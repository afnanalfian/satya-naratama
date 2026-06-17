<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Exam;

class BackfillPassingRules extends Command
{
    protected $signature = 'exam:backfill-passing-rules {--force : Timpa passing_rules yang sudah ada}';

    protected $description = 'Isi passing_rules default untuk exam tryout lama';

    public function handle(): int
    {
        $query = Exam::where('type', 'tryout');

        if (!$this->option('force')) {
            $query->whereNull('passing_rules');
        }

        $exams = $query->get();

        $this->info("Found {$exams->count()} exam(s)");

        foreach ($exams as $exam) {
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

            $exam->save();
            $this->line("Updated exam ID {$exam->id}");
        }

        $this->info('Done.');
        return Command::SUCCESS;
    }
}
