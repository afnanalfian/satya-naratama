<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year  = (int) $request->get('year', now()->year);

        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = $startOfMonth->copy()->endOfMonth();

        // ===============================
        // MEETINGS
        // ===============================
        $meetings = Meeting::with('course')
            ->whereBetween('scheduled_at', [$startOfMonth, $endOfMonth])
            ->get()
            ->map(function ($m) {
                return [
                    'type'        => 'meeting',
                    'id'          => $m->id,
                    'title'       => $m->title,
                    'time'        => $m->scheduled_at,
                    'date_key'    => $m->scheduled_at->format('Y-m-d'),
                    'course_id'   => $m->course_id,
                    'url'         => route('meeting.show', $m),
                ];
            });

        // ===============================
        // TRYOUT (EXAM)
        // ===============================
        $tryouts = Exam::where('type', 'tryout')
            ->whereNotNull('exam_date')
            ->whereBetween('exam_date', [$startOfMonth, $endOfMonth])
            ->get()
            ->map(function ($e) {
                return [
                    'type'      => 'tryout',
                    'id'        => $e->id,
                    'title'     => $e->title ?? 'Tryout',
                    'time'      => Carbon::parse($e->exam_date),
                    'date_key'  => Carbon::parse($e->exam_date)->format('Y-m-d'),
                    'url'       => route('exams.show', $e),
                ];
            });

        // ===============================
        // MERGE + GROUP BY DATE
        // ===============================
        $calendarItems = $meetings
            ->merge($tryouts)
            ->sortBy('time')
            ->groupBy('date_key');

        return view('schedule.index', [
            'items'   => $calendarItems,
            'month'   => $month,
            'year'    => $year,
        ]);
    }

}
