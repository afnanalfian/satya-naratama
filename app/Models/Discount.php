<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'max_discount',
        'min_order_amount',
        'quota',
        'used',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function targets()
    {
        return $this->morphedByMany(
            Product::class,
            'discountable'
        );
    }
    public function isGlobal(): bool
    {
        return ! $this->discountables()->exists();
    }
    public function getIsCurrentlyActiveAttribute(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        $now = Carbon::now();

        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }

        if ($this->ends_at && $now->gt($this->ends_at)) {
            return false;
        }

        if ($this->quota !== null && $this->used >= $this->quota) {
            return false;
        }

        return true;
    }
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'percentage' => 'PERSENTASE',
            'fixed'      => 'POTONGAN TETAP',
            default      => strtoupper($this->type),
        };
    }
}
