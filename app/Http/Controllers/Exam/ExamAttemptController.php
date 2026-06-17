<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use App\Services\ExamScoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamAttemptController extends Controller
{
    public function start(Exam $exam)
    {
        // ===============================
        // AUTHORIZATION (KHUSUS SISWA)
        // ===============================
        if (
            auth()->check() &&
            auth()->user()->hasRole('siswa') &&
            auth()->user()->cannot('view', $exam)
        ) {
            toast('error', 'Silakan lakukan pembelian terlebih dahulu');
            return back();
        }
        if (!$exam->isActive()) {
            abort(403, 'Ujian belum aktif');
        }

        if (!$exam->hasTimeWindow()) {
            abort(403, 'Ujian belum tersedia saat ini');
        }
        if (
            auth()->user()->hasRole('siswa') &&
            $exam->type === 'tryout' &&
            $exam->unmetPrerequisitesFor(auth()->user())->isNotEmpty()
        ) {
            abort(403, 'Anda harus menyelesaikan tryout sebelumnya terlebih dahulu');
        }

        $attempt = $exam->attempts()
            ->firstOrCreate(
                ['user_id' => auth()->id()],
                ['started_at' => now(),]
            );

        // kalau sudah submit → dilarang
        if ($attempt->is_submitted) {
            abort(403, 'Ujian sudah disubmit');
        }

        return redirect()
            ->route('exams.attempt', $exam);
    }

    protected function forceSubmit(ExamAttempt $attempt)
    {
        if ($attempt->is_submitted) return;

        $result = app(ExamScoringService::class)
            ->scoreAttempt($attempt);

        $attempt->update([
            'is_submitted'   => true,
            'submitted_at'   => now(),
            'score'          => $result['score'],
            'correct_count'  => $result['correct'],
            'wrong_count'    => $result['wrong'],
        ]);
    }

    public function attempt(Exam $exam)
    {
        if (
            auth()->check() &&
            auth()->user()->hasRole('siswa') &&
            auth()->user()->cannot('view', $exam)
        ) {
            toast('error', 'Silakan lakukan pembelian terlebih dahulu');
            return back();
        }

        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($attempt->isExpired()) {
            $this->forceSubmit($attempt);

            return redirect()
                ->route('exams.result.student', $exam)
                ->with('info', 'Waktu ujian telah habis');
        }

        // Load questions with proper relationships based on type
        $questions = $exam->questions()
            ->with([
                'question.options',
                'question.subItems' => function ($query) {
                    $query->orderBy('order');
                },
                'question.subItems.answers'
            ])
            ->orderBy('order')
            ->get();

        return view('exams.attempt', compact(
            'exam',
            'attempt',
            'questions'
        ));
    }

    public function submit(Exam $exam, ExamScoringService $scoring)
    {
        if (
            auth()->check() &&
            auth()->user()->hasRole('siswa') &&
            auth()->user()->cannot('view', $exam)
        ) {
            toast('error', 'Silakan lakukan pembelian terlebih dahulu');
            return back();
        }

        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', false)
            ->firstOrFail();

        if ($attempt->is_submitted) {
            return redirect()->route('exams.result.student', $exam);
        }

        if (!$exam->isActive()) {
            abort(403);
        }

        $result = $scoring->scoreAttempt($attempt);

        $attempt->update([
            'is_submitted'   => true,
            'submitted_at'   => now(),
            'score'          => $result['score'],
            'correct_count'  => $result['correct'],
            'wrong_count'    => $result['wrong'],
        ]);

        return redirect()
            ->route('exams.result.student', $exam);
    }

    public function saveAnswer(Request $request, Exam $exam)
    {
        if (
            auth()->check() &&
            auth()->user()->hasRole('siswa') &&
            auth()->user()->cannot('view', $exam)
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if (!$exam->isActive()) {
            abort(403);
        }

        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', false)
            ->firstOrFail();

        // waktu habis → autosubmit
        if ($attempt->isExpired()) {
            $this->forceSubmit($attempt);
            return response()->json(['expired' => true], 403);
        }

        // pastikan soal milik exam
        $examQuestion = $exam->questions()
            ->where('question_id', $request->question_id)
            ->with('question')
            ->first();

        abort_unless($examQuestion, 403);

        $question = $examQuestion->question;
        $selectedOptions = null;

        // Build selected_options based on question type
        switch ($question->type) {
            case 'mcq':
            case 'mcma':
            case 'truefalse':
                $selectedOptions = $this->handleMultipleChoiceAnswer($request, $question);
                break;

            case 'short_answer':
                $selectedOptions = $this->handleShortAnswer($request);
                break;

            case 'compound':
                $selectedOptions = $this->handleCompoundAnswer($request, $question);
                break;

            default:
                return response()->json(['error' => 'Invalid question type'], 400);
        }

        if ($selectedOptions === null) {
            return response()->json(['error' => 'Invalid answer format'], 400);
        }

        // simpan
        $attempt->answers()->updateOrCreate(
            ['question_id' => $request->question_id],
            ['selected_options' => $selectedOptions]
        );

        return response()->noContent();
    }

    /**
     * Handle multiple choice answers (MCQ, MCMA, TrueFalse)
     */
    private function handleMultipleChoiceAnswer(Request $request, $question): array
    {
        $request->validate([
            'selected_options' => 'required|array',
            'selected_options.*' => 'integer',
        ]);

        // Validasi option IDs
        $validOptionIds = $question->options->pluck('id')->toArray();
        $selectedIds = array_values(array_intersect(
            $request->selected_options,
            $validOptionIds
        ));

        return ExamAnswer::formatMcqAnswer($question->type, $selectedIds);
    }

    /**
     * Handle short answer
     */
    private function handleShortAnswer(Request $request): array
    {
        $request->validate([
            'short_answer_value' => 'required|string|max:1000',
        ]);

        return ExamAnswer::formatShortAnswer($request->short_answer_value);
    }

    /**
     * Handle compound answer
     */
    private function handleCompoundAnswer(Request $request, $question): array
    {
        $request->validate([
            'compound_answers' => 'required|array',
            'compound_answers.*.sub_id' => 'required|integer',
            'compound_answers.*.type' => 'required|in:truefalse,short_answer',
        ]);

        $answers = [];

        foreach ($request->compound_answers as $subAnswer) {
            $subId = $subAnswer['sub_id'];
            $subType = $subAnswer['type'];

            // Find sub item
            $subItem = $question->subItems->firstWhere('id', $subId);
            if (!$subItem) {
                continue; // Skip invalid sub items
            }

            $answerData = [
                'sub_id' => $subId,
                'type' => $subType,
            ];

            if ($subType === 'truefalse') {
                if (!isset($subAnswer['boolean'])) {
                    continue;
                }
                $answerData['boolean'] = (bool) $subAnswer['boolean'];
            }
            elseif ($subType === 'short_answer') {
                if (!isset($subAnswer['value']) || empty($subAnswer['value'])) {
                    continue;
                }
                $answerData['value'] = $subAnswer['value'];
                $answerData['normalized'] = Str::lower(trim(preg_replace('/\s+/', ' ', $subAnswer['value'])));
            }

            $answers[] = $answerData;
        }

        return ExamAnswer::formatCompoundAnswer($answers);
    }
}
