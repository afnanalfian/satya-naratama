<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionSubAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_item_id',
        'type',
        'boolean_answer',
        'answer_text',
        'normalized_text',
        'is_primary',
    ];

    protected $casts = [
        'boolean_answer' => 'boolean',
        'is_primary'     => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function ($model) {
            if ($model->type === 'short_answer' && !empty($model->answer_text)) {
                $model->normalized_text = self::normalizeAnswer($model->answer_text);
            }
        });
    }

    public static function normalizeAnswer(?string $value): ?string
    {
        if (empty($value)) return null;
        // Lowercase, trim, hapus spasi berlebih, hapus karakter khusus
        $normalized = mb_strtolower(trim($value), 'UTF-8');
        $normalized = preg_replace('/\s+/', ' ', $normalized);
        $normalized = preg_replace('/[^\p{L}\p{N}\s]/u', '', $normalized); // hapus tanda baca
        return $normalized;
    }

    public function subItem()
    {
        return $this->belongsTo(QuestionSubItem::class, 'sub_item_id');
    }

    public function getNormalizedAnswerAttribute(): ?string
    {
        return $this->type === 'short_answer'
            ? $this->normalized_text
            : null;
    }
}
