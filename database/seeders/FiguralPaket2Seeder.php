<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiguralPaket2Seeder extends Seeder
{
    /**
     * Seeder Soal Figural Paket 2 (30 soal)
     *
     * - material_id : 37
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : general
     * - Komposisi   : 20% mudah, 40% sedang, 40% menantang
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 37;

        $questions = [
            // Soal 1 | Deret gambar | mudah | Kunci: D
            [
                'no' => 1,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-01.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p><strong>Pola:</strong> jumlah sisi bangun bertambah <strong>satu</strong> pada setiap langkah, sedangkan coraknya tetap hitam.</p>
            <p>Segitiga (3) → persegi (4) → segi lima (5) → segi enam (6) → <strong>segi tujuh (7)</strong>.</p>
            <p>Gambar berikutnya adalah segi tujuh bercorak hitam. Hitung sisinya dengan teliti karena segi enam dan segi delapan juga muncul sebagai pengecoh.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 2 | Deret gambar | sedang | Kunci: A
            [
                'no' => 2,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-02.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Ada dua pola:</p>
            <ul>
            <li><strong>Titik hitam</strong> pada lingkaran berpindah <strong>2 posisi searah jarum jam</strong> setiap langkah. Setelah 4 langkah (8 posisi), titik hitam kembali ke <strong>posisi awal</strong> seperti gambar pertama.</li>
            <li><strong>Persegi di tengah</strong> berganti corak dengan siklus tiga: arsir → hitam → putih → arsir → <strong>hitam</strong>.</li>
            </ul>
            <p>Gambar berikutnya: titik hitam di posisi yang sama dengan gambar pertama dan persegi tengah bercorak <strong>hitam</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 3 | Deret gambar | sedang | Kunci: A
            [
                'no' => 3,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-03.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Ada dua pola:</p>
            <ul>
            <li><strong>Bangun luar</strong> berulang dengan siklus tiga: segitiga → lingkaran → persegi → segitiga → <strong>lingkaran</strong>.</li>
            <li><strong>Jumlah titik</strong> di dalamnya bertambah satu: 1 → 2 → 3 → 4 → <strong>5</strong>.</li>
            </ul>
            <p>Gambar berikutnya adalah <strong>lingkaran</strong> berisi <strong>5 titik</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 4 | Deret gambar | menantang | Kunci: D
            [
                'no' => 4,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-04.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Ada <strong>tiga pola</strong> sekaligus:</p>
            <ol>
            <li><strong>Arah</strong>: panah berputar 90° searah jarum jam. Setelah empat putaran (360°), panah kembali ke arah semula, yaitu <strong>atas</strong>.</li>
            <li><strong>Corak</strong> berulang dengan siklus tiga: putih → hitam → arsir → putih → <strong>hitam</strong>.</li>
            <li><strong>Ukuran</strong> berselang-seling: besar → kecil → besar → kecil → <strong>besar</strong>.</li>
            </ol>
            <p>Gambar berikutnya: panah <strong>besar</strong>, bercorak <strong>hitam</strong>, mengarah ke <strong>atas</strong>.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 5 | Deret gambar | menantang | Kunci: A
            [
                'no' => 5,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-05.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Gambar terdiri atas empat jari-jari yang saling tegak lurus dengan ujung bertanda (bulatan putih, bulatan hitam, atau tanpa tanda). Ada dua perubahan sekaligus:</p>
            <ul>
            <li><strong>Seluruh jari-jari</strong> berputar <strong>45° searah jarum jam</strong> setiap langkah.</li>
            <li><strong>Tanda di ujung</strong> bergeser <strong>satu jari-jari berlawanan arah jarum jam</strong> setiap langkah, relatif terhadap jari-jarinya.</li>
            </ul>
            <p>Terapkan kedua perubahan pada gambar keempat untuk memperoleh gambar kelima. Opsi pengecoh hanya menerapkan salah satu perubahan, atau menggeser tanda ke arah yang salah.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 6 | Analogi gambar | mudah | Kunci: C
            [
                'no' => 6,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-37-06.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p><strong>Hubungan:</strong> bentuk tetap, tetapi <strong>warnanya dibalik</strong>: bagian hitam menjadi putih dan bagian putih menjadi hitam.</p>
            <p>Gambar ketiga: persegi putih berisi bintang hitam. Setelah warnanya dibalik menjadi <strong>persegi hitam berisi bintang putih</strong>.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 7 | Analogi gambar | sedang | Kunci: A
            [
                'no' => 7,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-37-07.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p><strong>Hubungan:</strong> dua perubahan terjadi sekaligus:</p>
            <ul>
            <li>jumlah sisi bertambah <strong>satu</strong>;</li>
            <li>warna <strong>dibalik</strong> (hitam ↔ putih).</li>
            </ul>
            <p>Gambar ketiga adalah segi enam (6 sisi) putih. Hasilnya: <strong>segi tujuh (7 sisi) hitam</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 8 | Analogi gambar | sedang | Kunci: A
            [
                'no' => 8,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-37-08.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p><strong>Hubungan:</strong> gambar kedua adalah gambar pertama yang <strong>diputar 90° searah jarum jam</strong>. Unsur di kiri atas pindah ke kanan atas, unsur di kanan atas pindah ke kanan bawah, dan seterusnya. Arah setiap bangun ikut berputar 90°.</p>
            <p>Terapkan putaran yang sama pada gambar ketiga.</p>
            <p><strong>Jebakan:</strong> putaran 90° berlawanan arah jarum jam (270°) menempatkan unsur di posisi seberangnya.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 9 | Analogi gambar | menantang | Kunci: C
            [
                'no' => 9,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-37-09.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p><strong>Hubungan:</strong> setiap bangun di pojok <strong>berpindah satu pojok searah jarum jam</strong> (kiri atas → kanan atas → kanan bawah → kiri bawah → kiri atas), dengan bentuk dan corak yang tetap. Pojok yang kosong juga ikut bergeser.</p>
            <p>Geser setiap bangun pada gambar ketiga satu pojok searah jarum jam.</p>
            <p><strong>Jebakan:</strong> salah satu opsi memindahkan bentuk ke pojok yang benar, tetapi coraknya tertinggal di posisi lama.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 10 | Analogi gambar | menantang | Kunci: C
            [
                'no' => 10,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-37-10.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p><strong>Hubungan:</strong> dua perubahan terjadi sekaligus:</p>
            <ol>
            <li>gambar <strong>dicerminkan kiri–kanan</strong>;</li>
            <li>corak setiap bangun berganti mengikuti siklus <strong>hitam → arsir → putih → hitam</strong>.</li>
            </ol>
            <p>Terapkan pencerminan dan pergantian corak tersebut pada gambar ketiga. Perhatikan arah siklus corak: hitam menjadi arsir, bukan putih.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 11 | Klasifikasi gambar | mudah | Kunci: B
            [
                'no' => 11,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-37-11.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Pada empat gambar, <strong>bangun kecil di dalam sama bentuknya dengan bangun besar</strong> di luarnya, misalnya lingkaran di dalam lingkaran.</p>
            <p>Gambar yang berbeda adalah persegi yang berisi bintang, karena bentuk dalam dan luarnya tidak sama.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 12 | Klasifikasi gambar | sedang | Kunci: B
            [
                'no' => 12,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-37-12.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pada empat gambar, <strong>panah di tengah selalu mengarah ke titik hitam</strong>, di mana pun letak titik hitam tersebut.</p>
            <p>Pada gambar yang berbeda, panah justru mengarah <strong>menjauhi</strong> titik hitam.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 13 | Klasifikasi gambar | sedang | Kunci: E
            [
                'no' => 13,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-37-13.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Hitung jumlah sisi setiap bangun. Pada empat gambar, <strong>semua bangun memiliki jumlah sisi genap</strong> (persegi atau belah ketupat 4, segi enam 6, segi delapan 8).</p>
            <p>Gambar yang berbeda memuat <strong>segitiga</strong> yang jumlah sisinya ganjil (3 sisi).</p>
            <p>Corak dan posisi bangun hanyalah pengecoh.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 14 | Klasifikasi gambar | menantang | Kunci: C
            [
                'no' => 14,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-37-14.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Perhatikan susunan kotak hitam pada setiap grid 3×3.</p>
            <p>Pada empat gambar, susunan kotak hitam <strong>simetris kiri–kanan</strong>: jika grid dilipat pada kolom tengah, kotak hitam di kolom kiri tepat menutupi kotak hitam di kolom kanan.</p>
            <p>Gambar yang berbeda <strong>tidak simetris</strong>, karena ada kotak hitam di satu sisi yang tidak memiliki pasangan di sisi lainnya.</p>
            <p>Jumlah kotak hitam bukan petunjuk, karena jumlahnya bervariasi pada semua gambar.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 15 | Klasifikasi gambar | menantang | Kunci: E
            [
                'no' => 15,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-37-15.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setiap gambar memiliki satu titik hitam dan satu titik abu-abu pada lingkaran berisi delapan titik.</p>
            <p>Pada empat gambar, titik abu-abu selalu berada <strong>3 posisi searah jarum jam</strong> dari titik hitam.</p>
            <p>Pada gambar yang berbeda, titik abu-abu berada 3 posisi <strong>berlawanan arah jarum jam</strong> dari titik hitam. Jaraknya sama, tetapi arahnya terbalik.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 16 | Rotasi dan pencerminan | mudah | Kunci: D
            [
                'no' => 16,
                'question_text' => '<p>Gambar di sebelah kiri dicerminkan terhadap cermin tegak (kiri ↔ kanan). Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-37-16.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Pencerminan terhadap cermin tegak menukar <strong>kiri dan kanan</strong>, sedangkan atas dan bawah tetap.</p>
            <p>Unsur di sisi kiri pindah ke sisi kanan dengan jarak yang sama dari cermin, dan bangun yang menghadap ke kanan menjadi menghadap ke kiri.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 17 | Rotasi dan pencerminan | sedang | Kunci: D
            [
                'no' => 17,
                'question_text' => '<p>Gambar di sebelah kiri dicerminkan terhadap cermin mendatar (atas ↕ bawah). Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-37-17.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Cermin mendatar diletakkan di bawah gambar, sehingga pencerminan menukar <strong>atas dan bawah</strong>, sedangkan kiri dan kanan tetap.</p>
            <ul>
            <li>unsur di kiri atas pindah ke kiri bawah, unsur di kanan bawah pindah ke kanan atas;</li>
            <li>bangun yang menghadap ke atas menjadi menghadap ke bawah, sedangkan yang menghadap ke kiri atau kanan tetap.</li>
            </ul>
            <p><strong>Jebakan:</strong> rotasi 180° juga menukar atas dan bawah, tetapi sekaligus menukar kiri dan kanan.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 18 | Rotasi dan pencerminan | sedang | Kunci: C
            [
                'no' => 18,
                'question_text' => '<p>Empat dari lima gambar di bawah dapat diperoleh dengan <strong>memutar</strong> gambar di sebelah kiri. Gambar manakah yang <strong>tidak</strong> dapat diperoleh dengan memutar?</p>',
                'image' => 'soal-figural-general/fig-37-18.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Empat opsi adalah gambar di sebelah kiri yang <strong>diputar</strong> (0°, 90°, 180°, atau 270°). Satu opsi adalah hasil <strong>pencerminan</strong>.</p>
            <p><strong>Cara cek:</strong> pilih dua unsur, misalnya bendera dan segitiga. Lihat apakah unsur kedua berada searah atau berlawanan arah jarum jam dari unsur pertama. Pada hasil rotasi, urutan ini selalu sama dengan gambar asli; pada hasil pencerminan, urutannya terbalik.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 19 | Rotasi dan pencerminan | menantang | Kunci: E
            [
                'no' => 19,
                'question_text' => '<p>Gambar di sebelah kiri dicerminkan terhadap cermin tegak (kiri ↔ kanan), kemudian hasilnya diputar 180°. Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-37-19.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Kerjakan secara berurutan:</p>
            <ol>
            <li>Cerminkan terhadap cermin tegak: kiri ↔ kanan.</li>
            <li>Putar hasilnya 180°: kiri ↔ kanan dan atas ↔ bawah.</li>
            </ol>
            <p>Pertukaran kiri–kanan terjadi dua kali sehingga saling meniadakan. Hasil akhirnya sama dengan <strong>pencerminan atas–bawah</strong> (terhadap cermin mendatar) dari gambar asli.</p>
            <p>Jadi, pilih gambar yang posisi kiri–kanannya sama dengan gambar asli, tetapi atas dan bawahnya terbalik.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 20 | Rotasi dan pencerminan | menantang | Kunci: B
            [
                'no' => 20,
                'question_text' => '<p>Gambar manakah yang merupakan hasil <strong>rotasi</strong> (pemutaran) dari gambar di sebelah kiri?</p>',
                'image' => 'soal-figural-general/fig-37-20.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Hanya satu opsi yang merupakan gambar asli yang <strong>diputar</strong>. Opsi lainnya adalah <strong>bayangan cermin</strong> yang kemudian diputar, sehingga sekilas tampak mirip.</p>
            <p><strong>Cara cek:</strong> pada gambar asli, telusuri jari-jari searah jarum jam mulai dari jari-jari berbulatan hitam, lalu catat urutan tanda dan sudut antarjari-jarinya. Hanya hasil rotasi yang memiliki urutan dan sudut yang sama.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 21 | Matriks gambar | mudah | Kunci: E
            [
                'no' => 21,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-21.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p><strong>Bentuk</strong> ditentukan oleh baris: setiap baris memiliki satu jenis bangun.</p>
            <p><strong>Corak</strong> ditentukan oleh kolom: kolom pertama hitam, kolom kedua putih, kolom ketiga arsir.</p>
            <p>Kotak yang hilang (baris 3, kolom 3) adalah <strong>segi lima arsir</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 22 | Matriks gambar | sedang | Kunci: B
            [
                'no' => 22,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-22.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Hitung jumlah bangun pada setiap kotak. Pada setiap baris berlaku: <strong>kolom 1 + kolom 2 = kolom 3</strong>.</p>
            <ul>
            <li>Baris 1: 2 + 4 = 6</li>
            <li>Baris 2: 2 + 3 = 5</li>
            <li>Baris 3: 3 + 1 = <strong>4</strong></li>
            </ul>
            <p>Jawaban: kotak berisi <strong>4 bangun hitam</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 23 | Matriks gambar | sedang | Kunci: B
            [
                'no' => 23,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-23.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p><strong>Bangun luar</strong> ditentukan oleh baris, sedangkan <strong>bangun dalam</strong> ditentukan oleh kolom.</p>
            <p>Baris ketiga bangun luarnya lingkaran, dan kolom ketiga bangun dalamnya segitiga.</p>
            <p>Jawaban: <strong>lingkaran berisi segitiga hitam</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 24 | Matriks gambar | menantang | Kunci: A
            [
                'no' => 24,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-24.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Ada <strong>tiga atribut</strong> yang masing-masing muncul tepat satu kali di setiap baris dan setiap kolom:</p>
            <ul>
            <li><strong>Bentuk</strong>: persegi, segitiga, bintang;</li>
            <li><strong>Corak</strong>: hitam, putih, arsir;</li>
            <li><strong>Posisi titik kecil</strong>: kanan bawah, kiri atas, kiri bawah.</li>
            </ul>
            <p>Cari atribut yang belum muncul pada baris ketiga dan kolom ketiga. Bentuk: <strong>segitiga</strong>; corak: <strong>putih</strong>; titik kecil di pojok <strong>kanan bawah</strong>.</p>
            <p>Opsi pengecoh hanya salah pada satu atribut, jadi periksa ketiganya.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 25 | Matriks gambar | menantang | Kunci: D
            [
                'no' => 25,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-25.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pada setiap baris, gambar <strong>berputar 90° searah jarum jam</strong> dari kolom ke kolom. Seluruh unsur berpindah posisi dan arahnya ikut berputar.</p>
            <p>Kolom ketiga adalah gambar kolom pertama yang diputar <strong>180°</strong>. Pada baris ketiga, putar gambar kolom pertama 180°, atau putar gambar kolom kedua 90° lagi.</p>
            <p><strong>Jebakan:</strong> pencerminan atas–bawah atau kiri–kanan bisa menghasilkan posisi yang mirip, tetapi arah bangunnya berbeda.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 26 | Melengkapi pola gambar | mudah | Kunci: E
            [
                'no' => 26,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-26.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Pola berupa <strong>garis-garis diagonal</strong>: setiap bergeser satu kotak ke kanan (atau ke bawah), corak berganti dengan urutan arsir → hitam → putih → arsir. Kotak-kotak pada diagonal yang sama (dari kanan atas ke kiri bawah) bercorak sama.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>putih</strong>, kanan atas <strong>arsir</strong>, kiri bawah <strong>arsir</strong>, kanan bawah <strong>hitam</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 27 | Melengkapi pola gambar | sedang | Kunci: D
            [
                'no' => 27,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-27.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pola berupa <strong>persegi-persegi bersarang (cincin)</strong>: cincin terluar bercorak hitam, cincin kedua putih, dan bagian tengah arsir. Tentukan cincin mana yang dilalui bagian yang hilang.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>putih</strong>, kanan atas <strong>hitam</strong>, kiri bawah <strong>hitam</strong>, kanan bawah <strong>hitam</strong>.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 28 | Melengkapi pola gambar | sedang | Kunci: C
            [
                'no' => 28,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-28.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pola ini <strong>simetris kiri–kanan</strong> terhadap garis tengah tegak. Setiap baris tampak sama jika dibaca dari kiri maupun dari kanan, sehingga kotak di kolom 1 sama dengan kolom 6, kolom 2 sama dengan kolom 5, dan kolom 3 sama dengan kolom 4. Isi bagian yang hilang dengan mencerminkan kotak pasangannya.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>arsir</strong>, kanan atas <strong>arsir</strong>, kiri bawah <strong>arsir</strong>, kanan bawah <strong>putih</strong>.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 29 | Melengkapi pola gambar | menantang | Kunci: E
            [
                'no' => 29,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-29.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pola ini mengikuti dua aturan yang berbeda arah:</p>
            <ul>
            <li><strong>Bentuk</strong>: bergeser satu kotak ke bawah, bentuk berganti lingkaran → persegi → segitiga; bergeser satu kotak ke kanan, bentuk maju dua langkah dalam urutan tersebut.</li>
            <li><strong>Corak</strong>: bergeser satu kotak ke kanan <em>maupun</em> ke bawah, corak maju satu langkah dalam urutan hitam → putih → arsir, sehingga corak yang sama membentuk garis diagonal.</li>
            </ul>
            <p>Cara praktis: setiap atribut berulang tiap tiga kotak, baik ke kanan maupun ke bawah. Salin bentuk dan corak dari kotak yang berjarak tiga kolom atau tiga baris.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>persegi putih</strong>, kanan atas <strong>lingkaran arsir</strong>, kiri bawah <strong>segitiga arsir</strong>, kanan bawah <strong>persegi hitam</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 30 | Melengkapi pola gambar | menantang | Kunci: B
            [
                'no' => 30,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-37-30.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pola ini <strong>simetris terhadap diagonal utama</strong> (garis dari pojok kiri atas ke pojok kanan bawah). Kotak di baris ke-r, kolom ke-c selalu sama dengan kotak di baris ke-c, kolom ke-r.</p>
            <p>Cari kotak-kotak pasangan dengan "menukar" nomor baris dan kolom, lalu salin coraknya. Perhatikan bahwa potongan yang hilang ikut "terbalik" (ditransposisi), sehingga hasilnya tidak sekadar salinan langsung.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>arsir</strong>, kanan atas <strong>abu-abu</strong>, kiri bawah <strong>abu-abu</strong>, kanan bawah <strong>putih</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
        ];

        DB::transaction(function () use ($questions, $materialId, $now) {
            foreach ($questions as $question) {
                $questionId = DB::table('questions')->insertGetId([
                    'material_id'   => $materialId,
                    'type'          => 'mcq',
                    'test_type'     => 'general',
                    'question_text' => $question['question_text'],
                    'image'         => $question['image'],
                    'explanation'   => $question['explanation'],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);

                foreach ($question['options'] as $order => $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'image'       => null,
                        'is_correct'  => $option['is_correct'],
                        'order'       => $order + 1,
                        'weight'      => 0,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            }
        });

        $this->command->info('Seeder Soal Figural Paket 2 (30 soal) berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
