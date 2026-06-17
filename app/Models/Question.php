<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'material_id',
        'type',
        'test_type',
        'question_text',
        'image',
        'explanation',
    ];
    public const TYPES = [
        'mcq'          => 'Pilihan Ganda',
        'mcma'         => 'Pilihan Ganda (Multi Jawaban)',
        'truefalse'    => 'Benar / Salah',
        'short_answer' => 'Isian Singkat',
        'compound'     => 'Soal Kompleks',
    ];

    public static function getAvailableTypes(): array
    {
        return self::TYPES;
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? strtoupper($this->type);
    }
    public function material()
    {
        return $this->belongsTo(QuestionMaterial::class, 'material_id');
    }
    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class, 'question_id');
    }
    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id')->orderBy('order');
    }
    public function subItems()
    {
        return $this->hasMany(QuestionSubItem::class)
            ->orderBy('order');
    }
    /* ================= HELPERS ================= */
    public function usedInExamsCount(): int
    {
        return $this->examQuestions()->count();
    }
    public function isCompound(): bool
    {
        return $this->type === 'compound';
    }

    public function isShortAnswer(): bool
    {
        return $this->type === 'short_answer';
    }
    public function isMCQ(): bool
    {
        return $this->type === 'mcq';
    }

    public function isMCMA(): bool
    {
        return $this->type === 'mcma';
    }
    public function isTrueFalse(): bool
    {
        return $this->type === 'truefalse';
    }
    // Helper boolean
    public function isTBI(): bool
    {
        return $this->test_type === 'tbi';
    }
    public function isTPA(): bool
    {
        return $this->test_type === 'tpa';
    }
    public function isGeneral(): bool
    {
        return $this->test_type === 'general';
    }
    public function isTIU(): bool
    {
        return $this->test_type === 'tiu';
    }

    public function isTWK(): bool
    {
        return $this->test_type === 'twk';
    }

    public function isTKP(): bool
    {
        return $this->test_type === 'tkp';
    }

    public function isMtkStis(): bool
    {
        return $this->test_type === 'mtk_stis';
    }

    public function isMtkTka(): bool
    {
        return $this->test_type === 'mtk_tka';
    }

    public function checkCompoundAnswer(array $userAnswers): array
    {
        $results = [
            'correct' => true,
            'details' => [],
            'score' => 0
        ];

        foreach ($this->subItems as $subItem) {
            $userAnswer = $userAnswers[$subItem->id] ?? null;
            $isCorrect = $subItem->checkAnswer($userAnswer);

            $results['details'][] = [
                'sub_item_id' => $subItem->id,
                'label' => $subItem->label,
                'type' => $subItem->type,
                'user_answer' => $userAnswer,
                'correct' => $isCorrect,
                'primary_answer' => $subItem->primary_answer_text,
                'all_possible_answers' => $subItem->all_possible_answers
            ];

            if (!$isCorrect) {
                $results['correct'] = false;
            }
        }

        // Hitung skor: jika semua benar = 1, jika ada yang salah = 0
        $results['score'] = $results['correct'] ? 1 : 0;

        return $results;
    }

    public function checkShortAnswer(string $userAnswer): array
    {
        // Untuk soal isian singkat non-compound
        $correctValues = $this->options()
            ->where('is_correct', true)
            ->get()
            ->map(function ($option) {
                return QuestionSubAnswer::normalizeAnswer($option->option_text);
            })
            ->filter()
            ->values()
            ->toArray();

        $userNormalized = QuestionSubAnswer::normalizeAnswer($userAnswer);
        $isCorrect = in_array($userNormalized, $correctValues);

        return [
            'correct' => $isCorrect,
            'user_answer' => $userAnswer,
            'normalized' => $userNormalized,
            'possible_answers' => $correctValues,
            'primary_answer' => $this->options()->where('is_correct', true)->first()?->option_text
        ];
    }
}
