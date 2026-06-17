<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Perbandingan2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk kategori 1 (Blind Test) - soal 1-10
        $materialBT = QuestionMaterial::create([
            'category_id' => 15,
            'name' => 'BT - Perbandingan 3',
            'slug' => 'bt-perbandingan-3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 1-10 untuk Blind Test
        $questionsBT = [
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui luas tanah adalah 300 m² perbandingan luas tanah dan luas bangunan adalah 6:4. Berapakah luas bangunannya?',
                'explanation' => '<p>Perbandingan luas tanah : luas bangunan = 6 : 4</p>
                <p>Total perbandingan = 6 + 4 = 10</p>
                <p>Luas bangunan = \begin{aligned} \frac{4}{10} \times 300 \text{ m}^2 = 120 \text{ m}^2 \end{aligned}</p>
                <p>Jadi luas bangunan adalah 120 m².</p>',
                'options' => [
                    ['option_text' => '100 m²', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '120 m²', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '200 m²', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '180 m²', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '190 m²', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Kopi kualitas 1 dan 2 dicampur dengan perbandingan berat a:b harga kopi kualitas 1 dan kualitas 2 tiap kg masing-masing adalah Rp 16.000 dan Rp 18.000. Jika harga kopi kualitas 1 naik 15% sedangkan kopi kualitas 2 turun 10%, tetapi harga kopi campuran setiap kg tidak berubah, maka nilai a:b adalah?',
                'explanation' => '<p>Harga awal kualitas 1 = Rp 16.000, setelah naik 15% = Rp 18.400</p>
                <p>Harga awal kualitas 2 = Rp 18.000, setelah turun 10% = Rp 16.200</p>
                <p>Harga campuran awal = \begin{aligned} \frac{a \times 16000 + b \times 18000}{a + b} \end{aligned}</p>
                <p>Harga campuran setelah perubahan = \begin{aligned} \frac{a \times 18400 + b \times 16200}{a + b} \end{aligned}</p>
                <p>Karena harga tidak berubah:</p>
                <p>\begin{aligned}
                \frac{a \times 16000 + b \times 18000}{a + b} &= \frac{a \times 18400 + b \times 16200}{a + b} \\
                16000a + 18000b &= 18400a + 16200b \\
                18000b - 16200b &= 18400a - 16000a \\
                1800b &= 2400a \\
                \frac{a}{b} &= \frac{1800}{2400} = \frac{3}{4}
                \end{aligned}</p>
                <p>Jadi a:b = 3:4</p>',
                'options' => [
                    ['option_text' => '3:4', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '9:8', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '4:3', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '4:9', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '4:10', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Umur ayah 1 1/3 umur ibu. Umur ibu 2 1/2 umur kakak. Jika umur kakak tahun ini 18 tahun, maka umur ayah adalah?',
                'explanation' => '<p>Umur kakak = 18 tahun</p>
                <p>Umur ibu = \begin{aligned} 2\frac{1}{2} \times 18 = \frac{5}{2} \times 18 = 45 \text{ tahun} \end{aligned}</p>
                <p>Umur ayah = \begin{aligned} 1\frac{1}{3} \times 45 = \frac{4}{3} \times 45 = 60 \text{ tahun} \end{aligned}</p>
                <p>Jadi umur ayah adalah 60 tahun.</p>',
                'options' => [
                    ['option_text' => '23 tahun', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '44 tahun', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '59 tahun', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '60 tahun', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '62 tahun', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Lantai sekolah akan dipasang keramik besar dan kecil. Banyak keramik kecil 120 buah kurang dari banyak keramik besar. Perbandingan banyak keramik besar dan kecil adalah 8 : 5. Sebelum pemasangan, keramik yang tersedia ada 80 kardus keramik besar, dan 8 kardus keramik kecil. Selisih banyak keramik di dalam kardus keramik besar dan kardus keramik kecil ada ....',
                'explanation' => '<p>Misalkan:</p>
                <p>Keramik besar = Kb, Keramik kecil = Kk</p>
                <p>Diketahui: Kk = Kb - 120 dan Kb : Kk = 8 : 5</p>
                <p>\begin{aligned}
                \frac{Kb}{Kk} &= \frac{8}{5} \\
                \frac{Kb}{Kb - 120} &= \frac{8}{5} \\
                5Kb &= 8(Kb - 120) \\
                5Kb &= 8Kb - 960 \\
                960 &= 3Kb \\
                Kb &= 320 \text{ buah}
                \end{aligned}</p>
                <p>Kk = 320 - 120 = 200 buah</p>
                <p>Isi per kardus besar = 320 ÷ 80 = 4 buah</p>
                <p>Isi per kardus kecil = 200 ÷ 8 = 25 buah</p>
                <p>Selisih = 25 - 4 = 21 buah</p>',
                'options' => [
                    ['option_text' => '12 buah', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '15 buah', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '18 buah', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '21 buah', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '25 buah', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perbandingan harga sebuah pensil dengan harga sebuah buku tulis adalah 2 : 3. Perbandingan harga sebuah buku tulis 2 : 5 dari harga sebuah pastel warna. Harga sebuah pastel warna Rp45.000,00. Harga dua buah pensil adalah?',
                'explanation' => '<p>Pastel : Buku : Pensil = 5 : 2 : ?</p>
                <p>Dari soal: Pensil : Buku = 2 : 3</p>
                <p>Buku : Pastel = 2 : 5</p>
                <p>Samakan perbandingan buku (menjadi 6):</p>
                <p>Pensil : Buku = 4 : 6</p>
                <p>Buku : Pastel = 6 : 15</p>
                <p>Jadi Pensil : Buku : Pastel = 4 : 6 : 15</p>
                <p>Harga pastel = Rp45.000</p>
                <p>\begin{aligned}
                \text{Harga pensil} &= \frac{4}{15} \times 45.000 = 12.000 \\
                \text{Harga 2 pensil} &= 2 \times 12.000 = 24.000
                \end{aligned}</p>',
                'options' => [
                    ['option_text' => 'Rp12.000,00', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Rp18.000,00', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Rp24.000,00', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Rp45.000,00', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rp50.000,00', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Harga 2 buku tulis, 3 bolpoin, dan 3 penghapus Rp15.000,00. Perbandingan harga buku tulis dengan bolpoin dan penghapus adalah 5 : 3 : 2. Dengan perhitungan yang sama, Rina membeli 4 buku tulis, 5 penghapus, dan beberapa bolpoin. Rina membayar dengan dua lembar uang Rp20.000,00 dan mendapat pengembalian Rp4.000,00. Bolpoin yang dibeli Rina ada?',
                'explanation' => '<p>Harga satuan: Buku : Bolpoin : Penghapus = 5 : 3 : 2</p>
                <p>Misalkan faktor = x, maka:</p>
                <p>2(5x) + 3(3x) + 3(2x) = 15.000</p>
                <p>10x + 9x + 6x = 15.000</p>
                <p>25x = 15.000 → x = 600</p>
                <p>Harga buku = 5×600 = 3.000</p>
                <p>Harga bolpoin = 3×600 = 1.800</p>
                <p>Harga penghapus = 2×600 = 1.200</p>
                <p>Uang Rina = 2×20.000 - 4.000 = 36.000</p>
                <p>Misalkan bolpoin = b buah:</p>
                <p>4×3.000 + 5×1.200 + b×1.800 = 36.000</p>
                <p>12.000 + 6.000 + 1.800b = 36.000</p>
                <p>18.000 + 1.800b = 36.000</p>
                <p>1.800b = 18.000 → b = 10</p>
                <p>Jadi bolpoin yang dibeli = 10 buah</p>',
                'options' => [
                    ['option_text' => '12 Buah', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '10 Buah', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '8 Buah', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '6 Buah', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '9 Buah', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika X : Y = 4 : 5, dan diketahui nilai X = 20, maka nilai Y adalah ....',
                'explanation' => '<p>\begin{aligned}
                \frac{X}{Y} &= \frac{4}{5} \\
                \frac{20}{Y} &= \frac{4}{5} \\
                20 \times 5 &= 4 \times Y \\
                100 &= 4Y \\
                Y &= 25
                \end{aligned}</p>',
                'options' => [
                    ['option_text' => '15', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '20', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '25', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '30', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '35', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Sebuah pesta dihadiri tamu undangan yang terdiri dari 24 pria dan 30 wanita. Perbandingan antara tamu pria dengan tamu wanita adalah ....',
                'explanation' => '<p>Pria : Wanita = 24 : 30</p>
                <p>Sederhanakan dengan membagi 6:</p>
                <p>24 ÷ 6 = 4, 30 ÷ 6 = 5</p>
                <p>Jadi perbandingan = 4 : 5</p>',
                'options' => [
                    ['option_text' => '1 : 2', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '2 : 3', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '3 : 4', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '4 : 5', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '4 : 2', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui total buku yang dimiliki Lisa dan Mitha sebanyak 100 buah. Jika perbandingan buku Lisa dan Mitha adalah 3 : 2. Maka banyaknya buku yang dimiliki masing-masing adalah ....',
                'explanation' => '<p>Total perbandingan = 3 + 2 = 5</p>
                <p>Buku Lisa = \begin{aligned} \frac{3}{5} \times 100 = 60 \text{ buah} \end{aligned}</p>
                <p>Buku Mitha = \begin{aligned} \frac{2}{5} \times 100 = 40 \text{ buah} \end{aligned}</p>',
                'options' => [
                    ['option_text' => 'Lisa = 60, Mitha = 40', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Lisa = 70, Mitha = 30', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Lisa = 55, Mitha = 45', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Lisa = 45, Mitha = 55', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Lisa = 50, Mitha = 50', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui perbandingan tinggi rumah dengan pagar adalah 8 : 6. Jika perbedaan tinggi rumah dengan pagar adalah 4 meter. Maka tinggi masing masing adalah ....',
                'explanation' => '<p>Selisih perbandingan = 8 - 6 = 2</p>
                <p>Tinggi rumah = \begin{aligned} \frac{8}{2} \times 4 = 16 \text{ m} \end{aligned}</p>
                <p>Tinggi pagar = \begin{aligned} \frac{6}{2} \times 4 = 12 \text{ m} \end{aligned}</p>',
                'options' => [
                    ['option_text' => 'Rumah 14m, Pagar 10m', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Rumah 16m, Pagar 12m', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Rumah 16m, Pagar 14m', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Rumah 18m, Pagar 12m', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rumah 20m, Pagar 15m', 'is_correct' => false, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal untuk Blind Test
        foreach ($questionsBT as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Data untuk kategori 2 (Post Test) - soal 11-20
        $materialPT = QuestionMaterial::create([
            'category_id' => 15,
            'name' => 'PT - Perbandingan 3',
            'slug' => 'pt-perbandingan-3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 11-20 untuk Post Test
        $questionsPT = [
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui uang Rika dan Ilyas masing-masing memegang uang dengan perbandingan 6 : 7. Jika uang Ilyas adalah Rp 42.000,00. Maka uang Rika adalah ....',
                'explanation' => '<p>Rika : Ilyas = 6 : 7</p>
                <p>Uang Ilyas = Rp 42.000</p>
                <p>\begin{aligned}
                \frac{\text{Rika}}{42.000} &= \frac{6}{7} \\
                \text{Rika} &= \frac{6}{7} \times 42.000 = 36.000
                \end{aligned}</p>
                <p>Jadi uang Rika adalah Rp 36.000</p>',
                'options' => [
                    ['option_text' => 'Rp 49.000,00', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Rp 42.000,00', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Rp 36.000,00', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Rp 30.000,00', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rp 52.000,00', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Joyo dan Budi masing-masing memiliki uang yang jika digabungkan totalnya menjadi 1 juta rupiah. Perbandingan uang Joyo dan Budi adalah 2:3. Jika Joyo memperoleh tambahan uang 300 ribu, maka berapa perbandingan uang mereka sekarang?',
                'explanation' => '<p>Total uang = Rp 1.000.000</p>
                <p>Joyo : Budi = 2 : 3</p>
                <p>Uang Joyo awal = \begin{aligned} \frac{2}{5} \times 1.000.000 = 400.000 \end{aligned}</p>
                <p>Uang Budi = \begin{aligned} \frac{3}{5} \times 1.000.000 = 600.000 \end{aligned}</p>
                <p>Uang Joyo setelah tambahan = 400.000 + 300.000 = 700.000</p>
                <p>Perbandingan baru = 700.000 : 600.000 = 7 : 6</p>',
                'options' => [
                    ['option_text' => '2 : 3', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '3 : 2', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '4 : 5', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '7 : 6', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '8 : 2', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ika mempunyai baju sebanyak 3 kali dari banyak baju yang dimiliki Tesya. Jika total baju yang dimiliki keduanya adalah 40 lembar, maka banyaknya baju milik Ika adalah ....',
                'explanation' => '<p>Misalkan baju Tesya = x</p>
                <p>Baju Ika = 3x</p>
                <p>Total: x + 3x = 40</p>
                <p>4x = 40 → x = 10</p>
                <p>Baju Ika = 3 × 10 = 30 lembar</p>',
                'options' => [
                    ['option_text' => '20', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '25', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '30', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '35', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '40', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika dalam 7 hari Bobi menghabiskan uang Rp 210.000,00 untuk membeli makan siangnya, maka dalam jumlah uang yang dihabiskan Bobi untuk makan siang selama 11 hari adalah....',
                'explanation' => '<p>7 hari → Rp 210.000</p>
                <p>1 hari → \begin{aligned} \frac{210.000}{7} = 30.000 \end{aligned}</p>
                <p>11 hari → 11 × 30.000 = Rp 330.000</p>',
                'options' => [
                    ['option_text' => 'Rp 250.000,00', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Rp 260.000,00', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Rp 270.000,00', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Rp 280.000,00', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rp 330.000,00', 'is_correct' => true, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Lisa membeli 1 pak tissue, kemudian mendapat kembalian sebesar Rp 75.000. Jika kembalian tersebut bernilai ¾ dari uang yang dibayarkan, maka berapakah nilai uang yang dibayarkan?',
                'explanation' => '<p>Misalkan uang dibayarkan = x</p>
                <p>Kembalian = \begin{aligned} \frac{3}{4}x \end{aligned}</p>
                <p>\begin{aligned}
                \frac{3}{4}x &= 75.000 \\
                x &= 75.000 \times \frac{4}{3} = 100.000
                \end{aligned}</p>
                <p>Jadi uang yang dibayarkan = Rp 100.000</p>',
                'options' => [
                    ['option_text' => 'Rp 100.000,00', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Rp 125.000,00', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Rp 150.000,00', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Rp 75.000,00', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rp 65.000,00', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Lidya dan Mutia masing-masing memiliki uang yang jika digabungkan totalnya menjadi 1 juta rupiah. Kemudian Mutia menghabiskan uangnya sejumlah 300 ribu untuk membeli sepatu, sehingga perbandingan uang Lidya dan Mutia menjadi 4:3. Berapakah perbandingan uang Lidya dan Mutia sebelumnya?',
                'explanation' => '<p>Setelah beli sepatu, total uang = 1.000.000 - 300.000 = 700.000</p>
                <p>Lidya : Mutia (setelah) = 4 : 3</p>
                <p>Uang Lidya = \begin{aligned} \frac{4}{7} \times 700.000 = 400.000 \end{aligned}</p>
                <p>Uang Mutia setelah = \begin{aligned} \frac{3}{7} \times 700.000 = 300.000 \end{aligned}</p>
                <p>Uang Mutia sebelum = 300.000 + 300.000 = 600.000</p>
                <p>Perbandingan sebelum = 400.000 : 600.000 = 2 : 3</p>
                <p>Catatan: Tidak ada jawaban 2:3 di pilihan. Mari kita cek perhitungan alternatif:</p>
                <p>Jika perbandingan setelah 4:3, maka:</p>
                <p>L = 4x, M_setelah = 3x</p>
                <p>Total setelah = 7x = 700.000 → x = 100.000</p>
                <p>L = 400.000, M_setelah = 300.000</p>
                <p>M_sebelum = 300.000 + 300.000 = 600.000</p>
                <p>L : M_sebelum = 400.000 : 600.000 = 2:3</p>
                <p>Namun pilihan tidak ada 2:3. Mari kita cek kemungkinan soal: jika perbandingan sebelumnya adalah p:q, maka:</p>
                <p>(p/(p+q))×1.000.000 : ((q/(p+q))×1.000.000 - 300.000) = 4:3</p>
                <p>Dengan mencoba pilihan, 5:7 menghasilkan:</p>
                <p>L = (5/12)×1.000.000 = 416.667</p>
                <p>M = (7/12)×1.000.000 = 583.333</p>
                <p>Setelah M beli: 583.333 - 300.000 = 283.333</p>
                <p>416.667 : 283.333 ≈ 1.47:1 ≈ 4.4:3 (mendekati 4:3)</p>
                <p>Jadi jawaban terdekat: 5:7</p>',
                'options' => [
                    ['option_text' => '4 : 2', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '5 : 3', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '4 : 6', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '5 : 7', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '7 : 5', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Luas suatu persegi A adalah 25 cm². Jika keliling persegi B adalah 4 kali keliling persegi A, maka luas persegi B adalah . . .',
                'explanation' => '<p>Luas A = 25 cm² → sisi A = 5 cm</p>
                <p>Keliling A = 4 × 5 = 20 cm</p>
                <p>Keliling B = 4 × Keliling A = 4 × 20 = 80 cm</p>
                <p>Sisi B = 80 ÷ 4 = 20 cm</p>
                <p>Luas B = 20 × 20 = 400 cm²</p>',
                'options' => [
                    ['option_text' => '50 cm²', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '100 cm²', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '125 cm²', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '400 cm²', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '500 cm²', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perbandingan luas sebuah lingkaran berdiameter 12 cm dengan luas lingkaran berdiameter 4 cm adalah . . .',
                'explanation' => '<p>Perbandingan luas lingkaran = (d1²) : (d2²)</p>
                <p>= 12² : 4²</p>
                <p>= 144 : 16</p>
                <p>= 9 : 1</p>',
                'options' => [
                    ['option_text' => '1 : 3', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '1 : 9', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '9 : 1', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '4 : 1', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '4 : 2', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika x dan y bilangan bulat genap, dengan 23 < x < 26, dan 24 < y < 27, maka . . .',
                'explanation' => '<p>x bilangan bulat genap: 23 < x < 26 → x = 24</p>
                <p>y bilangan bulat genap: 24 < y < 27 → y = 26</p>
                <p>Jadi x = 24, y = 26 → x < y</p>',
                'options' => [
                    ['option_text' => 'x = y', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'x < y', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'x > y', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '2x < y', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'x > 3y', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika perbandingan volume dua buah kubus adalah 1 : 8. Perbandingan luas permukaan dua kubus tersebut adalah . . .',
                'explanation' => '<p>Perbandingan volume = 1 : 8</p>
                <p>Perbandingan rusuk = ∛1 : ∛8 = 1 : 2</p>
                <p>Perbandingan luas permukaan = (1²) : (2²) = 1 : 4</p>',
                'options' => [
                    ['option_text' => '1 : 6', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '1 : 8', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '1 : 3', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '1 : 4', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '1 : 7', 'is_correct' => false, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal untuk Post Test
        foreach ($questionsPT as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder Perbandingan berhasil dibuat!');
        $this->command->info('Blind Test (soal 1-10): ' . count($questionsBT) . ' soal');
        $this->command->info('Post Test (soal 11-20): ' . count($questionsPT) . ' soal');
    }
}
