<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use App\Models\Meeting;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class MeetingController extends Controller
{
    /**
     * Show meeting detail
     * (materi, video, attendance, post test)
     */
    public function show(Meeting $meeting)
    {
        try {
            $this->authorize('view', $meeting);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            toast('error', 'Silakan lakukan pembelian terlebih dahulu');
            return redirect()->back();
        }

        // ===============================
        // LOAD RELATIONS
        // ===============================
        $meeting->load([
            'material',
            'video',
            'creator',

            // exams
            'blindTest.questions.question.options',
            'blindTest.attempts',

            'postTest.questions.question.options',
            'postTest.attempts',

            // attendance
            'attendances' => function ($q) {
                $q->whereHas('user.roles', function ($r) {
                    $r->where('name', 'siswa');
                })->with('user');
            },
        ]);

        $blindAttempt = null;
        $postAttempt  = null;

        // ===============================
        // ATTEMPT KHUSUS SISWA
        // ===============================
        if (auth()->check() && auth()->user()->hasRole('siswa')) {

            if ($meeting->blindTest) {
                $blindAttempt = $meeting->blindTest
                    ->attempts()
                    ->where('user_id', auth()->id())
                    ->first();
            }

            if ($meeting->postTest) {
                $postAttempt = $meeting->postTest
                    ->attempts()
                    ->where('user_id', auth()->id())
                    ->first();
            }
        }

        return view('meetings.show', [
            'meeting'       => $meeting,
            'blindTest'     => $meeting->blindTest,
            'postTest'      => $meeting->postTest,
            'blindAttempt'  => $blindAttempt,
            'postAttempt'   => $postAttempt,
        ]);
    }

    /**
     * Show create meeting form
     */
    public function create(Course $course)
    {
        return view('meetings.create', compact('course'));
    }

    /**
     * Store new meeting
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'scheduled_at' => 'required|date_format:Y-m-d\TH:i',
            'zoom_link'    => 'nullable|url',
            'is_free'      => 'nullable|boolean',
        ]);

        Meeting::create([
            'course_id'    => $course->id,
            'title'        => $request->title,
            'scheduled_at' => Carbon::createFromFormat(
                'Y-m-d\TH:i',
                $request->scheduled_at,
                'Asia/Jakarta'
            ),
            'zoom_link'  => $request->zoom_link,
            'status'     => 'upcoming',
            'is_free'    => $request->boolean('is_free'),
            'created_by' => auth()->id(),
        ]);

        toast('success', 'Meeting berhasil dibuat');
        return redirect()->route('course.show', $course->slug);
    }

    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', [
            'meeting'     => $meeting,
            'scheduledAt' => optional($meeting->scheduled_at)
                ->timezone('Asia/Jakarta')
                ->format('Y-m-d\TH:i'),
        ]);
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'scheduled_at' => 'required|date',
            'zoom_link'    => 'nullable|url',
            'is_free'      => 'nullable|boolean',
        ]);

        $meeting->update([
            'title'        => $request->title,
            'slug'         => $meeting->slug
                                ?? Str::slug($request->title) . '-' . uniqid(),
            'scheduled_at' => Carbon::createFromFormat(
                'Y-m-d\TH:i',
                $request->scheduled_at,
                'Asia/Jakarta'
            ),
            'zoom_link'    => $request->zoom_link,
            'is_free'      => $request->boolean('is_free'),
        ]);

        toast('success', 'Meeting berhasil diperbarui');

        return redirect()->route('meeting.show', $meeting);
    }

    /**
     * Start meeting
     */
    public function start(Meeting $meeting)
    {
        $meeting->update([
            'status'     => 'live',
            'started_at' => now(),
        ]);

        toast('success', 'Meeting dimulai');
        return back();
    }

    /**
     * Finish meeting
     */
    public function finish(Meeting $meeting)
    {
        if ($meeting->status !== 'live') {
            abort(403, 'Meeting belum live');
        }

        $meeting->update([
            'status' => 'done',
        ]);
        /** NOTIFY TEACHERS */
        foreach ($meeting->course->teachers as $teacher) {
            notify_user(
                $teacher->user,
                "Meeting '{$meeting->title}' telah selesai. Harap upload materi dan video.",
                false,
                route('meeting.show', $meeting)
            );
        }
        toast('success', 'Meeting selesai');
        return back();
    }

    /**
     * Delete meeting
     */
    public function destroy(Meeting $meeting)
    {
        // if (
        //     $meeting->material ||
        //     $meeting->video ||
        //     $meeting->exam ||
        //     $meeting->attendances
        // ) {
        //     toast(
        //         'error',
        //         'Meeting tidak dapat dihapus karena masih memiliki absensi, materi, video, atau post test.'
        //     );
        //     return back();
        // }

        $meeting->delete();

        toast('warning', 'Meeting telah dihapus');

        return redirect()
            ->route('course.show', $meeting->course->slug);
    }

    /**
     * Join Zoom
     */
    public function joinZoom(Meeting $meeting)
    {
        if (empty($meeting->zoom_link)) {
            toast('warning', 'Belum ada link Zoom untuk pertemuan ini');
            return back();
        }

        return redirect()->away($meeting->zoom_link);
    }

    /**
     * ===============================
     * POST TEST and BLIND TEST (EXAM) CREATOR
     * ===============================
     */
    public function storeMeetingExam(Request $request, Meeting $meeting)
    {
        $data = $request->validate([
            'type' => 'required|in:post_test,blind_test',
            'test_type' => 'required|in:skd,mtk_stis,mtk_tka,tpa,tbi,general',
        ]);

        if ($meeting->exams()->where('type', $data['type'])->exists()) {
            toast('error', ucfirst(str_replace('_',' ', $data['type'])) . ' sudah ada');
            return back();
        }

        $exam = Exam::create([
            'type'       => $data['type'],
            'test_type'  => $data['test_type'],
            'status'     => 'inactive',
            'owner_type' => Meeting::class,
            'owner_id'   => $meeting->id,
            'created_by' => auth()->id(),
        ]);

        toast('success', 'Exam berhasil dibuat');
        return redirect()->route('exams.edit', $exam);
    }

}
