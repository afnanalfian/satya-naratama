<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\User;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Absensi per pertemuan:
 * - Scan QR kartu siswa (admin & tentor)
 * - Absensi manual / koreksi (khusus admin), termasuk pertemuan yang sudah lewat
 */
class MeetingAttendanceController extends Controller
{
    public function __construct(protected AttendanceService $attendance)
    {
    }

    /**
     * Halaman absensi pertemuan: scanner + daftar peserta.
     */
    public function index(Meeting $meeting)
    {
        $meeting->load('course');

        $students = $this->attendance->participants();
        $records = MeetingAttendance::with('marker:id,name')
            ->where('meeting_id', $meeting->id)
            ->get()
            ->each(fn ($a) => $a->setRelation('meeting', $meeting))
            ->keyBy('user_id');

        [$canScan, $scanReason] = $this->attendance->scanAvailability($meeting, auth()->user());

        $rows = $students->map(function (User $s) use ($records) {
            $rec = $records->get($s->id);

            return [
                'id'     => $s->id,
                'name'   => $s->name,
                'avatar' => $s->avatar_url,
                'class'  => $s->studentRegistration?->class,
                'gender' => $s->studentRegistration?->gender,
                'status' => $rec?->status,
                'time'   => $rec?->marked_at?->format('H:i'),
                'date'   => $rec?->marked_at?->format('Y-m-d'),
                'late'   => (bool) $rec?->is_late,
                'method' => $rec?->method,
                'note'   => $rec?->note,
                'marker' => $rec?->marker?->name,
            ];
        })->values();

        return view('attendance.meeting', [
            'meeting'    => $meeting,
            'rows'       => $rows,
            'counts'     => $this->attendance->meetingCounts($meeting, $students->count()),
            'canScan'    => $canScan,
            'scanReason' => $scanReason,
            'isAdmin'    => auth()->user()->hasRole('admin'),
            'statuses'   => MeetingAttendance::STATUSES,
        ]);
    }

    /**
     * Endpoint scan QR (JSON).
     */
    public function scan(Request $request, Meeting $meeting)
    {
        $request->validate(['code' => 'required|string|max:255']);

        $meeting->load('course');
        $result = $this->attendance->recordScan($meeting, $request->input('code'), $request->user());
        $result['counts'] = $this->attendance->meetingCounts($meeting->fresh());
        $result['meeting_status'] = $meeting->fresh()->status;

        return response()->json($result, $result['ok'] ? 200 : 422);
    }

    /**
     * Data terbaru untuk sinkronisasi (beberapa perangkat scan bersamaan).
     */
    public function feed(Meeting $meeting)
    {
        $records = MeetingAttendance::where('meeting_id', $meeting->id)
            ->get()
            ->each(fn ($a) => $a->setRelation('meeting', $meeting));

        return response()->json([
            'counts'  => $this->attendance->meetingCounts($meeting),
            'records' => $records->map(fn ($a) => $this->attendance->attendancePayload($a))->values(),
            'meeting_status' => $meeting->status,
        ]);
    }

    /**
     * Absensi manual satu siswa (ADMIN).
     */
    public function manual(Request $request, Meeting $meeting)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'status'  => ['required', Rule::in([...array_keys(MeetingAttendance::STATUSES), 'reset'])],
            'time'    => 'nullable|date_format:H:i',
            'note'    => 'nullable|string|max:255',
        ]);

        $student = User::role('siswa')->findOrFail($data['user_id']);
        $meeting->load('course');

        $time = null;
        if (! empty($data['time'])) {
            $date = $meeting->scheduled_at ?? now();
            $time = Carbon::parse($date->format('Y-m-d') . ' ' . $data['time'], config('app.timezone'));
        }

        $record = $this->attendance->setManual($meeting, $student, $data['status'], $request->user(), $time, $data['note'] ?? null);

        return response()->json([
            'ok'         => true,
            'message'    => $record
                ? "{$student->name}: {$record->status_label}" . ($record->marked_at ? ' (' . $record->marked_at->format('H:i') . ')' : '')
                : "Catatan absensi {$student->name} dihapus",
            'attendance' => $record ? $this->attendance->attendancePayload($record) : ['user_id' => $student->id, 'status' => null],
            'counts'     => $this->attendance->meetingCounts($meeting),
        ]);
    }

    /**
     * Tandai massal siswa yang BELUM tercatat (ADMIN).
     */
    public function bulk(Request $request, Meeting $meeting)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(MeetingAttendance::STATUSES))],
        ]);

        $recorded = MeetingAttendance::where('meeting_id', $meeting->id)->pluck('user_id');
        $students = $this->attendance->participantsQuery()->whereNotIn('users.id', $recorded)->get();

        foreach ($students as $student) {
            $this->attendance->setManual($meeting, $student, $data['status'], $request->user());
        }

        toast('success', "{$students->count()} siswa ditandai " . MeetingAttendance::STATUSES[$data['status']]);

        return back();
    }

    /**
     * Tandai pertemuan selesai dari halaman absensi (ADMIN) —
     * dipakai untuk pertemuan lampau yang lupa diselesaikan.
     */
    public function complete(Meeting $meeting)
    {
        if ($meeting->status !== 'done') {
            $meeting->update([
                'status'     => 'done',
                'started_at' => $meeting->started_at ?? $meeting->scheduled_at,
            ]);
        }

        toast('success', 'Pertemuan ditandai selesai dan masuk ke perhitungan persentase.');

        return back();
    }
}
