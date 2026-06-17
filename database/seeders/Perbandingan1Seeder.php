<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class Perbandingan1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Soal 1-10 dengan material_id = 60
        $material1 = QuestionMaterial::firstOrCreate(
            ['id' => 43]
        );

        // Soal 11-20 dengan material_id = 61
        $material2 = QuestionMaterial::firstOrCreate(
            ['id' => 44],
        );

        // Soal 1-10
        $questions1 = [
            // Soal 1
            [
                'material_id' => $material1->id,
                'question_text' => 'Kue dalam kaleng dibagikan kepada 6 orang anak, masing-masing mendapat 30 kue dan tidak tersisa. Bila kue tersebut dibagikan kepada 10 orang anak, masing-masing akan mendapat kue sebanyak....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Banyak kue = 6 × 30 = 180 kue</p>
                <p>Jika dibagikan kepada 10 anak:</p>
                <p>\\(\\frac{180}{10} = 18\\) kue per anak</p>
                <p><strong>Kunci Jawaban: D. 18</strong></p>',
                'options' => [
                    ['text' => '50', 'correct' => false],
                    ['text' => '36', 'correct' => false],
                    ['text' => '20', 'correct' => false],
                    ['text' => '18', 'correct' => true],
                    ['text' => '10', 'correct' => false],
                ]
            ],
            // Soal 2
            [
                'material_id' => $material1->id,
                'question_text' => 'Seorang tukang jahit mendapat pesanan menjahit kaos untuk keperluan kampanye. Ia hanya mampu menjahit 60 potong dalam 3 hari. Bila ia bekerja selama 2 minggu, berapa potong kaos yang dapat ia kerjakan?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>2 minggu = 14 hari</p>
                <p>Kecepatan menjahit = \\(\\frac{60}{3} = 20\\) potong/hari</p>
                <p>Dalam 14 hari = \\(20 \\times 14 = 280\\) potong</p>
                <p><strong>Kunci Jawaban: D. 280 potong</strong></p>',
                'options' => [
                    ['text' => '80 potong', 'correct' => false],
                    ['text' => '120 potong', 'correct' => false],
                    ['text' => '180 potong', 'correct' => false],
                    ['text' => '280 potong', 'correct' => true],
                    ['text' => '300 potong', 'correct' => false],
                ]
            ],
            // Soal 3
            [
                'material_id' => $material1->id,
                'question_text' => 'Untuk membuat 60 pasang pakaian, seorang penjahit memerlukan waktu selama 18 hari. Jika penjahit tersebut bekerja selama 24 hari, berapa pasang pakaian yang dapat dibuat?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan senilai:</p>
                <p>\\(\\frac{60}{18} = \\frac{x}{24}\\)</p>
                <p>\\(x = \\frac{60 \\times 24}{18} = \\frac{1440}{18} = 80\\) pasang</p>
                <p><strong>Kunci Jawaban: C. 80 pasang</strong></p>',
                'options' => [
                    ['text' => '40 pasang', 'correct' => false],
                    ['text' => '75 pasang', 'correct' => false],
                    ['text' => '80 pasang', 'correct' => true],
                    ['text' => '90 pasang', 'correct' => false],
                    ['text' => '95 pasang', 'correct' => false],
                ]
            ],
            // Soal 4
            [
                'material_id' => $material1->id,
                'question_text' => 'Sebungkus coklat akan dibagikan kepada 24 anak, setiap anak mendapat 8 coklat. Jika coklat itu dibagikan kepada 16 anak, maka banyak coklat yang diperoleh setiap anak adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Total coklat = \\(24 \\times 8 = 192\\) coklat</p>
                <p>Dibagikan ke 16 anak:</p>
                <p>\\(\\frac{192}{16} = 12\\) coklat per anak</p>
                <p><strong>Kunci Jawaban: B. 12 coklat</strong></p>',
                'options' => [
                    ['text' => '8 coklat', 'correct' => false],
                    ['text' => '12 coklat', 'correct' => true],
                    ['text' => '16 coklat', 'correct' => false],
                    ['text' => '48 coklat', 'correct' => false],
                    ['text' => '50 coklat', 'correct' => false],
                ]
            ],
            // Soal 5
            [
                'material_id' => $material1->id,
                'question_text' => 'Sebuah mobil yang melaju sejauh 144 km memerlukan 12,8 liter premix. Jika di dalam tangki terdapat 8 L premix, maka jarak yang dapat ditempuh mobil tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan senilai:</p>
                <p>\\(\\frac{144}{12,8} = \\frac{x}{8}\\)</p>
                <p>\\(x = \\frac{144 \\times 8}{12,8} = \\frac{1152}{12,8} = 90\\) km</p>
                <p><strong>Kunci Jawaban: D. 90 km</strong></p>',
                'options' => [
                    ['text' => '230,4 km', 'correct' => false],
                    ['text' => '115,2 km', 'correct' => false],
                    ['text' => '96 km', 'correct' => false],
                    ['text' => '90 km', 'correct' => true],
                    ['text' => '85 km', 'correct' => false],
                ]
            ],
            // Soal 6
            [
                'material_id' => $material1->id,
                'question_text' => 'Sebuah bangunan dikerjakan dalam 32 hari oleh 25 orang pekerja. Agar pekerjaan tersebut dapat diselesaikan dalam 20 hari, banyak pekerja yang diperlukan adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan berbalik nilai:</p>
                <p>\\(32 \\times 25 = 20 \\times x\\)</p>
                <p>\\(800 = 20x\\)</p>
                <p>\\(x = \\frac{800}{20} = 40\\) orang</p>
                <p><strong>Kunci Jawaban: B. 40 orang</strong></p>',
                'options' => [
                    ['text' => '15 orang', 'correct' => false],
                    ['text' => '40 orang', 'correct' => true],
                    ['text' => '50 orang', 'correct' => false],
                    ['text' => '60 orang', 'correct' => false],
                ]
            ],
            // Soal 7
            [
                'material_id' => $material1->id,
                'question_text' => 'Jarak dua kota pada peta adalah 20 cm. Jika skala peta 1 : 600.000, jarak dua kota sebenarnya adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Jarak sebenarnya = \\(20 \\times 600.000 = 12.000.000\\) cm</p>
                <p>\\(12.000.000\\) cm = \\(\\frac{12.000.000}{100.000} = 120\\) km</p>
                <p><strong>Kunci Jawaban: B. 120 km</strong></p>',
                'options' => [
                    ['text' => '1.200 km', 'correct' => false],
                    ['text' => '120 km', 'correct' => true],
                    ['text' => '30 km', 'correct' => false],
                    ['text' => '12 km', 'correct' => false],
                    ['text' => '10 km', 'correct' => false],
                ]
            ],
            // Soal 8
            [
                'material_id' => $material1->id,
                'question_text' => 'Sebuah panti asuhan memiliki persediaan beras yang cukup untuk 20 orang selama 15 hari. Jika penghuni panti asuhan bertambah 5 orang, persediaan beras akan habis dalam waktu....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan berbalik nilai:</p>
                <p>\\(20 \\times 15 = 25 \\times x\\)</p>
                <p>\\(300 = 25x\\)</p>
                <p>\\(x = \\frac{300}{25} = 12\\) hari</p>
                <p><strong>Kunci Jawaban: C. 12 hari</strong></p>',
                'options' => [
                    ['text' => '8 hari', 'correct' => false],
                    ['text' => '10 hari', 'correct' => false],
                    ['text' => '12 hari', 'correct' => true],
                    ['text' => '20 hari', 'correct' => false],
                    ['text' => '23 hari', 'correct' => false],
                ]
            ],
            // Soal 9
            [
                'material_id' => $material1->id,
                'question_text' => 'Untuk menyelesaikan suatu pekerjaan selama 72 hari diperlukan pekerja sebanyak 24 orang. Setelah dikerjakan 30 hari, pekerjaan dihentikan selama 6 hari. Jika kemampuan bekerja setiap orang sama dan agar pekerjaan tersebut selesai sesuai jadwal semula, maka banyak pekerja tambahan yang diperlukan adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Total volume pekerjaan = \\(72 \\times 24 = 1.728\\)</p>
                <p>Pekerjaan 30 hari = \\(30 \\times 24 = 720\\)</p>
                <p>Sisa pekerjaan = \\(1.728 - 720 = 1.008\\)</p>
                <p>Sisa waktu = \\(72 - 30 - 6 = 36\\) hari</p>
                <p>Pekerja yang dibutuhkan = \\(\\frac{1.008}{36} = 28\\) orang</p>
                <p>Tambahan pekerja = \\(28 - 24 = 4\\) orang</p>
                <p><strong>Kunci Jawaban: D. 4 orang</strong></p>',
                'options' => [
                    ['text' => '28 orang', 'correct' => false],
                    ['text' => '16 orang', 'correct' => false],
                    ['text' => '8 orang', 'correct' => false],
                    ['text' => '4 orang', 'correct' => true],
                    ['text' => '2 orang', 'correct' => false],
                ]
            ],
            // Soal 10
            [
                'material_id' => $material1->id,
                'question_text' => 'Pada denah dengan skala 1 : 200 terdapat gambar kebun berbentuk persegi panjang dengan ukuran 7 cm x 4,5 cm. Luas kebun sebenarnya adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Panjang sebenarnya = \\(7 \\times 200 = 1.400\\) cm = 14 m</p>
                <p>Lebar sebenarnya = \\(4,5 \\times 200 = 900\\) cm = 9 m</p>
                <p>Luas sebenarnya = \\(14 \\times 9 = 126 \\text{ m}^2\\)</p>
                <p><strong>Kunci Jawaban: C. 126 m²</strong></p>',
                'options' => [
                    ['text' => '58 m²', 'correct' => false],
                    ['text' => '63 m²', 'correct' => false],
                    ['text' => '126 m²', 'correct' => true],
                    ['text' => '140 m²', 'correct' => false],
                ]
            ],
        ];

        // Soal 11-20
        $questions2 = [
            // Soal 11
            [
                'material_id' => $material2->id,
                'question_text' => 'Pembangunan sebuah jembatan direncanakan selesai dalam waktu 132 hari oleh 72 pekerja. Sebelum pekerjaan dimulai ditambah 24 orang pekerja. Waktu untuk menyelesaikan pembangunan jembatan tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Total pekerja setelah ditambah = \\(72 + 24 = 96\\) orang</p>
                <p>Perbandingan berbalik nilai:</p>
                <p>\\(132 \\times 72 = x \\times 96\\)</p>
                <p>\\(9.504 = 96x\\)</p>
                <p>\\(x = \\frac{9.504}{96} = 99\\) hari</p>
                <p><strong>Kunci Jawaban: A. 99 hari</strong></p>',
                'options' => [
                    ['text' => '99 hari', 'correct' => true],
                    ['text' => '108 hari', 'correct' => false],
                    ['text' => '126 hari', 'correct' => false],
                ]
            ],
            // Soal 12
            [
                'material_id' => $material2->id,
                'question_text' => 'Perbandingan kelereng Egi dan Legi 3 : 2. Jika selisih kelereng mereka 8, jumlah kelereng Egi dan Legi adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Selisih perbandingan = \\(3 - 2 = 1\\)</p>
                <p>1 bagian = 8 kelereng</p>
                <p>Jumlah perbandingan = \\(3 + 2 = 5\\)</p>
                <p>Jumlah kelereng = \\(5 \\times 8 = 40\\)</p>
                <p><strong>Kunci Jawaban: A. 40</strong></p>',
                'options' => [
                    ['text' => '40', 'correct' => true],
                    ['text' => '32', 'correct' => false],
                    ['text' => '24', 'correct' => false],
                    ['text' => '16', 'correct' => false],
                    ['text' => '14', 'correct' => false],
                ]
            ],
            // Soal 13
            [
                'material_id' => $material2->id,
                'question_text' => 'Perbandingan uang Dian dan Rama 3 : 2. Jika jumlah uang Dian dan Rama Rp 40.000,00, selisih uang Dian dan Rama adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Jumlah perbandingan = \\(3 + 2 = 5\\)</p>
                <p>1 bagian = \\(\\frac{40.000}{5} = 8.000\\)</p>
                <p>Selisih perbandingan = \\(3 - 2 = 1\\)</p>
                <p>Selisih uang = \\(1 \\times 8.000 = Rp 8.000,00\\)</p>
                <p><strong>Kunci Jawaban: A. Rp 8.000,00</strong></p>',
                'options' => [
                    ['text' => 'Rp 8.000,00', 'correct' => true],
                    ['text' => 'Rp 16.000,00', 'correct' => false],
                    ['text' => 'Rp 24.000,00', 'correct' => false],
                    ['text' => 'Rp 32.000,00', 'correct' => false],
                    ['text' => 'Rp 35.000,00', 'correct' => false],
                ]
            ],
            // Soal 14
            [
                'material_id' => $material2->id,
                'question_text' => 'Sebuah mobil menempuh jarak dari kota A ke kota B dalam waktu 1,2 jam dengan kecepatan 80 km/jam. Agar jarak tersebut dapat ditempuh dalam waktu 60 menit maka kecepatan mobil yang harus dicapai adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>60 menit = 1 jam</p>
                <p>Jarak = \\(1,2 \\times 80 = 96\\) km</p>
                <p>Kecepatan = \\(\\frac{96}{1} = 96\\) km/jam</p>
                <p><strong>Kunci Jawaban: A. 96 km/jam</strong></p>',
                'options' => [
                    ['text' => '96 km/jam', 'correct' => true],
                    ['text' => '72 km/jam', 'correct' => false],
                    ['text' => '66 km/jam', 'correct' => false],
                    ['text' => '62 km/jam', 'correct' => false],
                    ['text' => '58 km/jam', 'correct' => false],
                ]
            ],
            // Soal 15
            [
                'material_id' => $material2->id,
                'question_text' => 'Perbandingan panjang dan lebar persegi panjang 7 : 4. Jika keliling persegi panjang tersebut 66 cm, maka luasnya adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Keliling = \\(2(p + l) = 66\\)</p>
                <p>\\(p + l = 33\\)</p>
                <p>Perbandingan p : l = 7 : 4 → jumlah = 11</p>
                <p>1 bagian = \\(\\frac{33}{11} = 3\\)</p>
                <p>p = \\(7 \\times 3 = 21\\) cm, l = \\(4 \\times 3 = 12\\) cm</p>
                <p>Luas = \\(21 \\times 12 = 252 \\text{ cm}^2\\)</p>
                <p><strong>Kunci Jawaban: D. 252 cm²</strong></p>',
                'options' => [
                    ['text' => '132 cm²', 'correct' => false],
                    ['text' => '198 cm²', 'correct' => false],
                    ['text' => '218 cm²', 'correct' => false],
                    ['text' => '252 cm²', 'correct' => true],
                    ['text' => '260 cm²', 'correct' => false],
                ]
            ],
            // Soal 16
            [
                'material_id' => $material2->id,
                'question_text' => 'Untuk membuat 9 loyang kue diperlukan 6 kg tepung terigu. Suatu toko ingin membuat 12 loyang kue. Banyak tepung terigu yang diperlukan adalah ....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan senilai:</p>
                <p>\\(\\frac{9}{6} = \\frac{12}{x}\\)</p>
                <p>\\(9x = 72\\)</p>
                <p>\\(x = 8\\) kg</p>
                <p><strong>Kunci Jawaban: B. 8 kg</strong></p>',
                'options' => [
                    ['text' => '4 kg', 'correct' => false],
                    ['text' => '8 kg', 'correct' => true],
                    ['text' => '9 kg', 'correct' => false],
                    ['text' => '12 kg', 'correct' => false],
                    ['text' => '15 kg', 'correct' => false],
                ]
            ],
            // Soal 17
            [
                'material_id' => $material2->id,
                'question_text' => 'Seekor ayam menghabiskan makanan konsentrat selama 120 hari, sedangkan seekor angsa mampu menghabiskan makanan konsentrat yang sama selama 24 hari. Berapa hari akan habis jika konsentrat tersebut dimakan oleh seekor ayam ditambah 3 ekor angsa?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Kecepatan ayam = \\(\\frac{1}{120}\\) per hari</p>
                <p>Kecepatan angsa = \\(\\frac{1}{24}\\) per hari</p>
                <p>Kecepatan total = \\(\\frac{1}{120} + \\frac{3}{24} = \\frac{1}{120} + \\frac{15}{120} = \\frac{16}{120} = \\frac{2}{15}\\)</p>
                <p>Waktu = \\(\\frac{1}{\\frac{2}{15}} = 7,5\\) hari</p>
                <p><strong>Kunci Jawaban: B. 7,5 hari</strong></p>',
                'options' => [
                    ['text' => '4 hari', 'correct' => false],
                    ['text' => '7,5 hari', 'correct' => true],
                    ['text' => '10 hari', 'correct' => false],
                    ['text' => '12,5 hari', 'correct' => false],
                    ['text' => '15 hari', 'correct' => false],
                ]
            ],
            // Soal 18
            [
                'material_id' => $material2->id,
                'question_text' => 'Sebuah ladang berisi tanaman rumput. Jika dimakan oleh 3 ekor kerbau habis dalam waktu 20 hari, sedangkan jika dimakan oleh 5 ekor kambing habis dalam waktu 40 hari. Berapa hari rumput tersebut akan habis dimakan oleh 2 ekor kerbau dan 2 ekor kambing?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Kecepatan 1 kerbau = \\(\\frac{1}{3 \\times 20} = \\frac{1}{60}\\) per hari</p>
                <p>Kecepatan 1 kambing = \\(\\frac{1}{5 \\times 40} = \\frac{1}{200}\\) per hari</p>
                <p>2 kerbau + 2 kambing = \\(\\frac{2}{60} + \\frac{2}{200} = \\frac{1}{30} + \\frac{1}{100} = \\frac{10}{300} + \\frac{3}{300} = \\frac{13}{300}\\)</p>
                <p>Waktu = \\(\\frac{300}{13} \\approx 23,07 \\approx 23\\) hari</p>
                <p><strong>Kunci Jawaban: C. 23 hari</strong></p>',
                'options' => [
                    ['text' => '15 hari', 'correct' => false],
                    ['text' => '18 hari', 'correct' => false],
                    ['text' => '23 hari', 'correct' => true],
                    ['text' => '25 hari', 'correct' => false],
                    ['text' => '27 hari', 'correct' => false],
                ]
            ],
            // Soal 19
            [
                'material_id' => $material2->id,
                'question_text' => 'Jika 6 orang pria beserta 8 orang anak laki-laki bisa melakukan pekerjaan dalam 10 hari, sementara 26 pria serta 48 anak dapat melakukan pekerjaan yang sama dalam 2 hari, waktu yang diperlukan 15 pria dengan 20 anak dalam melakukan pekerjaan sama adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Misal: p = kecepatan 1 pria/hari, a = kecepatan 1 anak/hari</p>
                <p>\\(6p + 8a = \\frac{1}{10} \\rightarrow 60p + 80a = 1\\) ...(1)</p>
                <p>\\(26p + 48a = \\frac{1}{2} \\rightarrow 52p + 96a = 1\\) ...(2)</p>
                <p>Eliminasi: (1) - (2): \\(8p - 16a = 0 \\rightarrow p = 2a\\)</p>
                <p>Substitusi: \\(60(2a) + 80a = 120a + 80a = 200a = 1 \\rightarrow a = \\frac{1}{200}, p = \\frac{1}{100}\\)</p>
                <p>15 pria + 20 anak = \\(\\frac{15}{100} + \\frac{20}{200} = \\frac{15}{100} + \\frac{10}{100} = \\frac{25}{100} = \\frac{1}{4}\\)</p>
                <p>Waktu = 4 hari</p>
                <p><strong>Kunci Jawaban: B. 4 hari</strong></p>',
                'options' => [
                    ['text' => '8 hari', 'correct' => false],
                    ['text' => '4 hari', 'correct' => true],
                    ['text' => '5 hari', 'correct' => false],
                    ['text' => '6 hari', 'correct' => false],
                    ['text' => '7 hari', 'correct' => false],
                ]
            ],
            // Soal 20
            [
                'material_id' => $material2->id,
                'question_text' => 'Suatu pekerjaan dikerjakan oleh 12 orang dan direncanakan selesai dalam waktu 25 hari. Oleh karena kehabisan bahan baku, pekerjaan terhenti saat memasuki hari ke-16 selama 2 hari. Agar pekerjaan selesai pada waktunya maka jumlah pekerja yang harus ditambah adalah',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Total pekerjaan = \\(25 \\times 12 = 300\\)</p>
                <p>Pekerjaan 15 hari = \\(15 \\times 12 = 180\\) (sampai hari ke-16? Perhatikan: hari ke-16 berarti sudah 15 hari penuh)</p>
                <p>Sisa pekerjaan = \\(300 - 180 = 120\\)</p>
                <p>Sisa waktu = \\(25 - 15 - 2 = 8\\) hari</p>
                <p>Pekerja yang dibutuhkan = \\(\\frac{120}{8} = 15\\) orang</p>
                <p>Tambahan pekerja = \\(15 - 12 = 3\\) orang</p>
                <p><strong>Kunci Jawaban: D. 3 orang</strong></p>',
                'options' => [
                    ['text' => '15 orang', 'correct' => false],
                    ['text' => '10 orang', 'correct' => false],
                    ['text' => '8 orang', 'correct' => false],
                    ['text' => '3 orang', 'correct' => true],
                    ['text' => '1 orang', 'correct' => false],
                ]
            ],
        ];

        // Simpan soal 1-10
        foreach ($questions1 as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $order = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['correct'],
                    'order' => $order,
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order++;
            }
        }

        // Simpan soal 11-20
        foreach ($questions2 as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $order = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['correct'],
                    'order' => $order,
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order++;
            }
        }

        $this->command->info('Seeder TIU Soal Perbandingan berhasil dibuat!');
        $this->command->info('Soal 1-10 (material_id = 60): ' . count($questions1) . ' soal');
        $this->command->info('Soal 11-20 (material_id = 61): ' . count($questions2) . ' soal');
    }
}