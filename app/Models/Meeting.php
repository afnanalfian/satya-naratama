<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'is_free',
        'scheduled_at',
        'started_at',
        'zoom_link',
        'status',
        'created_by',
    ];
    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'is_free' => 'boolean',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function material()
    {
        return $this->hasOne(MeetingMaterial::class);
    }
    public function exams()
    {
        return $this->morphMany(Exam::class, 'owner');
    }

    public function postTest()
    {
        return $this->morphOne(Exam::class, 'owner')
            ->where('type', 'post_test');
    }

    public function blindTest()
    {
        return $this->morphOne(Exam::class, 'owner')
            ->where('type', 'blind_test');
    }
    public function attendances()
    {
        return $this->hasMany(MeetingAttendance::class);
    }
    public function video()
    {
        return $this->hasOne(MeetingVideo::class);
    }
    // Untuk observer dan productable access
    public function productable()
    {
        return $this->morphOne(Productable::class, 'productable');
    }
    public function product()
    {
        return $this->morphOne(Productable::class, 'productable')->with('product');
    }
    // Untuk query langsung ke product
    public function productRelation()
    {
        return $this->hasOneThrough(
            Product::class,
            Productable::class,
            'productable_id',
            'id',
            'id',
            'product_id'
        )->where('productable_type', static::class);
    }

    /**
     * Accessor untuk mendapatkan Product langsung
     * Bisa melalui productRelation atau productable
     */
    public function getProductAttribute()
    {
        // Coba via productRelation dulu
        if ($this->relationLoaded('productRelation')) {
            return $this->productRelation;
        }

        // Fallback via productable
        if (!$this->relationLoaded('productable')) {
            $this->load('productable.product');
        }

        return $this->productable?->product;
    }
    public function isFree(): bool
    {
        return $this->is_free;
    }
    public function courseIsFree(): bool
    {
        return $this->course && $this->course->is_free;
    }

    // Generate Slug
    protected static function booted()
    {
        static::creating(function (Meeting $meeting) {
            if (empty($meeting->slug)) {
                $meeting->slug = self::generateUniqueSlug($meeting->title);
            }
        });
    }

    public static function generateUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
