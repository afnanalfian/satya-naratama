<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarisanDeretPaket1Seeder extends Seeder
{
    /**
     * Seeder Barisan dan Deret Paket 1 (30 soal)
     *
     * - material_id : 38
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : general
     * - Komposisi   : 20% mudah, 40% sedang, 40% menantang
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 16;

        $questions = [
            // Soal 1 | Barisan dan Deret | mudah | Kunci: B
            [
                'no' => 1,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(15,\\ 24,\\ 33,\\ 42,\\ 51,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(59\\)', 'is_correct' => false],
                    ['text' => '\\(60\\)', 'is_correct' => true],
                    ['text' => '\\(61\\)', 'is_correct' => false],
                    ['text' => '\\(62\\)', 'is_correct' => false],
                    ['text' => '\\(69\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Setiap suku bertambah <strong>9</strong> (barisan aritmetika dengan beda 9).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(15\\)</td><td>\\(+9\\)</td></tr>
            <tr><td>\\(24\\)</td><td>\\(+9\\)</td></tr>
            <tr><td>\\(33\\)</td><td>\\(+9\\)</td></tr>
            <tr><td>\\(42\\)</td><td>\\(+9\\)</td></tr>
            <tr><td>\\(51\\)</td><td>\\(+9\\)</td></tr>
            </table><p>Suku berikutnya: \\(51+9=60\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 2 | Barisan dan Deret | mudah | Kunci: B
            [
                'no' => 2,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(3,\\ 9,\\ 27,\\ 81,\\ 243,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(405\\)', 'is_correct' => false],
                    ['text' => '\\(729\\)', 'is_correct' => true],
                    ['text' => '\\(732\\)', 'is_correct' => false],
                    ['text' => '\\(758\\)', 'is_correct' => false],
                    ['text' => '\\(972\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Setiap suku dikalikan <strong>3</strong> (barisan geometri dengan rasio 3).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(3\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(9\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(27\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(81\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(243\\)</td><td>\\(\\times 3\\)</td></tr>
            </table><p>Suku berikutnya: \\(243\\times 3=729\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 3 | Barisan dan Deret | mudah | Kunci: E
            [
                'no' => 3,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>C, F, I, L, O, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'N', 'is_correct' => false],
                    ['text' => 'O', 'is_correct' => false],
                    ['text' => 'P', 'is_correct' => false],
                    ['text' => 'Q', 'is_correct' => false],
                    ['text' => 'R', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Ubah setiap huruf menjadi nomor urutnya dalam alfabet (A = 1, B = 2, dan seterusnya):</p><p>C = 3, F = 6, I = 9, L = 12, O = 15</p><p>Setiap huruf melompat <strong>3</strong> posisi. Huruf berikutnya: 15 + 3 = 18, yaitu <strong>R</strong>.</p><p><strong>Tips:</strong> hafalkan huruf kunci E = 5, J = 10, O = 15, T = 20, Y = 25.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 4 | Barisan dan Deret | mudah | Kunci: A
            [
                'no' => 4,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(8,\\ 11,\\ 15,\\ 20,\\ 26,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(33\\)', 'is_correct' => true],
                    ['text' => '\\(34\\)', 'is_correct' => false],
                    ['text' => '\\(35\\)', 'is_correct' => false],
                    ['text' => '\\(36\\)', 'is_correct' => false],
                    ['text' => '\\(37\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Selisih antarsuku bertambah satu: \\(+3\\), \\(+4\\), \\(+5\\), \\(+6\\), sehingga selisih berikutnya \\(+7\\).</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(8\\)</td><td>\\(+3\\)</td></tr>
            <tr><td>\\(11\\)</td><td>\\(+4\\)</td></tr>
            <tr><td>\\(15\\)</td><td>\\(+5\\)</td></tr>
            <tr><td>\\(20\\)</td><td>\\(+6\\)</td></tr>
            <tr><td>\\(26\\)</td><td>\\(+7\\)</td></tr>
            </table><p>Suku berikutnya: \\(26+7=33\\).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 5 | Barisan dan Deret | mudah | Kunci: D
            [
                'no' => 5,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(1215,\\ 405,\\ 135,\\ 45,\\ 15,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(2\\)', 'is_correct' => false],
                    ['text' => '\\(3\\)', 'is_correct' => false],
                    ['text' => '\\(4\\)', 'is_correct' => false],
                    ['text' => '\\(5\\)', 'is_correct' => true],
                    ['text' => '\\(10\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Setiap suku dibagi <strong>3</strong>.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(1215\\)</td><td>\\(\\div 3\\)</td></tr>
            <tr><td>\\(405\\)</td><td>\\(\\div 3\\)</td></tr>
            <tr><td>\\(135\\)</td><td>\\(\\div 3\\)</td></tr>
            <tr><td>\\(45\\)</td><td>\\(\\div 3\\)</td></tr>
            <tr><td>\\(15\\)</td><td>\\(\\div 3\\)</td></tr>
            </table><p>Suku berikutnya: \\(15\\div 3=5\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 6 | Barisan dan Deret | mudah | Kunci: A
            [
                'no' => 6,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 9,\\ 28,\\ 65,\\ 126,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(217\\)', 'is_correct' => true],
                    ['text' => '\\(218\\)', 'is_correct' => false],
                    ['text' => '\\(226\\)', 'is_correct' => false],
                    ['text' => '\\(227\\)', 'is_correct' => false],
                    ['text' => '\\(235\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Mudah</p>
            <p>Suku-sukunya adalah <strong>bilangan pangkat tiga</strong> ditambah 1:</p><p>\\(1^{3}+1=2\\), \\(2^{3}+1=9\\), \\(3^{3}+1=28\\), \\(4^{3}+1=65\\), \\(5^{3}+1=126\\)</p><p>Suku berikutnya: \\(6^{3}+1=217\\).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 7 | Barisan dan Deret | sedang | Kunci: C
            [
                'no' => 7,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(5,\\ 8,\\ 14,\\ 23,\\ 35,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(47\\)', 'is_correct' => false],
                    ['text' => '\\(49\\)', 'is_correct' => false],
                    ['text' => '\\(50\\)', 'is_correct' => true],
                    ['text' => '\\(51\\)', 'is_correct' => false],
                    ['text' => '\\(53\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Deret ini adalah <strong>deret bertingkat dua</strong>. Selisih antarsuku membentuk barisan aritmetika:</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Selisih tingkat 1</th><th>Selisih tingkat 2</th></tr>
            <tr><td>\\(+3\\), \\(+6\\), \\(+9\\), \\(+12\\)</td><td>semuanya \\(+3\\)</td></tr>
            </table><p>Selisih berikutnya: \\(12+3=15\\). Suku berikutnya: \\(35+15=50\\).</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 8 | Barisan dan Deret | sedang | Kunci: E
            [
                'no' => 8,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(4,\\ 2,\\ 9,\\ 4,\\ 14,\\ 8,\\ 19,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(10\\)', 'is_correct' => false],
                    ['text' => '\\(13\\)', 'is_correct' => false],
                    ['text' => '\\(14\\)', 'is_correct' => false],
                    ['text' => '\\(15\\)', 'is_correct' => false],
                    ['text' => '\\(16\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Ada <strong>dua deret berselang-seling</strong>:</p><ul>
            <li>Suku ganjil: 4, 9, 14, 19 → bertambah 5 (aritmetika)</li>
            <li>Suku genap: 2, 4, 8, ... → dikali 2 (geometri)</li>
            </ul><p>Suku berikutnya adalah suku ke-8 (genap): \\(8\\times 2=16\\).</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 9 | Barisan dan Deret | sedang | Kunci: C
            [
                'no' => 9,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 3,\\ 5,\\ 9,\\ 17,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(25\\)', 'is_correct' => false],
                    ['text' => '\\(26\\)', 'is_correct' => false],
                    ['text' => '\\(33\\)', 'is_correct' => true],
                    ['text' => '\\(34\\)', 'is_correct' => false],
                    ['text' => '\\(35\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Selisih antarsuku <strong>dikalikan 2</strong> setiap langkah: \\(+1\\), \\(+2\\), \\(+4\\), \\(+8\\).</p><p>Selisih berikutnya \\(+16\\), sehingga suku berikutnya \\(17+16=33\\).</p><p><strong>Jebakan:</strong> jika selisih dianggap bertambah tetap, hasilnya 26.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 10 | Barisan dan Deret | sedang | Kunci: A
            [
                'no' => 10,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(5,\\ 15,\\ 20,\\ 60,\\ 65,\\ 195,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(200\\)', 'is_correct' => true],
                    ['text' => '\\(201\\)', 'is_correct' => false],
                    ['text' => '\\(203\\)', 'is_correct' => false],
                    ['text' => '\\(208\\)', 'is_correct' => false],
                    ['text' => '\\(590\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Operasi yang digunakan <strong>bergantian</strong>: \\(\\times 3\\), lalu \\(+5\\), lalu \\(\\times 3\\), dan seterusnya.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(5\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(15\\)</td><td>\\(+5\\)</td></tr>
            <tr><td>\\(20\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(60\\)</td><td>\\(+5\\)</td></tr>
            <tr><td>\\(65\\)</td><td>\\(\\times 3\\)</td></tr>
            <tr><td>\\(195\\)</td><td>\\(+5\\)</td></tr>
            </table><p>Operasi berikutnya adalah \\(+5\\): \\(195+5=200\\).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 11 | Barisan dan Deret | sedang | Kunci: B
            [
                'no' => 11,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>A, B, D, G, K, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'O', 'is_correct' => false],
                    ['text' => 'P', 'is_correct' => true],
                    ['text' => 'Q', 'is_correct' => false],
                    ['text' => 'R', 'is_correct' => false],
                    ['text' => 'S', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Nomor urut huruf: A = 1, B = 2, D = 4, G = 7, K = 11.</p><p>Lompatannya bertambah satu: +1, +2, +3, +4, sehingga lompatan berikutnya <strong>+5</strong>.</p><p>Huruf berikutnya: 11 + 5 = 16, yaitu <strong>P</strong>.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 12 | Barisan dan Deret | sedang | Kunci: A
            [
                'no' => 12,
                'question_text' => '<p>Suku yang tepat untuk melanjutkan deret berikut adalah ....</p><p>B4, E10, H16, K22, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'N28', 'is_correct' => true],
                    ['text' => 'M26', 'is_correct' => false],
                    ['text' => 'O28', 'is_correct' => false],
                    ['text' => 'N14', 'is_correct' => false],
                    ['text' => 'N30', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Setiap suku terdiri atas sebuah <strong>huruf</strong> dan sebuah <strong>angka</strong>.</p><ul>
            <li>Huruf: B, E, H, K → maju 3 huruf; berikutnya <strong>N</strong> (huruf ke-14).</li>
            <li>Angka: selalu <strong>2 kali nomor urut hurufnya</strong>. Misalnya B = 2, sehingga angkanya 4.</li>
            </ul><p>Suku berikutnya: N = 14, angka = 14 × 2 = 28, sehingga jawabannya <strong>N28</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 13 | Barisan dan Deret | sedang | Kunci: C
            [
                'no' => 13,
                'question_text' => '<p>Jumlah 10 suku pertama deret aritmetika \\(9 + 15 + 21 + 27+\\dots\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(297\\)', 'is_correct' => false],
                    ['text' => '\\(346\\)', 'is_correct' => false],
                    ['text' => '\\(360\\)', 'is_correct' => true],
                    ['text' => '\\(420\\)', 'is_correct' => false],
                    ['text' => '\\(720\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>\\(a=9\\), \\(b=6\\), \\(n=10\\).</p><p>Suku ke-10: \\(U_{10}=9+\\left(10-1\\right)\\times 6=63\\)</p><p>Rumus jumlah: \\(S_{n}=\\frac{n}{2}\\left(a+U_{n}\\right)\\)</p><p>\\(S_{10}=\\frac{10}{2}\\left(9+63\\right)=\\frac{10}{2}\\times 72=360\\)</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 14 | Barisan dan Deret | sedang | Kunci: D
            [
                'no' => 14,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(\\frac{3}{2},\\ \\frac{4}{4},\\ \\frac{5}{8},\\ \\frac{6}{16},\\ \\frac{7}{32},\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(\\frac{7}{64}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{8}{128}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{8}{34}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{8}{64}\\)', 'is_correct' => true],
                    ['text' => '\\(\\frac{9}{64}\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Perhatikan <strong>pembilang</strong> dan <strong>penyebut</strong> secara terpisah (jangan disederhanakan):</p><ul>
            <li>Pembilang: 3, 4, 5, 6, 7 → bertambah 1, berikutnya <strong>8</strong></li>
            <li>Penyebut: 2, 4, 8, 16, 32 → dikali 2, berikutnya <strong>64</strong></li>
            </ul><p>Suku berikutnya: \\(\\frac{8}{64}\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 15 | Barisan dan Deret | sedang | Kunci: D
            [
                'no' => 15,
                'question_text' => '<p>Dua bilangan yang tepat untuk menggantikan tanda tanya pada deret berikut adalah ....</p><p>\\(3,\\ 8,\\ ?,\\ 24,\\ ?,\\ 48\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '15 dan 37', 'is_correct' => false],
                    ['text' => '13 dan 35', 'is_correct' => false],
                    ['text' => '16 dan 36', 'is_correct' => false],
                    ['text' => '15 dan 35', 'is_correct' => true],
                    ['text' => '17 dan 33', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Selisih yang diketahui: \\(8-3=5\\). Coba pola selisih bertambah 2:</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(3\\)</td><td>\\(+5\\)</td></tr>
            <tr><td>\\(8\\)</td><td>\\(+7\\)</td></tr>
            <tr><td>\\(15\\)</td><td>\\(+9\\)</td></tr>
            <tr><td>\\(24\\)</td><td>\\(+11\\)</td></tr>
            <tr><td>\\(35\\)</td><td>\\(+13\\)</td></tr>
            </table><p>Pola ini cocok dengan semua suku yang diketahui (24 dan 48). Jadi bilangan yang hilang adalah <strong>15</strong> dan <strong>35</strong>.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 16 | Barisan dan Deret | sedang | Kunci: C
            [
                'no' => 16,
                'question_text' => '<p>Banyak suku pada barisan \\(4,\\ 7,\\ 10,\\ \\dots,\\ 130\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(41\\)', 'is_correct' => false],
                    ['text' => '\\(42\\)', 'is_correct' => false],
                    ['text' => '\\(43\\)', 'is_correct' => true],
                    ['text' => '\\(44\\)', 'is_correct' => false],
                    ['text' => '\\(45\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>\\(a=4\\), \\(b=3\\), dan suku terakhir \\(U_{n}=130\\).</p><p>\\(130=4+\\left(n-1\\right)\\times 3\\Rightarrow n-1=\\frac{126}{3}=42\\Rightarrow n=43\\)</p><p><strong>Jebakan:</strong> jangan lupa menambahkan 1. Hasil bagi selisih dengan beda hanya menyatakan banyak "lompatan".</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 17 | Barisan dan Deret | sedang | Kunci: D
            [
                'no' => 17,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>X, V, S, O, J, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => true],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>Nomor urut huruf: X = 24, V = 22, S = 19, O = 15, J = 10.</p><p>Huruf mundur dengan lompatan yang bertambah: −2, −3, −4, −5, sehingga berikutnya <strong>−6</strong>.</p><p>Huruf berikutnya: 10 − 6 = 4, yaitu <strong>D</strong>.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 18 | Barisan dan Deret | sedang | Kunci: D
            [
                'no' => 18,
                'question_text' => '<p>Suatu bakteri membelah diri menjadi dua setiap 30 menit. Jika mula-mula terdapat 20 bakteri, banyak bakteri setelah 2 jam adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(160\\)', 'is_correct' => false],
                    ['text' => '\\(240\\)', 'is_correct' => false],
                    ['text' => '\\(307\\)', 'is_correct' => false],
                    ['text' => '\\(320\\)', 'is_correct' => true],
                    ['text' => '\\(640\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Sedang</p>
            <p>2 jam = 120 menit. Banyak pembelahan: \\(\\frac{120}{30}=4\\) kali.</p><p>Setiap pembelahan, jumlah bakteri dikali 2. Setelah 4 kali pembelahan:</p><p>\\(20\\times 2^{4}=20\\times 16=320\\)</p><p><strong>Jebakan:</strong> suku ke-4 barisan geometri \\(a\\cdot r^{n-1}\\) memberikan 160, padahal kondisi awal belum termasuk pembelahan. Yang dihitung adalah keadaan <em>setelah</em> 4 kali pembelahan.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 19 | Barisan dan Deret | menantang | Kunci: C
            [
                'no' => 19,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(5,\\ 6,\\ 11,\\ 22,\\ 41,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(68\\)', 'is_correct' => false],
                    ['text' => '\\(69\\)', 'is_correct' => false],
                    ['text' => '\\(70\\)', 'is_correct' => true],
                    ['text' => '\\(71\\)', 'is_correct' => false],
                    ['text' => '\\(72\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Deret ini adalah <strong>deret bertingkat tiga</strong>:</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Tingkat</th><th>Selisih</th></tr>
            <tr><td>Selisih 1</td><td>1, 5, 11, 19</td></tr>
            <tr><td>Selisih 2</td><td>4, 6, 8</td></tr>
            <tr><td>Selisih 3</td><td>semuanya 2</td></tr>
            </table><p>Lanjutkan dari bawah: selisih 2 berikutnya \\(8+2=10\\); selisih 1 berikutnya \\(19+10=29\\); suku berikutnya \\(41+29=70\\).</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 20 | Barisan dan Deret | menantang | Kunci: B
            [
                'no' => 20,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(4,\\ 3,\\ 43,\\ 6,\\ 6,\\ 38,\\ 8,\\ 12,\\ 33,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(9\\)', 'is_correct' => false],
                    ['text' => '\\(10\\)', 'is_correct' => true],
                    ['text' => '\\(11\\)', 'is_correct' => false],
                    ['text' => '\\(24\\)', 'is_correct' => false],
                    ['text' => '\\(28\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Deret ini terdiri atas <strong>tiga deret yang bergiliran</strong>:</p><ul>
            <li>Suku ke-1, 4, 7, 10: 4, 6, 8 → +2</li>
            <li>Suku ke-2, 5, 8, 11: 3, 6, 12 → ×2</li>
            <li>Suku ke-3, 6, 9, 12: 43, 38, 33 → −5</li>
            </ul><p>Suku berikutnya adalah suku ke-10, yaitu lanjutan deret pertama: \\(8+2=10\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 21 | Barisan dan Deret | menantang | Kunci: E
            [
                'no' => 21,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(2,\\ 3,\\ 8,\\ 63,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(125\\)', 'is_correct' => false],
                    ['text' => '\\(504\\)', 'is_correct' => false],
                    ['text' => '\\(3809\\)', 'is_correct' => false],
                    ['text' => '\\(3966\\)', 'is_correct' => false],
                    ['text' => '\\(3968\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Setiap suku adalah <strong>kuadrat suku sebelumnya dikurangi 1</strong>:</p><p>\\(2^{2}-1=3\\)<br>\\(3^{2}-1=8\\)<br>\\(8^{2}-1=63\\)</p><p>Suku berikutnya: \\(63^{2}-1=3968\\).</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 22 | Barisan dan Deret | menantang | Kunci: B
            [
                'no' => 22,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(10,\\ 11,\\ 15,\\ 24,\\ 40,\\ 65,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(95\\)', 'is_correct' => false],
                    ['text' => '\\(101\\)', 'is_correct' => true],
                    ['text' => '\\(102\\)', 'is_correct' => false],
                    ['text' => '\\(105\\)', 'is_correct' => false],
                    ['text' => '\\(109\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Selisih antarsuku adalah <strong>bilangan kuadrat</strong>: +1, +4, +9, +16, +25.</p><table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(10\\)</td><td>\\(+1^{2}\\)</td></tr>
            <tr><td>\\(11\\)</td><td>\\(+2^{2}\\)</td></tr>
            <tr><td>\\(15\\)</td><td>\\(+3^{2}\\)</td></tr>
            <tr><td>\\(24\\)</td><td>\\(+4^{2}\\)</td></tr>
            <tr><td>\\(40\\)</td><td>\\(+5^{2}\\)</td></tr>
            <tr><td>\\(65\\)</td><td>\\(+6^{2}\\)</td></tr>
            </table><p>Selisih berikutnya \\(6^{2}=36\\), sehingga suku berikutnya \\(65+36=101\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 23 | Barisan dan Deret | menantang | Kunci: E
            [
                'no' => 23,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>A, D, I, P, Y, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'F', 'is_correct' => false],
                    ['text' => 'G', 'is_correct' => false],
                    ['text' => 'H', 'is_correct' => false],
                    ['text' => 'I', 'is_correct' => false],
                    ['text' => 'J', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Nomor urut huruf: A = 1, D = 4, I = 9, P = 16, Y = 25.</p><p>Nomor-nomor tersebut adalah <strong>bilangan kuadrat</strong>: 1, 4, 9, 16, 25. Selisihnya bilangan ganjil +3, +5, +7, +9.</p><p>Berikutnya \\(6^{2}=36\\). Karena alfabet hanya 26 huruf, hitung berputar dari A lagi: 36 − 26 = 10, yaitu huruf <strong>J</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 24 | Barisan dan Deret | menantang | Kunci: A
            [
                'no' => 24,
                'question_text' => '<p>Huruf yang tepat untuk melanjutkan deret berikut adalah ....</p><p>3, C, 9, I, 27, A, 81, C, 243, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'I', 'is_correct' => true],
                    ['text' => 'J', 'is_correct' => false],
                    ['text' => 'K', 'is_correct' => false],
                    ['text' => 'L', 'is_correct' => false],
                    ['text' => 'Q', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Deret angka dikali 3: 3, 9, 27, 81, 243. Setiap angka diikuti <strong>huruf dengan nomor urut yang sama</strong>.</p><p>Jika angkanya lebih dari 26, hitungan alfabet berputar kembali ke A (kurangi dengan 26 sampai kurang dari atau sama dengan 26).</p><p>3 → C, 9 → I, 27 → A, 81 → C</p><p>Untuk 243: 243 − 26 × 9 = 9, yaitu huruf <strong>I</strong>.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 25 | Barisan dan Deret | menantang | Kunci: E
            [
                'no' => 25,
                'question_text' => '<p>Jumlah tak hingga deret geometri \\(12 + 8 + \\frac{16}{3}+\\dots\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(13\\)', 'is_correct' => false],
                    ['text' => '\\(24\\)', 'is_correct' => false],
                    ['text' => '\\(33\\)', 'is_correct' => false],
                    ['text' => '\\(35\\)', 'is_correct' => false],
                    ['text' => '\\(36\\)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Suku pertama \\(a=12\\) dan rasio \\(r=\\frac{8}{12}=\\frac{2}{3}\\). Karena \\(-1\\lt r\\lt 1\\), deret ini konvergen.</p><p>Rumus: \\(S_{\\infty}=\\frac{a}{1-r}\\)</p><p>\\(S_{\\infty}=\\frac{12}{1-\\frac{2}{3}}=\\frac{12}{\\frac{1}{3}}=36\\)</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 26 | Barisan dan Deret | menantang | Kunci: B
            [
                'no' => 26,
                'question_text' => '<p>Pada barisan geometri dengan rasio positif, suku ke-2 adalah 6 dan suku ke-5 adalah 48. Suku ke-7 barisan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(96\\)', 'is_correct' => false],
                    ['text' => '\\(192\\)', 'is_correct' => true],
                    ['text' => '\\(200\\)', 'is_correct' => false],
                    ['text' => '\\(208\\)', 'is_correct' => false],
                    ['text' => '\\(384\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>\\(\\frac{U_{5}}{U_{2}}=\\frac{ar^{4}}{ar}=r^{3}=\\frac{48}{6}=8\\Rightarrow r=2\\)</p><p>Suku ke-7 dapat dihitung langsung dari suku ke-5: \\(U_{7}=U_{5}\\times r^{2}=48\\times 4=192\\)</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 27 | Barisan dan Deret | menantang | Kunci: A
            [
                'no' => 27,
                'question_text' => '<p>Sebuah gedung pertunjukan memiliki 18 baris kursi. Baris paling depan berisi 15 kursi, dan setiap baris di belakangnya berisi 2 kursi lebih banyak daripada baris di depannya. Kapasitas seluruh kursi di gedung tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(576\\)', 'is_correct' => true],
                    ['text' => '\\(577\\)', 'is_correct' => false],
                    ['text' => '\\(594\\)', 'is_correct' => false],
                    ['text' => '\\(599\\)', 'is_correct' => false],
                    ['text' => '\\(882\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Banyak kursi per baris membentuk barisan aritmetika: \\(a=15\\), \\(b=2\\), \\(n=18\\).</p><p>Baris terakhir: \\(U_{18}=15+17\\times 2=49\\) kursi.</p><p>Total kursi: \\(S_{18}=\\frac{18}{2}\\left(15+49\\right)=576\\) kursi.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 28 | Barisan dan Deret | menantang | Kunci: D
            [
                'no' => 28,
                'question_text' => '<p>Bilangan yang tepat untuk melanjutkan deret berikut adalah ....</p><p>\\(\\frac{1}{2},\\ \\frac{4}{3},\\ \\frac{9}{4},\\ \\frac{16}{5},\\ \\frac{25}{6},\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(\\frac{49}{8}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{36}{8}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{30}{7}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{36}{7}\\)', 'is_correct' => true],
                    ['text' => '\\(\\frac{25}{7}\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Perhatikan pembilang dan penyebut secara terpisah:</p><ul>
            <li>Pembilang: 1, 4, 9, 16, 25 → <strong>bilangan kuadrat</strong>; berikutnya \\(6^{2}=36\\)</li>
            <li>Penyebut: 2, 3, 4, 5, 6 → bertambah 1; berikutnya 7</li>
            </ul><p>Suku berikutnya: \\(\\frac{36}{7}\\).</p><p><strong>Jebakan:</strong> jangan menyederhanakan pecahan, misalnya \\(\\frac{4}{3}\\) atau \\(\\frac{9}{4}\\), karena pola akan hilang.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 29 | Barisan dan Deret | menantang | Kunci: D
            [
                'no' => 29,
                'question_text' => '<p>Diketahui barisan \\(9,\\ 16,\\ 25,\\ 36,\\ \\dots\\). Jika suku ke-n barisan tersebut adalah 529, nilai n adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(18\\)', 'is_correct' => false],
                    ['text' => '\\(19\\)', 'is_correct' => false],
                    ['text' => '\\(20\\)', 'is_correct' => false],
                    ['text' => '\\(21\\)', 'is_correct' => true],
                    ['text' => '\\(23\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Suku-sukunya adalah kuadrat berurutan mulai dari \\(3^{2}\\), sehingga \\(U_{n}=\\left(n+2\\right)^{2}\\).</p><p>Cek: \\(U_{1}=\\left(1+2\\right)^{2}=9\\) ✔</p><p>\\(\\left(n+2\\right)^{2}=529\\Rightarrow n+2=23\\Rightarrow n=21\\)</p><p><strong>Jebakan:</strong> \\(\\sqrt{529}=23\\) bukan nilai n, karena barisan tidak dimulai dari \\(1^{2}\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 30 | Barisan dan Deret | menantang | Kunci: C
            [
                'no' => 30,
                'question_text' => '<p>Kaleng-kaleng disusun membentuk tumpukan segitiga. Baris paling atas terdiri atas 1 kaleng, dan setiap baris di bawahnya berisi satu kaleng lebih banyak. Jika baris paling bawah berisi 12 kaleng, banyak seluruh kaleng adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(66\\)', 'is_correct' => false],
                    ['text' => '\\(71\\)', 'is_correct' => false],
                    ['text' => '\\(78\\)', 'is_correct' => true],
                    ['text' => '\\(91\\)', 'is_correct' => false],
                    ['text' => '\\(144\\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Materi:</strong> Barisan dan Deret &nbsp;|&nbsp; <strong>Tingkat:</strong> Menantang</p>
            <p>Banyak kaleng per baris: 1, 2, 3, ..., 12.</p><p>Banyak baris: \\(n=12-1+1=12\\)</p><p>Jumlah: \\(S_{12}=\\frac{12}{2}\\left(1+12\\right)=78\\) kaleng.</p>
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

        $this->command->info('Seeder Barisan dan Deret Paket 1 (30 soal) berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
