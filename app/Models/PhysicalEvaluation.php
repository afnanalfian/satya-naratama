<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalEvaluation extends Model
{
    /**
     * Definisi item tes jasmani.
     * better: 'high' = makin besar makin baik, 'low' = makin kecil makin baik.
     */
    public const ITEMS = [
        'run_12min_m' => [
            'label'  => 'Lari 12 Menit',
            'short'  => 'Lari 12\'',
            'unit'   => 'm',
            'better' => 'high',
            'step'   => '1',
            'max'    => 6000,
        ],
        'pull_up_chinning' => [
            'label'    => 'Pull Up / Chinning',
            'label_L'  => 'Pull Up',
            'label_P'  => 'Chinning',
            'short'    => 'Pull Up/Chin',
            'unit'     => 'x',
            'better'   => 'high',
            'step'     => '1',
            'max'      => 200,
        ],
        'push_up' => [
            'label'  => 'Push Up',
            'short'  => 'Push Up',
            'unit'   => 'x',
            'better' => 'high',
            'step'   => '1',
            'max'    => 300,
        ],
        'sit_up' => [
            'label'  => 'Sit Up',
            'short'  => 'Sit Up',
            'unit'   => 'x',
            'better' => 'high',
            'step'   => '1',
            'max'    => 300,
        ],
        'shuttle_run_sec' => [
            'label'  => 'Shuttle Run',
            'short'  => 'Shuttle',
            'unit'   => 'detik',
            'better' => 'low',
            'step'   => '0.01',
            'max'    => 120,
        ],
    ];

    protected $fillable = [
        'title',
        'period',
        'held_on',
        'location',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'period'  => 'date',
        'held_on' => 'date',
    ];

    public function results()
    {
        return $this->hasMany(PhysicalEvaluationResult::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getPeriodLabelAttribute(): string
    {
        return $this->period?->translatedFormat('F Y') ?? '-';
    }

    public static function itemLabel(string $key, ?string $gender = null): string
    {
        $item = self::ITEMS[$key] ?? null;
        if (! $item) {
            return $key;
        }

        return $gender && isset($item["label_{$gender}"]) ? $item["label_{$gender}"] : $item['label'];
    }

    /**
     * Statistik per item: rata-rata, terbaik, terendah, jumlah peserta,
     * dan rata-rata per jenis kelamin.
     */
    public function itemStats(): array
    {
        $results = $this->relationLoaded('results') ? $this->results : $this->results()->get();
        $stats = [];

        foreach (self::ITEMS as $key => $item) {
            $values = $results->pluck($key)->filter(fn ($v) => $v !== null)->map(fn ($v) => (float) $v);
            $best = $item['better'] === 'low' ? $values->min() : $values->max();
            $worst = $item['better'] === 'low' ? $values->max() : $values->min();

            $byGender = [];
            foreach (['L', 'P'] as $g) {
                $gv = $results->where('gender', $g)->pluck($key)->filter(fn ($v) => $v !== null);
                $byGender[$g] = $gv->count() ? round($gv->avg(), 2) : null;
            }

            $stats[$key] = [
                'count'     => $values->count(),
                'avg'       => $values->count() ? round($values->avg(), 2) : null,
                'best'      => $best,
                'worst'     => $worst,
                'by_gender' => $byGender,
            ];
        }

        return $stats;
    }

    /* Simpan kolom tanggal sebagai Y-m-d murni (konsisten di MySQL & SQLite). */
    public function setPeriodAttribute($value): void
    {
        $this->attributes['period'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function setHeldOnAttribute($value): void
    {
        $this->attributes['held_on'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }
}
