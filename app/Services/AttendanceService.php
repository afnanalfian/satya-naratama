<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Seluruh logika absensi (scan QR, input manual, rekap & persentase)
 * dikumpulkan di sini agar konsisten dipakai oleh halaman admin, tentor,
 * siswa, dan link pantauan orang tua.
 *
 * Aturan persentase:
 *   persentase = jumlah HADIR / jumlah pertemuan berstatus "done" (selesai)
 *   dihitung terpisah untuk course AKADEMIK dan JASMANI.
 */
class AttendanceService
{
    public const TYPES = [Course::TYPE_AKADEMIK, Course::TYPE_JASMANI];

    /* =====================================================
     | PESERTA
     |===================================================== */

    /**
     * Peserta absensi = semua siswa aktif.
     * (Bimbel reguler: seluruh siswa mengikuti seluruh course.)
     */
    public function participantsQuery(): Builder
    {
        return User::query()->activeStudents();
    }

    public function participants(): Collection
    {
        return $this->participantsQuery()
            ->with('studentRegistration:id,user_id,full_name,gender,class,school_origin')
            ->orderBy('name')
            ->get();
    }

    /* =====================================================
     | SCAN QR
     |===================================================== */

    /**
     * Apakah $actor boleh melakukan scan untuk pertemuan ini sekarang?
     * - Admin  : semua pertemuan yang belum selesai.
     * - Tentor : pertemuan yang sedang live, atau terjadwal hari ini.
     * Pertemuan yang sudah selesai hanya bisa diubah lewat absensi manual (admin).
     */
    public function scanAvailability(Meeting $meeting, User $actor): array
    {
        if ($meeting->status === 'done') {
            return [false, 'Pertemuan sudah selesai. Gunakan absensi manual (admin) untuk mengubah data.'];
        }

        if ($actor->hasRole('admin')) {
            return [true, null];
        }

        if ($meeting->status === 'live') {
            return [true, null];
        }

        if ($meeting->scheduled_at && $meeting->scheduled_at->isSameDay(now())) {
            return [true, null];
        }

        return [false, 'Scan hanya bisa dilakukan pada hari pertemuan berlangsung.'];
    }

