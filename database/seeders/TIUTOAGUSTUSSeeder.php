<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder soal TIU - Try Out SKD AGUSTUS (Satya Naratama)
 *
 * Total soal : 35 (nomor 1 - 35)
 * Material   : id = 5
 * Test type  : tiu
 *
 * Catatan: rumus matematika ditulis dengan delimiter inline MathJax/MathQuill \( ... \)
 */
class TIUTOAGUSTUSSeeder extends Seeder
{
    public function run(): void
    {
        $now        = Carbon::now();
        $materialId = 5;

        $questions = [
            // ================= Soal 1 =================
            [
                'question_text' => 'HEWAN = ... = MAKANAN : SATE',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Hubungan yang dicari adalah hubungan jenis/konotasi: <strong>SATE</strong> adalah salah satu jenis <strong>MAKANAN</strong>, maka <strong>SAPI</strong> adalah salah satu jenis <strong>HEWAN</strong>.<br>Jadi jawabannya sesuai dengan konotasinya, yaitu <strong>Sapi</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Air', 'is_correct' => false],
                    ['text' => 'Waktu makan', 'is_correct' => false],
                    ['text' => 'Sapi', 'is_correct' => true],
                    ['text' => 'Lapar', 'is_correct' => false],
                    ['text' => 'Kenyang', 'is_correct' => false],
                ],
            ],
            // ================= Soal 2 =================
            [
                'question_text' => 'SEKOLAH : PINTAR = ....: .....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Hubungan <strong>SEKOLAH : PINTAR</strong> adalah hubungan <strong>sebab &ndash; akibat</strong>. Orang bersekolah akibatnya menjadi pintar.<br>Pola yang sama: orang <strong>MAKAN</strong> akibatnya menjadi <strong>KENYANG</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Tidur : Kamar', 'is_correct' => false],
                    ['text' => 'Ilmu : Buku', 'is_correct' => false],
                    ['text' => 'Makan : Kenyang', 'is_correct' => true],
                    ['text' => 'Bumi : Tanah', 'is_correct' => false],
                    ['text' => 'Baca : Majalah', 'is_correct' => false],
                ],
            ],
            // ================= Soal 3 =================
            [
                'question_text' => 'Sebuah asrama memiliki penghuni sebanyak 30 orang. Persediaan makanan yang ada diperkirakan akan habis selama 8 hari. Karena ada tambahan 10 orang penghuni, berapa hari persediaan makanan akan habis?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Total stok makanan \\(= 30 \\times 8 = 240\\) porsi.<br>Setelah ada tambahan 10 orang, jumlah penghuni menjadi \\(30 + 10 = 40\\) orang.<br>Lama persediaan habis \\(= \\dfrac{240}{40} = 6\\) hari.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '6 hari', 'is_correct' => true],
                    ['text' => '11 hari', 'is_correct' => false],
                    ['text' => '15 hari', 'is_correct' => false],
                    ['text' => '24 hari', 'is_correct' => false],
                    ['text' => '8 hari', 'is_correct' => false],
                ],
            ],
            // ================= Soal 4 =================
            [
                'question_text' => 'NASABAH : PRIVASI = ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br><strong>NASABAH</strong> yang perlu diutamakan adalah <strong>PRIVASI</strong>-nya. Sedemikian rupa, <strong>PELANGGAN</strong> yang perlu diutamakan adalah <strong>KENYAMANAN</strong>-nya.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Perampok : buron', 'is_correct' => false],
                    ['text' => 'Polisi : tilang', 'is_correct' => false],
                    ['text' => 'Akuntan : kesalahan', 'is_correct' => false],
                    ['text' => 'Pelanggan : kenyamanan', 'is_correct' => true],
                    ['text' => 'Drama : prolog', 'is_correct' => false],
                ],
            ],
            // ================= Soal 5 =================
            [
                'question_text' => 'VOTING : PERBEDAAN : KEPUTUSAN = ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br><strong>VOTING</strong> dilakukan karena adanya <strong>PERBEDAAN</strong> agar menghasilkan <strong>KEPUTUSAN</strong>.<br>Sebagaimana <strong>PERUNDINGAN</strong> dilakukan karena adanya <strong>KONFLIK</strong> agar menghasilkan <strong>PERDAMAIAN</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Perbaikan : got : lancar', 'is_correct' => false],
                    ['text' => 'Perselisihan : tawuran : ketenangan', 'is_correct' => false],
                    ['text' => 'Perundingan : konflik : perdamaian', 'is_correct' => true],
                    ['text' => 'Pertandingan : kompetensi : kemenangan', 'is_correct' => false],
                    ['text' => 'Tuntutan : kericuhan : pembalap', 'is_correct' => false],
                ],
            ],
            // ================= Soal 6 =================
            [
                'question_text' => 'Jika \\(P\\) merupakan volume tabung yang berjari-jari \\(a\\) dengan tinggi \\(b\\), dan \\(Q\\) merupakan volume kerucut yang mempunyai jari-jari \\(2a\\) dan tinggi \\(\\tfrac{3}{4}b\\). Di bawah ini pernyataan yang tepat adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>\\(P = V_{\\text{tabung}} = \\pi r^{2} t = \\pi a^{2} b\\)<br>\\(Q = V_{\\text{kerucut}} = \\dfrac{1}{3}\\pi r^{2} t\\)<br>\\(Q = \\dfrac{1}{3}\\pi (2a)^{2}\\left(\\dfrac{3}{4}b\\right)\\)<br>\\(Q = \\dfrac{1}{3}\\pi \\times 4a^{2} \\times \\dfrac{3}{4}b\\)<br>\\(Q = \\pi a^{2} b\\)<br>Jadi \\(P = Q\\).</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => '\\(P > Q\\)', 'is_correct' => false],
                    ['text' => '\\(P < Q\\)', 'is_correct' => false],
                    ['text' => '\\(P = Q\\)', 'is_correct' => true],
                    ['text' => 'Semua jawaban salah', 'is_correct' => false],
                    ['text' => 'Hubungan \\(P\\), \\(Q\\) tidak dapat ditentukan', 'is_correct' => false],
                ],
            ],
            // ================= Soal 7 =================
            [
                'question_text' => 'Seorang pedagang beras mencampurkan \\(w\\) kg beras seharga \\(y\\) per kg dengan \\(z\\) kg beras seharga \\(x\\) per kg. Jika pedagang menghendaki untung Rp2.500,00 per kg, maka harga jual beras campuran per kg adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Harga beli beras jenis I \\(\\rightarrow w \\times y\\)<br>Harga beli beras jenis II \\(\\rightarrow z \\times x\\)<br>Harga beli total per kg \\(= \\dfrac{wy + zx}{w + z}\\)<br>Karena menghendaki untung Rp2.500,00 per kg, maka harga jual per kg:<br>\\(\\dfrac{wy+zx}{w+z} + 2500 = \\dfrac{wy+zx}{w+z} + \\dfrac{2500(w+z)}{w+z}\\)<br>\\(= \\dfrac{wy + zx + 2500(w+z)}{w+z}\\)</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '\\(\\dfrac{wy + zx + 2500(w+z)}{w+z}\\)', 'is_correct' => true],
                    ['text' => '\\(\\dfrac{wy + zx + 2500}{w+z}\\)', 'is_correct' => false],
                    ['text' => '\\(\\dfrac{wy + zx}{w+z+2500}\\)', 'is_correct' => false],
                    ['text' => '\\(\\dfrac{wy + zx}{(w+z)2500}\\)', 'is_correct' => false],
                    ['text' => '\\(\\dfrac{2500(wy + zx)}{w+z}\\)', 'is_correct' => false],
                ],
            ],
            // ================= Soal 8 =================
            [
                'question_text' => 'Sasa mempunyai 805 ml sirup dalam sebuah wadah. Ia ingin memindahkan sirup tersebut ke dalam setengah dari jumlah botol yang dia miliki. Jika setiap botol Sasa mempunyai kapasitas 85 ml dan sirup tersebut masih tersisa 40 ml, berapa banyak botol yang dimiliki Sasa?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Banyak sirup yang dituang ke dalam botol \\(= 805 - 40 = 765\\) ml.<br>Banyak botol yang terisi \\(= \\dfrac{765}{85} = 9\\) botol.<br>Karena yang diisi hanya <strong>setengah</strong> dari jumlah botol milik Sasa, maka banyak botol yang dimiliki Sasa \\(= 9 \\times 2 = 18\\) botol.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => '7 botol', 'is_correct' => false],
                    ['text' => '9 botol', 'is_correct' => false],
                    ['text' => '10 botol', 'is_correct' => false],
                    ['text' => '14 botol', 'is_correct' => false],
                    ['text' => '18 botol', 'is_correct' => true],
                ],
            ],
            // ================= Soal 9 =================
            [
                'question_text' => 'Persamaan kuadrat yang akar-akarnya 2 lebihnya dari akar-akar persamaan kuadrat \\(m^{2} + 4m - 6 = 0\\) adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Misalkan akar-akar dari \\(m^{2} + 4m - 6 = 0\\) adalah \\(m_{1}\\) dan \\(m_{2}\\), dengan \\(a = 1,\\ b = 4,\\ c = -6\\).<br>\\(m_{1} + m_{2} = -\\dfrac{b}{a} = -4\\)<br>\\(m_{1} \\cdot m_{2} = \\dfrac{c}{a} = -6\\)<br><br>Misalkan \\(x_{1}\\) dan \\(x_{2}\\) adalah akar persamaan kuadrat baru, sehingga:<br>\\(x_{1} = m_{1} + 2 \\quad ; \\quad x_{2} = m_{2} + 2\\)<br>\\(x_{1} + x_{2} = (m_{1} + m_{2}) + 4 = -4 + 4 = 0\\)<br>\\(x_{1} \\cdot x_{2} = m_{1}m_{2} + 2(m_{1}+m_{2}) + 4 = -6 + 2(-4) + 4 = -10\\)<br><br>Persamaan kuadrat baru:<br>\\(m^{2} - (x_{1}+x_{2})m + (x_{1} \\cdot x_{2}) = 0\\)<br>\\(m^{2} - 0 \\cdot m + (-10) = 0\\)<br>\\(m^{2} - 10 = 0\\)</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => '\\(m^{2} - 8m = 0\\)', 'is_correct' => false],
                    ['text' => '\\(m^{2} - 10 = 0\\)', 'is_correct' => true],
                    ['text' => '\\(m^{2} + 6m - 8 = 0\\)', 'is_correct' => false],
                    ['text' => '\\(m^{2} + 8m - 12 = 0\\)', 'is_correct' => false],
                    ['text' => '\\(2m^{2} + 8m - 4 = 0\\)', 'is_correct' => false],
                ],
            ],
            // ================= Soal 10 =================
            [
                'question_text' => 'Untuk membuat sebuah baju dibutuhkan kain dengan panjang 1,5 meter dan lebar 1 meter serta 8 buah kancing. Pada suatu hari telah dihabiskan 144 kancing. Lebar kain yang telah digunakan jika panjangnya 9 meter adalah..',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Produksi harian \\(= \\dfrac{144}{8} = 18\\) buah baju.<br>Luas kain yang digunakan \\(= 18 \\times 1{,}5 \\times 1 = 27\\) m&sup2;.<br>Jika panjangnya 9 meter, maka lebarnya \\(= \\dfrac{27}{9} = 3\\) meter.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '3 meter', 'is_correct' => true],
                    ['text' => '4 meter', 'is_correct' => false],
                    ['text' => '5 meter', 'is_correct' => false],
                    ['text' => '6 meter', 'is_correct' => false],
                    ['text' => '7 meter', 'is_correct' => false],
                ],
            ],
            // ================= Soal 11 =================
            [
                'question_text' => 'Jika \\(\\dfrac{1}{a^{2}} - 3 = \\dfrac{1}{5}\\) maka \\(a\\sqrt{5} = \\ldots\\)',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>\\(\\dfrac{1}{a^{2}} - 3 = \\dfrac{1}{5}\\)<br>\\(a^{-2} = \\dfrac{1}{5} + 3\\)<br>\\(a^{-2} = \\dfrac{1 + 15}{5} = \\dfrac{16}{5}\\)<br>\\(a^{2} = \\dfrac{5}{16} \\ \\Rightarrow\\ a = \\sqrt{\\dfrac{5}{16}} = \\dfrac{\\sqrt{5}}{4}\\)<br><br>Jadi, \\(a\\sqrt{5} = \\dfrac{\\sqrt{5}}{4} \\times \\sqrt{5} = \\dfrac{5}{4} = 1\\tfrac{1}{4}\\)</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => '14', 'is_correct' => false],
                    ['text' => '52', 'is_correct' => false],
                    ['text' => '45', 'is_correct' => false],
                    ['text' => '\\(\\sqrt{5}\\)', 'is_correct' => false],
                    ['text' => '\\(1\\tfrac{1}{4}\\)', 'is_correct' => true],
                ],
            ],
            // ================= Soal 12 =================
            [
                'question_text' => 'Diketahui bahwa \\(a - 7b = 8c\\) dan \\(8b + 9c = 7\\). Jika \\(8\\sqrt{2} - 1 = 7 - c\\) maka \\(a + b = \\ldots\\)',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Diketahui \\(a - 7b = 8c\\) dan \\(8b + 9c = 7\\). Jumlahkan kedua persamaan:<br>\\((a - 7b) + (8b + 9c) = 8c + 7\\)<br>\\(a + b + 9c = 8c + 7\\)<br>\\(a + b = -c + 7\\)<br>\\(a + b = 7 - c\\)<br><br>Karena dari soal \\(7 - c = 8\\sqrt{2} - 1\\), maka \\(a + b = 8\\sqrt{2} - 1\\).</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '\\(8\\sqrt{2} - 1\\)', 'is_correct' => true],
                    ['text' => '\\(8\\sqrt{2}\\)', 'is_correct' => false],
                    ['text' => '1', 'is_correct' => false],
                    ['text' => '\\(\\sqrt{2}\\)', 'is_correct' => false],
                    ['text' => '0', 'is_correct' => false],
                ],
            ],
            // ================= Soal 13 =================
            [
                'question_text' => 'Jika \\(25^{(2x^{2} - 4x - 5)} = 5^{(3x^{2} - 7x - 4)}\\), maka nilai \\(x > 0\\) yang memenuhi adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>\\(25^{(2x^{2} - 4x - 5)} = 5^{(3x^{2} - 7x - 4)}\\)<br>\\(5^{2(2x^{2} - 4x - 5)} = 5^{(3x^{2} - 7x - 4)}\\)<br>\\(5^{(4x^{2} - 8x - 10)} = 5^{(3x^{2} - 7x - 4)}\\)<br><br>Karena basisnya sama, maka pangkatnya dapat disamakan:<br>\\(4x^{2} - 8x - 10 = 3x^{2} - 7x - 4\\)<br>\\(x^{2} - x - 6 = 0\\)<br>\\((x - 3)(x + 2) = 0\\)<br>\\(x = 3 \\ \\text{atau} \\ x = -2\\)<br><br>Karena \\(x > 0\\), maka \\(x\\) yang memenuhi adalah \\(x = 3\\).</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '3', 'is_correct' => true],
                    ['text' => '2', 'is_correct' => false],
                    ['text' => '1', 'is_correct' => false],
                    ['text' => '0', 'is_correct' => false],
                    ['text' => '-1', 'is_correct' => false],
                ],
            ],
            // ================= Soal 14 =================
            [
                'question_text' => '\\(\\dfrac{17^{2} - 7^{2} + 8\\% \\times 3500}{52} = \\ldots\\)',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>\\(17^{2} - 7^{2} = (17-7)(17+7) = 10 \\times 24 = 240\\)<br>\\(8\\% \\times 3500 = \\dfrac{8}{100} \\times 3500 = 280\\)<br><br>Sehingga:<br>\\(\\dfrac{240 + 280}{52} = \\dfrac{520}{52} = 10\\)</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '45', 'is_correct' => false],
                    ['text' => '37', 'is_correct' => false],
                    ['text' => '25', 'is_correct' => false],
                    ['text' => '10', 'is_correct' => true],
                    ['text' => '0', 'is_correct' => false],
                ],
            ],
            // ================= Soal 15 =================
            [
                'question_text' => 'Jika 5 kali banyak kelereng Gino dikurangi dengan 7 kali banyak kelereng Ani maka hasilnya adalah 10. Jika 4 kali banyak kelereng Gino dikurangi 6 kali banyak kelereng Ani maka hasilnya 12. Jika \\(x\\) adalah banyaknya kelereng Ani dan \\(y\\) adalah banyaknya kelereng Gino, maka ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>\\(x\\) adalah banyaknya kelereng Ani, \\(y\\) adalah banyaknya kelereng Gino.<br><br>Persamaan (i): \\(5y - 7x = 10\\)<br>Persamaan (ii): \\(4y - 6x = 12\\)<br><br>Kurangkan (i) dengan (ii):<br>\\((5y - 7x) - (4y - 6x) = 10 - 12\\)<br>\\(y - x = -2\\)<br>\\(y = x - 2\\)<br><br>Karena \\(y = x - 2\\), artinya \\(y\\) selalu lebih kecil dari \\(x\\). Jadi \\(x > y\\).</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '\\(x > y\\)', 'is_correct' => true],
                    ['text' => '\\(x < y\\)', 'is_correct' => false],
                    ['text' => '\\(x = y\\)', 'is_correct' => false],
                    ['text' => '\\(x = 2y\\)', 'is_correct' => false],
                    ['text' => 'Hubungan \\(x\\) dan \\(y\\) tidak dapat ditentukan.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 16 =================
            [
                'question_text' => 'Jika \\(x = \\dfrac{1}{17} - \\dfrac{1}{21}\\) dan \\(y = \\dfrac{1}{19} - \\dfrac{1}{23}\\) maka ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>\\(x = \\dfrac{1}{17} - \\dfrac{1}{21} = \\dfrac{21 - 17}{17 \\times 21} = \\dfrac{4}{357}\\)<br>\\(y = \\dfrac{1}{19} - \\dfrac{1}{23} = \\dfrac{23 - 19}{19 \\times 23} = \\dfrac{4}{437}\\)<br><br>Jika pembilang dua pecahan adalah sama, maka pecahan dengan penyebut yang lebih besar memiliki nilai yang lebih kecil.<br>Karena pembilang \\(x\\) dan \\(y\\) sama (yaitu 4) dan penyebut \\(x\\) lebih kecil daripada penyebut \\(y\\), maka \\(x > y\\).</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => '\\(x < y\\)', 'is_correct' => false],
                    ['text' => '\\(x > y\\)', 'is_correct' => true],
                    ['text' => '\\(x = y\\)', 'is_correct' => false],
                    ['text' => '\\(2x = y\\)', 'is_correct' => false],
                    ['text' => 'Hubungan \\(x\\) dan \\(y\\) tidak dapat ditentukan', 'is_correct' => false],
                ],
            ],
            // ================= Soal 17 =================
            [
                'question_text' => 'Sebuah bola dijatuhkan dari ketinggian \\(x\\) m ke lantai. Jarak yang ditempuh bola sampai berhenti adalah 10 m. Jika setiap kali memantul, bola mencapai ketinggian \\(\\tfrac{1}{3}\\) kali tinggi sebelumnya, maka nilai \\(x\\) adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Gunakan rumus panjang lintasan bola pantul:<br>\\(S = H_{0}\\left(\\dfrac{b + a}{b - a}\\right)\\)<br><br>Diketahui \\(H_{0} = x\\), \\(S = 10\\), dan perbandingan pantulan \\(\\dfrac{a}{b} = \\dfrac{1}{3}\\) sehingga \\(a = 1,\\ b = 3\\).<br><br>\\(10 = x\\left(\\dfrac{3 + 1}{3 - 1}\\right)\\)<br>\\(10 = x\\left(\\dfrac{4}{2}\\right) = 2x\\)<br>\\(x = 5\\)<br><br>Jadi, nilai \\(x\\) adalah <strong>5 m</strong>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '10 m', 'is_correct' => false],
                    ['text' => '9 m', 'is_correct' => false],
                    ['text' => '8 m', 'is_correct' => false],
                    ['text' => '5 m', 'is_correct' => true],
                    ['text' => '4 m', 'is_correct' => false],
                ],
            ],
            // ================= Soal 18 =================
            [
                'question_text' => 'Rata-rata nilai siswa putri dan siswa putra di kelas M berturut-turut adalah 83 dan 78. Jika rata-rata nilai seluruh siswa di kelas tersebut adalah 80, maka persentase banyak siswa putra terhadap banyak siswa putri di kelas M adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Rata-rata nilai siswa putra \\(\\bar{x}_{1} = 78\\)<br>Rata-rata nilai siswa putri \\(\\bar{x}_{2} = 83\\)<br>Rata-rata nilai seluruh siswa \\(\\bar{x}_{gab} = 80\\)<br>Banyak siswa putra \\(= n_{1}\\), banyak siswa putri \\(= n_{2}\\)<br><br>\\(\\dfrac{n_{1}}{n_{2}} = \\dfrac{\\bar{x}_{2} - \\bar{x}_{gab}}{\\bar{x}_{gab} - \\bar{x}_{1}} = \\dfrac{83 - 80}{80 - 78} = \\dfrac{3}{2}\\)<br><br>Jadi persentase jumlah siswa putra terhadap jumlah siswa putri di kelas M adalah \\(\\dfrac{3}{2} \\times 100\\% = 150\\%\\).</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => '160%', 'is_correct' => false],
                    ['text' => '150%', 'is_correct' => true],
                    ['text' => '145%', 'is_correct' => false],
                    ['text' => '140%', 'is_correct' => false],
                    ['text' => '130%', 'is_correct' => false],
                ],
            ],
            // ================= Soal 19 =================
            [
                'question_text' => 'Dalam suatu pameran, \\(\\tfrac{5}{7}\\) pengunjungnya adalah laki-laki. \\(\\tfrac{3}{5}\\) pengunjung laki-laki memakai kacamata. Jika \\(\\tfrac{4}{7}\\) dari pengunjung yang datang memakai kacamata, ada berapa pengunjung perempuan yang tidak berkacamata?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Banyak laki-laki \\(= \\dfrac{5}{7}\\)<br>Banyak laki-laki yang berkacamata \\(= \\dfrac{3}{5} \\times \\dfrac{5}{7} = \\dfrac{3}{7}\\)<br>Banyak perempuan yang berkacamata \\(= \\dfrac{4}{7} - \\dfrac{3}{7} = \\dfrac{1}{7}\\)<br>Banyak perempuan seluruhnya \\(= 1 - \\dfrac{5}{7} = \\dfrac{2}{7}\\)<br><br>Banyak perempuan yang tidak memakai kacamata \\(= \\dfrac{2}{7} - \\dfrac{1}{7} = \\dfrac{1}{7}\\)</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => '\\(\\tfrac{3}{14}\\)', 'is_correct' => false],
                    ['text' => '\\(\\tfrac{5}{14}\\)', 'is_correct' => false],
                    ['text' => '\\(\\tfrac{1}{7}\\)', 'is_correct' => true],
                    ['text' => '\\(\\tfrac{2}{7}\\)', 'is_correct' => false],
                    ['text' => '\\(\\tfrac{3}{7}\\)', 'is_correct' => false],
                ],
            ],
            // ================= Soal 20 =================
            [
                'question_text' => '1, 3, 1, 4, 2, 7, 6, 13, ..., ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Deret ini terdiri atas dua pola yang berselang-seling.<br><br>Suku ganjil (1, 1, 2, 6, ...) &rarr; dikalikan berturut-turut \\(\\times 1,\\ \\times 2,\\ \\times 3,\\ \\times 4\\)<br>\\(1 \\times 1 = 1;\\quad 1 \\times 2 = 2;\\quad 2 \\times 3 = 6;\\quad 6 \\times 4 = 24\\)<br><br>Suku genap (3, 4, 7, 13, ...) &rarr; ditambah berturut-turut \\(+1,\\ +3,\\ +6,\\ +10\\)<br>\\(3 + 1 = 4;\\quad 4 + 3 = 7;\\quad 7 + 6 = 13;\\quad 13 + 10 = 23\\)<br><br>Jadi dua suku berikutnya adalah <strong>24, 23</strong>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '16, 18', 'is_correct' => false],
                    ['text' => '20, 22', 'is_correct' => false],
                    ['text' => '12, 15', 'is_correct' => false],
                    ['text' => '24, 23', 'is_correct' => true],
                    ['text' => '15, 19', 'is_correct' => false],
                ],
            ],
            // ================= Soal 21 =================
            [
                'question_text' => 'B, A, F, B, D, C, L, ..., ..., ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Deret ini terdiri atas dua pola berselang-seling (gunakan urutan huruf A=1, B=2, C=3, dan seterusnya).<br><br>Suku ganjil: B(2), F(6), D(4), L(12), ... &rarr; polanya \\(\\times 3,\\ -2,\\ \\times 3,\\ -2\\)<br>\\(2 \\times 3 = 6 \\ (F);\\quad 6 - 2 = 4 \\ (D);\\quad 4 \\times 3 = 12 \\ (L);\\quad 12 - 2 = 10 \\ (J)\\)<br><br>Suku genap: A(1), B(2), C(3), ... &rarr; polanya \\(+1,\\ +1,\\ +1,\\ +1\\)<br>Huruf ke-4 = <strong>D</strong>, huruf ke-10 = <strong>J</strong>, huruf ke-5 = <strong>E</strong>.<br><br>Jadi tiga suku berikutnya adalah <strong>D, J, E</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'C, K, F', 'is_correct' => false],
                    ['text' => 'D, B, E', 'is_correct' => false],
                    ['text' => 'D, J, E', 'is_correct' => true],
                    ['text' => 'D, I, L', 'is_correct' => false],
                    ['text' => 'E, K, C', 'is_correct' => false],
                ],
            ],
            // ================= Soal 22 =================
            [
                'question_text' => 'Tidak satupun badak di Ujung Kulon bercula dua. Kebanyakan badak di Ujung Kulon bertubuh kecil.',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Premis 1: Tidak satu pun badak di Ujung Kulon bercula dua &rarr; berarti <strong>semua</strong> badak di Ujung Kulon tidak bercula dua.<br>Premis 2: Kebanyakan badak di Ujung Kulon bertubuh kecil &rarr; berarti <strong>beberapa</strong> badak di Ujung Kulon bertubuh kecil.<br><br>Sehingga kesimpulannya: <strong>beberapa badak di Ujung Kulon bertubuh kecil tidak bercula dua</strong>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Semua badak di Ujung Kulon bercula dua.', 'is_correct' => false],
                    ['text' => 'Semua badak tinggal di Ujung Kulon.', 'is_correct' => false],
                    ['text' => 'Sedikit badak di Ujung Kulon bertubuh besar.', 'is_correct' => false],
                    ['text' => 'Beberapa badak di Ujung Kulon bertubuh kecil tidak bercula dua', 'is_correct' => true],
                    ['text' => 'Beberapa badak di Ujung Kulon bercula satu.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 23 =================
            [
                'question_text' => 'Semua layanan internet adalah layanan berbayar. Semua ponsel terbaru memiliki layanan internet.',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Premis 1: Semua layanan internet adalah layanan berbayar.<br>Premis 2: Semua ponsel terbaru memiliki layanan internet.<br><br>Silogisme: ponsel terbaru &rarr; layanan internet &rarr; layanan berbayar.<br>Kesimpulan: <strong>Semua ponsel terbaru memiliki layanan berbayar</strong>.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => 'Semua layanan berbayar dimiliki ponsel terbaru', 'is_correct' => false],
                    ['text' => 'Tidak mungkin semua layanan berbayar dimiliki ponsel terbaru.', 'is_correct' => false],
                    ['text' => 'Semua layanan berbayar hanyalah layanan internet', 'is_correct' => false],
                    ['text' => 'Tidak mungkin semua layanan internet dimiliki ponsel terbaru', 'is_correct' => false],
                    ['text' => 'Semua ponsel terbaru memiliki layanan berbayar', 'is_correct' => true],
                ],
            ],
            // ================= Soal 24 =================
            [
                'question_text' => 'Semua pengendara kendaraan bermotor harus memiliki SIM. Badu adalah seorang petugas yang menyeleksi Ujian Praktek untuk mendapat SIM. Simon mempunyai SIM. Jadi kesimpulan yang tepat adalah ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Premis: Semua pengendara kendaraan bermotor harus memiliki SIM.<br>Fakta: Simon mempunyai SIM.<br><br>Premis hanya menyatakan arah &ldquo;pengendara &rarr; memiliki SIM&rdquo;, bukan sebaliknya. Dari fakta bahwa Simon mempunyai SIM, kita tidak dapat memastikan Simon pengendara, mengikuti ujian praktek, ataupun bertemu Badu.<br>Jadi jawabannya <strong>tidak dapat disimpulkan</strong>.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => 'Pemilik SIM mengikuti ujian praktek', 'is_correct' => false],
                    ['text' => 'Semua pengendara kendaraan bermotor pernah mengikuti ujian praktek', 'is_correct' => false],
                    ['text' => 'Simon mengikuti ujian praktek', 'is_correct' => false],
                    ['text' => 'Simon pernah bertemu dengan Badu', 'is_correct' => false],
                    ['text' => 'Tidak dapat disimpulkan', 'is_correct' => true],
                ],
            ],
            // ================= Soal 25 =================
            [
                'question_text' => 'Suatu proyek pembangunan terdiri atas beberapa jenis proyek kecil, yakni proyek P, Q, R, S, T, dan U. Proyek kecil ini berkaitan satu dengan yang lain sehingga setiap jenis proyek tersebut diatur sebagai berikut:<br><li>Proyek Q tidak boleh dikerjakan bersamaan dengan proyek S</li><li>Proyek P boleh dikerjakan bersama dengan proyek T</li><li>Proyek Q dikerjakan bersama dengan proyek R</li><li>Proyek T dikerjakan jika dan hanya jika proyek U dikerjakan</li><br>Jika pekerja mengerjakan proyek R, maka ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Dari soal diketahui:<br><li>Proyek Q dikerjakan bersama dengan proyek R, berarti jika proyek R dikerjakan maka proyek Q juga dikerjakan.</li><li>Proyek Q tidak boleh dikerjakan bersamaan dengan proyek S. Karena proyek Q dikerjakan, maka proyek S tidak dikerjakan.</li><br>Jadi, jika pekerja mengerjakan proyek R, maka <strong>pekerja tidak akan mengerjakan proyek S</strong>.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => 'Pekerja tidak akan mengerjakan proyek Q', 'is_correct' => false],
                    ['text' => 'Pekerja tidak akan mengerjakan proyek S', 'is_correct' => true],
                    ['text' => 'Pekerja tidak akan mengerjakan proyek P', 'is_correct' => false],
                    ['text' => 'Pekerja tidak akan mengerjakan proyek U', 'is_correct' => false],
                    ['text' => 'Pekerja tidak akan mengerjakan proyek T', 'is_correct' => false],
                ],
            ],
            // ================= Soal 26 =================
            [
                'question_text' => 'Dalam suatu perkuliahan ada 6 mata kuliah yaitu U, V, W, X, Y, Z. Tiap mata kuliah diambil dalam semester berbeda, dari semester 1 sampai semester 6. Mata kuliah W diambil 3 semester setelah mata kuliah V. Mata kuliah V lebih dulu diambil daripada mata kuliah Z. X hanya bisa diambil setelah Z. Bila mata kuliah Z diambil pada semester ketiga, maka yang mungkin diambil pada semester kedua adalah',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Diketahui:<br><li>Mata kuliah Z diambil semester ketiga</li><li>Mata kuliah V lebih dulu diambil daripada mata kuliah Z</li><li>Mata kuliah W diambil 3 semester setelah mata kuliah V</li><li>X hanya bisa diambil setelah Z</li><br>Jawaban A, B, dan D salah karena X hanya bisa diambil setelah Z (semester 3), sehingga X tidak mungkin di semester kedua.<br>Jawaban E salah karena W hanya bisa diambil 3 semester setelah V, sehingga W tidak mungkin di semester kedua.<br>Jadi yang mungkin diambil pada semester kedua adalah <strong>V dan Y</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'U dan X', 'is_correct' => false],
                    ['text' => 'W dan X', 'is_correct' => false],
                    ['text' => 'V dan Y', 'is_correct' => true],
                    ['text' => 'X dan Y', 'is_correct' => false],
                    ['text' => 'W dan U', 'is_correct' => false],
                ],
            ],
            // ================= Soal 27 =================
            [
                'question_text' => '5, 10, 15, 20, 45, 40, 135, 80, ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Deret ini terdiri atas dua pola berselang-seling.<br><br>Suku ganjil: <strong>5</strong>, 10, <strong>15</strong>, 20, <strong>45</strong>, 40, <strong>135</strong>, 80, <strong>405</strong><br>Jadi suku ganjil dikalikan 3 dan seterusnya:<br>\\(5 \\times 3 = 15;\\quad 15 \\times 3 = 45;\\quad 45 \\times 3 = 135;\\quad 135 \\times 3 = 405\\)<br><br>Jadi suku berikutnya adalah <strong>405</strong>.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => '115', 'is_correct' => false],
                    ['text' => '160', 'is_correct' => false],
                    ['text' => '240', 'is_correct' => false],
                    ['text' => '270', 'is_correct' => false],
                    ['text' => '405', 'is_correct' => true],
                ],
            ],
            // ================= Soal 28 =================
            [
                'question_text' => 'Sakit berhubungan dengan .... , sebagaimana ...., berhubungan dengan makan.',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Orang yang <strong>SAKIT</strong> membutuhkan <strong>ISTIRAHAT</strong>, sebagaimana orang yang <strong>LAPAR</strong> membutuhkan <strong>MAKAN</strong>.<br>Jadi jawabannya adalah <strong>Istirahat &ndash; Lapar</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Dokter-sakit', 'is_correct' => false],
                    ['text' => 'Makan-lemah', 'is_correct' => false],
                    ['text' => 'Istirahat-Lapar', 'is_correct' => true],
                    ['text' => 'Berobat-gemuk', 'is_correct' => false],
                    ['text' => 'Pasien-gizi', 'is_correct' => false],
                ],
            ],
            // ================= Soal 29 =================
            [
                'question_text' => 'Kaku berhubungan dengan ..., sebagaimana ..., berhubungan dengan karet.',
                'explanation'   => '<p><strong>Pembahasan:</strong><br><strong>KAKU</strong> adalah sifat dari <strong>BESI</strong>, sebagaimana <strong>LENTUR</strong> adalah sifat dari <strong>KARET</strong>.<br>Jadi jawabannya adalah <strong>Besi &ndash; lentur</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Tongkat-gelang', 'is_correct' => false],
                    ['text' => 'Batu-lembut', 'is_correct' => false],
                    ['text' => 'Besi-lentur', 'is_correct' => true],
                    ['text' => 'Kaki-fleksibel', 'is_correct' => false],
                    ['text' => 'Kayu-lateks', 'is_correct' => false],
                ],
            ],
            // ================= Soal 30 =================
            [
                'question_text' => 'Perlop = ....',
                'explanation'   => '<p><strong>Pembahasan:</strong><br><strong>Perlop</strong> = <strong>Cuti</strong>, yaitu izin tidak bekerja dalam beberapa hari untuk beristirahat atau karena sakit.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Absen', 'is_correct' => false],
                    ['text' => 'Masuk', 'is_correct' => false],
                    ['text' => 'Terlambat', 'is_correct' => false],
                    ['text' => 'Cuti', 'is_correct' => true],
                    ['text' => 'Pulang', 'is_correct' => false],
                ],
            ],
            // ================= Soal 31 =================
            [
                'question_text' => 'BALAI YASA = ...',
                'explanation'   => '<p><strong>Pembahasan:</strong><br><strong>Balai Yasa</strong> adalah <strong>bengkel lokomotif</strong>, yaitu tempat perawatan dan perbaikan berat sarana perkeretaapian (lokomotif dan kereta).</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => 'Bengkel lokomotif', 'is_correct' => true],
                    ['text' => 'Aula', 'is_correct' => false],
                    ['text' => 'Ruang pertemuan', 'is_correct' => false],
                    ['text' => 'Rumah makan', 'is_correct' => false],
                    ['text' => 'Rumah sakit', 'is_correct' => false],
                ],
            ],
            // ================= Soal 32 =================
            [
                'question_text' => 'Berapa lama waktu diperlukan untuk mengisi penuh air ke dalam sebuah tangki berkapasitas 3.750 sentimeter kubik jika air tersebut dipompakan ke dalam tangki dengan kecepatan 800 sentimeter kubik per menit dan air yang telah masuk sebagian dialirkan keluar tangki dengan kecepatan 300 sentimeter kubik per menit?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Debit bersih pengisian \\(= 800 - 300 = 500\\) cm&sup3;/menit.<br>Waktu yang diperlukan \\(= \\dfrac{3.750}{500} = 7{,}5\\) menit.<br>\\(7{,}5\\) menit = <strong>7 menit 30 detik</strong>.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '7 menit 30 detik', 'is_correct' => true],
                    ['text' => '8 menit', 'is_correct' => false],
                    ['text' => '3 menit 36 detik', 'is_correct' => false],
                    ['text' => '6 menit', 'is_correct' => false],
                    ['text' => '5 menit 25 detik', 'is_correct' => false],
                ],
            ],
            // ================= Soal 33 =================
            [
                'question_text' => 'Panitia mengedarkan undangan pertemuan untuk 50 wanita dan 70 pria. Jika ternyata 40% dari undangan wanita dan 50% undangan pria hadir, kira-kira berapa persen yang hadir?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Wanita yang hadir \\(= 40\\% \\times 50 = 20\\) orang.<br>Pria yang hadir \\(= 50\\% \\times 70 = 35\\) orang.<br>Total undangan \\(= 50 + 70 = 120\\) orang.<br><br>Persentase yang hadir \\(= \\dfrac{20 + 35}{120} \\times 100\\% = \\dfrac{55}{120} \\times 100\\% \\approx 46\\%\\)</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '90', 'is_correct' => false],
                    ['text' => '86', 'is_correct' => false],
                    ['text' => '48', 'is_correct' => false],
                    ['text' => '46', 'is_correct' => true],
                    ['text' => '40', 'is_correct' => false],
                ],
            ],
            // ================= Soal 34 =================
            [
                'question_text' => 'Seorang siswa memperoleh nilai 91, 88, 86, dan 78 untuk empat mata pelajaran. Berapa nilai yang harus diperoleh untuk mata pelajaran ke lima agar dia memperoleh rata-rata 85?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Misalkan nilai mata pelajaran kelima adalah \\(x\\).<br>\\(\\dfrac{91 + 88 + 86 + 78 + x}{5} = 85\\)<br>\\(343 + x = 85 \\times 5 = 425\\)<br>\\(x = 425 - 343 = 82\\)</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '86', 'is_correct' => false],
                    ['text' => '85', 'is_correct' => false],
                    ['text' => '84', 'is_correct' => false],
                    ['text' => '82', 'is_correct' => true],
                    ['text' => '80', 'is_correct' => false],
                ],
            ],
            // ================= Soal 35 =================
            [
                'question_text' => 'Jika M adalah himpunan huruf yang terdapat pada kata &ldquo;CATATAN&rdquo;, maka banyaknya himpunan bagian dari M yang tidak kosong adalah?',
                'explanation'   => '<p><strong>Pembahasan:</strong><br>Huruf berbeda pada kata CATATAN adalah C, A, T, N, sehingga \\(M = \\{C, A, T, N\\}\\) dengan \\(n(M) = 4\\).<br>Banyak seluruh himpunan bagian \\(= 2^{4} = 16\\)<br>Himpunan kosong ada 1.<br><br>Maka banyaknya himpunan bagian dari M yang tidak kosong \\(= 16 - 1 = 15\\).</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '12', 'is_correct' => false],
                    ['text' => '13', 'is_correct' => false],
                    ['text' => '14', 'is_correct' => false],
                    ['text' => '15', 'is_correct' => true],
                    ['text' => '16', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id'   => $materialId,
                'type'          => 'mcq',
                'test_type'     => 'tiu',
                'question_text' => $question['question_text'],
                'image'         => null,
                'explanation'   => $question['explanation'],
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            foreach ($question['options'] as $index => $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option['text'],
                    'is_correct'  => $option['is_correct'],
                    'image'       => null,
                    'order'       => $index + 1,
                    'weight'      => 0,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }
        }

        $this->command->info('Seeder TIU TO AGUSTUS berhasil dijalankan!');
        $this->command->info('Material ID : ' . $materialId);
        $this->command->info('Total soal  : ' . count($questions));
    }
}
