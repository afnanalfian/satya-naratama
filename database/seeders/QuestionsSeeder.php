<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Data untuk TIU (35 soal)
        $this->createQuestions('TIU', 35, 1, $now);

        // Data untuk TWK (30 soal)
        $this->createQuestions('TWK', 30, 2, $now);

        // Data untuk TKP (45 soal)
        $this->createQuestions('TKP', 45, 3, $now);
    }

    private function createQuestions(string $testType, int $count, int $materialId, Carbon $now): void
    {
        for ($i = 1; $i <= $count; $i++) {
            // Insert pertanyaan
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => strtolower($testType),
                'question_text' => "Soal {$testType} nomor {$i}: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua?",
                'image' => null,
                'explanation' => "Ini adalah penjelasan untuk soal {$testType} nomor {$i}. Jawaban yang benar adalah...",
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null
            ]);

            // Insert opsi untuk pertanyaan
            $this->createOptions($questionId, $testType, $i, $now);
        }
    }

    private function createOptions(int $questionId, string $testType, int $questionNumber, Carbon $now): void
    {
        $options = [];

        if ($testType === 'TKP') {
            // Untuk TKP: weight 1-5 (semua opsi valid dengan bobot berbeda)
            for ($j = 1; $j <= 5; $j++) {
                $weight = $j; // 1 sampai 5
                $options[] = [
                    'question_id' => $questionId,
                    'option_text' => "Opsi {$j} untuk soal TKP nomor {$questionNumber}. Ini adalah pilihan yang memiliki bobot {$weight}.",
                    'is_correct' => 0, // Untuk TKP, is_correct selalu 0
                    'image' => null,
                    'order' => $j,
                    'weight' => $weight,
                    'created_at' => $now,
                    'updated_at' => $now,
                    'deleted_at' => null
                ];
            }
        } else {
            // Untuk TIU dan TWK: satu jawaban benar (is_correct = 1), lainnya salah
            $correctOption = rand(1, 5); // Pilih acak opsi mana yang benar

            for ($j = 1; $j <= 5; $j++) {
                $options[] = [
                    'question_id' => $questionId,
                    'option_text' => "Opsi {$j} untuk soal {$testType} nomor {$questionNumber}. " .
                                   ($j === $correctOption ? "(Ini adalah jawaban yang benar)" : "(Ini adalah jawaban yang salah)"),
                    'is_correct' => $j === $correctOption ? 1 : 0,
                    'image' => null,
                    'order' => $j,
                    'weight' => 0, // Untuk non-TKP, weight = 0
                    'created_at' => $now,
                    'updated_at' => $now,
                    'deleted_at' => null
                ];
            }
        }

        DB::table('question_options')->insert($options);
    }
}
