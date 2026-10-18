<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\User;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Modul manajemen absensi: rekap, grafik, detail siswa, export,
 * hub scan, kartu QR, dan halaman QR milik siswa.
 */
class AttendanceController extends Controller
{
    public function __construct(protected AttendanceService $attendance)
    {
    }

    /* =====================================================
     | REKAP & MONITORING
     |===================================================== */

    public function index(Request $request)
    {
        $filters = $this->filters($request);

        $done = $this->attendance->doneMeetings($filters['type'], $filters['course_id'], $filters['from'], $filters['to']);
        $students = $this->attendance->participants();
        $participantIds = $students->pluck('id');
        $summaries = $this->attendance->studentSummaries($students, $done);
        $averages = $this->attendance->averageByType($summaries);
        $threshold = (float) config('attendance.warning_threshold', 75);

        // Tabel siswa (dengan pencarian & urutan)
        $rows = $students->map(fn ($s) => ['student' => $s] + $summaries[$s->id]);
        if ($filters['q'] !== '') {
            $q = mb_strtolower($filters['q']);
            $rows = $rows->filter(fn ($r) => str_contains(mb_strtolower($r['student']->name), $q));
        }
        $rows = match ($filters['sort']) {
            'akademik' => $rows->sortBy(fn ($r) => $r['akademik']['pct'] ?? 999),
            'jasmani'  => $rows->sortBy(fn ($r) => $r['jasmani']['pct'] ?? 999),
            'overall'  => $rows->sortBy(fn ($r) => $r['overall']['pct'] ?? 999),
            default    => $rows->sortBy(fn ($r) => mb_strtolower($r['student']->name)),
        };

        $lowAttendance = collect($summaries)->filter(function ($s) use ($threshold) {
            return ($s['akademik']['pct'] !== null && $s['akademik']['pct'] < $threshold)
                || ($s['jasmani']['pct'] !== null && $s['jasmani']['pct'] < $threshold);
        })->count();

        // Komposisi status keseluruhan
        $composition = ['hadir' => 0, 'izin' => 0, 'sakit' => 0, 'alpa' => 0];
        foreach ($summaries as $s) {
            foreach ($composition as $k => $_) {
                $composition[$k] += $s['overall'][$k];
            }
        }

        // Matriks (hanya bila satu course dipilih)
        $matrix = null;
        if ($filters['course_id']) {
            $matrix = MeetingAttendance::whereIn('meeting_id', $done->pluck('id'))
                ->whereIn('user_id', $participantIds)
                ->get(['meeting_id', 'user_id', 'status', 'marked_at'])
                ->groupBy('user_id')
                ->map(fn ($g) => $g->keyBy('meeting_id'));
        }

        // Pertemuan lampau yang belum diselesaikan (peringatan untuk admin)
        $unfinishedPast = Meeting::with('course:id,name,type')
            ->where('status', '!=', 'done')
            ->where('scheduled_at', '<', now()->startOfDay())
            ->orderByDesc('scheduled_at')
            ->limit(10)
            ->get();

        return view('attendance.index', [
            'filters'        => $filters,
            'courses'        => Course::orderBy('type')->orderBy('name')->get(['id', 'name', 'type']),
            'done'           => $done,
            'doneByType'     => $done->groupBy(fn ($m) => $m->course?->type ?? 'akademik')->map->count(),
            'rows'           => $rows->values(),
            'averages'       => $averages,
            'threshold'      => $threshold,
            'lowAttendance'  => $lowAttendance,
            'studentCount'   => $students->count(),
            'composition'    => $composition,
            'weekly'         => $this->attendance->weeklySeries($done, null, $participantIds),
            'perMeeting'     => array_slice($this->attendance->perMeetingSeries($done, $participantIds), -24),
            'matrix'         => $matrix,
            'unfinishedPast' => $unfinishedPast,
        ]);
    }

