<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TKPPaketSKDSeeder extends Seeder
{
    /**
     * Seeder TKP Paket SKD - soal nomor 66-110.
     *
     * - material_id : 13
     * - type        : mcq
     * - test_type   : tkp
     * - TKP tidak memakai benar/salah: is_correct selalu false,
     *   penilaian memakai kolom weight (bobot 1-5).
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 13;

        $questions = [
            // Soal 66 - PELAYANAN PUBLIK ; 12435
            [
                'no' => 66,
                'question_text' => '<p>Anda bertugas di loket pelayanan administrasi kependudukan. Menjelang jam layanan berakhir, masih ada beberapa warga yang mengantre, padahal Anda sudah sangat lelah. Sikap Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Menutup loket tepat waktu dan meminta warga datang kembali esok hari.', 'weight' => 1],
                    ['text' => 'Melayani warga dengan cepat tanpa banyak menjelaskan agar segera selesai.', 'weight' => 2],
                    ['text' => 'Meminta rekan kerja menggantikan karena Anda sudah lelah.', 'weight' => 4],
                    ['text' => 'Melayani warga yang berkasnya sudah lengkap saja, sisanya diminta kembali besok.', 'weight' => 3],
                    ['text' => 'Tetap melayani seluruh warga yang sudah mengantre hingga selesai dengan ramah.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 12435</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mengabaikan warga yang sudah menunggu; tidak berorientasi pada pelayanan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Melayani, tetapi kualitas pelayanan dikorbankan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>4</strong></td><td>Pelayanan tetap berjalan, tetapi Anda melepaskan tanggung jawab pribadi.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Ada usaha melayani, namun belum tuntas.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Mengutamakan kepentingan masyarakat dan tetap memberi layanan berkualitas.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 67 - PELAYANAN PUBLIK ; 23154
            [
                'no' => 67,
                'question_text' => '<p>Seorang warga lanjut usia datang ke kantor Anda untuk mengurus dokumen, tetapi ia kesulitan memahami prosedur pengisian formulir. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Meminta keluarganya datang untuk membantu mengisi formulir.', 'weight' => 2],
                    ['text' => 'Memberikan contoh formulir yang sudah terisi agar ia menirunya.', 'weight' => 3],
                    ['text' => 'Menyarankan ia menggunakan jasa pengisian formulir di luar kantor.', 'weight' => 1],
                    ['text' => 'Mendampingi dan menjelaskan langkah pengisian secara perlahan hingga formulir selesai diisi dengan benar.', 'weight' => 5],
                    ['text' => 'Menjelaskan prosedur secara singkat lalu mempersilakannya mengisi sendiri.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23154</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Melimpahkan bantuan kepada pihak lain.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Membantu, tetapi belum memastikan warga benar-benar paham.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak memberikan pelayanan dan berpotensi membebani warga.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Pelayanan inklusif, sabar, dan tuntas sesuai kebutuhan warga rentan.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Sudah menjelaskan, tetapi pendampingan belum maksimal.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 68 - PELAYANAN PUBLIK ; 13254
            [
                'no' => 68,
                'question_text' => '<p>Seorang pengguna layanan menyampaikan keluhan dengan nada tinggi karena berkasnya belum selesai diproses, padahal keterlambatan terjadi akibat gangguan sistem pusat. Apa tindakan Anda?</p>',
                'options' => [
                    ['text' => 'Meminta warga tersebut menurunkan nada bicaranya terlebih dahulu.', 'weight' => 1],
                    ['text' => 'Mencatat keluhannya dan berjanji akan menghubunginya nanti.', 'weight' => 3],
                    ['text' => 'Menjelaskan bahwa keterlambatan bukan kesalahan Anda melainkan kesalahan sistem pusat.', 'weight' => 2],
                    ['text' => 'Mendengarkan keluhannya dengan tenang, meminta maaf atas ketidaknyamanan, menjelaskan kendala, dan memberikan perkiraan waktu penyelesaian.', 'weight' => 5],
                    ['text' => 'Meminta maaf dan menyarankannya menunggu hingga sistem kembali normal.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 13254</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak fokus menyelesaikan masalah pelanggan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Ada tindak lanjut, tetapi tanpa penjelasan dan kepastian.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Defensif dan cenderung menyalahkan pihak lain.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Empatik, informatif, dan memberikan kepastian layanan.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Sopan, tetapi belum memberikan kepastian yang jelas.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 69 - PELAYANAN PUBLIK ; 14253
            [
                'no' => 69,
                'question_text' => '<p>Instansi Anda baru menerapkan prosedur pelayanan yang lebih ringkas. Namun, masih banyak masyarakat yang belum mengetahuinya sehingga sering terjadi kesalahan persyaratan. Langkah Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Menolak berkas yang tidak sesuai dengan prosedur baru.', 'weight' => 1],
                    ['text' => 'Menjelaskan prosedur baru kepada setiap warga yang datang ke loket.', 'weight' => 4],
                    ['text' => 'Menunggu masyarakat terbiasa dengan sendirinya.', 'weight' => 2],
                    ['text' => 'Mengusulkan sosialisasi melalui berbagai media, seperti media sosial, papan informasi, dan penjelasan langsung di loket, kepada pimpinan.', 'weight' => 5],
                    ['text' => 'Menempelkan pengumuman tentang prosedur baru di papan informasi kantor.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 14253</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Kaku dan merugikan masyarakat.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Membantu, namun hanya menjangkau warga yang sudah datang.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Pasif terhadap permasalahan layanan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Proaktif, inovatif, dan menjangkau masyarakat luas.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Informatif, tetapi jangkauannya terbatas.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 70 - PELAYANAN PUBLIK ; 54123
            [
                'no' => 70,
                'question_text' => '<p>Saat melayani, Anda menyadari bahwa seorang pemohon adalah tetangga Anda sendiri. Ia meminta agar berkasnya didahulukan dari antrean. Sikap Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Menolak dengan sopan dan menjelaskan bahwa semua pemohon dilayani sesuai nomor antrean.', 'weight' => 5],
                    ['text' => 'Menyarankannya mengambil nomor antrean seperti pemohon lain.', 'weight' => 4],
                    ['text' => 'Mendahulukan berkasnya karena hubungan baik bertetangga perlu dijaga.', 'weight' => 1],
                    ['text' => 'Mendahulukannya jika antrean sedang tidak terlalu panjang.', 'weight' => 2],
                    ['text' => 'Meminta ia mengurus berkas pada hari lain agar tidak dilihat orang.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 54123</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Adil, tegas, dan tetap menjaga hubungan baik.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Adil, tetapi kurang disertai penjelasan yang baik.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Diskriminatif dan melanggar prinsip keadilan pelayanan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tetap memberi perlakuan khusus.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menghindari konflik, tetapi tidak memberikan pelayanan semestinya.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 71 - PELAYANAN PUBLIK ; 23145
            [
                'no' => 71,
                'question_text' => '<p>Sebuah layanan di kantor Anda sering dikeluhkan karena waktu tunggu yang lama. Sebagai petugas, Anda diminta memberikan masukan. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyampaikan bahwa jumlah petugas memang kurang sehingga keluhan wajar terjadi.', 'weight' => 2],
                    ['text' => 'Mengusulkan penambahan jam kerja petugas.', 'weight' => 3],
                    ['text' => 'Menyarankan agar pengguna layanan datang lebih pagi.', 'weight' => 1],
                    ['text' => 'Mengusulkan penerapan nomor antrean daring berdasarkan pengalaman instansi lain.', 'weight' => 4],
                    ['text' => 'Menganalisis alur layanan, mengidentifikasi tahapan yang memakan waktu lama, lalu mengusulkan perbaikan yang konkret.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23145</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Hanya menyampaikan masalah tanpa solusi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Ada usulan, tetapi belum menyentuh akar masalah.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Membebankan masalah kepada masyarakat.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Solutif, tetapi belum berdasarkan analisis kondisi sendiri.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Berbasis data dan berorientasi pada perbaikan berkelanjutan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 72 - PELAYANAN PUBLIK ; 23415
            [
                'no' => 72,
                'question_text' => '<p>Seorang warga meminta informasi layanan melalui pesan WhatsApp resmi kantor di luar jam kerja. Anda yang kebetulan memegang akun tersebut membaca pesan itu pada malam hari. Tindakan Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Mengirimkan pesan otomatis bahwa layanan hanya pada jam kerja.', 'weight' => 2],
                    ['text' => 'Membalasnya keesokan harinya pada jam kerja.', 'weight' => 3],
                    ['text' => 'Membalas pesan dan menanyakan detail kebutuhan agar dapat segera diproses besok.', 'weight' => 4],
                    ['text' => 'Mengabaikan pesan tersebut karena sudah di luar jam kerja.', 'weight' => 1],
                    ['text' => 'Membalas dengan informasi singkat yang dibutuhkan dan menyampaikan bahwa penjelasan lengkap dapat diperoleh pada jam layanan.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23415</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Informatif, tetapi tidak menjawab kebutuhan warga.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Sesuai aturan, tetapi warga menunggu tanpa kepastian.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>4</strong></td><td>Responsif dan mempersiapkan tindak lanjut.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak responsif terhadap kebutuhan masyarakat.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Responsif dan tetap menjaga batas layanan secara profesional.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 73 - PELAYANAN PUBLIK ; 35214
            [
                'no' => 73,
                'question_text' => '<p>Anda menemukan bahwa rekan kerja Anda sering meminta "uang pelicin" kepada masyarakat agar berkas cepat selesai. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menasihati masyarakat agar tidak memberi uang kepada petugas.', 'weight' => 3],
                    ['text' => 'Menegur rekan tersebut secara pribadi dan melaporkannya kepada atasan atau melalui saluran pengaduan resmi jika perilakunya tetap berlanjut.', 'weight' => 5],
                    ['text' => 'Menjauhi rekan tersebut agar tidak ikut terlibat.', 'weight' => 2],
                    ['text' => 'Membiarkannya karena itu urusan pribadi rekan tersebut.', 'weight' => 1],
                    ['text' => 'Langsung melaporkannya kepada atasan.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Pelayanan Publik</p>
            <p><strong>Kunci Bobot (A–E):</strong> 35214</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>3</strong></td><td>Membantu mencegah, tetapi tidak menyelesaikan sumber masalah.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Berintegritas, berani bertindak, dan menempuh mekanisme yang tepat.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Menyelamatkan diri sendiri tanpa memperbaiki keadaan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Permisif terhadap pungutan liar.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat, tetapi belum memberi kesempatan rekan untuk memperbaiki diri.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 74 - JEJARING KERJA ; 31524
            [
                'no' => 74,
                'question_text' => '<p>Anda ditunjuk menjadi ketua tim dalam proyek lintas unit. Salah satu anggota tim dari unit lain sering tidak hadir dalam rapat koordinasi. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyampaikan hal tersebut langsung kepada pimpinan unitnya.', 'weight' => 3],
                    ['text' => 'Membiarkannya karena ia bukan bawahan langsung Anda.', 'weight' => 1],
                    ['text' => 'Mengajaknya berdiskusi untuk mengetahui kendalanya dan bersama-sama mencari pola koordinasi yang sesuai.', 'weight' => 5],
                    ['text' => 'Mengganti anggota tersebut dengan orang lain.', 'weight' => 2],
                    ['text' => 'Mengirimkan notulen rapat agar ia tetap mengetahui perkembangan.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 31524</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menyelesaikan melalui jalur formal tanpa komunikasi langsung terlebih dahulu.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak bertanggung jawab sebagai ketua tim.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Membangun komunikasi dan mencari solusi bersama.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>2</strong></td><td>Solusi cepat yang dapat merusak hubungan antarunit.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Menjaga keterlibatannya, tetapi belum menyelesaikan masalah.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 75 - JEJARING KERJA ; 23514
            [
                'no' => 75,
                'question_text' => '<p>Unit Anda membutuhkan data dari unit lain untuk menyelesaikan laporan, tetapi unit tersebut terkenal lambat merespons permintaan. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengirim permintaan resmi dan menunggu balasan.', 'weight' => 2],
                    ['text' => 'Meminta atasan Anda menegur unit tersebut.', 'weight' => 3],
                    ['text' => 'Menghubungi langsung penanggung jawab data, menjelaskan kebutuhan dan tenggat waktu, lalu menawarkan bantuan agar prosesnya lebih mudah.', 'weight' => 5],
                    ['text' => 'Menyusun laporan dengan data perkiraan sendiri.', 'weight' => 1],
                    ['text' => 'Mengirim permintaan resmi lalu menindaklanjutinya secara berkala melalui telepon.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23514</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Sesuai prosedur, tetapi pasif.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Mengandalkan tekanan hierarki.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Membangun kerja sama yang saling memudahkan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Berisiko menghasilkan laporan yang tidak akurat.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Proaktif, tetapi belum membangun kerja sama yang erat.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 76 - JEJARING KERJA ; 53412
            [
                'no' => 76,
                'question_text' => '<p>Dalam rapat tim, pendapat Anda ditolak oleh mayoritas anggota. Padahal, Anda yakin usulan Anda lebih efektif. Sikap Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Menerima keputusan tim dan tetap bekerja sungguh-sungguh, sambil menyimpan data pendukung untuk evaluasi selanjutnya.', 'weight' => 5],
                    ['text' => 'Meminta rapat diulang agar usulan Anda dipertimbangkan kembali.', 'weight' => 3],
                    ['text' => 'Menerima keputusan tim dengan lapang dada.', 'weight' => 4],
                    ['text' => 'Tetap menjalankan cara Anda sendiri karena yakin lebih baik.', 'weight' => 1],
                    ['text' => 'Mengikuti keputusan tim, tetapi bekerja seadanya.', 'weight' => 2],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 53412</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Menghormati keputusan bersama dan tetap konstruktif.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Gigih, tetapi kurang menghargai proses yang sudah berjalan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>4</strong></td><td>Positif, tetapi belum memberi nilai tambah.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mengabaikan keputusan tim.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak berkomitmen pada keputusan bersama.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 77 - JEJARING KERJA ; 53241
            [
                'no' => 77,
                'question_text' => '<p>Anda adalah pegawai baru di sebuah kantor. Rekan-rekan kerja Anda sudah memiliki kelompok pertemanan masing-masing. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Aktif berkenalan, terlibat dalam kegiatan bersama, dan menjalin hubungan baik dengan rekan dari berbagai kelompok.', 'weight' => 5],
                    ['text' => 'Bergabung dengan satu kelompok yang paling sesuai dengan Anda.', 'weight' => 3],
                    ['text' => 'Fokus bekerja saja karena pertemanan tidak penting dalam pekerjaan.', 'weight' => 2],
                    ['text' => 'Berkenalan dengan rekan satu ruangan terlebih dahulu.', 'weight' => 4],
                    ['text' => 'Menunggu rekan-rekan yang mengajak Anda bergabung.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 53241</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Inklusif dan membangun jejaring kerja yang luas.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Membangun relasi, tetapi terbatas.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kurang membangun jejaring.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Langkah awal yang baik, tetapi belum menyeluruh.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Pasif dalam membangun hubungan kerja.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 78 - JEJARING KERJA ; 25134
            [
                'no' => 78,
                'question_text' => '<p>Dua anggota tim Anda berselisih paham sehingga kerja tim terganggu. Sebagai koordinator, apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Meminta keduanya menyelesaikan masalah sendiri.', 'weight' => 2],
                    ['text' => 'Mempertemukan keduanya, mendengarkan pandangan masing-masing, lalu memfasilitasi kesepakatan cara kerja yang dapat diterima bersama.', 'weight' => 5],
                    ['text' => 'Melaporkan perselisihan tersebut kepada atasan.', 'weight' => 1],
                    ['text' => 'Memisahkan tugas keduanya agar tidak perlu bekerja sama.', 'weight' => 3],
                    ['text' => 'Berbicara dengan masing-masing secara terpisah untuk meredakan suasana.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 25134</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak menjalankan peran koordinator.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Menyelesaikan konflik secara terbuka dan adil.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Melimpahkan masalah yang seharusnya dapat diselesaikan sendiri.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Meredam konflik, tetapi tidak menyelesaikannya.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Membantu, tetapi belum mempertemukan solusi bersama.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 79 - JEJARING KERJA ; 21534
            [
                'no' => 79,
                'question_text' => '<p>Instansi Anda diminta bekerja sama dengan pemerintah desa dalam pelaksanaan program pendataan. Beberapa aparat desa tampak kurang antusias. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengirim surat resmi agar aparat desa wajib membantu.', 'weight' => 2],
                    ['text' => 'Menjalankan program dengan tim sendiri tanpa melibatkan aparat desa.', 'weight' => 1],
                    ['text' => 'Menjelaskan manfaat program bagi desa dan melibatkan aparat desa dalam perencanaan kegiatan di lapangan.', 'weight' => 5],
                    ['text' => 'Meminta camat untuk mengarahkan aparat desa.', 'weight' => 3],
                    ['text' => 'Mengadakan pertemuan perkenalan dengan aparat desa sebelum kegiatan dimulai.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 21534</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kerja sama berdasarkan paksaan formal.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mengabaikan kemitraan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Membangun rasa memiliki dan kemitraan yang setara.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menggunakan jalur struktural, belum membangun hubungan langsung.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Membangun hubungan, tetapi belum melibatkan mereka secara aktif.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 80 - JEJARING KERJA ; 25341
            [
                'no' => 80,
                'question_text' => '<p>Rekan satu tim Anda meminta bantuan menyelesaikan pekerjaannya, padahal pekerjaan Anda sendiri juga sedang menumpuk. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menolak karena pekerjaan Anda sendiri lebih penting.', 'weight' => 2],
                    ['text' => 'Mengatur prioritas pekerjaan, lalu membantu pada bagian yang paling mendesak sesuai kemampuan Anda.', 'weight' => 5],
                    ['text' => 'Membantu sepenuhnya walaupun pekerjaan Anda menjadi terlambat.', 'weight' => 3],
                    ['text' => 'Menjanjikan bantuan setelah pekerjaan Anda selesai.', 'weight' => 4],
                    ['text' => 'Menyarankan rekan meminta bantuan kepada orang lain.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 25341</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kurang peduli terhadap kinerja tim.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Seimbang antara tanggung jawab pribadi dan kepentingan tim.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Peduli, tetapi mengorbankan tanggung jawab sendiri.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Bertanggung jawab, tetapi bantuan mungkin terlambat.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Menghindar dari kerja sama.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 81 - JEJARING KERJA ; 12435
            [
                'no' => 81,
                'question_text' => '<p>Anda mendapat informasi penting dari mitra kerja di luar instansi yang dapat membantu pekerjaan unit lain di kantor Anda. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyimpan informasi itu karena bukan urusan unit Anda.', 'weight' => 1],
                    ['text' => 'Menyampaikan informasi tersebut jika unit lain menanyakannya.', 'weight' => 2],
                    ['text' => 'Meneruskan informasi tersebut kepada unit terkait.', 'weight' => 4],
                    ['text' => 'Menyampaikan informasi tersebut kepada atasan Anda.', 'weight' => 3],
                    ['text' => 'Meneruskan informasi tersebut kepada unit terkait dan menawarkan untuk menghubungkan mereka dengan mitra tersebut.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Jejaring Kerja</p>
            <p><strong>Kunci Bobot (A–E):</strong> 12435</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak membangun sinergi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Pasif dalam berbagi informasi.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>4</strong></td><td>Berbagi informasi, tetapi belum memfasilitasi kerja sama.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Informasi sampai, tetapi lebih lambat.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Membangun jejaring dan sinergi antarunit.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 82 - SOSIAL BUDAYA ; 24135
            [
                'no' => 82,
                'question_text' => '<p>Anda ditugaskan di daerah yang memiliki adat istiadat sangat berbeda dengan daerah asal Anda. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Bergaul hanya dengan sesama perantau dari daerah asal.', 'weight' => 2],
                    ['text' => 'Bertanya kepada warga setempat tentang adat yang perlu dihormati.', 'weight' => 4],
                    ['text' => 'Tetap menjalankan kebiasaan dari daerah asal Anda.', 'weight' => 1],
                    ['text' => 'Menyesuaikan diri seperlunya saja.', 'weight' => 3],
                    ['text' => 'Mempelajari adat setempat, menghormatinya, dan aktif terlibat dalam kegiatan masyarakat sesuai batas kemampuan Anda.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 24135</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Cenderung eksklusif.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Menghargai budaya, tetapi belum terlibat aktif.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak menghormati budaya setempat.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Beradaptasi secara minimal.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Adaptif dan menghargai keberagaman.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 83 - SOSIAL BUDAYA ; 54213
            [
                'no' => 83,
                'question_text' => '<p>Dalam grup percakapan kantor, seorang rekan membagikan lelucon yang merendahkan suku tertentu. Beberapa anggota grup menanggapinya dengan tertawa. Sikap Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Mengingatkan dengan sopan bahwa lelucon tersebut dapat menyinggung dan tidak pantas dibagikan.', 'weight' => 5],
                    ['text' => 'Mengirim pesan pribadi kepada rekan tersebut agar menghapus leluconnya.', 'weight' => 4],
                    ['text' => 'Diam saja dan tidak menanggapi.', 'weight' => 2],
                    ['text' => 'Ikut tertawa agar suasana tetap akrab.', 'weight' => 1],
                    ['text' => 'Keluar dari grup percakapan tersebut.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 54213</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Berani menjaga sikap saling menghormati.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat, tetapi kurang memberi contoh kepada anggota lain.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak ikut, tetapi membiarkan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mendukung sikap diskriminatif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menghindar tanpa memperbaiki keadaan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 84 - SOSIAL BUDAYA ; 41352
            [
                'no' => 84,
                'question_text' => '<p>Rekan kerja Anda yang berbeda agama sedang merayakan hari raya keagamaannya. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengucapkan selamat kepadanya.', 'weight' => 4],
                    ['text' => 'Menghindari pembicaraan tentang hari raya tersebut.', 'weight' => 1],
                    ['text' => 'Menghormati perayaan tersebut tanpa ikut campur.', 'weight' => 3],
                    ['text' => 'Mengucapkan selamat sesuai keyakinan Anda dan membantu menggantikan tugasnya bila diperlukan agar ia dapat beribadah dengan tenang.', 'weight' => 5],
                    ['text' => 'Bersikap biasa saja karena bukan hari raya Anda.', 'weight' => 2],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 41352</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Menghargai, tetapi belum memberi bantuan nyata.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>1</strong></td><td>Menjaga jarak dari perbedaan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Toleran, tetapi pasif.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Toleran dan memberi dukungan nyata.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kurang peduli.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 85 - SOSIAL BUDAYA ; 25134
            [
                'no' => 85,
                'question_text' => '<p>Di lingkungan tempat tinggal Anda, warga pendatang dan warga asli jarang berinteraksi. Sebagai warga, apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Bergaul dengan warga asli saja agar diterima.', 'weight' => 2],
                    ['text' => 'Mengusulkan kegiatan bersama, seperti kerja bakti atau lomba antarwarga, yang melibatkan pendatang dan warga asli.', 'weight' => 5],
                    ['text' => 'Membiarkan karena setiap orang berhak memilih pergaulannya.', 'weight' => 1],
                    ['text' => 'Mengikuti kegiatan yang diadakan oleh pengurus RT.', 'weight' => 3],
                    ['text' => 'Menyapa dan bersikap ramah kepada semua warga.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 25134</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Memilih kelompok.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Proaktif membangun kerukunan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak peduli terhadap kohesi sosial.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Berpartisipasi, tetapi pasif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Baik, tetapi belum menjembatani kelompok.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 86 - SOSIAL BUDAYA ; 12345
            [
                'no' => 86,
                'question_text' => '<p>Seorang rekan kerja Anda memiliki keterbatasan fisik sehingga sering kesulitan menjangkau ruang arsip di lantai dua. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyarankannya meminta pindah tugas ke bagian lain.', 'weight' => 1],
                    ['text' => 'Menunggu ia meminta bantuan.', 'weight' => 2],
                    ['text' => 'Membantu jika sedang tidak sibuk.', 'weight' => 3],
                    ['text' => 'Membantu mengambilkan dokumen setiap kali ia memerlukan.', 'weight' => 4],
                    ['text' => 'Menawarkan bantuan ketika ia membutuhkan dokumen dari ruang arsip dan mengusulkan kepada pimpinan agar akses ruangan dibuat lebih ramah disabilitas.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 12345</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Diskriminatif.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kurang peka.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Membantu, tetapi bersyarat.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Peduli, tetapi belum mencari solusi jangka panjang.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Peduli dan mendorong perubahan yang inklusif.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 87 - SOSIAL BUDAYA ; 42531
            [
                'no' => 87,
                'question_text' => '<p>Anda diundang menghadiri acara adat tetangga yang berbeda suku. Kebetulan Anda sedang memiliki banyak pekerjaan. Sikap Anda adalah ....</p>',
                'options' => [
                    ['text' => 'Menyampaikan permohonan maaf karena tidak dapat hadir.', 'weight' => 4],
                    ['text' => 'Tidak datang karena sibuk.', 'weight' => 2],
                    ['text' => 'Datang sebentar untuk menghormati undangan, lalu melanjutkan pekerjaan.', 'weight' => 5],
                    ['text' => 'Menitipkan bingkisan tanpa datang.', 'weight' => 3],
                    ['text' => 'Tidak datang dan tidak memberi kabar.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 42531</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Sopan, tetapi tidak hadir.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kurang menjaga hubungan sosial.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Menyeimbangkan hubungan sosial dan tanggung jawab.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menghargai, tetapi kurang hadir secara sosial.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak menghormati undangan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 88 - SOSIAL BUDAYA ; 23514
            [
                'no' => 88,
                'question_text' => '<p>Dalam rapat warga, seorang tokoh masyarakat mengusulkan larangan bagi kelompok etnis tertentu untuk menyewa rumah di lingkungan Anda. Apa sikap Anda?</p>',
                'options' => [
                    ['text' => 'Abstain karena tidak ingin berselisih dengan tokoh masyarakat.', 'weight' => 2],
                    ['text' => 'Membicarakan keberatan Anda dengan warga lain setelah rapat.', 'weight' => 3],
                    ['text' => 'Menyampaikan keberatan secara santun dan mengusulkan aturan yang berlaku sama bagi semua penyewa, seperti wajib lapor kepada RT.', 'weight' => 5],
                    ['text' => 'Menyetujui usulan tersebut demi menjaga keamanan lingkungan.', 'weight' => 1],
                    ['text' => 'Menolak usulan tersebut dalam rapat.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23514</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Membiarkan diskriminasi terjadi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Tidak disampaikan dalam forum yang tepat.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Menolak diskriminasi sambil menawarkan solusi yang adil.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mendukung diskriminasi.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat, tetapi belum menawarkan solusi.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 89 - SOSIAL BUDAYA ; 41235
            [
                'no' => 89,
                'question_text' => '<p>Anak-anak di lingkungan rumah Anda lebih menyukai budaya populer asing dan kurang mengenal kesenian daerah. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengajak anak-anak menonton pertunjukan kesenian daerah.', 'weight' => 4],
                    ['text' => 'Melarang anak-anak menonton tayangan budaya asing.', 'weight' => 1],
                    ['text' => 'Membiarkannya karena itu adalah perkembangan zaman.', 'weight' => 2],
                    ['text' => 'Menceritakan kepada anak-anak tentang kesenian daerah.', 'weight' => 3],
                    ['text' => 'Bersama warga lain mengadakan latihan kesenian daerah yang dikemas menarik, misalnya dipadukan dengan musik modern.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Sosial Budaya</p>
            <p><strong>Kunci Bobot (A–E):</strong> 41235</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Memperkenalkan budaya, tetapi belum berkelanjutan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>1</strong></td><td>Represif dan tidak efektif.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak peduli terhadap pelestarian budaya.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Edukatif, tetapi kurang menarik bagi anak-anak.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Melestarikan budaya secara kreatif dan kolaboratif.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 90 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 34521
            [
                'no' => 90,
                'question_text' => '<p>Instansi Anda mulai menerapkan aplikasi persuratan elektronik. Anda belum terbiasa menggunakannya. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menggunakan aplikasi sebatas fitur yang Anda pahami.', 'weight' => 3],
                    ['text' => 'Mengikuti pelatihan yang diadakan kantor.', 'weight' => 4],
                    ['text' => 'Mempelajari panduan aplikasi, berlatih, dan bertanya kepada rekan atau admin jika mengalami kesulitan.', 'weight' => 5],
                    ['text' => 'Meminta rekan yang paham untuk mengoperasikan aplikasi atas nama Anda.', 'weight' => 2],
                    ['text' => 'Tetap menggunakan surat manual sampai benar-benar diwajibkan.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 34521</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>3</strong></td><td>Mau mencoba, tetapi tidak berkembang.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Mau belajar, tetapi menunggu difasilitasi.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Adaptif dan mau belajar teknologi baru.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>2</strong></td><td>Bergantung pada orang lain dan berisiko terhadap keamanan akun.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Menolak perubahan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 91 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 51342
            [
                'no' => 91,
                'question_text' => '<p>Anda menerima surel yang mengatasnamakan bagian TI kantor dan meminta Anda mengirimkan kata sandi akun kepegawaian melalui tautan tertentu. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Tidak mengklik tautan, memverifikasi kepada bagian TI melalui kontak resmi, dan melaporkan surel tersebut sebagai upaya phishing.', 'weight' => 5],
                    ['text' => 'Mengikuti instruksi karena surel tersebut mengatasnamakan bagian TI.', 'weight' => 1],
                    ['text' => 'Mengabaikan surel tersebut.', 'weight' => 3],
                    ['text' => 'Menghapus surel tersebut dan mengganti kata sandi Anda.', 'weight' => 4],
                    ['text' => 'Menanyakan keaslian surel tersebut kepada rekan kerja.', 'weight' => 2],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 51342</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Waspada dan membantu menjaga keamanan sistem organisasi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>1</strong></td><td>Rentan menjadi korban phishing.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Aman, tetapi tidak membantu mencegah korban lain.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Melindungi diri, tetapi tidak melaporkan.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>2</strong></td><td>Verifikasi melalui sumber yang tidak tepat.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 92 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 41235
            [
                'no' => 92,
                'question_text' => '<p>Anda menerima pesan berantai di grup keluarga berisi informasi kebijakan pemerintah yang belum jelas sumbernya. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengingatkan anggota grup agar tidak menyebarkan informasi yang belum jelas sumbernya.', 'weight' => 4],
                    ['text' => 'Meneruskannya ke grup lain agar semakin banyak orang tahu.', 'weight' => 1],
                    ['text' => 'Membiarkannya karena bukan Anda yang menyebarkan.', 'weight' => 2],
                    ['text' => 'Mengecek kebenarannya untuk diri sendiri.', 'weight' => 3],
                    ['text' => 'Mengecek kebenarannya melalui situs resmi pemerintah, lalu menyampaikan hasil klarifikasi kepada anggota grup.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 41235</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Mencegah penyebaran, tetapi tanpa klarifikasi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>1</strong></td><td>Berpotensi menyebarkan hoaks.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Pasif terhadap misinformasi.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Kritis, tetapi tidak berbagi klarifikasi.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Literasi digital yang baik dan membantu mencegah hoaks.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 93 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 45321
            [
                'no' => 93,
                'question_text' => '<p>Atasan meminta Anda menyajikan data kinerja unit dalam rapat. Data tersebut selama ini dikelola secara manual dan tersebar di banyak dokumen. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengolah data dengan spreadsheet dan menampilkannya dalam bentuk tabel.', 'weight' => 4],
                    ['text' => 'Menghimpun data ke dalam lembar kerja (spreadsheet), mengolahnya, lalu menyajikannya dalam bentuk grafik yang mudah dipahami.', 'weight' => 5],
                    ['text' => 'Merangkum data secara manual dalam bentuk tabel.', 'weight' => 3],
                    ['text' => 'Menyalin data apa adanya ke dalam bahan paparan.', 'weight' => 2],
                    ['text' => 'Meminta rekan yang mahir komputer untuk membuatkannya.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 45321</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Memanfaatkan teknologi, tetapi penyajiannya kurang visual.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Memanfaatkan TIK untuk menghasilkan informasi yang efektif.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Rapi, tetapi belum memanfaatkan teknologi secara optimal.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak efisien dan kurang informatif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak mau mengembangkan kemampuan diri.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 94 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 43521
            [
                'no' => 94,
                'question_text' => '<p>Anda tidak sengaja melihat rekan kerja menyimpan data pribadi masyarakat di flashdisk pribadi dan membawanya pulang. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengingatkannya agar menghapus data dari flashdisk setelah selesai digunakan.', 'weight' => 4],
                    ['text' => 'Melaporkannya kepada atasan tanpa berbicara terlebih dahulu.', 'weight' => 3],
                    ['text' => 'Mengingatkannya tentang risiko kebocoran data dan menyarankan penggunaan media penyimpanan resmi kantor sesuai aturan pelindungan data.', 'weight' => 5],
                    ['text' => 'Menanyakan alasannya membawa data tersebut.', 'weight' => 2],
                    ['text' => 'Membiarkannya karena mungkin ia ingin bekerja lembur di rumah.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 43521</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Mengurangi risiko, tetapi tidak sesuai prosedur.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Tepat untuk keamanan, tetapi kurang membangun komunikasi.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Peduli terhadap keamanan dan pelindungan data pribadi.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>2</strong></td><td>Peduli, tetapi belum menyelesaikan masalah.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mengabaikan risiko kebocoran data pribadi.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 95 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 15342
            [
                'no' => 95,
                'question_text' => '<p>Kantor Anda ingin meningkatkan penyebaran informasi layanan kepada masyarakat. Anda dipercaya mengelola media sosial instansi. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyalin konten dari akun instansi lain.', 'weight' => 1],
                    ['text' => 'Menyusun rencana konten rutin yang informatif dan menarik, menanggapi pertanyaan warga, dan mengevaluasi jangkauan unggahan secara berkala.', 'weight' => 5],
                    ['text' => 'Mengunggah pengumuman resmi secara rutin.', 'weight' => 3],
                    ['text' => 'Membuat konten informatif yang menarik secara rutin.', 'weight' => 4],
                    ['text' => 'Mengunggah informasi layanan sesekali jika ada waktu luang.', 'weight' => 2],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 15342</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak kreatif dan berpotensi tidak sesuai.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Terencana, interaktif, dan berbasis evaluasi.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Konsisten, tetapi kurang interaktif.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Baik, tetapi belum dievaluasi dan belum interaktif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak konsisten.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 96 - TEKNOLOGI INFORMASI DAN KOMUNIKASI ; 54231
            [
                'no' => 96,
                'question_text' => '<p>Saat rapat daring, sambungan internet Anda terputus padahal Anda akan menyampaikan materi. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Segera beralih ke jaringan cadangan, seperti tethering ponsel, dan mengabari moderator melalui pesan singkat.', 'weight' => 5],
                    ['text' => 'Mengirimkan materi kepada moderator agar dibacakan orang lain.', 'weight' => 4],
                    ['text' => 'Menunggu sampai sambungan internet kembali normal.', 'weight' => 2],
                    ['text' => 'Mengabari moderator bahwa sambungan Anda terputus.', 'weight' => 3],
                    ['text' => 'Membatalkan presentasi dan meminta maaf.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Teknologi Informasi dan Komunikasi</p>
            <p><strong>Kunci Bobot (A–E):</strong> 54231</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Sigap dan komunikatif dalam mengatasi kendala.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Solutif, tetapi Anda tidak menyampaikannya sendiri.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Pasif dan rapat terhambat.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Komunikatif, tetapi belum ada solusi.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Menyerah pada kendala.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 97 - PROFESIONALISME ; 52413
            [
                'no' => 97,
                'question_text' => '<p>Atasan memberikan tugas mendesak menjelang jam pulang kantor, padahal Anda sudah memiliki janji pribadi. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyelesaikan tugas terlebih dahulu dan menginformasikan perubahan jadwal kepada pihak yang membuat janji dengan Anda.', 'weight' => 5],
                    ['text' => 'Mengerjakan tugas dengan cepat seadanya agar dapat segera pulang.', 'weight' => 2],
                    ['text' => 'Membawa pekerjaan pulang dan mengerjakannya setelah janji pribadi selesai.', 'weight' => 4],
                    ['text' => 'Menolak tugas karena sudah di luar jam kerja.', 'weight' => 1],
                    ['text' => 'Meminta keringanan tenggat waktu kepada atasan.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 52413</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Mengutamakan tugas dan tetap bertanggung jawab pada janji pribadi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kualitas kerja dikorbankan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>4</strong></td><td>Bertanggung jawab, tetapi penyelesaian bisa tertunda.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Kurang bertanggung jawab terhadap kebutuhan organisasi.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Komunikatif, tetapi kurang menunjukkan komitmen.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 98 - PROFESIONALISME ; 24153
            [
                'no' => 98,
                'question_text' => '<p>Anda menemukan kesalahan pada laporan yang sudah Anda kirimkan kepada pimpinan. Kesalahan tersebut belum diketahui siapa pun. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Memperbaikinya hanya jika pimpinan menemukan kesalahan tersebut.', 'weight' => 2],
                    ['text' => 'Melaporkan kesalahan kepada pimpinan dan menunggu arahan.', 'weight' => 4],
                    ['text' => 'Membiarkannya karena belum ada yang menyadari.', 'weight' => 1],
                    ['text' => 'Segera memperbaiki laporan, mengirimkan versi revisi, dan menyampaikan bagian yang diperbaiki kepada pimpinan.', 'weight' => 5],
                    ['text' => 'Mengirimkan revisi tanpa memberi penjelasan.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 24153</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Reaktif dan kurang jujur.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Jujur, tetapi kurang inisiatif memperbaiki.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak jujur dan tidak bertanggung jawab.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Jujur, bertanggung jawab, dan transparan.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Diperbaiki, tetapi tidak transparan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 99 - PROFESIONALISME ; 23415
            [
                'no' => 99,
                'question_text' => '<p>Anda mendapat promosi jabatan dan kini memimpin rekan-rekan yang dulu setingkat dengan Anda. Beberapa di antara mereka lebih senior. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menghindari memberi perintah kepada rekan yang lebih senior.', 'weight' => 2],
                    ['text' => 'Bersikap seperti biasa seolah-olah tidak ada perubahan jabatan.', 'weight' => 3],
                    ['text' => 'Meminta masukan dari rekan senior tentang cara memimpin tim.', 'weight' => 4],
                    ['text' => 'Menunjukkan wewenang Anda agar dihormati.', 'weight' => 1],
                    ['text' => 'Membangun komunikasi yang baik, melibatkan pengalaman rekan senior dalam pengambilan keputusan, dan tetap tegas dalam menjalankan tugas pimpinan.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23415</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak menjalankan peran pimpinan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menjaga hubungan, tetapi tidak menjalankan peran baru secara optimal.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>4</strong></td><td>Menghargai senior, tetapi belum menunjukkan arah kepemimpinan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Otoriter dan berpotensi merusak hubungan kerja.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Kepemimpinan yang menghargai sekaligus tegas.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 100 - PROFESIONALISME ; 24135
            [
                'no' => 100,
                'question_text' => '<p>Pekerjaan Anda menuntut keterampilan baru yang belum Anda kuasai. Kantor belum menyediakan pelatihan khusus. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menunggu kantor menyelenggarakan pelatihan.', 'weight' => 2],
                    ['text' => 'Belajar dari rekan kerja yang sudah menguasai keterampilan tersebut.', 'weight' => 4],
                    ['text' => 'Mengerjakan bagian yang sudah dikuasai saja.', 'weight' => 1],
                    ['text' => 'Mengusulkan kepada atasan agar diadakan pelatihan.', 'weight' => 3],
                    ['text' => 'Belajar secara mandiri melalui sumber terpercaya, mempraktikkannya dalam pekerjaan, dan membagikan hasilnya kepada rekan kerja.', 'weight' => 5],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 24135</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Pasif dalam pengembangan diri.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Inisiatif, tetapi terbatas pada sumber yang ada.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Menghindari tantangan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Konstruktif, tetapi bergantung pada pihak lain.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>5</strong></td><td>Inisiatif belajar dan berbagi pengetahuan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: E</strong> (bobot 5)</p>',
            ],
            // Soal 101 - PROFESIONALISME ; 23154
            [
                'no' => 101,
                'question_text' => '<p>Atasan meminta Anda mengubah data laporan agar capaian unit terlihat lebih baik. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengubah sebagian data saja agar tidak terlalu mencolok.', 'weight' => 2],
                    ['text' => 'Meminta perintah tersebut dituangkan secara tertulis.', 'weight' => 3],
                    ['text' => 'Mengikuti perintah atasan karena itu adalah instruksi pimpinan.', 'weight' => 1],
                    ['text' => 'Menolak dengan sopan, menjelaskan risiko manipulasi data, dan menawarkan penyajian data apa adanya disertai analisis penyebab serta rencana perbaikan.', 'weight' => 5],
                    ['text' => 'Menolak perintah tersebut.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23154</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tetap melakukan manipulasi.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Melindungi diri, tetapi tidak mencegah manipulasi.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Melanggar integritas.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Berintegritas dan tetap memberi solusi.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Berintegritas, tetapi tanpa solusi.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 102 - PROFESIONALISME ; 43512
            [
                'no' => 102,
                'question_text' => '<p>Anda memiliki beberapa pekerjaan dengan tenggat waktu yang hampir bersamaan. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyusun daftar pekerjaan berdasarkan tenggat waktu terdekat.', 'weight' => 4],
                    ['text' => 'Mengerjakan sesuai urutan datangnya tugas.', 'weight' => 3],
                    ['text' => 'Menyusun prioritas berdasarkan tingkat urgensi dan kepentingan, membuat jadwal pengerjaan, dan mengomunikasikan potensi kendala sejak awal.', 'weight' => 5],
                    ['text' => 'Mengerjakan semuanya sekaligus.', 'weight' => 1],
                    ['text' => 'Mengerjakan pekerjaan yang paling mudah terlebih dahulu.', 'weight' => 2],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 43512</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Terencana, tetapi belum mempertimbangkan tingkat kepentingan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Teratur, tetapi tidak memperhatikan prioritas.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Manajemen waktu yang baik dan komunikatif.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak efektif dan berisiko menurunkan kualitas.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak berdasarkan prioritas.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 103 - PROFESIONALISME ; 15234
            [
                'no' => 103,
                'question_text' => '<p>Hasil kerja Anda dikritik keras oleh atasan di hadapan rekan-rekan kerja. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Diam, tetapi merasa sakit hati.', 'weight' => 1],
                    ['text' => 'Menerima kritik dengan tenang, mencatat bagian yang perlu diperbaiki, lalu memperbaikinya.', 'weight' => 5],
                    ['text' => 'Membela diri saat itu juga.', 'weight' => 2],
                    ['text' => 'Menerima kritik, tetapi mengeluh kepada rekan kerja.', 'weight' => 3],
                    ['text' => 'Meminta penjelasan lebih lanjut kepada atasan setelah rapat.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Profesionalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 15234</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak mengelola emosi dengan baik.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Terbuka terhadap masukan dan berorientasi pada perbaikan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Defensif.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menerima, tetapi tidak sepenuhnya positif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Mencari pemahaman, tetapi belum memperbaiki.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 104 - ANTI RADIKALISME ; 52143
            [
                'no' => 104,
                'question_text' => '<p>Anda melihat seorang teman di media sosial mulai sering membagikan konten yang menganggap kelompok lain sebagai musuh yang harus diperangi. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengajaknya berdiskusi secara pribadi, memberikan perspektif yang moderat, dan melaporkan konten yang memuat ajakan kekerasan melalui kanal resmi.', 'weight' => 5],
                    ['text' => 'Langsung memutus pertemanan dengannya.', 'weight' => 2],
                    ['text' => 'Membiarkannya karena itu hak pribadinya.', 'weight' => 1],
                    ['text' => 'Melaporkan akunnya kepada platform media sosial.', 'weight' => 4],
                    ['text' => 'Mengomentari unggahannya dengan kritik keras.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 52143</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>5</strong></td><td>Mencegah radikalisme secara persuasif dan sesuai aturan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Menghindar dan berpotensi membuatnya semakin terisolasi.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Permisif terhadap paham radikal.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tindakan tepat, tetapi tanpa pendekatan persuasif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Peduli, tetapi berpotensi memicu konflik.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: A</strong> (bobot 5)</p>',
            ],
            // Soal 105 - ANTI RADIKALISME ; 24513
            [
                'no' => 105,
                'question_text' => '<p>Seorang kenalan mengajak Anda mengikuti kajian tertutup yang mengajarkan bahwa sistem pemerintahan Indonesia harus diganti karena dianggap tidak sah. Apa sikap Anda?</p>',
                'options' => [
                    ['text' => 'Ikut sekali untuk mengetahui isinya.', 'weight' => 2],
                    ['text' => 'Menolak dan menjelaskan pandangan Anda kepada kenalan tersebut.', 'weight' => 4],
                    ['text' => 'Menolak ajakan tersebut, menjelaskan bahwa Pancasila dan NKRI adalah kesepakatan bangsa, serta melaporkan kepada pihak berwenang jika terdapat indikasi ajakan makar.', 'weight' => 5],
                    ['text' => 'Mengikuti kajian tersebut karena menghormati kebebasan berpendapat.', 'weight' => 1],
                    ['text' => 'Menolak dengan halus tanpa memberikan alasan.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 24513</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Berisiko terpapar paham radikal.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat, tetapi belum mempertimbangkan pelaporan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Teguh pada ideologi negara dan bertindak sesuai hukum.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Membuka diri terhadap paham anti-Pancasila.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menolak, tetapi tidak meluruskan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 106 - ANTI RADIKALISME ; 42513
            [
                'no' => 106,
                'question_text' => '<p>Di lingkungan kantor, Anda mendengar rekan kerja menyampaikan bahwa hanya kelompoknya yang paling benar dan kelompok lain tidak layak dihormati. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Melaporkannya kepada atasan.', 'weight' => 4],
                    ['text' => 'Menghindarinya.', 'weight' => 2],
                    ['text' => 'Mengajaknya berdiskusi dengan santun tentang pentingnya saling menghormati perbedaan sebagai sesama warga negara.', 'weight' => 5],
                    ['text' => 'Menyetujuinya agar tidak terjadi perdebatan.', 'weight' => 1],
                    ['text' => 'Membantahnya di depan rekan-rekan lain.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 42513</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat sebagai langkah formal, tetapi belum persuasif.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak membantu meluruskan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>5</strong></td><td>Moderat dan persuasif dalam meluruskan pandangan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>1</strong></td><td>Membenarkan sikap intoleran.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Berani, tetapi berpotensi memicu konflik.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: C</strong> (bobot 5)</p>',
            ],
            // Soal 107 - ANTI RADIKALISME ; 23154
            [
                'no' => 107,
                'question_text' => '<p>Adik Anda yang masih remaja mulai tertutup, menjauhi keluarga, dan sering mengakses situs yang menyebarkan kebencian terhadap kelompok tertentu. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menyita gawainya.', 'weight' => 2],
                    ['text' => 'Menasihatinya agar tidak membuka situs tersebut.', 'weight' => 3],
                    ['text' => 'Membiarkannya karena masa remaja memang penuh pencarian jati diri.', 'weight' => 1],
                    ['text' => 'Mendekatinya dengan penuh perhatian, mengajaknya berdialog, mendampingi aktivitas daringnya, dan melibatkan orang tua serta tokoh yang ia hormati.', 'weight' => 5],
                    ['text' => 'Memberitahukan hal tersebut kepada orang tua.', 'weight' => 4],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 23154</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Represif dan dapat membuatnya semakin menjauh.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Peduli, tetapi kurang efektif.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Lalai terhadap tanda-tanda radikalisasi.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Pendekatan keluarga yang hangat dan menyeluruh.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>4</strong></td><td>Melibatkan keluarga, tetapi belum melakukan pendekatan langsung.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 108 - ANTI RADIKALISME ; 43251
            [
                'no' => 108,
                'question_text' => '<p>Anda menemukan selebaran di tempat ibadah yang berisi ajakan untuk tidak mengakui bendera Merah Putih dan lagu kebangsaan Indonesia Raya. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Melaporkannya kepada pengurus tempat ibadah.', 'weight' => 4],
                    ['text' => 'Membuangnya.', 'weight' => 3],
                    ['text' => 'Membacanya untuk memahami isinya.', 'weight' => 2],
                    ['text' => 'Mengamankan selebaran tersebut, melaporkannya kepada pengurus tempat ibadah dan aparat setempat, serta membantu memberi pemahaman kepada jamaah.', 'weight' => 5],
                    ['text' => 'Membiarkannya karena bukan tanggung jawab Anda.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 43251</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat, tetapi belum menyeluruh.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>3</strong></td><td>Menghentikan penyebaran, tetapi tidak menindaklanjuti.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak ada tindakan pencegahan.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>5</strong></td><td>Bertindak tepat dan edukatif.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Tidak peduli terhadap ancaman ideologi.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: D</strong> (bobot 5)</p>',
            ],
            // Soal 109 - ANTI RADIKALISME ; 25341
            [
                'no' => 109,
                'question_text' => '<p>Sebuah akun anonim di media sosial mengajak warganet melakukan aksi kekerasan terhadap kelompok yang berbeda pandangan politik. Banyak teman Anda menyukai unggahan tersebut. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Mengabaikannya.', 'weight' => 2],
                    ['text' => 'Melaporkan unggahan tersebut kepada platform dan aduan konten resmi pemerintah, serta mengingatkan teman-teman agar tidak mendukung ajakan kekerasan.', 'weight' => 5],
                    ['text' => 'Mengingatkan teman-teman Anda agar tidak menyukai unggahan tersebut.', 'weight' => 3],
                    ['text' => 'Melaporkan unggahan tersebut kepada platform.', 'weight' => 4],
                    ['text' => 'Ikut menyukai unggahan tersebut.', 'weight' => 1],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 25341</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>2</strong></td><td>Tidak melakukan pencegahan.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Bertindak sesuai aturan dan mengedukasi lingkungan.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>3</strong></td><td>Edukatif, tetapi konten tetap beredar.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>4</strong></td><td>Tepat, tetapi belum mengedukasi lingkungan.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>1</strong></td><td>Mendukung ajakan kekerasan.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
            // Soal 110 - ANTI RADIKALISME ; 45123
            [
                'no' => 110,
                'question_text' => '<p>Anda diminta menjadi narasumber dalam kegiatan pemuda di desa Anda. Panitia meminta Anda membahas cara menangkal paham radikal di kalangan pemuda. Apa yang Anda lakukan?</p>',
                'options' => [
                    ['text' => 'Menerima dan mengundang tokoh agama untuk berbicara bersama Anda.', 'weight' => 4],
                    ['text' => 'Menyiapkan materi tentang nilai Pancasila, literasi digital, dan contoh nyata, lalu mengajak pemuda berdiskusi secara interaktif.', 'weight' => 5],
                    ['text' => 'Menolak karena merasa topik tersebut terlalu sensitif.', 'weight' => 1],
                    ['text' => 'Menerima dan membacakan materi dari internet.', 'weight' => 2],
                    ['text' => 'Menerima dan menyampaikan materi secara ceramah.', 'weight' => 3],
                ],
                'explanation' => '<p><strong>Aspek:</strong> Anti Radikalisme</p>
            <p><strong>Kunci Bobot (A–E):</strong> 45123</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Opsi</th><th>Bobot</th><th>Alasan</th></tr>
            <tr><td style="text-align:center"><strong>A</strong></td><td style="text-align:center"><strong>4</strong></td><td>Kolaboratif, tetapi peran Anda belum optimal.</td></tr>
            <tr><td style="text-align:center"><strong>B</strong></td><td style="text-align:center"><strong>5</strong></td><td>Edukatif, kontekstual, dan partisipatif.</td></tr>
            <tr><td style="text-align:center"><strong>C</strong></td><td style="text-align:center"><strong>1</strong></td><td>Menghindari peran dalam pencegahan radikalisme.</td></tr>
            <tr><td style="text-align:center"><strong>D</strong></td><td style="text-align:center"><strong>2</strong></td><td>Kurang persiapan.</td></tr>
            <tr><td style="text-align:center"><strong>E</strong></td><td style="text-align:center"><strong>3</strong></td><td>Berkontribusi, tetapi kurang interaktif.</td></tr>
            </table>
            <p><strong>Jawaban terbaik: B</strong> (bobot 5)</p>',
            ],
        ];

        DB::transaction(function () use ($questions, $materialId, $now) {
            foreach ($questions as $question) {
                $questionId = DB::table('questions')->insertGetId([
                    'material_id'   => $materialId,
                    'type'          => 'mcq',
                    'test_type'     => 'tkp',
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
                        'image'       => null,
                        'is_correct'  => false,
                        'order'       => $order + 1,
                        'weight'      => $option['weight'],
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            }
        });

        $this->command->info('Seeder TKP Paket SKD berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
