<?php

namespace App\Listeners;

use App\Events\QuestionKeyChanged;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use App\Models\Question; // 🔥 PASTIKAN USE INI ADA
use App\Services\ExamScoringService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RecalculateExamScores
{
    protected $scoringService;

    public function __construct(ExamScoringService $scoringService)
    {
        $this->scoringService = $scoringService;
    }

    public function handle(QuestionKeyChanged $event)
    {
        $question = $event->question;
        
        // 🔥 LOAD RELASI YANG DIBUTUHKAN
        $question->load(['options', 'subItems.answers']);
        
        // Ambil semua exam yang menggunakan soal ini
        $examIds = DB::table('exam_questions')
            ->where('question_id', $question->id)
            ->pluck('exam_id');

        if ($examIds->isEmpty()) {
            Log::info("Question ID {$question->id} not used in any exam, no recalculation needed");
            return;
        }

        Log::info("Recalculating scores for question ID: {$question->id}, affected exams: " . $examIds->implode(','));

        // Proses per exam
        foreach ($examIds as $examId) {
            $this->recalculateExamScores($examId, $question);
        }
    }

    protected function recalculateExamScores($examId, $question)
    {
        try {
            DB::transaction(function () use ($examId, $question) {
                // 🔥 1. Ambil semua attempt untuk exam ini dengan relasi yang diperlukan
                $attempts = ExamAttempt::with([
                    'exam' => function($q) {
                        $q->with(['questions.question.options', 'questions.question.subItems.answers']);
                    },
                    'answers'
                ])
                ->where('exam_id', $examId)
                ->where('is_submitted', true)
                ->get();

                Log::info("Processing {$attempts->count()} attempts for exam {$examId}");

                foreach ($attempts as $attempt) {
                    // 🔥 2. Recalculate jawaban untuk soal ini saja
                    $answer = ExamAnswer::where('attempt_id', $attempt->id)
                        ->where('question_id', $question->id)
                        ->first();

                    if ($answer && !$answer->isEmpty) {
                        // Hitung ulang is_correct berdasarkan kunci baru
                        $this->recalculateAnswer($answer, $question);
                        Log::info("Recalculated answer ID {$answer->id} for attempt {$attempt->id}");
                    }

                    // 🔥 3. Hitung ulang total score attempt
                    $this->recalculateAttemptScore($attempt);
                }
            });
        } catch (\Exception $e) {
            Log::error("Failed to recalculate scores for exam {$examId}: " . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }

    /**
     * 🔥 PERBAIKAN: Parameter type hint menggunakan App\Models\Question
     */
    protected function recalculateAnswer(ExamAnswer $answer, Question $question)
    {
        $answerType = $answer->answer_type;
        $isCorrect = false;

        switch ($answerType) {
            case 'mcq':
            case 'truefalse':
                $isCorrect = $this->checkMcqSingle($question, $answer);
                break;

            case 'mcma':
                $isCorrect = $this->checkMcmaExact($question, $answer);
                break;

            case 'short_answer':
                $isCorrect = $this->checkShortAnswer($question, $answer);
                break;

            case 'compound':
                $isCorrect = $this->checkCompound($question, $answer);
                break;

            default:
                $isCorrect = false;
        }

        $answer->update(['is_correct' => $isCorrect]);
    }

    /**
     * 🔥 PERBAIKAN: Recalculate attempt score dengan benar
     */
    protected function recalculateAttemptScore(ExamAttempt $attempt)
    {
        // 🔥 Load relasi yang diperlukan
        $attempt->load([
            'exam.questions.question.options',
            'exam.questions.question.subItems.answers',
            'answers'
        ]);

        $exam = $attempt->exam;
        $answers = $attempt->answers;
        
        // Hitung correct dan wrong berdasarkan tipe exam
        $correctCount = 0;
        $wrongCount = 0;

        foreach ($exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer = $answers->firstWhere('question_id', $question->id);
            
            // 🔥 PERBAIKAN: Logika TKP
            if ($question->test_type === 'tkp') {
                if (!$answer || $answer->isEmpty) {
                    $wrongCount++;
                    continue;
                }
                
                $selectedWeight = $this->getTkpScore($question, $answer);
                $maxWeight = $question->options->max('weight') ?? 0;
                
                if ($selectedWeight === $maxWeight && $maxWeight > 0) {
                    $correctCount++;
                } else {
                    $wrongCount++;
                }
                continue;
            }
            
            // 🔥 PERBAIKAN: Untuk non-TKP, gunakan is_correct
            if (!$answer || $answer->isEmpty) {
                $wrongCount++;
                continue;
            }
            
            // Pastikan is_correct sudah diupdate sebelumnya
            if ($answer->is_correct) {
                $correctCount++;
            } else {
                $wrongCount++;
            }
        }

        // 🔥 PERBAIKAN: Gunakan scoring service dengan data yang sudah dimuat
        $result = $this->scoringService->scoreAttempt($attempt);
        
        $score = $result['score'] ?? 0;
        
        $attempt->update([
            'correct_count' => $correctCount,
            'wrong_count' => $wrongCount,
            'score' => $score,
        ]);

        // 🔥 PERBAIKAN: Pindahkan ?? ke luar string
        $scoreValue = $result['score'] ?? 0;
        Log::info("Updated attempt {$attempt->id}: correct={$correctCount}, wrong={$wrongCount}, score={$scoreValue}");

        // Update is_passed jika ada
        if ($exam->type === 'tryout') {
            $isPassed = $this->checkPassingStatus($attempt);
            $attempt->update(['is_passed' => $isPassed]);
        }
    }

    /**
     * 🔥 PERBAIKAN: Check passing status dengan benar
     */
    protected function checkPassingStatus(ExamAttempt $attempt)
    {
        $exam = $attempt->exam;
        $rules = $exam->passing_rules ?? [];

        if (empty($rules)) {
            return null;
        }

        // 🔥 Untuk SKD
        if ($exam->test_type === 'skd') {
            $scoreTiu = 0;
            $scoreTwk = 0;
            $scoreTkp = 0;

            foreach ($attempt->answers as $answer) {
                $question = $answer->question;
                if (!$question) continue;

                $subtest = $question->test_type;
                
                if ($subtest === 'tkp') {
                    $scoreTkp += $this->getTkpScore($question, $answer);
                } elseif (in_array($subtest, ['tiu', 'twk']) && $answer->is_correct) {
                    if ($subtest === 'tiu') {
                        $scoreTiu += 5;
                    } else {
                        $scoreTwk += 5;
                    }
                }
            }

            return ($scoreTiu >= ($rules['tiu'] ?? PHP_INT_MAX)) &&
                   ($scoreTwk >= ($rules['twk'] ?? PHP_INT_MAX)) &&
                   ($scoreTkp >= ($rules['tkp'] ?? PHP_INT_MAX));
        }

        // 🔥 Untuk MTK STIS
        if ($exam->test_type === 'mtk_stis') {
            return $attempt->score >= ($rules['score'] ?? 65);
        }

        return null;
    }

    /**
     * 🔥 Helper: Get TKP score
     */
    protected function getTkpScore(Question $question, ExamAnswer $answer): int
    {
        return (int) $question->options
            ->whereIn('id', $answer->selected_ids ?? [])
            ->sum('weight');
    }

    // 🔥 PERBAIKAN: Helper methods dengan loading relasi yang benar

    protected function checkMcqSingle(Question $question, ExamAnswer $answer): bool
    {
        $selected = $answer->selected_ids;
        if (count($selected) !== 1) return false;

        // 🔥 Gunakan options yang sudah dimuat
        $correctId = $question->options
            ->where('is_correct', true)
            ->first()?->id;

        return (int) $selected[0] === (int) $correctId;
    }

    protected function checkMcmaExact(Question $question, ExamAnswer $answer): bool
    {
        $selected = collect($answer->selected_ids)->sort()->values()->toArray();

        $correct = $question->options
            ->where('is_correct', true)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values()
            ->toArray();

        return $selected === $correct;
    }

    protected function checkShortAnswer(Question $question, ExamAnswer $answer): bool
    {
        $normalized = $answer->normalized_short_answer;
        if (!$normalized) return false;

        return $question->options
            ->pluck('option_text')
            ->map(fn ($v) => Str::lower(trim($v)))
            ->contains($normalized);
    }

    protected function checkCompound(Question $question, ExamAnswer $answer): bool
    {
        foreach ($question->subItems as $sub) {
            $student = $answer->getCompoundAnswerBySubId($sub->id);
            if (!$student) return false;

            if ($sub->type === 'truefalse') {
                if ((bool) $student['boolean'] !== (bool) $sub->answers->first()?->boolean_answer) {
                    return false;
                }
            }

            if ($sub->type === 'short_answer') {
                $normalized = $student['normalized'] ?? null;
                if (!$normalized) return false;

                $valid = $sub->answers
                    ->pluck('answer_text')
                    ->map(fn ($v) => Str::lower(trim($v)))
                    ->contains($normalized);

                if (!$valid) return false;
            }
        }

        return true;
    }
}