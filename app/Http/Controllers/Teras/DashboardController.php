<?php

namespace App\Http\Controllers\Teras;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\Order;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /* =====================================================
     | ADMIN DASHBOARD
     |===================================================== */

    public function admin(Request $request)
    {
        // === COUNTERS ===
        $totalSiswa   = User::role('siswa')->count();
        $totalTentor  = User::role('tentor')->count();
        $totalCourse  = Course::count();
        $totalMeeting = Meeting::count();
        $doneMeeting  = Meeting::where('status', 'done')->count();

        // === WEEK RANGE (MONDAY - SUNDAY) ===
        $weekOffset = (int) $request->get('week', 0);

        $startOfWeek = Carbon::now()
            ->startOfWeek(Carbon::MONDAY)
            ->addWeeks($weekOffset);

        $endOfWeek = $startOfWeek->copy()->endOfWeek(Carbon::SUNDAY);

        // Format label untuk tampilan
        $weekLabel = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M Y');

        // === WEEKLY SALES GRAPH ===
        $weeklySales = Order::where('status', 'verified')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function($item) {
                return [
                    'day' => Carbon::parse($item->date)->format('D'),
                    'date' => Carbon::parse($item->date)->format('d M'),
                    'total' => (float) $item->total
                ];
            });

        // Buat array untuk 7 hari dalam seminggu
        $allDays = [];
        $currentDate = $startOfWeek->copy();

        for ($i = 0; $i < 7; $i++) {
            $day = $currentDate->format('D');
            $date = $currentDate->format('d M');

            $saleData = $weeklySales->firstWhere('date', $date);

            $allDays[] = [
                'day' => $day,
                'date' => $date,
                'total' => $saleData ? $saleData['total'] : 0
            ];

            $currentDate->addDay();
        }

        // === MEETINGS THIS WEEK (PRIORITIZE LIVE) ===
        $meetingsThisWeek = Meeting::with('course')
            ->whereBetween('scheduled_at', [$startOfWeek, $endOfWeek])
            ->orderByRaw("
                CASE status
                    WHEN 'live' THEN 1
                    WHEN 'upcoming' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('scheduled_at')
            ->limit(10)
            ->get();

        // === ORDERS WAITING CONFIRMATION ===
        $pendingOrders = Order::with('user')
            ->where('status', 'paid')
            ->latest()
            ->limit(10)
            ->get();

        // === STATS ARRAY ===
        $stats = [
            'total_siswa' => $totalSiswa,
            'total_tentor' => $totalTentor,
            'total_course' => $totalCourse,
            'total_meeting' => $totalMeeting,
            'done_meeting' => $doneMeeting,
            'pending_orders' => $pendingOrders->count()
        ];

        return view('admin.dashboard', compact(
            'stats',
            'allDays',
            'meetingsThisWeek',
            'pendingOrders',
            'startOfWeek',
            'endOfWeek',
            'weekOffset',
            'weekLabel'
        ));
    }

    /* =====================================================
    | SISWA DASHBOARD
    |===================================================== */

    public function siswa()
    {
        $user = auth()->user();

        // === STATS CARD DATA ===
        $ownedCourseIds = $user->ownedCourseIds();
        $ownedMeetingIds = $user->ownedMeetingIds();

        $stats = [
            'total_course' => count($ownedCourseIds),
            'total_meeting' => count($ownedMeetingIds),
            'done_meeting' => Meeting::whereIn('id', $ownedMeetingIds)
                ->where('status', 'done')
                ->count(),
            'active_quiz' => $user->examAttempts()->where('is_submitted', false)->count(),
        ];

        // === MEETINGS THIS WEEK (ONLY OWNED) ===
        $weeklyMeetings = Meeting::where(function ($q) use ($ownedMeetingIds, $ownedCourseIds) {
                $q->whereIn('id', $ownedMeetingIds)
                ->orWhereIn('course_id', $ownedCourseIds);
            })
            ->whereBetween(
                'scheduled_at',
                [now()->startOfWeek(), now()->endOfWeek()]
            )
            ->orderByRaw("
                CASE status
                    WHEN 'live' THEN 1
                    WHEN 'upcoming' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('scheduled_at')
            ->get();

        // === QUIZ TODAY ===
        $todayQuizzes = Exam::where('type', 'quiz')
            ->whereDate('exam_date', today())
            ->where('status', 'active')
            ->orderBy('exam_date')
            ->get();

        // === UPCOMING TRYOUTS ===
        $upcomingTryouts = Exam::where('type', 'tryout')
            ->whereDate('exam_date', '>=', today())
            ->where('status', 'active')
            ->orderBy('exam_date')
            ->limit(3)
            ->get();

        // === MY COURSES (hanya course yang punya meeting yang dimiliki user) ===
        $myCourses = Course::whereHas('meetings', function($q) use ($ownedMeetingIds, $ownedCourseIds) {
                $q->where(function($query) use ($ownedMeetingIds, $ownedCourseIds) {
                    $query->whereIn('id', $ownedMeetingIds)
                        ->orWhereIn('course_id', $ownedCourseIds);
                });
            })
            ->withCount(['meetings' => function($q) use ($ownedMeetingIds, $ownedCourseIds) {
                $q->where(function($query) use ($ownedMeetingIds, $ownedCourseIds) {
                    $query->whereIn('id', $ownedMeetingIds)
                        ->orWhereIn('course_id', $ownedCourseIds);
                });
            }])
            ->latest()
            ->limit(4)
            ->get();

        // === RECENT ASSIGNMENTS ===
        $recentAssignments = Exam::whereIn('id', function($query) use ($user) {
                $query->select('exam_id')
                    ->from('exam_attempts')
                    ->where('user_id', $user->id)
                    ->where('is_submitted', false);
            })
            ->orderBy('exam_date')
            ->limit(4)
            ->get();

        return view('siswa.dashboard', compact(
            'stats',
            'weeklyMeetings',
            'todayQuizzes',
            'upcomingTryouts',
            'myCourses',
            'recentAssignments'
        ));
    }


    /* =====================================================
    | TENTOR DASHBOARD
    |===================================================== */

    public function tentor()
    {
        $user = auth()->user();

        // === STATS CARD DATA ===
        $stats = [
            'total_courses' => $user->teacher->courses()->count() ?? 0,
            'total_meetings' => Meeting::where('created_by', $user->id)->count(),
            'live_meetings' => Meeting::where('created_by', $user->id)
                ->where('status', 'live')
                ->count(),
            'done_meetings' => Meeting::where('created_by', $user->id)
                ->where('status', 'done')
                ->count(),
        ];

        // === MEETINGS THIS WEEK (CREATED BY TENTOR) ===
        $weeklyMeetings = Meeting::with('course')
            ->whereBetween(
                'scheduled_at',
                [now()->startOfWeek(), now()->endOfWeek()]
            )
            ->orderByRaw("
                CASE status
                    WHEN 'live' THEN 1
                    WHEN 'upcoming' THEN 2
                    ELSE 3
                END
            ")
            ->orderBy('scheduled_at')
            ->get();

        // === TOTAL STUDENTS ATTENDED THIS WEEK ===
        $totalAttendance = DB::table('meeting_attendances')
            ->whereIn(
                'meeting_id',
                $weeklyMeetings->pluck('id')
            )
            ->where('is_present', true)
            ->count();

        // === RECENT STUDENTS (attended meetings) ===
        $recentStudents = DB::table('meeting_attendances')
            ->join('users', 'meeting_attendances.user_id', '=', 'users.id')
            ->join('meetings', 'meeting_attendances.meeting_id', '=', 'meetings.id')
            ->where('meetings.created_by', $user->id)
            ->where('meeting_attendances.is_present', true)
            ->select('users.id', 'users.name', 'users.email', 'meeting_attendances.created_at as attended_at')
            ->orderByDesc('meeting_attendances.created_at')
            ->limit(5)
            ->get();

        // === UPCOMING MEETINGS (NEXT 7 DAYS) ===
        $upcomingMeetings = Meeting::with('course')
            ->where('created_by', $user->id)
            ->where('status', 'upcoming')
            ->where('scheduled_at', '>=', now())
            ->where('scheduled_at', '<=', now()->addDays(7))
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        // === COURSES TAUGHT ===
        $coursesTaught = $user->teacher
            ? $user->teacher->courses()
                ->withCount(['meetings' => function($q) use ($user) {
                    $q->where('created_by', $user->id);
                }])
                ->orderByDesc('meetings_count')
                ->limit(4)
                ->get()
            : collect();

        return view('tentor.dashboard', compact(
            'stats',
            'weeklyMeetings',
            'totalAttendance',
            'recentStudents',
            'upcomingMeetings',
            'coursesTaught'
        ));
    }
}
