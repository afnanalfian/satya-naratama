<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Exam extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'exam_code',
        'type',
        'title',
        'test_type',
        'exam_date',
        'duration_minutes',
        'status',
        'passing_rules',
        'owner_type',
        'owner_id',
        'created_by',
    ];
    public function getRouteKeyName()
    {
        return 'exam_code';
    }
    protected $casts = [
        'exam_date' => 'datetime',
        'test_type' => 'string',
        'passing_rules' => 'array',
    ];
    public const QUESTION_TYPE_RULES = [
        'skd' => ['tiu', 'twk', 'tkp'],
        'mtk_stis' => ['mtk_stis'],
        'tpa' => ['tpa', 'tiu'],
        'tbi' => ['tbi'],
        'mtk_tka' => ['mtk_tka'],
        'general' => ['tiu', 'twk', 'mtk_stis', 'mtk_tka','general','tpa','tbi'], // tkp
    ];

    public function allowedQuestionTypes(): array
    {
        return self::QUESTION_TYPE_RULES[$this->test_type] ?? [];
    }

    //GENERATE EXAM CODE
    protected static function booted()
    {
        static::creating(function (Exam $exam) {
            if (empty($exam->exam_code)) {
                $exam->exam_code = self::generateExamCode($exam);
            }
        });
    }

    public static function generateExamCode(Exam $exam): string
    {
        $prefix = match ($exam->type) {
            'post_test' => 'POST',
            'blind_test' => 'BLIND',
            'quiz'      => 'QUIZ',
            'tryout'    => 'TRY',
            default     => 'EXM',
        };

        return sprintf(
            'EXM-%s-%s-%s',
            $prefix,
            now()->format('Ymd'),
            strtoupper(Str::random(4))
        );
    }
    /* ================= RELATIONS ================= */

    // post test → Meeting
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function prerequisites()
    {
        return $this->belongsToMany(
            Exam::class,
            'exam_prerequisites',
            'exam_id',
            'required_exam_id'
        );
    }
    public function unmetPrerequisitesFor(User $user)
    {
        return $this->prerequisites
            ->filter(fn ($req) =>
                ! $user->examAttempts()
                    ->where('exam_id', $req->id)
                    ->where('is_submitted', true)
                    ->exists()
            );
    }
    /**
     * Relasi ke Productable
     */
    public function productable()
    {
        return $this->morphOne(Productable::class, 'productable')->with('product');
    }

    /* ================= HELPERS ================= */

    /**
     * Accessor untuk mendapatkan Product langsung
     */
    public function getProductAttribute()
    {
        // Cek apakah relasi productable sudah dimuat
        if (!$this->relationLoaded('productable')) {
            $this->load('productable');
        }

        // Kembalikan product dari productable
        return $this->productable?->product;
    }

    /* ================= METHODS ================= */
    public function isBlindTest(): bool
    {
        return $this->type === 'blind_test';
    }
    public function isPostTest(): bool
    {
        return $this->type === 'post_test';
    }

    public function isQuiz(): bool
    {
        return $this->type === 'quiz';
    }

    public function isTryout(): bool
    {
        return $this->type === 'tryout';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
    // Helper boolean
    public function isSKD(): bool
    {
        return $this->test_type === 'skd';
    }

    public function isMtkStis(): bool
    {
        return $this->test_type === 'mtk_stis';
    }

    public function isMtkTka(): bool
    {
        return $this->test_type === 'mtk_tka';
    }
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

    public function hasTimeWindow(): bool
    {
        if (!$this->scheduled_at) return true;

        return now()->between(
            $this->scheduled_at,
            $this->scheduled_end_at ?? now()->addYears(10)
        );
    }

    public function getContextTitleAttribute(): string
    {
        // BLIND POST TEST (melekat ke meeting)
        if (
            $this->owner_type === \App\Models\Meeting::class &&
            $this->owner
        ) {
            return (string) $this->owner->title;
        }

        // QUIZ / TRYOUT
        if (!empty($this->title)) {
            return (string) $this->title;
        }

        // fallback wajib string
        return 'Exam';
    }

    public function backRoute(): string
    {
        // ================= BLIND & POST TEST =================
        if (
            in_array($this->type, ['post_test', 'blind_test']) &&
            $this->owner instanceof Meeting
        ) {
            return route('meeting.show', $this->owner);
        }

        // ================= QUIZ =================
        if ($this->type === 'quiz') {
            return route('quizzes.index');
        }

        // ================= TRYOUT =================
        if ($this->type === 'tryout') {
            return route('tryouts.index');
        }

        // ================= FALLBACK =================
        return route('dashboard.redirect');
    }
    public function getAnswerTypeAttribute(): ?string
    {
        return $this->selected_options['type'] ?? null;
    }

    public function getCompoundAnswersAttribute(): array
    {
        return $this->selected_options['answers'] ?? [];
    }

    public function getShortAnswerValueAttribute(): ?string
    {
        return $this->selected_options['value'] ?? null;
    }
}
