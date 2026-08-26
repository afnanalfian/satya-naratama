<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder soal TWK - Try Out SKD AGUSTUS (Satya Naratama)
 *
 * Total soal : 30 (nomor 1 - 30)
 * Material   : id = 4
 * Test type  : twk
 */
class TWKTOAGUSTUSSeeder extends Seeder
{
    public function run(): void
    {
        $now        = Carbon::now();
        $materialId = 4;

        $questions = [
            // ================= Soal 1 =================
            [
                'question_text' => 'Pegawai Kementerian Keuangan dan pihak lain yang berkaitan dengan pelaksanaan Pengampunan Pajak, dilarang membocorkan, menyebarluaskan, dan atau memberitahukan data dan informasi yang diketahui atau diberitahukan oleh Wajib Pajak kepada pihak lain. Jika terbukti melanggar ketentuan ini dapat dipidana dengan pidana penjara paling lama ...',
                'explanation'   => '<p><strong>Pembahasan:</strong> Ketentuan tindak pidana pembocoran data Pengampunan Pajak tercantum dalam Undang-Undang Tax Amnesty Pasal 23 Bab XI tentang Ketentuan Pidana. Ayat (1) menyebutkan bahwa setiap orang (Menteri, Wakil Menteri, Pegawai Kementerian Keuangan, dan pihak lain) yang melanggar atau membocorkan data dan informasi tax amnesty dapat dipidana dengan pidana penjara paling lama <strong>5 tahun</strong>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => '1 tahun', 'is_correct' => false],
                    ['text' => '3 tahun', 'is_correct' => false],
                    ['text' => '4 tahun', 'is_correct' => false],
                    ['text' => '5 tahun', 'is_correct' => true],
                    ['text' => '6 tahun', 'is_correct' => false],
                ],
            ],
            // ================= Soal 2 =================
            [
                'question_text' => 'Latar belakang diterapkannya Tanam Paksa di Indonesia oleh Van De Bosch terutama adalah untuk.....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Sekitar tahun 1830 negeri Belanda menghadapi keadaan ekonomi yang sangat buruk akibat pemberontakan Belgia dan Perang Diponegoro yang memakan biaya sangat besar. Untuk menyelamatkan negara dari kehancuran, Raja William I mengangkat Van Den Bosch sebagai Gubernur Jenderal di Indonesia dengan tugas utama <strong>mengisi kekosongan kas negara</strong>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Menghentikan krisis ekonomi.', 'is_correct' => false],
                    ['text' => 'Mengenalkan jenis tanaman baru.', 'is_correct' => false],
                    ['text' => 'Meningkatkan hasil pertanian.', 'is_correct' => false],
                    ['text' => 'Mengisi kas negara yang kosong.', 'is_correct' => true],
                    ['text' => 'Meningkatkan perdagangan', 'is_correct' => false],
                ],
            ],
            // ================= Soal 3 =================
            [
                'question_text' => 'Selama pendudukan Jepang di Indonesia, K.H. Zaenal Mustofa pernah melakukan pemberontakan terhadap Jepang dikarenakan...',
                'explanation'   => '<p><strong>Pembahasan:</strong> K.H. Zaenal Mustofa melakukan perlawanan terhadap Jepang di Tasikmalaya karena beliau <strong>tidak bersedia melakukan seikeirei</strong>, yaitu memberi penghormatan kepada Kaisar Jepang dengan membungkukkan badan ke arah Tokyo. Bagi beliau, perbuatan tersebut bertentangan dengan akidah.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Ketidakpuasan atas janji Jepang.', 'is_correct' => false],
                    ['text' => 'Penderitaan rakyat akibat romusha.', 'is_correct' => false],
                    ['text' => 'Tidak bersedia melakukan seikeirei.', 'is_correct' => true],
                    ['text' => 'Tidak adanya kebebasan rakyat dalam berorganisasi.', 'is_correct' => false],
                    ['text' => 'H. Zaenal Mustofa dipaksa Jepang bertempur melawan NICA.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 4 =================
            [
                'question_text' => 'Tujuan didirikan partai-partai politik sesuai dengan Maklumat Pemerintah tanggal 3 November 1945 adalah....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Isi Maklumat Pemerintah tanggal 3 November 1945:<br><li>Memperkuat perjuangan dalam mempertahankan kemerdekaan.</li><li>Pemerintah menyukai adanya partai-partai agar aliran paham yang ada dalam masyarakat dapat dipimpin sehingga teratur.</li><li>Partai-partai politik segera lahir sebelum dilangsungkannya pemilihan anggota badan-badan perwakilan rakyat bulan Januari 1946.</li></p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => 'Memperkuat perjuangan dalam mempertahankan kemerdekaan.', 'is_correct' => true],
                    ['text' => 'Agar bangsa Indonesia sejajar dengan bangsa-bangsa lain.', 'is_correct' => false],
                    ['text' => 'Agar bangsa Indonesia termasuk bangsa yang maju dan modern.', 'is_correct' => false],
                    ['text' => 'Untuk memudahkan pemerintah mengendalikan gejolak masyarakat', 'is_correct' => false],
                    ['text' => 'Agar rakyat tidak mengancam pemerintah pusat.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 5 =================
            [
                'question_text' => 'Pada awal pemerintahan Orde Baru perekonomian dan keuangan Indonesia sangat buruk. Untuk itu diadakan pertemuan antar negara-negara kreditor di Tokyo pada tanggal 19 - 20 September 1966, isinya...',
                'explanation'   => '<p><strong>Pembahasan:</strong> Pembicaraan mengenai penyelesaian utang-utang Indonesia dengan negara-negara kreditor dilakukan pertama kalinya di Tokyo pada 19&ndash;20 September 1966. Hasilnya adalah <strong>persetujuan negara-negara kreditor untuk menunda pembayaran utang Indonesia</strong>. Pembicaraan kemudian dilanjutkan di Paris dan mencapai kesepakatan pada 24 April 1970.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Indonesia mendapat bantuan pinjaman dengan bunga rendah.', 'is_correct' => false],
                    ['text' => 'Bunga rendah dibayar setelah lima tahun dihitung sesudah penerimaan peminjaman.', 'is_correct' => false],
                    ['text' => 'Ada beberapa negara kreditor yang memberikan pinjaman tanpa bunga.', 'is_correct' => false],
                    ['text' => 'Persetujuan di negara-negara kreditor untuk menunda pembayaran utang Indonesia.', 'is_correct' => true],
                    ['text' => 'Bantuan pinjaman hendaknya dimanfaatkan untuk proyek irigasi', 'is_correct' => false],
                ],
            ],
            // ================= Soal 6 =================
            [
                'question_text' => 'Perang dingin yang terjadi antara Amerika Serikat dengan Uni Soviet mendorong negara-negara di benua Asia-Afrika mencari alternatif untuk ikut memelihara perdamaian dunia dengan cara....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Gerakan Non Blok muncul setelah berakhirnya Perang Dunia II, ketika berkembang dua kekuatan besar yang saling bersaing dan bertentangan, yaitu Blok Barat (Amerika Serikat) dan Blok Timur (Uni Soviet). Pertentangan dan persaingan ini mendorong perlombaan senjata atom dan nuklir yang membahayakan perdamaian dunia, sehingga negara-negara Asia-Afrika memilih untuk <strong>mendirikan Gerakan Non Blok</strong>.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => 'Menyelenggarakan Konferensi Tingkat Tinggi antar negara Asia-Afrika.', 'is_correct' => false],
                    ['text' => 'Mendirikan negara Non Blok.', 'is_correct' => true],
                    ['text' => 'Mengusulkan dibentuknya pasukan perdamaian PBB.', 'is_correct' => false],
                    ['text' => 'Mendirikan ASEAN', 'is_correct' => false],
                    ['text' => 'Menolak dijadikannya pengkalan senjata nuklir dari kedua negara adi kuasa.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 7 =================
            [
                'question_text' => 'Lembaga kekuasaan kehakiman yang berwenang memeriksa dan memutus permohonan banding adalah&hellip;.',
                'explanation'   => '<p><strong>Pembahasan:</strong> Sesuai kunci jawaban paket ini, jawabannya adalah <strong>Mahkamah Agung</strong> sebagai puncak kekuasaan kehakiman yang memeriksa dan memutus permohonan upaya hukum di tingkat lebih tinggi.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Komisi Yudisial', 'is_correct' => false],
                    ['text' => 'Pengadilan Tinggi', 'is_correct' => false],
                    ['text' => 'Pengadilan Negeri', 'is_correct' => false],
                    ['text' => 'Mahkamah Agung', 'is_correct' => true],
                    ['text' => 'Mahkamah Konstitusi', 'is_correct' => false],
                ],
            ],
            // ================= Soal 8 =================
            [
                'question_text' => 'Dokumen naskah Proklamasi 17 Agustus 1945 pada hakikatnya merupakan &hellip;.',
                'explanation'   => '<p><strong>Pembahasan:</strong> Naskah Proklamasi termasuk <strong>bukti sejarah</strong> berupa peninggalan sejarah, karena merupakan sumber penulisan sejarah. Sumber tertulis adalah sumber sejarah yang diperoleh melalui peninggalan-peninggalan tertulis dan catatan peristiwa masa lampau, misalnya prasasti, dokumen, naskah, piagam, babad, surat kabar, tambo (catatan tahunan dari Cina), dan rekaman.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Fakta sejarah', 'is_correct' => false],
                    ['text' => 'Kisah sejarah', 'is_correct' => false],
                    ['text' => 'Bukti sejarah', 'is_correct' => true],
                    ['text' => 'Peristiwa sejarah', 'is_correct' => false],
                    ['text' => 'Bentuk sejarah', 'is_correct' => false],
                ],
            ],
            // ================= Soal 9 =================
            [
                'question_text' => 'Sidang PPKI pertama dilaksanakan di Pejambon. Sebelum rapat dimulai Ir. Sukarno dan Drs. Moh. Hatta meminta sejumlah tokoh islam untuk membahas kembali rancangan UUD. Hal itu disebabkan ada kelompok yang tidak bersedia menerima kalimat pada sila pertama naskah Piagam Jakarta. Tokoh-tokoh yang dimaksud adalah &hellip;',
                'explanation'   => '<p><strong>Pembahasan:</strong> Sebelum rapat dimulai, Ir. Sukarno dan Drs. Moh. Hatta meminta <strong>Ki Bagus Hadikusumo, K.H. Wachid Hasyim, Mr. Kasman Singodimedjo, dan Mr. Teuku Moh. Hasan</strong> untuk membahas kembali rancangan UUD. Demi menjaga persatuan bangsa, diadakan perubahan kalimat pada sila pertama naskah Piagam Jakarta. Perubahan tersebut disebabkan tokoh-tokoh dari Indonesia bagian timur merasa keberatan dengan kalimat &ldquo;Ketuhanan dengan kewajiban menjalankan syariat Islam bagi pemeluk-pemeluknya&rdquo;. Akhirnya kalimat itu diubah menjadi &ldquo;Ketuhanan Yang Maha Esa&rdquo;.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => 'Agus Salim, K.H. Wachid Hasyim, Mr. Kasman Singodimedjo, dan Mr. Teuku Moh. Hasan', 'is_correct' => false],
                    ['text' => 'Ki Bagus Hadikusumo, K.H. Wachid Hasyim, Mr. Kasman Singodimedjo, dan Mr. Teuku Moh. Hasan', 'is_correct' => true],
                    ['text' => 'Ki Bagus Hadikusumo, K.H. Wachid Hasyim, Otto Iskandardinata, dan Mr. Wongsonegoro', 'is_correct' => false],
                    ['text' => 'Otto Iskandardinata, Agus Salim, K.H. Wachid Hasyim, dan Mr. Supomo', 'is_correct' => false],
                    ['text' => 'Agus Salim, K.H. Wachid Hasyim, Ki Bagus Hadikusumo, dan Mr. Kasman Singodimedjo', 'is_correct' => false],
                ],
            ],
            // ================= Soal 10 =================
            [
                'question_text' => 'Pasal UUD yang berkaitan erat dengan Sila Kemanusiaan yang Adil dan Beradab adalah&hellip;.',
                'explanation'   => '<p><strong>Pembahasan:</strong> <strong>Pasal 34</strong> UUD NRI Tahun 1945 mengatur bahwa fakir miskin dan anak-anak terlantar dipelihara oleh negara, serta negara mengembangkan sistem jaminan sosial dan bertanggung jawab atas penyediaan fasilitas pelayanan kesehatan dan fasilitas pelayanan umum yang layak. Ketentuan ini merupakan perwujudan sila kedua, <em>Kemanusiaan yang Adil dan Beradab</em>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Pasal 29', 'is_correct' => false],
                    ['text' => 'Pasal 30', 'is_correct' => false],
                    ['text' => 'Pasal 33', 'is_correct' => false],
                    ['text' => 'Pasal 34', 'is_correct' => true],
                    ['text' => 'Pasal 35', 'is_correct' => false],
                ],
            ],
            // ================= Soal 11 =================
            [
                'question_text' => 'Pokok&ndash;pokok pikiran dalam pembukaan UUD 1945 yang menegaskan bahwa negara hendak mewujudkan keadilan sosial bagi seluruh rakyat Indonesia terdapat dalam..',
                'explanation'   => '<p><strong>Pembahasan:</strong> <strong>Pokok pikiran kedua</strong> Pembukaan UUD NRI Tahun 1945 berbunyi bahwa negara hendak mewujudkan keadilan sosial bagi seluruh rakyat Indonesia. Pokok pikiran ini merupakan penjabaran sila kelima Pancasila.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => 'Pokok pikiran pertama', 'is_correct' => false],
                    ['text' => 'Pokok pikiran kedua', 'is_correct' => true],
                    ['text' => 'Pokok pikiran ketiga', 'is_correct' => false],
                    ['text' => 'Pokok pikiran keempat', 'is_correct' => false],
                    ['text' => 'Pokok pikiran kelima', 'is_correct' => false],
                ],
            ],
            // ================= Soal 12 =================
            [
                'question_text' => 'Seorang tokoh yang menggulirkan program perestroika untuk meningkatkan perekonomian Uni Soviet adalah...',
                'explanation'   => '<p><strong>Pembahasan:</strong> Pada bulan Maret 1985, <strong>Mikhail Gorbachev</strong> diangkat menjadi Sekjen Partai Komunis Uni Soviet menggantikan Konstantin Chernenko, yang sekaligus mengantarkannya ke puncak kekuasaan di Uni Soviet. Programnya ialah <em>perestroika</em> (restrukturisasi) dan <em>glasnost</em> (keterbukaan) untuk membawa Uni Soviet keluar dari stagnasi politik dan ekonomi.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Lenin', 'is_correct' => false],
                    ['text' => 'Stalin', 'is_correct' => false],
                    ['text' => 'Mikhail Gorbachev', 'is_correct' => true],
                    ['text' => 'Leonid Breznev', 'is_correct' => false],
                    ['text' => 'Konstantin Chernenko', 'is_correct' => false],
                ],
            ],
            // ================= Soal 13 =================
            [
                'question_text' => 'Warga negara Indonesia yang kurang mampu mendapatkan perlindungan kesehatan dari negara berupa Kartu Indonesia Sehat. Hal ini sesuai dengan penerapan Pancasila terutama sila ke...',
                'explanation'   => '<p><strong>Pembahasan:</strong> Pemberian Kartu Indonesia Sehat kepada warga negara yang kurang mampu merupakan wujud pemerataan kesejahteraan dan jaminan sosial, sehingga sesuai dengan sila <strong>kelima</strong>, yaitu <em>Keadilan Sosial bagi Seluruh Rakyat Indonesia</em>.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => 'Pertama', 'is_correct' => false],
                    ['text' => 'Kedua', 'is_correct' => false],
                    ['text' => 'Ketiga', 'is_correct' => false],
                    ['text' => 'Keempat', 'is_correct' => false],
                    ['text' => 'Kelima', 'is_correct' => true],
                ],
            ],
            // ================= Soal 14 =================
            [
                'question_text' => 'Tujuan didirikan partai-partai politik sesuai dengan Maklumat Pemerintah tanggal 3 November 1945 adalah....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Tujuan utama pendirian partai politik menurut Maklumat Pemerintah 3 November 1945 adalah <strong>memperkuat perjuangan dalam mempertahankan kemerdekaan</strong>, di samping agar aliran paham yang ada dalam masyarakat dapat dipimpin secara teratur menjelang pemilihan anggota badan perwakilan rakyat pada Januari 1946.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => 'Memperkuat perjuangan dalam mempertahankan kemerdekaan.', 'is_correct' => true],
                    ['text' => 'Agar bangsa Indonesia sejajar dengan bangsa-bangsa lain.', 'is_correct' => false],
                    ['text' => 'Agar bangsa Indonesia termasuk bangsa yang maju dan modern.', 'is_correct' => false],
                    ['text' => 'Untuk memudahkan pemerintah mengendalikan gejolak masyarakat.', 'is_correct' => false],
                    ['text' => 'Agar rakyat tidak mengancam pemerintah pusat.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 15 =================
            [
                'question_text' => 'Pada awal pemerintahan Orde Baru perekonomian dan keuangan Indonesia sangat buruk. Untuk itu diadakan pertemuan antar negara-negara kreditor di Tokyo pada tanggal 19 - 20 September 1966, isinya...',
                'explanation'   => '<p><strong>Pembahasan:</strong> Pembicaraan mengenai penyelesaian utang-utang Indonesia dengan negara-negara kreditor dilakukan pertama kalinya di Tokyo pada 19&ndash;20 September 1966. Hasilnya adalah <strong>persetujuan negara-negara kreditor untuk menunda pembayaran utang Indonesia</strong>. Pembicaraan kemudian dilanjutkan di Paris dan mencapai kesepakatan pada 24 April 1970.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Indonesia mendapat bantuan pinjaman dengan bunga rendah.', 'is_correct' => false],
                    ['text' => 'Bunga rendah dibayar setelah lima tahun dihitung sesudah penerimaan peminjaman.', 'is_correct' => false],
                    ['text' => 'Ada beberapa negara kreditor yang memberikan pinjaman tanpa bunga.', 'is_correct' => false],
                    ['text' => 'Persetujuan di negara-negara kreditor untuk menunda pembayaran utang Indonesia.', 'is_correct' => true],
                    ['text' => 'Bantuan pinjaman hendaknya dimanfaatkan untuk proyek irigasi.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 16 =================
            [
                'question_text' => 'Berikut ini yang merupakan aktualisasi Pancasila secara obyektif adalah...',
                'explanation'   => '<p><strong>Pembahasan:</strong> Aktualisasi Pancasila secara <strong>objektif</strong> adalah pelaksanaan Pancasila dalam bentuk <strong>realisasi pada setiap aspek penyelenggaraan negara di semua bidang kenegaraan</strong>, yaitu melalui peraturan perundang-undangan. Sementara aktualisasi subjektif adalah pelaksanaan pada sikap pribadi setiap individu.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Pelaksanaan dalam sikap pribadi golongan, setiap anggota kelompok, setiap individu, setiap penduduk, setiap pengusaha dan rakyat Indonesia.', 'is_correct' => false],
                    ['text' => 'Pelaksanaan Pancasila sebagai konsep dasar dan gagasan mengenai wujud kehidupan yang baik dan dicitakan oleh bangsa Indonesia', 'is_correct' => false],
                    ['text' => 'Pelaksanaan Pancasila yang mengandung pikiran terdalam suatu bangsa mengenai kehidupan yang lebih baik dan dilaksanakan oleh pemerintah suatu negara', 'is_correct' => false],
                    ['text' => 'Pelaksanaan Pancasila dalam bentuk realisasi dalam setiap aspek penyelenggaraan negara di semua bidang kenegaraan', 'is_correct' => true],
                    ['text' => 'Pelaksanaan Pancasila dalam bentuk kristalisasi dalam setiap aspek penyelenggaraan negara, terutama di bidang eksekutif, legislatif, dan yudikatif', 'is_correct' => false],
                ],
            ],
            // ================= Soal 17 =================
            [
                'question_text' => 'Hukum menurut M. H. Tirtaatmidjaja adalah....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Menurut <strong>M. H. Tirtaatmidjaja</strong>, hukum ialah semua aturan (norma) yang harus diturut dalam tingkah laku tindakan-tindakan dalam pergaulan hidup dengan ancaman mesti mengganti kerugian, jika melanggar aturan-aturan itu akan membahayakan diri sendiri atau harta, umpamanya orang akan kehilangan kemerdekaannya, didenda, dan sebagainya.<br>Sebagai pembanding: pilihan A adalah definisi menurut Immanuel Kant, pilihan B menurut E. Utrecht/Wiryono, pilihan D menurut E.M. Meyers, dan pilihan E menurut S.M. Amin.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Hukum ialah keseluruhan syarat-syarat yang dengan ini kehendak bebas dari orang yang satu dapat menyesuaikan diri dengan kehendak bebas dari orang yang lain, menuruti peraturan hukum tentang kemerdekaan.', 'is_correct' => false],
                    ['text' => 'Hukum ialah semua aturan yang mengandung pertimbangan kesusilaan, ditujukan kepada tingkah laku manusia dalam masyarakat, dan yang menjadi pedoman bagi penguasa-penguasa negara dalam melakukan tugasnya', 'is_correct' => false],
                    ['text' => 'Hukum ialah semua aturan (norma) yang harus diturut dalam tingkah laku tindakan-tindakan dalam pergaulan hidup dengan ancaman mesti mengganti kerugian, jika melanggar aturan-aturan itu akan membahayakan diri sendiri atau harta, umpamanya orang akan kehilangan kemerdekaannya, didenda, dan sebagainya.', 'is_correct' => true],
                    ['text' => 'Kumpulan-kumpulan peraturan yang terdiri dari norma dan sanksi-sanksi itu disebut hukum dan tujuan hukum itu adalah mengadakan ketatatertiban dalam pergaulan manusia sehingga keamanan dan ketertiban terpelihara', 'is_correct' => false],
                    ['text' => 'Hukum ialah aturan tingkah laku anggota masyarakat, aturan yang daya penggunaannya pada saat tertentu diindahkan oleh suatu masyarakat sebagai jaminan dari kepentingan bersama dan yang jika dilanggar menimbulkan reaksi bersama terhadap orang yang melakukan pelanggaran itu.', 'is_correct' => false],
                ],
            ],
            // ================= Soal 18 =================
            [
                'question_text' => 'Keadilan distributif menurut Aristoteles adalah....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Menurut Aristoteles, <strong>keadilan distributif</strong> adalah keadilan yang memberikan perlakuan kepada seseorang <strong>sesuai dengan jasa-jasa yang telah diberikannya</strong> (proporsional terhadap prestasi). Sedangkan keadilan komutatif memberi perlakuan yang sama tanpa melihat jasa.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => 'Perlakuan terhadap seseorang sesuai dengan jasa-jasa yang telah diberikannya.', 'is_correct' => true],
                    ['text' => 'Kondisi jika seorang warga negara telah menaati segala peraturan perundang-undangan yang telah dikeluarkan.', 'is_correct' => false],
                    ['text' => 'Memberi sesuatu sesuai dengan yang diberikan oleh orang lain kepada kita.', 'is_correct' => false],
                    ['text' => 'Perlakuan terhadap seseorang dengan tidak melihat jasa-jasa yang telah diberikannya', 'is_correct' => false],
                    ['text' => 'Jika seseorang telah berusaha memulihkan nama baik orang lain yang telah tercemar. Misalnya, orang yang tidak bersalah maka nama baiknya harus direhabilitasi', 'is_correct' => false],
                ],
            ],
            // ================= Soal 19 =================
            [
                'question_text' => 'Posisi negara Indonesia yang berada di tengah-tengah dunia dilewati garis khatulistiwa, diapit oleh dua benua yaitu Asia dan Australia, serta berada di antara dua samudera yaitu Samudera Hindia dan Pasifik, jika ditinjau dari aspek penduduk berada di antara..',
                'explanation'   => '<p><strong>Pembahasan:</strong> Yang ditanyakan adalah aspek <strong>penduduk</strong> (kependudukan), bukan aspek ideologi, budaya, ekonomi, maupun politik. Ditinjau dari aspek penduduk, Indonesia berada di antara <strong>daerah berpenduduk padat di utara (Asia) dan daerah berpenduduk jarang di selatan (Australia)</strong>.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options'       => [
                    ['text' => 'Idiologi komunisme di utara dan liberalisme di selatan', 'is_correct' => false],
                    ['text' => 'Kebudayaan timur di utara dan kebudayaan barat di selatan', 'is_correct' => false],
                    ['text' => 'Sistem ekonomi sosialis di utara dan sistem ekonomi kapitalis di selatan', 'is_correct' => false],
                    ['text' => 'Daerah berpenduduk padat di utara dan daerah berpenduduk jarang di selatan', 'is_correct' => true],
                    ['text' => 'Demokrasi rakyat di utara (Asia daratan bagian utara) dan demokrasi liberal di selatan', 'is_correct' => false],
                ],
            ],
            // ================= Soal 20 =================
            [
                'question_text' => 'Usaha pertahanan dan keamanan negara dalam rangka mengatasi ancaman yang datang dari luar dilaksanakan melalui &hellip;',
                'explanation'   => '<p><strong>Pembahasan:</strong> Sesuai Pasal 30 ayat (2) UUD NRI Tahun 1945, usaha pertahanan dan keamanan negara dilaksanakan melalui <strong>sistem pertahanan dan keamanan rakyat semesta (Sishankamrata)</strong> oleh TNI dan Polri sebagai kekuatan utama, dan rakyat sebagai kekuatan pendukung.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => 'Sistem pertahanan sipil', 'is_correct' => false],
                    ['text' => 'Sistem keamanan oleh Polri', 'is_correct' => false],
                    ['text' => 'Sistem pertahanan negara oleh TNI', 'is_correct' => false],
                    ['text' => 'Mobilisasi segenap angkatan perang yang ada', 'is_correct' => false],
                    ['text' => 'Sistem pertahanan dan keamanan rakyat semesta', 'is_correct' => true],
                ],
            ],
            // ================= Soal 21 =================
            [
                'question_text' => 'Pemilihan senat untuk mewakili negara bagian di Amerika Serikat dilaksanakan setiap &hellip; tahun sekali.',
                'explanation'   => '<p><strong>Pembahasan:</strong> Anggota Senat Amerika Serikat menjabat selama <strong>6 tahun</strong>. Setiap negara bagian diwakili oleh 2 orang senator, dan pemilihan untuk masing-masing kursi senat dilaksanakan setiap 6 tahun sekali (dengan sepertiga kursi diperbarui setiap 2 tahun).</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options'       => [
                    ['text' => '2', 'is_correct' => false],
                    ['text' => '3', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => false],
                    ['text' => '6', 'is_correct' => true],
                ],
            ],
            // ================= Soal 22 =================
            [
                'question_text' => 'Ketika pengadilan dalam tuntutan perdata yang hal ini tergugat tidak mengindahkan atau memenuhi panggilan pengadilan dengan alasan yang tidak jelas ataupun telah tidak memenuhi panggilan pengadilan sebanyak 3 kali dengan alasan tidak jelas, maka pengadilan dapat berjalan sesuai keputusan hakim, putusan hakim ini disebut?',
                'explanation'   => '<p><strong>Pembahasan:</strong> <strong>Verstek</strong> adalah putusan pengadilan yang dijatuhkan tanpa hadirnya pihak tergugat, meskipun tergugat telah dipanggil secara sah dan patut namun tidak hadir tanpa alasan yang dapat dibenarkan.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Versitkser', 'is_correct' => false],
                    ['text' => 'Xersiv', 'is_correct' => false],
                    ['text' => 'Verstek', 'is_correct' => true],
                    ['text' => 'Vyndhom', 'is_correct' => false],
                    ['text' => 'Versinxche', 'is_correct' => false],
                ],
            ],
            // ================= Soal 23 =================
            [
                'question_text' => 'Presiden Jokowi menerbitkan Peraturan Pemerintah Pengganti Undang-Undang (Perppu) Nomor 2 Tahun 2017 tentang Perubahan Atas Undang-Undang Nomor ...... tentang Organisasi Kemasyarakatan, UU berapakah yang di maksud?',
                'explanation'   => '<p><strong>Pembahasan:</strong> Perppu Nomor 2 Tahun 2017 merupakan perubahan atas <strong>Undang-Undang Nomor 17 Tahun 2013</strong> tentang Organisasi Kemasyarakatan.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '17 tahun 2013', 'is_correct' => true],
                    ['text' => '18 tahun 2013', 'is_correct' => false],
                    ['text' => '16 tahun 2013', 'is_correct' => false],
                    ['text' => '17 tahun 2012', 'is_correct' => false],
                    ['text' => '18 tahun 2012', 'is_correct' => false],
                ],
            ],
            // ================= Soal 24 =================
            [
                'question_text' => 'Dalam pelaksanaan fungsinya mengenai administrasi pemerintahan adalah tugas pemerintah dan negara untuk menciptakan kesejahteraan bagi rakyat Indonesia sebagaimana diamanatkan oleh UUD 1945 diperlukan penerapan asas-asas umum pemerintahan yang baik sebagai pedoman dalam penyelenggaraan pemerintahan di Indonesia. Yang bukan merupakan asas-asas yang dimaksud adalah....',
                'explanation'   => '<p><strong>Pembahasan:</strong> Asas-asas umum pemerintahan yang baik (AUPB) menurut Pasal 10 UU Nomor 30 Tahun 2014 tentang Administrasi Pemerintahan meliputi: kepastian hukum, kemanfaatan, ketidakberpihakan, kecermatan, tidak menyalahgunakan kewenangan, keterbukaan, kepentingan umum, dan pelayanan yang baik.<br>Dengan demikian, <strong>keadilan</strong> bukan termasuk asas yang dimaksud.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => 'Kepastian Hukum', 'is_correct' => false],
                    ['text' => 'Keadilan', 'is_correct' => true],
                    ['text' => 'Kecermatan', 'is_correct' => false],
                    ['text' => 'Kemanfaatan', 'is_correct' => false],
                    ['text' => 'Keterbukaan', 'is_correct' => false],
                ],
            ],
            // ================= Soal 25 =================
            [
                'question_text' => 'Secara politik, awal kekuasaan pemerintahan Belanda di Indonesia dimulai dari tanggal....',
                'explanation'   => '<p><strong>Pembahasan:</strong> VOC dibubarkan pada 31 Desember 1799, dan seluruh wilayah beserta utang-piutangnya diambil alih oleh Pemerintah Kerajaan Belanda terhitung mulai <strong>1 Januari 1800</strong>. Sejak tanggal itulah secara politik kekuasaan pemerintahan Belanda di Indonesia dimulai.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => '22 April 1529', 'is_correct' => false],
                    ['text' => '31 Desember 1799', 'is_correct' => false],
                    ['text' => '1 Januari 1800', 'is_correct' => true],
                    ['text' => '15 Januari 1808', 'is_correct' => false],
                    ['text' => '18 September 1811', 'is_correct' => false],
                ],
            ],
            // ================= Soal 26 =================
            [
                'question_text' => 'Sifat Pemilu berdasarkan pasal 22E ayat 5 Undang Undang Dasar Negara Republik Indonesia Tahun 1945 ialah..',
                'explanation'   => '<p><strong>Pembahasan:</strong> Pasal 22E ayat (5) UUD NRI Tahun 1945 menyebutkan bahwa pemilihan umum diselenggarakan oleh suatu komisi pemilihan umum yang bersifat <strong>nasional, tetap, dan mandiri</strong>.<br>Perlu dibedakan dengan Pasal 22E ayat (1) yang mengatur asas pemilu, yaitu langsung, umum, bebas, rahasia, jujur, dan adil (luber jurdil).</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'jujur, adil, dan mandiri', 'is_correct' => false],
                    ['text' => 'nyata, mandiri, dan adil', 'is_correct' => false],
                    ['text' => 'nasional, tetap, dan mandiri', 'is_correct' => true],
                    ['text' => 'langsung, umum, dan tetap', 'is_correct' => false],
                    ['text' => 'nasional, mandiri, dan langsung', 'is_correct' => false],
                ],
            ],
            // ================= Soal 27 =================
            [
                'question_text' => 'Dalam ketatanegaraan Republik Indonesia, pembentukan sebuah provinsi dapat dilakukan dengan memiliki paling sedikitnya&hellip;',
                'explanation'   => '<p><strong>Pembahasan:</strong> Syarat pembentukan daerah menurut UU Nomor 32 Tahun 2004 tentang Pemerintahan Daerah Pasal 5 ayat (5) menyebutkan bahwa syarat fisik meliputi paling sedikit:<br><li><strong>5 (lima) kabupaten/kota untuk pembentukan provinsi</strong></li><li>5 (lima) kecamatan untuk pembentukan kabupaten</li><li>4 (empat) kecamatan untuk pembentukan kota</li>serta lokasi calon ibu kota, sarana, dan prasarana pemerintahan.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => '5 (lima) kabupaten/kota', 'is_correct' => true],
                    ['text' => '7 (tujuh) kabupaten/kota', 'is_correct' => false],
                    ['text' => '10 (sepuluh) kabupaten/kota', 'is_correct' => false],
                    ['text' => '1/2 kabupaten/kota dari jumlah provinsi di seluruh Indonesia', 'is_correct' => false],
                    ['text' => '2/3 kabupaten/kota dari jumlah provinsi di seluruh Indonesia', 'is_correct' => false],
                ],
            ],
            // ================= Soal 28 =================
            [
                'question_text' => 'Makna Pancasila sebagai ideologi terbuka adalah ideologi yang&hellip;.',
                'explanation'   => '<p><strong>Pembahasan:</strong> Ideologi terbuka berarti ideologi tersebut bersifat dinamis dan <strong>dapat berinteraksi dengan perkembangan zaman</strong>. Nilai dasarnya tetap, namun nilai instrumental dan praksisnya dapat menyesuaikan dengan tuntutan perkembangan masyarakat tanpa mengubah nilai dasar tersebut.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options'       => [
                    ['text' => 'Tidak dapat berinteraksi dengan perkembangan zaman', 'is_correct' => false],
                    ['text' => 'Dapat berinteraksi dengan perkembangan zaman', 'is_correct' => true],
                    ['text' => 'Mengandung semangat kekeluargaan', 'is_correct' => false],
                    ['text' => 'Mengandung adanya semangat kerjasama', 'is_correct' => false],
                    ['text' => 'Menjunjung tinggi persatuan dan kesatuan', 'is_correct' => false],
                ],
            ],
            // ================= Soal 29 =================
            [
                'question_text' => 'Pancasila dilaksanakan secara objektif, artinya&hellip;',
                'explanation'   => '<p><strong>Pembahasan:</strong> Pengamalan Pancasila secara objektif adalah dengan melaksanakan dan menaati peraturan perundang-undangan sebagai norma hukum negara yang berlandaskan Pancasila. Adanya pengamalan objektif ini merupakan konsekuensi dari mewujudkan nilai dasar Pancasila sebagai norma hukum negara. Contoh nyatanya adalah ketaatan warga negara pada peraturan perundang-undangan yang berlaku, seperti taat pada rambu-rambu lalu lintas, sehingga Pancasila <strong>digunakan sebagai pedoman perilaku sehari-hari</strong>.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options'       => [
                    ['text' => 'Pancasila digunakan sebagai pedoman perilaku sehari-hari', 'is_correct' => true],
                    ['text' => 'Pancasila digunakan sebagai asas tunggal partai politik', 'is_correct' => false],
                    ['text' => 'Pancasila digunakan sebagai sumber hukum negara', 'is_correct' => false],
                    ['text' => 'Pancasila digunakan sebagai dasar hukum penyelenggaraan bangsa', 'is_correct' => false],
                    ['text' => 'Pancasila digunakan sebagai filter masuknya budaya global', 'is_correct' => false],
                ],
            ],
            // ================= Soal 30 =================
            [
                'question_text' => 'Allan Pope merupakan salah satu warga negara asing yang terlibat dalam pemberontakan Permesta yang mengindikasikan keterlibatan negara..',
                'explanation'   => '<p><strong>Pembahasan:</strong> Allan Lawrence Pope adalah pilot berkewarganegaraan <strong>Amerika Serikat</strong> yang pesawatnya ditembak jatuh di Ambon pada 18 Mei 1958. Tertangkapnya Allan Pope menjadi bukti keterlibatan Amerika Serikat (melalui CIA) dalam pemberontakan PRRI/Permesta.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options'       => [
                    ['text' => 'Rusia', 'is_correct' => false],
                    ['text' => 'Belanda', 'is_correct' => false],
                    ['text' => 'Amerika Serikat', 'is_correct' => true],
                    ['text' => 'Malaysia', 'is_correct' => false],
                    ['text' => 'Inggris', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id'   => $materialId,
                'type'          => 'mcq',
                'test_type'     => 'twk',
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

        $this->command->info('Seeder TWK TO AGUSTUS berhasil dijalankan!');
        $this->command->info('Material ID : ' . $materialId);
        $this->command->info('Total soal  : ' . count($questions));
    }
}
