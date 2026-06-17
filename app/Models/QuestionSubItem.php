<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionSubItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'label',
        'type',
        'prompt',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionSubAnswer::class, 'sub_item_id');
    }

    public function primaryAnswer()
    {
        return $this->hasOne(QuestionSubAnswer::class, 'sub_item_id')
            ->where('is_primary', true);
    }

    public function correctValue()
    {
        if ($this->type === 'truefalse') {
            return optional(
                $this->answers->first()
            )->boolean_answer;
        }

        // short_answer - kembalikan semua kemungkinan jawaban yang sudah dinormalisasi
        return $this->answers
            ->pluck('normalized_text')
            ->filter()
            ->values()
            ->toArray();
    }

    public function checkAnswer($userAnswer): bool
    {
        if ($this->type === 'truefalse') {
            $correct = $this->answers->first()->boolean_answer ?? null;
            return $userAnswer === $correct;
        }

        if ($this->type === 'short_answer') {
            if ($userAnswer === null) return false;

            $userNormalized = QuestionSubAnswer::normalizeAnswer($userAnswer);
            $correctValues = $this->answers
                ->pluck('normalized_text')
                ->filter()
                ->values()
                ->toArray();

            return in_array($userNormalized, $correctValues);
        }

        return false;
    }

    public function getPrimaryAnswerTextAttribute(): ?string
    {
        return $this->primaryAnswer?->answer_text;
    }

    public function getAllPossibleAnswersAttribute(): array
    {
        if ($this->type === 'truefalse') {
            return [];
        }

        return $this->answers
            ->pluck('answer_text')
            ->filter()
            ->values()
            ->toArray();
    }
}
