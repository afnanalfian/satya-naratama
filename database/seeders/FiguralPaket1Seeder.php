<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiguralPaket1Seeder extends Seeder
{
    /**
     * Seeder Soal Figural Paket 1 (30 soal)
     *
     * - material_id : 36
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : general
     * - Komposisi   : 20% mudah, 40% sedang, 40% menantang
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 14;

        $questions = [
            // Soal 1 | Deret gambar | mudah | Kunci: B
            [
                'no' => 1,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-01.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p><strong>Pola:</strong> panah berputar <strong>45° searah jarum jam</strong> pada setiap langkah.</p>
            <p>Arah panah: kiri bawah → kiri → kiri atas → atas → <strong>kanan atas</strong>.</p>
            <p>Gambar berikutnya adalah panah hitam yang mengarah ke <strong>kanan atas</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 2 | Deret gambar | sedang | Kunci: C
            [
                'no' => 2,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-02.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Ada <strong>dua pola</strong> yang berjalan bersamaan:</p>
            <ol>
            <li><strong>Arah panah</strong> berputar 45° searah jarum jam: kiri bawah → kiri → kiri atas → atas → <strong>kanan atas</strong>.</li>
            <li><strong>Lingkaran di pangkal panah</strong> berselang-seling: hitam → putih → hitam → putih → <strong>hitam</strong>.</li>
            </ol>
            <p>Gambar berikutnya: panah mengarah ke <strong>kanan atas</strong> dengan lingkaran <strong>hitam</strong> di pangkalnya.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 3 | Deret gambar | sedang | Kunci: C
            [
                'no' => 3,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-03.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Ada dua pola:</p>
            <ul>
            <li><strong>Jumlah bangun</strong> bertambah satu: 1 → 2 → 3 → 4 → <strong>5</strong>.</li>
            <li><strong>Jenis bangun</strong> berselang-seling: persegi → segitiga → persegi → segitiga → <strong>persegi</strong>.</li>
            </ul>
            <p>Gambar berikutnya berisi <strong>5 persegi hitam</strong>.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 4 | Deret gambar | menantang | Kunci: E
            [
                'no' => 4,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-04.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Beri nomor 0–7 pada delapan titik searah jarum jam. Ada dua pola yang berjalan bersamaan:</p>
            <ul>
            <li><strong>Titik hitam</strong> bergerak searah jarum jam dengan langkah yang <strong>bertambah</strong>: +1, +2, +3, sehingga langkah berikutnya <strong>+4</strong>.</li>
            <li><strong>Titik abu-abu</strong> bergerak <strong>1 posisi berlawanan arah jarum jam</strong> setiap langkah.</li>
            </ul>
            <p>Pada gambar kelima, titik hitam maju 4 posisi dari gambar keempat, dan titik abu-abu mundur 1 posisi dari gambar keempat.</p>
            <p><strong>Jebakan:</strong> opsi yang memindahkan titik hitam hanya 3 posisi menganggap langkahnya tetap, padahal langkahnya bertambah.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 5 | Deret gambar | menantang | Kunci: A
            [
                'no' => 5,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk menggantikan tanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-05.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Deret gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Perhatikan hanya kotak-kotak di <strong>pinggir</strong> grid 3×3. Ada dua pola:</p>
            <ul>
            <li><strong>Kotak hitam</strong> bergerak <strong>1 langkah searah jarum jam</strong>: kiri bawah → kiri tengah → kiri atas → tengah atas → <strong>kanan atas</strong>.</li>
            <li><strong>Kotak arsir</strong> bergerak <strong>2 langkah berlawanan arah jarum jam</strong>: tengah bawah → kanan tengah → tengah atas → kiri tengah → <strong>tengah bawah</strong>.</li>
            </ul>
            <p>Gambar berikutnya: kotak hitam di <strong>kanan atas</strong> dan kotak arsir di <strong>tengah bawah</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 6 | Analogi gambar | mudah | Kunci: D
            [
                'no' => 6,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-36-06.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p><strong>Hubungan:</strong> gambar kedua adalah gambar pertama yang <strong>diputar 180°</strong>. Semua unsur berpindah ke posisi seberangnya (kiri atas ↔ kanan bawah, atas ↔ bawah) dan arah setiap bangun ikut terbalik.</p>
            <p>Terapkan rotasi 180° pada gambar ketiga.</p>
            <p><strong>Jebakan:</strong> pencerminan (atas–bawah atau kiri–kanan) memindahkan posisi mirip rotasi 180°, tetapi arah bangun yang tidak simetris, seperti bendera dan panah, menjadi berbeda.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 7 | Analogi gambar | sedang | Kunci: D
            [
                'no' => 7,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-36-07.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p><strong>Hubungan:</strong> bangun luar dan bangun dalam <strong>bertukar tempat</strong>. Bangun luar selalu putih, sedangkan bangun dalam tetap memakai corak yang sama.</p>
            <p>Gambar ketiga: persegi besar berisi segi lima kecil bercorak arsir. Hasilnya: <strong>segi lima besar berisi persegi kecil bercorak arsir</strong>.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 8 | Analogi gambar | sedang | Kunci: E
            [
                'no' => 8,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-36-08.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p><strong>Hubungan:</strong> gambar kedua adalah <strong>pencerminan kiri–kanan</strong> (terhadap garis tegak) dari gambar pertama. Unsur di kiri pindah ke kanan dan sebaliknya, posisi atas–bawah tetap, dan arah bangun ikut tercermin.</p>
            <p>Terapkan pencerminan kiri–kanan pada gambar ketiga.</p>
            <p><strong>Jebakan:</strong> rotasi 180° juga memindahkan unsur ke kanan, tetapi sekaligus membaliknya ke bawah.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 9 | Analogi gambar | menantang | Kunci: D
            [
                'no' => 9,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-36-09.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p><strong>Hubungan:</strong> ada dua perubahan sekaligus dari gambar pertama ke gambar kedua:</p>
            <ol>
            <li>seluruh gambar <strong>diputar 90° searah jarum jam</strong>;</li>
            <li>warna setiap bangun <strong>dibalik</strong> (hitam ↔ putih).</li>
            </ol>
            <p>Terapkan keduanya pada gambar ketiga. Opsi pengecoh hanya menerapkan salah satu perubahan, atau memutar ke arah yang salah.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 10 | Analogi gambar | menantang | Kunci: B
            [
                'no' => 10,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural-general/fig-36-10.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Analogi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p><strong>Hubungan:</strong> jumlah <strong>sisi bangun</strong> dan jumlah <strong>titik</strong> di dalamnya <strong>bertukar</strong>.</p>
            <p>Gambar pertama: segitiga (3 sisi) berisi 5 titik → gambar kedua: segi lima (5 sisi) berisi 3 titik.</p>
            <p>Gambar ketiga: segi enam (6 sisi) berisi 4 titik → jawabannya <strong>persegi (4 sisi) berisi 6 titik</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 11 | Klasifikasi gambar | mudah | Kunci: E
            [
                'no' => 11,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-36-11.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Perhatikan <strong>jumlah bangun</strong> pada setiap gambar. Jenis dan corak bangunnya beragam, sehingga keduanya bukan petunjuk.</p>
            <p>Empat gambar masing-masing berisi <strong>3 bangun</strong>, sedangkan satu gambar berisi <strong>4 bangun</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 12 | Klasifikasi gambar | sedang | Kunci: D
            [
                'no' => 12,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-36-12.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Semua gambar tampak berupa huruf F dengan sebuah lingkaran kecil.</p>
            <p>Empat gambar adalah <strong>bangun yang sama yang diputar</strong> (0°, 90°, 180°, atau 270°). Satu gambar adalah <strong>bayangan cermin</strong> dari bangun tersebut. Bayangan cermin tidak bisa diperoleh dengan memutar gambar.</p>
            <p><strong>Cara cek:</strong> putar setiap gambar dalam pikiran sampai batang F tegak di kiri. Jika lengan F mengarah ke kiri, gambar itu adalah hasil pencerminan.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 13 | Klasifikasi gambar | sedang | Kunci: E
            [
                'no' => 13,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-36-13.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pada empat gambar, <strong>jumlah titik di dalam bangun sama dengan jumlah sisi bangun</strong>: segitiga berisi 3 titik, persegi 4 titik, dan seterusnya.</p>
            <p>Gambar yang berbeda adalah segi enam (6 sisi) yang berisi <strong>5 titik</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 14 | Klasifikasi gambar | menantang | Kunci: E
            [
                'no' => 14,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-36-14.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setiap gambar terdiri atas jari-jari dengan ujung bertanda (bulatan putih, bulatan hitam, atau tanpa tanda).</p>
            <p>Empat gambar adalah <strong>bangun yang sama yang diputar</strong> dengan sudut berbeda. Urutan tanda di ujung jari-jari, jika ditelusuri searah jarum jam, selalu sama.</p>
            <p>Gambar yang berbeda adalah <strong>bayangan cermin</strong>: jika ditelusuri searah jarum jam, urutan tandanya terbalik. Gambar ini tidak bisa diperoleh dengan memutar.</p>
            <p><strong>Cara cek:</strong> pilih satu jari-jari yang khas (misalnya berbulatan hitam), lalu baca tanda pada jari-jari berikutnya searah jarum jam di setiap gambar.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 15 | Klasifikasi gambar | menantang | Kunci: C
            [
                'no' => 15,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan pola. Gambar manakah yang <strong>berbeda</strong> dari yang lain?</p>',
                'image' => 'soal-figural-general/fig-36-15.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Klasifikasi gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Jumlahkan sisi bangun luar dan bangun dalam pada setiap gambar.</p>
            <p>Pada empat gambar, jumlahnya selalu <strong>9</strong>: segitiga + segi enam (3 + 6), persegi + segi lima (4 + 5), segi lima + persegi (5 + 4), dan segi enam + segitiga (6 + 3).</p>
            <p>Gambar yang berbeda adalah segi enam berisi persegi, yang jumlah sisinya <strong>10</strong>.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 16 | Rotasi dan pencerminan | mudah | Kunci: B
            [
                'no' => 16,
                'question_text' => '<p>Gambar di sebelah kiri diputar 180°. Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-36-16.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Pada <strong>rotasi 180°</strong>, setiap unsur berpindah ke posisi seberangnya terhadap titik pusat: kiri atas ↔ kanan bawah, atas ↔ bawah, dan kiri ↔ kanan. Arah setiap bangun ikut terbalik.</p>
            <p>Pilih gambar yang posisi <em>dan</em> arah unsur-unsurnya sesuai. Pencerminan atas–bawah atau kiri–kanan hanya membalik satu arah.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 17 | Rotasi dan pencerminan | sedang | Kunci: D
            [
                'no' => 17,
                'question_text' => '<p>Gambar di sebelah kiri diputar 90° searah jarum jam. Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-36-17.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pada <strong>rotasi 90° searah jarum jam</strong>:</p>
            <ul>
            <li>unsur di <strong>kiri atas</strong> pindah ke <strong>kanan atas</strong>, kanan atas → kanan bawah, kanan bawah → kiri bawah, kiri bawah → kiri atas;</li>
            <li>unsur di tengah sisi atas pindah ke tengah sisi kanan, dan seterusnya;</li>
            <li>arah setiap bangun (panah, bendera, segitiga) juga ikut berputar 90° searah jarum jam.</li>
            </ul>
            <p>Opsi pengecoh berupa rotasi berlawanan arah jarum jam, rotasi 180°, atau pencerminan.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 18 | Rotasi dan pencerminan | sedang | Kunci: D
            [
                'no' => 18,
                'question_text' => '<p>Gambar di sebelah kiri diputar 90° berlawanan arah jarum jam. Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-36-18.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pada <strong>rotasi 90° berlawanan arah jarum jam</strong>:</p>
            <ul>
            <li>unsur di <strong>kanan atas</strong> pindah ke <strong>kiri atas</strong>, kiri atas → kiri bawah, kiri bawah → kanan bawah, kanan bawah → kanan atas;</li>
            <li>arah setiap bangun ikut berputar 90° berlawanan arah jarum jam (yang menghadap atas menjadi menghadap kiri).</li>
            </ul>
            <p><strong>Jebakan:</strong> rotasi searah jarum jam menghasilkan posisi yang berseberangan dengan jawaban yang benar.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 19 | Rotasi dan pencerminan | menantang | Kunci: C
            [
                'no' => 19,
                'question_text' => '<p>Gambar di sebelah kiri diputar 90° searah jarum jam, kemudian hasilnya dicerminkan terhadap cermin tegak (kiri ↔ kanan). Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-36-19.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Kerjakan secara <strong>berurutan</strong>:</p>
            <ol>
            <li>Putar gambar <strong>90° searah jarum jam</strong>: kiri atas → kanan atas → kanan bawah → kiri bawah.</li>
            <li>Cerminkan hasilnya terhadap cermin tegak, sehingga kiri dan kanan bertukar.</li>
            </ol>
            <p><strong>Catatan:</strong> urutan operasi penting. Mencerminkan dahulu lalu memutar 90° memberikan hasil yang berbeda, dan hasil itu juga disediakan sebagai pengecoh.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 20 | Rotasi dan pencerminan | menantang | Kunci: A
            [
                'no' => 20,
                'question_text' => '<p>Gambar di sebelah kiri diputar 90° searah jarum jam. Gambar manakah yang merupakan hasilnya?</p>',
                'image' => 'soal-figural-general/fig-36-20.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Rotasi dan pencerminan &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pada <strong>rotasi 90° searah jarum jam</strong>, setiap jari-jari berpindah 90° searah jarum jam beserta tanda di ujungnya: jari-jari yang mengarah ke atas menjadi mengarah ke kanan, yang mengarah ke kanan menjadi ke bawah, dan seterusnya.</p>
            <p><strong>Cara cek:</strong> ambil satu jari-jari yang khas (misalnya berbulatan hitam), tentukan posisi barunya, lalu cocokkan urutan tanda pada jari-jari lain searah jarum jam.</p>
            <p>Opsi pengecoh berupa putaran 45°, 135°, 270°, dan hasil pencerminan.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 21 | Matriks gambar | mudah | Kunci: A
            [
                'no' => 21,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-21.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Setiap <strong>baris</strong> berisi satu jenis bangun, dan <strong>jumlah bangun</strong> bertambah dari kiri ke kanan: 1, 2, 3.</p>
            <p>Baris ketiga berisi lingkaran, sehingga kotak terakhir berisi <strong>3 lingkaran</strong> bercorak arsir.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 22 | Matriks gambar | sedang | Kunci: B
            [
                'no' => 22,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-22.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Setiap <strong>baris</strong> dan setiap <strong>kolom</strong> berisi tepat satu dari tiap bentuk (lingkaran, bintang, belah ketupat) dan tepat satu dari tiap corak (hitam, putih, arsir).</p>
            <p>Pada baris ketiga, bentuk yang belum muncul adalah <strong>bintang</strong> dan corak yang belum muncul adalah <strong>arsir</strong>. Cek kolom ketiga: kombinasi ini juga belum muncul di sana.</p>
            <p>Jawaban: <strong>bintang arsir</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 23 | Matriks gambar | sedang | Kunci: C
            [
                'no' => 23,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-23.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pada setiap baris, panah <strong>berputar 90° searah jarum jam</strong> dari kolom ke kolom. Setiap baris memiliki corak sendiri.</p>
            <p>Baris ketiga dimulai dari arah kanan bawah → kiri bawah → <strong>kiri atas</strong>.</p>
            <p>Jawaban: panah bercorak <strong>putih</strong> yang mengarah ke <strong>kiri atas</strong>.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 24 | Matriks gambar | menantang | Kunci: C
            [
                'no' => 24,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-24.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pada setiap baris, gambar kolom 1 dan kolom 2 <strong>ditumpuk</strong> untuk menghasilkan kolom 3, dengan aturan: garis yang <strong>sama-sama ada</strong> di kedua gambar <strong>hilang</strong>, sedangkan garis yang hanya ada di salah satu gambar tetap muncul.</p>
            <p>Baris ketiga: garis yang sama pada kolom 1 dan 2 adalah <strong>diagonal /, garis mendatar atas</strong>, sehingga garis tersebut dihapus.</p>
            <p>Hasilnya hanya memuat: <strong>garis tegak</strong>.</p>
            <p><strong>Jebakan:</strong> opsi yang memuat semua garis adalah gabungan biasa, bukan aturan matriks ini.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 25 | Matriks gambar | menantang | Kunci: E
            [
                'no' => 25,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-25.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Matriks gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pada setiap baris, kolom 3 hanya memuat garis yang <strong>ada di kolom 1 dan juga ada di kolom 2</strong> (irisan). Garis yang hanya ada di salah satu kolom dihilangkan.</p>
            <p>Baris ketiga: garis yang sama-sama ada di kolom 1 dan 2 adalah <strong>diagonal /, garis mendatar tengah</strong>.</p>
            <p>Jawaban: kotak yang hanya berisi garis tersebut (di dalam bingkai persegi).</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 26 | Melengkapi pola gambar | mudah | Kunci: B
            [
                'no' => 26,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-26.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Pola berbentuk <strong>papan catur</strong>: kotak putih dan hitam selalu berselang-seling, baik secara mendatar maupun tegak. Tidak ada dua kotak bercorak sama yang bersebelahan.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>putih</strong>, kanan atas <strong>hitam</strong>, kiri bawah <strong>hitam</strong>, kanan bawah <strong>putih</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 27 | Melengkapi pola gambar | sedang | Kunci: A
            [
                'no' => 27,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-27.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pola ini <strong>simetris terhadap garis tengah tegak dan garis tengah mendatar</strong>. Setiap kuadran merupakan bayangan cermin kuadran di sebelahnya. Isi bagian yang hilang dengan mencerminkan kotak-kotak pasangannya dari sisi seberang garis tengah.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>arsir</strong>, kanan atas <strong>arsir</strong>, kiri bawah <strong>abu-abu</strong>, kanan bawah <strong>abu-abu</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 28 | Melengkapi pola gambar | sedang | Kunci: A
            [
                'no' => 28,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-28.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pola terbentuk dari <strong>satu ubin berukuran 3×3 kotak yang diulang</strong> ke kanan dan ke bawah. Kotak di baris ke-r dan kolom ke-c memiliki corak yang sama dengan kotak tiga baris atau tiga kolom darinya. Gunakan pengulangan ini untuk menentukan bagian yang hilang.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>putih</strong>, kanan atas <strong>arsir</strong>, kiri bawah <strong>hitam</strong>, kanan bawah <strong>hitam</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 29 | Melengkapi pola gambar | menantang | Kunci: B
            [
                'no' => 29,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-29.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => true],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pola ini memiliki <strong>simetri putar 90°</strong>: jika seluruh gambar diputar seperempat putaran terhadap titik tengah, polanya tetap sama. Kuadran kanan atas adalah kuadran kiri atas yang diputar 90° searah jarum jam, dan seterusnya.</p>
            <p><strong>Jebakan:</strong> pola ini <em>bukan</em> simetri cermin. Mencerminkan kuadran sebelahnya akan menghasilkan potongan yang salah, dan potongan itu juga disediakan sebagai pengecoh.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>putih</strong>, kanan atas <strong>putih</strong>, kiri bawah <strong>arsir</strong>, kanan bawah <strong>putih</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 30 | Melengkapi pola gambar | menantang | Kunci: A
            [
                'no' => 30,
                'question_text' => '<p>Perhatikan pola gambar berikut. Potongan gambar manakah yang tepat untuk mengisi bagian bertanda tanya?</p>',
                'image' => 'soal-figural-general/fig-36-30.png',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Melengkapi pola gambar &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pola ini <strong>simetris terhadap garis tengah tegak dan mendatar</strong>, dan setiap kotak memiliki dua atribut: <strong>bentuk</strong> dan <strong>warna</strong>. Pasangan cermin setiap kotak harus sama bentuk <em>dan</em> warnanya.</p>
            <p>Isi bagian yang hilang: kiri atas <strong>segitiga putih</strong>, kanan atas <strong>bintang putih</strong>, kiri bawah <strong>bintang hitam</strong>, kanan bawah <strong>persegi hitam</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
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

        $this->command->info('Seeder Soal Figural Paket 1 (30 soal) berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
