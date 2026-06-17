<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PromoBanner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'target_url',
        'is_active',
        'show_on_landing',
        'type',
        'display_delay',
        'display_duration',
        'priority',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_landing' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /* ================= SCOPES ================= */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForLanding($query)
    {
        return $query->where('show_on_landing', true);
    }

    public function scopeCurrentlyActive($query)
    {
        $now = Carbon::now();

        return $query->where(function ($q) use ($now) {
            $q->whereNull('starts_at')
              ->orWhere('starts_at', '<=', $now);
        })->where(function ($q) use ($now) {
            $q->whereNull('ends_at')
              ->orWhere('ends_at', '>=', $now);
        });
    }

    public function scopeOrderByPriority($query)
    {
        return $query->orderBy('priority', 'desc')
                     ->orderBy('created_at', 'desc');
    }

    /* ================= METHODS ================= */

    public function isCurrentlyActive(): bool
    {
        $now = Carbon::now();

        if (!$this->is_active || !$this->show_on_landing) {
            return false;
        }

        if ($this->starts_at && $this->starts_at->greaterThan($now)) {
            return false;
        }

        if ($this->ends_at && $this->ends_at->lessThan($now)) {
            return false;
        }

        return true;
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public function getFormattedDurationAttribute()
    {
        return $this->display_duration . ' detik';
    }
    public function getResolvedUrlAttribute()
    {
        if (!$this->target_url) {
            return '#';
        }

        // URL absolut (http / https)
        if (preg_match('/^https?:\/\//i', $this->target_url)) {
            return $this->target_url;
        }

        // Route name (browse.index)
        if (str_contains($this->target_url, '.')) {
            try {
                return route($this->target_url);
            } catch (\Exception $e) {
                return '#';
            }
        }

        // Path relatif (/browse)
        return url($this->target_url);
    }

}
