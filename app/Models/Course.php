<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'is_free',
        'description',
        'thumbnail',
    ];
    protected $casts = [
        'is_free' => 'boolean',
    ];
    public const TYPE_AKADEMIK = 'akademik';
    public const TYPE_JASMANI  = 'jasmani';

    public const TYPES = [
        self::TYPE_AKADEMIK => 'Akademik',
        self::TYPE_JASMANI  => 'Jasmani',
    ];

    public function isJasmani(): bool
    {
        return $this->type === self::TYPE_JASMANI;
    }

    public function isAkademik(): bool
    {
        return ! $this->isJasmani();
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? 'Akademik';
    }

    public function scopeOfType($query, ?string $type)
    {
        return $type ? $query->where('type', $type) : $query;
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class)->orderBy('scheduled_at');
    }

    public function questionCategories()
    {
        return $this->hasMany(QuestionCategory::class);
    }
    public function product()
    {
        return $this->morphOne(Productable::class, 'productable')->with('product');
    }
    public function coursePackage()
    {
        return $this->morphOne(Productable::class, 'productable')
            ->whereHas('product', fn ($q) =>
                $q->where('type', 'course_package')
            )
            ->with('product');
    }
    public function isFree(): bool
    {
        return $this->is_free;
    }


    protected static function booted()
    {
        // Submit ketika course disimpan (created atau updated)
        static::saved(function ($course) {
            // Hanya submit jika course published
            if ($course->is_published) {
                // Delay sedikit agar data benar-benar tersimpan
                dispatch(function () use ($course) {
                    \App\Services\IndexNowService::submit([
                        "/course/{$course->slug}"
                    ]);
                })->delay(now()->addSeconds(5));
            }
        });

        // Submit ketika status berubah dari draft ke published
        static::updated(function ($course) {
            // Cek jika status berubah menjadi published
            if ($course->is_published && $course->wasChanged('is_published')) {
                dispatch(function () use ($course) {
                    \App\Services\IndexNowService::submit([
                        "/course/{$course->slug}"
                    ]);
                })->delay(now()->addSeconds(5));
            }

            // Juga submit jika slug berubah (URL berubah)
            if ($course->is_published && $course->wasChanged('slug')) {
                // Submit URL baru
                dispatch(function () use ($course) {
                    \App\Services\IndexNowService::submit([
                        "/course/{$course->slug}"
                    ]);
                })->delay(now()->addSeconds(5));

                // Optional: Submit URL lama untuk di-remove/di-update
                // (tergantung kebutuhan)
            }
        });
    }
}
