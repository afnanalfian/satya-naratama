<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdditionalTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Mapping test types dengan material_id dari gambar
        $testTypes = [
            'tpa' => [
                'count' => 35,
                'material_id' => 5, // TPA - Testing
                'description' => 'Tes Potensi Akademik'
            ],
            'tbi' => [
                'count' => 30,
                'material_id' => 6, // TBI - Testing
                'description' => 'Tes Bahasa Inggris'
            ],
            'mtk_stis' => [
                'count' => 40,
                'material_id' => 7, // MTK STIS - Testing
                'description' => 'Matematika STIS'
            ],
            'general' => [
                'count' => 50,
                'material_id' => 8, // General - Testing
                'description' => 'Tes Umum'
            ]
        ];

        foreach ($testTypes as $testType => $config) {
            $this->createMCQuestions(
                testType: $testType,
                count: $config['count'],
                materialId: $config['material_id'],
                description: $config['description'],
                now: $now
            );

            $this->command->info("Seeder untuk {$config['description']} ({$testType}) dengan material_id {$config['material_id']} berhasil dibuat.");
        }
    }

    /**
     * Membuat soal MCQ dengan 5 opsi (1 benar)
     */
    private function createMCQuestions(string $testType, int $count, int $materialId, string $description, Carbon $now): void
    {
        for ($i = 1; $i <= $count; $i++) {
            // Insert pertanyaan
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => $testType,
                'question_text' => $this->generateQuestionText($testType, $i, $description),
                'image' => null, // Semua null sesuai contoh
                'explanation' => $this->generateExplanation($testType, $i, $description),
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null
            ]);

            // Insert opsi jawaban (5 opsi, 1 benar)
            $this->createSingleCorrectOptions($questionId, $testType, $i, $description, $now);
        }
    }

    /**
     * Generate teks pertanyaan berdasarkan tipe tes
     */
    private function generateQuestionText(string $testType, int $number, string $description): string
    {
        $baseText = "Soal {$description} nomor {$number}: ";

        $specificTexts = [
            'mtk_stis' => [
                "Jika 2x + 3y = 12 dan 3x - 2y = 5, maka nilai x + y adalah...",
                "Sebuah lingkaran memiliki jari-jari 7 cm. Luas lingkaran tersebut adalah... (π = 22/7)",
                "Deret bilangan: 2, 5, 10, 17, 26, ... Bilangan selanjutnya adalah...",
                "Jika f(x) = x² - 4x + 3, maka nilai f(3) adalah...",
                "Sebuah segitiga memiliki alas 12 cm dan tinggi 8 cm. Luas segitiga tersebut adalah..."
            ],
            'tpa' => [
                "Semua dokter adalah profesional. Beberapa profesional adalah peneliti. Kesimpulan yang tepat adalah...",
                "Jika A = 1, B = 2, C = 3, maka nilai dari A + B + C adalah...",
                "Pola bilangan: 3, 6, 12, 24, ... Bilangan selanjutnya adalah...",
                "Kebalikan dari kata 'CEPAT' adalah...",
                "Jika semua burung bisa terbang dan merpati adalah burung, maka..."
            ],
            'tbi' => [
                "Choose the correct form of the verb: She _____ to school every day.",
                "What is the synonym of 'HAPPY'?",
                "If I had known, I _____ you.",
                "The opposite of 'ANCIENT' is...",
                "Complete the sentence: Neither John nor his brothers _____ coming to the party."
            ],
            'general' => [
                "Ibu kota negara Perancis adalah...",
                "Planet terdekat dari matahari adalah...",
                "Penemu bola lampu adalah...",
                "Hari sumpah pemuda diperingati setiap tanggal...",
                "Lagu kebangsaan Indonesia adalah..."
            ]
        ];

        // Gunakan teks spesifik jika ada, atau gunakan template umum
        if (isset($specificTexts[$testType])) {
            $index = ($number - 1) % count($specificTexts[$testType]);
            return $baseText . $specificTexts[$testType][$index];
        }

        return $baseText . "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua?";
    }

    /**
     * Generate penjelasan berdasarkan tipe tes
     */
    private function generateExplanation(string $testType, int $number, string $description): string
    {
        return "Ini adalah penjelasan untuk soal {$description} nomor {$number}. Jawaban yang benar adalah opsi yang telah ditentukan sesuai dengan kaidah {$description}.";
    }

    /**
     * Membuat opsi jawaban dengan 1 benar
     */
    private function createSingleCorrectOptions(int $questionId, string $testType, int $questionNumber, string $description, Carbon $now): void
    {
        $options = [];

        // Pilih acak opsi mana yang benar (1-5)
        $correctOption = rand(1, 5);

        for ($j = 1; $j <= 5; $j++) {
            $isCorrect = $j === $correctOption ? 1 : 0;

            // Generate teks opsi yang berbeda-beda berdasarkan tipe tes
            $optionText = $this->generateOptionText($testType, $j, $questionNumber, $isCorrect);

            $options[] = [
                'question_id' => $questionId,
                'option_text' => $optionText,
                'is_correct' => $isCorrect,
                'image' => null,
                'order' => $j,
                'weight' => 0, // Semua 0 karena bukan TKP
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null
            ];
        }

        DB::table('question_options')->insert($options);
    }

    /**
     * Generate teks opsi yang berbeda untuk setiap tipe tes
     */
    private function generateOptionText(string $testType, int $optionNumber, int $questionNumber, bool $isCorrect): string
    {
        $prefix = "Opsi {$optionNumber} untuk soal ";

        // Pilihan untuk tipe tes berbeda
        $typeSpecific = [
            'mtk_stis' => [
                "Hasil perhitungan adalah {$optionNumber}",
                "Nilai dari persamaan adalah " . ($optionNumber * 2),
                "Jawaban matematis: " . ($optionNumber + 5),
                "Solusi: x = " . $optionNumber,
                "Hasil: " . pow($optionNumber, 2)
            ],
            'tpa' => [
                "Kesimpulan logis {$optionNumber}",
                "Pola menunjukkan {$optionNumber}",
                "Analisis menghasilkan {$optionNumber}",
                "Penalaran: opsi {$optionNumber}",
                "Logika: pilihan {$optionNumber}"
            ],
            'tbi' => [
                "Grammar choice {$optionNumber}",
                "Vocabulary option {$optionNumber}",
                "English answer {$optionNumber}",
                "Language selection {$optionNumber}",
                "TBI response {$optionNumber}"
            ],
            'general' => [
                "Pengetahuan umum pilihan {$optionNumber}",
                "Fakta: opsi {$optionNumber}",
                "Informasi: {$optionNumber}",
                "Data: pilihan {$optionNumber}",
                "Wawasan: opsi {$optionNumber}"
            ]
        ];

        $specificText = $typeSpecific[$testType] ?? $typeSpecific['general'];
        $index = ($optionNumber - 1) % count($specificText);
        $text = $specificText[$index];

        // Tambah tanda jika ini jawaban benar
        if ($isCorrect) {
            $text .= " (Ini adalah jawaban yang benar)";
        } else {
            $text .= " (Ini adalah jawaban yang salah)";
        }

        return $prefix . strtoupper($testType) . " nomor {$questionNumber}. {$text}";
    }
}
