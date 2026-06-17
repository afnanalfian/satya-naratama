<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TKPTOPEKAN2Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Material dengan id = 52 (TKP)
        $materialId = 39;

        $questions = [
            // Soal 66 (asli nomor 1)
            [
                'question_text' => 'Di suatu kantor pajak yang ramai, masuklah seorang bapak dengan wajah kebingungan. Ia mengatakan bahwa dirinya baru pertama kali ke kantor pajak untuk mengurus surat-surat. Sebagai petugas loket, apa yang Anda lakukan?',
                'explanation' => 'Kunci: ABCED (A=5, B=4, C=3, E=2, D=1)',
                'options' => [
                    ['text' => 'Menanyakan keperluannya, mungkin dia memerlukan bantuan', 'weight' => 5, 'order' => 1],
                    ['text' => 'Memintanya untuk antre bersama pelanggan yang lain', 'weight' => 4, 'order' => 2],
                    ['text' => 'Mencatat semua kebutuhannya agar bisa segera diatasi', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menasihatinya agar lain kali mengurus kebutuhannya dengan persiapan', 'weight' => 2, 'order' => 4],
                    ['text' => 'Memastikan seluruh kebutuhannya sudah ditampung dan dipahami', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 67 (asli nomor 2)
            [
                'question_text' => 'Winda adalah seorang customer service di kantornya. Ia bertugas menangani keluhan dari pelanggan. Suatu ketika pelanggan tersebut kurang menerima penjelasan diberikan oleh Winda terkait dengan permasalahan yang dihadapinya. Yang Winda lakukan adalah...',
                'explanation' => 'Kunci: CABED (C=5, A=4, B=3, E=2, D=1)',
                'options' => [
                    ['text' => 'Segera melaporkan kepada atasan agar masalah pelanggan tersebut segera dapat diatasi atasan dan pelanggan tidak marah', 'weight' => 4, 'order' => 1],
                    ['text' => 'Bersungguh-sungguh mendengarkan keluhannya lalu berusaha segera memberikan solusi sesuai dengan masalah', 'weight' => 3, 'order' => 2],
                    ['text' => 'Menanyakan apakah penjelasannya jelas setiap selesai menjelaskan satu poin pada sesi konsultan tersebut', 'weight' => 5, 'order' => 3],
                    ['text' => 'Mencoba mengajaknya membicarakan hal lain dahulu, baru kemudian menjelaskan kembali dengan pelan dan sabar', 'weight' => 1, 'order' => 4],
                    ['text' => 'Menenangkan dahulu pelanggan tersebut, menawarkan minum, kemudian menjelaskan kembali setelah tenang', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 68 (asli nomor 3)
            [
                'question_text' => 'Produk milik perusahaan tempat Yamin bekerja sering dibajak oleh kompetitor. Adik Yamin adalah salah satu pelanggan yang belakangan diketahui bekerja di perusahaan kompetitor. Suatu hari adiknya bertanya-tanya tentang spesifikasi sebuah produk. Sebagai seorang pemberi layanan, apa respons Yamin?',
                'explanation' => 'Kunci: ABDEC (A=5, B=4, D=3, E=2, C=1)',
                'options' => [
                    ['text' => 'Menjelaskan spesifikasi produk sebatas yang dapat diketahui oleh konsumen', 'weight' => 5, 'order' => 1],
                    ['text' => 'Mengatakan bahwa ia tidak memberikan informasi produk kepada kompetitor', 'weight' => 4, 'order' => 2],
                    ['text' => 'Meminta adiknya mencari tahu spesifikasi produk di brosur atau bungkus produk', 'weight' => 1, 'order' => 3],
                    ['text' => 'Menanyakan informasi spesifik yang dibutuhkan agar penjelasannya tidak meluas', 'weight' => 3, 'order' => 4],
                    ['text' => 'Meminta untuk menggunakan informasi produk sesuai dengan kebutuhannya sebagai konsumen', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 69 (asli nomor 4)
            [
                'question_text' => 'Suatu hari seorang pengelola panti asuhan marah, dan membentak-bentak Fathir karena merasa dipersulit mengurus akta kelahiran anak di panti. Sebagai petugas, Fathir sudah menjelaskan alasannya karena persyaratan yang dibutuhkan belum terpenuhi, tetapi mereka tidak menerima. Apa yang harus dilakukan Fathir?',
                'explanation' => 'Kunci: AECBD (A=5, E=4, C=3, B=2, D=1)',
                'options' => [
                    ['text' => 'Mencoba menenangkan emosi pengelola dengan sabar lalu mengajaknya bicara baik-baik', 'weight' => 5, 'order' => 1],
                    ['text' => 'Menunjukkan wajah kesal dan tidak bisa menerima perlakuan dari pengelola panti asuhan tersebut', 'weight' => 2, 'order' => 2],
                    ['text' => 'Berusaha tetap tenang, tetapi tidak bisa menyembunyikan wajah kesalnya kepada pengelola tersebut', 'weight' => 3, 'order' => 3],
                    ['text' => 'Pergi meninggalkan pengelola tersebut agar bisa sejenak menenangkan diri terlebih dahulu', 'weight' => 1, 'order' => 4],
                    ['text' => 'Mendengarkan keluhan pengelola tersebut sambil tetap mengendalikan emosi di dalam diri', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 70 (asli nomor 5)
            [
                'question_text' => 'Dodi adalah kurir yang bertugas mengantar barang. Karena lokasi tujuan berjarak cukup jauh dan daerahnya kurang familiar, Dodi berkali-kali menelepon pelanggan untuk memastikan alamatnya benar. Saat sampai di lokasi, pelanggan marah karena menunggu lama. Apa yang sebaiknya dilakukan Dodi?',
                'explanation' => 'Kunci: CABDE (C=5, A=4, B=3, D=2, E=1)',
                'options' => [
                    ['text' => 'Ia meminta maaf dan mengatakan untuk pengantaran berikutnya ia pasti sudah hafal alamatnya', 'weight' => 4, 'order' => 1],
                    ['text' => 'Ia menjelaskan alasan keterlambatan dengan cara yang bisa diterima oleh pelanggan', 'weight' => 3, 'order' => 2],
                    ['text' => 'Ia meminta maaf atas ketidaknyamanan yang dirasakan pelanggan dan akan memperbaikinya', 'weight' => 5, 'order' => 3],
                    ['text' => 'Ia menunjukkan ekspresi lelah sehingga pelanggan bisa memaklumi kondisinya', 'weight' => 2, 'order' => 4],
                    ['text' => 'Ia langsung menyerahkan barang, kemudian buru-buru pamit agar tidak dimarahi pelanggan', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 71 (asli nomor 6)
            [
                'question_text' => 'Fandi, seorang dosen, dikritik mahasiswa tentang sikapnya yang semena-mena terhadap mahasiswa. Fandi sadar bahwa sebagai pendidik sikap dan perilaku dosen tentu menjadi perhatian banyak pihak, tetapi ia tidak menyangka akan mendapat reaksi negatif dari mahasiswa. Apa yang sebaiknya dilakukan Fandi?',
                'explanation' => 'Kunci: CEDBA (C=5, E=4, D=3, B=2, A=1)',
                'options' => [
                    ['text' => 'Diam saja tanpa menanggapi kritikan mahasiswa karena setiap dosen punya ciri khas yang berbeda-beda', 'weight' => 1, 'order' => 1],
                    ['text' => 'Mendengarkan kritik mahasiswa tanpa memberikan komentar apa pun agar tidak menjadi panjang', 'weight' => 2, 'order' => 2],
                    ['text' => 'Segera mengintrospeksi diri dan meminta masukan mahasiswa sebagai dasar perbaikan diri', 'weight' => 5, 'order' => 3],
                    ['text' => 'Mengajak mahasiswa berdialog untuk mendapat masukan dari apa yang mereka harapkan darinya', 'weight' => 3, 'order' => 4],
                    ['text' => 'Memikirkan respons yang paling tepat untuk menanggapi kritik dan pandangan mahasiswa', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 72 (asli nomor 7)
            [
                'question_text' => 'Nadine terlibat kegiatan pekan promosi produk kantor yang diadakan di mal. Ia mendapat kritikan dari pengunjung yang mengatakan bahwa produk mereka kurang canggih jika dibandingkan dengan produk serupa dari perusahaan lain. Kritikan disampaikan di depan para pengunjung lain. Respons Nadine adalah...',
                'explanation' => 'Kunci: CDEBA (C=5, D=4, E=3, B=2, A=1)',
                'options' => [
                    ['text' => 'Tidak perlu terlalu menanggapi kritikan tersebut karena Nadine tidak ada hubungan langsung dengan produk perusahaan yang lain', 'weight' => 1, 'order' => 1],
                    ['text' => 'Mendengarkan kritikan yang disampaikan pengunjung tersebut agar ia merasa lega dan tidak semakin panjang kritikannya', 'weight' => 2, 'order' => 2],
                    ['text' => 'Meyakinkan pengunjung tersebut bahwa produk yang ditawarkan Nadine jauh lebih baik dengan harga yang bersaing', 'weight' => 5, 'order' => 3],
                    ['text' => 'Menerima kritikan tersebut kemudian meneruskannya kepada pihak penjaminan kualitas produk di perusahaannya', 'weight' => 4, 'order' => 4],
                    ['text' => 'Berterima kasih atas kritikan pengunjung dan meminta kontaknya untuk bisa memberikan informasi yang lebih detail tentang produk', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 73 (asli nomor 8)
            [
                'question_text' => 'Robi selalu bimbang dalam bertindak. Saat diminta melakukan penjajakan kerja sama dengan pihak lain, ia pun meragukan bahwa hal tersebut akan berhasil. Sementara itu, Anda juga tidak yakin dengan hal tersebut. Anda dimintai pendapat oleh Robi, apakah yang akan Anda sampaikan kepadanya?',
                'explanation' => 'Kunci: DEACB (D=5, E=4, A=3, C=2, B=1)',
                'options' => [
                    ['text' => 'Menyampaikan kepadanya bahwa kerja sama dengan pihak lain dapat dilakukan', 'weight' => 3, 'order' => 1],
                    ['text' => 'Berargumentasi bahwa keberhasilan sangat ditentukan oleh kerja sama dengan pihak lain', 'weight' => 1, 'order' => 2],
                    ['text' => 'Menyetujui bahwa kerja sama dengan pihak lain akan menambah koordinasi semakin sulit', 'weight' => 2, 'order' => 3],
                    ['text' => 'Menyampaikan kepadanya bahwa pihak tertentu dapat diajak kerja sama jika situasi memungkinkan', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menyampaikan kepadanya bahwa meskipun berat, kerja sama penting dilakukan demi kemajuan', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 74 (asli nomor 9)
            [
                'question_text' => 'Budi kesulitan dan merasa tidak nyaman untuk menjalin hubungan kerja sama bisnis dengan orang-orang, tetapi kerja sama itu dibutuhkan agar usaha peternakannya bisa berkembang. Apa yang sebaiknya dilakukan oleh Budi?',
                'explanation' => 'Kunci: DEACB (D=5, E=4, A=3, C=2, B=1)',
                'options' => [
                    ['text' => 'Memberanikan diri untuk terus membuka kerja sama baru dengan pihak mana pun, termasuk dengan pihak baru yang belum dikenal', 'weight' => 3, 'order' => 1],
                    ['text' => 'Memilih untuk belajar mengembangkan usaha peternakannya seorang diri tanpa hubungan kerja sama apa pun agar bisa mandiri', 'weight' => 1, 'order' => 2],
                    ['text' => 'Bersedia untuk menjalin kerja sama dengan pihak lain bila memang ada yang menawarkan untuk bekerja sama dengan dirinya', 'weight' => 2, 'order' => 3],
                    ['text' => 'Memaksa diri untuk terus membuka kerja sama baru dengan pihak mana pun sekaligus memperkuat hubungan kerja yang lama', 'weight' => 5, 'order' => 4],
                    ['text' => 'Tetap mencoba untuk membuka berbagai pintu kerja sama, tetapi sebaiknya hanya dengan orang-orang yang telah dikenal baik saja', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 75 (asli nomor 10)
            [
                'question_text' => 'Tiara adalah pegawai baru yang belum banyak tahu tentang detail produk. Dalam suatu kesempatan, pimpinan meminta ide promosi produk dari semua pegawai. Sedikitnya pengetahuan dan pengalaman membuat Tiara belum punya ide promosi yang bisa diandalkan. Apa yang akan dilakukan Tiara?',
                'explanation' => 'Kunci: EDACB (E=5, D=4, A=3, C=2, B=1)',
                'options' => [
                    ['text' => 'Sementara waktu mengamati perkembangan situasi sambil menunggu barangkali ada rekan kerjanya yang mengajaknya berdiskusi mencari ide promosi', 'weight' => 3, 'order' => 1],
                    ['text' => 'Mengabarkan masalah yang dihadapinya kepada orang-orang di sekitarnya dengan harapan ada di antara mereka yang bisa memberikan ide promosi produk', 'weight' => 1, 'order' => 2],
                    ['text' => 'Memilih untuk mendengarkan saja ide-ide yang disampaikan oleh rekan-rekannya karena belum siap memberikan ide yang bisa diandalkan', 'weight' => 2, 'order' => 3],
                    ['text' => 'Mencari alternatif cara agar rekan-rekan kerjanya bersedia bekerja sama dalam diskusi mencari strategi promosi produk yang bisa diandalkan', 'weight' => 4, 'order' => 4],
                    ['text' => 'Aktif merancang strategi agar bisa bekerja sama dengan seluruh rekan kerja untuk membicarakan strategi promosi produk yang bisa diandalkan', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 76 (asli nomor 11)
            [
                'question_text' => 'Pimpinan perusahaan tempat Dhani bekerja memberikan tugas tambahan kepadanya dengan tenggat waktu pelaporan satu minggu. Sementara itu, laporan pertanggungjawaban tugas lainnya belum selesai disusun. Bagaimana seharusnya pandangan Dhani tentang tugas tambahan tersebut?',
                'explanation' => 'Kunci: ABEDC (A=5, B=4, E=3, D=2, C=1)',
                'options' => [
                    ['text' => 'Menyusun skala prioritas tugas sehingga tugas bisa diselesaikan dengan sebaik-baiknya', 'weight' => 5, 'order' => 1],
                    ['text' => 'Menyelesaikan tugas dengan tuntas agar perusahaan dapat berkembang dengan baik', 'weight' => 4, 'order' => 2],
                    ['text' => 'Merasa diintimidasi oleh pimpinan yang tidak suka terhadap dirinya', 'weight' => 1, 'order' => 3],
                    ['text' => 'Berusaha menyelesaikan semua tugas seadanya dan tidak optimal', 'weight' => 2, 'order' => 4],
                    ['text' => 'Menyelesaikan tugas dari pimpinan jika mendapatkan insentif tambahan atas kinerjanya', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 77 (asli nomor 12)
            [
                'question_text' => 'Dino mahasiswa pendiam yang berprestasi. Bersama Dita dipilih menjadi wakil pertukaran mahasiswa internasional. Dino belum pernah pergi ke luar negeri dan ingin bertanya pada Dita, tetapi ia takut karena dirinya jarang bicara dengan lawan jenis. Apa tindakan Dino?',
                'explanation' => 'Kunci: DBECA (D=5, B=4, E=3, C=2, A=1)',
                'options' => [
                    ['text' => 'Mencari sendiri informasi terkait negara tujuan melalui internet', 'weight' => 1, 'order' => 1],
                    ['text' => 'Memberanikan diri bertanya ke Dita dengan mengajak teman', 'weight' => 4, 'order' => 2],
                    ['text' => 'Menunggu Dita datang lebih dulu untuk memberikan informasi', 'weight' => 2, 'order' => 3],
                    ['text' => 'Melakukan koordinasi dengan Dita untuk mempersiapkan segala sesuatu yang diperlukan bersama', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menanyakan informasi yang dibutuhkan pada Dita melalui pesan Whatsapp', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 78 (asli nomor 13)
            [
                'question_text' => 'Judith menjadi ketua penelitian dari program hibah yang diajukan bersama Eva. Ketika diadakan pemonitoran dan evaluasi, Judith sedang dinas luar kota sehingga Eva harus mewakilinya. Judith sebenarnya mengetahui bahwa Eva kurang menguasai materi penelitian. Apakah langkah yang sebaiknya dilakukan Judith?',
                'explanation' => 'Kunci: DBECA (D=5, B=4, E=3, C=2, A=1)',
                'options' => [
                    ['text' => 'Membiarkan Eva mempelajari sendiri materi pelaksanaan penelitian', 'weight' => 1, 'order' => 1],
                    ['text' => 'Menyiapkan materi yang dibutuhkan agar Eva bisa presentasi dengan baik', 'weight' => 4, 'order' => 2],
                    ['text' => 'Membagi informasi penelitian jika Eva bertanya detail pelaksanaan kegiatan', 'weight' => 2, 'order' => 3],
                    ['text' => 'Berkoordinasi bersama Eva untuk mempersiapkan materi presentasi penelitian', 'weight' => 5, 'order' => 4],
                    ['text' => 'Memberikan informasi kemajuan proses penelitian pada poin-poin penting saja', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 79 (asli nomor 14)
            [
                'question_text' => 'Sebagai auditor senior, Budi mendapati beberapa auditor junior mengeluhkan masalah-masalah yang mereka hadapi saat melakukan proses audit. Menanggapi hal tersebut apa yang sebaiknya Budi lakukan?',
                'explanation' => 'Kunci: DECBA (D=5, E=4, C=3, B=2, A=1)',
                'options' => [
                    ['text' => 'Membiarkan hal tersebut terjadi karena lama-kelamaan para auditor junior juga akan mendapatkan pemecahan masalah saat menjalankan tugasnya', 'weight' => 1, 'order' => 1],
                    ['text' => 'Tidak keberatan berbagi pengetahuan dan keahlian dalam memecahkan masalah saat melaksanakan tugas sebagai auditor untuk meningkatkan reputasi pribadi', 'weight' => 2, 'order' => 2],
                    ['text' => 'Bersedia berbagi pengetahuan dan pengalaman dalam memecahkan masalah selama menjalankan tugas sebagai auditor jika diminta', 'weight' => 3, 'order' => 3],
                    ['text' => 'Bersedia berbagi pengetahuan dan keahlian dalam memecahkan masalah selama menjalankan tugas sebagai auditor di hadapan para auditor junior', 'weight' => 5, 'order' => 4],
                    ['text' => 'Membangun interaksi yang nyaman dengan semua auditor untuk bisa berdiskusi dan bertukar pengalaman menjalankan tugas dalam keseharian', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 80 (asli nomor 15)
            [
                'question_text' => 'Lusi dan Rita adalah dua rekan kerja yang berasal dari suku yang berbeda sehingga karakter mereka juga berbeda. Rita lebih berani mengekspresikan keinginannya daripada Lusi. Dua orang ini sering mengalami konflik akibat salah komunikasi. Apa yang perlu mereka lakukan?',
                'explanation' => 'Kunci: BADCE (B=5, A=4, D=3, C=2, E=1)',
                'options' => [
                    ['text' => 'Mereka berinteraksi seperti biasa dan tidak perlu memahami karakter karena itu sudah ciri khas masing-masing', 'weight' => 4, 'order' => 1],
                    ['text' => 'Mereka mempelajari adat dan budaya masing-masing untuk lebih saling memahami mengapa mereka sering berkonflik', 'weight' => 5, 'order' => 2],
                    ['text' => 'Mereka meminta bantuan orang lain yang bisa menjembatani konflik yang terjadi di antara mereka berdua', 'weight' => 2, 'order' => 3],
                    ['text' => 'Mereka mendiskusikan perbedaan karakter masing-masing yang didasarkan pada budaya yang berbeda', 'weight' => 3, 'order' => 4],
                    ['text' => 'Mereka mencoba memahami penyebab dari perilaku masing-masing sehingga membuat konflik terus terjadi di antara keduanya', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 81 (asli nomor 16)
            [
                'question_text' => 'Karyawan bagian produksi memiliki agama yang beragam. Beberapa karyawan berkeberatan ketika ketua panitia meminta Pak Jangkung, pemuka salah satu agama, memimpin doa bersama peringatan HUT RI. Apa yang sebaiknya dilakukan ketua panitia menghadapi keberatan mereka?',
                'explanation' => 'Kunci: ECBAD (E=5, C=4, B=3, A=2, D=1)',
                'options' => [
                    ['text' => 'Menyelenggarakan rapat perencanaan kegiatan dengan karyawan untuk menyepakati susunan umum pengisi acara', 'weight' => 2, 'order' => 1],
                    ['text' => 'Berdiskusi dengan karyawan yang beda agama mengenai bentuk kegiatan doa bersama di kantor', 'weight' => 3, 'order' => 2],
                    ['text' => 'Tetap melaksanakan acara doa bersama dengan dipimpin Pak Jangkung sesuai dengan rencana', 'weight' => 4, 'order' => 3],
                    ['text' => 'Meminta kepala bagian memberikan penjelasan agar karyawan yang beda agama dapat menarik keberatan mereka', 'weight' => 1, 'order' => 4],
                    ['text' => 'Menyampaikan pada karyawan yang beda agama bahwa Pak Jangkung akan memimpin doa secara umum', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 82 (asli nomor 17)
            [
                'question_text' => 'Sita terbiasa bernyanyi dalam perayaan di desa. Sekarang ia tinggal di asrama daerah yang terletak di Kota X. Salah satu peraturan di asramanya adalah tidak mengizinkan penghuninya bernyanyi keras pada malam hari. Ia merasa kesepian jika tidak bernyanyi, tetapi tidak berani melanggar aturan. Apa yang sebaiknya Sita lakukan?',
                'explanation' => 'Kunci: EBDCA (E=5, B=4, D=3, C=2, A=1)',
                'options' => [
                    ['text' => 'Menganggap aturan tersebut aneh dan mengabaikannya', 'weight' => 1, 'order' => 1],
                    ['text' => 'Bertanya kepada teman satu asrama tentang aturan tersebut dan berusaha memahaminya', 'weight' => 4, 'order' => 2],
                    ['text' => 'Sesekali bernyanyi dengan suara keras pada waktu yang dapat diterima', 'weight' => 2, 'order' => 3],
                    ['text' => 'Mencari tahu tata cara hidup di kota tersebut dari teman satu asrama', 'weight' => 3, 'order' => 4],
                    ['text' => 'Bersikap dan berperilaku sesuai dengan aturan asrama', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 83 (asli nomor 18)
            [
                'question_text' => 'Maya meminta tolong Edi, teman satu kelompok KKN, untuk menemaninya bergabung dalam kegiatan yang diadakan oleh klub pemuda desa pada malam hari. Edi ingin menemaninya agar ia bisa menjaga keselamatan teman perempuannya itu, tetapi ia juga sedang menjalankan programnya. Apa yang sebaiknya dilakukan oleh Edi?',
                'explanation' => 'Kunci: EBDCA (E=5, B=4, D=3, C=2, A=1)',
                'options' => [
                    ['text' => 'Menolaknya karena ia memiliki program sendiri', 'weight' => 1, 'order' => 1],
                    ['text' => 'Mengingatkan anggota kelompok untuk saling menjaga keamanan anggota lain dan bersedia menemani Maya', 'weight' => 4, 'order' => 2],
                    ['text' => 'Memahami kebutuhan Maya sebagai perempuan, tetapi meminta maaf karena belum bisa membantunya', 'weight' => 2, 'order' => 3],
                    ['text' => 'Mengajak teman lain untuk menemani Maya', 'weight' => 3, 'order' => 4],
                    ['text' => 'Memastikan bahwa dalam setiap kegiatan perlu ada anggota laki-laki untuk mendukung program', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 84 (asli nomor 19)
            [
                'question_text' => 'Penyusunan program kerja merupakan hal rutin yang dilakukan. Agar terjadi sinkronisasi program kerja lintas unit kerja, semua unit diberi kesempatan untuk menyampaikan program kerjanya. Beragam masukan dari unit kerja lain sudah diterima. Apa tindakan Anda?',
                'explanation' => 'Kunci: BAECD (B=5, A=4, E=3, C=2, D=1)',
                'options' => [
                    ['text' => 'Memperbaiki program kerja berdasarkan masukan yang sesuai dengan tujuan awal program kerja', 'weight' => 4, 'order' => 1],
                    ['text' => 'Mengajak unit kerja untuk mencermati semua masukan yang ada dan menentukan langkah perbaikan program kerja', 'weight' => 5, 'order' => 2],
                    ['text' => 'Memilih ide baru yang disampaikan dari rekan yang jelas pengalaman dan latar belakang organisasi yang diikuti', 'weight' => 2, 'order' => 3],
                    ['text' => 'Merasa bahwa program kerja yang disusun merupakan hasil pemikiran yang matang dan sudah melalui perdebatan panjang', 'weight' => 1, 'order' => 4],
                    ['text' => 'Menganalisis semua masukan, baik yang positif maupun negatif kemudian mengambil simpulan untuk perbaikan program kerja', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 85 (asli nomor 20)
            [
                'question_text' => 'Nova adalah karyawan daerah yang dipindahkan ke kantor pusat. Ia merasakan banyak perbedaan situasi kerja antara di kantor daerah dan kantor pusat terutama terkait dengan keragaman latar belakang rekan kerja. Bagaimana tindakan Nova?',
                'explanation' => 'Kunci: CEDBA (C=5, E=4, D=3, B=2, A=1)',
                'options' => [
                    ['text' => 'Memilih bekerja sama terutama dengan karyawan yang berasal dari satu daerah agar lebih mudah beradaptasi', 'weight' => 1, 'order' => 1],
                    ['text' => 'Merasa nyaman bekerja saat tergabung dalam satu kelompok karyawan yang merupakan orang-orang satu daerah', 'weight' => 2, 'order' => 2],
                    ['text' => 'Meyakinkan rekan lain untuk dapat bekerja sama dengan siapa saja agar dapat memahami keragaman yang ada', 'weight' => 5, 'order' => 3],
                    ['text' => 'Tidak ada kendala untuk menjalin kerja sama dengan semua rekan kerja yang berasal dari daerah mana pun', 'weight' => 3, 'order' => 4],
                    ['text' => 'Lebih semangat bekerja sama dengan karyawan yang memiliki tujuan yang sama meskipun berasal dari daerah berbeda', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 86 (asli nomor 21)
            [
                'question_text' => 'Caca terpilih menjadi ketua divisi yang anggotanya memiliki agama yang berbeda-beda. Hal ini membuat Caca sulit mengadakan rapat kerja divisi secara rutin karena setiap anggota memiliki jadwal ibadah yang berbeda. Apa seharusnya tindakan Caca?',
                'explanation' => 'Kunci: ACBDE (A=5, C=4, B=3, D=2, E=1)',
                'options' => [
                    ['text' => 'Mengadakan rapat anggota untuk membahas jadwal dan mengajak untuk komitmen terhadap hasil rapat', 'weight' => 5, 'order' => 1],
                    ['text' => 'Menjalin komunikasi dengan anggota divisi melalui grup percakapan untuk mendapatkan informasi', 'weight' => 3, 'order' => 2],
                    ['text' => 'Membentuk tim inti untuk menentukan jadwal rapat kerja sehingga dapat segera diambil keputusan', 'weight' => 4, 'order' => 3],
                    ['text' => 'Menunjuk beberapa orang yang agamanya sama dan menentukan kesepakatan berdasarkan suara terbanyak', 'weight' => 2, 'order' => 4],
                    ['text' => 'Mendelegasikan tugas kepada anggota divisi yang telah lama dikenal dan memiliki kesamaan pandangan', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 87 (asli nomor 22)
            [
                'question_text' => 'Tempat kerja menyediakan akses layanan internet bagi pegawai untuk meningkatkan pencarian informasi melalui teks dan video virtual. Di sisi lain hal ini mungkin menimbulkan kelelahan bagi para pegawainya karena menjadi lebih banyak di depan monitor. Sebagai seorang pegawai, apa yang akan Anda lakukan?',
                'explanation' => 'Kunci: BACDA (B=5, A=4, C=3, D=2, E=1)',
                'options' => [
                    ['text' => 'Akses informasi secara daring tidak dapat dikontrol dan justru melelahkan karena terus berhadapan dengan monitor', 'weight' => 4, 'order' => 1],
                    ['text' => 'Akses informasi terkini dan segera dapat membantu diskusi berkelanjutan dengan rekan kerja tidak terbatas satu divisi', 'weight' => 5, 'order' => 2],
                    ['text' => 'Internet membantu pencarian informasi, tetapi juga memperbesar peluang bagi pegawai untuk tidak tertib', 'weight' => 3, 'order' => 3],
                    ['text' => 'Pencarian informasi terkini dan berkelanjutan membantu berkontribusi terbaik bagi tempat kerja', 'weight' => 2, 'order' => 4],
                    ['text' => 'Akses informasi secara daring dapat dilakukan dengan cepat sehingga dapat menghemat waktu lebih banyak', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 88 (asli nomor 23)
            [
                'question_text' => 'Perusahaan periklanan saat ini mulai beralih ke media digital untuk melakukan pemasaran. Beberapa media menuntut kualitas materi iklan yang cukup tinggi. Sebagai pemilik perusahaan iklan yang baru memulai usaha, apa yang sebaiknya Anton lakukan?',
                'explanation' => 'Kunci: ECABD (E=5, C=4, A=3, B=2, D=1)',
                'options' => [
                    ['text' => 'Mencari informasi tentang perangkat lunak yang menunjang kinerja Anton sendiri', 'weight' => 3, 'order' => 1],
                    ['text' => 'Mengandalkan kemampuan staf untuk bisa mengerjakan materi iklan yang ada', 'weight' => 2, 'order' => 2],
                    ['text' => 'Mempelajari beberapa perangkat lunak yang dibutuhkan tim divisi kreatif', 'weight' => 4, 'order' => 3],
                    ['text' => 'Menyiasati pengerjaan materi secara manual untuk memenuhi tuntutan media', 'weight' => 1, 'order' => 4],
                    ['text' => 'Mempelajari seluruh perangkat lunak yang dibutuhkan oleh semua divisi di kantor', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 89 (asli nomor 24)
            [
                'question_text' => 'Aplikasi seperti word dan excel ternyata memuat begitu banyak fitur kompleks yang bisa memudahkan pekerjaan apabila dapat dikuasai. Nur yang selama ini sudah bekerja sebagai sekretaris merasa masih jauh dari penguasaan tersebut. Bagaimana sikap yang seharusnya dimiliki Nur?',
                'explanation' => 'Kunci: EBADC (E=5, B=4, A=3, D=2, C=1)',
                'options' => [
                    ['text' => 'Meluangkan waktu lebih banyak untuk mencoba berbagai kemungkinan manfaat dari fitur-fitur yang ada', 'weight' => 3, 'order' => 1],
                    ['text' => 'Meluangkan waktu yang dimiliki untuk mencoba fitur kompleks yang menarik dan terus digunakan', 'weight' => 4, 'order' => 2],
                    ['text' => 'Menyimpan waktu dan tenaga untuk mengoptimalkan kinerjanya menggunakan cara yang sudah dikuasai', 'weight' => 1, 'order' => 3],
                    ['text' => 'Menyisihkan waktu dan tenaga untuk mempelajari fitur lebih kompleks berdasarkan testimoni teman-teman kerja', 'weight' => 2, 'order' => 4],
                    ['text' => 'Menyisihkan waktu dan tenaga untuk mempelajari fitur yang lebih kompleks dan penting bagi pekerjaannya', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 90 (asli nomor 25)
            [
                'question_text' => 'Rusdi adalah pegawai senior di suatu kementerian yang salah satu tugasnya adalah menginventarisasi barang-barang keperluan kantor. Atasan menawarkan Rusdi untuk mengerjakan secara manual, mencatat di buku besar, atau dengan menggunakan komputer. Apa tindakan Rusdi?',
                'explanation' => 'Kunci: CABDE (C=5, A=4, B=3, D=2, E=1)',
                'options' => [
                    ['text' => 'Berusaha belajar agar pekerjaannya terselesaikan dengan lebih cepat dan cermat', 'weight' => 4, 'order' => 1],
                    ['text' => 'Berusaha mempelajari komputer agar catatannya tersimpan dengan rapi', 'weight' => 3, 'order' => 2],
                    ['text' => 'Antusias mempelajari semua aplikasi yang digunakan oleh dirinya dan rekan-rekan lain bidang', 'weight' => 5, 'order' => 3],
                    ['text' => 'Memilih mengerjakan secara manual karena tugasnya tetap terselesaikan dengan baik', 'weight' => 2, 'order' => 4],
                    ['text' => 'Berusaha belajar walaupun ia kurang cekatan dalam mengetik di komputer', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 91 (asli nomor 26)
            [
                'question_text' => 'Ani diminta atasan untuk mengelola data peminjaman buku di perpustakaan dengan menggunakan sistem komputerisasi. Sebelumnya, ia menggunakan sistem pencatatan secara manual selama bertahun-tahun ia bekerja. Apa tindakan Ani?',
                'explanation' => 'Kunci: CDABE (C=5, D=4, A=3, B=2, E=1)',
                'options' => [
                    ['text' => 'Menggunakan aplikasi komputer sederhana yang ia kuasai untuk mengelola data peminjaman', 'weight' => 3, 'order' => 1],
                    ['text' => 'Meminta rekan satu unit untuk mengerjakan pengelolaan data peminjaman menggunakan aplikasi komputer', 'weight' => 2, 'order' => 2],
                    ['text' => 'Mempelajari aplikasi alternatif dan inovatif secara mandiri untuk mengembangkan prosedur kerja peminjaman', 'weight' => 5, 'order' => 3],
                    ['text' => 'Bekerja sama dengan penyedia layanan TI untuk membuat sistem aplikasi yang tepat', 'weight' => 4, 'order' => 4],
                    ['text' => 'Mengerjakannya secara manual karena memberikan rasa nyaman dan hasil kerja lebih rapi', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 92 (asli nomor 27)
            [
                'question_text' => 'Akses data keuangan perusahaan harus menggunakan kata kunci. Anda adalah kepala divisi keuangan yang memiliki akses tersebut. Anda menyadari bahwa Anda orang yang pelupa. Apa yang Anda lakukan?',
                'explanation' => 'Kunci: DECAB (D=5, E=4, C=3, A=2, B=1)',
                'options' => [
                    ['text' => 'Menghentikan akses ke data keuangan dari perangkat pribadi agar tidak disalahkan ketika terjadi kebocoran data', 'weight' => 2, 'order' => 1],
                    ['text' => 'Membagikan kata kunci kepada beberapa bawahan untuk memudahkan akses data kapan pun dapat diakses', 'weight' => 1, 'order' => 2],
                    ['text' => 'Meminta atasan untuk tidak memberikan akses data keuangan kepada Anda agar tidak disalahkan ketika terjadi kebocoran data', 'weight' => 3, 'order' => 3],
                    ['text' => 'Meminta perusahaan untuk menambah enkripsi data keuangan agar tidak mudah diakses sembarang orang', 'weight' => 5, 'order' => 4],
                    ['text' => 'Mengingatkan rekan kerja untuk menghindari penyimpanan kata kunci secara otomatis di perangkat komputer', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 93 (asli nomor 28)
            [
                'question_text' => 'Joko menggunakan salah satu penyedia penyimpanan data kantor yang dilakukan secara online yang bisa diakses kapan pun dan di mana pun. Setelah sekian lama digunakan, ada kendala dalam penjagaan kerahasiaan data oleh penyedia. Bagaimana sebaiknya tindakan yang dilakukan Joko?',
                'explanation' => 'Kunci: EACDB (E=5, A=4, C=3, D=2, B=1)',
                'options' => [
                    ['text' => 'Tetap menggunakannya karena sudah banyak data yang tersimpan', 'weight' => 4, 'order' => 1],
                    ['text' => 'Menghentikan penggunaannya demi keamanan data pribadi', 'weight' => 1, 'order' => 2],
                    ['text' => 'Menghentikan penggunaannya demi keamanan pribadi dan kenyamanan orang lain', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menghentikan dan merekomendasikan rekan kerja untuk tidak menggunakannya lagi', 'weight' => 2, 'order' => 4],
                    ['text' => 'Melakukan pengamanan yang lebih ketat sebelum memakainya kembali', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 94 (asli nomor 29)
            [
                'question_text' => 'Dito melakukan penyerangan secara tertulis dan terbuka pada salah satu anggota organisasi daring karena dirasakan sangat tidak kooperatif pada suatu program kerja. Sebelumnya, Dito telah merasa lelah mengingatkan secara personal. Apa yang seharusnya dilakukan Dito?',
                'explanation' => 'Kunci: DBCEA (D=5, B=4, C=3, E=2, A=1)',
                'options' => [
                    ['text' => 'Menahan diri untuk tidak menyampaikan kritik tertulis dan terbuka karena dirinya juga dapat dirugikan', 'weight' => 1, 'order' => 1],
                    ['text' => 'Membiarkan dirinya meluapkan kekesalan secara tertulis dan terbuka agar betul-betul didengarkan', 'weight' => 4, 'order' => 2],
                    ['text' => 'Menghubungi pengelola organisasi secara personal untuk membuat regulasi yang dapat memantau anggotanya', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menyampaikan kritik secara etis sehingga menjadi pembelajaran bagi seluruh anggota organisasi', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menahan diri karena menyadari tindakannya dapat menimbulkan ketidaknyamanan secara keseluruhan', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 95 (asli nomor 30)
            [
                'question_text' => 'Anda merekomendasikan suatu teknologi pengelolaan pelatihan berbasis daring bagi seluruh karyawan. Namun, teknologi ini ditengarai berpotensi mengganggu sistem jaringan kantor. Apa yang Anda lakukan?',
                'explanation' => 'Kunci: EDCAB (E=5, D=4, C=3, A=2, B=1)',
                'options' => [
                    ['text' => 'Segera menunda rencana penggunaan teknologi ini agar perangkat komputer saya tidak terganggu', 'weight' => 2, 'order' => 1],
                    ['text' => 'Menghentikan penggunaan teknologi ini karena saat uji coba perangkat komputer pribadi mengalami kerusakan', 'weight' => 1, 'order' => 2],
                    ['text' => 'Meyakini bahwa penggunaan teknologi ini dapat membawa manfaat besar bagi karyawan di perusahaan', 'weight' => 3, 'order' => 3],
                    ['text' => 'Merekomendasikan pada rekan kerja untuk mengevaluasi pemanfaatan teknologi baru agar tidak merugikan', 'weight' => 4, 'order' => 4],
                    ['text' => 'Mengkaji beberapa teknologi agar dapat memilih yang paling aman untuk menghindari kerugian perusahaan', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 96 (asli nomor 31)
            [
                'question_text' => 'Tingkat hunian hotel tempat Agus bekerja terus menurun selama lima bulan terakhir akibat resesi. Ketika tingkat hunian hotel lain sudah mulai meningkat melalui penerapan program inovatif, Agus berpikir untuk segera bertindak. Agar hotelnya tidak terancam tutup, apa yang Agus lakukan?',
                'explanation' => 'Kunci: BDEAC (B=5, D=4, E=3, A=2, C=1)',
                'options' => [
                    ['text' => 'Memikirkan program unik dan spesifik yang mungkin dapat dibayarkan oleh hotelnya', 'weight' => 2, 'order' => 1],
                    ['text' => 'Memodifikasi program inovatif yang telah berhasil di perusahaan lain untuk diterapkan di hotelnya', 'weight' => 5, 'order' => 2],
                    ['text' => 'Melanjutkan kebiasaan yang sudah berjalan selama ini sambil berharap resesi segera berakhir', 'weight' => 1, 'order' => 3],
                    ['text' => 'Mengembangkan dan menguji model perhotelan gaya baru yang disesuaikan pada masa resesi', 'weight' => 4, 'order' => 4],
                    ['text' => 'Merangsang munculnya kreasi baru dengan melibatkan karyawan dalam penggalian ide inovatif', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 97 (asli nomor 32)
            [
                'question_text' => 'Fani dan Yudi ada agenda untuk memimpin rapat kerja dalam tim. Sayangnya hari ini Yudi terlambat bangun karena semalaman mempersiapkan materi. Saat buru-buru berangkat ke kantor tiba-tiba ban motor Yudi kempes. Bagaimana sebaiknya tindakan Yudi?',
                'explanation' => 'Kunci: BADCE (B=5, A=4, D=3, C=2, E=1)',
                'options' => [
                    ['text' => 'Mencari kendaraan alternatif agar dapat segera sampai di kantor untuk menghadiri rapat', 'weight' => 4, 'order' => 1],
                    ['text' => 'Segera meminta rekan untuk memulai rapat dan memutuskan naik taksi sambil memantau rapat melalui panggilan video', 'weight' => 5, 'order' => 2],
                    ['text' => 'Meminta rekan kerja yang dipercaya untuk mewakilinya agar dapat menggantikan memimpin rapat', 'weight' => 2, 'order' => 3],
                    ['text' => 'Langsung menuju tambal ban terdekat dan menambal ban yang kempes baru ke kantor', 'weight' => 3, 'order' => 4],
                    ['text' => 'Mengabari rekan satu tim bahwa akan terlambat sehingga tidak perlu menunggu untuk memulai rapat', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 98 (asli nomor 33)
            [
                'question_text' => 'Mendadak Mirza harus menyerahkan analisis keuangan perusahaan hari ini. Padahal, ia tengah menyusun rekomendasi perubahan kebijakan jam kerja untuk rapat direksi esok hari. Apa hal terbaik yang dapat Mirza lakukan?',
                'explanation' => 'Kunci: ABEDC (A=5, B=4, E=3, D=2, C=1)',
                'options' => [
                    ['text' => 'Mendahulukan penyelesaian analisis keuangan perusahaan lalu melanjutkan menyusun rekomendasi kebijakan sampai selesai', 'weight' => 5, 'order' => 1],
                    ['text' => 'Menyelesaikan penyusunan rekomendasi kebijakan sesuai dengan jadwal baru kemudian menyusun analisis keuangan sebisanya', 'weight' => 4, 'order' => 2],
                    ['text' => 'Menyelesaikan rekomendasi kebijakan lebih dahulu karena itu lebih disukainya jika dibandingkan dengan menyusun analisis keuangan', 'weight' => 1, 'order' => 3],
                    ['text' => 'Meminta bantuan staf ahli untuk menyusun draft analisis keuangan dan menambah anggota tim untuk menyusun rekomendasi kebijakan', 'weight' => 2, 'order' => 4],
                    ['text' => 'Meminta staf mengumpulkan data untuk analisis keuangan sambil meneruskan penyusunan rekomendasi kebijakan', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 99 (asli nomor 34)
            [
                'question_text' => 'Dua bulan lagi, Vina mengikuti lomba robotik nasional dan wajib mengumpulkan purwarupa kepada panitia paling lambat seminggu sebelumnya. Ia butuh waktu sebulan untuk persiapan. Bersamaan dengan itu, ia harus menyelesaikan tugas sebagai asisten penelitian. Apa tindakan yang diambil Vina?',
                'explanation' => 'Kunci: DBAEC (D=5, B=4, A=3, E=2, C=1)',
                'options' => [
                    ['text' => 'Berkoordinasi dengan asisten penelitian yang lain untuk berbagi tugas', 'weight' => 3, 'order' => 1],
                    ['text' => 'Berkonsultasi dengan dosen pembimbing agar efektif menyelesaikan purwarupa', 'weight' => 4, 'order' => 2],
                    ['text' => 'Mengerjakan apa saja yang bisa dikerjakan saat ini sesuai dengan kemampuannya', 'weight' => 1, 'order' => 3],
                    ['text' => 'Segera mulai mengerjakan purwarupa karena hal itu membutuhkan waktu lama', 'weight' => 5, 'order' => 4],
                    ['text' => 'Mendahulukan pembuatan purwarupa karena ia masih bersemangat', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 100 (asli nomor 35)
            [
                'question_text' => 'Pekerjaan sehari-hari yang dilakukan Lindu adalah menjadi petugas operator mesin tenun di perusahaan. Hari ini salah satu teman karyawan Lindu tidak masuk dan tidak memberikan surat izin, padahal alat tenun harus tetap beroperasi setiap hari. Apa yang akan Lindu lakukan?',
                'explanation' => 'Kunci: EDBAC (E=5, D=4, B=3, A=2, C=1)',
                'options' => [
                    ['text' => 'Membantu untuk mengoperasikan alat tenun jika diminta oleh supervisor perusahaan', 'weight' => 2, 'order' => 1],
                    ['text' => 'Membantu mengoperasikan alat tenun tersebut disela-sela tugas wajib yang dilakukan', 'weight' => 3, 'order' => 2],
                    ['text' => 'Menelepon teman yang kebetulan tidak masuk untuk segera berangkat kerja', 'weight' => 1, 'order' => 3],
                    ['text' => 'Mendiskusikan kepada teman sekerja untuk bekerja sama mengoperasikan alat tenun', 'weight' => 4, 'order' => 4],
                    ['text' => 'Secara aktif membantu mengoperasikan mesin sambil meminta arahan supervisor', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 101 (asli nomor 36)
            [
                'question_text' => 'Suki ditugaskan secepatnya untuk membuka cabang di pulau seberang. Sebagai pendatang di pulau, ia hanya mengetahui sedikit hal tentang lingkungan sekitar. Padahal penyiapan fasilitas kantor cabang perlu dukungan masyarakat setempat. Apa tindakan Suki?',
                'explanation' => 'Kunci: BCDEA (B=5, C=4, D=3, E=2, A=1)',
                'options' => [
                    ['text' => 'Tinggal lebih awal di pulau untuk beradaptasi dengan lingkungan setempat', 'weight' => 1, 'order' => 1],
                    ['text' => 'Berkoordinasi dengan pemerintahan lokal untuk menyiapkan pembukaan kantor', 'weight' => 5, 'order' => 2],
                    ['text' => 'Menyiapkan orang dan struktur organisasi sesuai arahan kantor pusat', 'weight' => 4, 'order' => 3],
                    ['text' => 'Merekrut orang dan menyiapkan fasilitas mengikuti prosedur baku', 'weight' => 3, 'order' => 4],
                    ['text' => 'Mempunyai rencana awal yang siap berubah dengan melihat kondisi pulau', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 102 (asli nomor 37)
            [
                'question_text' => 'Redi menjadi ketua tim kerja. Mulanya tim dapat bekerja efektif dan semua orang hadir. Namun, setelah pengerjaan tugas mandiri, beberapa orang sering tidak menghadiri diskusi. Ini membuat peran Redi kurang dipercaya sebagian anggota tim. Apa tindakan Redi?',
                'explanation' => 'Kunci: ECBDA (E=5, C=4, B=3, D=2, A=1)',
                'options' => [
                    ['text' => 'Mengganti anggota tim dengan orang baru yang dapat dipercaya', 'weight' => 1, 'order' => 1],
                    ['text' => 'Memberikan masukan pada pekerjaan masing-masing untuk memotivasi tim', 'weight' => 3, 'order' => 2],
                    ['text' => 'Mendorong kerjasama tim dengan menunjukkan bagian hasil kerjanya', 'weight' => 4, 'order' => 3],
                    ['text' => 'Menekan anggota tim untuk menyelesaikan hasil masing-masing', 'weight' => 2, 'order' => 4],
                    ['text' => 'Membuat tim lebih sering bertemu untuk bekerja sama dan memperbaiki kinerja', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 103 (asli nomor 38)
            [
                'question_text' => 'Jeni tidak terbiasa bergaul dengan orang lain yang berbeda status sosial dengan dirinya. Ketika kuliah, ia mulai bertemu dengan berbagai macam orang dan harus bekerja sama dengan mereka di dalam kelompok. Apa yang dilakukan oleh Jeni?',
                'explanation' => 'Kunci: BADEC (B=5, A=4, D=3, E=2, C=1)',
                'options' => [
                    ['text' => 'Belajar berinteraksi dengan berbagai macam golongan', 'weight' => 4, 'order' => 1],
                    ['text' => 'Menunjukkan sikap terbuka akan perbedaan dengan orang lain', 'weight' => 5, 'order' => 2],
                    ['text' => 'Berupaya melihat orang lain sama dengan dirinya', 'weight' => 1, 'order' => 3],
                    ['text' => 'Tidak membedakan teman meski berbeda status sosial', 'weight' => 3, 'order' => 4],
                    ['text' => 'Sadar bahwa dia harus mulai mencoba berinteraksi dengan berbagai golongan', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 104 (asli nomor 39)
            [
                'question_text' => 'Terjadi perebutan sumber mata air antar-desa. Tiap desa merasa mereka lebih berhak atas sumber tersebut dan sekarang mereka saling menghalangi akses menuju mata air tersebut. Akibatnya kedua desa tersebut sama-sama tidak mendapatkan sumber air bersih. Bagaimana pandangan Anda sebagai warga salah satu desa?',
                'explanation' => 'Kunci: EACDB (E=5, A=4, C=3, D=2, B=1)',
                'options' => [
                    ['text' => 'Mendukung keputusan desa Anda dan mencari sumber mata air lain', 'weight' => 4, 'order' => 1],
                    ['text' => 'Mengetahui perebutan sumber air ini justru membawa masalah baru untuk kedua desa', 'weight' => 1, 'order' => 2],
                    ['text' => 'Ingin agar kedua desa segera mencari jalan keluar dan rukun seperti sedia kala', 'weight' => 3, 'order' => 3],
                    ['text' => 'Mengetahui bahwa jika tidak ada perebutan ini kedua desa masih tetap dapat menikmati air bersih', 'weight' => 2, 'order' => 4],
                    ['text' => 'Menyampaikan kepada warga desa untuk bernegosiasi dalam rangka mencari jalan keluar bersama', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 105 (asli nomor 40)
            [
                'question_text' => 'Fani adalah pegawai teladan di kantor yang sering mendapat pujian dari atasan. Namun, ia sering kali mengabaikan peraturan perusahaan demi mencapai target pekerjaannya. Apa yang Anda lakukan?',
                'explanation' => 'Kunci: ABCDE (A=5, B=4, C=3, D=2, E=1)',
                'options' => [
                    ['text' => 'Merancang dialog yang melibatkan semua pegawai di kantor dalam rangka menegakkan aturan perusahaan', 'weight' => 5, 'order' => 1],
                    ['text' => 'Membuat program khusus dalam rangka implementasi aturan perusahaan bagi semua pegawai agar tidak melanggar aturan', 'weight' => 4, 'order' => 2],
                    ['text' => 'Berdiskusi dengan rekan kerja lain untuk menemukan cara agar Fani tidak melanggar aturan, tetapi tetap menjadi teladan', 'weight' => 3, 'order' => 3],
                    ['text' => 'Mencari informasi tentang penyebab mengapa Fani mengabaikan peraturan yang ada', 'weight' => 2, 'order' => 4],
                    ['text' => 'Tetap diam dan tidak ingin terlibat dalam masalah', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 106 (asli nomor 41)
            [
                'question_text' => 'Anda ditugaskan memimpin sebuah tim kerja yang anggotanya terdiri atas beberapa etnis. Ada beberapa kebiasaan yang berbeda di antara anggota tim sehingga kinerja tim menjadi kurang optimal dan target tim Anda menjadi sulit tercapai. Apa yang sebaiknya dilakukan?',
                'explanation' => 'Kunci: ECDAB (E=5, C=4, D=3, A=2, B=1)',
                'options' => [
                    ['text' => 'Saya menganggap perbedaan adalah sesuatu yang wajar dan harus dihargai, tetapi kinerja tim harus tetap optimal', 'weight' => 2, 'order' => 1],
                    ['text' => 'Perbedaan adalah sebuah anugerah. Tim harus tetap bekerja, meskipun hasilnya tidak optimal', 'weight' => 1, 'order' => 2],
                    ['text' => 'Saya akan dengarkan aspirasi setiap kelompok yang ada, kemudian melaporkan situasi tersebut kepada atasan', 'weight' => 4, 'order' => 3],
                    ['text' => 'Saya akan laporkan situasi tersebut kepada pimpinan dan mendiskusikannya bersama untuk mengatasi perbedaan tersebut', 'weight' => 3, 'order' => 4],
                    ['text' => 'Saya akan berdiskusi dengan mereka secara intensif untuk menemukan titik temu yang saling menguntungkan', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 107 (asli nomor 42)
            [
                'question_text' => 'Teguh adalah seorang pegawai kantor pusat di Jakarta. Ia dipindahkan ke kantor cabang dan menemukan kesulitan untuk bergaul dengan pegawai yang lain karena lingkungan kerja yang terkotak-kotak. Apa yang seharusnya dilakukan Teguh?',
                'explanation' => 'Kunci: DCBEA (D=5, C=4, B=3, E=2, A=1)',
                'options' => [
                    ['text' => 'Menjalankan aktivitas yang sama seperti yang dilakukannya di kantor pusat', 'weight' => 1, 'order' => 1],
                    ['text' => 'Mencari informasi terkait kondisi kantor sebenarnya', 'weight' => 3, 'order' => 2],
                    ['text' => 'Berdiskusi dengan rekan kerja terkait kondisi lingkungan kerja', 'weight' => 4, 'order' => 3],
                    ['text' => 'Berupaya menghilangkan setiap sekat yang ada di antara pegawai', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menggelar acara kantor yang menghadirkan semua pegawai dan meminta mereka untuk saling terbuka di sana', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 108 (asli nomor 43)
            [
                'question_text' => 'Putra merupakan seorang ketua RW di Desa Sukamajaya. Di wilayahnya terdapat dua aliran keagamaan yang sering berkonflik. Apa tindakan Putra?',
                'explanation' => 'Kunci: EACDB (E=5, A=4, C=3, D=2, B=1)',
                'options' => [
                    ['text' => 'Mengajak aparat wilayah dan ketua masing-masing aliran untuk berdiskusi', 'weight' => 4, 'order' => 1],
                    ['text' => 'Mendukung salah satu yang menurut Putra paling tepat', 'weight' => 1, 'order' => 2],
                    ['text' => 'Memberikan alternatif baru kepada kedua belah pihak agar tidak berselisih', 'weight' => 3, 'order' => 3],
                    ['text' => 'Membiarkan konflik tersebut selesai dengan sendirinya', 'weight' => 2, 'order' => 4],
                    ['text' => 'Bermusyawarah dengan pimpinan kedua belah pihak untuk menemukan jalan keluar', 'weight' => 5, 'order' => 5],
                ]
            ],
            // Soal 109 (asli nomor 44)
            [
                'question_text' => 'Warga di perumahan Ali saat ini sedang merasa ketakutan karena kabarnya sekelompok orang sedang melakukan penyisiran kepada warga dengan etnis tertentu. Beberapa warga sudah menghubungi Ali sebagai ketua RT untuk meminta perlindungan. Bagaimana tindakan Ali dalam menghadapi situasi ini?',
                'explanation' => 'Kunci: CBDAE (C=5, B=4, D=3, A=2, E=1)',
                'options' => [
                    ['text' => 'Menyampaikan ke warga mengenai kabar tersebut dan meminta mereka bersiap-siap', 'weight' => 2, 'order' => 1],
                    ['text' => 'Melacak sumber berita dan memastikan kebenarannya', 'weight' => 4, 'order' => 2],
                    ['text' => 'Meminta warga tenang dan mencari kebenaran berita tersebut dari berbagai sumber terpercaya', 'weight' => 5, 'order' => 3],
                    ['text' => 'Mengumpulkan informasi dari berbagai sumber yang terpercaya', 'weight' => 3, 'order' => 4],
                    ['text' => 'Bersikap tenang meskipun meyakini bahwa berita itu benar adanya', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 110 (asli nomor 45)
            [
                'question_text' => 'Wati dan anak perempuannya bekerja di tempat yang sama. Wati selalu memberikan tugas mudah untuk anaknya sehingga menimbulkan kecemburuan di kantor. Beberapa pegawai mendesak Anda untuk menegur atau memberi sanksi. Sebagai atasan Wati, apa yang akan Anda lakukan?',
                'explanation' => 'Kunci: ECABD (E=5, C=4, A=3, B=2, D=1)',
                'options' => [
                    ['text' => 'Segera merespon keluhan saat itu juga dan menegur Wati', 'weight' => 3, 'order' => 1],
                    ['text' => 'Memanggil dan memberikan teguran keras kepada Wati', 'weight' => 2, 'order' => 2],
                    ['text' => 'Menerima keluhan dan menenangkan karyawan lain', 'weight' => 4, 'order' => 3],
                    ['text' => 'Menyusun rencana menyelesaikan persoalan ini', 'weight' => 1, 'order' => 4],
                    ['text' => 'Memberikan alternatif menyelesaikan masalah ini dengan damai', 'weight' => 5, 'order' => 5],
                ]
            ],
        ];

        // Insert all questions
        foreach ($questions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => $question['question_text'],
                'explanation' => $question['explanation'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($question['options'] as $order => $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option['text'],
                    'is_correct' => false, // TKP tidak menggunakan is_correct
                    'order' => $option['order'],
                    'weight' => $option['weight'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TKP (45 soal) berhasil dijalankan!');
        $this->command->info('Material ID: ' . $materialId);
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Soal nomor 66 s/d 110');
    }
}