    /**
     * Ambil token dari isi QR (mendukung dengan/tanpa prefix, huruf besar/kecil,
     * maupun URL yang berisi token di akhir).
     */
    public function extractToken(string $raw): string
    {
        $raw = trim($raw);
        $prefix = config('attendance.qr_prefix', 'SN-');

        if (str_contains($raw, '/')) {
            $raw = last(explode('/', rtrim($raw, '/')));
        }
        if (stripos($raw, $prefix) === 0) {
            $raw = substr($raw, strlen($prefix));
        }

        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $raw));
    }

    /**
     * Proses satu hasil scan.
     *
     * @return array{ok:bool, code:string, message:string, student:?array, attendance:?array}
     */
    public function recordScan(Meeting $meeting, string $raw, User $actor): array
    {
        [$allowed, $reason] = $this->scanAvailability($meeting, $actor);
        if (! $allowed) {
            return $this->scanResult(false, 'closed', $reason);
        }

        $token = $this->extractToken($raw);
        if ($token === '') {
            return $this->scanResult(false, 'invalid', 'QR code tidak valid.');
        }

        $student = User::where('qr_token', $token)
            ->with('studentRegistration:id,user_id,full_name,gender,class')
            ->first();

        if (! $student || ! $student->hasRole('siswa')) {
            return $this->scanResult(false, 'not_found', 'QR code tidak terdaftar sebagai siswa.');
        }

        if (! $student->is_active) {
            return $this->scanResult(false, 'inactive', "Akun {$student->name} sedang nonaktif.", $student);
        }

        // Pertemuan upcoming yang di-scan pada harinya otomatis dimulai (live)
        if ($meeting->status === 'upcoming') {
            $meeting->update(['status' => 'live', 'started_at' => $meeting->started_at ?? now()]);
        }

        $existing = MeetingAttendance::where('meeting_id', $meeting->id)
            ->where('user_id', $student->id)
            ->first();

        if ($existing && $existing->status === MeetingAttendance::STATUS_HADIR) {
            return $this->scanResult(
                true,
                'duplicate',
                "{$student->name} sudah tercatat hadir pukul {$existing->marked_at?->format('H:i')}.",
                $student,
                $existing->setRelation('meeting', $meeting)
            );
        }

        $attendance = MeetingAttendance::updateOrCreate(
            ['meeting_id' => $meeting->id, 'user_id' => $student->id],
            [
                'status'    => MeetingAttendance::STATUS_HADIR,
                'method'    => MeetingAttendance::METHOD_SCAN,
                'marked_by' => $actor->id,
                'marked_at' => now(),
            ]
        )->setRelation('meeting', $meeting);

        $msg = "{$student->name} tercatat hadir pukul {$attendance->marked_at->format('H:i')}";
        if ($attendance->is_late) {
            $msg .= ' (terlambat)';
        }

        return $this->scanResult(true, 'recorded', $msg . '.', $student, $attendance);
    }

    protected function scanResult(bool $ok, string $code, string $message, ?User $student = null, ?MeetingAttendance $attendance = null): array
    {
        return [
            'ok'         => $ok,
            'code'       => $code,
            'message'    => $message,
            'student'    => $student ? $this->studentPayload($student) : null,
            'attendance' => $attendance ? $this->attendancePayload($attendance) : null,
        ];
    }

    public function studentPayload(User $student): array
    {
        return [
            'id'     => $student->id,
            'name'   => $student->name,
            'avatar' => $student->avatar_url,
            'class'  => $student->studentRegistration?->class,
            'gender' => $student->studentRegistration?->gender,
        ];
    }

    public function attendancePayload(MeetingAttendance $a): array
    {
        return [
            'user_id' => $a->user_id,
            'status'  => $a->status,
            'label'   => $a->status_label,
            'method'  => $a->method,
            'time'    => $a->marked_at?->format('H:i'),
            'late'    => $a->is_late,
            'note'    => $a->note,
        ];
    }

    /* =====================================================
     | ABSENSI MANUAL (ADMIN)
     |===================================================== */

    /**
     * Set status kehadiran secara manual. $status = 'reset' menghapus catatan.
     */
    public function setManual(
        Meeting $meeting,
        User $student,
        string $status,
        User $actor,
        ?CarbonInterface $time = null,
        ?string $note = null
    ): ?MeetingAttendance {
        if ($status === 'reset') {
            MeetingAttendance::where('meeting_id', $meeting->id)->where('user_id', $student->id)->delete();

            return null;
        }

        $markedAt = $time
            ?? ($status === MeetingAttendance::STATUS_HADIR
                ? ($meeting->status === 'done' ? $meeting->scheduled_at : now())
                : now());

        return MeetingAttendance::updateOrCreate(
            ['meeting_id' => $meeting->id, 'user_id' => $student->id],
            [
                'status'    => $status,
                'method'    => MeetingAttendance::METHOD_MANUAL,
                'note'      => $note,
                'marked_by' => $actor->id,
                'marked_at' => $markedAt,
            ]
        )->setRelation('meeting', $meeting);
    }

    /* =====================================================
     | STATISTIK PER PERTEMUAN
     |===================================================== */

    public function meetingCounts(Meeting $meeting, ?int $participantCount = null): array
    {
        $participantIds = $this->participantsQuery()->pluck('users.id');
        $participantCount ??= $participantIds->count();

        $byStatus = MeetingAttendance::where('meeting_id', $meeting->id)
            ->whereIn('user_id', $participantIds)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $hadir = (int) ($byStatus['hadir'] ?? 0);
        $izin  = (int) ($byStatus['izin'] ?? 0);
        $sakit = (int) ($byStatus['sakit'] ?? 0);
        $alpa  = (int) ($byStatus['alpa'] ?? 0);

        return [
            'total'      => $participantCount,
            'hadir'      => $hadir,
            'izin'       => $izin,
            'sakit'      => $sakit,
            'alpa'       => $alpa,
            'unrecorded' => max(0, $participantCount - $hadir - $izin - $sakit - $alpa),
            'pct'        => $participantCount ? round($hadir / $participantCount * 100, 1) : 0,
        ];
    }

    /* =====================================================
     | REKAP
     |===================================================== */

    /**
     * Pertemuan selesai sesuai filter.
     */
    public function doneMeetings(
        ?string $type = null,
        ?int $courseId = null,
        ?CarbonInterface $from = null,
        ?CarbonInterface $to = null
    ): Collection {
        return Meeting::query()
            ->with('course:id,name,slug,type')
            ->where('status', 'done')
            ->whereHas('course', fn ($q) => $q->ofType($type))
            ->when($courseId, fn ($q) => $q->where('course_id', $courseId))
            ->when($from, fn ($q) => $q->where('scheduled_at', '>=', $from->copy()->startOfDay()))
            ->when($to, fn ($q) => $q->where('scheduled_at', '<=', $to->copy()->endOfDay()))
            ->orderBy('scheduled_at')
            ->get();
    }

    /**
     * Ringkasan kehadiran per siswa, dipisah akademik & jasmani.
     *
     * @param  Collection<User>     $students
     * @param  Collection<Meeting>  $doneMeetings
     * @return array<int, array>    keyed by user_id
     */
    public function studentSummaries(Collection $students, Collection $doneMeetings): array
    {
        $meetingType = $doneMeetings->mapWithKeys(fn ($m) => [$m->id => $m->course?->type ?? Course::TYPE_AKADEMIK]);
        $doneByType = collect(self::TYPES)->mapWithKeys(
            fn ($t) => [$t => $meetingType->filter(fn ($mt) => $mt === $t)->count()]
        );

        $records = MeetingAttendance::query()
            ->whereIn('meeting_id', $meetingType->keys())
            ->whereIn('user_id', $students->pluck('id'))
            ->get(['meeting_id', 'user_id', 'status', 'marked_at'])
            ->groupBy('user_id');

        $out = [];
        foreach ($students as $student) {
            $rows = $records->get($student->id, collect());
            $summary = [];

            foreach (self::TYPES as $type) {
                $typed = $rows->filter(fn ($r) => ($meetingType[$r->meeting_id] ?? null) === $type);
                $summary[$type] = $this->bucket($typed, $doneByType[$type]);
            }

            $summary['overall'] = $this->bucket($rows, $meetingType->count());
            $summary['last_present_at'] = $rows->where('status', 'hadir')->max('marked_at');

            $out[$student->id] = $summary;
        }

        return $out;
    }

    protected function bucket(Collection $rows, int $done): array
    {
        $hadir = $rows->where('status', 'hadir')->count();
        $izin  = $rows->where('status', 'izin')->count();
        $sakit = $rows->where('status', 'sakit')->count();

        return [
            'done'  => $done,
            'hadir' => $hadir,
            'izin'  => $izin,
            'sakit' => $sakit,
            // pertemuan selesai tanpa catatan dihitung alpa
            'alpa'  => max(0, $done - $hadir - $izin - $sakit),
            'pct'   => $done > 0 ? round($hadir / $done * 100, 1) : null,
        ];
    }

    /**
     * Rata-rata persentase kehadiran per jenis (seluruh peserta).
     */
    public function averageByType(array $summaries): array
    {
        $out = [];
        foreach (self::TYPES as $type) {
            $vals = collect($summaries)->pluck("{$type}.pct")->filter(fn ($v) => $v !== null);
            $out[$type] = $vals->count() ? round($vals->avg(), 1) : null;
        }

        return $out;
    }

    /**
     * Grafik kehadiran per pekan (Senin–Minggu), dipisah akademik & jasmani.
     * Jika $studentId diisi -> persentase siswa tsb, jika tidak -> seluruh peserta.
     */
    public function weeklySeries(Collection $doneMeetings, ?int $studentId = null, ?Collection $participantIds = null): array
    {
        if ($doneMeetings->isEmpty()) {
            return ['labels' => [], 'ranges' => [], 'akademik' => [], 'jasmani' => [], 'meetings' => []];
        }

        $participantIds = $studentId
            ? collect([$studentId])
            : ($participantIds ?? $this->participantsQuery()->pluck('users.id'));
        $n = max(1, $participantIds->count());

        $presentByMeeting = MeetingAttendance::query()
            ->whereIn('meeting_id', $doneMeetings->pluck('id'))
            ->whereIn('user_id', $participantIds)
            ->where('status', 'hadir')
            ->selectRaw('meeting_id, COUNT(*) as total')
            ->groupBy('meeting_id')
            ->pluck('total', 'meeting_id');

        $weeks = $doneMeetings->groupBy(fn ($m) => $m->scheduled_at->copy()->startOfWeek(Carbon::MONDAY)->toDateString());

        // isi pekan kosong di antara agar sumbu waktu tidak menipu
        $start = Carbon::parse($weeks->keys()->min());
        $end = Carbon::parse($weeks->keys()->max());

        $labels = $ranges = $akad = $jas = $counts = [];
        for ($w = $start->copy(); $w->lte($end); $w->addWeek()) {
            $key = $w->toDateString();
            $meetings = $weeks->get($key, collect());
            $weekEnd = $w->copy()->endOfWeek(Carbon::SUNDAY);

            $labels[] = $w->translatedFormat('d M');
            $ranges[] = $w->translatedFormat('d M') . ' – ' . $weekEnd->translatedFormat('d M Y');

            foreach (self::TYPES as $type) {
                $typed = $meetings->filter(fn ($m) => ($m->course?->type ?? Course::TYPE_AKADEMIK) === $type);
                $slots = $typed->count() * $n;
                $present = $typed->sum(fn ($m) => (int) ($presentByMeeting[$m->id] ?? 0));
                $pct = $slots > 0 ? round($present / $slots * 100, 1) : null;

                if ($type === Course::TYPE_AKADEMIK) {
                    $akad[] = $pct;
                } else {
                    $jas[] = $pct;
                }
                $counts[$type][] = $typed->count();
            }
        }

        return [
            'labels'   => $labels,
            'ranges'   => $ranges,
            'akademik' => $akad,
            'jasmani'  => $jas,
            'meetings' => $counts,
        ];
    }

    /**
     * Persentase hadir per pertemuan (untuk grafik batang).
     */
    public function perMeetingSeries(Collection $doneMeetings, ?Collection $participantIds = null): array
    {
        $participantIds ??= $this->participantsQuery()->pluck('users.id');
        $n = max(1, $participantIds->count());

        $present = MeetingAttendance::query()
            ->whereIn('meeting_id', $doneMeetings->pluck('id'))
            ->whereIn('user_id', $participantIds)
            ->where('status', 'hadir')
            ->selectRaw('meeting_id, COUNT(*) as total')
            ->groupBy('meeting_id')
            ->pluck('total', 'meeting_id');

        return $doneMeetings->map(fn ($m) => [
            'id'     => $m->id,
            'slug'   => $m->slug,
            'title'  => $m->title,
            'course' => $m->course?->name,
            'type'   => $m->course?->type ?? Course::TYPE_AKADEMIK,
            'date'   => $m->scheduled_at->translatedFormat('d M'),
            'hadir'  => (int) ($present[$m->id] ?? 0),
            'total'  => $n,
            'pct'    => round(((int) ($present[$m->id] ?? 0)) / $n * 100, 1),
        ])->values()->all();
    }

    /**
     * Riwayat pertemuan selesai untuk satu siswa (status per pertemuan).
     */
    public function studentHistory(User $student, Collection $doneMeetings): Collection
    {
        $records = MeetingAttendance::where('user_id', $student->id)
            ->whereIn('meeting_id', $doneMeetings->pluck('id'))
            ->get()
            ->keyBy('meeting_id');

        return $doneMeetings->sortByDesc('scheduled_at')->values()->map(function ($m) use ($records) {
            $rec = $records->get($m->id)?->setRelation('meeting', $m);

            return (object) [
                'meeting' => $m,
                'status'  => $rec?->status ?? MeetingAttendance::STATUS_ALPA,
                'label'   => $rec?->status_label ?? 'Alpa',
                'time'    => $rec?->marked_at,
                'late'    => (bool) $rec?->is_late,
                'method'  => $rec?->method,
                'note'    => $rec?->note,
            ];
        });
    }
}
