<?php

namespace App\Console\Commands;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Events\QuestionKeyChanged;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RecalculateExamScores extends Command
{
    protected $signature = 'exam:recalculate {--question=} {--exam=} {--all}';
    protected $description = 'Recalculate exam scores after key changes';

    public function handle()
    {
        if ($this->option('question')) {
            $question = Question::find($this->option('question'));
            if ($question) {
                $this->info("Recalculating for question ID: {$question->id}");
                event(new QuestionKeyChanged($question));
                $this->info("✅ Recalculated scores for question ID: {$question->id}");
                Log::info("Manual recalculated for question ID: {$question->id}");
            } else {
                $this->error("Question not found");
            }
            return;
        }

        if ($this->option('exam')) {
            $exam = Exam::with('questions')->find($this->option('exam'));
            if ($exam) {
                $this->info("Recalculating for exam ID: {$exam->id}");
                $count = 0;
                
                // 🔥 PERBAIKAN: Ambil question_id dari exam_questions
                $questionIds = ExamQuestion::where('exam_id', $exam->id)
                    ->pluck('question_id')
                    ->toArray();
                    
                foreach ($questionIds as $questionId) {
                    $question = Question::find($questionId);
                    if ($question) {
                        event(new QuestionKeyChanged($question));
                        $count++;
                        $this->line("  - Processed question ID: {$questionId}");
                    }
                }
                
                $this->info("✅ Recalculated scores for {$count} questions in exam ID: {$exam->id}");
            } else {
                $this->error("Exam not found");
            }
            return;
        }

        if ($this->option('all')) {
            $this->info("Recalculating ALL exams...");
            
            // 🔥 PERBAIKAN: Ambil semua exam yang punya questions
            $examIds = ExamQuestion::distinct()->pluck('exam_id')->toArray();
            $total = 0;
            
            foreach ($examIds as $examId) {
                $exam = Exam::find($examId);
                if (!$exam) continue;
                
                $questionIds = ExamQuestion::where('exam_id', $examId)
                    ->pluck('question_id')
                    ->toArray();
                    
                foreach ($questionIds as $questionId) {
                    $question = Question::find($questionId);
                    if ($question) {
                        event(new QuestionKeyChanged($question));
                        $total++;
                    }
                }
                
                $this->line("  - Processed exam: {$examId} (" . count($questionIds) . " questions)");
            }
            
            $this->info("✅ Recalculated scores for {$total} questions across " . count($examIds) . " exams");
            return;
        }

        $this->error('Please specify --question, --exam, or --all');
    }
}