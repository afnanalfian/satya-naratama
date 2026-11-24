<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarisanDeretPaket2Seeder extends Seeder
{
    /**
     * Seeder Barisan dan Deret Paket 2 (30 soal)
     *
     * - material_id : 39
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : general
     * - Komposisi   : 20% mudah, 40% sedang, 40% menantang
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 17;

        $questions = [
            // Soal 1 | Barisan dan Deret | mudah | Kunci: E
            [
                'no' => 1,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(101,\\ 91,\\ 81,\\ 71,\\ 61,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(41\\)', 'is_correct' => false],
                    ['text' => '\\(47\\)', 'is_correct' => false],
                    ['text' => '\\(49\\)', 'is_correct' => false],
                    ['text' => '\\(50\\)', 'is_correct' => false],
                    ['text' => '\\(51\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Setiap suku berkurang <strong>10</strong>.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(101\\)</td><td>\\(-10\\)</td></tr>
            <tr><td>\\(91\\)</td><td>\\(-10\\)</td></tr>
            <tr><td>\\(81\\)</td><td>\\(-10\\)</td></tr>
            <tr><td>\\(71\\)</td><td>\\(-10\\)</td></tr>
            <tr><td>\\(61\\)</td><td>\\(-10\\)</td></tr>
            </table><p>Suku berikutnya: \\(61-10=51\\).</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 2 | Barisan dan Deret | mudah | Kunci: C
            [
                'no' => 2,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(8,\\ 15,\\ 24,\\ 35,\\ 48,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(61\\)', 'is_correct' => false],
                    ['text' => '\\(62\\)', 'is_correct' => false],
                    ['text' => '\\(63\\)', 'is_correct' => true],
                    ['text' => '\\(64\\)', 'is_correct' => false],
                    ['text' => '\\(65\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Suku-sukunya merupakan <strong>bilangan kuadrat</strong> yang dikurangi 1, yaitu \\(n^{2}-1\\) untuk \\(n=3,4,5,\\dots\\).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>n</th><th>Suku</th></tr>
            <tr><td>\\(3\\)</td><td>\\(3^{2}-1=8\\)</td></tr>
            <tr><td>\\(4\\)</td><td>\\(4^{2}-1=15\\)</td></tr>
            <tr><td>\\(5\\)</td><td>\\(5^{2}-1=24\\)</td></tr>
            <tr><td>\\(6\\)</td><td>\\(6^{2}-1=35\\)</td></tr>
            <tr><td>\\(7\\)</td><td>\\(7^{2}-1=48\\)</td></tr>
            <tr><td>\\(8\\)</td><td>\\(8^{2}-1=63\\)</td></tr>
            </table><p>Suku berikutnya: <strong>63</strong>.</p><p><strong>Cara cek lain:</strong> selisih antarsuku adalah bilangan ganjil berurutan.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 3 | Barisan dan Deret | mudah | Kunci: E
            [
                'no' => 3,
                'question_text' => '<p>Diketahui barisan aritmetika \\(4,\\ 9,\\ 14,\\ 19,\\ \\dots\\). Suku ke-25 barisan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(100\\)', 'is_correct' => false],
                    ['text' => '\\(109\\)', 'is_correct' => false],
                    ['text' => '\\(114\\)', 'is_correct' => false],
                    ['text' => '\\(119\\)', 'is_correct' => false],
                    ['text' => '\\(124\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Suku pertama \\(a=4\\) dan beda \\(b=9-4=5\\).</p><p>Rumus suku ke-n barisan aritmetika: \\(U_{n}=a+\\left(n-1\\right)b\\)</p><p>\\(U_{25}=4+\\left(25-1\\right)\\times 5=4+120=124\\)</p><p><strong>Jebakan:</strong> jika menghitung \\(a+n\\times b\\) (lupa dikurangi 1), hasilnya 129.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 4 | Barisan dan Deret | mudah | Kunci: E
            [
                'no' => 4,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(8,\\ 25,\\ 10,\\ 21,\\ 12,\\ 17,\\ 14,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(9\\)', 'is_correct' => false],
                    ['text' => '\\(10\\)', 'is_correct' => false],
                    ['text' => '\\(11\\)', 'is_correct' => false],
                    ['text' => '\\(12\\)', 'is_correct' => false],
                    ['text' => '\\(13\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Deret ini terdiri atas <strong>dua deret yang berselang-seling</strong>:</p><ul>
            <li>Suku ganjil (ke-1, 3, 5, 7): 8, 10, 12, 14 → bertambah 2</li>
            <li>Suku genap (ke-2, 4, 6, 8): 25, 21, 17, ... → berkurang 4</li>
            </ul><p>Suku berikutnya adalah suku ke-8 (suku genap): \\(17-4=13\\).</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 5 | Barisan dan Deret | mudah | Kunci: D
            [
                'no' => 5,
                'question_text' => '<p>Jumlah 15 bilangan ganjil positif pertama, yaitu \\(1+3+5+\\dots\\), adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(207\\)', 'is_correct' => false],
                    ['text' => '\\(210\\)', 'is_correct' => false],
                    ['text' => '\\(216\\)', 'is_correct' => false],
                    ['text' => '\\(225\\)', 'is_correct' => true],
                    ['text' => '\\(240\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Bilangan ganjil membentuk barisan aritmetika dengan \\(a=1\\) dan \\(b=2\\).</p><p>Suku ke-15: \\(U_{15}=1+\\left(15-1\\right)\\times 2=29\\)</p><p>Jumlah: \\(S_{15}=\\frac{15}{2}\\left(1+29\\right)=\\frac{15}{2}\\times 30=225\\)</p><p><strong>Cara cepat:</strong> jumlah \\(n\\) bilangan ganjil pertama selalu \\(n^{2}\\), yaitu \\(15^{2}=225\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 6 | Barisan dan Deret | mudah | Kunci: A
            [
                'no' => 6,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>Z, X, V, T, R, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'P', 'is_correct' => true],
                    ['text' => 'Q', 'is_correct' => false],
                    ['text' => 'R', 'is_correct' => false],
                    ['text' => 'S', 'is_correct' => false],
                    ['text' => 'T', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Ubah huruf menjadi nomor urut alfabet: Z = 26, X = 24, V = 22, T = 20, R = 18.</p><p>Setiap huruf mundur <strong>2</strong> posisi. Huruf berikutnya: 18 − 2 = 16, yaitu <strong>P</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 7 | Barisan dan Deret | sedang | Kunci: B
            [
                'no' => 7,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(4,\\ 10,\\ 22,\\ 46,\\ 94,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(188\\)', 'is_correct' => false],
                    ['text' => '\\(190\\)', 'is_correct' => true],
                    ['text' => '\\(191\\)', 'is_correct' => false],
                    ['text' => '\\(192\\)', 'is_correct' => false],
                    ['text' => '\\(198\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Setiap suku <strong>dikalikan 2</strong> lalu <strong>ditambah 2</strong>.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(4\\)</td><td>\\(\\times 2+2\\)</td></tr>
            <tr><td>\\(10\\)</td><td>\\(\\times 2+2\\)</td></tr>
            <tr><td>\\(22\\)</td><td>\\(\\times 2+2\\)</td></tr>
            <tr><td>\\(46\\)</td><td>\\(\\times 2+2\\)</td></tr>
            <tr><td>\\(94\\)</td><td>\\(\\times 2+2\\)</td></tr>
            </table><p>Suku berikutnya: \\(94\\times 2+2=190\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 8 | Barisan dan Deret | sedang | Kunci: D
            [
                'no' => 8,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(1,\\ 3,\\ 4,\\ 7,\\ 11,\\ 18,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(25\\)', 'is_correct' => false],
                    ['text' => '\\(27\\)', 'is_correct' => false],
                    ['text' => '\\(28\\)', 'is_correct' => false],
                    ['text' => '\\(29\\)', 'is_correct' => true],
                    ['text' => '\\(30\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Setiap suku merupakan <strong>jumlah dua suku sebelumnya</strong> (pola Fibonacci):</p><p>\\(1+3=4\\)<br>\\(3+4=7\\)<br>\\(4+7=11\\)<br>\\(7+11=18\\)</p><p>Suku berikutnya: \\(11+18=29\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 9 | Barisan dan Deret | sedang | Kunci: E
            [
                'no' => 9,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(3,\\ 3,\\ 6,\\ 18,\\ 72,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(90\\)', 'is_correct' => false],
                    ['text' => '\\(288\\)', 'is_correct' => false],
                    ['text' => '\\(332\\)', 'is_correct' => false],
                    ['text' => '\\(346\\)', 'is_correct' => false],
                    ['text' => '\\(360\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Pengalinya bertambah satu setiap langkah: ×1, ×2, ×3, ×4, sehingga berikutnya <strong>×5</strong>.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(3\\)</td><td>\\(\\times 1\\)</td></tr>
            <tr><td>\\(3\\)</td><td>\\(\\times 2\\)</td></tr>
            <tr><td>\\(6\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(18\\)</td><td>\\(\\times 4\\)</td></tr>
            <tr><td>\\(72\\)</td><td>\\(\\times 5\\)</td></tr>
            </table><p>Suku berikutnya: \\(72\\times 5=360\\).</p><p><strong>Catatan:</strong> pola ini setara dengan \\(3\\times n!\\) (faktorial).</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 10 | Barisan dan Deret | sedang | Kunci: A
            [
                'no' => 10,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(17,\\ 21,\\ 23,\\ 27,\\ 29,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(33\\)', 'is_correct' => true],
                    ['text' => '\\(34\\)', 'is_correct' => false],
                    ['text' => '\\(35\\)', 'is_correct' => false],
                    ['text' => '\\(36\\)', 'is_correct' => false],
                    ['text' => '\\(37\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Kurangkan setiap suku dengan 10: 7, 11, 13, 17, 19. Hasilnya adalah <strong>bilangan prima berurutan</strong>.</p><p>Bilangan prima setelah 19 adalah 23, sehingga suku berikutnya \\(23+10=33\\).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 11 | Barisan dan Deret | sedang | Kunci: A
            [
                'no' => 11,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>C, Y, F, W, I, U, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'L', 'is_correct' => true],
                    ['text' => 'M', 'is_correct' => false],
                    ['text' => 'N', 'is_correct' => false],
                    ['text' => 'O', 'is_correct' => false],
                    ['text' => 'S', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Deret ini terdiri atas <strong>dua deret huruf berselang-seling</strong>:</p><ul>
            <li>Suku ganjil: C, F, I → maju 3 huruf</li>
            <li>Suku genap: Y, W, U → mundur 2 huruf (dari belakang alfabet)</li>
            </ul><p>Suku berikutnya adalah suku ke-7 (suku ganjil): I + 3 = <strong>L</strong>.</p><p><strong>Jebakan:</strong> S adalah lanjutan deret genap (suku ke-8).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 12 | Barisan dan Deret | sedang | Kunci: A
            [
                'no' => 12,
                'question_text' => '<p>Diketahui barisan geometri \\(5,\\ 10,\\ 20,\\ \\dots\\). Suku ke-8 barisan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(640\\)', 'is_correct' => true],
                    ['text' => '\\(645\\)', 'is_correct' => false],
                    ['text' => '\\(666\\)', 'is_correct' => false],
                    ['text' => '\\(692\\)', 'is_correct' => false],
                    ['text' => '\\(1280\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Suku pertama \\(a=5\\) dan rasio \\(r=\\frac{10}{5}=2\\).</p><p>Rumus: \\(U_{n}=a\\cdot r^{n-1}\\)</p><p>\\(U_{8}=5\\times 2^{7}=5\\times 128=640\\)</p><p><strong>Jebakan:</strong> menggunakan pangkat 8 (bukan 7) menghasilkan 1280.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 13 | Barisan dan Deret | sedang | Kunci: B
            [
                'no' => 13,
                'question_text' => '<p>Pada suatu barisan aritmetika, suku ke-3 adalah 25 dan suku ke-7 adalah 53. Suku ke-15 barisan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(102\\)', 'is_correct' => false],
                    ['text' => '\\(109\\)', 'is_correct' => true],
                    ['text' => '\\(110\\)', 'is_correct' => false],
                    ['text' => '\\(116\\)', 'is_correct' => false],
                    ['text' => '\\(117\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Selisih suku ke-7 dan ke-3 sama dengan 4 kali beda:</p><p>\\(U_{7}-U_{3}=\\left(7-3\\right)b\\Rightarrow 53-25=4b\\Rightarrow b=7\\)</p><p>Suku pertama: \\(a=U_{3}-2b=25-14=11\\)</p><p>\\(U_{15}=a+\\left(15-1\\right)b=11+14\\times 7=109\\)</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 14 | Barisan dan Deret | sedang | Kunci: E
            [
                'no' => 14,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 6,\\ 12,\\ 20,\\ 30,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(34\\)', 'is_correct' => false],
                    ['text' => '\\(36\\)', 'is_correct' => false],
                    ['text' => '\\(38\\)', 'is_correct' => false],
                    ['text' => '\\(40\\)', 'is_correct' => false],
                    ['text' => '\\(42\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Setiap suku adalah hasil kali <strong>dua bilangan berurutan</strong> \\(n\\left(n+1\\right)\\): \\(1\\times 2=2\\), \\(2\\times 3=6\\), \\(3\\times 4=12\\), \\(4\\times 5=20\\), \\(5\\times 6=30\\).</p><p>Suku berikutnya: \\(6\\times 7=42\\).</p><p><strong>Cara lain:</strong> selisihnya adalah bilangan genap berurutan.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 15 | Barisan dan Deret | sedang | Kunci: C
            [
                'no' => 15,
                'question_text' => '<p>Jumlah 6 suku pertama deret geometri \\(2 + 6 + 18+\\dots\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(486\\)', 'is_correct' => false],
                    ['text' => '\\(726\\)', 'is_correct' => false],
                    ['text' => '\\(728\\)', 'is_correct' => true],
                    ['text' => '\\(1458\\)', 'is_correct' => false],
                    ['text' => '\\(2186\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>\\(a=2\\), \\(r=3\\), \\(n=6\\).</p><p>Rumus: \\(S_{n}=\\frac{a\\left(r^{n}-1\\right)}{r-1}\\)</p><p>\\(S_{6}=\\frac{2\\left(3^{6}-1\\right)}{3-1}=\\frac{2\\times 728}{2}=728\\)</p><p><strong>Cek:</strong> \\(2 + 6 + 18 + 54 + 162 + 486=728\\)</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 16 | Barisan dan Deret | sedang | Kunci: B
            [
                'no' => 16,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(64,\\ 32,\\ 96,\\ 48,\\ 144,\\ 72,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(18\\)', 'is_correct' => false],
                    ['text' => '\\(216\\)', 'is_correct' => true],
                    ['text' => '\\(217\\)', 'is_correct' => false],
                    ['text' => '\\(218\\)', 'is_correct' => false],
                    ['text' => '\\(225\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Operasinya bergantian: \\(\\div 2\\) lalu \\(\\times 3\\).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(64\\)</td><td>\\(\\div 2\\)</td></tr>
            <tr><td>\\(32\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(96\\)</td><td>\\(\\div 2\\)</td></tr>
            <tr><td>\\(48\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(144\\)</td><td>\\(\\div 2\\)</td></tr>
            <tr><td>\\(72\\)</td><td>\\(\\times 3\\)</td></tr>
            </table><p>Operasi berikutnya \\(\\times 3\\): \\(72\\times 3=216\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 17 | Barisan dan Deret | sedang | Kunci: E
            [
                'no' => 17,
                'question_text' => '<p>Rina menabung setiap bulan. Pada bulan pertama ia menabung Rp100.000,00, dan setiap bulan berikutnya tabungannya bertambah Rp10.000,00 dari bulan sebelumnya. Jumlah seluruh uang yang ditabung Rina selama satu tahun adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Rp2.640.000,00', 'is_correct' => false],
                    ['text' => 'Rp1.800.000,00', 'is_correct' => false],
                    ['text' => 'Rp1.980.000,00', 'is_correct' => false],
                    ['text' => 'Rp1.740.000,00', 'is_correct' => false],
                    ['text' => 'Rp1.860.000,00', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Tabungan per bulan membentuk deret aritmetika dengan \\(a=100000\\), \\(b=10000\\), dan \\(n=12\\) (satu tahun).</p><p>Tabungan bulan ke-12: \\(U_{12}=100000+11\\times 10000=210000\\)</p><p>Jumlah: \\(S_{12}=\\frac{12}{2}\\left(100000+210000\\right)=6\\times 310000=1860000\\)</p><p>Jadi, total tabungan Rina adalah <strong>Rp1.860.000,00</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 18 | Barisan dan Deret | sedang | Kunci: B
            [
                'no' => 18,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(128,\\ 116,\\ 105,\\ 95,\\ 86,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(77\\)', 'is_correct' => false],
                    ['text' => '\\(78\\)', 'is_correct' => true],
                    ['text' => '\\(79\\)', 'is_correct' => false],
                    ['text' => '\\(80\\)', 'is_correct' => false],
                    ['text' => '\\(81\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Selisih antarsuku semakin kecil: \\(-12\\), \\(-11\\), \\(-10\\), \\(-9\\), sehingga selisih berikutnya \\(-8\\).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(128\\)</td><td>\\(-12\\)</td></tr>
            <tr><td>\\(116\\)</td><td>\\(-11\\)</td></tr>
            <tr><td>\\(105\\)</td><td>\\(-10\\)</td></tr>
            <tr><td>\\(95\\)</td><td>\\(-9\\)</td></tr>
            <tr><td>\\(86\\)</td><td>\\(-8\\)</td></tr>
            </table><p>Suku berikutnya: \\(86-8=78\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 19 | Barisan dan Deret | menantang | Kunci: A
            [
                'no' => 19,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(4,\\ 18,\\ 85,\\ 336,\\ 1005,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(2008\\)', 'is_correct' => true],
                    ['text' => '\\(2009\\)', 'is_correct' => false],
                    ['text' => '\\(2010\\)', 'is_correct' => false],
                    ['text' => '\\(2012\\)', 'is_correct' => false],
                    ['text' => '\\(3012\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setiap suku dikalikan suatu bilangan, lalu <strong>dikurangi bilangan yang sama</strong>. Bilangan tersebut berkurang satu setiap langkah (6, 5, 4, 3, 2).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(4\\)</td><td>\\(\\times 6-6\\)</td></tr>
            <tr><td>\\(18\\)</td><td>\\(\\times 5-5\\)</td></tr>
            <tr><td>\\(85\\)</td><td>\\(\\times 4-4\\)</td></tr>
            <tr><td>\\(336\\)</td><td>\\(\\times 3-3\\)</td></tr>
            <tr><td>\\(1005\\)</td><td>\\(\\times 2-2\\)</td></tr>
            </table><p>Suku berikutnya: \\(1005\\times 2-2=2008\\).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 20 | Barisan dan Deret | menantang | Kunci: D
            [
                'no' => 20,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 2,\\ 3,\\ 7,\\ 12,\\ 22,\\ 41,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(63\\)', 'is_correct' => false],
                    ['text' => '\\(72\\)', 'is_correct' => false],
                    ['text' => '\\(73\\)', 'is_correct' => false],
                    ['text' => '\\(75\\)', 'is_correct' => true],
                    ['text' => '\\(82\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setiap suku adalah <strong>jumlah tiga suku sebelumnya</strong>:</p><p>\\(2+2+3=7\\)<br>\\(2+3+7=12\\)<br>\\(3+7+12=22\\)<br>\\(7+12+22=41\\)</p><p>Suku berikutnya: \\(12+22+41=75\\).</p><p><strong>Jebakan:</strong> menjumlahkan dua suku saja (pola Fibonacci) tidak cocok dengan suku-suku sebelumnya.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 21 | Barisan dan Deret | menantang | Kunci: B
            [
                'no' => 21,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 4,\\ 7,\\ 12,\\ 19,\\ 30,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(42\\)', 'is_correct' => false],
                    ['text' => '\\(43\\)', 'is_correct' => true],
                    ['text' => '\\(44\\)', 'is_correct' => false],
                    ['text' => '\\(45\\)', 'is_correct' => false],
                    ['text' => '\\(47\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Selisih antarsuku adalah <strong>bilangan prima berurutan</strong>: +2, +3, +5, +7, +11.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(2\\)</td><td>\\(+2\\)</td></tr>
            <tr><td>\\(4\\)</td><td>\\(+3\\)</td></tr>
            <tr><td>\\(7\\)</td><td>\\(+5\\)</td></tr>
            <tr><td>\\(12\\)</td><td>\\(+7\\)</td></tr>
            <tr><td>\\(19\\)</td><td>\\(+11\\)</td></tr>
            <tr><td>\\(30\\)</td><td>\\(+13\\)</td></tr>
            </table><p>Bilangan prima setelah 11 adalah 13, sehingga suku berikutnya \\(30+13=43\\).</p><p><strong>Jebakan:</strong> menganggap selisihnya bilangan ganjil (+13 → +15) atau bertambah 4 seperti langkah terakhir.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 22 | Barisan dan Deret | menantang | Kunci: D
            [
                'no' => 22,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 6,\\ 4,\\ 12,\\ 10,\\ 30,\\ 28,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(25\\)', 'is_correct' => false],
                    ['text' => '\\(28\\)', 'is_correct' => false],
                    ['text' => '\\(81\\)', 'is_correct' => false],
                    ['text' => '\\(84\\)', 'is_correct' => true],
                    ['text' => '\\(86\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Operasinya bergantian \\(\\times 3\\) dan \\(-2\\). Pola ini sulit terlihat karena nilainya naik turun.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(2\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(6\\)</td><td>\\(-2\\)</td></tr>
            <tr><td>\\(4\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(12\\)</td><td>\\(-2\\)</td></tr>
            <tr><td>\\(10\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(30\\)</td><td>\\(-2\\)</td></tr>
            <tr><td>\\(28\\)</td><td>\\(\\times 3\\)</td></tr>
            </table><p>Operasi berikutnya \\(\\times 3\\): \\(28\\times 3=84\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 23 | Barisan dan Deret | menantang | Kunci: E
            [
                'no' => 23,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>A, B, E, J, Q, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'U', 'is_correct' => false],
                    ['text' => 'V', 'is_correct' => false],
                    ['text' => 'X', 'is_correct' => false],
                    ['text' => 'Y', 'is_correct' => false],
                    ['text' => 'Z', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Nomor urut huruf: A = 1, B = 2, E = 5, J = 10, Q = 17.</p><p>Selisihnya bilangan ganjil berurutan: +1, +3, +5, +7, sehingga berikutnya <strong>+9</strong>. (Pola ini juga dapat ditulis sebagai \\(n^{2}+1\\) untuk \\(n=0,1,2,\\dots\\).)</p><p>Huruf berikutnya: 17 + 9 = 26, yaitu <strong>Z</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 24 | Barisan dan Deret | menantang | Kunci: C
            [
                'no' => 24,
                'question_text' => '<p>Perhatikan barisan \\(1,\\ 3,\\ 6,\\ 10,\\ 15,\\ \\dots\\). Suku ke-30 barisan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(435\\)', 'is_correct' => false],
                    ['text' => '\\(446\\)', 'is_correct' => false],
                    ['text' => '\\(465\\)', 'is_correct' => true],
                    ['text' => '\\(495\\)', 'is_correct' => false],
                    ['text' => '\\(900\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Selisih antarsuku adalah +2, +3, +4, +5, sehingga barisan ini adalah <strong>bilangan segitiga</strong>:</p><p>\\(U_{n}=1+2+3+\\dots+n=\\frac{n\\left(n+1\\right)}{2}\\)</p><p>Cek: \\(U_{4}=\\frac{4\\times 5}{2}=10\\) ✔</p><p>\\(U_{30}=\\frac{30\\times 31}{2}=465\\)</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 25 | Barisan dan Deret | menantang | Kunci: C
            [
                'no' => 25,
                'question_text' => '<p>Tiga bilangan membentuk barisan aritmetika naik. Jumlah ketiga bilangan tersebut adalah 42 dan hasil kalinya 2520. Bilangan terbesar adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(14\\)', 'is_correct' => false],
                    ['text' => '\\(17\\)', 'is_correct' => false],
                    ['text' => '\\(18\\)', 'is_correct' => true],
                    ['text' => '\\(19\\)', 'is_correct' => false],
                    ['text' => '\\(22\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Misalkan ketiga bilangan adalah \\(m-b,\\ m,\\ m+b\\).</p><p>Jumlah: \\(3m=42\\Rightarrow m=14\\)</p><p>Hasil kali: \\(\\left(14-b\\right)\\times 14\\times \\left(14+b\\right)=2520\\)</p><p>\\(\\left(196-b^{2}\\right)\\times 14=2520\\Rightarrow 196-b^{2}=180\\Rightarrow b^{2}=16\\Rightarrow b=4\\)</p><p>Ketiga bilangan: 10, 14, 18. Bilangan terbesar <strong>18</strong>.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 26 | Barisan dan Deret | menantang | Kunci: C
            [
                'no' => 26,
                'question_text' => '<p>Di antara bilangan 2 dan 50 disisipkan 5 bilangan sehingga terbentuk barisan aritmetika. Jumlah seluruh bilangan pada barisan yang terbentuk adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(130\\)', 'is_correct' => false],
                    ['text' => '\\(156\\)', 'is_correct' => false],
                    ['text' => '\\(182\\)', 'is_correct' => true],
                    ['text' => '\\(189\\)', 'is_correct' => false],
                    ['text' => '\\(190\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setelah disisipkan 5 bilangan, banyak suku menjadi \\(n=5+2=7\\).</p><p>Beda baru: \\(b=\\frac{50-2}{5+1}=\\frac{48}{6}=8\\)</p><p>Barisannya: 2, 10, 18, 26, 34, 42, 50.</p><p>Jumlah: \\(S_{7}=\\frac{7}{2}\\left(2+50\\right)=182\\)</p><p><strong>Jebakan:</strong> jumlah suku bukan 5 atau 6, melainkan 7 (dua bilangan awal ikut dihitung).</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 27 | Barisan dan Deret | menantang | Kunci: B
            [
                'no' => 27,
                'question_text' => '<p>Sebuah bola dijatuhkan dari ketinggian 20 m. Setiap kali memantul, bola mencapai ketinggian \\(\\frac{3}{4}\\) dari ketinggian sebelumnya. Panjang seluruh lintasan bola sampai berhenti adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '80 m', 'is_correct' => false],
                    ['text' => '140 m', 'is_correct' => true],
                    ['text' => '130 m', 'is_correct' => false],
                    ['text' => '160 m', 'is_correct' => false],
                    ['text' => '180 m', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Lintasan terdiri atas gerakan turun dan gerakan naik:</p><ul>
            <li><strong>Lintasan turun:</strong> \\(20+20\\cdot \\frac{3}{4}+\\dots=\\frac{20}{1-\\frac{3}{4}}=80\\) m</li>
            <li><strong>Lintasan naik:</strong> dimulai dari pantulan pertama, \\(20\\cdot \\frac{3}{4}+\\dots=\\frac{15}{1-\\frac{3}{4}}=60\\) m</li>
            </ul><p>Total lintasan: \\(80+60=140\\) m.</p><p><strong>Rumus cepat:</strong> \\(\\text{panjang}=h\\times\\frac{1+r}{1-r}\\), dengan \\(h\\) tinggi awal.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 28 | Barisan dan Deret | menantang | Kunci: D
            [
                'no' => 28,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(0,\\ 6,\\ 24,\\ 60,\\ 120,\\ 210,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(300\\)', 'is_correct' => false],
                    ['text' => '\\(323\\)', 'is_correct' => false],
                    ['text' => '\\(330\\)', 'is_correct' => false],
                    ['text' => '\\(336\\)', 'is_correct' => true],
                    ['text' => '\\(343\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setiap suku berbentuk \\(n^{3}-n\\), yaitu hasil kali tiga bilangan berurutan \\(\\left(n-1\\right)n\\left(n+1\\right)\\):</p><p>\\(0\\times 1\\times 2=0\\), \\(1\\times 2\\times 3=6\\), \\(2\\times 3\\times 4=24\\), \\(3\\times 4\\times 5=60\\), \\(4\\times 5\\times 6=120\\), \\(5\\times 6\\times 7=210\\)</p><p>Suku berikutnya: \\(6\\times 7\\times 8=336\\).</p><p><strong>Cara lain:</strong> selisihnya 6, 18, 36, 60, 90 (enam kali bilangan segitiga), sehingga berikutnya +126.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 29 | Barisan dan Deret | menantang | Kunci: A
            [
                'no' => 29,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>B, Z, D, X, F, V, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'H', 'is_correct' => true],
                    ['text' => 'I', 'is_correct' => false],
                    ['text' => 'J', 'is_correct' => false],
                    ['text' => 'T', 'is_correct' => false],
                    ['text' => 'U', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Pisahkan suku ganjil dan suku genap:</p><ul>
            <li>Suku ganjil: B, D, F → maju 2 huruf dari depan alfabet</li>
            <li>Suku genap: Z, X, V → mundur 2 huruf dari belakang alfabet</li>
            </ul><p>Suku ke-7 adalah lanjutan deret ganjil: F + 2 = <strong>H</strong>.</p><p><strong>Jebakan:</strong> T adalah lanjutan deret genap (suku ke-8), bukan suku ke-7.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 30 | Barisan dan Deret | menantang | Kunci: C
            [
                'no' => 30,
                'question_text' => '<p>Suku ke-n suatu barisan dirumuskan \\(U_{n}=4n^{2}-3n\\). Selisih suku ke-8 dan suku ke-7 adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(49\\)', 'is_correct' => false],
                    ['text' => '\\(55\\)', 'is_correct' => false],
                    ['text' => '\\(57\\)', 'is_correct' => true],
                    ['text' => '\\(65\\)', 'is_correct' => false],
                    ['text' => '\\(232\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Hitung kedua suku:</p><p>\\(U_{8}=4\\times 8^{2}-3\\times 8=256-24=232\\)</p><p>\\(U_{7}=4\\times 7^{2}-3\\times 7=196-21=175\\)</p><p>\\(U_{8}-U_{7}=232-175=57\\)</p><p><strong>Cara cepat:</strong> \\(U_{n}-U_{n-1}=4\\left(2n-1\\right)-3\\), sehingga untuk \\(n=8\\): \\(4\\times 15-3=57\\).</p>
            <p><strong>Jawaban: C</strong></p>',
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

        $this->command->info('Seeder Barisan dan Deret Paket 2 (30 soal) berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
