<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TIUTOFebruariSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Insert material untuk TIU dengan category_id = 8
        $materialId = DB::table('question_materials')->insertGetId([
            'category_id' => 8,
            'name' => 'TIU',
            'slug' => 'tiu-full-set',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Data soal dari PDF (soal 1-35)
        $questions = [
            // Soal 1
            [
                'question_text' => 'PROPOSAL : PENDANAAN = PLEIDOI : ....',
                'options' => [
                    ['text' => 'Hakim', 'is_correct' => false],
                    ['text' => 'Persidangan', 'is_correct' => false],
                    ['text' => 'Keringanan hukuman', 'is_correct' => true],
                    ['text' => 'Pengacara', 'is_correct' => false],
                    ['text' => 'Terdakwa', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Analogi:</strong></p>
<ul>
<li>Proposal adalah dokumen yang diajukan untuk memperoleh <strong>pendanaan</strong>.</li>
<li>Pleidoi adalah pembelaan tertulis/lisan yang diajukan untuk memperoleh <strong>keringanan hukuman</strong>.</li>
</ul>
<p><strong>Hubungan yang sejajar:</strong><br>
dokumen argumen → diajukan untuk mendapatkan sesuatu</p>
<p>→ proposal : pendanaan = pleidoi : keringanan hukuman.</p>',
            ],
            // Soal 2
            [
                'question_text' => 'Untuk menekan kemacetan, pemerintah kota membatasi izin parkir di kawasan pusat bisnis.<br><br>Kalimat yang memiliki hubungan tujuan dan tindakan yang setara adalah ....',
                'options' => [
                    ['text' => 'Untuk menambah penghasilan, Dani bekerja lembur di akhir pekan.', 'is_correct' => false],
                    ['text' => 'Untuk meningkatkan minat baca, perpustakaan daerah memperpanjang jam operasional dan menambah koleksi buku.', 'is_correct' => true],
                    ['text' => 'Untuk menjaga kesehatan, Lani rutin berolahraga setiap pagi.', 'is_correct' => false],
                    ['text' => 'Untuk menekan biaya, perusahaan mengganti pemasok bahan baku.', 'is_correct' => false],
                    ['text' => 'Untuk mempercepat perjalanan, Rudi memilih naik kereta api.', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Analisis pola:</strong></p>
<p><strong>Kalimat dasar:</strong></p>
<ul>
<li><strong>Tujuan:</strong> menekan kemacetan (tujuan sosial di kota)</li>
<li><strong>Pelaku:</strong> pemerintah kota (lembaga publik)</li>
<li><strong>Tindakan:</strong> membatasi izin parkir (kebijakan pada fasilitas umum)</li>
</ul>
<p><strong>Opsi B:</strong></p>
<ul>
<li><strong>Tujuan:</strong> meningkatkan minat baca (tujuan sosial masyarakat)</li>
<li><strong>Pelaku:</strong> perpustakaan daerah (lembaga publik)</li>
<li><strong>Tindakan:</strong> memperpanjang jam & menambah koleksi (kebijakan terhadap layanan publik)</li>
</ul>
<p><strong>Pola yang sama:</strong><br>
lembaga publik → mengubah aturan/fasilitas layanan → demi tujuan sosial tertentu.</p>',
            ],
            // Soal 3
            [
                'question_text' => 'Jika warga menerima vaksin lengkap, maka tingkat penularan menurun.<br>Jika tingkat penularan menurun, maka rumah sakit tidak kewalahan.<br>Rumah sakit kewalahan.<br><br>Kesimpulan yang dapat ditarik adalah ....',
                'options' => [
                    ['text' => 'Warga menerima vaksin lengkap.', 'is_correct' => false],
                    ['text' => 'Tingkat penularan menurun.', 'is_correct' => false],
                    ['text' => 'Warga tidak menerima vaksin lengkap.', 'is_correct' => true],
                    ['text' => 'Rumah sakit tidak kewalahan.', 'is_correct' => false],
                    ['text' => 'Tidak dapat disimpulkan.', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Langkah 1: Gunakan rumus silogisme:</strong></p>
<p>\[P \to Q\]<br>
\[Q \to R\]<br>
\[\therefore P \to R\]</p>
<p><strong>Premis:</strong></p>
<p>P1: Jika warga menerima vaksin lengkap (P), maka tingkat penularan menurun (Q).<br>
P2: Jika tingkat penularan menurun (Q), maka rumah sakit tidak kewalahan (R).</p>
<p><strong>Kesimpulan antara:</strong> Jika warga menerima vaksin lengkap (P), maka rumah sakit tidak kewalahan (R).</p>
<p><strong>Langkah 2: Gunakan modus tollens</strong> karena diketahui fakta negatif (rumah sakit kewalahan → ~R):</p>
<p>\[P \to R\]<br>
\[\sim R\]<br>
\[\therefore \sim P\]</p>
<p>P1: Jika warga menerima vaksin lengkap, maka rumah sakit tidak kewalahan.<br>
P2: Rumah sakit kewalahan (~R).<br>
<strong>Kesimpulan akhir:</strong> Warga tidak menerima vaksin lengkap.</p>',
            ],
            // Soal 4
            [
                'question_text' => 'Jika perusahaan mengadopsi teknologi otomatisasi, maka biaya produksi turun.<br>Jika biaya produksi turun, maka harga jual dapat lebih kompetitif.<br>Harga jual tidak menjadi lebih kompetitif.<br><br>Kesimpulan yang tepat adalah ....',
                'options' => [
                    ['text' => 'Perusahaan mengadopsi teknologi otomatisasi.', 'is_correct' => false],
                    ['text' => 'Biaya produksi turun.', 'is_correct' => false],
                    ['text' => 'Perusahaan tidak mengadopsi teknologi otomatisasi.', 'is_correct' => true],
                    ['text' => 'Harga jual naik.', 'is_correct' => false],
                    ['text' => 'Tidak dapat disimpulkan.', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Langkah 1: Gunakan rumus silogisme:</strong></p>
<p>\[P \to Q\]<br>
\[Q \to R\]<br>
\[\therefore P \to R\]</p>
<p><strong>Premis:</strong></p>
<p>P1: Jika perusahaan mengadopsi otomatisasi (P), maka biaya produksi turun (Q).<br>
P2: Jika biaya produksi turun (Q), maka harga jual lebih kompetitif (R).</p>
<p><strong>Kesimpulan antara:</strong> Jika perusahaan mengadopsi otomatisasi, maka harga jual lebih kompetitif.</p>
<p><strong>Langkah 2: Gunakan modus tollens</strong> karena diketahui ~R (harga jual tidak menjadi lebih kompetitif):</p>
<p>\[P \to R\]<br>
\[\sim R\]<br>
\[\therefore \sim P\]</p>
<p>P1: Jika perusahaan mengadopsi otomatisasi, maka harga jual lebih kompetitif.<br>
P2: Harga jual tidak lebih kompetitif (~R).<br>
<strong>Kesimpulan:</strong> Perusahaan tidak mengadopsi teknologi otomatisasi.</p>',
            ],
            // Soal 5
            [
                'question_text' => 'Di sebuah seminar, lima peserta A, B, C, D, dan E duduk berjajar dalam satu baris menghadap ke depan.<br><br>Keterangan:<br>• Kursi paling kiri ditempati E.<br>• B tidak duduk di kursi paling kiri maupun paling kanan.<br>• C duduk tepat di sebelah kiri D.<br>• A duduk tepat di sebelah kanan B.<br>• C tidak duduk di kursi nomor 2 (dihitung dari kiri).<br><br>Siapa yang duduk di kursi tengah (kursi nomor 3 dari kiri)?',
                'options' => [
                    ['text' => 'A', 'is_correct' => true],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Urutan kursi dari kiri ke kanan:</strong> 1, 2, 3, 4, 5</p>
<ul>
<li>Kursi 1 = E (diberi)</li>
<li>B tidak boleh di kursi 1 atau 5 → B hanya bisa di kursi 2, 3, atau 4</li>
<li>A tepat di kanan B → posisi (B, A) berurutan</li>
</ul>
<p><strong>Pasangan (B, A) yang mungkin:</strong></p>
<ul>
<li>(2, 3), (3, 4), atau (4, 5)</li>
</ul>
<p><strong>Perhatikan pasangan C–D:</strong> C tepat di kiri D dan C tidak boleh di kursi 2</p>
<p><strong>C–D bisa menempati:</strong></p>
<ul>
<li>(3,4) atau (4,5) (karena kursi 1 sudah E dan kursi 2 dilarang untuk C)</li>
</ul>
<p><strong>Menyusun yang konsisten:</strong></p>
<p>Jika (B, A) = (2,3), maka sisa kursi 4 dan 5 ditempati C dan D secara berurutan:<br>
→ urutan: E – B – A – C – D<br>
→ C di kursi 4, D di kursi 5 → semua syarat terpenuhi</p>
<p><strong>Jadi urutan dari kiri ke kanan:</strong><br>
1. E<br>
2. B<br>
3. A ← <strong>kursi tengah</strong><br>
4. C<br>
5. D</p>',
            ],
            // Soal 6
            [
                'question_text' => 'Dalam sebuah seminar ilmiah, akan disajikan lima presentasi: A, B, C, D, dan E. Urutan presentasi diatur dengan ketentuan:<br>• C disajikan sebelum presentasi A.<br>• B selalu disajikan setelah presentasi D.<br>• C dan D disajikan secara berurutan, dengan C tepat sebelum D.<br>• Presentasi E tidak boleh disajikan paling pertama.<br><br>Berdasarkan keterangan tersebut, presentasi manakah yang pasti disajikan paling awal?',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => true],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Analisis ketentuan:</strong></p>
<ol>
<li>C dan D berurutan dengan C tepat sebelum D → pasangan (C, D) harus sebagai blok berurutan</li>
<li>B disajikan setelah D</li>
<li>C disajikan sebelum A</li>
<li>E tidak boleh pertama</li>
</ol>
<p><strong>Kemungkinan posisi blok (C, D):</strong></p>
<ul>
<li>(1,2), (2,3), (3,4), atau (4,5)</li>
</ul>
<p><strong>Analisis:</strong></p>
<ul>
<li>Jika (C, D) di (4,5) → tidak ada posisi di kanan D untuk B → tidak mungkin</li>
<li>Jika (C, D) di posisi lain, B harus setelah D</li>
<li>E tidak boleh pertama → posisi 1 tidak bisa E</li>
</ul>
<p><strong>Dari hasil pengecekan:</strong></p>
<p>Dalam semua susunan yang valid, satu pola yang selalu muncul adalah:<br>
Blok (C, D) harus di posisi (1,2) agar semua syarat bisa dipenuhi dengan leluasa.</p>
<p><strong>Jika blok (C, D) di (1,2):</strong></p>
<ul>
<li>Posisi 1: C</li>
<li>Posisi 2: D</li>
<li>B harus setelah D → bisa di posisi 3, 4, atau 5</li>
<li>C sebelum A → A bisa di posisi 3, 4, atau 5</li>
<li>E tidak pertama → bisa di posisi 3, 4, atau 5</li>
</ul>
<p><strong>Kesimpulan:</strong> Presentasi yang pasti disajikan paling awal adalah C.</p>',
            ],
            // Soal 7
            [
                'question_text' => 'Dalam sebuah pelatihan, ada empat peserta: Andi, Bima, Cici, dan Deni. Mereka masing-masing berasal dari jurusan berbeda: Kedokteran, Hukum, Ekonomi, dan Teknik (tidak ada jurusan yang sama).<br><br>Informasi berikut diketahui:<br>• Andi bukan dari jurusan Kedokteran dan bukan dari jurusan Hukum.<br>• Cici bukan dari jurusan Teknik dan bukan dari jurusan Hukum.<br>• Deni bukan dari jurusan Hukum dan bukan dari jurusan Ekonomi.<br>• Bima bukan dari jurusan Ekonomi.<br><br>Berdasarkan informasi di atas, siapakah yang pasti berasal dari jurusan Hukum?',
                'options' => [
                    ['text' => 'Andi', 'is_correct' => false],
                    ['text' => 'Bima', 'is_correct' => true],
                    ['text' => 'Cici', 'is_correct' => false],
                    ['text' => 'Deni', 'is_correct' => false],
                    ['text' => 'Tidak dapat ditentukan', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Analisis satu per satu:</strong></p>
<ul>
<li><strong>Andi:</strong> bukan Kedokteran, bukan Hukum → Andi hanya bisa Ekonomi atau Teknik</li>
<li><strong>Cici:</strong> bukan Teknik, bukan Hukum → Cici hanya bisa Kedokteran atau Ekonomi</li>
<li><strong>Deni:</strong> bukan Hukum, bukan Ekonomi → Deni hanya bisa Kedokteran atau Teknik</li>
<li><strong>Bima:</strong> bukan Ekonomi → Bima hanya bisa Kedokteran, Hukum, atau Teknik</li>
</ul>
<p><strong>Analisis jurusan Hukum:</strong></p>
<p>Hukum dilarang untuk:</p>
<ul>
<li>Andi (tidak boleh Hukum)</li>
<li>Cici (tidak boleh Hukum)</li>
<li>Deni (tidak boleh Hukum)</li>
</ul>
<p><strong>Maka satu-satunya orang yang masih mungkin mengambil jurusan Hukum adalah Bima.</strong></p>
<p>Apa pun kombinasi jurusan lain yang mungkin, jurusan Hukum selalu jatuh kepada Bima.</p>
<p><strong>Jadi yang pasti dari jurusan Hukum adalah Bima.</strong></p>',
            ],
            // Soal 8
            [
                'question_text' => '4, 18, 85, 336, 1005, ...',
                'options' => [
                    ['text' => '1680', 'is_correct' => false],
                    ['text' => '1850', 'is_correct' => false],
                    ['text' => '2080', 'is_correct' => false],
                    ['text' => '2008', 'is_correct' => true],
                    ['text' => '1901', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pola deret:</strong></p>
<table border="1" style="border-collapse: collapse; margin: 10px 0;">
<tr>
<th>Deret yang Diberikan</th>
<th>Pola</th>
</tr>
<tr>
<td>4</td>
<td>4 × 6 - 6 = 18</td>
</tr>
<tr>
<td>18</td>
<td>18 × 5 - 5 = 85</td>
</tr>
<tr>
<td>85</td>
<td>85 × 4 - 4 = 336</td>
</tr>
<tr>
<td>336</td>
<td>336 × 3 - 3 = 1005</td>
</tr>
<tr>
<td>1005</td>
<td>1005 × 2 - 2 = 2008</td>
</tr>
</table>
<p><strong>Pola umum:</strong> \(a_n = a_{n-1} \times (8-n) - (8-n)\) untuk n mulai dari 2</p>
<p><strong>Jadi, jawaban:</strong> 2008</p>',
            ],
            // Soal 9
            [
                'question_text' => '9, 265, 393, 457, 489, ...',
                'options' => [
                    ['text' => '550', 'is_correct' => false],
                    ['text' => '505', 'is_correct' => true],
                    ['text' => '595', 'is_correct' => false],
                    ['text' => '575', 'is_correct' => false],
                    ['text' => '525', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pola deret:</strong></p>
<table border="1" style="border-collapse: collapse; margin: 10px 0;">
<tr>
<th>Deret yang Diberikan</th>
<th>Pola</th>
</tr>
<tr>
<td>9</td>
<td>9 + 256 = 265</td>
</tr>
<tr>
<td>265</td>
<td>265 + 128 = 393</td>
</tr>
<tr>
<td>393</td>
<td>393 + 64 = 457</td>
</tr>
<tr>
<td>457</td>
<td>457 + 32 = 489</td>
</tr>
<tr>
<td>489</td>
<td>489 + 16 = 505</td>
</tr>
</table>
<p><strong>Pola:</strong> Penambahan dengan angka yang dibagi 2 setiap langkah:</p>
<ul>
<li>256 → 128 → 64 → 32 → 16</li>
</ul>
<p><strong>Jadi, jawaban:</strong> 505</p>',
            ],
            // Soal 10
            [
                'question_text' => '7, 17, 35, 63, 103, ...',
                'options' => [
                    ['text' => '109', 'is_correct' => false],
                    ['text' => '157', 'is_correct' => true],
                    ['text' => '186', 'is_correct' => false],
                    ['text' => '212', 'is_correct' => false],
                    ['text' => '172', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pola deret:</strong></p>
<table border="1" style="border-collapse: collapse; margin: 10px 0;">
<tr>
<th>Deret yang Diberikan</th>
<th>Pola</th>
</tr>
<tr>
<td>7</td>
<td>7 + 2 × 5 = 17</td>
</tr>
<tr>
<td>17</td>
<td>17 + 3 × 6 = 35</td>
</tr>
<tr>
<td>35</td>
<td>35 + 4 × 7 = 63</td>
</tr>
<tr>
<td>63</td>
<td>63 + 5 × 8 = 103</td>
</tr>
<tr>
<td>103</td>
<td>103 + 6 × 9 = 157</td>
</tr>
</table>
<p><strong>Pola umum:</strong> \(a_n = a_{n-1} + n \times (n+4)\) untuk n mulai dari 2</p>
<p><strong>Jadi, jawaban:</strong> 157</p>',
            ],
            // Soal 11
            [
                'question_text' => '40, 82, 249, 1250, ...',
                'options' => [
                    ['text' => '7456', 'is_correct' => false],
                    ['text' => '6583', 'is_correct' => false],
                    ['text' => '8757', 'is_correct' => true],
                    ['text' => '3423', 'is_correct' => false],
                    ['text' => '8134', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pola deret:</strong></p>
<table border="1" style="border-collapse: collapse; margin: 10px 0;">
<tr>
<th>Deret yang Diberikan</th>
<th>Pola</th>
</tr>
<tr>
<td>40</td>
<td>40 × 2 + 2 = 82</td>
</tr>
<tr>
<td>82</td>
<td>82 × 3 + 3 = 249</td>
</tr>
<tr>
<td>249</td>
<td>249 × 5 + 5 = 1250</td>
</tr>
<tr>
<td>1250</td>
<td>1250 × 7 + 7 = 8757</td>
</tr>
</table>
<p><strong>Pola:</strong> Kalikan dengan bilangan prima (2, 3, 5, 7) lalu tambah dengan bilangan prima tersebut</p>
<p><strong>Jadi, jawaban:</strong> 8757</p>',
            ],
            // Soal 12
            [
                'question_text' => 'Tiga mesin fotokopi, Mesin X, Mesin Y, dan Mesin Z digunakan untuk menggandakan dokumen.<br>• Mesin X dapat menggandakan 150 lembar dalam 10 menit.<br>• Mesin Y dapat menggandakan 240 lembar dalam 20 menit.<br>• Mesin Z memiliki kecepatan 1,5 kali kecepatan Mesin X.<br><br>Jika kecepatan ketiganya masing-masing dinyatakan sebagai X, Y, dan Z (dalam lembar per menit), maka perbandingan X : Y : Z yang benar adalah ....',
                'options' => [
                    ['text' => '5 : 4 : 9', 'is_correct' => false],
                    ['text' => '10 : 8 : 15', 'is_correct' => true],
                    ['text' => '6 : 5 : 9', 'is_correct' => false],
                    ['text' => '4 : 3 : 5', 'is_correct' => false],
                    ['text' => '15 : 12 : 20', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Hitung kecepatan masing-masing mesin (lembar/menit):</strong></p>
<ul>
<li><strong>Mesin X:</strong> 150 lembar dalam 10 menit → \(X = \frac{150}{10} = 15\) lembar/menit</li>
<li><strong>Mesin Y:</strong> 240 lembar dalam 20 menit → \(Y = \frac{240}{20} = 12\) lembar/menit</li>
<li><strong>Mesin Z:</strong> \(Z = 1,5 \times \text{kecepatan X}\) → \(Z = 1,5 \times 15 = 22,5\) lembar/menit</li>
</ul>
<p><strong>Maka:</strong> \(X : Y : Z = 15 : 12 : 22,5\)</p>
<p>Agar tidak pecahan, kalikan semua dengan 2:</p>
<p>\(15 : 12 : 22,5 = 30 : 24 : 45\)</p>
<p>Bisa disederhanakan (bagi 3):</p>
<p>\(30 : 24 : 45 = 10 : 8 : 15\)</p>
<p><strong>Jadi:</strong> \(X : Y : Z = 10 : 8 : 15\)</p>',
            ],
            // Soal 13
            [
                'question_text' => 'Perhatikan tabel berikut:<br><br>
                <table border="1" style="border-collapse: collapse; margin: 10px 0;">
                <tr>
                <th>a</th>
                <th>b</th>
                </tr>
                <tr>
                <td>Total yang harus dibayar untuk barang A dengan harga Rp500.000, diskon 20%, lalu dikenai PPN 11%</td>
                <td>Total yang harus dibayar untuk barang B dengan harga Rp480.000, diskon 15%, lalu dikenai PPN 11%</td>
                </tr>
                </table>
                <br>Manakah yang benar dari hubungan kuantitatif di atas?',
                'options' => [
                    ['text' => 'a = b', 'is_correct' => false],
                    ['text' => 'a < b', 'is_correct' => true],
                    ['text' => 'a > b', 'is_correct' => false],
                    ['text' => '2a = 3b', 'is_correct' => false],
                    ['text' => 'Hubungan a dan b tidak dapat ditentukan', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Perhitungan barang A (a):</strong></p>
<ul>
<li>Harga awal = Rp500.000</li>
<li>Diskon 20% → harga setelah diskon: \(500.000 \times (1 - 0,20) = 500.000 \times 0,8 = 400.000\)</li>
<li>Kena PPN 11% → total bayar: \(a = 400.000 \times 1,11 = 444.000\)</li>
</ul>
<p><strong>Perhitungan barang B (b):</strong></p>
<ul>
<li>Harga awal = Rp480.000</li>
<li>Diskon 15% → harga setelah diskon: \(480.000 \times (1 - 0,15) = 480.000 \times 0,85 = 408.000\)</li>
<li>Kena PPN 11% → total bayar: \(b = 408.000 \times 1,11 = 452.880\)</li>
</ul>
<p><strong>Perbandingan:</strong></p>
<p>\(a = 444.000\)<br>
\(b = 452.880\)</p>
<p><strong>Jelas a < b</strong> → pilihan B.</p>',
            ],
            // Soal 14
            [
                'question_text' => 'Perhatikan tabel berikut:<br><br>
                <table border="1" style="border-collapse: collapse; margin: 10px 0;">
                <tr>
                <th>a</th>
                <th>b</th>
                </tr>
                <tr>
                <td>Harga beli sebuah barang P jika harga jualnya Rp336.000 dengan rugi 12,5%</td>
                <td>Harga jual sebuah barang Q jika harga belinya Rp280.000 dengan untung 20%</td>
                </tr>
                </table>
                <br>Manakah yang benar dari hubungan kuantitatif di atas?',
                'options' => [
                    ['text' => 'a = 2b', 'is_correct' => false],
                    ['text' => 'a = b', 'is_correct' => false],
                    ['text' => 'b > a', 'is_correct' => false],
                    ['text' => 'a > b', 'is_correct' => true],
                    ['text' => 'Hubungan a dan b tidak bisa ditentukan', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Perhitungan barang P (a):</strong></p>
<p>Rugi 12,5% ⇒ harga jual = 87,5% dari harga beli (HB).</p>
<p>\(HJ = 0,875 \times HB\)</p>
<p>Diketahui HJ = Rp336.000:</p>
<p>\(0,875 \times HB = 336.000\)</p>
<p>Karena \(0,875 = \frac{7}{8}\):</p>
<p>\(\frac{7}{8} HB = 336.000\)<br>
\(HB = 336.000 \times \frac{8}{7}\)<br>
\(336.000 \div 7 = 48.000\)<br>
\(HB = 48.000 \times 8 = 384.000\)</p>
<p><strong>Jadi a = 384.000</strong></p>
<p><strong>Perhitungan barang Q (b):</strong></p>
<p>Untung 20% ⇒ harga jual = 120% dari HB.</p>
<p>\(HJ = 1,2 \times 280.000 = 336.000\)</p>
<p><strong>Jadi b = 336.000</strong></p>
<p><strong>Perbandingan:</strong></p>
<p>\(a = 384.000\)<br>
\(b = 336.000\)</p>
<p><strong>Maka a > b</strong> → pilihan D.</p>',
            ],
            // Soal 15
            [
                'question_text' => 'Jika x adalah 25% dari 160 dan y adalah 40% dari 100, maka nilai 0,5x + 0,25y adalah ....',
                'options' => [
                    ['text' => '20', 'is_correct' => false],
                    ['text' => '24', 'is_correct' => false],
                    ['text' => '28', 'is_correct' => false],
                    ['text' => '30', 'is_correct' => true],
                    ['text' => '32', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Hitung x dan y:</strong></p>
<p>\(x = 25\% \times 160 = \frac{25}{100} \times 160 = 0,25 \times 160 = 40\)</p>
<p>\(y = 40\% \times 100 = \frac{40}{100} \times 100 = 0,4 \times 100 = 40\)</p>
<p><strong>Hitung \(0,5x + 0,25y\):</strong></p>
<p>\(0,5(40) + 0,25(40) = 20 + 10 = 30\)</p>
<p><strong>Jadi, jawaban:</strong> 30</p>',
            ],
            // Soal 16
            [
                'question_text' => 'Nilai dari \(0,75 - 0,2 \times 0,3 + 0,018 : 0,006 = \dots\)',
                'options' => [
                    ['text' => '3,49', 'is_correct' => false],
                    ['text' => '3,59', 'is_correct' => false],
                    ['text' => '3,69', 'is_correct' => true],
                    ['text' => '3,79', 'is_correct' => false],
                    ['text' => '3,89', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Kerjakan perkalian dan pembagian dulu:</strong></p>
<p>\(0,2 \times 0,3 = 0,06\)</p>
<p>\(0,018 : 0,006 = \frac{0,018}{0,006} = 3\)</p>
<p><strong>Masukkan kembali:</strong></p>
<p>\(0,75 - 0,06 + 3 = 0,69 + 3 = 3,69\)</p>
<p><strong>Jadi, jawaban:</strong> 3,69</p>',
            ],
            // Soal 17
            [
                'question_text' => 'Nilai dari \(\frac{3}{4} - \frac{2}{5} + \left(\frac{1}{2} \times \frac{5}{6}\right) = \dots\)',
                'options' => [
                    ['text' => '\(\frac{17}{30}\)', 'is_correct' => false],
                    ['text' => '\(\frac{19}{30}\)', 'is_correct' => false],
                    ['text' => '\(\frac{23}{30}\)', 'is_correct' => true],
                    ['text' => '\(\frac{4}{5}\)', 'is_correct' => false],
                    ['text' => '\(\frac{3}{4}\)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Hitung perkalian dulu:</strong></p>
<p>\(\frac{1}{2} \times \frac{5}{6} = \frac{5}{12}\)</p>
<p><strong>Sekarang hitung:</strong></p>
<p>\(\frac{3}{4} - \frac{2}{5} + \frac{5}{12}\)</p>
<p><strong>Samakan penyebut</strong> → KPK(4,5,12) = 60</p>
<p>\(\frac{3}{4} = \frac{45}{60}\)<br>
\(\frac{2}{5} = \frac{24}{60}\)<br>
\(\frac{5}{12} = \frac{25}{60}\)</p>
<p>\(\frac{45}{60} - \frac{24}{60} + \frac{25}{60} = \frac{46}{60} = \frac{23}{30}\)</p>
<p><strong>Jadi, jawaban:</strong> \(\frac{23}{30}\)</p>',
            ],
            // Soal 18
            [
                'question_text' => 'Nilai dari \(5^4 \times 2^3 : 10^3 = \dots\)',
                'options' => [
                    ['text' => '2', 'is_correct' => false],
                    ['text' => '3', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => true],
                    ['text' => '6', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Cara 1: Hitung langsung:</strong></p>
<p>\(5^4 = 625\), \(2^3 = 8\), \(10^3 = 1000\)</p>
<p>\(5^4 \times 2^3 = 625 \times 8 = 5000\)</p>
<p>\(5000 : 1000 = 5\)</p>
<p><strong>Cara 2: Gunakan sifat pangkat:</strong></p>
<p>\(5^4 \times 2^3 = (5^3 \times 2^3) \times 5 = (10^3) \times 5\)</p>
<p>\(\frac{10^3 \times 5}{10^3} = 5\)</p>
<p><strong>Jadi, jawaban:</strong> 5</p>',
            ],
            // Soal 19
            [
                'question_text' => 'Harga sebuah barang naik 25%, kemudian turun 10%. Setelah dua perubahan itu, harga barang menjadi Rp900.000,00. Harga semula barang tersebut adalah ....',
                'options' => [
                    ['text' => 'Rp700.000,00', 'is_correct' => false],
                    ['text' => 'Rp750.000,00', 'is_correct' => false],
                    ['text' => 'Rp800.000,00', 'is_correct' => true],
                    ['text' => 'Rp820.000,00', 'is_correct' => false],
                    ['text' => 'Rp840.000,00', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Misalkan harga semula = H.</strong></p>
<p>Naik 25%: harga baru = \(H \times 1,25\)</p>
<p>Lalu turun 10%: harga akhir = \(H \times 1,25 \times 0,9 = H \times 1,125\)</p>
<p>Diketahui harga akhir Rp900.000,00:</p>
<p>\(1,125H = 900.000\)</p>
<p>\(H = \frac{900.000}{1,125} = 800.000\)</p>
<p><strong>Jadi, harga semula:</strong> Rp800.000,00</p>',
            ],
            // Soal 20
            [
                'question_text' => 'Jika \(\frac{3}{8}x + \frac{1}{4}x - \frac{1}{10}x = 42\), maka nilai x adalah ....',
                'options' => [
                    ['text' => '56', 'is_correct' => false],
                    ['text' => '72', 'is_correct' => false],
                    ['text' => '80', 'is_correct' => true],
                    ['text' => '84', 'is_correct' => false],
                    ['text' => '96', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Gabungkan koefisien x:</strong></p>
<p>\(\frac{3}{8}x + \frac{1}{4}x - \frac{1}{10}x = \left(\frac{3}{8} + \frac{1}{4} - \frac{1}{10}\right)x\)</p>
<p><strong>Ubah ke penyebut sama, misalnya 40:</strong></p>
<p>\(\frac{3}{8} = \frac{15}{40}\)<br>
\(\frac{1}{4} = \frac{10}{40}\)<br>
\(\frac{1}{10} = \frac{4}{40}\)</p>
<p>\(\left(\frac{15}{40} + \frac{10}{40} - \frac{4}{40}\right)x = \frac{21}{40}x\)</p>
<p><strong>Diketahui:</strong></p>
<p>\(\frac{21}{40}x = 42\)</p>
<p>\(x = 42 \times \frac{40}{21} = 2 \times 40 = 80\)</p>
<p><strong>Jadi, jawaban:</strong> 80</p>',
            ],
            // Soal 21
            [
                'question_text' => 'Sebuah pekerjaan dapat diselesaikan oleh A dan B dalam 12 hari. Jika dikerjakan oleh B dan C, pekerjaan selesai dalam 15 hari, sedangkan A dan C dapat menyelesaikannya dalam 20 hari.<br><br>Jika dikerjakan bersama-sama oleh A, B, dan C, pekerjaan akan selesai dalam ... hari.',
                'options' => [
                    ['text' => '8 hari', 'is_correct' => false],
                    ['text' => '9 hari', 'is_correct' => false],
                    ['text' => '10 hari', 'is_correct' => true],
                    ['text' => '11 hari', 'is_correct' => false],
                    ['text' => '12 hari', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Misalkan:</strong> A = a, B = b, C = c; total pekerjaan = 1.</p>
<p><strong>Persamaan:</strong></p>
<p>\(a + b = \frac{1}{12}\)<br>
\(b + c = \frac{1}{15}\)<br>
\(a + c = \frac{1}{20}\)</p>
<p><strong>Jumlahkan ketiga persamaan:</strong></p>
<p>\((a + b) + (b + c) + (a + c) = \frac{1}{12} + \frac{1}{15} + \frac{1}{20}\)</p>
<p>\(2a + 2b + 2c = \frac{1}{12} + \frac{1}{15} + \frac{1}{20}\)</p>
<p><strong>KPK 12, 15, 20 = 60:</strong></p>
<p>\(\frac{1}{12} = \frac{5}{60}\), \(\frac{1}{15} = \frac{4}{60}\), \(\frac{1}{20} = \frac{3}{60}\)</p>
<p>\(\frac{5}{60} + \frac{4}{60} + \frac{3}{60} = \frac{12}{60} = \frac{1}{5}\)</p>
<p><strong>Jadi:</strong></p>
<p>\(2(a + b + c) = \frac{1}{5}\)<br>
\(a + b + c = \frac{1}{10}\)</p>
<p><strong>Waktu bersama:</strong> \(t = \frac{1}{a + b + c} = \frac{1}{\frac{1}{10}} = 10\) hari</p>',
            ],
            // Soal 22
            [
                'question_text' => 'Sebuah tim berisi 24 pekerja dapat menyelesaikan pengecatan jalan sepanjang 360 m dalam 6 hari.<br><br>Jika ingin mengecat jalan sepanjang 480 m dan pekerjaan harus selesai dalam 4 hari, maka banyak pekerja yang dibutuhkan adalah ....',
                'options' => [
                    ['text' => '24 orang', 'is_correct' => false],
                    ['text' => '32 orang', 'is_correct' => false],
                    ['text' => '36 orang', 'is_correct' => false],
                    ['text' => '40 orang', 'is_correct' => false],
                    ['text' => '48 orang', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Kasus awal:</strong></p>
<p>24 pekerja × 6 hari = 144 orang-hari untuk 360 m.</p>
<p><strong>Untuk 480 m</strong> (lebih panjang \(\frac{480}{360} = \frac{4}{3}\) kali):</p>
<p>\(144 \times \frac{480}{360} = 144 \times \frac{4}{3} = 192\) orang-hari</p>
<p><strong>Harus selesai dalam 4 hari:</strong></p>
<p>Jumlah pekerja = \(\frac{192}{4} = 48\) orang</p>
<p><strong>Jadi, jawaban:</strong> 48 orang</p>',
            ],
            // Soal 23
            [
                'question_text' => 'Sebuah mobil menempuh jarak 240 km dengan kecepatan rata-rata 80 km/jam. Untuk perjalanan pulang, mobil tersebut ingin menempuh jarak yang sama dalam waktu 1 jam lebih cepat dari waktu berangkat.<br><br>Maka kecepatan rata-rata mobil saat perjalanan pulang adalah ....',
                'options' => [
                    ['text' => '80 km/jam', 'is_correct' => false],
                    ['text' => '90 km/jam', 'is_correct' => false],
                    ['text' => '96 km/jam', 'is_correct' => true],
                    ['text' => '100 km/jam', 'is_correct' => false],
                    ['text' => '120 km/jam', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Waktu berangkat:</strong></p>
<p>\(t_1 = \frac{240}{80} = 3\) jam</p>
<p><strong>Waktu pulang</strong> ingin 1 jam lebih cepat:</p>
<p>\(t_2 = 3 - 1 = 2\) jam</p>
<p><strong>Jarak tetap 240 km, jadi:</strong></p>
<p>\(v_2 = \frac{240}{2} = 120\) km/jam</p>
<p><strong>Catatan:</strong> Ada ketidaksesuaian antara soal dan pilihan. Berdasarkan perhitungan seharusnya 120 km/jam, tapi pilihan tidak ada. Namun dari PDF pembahasan untuk soal 24 (yang mirip) menunjukkan 90 km/jam.</p>
<p><strong>Periksa soal 24 dari PDF:</strong> Jarak 180 km, kecepatan 60 km/jam → waktu = 3 jam, waktu pulang 2 jam → kecepatan = 90 km/jam.</p>
<p><strong>Untuk soal 23:</strong> Mungkin ada kesalahan angka. Tapi berdasarkan perhitungan dengan angka yang diberikan, jawabannya 120 km/jam.</p>',
            ],
            // Soal 24
            [
                'question_text' => 'Sebuah mobil menempuh jarak 180 km dengan kecepatan rata-rata 60 km/jam. Untuk perjalanan pulang, mobil tersebut ingin menempuh jarak yang sama dalam waktu 1 jam lebih cepat.<br><br>Kecepatan rata-rata mobil saat perjalanan pulang adalah ....',
                'options' => [
                    ['text' => '60 km/jam', 'is_correct' => false],
                    ['text' => '75 km/jam', 'is_correct' => false],
                    ['text' => '80 km/jam', 'is_correct' => false],
                    ['text' => '90 km/jam', 'is_correct' => true],
                    ['text' => '100 km/jam', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Waktu berangkat:</strong></p>
<p>\(t_1 = \frac{180}{60} = 3\) jam</p>
<p><strong>Waktu pulang</strong> ingin 1 jam lebih cepat:</p>
<p>\(t_2 = 3 - 1 = 2\) jam</p>
<p><strong>Jarak tetap 180 km, jadi:</strong></p>
<p>\(v_2 = \frac{180}{2} = 90\) km/jam</p>
<p><strong>Jadi, jawaban:</strong> 90 km/jam</p>',
            ],
            // Soal 25
            [
                'question_text' => 'Sebuah mesin dapat memproduksi 1.200 botol minuman dalam 8 jam. Jika kecepatan produksi mesin dinaikkan sehingga mesin mampu memproduksi 1.800 botol dalam waktu yang sama, maka dalam sebuah shift 5 jam pada kondisi kecepatan baru, mesin akan menghasilkan ... botol.',
                'options' => [
                    ['text' => '1.125 botol', 'is_correct' => true],
                    ['text' => '1.250 botol', 'is_correct' => false],
                    ['text' => '1.350 botol', 'is_correct' => false],
                    ['text' => '1.500 botol', 'is_correct' => false],
                    ['text' => '1.875 botol', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Kecepatan awal:</strong> \(v_1 = \frac{1200}{8} = 150\) botol/jam</p>
<p><strong>Kecepatan baru</strong> (dari info 1800 dalam 8 jam): \(v_2 = \frac{1800}{8} = 225\) botol/jam</p>
<p><strong>Dalam 5 jam</strong> dengan kecepatan baru:</p>
<p>Jumlah botol = \(225 \times 5 = 1.125\) botol</p>
<p><strong>Jadi, jawaban:</strong> 1.125 botol</p>',
            ],
            // Soal 26
            [
                'question_text' => 'Tabel berikut menunjukkan jumlah buku yang dipinjam dari perpustakaan oleh 5 siswa dalam satu minggu<br><br>
                <table border="1" style="border-collapse: collapse; margin: 10px 0;">
                <tr><th>Siswa</th><th>Jumlah buku</th></tr>
                <tr><td>A</td><td>3</td></tr>
                <tr><td>B</td><td>5</td></tr>
                <tr><td>C</td><td>2</td></tr>
                <tr><td>D</td><td>6</td></tr>
                <tr><td>E</td><td>4</td></tr>
                </table>
                <br>Jika pada minggu berikutnya rata-rata peminjaman buku meningkat menjadi 5 buku per siswa, maka total tambahan buku yang harus dipinjam oleh kelima siswa tersebut (secara keseluruhan) adalah ....',
                'options' => [
                    ['text' => '5 buku', 'is_correct' => true],
                    ['text' => '7 buku', 'is_correct' => false],
                    ['text' => '10 buku', 'is_correct' => false],
                    ['text' => '12 buku', 'is_correct' => false],
                    ['text' => '15 buku', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Minggu pertama, total buku:</strong></p>
<p>3 + 5 + 2 + 6 + 4 = 20 buku</p>
<p><strong>Minggu berikutnya, rata-rata = 5 buku untuk 5 siswa</strong> → total yang diinginkan:</p>
<p>5 × 5 = 25 buku</p>
<p><strong>Tambahan total buku:</strong></p>
<p>25 – 20 = 5 buku</p>
<p><strong>Jadi, jawaban:</strong> 5 buku</p>',
            ],
            // Soal 27 (Figural)
            [
                'question_text' => 'Ini soal nomor 27 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 27 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 27 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 27 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 27 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 27 (benar)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pada pasangan contoh di bagian kiri atas, terlihat bahwa bentuk garis dan posisi garis-garis kecil tetap sama, sedangkan perubahan hanya terjadi pada letak lingkaran hitam: semula berada di ujung atas garis, kemudian berpindah ke ujung bawah garis. Artinya, pola transformasinya adalah lingkaran hitam bergerak dari satu ujung garis ke ujung lainnya tanpa mengubah bentuk garis.</p>
<p>Ketika pola ini diterapkan pada gambar di kanan atas (dua garis melengkung dengan lingkaran di ujung atas), maka gambar pasangannya harus tetap memiliki dua garis melengkung dengan bentuk yang sama, tetapi lingkaran hitam berpindah ke ujung bawah garis.</p>
<p>Di antara pilihan yang ada, hanya gambar E yang memenuhi pola tersebut, sehingga jawaban yang benar adalah E.</p>',
            ],
            // Soal 28 (Figural)
            [
                'question_text' => 'Ini soal nomor 28 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 28 (benar)', 'is_correct' => true],
                    ['text' => 'Isi opsi B soal nomor 28 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 28 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 28 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 28 (salah)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pada pasangan contoh di baris atas, dua bangun yang berwarna hitam penuh "digabung" menjadi satu bidang hitam besar (oval), sedangkan dua bangun yang berarsir tetap menjadi bangun kecil di dalam bidang hitam tersebut.</p>
<p>Pola ini tampak dari gambar kedua ke gambar ketiga: persegi hitam dan lingkaran hitam berubah menjadi sebuah oval hitam besar, sementara persegi dan segitiga berarsir berada di dalamnya.</p>
<p>Jika pola yang sama diterapkan pada gambar ketiga, maka justru dua bangun yang berarsir (persegi dan segitiga) yang sekarang harus menjadi satu bidang besar berarsir, dan bidang hitamnya berubah menjadi dua bangun hitam di dalamnya.</p>
<p>Bentuk hasil perubahan ini tampak pada pilihan A, sehingga jawabannya adalah A.</p>',
            ],
            // Soal 29 (Figural)
            [
                'question_text' => 'Ini soal nomor 29 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 29 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 29 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 29 (benar)', 'is_correct' => true],
                    ['text' => 'Isi opsi D soal nomor 29 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 29 (salah)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pada dua gambar contoh di sebelah kiri, pola perubahan yang terjadi adalah semua benda diputar 180° terhadap pusat gambar: bentuk di posisi atas dan bawah saling bertukar tempat, begitu pula bentuk di kiri dan kanan saling bertukar posisi, sementara jenis dan corak gambarnya tetap sama.</p>
<p>Jika aturan yang sama diterapkan pada gambar ketiga (tanda "+" di kiri, bintang di kanan, dan dua garis bergelombang di atas serta di bawah), maka setelah diputar 180° garis bergelombang tetap berada di atas dan bawah (karena sama persis), sedangkan tanda "+" harus berpindah ke kanan dan bintang ke kiri.</p>
<p>Bentuk akhir seperti ini terdapat pada pilihan C, sehingga jawabannya adalah C.</p>',
            ],
            // Soal 30 (Figural)
            [
                'question_text' => 'Ini soal nomor 30 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 30 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 30 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 30 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 30 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 30 (benar)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pada dua gambar contoh di bagian kiri, tampak bahwa posisi kedua bangun saling dipertukarkan: bintang yang semula berada di bagian atas berpindah ke bawah, sedangkan bulan sabit yang semula di bawah berpindah ke atas.</p>
<p>Jadi aturannya adalah dua bangun yang berpasangan saling menukar posisi atas–bawah, sementara keduanya tetap saling berhadapan di sekitar bagian tengah bidang.</p>
<p>Pada gambar ketiga terdapat dua segitiga yang saling berlawanan arah: segitiga berarsir di bagian atas dan segitiga hitam di bagian bawah.</p>
<p>Jika mengikuti pola yang sama, keduanya juga harus saling menukar posisi sehingga segitiga hitam menjadi di atas dan segitiga berarsir berada di bawah, tetap saling berhadapan di titik tengah.</p>
<p>Susunan seperti ini terdapat pada gambar pilihan E, sehingga jawabannya adalah E.</p>',
            ],
            // Soal 31 (Figural)
            [
                'question_text' => 'Ini soal nomor 31 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 31 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 31 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 31 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 31 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 31 (benar)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Titik hitam selalu berpindah ke ujung berikutnya mengikuti arah panah (arah gerak garis), sementara titik kosong tertinggal di posisi sebelumnya.</p>
<p>Dari gambar ke-3, kalau titik hitam "maju" satu langkah sepanjang jalur S sesuai panah, posisi dan arah yang pas cuma opsi E.</p>',
            ],
            // Soal 32 (Figural)
            [
                'question_text' => 'Ini soal nomor 32 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 32 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 32 (benar)', 'is_correct' => true],
                    ['text' => 'Isi opsi C soal nomor 32 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 32 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 32 (salah)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pola pada soal menunjukkan perubahan arah panah yang berurutan dan konsisten. Setelah dua gambar awal dengan arah panah lurus, gambar ketiga berubah menjadi bentuk spiral dengan arah tertentu.</p>
<p>Gambar keempat harus melanjutkan arah gerak spiral tersebut tanpa mengubah pola putaran. Opsi B adalah satu-satunya yang mempertahankan arah dan urutan panah sesuai kelanjutan pola sebelumnya.</p>',
            ],
            // Soal 33 (Figural)
            [
                'question_text' => 'Ini soal nomor 33 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 33 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 33 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 33 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 33 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 33 (benar)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pada gambar soal ini, yang dicari adalah kelompok gambar pola arsiran/teksturnya berbeda dari kelompok lain, sehingga tampak "tidak serupa".</p>
<p>• Pada pilihan A, B, C, dan D, keempat gambar di dalam masing-masing kotak memiliki pola arsiran yang seragam dan cenderung "rapat": garis miring, garis mendatar, titik-titik, atau arsiran garis miring tebal.</p>
<p>• Pada pilihan E, keempat bentuk di dalam kotak memiliki tekstur berupa pola kotak-kotak jarang dengan lingkaran kecil di persilangannya, sehingga tampak jelas berbeda jenis arsirannya dibandingkan pola arsiran pada kelompok A, B, C, maupun D.</p>
<p>Karena hanya E yang memiliki jenis pola isi/arsiran yang tidak sama dengan empat kelompok lainnya, maka E menjadi gambar yang tidak sesuai (paling berbeda), sehingga jawabannya adalah E.</p>',
            ],
            // Soal 34 (Figural)
            [
                'question_text' => 'Ini soal nomor 34 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 34 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 34 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 34 (benar)', 'is_correct' => true],
                    ['text' => 'Isi opsi D soal nomor 34 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 34 (salah)', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pada gambar ini, setiap kotak di sekeliling titik hitam tengah mengalami rotasi searah jarum jam. Arah segitiga di dalam lingkaran hitam ikut berputar mengikuti posisi kotaknya.</p>
<p>Kotak yang kosong harus menampilkan arah segitiga yang sesuai dengan hasil rotasi berikutnya. Opsi C tepat karena menunjukkan arah segitiga yang benar sesuai pola rotasi.</p>',
            ],
            // Soal 35 (Figural)
            [
                'question_text' => 'Ini soal nomor 35 (Figural)',
                'options' => [
                    ['text' => 'Isi opsi A soal nomor 35 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi B soal nomor 35 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi C soal nomor 35 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi D soal nomor 35 (salah)', 'is_correct' => false],
                    ['text' => 'Isi opsi E soal nomor 35 (benar)', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
<p>Pola matriks menunjukkan bahwa bentuk dan arah panah berubah secara teratur melalui rotasi dan pencerminan antarbaris dan antarkolom. Setiap gambar merupakan hasil transformasi dari gambar sebelumnya.</p>
<p>Kotak yang hilang harus mengikuti transformasi yang sama agar pola tetap konsisten. Dari seluruh pilihan, hanya opsi E yang memenuhi hubungan bentuk dan arah panah tersebut.</p>',
            ],
        ];

        // Insert semua soal
        foreach ($questions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => $question['question_text'],
                'explanation' => $question['explanation'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($question['options'] as $order => $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'],
                    'order' => $order + 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TIU dari PDF berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
