<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder soal TKP - Try Out SKD AGUSTUS (Satya Naratama)
 *
 * Total soal : 45 (nomor 1 - 45)
 * Material   : id = 6
 * Test type  : tkp
 *
 * Catatan:
 * - TKP tidak menggunakan is_correct (semua false), penilaian memakai kolom weight (bobot 1-5).
 * - Urutan opsi (order 1-5) mengikuti urutan A-B-C-D-E pada naskah soal,
 *   dan bobotnya diambil persis dari tabel kunci bobot pada berkas pembahasan.
 */
class TKPTOAGUSTUSSeeder extends Seeder
{
    public function run(): void
    {
        $now        = Carbon::now();
        $materialId = 6;

        $questions = [
            // ================= Soal 1 (Pelayanan Publik) | bobot A-E: 53214 =================
            [
                'question_text' => 'Anda merupakan seorang front office di sebuah perusahaan di instansi pemerintah. Tugas anda adalah melayani setiap tamu yang datang ke instansi pemerintah tempat anda mengabdi. Suatu hari anda kedatangan seorang tamu dan ingin bertemu dengan pimpinan anda untuk suatu urusan yang harus diputuskan pada saat itu juga. Sedangkan pimpinan anda baru saja pagi tadi harus keluar kota untuk urusan lain yang juga tidak bisa ditinggalkannya. Tamu tersebut terus mendesak anda untuk mencoba menghubungi atasan anda tapi setelah beberapa kali anda coba, nomer atasan anda tetap tidak dapat dihubungi, kemudian tamu tersebut meminta anda memberikan keputusan sikap anda...',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 53214</strong> &rarr; A=5, B=3, C=2, D=1, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: berinisiatif mengambil keputusan namun tetap berada dalam koridor kebijakan perusahaan &mdash; solusi paling tepat dan aman</li><li><strong>Bobot 4</strong> &mdash; opsi E: sudah berinisiatif, tetapi bersandar pada asumsi atasan akan memaklumi, bukan pada kebijakan yang berlaku</li><li><strong>Bobot 3</strong> &mdash; opsi B: tidak berinisiatif, namun masih memberi kepastian waktu kepada tamu</li><li><strong>Bobot 2</strong> &mdash; opsi C: ragu-ragu sehingga tidak menghasilkan keputusan maupun solusi bagi tamu</li><li><strong>Bobot 1</strong> &mdash; opsi D: menunda-nunda adalah sikap paling tidak produktif dan merugikan pelayanan</li>',
                'options'       => [
                    ['text' => 'Mengambil keputusan tanpa petunjuk atasan selama tidak bertentangan dengan kebijakan yang ada diperusahaan', 'weight' => 5], // A
                    ['text' => 'Tidak berani mengambil keputusan tanpa petunjuk atasan saya, dan meminta tamu tersebut datang besok', 'weight' => 3], // B
                    ['text' => 'Ragu - ragu dalam mengambil keputusan tanpa petunjuk atasan saya, karena takut melakukan kesalahan', 'weight' => 2], // C
                    ['text' => 'Menunda - nunda pengambilan keputusan tanpa petunjuk atasan saya karena takut melakukan kesalahan', 'weight' => 1], // D
                    ['text' => 'Mengambil keputusan tanpa petunjuk atasan karena sangat mendesak atasan pasti memakluminya asal benar', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 2 (Sosial Budaya) | bobot A-E: 54321 =================
            [
                'question_text' => 'Anda ditugasi dosen untuk melakukan observasi di suatu lokasi. Di lokasi tersebut terdapat air terjun yang belum termanfaatkan dengan baik. Akses ke tempat tersebut cukup sulit. Perekonomian masyarakat setempat hanya bergantung pada ladang seadanya. Isi dalam laporan observasi tersebut Anda akan mengupayakan...',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 54321</strong> &rarr; A=5, B=4, C=3, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: memanfaatkan potensi terbesar lokasi sekaligus langsung menjawab masalah perekonomian masyarakat</li><li><strong>Bobot 4</strong> &mdash; opsi B: membuka akses adalah langkah pendukung yang penting, tetapi belum menyentuh masalah ekonomi secara langsung</li><li><strong>Bobot 3</strong> &mdash; opsi C: bermanfaat bagi ladang penduduk, namun potensi lokasi belum dioptimalkan</li><li><strong>Bobot 2</strong> &mdash; opsi D: tidak relevan dengan potensi air terjun dan berdampak jangka sangat panjang</li><li><strong>Bobot 1</strong> &mdash; opsi E: sikap pesimistis dan mematikan potensi daerah &mdash; paling tidak tepat</li>',
                'options'       => [
                    ['text' => 'Menjadikan lokasi tersebut sebagai tempat wisata agar perekonomian penduduk bisa membaik', 'weight' => 5], // A
                    ['text' => 'Membuat jalan agar pejalan kaki dapat dengan mudah menuju air terjun', 'weight' => 4], // B
                    ['text' => 'Menjadikan air terjun sebagai sarana irigasi bagi masyarakat', 'weight' => 3], // C
                    ['text' => 'Menanam pohon agar lokasi tersebut bisa menjadi hutan industri', 'weight' => 2], // D
                    ['text' => 'Mengusulkan untuk menutup lokasi tersebut karena tidak akan berkembang', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 3 (Profesionalisme) | bobot A-E: 53412 =================
            [
                'question_text' => 'Saya menyukai tantangan dan hal-hal baru berkaitan dengan pekerjaan saya. Hal yang harus saya lakukan adalah...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 53412</strong> &rarr; A=5, B=3, C=4, D=1, E=2</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: inisiatif belajar mandiri yang konsisten dan dapat dilakukan kapan saja tanpa bergantung pihak lain</li><li><strong>Bobot 4</strong> &mdash; opsi C: proaktif belajar dari sumber yang kompeten, meski masih bergantung pada kesediaan orang lain</li><li><strong>Bobot 3</strong> &mdash; opsi B: menambah wawasan, namun bergantung pada ketersediaan jadwal dan biaya kegiatan</li><li><strong>Bobot 2</strong> &mdash; opsi E: bermanfaat, tetapi kedalaman informasinya terbatas pada tingkat pengetahuan rekan sejawat</li><li><strong>Bobot 1</strong> &mdash; opsi D: tidak fokus pada pengembangan kompetensi kerja dan mengurangi produktivitas</li>',
                'options'       => [
                    ['text' => 'Selalu meluangkan waktu untuk belajar informasi terbaru baik dari buku maupun internet', 'weight' => 5], // A
                    ['text' => 'Selalu mengikuti seminar dan workshop yang berkaitan dengan pekerjaan saya', 'weight' => 3], // B
                    ['text' => 'Selalu bertanya kepada orang yang lebih ahli dalam bidang pekerjaan yang saya geluti', 'weight' => 4], // C
                    ['text' => 'Menghabiskan waktu di kantor untuk membaca koran dan majalah', 'weight' => 1], // D
                    ['text' => 'Banyak berdiskusi tentang informasi terbaru dengan teman sejawat', 'weight' => 2], // E
                ],
            ],
            // ================= Soal 4 (Profesionalisme) | bobot A-E: 54321 =================
            [
                'question_text' => 'Dalam suatu kejadian kecelakaan kapal laut yang sangat parah karena memakan banyak korban jiwa, ternyata anda menjadi satu-satunya korban yang berhasil selamat dari kecelakaan itu dengan luka trauma dan fisik yang cukup parah. Setelah beberapa bulan, anda berhasil sembuh secara fisik namun meninggalkan bekas trauma psikis yang mendalam. Lalu, anda sebagai ASN diberikan sebuah tugas penting keluar daerah yang di mana hanya bisa dilalui dengan naik kapal laut. Apa yang anda lakukan?',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 54321</strong> &rarr; A=5, B=4, C=3, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: menerima tugas dengan tanggung jawab penuh dan hati yang tulus &mdash; berhasil mengatasi trauma demi profesionalisme</li><li><strong>Bobot 4</strong> &mdash; opsi B: menuntaskan tugas dengan berpegang pada jati diri sebagai ASN</li><li><strong>Bobot 3</strong> &mdash; opsi C: menerima tugas, namun motivasinya sebatas tidak menolak perintah</li><li><strong>Bobot 2</strong> &mdash; opsi D: semangat, tetapi menonjolkan kesiapan menanggung risiko, bukan penyelesaian tugas</li><li><strong>Bobot 1</strong> &mdash; opsi E: sekadar menuruti perintah &mdash; motivasi paling rendah dan bukan dorongan dari dalam diri</li>',
                'options'       => [
                    ['text' => 'Menyelesaikan tugas dengan penuh tanggungjawab dan dengan sepenuh hati', 'weight' => 5], // A
                    ['text' => 'Menyelesaikan tugas dan tetap berpegang teguh menjadi seorang ASN', 'weight' => 4], // B
                    ['text' => 'Tidak akan menolak karena merupakan amanah yang diberikan atasan', 'weight' => 3], // C
                    ['text' => 'Menerima tugas dengan penuh semangat dan siap dengan segala resiko yang akan dihadapi', 'weight' => 2], // D
                    ['text' => 'Tetap menuruti perintah atasan sembari mempersiapkan segala hal yang diperlukan saat dinas nanti', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 5 (Jejaring Kerja) | bobot A-E: 34521 =================
            [
                'question_text' => 'Ketika saya mendapat tugas menjadi panitia sebuah kegiatan sekolah, saya akan menggalang dana dengan cara...',
                'explanation'   => '<p><strong>Aspek: Jejaring Kerja</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 34521</strong> &rarr; A=3, B=4, C=5, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: cara paling profesional, resmi, dan terdokumentasi &mdash; peluang keberhasilannya paling besar</li><li><strong>Bobot 4</strong> &mdash; opsi B: membangun jejaring baru untuk mendukung kegiatan</li><li><strong>Bobot 3</strong> &mdash; opsi A: melibatkan tim, namun belum ada mekanisme yang jelas dan terukur</li><li><strong>Bobot 2</strong> &mdash; opsi D: mengandalkan relasi pribadi sehingga jangkauannya terbatas</li><li><strong>Bobot 1</strong> &mdash; opsi E: membebani pihak lain dan bukan bentuk penggalangan dana yang profesional</li>',
                'options'       => [
                    ['text' => 'Menggerakkan teman-teman untuk mencari dana', 'weight' => 3], // A
                    ['text' => 'Mencari sponsor yang mendukung keberhasilan', 'weight' => 4], // B
                    ['text' => 'Mengajukan proposal kegiatan sekolah', 'weight' => 5], // C
                    ['text' => 'Menghubungi sponsor yang sudah saya kenal', 'weight' => 2], // D
                    ['text' => 'Meminta sumbangan kepada orangtua', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 6 (Sosial Budaya) | bobot A-E: 45321 =================
            [
                'question_text' => 'Dalam dunia kerja, Anda akan bertemu dengan orang-orang dari latar belakang yang berbeda. Terkadang ada orang yang cuek dan tidak mau tau, ada juga yang sangat aktif mengkritik dan menyuarakan pendapatnya terhadap anda, sikap anda&hellip;',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 45321</strong> &rarr; A=4, B=5, C=3, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: kritik diubah menjadi bahan perbaikan diri &mdash; sikap paling positif dan produktif</li><li><strong>Bobot 4</strong> &mdash; opsi A: terbuka menerima kritik, meskipun belum ada tindak lanjut yang konkret</li><li><strong>Bobot 3</strong> &mdash; opsi C: melakukan evaluasi diri, namun belum tentu berujung pada perbaikan nyata</li><li><strong>Bobot 2</strong> &mdash; opsi D: sebatas berusaha menerima, bersifat pasif</li><li><strong>Bobot 1</strong> &mdash; opsi E: tidak menjawab persoalan kritik itu sendiri</li>',
                'options'       => [
                    ['text' => 'Bersifat terbuka terhadap kritik atau masukkan', 'weight' => 4], // A
                    ['text' => 'Menjadikan kritikan sebagai masukan yang membangun agar Anda bisa menjadi pribadi yang lebih baik lagi.', 'weight' => 5], // B
                    ['text' => 'Saya jadikan kritikan sebagai bahan evaluasi diri', 'weight' => 3], // C
                    ['text' => 'Berusaha menerima setiap kritikan yang dilontarkan untuk anda', 'weight' => 2], // D
                    ['text' => 'Memahami karakter setiap orang yang anda temui', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 7 (Sosial Budaya) | bobot A-E: 32415 =================
            [
                'question_text' => 'Setelah bekerja kelompok 2 hari untuk menyelesaikan laporan tugas kuliah, laporan tersebut kemudian dibawa teman anda, setelah dibawa teman anda ternyata tanpa diketahui teman anda laporan tersebut dicoret-coret oleh adiknya sehingga laporan tersebut menjadi kotor, sikap anda ...',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 32415</strong> &rarr; A=3, B=2, C=4, D=1, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: menerima kejadian di luar kendali dengan lapang dada sekaligus memberi pembelajaran &mdash; sikap paling matang</li><li><strong>Bobot 4</strong> &mdash; opsi C: menyampaikan ketidakpuasan secara langsung sehingga persoalan terbuka, meskipun caranya kurang santun</li><li><strong>Bobot 3</strong> &mdash; opsi A: menyampaikan masalah dan menuntut perbaikan, namun membebankan seluruhnya kepada teman</li><li><strong>Bobot 2</strong> &mdash; opsi B: memendam kekecewaan sehingga masalah tidak terselesaikan</li><li><strong>Bobot 1</strong> &mdash; opsi D: mendiamkan orang lain adalah reaksi paling tidak dewasa dan merusak hubungan kerja</li>',
                'options'       => [
                    ['text' => 'Mengatakan dan memintanya menulis kembali laporan tersebut', 'weight' => 3], // A
                    ['text' => 'Diam saja meskipun sebenarnya saya kecewa', 'weight' => 2], // B
                    ['text' => 'Memarahi dia atas ketidakpeduliannya', 'weight' => 4], // C
                    ['text' => 'Tidak mengajaknya bicara sampai dia merasa bersalah', 'weight' => 1], // D
                    ['text' => 'Menerimanya dengan lapang dada dan memintanya untuk lebih berhati-hati ketika menyimpan laporan penting', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 8 (Profesionalisme) | bobot A-E: 12354 =================
            [
                'question_text' => 'Banyak karyawan dari perusahaan yang anda pimpin tiba-tiba mengundurkan diri, di antaranya merupakan karyawan yang berprestasi dan berkinerja baik. Anda mengetahui jika kebanyakan alasan pengunduran diri karyawan tersebut adalah karena perusahaan tidak memberi kesempatan pada karyawannya untuk mengembangkan diri, di sisi lain keuangan perusahaan sedang tidak memungkinkan untuk hal tersebut, sedangkan jika hal ini terus dibiarkan akan berdampak buruk dan merugikan perusahaan anda karena kehilangan SDM yang bagus, sikap anda&hellip;',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12354</strong> &rarr; A=1, B=2, C=3, D=5, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: solusi paling tepat &mdash; kebutuhan pengembangan diri terpenuhi tanpa membebani keuangan perusahaan</li><li><strong>Bobot 4</strong> &mdash; opsi E: menyoroti akar masalah pada level kebijakan, meskipun belum menjadi tindakan nyata dari diri sendiri</li><li><strong>Bobot 3</strong> &mdash; opsi C: memahami keterbatasan, namun bersikap pasrah tanpa mencari jalan keluar</li><li><strong>Bobot 2</strong> &mdash; opsi B: sama-sama berbiaya tinggi sehingga tidak realistis dengan kondisi saat ini</li><li><strong>Bobot 1</strong> &mdash; opsi A: mengabaikan kendala utama, yaitu kondisi keuangan perusahaan yang sedang tidak memungkinkan</li>',
                'options'       => [
                    ['text' => 'Memberikan karyawan kesempatan untuk mengembangkan diri dengan cara mengikutkan seminar', 'weight' => 1], // A
                    ['text' => 'Memberikan karyawan kesempatan pengembangan diri dengan mengikutkan pelatihan', 'weight' => 2], // B
                    ['text' => 'Semua perusahaan ingin karyawannya berkembang tapi karena kondisi keuangan perusahaan sedang tidak mendukung hal ini tidak terhindarkan', 'weight' => 3], // C
                    ['text' => 'Pimpinan sendiri harus memberikan pembekalan tersebut agar karyawan bisa mengembangkan dirinya ke arah yang lebih baik.', 'weight' => 5], // D
                    ['text' => 'Pemilik perusahaan harusnya lebih peka terhadap karyawan dan memfasilitasi pengembangan diri mereka', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 9 (Pelayanan Publik) | bobot A-E: 12345 =================
            [
                'question_text' => 'Dalam suatu pelatihan kepegawaian yang Saya ikuti, ada gerakan 3S, yaitu Senyum, Sapa, dan Salam yang harus diterapkan di seluruh bagian instansi. Saat ini, Saya ditempatkan di bagian front office yang merupakan bagian terdepan di instansi tempat Saya bekerja. Sikap saya setelah pelatihan kepegawaian tersebut adalah...',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12345</strong> &rarr; A=1, B=2, C=3, D=4, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: sesuai kunci jawaban paket ini &mdash; menerapkan hasil pelatihan sekaligus menjaga keseragaman standar layanan antarbagian</li><li><strong>Bobot 4</strong> &mdash; opsi D: menerapkan hasil pelatihan sesuai yang diajarkan</li><li><strong>Bobot 3</strong> &mdash; opsi C: hanya bersifat simbolis, tidak diwujudkan dalam perilaku</li><li><strong>Bobot 2</strong> &mdash; opsi B: menunda penerapan dengan alasan kesiapan pribadi</li><li><strong>Bobot 1</strong> &mdash; opsi A: menolak menerapkan hasil pelatihan sama sekali &mdash; sikap paling tidak tepat</li>',
                'options'       => [
                    ['text' => 'Melakukan seperti yang saya lakukan setiap hari karena khawatir gerakan 3S akan tampak memalukan bagi saya', 'weight' => 1], // A
                    ['text' => 'Saya akan mulai gerakan 3S hanya jika Saya sudah siap', 'weight' => 2], // B
                    ['text' => 'Cukup dengan memasang poster yang bertuliskan gerakan 3S dan artinya, itu sudah membuat semua orang memahami bahwa Saya sudah melakukan anjuran pelatihan tersebut', 'weight' => 3], // C
                    ['text' => 'Menerapkan gerakan 3S seperti yang diajarkan di pelatihan', 'weight' => 4], // D
                    ['text' => 'Menerapkan gerakan 3S seperti yang diajarkan di pelatihan hanya pada saat awal bekerja saja biar seragam dengan bagian lainnya', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 10 (Anti Radikalisme / Integritas) | bobot A-E: 14532 =================
            [
                'question_text' => 'Suatu hari anda akan mengadakan audit ke sebuah sekolah yang lokasinya cukup jauh dan hanya bisa ditempuh dengan perjalanan darat. Di tengah perjalanan mobil yang anda bawa mengalami kecelakaan padahal mobil tersebut adalah mobil pinjaman. Untuk memperbaiki mobil tersebut anda harus mengeluarkan uang sangat banyak. Setelah mobil di servis setelah menunggu 3 jam, anda kembali melanjutkan perjalanan. Ketika akan pulang kepala sekolah memberikan sejumlah uang, maka&hellip;',
                'explanation'   => '<p><strong>Aspek: Anti Radikalisme / Integritas</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 14532</strong> &rarr; A=1, B=4, C=5, D=3, E=2</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: menolak atas dasar kesadaran dan pemahaman sendiri bahwa pemberian tersebut adalah gratifikasi &mdash; integritas tertinggi</li><li><strong>Bobot 4</strong> &mdash; opsi B: menolak pemberian dengan cara yang tegas sekaligus menjaga perasaan pemberi</li><li><strong>Bobot 3</strong> &mdash; opsi D: menolak, namun dorongannya berasal dari perintah atasan, bukan kesadaran diri</li><li><strong>Bobot 2</strong> &mdash; opsi E: menolak tetapi dengan cara emosional yang merusak hubungan kerja</li><li><strong>Bobot 1</strong> &mdash; opsi A: menerima gratifikasi secara sembunyi-sembunyi &mdash; pelanggaran integritas paling berat</li>',
                'options'       => [
                    ['text' => 'Menerima uang transport tersebut jika tidak diketahui oleh rekan tim yang lainnya', 'weight' => 1], // A
                    ['text' => 'Mengembalikan uang transport secara tegas dan halus', 'weight' => 4], // B
                    ['text' => 'Menolak karena kamu tahu itu bentuk gratifikasi', 'weight' => 5], // C
                    ['text' => 'Menolak karena disuruh atasan untuk bekerja dengan jujur dan bebas KKN', 'weight' => 3], // D
                    ['text' => 'Marah karena kepala sekolah telah berusaha untuk menyogok', 'weight' => 2], // E
                ],
            ],
            // ================= Soal 11 (Anti Radikalisme / Integritas) | bobot A-E: 21435 =================
            [
                'question_text' => 'Kamu adalah seorang ASN di dinas perencanaan daerah. Di daerah kamu sedang ada rencana pembangunan kampus yang dibiayai oleh daerah. Dalam sebuah rapat perencanaan tender, ternyata atasan kamu memerintahkan untuk memenangkan salah satu pihak ketiga untuk membangun bangunan kampus tersebut tanpa melalui tahap semestinya. Apa tindakan kamu menghadapi atasanmu...',
                'explanation'   => '<p><strong>Aspek: Anti Radikalisme / Integritas</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 21435</strong> &rarr; A=2, B=1, C=4, D=3, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: menyampaikan penolakan langsung di forum resmi sehingga pelanggaran dapat dicegah &mdash; keberanian dan integritas tertinggi</li><li><strong>Bobot 4</strong> &mdash; opsi C: menegur dengan cara yang menjaga wibawa atasan, meskipun belum melindungi forum rapat</li><li><strong>Bobot 3</strong> &mdash; opsi D: menjaga diri sendiri, tetapi tidak mencegah pelanggaran tetap berjalan</li><li><strong>Bobot 2</strong> &mdash; opsi A: membiarkan pelanggaran terjadi karena takut menentang atasan</li><li><strong>Bobot 1</strong> &mdash; opsi B: ikut menyetujui pelanggaran &mdash; sikap paling buruk</li>',
                'options'       => [
                    ['text' => 'Diam saja, karena tidak mau untuk menentang perintah atasan', 'weight' => 2], // A
                    ['text' => 'Diam dan setuju dengan apa yang disampaikan atasan', 'weight' => 1], // B
                    ['text' => 'Mengajak atasan berbicara secara pribadi mengenai aturan pengadaan tender', 'weight' => 4], // C
                    ['text' => 'Tidak mau terlibat dalam penyalahgunaan wewenang tersebut.', 'weight' => 3], // D
                    ['text' => 'Berpendapat dalam rapat, dengan keras menolak rencana atasan tersebut.', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 12 (Sosial Budaya) | bobot A-E: 35124 =================
            [
                'question_text' => 'Baru-baru ini kita dihadapkan pada propaganda tentang sebutan &ldquo;Wisata Halal&rdquo;, jika dilihat dari cara pandang orang bijaksana, sebenarnya hal ini adalah masalah penggunaan bahasa yang mengundang kontradiksi. Pemakaian kata atau julukan wisata halal membuat banyak kita berfikiran, berarti selama ini wisatanya itu adalah haram. Nah sebenarnya yang dimaksudkan adalah, untuk mengundang wisata dari berbagai negara, agama, dan budaya supaya mau berkunjung, kita harus menyediakan fasilitas yang memang paling dibutuhkan oleh masing-masing agama tersebut. Contohnya islam, mereka pasti memikirkan makanan dan tempat beribadah yang memadai di wisata tersebut, bukan mengganti seluruh kebiasaan di sana menjadi bernuansa Islam. Bagaimana pandangan anda?',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 35124</strong> &rarr; A=3, B=5, C=1, D=2, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: mengedepankan musyawarah dengan seluruh pemangku kepentingan &mdash; paling menghargai kebinekaan</li><li><strong>Bobot 4</strong> &mdash; opsi E: menunjukkan sikap toleran pribadi yang nyata, meski belum melibatkan pihak lain</li><li><strong>Bobot 3</strong> &mdash; opsi A: solusi tepat sasaran, namun mengambil keputusan sepihak tanpa melibatkan masyarakat setempat</li><li><strong>Bobot 2</strong> &mdash; opsi D: sikap netral yang tidak memberikan kontribusi terhadap penyelesaian masalah</li><li><strong>Bobot 1</strong> &mdash; opsi C: menolak berdasarkan mayoritas &mdash; bertentangan dengan nilai toleransi</li>',
                'options'       => [
                    ['text' => 'Harusnya pemerintah langsung memfasilitasi tempat untuk beribadah mereka di lingkungan wisata tersebut.', 'weight' => 3], // A
                    ['text' => 'Harusnya pemerintah mendiskusikan masalah ini dengan masyarakat sekitar tempat wisata untuk mencari solusi yang tepat atas permasalahan tersebut', 'weight' => 5], // B
                    ['text' => 'Karena mayoritas masyarakat adalah non-muslim, tidak dibenarkan membuat hal atau program seperti itu', 'weight' => 1], // C
                    ['text' => 'Tidak ada masalah dengan sebutan wisata halal bagi saya pribadi', 'weight' => 2], // D
                    ['text' => 'Jika saya menjadi masyarakat di wisata tersebut, saya akan toleran dan menyediakan fasilitas ibadah bagi umat islam.', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 13 (Pelayanan Publik) | bobot A-E: 23451 =================
            [
                'question_text' => 'Beberapa hari terakhir ini di kantor anda sedang disibukkan dengan banyaknya deadline pekerjaan yang harus diselesaikan secepatnya, sehingga setiap komponen perusahaan diminta untuk memberikan kemampuan terbaiknya bagi perusahaan, karena jika ada pekerjaan yang tertunda akan berpengaruh terhadap produktivitas kerja. Namun ada beberapa karyawan yang datang kepada anda bercerita dan mengeluhkan beberapa hal yang tidak berkaitan dengan pekerjaan, sikap anda&hellip;',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 23451</strong> &rarr; A=2, B=3, C=4, D=5, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: menyeimbangkan kepedulian pada rekan kerja dengan prioritas pekerjaan &mdash; paling proporsional</li><li><strong>Bobot 4</strong> &mdash; opsi C: sangat peduli, tetapi berpotensi menyita waktu di tengah tenggat yang ketat</li><li><strong>Bobot 3</strong> &mdash; opsi B: menjaga produktivitas, namun mengabaikan sisi kepedulian terhadap rekan kerja</li><li><strong>Bobot 2</strong> &mdash; opsi A: terlalu longgar sehingga mengorbankan target pekerjaan yang sedang mendesak</li><li><strong>Bobot 1</strong> &mdash; opsi E: sepenuhnya mengabaikan tuntutan pekerjaan yang sedang mendesak</li>',
                'options'       => [
                    ['text' => 'Saya selalu terbuka terhadap setiap karyawan untuk berkeluh kesah kapanpun mereka membutuhkannya', 'weight' => 2], // A
                    ['text' => 'Hal tersebut harus dibatasi karena dapat mengganggu kinerja perusahaan', 'weight' => 3], // B
                    ['text' => 'Selalu bersimpati dan memberikan nasehat dan solusi yang paling baik terhadap setiap masalah mereka', 'weight' => 4], // C
                    ['text' => 'Bersimpati dan memberikan solusi dan nasehat dengan tetap memprioritaskan kepentingan perusahaan', 'weight' => 5], // D
                    ['text' => 'Saya akan selalu baik kepada setiap karyawan di perusahaan dan dapat menjadi teman curhat mereka setiap waktu', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 14 (Pelayanan Publik) | bobot A-E: 43152 =================
            [
                'question_text' => 'Ketika anda sedang mengambil beberapa dokumen di meja CS, tiba-tiba datang seorang pelanggan yang marah pada anda karena pelayanan yang kurang baik bahkan sampai mencaci anda, yang anda lakukan?',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 43152</strong> &rarr; A=4, B=3, C=1, D=5, E=2</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: meredakan emosi pelanggan dengan permintaan maaf sekaligus menggali akar keluhan &mdash; standar pelayanan terbaik</li><li><strong>Bobot 4</strong> &mdash; opsi A: mampu mengendalikan emosi dan tetap melayani sesuai tugas</li><li><strong>Bobot 3</strong> &mdash; opsi B: sikap ramah dan mau mendengar, namun belum ada permintaan maaf sebagai pengakuan atas ketidaknyamanan</li><li><strong>Bobot 2</strong> &mdash; opsi E: sebatas menahan diri, fokusnya masih pada emosi pribadi</li><li><strong>Bobot 1</strong> &mdash; opsi C: menggurui pelanggan yang sedang marah justru memperkeruh keadaan</li>',
                'options'       => [
                    ['text' => 'Menahan emosi dan menjawab pertanyaannya karena sudah tugas saya melayani', 'weight' => 4], // A
                    ['text' => 'Tetap tersenyum dan mendengarkan keluhannya.', 'weight' => 3], // B
                    ['text' => 'Menasehatinya agar tidak boleh berkata kasar', 'weight' => 1], // C
                    ['text' => 'Meminta maaf dan mendengarkan keluhannya.', 'weight' => 5], // D
                    ['text' => 'Berusaha tidak marah meskipun dicaci dan tetap melayani keluhannya', 'weight' => 2], // E
                ],
            ],
            // ================= Soal 15 (Sosial Budaya) | bobot A-E: 43521 =================
            [
                'question_text' => 'Sebuah perusahaan harusnya juga peka terhadap kebutuhan karyawannya. Jangan hanya menuntut untuk bekerja cepat dan tepat, tapi juga mengerti permasalahan dari karyawan. Contohnya saja seperti isu keluarga atau keuangan bisa saja mengganggu konsentrasi karyawan dalam bekerja sehingga membuat kinerjanya menurun, harusnya&hellip;',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 43521</strong> &rarr; A=4, B=3, C=5, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: solusi struktural yang berkelanjutan, adil bagi semua karyawan, dan tidak menggerus keuangan perusahaan</li><li><strong>Bobot 4</strong> &mdash; opsi A: meringankan beban karyawan secara langsung, namun membebani keuangan perusahaan secara permanen</li><li><strong>Bobot 3</strong> &mdash; opsi B: memotivasi, tetapi tidak menjangkau karyawan yang sedang bermasalah</li><li><strong>Bobot 2</strong> &mdash; opsi D: bersifat pribadi dan tidak dapat diandalkan sebagai kebijakan</li><li><strong>Bobot 1</strong> &mdash; opsi E: berpotensi mengganggu fokus kerja dan menimbulkan konflik kepentingan</li>',
                'options'       => [
                    ['text' => 'Perusahaan bisa memberikan gaji yang lebih besar kepada karyawan', 'weight' => 4], // A
                    ['text' => 'Memberikan bonus pada karyawan yang berkinerja bagus', 'weight' => 3], // B
                    ['text' => 'Membuat kebijakan baru berupa pinjaman karyawan.', 'weight' => 5], // C
                    ['text' => 'Meminta setiap pimpinan divisi mau membantu bawahan yang sedang bermasalah dalam keuangan', 'weight' => 2], // D
                    ['text' => 'Memberikan akses untuk karyawan berbisnis sampingan di perusahaan', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 16 (Profesionalisme) | bobot A-E: 13524 =================
            [
                'question_text' => 'Anda telah bekerja sesuai dengan SOP yang perusahaan berikan kepada setiap karyawan dengan jelas, sudah terdokumentasi sebagai panduan bagi setiap karyawan dalam bekerja dan telah menerapkannya setiap hari dengan baik, namun terkadang ada kondisi di mana sebuah masalah yang timbul tidak dijelaskan bahkan tidak ada di dalam SOP yang perusahaan berikan, yang akan anda lakukan?',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 13524</strong> &rarr; A=1, B=3, C=5, D=2, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: fleksibel membaca situasi namun tetap berpedoman pada misi perusahaan &mdash; paling profesional</li><li><strong>Bobot 4</strong> &mdash; opsi E: berinisiatif mencari solusi sendiri dengan tetap mengacu pada misi perusahaan</li><li><strong>Bobot 3</strong> &mdash; opsi B: mau berkonsultasi, namun menggantungkan penyelesaian pada orang lain</li><li><strong>Bobot 2</strong> &mdash; opsi D: usulan jangka panjang yang tidak menyelesaikan masalah saat ini, dan caranya kurang tepat</li><li><strong>Bobot 1</strong> &mdash; opsi A: kaku pada aturan meskipun sudah jelas merugikan kinerja</li>',
                'options'       => [
                    ['text' => 'Tetap mengikuti SOP yang ada meskipun pekerjaan selesai jadi sangat lama dan mengganggu kinerja', 'weight' => 1], // A
                    ['text' => 'Meminta bantuan kepada rekan karyawan yang lain untuk dicarikan solusi terbaik', 'weight' => 3], // B
                    ['text' => 'Melihat dari kondisi yang ada dan saya sesuaikan dengan misi perusahaan agar pekerjaan cepat terselesaikan', 'weight' => 5], // C
                    ['text' => 'Menyuruh atasan untuk mereview kembali SOP yang ada agar karyawan dapat bekerja dengan baik', 'weight' => 2], // D
                    ['text' => 'Memikirkan penyelesaian yang sekira cocok dan bisa saya kerjakan sesuai kemampuan saya dan misi perusahaan', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 17 (Sosial Budaya) | bobot A-E: 45213 =================
            [
                'question_text' => 'Siang ini anda berkunjung ke sebuah tempat wisata, karena hari libur tentu saja pengunjung sangat ramai. Pada saat pembelian tiket masuk objek wisata antrian sangat panjang, kemudian anda melihat seorang ibu hamil sedang mengantri selang 10-an antrian di belakang anda. Ibu tersebut kelihatan sangat lelah ditambah lagi cuaca pada saat itu panas, apa yang anda lakukan?',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 45213</strong> &rarr; A=4, B=5, C=2, D=1, E=3</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: ibu hamil mendapatkan posisi yang lebih baik dari posisi anda sendiri &mdash; bentuk kepedulian paling tinggi</li><li><strong>Bobot 4</strong> &mdash; opsi A: merelakan posisi antrean bagi yang lebih membutuhkan</li><li><strong>Bobot 3</strong> &mdash; opsi E: ada niat membantu, tetapi belum memberi kepastian posisi antrean</li><li><strong>Bobot 2</strong> &mdash; opsi C: membantu, namun berarti anda ikut mundur jauh ke belakang tanpa perlu</li><li><strong>Bobot 1</strong> &mdash; opsi D: mengabaikan orang yang jelas membutuhkan pertolongan</li>',
                'options'       => [
                    ['text' => 'Meminta ibu tersebut untuk mengambil antrian anda', 'weight' => 4], // A
                    ['text' => 'Meminta ibu tersebut untuk berpindah ke antrian di depan anda', 'weight' => 5], // B
                    ['text' => 'Bertukar posisi antrian dengan ibu tersebut', 'weight' => 2], // C
                    ['text' => 'Antri seperti biasa karena kondisi antrian sangat panjang', 'weight' => 1], // D
                    ['text' => 'Menyuruh ibu tersebut untuk antri di dekat anda', 'weight' => 3], // E
                ],
            ],
            // ================= Soal 18 (Profesionalisme) | bobot A-E: 23451 =================
            [
                'question_text' => 'Suatu hari anda dimarahi oleh atasan anda karena telat mengumpulkan laporan kerja, sehingga anda dinilai kurang bertanggung jawab dan membuat image anda buruk. Sedangkan fakta anda telat mengumpulkan tugas tersebut karena printer yang akan anda gunakan bermasalah, sikap Anda&hellip;',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 23451</strong> &rarr; A=2, B=3, C=4, D=5, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: meminta maaf sekaligus menjelaskan kendala sebenarnya secara jujur &mdash; paling seimbang dan dewasa</li><li><strong>Bobot 4</strong> &mdash; opsi C: menjelaskan penyebab dengan jelas, namun tanpa permintaan maaf terlebih dahulu</li><li><strong>Bobot 3</strong> &mdash; opsi B: sudah menjelaskan, tetapi terkesan mencari pembenaran karena tidak menyebut sebab yang jelas</li><li><strong>Bobot 2</strong> &mdash; opsi A: meminta maaf, namun fakta sebenarnya tidak tersampaikan sehingga salah paham tetap ada</li><li><strong>Bobot 1</strong> &mdash; opsi E: menyalahkan pihak lain tanpa introspeksi &mdash; sikap paling defensif</li>',
                'options'       => [
                    ['text' => 'Meminta maaf kepada atasan dan berjanji tidak mengulangi hal yang sama', 'weight' => 2], // A
                    ['text' => 'Minta maaf dan menjelaskan bahwa kesalahan tersebut bukan semata-mata karena anda', 'weight' => 3], // B
                    ['text' => 'Menjelaskan bahwa printer untuk anda mencetak laporan bermasalah', 'weight' => 4], // C
                    ['text' => 'Minta maaf dan menjelaskan jika keterlambatan anda karena printer perusahaan yang bermasalah', 'weight' => 5], // D
                    ['text' => 'Tidak terima karena seharusnya perusahaan juga memfasilitasi semua sarana penunjang kerja karyawan', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 19 (Pelayanan Publik) | bobot A-E: 12345 =================
            [
                'question_text' => 'Siang ini anda sedang melayani banyak nasabah di kantor anda, antrian cukup panjang. Kemudian ada seorang kakek-kakek umur 70 tahun juga ikut mengantri. Karena terlalu lama dan antrian panjang, kakek tersebut meminta untuk dilayani terlebih dahulu, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12345</strong> &rarr; A=1, B=2, C=3, D=4, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: meminta pengertian antrean lain lebih dahulu baru melayani lansia &mdash; adil dan tidak menimbulkan gejolak</li><li><strong>Bobot 4</strong> &mdash; opsi D: melayani lansia lalu menjelaskan, meski penjelasan diberikan setelah terjadi</li><li><strong>Bobot 3</strong> &mdash; opsi C: berpihak pada lansia, namun berpotensi menimbulkan protes karena tidak ada penjelasan</li><li><strong>Bobot 2</strong> &mdash; opsi B: menolak dengan alasan prosedur, tetapi tetap tidak berpihak pada kelompok rentan</li><li><strong>Bobot 1</strong> &mdash; opsi A: menolak permintaan tanpa mempertimbangkan kondisi lansia sama sekali</li>',
                'options'       => [
                    ['text' => 'Minta maaf, meminta kakek tersebut untuk antri sesuai dengan nomer antrian', 'weight' => 1], // A
                    ['text' => 'Minta maaf, meminta untuk tetap antri karena pelayanan didasarkan kepada jadwal kedatangan', 'weight' => 2], // B
                    ['text' => 'Langsung melayani kakek tersebut karena dia sudah tua', 'weight' => 3], // C
                    ['text' => 'Melayani kakek tersebut kemudian memberikan pengertian kepada pelanggan yang lain', 'weight' => 4], // D
                    ['text' => 'Memberikan pengertian kepada yang lain dan melayani kakek tersebut', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 20 (Sosial Budaya) | bobot A-E: 35124 =================
            [
                'question_text' => 'Kita hidup di negara yang memiliki ragam kepercayaan, budaya dan adat istiadat yang berbeda-beda. Di perusahaan anda sendiri terdiri dari orang-orang yang berbeda latar belakang, banyak karyawan muslim yang mengeluhkan sulitnya beribadah karena ketersediaan tempat atau pada jam untuk beribadah mereka harus tetap bekerja, sikap anda&hellip;',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 35124</strong> &rarr; A=3, B=5, C=1, D=2, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: menempuh jalur musyawarah dengan seluruh pengambil keputusan &mdash; paling tepat sesuai kunci paket ini</li><li><strong>Bobot 4</strong> &mdash; opsi E: mengarah pada jalur yang benar, namun masih sebatas rencana</li><li><strong>Bobot 3</strong> &mdash; opsi A: solusi tepat, namun diputuskan sendiri tanpa melibatkan pemangku kebijakan</li><li><strong>Bobot 2</strong> &mdash; opsi D: niat baik, tetapi menjanjikan hal yang belum tentu dapat dipenuhi perusahaan</li><li><strong>Bobot 1</strong> &mdash; opsi C: terlalu umum dan tidak menjawab kebutuhan nyata (tempat dan waktu ibadah)</li>',
                'options'       => [
                    ['text' => 'Akan memfasilitasi tempat untuk beribadah mereka di lingkungan perusahaan', 'weight' => 3], // A
                    ['text' => 'Mendiskusikan hal ini dengan jajaran pimpinan dan pemilik perusahaan untuk dicari solusinya Karena pemilik perusahaan seorang non muslim, maka itu sudah menjadi aturan yang harus dipatuhi karyawan', 'weight' => 5], // B
                    ['text' => 'Memberikan kebijakan yang bersifat toleran kepada karyawan', 'weight' => 1], // C
                    ['text' => 'Bersifat toleran dan menyediakan semua fasilitas ibadah karyawan', 'weight' => 2], // D
                    ['text' => 'Berpikir untuk bertemu dengan pimpinan', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 21 (Profesionalisme) | bobot A-E: 12453 =================
            [
                'question_text' => 'Di kantor anda beredar kabar bahwa salah seorang rekan kerja anda menggelapkan uang penjualan bulanan untuk keperluan pribadinya. Dan sudah beberapa hari ini rekan tersebut tidak masuk bekerja. Kabar ini sangat cepat menyebar ke seluruh karyawan, sehingga menjadi buah bibir di kantor anda, menurut anda...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12453</strong> &rarr; A=1, B=2, C=4, D=5, E=3</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: melakukan verifikasi terlebih dahulu sebelum berpendapat &mdash; paling objektif dan bertanggung jawab</li><li><strong>Bobot 4</strong> &mdash; opsi C: tidak ikut menyebarkan kabar yang belum jelas &mdash; sikap hati-hati, meski pasif</li><li><strong>Bobot 3</strong> &mdash; opsi E: berusaha memverifikasi, tetapi sumbernya sesama karyawan sehingga berisiko memperluas gosip</li><li><strong>Bobot 2</strong> &mdash; opsi B: menghakimi rekan kerja atas dasar kabar yang belum terverifikasi</li><li><strong>Bobot 1</strong> &mdash; opsi A: langsung menuntut sanksi padahal kebenaran informasinya belum terbukti</li>',
                'options'       => [
                    ['text' => 'Pihak perusahaan harus memberikan sanksi yang tegas terhadap pelaku', 'weight' => 1], // A
                    ['text' => 'Sifat teman tersebut sudah di luar batas dan dapat menyebabkan kerugian besar pada perusahaan', 'weight' => 2], // B
                    ['text' => 'Kabar tersebut belum pasti jadi saya tidak mau berkomentar lebih jauh', 'weight' => 4], // C
                    ['text' => 'Saya akan mencari kebenaran informasi tersebut sebelum memberikan pendapat', 'weight' => 5], // D
                    ['text' => 'Saya tanyakan kepada teman-teman yang lainnya apakah informasi tersebut benar adanya', 'weight' => 3], // E
                ],
            ],
            // ================= Soal 22 (Pelayanan Publik) | bobot A-E: 32154 =================
            [
                'question_text' => 'Masalah pelayanan publik dalam instansi yang anda pimpin sekarang mendapat keluhan dari masyarakat. Hal ini disebabkan karena proses pelayanan sering kali tidak sesuai dengan prosedur yang telah ditetapkan. Padahal standar pelayanan minimal (SPM) dalam setiap instansi telah menjadi acuan dan tidak benar-benar dilaksanakan, hal yang demikian merupakan permasalahan dari implementasi penyelenggara pemerintahan. Keluhan masyarakat terhadap kinerja pelayanan publik merupakan isu yang sering dikeluhkan dari masyarakat. Secara umum yang menjadi permasalahan adalah kelambanan proses pelayanan terhadap kelompok masyarakat yang kurang mampu dibandingkan dengan kelompok yang secara ekonomis lebih mampu. Banyak masyarakat telah menjadi korban dari adanya diskriminasi dalam pelayanan publik, hal tersebut dapat dilihat bagaimana beberapa bawahan anda seringkali dalam melayani masyarakat masih pandang bulu contohnya pada saat masyarakat kurang mampu pelanggan kartu BPJS, anda mendapatkan laporan dari masyarakat jika ada oknum perawat jutek, tidak ada senyum-senyumnya setelah mengetahui pasien BPJS. Pelayanan seadanya seperti tidak ikhlas. Bahkan, ruang rawat inap sering dibilang penuh dan sebagainya lalu ada lagi laporan ketika bukan pasien BPJS Kesehatan yang sudah mengantre sejak pagi dulu yang dilayani. Melainkan pasien yang membayar secara cash terlebih dahulu meskipun memiliki nomor antrean di belakang. Sikap anda sebagai pimpinan instansi yang harus anda lakukan adalah....',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 32154</strong> &rarr; A=3, B=2, C=1, D=5, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: tindakan langsung dan tegas terhadap pelanggaran yang sedang terjadi &mdash; paling efektif sebagai pimpinan</li><li><strong>Bobot 4</strong> &mdash; opsi E: pembinaan berkelanjutan yang baik, meskipun hasilnya tidak seketika</li><li><strong>Bobot 3</strong> &mdash; opsi A: memperbaiki keramahan petugas, namun belum menyentuh persoalan diskriminasi antrean</li><li><strong>Bobot 2</strong> &mdash; opsi B: evaluasi bulanan terlalu lambat untuk masalah yang sudah berjalan dan merugikan masyarakat</li><li><strong>Bobot 1</strong> &mdash; opsi C: hanya berdampak pada pegawai baru dan tidak menyelesaikan masalah pegawai yang ada sekarang</li>',
                'options'       => [
                    ['text' => 'Mengadakan program 5S yaitu senyum, salam, sapa, sopan dan santun agar dengan adanya program tersebut masalah pelayanan publik akan berjalan dengan baik.', 'weight' => 3], // A
                    ['text' => 'Mengadakan evaluasi setiap bulannya untuk memperbaiki struktur manajemen yang ada.', 'weight' => 2], // B
                    ['text' => 'Memperbaiki sistem rekrutmen seleksi diperketat dan seperti perubahan sistem antara lain dibuat tes psikotes dan integritas, sehingga mampu menghasilkan pegawai yang profesional.', 'weight' => 1], // C
                    ['text' => 'Memberikan teguran bila perlu diberlakukan sanksi tegas pada bawahan yang tidak menjalankan tugasnya dengan baik.', 'weight' => 5], // D
                    ['text' => 'Memberikan pelatihan dan evaluasi secara berkala untuk memperbaiki kinerja pegawai.', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 23 (Integritas) | bobot A-E: 54123 =================
            [
                'question_text' => 'Anda bekerja dan kebetulan ditempatkan di bagian marketing dan tiba-tiba anda mendapat kabar bahwa orang tua mendapatkan musibah dan harus dilarikan ke rumah sakit lalu anda membutuhkan uang untuk biaya pengobatan orang tua anda tersebut, apa yang akan anda lakukan....',
                'explanation'   => '<p><strong>Aspek: Integritas</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 54123</strong> &rarr; A=5, B=4, C=1, D=2, E=3</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: kebutuhan mendesak terpenuhi melalui jalur resmi dan disertai komitmen pengembalian yang terukur</li><li><strong>Bobot 4</strong> &mdash; opsi B: menempuh jalur resmi dan transparan, namun rencana pengembaliannya belum konkret</li><li><strong>Bobot 3</strong> &mdash; opsi E: strategi kerja yang baik, namun hasilnya belum tentu cepat tersedia</li><li><strong>Bobot 2</strong> &mdash; opsi D: menunda-nunda penyelesaian padahal kondisinya darurat</li><li><strong>Bobot 1</strong> &mdash; opsi C: tidak menjawab kebutuhan yang sifatnya sangat mendesak saat itu juga</li>',
                'options'       => [
                    ['text' => 'Meminjam uang terlebih dahulu ke kantor dan secepatnya dikembalikan dengan menjual produk sesuai dengan target', 'weight' => 5], // A
                    ['text' => 'Meminjam uang terlebih dahulu ke kantor dan berjanji akan mengembalikannya dan melapor kepada atasan bahwa anda mendapatkan musibah', 'weight' => 4], // B
                    ['text' => 'Saya akan berusaha menjual produk dan memenuhi target untuk keperluan kebutuhan pengobatan orang tua saya', 'weight' => 1], // C
                    ['text' => 'Berusaha menjual produk tanpa lelah jika hasil kurang maksimal maka saya akan berusaha kembali esok kemudian agar mendapatkan target yang diinginkan', 'weight' => 2], // D
                    ['text' => 'Berusaha menjual produk dengan memanfaatkan teknologi informasi dan komunikasi agar dapat dengan mudah menjual produk dengan harapan tercapai targetnya', 'weight' => 3], // E
                ],
            ],
            // ================= Soal 24 (Teknologi Informasi & Komunikasi) | bobot A-E: 23541 =================
            [
                'question_text' => 'Hampir setiap minggu anda selalu menjalankan dinas ke luar kota. Pekerjaan anda menuntut anda untuk selalu mempersiapkan segala kebutuhan yang diperlukan ketika bertugas, mulai dari barang-barang pribadi sampai ke dokumen penting yang harus dibawa. Kendala yang sering terjadi adalah anda agak sedikit pelupa, terkadang barang bawaan anda bisa tertinggal, belum lagi risiko kerusakan selama perjalanan atau hilang, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Teknologi Informasi & Komunikasi</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 23541</strong> &rarr; A=2, B=3, C=5, D=4, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: memanfaatkan teknologi sehingga dokumen aman, tidak mungkin tertinggal, dan dapat diakses kapan pun</li><li><strong>Bobot 4</strong> &mdash; opsi D: sudah digital, tetapi perangkatnya tetap bisa tertinggal, rusak, atau hilang</li><li><strong>Bobot 3</strong> &mdash; opsi B: ada cadangan, namun masih berbentuk fisik sehingga tetap berisiko rusak atau hilang</li><li><strong>Bobot 2</strong> &mdash; opsi A: mengurangi risiko lupa, tetapi tidak melindungi dokumen dari kerusakan atau kehilangan</li><li><strong>Bobot 1</strong> &mdash; opsi E: tidak melakukan perbaikan apa pun atas kendala yang sudah disadari</li>',
                'options'       => [
                    ['text' => 'Menyiapkannya jauh-jauh hari agar tidak lupa', 'weight' => 2], // A
                    ['text' => 'Selalu membawa dokumen cadangan di tempat berbeda', 'weight' => 3], // B
                    ['text' => 'Menyimpan dengan sistem online agar bisa diakses di mana saja', 'weight' => 5], // C
                    ['text' => 'Menyimpan dokumen di dalam hard disk', 'weight' => 4], // D
                    ['text' => 'Tetap mempersiapkan seperti biasa yang anda lakukan', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 25 (Profesionalisme) | bobot A-E: 25431 =================
            [
                'question_text' => 'Dosen anda meminta anda untuk ikut dalam sebuah perlombaan yang dalam waktu dekat akan diselenggarakan oleh universitas tempat anda berkuliah. Dosen anda melihat bahwa anda memiliki talenta sesuai dengan deskripsi dari perlombaan, akan tetapi anda tidak menyadarinya, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 25431</strong> &rarr; A=2, B=5, C=4, D=3, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: menerima tawaran sekaligus berkomitmen mengembangkan potensi diri &mdash; sikap paling proaktif</li><li><strong>Bobot 4</strong> &mdash; opsi C: bersedia dan proaktif mencari bimbingan untuk memaksimalkan hasil</li><li><strong>Bobot 3</strong> &mdash; opsi D: bersedia, tetapi dengan syarat sehingga kemandiriannya rendah</li><li><strong>Bobot 2</strong> &mdash; opsi A: sebatas berterima kasih tanpa menindaklanjuti kesempatan yang diberikan</li><li><strong>Bobot 1</strong> &mdash; opsi E: menerima tanpa kesungguhan untuk memberikan hasil terbaik</li>',
                'options'       => [
                    ['text' => 'Berterimakasih kepada Dosen tersebut karena telah memuji anda sebagai seseorang yang bertalenta', 'weight' => 2], // A
                    ['text' => 'Menerima dan mengembangkan lebih dalam talenta yang anda miliki', 'weight' => 5], // B
                    ['text' => 'Bersedia mengikuti perlombaan tersebut dan meminta bantuan dosen untuk membantu dan membimbing anda', 'weight' => 4], // C
                    ['text' => 'Bersedia asalkan dosen anda selalu mau memberikan bimbingan jika nanti menemui permasalahan', 'weight' => 3], // D
                    ['text' => 'Menerima dan mengikuti perlombaan tersebut sebisanya', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 26 (Jejaring Kerja) | bobot A-E: 35421 =================
            [
                'question_text' => 'Beberapa minggu yang lalu atasan anda pernah memberitahu anda bahwa dia mempunyai jadwal untuk bisa menandatangani kontrak dengan beberapa orang klien baru dalam beberapa minggu ke depan untuk pengembangan perusahaan, namun tampaknya atasan anda lupa akan hal tersebut karena terlalu sibuk mengurusi banyak hal dan sering tidak berada di kantor karena pergi ke luar kota, sebagai seorang asisten yang akan anda lakukan adalah...',
                'explanation'   => '<p><strong>Aspek: Jejaring Kerja</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 35421</strong> &rarr; A=3, B=5, C=4, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: berinisiatif menyiapkan rencana sekaligus tetap meminta persetujuan atasan &mdash; ideal bagi seorang asisten</li><li><strong>Bobot 4</strong> &mdash; opsi C: berinisiatif menyusun rencana, tetapi keputusannya diambil sepihak tanpa persetujuan lebih dulu</li><li><strong>Bobot 3</strong> &mdash; opsi A: sudah mengingatkan, namun belum ada tindak lanjut penyiapan pertemuan</li><li><strong>Bobot 2</strong> &mdash; opsi D: sekadar memberi tahu dengan nada mengarahkan, tanpa membantu penyiapan</li><li><strong>Bobot 1</strong> &mdash; opsi E: sepenuhnya pasif padahal atasan jelas sedang lupa</li>',
                'options'       => [
                    ['text' => 'Mengingatkan atasan bahwa punya rencana untuk bertemu klien', 'weight' => 3], // A
                    ['text' => 'Membuat rencana pertemuan dan memberitahu atasan untuk disetujui', 'weight' => 5], // B
                    ['text' => 'Membuat rencana pertemuan dengan klien atasan dan memberitahukannya', 'weight' => 4], // C
                    ['text' => 'Memberitahu atasan bahwa dia harus bertemu klien untuk urusan bisnis dalam waktu dekat', 'weight' => 2], // D
                    ['text' => 'Menunggu atasan membicarakannya lagi, lalu baru melakukan persiapan pertemuan', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 27 (Profesionalisme) | bobot A-E: 13542 =================
            [
                'question_text' => 'Rekan team kerja anda dimarahi oleh atasan pada saat mengumpulkan tugas team karena sudah telat beberapa menit mengumpulkan tugasnya. Hal ini disebabkan karena rekan anda tersebut harus meng-assembly pekerjaan tersebut terlebih dahulu sebelum dikumpulkan ditambah lagi semua rekan anggota team mengumpulkan tugas pribadi mereka juga terlambat, sehingga rekan anda yang bertugas untuk meng-assembly setiap pekerjaan jadi tidak menyelesaikan pekerjaannya tepat waktu, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 13542</strong> &rarr; A=1, B=3, C=5, D=4, E=2</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: berani bertanggung jawab di hadapan atasan sehingga rekan tidak dipersalahkan sendirian &mdash; paling berintegritas</li><li><strong>Bobot 4</strong> &mdash; opsi D: mengakui kesalahan disertai komitmen perbaikan, tetapi hanya kepada rekan</li><li><strong>Bobot 3</strong> &mdash; opsi B: mengakui kesalahan kepada rekan, namun atasan tetap salah paham</li><li><strong>Bobot 2</strong> &mdash; opsi E: sebatas memberi dukungan moral tanpa mengakui andil sendiri</li><li><strong>Bobot 1</strong> &mdash; opsi A: membiarkan rekan menanggung kesalahan yang sebenarnya juga milik anda</li>',
                'options'       => [
                    ['text' => 'Mendengarkan saja rekan anda dimarahi setelah itu memberikan semangat untuk tidak dimasukkan ke hati ucapan atasan', 'weight' => 1], // A
                    ['text' => 'Minta maaf kepada teman karena keterlambatan juga disebabkan oleh anggota team yang lain', 'weight' => 3], // B
                    ['text' => 'Mengakui kesalahan kepada atasan jika anda juga turut berkontribusi pada masalah tersebut', 'weight' => 5], // C
                    ['text' => 'Mengakui kesalahan kepada teman dan berjanji tidak akan mengulanginya lagi', 'weight' => 4], // D
                    ['text' => 'Mengajak rekan anda untuk membicarakannya dan menghibur rekan yang dimarahi atasan', 'weight' => 2], // E
                ],
            ],
            // ================= Soal 28 (Sosial Budaya) | bobot A-E: 54321 =================
            [
                'question_text' => 'Siang ini anda menerima panggilan untuk proses rekrutmen pada sebuah perusahaan. Ketika anda berangkat untuk mengikuti rekrutmen tersebut di tengah perjalanan anda melihat kerumunan orang di pinggir jalan dan ternyata telah terjadi kecelakaan dengan korban tabrak lari, sedangkan anda harus sesegera mungkin sampai di perusahaan untuk memulai seleksi, maka sikap anda...',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 54321</strong> &rarr; A=5, B=4, C=3, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: sesuai kunci jawaban paket ini &mdash; memenuhi komitmen yang telah dijanjikan tepat waktu</li><li><strong>Bobot 4</strong> &mdash; opsi B: tetap memenuhi komitmen, namun disampaikan dengan alasan yang kurang empatik</li><li><strong>Bobot 3</strong> &mdash; opsi C: memastikan korban tertolong lebih dahulu sebelum melanjutkan perjalanan</li><li><strong>Bobot 2</strong> &mdash; opsi D: sangat empatik, tetapi mengorbankan komitmen yang sudah dijanjikan</li><li><strong>Bobot 1</strong> &mdash; opsi E: tindakan berisiko, di luar kewenangan, dan mengabaikan korban maupun komitmen</li>',
                'options'       => [
                    ['text' => 'Tetap melanjutkan perjalanan untuk tepat waktu mengikuti tes pekerjaan', 'weight' => 5], // A
                    ['text' => 'Mengabaikannya karena harus mengikuti tes yang akan dimulai sebentar lagi', 'weight' => 4], // B
                    ['text' => 'Tetap melanjutkan perjalanan setelah yakin ada orang lain yang menolong', 'weight' => 3], // C
                    ['text' => 'Menolongnya, kemudian membawanya ke rumah sakit atau kantor polisi', 'weight' => 2], // D
                    ['text' => 'Mengejar pelaku tabrak lari dan memintanya untuk bertanggung jawab atas perbuatannya', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 29 (Integritas) | bobot A-E: 14523 =================
            [
                'question_text' => 'Anda adalah PNS melalui jalur CPNS resmi suatu instansi yang dikepalai kerabat Anda. Belakangan diketahui bahwa ternyata Anda tidak lulus dan orang tua menggunakan jalur belakang untuk meluluskan Anda. Padahal selama ini Anda selalu aktif memerangi korupsi, kolusi, dan nepotisme di perusahaan kementerian anda, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Integritas</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 14523</strong> &rarr; A=1, B=4, C=5, D=2, E=3</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: mengakui secara terbuka dan menyerahkan sepenuhnya pada keputusan instansi &mdash; integritas tertinggi</li><li><strong>Bobot 4</strong> &mdash; opsi B: berani melaporkan sekaligus meluruskan sikap orang tua</li><li><strong>Bobot 3</strong> &mdash; opsi E: melaporkan pelanggaran, tetapi belum ada pengakuan terbuka atas posisi yang diperoleh</li><li><strong>Bobot 2</strong> &mdash; opsi D: menyesal namun sengaja memanfaatkan celah aturan untuk mempertahankan posisi</li><li><strong>Bobot 1</strong> &mdash; opsi A: menebus kesalahan dengan cara yang sama sekali tidak berkaitan dan tidak meluruskan pelanggaran</li>',
                'options'       => [
                    ['text' => 'Menyesali perbuatan dengan bersedekah membantu korban bencana dan aktif di organisasi kemanusiaan', 'weight' => 1], // A
                    ['text' => 'Menasehati orang tua dan melaporkan pada pihak berwenang', 'weight' => 4], // B
                    ['text' => 'Mengakui kecurangan orang tua di depan semua orang, dan menunggu keputusan instansi', 'weight' => 5], // C
                    ['text' => 'Menyesali perbuatan, tetap tenang dan tidak gegabah karena sulit memecat PNS', 'weight' => 2], // D
                    ['text' => 'Meminta maaf dan melapor ke pihak berwenang', 'weight' => 3], // E
                ],
            ],
            // ================= Soal 30 (Jejaring Kerja) | bobot A-E: 53241 =================
            [
                'question_text' => 'Anda ditunjuk menjadi seorang pemimpin pada sebuah tim dari berbagai lulusan universitas terkemuka. Akhir-akhir ini tim anda mendapatkan banyak tugas dengan deadline yang lumayan singkat, akan tetapi tim anda selalu berhasil menyelesaikan tugas-tugas tersebut dengan hasil yang memuaskan. Banyak yang menilai jika kinerja tim anda sangat bagus, menurut anda apa penyebabnya?',
                'explanation'   => '<p><strong>Aspek: Jejaring Kerja</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 53241</strong> &rarr; A=5, B=3, C=2, D=4, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: disiplin dan profesionalisme adalah faktor paling menentukan keberhasilan tim di bawah tenggat ketat</li><li><strong>Bobot 4</strong> &mdash; opsi D: kekompakan dan musyawarah membuat koordinasi tim berjalan efektif</li><li><strong>Bobot 3</strong> &mdash; opsi B: kesamaan tujuan penting, namun belum menjamin ketepatan waktu penyelesaian</li><li><strong>Bobot 2</strong> &mdash; opsi C: potensi individu tidak otomatis menghasilkan kinerja tim yang baik</li><li><strong>Bobot 1</strong> &mdash; opsi E: motivasi hanyalah pemicu awal, bukan penyebab langsung hasil kerja yang memuaskan</li>',
                'options'       => [
                    ['text' => 'Seluruh anggota tim bekerja dengan disiplin dan profesional dalam menyelesaikan tugas', 'weight' => 5], // A
                    ['text' => 'Semua anggota tim menjiwai tujuan tim', 'weight' => 3], // B
                    ['text' => 'Anggota tim masing-masing mempunyai potensi yang bagus di setiap bidangnya', 'weight' => 2], // C
                    ['text' => 'Kekompakan, bermusyawarah mufakat dalam bekerja', 'weight' => 4], // D
                    ['text' => 'Motivasi yang bagus kepada seluruh anggota tim', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 31 (Sosial Budaya) | bobot A-E: 51423 =================
            [
                'question_text' => 'Malam ini anda bersama anggota keluarga berkumpul untuk makan bersama. Salah satu di antaranya menggunakan gawai untuk menjelajahi teknologi informasi pada gawainya, seperti WhatsApp, Line, Twitter, Instagram. Sikap anda terhadap ilustrasi di atas...',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 51423</strong> &rarr; A=5, B=1, C=4, D=2, E=3</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: sesuai kunci jawaban paket ini &mdash; menghargai kebutuhan pribadi anggota keluarga tanpa memaksakan kehendak</li><li><strong>Bobot 4</strong> &mdash; opsi C: tetap menjaga suasana kebersamaan tanpa menghakimi siapa pun</li><li><strong>Bobot 3</strong> &mdash; opsi E: berusaha memahami lebih dahulu, meski tetap berujung pada teguran</li><li><strong>Bobot 2</strong> &mdash; opsi D: menasihati di saat yang kurang tepat sehingga berpotensi mengganggu suasana</li><li><strong>Bobot 1</strong> &mdash; opsi B: tindakan memaksa yang merusak suasana kebersamaan</li>',
                'options'       => [
                    ['text' => 'Membiarkannya karena itu suatu hal wajar untuk bersosialisasi dengan rekan di dunia maya', 'weight' => 5], // A
                    ['text' => 'Menarik gawainya dan tidak akan mengembalikannya sebelum seluruh anggota keluarga selesai makan', 'weight' => 1], // B
                    ['text' => 'Melanjutkan makan dan berbincang dengan anggota keluarga lainnya', 'weight' => 4], // C
                    ['text' => 'Menasehatinya pada saat makan untuk tidak menggunakan gawai', 'weight' => 2], // D
                    ['text' => 'Menanyakan alasannya menggunakan gawai tersebut dan mengingatkan untuk mematikan gawainya', 'weight' => 3], // E
                ],
            ],
            // ================= Soal 32 (Profesionalisme) | bobot A-E: 34251 =================
            [
                'question_text' => 'Anda dan tim Anda diberikan tugas baru oleh pimpinan, tugas tersebut merupakan tugas yang lumayan baru dan belum pernah anda kerjakan sebelumnya, begitu pun dengan rekan tim yang lain mereka merasa kebingungan dan juga mereka semua juga belum memahami maksud dan cara mengerjakan tugas baru. Sikap Anda...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 34251</strong> &rarr; A=3, B=4, C=2, D=5, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: menyelesaikan tugas secara kolaboratif sejak awal &mdash; paling efektif untuk tugas yang baru bagi semua orang</li><li><strong>Bobot 4</strong> &mdash; opsi B: berinisiatif belajar dan berbagi ilmu, meski beban sepenuhnya ada pada satu orang</li><li><strong>Bobot 3</strong> &mdash; opsi A: percaya pada kemampuan tim, namun membiarkan setiap orang berjuang sendiri-sendiri</li><li><strong>Bobot 2</strong> &mdash; opsi C: melimpahkan tanggung jawab belajar kepada satu orang saja</li><li><strong>Bobot 1</strong> &mdash; opsi E: menggantungkan seluruh penyelesaian pada pimpinan tanpa usaha sendiri</li>',
                'options'       => [
                    ['text' => 'Saya yakin bahwa para anggota tim juga dapat belajar sendiri untuk memahami cara menyelesaikan tugas baru tersebut.', 'weight' => 3], // A
                    ['text' => 'Saya mempelajari tugas tersebut, lalu membagi pengetahuan saya kepada anggota tim yang lain.', 'weight' => 4], // B
                    ['text' => 'Saya akan meminta bantuan rekan kerja yang paling pandai untuk mempelajari tugas tersebut, kemudian menjelaskannya pada semua anggota tim.', 'weight' => 2], // C
                    ['text' => 'Kami mengerjakan bersama-sama tugas tersebut sesuai dengan pemahaman kami, bila ada kesulitan kami akan menyelesaikannya dan mencari jalan keluar secara bersama-sama.', 'weight' => 5], // D
                    ['text' => 'Pimpinan yang memberikan tugas, sebaiknya menjelaskan terlebih dahulu bagaimana mengerjakan tugas tersebut sebaik-baiknya.', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 33 (Teknologi Informasi & Komunikasi) | bobot A-E: 53421 =================
            [
                'question_text' => 'Banyak perusahaan yang berlomba-lomba untuk mengikuti perubahan dengan penggunaan teknologi informasi dalam aktivitas pekerjaan sehari-hari. Namun penggunaan teknologi informasi di perusahaan anda tidak signifikan, serta kurang bisa memajukan kinerja karyawan dan perusahaan yang anda pimpin. Sikap anda sebagai pemimpin pada perusahaan tersebut adalah...',
                'explanation'   => '<p><strong>Aspek: Teknologi Informasi & Komunikasi</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 53421</strong> &rarr; A=5, B=3, C=4, D=2, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi A: menyentuh akar masalah, yaitu kompetensi SDM, melalui motivasi sekaligus pendidikan dan pelatihan</li><li><strong>Bobot 4</strong> &mdash; opsi C: mencari alternatif teknologi yang lebih sesuai dengan kebutuhan perusahaan</li><li><strong>Bobot 3</strong> &mdash; opsi B: menumbuhkan kesadaran, namun belum meningkatkan keterampilan secara nyata</li><li><strong>Bobot 2</strong> &mdash; opsi D: mundur ke cara manual, meskipun masih ada usaha mencari jalan keluar</li><li><strong>Bobot 1</strong> &mdash; opsi E: menyerah pada perubahan &mdash; sikap paling tidak adaptif bagi seorang pemimpin</li>',
                'options'       => [
                    ['text' => 'Memberi motivasi dan diklat seluruh anggota/karyawan untuk terus meningkatkan ilmu tentang teknologi informasi', 'weight' => 5], // A
                    ['text' => 'Berusaha memberi pengetahuan bahwa teknologi informasi itu penting dalam bekerja', 'weight' => 3], // B
                    ['text' => 'Menggunakan teknologi informasi yang lain yang sekiranya dapat membuat perubahan bagi perusahaan', 'weight' => 4], // C
                    ['text' => 'Tidak menggunakan teknologi lagi dan beralih pada proses manual seperti sebelumnya, namun mencari solusi lainnya.', 'weight' => 2], // D
                    ['text' => 'Tidak menggunakan teknologi informasi karena sudah jelas tidak membantu perusahaan ke arah yang lebih baik', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 34 (Pelayanan Publik) | bobot A-E: 12354 =================
            [
                'question_text' => 'Anda merupakan seorang waiters pada sebuah restoran. Datang seorang tamu bersama dengan keluarganya untuk makan di restoran anda. Pada saat menu sudah dihidangkan di atas meja dan mulai dinikmati oleh tamu tersebut, kemudian dia memanggil anda dan komplain jika tadi dia minta agar menu yang dia pesan dibikin tidak pedas sama sekali, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Pelayanan Publik</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12354</strong> &rarr; A=1, B=2, C=3, D=5, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: meminta maaf kepada tamu sekaligus meneruskan komplain ke bagian yang berwenang &mdash; paling sesuai peran</li><li><strong>Bobot 4</strong> &mdash; opsi E: meminta maaf dan menindaklanjuti, namun langsung menuntut penggantian tanpa konfirmasi</li><li><strong>Bobot 3</strong> &mdash; opsi C: menindaklanjuti pada pihak yang tepat, tetapi tanpa permintaan maaf kepada tamu</li><li><strong>Bobot 2</strong> &mdash; opsi B: meminta tamu menunggu tanpa kepastian siapa yang akan menindaklanjuti</li><li><strong>Bobot 1</strong> &mdash; opsi A: mengambil alih pekerjaan bagian dapur &mdash; di luar kewenangan seorang waiters</li>',
                'options'       => [
                    ['text' => 'Meminta maaf dan langsung membuatkan menu baru sesuai pesanan', 'weight' => 1], // A
                    ['text' => 'Minta maaf dan memohon untuk menunggu agar dibuatkan yang baru', 'weight' => 2], // B
                    ['text' => 'Melaporkan kepada bagian dapur yang bertugas memasak', 'weight' => 3], // C
                    ['text' => 'Minta maaf dan melaporkan pada bagian dapur', 'weight' => 5], // D
                    ['text' => 'Minta maaf dan meminta bagian dapur untuk mengganti menu tersebut', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 35 (Profesionalisme) | bobot A-E: 12354 =================
            [
                'question_text' => 'Anda merupakan karyawan baru pada sebuah perusahaan. Karena masih dalam masa percobaan, gaji yang diberikan oleh perusahaan kepada anda biasanya sangat pas-pasan untuk kebutuhan sehari-hari. Belum lagi setiap minggunya pacar anda sering mengajak untuk nonton. Kondisi ini diperburuk lagi anda termasuk orang yang lumayan boros sehingga terkadang pengeluaran anda lebih besar dari pemasukannya, sikap anda...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12354</strong> &rarr; A=1, B=2, C=3, D=5, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: menyusun perencanaan keuangan &mdash; solusi paling sistematis dan berkelanjutan</li><li><strong>Bobot 4</strong> &mdash; opsi E: berhemat sekaligus menabung, langkah baik meski tanpa perencanaan menyeluruh</li><li><strong>Bobot 3</strong> &mdash; opsi C: membedakan kebutuhan dan keinginan, namun belum terstruktur</li><li><strong>Bobot 2</strong> &mdash; opsi B: hanya memotong satu pos pengeluaran, tidak menyelesaikan pola pengeluaran secara keseluruhan</li><li><strong>Bobot 1</strong> &mdash; opsi A: sebatas niat berhemat tanpa cara yang jelas, padahal masalahnya adalah kebiasaan boros</li>',
                'options'       => [
                    ['text' => 'Berusaha sekuat tenaga untuk berhemat agar gaji cukup untuk tiap bulan', 'weight' => 1], // A
                    ['text' => 'Mengurangi aktivitas nonton bersama pacar anda dan nonton televisi saja yang murah', 'weight' => 2], // B
                    ['text' => 'Menghemat pengeluaran dan membeli hal yang dibutuhkan saja', 'weight' => 3], // C
                    ['text' => 'Membuat perencanaan untuk mengontrol keuangan', 'weight' => 5], // D
                    ['text' => 'Berhemat dan menabung setiap habis gajian', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 36 (Profesionalisme) | bobot A-E: 21435 =================
            [
                'question_text' => 'Setelah melaksanakan tugas tertentu yang diberikan atasan, ternyata ada instruksi yang salah dari atasan sehingga anda harus mengulangi tugas tersebut. Bagaimana sikap anda?',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 21435</strong> &rarr; A=2, B=1, C=4, D=3, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: menyelesaikan tugas sekaligus memberi masukan perbaikan dengan santun &mdash; paling profesional</li><li><strong>Bobot 4</strong> &mdash; opsi C: tetap menjalankan tugas dan mampu menahan emosi agar tidak terlihat</li><li><strong>Bobot 3</strong> &mdash; opsi D: menolak dengan alasan yang dapat dipahami, namun pekerjaan menjadi terbengkalai</li><li><strong>Bobot 2</strong> &mdash; opsi A: bersedia mengulang, tetapi melampiaskan emosi kepada atasan</li><li><strong>Bobot 1</strong> &mdash; opsi B: menegur dengan keras &mdash; cara paling tidak profesional dan merusak hubungan kerja</li>',
                'options'       => [
                    ['text' => 'Saya tetap mengulanginya meskipun sambil sedikit melampiaskan kekesalan kepada atasan', 'weight' => 2], // A
                    ['text' => 'Meskipun dia atasan saya, saya menegurnya dengan keras atas kesalahan yang merugikan orang lain tersebut', 'weight' => 1], // B
                    ['text' => 'Saya mengulanginya meskipun dalam hati terasa sangat marah', 'weight' => 4], // C
                    ['text' => 'Saya tidak bersedia mengulanginya karena kesalahan bukan dari pihak saya', 'weight' => 3], // D
                    ['text' => 'Saya bersedia mengulanginya dan saya juga memintanya untuk lebih berhati-hati dalam memberikan instruksi di kemudian hari.', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 37 (Jejaring Kerja) | bobot A-E: 35412 =================
            [
                'question_text' => 'Seorang kawan di kantor sering meminta untuk diajari hal-hal seputar pekerjaan yang belum diketahuinya, maka saya&hellip;',
                'explanation'   => '<p><strong>Aspek: Jejaring Kerja</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 35412</strong> &rarr; A=3, B=5, C=4, D=1, E=2</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: mengajari sekaligus mendorong kemandirian belajar &mdash; paling bermanfaat jangka panjang</li><li><strong>Bobot 4</strong> &mdash; opsi C: bersedia mengajari dengan mempertimbangkan ketersediaan waktu</li><li><strong>Bobot 3</strong> &mdash; opsi A: mau mengajari, namun membatasi diri sehingga kebutuhannya belum tentu terpenuhi</li><li><strong>Bobot 2</strong> &mdash; opsi E: menolak dengan cara yang kurang bersahabat meski disertai alasan</li><li><strong>Bobot 1</strong> &mdash; opsi D: menolak membantu rekan kerja tanpa alternatif solusi</li>',
                'options'       => [
                    ['text' => 'Mengajarinya cukup sekali saja', 'weight' => 3], // A
                    ['text' => 'Mengajari dan menyarankannya membaca buku yang dapat membantu peningkatan profesional pekerjaan.', 'weight' => 5], // B
                    ['text' => 'Mengajari kalau memang saya memiliki waktu yang sangat longgar', 'weight' => 4], // C
                    ['text' => 'Memintanya agar belajar mandiri', 'weight' => 1], // D
                    ['text' => 'Memintanya dengan tegas agar belajar sendiri, karena itulah inti tanggungjawab', 'weight' => 2], // E
                ],
            ],
            // ================= Soal 38 (Profesionalisme) | bobot A-E: 32415 =================
            [
                'question_text' => 'Anda adalah seorang anggota unit biasa. Saat ini unit anda dihadapkan pada situasi rumit yang membutuhkan pengambilan keputusan saat ini juga dari pimpinan unit, padahal pimpinan unit baru tiba di kantor 4 jam lagi. Sikap anda adalah....',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 32415</strong> &rarr; A=3, B=2, C=4, D=1, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: berkoordinasi dengan pimpinan lalu bertindak sesuai arahan &mdash; cepat sekaligus tetap dalam koridor kewenangan</li><li><strong>Bobot 4</strong> &mdash; opsi C: menghindari melampaui kewenangan, meski alasannya berorientasi pada kepentingan pribadi</li><li><strong>Bobot 3</strong> &mdash; opsi A: menaati kewenangan, namun mengabaikan situasi yang mendesak</li><li><strong>Bobot 2</strong> &mdash; opsi B: melempar tanggung jawab kepada orang lain</li><li><strong>Bobot 1</strong> &mdash; opsi D: mengambil keputusan sendiri di luar kewenangan tanpa berkoordinasi lebih dahulu</li>',
                'options'       => [
                    ['text' => 'Tetap menunggu pimpinan unit untuk datang', 'weight' => 3], // A
                    ['text' => 'Meminta rekan lain saja yang mengambil keputusan', 'weight' => 2], // B
                    ['text' => 'Bagaimanapun juga, saya tidak bersedia mengambil keputusan karena hal itu berisiko tinggi bagi karier saya', 'weight' => 4], // C
                    ['text' => 'Saya akan mengambil keputusan untuk menyelamatkan kondisi rumit tersebut', 'weight' => 1], // D
                    ['text' => 'Saya menelpon dulu pimpinan lalu mengambil keputusan sesuai arahan pimpinan dan berdasarkan kondisi saat itu', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 39 (Profesionalisme) | bobot A-E: 12345 =================
            [
                'question_text' => 'Saya diminta untuk lembur kerja sedangkan saya sudah berjanji kepada anak saya untuk mengantarnya ke pesta ulang tahun sahabatnya. Sikap saya&hellip;.',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12345</strong> &rarr; A=1, B=2, C=3, D=4, E=5</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi E: komunikasi terbuka dengan pimpinan sehingga janji kepada anak dan tanggung jawab kerja sama-sama terpenuhi</li><li><strong>Bobot 4</strong> &mdash; opsi D: memenuhi tanggung jawab pekerjaan, meski janji kepada anak tetap tidak ditepati</li><li><strong>Bobot 3</strong> &mdash; opsi C: menyelesaikan pekerjaan, tetapi mengingkari janji kepada anak</li><li><strong>Bobot 2</strong> &mdash; opsi B: berbohong kepada pimpinan demi kepentingan pribadi</li><li><strong>Bobot 1</strong> &mdash; opsi A: meninggalkan tanggung jawab secara tidak jujur &mdash; sikap paling buruk</li>',
                'options'       => [
                    ['text' => 'Pulang dengan diam-diam, tanpa sepengetahuan pimpinan', 'weight' => 1], // A
                    ['text' => 'Berpura-pura sakit agar dapat diizinkan untuk segera pulang', 'weight' => 2], // B
                    ['text' => 'Menghubungi anak saya menjelaskan agar naik taksi saja', 'weight' => 3], // C
                    ['text' => 'Bekerja lembur, karena yakin anak saya pasti memaklumi', 'weight' => 4], // D
                    ['text' => 'Meminta izin pimpinan mengantar anak saya kemudian kembali ke kantor untuk bekerja lembur', 'weight' => 5], // E
                ],
            ],
            // ================= Soal 40 (Profesionalisme) | bobot A-E: 12354 =================
            [
                'question_text' => 'Setiap hari, saya masuk kantor paling cepat dibandingkan pegawai lainnya. Yang saya lakukan setelah tiba adalah ...',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 12354</strong> &rarr; A=1, B=2, C=3, D=5, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: memanfaatkan waktu paling awal untuk merencanakan pekerjaan sehari penuh &mdash; paling produktif</li><li><strong>Bobot 4</strong> &mdash; opsi E: langsung produktif menuntaskan pekerjaan, meski tanpa perencanaan lebih dahulu</li><li><strong>Bobot 3</strong> &mdash; opsi C: membangun keakraban, namun belum bernilai produktif bagi pekerjaan</li><li><strong>Bobot 2</strong> &mdash; opsi B: tidak memanfaatkan waktu untuk hal produktif</li><li><strong>Bobot 1</strong> &mdash; opsi A: mengisi waktu dengan kegiatan yang tidak berkaitan dengan pekerjaan</li>',
                'options'       => [
                    ['text' => 'Masuk ke ruangan dan membaca koran', 'weight' => 1], // A
                    ['text' => 'Santai di luar gedung kantor untuk menikmati udara pagi', 'weight' => 2], // B
                    ['text' => 'Masuk ke ruangan dan mengobrol dengan rekan sejawat', 'weight' => 3], // C
                    ['text' => 'Masuk ke ruangan dan membuat rencana kerja', 'weight' => 5], // D
                    ['text' => 'Masuk ke ruangan dan memulai pekerjaan yang tertunda kemarin.', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 41 (Profesionalisme) | bobot A-E: 32541 =================
            [
                'question_text' => 'Prediksi pengamat ekonomi bahwa bulan depan akan terjadi inflasi besar di Indonesia membuat saya,',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 32541</strong> &rarr; A=3, B=2, C=5, D=4, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: menanggapi informasi dengan tindakan antisipatif yang rasional &mdash; paling tepat</li><li><strong>Bobot 4</strong> &mdash; opsi D: tetap tenang menghadapi situasi, meskipun tanpa langkah antisipasi</li><li><strong>Bobot 3</strong> &mdash; opsi A: menunjukkan kepedulian pada situasi, namun berhenti pada kecemasan</li><li><strong>Bobot 2</strong> &mdash; opsi B: reaksi berlebihan yang tidak menyelesaikan apa pun</li><li><strong>Bobot 1</strong> &mdash; opsi E: menolak informasi tanpa dasar &mdash; sikap paling tidak adaptif</li>',
                'options'       => [
                    ['text' => 'Susah tidur', 'weight' => 3], // A
                    ['text' => 'Depresi berat, karena inflasi berarti harga barang naik', 'weight' => 2], // B
                    ['text' => 'Mengambil langkah hati-hati dalam membelanjakan uang', 'weight' => 5], // C
                    ['text' => 'Biarlah yang akan terjadi terjadilah', 'weight' => 4], // D
                    ['text' => 'Tidak percaya dengan prediksi yang menyusahkan itu', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 42 (Profesionalisme) | bobot A-E: 31254 =================
            [
                'question_text' => 'Karena ruang kantor sempit, maka penambahan sekat untuk karyawan baru terpaksa mempersempit seluruh sekat yang sudah ada termasuk sekat anda.',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 31254</strong> &rarr; A=3, B=1, C=2, D=5, E=4</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: menerima perubahan dengan lapang dada &mdash; sikap paling adaptif terhadap kebijakan perusahaan</li><li><strong>Bobot 4</strong> &mdash; opsi E: mengajak rekan beradaptasi, meskipun masih diwarnai keterpaksaan</li><li><strong>Bobot 3</strong> &mdash; opsi A: bersedia menyesuaikan diri, namun membutuhkan waktu yang lama</li><li><strong>Bobot 2</strong> &mdash; opsi C: menerima dengan terpaksa, bukan atas kesadaran sendiri</li><li><strong>Bobot 1</strong> &mdash; opsi B: menolak perubahan dan mempersoalkan keputusan perusahaan &mdash; paling tidak adaptif</li>',
                'options'       => [
                    ['text' => 'Saya perlu waktu beberapa bulan untuk penyesuaian diri terhadap sempitnya sekat saya saat ini', 'weight' => 3], // A
                    ['text' => 'Seharusnya tak perlu ada karyawan baru, karena hanya mempersempit ruang sekat yang sudah sempit', 'weight' => 1], // B
                    ['text' => 'Apa boleh buat, saya harus menerima kondisi ini', 'weight' => 2], // C
                    ['text' => 'Saya menerima perubahan yang sudah ditetapkan', 'weight' => 5], // D
                    ['text' => 'Saya mengajak rekan kerja lain untuk menyesuaikan diri dengan terpaksa', 'weight' => 4], // E
                ],
            ],
            // ================= Soal 43 (Sosial Budaya) | bobot A-E: 24351 =================
            [
                'question_text' => 'Dimas sampai saat ini belum mengembalikan buku yang ia pinjam dari minggu lalu, maka sikap saya&hellip;',
                'explanation'   => '<p><strong>Aspek: Sosial Budaya</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 24351</strong> &rarr; A=2, B=4, C=3, D=5, E=1</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi D: mengingatkan dengan cara yang santun &mdash; komunikasi paling sehat dan efektif</li><li><strong>Bobot 4</strong> &mdash; opsi B: memberi kesempatan dan toleransi karena baru pertama kali terjadi</li><li><strong>Bobot 3</strong> &mdash; opsi C: menghindari konflik, tetapi tidak mendidik dan merelakan hak sendiri</li><li><strong>Bobot 2</strong> &mdash; opsi A: menegur dengan keras untuk kelalaian yang masih ringan</li><li><strong>Bobot 1</strong> &mdash; opsi E: menyindir adalah komunikasi tidak langsung yang berpotensi menimbulkan salah paham</li>',
                'options'       => [
                    ['text' => 'Saya akan menegurnya dengan keras agar tidak terulang lagi', 'weight' => 2], // A
                    ['text' => 'Saya membiarkannya terlebih dulu sampai dia teringat sebab ini yang pertama kalinya dia lupa', 'weight' => 4], // B
                    ['text' => 'Saya mengikhlaskan buku tersebut, karena harganya murah', 'weight' => 3], // C
                    ['text' => 'Saya mencoba mengingatkannya', 'weight' => 5], // D
                    ['text' => 'Saya menyindirnya agar ia ingat atas kelalaiannya', 'weight' => 1], // E
                ],
            ],
            // ================= Soal 44 (Profesionalisme) | bobot A-E: 34512 =================
            [
                'question_text' => 'Sudah beberapa kali saya melakukan beberapa kesalahan di kantor saya, dan saya sudah berusaha untuk memperbaiki kelemahan diri pada diri saya, tetapi belum juga menampakkan hasilnya. Sehingga saya, &hellip;.',
                'explanation'   => '<p><strong>Aspek: Profesionalisme</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 34512</strong> &rarr; A=3, B=4, C=5, D=1, E=2</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi C: menerima dengan lapang dada sekaligus terus berusaha &mdash; sikap paling positif dan pantang menyerah</li><li><strong>Bobot 4</strong> &mdash; opsi B: menerima kenyataan dengan kekecewaan yang wajar dan terkendali</li><li><strong>Bobot 3</strong> &mdash; opsi A: menerima keadaan, namun disertai kebencian pada diri sendiri</li><li><strong>Bobot 2</strong> &mdash; opsi E: larut dalam penyesalan tanpa upaya perbaikan</li><li><strong>Bobot 1</strong> &mdash; opsi D: sepenuhnya negatif dan merusak kepercayaan diri</li>',
                'options'       => [
                    ['text' => 'Menerimanya dengan terpaksa dan membenci diri sendiri', 'weight' => 3], // A
                    ['text' => 'Menerimanya, meski tentu saja dengan sedikit kekecewaan', 'weight' => 4], // B
                    ['text' => 'Menerimanya dengan lapang dada, dan berusaha mencoba lagi', 'weight' => 5], // C
                    ['text' => 'Membenci diri saya sendiri.', 'weight' => 1], // D
                    ['text' => 'Meratapi diri sendiri.', 'weight' => 2], // E
                ],
            ],
            // ================= Soal 45 (Integritas) | bobot A-E: 45213 =================
            [
                'question_text' => 'Ketika teman dekat saya meminta bantuan saya untuk melakukan sesuatu yang cenderung melanggar hukum, maka tindakan saya',
                'explanation'   => '<p><strong>Aspek: Integritas</strong></p><p><strong>Kunci Bobot (A-B-C-D-E): 45213</strong> &rarr; A=4, B=5, C=2, D=1, E=3</p><p><strong>Pembahasan:</strong></p><li><strong>Bobot 5</strong> &mdash; opsi B: menolak sekaligus memberi pemahaman kepada teman &mdash; paling berintegritas dan mendidik</li><li><strong>Bobot 4</strong> &mdash; opsi A: tetap menolak permintaan yang melanggar hukum, meskipun caranya kurang tepat</li><li><strong>Bobot 3</strong> &mdash; opsi E: masih membuka peluang melanggar hukum jika risikonya dianggap terjangkau</li><li><strong>Bobot 2</strong> &mdash; opsi C: tetap melanggar hukum meskipun berdalih hanya sekali</li><li><strong>Bobot 1</strong> &mdash; opsi D: mengorbankan integritas demi pertemanan &mdash; sikap paling buruk</li>',
                'options'       => [
                    ['text' => 'Menolak dengan hal yang tidak wajar', 'weight' => 4], // A
                    ['text' => 'Menolak dan menjelaskan alasan mengapa tidak boleh melakukan hal itu', 'weight' => 5], // B
                    ['text' => 'Melakukannya untuk yang pertama dan terakhir kalinya', 'weight' => 2], // C
                    ['text' => 'Karena dia teman dekat saya, maka saya melakukannya kali ini saja', 'weight' => 1], // D
                    ['text' => 'Mempertimbangkan risikonya baru melakukannya kalau memungkinkan saya menanggung risikonya', 'weight' => 3], // E
                ],
            ],
        ];

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

            foreach ($question['options'] as $index => $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option['text'],
                    'is_correct'  => false, // TKP tidak memakai is_correct
                    'image'       => null,
                    'order'       => $index + 1, // urutan A, B, C, D, E sesuai naskah
                    'weight'      => $option['weight'],
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }
        }

        $this->command->info('Seeder TKP TO AGUSTUS berhasil dijalankan!');
        $this->command->info('Material ID : ' . $materialId);
        $this->command->info('Total soal  : ' . count($questions));
    }
}
