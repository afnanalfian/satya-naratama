<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPhysicalRecord extends Model
{
    protected $fillable = [
        'user_id',
        'period',
        'height_cm',
        'weight_kg',
        'has_illness',
        'illness_notes',
        'has_injury',
        'injury_notes',
        'notes',
        'updated_by',
    ];

    protected $casts = [
        'period'      => 'date',
        'height_cm'   => 'float',
        'weight_kg'   => 'float',
        'has_illness' => 'boolean',
        'has_injury'  => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getPeriodLabelAttribute(): string
    {
        return $this->period?->translatedFormat('F Y') ?? '-';
    }

    public function getBmiAttribute(): ?float
    {
        if (! $this->height_cm || ! $this->weight_kg) {
            return null;
        }
        $m = $this->height_cm / 100;

        return round($this->weight_kg / ($m * $m), 1);
    }

    /** Kategori IMT (standar Kemenkes RI). */
    public static function bmiCategory(?float $bmi): ?array
    {
        if ($bmi === null) {
            return null;
        }

        return match (true) {
            $bmi < 17.0  => ['key' => 'kurus_berat', 'label' => 'Kurus (berat)', 'tone' => 'red'],
            $bmi < 18.5  => ['key' => 'kurus',       'label' => 'Kurus',         'tone' => 'amber'],
            $bmi <= 25.0 => ['key' => 'normal',      'label' => 'Normal',        'tone' => 'emerald'],
            $bmi <= 27.0 => ['key' => 'gemuk',       'label' => 'Gemuk',         'tone' => 'amber'],
            default      => ['key' => 'obesitas',    'label' => 'Obesitas',      'tone' => 'red'],
        };
    }

    public function getBmiCategoryAttribute(): ?array
    {
        return self::bmiCategory($this->bmi);
    }

    public function hasHealthIssue(): bool
    {
        return $this->has_illness || $this->has_injury;
    }

    /* Simpan kolom tanggal sebagai Y-m-d murni (konsisten di MySQL & SQLite). */
    public function setPeriodAttribute($value): void
    {
        $this->attributes['period'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }
}
