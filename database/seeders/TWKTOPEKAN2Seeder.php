<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TWKTOPEKAN2Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Material dengan id = 50 (TWK)
        $materialId = 37;

        $questions = [
            // Soal 1
            [
                'question_text' => 'Dinamika pelaksanaan UUD 1945 sejak memasuki era Orde Baru diwarnai hal yang baru terkait dengan pembangunan nasional. Apakah hal yang baru sebagaimana dimaksud?',
                'options' => [
                    ['text' => 'Dilaksanakannya pembangunan nasional semester berencana', 'is_correct' => false],
                    ['text' => 'Dilaksanakannya pembangunan nasional melalui Repelita', 'is_correct' => true],
                    ['text' => 'Penekanan pada pembangunan bidang politik nasional', 'is_correct' => false],
                    ['text' => 'Pelaksanaan pembangunan ekonomi untuk kesejahteraan rakyat', 'is_correct' => false],
                    ['text' => 'Dilaksanakannya pembangunan pada segala bidang', 'is_correct' => false],
                ],
                'explanation' => 'Pada era Orde Baru, pembangunan nasional dilaksanakan melalui Rencana Pembangunan Lima Tahun (Repelita) yang merupakan sistem perencanaan pembangunan berjangka.',
            ],
            // Soal 2
            [
                'question_text' => 'Dalam suatu pertandingan, seorang pemain sepak bola melakukan tekel keras kepada pemain lawan. Pemain tersebut memang sudah menginginkan agar pemain lawan tersebut tidak bisa melanjutkan pertandingan. Tindakan tersebut dapat dipandang sebagai perilaku yang bertentangan dengan nilai-nilai Pancasila sebab...',
                'options' => [
                    ['text' => 'berperilaku merendahkan martabat orang lain', 'is_correct' => false],
                    ['text' => 'melakukan tindakan yang tidak jujur', 'is_correct' => false],
                    ['text' => 'menciptakan pertentangan antarpemain', 'is_correct' => true],
                    ['text' => 'melanggar kewajiban sebagai pemain', 'is_correct' => false],
                    ['text' => 'mengkhianati rasa setia kawan', 'is_correct' => false],
                ],
                'explanation' => 'Tindakan tersebut menciptakan pertentangan antarpemain, yang bertentangan dengan sila ketiga Pancasila yaitu Persatuan Indonesia.',
            ],
            // Soal 3
            [
                'question_text' => 'Untuk memperingati Hari Sumpah Pemuda, ketua Rukun Warga (RW) mengajak seluruh warga untuk berpartisipasi. Tujuannya agar semangat keberagaman di lingkungannya tetap terjaga dan dihormati sejalan dengan abad teknologi informasi. Atas ajakan tersebut, bentuk partisipasi yang tepat adalah...',
                'options' => [
                    ['text' => 'menyiapkan parade pakaian', 'is_correct' => false],
                    ['text' => 'mengajak warga lain ikut', 'is_correct' => false],
                    ['text' => 'membuka donasi kegiatan', 'is_correct' => false],
                    ['text' => 'menyebarkan info tersebut', 'is_correct' => true],
                    ['text' => 'menyiapkan tempat acara', 'is_correct' => false],
                ],
                'explanation' => 'Dalam era teknologi informasi, bentuk partisipasi yang tepat adalah menyebarkan informasi tentang kegiatan tersebut agar lebih banyak warga yang mengetahui dan ikut berpartisipasi.',
            ],
            // Soal 4
            [
                'question_text' => 'Negara-negara Asia Tenggara pada Konferensi Tingkat Tinggi (KTT) ASEAN di Thailand menyepakati Deklarasi Bangkok tentang memerangi sampah laut di Kawasan ASEAN. Adapun peran Indonesia adalah...',
                'options' => [
                    ['text' => 'memperjelas hukum mengenai sistem ekspor impor', 'is_correct' => false],
                    ['text' => 'membuka kerja sama perlindungan hewan laut', 'is_correct' => false],
                    ['text' => 'melakukan kerja sama untuk membersihkan laut', 'is_correct' => true],
                    ['text' => 'mengurangi produk industri yang berbahan plastik', 'is_correct' => false],
                    ['text' => 'mengurangi dan menolak impor dari luar negeri', 'is_correct' => false],
                ],
                'explanation' => 'Peran Indonesia dalam deklarasi tersebut adalah melakukan kerja sama dengan negara-negara ASEAN lainnya untuk membersihkan laut dari sampah.',
            ],
            // Soal 5
            [
                'question_text' => 'Berdasarkan jejak sejarah konflik yang disebabkan perbedaan pandangan cara bernegara telah terjadi sejak awal kemerdekaan Indonesia. Hal-hal yang dapat dilakukan untuk mencegah agar tidak terjadi kembali konflik tersebut adalah...',
                'options' => [
                    ['text' => 'menciptakan pertahanan militer yang kuat', 'is_correct' => false],
                    ['text' => 'membatasi kebebasan rakyat untuk berpendapat', 'is_correct' => false],
                    ['text' => 'memberikan doktrin kebangsaan', 'is_correct' => false],
                    ['text' => 'menyamakan pandangan tentang bernegara', 'is_correct' => false],
                    ['text' => 'menanamkan semangat dan komitmen kebangsaan', 'is_correct' => true],
                ],
                'explanation' => 'Pencegahan konflik akibat perbedaan pandangan dapat dilakukan dengan menanamkan semangat dan komitmen kebangsaan kepada seluruh rakyat Indonesia.',
            ],
            // Soal 6
            [
                'question_text' => 'Salah satu pergerakan untuk mencapai kemerdekaan diwarnai oleh lahirnya Sarekat Dagang Islam yang didirikan oleh Haji Samanhudi di Solo pada 1911. Gerakan ini berusaha membangun kekuatan serta persatuan bangsa melalui penguatan dalam bidang...',
                'options' => [
                    ['text' => 'Ekonomi melalui pelindungan pengusaha lokal agar mampu bersaing dengan pengusaha nonlocal', 'is_correct' => true],
                    ['text' => 'kebudayaan melalui pengembangan kesenian-kesenian daerah agar mampu mengharumkan nama baik Indonesia', 'is_correct' => false],
                    ['text' => 'pendidikan melalui pengajaran serta menjadi pemantik persatuan dan kesatuan bangsa Indonesia', 'is_correct' => false],
                    ['text' => 'keagamaan yang memobilisasi gerakan rakyat dengan dasar keyakinan pada nilai-nilai Ketuhanan', 'is_correct' => false],
                    ['text' => 'politik melalui pengembangan kebijakan yang berpihak masyarakat lokal dibanding masyarakat nonlocal', 'is_correct' => false],
                ],
                'explanation' => 'Sarekat Dagang Islam (SDI) didirikan untuk melindungi pengusaha lokal (pribumi) agar mampu bersaing dengan pengusaha nonpribumi, terutama di bidang ekonomi.',
            ],
            // Soal 7
            [
                'question_text' => 'Sekelompok ibu-ibu mengadakan kegiatan arisan. Seorang anggota menawarkan suatu produk tabungan kepada peserta lain dengan iming-iming bunga yang lebih tinggi daripada bunga bank. Tawaran tersebut membuat banyak anggota tertarik menyetorkan tabungan. Uang tabungan katanya akan digunakan untuk investasi di berbagai bisnis. Padahal, uang tersebut hanya dipinjamkan lagi dengan bunga yang lebih tinggi lagi. Berdasarkan peristiwa tersebut, tindakan yang bertentangan dengan integritas adalah...',
                'options' => [
                    ['text' => 'pemutaran kembali uang tabungan untuk pinjaman berbunga tinggi', 'is_correct' => true],
                    ['text' => 'penawaran produk tabungan dengan bunga yang lebih tinggi daripada bunga bank', 'is_correct' => false],
                    ['text' => 'banyak anggota yang tergiur dengan keuntungan bunga yang tinggi', 'is_correct' => false],
                    ['text' => 'penggunaan arisan sebagai wahana menawarkan berbagai produk', 'is_correct' => false],
                    ['text' => 'kegiatan arisan yang dilakukan tanpa tujuan yang jelas', 'is_correct' => false],
                ],
                'explanation' => 'Pemutaran uang tabungan untuk pinjaman berbunga tinggi (money game) adalah tindakan yang tidak transparan dan merugikan, bertentangan dengan nilai integritas.',
            ],
            // Soal 8
            [
                'question_text' => 'Dalam perumusan dan penetapan UUD NRI Tahun 1945 dalam sidang BPUPK dan PPKI, ada yang menjabat sebagai Ketua Panitia Persiapan Kemerdekaan Indonesia, Ketua Panitia Perancangan Ekonomi, konseptor naskah teks proklamasi kemerdekaan, dan sebagainya. Dalam hal ini, nilai persatuan ditunjukkan dengan adanya kerja sama pendiri negara berdasarkan...',
                'options' => [
                    ['text' => 'profesinya masing-masing', 'is_correct' => false],
                    ['text' => 'penunjukan masing-masing', 'is_correct' => false],
                    ['text' => 'ahlinya masing-masing', 'is_correct' => false],
                    ['text' => 'perannya masing-masing', 'is_correct' => true],
                    ['text' => 'kerelaan hati masing-masing', 'is_correct' => false],
                ],
                'explanation' => 'Nilai persatuan ditunjukkan dengan kerja sama para pendiri negara berdasarkan perannya masing-masing dalam mempersiapkan kemerdekaan Indonesia.',
            ],
            // Soal 9
            [
                'question_text' => 'Negara Indonesia sangat menjunjung tinggi persatuan Indonesia berdasarkan Pancasila. Saat ini masih terdapat gerakan separatisme di beberapa wilayah di Indonesia. Hal tersebut bertentangan dengan Pancasila dan UUD. Penolakan terhadap separatisme perlu terus ditumbuhkan dalam diri warga negara karena hal ini...',
                'options' => [
                    ['text' => 'dapat memperkuat kepercayaan diri bangsa', 'is_correct' => false],
                    ['text' => 'dapat menyatukan perbedaan di setiap wilayah', 'is_correct' => false],
                    ['text' => 'memperkuat persatuan dan keutuhan NKRI', 'is_correct' => true],
                    ['text' => 'meningkatkan dan memperkuat rasa kesukuan', 'is_correct' => false],
                    ['text' => 'meringankan beban TNI dalam menjaga NKRI', 'is_correct' => false],
                ],
                'explanation' => 'Penolakan terhadap separatisme perlu terus ditumbuhkan karena dapat memperkuat persatuan dan keutuhan Negara Kesatuan Republik Indonesia.',
            ],
            // Soal 10
            [
                'question_text' => 'Perumusan dan penetapan UUD Republik Indonesia dilakukan oleh tokoh-tokoh yang berasal dari berbagai suku yang berbeda-beda. Namun para tokoh mampu bersatu dalam merumuskan UUD 1945 yang disepakati oleh seluruh rakyat Indonesia yang terkenal pluralis. Makna yang dapat diambil dari peristiwa ini adalah...',
                'options' => [
                    ['text' => 'saat rapat tokoh bangsa lebih mementingkan golongannya', 'is_correct' => false],
                    ['text' => 'persatuan dapat terwujud jika mengikuti perintah pimpinan', 'is_correct' => false],
                    ['text' => 'sukuisme dapat memperkuat persatuan bangsa Indonesia', 'is_correct' => false],
                    ['text' => 'sikap pluralis dapat dilakukan jika memiliki persamaan', 'is_correct' => false],
                    ['text' => 'perbedaan suku tidak menjadi penghalang untuk bersatu', 'is_correct' => true],
                ],
                'explanation' => 'Makna yang dapat diambil adalah bahwa perbedaan suku tidak menjadi penghalang untuk bersatu dalam mencapai tujuan bersama.',
            ],
            // Soal 11
            [
                'question_text' => 'Setelah mundur dari jabatannya sebagai wakil presiden, Drs. Moh. Hatta mendapatkan banyak tawaran untuk menempati berbagai jabatan dari tingkat nasional sampai tingkat internasional. Namun, Hatta menolak semuanya dan memilih untuk hidup dari uang pensiun. Mengapa perilaku tersebut mencerminkan integritas terhadap bangsa Indonesia?',
                'options' => [
                    ['text' => 'Perilaku tersebut mencerminkan pribadi yang oportunis', 'is_correct' => false],
                    ['text' => 'Perilaku tersebut mencerminkan sosok yang tidak mengejar jabatan dan harta', 'is_correct' => true],
                    ['text' => 'Perilaku tersebut mencerminkan pribadi yang menghindari kemajuan nasional', 'is_correct' => false],
                    ['text' => 'Perilaku tersebut mencerminkan sosok yang progresif dan rendah hati', 'is_correct' => false],
                    ['text' => 'Perilaku tersebut mencerminkan pribadi yang dekat dengan orang banyak', 'is_correct' => false],
                ],
                'explanation' => 'Perilaku Hatta mencerminkan integritas karena beliau adalah sosok yang tidak mengejar jabatan dan harta, lebih memilih hidup sederhana dengan uang pensiun.',
            ],
            // Soal 12
            [
                'question_text' => 'Beberapa kali integrasi bangsa kita menjadi taruhan ketika terjadi konflik SARA yang besar, tetapi semangat bersatu dalam segala perbedaan dapat menjaga kesatuan bangsa kita. Berdasarkan pernyataan di atas, tindakan yang sesuai dengan persatuan dalam keberagaman adalah...',
                'options' => [
                    ['text' => 'harus menang dalam berkonflik apa pun yang terjadi', 'is_correct' => false],
                    ['text' => 'berani mengemukakan apa yang dirasakan', 'is_correct' => false],
                    ['text' => 'menyikapi konflik yang terjadi secara objektif', 'is_correct' => true],
                    ['text' => 'kepentingan mayoritas yang paling penting', 'is_correct' => false],
                    ['text' => 'kepentingan kelompok minoritas didahulukan', 'is_correct' => false],
                ],
                'explanation' => 'Tindakan yang sesuai dengan persatuan dalam keberagaman adalah menyikapi konflik yang terjadi secara objektif, tidak memihak salah satu kelompok.',
            ],
            // Soal 13
            [
                'question_text' => 'RA. Kartini adalah tokoh perempuan dari Jepara memiliki peran yang sangat penting bagi perjuangan bangsa Indonesia, yakni...',
                'options' => [
                    ['text' => 'melatih menari dan membatik untuk perempuan', 'is_correct' => false],
                    ['text' => 'mendirikan organisasi yang bergerak di bidang seni', 'is_correct' => false],
                    ['text' => 'mengembangkan keterampilan seni ukir khas Jepara', 'is_correct' => false],
                    ['text' => 'memperjuangkan emansipasi perempuan di Indonesia', 'is_correct' => true],
                    ['text' => 'menguatkan pentingnya perempuan untuk belajar bahasa asing', 'is_correct' => false],
                ],
                'explanation' => 'RA. Kartini dikenal sebagai tokoh yang memperjuangkan emansipasi perempuan di Indonesia, terutama dalam bidang pendidikan.',
            ],
            // Soal 14
            [
                'question_text' => 'Berbagai film asing (mulai dari Amerika, India, Jepang, Tiongkok, hingga Korea) telah masuk ke Indonesia dan telah mendominasi media elektronik, baik di bioskop maupun televisi. Semua film tersebut akan berdampak pada sisi budaya dan karakter masyarakat. Penangkalan yang bisa dilakukan oleh masyarakat untuk mewujudkan kekuatan bangsa adalah...',
                'options' => [
                    ['text' => 'melarang masuknya film asing sebagai wujud proteksi', 'is_correct' => false],
                    ['text' => 'menciptakan kompetisi yang adil dalam perfilman', 'is_correct' => false],
                    ['text' => 'tidak menonton atau mengurangi menonton film asing', 'is_correct' => false],
                    ['text' => 'membuat budaya tanding dengan jenis lain', 'is_correct' => false],
                    ['text' => 'revitalisasi produk budaya asli', 'is_correct' => true],
                ],
                'explanation' => 'Revitalisasi produk budaya asli adalah upaya untuk memperkuat ketahanan budaya bangsa di tengah derasnya pengaruh budaya asing.',
            ],
            // Soal 15
            [
                'question_text' => 'Selama ini produk-produk UMKM (Usaha Menengah Kecil Mikro) dalam negeri sering dianggap sebelah mata jika dibandingkan dengan produk-produk asing. Padahal kualitas produk-produknya tidak kalah dengan barang-barang impor. Membeli produk UMKM sama artinya dengan mempertahankan keutuhan NKRI. Alasan adalah untuk...',
                'options' => [
                    ['text' => 'memperkuat ideologi bangsa', 'is_correct' => false],
                    ['text' => 'menguatkan komitmen politik pemimpin bangsa', 'is_correct' => false],
                    ['text' => 'memperkuat perekonomian rakyat kecil', 'is_correct' => true],
                    ['text' => 'menjalin kekuatan kehidupan sosial', 'is_correct' => false],
                    ['text' => 'menghargai karya masyarakat lokal', 'is_correct' => false],
                ],
                'explanation' => 'Membeli produk UMKM berarti memperkuat perekonomian rakyat kecil yang menjadi tulang punggung perekonomian nasional, sehingga ikut mempertahankan keutuhan NKRI.',
            ],
            // Soal 16
            [
                'question_text' => 'Sebagai bentuk perlawanan pada gerakan LGBT, masyarakat meminta pemerintah melarang berkembangnya paham tersebut, karena bertentangan dengan Ideologi Pancasila. Tunjukkan bukti manakah upaya melawan gerakan LGBT, yang merupakan bagian dari bela negara untuk mempertahankan Ideologi Pancasila dan Bhinneka Tunggal Ika?',
                'options' => [
                    ['text' => 'Mengancam segala perilaku yang memiliki kecenderungan LGBT', 'is_correct' => false],
                    ['text' => 'Memberikan tindakan yang represif bagi para pelaku LGBT di masyarakat', 'is_correct' => true],
                    ['text' => 'Meminta tokoh-tokoh agama untuk menggerakan kesadaran melawan LGBT', 'is_correct' => false],
                    ['text' => 'Memaksa pemerintah untuk bertindak tegas terhadap segala propaganda asing', 'is_correct' => false],
                    ['text' => 'Melakukan pendekatan psikologi pada kaum LGBT sebagai upaya penyadaran', 'is_correct' => false],
                ],
                'explanation' => 'Memberikan tindakan yang represif bagi para pelaku LGBT di masyarakat merupakan bentuk bela negara untuk mempertahankan Ideologi Pancasila.',
            ],
            // Soal 17
            [
                'question_text' => 'Kedudukan wakil presiden dalam UUD NRI 1945 tidak dapat dipisahkan dengan presiden sebagai satu kesatuan pasangan jabatan yang dipilih secara langsung melalui pemilihan umum. Manakah dari pilihan di bawah ini yang menunjukkan bukti kewenangan wakil presiden tersebut merupakan penerapan paham konstitusionalisme dalam Negara Kesatuan Republik Indonesia?',
                'options' => [
                    ['text' => 'Bertugas melantik menteri kabinet sebagai pembantunya', 'is_correct' => false],
                    ['text' => 'Menunggu perintah dari presiden untuk melaksanakan tugas', 'is_correct' => false],
                    ['text' => 'Membuat notulen rapat kabinet sebagai bentuk pertanggungjawaban', 'is_correct' => false],
                    ['text' => 'Menampung permasalahan yang perlu penanganan bidang kesejahteraan rakyat', 'is_correct' => true],
                    ['text' => 'Menerima laporan kinerja menteri setiap tahun yang dievaluasi bersama presiden', 'is_correct' => false],
                ],
                'explanation' => 'Wakil presiden memiliki kewenangan menampung permasalahan di bidang kesejahteraan rakyat, yang merupakan bagian dari pelaksanaan konstitusionalisme.',
            ],
            // Soal 18
            [
                'question_text' => 'Seorang bupati memberikan bantuan kemanusiaan kepada masyarakat yang terkena banjir berdasarkan pertimbangan dan masukan yang diterima dari berbagai pihak. Proses pertimbangan untuk memutuskan tersebut dilakukan melalui dialog yang merupakan perwujudan dari nilai Pancasila sila...',
                'options' => [
                    ['text' => 'Pertama', 'is_correct' => false],
                    ['text' => 'Kedua', 'is_correct' => false],
                    ['text' => 'Ketiga', 'is_correct' => false],
                    ['text' => 'Keempat', 'is_correct' => true],
                    ['text' => 'Kelima', 'is_correct' => false],
                ],
                'explanation' => 'Proses dialog dan musyawarah dalam mengambil keputusan merupakan perwujudan dari sila keempat Pancasila yaitu Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan.',
            ],
            // Soal 19
            [
                'question_text' => 'Perwujudan nilai kemanusiaan dari Pancasila sesungguhnya telah dipraktikkan dalam kehidupan bangsa Indonesia sedari dulu, antara lain, dibuktikan dengan...',
                'options' => [
                    ['text' => 'adanya pengadilan adat untuk menerapkan hukum adat', 'is_correct' => false],
                    ['text' => 'terdapat lembaga musyawarah adat pada masyarakat desa', 'is_correct' => false],
                    ['text' => 'hubungan pemimpin informal dengan masyarakat terjalin baik', 'is_correct' => false],
                    ['text' => 'terdapat tradisi saling membantu di antara anggota masyarakat', 'is_correct' => true],
                    ['text' => 'adanya norma kesopanan pada masyarakat desa dan kota', 'is_correct' => false],
                ],
                'explanation' => 'Tradisi saling membantu (gotong royong) merupakan perwujudan nyata nilai kemanusiaan yang telah lama dipraktikkan dalam kehidupan masyarakat Indonesia.',
            ],
            // Soal 20
            [
                'question_text' => 'Pelaksanaan pemilu dan pilkada yang berlangsung dengan damai dan lancar menunjukkan bahwa nilai-nilai Pancasila menjadi dasar kehidupan bernegara. Hal itu dibuktikan dalam bentuk...',
                'options' => [
                    ['text' => 'suasana kehidupan di masyarakat dengan penuh kedamaian', 'is_correct' => false],
                    ['text' => 'nuansa hidup di masyarakat dengan rasa kebersamaan yang tinggi', 'is_correct' => false],
                    ['text' => 'adanya jaminan kepastian hukum dalam masyarakat', 'is_correct' => false],
                    ['text' => 'adanya semangat kekeluargaan yang tinggi di kalangan masyarakat', 'is_correct' => true],
                    ['text' => 'semangat kejujuran setiap anggota masyarakat', 'is_correct' => false],
                ],
                'explanation' => 'Pelaksanaan pemilu dan pilkada yang damai mencerminkan semangat kekeluargaan yang tinggi, yang merupakan nilai luhur Pancasila.',
            ],
            // Soal 21
            [
                'question_text' => 'Rancangan undang-undang yang berkaitan dengan otonomi daerah, hubungan pusat dan daerah, pembentukan atau pemekaran daerah dapat batal demi hukum jika dalam pembahasannya tidak melibatkan...',
                'options' => [
                    ['text' => 'DPR, Presiden dan DPD', 'is_correct' => true],
                    ['text' => 'DPR, presiden dan DPRD', 'is_correct' => false],
                    ['text' => 'DPR, presiden dan masyarakat', 'is_correct' => false],
                    ['text' => 'DPR, presiden dan tokoh adat', 'is_correct' => false],
                    ['text' => 'DPR, presiden dan kepala daerah', 'is_correct' => false],
                ],
                'explanation' => 'Berdasarkan UUD 1945, pembahasan RUU terkait otonomi daerah, hubungan pusat-daerah, pembentukan/pemekaran daerah harus melibatkan DPR, Presiden, dan DPD.',
            ],
            // Soal 22
            [
                'question_text' => 'Hal keuangan negara diatur di dalam pasal UUD NRI Tahun 1945. Alasannya adalah...',
                'options' => [
                    ['text' => 'agar tidak membebani masyarakat dalam melaksanakan berbagai program kegiatan', 'is_correct' => false],
                    ['text' => 'agar ada kepastian hukum dalam berusaha untuk menjamin masa depan', 'is_correct' => false],
                    ['text' => 'membangun transparansi dalam kehidupan berbangsa dan bernegara', 'is_correct' => true],
                    ['text' => 'mendorong perilaku wirausaha atau kemandirian warga masyarakat', 'is_correct' => false],
                    ['text' => 'mendukung kemandirian dan kelangsungan hidup warga masyarakat', 'is_correct' => false],
                ],
                'explanation' => 'Pengaturan keuangan negara dalam UUD bertujuan untuk membangun transparansi dan akuntabilitas dalam pengelolaan keuangan negara.',
            ],
            // Soal 23
            [
                'question_text' => 'Seorang pemuda muslim menjadi petugas satuan pengamanan di sebuah gereja. Seorang pemuda beragama Kristen bertugas saat temannya menjalankan ibadah salat Jumat. Dengan adanya para pemuda yang berbeda agama, umat Hindu di Bali bisa menjalankan rangkaian peribadatannya dengan lancar. Peristiwa tersebut menumbuhkan semangat persatuan karena...',
                'options' => [
                    ['text' => 'dengan keberagaman kita bisa bekerja sama dalam masyarakat', 'is_correct' => true],
                    ['text' => 'kita bisa menggunakan jasa orang lain untuk kepentingan kita', 'is_correct' => false],
                    ['text' => 'dapat saling memahami ajaran-ajaran agama yang berbeda dengan yang dianutnya', 'is_correct' => false],
                    ['text' => 'dengan keberagaman kita menyadari akan adanya kekurangan dan kelebihan kita', 'is_correct' => false],
                    ['text' => 'adanya kemauan antaramut untuk menghilangkan segala bentuk keberagaman', 'is_correct' => false],
                ],
                'explanation' => 'Peristiwa tersebut menunjukkan bahwa keberagaman dapat menjadi kekuatan ketika kita bisa bekerja sama dalam masyarakat untuk kepentingan bersama.',
            ],
            // Soal 24
            [
                'question_text' => 'Ditinjau dari sisi hukum, keberadaan Mahkamah Konstitusi yang dibentuk pasca perubahan atau amendemen UUD 1945 dilandasi dengan alasan, yakni...',
                'options' => [
                    ['text' => 'tuntutan perkembangan hukum ketatanegaraan yang semakin dinamis seiring dengan pembangunan hukum di Indonesia pasca reformasi', 'is_correct' => false],
                    ['text' => 'tuntutan perkembangan demokrasi di Indonesia seiring dengan dilaksanakannya reformasi dalam bidang hukum', 'is_correct' => false],
                    ['text' => 'dalam rangka mendorong partisipasi masyarakat untuk mewujudkan masyarakat hukum berdasarkan Pancasila', 'is_correct' => false],
                    ['text' => 'konsekuensi perubahan dari supremasi MPR menjadi supremasi konstitusi sesuai dengan Pasal 1 ayat (2) UUD NRI Tahun 1945', 'is_correct' => true],
                    ['text' => 'dalam rangka membangun budaya hukum masyarakat Indonesia untuk mewujudkan keadilan di masyarakat', 'is_correct' => false],
                ],
                'explanation' => 'Mahkamah Konstitusi dibentuk sebagai konsekuensi dari perubahan sistem ketatanegaraan dari supremasi MPR menjadi supremasi konstitusi.',
            ],
            // Soal 25
            [
                'question_text' => 'Cermati kalimat berikut!<br><br>"Kalimantan Barat merupakan provinsi di Indonesia yang terletak di Pulau Kalimantan dan Kota Pontianak menjadi ibu kota provinsi yang terdiri atas berbagai sungai kecil dan besar sebagai jalur utama kendaraan masuk kepedalaman."<br><br>Perbaikan ejaan yang salah dalam kalimat tersebut adalah...',
                'options' => [
                    ['text' => 'Kalimantan Barat seharusnya Kalimantan barat', 'is_correct' => false],
                    ['text' => 'Pulau Kalimantan seharusnya pulau Kalimantan', 'is_correct' => false],
                    ['text' => 'Kota Pontianak seharusnya kota Pontianak', 'is_correct' => false],
                    ['text' => 'provinsi seharusnya propinsi', 'is_correct' => false],
                    ['text' => 'kepedalaman seharusnya ke pedalaman', 'is_correct' => true],
                ],
                'explanation' => 'Kata "kepedalaman" seharusnya ditulis terpisah menjadi "ke pedalaman" karena merupakan kata depan "ke" yang diikuti kata benda "pedalaman".',
            ],
            // Soal 26
            [
                'question_text' => 'Cermati paragraf berikut!<br><br>"Anda dapat menghitung jumlah hewan yang berwarna biru hanya dengan satu tangan. (1) Hampir semua warna kulit atau bulu binatang memiliki pigmen berkaitan dengan makanan yang mereka konsumsi. (2) Salah satu contohnya, salmon dan flamingo berdaging merah muda karena memakan kerang dan udang. Hal ini juga berlaku untuk warna cokelat, merah, dan oranye, tetapi biru adalah pengecualian. Jadi, karena tidak ada pigmen biru sejati pada tanaman, hewan tidak bisa menjadi biru melalui makanan.<br>(3) Beberapa hewan tampak berwarna biru karena mengembangkan cara untuk menipu mata kita menggunakan struktur fisik dan pantulan cahaya. (4) Biru adalah pigmen sangat langka di alam dan Anda hanya dapat melihatnya pada satu jenis kupu-kupu yaitu olivewing. Mereka telah secara kimia mengembangkan pigmen pada sayap, sehingga warnanya tidak akan berubah, tidak peduli bagaimana Anda melihatnya. (5) Dan bagi peneliti, kupu-kupu jenis ini pun masih menjadi misteri."<br><br>Kalimat yang tidak efektif ditunjukkan oleh nomor...',
                'options' => [
                    ['text' => '1 dan 2', 'is_correct' => false],
                    ['text' => '2 dan 4', 'is_correct' => false],
                    ['text' => '2 dan 5', 'is_correct' => true],
                    ['text' => '3 dan 4', 'is_correct' => false],
                    ['text' => '4 dan 5', 'is_correct' => false],
                ],
                'explanation' => 'Kalimat nomor 2 dan 5 tidak efektif karena terdapat penggunaan kata yang tidak tepat dan pemborosan kata.',
            ],
            // Soal 27
            [
                'question_text' => 'Cermati kutipan cerpen berikut!<br><br>"Aku menutup kembali pintu lemari pakaian. Isak tangis tertahan masih terdengar dari luar kamar. Tanganku meraih daun pintu, menutup pintu kamar yang terbuka sejenak. Suara tangisan tinggal lamat-lamat. Aku berjalan pelan menuju jendela, membukanya, lalu duduk di atas kursi. Pagi ini, langit berwarna kelabu. Sejujurnya, sempat melintas pertanyaan di kepalaku, kenapa aku tidak menangis? Kemudian pikiranku mengembara, menyusuri tiap jengkal peristiwa yang terjadi tiga pekan lalu.<br><br>"Kamu belum pernah punya anak. Menikah pun belum. Kalaupun toh punya anak, kamu tidak akan pernah punya pengalaman melahirkan. Kamu, laki-laki."<br><br>Aku menatap wajah di depanku, wajah perempuan yang sangat kukenal.<br><br>"Aku, ibunya. Aku yang mengandung dan melahirkannya. Kelak kalau kamu punya anak, kamu akan tahu bagaimana rasanya khawatir yang sesungguhnya."<br><br>Nilai sosial dalam kutipan cerpen tersebut adalah...',
                'options' => [
                    ['text' => 'Dalam keadaan sedih, menangis bukan hal tabu', 'is_correct' => false],
                    ['text' => 'Ibu merasa sedih bila ditinggalkan anaknya', 'is_correct' => false],
                    ['text' => 'Menikah memberikan pengalaman berkesan', 'is_correct' => false],
                    ['text' => 'Pengalaman melahirkan tidak dapat dilupakan', 'is_correct' => false],
                    ['text' => 'Sayang ibu kepada anak tidak mengenal batas', 'is_correct' => true],
                ],
                'explanation' => 'Kutipan tersebut menunjukkan betapa besar kasih sayang seorang ibu kepada anaknya, yang tidak mengenal batas dan hanya dapat dirasakan oleh seorang ibu.',
            ],
            // Soal 28
            [
                'question_text' => 'Cermati paragraf berikut!<br><br>(1) Orang tua di Finlandia memahami bahwa pekerjaan mengajar adalah pekerjaan yang sangat kompleks dan penuh dinamika sehingga perlu didukung dalam semua aspek.<br>(2) Oleh karena itu, apabila para guru-guru mengalami kesulitan mengajar kepada seorang siswa, maka orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.<br>(3) Orang tua menganggap guru adalah pahlawan kesuksesan bagi anak-anak mereka.<br>(4) Pemahaman awal yang baik pada awal anak masuk sekolah adalah guru menjelaskan kepada orang tua dan anak bahwa sekolah bukanlah tempat menyeramkan yang menyebabkan tekanan batin dan ketegangan.<br>(5) Dengan seluruh daya dan upaya, para guru berusaha memahami kondisi intelektual dan emosi siswa, bahkan sampai ke hal-hal yang kecil.<br><br>Perbaikan kalimat (2) agar menjadi kalimat efektif adalah...',
                'options' => [
                    ['text' => 'Oleh karena itu, apabila para guru-guru mengalami kesulitan mengajar seorang siswa, maka orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 'is_correct' => false],
                    ['text' => 'Oleh karena itu, apabila guru-guru mengalami kesulitan mengajar kepada seorang siswa, maka orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 'is_correct' => false],
                    ['text' => 'Oleh karena itu, apabila para guru mengalami kesulitan mengajar kepada seorang siswa, orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 'is_correct' => false],
                    ['text' => 'Oleh karena itu, apabila guru mengalami kesulitan mengajar seorang siswa, orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 'is_correct' => true],
                    ['text' => 'Oleh karena itu, apabila guru-guru mengalami kesulitan mengajar seorang siswa, karena orang tua akan membantu semaksimal mungkin dan bukan menyalahkan', 'is_correct' => false],
                ],
                'explanation' => 'Kalimat efektif menghilangkan kata "para" (karena sudah jamak dengan "guru-guru") dan menghilangkan kata "kepada" serta "maka" untuk menghindari pemborosan kata.',
            ],
            // Soal 29
            [
                'question_text' => 'Cermati paragraf berikut!<br><br>"Menang dan kalah adalah keniscayaan, tinggal bagaimana orang tua mengajarkan bagaimana anak menyikapi dua kondisi tersebut. Mengajari anak siap kalah, berarti mengajari anak menerima kekalahan dan mengakui kemenangan orang lain (dalam sikap dan tindakan) tanpa prasangka buruk. Kehidupan itu sendiri tidak selalu memberi ruang pada kemenangan saja, ada ruang dan waktu lain yang musti ditunjukkan dan dipahami anak, yaitu kalah. Bahwa suatu saat, anak akan mengalami kekalahan sehingga sikap siap menang dan siap kalah adalah sikap yang harus ditanamkan."<br><br>Ide pokok paragraf tersebut adalah...',
                'options' => [
                    ['text' => 'penanaman sikap menerima kalah dan menang', 'is_correct' => true],
                    ['text' => 'kehidupan yang penuh persaingan kalah dan menang', 'is_correct' => false],
                    ['text' => 'hindari berprasangka buruk kepada kemenangan', 'is_correct' => false],
                    ['text' => 'siap kalah dan siap menang sebagai hal biasa', 'is_correct' => false],
                    ['text' => 'mampu menghindari kekalahan dan meraih kemenangan', 'is_correct' => false],
                ],
                'explanation' => 'Ide pokok paragraf adalah tentang pentingnya menanamkan sikap siap menerima kemenangan dan kekalahan kepada anak.',
            ],
            // Soal 30
            [
                'question_text' => 'Cermati dua paragraf berikut!<br><br>"Pada 15 November lalu Indonesia dan 14 negara lain yang terdiri atas 9 negara ASEAN, China, Jepang, Korea Selatan, Australia, dan Selandia Baru menandatangani perjanjian dagang Regional Comprehensive Economic Partnership (RCEP). RCEP merupakan kemitraan dagang terbesar kedua dunia setelah WTO yang total Produk Domestik Bruto (PDB) RCEP mencapai 30,2 persen dari PDB dunia; Foreign Direct Investment (FDI) 29,8 persen; penduduk 29,6 persen; dan perdagangan 27,4 persen. Dengan terintegrasinya Indonesia dalam blok dagang ini, akan ada angin segar baru yang akan berkontribusi bagi pertumbuhan ekonomi nasional.<br><br>Namun, tidak sepenuhnya perjanjian ini membawa manfaat bagi Indonesia. Secara teoretis, dalam hubungan internasional akan selalu terselip kepentingan nasional negara-negara pesertanya, entah itu dari segi militer, ekonomi, atau budaya. Kepentingan nasional itu berkaitan erat dengan power, entah itu sebagai tujuan atau pun instrumen untuk mencapai kepentingan nasional. Dengan demikian, ketika orientasi sudah mengarah kepada penggunaan power dan bertujuan untuk power, konsekuensinya adalah kompetisi, perimbangan kekuasaan, konflik, hingga perang. Barangkali dasar pemikiran inilah yang membuat India belakangan mundur dari RCEP setelah menghitung untung-rugi perjanjian tersebut."<br><br>Simpulan dua paragraf tersebut adalah...',
                'options' => [
                    ['text' => 'RCEP merupakan blok perdagangan besar yang bertujuan memberikan keuntungan ekonomi kepada semua anggota yang terdiri atas semua anggota ASEAN dan empat mitra.', 'is_correct' => false],
                    ['text' => 'Indikator RCEP sebagai blok dagang besar adalah total PDB yang mencapai 30,2 persen dari PDB dunia, FDI sebesar 29,8 persen, penduduk 29,6 persen, dan perdagangan 27,4 persen.', 'is_correct' => false],
                    ['text' => 'Persoalan Laut Cina Selatan yang menjadi sumber konflik antara Cina dengan beberapa negara ASEAN akan menyebabkan hubungan antarnegara dalam RCEP tidak harmonis.', 'is_correct' => false],
                    ['text' => 'RCEP berpeluang memberikan kontribusi bagi pertumbuhan ekonomi Indonesia tetapi sekaligus menghadirkan masalah bila antar negara anggota mengedepankan kepentingan.', 'is_correct' => false],
                    ['text' => 'Berbeda dengan negara-negara anggota ASEAN, China, Jepang, Korea Selatan, Australia, dan Selandia Baru, India melihat RCEP lebih banyak memberikan masalah daripada manfaat.', 'is_correct' => true],
                ],
                'explanation' => 'Simpulan yang tepat adalah India melihat RCEP lebih banyak memberikan masalah daripada manfaat, sehingga India memilih mundur dari perjanjian tersebut.',
            ],
        ];

        // Insert all questions
        foreach ($questions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'twk',
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
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TWK (30 soal) berhasil dijalankan!');
        $this->command->info('Material ID: ' . $materialId);
        $this->command->info('Total soal: 30');
    }
}
