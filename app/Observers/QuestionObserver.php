<?php

namespace App\Observers;

use App\Models\Question;
use App\Events\QuestionKeyChanged;
use Illuminate\Support\Facades\Log;

class QuestionObserver
{
    public function updated(Question $question)
    {
        // 🔥 Load relasi yang diperlukan
        $question->load(['options', 'subItems.answers']);
        
        $shouldRecalculate = false;
        
        // 🔥 Cek perubahan options (is_correct atau weight)
        // Ambil data asli dari database sebelum update
        $originalQuestion = Question::with(['options', 'subItems.answers'])
            ->find($question->id);
            
        if ($originalQuestion) {
            $oldOptions = $originalQuestion->options ?? collect();
            $newOptions = $question->options ?? collect();
            
            // Bandingkan options
            foreach ($newOptions as $index => $newOption) {
                $oldOption = $oldOptions[$index] ?? null;
                
                if ($oldOption) {
                    $oldIsCorrect = $oldOption->is_correct ?? false;
                    $newIsCorrect = $newOption->is_correct ?? false;
                    
                    $oldWeight = $oldOption->weight ?? 0;
                    $newWeight = $newOption->weight ?? 0;
                    
                    if ($oldIsCorrect !== $newIsCorrect || $oldWeight !== $newWeight) {
                        $shouldRecalculate = true;
                        Log::info("Option changed for question {$question->id}: old_correct={$oldIsCorrect}, new_correct={$newIsCorrect}");
                        break;
                    }
                }
            }
        }
        
        // 🔥 Cek perubahan subItems untuk compound
        if ($question->isCompound() && !$shouldRecalculate) {
            $originalQuestion = Question::with(['subItems.answers'])
                ->find($question->id);
                
            if ($originalQuestion) {
                $oldSubItems = $originalQuestion->subItems ?? collect();
                $newSubItems = $question->subItems ?? collect();
                
                foreach ($newSubItems as $index => $newSub) {
                    $oldSub = $oldSubItems[$index] ?? null;
                    
                    if ($oldSub) {
                        $oldAnswers = $oldSub->answers ?? collect();
                        $newAnswers = $newSub->answers ?? collect();
                        
                        // Cek boolean_answer untuk truefalse
                        if ($newSub->type === 'truefalse') {
                            $oldBool = $oldAnswers->first()?->boolean_answer ?? false;
                            $newBool = $newAnswers->first()?->boolean_answer ?? false;
                            
                            if ($oldBool !== $newBool) {
                                $shouldRecalculate = true;
                                Log::info("Compound sub-item changed for question {$question->id}");
                                break;
                            }
                        }
                        
                        // Cek answer_text untuk short_answer
                        if ($newSub->type === 'short_answer') {
                            $oldTexts = $oldAnswers->pluck('answer_text')->toArray();
                            $newTexts = $newAnswers->pluck('answer_text')->toArray();
                            
                            if ($oldTexts !== $newTexts) {
                                $shouldRecalculate = true;
                                Log::info("Compound short answer changed for question {$question->id}");
                                break;
                            }
                        }
                    }
                }
            }
        }
        
        if ($shouldRecalculate) {
            Log::info("Question key changed for question ID: {$question->id}, triggering recalculation");
            event(new QuestionKeyChanged($question));
        }
    }
}