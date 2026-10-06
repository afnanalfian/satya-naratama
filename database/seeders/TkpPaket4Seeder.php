<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TkpPaket4Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $materialId = 9;

        $questions = [
            [
                'text' => 'Di suatu kantor pajak yang ramai, masuklah seorang bapak dengan wajah kebingungan. Ia mengatakan bahwa dirinya baru pertama kali ke kantor pajak untuk mengurus surat-surat. Sebagai petugas loket, apa yang Anda lakukan?',
                'options' => [
                    ['Menanyakan keperluannya, mungkin dia memerlukan bantuan', 5],
                    ['Memintanya untuk antre bersama pelanggan yang lain.', 4],
                    ['Mencatat semua kebutuhannya agar bisa segera diatasi', 3],
                    ['Menasihatinya agar lain kali mengurus kebutuhannya dengan persiapan.', 1],
                    ['Memastikan seluruh kebutuhannya sudah ditampung dan dipahami.', 2],
                ],
            ],
            [
                'text' => 'Winda adalah seorang customer service di kantornya. Ia bertugas menangani keluhan dari pelanggan. Suatu ketika pelanggan tersebut kurang menerima penjelasan diberikan oleh Winda terkait dengan permasalahan yang dihadapinya. Yang Winda lakukan adalah…',
                'options' => [
                    ['Segera melaporkan kepada atasan agar masalah pelanggan tersebut segera dapat di atasi atasan dan pelanggan tidak marah', 4],
                    ['bersungguh-sungguh mendengarkan keluhannya lalu berusaha segera memberikan solusi sesuai dengan masalah', 4],
                    ['menanyakan apakah penjelasannya jelas setiap selesai menjelaskan satu poin pada sesi konsultan tersebut.', 5],
                    ['mencoba mengajaknya membicarakan hal lain dahulu, baru kemudian menjelaskan kembali dengan pelan dan sabar.', 1],
                    ['menenangkan dahulu pelanggan tersebut, menawarkan minum, kemudian menjelaskan kembali setelah tenang.', 2],
                ],
            ],
            [
                'text' => 'Produk milik perusahaan tempat Yamin bekerja sering dibajak oleh kompetitor. Adik Yamin adalah salah satu pelanggan yang belakangan diketahui bekerja di perusahaan kompetitor. Suatu hari adiknya bertanya-tanya tentang spesifikasi sebuah produk: Sebagai seorang pemberi layanan, apa respons Yamin?',
                'options' => [
                    ['Menjelaskan spesifikasi produk sebatas yang dapat diketahui oleh konsumen.', 5],
                    ['Mengatakan bahwa ia tidak memberikan informasi produk kepeda kompetitor.', 4],
                    ['Meminta adiknya mencari tahu spesifikasi produk di brosur atau bungkus produk:', 1],
                    ['Menanyakan informasi spesifik yang dibutuhkan agar penjelasannya tidak meluas', 3],
                    ['Meminta untuk menggunakan informasi produk sesuai dengan kebutuhannya sebagai konsumen', 2],
                ],
            ],
            [
                'text' => 'Suatu hari seorang pengelola panti asuhan marah, dan menbentak-bentak Fathir karena merasa dipersulit mengurus akta kelahiran anak di panti. Sebagai petugas, Fathir sudah menjelaskan alasannya karena persyaratan yang dibutuhkan belum terpenuhi, tetapi mereka tidak menerima. Apa yang harus dilakukan Fathir?',
                'options' => [
                    ['Mencoba menenangkan emosi pengelola dengan sabar lalu mengajaknya bicara baik-baik', 5],
                    ['Menunjukkan wajah kesal dan tidak bisa menerima perlakuan dari pengelola panti asuhan tersebut', 3],
                    ['Berusaha tetap tenang, tetapi tidak bisa menyembunyikan wajah kesalnya kepada pengelola tersebut', 3],
                    ['Pergi meninggalkan pengelola tersebut agar bisa sejenak menenangkan diri terlebih dahulu', 0],
                    ['Mendengarkan keluhan pengelola tersebut sambil tetap mengendalikan emosi di dalam diri', 4],
                ],
            ],
            [
                'text' => 'Dodi adalah kurir yang bertugas mengantar barang. Karena lokasi tujuan berjarak cukup jauh dan daerahnya kurang familiar, Dodi berkali-kali menelepon pelanggan untuk memastikan alamatnya benar. Saat  sampai di lokasi, pelanggan marah karena menunggu lama. Apa yang sebaiknya dilakukan Dodi?',
                'options' => [
                    ['Ia meminta maaf dan mengatakan untuk pengantaran berikutnya ia pasti sudah hafal alamatya.', 4],
                    ['la menjelaskan alasan keterlambatan dengan cara yang bisa diterima oleh pelanggan.', 3],
                    ['la meminta maaf atas ketidaknyamanan yang dirasakan pelanggan dan akan memperbaikinya.', 5],
                    ['ia  menunjukkan ekspresi lelah sehingga pelanggan bisa memaklumi kondisinya.', 2],
                    ['Ia langsung menyerahkan barang, kemudian buru-buru pamit agar tidak dimarahi pelanggan.', 1],
                ],
            ],
            [
                'text' => 'Fandi, seorang dosen, dikritik mahasiswa tentang sikapnya yang semena-mena terhadap mahasiswa. Fandi sadar bahwa sebagai pendidik sikap dan perilaku dosen tentu menjadi perhatian banyak pihak, tetapi ia tidak menyangka akan mendapat reaksi negatif dari mahasiswa. Apa yang sebaiknya dilakukan Fandi?',
                'options' => [
                    ['Diam saja tanpa menanggapi kritikan mahasiswa karena setiap dosen punya ciri khas yang berbeda-beda', 1],
                    ['Mendengarkan kritik mahasiswa tanpa memberikan komentar apa pun agar tidak menjadi Panjang', 2],
                    ['Segera mengintrogasi diri dan meminta masukan mahasiswa sebagai dasar perbaikan diri', 5],
                    ['Mengajak mahasiswa berdialog untuk mendapat masukan dari apa yang mereka harapkan darinya.', 3],
                    ['Memikirkan respons yang paling tepat untuk menanggapi knitikan dan pandangan mahasiswa', 4],
                ],
            ],
            [
                'text' => 'Nadine terlibat kegiatan pekan promosi produk kantor yang diadakan di mal. la mendapat kritikan dari pengunjung yang mengatakan bahwa produk mereka kurang canggih jika dibandingkan dengan produk serupa dari perusahaan lain. Kritikan disampaikan di depan para pengunjung lain. Respons Nadine adalah',
                'options' => [
                    ['Tidak perlu terlalu menanggapi kritikan tersebut karena Nadine tidak ada hubungan langsung dengan produk perusahaan yang lain', 1],
                    ['mendengarkan kritikan yang disampaikan pengunjung tersebut agar ia merasa lega dan tidak semakin panjang kritikannya.', 2],
                    ['meyakinkan pengunjung tersebut bahwa produk yang ditawarkan Nadin jauh lebih baik dengan harga yang bersaing.', 5],
                    ['menerima kritikan tersebut kemudian meneruskannya kepada pihak penjaminan kualitas produk di perusahaannya.', 4],
                    ['berterima kasih atas kritikan pengunjung dan meminta kontaknya untuk bisa memberikan informasi yang lebih detail tentang produk.', 3],
                ],
            ],
            [
                'text' => 'Robi selalu bimbang dalam bertindak. Saat diminta melakukan penjajalan kerja sama dengan pihak lain, ia pun meragukan bahwa hal tersebut akan berhasil. Sementara itu, Anda juga tidak yakin dengan hal tersebut. Anda dimintai pendapat oleh Robi, apakah yang akan Anda sampaikan kapadanya?',
                'options' => [
                    ['Menyampaikan kepadanya bahwa kerja sama dengan pihak lain dapat dilakukan.', 3],
                    ['Berargumentasi bahwa keberhasilan sangat ditentukan oleh kerja sama dengan pihak lain', 1],
                    ['Menyetujui bahwa kerja sama dengan pihak lain akan menambah koordinasi semakin sulit.', 2],
                    ['Menyampaikan kepadanya bahwa pihak  tertentu dapat diajak kerja sama jika situasi memungkinkan.', 5],
                    ['Menyampaikan kepadanya bahwa meskipun berat, kerja sama penting dilakukan demi kemajuan', 4],
                ],
            ],
            [
                'text' => 'Budi kesulitan dan merasa tidak nyaman untuk menjalin hubungan kerja sama bisnis dengan orang-orang, tetapi kerja sama itu dibutuhkan agar usaha peternakannya bisa berkembang. Apa yang sebaiknya dilakukan oleh Budi?',
                'options' => [
                    ['Memberanikan diri untuk terus membuka kerja sama baru dengan pihak mana pun, termasuk dengan pihak baru yang belum dikenal', 3],
                    ['Memilih untuk belajar thengembangkan usaha peternakannya seorang diri tanpa hubungan kerja sama apa pun agar bisa mandiri.', 1],
                    ['Bersedia untuk menjalin kerja sama dengan pihak lain bila memang ada yang menawarkan untuk bekerja sama dengan dirinya.', 2],
                    ['Memaksa diri untuk terus membuka kerja sama baru dengan pihak mana pun sekaligus memperkuat hubungan kerja yang lama.', 5],
                    ['Tetap mencoba untuk membuka berbagai pintu kerja sama, tetapi sebaiknya hanya dengan orang-orang yang telah dikenal baik saja.', 4],
                ],
            ],
            [
                'text' => 'Tiara adalah pegawai baru yang belum banyak tahu tentang detail produk. Dalam suatu kesempatan, pimpinan meminta ide promosi produk dari semua pegawai. Sedikitnya pengetahuan dan pengalaman membuat Tiara belum punya ide promosi yang bisa diandalkan. Apa yang akan dilakukan Tiara?',
                'options' => [
                    ['Sementara waktu mengamati perkembangan situasi sambil menunggu barangkali ada rekan kerjanya yang mengajaknya berdiskusi mencari ide promosi.', 3],
                    ['Mengabarkan masalah yang dihadapinya kepada orang-orang di sekitarnya dengan harapan ada di antara mereka yang bisa memberikan ide promosi produk', 1],
                    ['Memilih untuk mendengarkan saja ide-ide yang disampaikan oleh rekan-rekannya karena belum siap memberikan ide yang bisa diandalkan.', 2],
                    ['Mencari alternatif cara agar rekan- rekan kerjanya bersedia bekerja sama dalam diskusi mencari strategi promosi produk yang bisa diandalkan.', 4],
                    ['Aktif merancang strategi agar bisa bekerja sama dengan seluruh rekan kerja untuk membicarakan strategi promosi produk, yang bisa diandalkan.', 5],
                ],
            ],
            [
                'text' => 'Pimpinan perusahaan tempat Dhani bekerja memberikan tugas tambahan kepadanya dengan tenggat waktu pelaporan satu minggu. Sementara itu, laporan pertanggungjawaban tugas lainnya belum selesai disusun. Bagaimana seharusnya pandangan Dhani tentang tugas tambahan tersebut?',
                'options' => [
                    ['Menyusun skala prioritas tugas sehingga tugas bisa diselesaikan dengan sebaik-baiknya', 5],
                    ['Menyelesaikan tugas dengan tuntas agar perusahaan dapat berkembang dengan baik.', 4],
                    ['Merasa diintimidasi oleh pimpinan yang tidak suka terhadap dirinya.', 1],
                    ['Berusaha menyelesaikan semua tugas seadanya dan tidak optimal', 2],
                    ['Menvelesaikan tugas dari pimpinan jika mendapatkan insentif tambahan atas kinerjanya.', 3],
                ],
            ],
            [
                'text' => 'Dino mahasiswa pendiam yang berprestasi. Bersama Dita dipilih menjadi wakil pertukaran mahasiswa internasional. Dino belum pernah pergi ke luar negeri dan ingin bertanya pada Dita, tetapi ia takut karena dirinya jarang bicara dengan lawan jenis. Apa tindakan Dino?',
                'options' => [
                    ['Mencari sendiri informasi terkait negara tujuan melalui internet.', 1],
                    ['Memberanikan diri bertanya ke Dita dengan mengajak teman.', 4],
                    ['Menunggu Dita datang lebih dulu untuk memberikan informasi.', 2],
                    ['Melakukan koordinasi dengan Dita untuk mempersiapkan segala sesuatu yang diperlukan Bersama', 5],
                    ['Menanyakan informasi yang dibutuhkan pada Dita melalui pesan Whatsapp.', 3],
                ],
            ],
            [
                'text' => 'Judith menjadi ketua penelitian dari program hibah yang diajukan bersama Eva. Ketika diadakan pemonitoran dan evaluasi, Judith sedang dinas luar kota sehingga Eva harus mewakilinya. Judith sebenarnya mengetahui bahwa Eva kurang menguasai materi penelitian. Apakah langkah yang sebaiknya dilakukan Judith?',
                'options' => [
                    ['Membiarkan Eva mempelajari sendiri materi pelaksanaan penelitian.', 1],
                    ['Menyiapkan materi yang dibutuhkan agar Eva bisa presentasi dengan baik', 4],
                    ['Membagi informasi penelitian jika Eva bertanya detail pelaksanaan kegiatan.', 2],
                    ['Berkoordinasi bersama Eva untuk mempersiapkan materi presentasi penelitian.', 5],
                    ['Memberikan informasi kemajuan proses penelitian pada poin-poin penting saja.', 3],
                ],
            ],
            [
                'text' => 'Sebagai auditor senior, Budi mendapati beberapa auditor junior mengeluhkan masalah-masalah, yang mereka hadapi saat melakukan proses audit. Menanggapi hal tersebut apa yang sebaiknya Budi lakukan?',
                'options' => [
                    ['Membiarkan hal tersebut terjadi karena lama-kelamaan para auditor junior juga akan mendapatkan pemecahan masalah saat menjalankan tugasnya.', 1],
                    ['Tidak keberatan berbagi pengetahuan dan keahlian dalam memecahkan masalah saat melaksanakan tugas sebagai auditor untuk meningkatkan reputasi pribadi.', 2],
                    ['Bersedia berbagi pengetahuan dan pengalaman dalam memecahkan masalah selama menjalankan tugas sebagai auditor jika diminta.', 3],
                    ['Bersedia berbagi pengetahuan dan keahlian dalam memecahkan masalah selama menjalankan tugas sebagai auditor di hadapan para auditor junior', 5],
                    ['Membangun interaksi yang nyaman dengan semua auditor untuk bisa berdiskusi dan bertukar pengalaman menjalankan tugas dalam keseharian.', 4],
                ],
            ],
            [
                'text' => 'Lusi dan Rita adalah dua rekan kerja yang berasal dari suku yang berbeda sehingga karakter mereka juga berbeda. Rita lebih berani mengekspresikan keinginannya daripada Lusi. Dua orang ini sering mengalami konflik akibat salah komunikasi. Apa yang perlu mereka lakukan?',
                'options' => [
                    ['Mereka berinteraksi seperti biasa dan tidak perlu memahami karakter karena itu sudah ciri khas masing-masing.', 4],
                    ['Mereka mempelajari adat dan budaya masing-masing untuk lebih saling memahami mengapa mereka sering berkonflik.', 5],
                    ['Mereka meminta bantuan orang lain yang bisa menjembatani konflik yang terjadi di antara mereka berdua.', 2],
                    ['Mereka mendiskusikan perbedaan karakter masing-masing yang didasarkan pada budaya yang berbeda.', 3],
                    ['Mereka mencoba memahami penyebab dari perilaku masing-masing sehingga membuat konflik terus terjadi di antara keduanya.', 1],
                ],
            ],
            [
                'text' => 'Karyawan bagian produksi memiliki agama yang beragam. Beberapa karyawan berkeberatan ketika ketua panitia meminta Pak Jangkung, pemuka salah satu agama, memimpin doa bersama peringatan HUT RI. Apa yang sebaiknya dilakukan ketua panitia menghadapi keberatan mereka?',
                'options' => [
                    ['Menyelenggarakan rapat perencanaan kegiatan dengan karyawan untuk menyepakati susunan umum pengisi acara', 2],
                    ['Berdiskusi dengan karyawan yang beda agama mengenai bentuk kegiatan doa bersama di kantor', 3],
                    ['Tetap melaksanakan acara doa bersama dengan dipimpin Pak jangkung sesuai dengan rencana', 4],
                    ['Meminta kepala bagian memberikan penjelasan agar karyawan yang beda agama dapat menarik keberatan mereka', 1],
                    ['Menyampaikan pada karyawan yang beda agama bahwa Pak Jangkung akan memimpin doa secara umum', 5],
                ],
            ],
            [
                'text' => 'Sita terbiasa bernyanyi dalam perayaan di desa. Sekarang ia tinggal di asrama daerah yang terletak di Kota X. Salah satu peraturan di asramanya adalah tidak mengizinkan penghuninya bernyanyi keras pada malam hari. la merasa kesepian jika tidak bernyanyi, tetapi tidak berani melanggar aturan. Apa yang sebaiknya Sita lakukan?',
                'options' => [
                    ['Menganggap aturan tersebut aneh dan mengabaikannya.', 1],
                    ['Bertanya kepada teman satu asrama tentang aturan tersebut dan berusaha memahaminva', 4],
                    ['Sesekali bernyanyi dengan suara keras pada waktu yang dapat diterima.', 2],
                    ['Mencari tahu tata cara hidup di kota tersebut dari teman satu asrama.', 3],
                    ['Bersikap dan berperilaku sesuai dengan aturan asrama.', 5],
                ],
            ],
            [
                'text' => 'Maya meminta tolong Edi, teman satu kelompok KKN, untuk menemaninya bergabung dalam kegiatan yang diadakan oleh klub pemuda desa pada malam hari. Edi ingin menemaninya agar ia bisa menjaga keselamatan teman perempuannya itu, tetapi ia juga sedang menjalankan programnya. Apa yang sebaiknya dilakukan oleh Edi?',
                'options' => [
                    ['Menolaknya karena ia memiliki program sendiri.', 1],
                    ['Mengingatkan anggota kelompok untuk saling menjaga keamanan anggota lain dan bersedia menemani Maya', 4],
                    ['Memahami kebutuhan Maya sebagai perempuan, tetapi meminta maaf karena belum bisa membantunya', 2],
                    ['Mengajak teman lain untuk menemani Maya.', 3],
                    ['Memastikan bahwa dalam setiap kegiatan perlu ada anggota laki-laki untuk mendukung program.', 5],
                ],
            ],
            [
                'text' => 'Penyusunan program kerja merupakan hal rutin yang dilakukan. Agar terjadi sinkronisasi program kerja lintas unit kerja, semua unit diberi kesempatan untuk menyampaikan program kerjanya. Beragam masukan dari unit kerja lain sudah diterima. Apa tindakan Anda?',
                'options' => [
                    ['Memperbaiki program kerja berdasarkan masukan yang sesuai dengan tujuan awal program kerja.', 4],
                    ['Mengajak unit kerja untuk mencermati semua masukan yang ada dan menentukan langkah perbaikan program kerja.', 5],
                    ['Memilih ide baru yang disampaikan dari rekan yang jelas pengalaman dan latar belakang organisasi yang diikuti.', 2],
                    ['Merasa bahwa program kerja yang disusun merupakan hasil pemikiran yang matang dan sudah melalui perdebatan panjang.', 1],
                    ['Menganalisis semua masukan, baik yang positif maupun negatif kemudian mengambil simpulan untuk perbaikan program kerja.', 3],
                ],
            ],
            [
                'text' => 'Nova adalah karyawan daerah yang dipindahkan ke kantor pusat. la merasakan banyak perbedaan situasi kerja antara di kantor daerah dan kantor pusat terutama terkait dengan keragaman latar belakang rekan kerja. Bagaimana tindakan Nova?',
                'options' => [
                    ['Memilih bekerja sama terutama dengan karyawan yang berasal dari satu daerah agar lebih mudah beradaptasi', 1],
                    ['Merasa nyaman bekerja saat tergabung dalam satu kelompok karyawan yang merupakan orang-orang satu daerah', 2],
                    ['Meyakinkan rekan lain untuk dapat bekerja sama dengan siapa saja agar dapat memahami keragaman yang ada', 5],
                    ['Tidak ada kendala untuk menjalin kerja sama dengan semua rekan kerja yang berasal dari daerah mana pun.', 3],
                    ['Lebih semangat bekerja sama dengan karyawan yang memiliki tujuan yang sama meskipun berasal dari daerah berbeda.', 4],
                ],
            ],
            [
                'text' => 'Caca terpilih menjadi ketua divisi yang anggotanya memiliki agama yang berbeda-beda. Hal ini membuat Caca sulit mengadakan rapat kerja divisi secara rutin karena setiap anggota memiliki jadwal ibadah yang berbeda. Apa seharusnya tindakan Caca?',
                'options' => [
                    ['Mengadakan rapat anggota untuk membahas jadwal dan mengajak untuk komitmen terhadap hasil rapat.', 5],
                    ['Menjalin komunikasi Pelanggan anggota divisi melalui grup percakapan untuk mendapatkan informasi.', 3],
                    ['Membentuk tim inti untuk menentukan jadwal rapat kerja sehingga dapat segera diambil keputusan.', 4],
                    ['Menunjuk beberapa orang yang agamanya sama dan menentukan kesepakatan berdasarkan suara terbanyak.', 2],
                    ['Mendelegasikan tugas kepada anggota divisi yang telah lama dikenal dan memiliki kesamaan pandangan.', 1],
                ],
            ],
            [
                'text' => 'Tempat kerja menyediakan akses layanan internet bagi pegawai untuk meningkatkan pencarian informasi melalui teks dan video virtual. Di sisi lain hal ini mungkin menimbulkan kelelahan bagi para pegawainya karena menjadi lebih banyak di depan monitor. Sebagai seorang pegawai, apa yang akan Anda lakukan?',
                'options' => [
                    ['Akses informasi secara daring tidak dapat dikontrol dan justru melelahkan karena terus berhadapan dengan monitor.', 1],
                    ['Akses informasi terkini dan segera dapat membantu diskusi berkelanjutan dengan rekan kerja tidak terbatas satu divisi.', 5],
                    ['internet membantu pencarian informasi, tetapi juga memperbesar peluang bagi pegawai untuk tidak tertib.', 3],
                    ['Pencarian informasi terkini dan berkelanjutan membantu berkontribusi terbaik bagi tempat kerja.', 2],
                    ['Akses informasi secara daring dapat dilakukan dengan cepat sehingga dapat menyimpan waktu lebih banyak.', 4],
                ],
            ],
            [
                'text' => 'Perusahaan periklanan saat ini mulai beralih ke media digital untuk melakukan pemasaran. Beberapa media menuntut kualitas materi iklan yang cukup tinggi. Sebagai pemilik perusahaan iklan yang baru memulai usaha, apa yang sebaiknya Anton lakukan?',
                'options' => [
                    ['Mencari informasi tentang perangkat lunak yang menunjang kinerja Anton sendiri.', 3],
                    ['Mengandalkan kemampuan staf untuk bisa mengerjakan materi iklan yang ada', 2],
                    ['Mempelajari beberapa perangkat lunak yang dibutuhkan tim divisi kreatif', 4],
                    ['Menyiasati pengerjaan materi secara manual untuk memenuhi tuntutan media', 1],
                    ['Mempelajari seluruh perangkat lunak yang dibutuhkan oleh semua divisi di kantor', 5],
                ],
            ],
            [
                'text' => 'Aplikasi seperti word dan excel ternyata memuat begitu banyak fitur kompleks yang bisa memudahkan pekerjaan apabila dapat dikuasai. Nur yang selama ini sudah bekerja sebagai sekretaris merasa masih merasa jauh dari penguasaan tersebut. Bagaimana sikap yang seharusnya dimiliki Nur?',
                'options' => [
                    ['Meluangkan waktu lebih banyak untuk mencoba berbagai kemungkinan manfaat dari fitur-fitur yang ada', 3],
                    ['Meluangkan waktu yang dimiliki untuk mencoba firtur kompleks yang menarik dan terus digunakan.', 4],
                    ['Menyimpan waktu dan tenaga untuk mengoptimalkan kinerjanya menggunakan cara yang sudah dikuasai', 1],
                    ['Menyisihkan waktu dan tenaga untuk mempelajari fitur lebih kompleks berdasarkan testimoni teman-teman kerja', 2],
                    ['Menyisihkan waktu dan tenaga untuk mempelajari fitur yang lebih kompleks dan penting bagi pekerjaannya.', 5],
                ],
            ],
            [
                'text' => 'Rusdi adalah pegawai senior di suatu kementerian yang salah satu tugasnya adalah menginventarisasi barang-barang keperluan kantor. Atasan menawarkan Rusdi untuk mengerjakan secara manual, mencatat di buku besar, atau dengan menggunakan komputer. Apa tindakan Rusdi?',
                'options' => [
                    ['Berusaha belajar agar pekerjaannya terselesaikan dengan lebih cepat dan cermat.', 4],
                    ['Berusaha mempelajari komputer agar catatannya tersimpan dengan rapi.', 3],
                    ['Antusias mempelajari semua aplikasi yang digunakan oleh dirinya dan rekan-rekan lain bidang.', 5],
                    ['Memilih mengerjakan secara manual karena tugasnya tetap terselesaikan dengan baik', 2],
                    ['Berusaha belajar walaupan ia kurang cekatan dalam mengetik di komputer.', 1],
                ],
            ],
            [
                'text' => 'Ani diminta atasan untuk mengelola data peminjaman buku di perpustakaan dengan menggunakan sistem komputerisasi. Sebelumnya, ia menggunakan sistem pencatatan secara manual selama bertahun-tahun ia bekerja. Apa tindakan Ani?',
                'options' => [
                    ['Menggunakan aplikasi komputer sederhana yang ia kuasai untuk mengelola data peminjaman.', 3],
                    ['Meminta rekan satu unit untuk mengerjakan pengelolaan data peminjaman menggunakan aplikasi komputer.', 2],
                    ['Mempelajari aplikasi alternatif dan inovatif secara mandiri untuk mengembangkan prosedur kerja pemninjaman', 5],
                    ['Bekerja sama dengan penyedia layanan TI untuk membuat sistem aplikasi yang tepat.', 4],
                    ['Mengerjakannya secara manual karena memberikan rasa nyaman dan hasil kerja lebih rapi.', 1],
                ],
            ],
            [
                'text' => 'Akses data keuangan perusahaan harus menggunakan kata kunci. Anda adalah kepala divisi keuangan yang memiliki akses tersebut. Anda menyadari bahwa Anda orang yang pelupa, Apa yang Anda lakukan?',
                'options' => [
                    ['Menghentikan akses ke data keuangan dari perangkat pribadi agar tidak disalahkan ketika terjadi kebocoran data.', 2],
                    ['Membagikan kata kunci kepada beberapa bawahan untuk memudahahkan akses dan data kapan pun dapat diakses.', 1],
                    ['Meminta atasan untuk tidak memberikan akses data keuangan kepada Anda agar tidak disalahkan ketika terjadi kebocoran data.', 3],
                    ['Meminta perusahaan untuk menambah enkripsi data keuangan agar tidak mudah diakses sembarang orang.', 5],
                    ['Mengingatkan rekan kerja untuk menghindari penyimpanan kata kunci secara otomatis di perangkat komputer.', 4],
                ],
            ],
            [
                'text' => 'Joko menggunakan salah satu penyedia penyimpanan data kantor yang dilakukan secara online yang bisa diakses kapan pun dan di mana pun. Setelah sekian lama digunakan, ada kendala dalam penjagaan kerahasiaan data oleh penyedia. Bagaimana sebaiknya tindakan yang dilakukan Joko?',
                'options' => [
                    ['Tetap menggunakannya karena sudah banyak data yang tersimpan', 4],
                    ['Menghentikan penggunaannya demi keamanan data pribadi', 1],
                    ['Menghentikan penggunaannya demi keamanan pribadi dan kenyamanan orang lain.', 3],
                    ['Menghentikan dan merekomendasikan rekan kerja untuk tidak menggunakannya lagi', 2],
                    ['Melakukan pengamanan yang lebih ketat sebelum memakainya Kembali', 5],
                ],
            ],
            [
                'text' => 'Dito melakukan penyerangan secara tertulis dan terbuka pada salah satu anggota organisasi daring karena dirasakan sangat tidak kooperatif pada suatu program kerja. Sebelumnya, Dito telah merasa lelah mengingatkan secara personal. Apa yang seharusnya dilakukan Dito?',
                'options' => [
                    ['Menahan diri untuk tidak menyampaikan kritik tertulis dan terbuka karena dirinya juga dapat dirugikan.', 1],
                    ['Membiarkan dirinya meluapkan kekesalan secara tertulis dan terbuka agar betul-betul didengarkan.', 4],
                    ['Menghubungi pengelola organisasi secara personal untuk membuat regulasi yang dapat memantau ang gotanya.', 3],
                    ['Menyampaikan kritik secara etis sehingga menjadi pembelajaran bagi seluruh anggota organisasi', 5],
                    ['Menahan diri karena menyadari tindakannya dapat menimbulkan ketidaknyamanan secara keseluruhan', 2],
                ],
            ],
            [
                'text' => 'Anda merekomendasikan suatu teknologi pengelolaan pelatihan berbasis daring bagi seluruh karyawan. Namun, teknologi ini ditengarai berpotensi mengganggu sistem jaringan kantor. Apa yang Anda lakukan?',
                'options' => [
                    ['Segera menunda rencana penggunaan teknologi ini agar perangkat komputer saya tidak terganggu.', 2],
                    ['Menghentikan penggunaan teknologi ini karena saat uji coba perangkat komputer pribadi mengalami kerusakan.', 1],
                    ['Meyakini bahwa penggunaan teknologi ini dapat membawa manfaat besar bagi karyawan di perusahaan.', 3],
                    ['Merekomendasikan pada rekan kerja untuk mengevaluasi pemanfaatan teknologi baru agar tidak merugikan.', 4],
                    ['Mengkaji beberapa teknologi agar dapat memilih yang paling aman untuk menghindari kerugian perusahaan.', 5],
                ],
            ],
            [
                'text' => 'Tingkat hunian hotel tempat Agus bekerja terus menurun selama lima bulan terakhir akibat resesi. Ketika tingkat hunian hotel lain sudah mulai meningkat melalui penerapan program inovatif, Agus berpikir untuk segera bertindak. Agar hotelnya tidak terancam tutup, apa yang Agus lakukan?',
                'options' => [
                    ['Memikinkan program unik dan spesifik yang mungkin dapat dibayarkan oleh hotelnya.', 2],
                    ['Memodifikasi program inovatif yang telah berhasil di perusahaan lain untuk diterapkan di hotelnya', 5],
                    ['Melanjutkan kebiasaan yang sudah berjalan selama ini sambil berharap resesi segera berakhir.', 1],
                    ['Mengembangkan dan menguji model perhotelan gaya baru yang disesuaikan pada masa resesi', 4],
                    ['Merangsang munculnya kreasi baru dengan melibatkan karyawan dalam penggalian ide inovatif', 3],
                ],
            ],
            [
                'text' => 'Fani dan Yudi ada agenda unfuk memimpin rapat Kerja dalam tim. Sayangnya hari ini Yudi terlambat bangun Karena semalaman mempersiapkan materi. Saat buru-buru berangkat ke kantor tiba-tiba ban motor Yudi kempes. Bagaimana sebaiknya tindakan Yudi?',
                'options' => [
                    ['Mencari kendaraan alternatif agar dapat segera sampai di kantor untuk menghadiri rapat.', 4],
                    ['Segera meminta rekan untuk memulai rapat dan memutuskan naik taksi sambil memantau rapat melalui panggilan video.', 5],
                    ['Meminta rekan kerja yang dipercaya untuk mewvakilinya agar dapat menggantikan memimpin rapar', 2],
                    ['Langsung menuju tambal ban terdekat dan menambal ban yang kempes baru ke kantor.', 3],
                    ['Mengabari rekan satu tim bahwa akan terlambat sehingga tidak perlu menunggu untuk memulai rapat.', 1],
                ],
            ],
            [
                'text' => 'Mendadak Mirza harus menyerahkan analisis Keuangan perusahaan hari ini Padahal, ia tengah menyusun rekomendasi perubahan Kebijakan jam Kerja untuk rapat direksi esok hari. Apa hal terbaik yang dapat Mirza lakukan?',
                'options' => [
                    ['Mendahulukan penyelesaian analisis keuaran perusahaan lalu melanjutkan menyusun rekomendasi kebijakan sampai selesai.', 5],
                    ['Menyelesaikan penyusunan rekomendasi kebijakan sesuai dengan jadwal baru kemudian menyusun analisis keuangan sebisanya.', 4],
                    ['Menyelesaikan rekomendasi kebijakan lebih dahulu karena itu lebih disukainya jika dibandingkan dengan menyusun analisis keuangan.', 1],
                    ['Meminta bantuan staf ahli untuk menyusun draft analisis keuangan dan menambah anggota tim untuk menyusun rekomendasi kebijakan.', 2],
                    ['Meminta staf mengumpulkan data untuk analisis keuangan sambil meneruskan penyusunan rekomendasi kebijakan', 3],
                ],
            ],
            [
                'text' => 'Dua bulan lagi, Vina mengikuti lomba robotik nasional dan wajib mengumpulkan purwarupa kepada panitia paling lambat seminggu sebelumnya. la butuh waktu sebulan untuk persiapan. Bersamaan dengan itu, ia harus menyelesaikan tugas sebagai asisten penelitian. Apa tindakan yang diambil Vina?',
                'options' => [
                    ['Berkoordinasi dengan asisten penelitian yang lain untuk berbagi tugas.', 3],
                    ['Berkonsultasi dengan dosen pembimbing agar efektif menyelesaikan purwarupa.', 4],
                    ['Mengerjakan apa saja yang bisa dikerjakan saat ini sesuai dengan kemampuannya', 1],
                    ['Segera mulai mengerjakan purwarupa karena hal itu membutuhkan waktu lama.', 5],
                    ['Mendahulukan pembuatan purwarupa karena ia masih bersemangat.', 2],
                ],
            ],
            [
                'text' => 'Pekerjaan sehari-hari yang dilakukan Lindu adalah menjadi petugas operator mesin tenun di perusahaan. Hari ini salah satu teman karyawan Lindu tidak masuk dan tidak memberikan surat izin, padahal alat tenun harus tetap beroperasi setiap hari. Apa yang akan Lindu lakukan?',
                'options' => [
                    ['Membantu untuk mengoperasikan alat tenun jika diminta oleh supervisor perusahaan.', 2],
                    ['Membantu mengoperasikan alat tenun tersebut disela-sela tugas wajib yang dilakukan', 3],
                    ['Menelepon teman yang kebetulan tidak masuk untuk segera berangkat kerja.', 1],
                    ['Mendiskusikan kepada teman sekerja untuk bekerja sama mengoperasikan alat tenun.', 4],
                    ['Secara aktif membantu mengoperasikan mesin sambil meminta arahan supervisor.', 5],
                ],
            ],
            [
                'text' => 'Suki ditugaskan secepatnya untuk membuka cabang di pulau seberang. Sebagai pendatang di pulau, ia hanya mengetahui sedikit hal tentang lingkungan sekitar. Padahal penyiapan fasilitas kantor cabang perlu dukungan masyarakat setempat. Apa tindakan Suki?',
                'options' => [
                    ['Tinggal lebih awal di pulau untuk beradaptasi dengan lingkungan setempat.', 1],
                    ['Berkoordinasi dengan pemerintahan lokal untuk menyiapkan pembukaan kantor.', 5],
                    ['Menyiapkan \'orang dan struktur organisasi sesuai arahan kantor pusat.', 4],
                    ['Merekrut orang dan menyiapkan fasilitas mengikuti prosedur baku.', 3],
                    ['Mempunyai rencana awal yang siap berubah dengan melihat kondisi pulau.', 2],
                ],
            ],
            [
                'text' => 'Redi menjadi ketua tim kerja. Mulanya tim dapat bekerja efektif dan semua orang hadir. Namun, setelah pengerjaan tugas mandiri, beberapa orang sering tidak menghadiri diskusi. Ini membuat peran Redi kurang dipercaya sebagian anggota tim. Apa tindakan Redi?',
                'options' => [
                    ['Mengganti anggota tim dengan orang baru yang dapat dipercaya.', 1],
                    ['Memberikan masukan pada pekerjaan masing-masing untuk memotivasi tim.', 3],
                    ['Mendorong kerjasama tim dengan menunjukkan bagian hasil kerjanya.', 4],
                    ['Menekan anggota tim untuk menyelesaikan hasil masing-masing', 2],
                    ['Membuat tim lebih sering bertemu untuk bekerja sama dan memperbaiki kinerja', 5],
                ],
            ],
            [
                'text' => 'Jeni tidak terbiasa bergaul dengan orang lain yang berbeda status sosial dengan dirinya. Ketika kuliah, ia mulai bertemu dengan berbagai macam orang dan harus bekerja sama dengan mereka di dalam kelompok. Apa yang dilakukan oleh Jeni?',
                'options' => [
                    ['Belajar berinteraksi dengan berbagai macam golongan.', 4],
                    ['Menunjukkan sikap terbuka akan perbedaan dengan orang lain.', 5],
                    ['Berupaya melihat orang lain sama dengan dirinya.', 1],
                    ['Tidak membedakan teman meski berbeda status sosial.', 2],
                    ['Sadar bahwa dia harus mulai mencoba berinteraksi dengan berbagai golongan.', 3],
                ],
            ],
            [
                'text' => 'Terjadi perebutan sumber mata air antar-desa. Tiap desa merasa mereka lebih berhak atas sumber tersebut dan sekarang mereka saling menghalangi akses menuju mata air tersebut. Akibatnya kedua desa tersebut sama-sama tidak mendapatkan sumber air bersih. Bagaimana pandangan Anda sebagai warga salah satu desa?',
                'options' => [
                    ['Mendukung keputusan desa Anda dan mencari sumber mata air lain.', 4],
                    ['Mengetahui perebutan sumber air ini justru membawa masalah baru untuk kedua desa.', 1],
                    ['Ingin agar kedua desa segera mencari jalan keluar dan rukun seperti sedia kala.', 3],
                    ['Mengetahui bahwa jika tidak ada perebutan ini kedua desa masih tetap dapat menikmati air bersih', 2],
                    ['Menyampaikan  kepada warga desa untuk: bernegosiasi dalam rangka mencari jalan keluar bersama,', 5],
                ],
            ],
            [
                'text' => 'Fani adalah pegawai teladan di kantor yang sering mendapat pujian dari atasan. Namun, ia sering kali mengabaikan peraturan perusahaan demi mencapai target pekerjaannya. Apa yang Anda lakukan?',
                'options' => [
                    ['Merancang dialog yang melibatkan semua pegawai di kantor dalam rangka menegakkan aturan perusahaan.', 5],
                    ['Membuat program Khusus dalam rangka implementasi aturan perusahan bagi semua pegawai agar tidak melanggar aturan.', 4],
                    ['Berdiskusi dengan rekan kerja lain untuk menemukan cara agar Fani tidak melanggar aturan, tetapi tetap menjadi teladan.', 3],
                    ['Mencari informasi tentang penyebab mengapa Fani mengabaikan peraturan yang ada', 2],
                    ['Tetap diam dan tidak ingin terlibat dalam masalah', 1],
                ],
            ],
            [
                'text' => 'Anda ditugaskan memimpin sebuah tim kerja yang anggotanya terdiri atas beberapa etnis. Ada beberapa kebiasaan yang berbeda di antara anggota tim sehingga kinerja tim menjadi kurang optimal dan target tim Anda menjadi sulit tercapai. Apa yang sebaiknya dilakukan?',
                'options' => [
                    ['Saya menganggap perbedaan adalah sesuatu yang wajar dan harus dihargai, tetapi kinerja tim harus tetap optimal.', 2],
                    ['Perbedaan adalah sebuah anugerah. Tim harus tetap bekerja, meskipun hasilnya tidak optimal.', 1],
                    ['Saya akan dengarkan aspirasi setiap kelompok yang ada, kemudian melaporkan situasi tersebut kepada atasan.', 4],
                    ['Saya akan laporkan situasi tersebut kepada pimpinan dan mendiskusikannya bersama untuk mengatasi perbedaan tersebut.', 3],
                    ['Saya akan berdiskusi dengan mereka secara intensif untuk menemukan titik temu yang saling menguntungkan.', 5],
                ],
            ],
            [
                'text' => 'Teguh adalah seorang pegawai kantor pusat di Jakarta. la dipindahkan ke kantor cabang dan menemukan kesulitan untuk bergaul dengan pegawai yang lain karena lingkungan kerja yang terkotak-kotak. Apa yang seharusnya dilakukan Teguh?',
                'options' => [
                    ['Menjalankan aktivitas yang sama seperti yang dilakukannya di kantor pusat.', 1],
                    ['Mencari informasi terkait kondisi kantor sebenarnya.', 3],
                    ['Berdiskusi dengan rekan kerja terkait kondisi lingkungan kerja.', 4],
                    ['Berupaya menghilangkan setiap sekat yang ada di antara pegawai.', 5],
                    ['Menggelar acara kantor yang menghadirkan semua pegawai dan meminta mereka untuk saling terbuka di sana.', 2],
                ],
            ],
            [
                'text' => 'Putra merupakan Seorang ketua RW di Desa Sukamajaya. Di wilayahnya terdapat dua aliran keagamaan yang sering berkonflik. Apa tindakan Putra?',
                'options' => [
                    ['Mengajak aparat wilayah dan ketua masing masing aliran untuk berdiskusi.', 4],
                    ['Mendukung salah satu yang menurut Putra paling tepat.', 1],
                    ['Memberikan alternatif baru kepada kedua belah pihak agar tidak berselisih.', 3],
                    ['Membiarkan konflik tersebut selesai dengan sendirinya.', 2],
                    ['Bermusyawarah dengan pimpinan kedua belah pihak untuk menemukan jalan keluar', 5],
                ],
            ],
            [
                'text' => 'Warga di perumahan Ali saat ini sedang merasa ketakutan karena kabarnya sekelompok orang sedang melakukan penyisiran kepada warga dengan etnis tertentu. Beberapa warga sudah menghubungi Ali sebagai ketua RT untuk meminta perlindungan. Bagaimana tindakan Ali dalam menghadapi situasi ini?',
                'options' => [
                    ['Menyampeikan ke warga mengenai kabar tersebut dan meminta mereka bersiap-siap', 2],
                    ['Melacak sumber berita dan memastikan kebenarannya', 4],
                    ['Meminta warga tenang dan mencari kebenaran berita tersebut dari berbagai sumber terpercaya', 5],
                    ['Mengumpulkan informasi dari berbagai sumber yang terpercaya', 3],
                    ['Bersikap tenang meskipun meyakini bahwa berita itu benar adanva', 1],
                ],
            ],
            [
                'text' => 'Wati dan anak perempuannya bekerja di tempat yang sama. Wati selalu memberikan tugas mudah untuk anaknya sehingga menimbulkan kecemburuan di kantor Beberapa pegawai mendesak Anda untuk menegur atau memberi sanksi. Sebagai atasan Wati, apa yang akan Anda lakukan?',
                'options' => [
                    ['Segera merespon keluhan saat itu juga dan menegur Wati', 3],
                    ['Memanggil dan memberikan teguran keras kepada Wati', 2],
                    ['Menerima keluhan dan menenangkan karyawan lain', 4],
                    ['Menyusun rencana menyelesaikan persoalan ini', 1],
                    ['Memberikan alternatif menyelesaikan masalah ini dengan damai', 5],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => $q['text'],
                'image' => null,
                'explanation' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $order = 1;
            foreach ($q['options'] as $opt) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $opt[0],
                    'is_correct' => 0,
                    'image' => null,
                    'order' => $order++,
                    'weight' => $opt[1],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('TKP Paket 4 seeder selesai: ' . count($questions) . ' soal + opsi.');
    }
}