    public function student(Request $request, User $user)
    {
        abort_unless($user->hasRole('siswa'), 404);
        $user->load('studentRegistration');

        $filters = $this->filters($request);
        $done = $this->attendance->doneMeetings(null, null, $filters['from'], $filters['to']);
        $summary = $this->attendance->studentSummaries(collect([$user]), $done)[$user->id];
        $history = $this->attendance->studentHistory($user, $done);

        $perCourse = $history->groupBy(fn ($h) => $h->meeting->course_id)->map(function ($items) {
            $course = $items->first()->meeting->course;
            $hadir = $items->where('status', 'hadir')->count();

            return [
                'course' => $course,
                'done'   => $items->count(),
                'hadir'  => $hadir,
                'izin'   => $items->where('status', 'izin')->count(),
                'sakit'  => $items->where('status', 'sakit')->count(),
                'alpa'   => $items->where('status', 'alpa')->count(),
                'pct'    => $items->count() ? round($hadir / $items->count() * 100, 1) : null,
            ];
        })->sortBy(fn ($c) => [$c['course']?->type, $c['course']?->name])->values();

        return view('attendance.student', [
            'student'   => $user,
            'filters'   => $filters,
            'summary'   => $summary,
            'history'   => $history,
            'perCourse' => $perCourse,
            'weekly'    => $this->attendance->weeklySeries($done, $user->id),
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        $filters = $this->filters($request);
        $done = $this->attendance->doneMeetings($filters['type'], $filters['course_id'], $filters['from'], $filters['to']);
        $students = $this->attendance->participants();
        $summaries = $this->attendance->studentSummaries($students, $done);

        $filename = 'rekap-absensi-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($students, $summaries) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM agar terbaca rapi di Excel
            fputcsv($out, [
                'No', 'Nama', 'Kelas',
                'Akademik Selesai', 'Akademik Hadir', 'Akademik Izin', 'Akademik Sakit', 'Akademik Alpa', 'Akademik %',
                'Jasmani Selesai', 'Jasmani Hadir', 'Jasmani Izin', 'Jasmani Sakit', 'Jasmani Alpa', 'Jasmani %',
                'Total %',
            ], ';');

            foreach ($students->values() as $i => $s) {
                $sum = $summaries[$s->id];
                $row = [$i + 1, $s->name, $s->studentRegistration?->class];
                foreach (['akademik', 'jasmani'] as $t) {
                    $row = array_merge($row, [
                        $sum[$t]['done'], $sum[$t]['hadir'], $sum[$t]['izin'], $sum[$t]['sakit'], $sum[$t]['alpa'],
                        $sum[$t]['pct'] === null ? '-' : str_replace('.', ',', (string) $sum[$t]['pct']),
                    ]);
                }
                $row[] = $sum['overall']['pct'] === null ? '-' : str_replace('.', ',', (string) $sum['overall']['pct']);
                fputcsv($out, $row, ';');
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /* =====================================================
     | HUB SCAN
     |===================================================== */

    public function hub()
    {
        $user = auth()->user();
        $isAdmin = $user->hasRole('admin');

        $today = Meeting::with('course:id,name,slug,type')
            ->whereHas('course')
            ->where(function ($q) {
                $q->where('status', 'live')
                  ->orWhereBetween('scheduled_at', [now()->startOfDay(), now()->endOfDay()]);
            })
            ->orderByRaw("CASE status WHEN 'live' THEN 1 WHEN 'upcoming' THEN 2 ELSE 3 END")
            ->orderBy('scheduled_at')
            ->get();

        $upcoming = Meeting::with('course:id,name,slug,type')
            ->whereHas('course')
            ->where('status', 'upcoming')
            ->where('scheduled_at', '>', now()->endOfDay())
            ->orderBy('scheduled_at')
            ->limit(6)
            ->get();

        $past = $isAdmin
            ? Meeting::with('course:id,name,slug,type')
                ->whereHas('course')
                ->where('scheduled_at', '<', now()->startOfDay())
                ->orderByDesc('scheduled_at')
                ->paginate(15)
            : null;

        $counts = [];
        foreach ($today->concat($past?->items() ?? []) as $m) {
            $counts[$m->id] = $this->attendance->meetingCounts($m);
        }

        return view('attendance.hub', compact('today', 'upcoming', 'past', 'counts', 'isAdmin'));
    }

    /* =====================================================
     | KARTU QR
     |===================================================== */

    public function qrCards(Request $request)
    {
        $q = trim((string) $request->query('q'));
        $students = $this->attendance->participantsQuery()
            ->with('studentRegistration:id,user_id,full_name,gender,class,school_origin')
            ->when($q, fn ($qr) => $qr->where('name', 'like', "%{$q}%"))
            ->orderBy('name')
            ->get()
            ->each->ensureTokens();

        if ($request->boolean('print')) {
            $ids = collect(explode(',', (string) $request->query('ids')))->filter()->map(fn ($v) => (int) $v);
            if ($ids->isNotEmpty()) {
                $students = $students->whereIn('id', $ids)->values();
            }

            return view('attendance.qr-print', compact('students'));
        }

        return view('attendance.qr-cards', compact('students', 'q'));
    }

    public function regenerateQr(User $user)
    {
        abort_unless($user->hasRole('siswa'), 404);
        $user->qr_token = User::newQrToken();
        $user->saveQuietly();

        toast('success', "QR {$user->name} diperbarui. Kartu lama tidak berlaku lagi.");

        return back();
    }

    /* =====================================================
     | SISWA: QR SAYA
     |===================================================== */

    public function myQr()
    {
        $user = auth()->user()->load('studentRegistration');
        $user->ensureTokens();

        $done = $this->attendance->doneMeetings();
        $summary = $this->attendance->studentSummaries(collect([$user]), $done)[$user->id];
        $history = $this->attendance->studentHistory($user, $done)->take(8);

        return view('attendance.my-qr', compact('user', 'summary', 'history'));
    }

    /* ===================================================== */

    protected function filters(Request $request): array
    {
        $type = $request->query('type');
        $type = in_array($type, AttendanceService::TYPES, true) ? $type : null;

        $from = $request->query('from');
        $to = $request->query('to');

        return [
            'type'      => $type,
            'course_id' => $request->integer('course_id') ?: null,
            'from'      => $from ? rescue(fn () => Carbon::parse($from), null, false) : null,
            'to'        => $to ? rescue(fn () => Carbon::parse($to), null, false) : null,
            'q'         => trim((string) $request->query('q', '')),
            'sort'      => in_array($request->query('sort'), ['akademik', 'jasmani', 'overall'], true) ? $request->query('sort') : 'name',
        ];
    }
}
