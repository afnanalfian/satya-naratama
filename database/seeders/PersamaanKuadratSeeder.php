<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersamaanKuadratSeeder extends Seeder
{
    /**
     * Seeder Tugas Pertemuan: Persamaan Kuadrat (10 soal).
     *
     * - material_id : 10
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : general
     *
     * Semua ekspresi matematika ditulis dalam LaTeX yang kompatibel dengan
     * MathQuill (static math) dan dibungkus delimiter \( ... \).
     * Tanda < dan > di dalam math memakai \lt dan \gt agar tidak bentrok dengan HTML.
     */
    public function run()
    {
        $now = Carbon::now();
        $materialId = 10;

        $questions = [
            // ===================== Soal 1 =====================
            [
                'question_text' => '<p>Hasil dari \(\frac{1025^{2}-1020^{2}}{5}\) adalah ....</p>',
                'options' => [
                    ['text' => '\(2040\)', 'is_correct' => false],
                    ['text' => '\(2045\)', 'is_correct' => true],
                    ['text' => '\(2050\)', 'is_correct' => false],
                    ['text' => '\(4090\)', 'is_correct' => false],
                    ['text' => '\(10225\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Konsep:</strong> Selisih dua kuadrat</p>
<p>\(a^{2}-b^{2}=\left(a+b\right)\left(a-b\right)\)</p>
<p><strong>Langkah 1:</strong> Ubah pembilang dengan rumus selisih kuadrat.</p>
<p>\(1025^{2}-1020^{2}=\left(1025+1020\right)\left(1025-1020\right)=2045\times 5\)</p>
<p><strong>Langkah 2:</strong> Bagi dengan 5.</p>
<p>\(\frac{2045\times 5}{5}=2045\)</p>
<p><strong>Tips cepat:</strong> Jangan menghitung \(1025^{2}\) secara langsung. Bentuk \(a^{2}-b^{2}\) hampir selalu bisa diselesaikan dengan pemfaktoran.</p>
<p><strong>Jawaban: B</strong> \(\left(2045\right)\)</p>',
            ],

            // ===================== Soal 2 =====================
            [
                'question_text' => '<p>Jika \(a+b=11\) dan \(a^{2}+b^{2}=65\), maka nilai dari \(a\cdot b\) adalah ....</p>',
                'options' => [
                    ['text' => '\(24\)', 'is_correct' => false],
                    ['text' => '\(28\)', 'is_correct' => true],
                    ['text' => '\(32\)', 'is_correct' => false],
                    ['text' => '\(54\)', 'is_correct' => false],
                    ['text' => '\(56\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Konsep:</strong> Kuadrat jumlah</p>
<p>\(\left(a+b\right)^{2}=a^{2}+2ab+b^{2}\)</p>
<p><strong>Langkah 1:</strong> Substitusi nilai yang diketahui.</p>
<p>\(11^{2}=65+2ab\)</p>
<p>\(121=65+2ab\)</p>
<p><strong>Langkah 2:</strong> Selesaikan untuk \(ab\).</p>
<p>\(2ab=121-65=56\)</p>
<p>\(ab=28\)</p>
<p><strong>Jebakan:</strong> Opsi E \(\left(56\right)\) adalah nilai \(2ab\), bukan \(ab\). Jangan lupa membagi 2.</p>
<p><strong>Jawaban: B</strong> \(\left(28\right)\)</p>',
            ],

            // ===================== Soal 3 =====================
            [
                'question_text' => '<p>Himpunan penyelesaian dari persamaan kuadrat \(3x^{2}+5x-2=0\) adalah ....</p>',
                'options' => [
                    ['text' => '\(\left\{-2,\ \frac{1}{3}\right\}\)', 'is_correct' => true],
                    ['text' => '\(\left\{2,\ -\frac{1}{3}\right\}\)', 'is_correct' => false],
                    ['text' => '\(\left\{-1,\ \frac{2}{3}\right\}\)', 'is_correct' => false],
                    ['text' => '\(\left\{1,\ -\frac{2}{3}\right\}\)', 'is_correct' => false],
                    ['text' => '\(\left\{-2,\ 3\right\}\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Cara 1: Pemfaktoran</strong></p>
<p>Cari dua bilangan yang hasil kalinya \(a\cdot c=3\cdot\left(-2\right)=-6\) dan jumlahnya \(b=5\), yaitu \(6\) dan \(-1\).</p>
<p>\(3x^{2}+6x-x-2=0\)</p>
<p>\(3x\left(x+2\right)-1\left(x+2\right)=0\)</p>
<p>\(\left(3x-1\right)\left(x+2\right)=0\)</p>
<p>\(3x-1=0\Rightarrow x=\frac{1}{3}\) &nbsp; atau &nbsp; \(x+2=0\Rightarrow x=-2\)</p>
<p><strong>Cara 2: Rumus ABC</strong> (untuk mengecek)</p>
<p>\(x_{1,2}=\frac{-b\pm\sqrt{b^{2}-4ac}}{2a}=\frac{-5\pm\sqrt{25+24}}{6}=\frac{-5\pm 7}{6}\)</p>
<p>\(x_{1}=\frac{2}{6}=\frac{1}{3}\) &nbsp; dan &nbsp; \(x_{2}=\frac{-12}{6}=-2\)</p>
<p><strong>Jadi,</strong> \(HP=\left\{-2,\ \frac{1}{3}\right\}\)</p>
<p><strong>Jawaban: A</strong></p>',
            ],

            // ===================== Soal 4 =====================
            [
                'question_text' => '<p>Jika \(x_{1}\) dan \(x_{2}\) adalah akar-akar persamaan \(2x^{2}-8x+3=0\), nilai dari \(x_{1}^{2}+x_{2}^{2}\) adalah ....</p>',
                'options' => [
                    ['text' => '\(10\)', 'is_correct' => false],
                    ['text' => '\(13\)', 'is_correct' => true],
                    ['text' => '\(16\)', 'is_correct' => false],
                    ['text' => '\(19\)', 'is_correct' => false],
                    ['text' => '\(22\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Konsep:</strong> Rumus jumlah dan hasil kali akar (Vieta)</p>
<p>\(x_{1}+x_{2}=-\frac{b}{a}\) &nbsp; dan &nbsp; \(x_{1}\cdot x_{2}=\frac{c}{a}\)</p>
<p><strong>Langkah 1:</strong> Dari \(2x^{2}-8x+3=0\), diperoleh \(a=2\), \(b=-8\), \(c=3\).</p>
<p>\(x_{1}+x_{2}=-\frac{-8}{2}=4\)</p>
<p>\(x_{1}\cdot x_{2}=\frac{3}{2}\)</p>
<p><strong>Langkah 2:</strong> Gunakan identitas</p>
<p>\(x_{1}^{2}+x_{2}^{2}=\left(x_{1}+x_{2}\right)^{2}-2x_{1}x_{2}\)</p>
<p>\(=4^{2}-2\cdot\frac{3}{2}=16-3=13\)</p>
<p><strong>Jebakan:</strong> Opsi C \(\left(16\right)\) muncul jika lupa mengurangkan \(2x_{1}x_{2}\).</p>
<p><strong>Jawaban: B</strong> \(\left(13\right)\)</p>',
            ],

            // ===================== Soal 5 =====================
            [
                'question_text' => '<p>Persamaan kuadrat baru yang akar-akarnya tiga kurangnya dari akar-akar persamaan \(x^{2}+2x-4=0\) adalah ....</p>',
                'options' => [
                    ['text' => '\(x^{2}+8x+11=0\)', 'is_correct' => true],
                    ['text' => '\(x^{2}-4x-1=0\)', 'is_correct' => false],
                    ['text' => '\(x^{2}+8x+5=0\)', 'is_correct' => false],
                    ['text' => '\(x^{2}-4x+11=0\)', 'is_correct' => false],
                    ['text' => '\(x^{2}+2x-7=0\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Konsep:</strong> Trik invers (substitusi kebalikan)</p>
<p>Akar baru \(=\) akar lama \(-3\). Misalkan akar baru \(y=x-3\), maka \(x=y+3\).</p>
<p><strong>Langkah 1:</strong> Substitusi \(x=y+3\) ke persamaan awal.</p>
<p>\(\left(y+3\right)^{2}+2\left(y+3\right)-4=0\)</p>
<p><strong>Langkah 2:</strong> Jabarkan.</p>
<p>\(y^{2}+6y+9+2y+6-4=0\)</p>
<p>\(y^{2}+8y+11=0\)</p>
<p><strong>Langkah 3:</strong> Ganti kembali variabel \(y\) dengan \(x\).</p>
<p>\(x^{2}+8x+11=0\)</p>
<p><strong>Cek dengan Vieta:</strong> Persamaan awal punya \(x_{1}+x_{2}=-2\) dan \(x_{1}x_{2}=-4\).</p>
<p>Jumlah akar baru: \(\left(x_{1}-3\right)+\left(x_{2}-3\right)=-2-6=-8\)</p>
<p>Hasil kali akar baru: \(\left(x_{1}-3\right)\left(x_{2}-3\right)=x_{1}x_{2}-3\left(x_{1}+x_{2}\right)+9=-4+6+9=11\)</p>
<p>Sehingga \(x^{2}-\left(-8\right)x+11=0\Rightarrow x^{2}+8x+11=0\) ✔</p>
<p><strong>Jawaban: A</strong></p>',
            ],

            // ===================== Soal 6 =====================
            [
                'question_text' => '<p>Diketahui \(x^{2}-9x+20=0\). Jika \(P=x_{1}\cdot x_{2}\) dan \(Q=18\), manakah hubungan yang tepat antara \(P\) dan \(Q\)?</p>',
                'options' => [
                    ['text' => '\(P\gt Q\)', 'is_correct' => true],
                    ['text' => '\(P\lt Q\)', 'is_correct' => false],
                    ['text' => '\(P=Q\)', 'is_correct' => false],
                    ['text' => '\(P=Q+1\)', 'is_correct' => false],
                    ['text' => 'Informasi tidak cukup', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Langkah 1:</strong> Hitung \(P\) dengan rumus hasil kali akar.</p>
<p>\(P=x_{1}\cdot x_{2}=\frac{c}{a}=\frac{20}{1}=20\)</p>
<p><strong>Cek dengan pemfaktoran:</strong></p>
<p>\(x^{2}-9x+20=\left(x-4\right)\left(x-5\right)=0\Rightarrow x=4\) atau \(x=5\)</p>
<p>\(P=4\cdot 5=20\) ✔</p>
<p><strong>Langkah 2:</strong> Bandingkan dengan \(Q\).</p>
<p>\(P=20\) dan \(Q=18\), sehingga \(P\gt Q\).</p>
<p><strong>Catatan:</strong> Hasil kali akar bernilai tunggal (tidak bergantung pada urutan \(x_{1}\) dan \(x_{2}\)), sehingga hubungan dapat ditentukan.</p>
<p><strong>Jawaban: A</strong> \(\left(P\gt Q\right)\)</p>',
            ],

            // ===================== Soal 7 =====================
            [
                'question_text' => '<p>Diketahui \(y^{2}=49\) dan \(z=6\). Hubungan yang tepat antara \(y\) dan \(z\) adalah ....</p>',
                'options' => [
                    ['text' => '\(y\gt z\)', 'is_correct' => false],
                    ['text' => '\(y\lt z\)', 'is_correct' => false],
                    ['text' => '\(y=z\)', 'is_correct' => false],
                    ['text' => '\(y+z=13\)', 'is_correct' => false],
                    ['text' => 'Informasi tidak cukup', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Langkah 1:</strong> Selesaikan \(y^{2}=49\).</p>
<p>\(y=\pm\sqrt{49}\Rightarrow y=7\) atau \(y=-7\)</p>
<p><strong>Langkah 2:</strong> Uji kedua kemungkinan terhadap \(z=6\).</p>
<ul>
<li>Jika \(y=7\), maka \(7\gt 6\Rightarrow y\gt z\)</li>
<li>Jika \(y=-7\), maka \(-7\lt 6\Rightarrow y\lt z\)</li>
</ul>
<p><strong>Kesimpulan:</strong> Ada dua kemungkinan hubungan yang berbeda, sehingga hubungan \(y\) dan \(z\) <strong>tidak dapat ditentukan secara tunggal</strong>.</p>
<p><strong>Jebakan:</strong> Banyak yang langsung menjawab \(y=7\) dan memilih \(y\gt z\). Ingat, akar kuadrat dari sebuah persamaan \(y^{2}=k\) selalu menghasilkan nilai positif <em>dan</em> negatif.</p>
<p><strong>Jawaban: E</strong> (Informasi tidak cukup)</p>',
            ],

            // ===================== Soal 8 =====================
            [
                'question_text' => '<p>Untuk \(x\lt 0\), diketahui \(x^{2}+2x-15=0\). Jika \(P=x+8\) dan \(Q=3\), maka ....</p>',
                'options' => [
                    ['text' => '\(P\gt Q\)', 'is_correct' => false],
                    ['text' => '\(P\lt Q\)', 'is_correct' => false],
                    ['text' => '\(P=Q\)', 'is_correct' => true],
                    ['text' => '\(P=2Q\)', 'is_correct' => false],
                    ['text' => 'Informasi tidak cukup', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Langkah 1:</strong> Faktorkan persamaan kuadrat.</p>
<p>Cari dua bilangan yang hasil kalinya \(-15\) dan jumlahnya \(2\), yaitu \(5\) dan \(-3\).</p>
<p>\(x^{2}+2x-15=\left(x+5\right)\left(x-3\right)=0\)</p>
<p>\(x=-5\) atau \(x=3\)</p>
<p><strong>Langkah 2:</strong> Terapkan syarat \(x\lt 0\).</p>
<p>Nilai yang memenuhi hanya \(x=-5\).</p>
<p><strong>Langkah 3:</strong> Hitung \(P\).</p>
<p>\(P=x+8=-5+8=3\)</p>
<p><strong>Langkah 4:</strong> Bandingkan.</p>
<p>\(P=3\) dan \(Q=3\Rightarrow P=Q\)</p>
<p><strong>Catatan:</strong> Tanpa syarat \(x\lt 0\), jawabannya akan menjadi "Informasi tidak cukup" (karena \(x=3\) memberi \(P=11\)). Syarat inilah yang membuat jawabannya tunggal.</p>
<p><strong>Jawaban: C</strong> \(\left(P=Q\right)\)</p>',
            ],

            // ===================== Soal 9 =====================
            [
                'question_text' => '<p>Keliling sebuah taman berbentuk persegi panjang adalah \(30\text{ m}\) dan luasnya \(50\text{ m}^{2}\). Panjang taman tersebut adalah ....</p>',
                'options' => [
                    ['text' => '\(5\text{ m}\)', 'is_correct' => false],
                    ['text' => '\(8\text{ m}\)', 'is_correct' => false],
                    ['text' => '\(10\text{ m}\)', 'is_correct' => true],
                    ['text' => '\(12\text{ m}\)', 'is_correct' => false],
                    ['text' => '\(15\text{ m}\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Misalkan:</strong> panjang \(=p\) dan lebar \(=l\).</p>
<p><strong>Langkah 1:</strong> Susun persamaan dari informasi soal.</p>
<p>Keliling: \(2\left(p+l\right)=30\Rightarrow p+l=15\)</p>
<p>Luas: \(p\cdot l=50\)</p>
<p><strong>Langkah 2:</strong> Bentuk persamaan kuadrat. Karena \(p\) dan \(l\) memiliki jumlah \(15\) dan hasil kali \(50\), keduanya adalah akar-akar dari</p>
<p>\(t^{2}-15t+50=0\)</p>
<p><strong>Langkah 3:</strong> Faktorkan.</p>
<p>\(\left(t-10\right)\left(t-5\right)=0\Rightarrow t=10\) atau \(t=5\)</p>
<p><strong>Langkah 4:</strong> Panjang selalu lebih besar dari lebar, sehingga \(p=10\text{ m}\) dan \(l=5\text{ m}\).</p>
<p><strong>Cek:</strong> \(2\left(10+5\right)=30\) ✔ &nbsp; dan &nbsp; \(10\times 5=50\) ✔</p>
<p><strong>Jebakan:</strong> Opsi A \(\left(5\text{ m}\right)\) adalah lebar, bukan panjang. Opsi E \(\left(15\text{ m}\right)\) adalah \(p+l\).</p>
<p><strong>Jawaban: C</strong> \(\left(10\text{ m}\right)\)</p>',
            ],

            // ===================== Soal 10 =====================
            [
                'question_text' => '<p>Jumlah dua bilangan asli adalah \(15\) dan hasil kalinya \(54\). Selisih kedua bilangan tersebut adalah ....</p>',
                'options' => [
                    ['text' => '\(1\)', 'is_correct' => false],
                    ['text' => '\(2\)', 'is_correct' => false],
                    ['text' => '\(3\)', 'is_correct' => true],
                    ['text' => '\(4\)', 'is_correct' => false],
                    ['text' => '\(5\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Misalkan:</strong> kedua bilangan adalah \(a\) dan \(b\), dengan \(a+b=15\) dan \(a\cdot b=54\).</p>
<p><strong>Cara 1: Persamaan kuadrat</strong></p>
<p>\(a\) dan \(b\) adalah akar-akar dari \(t^{2}-15t+54=0\)</p>
<p>\(\left(t-9\right)\left(t-6\right)=0\Rightarrow t=9\) atau \(t=6\)</p>
<p>Selisih: \(9-6=3\)</p>
<p><strong>Cara 2: Identitas (tanpa mencari bilangannya)</strong></p>
<p>\(\left(a-b\right)^{2}=\left(a+b\right)^{2}-4ab\)</p>
<p>\(\left(a-b\right)^{2}=15^{2}-4\cdot 54=225-216=9\)</p>
<p>\(\left|a-b\right|=\sqrt{9}=3\)</p>
<p><strong>Jawaban: C</strong> \(\left(3\right)\)</p>',
            ],
        ];

        DB::transaction(function () use ($questions, $materialId, $now) {
            foreach ($questions as $question) {
                $questionId = DB::table('questions')->insertGetId([
                    'material_id'   => $materialId,
                    'type'          => 'mcq',
                    'test_type'     => 'general',
                    'question_text' => $question['question_text'],
                    'image'         => null,
                    'explanation'   => $question['explanation'],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);

                foreach ($question['options'] as $order => $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'is_correct'  => $option['is_correct'],
                        'image'       => null,
                        'order'       => $order + 1,
                        'weight'      => 0,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            }
        });

        $this->command->info('Seeder Persamaan Kuadrat berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
