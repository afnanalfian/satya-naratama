<?php

namespace App\Services;

use App\Models\ExamAttempt;
use App\Models\Question;
use Illuminate\Support\Str;

class ExamScoringService
{
    /**
     * ======================================================
     * ENTRY POINT
     * ======================================================
     */
    public function scoreAttempt(ExamAttempt $attempt): array
    {
        $attempt->load([
            'exam',
            'exam.questions.question.options',
            'exam.questions.question.subItems.answers',
            'answers',
        ]);

        $exam = $attempt->exam;

        return match ($exam->test_type) {
            'skd'       => $this->scoreSKD($attempt),
            'mtk_stis'  => $this->scoreMtkStis($attempt),
            'tpa', 'tbi'=> $this->scoreTpaTbi($attempt),
            'mtk_tka'   => $this->scoreScaled($attempt, false),
            'general'   => $this->scoreScaled($attempt, true),
            default     => throw new \LogicException('Unknown exam test_type'),
        };
    }

    /**
     * ======================================================
     * 1. SKD (TIU / TWK / TKP)
     * ======================================================
     */
    protected function scoreSKD(ExamAttempt $attempt): array
    {
        $subs = [
            'tiu' => ['score' => 0, 'correct' => 0, 'wrong' => 0],
            'twk' => ['score' => 0, 'correct' => 0, 'wrong' => 0],
            'tkp' => ['score' => 0, 'correct' => 0, 'wrong' => 0],
        ];

        foreach ($attempt->exam->questions as $examQuestion) {
            $q = $examQuestion->question;
            $a = $attempt->answers->firstWhere('question_id', $q->id);
            $type = $q->test_type;

            if (!isset($subs[$type])) {
                continue;
            }

            // ==========================
            // TKP (tidak ada kosong)
            // ==========================
            if ($type === 'tkp') {
                if (!$a || $a->isEmpty) {
                    $subs['tkp']['wrong']++;
                    continue;
                }

                $selectedWeight = $this->getTkpScore($q, $a);
                $maxWeight = $q->options->max('weight');

                $subs['tkp']['score'] += $selectedWeight;

                if ($selectedWeight === $maxWeight) {
                    $subs['tkp']['correct']++;
                } else {
                    $subs['tkp']['wrong']++;
                }

                $a->update(['is_correct' => null]);
                continue;
            }

            // ==========================
            // TIU / TWK
            // ==========================
            if (!$a || $a->isEmpty) {
                $subs[$type]['wrong']++;
                continue;
            }

            $isCorrect = $this->checkMcqSingle($q, $a);

            if ($isCorrect) {
                $subs[$type]['score'] += 5;
                $subs[$type]['correct']++;
            } else {
                $subs[$type]['wrong']++;
            }

            $a->update(['is_correct' => $isCorrect]);
        }

        $totalScore =
            $subs['tiu']['score'] +
            $subs['twk']['score'] +
            $subs['tkp']['score'];

        $isPassed = null;
        if ($attempt->exam->type === 'tryout') {
            $rules = $attempt->exam->passing_rules ?? [];
            $isPassed =
                ($subs['tiu']['score'] >= ($rules['tiu'] ?? PHP_INT_MAX)) &&
                ($subs['twk']['score'] >= ($rules['twk'] ?? PHP_INT_MAX)) &&
                ($subs['tkp']['score'] >= ($rules['tkp'] ?? PHP_INT_MAX));
        }

        $attempt->update(['is_passed' => $isPassed]);

        return [
            'score'   => $totalScore,
            'correct' => $subs['tiu']['correct'] + $subs['twk']['correct'] + $subs['tkp']['correct'],
            'wrong'   => $subs['tiu']['wrong'] + $subs['twk']['wrong'] + $subs['tkp']['wrong'],
            'detail'  => $subs,
            'passed'  => $isPassed,
        ];
    }

