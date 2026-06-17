<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamAnswer extends Model
{
    protected $fillable = [
        'attempt_id',
        'question_id',
        'selected_options',
        'is_correct',
    ];

    protected $casts = [
        'selected_options' => 'array',
        'is_correct' => 'boolean',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(ExamAttempt::class, 'attempt_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /* ================= HELPERS - NEW STRUCTURE ================= */

    /**
     * Get answer type from selected_options
     */
    public function getAnswerTypeAttribute(): ?string
    {
        return $this->selected_options['type'] ?? 'unknown';
    }

    /**
     * For MCQ/MCMA/TrueFalse: get selected option IDs
     */
    public function getSelectedIdsAttribute(): array
    {
        if (!in_array($this->answer_type, ['mcq', 'mcma', 'truefalse'])) {
            return [];
        }

        return is_array($this->selected_options['mcq_answers'] ?? null)
            ? $this->selected_options['mcq_answers']
            : [];
    }

    /**
     * For short_answer: get raw answer value
     */
    public function getShortAnswerValueAttribute(): ?string
    {
        if ($this->answer_type !== 'short_answer') {
            return null;
        }

        return $this->selected_options['value'] ?? null;
    }

    /**
     * For short_answer: get normalized value (lowercase, no spaces)
     */
    public function getNormalizedShortAnswerAttribute(): ?string
    {
        if ($this->answer_type !== 'short_answer') {
            return null;
        }

        // Use pre-normalized value if stored
        if (isset($this->selected_options['normalized'])) {
            return $this->selected_options['normalized'];
        }

        // Normalize on the fly
        return $this->normalizeShortAnswer($this->short_answer_value);
    }

    /**
     * For compound: get array of sub-item answers
     */
    public function getCompoundAnswersAttribute(): array
    {
        if ($this->answer_type !== 'compound') {
            return [];
        }

        return $this->selected_options['answers'] ?? [];
    }

    /**
     * Get answer for specific sub-item in compound
     */
    public function getCompoundAnswerBySubId($subId): ?array
    {
        if (!is_array($this->compound_answers)) {
            return null;
        }
        foreach ($this->compound_answers as $answer) {
            if (($answer['sub_id'] ?? null) == $subId) {
                return $answer;
            }
        }

        return null;
    }

    /**
     * Helper to create selected_options for MCQ/MCMA/TrueFalse
     */
    public static function formatMcqAnswer(string $type, array $selectedIds): array
    {
        return [
            'type' => $type,
            'mcq_answers' => $selectedIds,
        ];
    }

    /**
     * Helper to create selected_options for short_answer
     */
    public static function formatShortAnswer(string $value): array
    {
        return [
            'type' => 'short_answer',
            'value' => $value,
            'normalized' => self::normalizeShortAnswer($value),
        ];
    }

    /**
     * Helper to create selected_options for compound
     */
    public static function formatCompoundAnswer(array $answers): array
    {
        return [
            'type' => 'compound',
            'answers' => $answers,
        ];
    }

    /**
     * Normalize short answer: lowercase, trim, remove extra spaces
     */
    private static function normalizeShortAnswer(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return strtolower(trim(preg_replace('/\s+/', ' ', $value)));
    }

    /**
     * Check if answer is empty/not answered
     */
    public function getIsEmptyAttribute(): bool
    {
        return match ($this->answer_type) {
            'mcq', 'mcma', 'truefalse' => empty($this->selected_ids),
            'short_answer' => empty($this->short_answer_value),
            'compound' => empty($this->compound_answers),
            default => true
        };
    }
    public function checkCompoundCorrectness(): bool
    {
        if ($this->answer_type !== 'compound') {
            return false;
        }

        $question = $this->question;
        if (!$question || !$question->isCompound()) {
            return false;
        }

        // Format user answers untuk pengecekan
        $userAnswers = [];
        foreach ($this->compound_answers as $answer) {
            $userAnswers[$answer['sub_id']] = $answer['value'] ?? null;
        }

        $result = $question->checkCompoundAnswer($userAnswers);
        return $result['correct'];
    }

    /**
     * Check short answer correctness
     */
    public function checkShortAnswerCorrectness(): bool
    {
        if ($this->answer_type !== 'short_answer') {
            return false;
        }

        $question = $this->question;
        if (!$question || !$question->isShortAnswer()) {
            return false;
        }

        $result = $question->checkShortAnswer($this->short_answer_value ?? '');
        return $result['correct'];
    }

    /**
     * Auto-calculate correctness based on question type
     */
    public function calculateCorrectness(): void
    {
        if ($this->isEmpty) {
            $this->is_correct = false;
            return;
        }

        switch ($this->answer_type) {
            case 'mcq':
            case 'mcma':
            case 'truefalse':
                // Logic untuk pilihan ganda (sudah ada)
                break;
            case 'short_answer':
                $this->is_correct = $this->checkShortAnswerCorrectness();
                break;
            case 'compound':
                $this->is_correct = $this->checkCompoundCorrectness();
                break;
            default:
                $this->is_correct = false;
        }

        $this->save();
    }
}
