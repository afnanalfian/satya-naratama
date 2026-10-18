<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalEvaluationResult extends Model
{
    protected $fillable = [
        'physical_evaluation_id',
        'user_id',
        'gender',
        'run_12min_m',
        'pull_up_chinning',
        'push_up',
        'sit_up',
        'shuttle_run_sec',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'run_12min_m'      => 'integer',
        'pull_up_chinning' => 'integer',
        'push_up'          => 'integer',
        'sit_up'           => 'integer',
        'shuttle_run_sec'  => 'float',
    ];

    public function evaluation()
    {
        return $this->belongsTo(PhysicalEvaluation::class, 'physical_evaluation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPullUpLabelAttribute(): string
    {
        return $this->gender === 'P' ? 'Chinning' : 'Pull Up';
    }

    public function isEmpty(): bool
    {
        foreach (array_keys(PhysicalEvaluation::ITEMS) as $key) {
            if ($this->{$key} !== null) {
                return false;
            }
        }

        return true;
    }
}
