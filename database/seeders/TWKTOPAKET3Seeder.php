<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TWKTOPAKET3Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Soal TWK nomor 1-30
        $questions = [
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'UUD NRI tahun 1945 pasca-amandemen telah mengalami perubahan sistem ketatanegaraan Indonesia termasuk tugas dan wewenang MPR-RI. Adapun tugas dan wewenang yang tidak mengalami perubahan adalah MPR-RI...',
                'explanation' => 'Pasca-amandemen, MPR tidak lagi memiliki wewenang untuk menetapkan dan mengubah GBHN, mengangkat Presiden dan Wakil Presiden, serta menetapkan dan mengubah UUD.',
                'options' => [
                    ['Sejajar kedudukannya dengan Lembaga tinggi negara lainnya', 0],
                    ['Tetap berwenang dalam menetapkan dan mengubah GBHN', 0],
                    ['Tetap berwenang untuk mengangkat Presiden dan Wakil Presiden', 0],
                    ['Tetap berwenang dalam menetapkan dan mengubah UUD', 0],
                    ['Susunan keanggotaan terdiri atas DPR dan DPD hasil pemilu', 1],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Perilaku cyber bullying merupakan masalah serius yang saat ini banyak terjadi. Kemudahan mengakses internet yang tidak disertai dengan kesiapan etika bermedia sosial membuat cyber bullying memerlukan penanganan serius. Hal tersebut menyalahi nilai-nilai Pancasila karena...',
                'explanation' => 'Cyber bullying merupakan masalah yang serius dan memang bertentangan dengan nilai-nilai Pancasila. Dari pilihan yang ada, jawaban yang paling tepat adalah: B. Cyber bullying menyalahi nilai kemanusiaan yang beradab. Alasan ini mencerminkan bahwa tindakan cyber bullying tidak sesuai dengan penghormatan terhadap martabat manusia dan nilai-nilai kemanusiaan yang dijunjung tinggi dalam Pancasila.',
                'options' => [
                    ['Nilai-nilai Pancasila tidak boleh membenarkan perundungan', 0],
                    ['Cyber bullying menyalahi nilai kemanusiaan yang beradab', 1],
                    ['Keberadaan Pancasila seharusnya dapat mengatasi cyber bullying', 0],
                    ['Manfaat media sudah ada secara eksplisit dalam nilai Pancasila', 0],
                    ['Menjauhi cyber bullying adalah cerminan rasa persatuan antarsesama', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Seorang tokoh agama dipercaya memimpin doa upacara pembukaan olahraga menurut agama yang dianutnya setelah meminta izin hadirin yang berbeda-beda agamanya. Langkah tokoh agama ini sejalan dengan konsep kebhinekaan bangsa Indonesia karena...',
                'explanation' => 'Langkah tokoh agama yang meminta izin kepada hadirin yang berbeda agama menunjukkan sikap menghormati keberagaman dan prinsip kebhinekaan yang dianut bangsa Indonesia.',
                'options' => [
                    ['Menghormati keberagaman keyakinan beragama', 1],
                    ['Sedia menerima Amanah memimpin doa', 0],
                    ['Bangga memimpin doa bagi semua umat beragama', 0],
                    ['Bertanggung jawab terhadap pilihan isi doanya', 0],
                    ['Setiap pemimpin doa mendoakan kebaikan', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Sikap yang termasuk cerminan sikap cinta tanah air seseorang dalam upaya menunjukkan penghargaan terhadap sumber daya dan budaya bangsanya sendiri adalah...',
                'explanation' => '',
                'options' => [
                    ['Menghormati bendera, lagu kebangsaan, lambang negara, serta simbol-simbol kebangsaan lainnya.', 0],
                    ['Siap menjaga keamanan dan keutuhan negara, baik dengan cara langsung maupun berkontribusi secara sosial.', 0],
                    ['Mendukung produk dalam negeri dan menjaga budaya lokal sebagai upaya memperkuat ekonomi serta melestarikan identitas bangsa di tengah globalisasi.', 1],
                    ['Menghargai sistem yang dibuat pemerintah negara Republik Indonesia untuk kebaikan bersama.', 0],
                    ['Ikut serta dalam program pengabdian masyarakat dan membantu meningkatkan kualitas penegakan hukum.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Sebagai negara yang majemuk, munculnya golongan-golongan yang mempunyai perbedaan dalam sisi pemikiran merupakan hal yang wajar. Namun, bila tidak berhati-hati dapat menjadi sebab yang berujung pada terjadinya konflik. Hal yang harus dilakukan oleh setiap golongan dalam menjaga semangat nasionalisme adalah .....',
                'explanation' => 'Dalam konteks menjaga semangat nasionalisme di negara yang majemuk, pilihan yang paling tepat adalah: C. mengedepankan nilai saling menghargai perbedaan antargolongan. Mengedepankan saling menghargai perbedaan adalah kunci untuk mencegah konflik dan membangun solidaritas antar golongan dalam masyarakat yang beragam.',
                'options' => [
                    ['memperkokoh hubungan internal golongan tersebut', 0],
                    ['memposisikan satu golongan lebih unggul dari lainnya', 0],
                    ['mengedepankan nilai saling menghargai perbedaan antargolongan', 1],
                    ['membangun kecintaan terhadap beberapa golongan saja', 0],
                    ['membangun persaudaraan yang baik di antara warga negara', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Anda menemukan sebuah unggahan di media sosial yang membahas isu agama di Indonesia, yang menurut pandangan Anda kurang tepat berdasarkan pemahaman agama yang Anda miliki. Dalam konteks keberagaman agama, sikap yang paling bijak untuk diambil adalah...',
                'explanation' => '',
                'options' => [
                    ['Menghormati pandangan tersebut dan memberikan dukungan dengan berkomentar positif.', 0],
                    ['Menghormati pandangan tersebut dan menilai unggahan tersebut berdasarkan komentar-komentar lainnya.', 0],
                    ['Menahan diri untuk tidak berkomentar negatif dan melakukan pengecekan lebih lanjut.', 1],
                    ['Melaporkan unggahan tersebut dengan menggunakan fitur report.', 0],
                    ['Meninjau kembali pemahaman agama yang telah Anda miliki.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Yogyakarta adalah tempat berdirinya Perguruan Taman Siswa oleh Ki Hadjar Dewantara pada 3 Juli 1922, yang kemudian dikenal sebagai Bapak Pendidikan Indonesia. Alasan Ki Hadjar Dewantara mendirikan Taman Siswa adalah...',
                'explanation' => '',
                'options' => [
                    ['Sebagai bentuk pengabdian kepada bangsa dan negara.', 0],
                    ['Untuk mendidik rakyat agar berjiwa kebangsaan dan siap memajukan bangsa.', 1],
                    ['Menghargai budaya dan sejarah perjuangan bangsa demi persatuan.', 0],
                    ['Mengajarkan persatuan dan nasionalisme kepada generasi muda.', 0],
                    ['Menanggapi diskriminasi pendidikan yang hanya untuk kaum tertentu.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Menegangnya konflik antarkelompok yang memiliki identitas sosial budaya yang berbeda sering kali muncul pada periode suksesi kepemimpinan, baik daerah maupun nasional. Mengapa Pancasila perlu hadir dan dilestarikan pada suksesi kepemimpinan tersebut?',
                'explanation' => 'Pancasila berfungsi sebagai dasar untuk menjaga persatuan dan kesatuan di tengah keragaman.',
                'options' => [
                    ['Supaya kelompok mana pun yang menjadikan Pancasila sebagai jargon bisa menang.', 0],
                    ['Supaya nilai persatuan bangsa tetap dijunjung tinggi di atas kepentingan kelompok.', 1],
                    ['Supaya kemanusiaan sebagai nilai universal bisa menjadi diskursus utama', 0],
                    ['Supaya identitas keagamaan dijunjung lebih tinggi daripada identitas lainnya.', 0],
                    ['Supaya perhelatan demokrasi di Indonesia menjadi wujud kebebasan warga negara.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Pada saat sidang Panitia 9 yang membahas undang-undang dasar negara terjadi perdebatan mengenai pelindungan HAM atas kebebasan berserikat, berkumpul, dan berpendapat. Soekarno dan Soepomo tidak menyetujui konsep pelindungan HAM tersebut dimasukkan ke dalam UUD, sedangkan M. Hatta dan M. Yamin memiliki pandangan yang sebaliknya. Pada akhirnya pelindungan kebebasan berserikat dan mengemukakan pendapat dimasukkannya ke dalam Pasal 28 UUD. Berdasarkan ilustrasi di atas, tindakan menuliskan Pasal 28 UUD tersebut dapat dicapai karena adanya.',
                'explanation' => 'Perdebatan antara berbagai pandangan menunjukkan bahwa akhirnya tercapai kesepakatan melalui kompromi.',
                'options' => [
                    ['pihak yang memonopoli sidang.', 0],
                    ['pihak yang mengalah dalam sidang.', 0],
                    ['kompromi di antara anggota sidang.', 1],
                    ['sikap superior di antara anggota sidang.', 0],
                    ['sikap inferior di antara anggota sidang.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Seorang mahasiswa dari suku terpencil mengalami kesulitan dalam memahami budaya tempatnya berkuliah. Teman-teman kuliahnya membantunya dalam memahami budaya setempat. Makna dari peristiwa ini adalah',
                'explanation' => 'Makna dari peristiwa di atas adalah: B. meskipun berbeda suku, kita harus saling membantu. Peristiwa ini menunjukkan pentingnya saling membantu dan mendukung antar individu dari latar belakang yang berbeda untuk menciptakan pemahaman dan harmoni dalam masyarakat.',
                'options' => [
                    ['orang dari semua wilayah mempunyai persamaan budaya', 0],
                    ['meskipun berbeda suku, kita harus saling membantu', 1],
                    ['semua suku-suku yang ada di Indonesia adalah sama', 0],
                    ['mahasiswa Indonesia harus mempelajari semua budaya', 0],
                    ['semua perguruan tinggi wajib menerima mahasiswa dari wilayah terpencil', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Saifuddin Zuhri. Menteri Agama di Kabinet Dwikora I, pernah menolak permintaan adik iparnya untuk diberangkatkan ke tanah suci untuk menunaikan ibadah haji dengan menggunakan fasilitas Kementerian Agama yang dipimpinnya. Berikut ini adalah alasan yang menunjukkan Saifuddin Zuhri melakukan tindakan berintegritas, yaitu',
                'explanation' => 'Menolak permintaan adik iparnya untuk menggunakan fasilitas kementerian menunjukkan bahwa ia memegang prinsip amanah dan tidak menyalahgunakan jabatannya.',
                'options' => [
                    ['berbuat baik', 0],
                    ['bertindak Amanah', 1],
                    ['menerima konsekuensi', 0],
                    ['memikirkan orang lain', 0],
                    ['berani menanggung risiko', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Suatu kelas terdiri atas siswa-siswa yang berasal dari berbagai suku. Mereka menghormati satu sama lain. Tugas-tugas dari guru dikerjakan secara berkelompok lintas suku. Hubungan integritas dan Bhinneka Tunggal Ika pada peristiwa ini adalah',
                'explanation' => 'Penghormatan satu sama lain di antara siswa dari berbagai suku mencerminkan semangat Bhinneka Tunggal Ika dan menunjukkan bahwa perbedaan dapat memperkuat persatuan.',
                'options' => [
                    ['semua siswa harus mempelajari budaya semua suku', 0],
                    ['sekolah harus menyediakan guru-guru dari berbagai suku', 0],
                    ['semua suku-suku di Indonesia perlu saling mempelajari', 0],
                    ['penghormatan terhadap perbedaan menciptakan kebersamaan', 1],
                    ['Indonesia memiliki berbagai macam suku, agama, ras, dan etnis', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Untuk melaksanakan tugas menyelidiki segala sesuatu mengenai persiapan kemerdekaan Indonesia, BPUPKI telah membentuk beberapa Panitia Kerja, Panitia Perancang UUD yang diketuai Ir. Soekarno dan..',
                'explanation' => 'Soepomo adalah salah satu tokoh penting dalam perumusan UUD.',
                'options' => [
                    ['Abikusno Tjokrosuyoso', 0],
                    ['Moh. Hatta', 0],
                    ['Muhammad Yamin', 0],
                    ['Soepomo', 1],
                    ['Ahmad Subardjo', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Saat ini bangsa Indonesia dihadapkan pada tantangan mewujudkan kemandirian, karena dapat mempengaruhi eksistensinya di tengah perkembangan global. Berikut ini bukti menghadapi tantangan kemandirian bangsa untuk mewujudkan kekuatan bangsa dalam bidang ekonomi, yakni .....',
                'explanation' => 'Bukti menghadapi tantangan kemandirian bangsa dalam bidang ekonomi adalah: B. menguatkan wirausaha berbasis potensi lokal untuk meningkatkan ekonomi rakyat. Pendekatan ini mendukung pengembangan ekonomi yang berkelanjutan dan memberdayakan masyarakat.',
                'options' => [
                    ['melindungi pengusaha kecil dengan melarang masuknya investasi dari luar negeri', 0],
                    ['menguatkan wirausaha berbasis potensi lokal untuk meningkatkan ekonomi rakyat', 1],
                    ['memasarkan barang-barang produksi luar negeri untuk meningkatkan daya beli', 0],
                    ['mendirikan kegiatan usaha untuk memperoleh bantuan dana dari pemerintah', 0],
                    ['meniru barang-barang produksi luar negeri agar tidak perlu mengimpor', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Aktualisasi nilai-nilai nasionalisme salah satunya dilakukan dengan menggunakan produk-produk dalam negeri. Upaya ini dapat mempertahankan keutuhan NKRI dengan alasan karena',
                'explanation' => 'Menggunakan produk dalam negeri dapat membantu meningkatkan ekonomi lokal, yang berkontribusi pada keutuhan NKRI.',
                'options' => [
                    ['mengurangi hutang pengusaha', 0],
                    ['meningkatkan usaha ekonomi rakyat', 1],
                    ['membatasi masuknya barang luar', 0],
                    ['melakukan liberalisasi ekonomi', 0],
                    ['memperbanyak jumlah koperasi', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Upaya penegakan hukum terhadap berbagai pelaku tindak pidana kejahatan internasional dengan menerapkan hukuman mati akan memberikan efek jera bagi pelaku tindak kejahatan lain. Strategi tersebut sangat sesuai untuk diterapkan karena hal tersebut adalah bagian dari upaya bela negara untuk mempertahankan .....',
                'explanation' => 'Penegakan hukum terhadap pelaku kejahatan internasional dengan hukuman mati berhubungan langsung dengan kedaulatan negara dan keamanan nasional.',
                'options' => [
                    ['kedaulatan negara', 1],
                    ['kehormatan negara', 0],
                    ['kebijakan pemerintah', 0],
                    ['kedaulatan politik', 0],
                    ['kepentingan ekonomi', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Menurut UUD RI 1945 Pasal 24C, dinyatakan bahwa Mahkamah Konstitusi berwenang mengadili pada tingkat pertama dan terakhir yang putusannya bersifat final untuk menguji undang-undang terhadap Undang-Undang Dasar. Kewenangan tersebut mencerminkan penerapan paham konstitusionalisme yang berupa ....',
                'explanation' => 'Kewenangan Mahkamah Konstitusi untuk menguji undang-undang mencerminkan supremasi konstitusi sebagai prinsip konstitusionalisme.',
                'options' => [
                    ['supremasi konstitusi', 1],
                    ['supremasi BPUPKI, PPKI, dan MPR', 0],
                    ['kedaulatan rakyat yang dipegang lembaga hasil pemilihan umum', 0],
                    ['kewenangan DPR dan Presiden membuat RUU revisi putusan MK', 0],
                    ['supremasi MPR sebagai wujud kedaulatan rakyat hasil pemilihan umum', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Untuk mengamalkan nilai Pancasila sebagai wujud aktualisasi Sila Persatuan Indonesia yang diutamakan adalah ....',
                'explanation' => 'Aktualisasi Sila Persatuan Indonesia lebih menekankan pada kepentingan bersama bangsa dan negara.',
                'options' => [
                    ['untuk menjamin pengakuan harkat dan martabat manusia', 0],
                    ['mewujudkan kebebasan dalam menjalankan ibadah', 0],
                    ['mewujudkan masyarakat yang Sejahtera', 0],
                    ['memenuhi kepentingan bangsa dan negara', 1],
                    ['mewujudkan kepentingan kelompok', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Menghargai harkat dan martabat manusia telah lama ditunjukkan oleh bangsa Indonesia. Hal itu dibuktikan antara lain dalam bentuk berikut ini.',
                'explanation' => 'Tradisi ini menunjukkan penghargaan terhadap harkat dan martabat manusia melalui kegiatan sosial yang melibatkan masyarakat.',
                'options' => [
                    ['Orang Jawa mengakui adanya pembedaan santri, abangan, dan priayi.', 0],
                    ['Dianutnya budaya siri’ oleh masyarakat Bugis-Makassar.', 0],
                    ['Adanya pepatah Jawa, mangan ora mangan waton kumpul.', 0],
                    ['Adanya pepatah Minang, menang jadi arang, kalah jadi abu.', 0],
                    ['Adanya tradisi bersih desa dengan beragam coraknya.', 1],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Ketika bencana alam terjadi di suatu wilayah, negara langsung hadir memberikan bantuan kemanusiaan sebagai bentuk perwujudan nilai-nilai Pancasila dalam kehidupan bernegara. Berikut yang merupakan salah satu bukti bahwa Pancasila sebagai dasar negara, yaitu',
                'explanation' => 'Ini menunjukkan bahwa Pancasila dijadikan dasar dalam setiap aspek kebijakan pemerintah, termasuk dalam penanganan bencana alam.',
                'options' => [
                    ['nilai kemanusiaan menjadi dasar utama dalam penyelenggaraan pemerintahan dan pembuatan kebijakan negara.', 1],
                    ['negara akan membuat kebijakan terkait penanganan bencana alam didasarkan pada Pancasila.', 0],
                    ['nilai-nilai Pancasila menjadi acuan dasar dalam pemilihan warga yang akan diberikan bantuan kemanusiaan.', 0],
                    ['pemberian bantuan kemanusiaan kepada korban bencana alam didasarkan pada kesamaan kepentingan:', 0],
                    ['Pancasila dijadikan sebagai dasar dalam penyelenggaraan pemerintahan dan penentuan kebijakan negara.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Rancangan undang-undang yang berkaitan dengan otonomi daerah, hubungan pusat dan daerah, pembentukan atau pemekaran daerah dapat batal demi hukum jika dalam pembahasannya tidak melibatkan....',
                'explanation' => 'Rancangan undang-undang yang berkaitan dengan otonomi daerah, hubungan pusat dan daerah, pembentukan atau pemekaran daerah dapat batal demi hukum jika dalam pembahasannya tidak melibatkan... C. DPR, presiden dan DPD',
                'options' => [
                    ['DPR, Presiden dan DPD', 1],
                    ['DPR, presiden dan DPRD', 0],
                    ['DPR, presiden dan Masyarakat', 0],
                    ['DPR, presiden dan tokoh adat', 0],
                    ['DPR, presiden dan kepala daerah', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Pasal 29 UUD Negara RI Tahun 1945 secara jelas mengatur tentang bidang agama. Alasan yang mendasari pentingnya bidang agama diatur dalam konstitusi adalah .....',
                'explanation' => 'Pasal 29 UUD Negara RI Tahun 1945 secara jelas mengatur tentang bidang agama. Alasan yang mendasari pentingnya bidang agama diatur dalam konstitusi adalah ..... B. Indonesia merupakan negara yang tidak memisahkan urusan agama dan negara',
                'options' => [
                    ['agar tidak muncul agama baru di Indonesia yang berseberangan dengan Pancasila', 0],
                    ['Indonesia merupakan negara yang tidak memisahkan urusan agama dan negara', 1],
                    ['warga negara akan merasa khusyuk dan nyaman dalam menjalankan ibadah', 0],
                    ['Indonesia merupakan negara yang mendasarkan pemerintahan berdasarkan agama tertentu', 0],
                    ['seringnya muncul konflik horizontal yang mengatasnamakan agama tertentu', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Di suatu kompleks perumahan tampak penghuninya sedang bekerja bakti dengan penuh semangat dan kekeluargaan meskipun berasal dari berbagai latar belakang etnis dan budaya. Salah satu bukti yang menunjukkan bahwa keberagaman tersebut dapat mendorong persatuan masyarakat tersebut adalah....',
                'explanation' => 'Di suatu kompleks perumahan tampak penghuninya sedang bekerja bakti dengan penuh semangat dan kekeluargaan meskipun berasal dari berbagai latar belakang etnis dan budaya. Salah satu bukti yang menunjukkan bahwa keberagaman tersebut dapat mendorong persatuan masyarakat tersebut adalah.... A. sikap saling menghargai antarwarga',
                'options' => [
                    ['sikap saling menghargai antarwarga', 1],
                    ['pandangan positif masyarakat tentang pendidikan', 0],
                    ['penerapan pendekatan dialog dalam Masyarakat', 0],
                    ['kesediaan memberikan saran yang konstruktif', 0],
                    ['adanya kesadaran individual yang bersifat temporal', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Salah satu lembaga negara baru yang terbentuk setelah amendemen UUD NRI Tahun 1945 adalah Mahkamah Konstitusi (MK). Keberadaan MK dalam sistem ketatanegaraan Indonesia sangat penting karena',
                'explanation' => 'Salah satu lembaga negara baru yang terbentuk setelah amendemen UUD NRI Tahun 1945 adalah Mahkamah Konstitusi (MK). Keberadaan MK dalam sistem ketatanegaraan Indonesia sangat penting karena A. perlu ada lembaga yang memutus pembubaran parpol dan perselisihan tentang hasil pemilihan umum',
                'options' => [
                    ['perlu ada lembaga yang memutus pembubaran parpol dan perselisihan tentang hasil pemilihan umum', 1],
                    ['perlu ada lembaga baru yang melaksanakan amanat demokrasi Pancasila setelah proses reformasi', 0],
                    ['setelah reformasi, perlu ada lembaga baru yang diberi amanat untuk melaksanakan pemilihan umum', 0],
                    ['masih sering terjadi tumpang tindih peraturan perundang-undangan dalam sistem ketatanegaraan Indonesia', 0],
                    ['Demokrasi Pancasila dapat terlaksana dengan baik jika ada lembaga baru di Indonesia yang independent', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Wakil Dekan menyatakan, Fakultas Farmasi memanfaatkan momentum pembelajaran daring ini untuk membangun atmosfer akademik yang kondusif bagi sivitas akademika agar lebih tangguh, adaptif, dan mampu menjadi leader dalam digital society. Perbaikan ejaan yang salah dalam kalimat tersebut adalah .....',
                'explanation' => 'Perbaikan ejaan yang salah dalam kalimat tersebut adalah: A. Setelah menyatakan tidak ada tanda koma (,) seharusnya koma diganti dengan bahwa.',
                'options' => [
                    ['Setelah menyatakan tidak ada tanda koma (.)', 1],
                    ['Fakultas Farmasi seharusnya fakultas farmasi', 0],
                    ['daring seharusnya dicetak miring', 0],
                    ['atmosfer seharusnya atmosfir', 0],
                    ['Setelah adaptif tidak ada tanda koma (.)', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Dalam acara Pameran Kebudayaan Rakyat, masyarakat Desa Tumbuhan mempertunjukkan keahlian mereka dalam menganyam beraneka jenis tikar lampit, tikar yang terbuat dari rotan, yang bisa digunakan untuk mengalas lantai. Perbaikan kata bentukan yang salah pada kalimat tersebut adalah',
                'explanation' => 'Perbaikan kata bentukan yang salah pada kalimat tersebut adalah: B. mempertunjukkan seharusnya menunjukkan. Karena sebelumnya sudah ada kata pameran yang bermakna tontonan.',
                'options' => [
                    ['pameran seharusnya pertunjukan', 0],
                    ['mempertunjukkan seharusnya menunjukkan', 1],
                    ['terbuat seharusnya dibuat', 0],
                    ['beraneka seharusnya bermacam', 0],
                    ['mengalas seharusnya mengalasi', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Ama Nara memeluk anaknya. Mereka berbagi jalan di simpang ke arah pasar dan sekolah. Ama Nara bergegas ke pasar Rabuan Kewuta Harun Bala menemui para breun-nya. Ia membawa sedikit ubi ungu dan beras merah yang baru dipanennya. Biasanya, breun-nya, seperti Paman Kadir dan Bibi Kadijah, sudah menyiapkan ikan sembe, garam, tembakau Boleng, dan gurita kering untuknya. Namun ada yang berubah sejak sepuluh tahun terakhir. Tepatnya sejak pasar Kewuta Harun Bala direlokasi. Pemerintah membangun ruko di tempat baru yang lebih banyak dihuni oleh pedagang besar dan berduit. Pasar ditata lebih rapi. Barang-barang, seperti beras, jagung, minyak goreng, dan garam, yang didatangkan dari luar dalam jumlah besar dan terkemas bagus membuat Ama Nara kerap merasa bahwa pasar bukan lagi diperuntukkan bagi orang seperti dirinya. Nilai sosial dalam kutipan cerpen tersebut adalah',
                'explanation' => 'Nilai merupakan pesan yang terkandung dalam teks. Nilai sosial dalam kutipan cerpen tersebut adalah: D. penataan pasar untuk kebaikan si kaya.',
                'options' => [
                    ['perubahan adalah hal yang niscaya di dunia', 0],
                    ['mengikuti perubahan sesuai kemajuan zaman', 0],
                    ['tidak perlunya lagi budaya barter di pasar', 0],
                    ['penataan pasar untuk kebaikan si kaya', 1],
                    ['orang kaya bisa makin kaya', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => '(1) Badan Meteorologi, Klimatologi, dan Geofisika memperkirakan hujan dengan intenstitas sedang hingga lebat akan melanda Jakarta selama sepekan ke depan. (2) Hujan dengan intensitas sedang hingga lebat tersebut diperkirakan terjadi pada dini hari hingga pagi. (3) Wilayah dengan intensitas hujan tinggi adalah Jakarta Utara, Jakarta Barat, dan Kepulauan Seribu. (4) Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi pada saat siang hari hingga sore hari saja. (5) Meskipun belum ada tanda-tanda cuaca ekstrem, warga yang beraktivitas di luar rumah diimbau untuk mewaspadai angin kencang dan petir. Perbaikan kalimat (4) agar menjadi kalimat efektif adalah',
                'explanation' => 'Perbaikan kalimat (4) agar menjadi kalimat efektif adalah menghilangkan kata pada karena kalimat tersebut sudah terhimpun dalam kalimat perincian yang diawali dengan kata depan “di” sebelum kalimatnya dirincikan: B. Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi saat siang hari hingga sore hari saja.',
                'options' => [
                    ['Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi pada siang hari hingga sore hari saja.', 0],
                    ['Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi saat siang hari hingga sore hari saja.', 1],
                    ['Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi siang hari hingga sore hari saja.', 0],
                    ['Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi sewaktu siang hingga sore hari saja.', 0],
                    ['Sementara itu, di wilayah timur dan selatan Jakarta, hujan umumnya hanya terjadi pada siang hingga sore hari.', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Memiliki luas 52 hektare dengan tumpukan sampah menjulang lebih dari 60 meter, tempat pembuangan akhir di New Delhi dipenuhi oleh limbah plastik dari alat uji virus corona, alat pelindung diri (APD), dan kapas bernoda darah dan nanah. Ratusan ton limbah itu datang dari seluruh penjuru ibu kota India, di antaranya rumah sakit kecil dan panti jompo. Para ahli mengatakan adanya risiko besar bagi mereka yang bekerja di sana untuk terinfeksi virus corona. Mengais dengan tangan kosong, ratusan pemulung termasuk anak-anak memaparkan diri mereka pada virus corona yang telah menginfeksi lebih dari 15 juta orang di seluruh dunia dan merenggut lebih dari 600.000 jiwa. Ide pokok paragraf tersebut adalah',
                'explanation' => 'Ide pokok paragraf tersebut adalah: C. risiko para pemulung terpapar virus corona. Ide pokok terletak pada kalimat utama, kata kunci dalam kalimat utamanya adalah pemulung memaparkan diri mereka pada virus corona.',
                'options' => [
                    ['luas tempat pembuangan akhir di New Delhi', 0],
                    ['limbah medis di tempat pembuangan akhir', 0],
                    ['risiko para pemulung terpapar virus corona', 1],
                    ['jumlah korban virus corona di seluruh dunia', 0],
                    ['aktivitas pemulung di tempat pembuangan akhir', 0],
                ],
            ],
            [
                'material_id' => 32,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Untuk mendorong transformasi pendidikan tinggi, pemerintah menetapkan delapan indikator kualitas. Kedelapan indikator tersebut, yaitu lulusan mendapat pekerjaan layak, mahasiswa memperoleh pengalaman di luar kampus, dosen berkegiatan di luar kampus, praktisi mengajar di kampus, program studi bekerja sama dengan mitra kelas dunia, program studi memiliki standar internasional, dan adanya kelas kolaboratif dan partisipatif. Delapan indikator kualitas merupakan efisiensi dari sejumlah indikator yang harus dicapai oleh sebuah perguruan tinggi. Rangkaian kebijakan yang dituangkan dalam indikator kualitas pada akhirnya dapat menguntungkan mahasiswa. Pada saat memasuki dunia kerja, mahasiswa tidak merasa kaget dan canggung. Hal ini karena selama masa kuliah, mahasiswa telah memperoleh kelas kolaboratif dan proyek pengalaman lintas program studi dan luar kampus. Peluang mahasiswa dapat terserap di dunia kerja lebih besar dan bahkan memiliki keterampilan berwirausaha secara mandiri. (Kompas, November 2020) Simpulan dua paragraf tersebut adalah ....',
                'explanation' => 'Simpulan dua paragraf tersebut adalah: C. Untuk mendorong transformasi pendidikan tinggi, pemerintah menetapkan delapan indikator kualitas agar mahasiswa dapat terserap di dunia kerja dan memiliki keterampilan berwirausaha secara mandiri. Simpulan tersebut diambil dari gabungan intisari paragraf pertama dan paragraf kedua.',
                'options' => [
                    ['Selama masa kuliah, mahasiswa telah memperoleh kelas kolaboratif dan proyek pengalaman lintas program studi dan luar kampus agar siap di dunia kerja dan memiliki keterampilan berwirausaha secara mandiri.', 0],
                    ['Untuk mendorong transformasi pendidikan tinggi, pemerintah menetapkan delapan indikator kualitas yang merupakan efisiensi dari sejumlah indikator yang harus dicapai oleh sebuah perguruan tinggi.', 0],
                    ['Untuk mendorong transformasi pendidikan tinggi, pemerintah menetapkan delapan indikator kualitas agar mahasiswa dapat terserap di dunia kerja dan memiliki keterampilan berwirausaha secara mandiri.', 1],
                    ['Rangkaian kebijakan yang dituangkan dalam indikator kualitas pada akhirnya dapat menguntungkan mahasiswa sehingga pada saat memasuki dunia kerja mereka tidak merasa kaget dan canggung.', 0],
                    ['Pemerintah menetapkan delapan indikator kualitas untuk mendorong transformasi pendidikan tinggi dalam rangka menyiapkan lulusan yang siap memasuki dunia kerja dan memiliki kemandirian berwirausaha.', 0],
                ],
            ],
        ];

        foreach ($questions as $index => $questionData) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $order = 1;
            foreach ($questionData['options'] as $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option[0],
                    'is_correct' => $option[1],
                    'order' => $order++,
                    'weight' => 0, // untuk TWK weight tidak dipakai
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder untuk TWK Paket 3 (30 soal) berhasil ditambahkan.');
    }
}
