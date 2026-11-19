<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TIUPaketSKDSeeder extends Seeder
{
    /**
     * Seeder TIU Paket SKD - soal nomor 31-65
     *
     * - material_id : 11
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : tiu
     *
     * Ekspresi matematika ditulis dalam LaTeX kompatibel MathQuill di dalam \( ... \).
     * Tanda < dan > di dalam math memakai \lt dan \gt agar aman untuk HTML.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 11;

        $questions = [
            // Soal 31 | Kunci: B
            [
                'no' => 31,
                'question_text' => '<p>PADI : LUMBUNG = AIR : ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Sungai', 'image' => null, 'is_correct' => false],
                    ['text' => 'Waduk', 'image' => null, 'is_correct' => true],
                    ['text' => 'Hujan', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sawah', 'image' => null, 'is_correct' => false],
                    ['text' => 'Irigasi', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Hubungan:</strong> benda → tempat <strong>menyimpan/menampung</strong> benda tersebut dalam jumlah besar untuk digunakan kemudian.</p>
            <ul>
            <li>Padi disimpan di <strong>lumbung</strong>.</li>
            <li>Air ditampung di <strong>waduk</strong>.</li>
            </ul>
            <p>Sungai adalah tempat air <em>mengalir</em>, bukan tempat menyimpan. Irigasi adalah saluran pembagi air. Sawah adalah tempat air digunakan. Hujan adalah sumber air.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 32 | Kunci: D
            [
                'no' => 32,
                'question_text' => '<p>TERMOMETER : SUHU = .... : ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Odometer : kecepatan', 'image' => null, 'is_correct' => false],
                    ['text' => 'Higrometer : curah hujan', 'image' => null, 'is_correct' => false],
                    ['text' => 'Seismograf : gelombang laut', 'image' => null, 'is_correct' => false],
                    ['text' => 'Barometer : tekanan udara', 'image' => null, 'is_correct' => true],
                    ['text' => 'Anemometer : arah angin', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Hubungan:</strong> alat ukur → besaran yang diukurnya.</p>
            <ul>
            <li>Termometer mengukur <strong>suhu</strong>.</li>
            <li>Barometer mengukur <strong>tekanan udara</strong>. ✔</li>
            </ul>
            <p><strong>Analisis pengecoh:</strong></p>
            <ul>
            <li>Odometer mengukur <em>jarak tempuh</em>; kecepatan diukur speedometer.</li>
            <li>Higrometer mengukur <em>kelembapan udara</em>; curah hujan diukur ombrometer.</li>
            <li>Seismograf mencatat <em>getaran gempa bumi</em>.</li>
            <li>Anemometer mengukur <em>kecepatan angin</em>; arah angin ditunjukkan wind vane (bendera angin).</li>
            </ul>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 33 | Kunci: C
            [
                'no' => 33,
                'question_text' => '<p>SENAPAN : BERBURU = KAMERA : ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Lensa', 'image' => null, 'is_correct' => false],
                    ['text' => 'Foto', 'image' => null, 'is_correct' => false],
                    ['text' => 'Memotret', 'image' => null, 'is_correct' => true],
                    ['text' => 'Fotografer', 'image' => null, 'is_correct' => false],
                    ['text' => 'Album', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Hubungan:</strong> alat → <strong>kegiatan</strong> yang dilakukan dengan alat tersebut.</p>
            <ul>
            <li>Senapan digunakan untuk <strong>berburu</strong>.</li>
            <li>Kamera digunakan untuk <strong>memotret</strong>.</li>
            </ul>
            <p>Perhatikan jenis kata: "berburu" adalah kata kerja, maka pasangannya juga harus kata kerja, yaitu "memotret". Foto adalah <em>hasil</em>, fotografer adalah <em>pelaku</em>, dan lensa adalah <em>bagian</em> kamera.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 34 | Kunci: E
            [
                'no' => 34,
                'question_text' => '<p>Semua peserta pelatihan mendapatkan sertifikat.<br>Sebagian peserta pelatihan adalah pegawai honorer.</p><p>Kesimpulan yang tepat adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Semua pegawai honorer mendapatkan sertifikat.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Semua yang mendapatkan sertifikat adalah pegawai honorer.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sebagian pegawai honorer tidak mendapatkan sertifikat.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Tidak ada pegawai honorer yang mendapatkan sertifikat.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sebagian pegawai honorer mendapatkan sertifikat.', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Misalkan P = peserta pelatihan, S = mendapat sertifikat, H = pegawai honorer.</p>
            <p>Premis 1: Semua P adalah S.<br>Premis 2: Sebagian P adalah H, artinya sebagian H adalah P.</p>
            <p>Pegawai honorer yang menjadi peserta pelatihan pasti mendapatkan sertifikat, sehingga:</p>
            <p>\\(\\text{Sebagian H}\\to\\text{P}\\to\\text{S}\\Rightarrow\\) <strong>Sebagian pegawai honorer mendapatkan sertifikat.</strong></p>
            <p>Opsi A terlalu luas (tidak semua honorer ikut pelatihan). Opsi C belum tentu benar, karena tidak ada informasi tentang honorer yang tidak ikut pelatihan.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 35 | Kunci: A
            [
                'no' => 35,
                'question_text' => '<p>Andi pergi ke perpustakaan atau ke kantin.<br>Jika Andi pergi ke kantin, maka ia membeli roti.<br>Andi tidak membeli roti.</p><p>Kesimpulan yang tepat adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Andi pergi ke perpustakaan.', 'image' => null, 'is_correct' => true],
                    ['text' => 'Andi pergi ke kantin.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Andi pergi ke perpustakaan dan ke kantin.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Andi tidak pergi ke perpustakaan.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Tidak dapat disimpulkan.', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Misalkan p = Andi ke perpustakaan, q = Andi ke kantin, r = Andi membeli roti.</p>
            <p><strong>Langkah 1: Modus tollens</strong> pada premis 2 dan 3:</p>
            <p>\\(q\\to r\\)<br>\\(\\sim r\\)<br>\\(\\therefore\\sim q\\) (Andi tidak pergi ke kantin)</p>
            <p><strong>Langkah 2: Silogisme disjungtif</strong> pada premis 1:</p>
            <p>\\(p\\vee q\\)<br>\\(\\sim q\\)<br>\\(\\therefore p\\)</p>
            <p><strong>Kesimpulan:</strong> Andi pergi ke perpustakaan.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 36 | Kunci: C
            [
                'no' => 36,
                'question_text' => '<p>Tidak ada atlet yang merokok.<br>Sebagian mahasiswa adalah atlet.</p><p>Kesimpulan yang tepat adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Semua mahasiswa tidak merokok.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sebagian mahasiswa merokok.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sebagian mahasiswa tidak merokok.', 'image' => null, 'is_correct' => true],
                    ['text' => 'Semua atlet adalah mahasiswa.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Semua mahasiswa yang tidak merokok adalah atlet.', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Premis 1: Semua atlet <strong>tidak</strong> merokok.<br>Premis 2: Sebagian mahasiswa adalah atlet.</p>
            <p>Mahasiswa yang merupakan atlet pasti tidak merokok, sehingga dapat disimpulkan: <strong>sebagian mahasiswa tidak merokok</strong>.</p>
            <ul>
            <li>A: tidak dapat dipastikan karena ada mahasiswa yang bukan atlet.</li>
            <li>B: belum tentu; tidak ada informasi tentang mahasiswa nonatlet.</li>
            <li>D dan E: tidak dapat disimpulkan dari premis.</li>
            </ul>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 37 | Kunci: B
            [
                'no' => 37,
                'question_text' => '<p>Lima orang, yaitu Ani, Budi, Cita, Dodi, dan Eka, sedang mengantre di sebuah loket dalam satu barisan.</p>
            <ul>
            <li>Dodi berada di posisi paling belakang.</li>
            <li>Budi berdiri tepat di belakang Ani.</li>
            <li>Ani tidak berada di posisi paling depan.</li>
            <li>Cita tidak berada di posisi paling depan.</li>
            <li>Cita tidak berdiri tepat di belakang Eka.</li>
            </ul>
            <p>Siapakah yang berada di posisi ketiga dari depan?</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Ani', 'image' => null, 'is_correct' => false],
                    ['text' => 'Budi', 'image' => null, 'is_correct' => true],
                    ['text' => 'Cita', 'image' => null, 'is_correct' => false],
                    ['text' => 'Dodi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Eka', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Langkah 1:</strong> Dodi di posisi 5.</p>
            <p><strong>Langkah 2:</strong> Posisi 1 tidak boleh Ani dan tidak boleh Cita. Budi juga tidak mungkin di posisi 1 karena harus tepat di belakang Ani. Maka posisi 1 = <strong>Eka</strong>.</p>
            <p><strong>Langkah 3:</strong> Cita tidak boleh tepat di belakang Eka, jadi Cita bukan di posisi 2. Posisi 2 harus Ani (Budi tidak bisa di posisi 2 karena posisi 1 bukan Ani).</p>
            <p><strong>Langkah 4:</strong> Budi tepat di belakang Ani → Budi di posisi 3, sisanya Cita di posisi 4.</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th></tr>
            <tr><td>Eka</td><td>Ani</td><td><strong>Budi</strong></td><td>Cita</td><td>Dodi</td></tr>
            </table>
            <p>Semua syarat terpenuhi dan susunan ini satu-satunya yang mungkin.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 38 | Kunci: D
            [
                'no' => 38,
                'question_text' => '<p>Lima pegawai, yaitu Fani, Gilang, Hana, Irfan, dan Joko, mendapat jadwal piket masing-masing satu hari dari Senin sampai Jumat (satu orang per hari).</p>
            <ul>
            <li>Gilang piket pada hari Rabu.</li>
            <li>Hana dan Irfan tidak piket pada hari yang berurutan.</li>
            <li>Fani piket sebelum Joko.</li>
            <li>Joko tidak piket pada hari Jumat.</li>
            </ul>
            <p>Pada hari apakah Joko pasti piket?</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Senin', 'image' => null, 'is_correct' => false],
                    ['text' => 'Selasa', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rabu', 'image' => null, 'is_correct' => false],
                    ['text' => 'Kamis', 'image' => null, 'is_correct' => true],
                    ['text' => 'Jumat', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Gilang = Rabu. Sisa hari: Senin, Selasa, Kamis, Jumat untuk Fani, Hana, Irfan, dan Joko.</p>
            <p><strong>Analisis Hana dan Irfan:</strong> keduanya tidak boleh di hari berurutan. Pasangan hari berurutan yang tersedia adalah (Senin, Selasa) dan (Kamis, Jumat). Jadi Hana dan Irfan harus <strong>satu di awal pekan (Senin/Selasa) dan satu di akhir pekan (Kamis/Jumat)</strong>.</p>
            <p>Akibatnya, Fani dan Joko juga menempati satu hari di awal pekan dan satu hari di akhir pekan.</p>
            <p><strong>Analisis Fani dan Joko:</strong> Fani harus sebelum Joko, sehingga Fani di awal pekan dan Joko di akhir pekan (Kamis atau Jumat). Karena Joko tidak piket hari Jumat, maka <strong>Joko pasti piket hari Kamis</strong>.</p>
            <p>Contoh susunan: Senin (Fani), Selasa (Hana), Rabu (Gilang), Kamis (Joko), Jumat (Irfan).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 39 | Kunci: E
            [
                'no' => 39,
                'question_text' => '<p>Diketahui informasi tinggi badan lima siswa berikut:</p>
            <ul>
            <li>Rina lebih tinggi daripada Sari.</li>
            <li>Tika lebih pendek daripada Sari, tetapi lebih tinggi daripada Umi.</li>
            <li>Vina lebih tinggi daripada Rina.</li>
            </ul>
            <p>Siswa yang memiliki tinggi badan urutan ketiga dari yang tertinggi adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Rina', 'image' => null, 'is_correct' => false],
                    ['text' => 'Tika', 'image' => null, 'is_correct' => false],
                    ['text' => 'Umi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Vina', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sari', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Tuliskan setiap informasi dalam bentuk pertidaksamaan:</p>
            <p>\\(R\\gt S\\)<br>\\(S\\gt T\\gt U\\)<br>\\(V\\gt R\\)</p>
            <p>Gabungkan menjadi satu urutan:</p>
            <p>\\(V\\gt R\\gt S\\gt T\\gt U\\)</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Urutan</th><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
            <tr><th>Siswa</th><td>Vina</td><td>Rina</td><td><strong>Sari</strong></td><td>Tika</td><td>Umi</td></tr>
            </table>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 40 | Kunci: D
            [
                'no' => 40,
                'question_text' => '<p>Harga buku P lebih mahal daripada buku Q. Harga buku R lebih murah daripada buku Q. Harga buku S lebih mahal daripada buku R.</p>
            <p>Pernyataan berikut yang <strong>pasti benar</strong> adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Buku S adalah buku termahal.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Buku S lebih mahal daripada buku Q.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Buku Q adalah buku termurah.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Buku P lebih mahal daripada buku R.', 'image' => null, 'is_correct' => true],
                    ['text' => 'Buku R lebih mahal daripada buku P.', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Dari informasi:</p>
            <p>\\(P\\gt Q\\) dan \\(Q\\gt R\\Rightarrow P\\gt Q\\gt R\\)</p>
            <p>\\(S\\gt R\\), tetapi posisi S terhadap P dan Q <strong>tidak diketahui</strong>.</p>
            <ul>
            <li>A dan B: belum tentu, karena S bisa lebih murah dari Q.</li>
            <li>C: salah, karena R lebih murah dari Q.</li>
            <li>D: \\(P\\gt Q\\gt R\\Rightarrow P\\gt R\\), <strong>pasti benar</strong>. ✔</li>
            <li>E: salah.</li>
            </ul>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 41 | Kunci: D
            [
                'no' => 41,
                'question_text' => '<p>\\(3,\\ 5,\\ 9,\\ 17,\\ 33,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(49\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(57\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(63\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(65\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(66\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><th>Pola</th></tr>
            <tr><td>\\(3\\)</td><td>\\(3\\times 2-1=5\\)</td></tr>
            <tr><td>\\(5\\)</td><td>\\(5\\times 2-1=9\\)</td></tr>
            <tr><td>\\(9\\)</td><td>\\(9\\times 2-1=17\\)</td></tr>
            <tr><td>\\(17\\)</td><td>\\(17\\times 2-1=33\\)</td></tr>
            <tr><td>\\(33\\)</td><td>\\(33\\times 2-1=65\\)</td></tr>
            </table>
            <p><strong>Cara lain:</strong> selisih antarsuku adalah \\(2,\\ 4,\\ 8,\\ 16\\), berikutnya \\(32\\), sehingga \\(33+32=65\\).</p>
            <p><strong>Jawaban: D</strong> \\(\\left(65\\right)\\)</p>',
            ],
            // Soal 42 | Kunci: B
            [
                'no' => 42,
                'question_text' => '<p>\\(2,\\ 3,\\ 5,\\ 9,\\ 10,\\ 12,\\ 16,\\ 17,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(18\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(19\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(20\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(21\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(23\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Perhatikan selisih antarsuku:</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Suku</th><td>\\(2\\)</td><td>\\(3\\)</td><td>\\(5\\)</td><td>\\(9\\)</td><td>\\(10\\)</td><td>\\(12\\)</td><td>\\(16\\)</td><td>\\(17\\)</td><td>\\(?\\)</td></tr>
            <tr><th>Selisih</th><td></td><td>\\(+1\\)</td><td>\\(+2\\)</td><td>\\(+4\\)</td><td>\\(+1\\)</td><td>\\(+2\\)</td><td>\\(+4\\)</td><td>\\(+1\\)</td><td>\\(+2\\)</td></tr>
            </table>
            <p>Pola penambahan \\(+1,\\ +2,\\ +4\\) berulang.</p>
            <p>Suku berikutnya: \\(17+2=19\\)</p>
            <p><strong>Jawaban: B</strong> \\(\\left(19\\right)\\)</p>',
            ],
            // Soal 43 | Kunci: B
            [
                'no' => 43,
                'question_text' => '<p>\\(120,\\ 60,\\ 20,\\ 5,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(0\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(1\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(2\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(2{,}5\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(4\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>\\(120\\div 2=60\\)<br>\\(60\\div 3=20\\)<br>\\(20\\div 4=5\\)<br>\\(5\\div 5=1\\)</p>
            <p>Pembaginya bertambah 1 setiap langkah: \\(2,\\ 3,\\ 4,\\ 5\\).</p>
            <p><strong>Catatan:</strong> \\(120=5!\\), sehingga deret ini adalah \\(\\frac{5!}{1},\\ \\frac{5!}{2!},\\ \\frac{5!}{3!},\\ \\frac{5!}{4!},\\ \\frac{5!}{5!}=1\\).</p>
            <p><strong>Jawaban: B</strong> \\(\\left(1\\right)\\)</p>',
            ],
            // Soal 44 | Kunci: D
            [
                'no' => 44,
                'question_text' => '<p>\\(7,\\ 10,\\ 14,\\ 8,\\ 21,\\ 6,\\ 28,\\ \\dots\\)</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(2\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(35\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(5\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(4\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(3\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Deret ini merupakan <strong>deret bertingkat (selang-seling)</strong>, terdiri atas dua deret:</p>
            <ul>
            <li>Suku ganjil (ke-1, 3, 5, 7): \\(7,\\ 14,\\ 21,\\ 28\\) → bertambah \\(7\\)</li>
            <li>Suku genap (ke-2, 4, 6, 8): \\(10,\\ 8,\\ 6,\\ \\dots\\) → berkurang \\(2\\)</li>
            </ul>
            <p>Suku berikutnya adalah suku ke-8 (suku genap): \\(6-2=4\\)</p>
            <p><strong>Jebakan:</strong> \\(35\\) adalah suku ke-9, bukan suku ke-8.</p>
            <p><strong>Jawaban: D</strong> \\(\\left(4\\right)\\)</p>',
            ],
            // Soal 45 | Kunci: C
            [
                'no' => 45,
                'question_text' => '<p>A, C, F, J, O, ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'S', 'image' => null, 'is_correct' => false],
                    ['text' => 'T', 'image' => null, 'is_correct' => false],
                    ['text' => 'U', 'image' => null, 'is_correct' => true],
                    ['text' => 'V', 'image' => null, 'is_correct' => false],
                    ['text' => 'W', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Ubah huruf menjadi urutan angka dalam alfabet:</p>
            <p>\\(A=1,\\ C=3,\\ F=6,\\ J=10,\\ O=15\\)</p>
            <p>Selisihnya \\(+2,\\ +3,\\ +4,\\ +5\\), sehingga berikutnya \\(+6\\):</p>
            <p>\\(15+6=21\\Rightarrow\\) huruf ke-21 adalah <strong>U</strong>.</p>
            <p><strong>Tips:</strong> hafalkan posisi huruf kunci: E = 5, J = 10, O = 15, T = 20, Y = 25.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 46 | Kunci: C
            [
                'no' => 46,
                'question_text' => '<p>Nilai dari \\(\\sqrt{0{,}0144}\\times 25+\\left(1{,}2\\right)^{2}\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(3{,}44\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(4{,}04\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(4{,}44\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(4{,}84\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(5{,}44\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Langkah 1:</strong> Hitung akar.</p>
            <p>\\(\\sqrt{0{,}0144}=\\sqrt{\\frac{144}{10000}}=\\frac{12}{100}=0{,}12\\)</p>
            <p><strong>Langkah 2:</strong> Kalikan dengan 25.</p>
            <p>\\(0{,}12\\times 25=3\\)</p>
            <p><strong>Langkah 3:</strong> Hitung kuadrat.</p>
            <p>\\(\\left(1{,}2\\right)^{2}=1{,}44\\)</p>
            <p><strong>Langkah 4:</strong> Jumlahkan.</p>
            <p>\\(3+1{,}44=4{,}44\\)</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 47 | Kunci: E
            [
                'no' => 47,
                'question_text' => '<p>Nilai dari \\(45\\%\\) dari \\(240\\) ditambah \\(\\frac{3}{8}\\) dari \\(96\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(132\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(138\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(140\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(142\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(144\\)', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>\\(45\\%\\times 240=\\frac{45}{100}\\times 240=108\\)</p>
            <p>\\(\\frac{3}{8}\\times 96=3\\times 12=36\\)</p>
            <p>\\(108+36=144\\)</p>
            <p><strong>Tips cepat:</strong> \\(10\\%\\) dari \\(240=24\\), maka \\(45\\%=4{,}5\\times 24=108\\).</p>
            <p><strong>Jawaban: E</strong> \\(\\left(144\\right)\\)</p>',
            ],
            // Soal 48 | Kunci: B
            [
                'no' => 48,
                'question_text' => '<p>Nilai dari \\(\\frac{2^{5}\\times 3^{3}}{6^{3}}\\) adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(2\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(4\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(6\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(8\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(12\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Gunakan sifat \\(6^{3}=\\left(2\\times 3\\right)^{3}=2^{3}\\times 3^{3}\\).</p>
            <p>\\(\\frac{2^{5}\\times 3^{3}}{2^{3}\\times 3^{3}}=2^{5-3}\\times 3^{3-3}=2^{2}\\times 1=4\\)</p>
            <p><strong>Cek langsung:</strong> \\(\\frac{32\\times 27}{216}=\\frac{864}{216}=4\\)</p>
            <p><strong>Jawaban: B</strong> \\(\\left(4\\right)\\)</p>',
            ],
            // Soal 49 | Kunci: C
            [
                'no' => 49,
                'question_text' => '<p>Perhatikan informasi berikut:</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>P</th><th>Q</th></tr>
            <tr><td>\\(15\\%\\) dari \\(80\\)</td><td>\\(80\\%\\) dari \\(15\\)</td></tr>
            </table>
            <p>Hubungan yang tepat antara P dan Q adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(P\\gt Q\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(P\\lt Q\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(P=Q\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(P=2Q\\)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hubungan P dan Q tidak dapat ditentukan', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>\\(P=\\frac{15}{100}\\times 80=12\\)</p>
            <p>\\(Q=\\frac{80}{100}\\times 15=12\\)</p>
            <p>Maka \\(P=Q\\).</p>
            <p><strong>Konsep cepat:</strong> \\(a\\%\\) dari \\(b\\) selalu sama dengan \\(b\\%\\) dari \\(a\\), karena keduanya bernilai \\(\\frac{a\\times b}{100}\\).</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 50 | Kunci: B
            [
                'no' => 50,
                'question_text' => '<p>Perhatikan informasi berikut:</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>x</th><th>y</th></tr>
            <tr><td>Rata-rata dari \\(12,\\ 15,\\ 18,\\ 21,\\ 24\\)</td><td>Median dari \\(10,\\ 25,\\ 17,\\ 19,\\ 30\\)</td></tr>
            </table>
            <p>Hubungan yang tepat antara x dan y adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(x\\gt y\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(x\\lt y\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(x=y\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(x=y+1\\)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hubungan x dan y tidak dapat ditentukan', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Menghitung x (rata-rata):</strong></p>
            <p>\\(x=\\frac{12+15+18+21+24}{5}=\\frac{90}{5}=18\\)</p>
            <p><strong>Menghitung y (median):</strong> urutkan data terlebih dahulu.</p>
            <p>\\(10,\\ 17,\\ 19,\\ 25,\\ 30\\Rightarrow\\) nilai tengah \\(y=19\\)</p>
            <p>Maka \\(x=18\\lt y=19\\).</p>
            <p><strong>Jebakan:</strong> Jika data tidak diurutkan, nilai tengahnya tampak \\(17\\), sehingga terkesan \\(x\\gt y\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 51 | Kunci: C
            [
                'no' => 51,
                'question_text' => '<p>Harga 3 pensil dan 2 buku tulis adalah Rp19.000,00, sedangkan harga 2 pensil dan 3 buku tulis adalah Rp21.000,00. Harga 1 pensil dan 1 buku tulis adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Rp7.000,00', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rp7.500,00', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rp8.000,00', 'image' => null, 'is_correct' => true],
                    ['text' => 'Rp8.500,00', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rp9.000,00', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Misalkan harga pensil \\(=p\\) dan buku tulis \\(=b\\).</p>
            <p>\\(3p+2b=19.000\\)<br>\\(2p+3b=21.000\\)</p>
            <p><strong>Cara cepat:</strong> jumlahkan kedua persamaan.</p>
            <p>\\(5p+5b=40.000\\Rightarrow p+b=8.000\\)</p>
            <p><strong>Cek:</strong> dengan eliminasi diperoleh \\(p=3.000\\) dan \\(b=5.000\\), sehingga \\(3\\left(3.000\\right)+2\\left(5.000\\right)=19.000\\) ✔</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 52 | Kunci: C
            [
                'no' => 52,
                'question_text' => '<p>Jarak kota X dan kota Y adalah 240 km. Mobil A berangkat dari kota X menuju kota Y pukul 07.00 dengan kecepatan rata-rata 60 km/jam. Mobil B berangkat dari kota Y menuju kota X pukul 07.30 dengan kecepatan rata-rata 80 km/jam. Kedua mobil akan berpapasan pada pukul ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '08.30', 'image' => null, 'is_correct' => false],
                    ['text' => '08.45', 'image' => null, 'is_correct' => false],
                    ['text' => '09.00', 'image' => null, 'is_correct' => true],
                    ['text' => '09.15', 'image' => null, 'is_correct' => false],
                    ['text' => '09.30', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Langkah 1:</strong> Hitung jarak yang ditempuh mobil A sebelum mobil B berangkat (30 menit).</p>
            <p>\\(s_{A}=60\\times\\frac{1}{2}=30\\text{ km}\\)</p>
            <p><strong>Langkah 2:</strong> Sisa jarak saat mobil B berangkat.</p>
            <p>\\(240-30=210\\text{ km}\\)</p>
            <p><strong>Langkah 3:</strong> Waktu berpapasan sejak pukul 07.30.</p>
            <p>\\(t=\\frac{\\text{sisa jarak}}{v_{A}+v_{B}}=\\frac{210}{60+80}=\\frac{210}{140}=1{,}5\\text{ jam}\\)</p>
            <p><strong>Langkah 4:</strong> \\(07.30+1\\text{ jam }30\\text{ menit}=09.00\\)</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 53 | Kunci: D
            [
                'no' => 53,
                'question_text' => '<p>Rata-rata nilai ujian 30 siswa adalah 72. Setelah dua siswa baru mengikuti ujian susulan, rata-rata nilai seluruh siswa menjadi 73. Rata-rata nilai kedua siswa baru tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(80\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(84\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(86\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(88\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(90\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Total nilai awal: \\(30\\times 72=2.160\\)</p>
            <p>Total nilai setelah ada 32 siswa: \\(32\\times 73=2.336\\)</p>
            <p>Jumlah nilai dua siswa baru: \\(2.336-2.160=176\\)</p>
            <p>Rata-rata dua siswa baru: \\(\\frac{176}{2}=88\\)</p>
            <p><strong>Cara cepat:</strong> terhadap rata-rata baru \\(73\\), setiap siswa lama kurang \\(1\\) poin, sehingga total kekurangannya \\(30\\times 1=30\\). Kekurangan ini harus ditutup oleh dua siswa baru, jadi masing-masing berada \\(\\frac{30}{2}=15\\) poin di atas \\(73\\), yaitu \\(73+15=88\\).</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 54 | Kunci: B
            [
                'no' => 54,
                'question_text' => '<p>Sebuah toko memberikan diskon bertingkat 20% + 10% untuk sebuah jaket seharga Rp450.000,00. Harga yang harus dibayar pembeli adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Rp315.000,00', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rp324.000,00', 'image' => null, 'is_correct' => true],
                    ['text' => 'Rp330.000,00', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rp335.000,00', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rp360.000,00', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Diskon bertingkat dihitung <strong>bertahap</strong>, bukan dijumlahkan.</p>
            <p><strong>Diskon pertama 20%:</strong></p>
            <p>\\(450.000\\times 0{,}8=360.000\\)</p>
            <p><strong>Diskon kedua 10% dari harga setelah diskon pertama:</strong></p>
            <p>\\(360.000\\times 0{,}9=324.000\\)</p>
            <p><strong>Jebakan:</strong> Jika diskon dijumlahkan menjadi 30%, hasilnya Rp315.000,00 (opsi A), dan itu salah. Diskon efektif sebenarnya \\(1-0{,}8\\times 0{,}9=0{,}28=28\\%\\).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 55 | Kunci: D
            [
                'no' => 55,
                'question_text' => '<p>Dari 6 pria dan 4 wanita akan dipilih 3 orang sebagai panitia. Jika panitia harus beranggotakan paling sedikit 1 wanita, banyak cara pemilihan yang mungkin adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '\\(60\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(80\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(96\\)', 'image' => null, 'is_correct' => false],
                    ['text' => '\\(100\\)', 'image' => null, 'is_correct' => true],
                    ['text' => '\\(120\\)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Gunakan <strong>komplemen</strong>: semua cara dikurangi cara tanpa wanita.</p>
            <p>Semua cara memilih 3 dari 10 orang:</p>
            <p>\\(C_{3}^{10}=\\frac{10\\times 9\\times 8}{3\\times 2\\times 1}=120\\)</p>
            <p>Cara memilih 3 orang tanpa wanita (semua pria):</p>
            <p>\\(C_{3}^{6}=\\frac{6\\times 5\\times 4}{3\\times 2\\times 1}=20\\)</p>
            <p>Banyak cara dengan paling sedikit 1 wanita:</p>
            <p>\\(120-20=100\\)</p>
            <p><strong>Cek dengan cara langsung:</strong> \\(C_{1}^{4}C_{2}^{6}+C_{2}^{4}C_{1}^{6}+C_{3}^{4}=60+36+4=100\\) ✔</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 56 | Kunci: C
            [
                'no' => 56,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk mengisi tanda tanya?</p>',
                'image' => 'soal-figural/tiu-56.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-56-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-56-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-56-c.png', 'is_correct' => true],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-56-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-56-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Ada dua pola yang berjalan bersamaan:</p>
            <ol>
            <li><strong>Arah panah</strong> berputar \\(45^{\\circ}\\) searah jarum jam setiap langkah: atas → kanan atas → kanan → kanan bawah → <strong>bawah</strong>.</li>
            <li><strong>Lingkaran di pangkal panah</strong> berganti warna: hitam → putih → hitam → putih → <strong>hitam</strong>.</li>
            </ol>
            <p>Gambar kelima: panah mengarah ke <strong>bawah</strong> dengan lingkaran <strong>hitam</strong> di pangkalnya.</p>
            <p>Opsi A arahnya benar tetapi lingkarannya putih; opsi B lingkarannya hitam tetapi panah mengarah ke kiri bawah.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 57 | Kunci: D
            [
                'no' => 57,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk mengisi tanda tanya?</p>',
                'image' => 'soal-figural/tiu-57.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-57-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-57-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-57-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-57-d.png', 'is_correct' => true],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-57-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <ol>
            <li><strong>Jumlah sisi</strong> bertambah satu: segitiga (3) → segi empat (4) → segi lima (5) → segi enam (6) → <strong>segi tujuh (7)</strong>.</li>
            <li><strong>Warna</strong> berselang-seling: hitam → putih → hitam → putih → <strong>hitam</strong>.</li>
            </ol>
            <p>Gambar yang tepat adalah <strong>segi tujuh berwarna hitam</strong>.</p>
            <p>Opsi A segi tujuh tetapi putih, opsi B segi delapan hitam, opsi C segi enam hitam.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 58 | Kunci: E
            [
                'no' => 58,
                'question_text' => '<p>Perhatikan matriks gambar berikut. Gambar manakah yang tepat untuk mengisi kotak bertanda tanya?</p>',
                'image' => 'soal-figural/tiu-58.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-58-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-58-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-58-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-58-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-58-e.png', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Setiap baris dan setiap kolom memuat:</p>
            <ul>
            <li>tiga <strong>bentuk</strong> berbeda: lingkaran, persegi, segitiga; dan</li>
            <li>tiga <strong>corak</strong> berbeda: hitam, putih, arsir.</li>
            </ul>
            <p>Baris ketiga sudah berisi segitiga arsir dan lingkaran hitam, sehingga kotak yang kosong harus berisi bentuk <strong>persegi</strong> dengan corak <strong>putih</strong>.</p>
            <p>Cek kolom ketiga: segitiga arsir, lingkaran hitam, dan <strong>persegi putih</strong>. Semua bentuk dan corak berbeda ✔</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 59 | Kunci: A
            [
                'no' => 59,
                'question_text' => '<p>Gambar pertama berhubungan dengan gambar kedua. Dengan hubungan yang sama, gambar ketiga berhubungan dengan gambar ....</p>',
                'image' => 'soal-figural/tiu-59.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-59-a.png', 'is_correct' => true],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-59-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-59-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-59-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-59-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pada pasangan pertama: persegi besar berisi lingkaran kecil hitam → lingkaran besar berisi persegi kecil hitam.</p>
            <p><strong>Aturannya:</strong> bentuk luar dan bentuk dalam <strong>bertukar posisi</strong>, sedangkan <strong>corak bentuk dalam tetap</strong>.</p>
            <p>Diterapkan pada gambar ketiga (segitiga besar berisi lingkaran kecil arsir), hasilnya adalah <strong>lingkaran besar berisi segitiga kecil arsir</strong>.</p>
            <ul>
            <li>B: tidak terjadi pertukaran.</li>
            <li>C: corak berubah menjadi hitam.</li>
            <li>D: bentuk dalam salah (persegi).</li>
            <li>E: bentuk luar salah (persegi).</li>
            </ul>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 60 | Kunci: B
            [
                'no' => 60,
                'question_text' => '<p>Empat dari lima gambar berikut memiliki kesamaan. Gambar manakah yang berbeda dari yang lain?</p>',
                'image' => 'soal-figural/tiu-60.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-60-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-60-b.png', 'is_correct' => true],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-60-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-60-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-60-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Semua gambar berbentuk huruf "F" dengan sebuah lingkaran kecil.</p>
            <ul>
            <li>Gambar A: posisi awal.</li>
            <li>Gambar C: gambar A diputar \\(90^{\\circ}\\) searah jarum jam.</li>
            <li>Gambar D: gambar A diputar \\(180^{\\circ}\\).</li>
            <li>Gambar E: gambar A diputar \\(90^{\\circ}\\) berlawanan arah jarum jam.</li>
            <li>Gambar B: hasil <strong>pencerminan</strong> gambar A, bukan rotasi.</li>
            </ul>
            <p>Cara cek: pada gambar A, lengan F mengarah ke kanan dengan lingkaran di sebelah kanan batang. Pencerminan tidak dapat diperoleh dengan memutar gambar, sehingga gambar B adalah yang berbeda.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 61 | Kunci: D
            [
                'no' => 61,
                'question_text' => '<p>Gambar manakah yang merupakan bayangan cermin dari gambar di sebelah kiri jika cermin diletakkan di sebelah kanannya (garis putus-putus)?</p>',
                'image' => 'soal-figural/tiu-61.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-61-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-61-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-61-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-61-d.png', 'is_correct' => true],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-61-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pada pencerminan terhadap cermin tegak (vertikal), unsur <strong>kiri dan kanan bertukar</strong>, sedangkan posisi atas dan bawah tetap.</p>
            <ul>
            <li>Segitiga hitam di <strong>kiri atas</strong> → pindah ke <strong>kanan atas</strong> (sudut sikunya juga pindah ke pojok kanan atas).</li>
            <li>Lingkaran arsir di <strong>kanan bawah</strong> → pindah ke <strong>kiri bawah</strong>.</li>
            <li>Panah yang mengarah ke <strong>kanan</strong> → berbalik mengarah ke <strong>kiri</strong>.</li>
            </ul>
            <p><strong>Analisis pengecoh:</strong> A adalah pencerminan terhadap cermin mendatar, B adalah rotasi \\(180^{\\circ}\\), C arah panahnya tidak berubah, dan E posisi lingkarannya tidak berubah.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 62 | Kunci: B
            [
                'no' => 62,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk mengisi tanda tanya?</p>',
                'image' => 'soal-figural/tiu-62.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-62-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-62-b.png', 'is_correct' => true],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-62-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-62-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-62-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Lingkaran memiliki 8 titik. Beri nomor 0 sampai 7 searah jarum jam mulai dari titik paling atas.</p>
            <p>Posisi titik hitam: \\(0\\to 1\\to 3\\to 6\\)</p>
            <p>Langkah perpindahannya: \\(+1,\\ +2,\\ +3\\), sehingga berikutnya \\(+4\\).</p>
            <p>\\(6+4=10\\). Karena hanya ada 8 titik, \\(10-8=2\\).</p>
            <p>Titik hitam berada di posisi 2, yaitu titik <strong>paling kanan</strong> (arah pukul 3).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 63 | Kunci: E
            [
                'no' => 63,
                'question_text' => '<p>Perhatikan deret gambar berikut. Gambar manakah yang tepat untuk mengisi tanda tanya?</p>',
                'image' => 'soal-figural/tiu-63.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-63-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-63-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-63-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-63-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-63-e.png', 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Hanya kotak-kotak di <strong>pinggir</strong> grid \\(3\\times 3\\) yang terlibat. Ada dua pola yang bergerak bersamaan:</p>
            <ol>
            <li><strong>Kotak hitam</strong> bergerak satu langkah <strong>searah jarum jam</strong>: kiri atas → tengah atas → kanan atas → kanan tengah → <strong>kanan bawah</strong>.</li>
            <li><strong>Kotak arsir</strong> bergerak satu langkah <strong>berlawanan arah jarum jam</strong>: tengah bawah → kanan bawah → kanan tengah → kanan atas → <strong>tengah atas</strong>.</li>
            </ol>
            <p>Gambar kelima: kotak hitam di <strong>kanan bawah</strong> dan kotak arsir di <strong>tengah atas</strong>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 64 | Kunci: C
            [
                'no' => 64,
                'question_text' => '<p>Perhatikan pola penggabungan gambar pada baris pertama. Dengan aturan yang sama, gambar manakah yang tepat untuk mengisi tanda tanya pada baris kedua?</p>',
                'image' => 'soal-figural/tiu-64.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-64-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-64-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-64-c.png', 'is_correct' => true],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-64-d.png', 'is_correct' => false],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-64-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Baris pertama: (diagonal \\ + garis tegak) + (garis tegak + garis mendatar) = (diagonal \\ + garis mendatar).</p>
            <p><strong>Aturannya:</strong> saat dua gambar digabung, garis yang <strong>sama-sama ada</strong> pada kedua gambar <strong>hilang</strong>, sedangkan garis yang hanya ada di salah satu gambar tetap muncul.</p>
            <p>Baris kedua:</p>
            <ul>
            <li>Gambar 1: diagonal \\, diagonal /, garis mendatar</li>
            <li>Gambar 2: garis mendatar, garis tegak</li>
            <li>Garis yang sama: <strong>garis mendatar</strong> → hilang</li>
            </ul>
            <p>Hasil: <strong>diagonal \\, diagonal /, dan garis tegak</strong>.</p>
            <p>Opsi A adalah gabungan seluruh garis, sedangkan opsi B hanya garis yang sama.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 65 | Kunci: D
            [
                'no' => 65,
                'question_text' => '<p>Gambar di sebelah kiri diputar \\(90^{\\circ}\\) searah jarum jam. Gambar manakah yang merupakan hasil putarannya?</p>',
                'image' => 'soal-figural/tiu-65.png',
                'options' => [
                    ['text' => 'A', 'image' => 'soal-figural/tiu-65-a.png', 'is_correct' => false],
                    ['text' => 'B', 'image' => 'soal-figural/tiu-65-b.png', 'is_correct' => false],
                    ['text' => 'C', 'image' => 'soal-figural/tiu-65-c.png', 'is_correct' => false],
                    ['text' => 'D', 'image' => 'soal-figural/tiu-65-d.png', 'is_correct' => true],
                    ['text' => 'E', 'image' => 'soal-figural/tiu-65-e.png', 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pada rotasi \\(90^{\\circ}\\) searah jarum jam, setiap unsur berpindah satu "sisi" mengikuti arah jarum jam:</p>
            <ul>
            <li>Lingkaran hitam di <strong>kiri atas</strong> → pindah ke <strong>kanan atas</strong>.</li>
            <li>Batang arsir di <strong>sisi kanan</strong> → pindah ke <strong>sisi bawah</strong>.</li>
            <li>Panah yang mengarah ke <strong>atas</strong> → mengarah ke <strong>kanan</strong>.</li>
            </ul>
            <p><strong>Analisis pengecoh:</strong></p>
            <ul>
            <li>A: rotasi \\(90^{\\circ}\\) berlawanan arah jarum jam.</li>
            <li>B: rotasi \\(180^{\\circ}\\).</li>
            <li>C: pencerminan, bukan rotasi.</li>
            <li>E: posisi benar, tetapi panah salah arah.</li>
            </ul>
            <p><strong>Jawaban: D</strong></p>',
            ],
        ];

        DB::transaction(function () use ($questions, $materialId, $now) {
            foreach ($questions as $question) {
                $questionId = DB::table('questions')->insertGetId([
                    'material_id'   => $materialId,
                    'type'          => 'mcq',
                    'test_type'     => 'tiu',
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
                        'image'       => $option['image'],
                        'is_correct'  => $option['is_correct'],
                        'order'       => $order + 1,
                        'weight'      => 0,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            }
        });

        $this->command->info('Seeder TIU Paket SKD - soal nomor 31-65 berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
