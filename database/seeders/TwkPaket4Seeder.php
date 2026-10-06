<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TwkPaket4Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $materialId = 8;

        // [question_text, image, options => [[text, is_correct], ...]]
        $questions = [
            [
                'text' => 'Dinamika pelaksanaan UUD 1945 sejak memasuki era Orde Baru di warnai hal yang baru terkait dengan pembangunan nasional. Apakah hal yang baru sebagaimana dimaksud?',
                'image' => null,
                'options' => [
                    ['Dilaksanakannya pembangunan nasional semester berencana', 0],
                    ['Dilaksanakannya pembangunan nasional melalui Repelita', 1],
                    ['Penekanan pada pembangunan bidang politik nasional.', 0],
                    ['Pelaksanaan pembangunan ckonomi untuk: kesejahteraan rakyat.', 0],
                    ['Dilaksanakannya pembangunan pada segala bidang.', 0],
                ],
            ],
            [
                'text' => 'Dalam suatu pertandingan, seorang pemain sepak bola melakukan tekel keras kepada pemain lawan. Pemain tersebut memang sudah menginginkan agar pemain lawan tersebut tidak bisa melanjutkan pertandingan. Tindakan tersebut dapat dipandang sebagai perilaku yang bertentangan dengan nilai-nilai Pancasila sebab',
                'image' => null,
                'options' => [
                    ['berperilaku merendahkan martabat orang lain', 0],
                    ['melakukan tindakan yang tidak jujur', 0],
                    ['menciptakan pertentangan antarpemain', 1],
                    ['melanggar kewajiban sebagai pemain', 0],
                    ['mengkhianati rasa setia kawan', 0],
                ],
            ],
            [
                'text' => 'Untuk memperingati Hari Sumpah Pemuda, ketua Rukun Warga (RW) mengajak seluruh warga untuk berpartisipasi. Tujuannya agar semangat keberagaman di lingkungannya tetap terjaga dan dihormati sejalan dengan abad teknologi informasi. Atas ajakan tersebut, bentuk partisipasi yang tepat adalah',
                'image' => null,
                'options' => [
                    ['menyiapkan parade pakaian', 0],
                    ['mengajak warga lain ikut', 0],
                    ['membuka donasi kegiatan', 0],
                    ['menyebarkan info tersebut', 1],
                    ['menyiapkan tempat acara', 0],
                ],
            ],
            [
                'text' => 'Negara-negara Asia Tenggara pada Konferensi Tingkat Tinggi (KTT) ASEAN di Thailand menyepakati Deklarasi Bangkok tentang memerangi sampah laut di Kawasan ASEAN. Adapun peran Indonesia adalah',
                'image' => null,
                'options' => [
                    ['memperjelas hukum mengenai sistem ekspor impor', 0],
                    ['membuka kerja sama perlindungan hewan laut', 0],
                    ['melalukan kerja sama untuk membersihkan laut', 1],
                    ['mengurangi produk industri yang berbahan plastic', 0],
                    ['mengurangi dan menolak impor dari luar negeri', 0],
                ],
            ],
            [
                'text' => 'Berdasarkan jejak sejarah konflik yang disebabkan perbedaan pandangan cara bernegara telah terjadi sejak awal kemerdekaan Indonesia. Hal-hal yang dapat dilakukan untuk mencegah agar tidak terjadi kembali konflik tersebut adalah',
                'image' => null,
                'options' => [
                    ['menciptakan pertahanan militer yang kuat', 0],
                    ['membatasi kebebasan rakyat untuk berpendapat', 0],
                    ['memberikan doktrin kebangsaan', 0],
                    ['menyamakan pandangan tentang bernegara', 0],
                    ['menanamkan semangat dan komitmen kebangsaan', 1],
                ],
            ],
            [
                'text' => 'Salah satu pergerakan untuk mencapai kemerdekaan diwarnai oleh lahirnya Sarekat Dagang Islam yang didirikan oleh Haji Samanhudi di Solo pada 1911. Gerakan ini berusaha membangun kekuatan serta persatuan bangsa melalui penguatan dalam bidang',
                'image' => null,
                'options' => [
                    ['Ekonomi melalui pelindungan pengusaha lokal agar mampu bersaing dengan pengusaha nonlocal', 1],
                    ['kebudayaan melalui pengembangan kesenian- kesenian daerah agar mampu mengharumkan nama baik Indonesia', 0],
                    ['pendidilcan melalui pengajaran serta menjadi pemantik persatuan dan kesatuan bangsa Indonesia', 0],
                    ['keagamaan yang memobilisasi gerakan rakyat dengan dasar keyakinan pada nilai-nilai Ketuhanan', 0],
                    ['politik melalui pengembangan kebijakan kebijakan yang berpihak masyarkat lokal dibanding masayarakat nonlocal', 0],
                ],
            ],
            [
                'text' => 'Sekelompok ibu-ibu mengadakan kegiatan arisan. Seorang anggota menawarkan suatu produk tabungan kepada peserta lain dengan iming-iming bunga yang lebih tinggi daripada bunga bank. Tawaran tersebut membuat banyak anggota tertarik menyetorkan tabungan. Uang tabungan katanya akan digunakan untuk investasi di berbagai bisnis. Padahal, uang tersebut hanya dipinjamkan lagi dengan bunga yang lebih tinggi lagi. Berdasarkan peristiwa tersebut, tindakan yang bertentangan dengan integritas adalah…',
                'image' => null,
                'options' => [
                    ['pemutaran kembali uang tabungan untuk pinjaman berbunga tinggi', 1],
                    ['penawaran produk tabungan dengan bunga yang lebih tinggi daripada bunga bank', 0],
                    ['banyak anggota yang tergiur dengan keuntungan bunga yang tinggi', 0],
                    ['penggunaan arisan sebagai wahana menawarkan berbagai produk', 0],
                    ['kegiatan arisan yang dilakukan tanpa tujuan yang jelas', 0],
                ],
            ],
            [
                'text' => 'Dalam perumusan dan penetapan UUD NRI Tahun 1945 dalam sidang BPUPK dan PPKI, ada yang menjabat sebagai Ketua Panitia Persiapan Kemerdekaan Indonesia Ketua Panitia Perancangan Ekonomi, konseptor naskah teks proklamasi kemerdekaan, dan sebagainya. Dalam hal ini, nilai persatuan ditunjukkan dengan adanya kerja sama pendiri negara berdasarkan',
                'image' => null,
                'options' => [
                    ['profesinya masing-masing', 0],
                    ['penunjukan masing-masing', 0],
                    ['ahlinya masing-masing', 0],
                    ['perannya masing-masing', 1],
                    ['kerelaan hati masing-masing', 0],
                ],
            ],
            [
                'text' => 'Negara Indonesia sangat menjunjung tinggi persatuan Indonesia berdasarkan Pancasila. Saat ini masih terdapat gerakan separatisme di beberapa wilayah di Indonesia. Hal tersebut bertentangan dengan Pancasila dan UUD. Penolakan terhadap separatisme perlu terus ditumbuhkan dalam diri warga negara karena hal ini .',
                'image' => null,
                'options' => [
                    ['dapat memperkuat kepercayaaan diri bangsa', 0],
                    ['dapat menyatukan perbedaan di setiap wilayah', 0],
                    ['memperkuat persatuan dan keutuhan NKRI', 1],
                    ['meningkatkan dan memperkuat rasa kesukuan', 0],
                    ['meringankan beban TNI dalam menjaga NKRI', 0],
                ],
            ],
            [
                'text' => 'Perumusan dan penetapan UUD Republik Indonesia dilakukan oleh tokoh-tokoh yang berasal dari berbagai suku yang berbeda-beda. Namun para tokoh mampu bersatu dalam merumuskan UUD 1945 yang disepakati oleh seluruh rakyat Indonesia yang terkenal pluralis. Makna yang dapat diambil dari peristiwa ini adalah',
                'image' => null,
                'options' => [
                    ['saat rapat tokoh bangsa lebih mementingkan golongannya', 0],
                    ['persatuan dapat terwujod jaka mengikuti perintah pimpinan', 0],
                    ['sukuisme dapat memperkuat persatuan bangsa Indonesia', 0],
                    ['sikap pluralis dapat dilakukan jika memiliki persamaan', 0],
                    ['perbedaan suku tidak menjadi penghalang untuk Bersatu', 1],
                ],
            ],
            [
                'text' => 'Setelah mundur dari jabatannya sebagai wakil presiden, Drs. Moh. Hatta mendapatkan banyak tawaran untuk menempati berbagai jabatan dari tingkat nasional sampai tingkat internasional. Namun., Hatta menolak semuanya dan memilih untuk hidup dari uang pensiun. Mengapa perilaku tersebut mencerminkan integritas terhadap bangsa Indonesia?',
                'image' => null,
                'options' => [
                    ['Perilaku tersebut mencerminkan pribadi yang oportunis.', 0],
                    ['Perilaku tersebut mencerminkan sosok yang tidak mengejar jabatan dan harta.', 1],
                    ['Perilaku tersebut mencerminkan pribadi yang menghindari kemajuan nasional.', 0],
                    ['Perilaku tersebut mencerminkan sosok yang progresif dan rendah hati', 0],
                    ['Perilaku tersebut mencerminkan pribadi yang dekat dengan orang banyak', 0],
                ],
            ],
            [
                'text' => 'Beberapa kali integrasi bangsa kita menjadi taruhan ketika terjadi konflik sara yang besar, tetapi semangat bersatu dalam segala perbedaan dapat menjaga kesatuan bangsa kita. Berdasarkan pernyataan di atas, tindakan yang sesuai dengan persatuan dalam keberagaman adalah',
                'image' => null,
                'options' => [
                    ['harus menang dalam berkonflik apa pun yang terjadi.', 0],
                    ['berani mengemukakan apa yang dirasakan.', 0],
                    ['menyikapi konflik yang terjadi secara objektif.', 1],
                    ['kepentingan mayoritas yang paling penting.', 0],
                    ['kepentingan kelompok minoritas didahulukan.', 0],
                ],
            ],
            [
                'text' => 'RA. Kartini adalah tokoh perempuan dari Jepara memiliki peran yang sangat penting bagi perjuangan bangsa Indonesia, yakni',
                'image' => null,
                'options' => [
                    ['melatih menari dan membatik untuk perempuan', 0],
                    ['mendirikan organisasi yang bergerak di bidang seni', 0],
                    ['mengembangkan keterampilan seni ukir khas Jepara', 0],
                    ['memperjuangkan emansipasi perempuan di Indonesia', 1],
                    ['menguatkan pentingnya perempuan untuk belajar bahasa asing', 0],
                ],
            ],
            [
                'text' => 'Berbagai film asing (mulai dari Amerika, India, Jepang. Tiongkok, hingga Korea) telah masuk ke Indonesia dan telah mendominasi media elektronik, baik di bioskop maupun televisi. Semua film tersebut akan berdampak pada sisi budaya dan karakter masyarakat. Penangkalan yang bisa dilakukan oleh masyarakat untuk mewujudkan kekuatan bangsa adalah',
                'image' => null,
                'options' => [
                    ['melarang masukmya film asing sebagai wujad proteksi', 0],
                    ['menciptakan kompetisi yang adil dalam perfilman', 0],
                    ['tidak menonton atau mengurangi menonton film asing', 0],
                    ['membuat budaya tanding dengan jenis lain', 0],
                    ['revitalisasi produk budaya asli', 1],
                ],
            ],
            [
                'text' => 'Selama in produk-produk UMKM (Usaha Menengah Kecil Mikro) dalam negeri sering dianggap sebelah mata jika dibandingkan dengan produk-produk asing. Padahal kualitas produk-produknya tidak kalah dengan barang-barang impor. Membeli produk UMKM sama artinya dengan mempertahankan keutuhan NKRI. Alasan adalah untuk..',
                'image' => null,
                'options' => [
                    ['memperkuat ideologi bangsa', 0],
                    ['menguatkan komitmen politik pemimpin bangsa', 0],
                    ['memperkuat perekonomian rakyat kecil', 1],
                    ['menjalin kekuatan kehidupan social', 0],
                    ['menghargai karya masyarakat local', 0],
                ],
            ],
            [
                'text' => 'Sebagai bentuk perlawanan pada gerakan LGBT masyarakat meminta pemerintah melarang berkembangnya paham tersebut, karena bertentangan dengan Ideologi Pancasila. Tunjukkan bukti manakah upaya melawan gerakan LGBT, yang merupakan bagian dari bela negara untuk mempertahankan Ideologi Pancasila dan Bhinneka Tunggal Ika?',
                'image' => null,
                'options' => [
                    ['Mengancam segala perilaku yang memiliki kecenderungan LGBT.', 0],
                    ['Memberikan tindakan yang represif bagi para pelaku LGBT di masyarakat', 1],
                    ['Meminta tokoh-tokoh agama untuk menggerakan kesadaran melawan LGBT.', 0],
                    ['Memaksa pemerintah untuk bertindak tegas terhadap segala propaganda asing.', 0],
                    ['Melakukan pendekatan psikologi pada kaum LGBT sebagai upaya penyadaran.', 0],
                ],
            ],
            [
                'text' => 'Kedudukan wakil presiden dalam UUD NRI 1945 tidak dapat dipisahkan dengan presiden sebagai satu kesatuan pasangan jabatan yang dipilih secara langsung melalui pemilihan umum. Manakah dari pilihan di bawah ini yang menunjukkan bukti kewenangan wakil presiden tersebut merupakan penerapan paham konstitusionalisme dalam Negara Kesatuan Republik Indonesia?',
                'image' => null,
                'options' => [
                    ['Bertugas melantik menteri kabinet sebagai permbantunya.', 0],
                    ['Menunggu perintah dari presiden untuk melaksanakan tugas.', 0],
                    ['Membuat notulen rapat kabinet sebagai bentuk pertanggungjawaban.', 0],
                    ['Menampung permasalahan yang perlu penanganan bidang kesejahteraan rakyat.', 1],
                    ['Menerima laporan kinerja menteri setiap tahun yang di evaluasi bersama presiden.', 0],
                ],
            ],
            [
                'text' => 'Seorang bupati memberikan bantun kemanusiaan kepada masyarakat yang terkena banjir berdasarkan pertimbangan dan masukan yang diterima dari barbagai pihak. Proses pertimbangan untuk memutuskan tersebut dilakukan melalui dialog yang merupakan perwujudan dari nilai Pancasila sila',
                'image' => null,
                'options' => [
                    ['Pertama', 0],
                    ['Kedua', 0],
                    ['Ketiga', 0],
                    ['Keempat', 1],
                    ['Kelima', 0],
                ],
            ],
            [
                'text' => 'Perwujudan nilai kemanusiaan dari Pancasila sesungguhnya telah dipraktikkan dalam kehidupan bangsa Indonesia sedari dulu, antara lain, dibuktikan dengan',
                'image' => null,
                'options' => [
                    ['adanya pengadilan adat untuk menerapkan hukum adat', 0],
                    ['terdapat lembaga musyawarah adat pada masyarakat desa', 0],
                    ['hubungan pemimpin informal dengan masyarakat terjalin baik', 0],
                    ['terdapat tradisi saling membantu di antara anggota masyarakat', 1],
                    ['adanya norma kesopanan pada masyarakat desa dan kota', 0],
                ],
            ],
            [
                'text' => 'Pelaksanaan pemilu dan pilkada yang berlangsung dengan damai dan lancar menunjukkan bahwa nila-nilai Pancasila menjadi dasar kehidupan bernegara. Hal itu dibuktikan dalam bentuk',
                'image' => null,
                'options' => [
                    ['suasana kehidupan di masyarakat dengan penuh kedamaian', 0],
                    ['nuansa hidup di masyarakat dengan rasa kebersamaan yang tinggi', 0],
                    ['adanya jaminan kepastian hukum dalam masyarakat', 0],
                    ['adanya semangat kekeluargaan yang tinggi di kalangan masyarakat', 1],
                    ['semangat kejujuran setiap anggota masyarakat', 0],
                ],
            ],
            [
                'text' => 'Rancangan undang-undang yang berkaitan dengan otonomi daerah, hubungan pusat dan daerah, pembentukan atau pemekaran daerah dapat batal demi hukum jika dalam pembahasannya tidak melibatkan.',
                'image' => null,
                'options' => [
                    ['DPR. Presiden dan DPD', 1],
                    ['DPR, presiden dan DPRD', 0],
                    ['DPR, presiden dan masyarakat', 0],
                    ['DPR, presiden dan tokoh adat', 0],
                    ['DPR, presiden dan kepala daerah', 0],
                ],
            ],
            [
                'text' => 'Hal keuangan negara diatur di dalam pasal UUD NRI Tahun 1945. Alasannya adalah',
                'image' => null,
                'options' => [
                    ['agar tidak membebani masyarakat dalam melaksanakan berbagai program kegiatan', 0],
                    ['agar ada kepastian hukum dalam berusaha untuk menjamin masa depan', 0],
                    ['membangun transparansi dalam kehidupan berbangsa dan bernegara', 1],
                    ['mendorong perilaku wirausaha atau kemandirian warga masyarakar', 0],
                    ['mendukung kemandirian dan kelangsungan hidup warga masyarakat', 0],
                ],
            ],
            [
                'text' => 'Seorang pemuda muslim menjadi petugas satuan pengamanan di sebuah gereja. Seorang pemuda beragama Kristen bertugas saat temannya menjalankan ibadah salat Jumat. Dengan adanya para pemuda yang berbeda agama, umat Hindu di Bali bisa menjalankan rangkaian peribadatannya dengan lancar. Peristiwa tersebut menumbuhkan semangat persatuan karena...',
                'image' => null,
                'options' => [
                    ['dengan keberagaman kita bisa bekerja sama dalam masyarakat', 1],
                    ['kita bisa menggunakan jasa orang lain untuk kepentingan kita', 0],
                    ['dapat saling memahami ajaran-ajaran agama yang berbeda dengan yang dianutnya', 0],
                    ['dengan keberagaman kita menyadari akan adanya kekurangan dan kelebihan kita', 0],
                    ['adanya kemauan antarumat untuk menghilangkan segala bentuk keberagaman', 0],
                ],
            ],
            [
                'text' => 'Ditinjau dari sisi hukum, keberadaan Mahkamah Konstitusi yang dibentuk pasca perubahan atau amendemen UUD 1945 dilandasi dengan alasan, yakni',
                'image' => null,
                'options' => [
                    ['tuntutan perkembangan hukum ketätanegaraan yang semakin dinamis seiring dengan pembangunan hukum di Indonesia pasca reformasi', 0],
                    ['tuntutan perkembangan demokrasi di Indonesia seiring dengan dilaksanakannya reformasi dalam bidang hukum', 0],
                    ['dalam rangka mendorong partisipasi masyarakat untuk mewujudkan masyarakat hukum berdasarkan Pancasila', 0],
                    ['konsekuensi perubahan dari supremasi MPR menjadi supremasi konstitusi sesuai dengan Pasal 1 ayat (2) UUD NRI Tahun 1945', 1],
                    ['dalam rangka membangun budaya hukum masyarakat Indonesia untuk mewvujudkan keadilan di masyarakat', 0],
                ],
            ],
            [
                'text' => 'Cermati kalimat berikut!<br>Kalimantan Barat merupakan provinsi di Indonesia yang terletak di Pulau Kalimantan dan Kota Pontianak menjadi ibu kota provinsi yang terdiri atas berbagai sungai kecil dan besar sebagai jalur utama kendaraan masuk kepedalaman. Perbaikan ejaan yang salah dalam kalimat tersebut adalah',
                'image' => null,
                'options' => [
                    ['Kalimantan Barat seharusnya Kalimantan barat', 0],
                    ['Pulau Kalimantan seharusnya pulau Kalimantan', 0],
                    ['Kota Pontianak seharusnya kota Pontianak', 0],
                    ['provinsi seharusnya propinsi', 0],
                    ['kepedalaman seharusnya ke pedalaman', 1],
                ],
            ],
            [
                'text' => 'Cermati paragraph berikut!<br>Anda dapat menghitung jumlah hewan yang berwarna biru hanya dengan satu tangan. (1) Hampir semua warna kulit atau bulu binatang memiliki pigmen berkaitan dengan makanan yang mereka konsumsi. (2) Salah satu contohnya, salmon dan flamingo berdaging merah muda karena memakan kerang dan udang. Hal ini juga berlaku untuk warna cokelat, merah, dan oranye, tetapi biru adalah pengecualian. Jadi, karena tidak ada pigmen biru sejati pada tanaman, hewan tidak bisa menjadi biru melalui makanan.<br>(3) Beberapa hewan tampak berwarna biru karena mengembangkan cara untuk menipu mata kita menggunakan struktur fisik dan pantulan cahaya. (4) Biru adalah pigmen sangat langka di alam dan Anda hanya dapat melihatnya pada satu jenis kupu-kupu yaitu olivewing. Mereka telah secara kimia mengembangkan pigmen pada sayap, sehingga warnanya tidak akan berubah, tidak peduli bagaimana Anda melihatnya. (5) Dan bagi peneliti, kupu-kupu jenis ini pun mash menjadi misteri. (Disadur dari https://www.liputan6.com/global)<br>Kalimat yang tidak efektif ditunjukkan oleh nomor',
                'image' => null,
                'options' => [
                    ['1 dan 2', 0],
                    ['2 dan 4', 0],
                    ['2 dan 5', 1],
                    ['3 dan 4', 0],
                    ['4 dan 5', 0],
                ],
            ],
            [
                'text' => 'Cermati kutipan cerpen berikut!<br>Aku menutup kembali pintu lemari pakaian. Isak tangis tertahan masth terdengar dari luar kamar. Tanganku meraih daun pintu, menutup pintu kamar yang terbuka sejengkal. Suara tangisan tinggal lamat-lamat. Aku berjalan pelan menuju jendela, membukanya, lalu duduk di atas kursi. Pagi ini, langit berwarna kelabu. Sejujurnya, sempat melintas pertanyaan di kepalaku, kenapa aku tidak menangis? Kemudian pikiranku mengembara, menyusuri tiap jengkal peristiwa yang terjadi tiga pekan lalu.<br>"\'Kamu belum pernah punya anak. Menikah pun belum. Kalaupun toh punya anak, kamu tidak akan pernah punya pengalaman melahirkan. Kamu, laki-laki."<br>Aku menatap wajah di depanku, wajah perempuan yang sangat kukenal.<br>"Aku, ibunya. Aku yang mengandung dan melahirkannya. Kelak kalau kamu punya anak, kamu akan tahu bagaimana rasanya khawatir yang sesungguhnya." (diadaptasi dari http://lalalatifah594.blogspot.com/p/kumpulan-cerpen. htm!)<br>Nilai sosial dalam kutipan cerpen tersebut adalah sebagai berikut.',
                'image' => null,
                'options' => [
                    ['Dalam keadaan sedih, menangis bukan hal tabu.', 0],
                    ['Ibu merasa sedih bila ditinggalkan anaknya.', 0],
                    ['Menikah memberikan pengalaman berkesan', 0],
                    ['Pengalaman melahirkan tidak dapat dilupakan.', 0],
                    ['Sayang ibu kepada anak tidak mengenal batas', 1],
                ],
            ],
            [
                'text' => 'Cermati paragraf berikut!<br>Orang tua di Finlandia memahami bahwa pekerjaan mengajar adalah pekerjaan yang sangat kompleks dan penuh dinamika sehingga perlu didukung dalam semua aspek. (2) Oleh karena itu, apabila para guru-guru mengalami kesulitan mengajar kepada seorang siswa, maka orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya. (3) Orang tua menganggap guru adalah pahlawan kesuksesan bagi anak-anak mereka. (4) Pemahaman awal yang baik pada awal anak masuk. sekolah adalah guru menjelaskan kepada orang tua dan anak bahwa sekolah bukanlah tempat menyeramkan yang menyebabkan tekanan batin dan ketegangan. (S) Dengan seluruh daya dan upaya, para guru berusaha memahami kondisi intelektual dan emosi siswa, bahkan sampai ke hal-hal yang kecil.<br>Perbaikan kalimat (2) agar menjadi kalimat efektif adalah',
                'image' => null,
                'options' => [
                    ['Oleh karena itu, apabila para guru-guru mengalami kesulitan mengajar seorang siswa, maka orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 0],
                    ['Oleh karena itu, apabila guru-guru mengalami kesulitan mengajar kepada seorang siswa, maka orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 0],
                    ['Oleh karena itu, apabila para guru mengalami kesulitan mengajar kepada seorang siswa, orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya.', 0],
                    ['Oleh karena itu, apabila para guru mengalami kesulitan mengajar seorang siswa, orang tua akan membantu semaksimal mungkin dan bukan menyalahkan gurunya', 1],
                    ['Oleh karena itu, apabila guru-guru mengalami kesulitan mengajar seorang siswa, karena orang tua akan membantu semaksimal mungkin dan bukan menyalahkan', 0],
                ],
            ],
            [
                'text' => 'Cermati paragraf benikut!<br>Menang dan kalah adalah keniscayaan, tinggal bagaimana orang tua mengajarkan bagaimana anak menyikapi dua kondisi tersebut. Mengajari anak siap kalah, berarti mengajari anak menerima kekalahan dan mengakui kemenangan orang lain (dalam sikap dan tindakan) tanpa prasangka buruk. Kehidupan itu sendiri tidak selalu memberi ruang pada kemenangan saja, ada ruang dan waktu lain yang musti ditunjukkan dan dipahami anak, yaitu kalah. Bahwa suatu saat, anak akan mengalami kekalahan sehingga sikap siap menang dan siap kalah adalah sikap yang harus ditanamkan<br>Ide pokok paragraf tersebut adalah',
                'image' => null,
                'options' => [
                    ['penanaman sikap menerima kalah dan menang', 1],
                    ['kehidupan yang penuh persaingan kalah dan menang', 0],
                    ['hindari berprasangka buruk kepada kemenangan', 0],
                    ['Siap kalah dan siap menang sebagai hal biasa', 0],
                    ['mampu menghindari kekalahan dan meraih kemenangan', 0],
                ],
            ],
            [
                'text' => 'Cermati dua paragraf berikut!<br>Pada 15 November lalu Indonesia dan 14 negara lain yang terdiri atas 9 negara ASEAN, China, Jepang. Korea Selatan, Australia, dan Selandia Baru menandatangani perjanjian dagang Regional Comprehensive Economic Partnership (RCEP). REP merupakan kemitraan dagang terbesar kedua dunia setelah WTO yang total Produk Domestik Bruto (PB) RCEP mencapai 30,2 persen dari PDB dunia; Foreign Direct investment(FDI) 29,8 persen; penduduk 29,6 persen; dan perdagangan 27,4 persen. Dengan terintegrasinya Indonesia dalam blok dagang ini, akan ada angin segar baru yang akan berkontribusi bagi pertumbuhan ekonomi nasional.<br>Namun, tidak sepenuhnya perjanjian ini membawa manfaat bagi Indonesia. Secara teoretis, dalam hubungan internasional akan selalu terselip kepentingan nasional negara-negara pesertanya, entah itu dari segi militer, ekonomi, atau budaya. Kepentingan nasional itu berkaitan erat dengan power, entah itu sebagai tujuan atau pun instrumen untuk mencapai kepentingan nasional. Dengan demikian, ketika orientasi sudah mengarah kepada penggunaan power dan bertujuan untuk power, konsekuensinya adalah kompetisi, perimbangan. kekuasaan, konflik, hingga perang. Barangkali dasar pemikiran iniah yang membuat india belakangan mundur dari RCEP setelah menghitung untung-rugi perjanjian tersebut.<br>(diadaptasi dari https://news.detik.com/kolom/d-5279517/umkm-menotap-rcep)<br>Simpulan dua paragraf tersebut adalah sebagai berikut.',
                'image' => null,
                'options' => [
                    ['RCEP merupakan blok perdagangan besar yang bertujuan memberikan keuntungan ekonomi kepada semua anggota yang terdiri atas semua anggota ASEAN dan empat mitra.', 0],
                    ['Indikator RCEP sebagal blok dagang besar adalah total PDB yang mencapai 30,2 persen dari POB dunia, FDI sebesar 29,8 persen, penduduk 29,6 persen, dan perdagangan 27,4 persen.', 0],
                    ['Persoalan Laut Cina Selatan yang menjadi sumber konflik antara Cina dengan beberapa negara ASEAN akan menyebabkan hubungan antarnegara dalam RCEP tidak harmonis.', 0],
                    ['RCEP berpeluang memberikan kontribusi bagi pertumbuhan ekonomi Indonesia tetapi sekaligus menghadirkan masalah bila  antar negara anggota mengedepankan kepentingan.', 0],
                    ['Berbeda dengan negara-negara anggota ASEAN, China, Jepang, Korea Selatan, Australia, dan Selandia Baru: india melihat RCEP lebih baryak memberkan masalah daripada manfaat.', 1],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => $q['text'],
                'image' => $q['image'],
                'explanation' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $order = 1;
            foreach ($q['options'] as $opt) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $opt[0],
                    'is_correct' => $opt[1],
                    'image' => null,
                    'order' => $order++,
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('TWK Paket 4 seeder selesai: ' . count($questions) . ' soal + opsi.');
    }
}
