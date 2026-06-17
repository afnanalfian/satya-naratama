<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Meeting;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use App\Models\User;

class ExamController extends Controller
{
    /* ================= LIST ================= */

    public function index()
    {
        $exams = Exam::latest()->paginate(15);
        return view('exams.index', compact('exams'));
    }
    public function show(Exam $exam)
    {
        $exam->load([
            'questions',
            'attempts',
            'prerequisites',
        ]);

        $user    = auth()->user();
        $attempt = null;

        $blockedByPrerequisite = false;
        $unmetPrerequisites    = collect();

        if ($user && $user->hasRole('siswa')) {

            $attempt = $exam->attempts()
                ->where('user_id', $user->id)
                ->latest()
                ->first();

            if ($exam->type === 'tryout' && $exam->prerequisites->isNotEmpty()) {
                $unmetPrerequisites = $exam->unmetPrerequisitesFor($user);
                $blockedByPrerequisite = $unmetPrerequisites->isNotEmpty();
            }
        }
        $allTryouts = collect();

        if ($user && $user->hasRole(['admin','tentor'])) {
            $allTryouts = Exam::where('type', 'tryout')
                ->where('id', '!=', $exam->id)
                ->orderBy('title')
                ->get();
        }
        return view('exams.show', compact(
            'exam',
            'attempt',
            'blockedByPrerequisite',
            'unmetPrerequisites',
            'allTryouts'
        ));
    }

    public function indexTryout(Request $request)
    {
        $exams = Exam::where('type', 'tryout')
            ->when($request->q, fn ($q) =>
                $q->where('title', 'like', "%{$request->q}%")
            )
            ->when($request->date, fn ($q) =>
                $q->whereDate('exam_date', $request->date)
            )
            ->latest('exam_date')
            ->paginate(10);

        return view('exams.tryout.index', compact('exams'));
    }
    public function indexQuiz(Request $request)
    {
        $exams = Exam::where('type', 'quiz')
            ->when($request->q, fn ($q) =>
                $q->where('title', 'like', "%{$request->q}%")
            )
            ->when($request->date, fn ($q) =>
                $q->whereDate('exam_date', $request->date)
            )
            ->latest('exam_date')
            ->paginate(10);

        return view('exams.quiz.index', compact('exams'));
    }

    /* ================= CREATE ================= */

    public function create(Request $request)
    {
        // untuk tryout / daily quiz
        $type = $request->get('type', 'tryout');
        $testTypes = [
            'skd' => 'SKD',
            'tpa' => 'TPA',
            'tbi' => 'TBI',
            'mtk_stis' => 'Matematika STIS',
            'mtk_tka' => 'Matematika TKA',
            'general' => 'General',
        ];
        return view('exams.create', compact('type','testTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:quiz,tryout',
            'test_type' => 'required|in:skd,tpa,tbi,mtk_stis,mtk_tka,general',
            'title' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        $exam = Exam::create([
            'type' => $data['type'],
            'title' => $data['title'],
            'test_type' => $data['test_type'],
            'exam_date' => $data['exam_date'],
            'status' => 'inactive',
            'created_by' => auth()->id(),
        ]);

        toast('success', ucfirst($data['type']) . ' berhasil dibuat');

        return redirect()->route('exams.edit', $exam);
    }

    /* ================= EDIT ================= */
    public function edit(Exam $exam, Request $request)
    {
        $perPage = in_array(
            (int) $request->get('per_page'),
            [10, 20, 30, 50, 100]
        )
            ? (int) $request->get('per_page')
            : 10;

        $questions = $exam->questions()
            ->with([
                'question.options',
                'question.subItems.answers'
            ])
            ->orderBy('order', 'asc')
            ->paginate($perPage)
            ->withQueryString(); // 🔑 penting

        $usedQuestionIds = $exam->questions()
            ->pluck('question_id')
            ->toArray();

        $allowedQuestionTypes = $exam->allowedQuestionTypes();

        $categories = QuestionCategory::with([
                'materials' => fn ($q) => $q->orderBy('name')
            ])
            ->orderBy('name')
            ->get();

        return view('exams.edit', compact(
            'exam',
            'questions',
            'categories',
            'usedQuestionIds',
            'allowedQuestionTypes'
        ));
    }

    public function update(Request $request, Exam $exam)
    {
        if ($exam->status !== 'inactive') {
            abort(403, 'Exam sedang berjalan');
        }

        $exam->update($request->only([
            'title',
            'duration_minutes',
            'exam_date',
        ]));

        toast('success', 'Exam diperbarui');
        return back();
    }
    public function updatePrerequisites(Request $request, Exam $exam)
    {
        abort_unless(auth()->user()->hasRole(['admin','tentor']), 403);

        $data = $request->validate([
            'required_exam_ids'   => 'nullable|array',
            'required_exam_ids.*' => 'exists:exams,id',
        ]);

        // hanya untuk tryout
        abort_if($exam->type !== 'tryout', 403);

        // tidak boleh depend ke dirinya sendiri
        $ids = collect($data['required_exam_ids'] ?? [])
            ->reject(fn ($id) => $id == $exam->id)
            ->values()
            ->toArray();

        $exam->prerequisites()->sync($ids);

        return back()->with('success', 'Prerequisite tryout berhasil diperbarui');
    }

    /* ================= STATUS ================= */

    public function activate(Exam $exam)
    {
        $exam->update(['status' => 'active']);
        /** TARGET USERS */
        $users = collect();

        if (in_array($exam->type, ['tryout', 'quiz'])) {
            $users = User::whereHas('entitlements', function ($q) use ($exam) {
                $q->where('entitlement_type', $exam->type);
            })->get();
        }

        if ($exam->type === 'post_test' && $exam->owner_type === Meeting::class) {
            $meeting = Meeting::find($exam->owner_id);
            $users = User::usersWithMeetingAccess($meeting);
        }

        foreach ($users as $user) {
            notify_user(
                $user,
                "Ujian '{$exam->title}' telah dibuka. Silakan dikerjakan.",
                false,
                route('exams.show', $exam)
            );
        }
        return back()->with('success', 'Ujian diaktifkan');
    }

    public function close(Exam $exam)
    {
        $exam->update(['status' => 'closed']);

        return back()->with('success', 'Ujian ditutup');
    }
    public function destroy(Exam $exam)
    {
        // Tidak boleh hapus kalau sedang aktif
        if ($exam->status === 'active') {
            toast('error', 'Exam sedang berlangsung dan tidak dapat dihapus');
            return back();
        }

        // Tidak boleh hapus kalau sudah ada attempt
        if ($exam->attempts()->exists()) {
            toast('error', 'Ujian sudah dikerjakan, tidak dapat dihapus');
            return back();
        }

        // Simpan owner sebelum delete
        $owner = $exam->owner;

        // Soft delete
        $exam->delete();

        toast('success', 'Ujian berhasil dihapus');

        // Redirect berdasarkan owner
        if ($owner instanceof Meeting) {
            return redirect()->route('meeting.show', $owner);
        }

        return redirect()->route(
            match ($exam->type) {
                'quiz'   => 'quizzes.index',
                'tryout' => 'tryouts.index',
                default  => 'exams.index',
            }
        );
    }

}
