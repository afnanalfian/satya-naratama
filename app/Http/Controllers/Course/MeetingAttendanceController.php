<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;

class MeetingAttendanceController extends Controller
{
     /**
     * Display attendance page with eligibility check
     */
    public function index(Meeting $meeting, Request $request)
    {
        $search = $request->query('search', '');

        // Query siswa yang memiliki akses ke meeting ini
        $query = User::role('siswa')
            ->where(function($query) use ($meeting) {
                // Siswa yang memiliki akses ke course ini
                $query->whereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'course')
                      ->where('entitlement_id', $meeting->course_id);
                })
                // ATAU siswa yang membeli meeting satuan ini
                ->orWhereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'meeting')
                      ->where('entitlement_id', $meeting->id);
                });
            })
            ->orderBy('name');

        // Tambahkan filter pencarian jika ada
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $eligibleStudents = $query->paginate(20);

        // Ambil absensi yang sudah ada HANYA untuk siswa yang eligible
        $attendances = MeetingAttendance::where('meeting_id', $meeting->id)
            ->whereIn('user_id', $eligibleStudents->pluck('id'))
            ->get()
            ->keyBy('user_id');

        // Hitung statistik
        $presentCount = $attendances->where('is_present', true)->count();
        $absentCount = $eligibleStudents->total() - $presentCount;

        return view('meetings.attendance', [
            'meeting'           => $meeting,
            'eligibleStudents'  => $eligibleStudents,
            'attendances'       => $attendances,
            'search'            => $search,
            'presentCount'      => $presentCount,
            'absentCount'       => $absentCount,
        ]);
    }

    /**
     * Store / update attendance ONLY for eligible students
     */
    public function store(Request $request, Meeting $meeting)
    {
        // Validasi: hanya boleh ada attendances untuk siswa yang eligible
        $eligibleStudentIds = User::role('siswa')
            ->where(function($query) use ($meeting) {
                $query->whereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'course')
                      ->where('entitlement_id', $meeting->course_id);
                })
                ->orWhereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'meeting')
                      ->where('entitlement_id', $meeting->id);
                });
            })
            ->pluck('id')
            ->toArray();

        // Filter hanya attendances untuk siswa yang eligible
        $validAttendances = array_intersect_key(
            $request->attendances ?? [],
            array_flip($eligibleStudentIds)
        );

        // Update atau create attendance HANYA untuk siswa eligible
        foreach ($eligibleStudentIds as $studentId) {
            MeetingAttendance::updateOrCreate(
                [
                    'meeting_id' => $meeting->id,
                    'user_id'    => $studentId,
                ],
                [
                    'is_present' => isset($validAttendances[$studentId]),
                    'marked_by'  => auth()->id(),
                    'marked_at'  => now(),
                ]
            );
        }

        // Hapus absensi untuk siswa yang tidak eligible (jika ada)
        MeetingAttendance::where('meeting_id', $meeting->id)
            ->whereNotIn('user_id', $eligibleStudentIds)
            ->delete();

        toast('success', 'Absensi berhasil disimpan');
        return redirect()->route('meeting.show', $meeting);
    }

    /**
     * Quick attendance - toggle kehadiran satu siswa
     * DENGAN eligibility check
     */
    public function quickToggle(Request $request, Meeting $meeting)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'status'     => 'required|boolean',
        ]);

        // Cek apakah siswa eligible untuk meeting ini
        $isEligible = User::role('siswa')
            ->where('id', $request->student_id)
            ->where(function($query) use ($meeting) {
                $query->whereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'course')
                      ->where('entitlement_id', $meeting->course_id);
                })
                ->orWhereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'meeting')
                      ->where('entitlement_id', $meeting->id);
                });
            })
            ->exists();

        if (!$isEligible) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak memiliki akses ke meeting ini'
            ], 403);
        }

        $student = User::findOrFail($request->student_id);

        MeetingAttendance::updateOrCreate(
            [
                'meeting_id' => $meeting->id,
                'user_id'    => $student->id,
            ],
            [
                'is_present' => $request->status,
                'marked_by'  => auth()->id(),
                'marked_at'  => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Absensi ' . $student->name . ' berhasil diupdate',
            'status'  => $request->status ? 'hadir' : 'tidak hadir'
        ]);
    }
    public function courseAttendanceReport(Request $request)
    {
        $courses = Course::orderBy('name')->get();
        $selectedCourseId = $request->query('course_id');

        $attendanceData = collect();

        if ($selectedCourseId) {
            $course = Course::findOrFail($selectedCourseId);

            // Ambil semua meeting yang sudah done di course ini
            $doneMeetings = Meeting::where('course_id', $selectedCourseId)
                ->where('status', 'done')
                ->get();

            // Ambil semua siswa yang memiliki akses ke course ini
            $students = User::role('siswa')
                ->with(['attendances' => function($q) use ($doneMeetings) {
                    $q->whereIn('meeting_id', $doneMeetings->pluck('id'))
                    ->where('is_present', true);
                }])
                ->get();

            $totalDoneMeetings = $doneMeetings->count();

            // Hitung persentase kehadiran per siswa
            foreach ($students as $student) {
                $attendedCount = $student->attendances->count();
                $percentage = $totalDoneMeetings > 0
                    ? round(($attendedCount / $totalDoneMeetings) * 100, 1)
                    : null;

                $attendanceData->push([
                    'student' => $student,
                    'attended_count' => $attendedCount,
                    'total_done_meetings' => $totalDoneMeetings,
                    'percentage' => $percentage,
                    'attended_meetings' => $student->attendances->pluck('meeting_id')->toArray()
                ]);
            }

            // Urutkan dari yang paling sering hadir ke paling jarang
            $attendanceData = $attendanceData->sortByDesc('percentage');
        }

        return view('reports.course-attendance', compact(
            'courses',
            'selectedCourseId',
            'attendanceData'
        ));
    }

}
