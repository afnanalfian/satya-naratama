<?php

namespace App\Observers;

use App\Models\Exam;

class ExamObserver
{
    public function creating(Exam $exam): void
    {
        $this->applyDefaultPassingRules($exam);
    }

    public function updating(Exam $exam): void
    {
        // hanya auto-isi kalau masih kosong
        if ($exam->isDirty('test_type') || $exam->isDirty('type')) {
            $this->applyDefaultPassingRules($exam);
        }
    }

    protected function applyDefaultPassingRules(Exam $exam): void
    {
        // hanya untuk TRYOUT
        if ($exam->type !== 'tryout') {
            $exam->passing_rules = null;
            return;
        }

        // kalau admin sudah set manual → jangan timpa
        if (!empty($exam->passing_rules)) {
            return;
        }

        match ($exam->test_type) {
            'skd' => $exam->passing_rules = [
                'tiu' => 80,
                'twk' => 65,
                'tkp' => 166,
            ],

            'mtk_stis' => $exam->passing_rules = [
                'score' => 65,
            ],

            default => $exam->passing_rules = null,
        };
    }
}