    /**
     * ======================================================
     * 2. MTK STIS
     * benar +5 | salah -1 | kosong 0
     * ======================================================
     */
    protected function scoreMtkStis(ExamAttempt $attempt): array
    {
        $score = 0;
        $correct = 0;
        $wrong = 0;

        foreach ($attempt->exam->questions as $examQuestion) {
            $q = $examQuestion->question;
            $a = $attempt->answers->firstWhere('question_id', $q->id);

            if (!$a || $a->isEmpty) {
                continue;
            }

            $isCorrect = $this->checkMcqSingle($q, $a);

            if ($isCorrect) {
                $score += 5;
                $correct++;
            } else {
                $score -= 1;
                $wrong++;
            }

            $a->update(['is_correct' => $isCorrect]);
        }

        $isPassed = null;
        if ($attempt->exam->type === 'tryout') {
            $isPassed = $score >= ($attempt->exam->passing_rules['score'] ?? 65);
        }

        $attempt->update(['is_passed' => $isPassed]);

        return [
            'score'   => max(0, $score),
            'correct' => $correct,
            'wrong'   => $wrong,
            'passed'  => $isPassed,
        ];
    }

    /**
     * ======================================================
     * 3. TPA & TBI
     * Skala 0 – 1000
     * Benar + (1000 / total soal)
     * Salah / Kosong = 0 (kosong dihitung salah)
     * ======================================================
     */
    protected function scoreTpaTbi(ExamAttempt $attempt): array
    {
        $totalQuestions = $attempt->exam->questions->count();
        $pointPerCorrect = $totalQuestions > 0
            ? 1000 / $totalQuestions
            : 0;

        $score = 0;
        $correct = 0;
        $wrong = 0;

        foreach ($attempt->exam->questions as $examQuestion) {
            $q = $examQuestion->question;
            $a = $attempt->answers->firstWhere('question_id', $q->id);

            // ==========================
            // Kosong → salah
            // ==========================
            if (!$a || $a->isEmpty) {
                $wrong++;
                continue;
            }

            // ==========================
            // Jawaban ada
            // ==========================
            if ($this->checkMcqSingle($q, $a)) {
                $score += $pointPerCorrect;
                $correct++;
                $a->update(['is_correct' => true]);
            } else {
                $wrong++;
                $a->update(['is_correct' => false]);
            }
        }

        return [
            'score'   => (int) round($score),
            'correct' => $correct,
            'wrong'   => $wrong,
        ];
    }

    /**
     * ======================================================
     * 4. MTK TKA & GENERAL (0–100)
     * ======================================================
     */
    protected function scoreScaled(ExamAttempt $attempt, bool $allowShortAnswer): array
    {
        $correct = 0;
        $wrong = 0;
        $total = $attempt->exam->questions->count();

        foreach ($attempt->exam->questions as $examQuestion) {
            $q = $examQuestion->question;
            $a = $attempt->answers->firstWhere('question_id', $q->id);

            if (!$a || $a->isEmpty) {
                $wrong++;
                continue;
            }

            $isCorrect = match ($q->type) {
                'mcq', 'truefalse' => $this->checkMcqSingle($q, $a),
                'mcma'             => $this->checkMcmaExact($q, $a),
                'compound'         => $this->checkCompound($q, $a),
                'short_answer'     => $allowShortAnswer
                    ? $this->checkShortAnswer($q, $a)
                    : false,
                default            => false,
            };

            $isCorrect ? $correct++ : $wrong++;
            $a->update(['is_correct' => $isCorrect]);
        }

        $score = round(($correct / max(1, $total)) * 100);

        return [
            'score'   => $score,
            'correct' => $correct,
            'wrong'   => $wrong,
        ];
    }

    /**
     * ======================================================
     * HELPERS
     * ======================================================
     */
    protected function checkMcqSingle(Question $question, $answer): bool
    {
        $selected = $answer->selected_ids;
        if (count($selected) !== 1) return false;

        $correctId = $question->options
            ->where('is_correct', true)
            ->first()?->id;

        return (int) $selected[0] === (int) $correctId;
    }

    protected function checkMcmaExact(Question $question, $answer): bool
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

    protected function checkCompound(Question $question, $answer): bool
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

    protected function checkShortAnswer(Question $question, $answer): bool
    {
        $normalized = $answer->normalized_short_answer;
        if (!$normalized) return false;

        return $question->options
            ->pluck('option_text')
            ->map(fn ($v) => Str::lower(trim($v)))
            ->contains($normalized);
    }

    protected function getTkpScore(Question $question, $answer): int
    {
        return (int) $question->options
            ->whereIn('id', $answer->selected_ids ?? [])
            ->sum('weight');
    }
}
