<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TWKTOFebruariSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Insert material untuk TWK dengan category_id = 8
        $materialId = DB::table('question_materials')->insertGetId([
            'category_id' => 8,
            'name' => 'TWK',
            'slug' => 'twk-full-set',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Data soal dari PDF (soal 1-30)
        $questions = [
            // Soal 1
            [
                'question_text' => 'Laporan berbasis data SETARA Institute menunjukkan tren peningkatan pelanggaran kebebasan beragama/berkeyakinan (KBB): total 477 peristiwa dan 731 tindakan intoleransi sepanjang 2023–2024, dengan lonjakan kasus pada 2024. Di sebuah kota, pemerintah daerah membiarkan pembubaran kegiatan keagamaan minoritas karena khawatir kehilangan dukungan politik mayoritas. Sebagai calon ASN yang diminta memberi rekomendasi, sikap kebijakan yang PALING mencerminkan nasionalisme konstitusional adalah...',
                'options' => [
                    ['text' => 'Menghormati aspirasi mayoritas masyarakat setempat demi menjaga ketertiban umum dan stabilitas politik daerah, meskipun harus membatasi aktivitas kelompok minoritas.', 'is_correct' => false],
                    ['text' => 'Menyerahkan sepenuhnya penyelesaian konflik keagamaan kepada mekanisme sosial dan tokoh masyarakat lokal agar pemerintah tidak dianggap memihak kelompok tertentu.', 'is_correct' => false],
                    ['text' => 'Menjaga netralitas pemerintah daerah dengan tidak terlibat langsung dalam konflik, selama tidak menimbulkan gangguan keamanan yang meluas.', 'is_correct' => false],
                    ['text' => 'Menjamin kebebasan beragama seluruh warga negara sesuai UUD 1945, menegakkan hukum secara adil tanpa diskriminasi, serta melindungi kelompok minoritas dari tindakan intoleransi meskipun berisiko kehilangan dukungan politik.', 'is_correct' => true],
                    ['text' => 'Mengupayakan kompromi dengan membatasi sementara kegiatan keagamaan minoritas sambil melakukan dialog agar tercapai kesepakatan bersama dengan kelompok mayoritas.', 'is_correct' => false],
                ],
                'explanation' => 'Nasionalisme konstitusional menempatkan konstitusi (UUD 1945) sebagai landasan utama dalam penyelenggaraan negara, bukan kepentingan politik jangka pendek atau tekanan mayoritas.<br><br>Pasal 28E ayat (1) dan Pasal 29 ayat (2) UUD 1945 secara tegas menjamin kebebasan beragama dan berkeyakinan bagi setiap warga negara tanpa diskriminasi. Dalam konteks ini, ASN dituntut untuk setia pada konstitusi dan hukum, bukan pada kepentingan elektoral.<br><br>Opsi D paling tepat karena mencerminkan:<br><li>Supremasi konstitusi</li><li>Penegakan hukum yang adil</li><li>Perlindungan hak asasi manusia</li><li>Komitmen pada nilai Pancasila dan Bhinneka Tunggal Ika</li>Inilah esensi nasionalisme konstitusional yang wajib dimiliki oleh setiap ASN.',
            ],
            // Soal 2
            [
                'question_text' => 'Pemerintah mempersiapkan pemindahan tahap awal sekitar 3.500 ASN dari 16 kementerian/lembaga ke Ibu Kota Nusantara (IKN) sebagai bagian dari proyek prioritas nasional, sekaligus mempercepat pemerataan pembangunan di luar Jawa. Dalam forum internal, sebagian ASN menolak dengan alasan: "Nasionalisme saya justru menolak pindah. Ibu kota itu ya harus di Jakarta, simbol negara sejak dulu." Sebagai calon ASN yang diminta memberi pandangan, sikap yang PALING mencerminkan nasionalisme integratif adalah...',
                'options' => [
                    ['text' => 'Menghargai pandangan ASN yang menolak pindah karena keterikatan historis Jakarta sebagai simbol nasional, demi menjaga rasa kebangsaan yang telah terbentuk.', 'is_correct' => false],
                    ['text' => 'Mendukung pemindahan IKN sebagai kebijakan negara yang bertujuan memperkuat persatuan nasional melalui pemerataan pembangunan dan integrasi seluruh wilayah Indonesia.', 'is_correct' => true],
                    ['text' => 'Menyarankan agar pemindahan ASN dilakukan secara sukarela saja agar tidak menimbulkan perpecahan dan resistensi di kalangan aparatur negara.', 'is_correct' => false],
                    ['text' => 'Menilai bahwa nasionalisme sejati adalah mempertahankan simbol-simbol lama negara demi menjaga identitas nasional yang sudah dikenal dunia internasional.', 'is_correct' => false],
                    ['text' => 'Mengusulkan penundaan pemindahan IKN sampai seluruh ASN memiliki pemahaman dan kesiapan yang sama terhadap makna nasionalisme.', 'is_correct' => false],
                ],
                'explanation' => 'Nasionalisme integratif menekankan persatuan bangsa di tengah keberagaman wilayah, kepentingan, dan latar belakang, serta mendukung kebijakan negara yang bertujuan mengintegrasikan seluruh wilayah Indonesia secara adil dan merata.<br><br>Pemindahan IKN bukan sekadar relokasi fisik, melainkan strategi nasional untuk memperkuat kohesi nasional dan mengurangi ketimpangan pembangunan.<br><br>Opsi B paling tepat karena mencerminkan:<br><li>Dukungan terhadap kebijakan negara yang sah dan strategis</li><li>Upaya pemerataan pembangunan sebagai perekat persatuan bangsa</li><li>Kesadaran bahwa nasionalisme bersifat dinamis, bukan statis</li><li>Komitmen ASN pada kepentingan nasional dan keutuhan NKRI</li>Inilah wujud nasionalisme integratif yang diharapkan dari setiap ASN.',
            ],
            // Soal 3
            [
                'question_text' => 'Tema resmi Hari Lahir Pancasila 2026 adalah "Memperkokoh Ideologi Pancasila Menuju Indonesia Raya", dengan logo "Garuda Niskala Hema" yang melambangkan kekuatan, keteguhan, dan kejayaan bangsa dengan Pancasila sebagai fondasi. Di media sosial muncul hoaks yang menuduh logo tersebut mengandung simbol asing yang ingin mengganti Pancasila. Sebagai calon ASN yang membuat materi edukasi publik, langkah yang PALING mencerminkan nasionalisme ideologis adalah...',
                'options' => [
                    ['text' => 'Menghimbau masyarakat untuk tidak membesar-besarkan isu logo agar tidak menimbulkan kegaduhan dan polarisasi di ruang publik.', 'is_correct' => false],
                    ['text' => 'Membiarkan perdebatan berkembang secara alami di media sosial sebagai bagian dari kebebasan berekspresi masyarakat.', 'is_correct' => false],
                    ['text' => 'Menyusun materi edukasi berbasis fakta yang menjelaskan makna logo dan nilai Pancasila secara rasional, serta meluruskan hoaks tanpa menyerang pihak tertentu.', 'is_correct' => true],
                    ['text' => 'Menegaskan bahwa kritik terhadap simbol negara adalah bentuk sikap tidak nasionalis dan harus dihentikan demi persatuan bangsa.', 'is_correct' => false],
                    ['text' => 'Menghindari pembahasan simbol negara di ruang publik agar tidak dimanfaatkan oleh pihak yang tidak bertanggung jawab.', 'is_correct' => false],
                ],
                'explanation' => 'Nasionalisme ideologis menekankan kesetiaan dan pemahaman rasional terhadap Pancasila sebagai ideologi negara, serta kemampuan mempertahankannya melalui cara-cara edukatif dan konstitusional.<br><br>Hoaks yang menyerang simbol Pancasila harus dihadapi dengan klarifikasi berbasis fakta, bukan pembiaran atau represi.<br><br>Opsi C paling tepat karena mencerminkan:<br><li>Pemahaman ideologis yang matang terhadap Pancasila</li><li>Pendekatan edukatif dan persuasif</li><li>Perlindungan ideologi negara melalui literasi publik</li><li>Sikap ASN yang rasional, beradab, dan demokratis</li>Inilah bentuk nasionalisme ideologis yang relevan di era digital.',
            ],
            // Soal 4
            [
                'question_text' => 'Pemerintah melalui Kemenag dan Kemenko PMK menyusun Peta Jalan Moderasi Beragama 2025–2029 untuk memperkuat toleransi dan kerukunan sebagai fondasi karakter bangsa dalam menghadapi perubahan global dan risiko konflik horizontal. Dalam FGD di daerah, ada yang menilai moderasi beragama sebagai upaya "melemahkan identitas agama" demi kepentingan politik. Sebagai calon ASN analis kebijakan, pernyataan yang PALING tepat dan mencerminkan nasionalisme kebangsaan adalah...',
                'options' => [
                    ['text' => 'Moderasi beragama memang perlu dibatasi agar tidak menimbulkan kesalahpahaman di tengah masyarakat yang religius.', 'is_correct' => false],
                    ['text' => 'Moderasi beragama merupakan kompromi politik yang harus disesuaikan dengan kepentingan kelompok mayoritas di daerah.', 'is_correct' => false],
                    ['text' => 'Setiap agama seharusnya dijalankan secara penuh tanpa campur tangan negara demi menjaga kemurniannya.', 'is_correct' => false],
                    ['text' => 'Moderasi beragama bertujuan menjaga keseimbangan antara pengamalan ajaran agama dan komitmen kebangsaan dalam kerangka Pancasila.', 'is_correct' => true],
                    ['text' => 'Moderasi beragama sebaiknya diterapkan hanya di wilayah perkotaan yang masyarakatnya lebih majemuk.', 'is_correct' => false],
                ],
                'explanation' => 'Nasionalisme kebangsaan menekankan persatuan nasional di atas perbedaan agama, suku, dan budaya, dengan Pancasila sebagai titik temu bersama.<br><br>Moderasi beragama bukan upaya melemahkan agama, melainkan strategi kebangsaan untuk mencegah konflik dan menjaga keutuhan NKRI.<br><br>Opsi D paling tepat karena mencerminkan:<br><li>Sinergi antara nilai agama dan nilai kebangsaan</li><li>Peran negara dalam menjaga kerukunan</li><li>Semangat Bhinneka Tunggal Ika</li><li>Nasionalisme yang inklusif dan berorientasi persatuan</li>Inilah wujud nasionalisme kebangsaan dalam kebijakan publik.',
            ],
            // Soal 5
            [
                'question_text' => 'Data dan kasus terbaru menunjukkan perundungan berbasis agama bahkan menimpa anak usia sekolah dasar; misalnya kasus siswa SD yang meninggal diduga akibat perundungan karena perbedaan agama, serta kasus retret anak yang dirusak warga karena kecurigaan ibadah. Sebagai calon guru PNS, tindakan yang PALING mencerminkan nasionalisme dan bela negara dalam dimensi non-militer adalah...',
                'options' => [
                    ['text' => 'Menyerahkan penanganan kasus intoleransi sepenuhnya kepada pihak berwenang agar tidak mengganggu proses belajar mengajar.', 'is_correct' => false],
                    ['text' => 'Mengajarkan toleransi secara umum tanpa menyentuh isu sensitif agama agar tidak memicu konflik di sekolah.', 'is_correct' => false],
                    ['text' => 'Menanamkan nilai Pancasila, toleransi, dan saling menghormati melalui pendidikan karakter serta menciptakan lingkungan sekolah yang aman dan inklusif.', 'is_correct' => true],
                    ['text' => 'Memfokuskan pendidikan pada prestasi akademik karena urusan sosial dan agama berada di luar tanggung jawab guru.', 'is_correct' => false],
                    ['text' => 'Memberikan sanksi tegas kepada siswa yang berbeda keyakinan agar tidak menimbulkan gesekan di lingkungan sekolah.', 'is_correct' => false],
                ],
                'explanation' => 'Pilihan C mempraktikkan bela negara non-militer, yaitu membela bangsa dengan cara melindungi martabat dan keselamatan warga negara (terutama anak) dan menanamkan nilai Pancasila dalam kehidupan nyata.<br><br>Ini sejalan dengan:<br><li>Sila ke-2: Kemanusiaan yang Adil dan Beradab</li><li>Sila ke-5: Keadilan Sosial</li><li>Konsep nasionalisme humanis, yang menempatkan setiap warga – apapun agamanya – sebagai bagian berharga dari bangsa</li>Program pendidikan toleransi dan HAM di sekolah juga mendukung pembentukan karakter warga negara yang demokratis dan anti-kekerasan.',
            ],
            // Soal 6
            [
                'question_text' => 'Sejumlah Proyek Strategis Nasional (PSN), termasuk di kawasan timur Indonesia, menuai penolakan sebagian kelompok lokal yang khawatir terhadap hak masyarakat adat dan narasi "pribumi akan tergusur oleh pendatang". PSN sendiri dirancang untuk mempercepat pertumbuhan dan pemerataan pembangunan di berbagai daerah. Dalam dialog dengan warga lokal, sebagai calon ASN analis kebijakan, narasi yang PALING mencerminkan nasionalisme yang adil dan inklusif adalah...',
                'options' => [
                    ['text' => 'Menegaskan bahwa kepentingan nasional harus selalu diutamakan meskipun berpotensi mengorbankan kepentingan masyarakat lokal demi percepatan pembangunan.', 'is_correct' => false],
                    ['text' => 'Menyatakan bahwa penolakan masyarakat adat merupakan bentuk resistensi terhadap kemajuan yang perlu dikurangi melalui pendekatan keamanan.', 'is_correct' => false],
                    ['text' => 'Menyarankan agar proyek ditunda sampai seluruh kelompok lokal menyatakan persetujuan penuh tanpa pengecualian.', 'is_correct' => false],
                    ['text' => 'Menjelaskan bahwa PSN bertujuan untuk kesejahteraan bersama, dengan komitmen negara melindungi hak masyarakat adat, melibatkan warga lokal, dan memastikan pembangunan berjalan adil tanpa diskriminasi.', 'is_correct' => true],
                    ['text' => 'Mengakui bahwa pembangunan besar selalu membawa risiko sosial sehingga pengorbanan masyarakat lokal merupakan konsekuensi yang tidak terhindarkan.', 'is_correct' => false],
                ],
                'explanation' => 'Nasionalisme yang adil dan inklusif menempatkan kepentingan nasional dan perlindungan hak warga negara secara seimbang, termasuk hak masyarakat adat.<br><br>Pembangunan tidak boleh bersifat eksklusif atau menyingkirkan kelompok tertentu, melainkan harus dilakukan melalui dialog, partisipasi, dan keadilan sosial sesuai nilai Pancasila.<br><br>Opsi D paling tepat karena mencerminkan:<br><li>Nasionalisme yang mengakui keberagaman dan hak masyarakat adat</li><li>Keseimbangan antara pembangunan dan keadilan sosial</li><li>Pendekatan dialogis dan partisipatif</li><li>Implementasi nilai Pancasila dan Bhinneka Tunggal Ika</li>Inilah wujud nasionalisme yang adil dan inklusif dalam perumusan dan komunikasi kebijakan publik.',
            ],
            // Soal 7
            [
                'question_text' => 'Data KPK menunjukkan puluhan kasus korupsi sepanjang 2025 melibatkan pejabat dan ASN di berbagai instansi, terutama terkait proyek dan pengadaan. Di sebuah dinas, Anda anggota panitia lelang jalan. Seorang rekan menawarkan: "Vendor ini mau kasih ucapan terima kasih asal kita bantu atur spesifikasi biar dia yang menang. Proyek tetap jalan kok, masyarakat juga diuntungkan." Sikap yang PALING mencerminkan integritas sebagai ASN adalah...',
                'options' => [
                    ['text' => 'Menolak tegas tawaran tersebut dan tetap berpegang pada prinsip pengadaan yang bersih dan transparan.', 'is_correct' => true],
                    ['text' => 'Menolak dengan halus agar hubungan dengan rekan tidak rusak.', 'is_correct' => false],
                    ['text' => 'Menerima tawaran tersebut asalkan proyek tetap berjalan dan masyarakat diuntungkan.', 'is_correct' => false],
                    ['text' => 'Melaporkan rekan tersebut ke atasan langsung.', 'is_correct' => false],
                    ['text' => 'Mengabaikan tawaran tersebut tanpa memberikan respons.', 'is_correct' => false],
                ],
                'explanation' => 'Integritas ASN menuntut kejujuran aktif, bukan sekadar penolakan pasif. Dalam konteks pengadaan yang rawan korupsi, integritas diwujudkan melalui penolakan dan pelaporan gratifikasi sebagaimana mandat sistem pencegahan korupsi dan pengawasan internal pemerintah.<br><br>Sikap ini:<br><li>Melindungi kepentingan publik</li><li>Memperkuat tata kelola bersih</li><li>Mencerminkan nilai BerAKHLAK (Akuntabel dan Loyal)</li>Menolak suap plus melapor melalui mekanisme resmi menunjukkan bahwa ASN bukan hanya pasif tidak korupsi, tetapi aktif menjaga sistem tetap bersih.',
            ],
            // Soal 8
            [
                'question_text' => 'Anda adalah pejabat pengadaan di sebuah dinas. Tanpa Anda duga, salah satu peserta tender adalah perusahaan milik saudara kandang Anda. Rekan mengatakan: "Tenang saja, kita ikuti aturan saja di atas kertas. Toh kamu bisa jaga objektivitas." Dalam konteks integritas dan pengelolaan konflik kepentingan, langkah yang PALING tepat adalah...',
                'options' => [
                    ['text' => 'Tetap menjalankan peran dengan menjaga profesionalisme dan tidak terlibat dalam penilaian teknis.', 'is_correct' => false],
                    ['text' => 'Mengawasi proses secara lebih ketat agar tidak terjadi pelanggaran prosedur.', 'is_correct' => false],
                    ['text' => 'Menyerahkan keputusan akhir kepada pimpinan tanpa menyebutkan hubungan keluarga.', 'is_correct' => false],
                    ['text' => 'Melaporkan potensi konflik kepentingan dan mengundurkan diri dari proses pengadaan sesuai ketentuan etika ASN.', 'is_correct' => true],
                    ['text' => 'Memastikan seluruh tahapan administrasi dipenuhi agar tidak menimbulkan masalah hukum di kemudian hari.', 'is_correct' => false],
                ],
                'explanation' => 'Integritas ASN mengharuskan pengelolaan konflik kepentingan secara terbuka dan preventif, bukan sekadar mengandalkan objektivitas pribadi.<br><br>Pilihan D mencerminkan prinsip integritas dan pengelolaan konflik kepentingan: ketika kepentingan pribadi/keluarga berpotensi memengaruhi keputusan jabatan, ASN harus:<br><li>Mengungkapkan (disclosure)</li><li>Mengundurkan diri dari posisi pengambil keputusan di kasus tersebut</li>Ini sejalan dengan:<br><li>Nilai BerAKHLAK – Akuntabel dan Loyal</li><li>Prinsip kode etik ASN yang menuntut bebas dari KKN dan intervensi kepentingan pribadi/golongan</li><li>Kepentingan publik di atas kepentingan pribadi dan keluarga</li>',
            ],
            // Soal 9
            [
                'question_text' => 'Indonesia berkali-kali diguncang kebocoran data: dari Pusat Data Nasional Sementara (PDNS) hingga laporan BSSN soal puluhan juta data kredensial yang terekspos, termasuk domain .go.id. Sebagai ASN operator sistem, Anda tahu bahwa rekan-rekan sering: <br>• login sistem pemerintah dari laptop pribadi yang tidak aman, <br>• saling berbagi akun (username + password) untuk "mempermudah pekerjaan". <br>Setelah muncul berita kebocoran data .go.id, tindakan yang PALING mencerminkan integritas dalam pengelolaan informasi publik adalah...',
                'options' => [
                    ['text' => 'Mengingatkan rekan kerja agar lebih berhati-hati dalam menggunakan akun sistem pemerintah.', 'is_correct' => false],
                    ['text' => 'Menyesuaikan kebiasaan kerja secara bertahap agar tidak mengganggu pelayanan publik.', 'is_correct' => false],
                    ['text' => 'Mengutamakan kelancaran layanan sambil menunggu arahan resmi pimpinan.', 'is_correct' => false],
                    ['text' => 'Memperketat akses secara internal pada unit kerja tanpa perlu sosialisasi luas.', 'is_correct' => false],
                    ['text' => 'Mendorong kepatuhan pada standar keamanan informasi, menghentikan praktik berbagi akun, serta melaporkan risiko keamanan sesuai prosedur yang berlaku.', 'is_correct' => true],
                ],
                'explanation' => 'Integritas dalam pengelolaan informasi publik berarti bertanggung jawab menjaga keutuhan dan keamanan data negara.<br><br>Pilihan E sesuai dengan konsep integritas informasi: menjaga kerahasiaan, keutuhan (integrity), dan ketersediaan data.<br><br>Dalam dimensi integritas ASN:<br><li>Memegang data publik adalah bentuk amanah</li><li>Nilai BerAKHLAK – Akuntabel dan Kompeten mengharuskan ASN memahami risiko dan mengubah perilaku kerja agar sesuai standar keamanan</li><li>Penegakan disiplin akses dan pelaporan risiko sejalan dengan kebijakan nasional keamanan siber</li><li>Mencerminkan akuntabilitas ASN terhadap kepercayaan publik</li>',
            ],
            // Soal 10
            [
                'question_text' => 'Beberapa kode etik ASN menegaskan bahwa integritas mencakup menjaga citra dan martabat institusi, termasuk larangan memamerkan gaya hidup hedonis dan kewajiban menggunakan media sosial secara bijak. Seorang ASN muda rajin mengunggah konten di media sosial: memamerkan tas branded, liburan mewah, dan "flexing" di tempat hiburan mahal. Publik mulai mempertanyakan asal-usul kekayaannya dan citra instansi ikut terdampak. Sebagai atasannya, langkah yang PALING sesuai dengan prinsip integritas dan pembinaan etika ASN adalah...',
                'options' => [
                    ['text' => 'Mengimbau ASN tersebut agar lebih berhati-hati dalam bermedia sosial demi menjaga citra instansi.', 'is_correct' => false],
                    ['text' => 'Mengingatkan bahwa media sosial bersifat pribadi namun tetap mencerminkan identitas ASN.', 'is_correct' => false],
                    ['text' => 'Menyarankan penghapusan konten tertentu agar polemik publik tidak berlanjut.', 'is_correct' => false],
                    ['text' => 'Memberikan pembinaan etika, menegaskan kewajiban menjaga citra institusi, serta memastikan kepatuhan terhadap aturan pelaporan harta dan kode etik ASN.', 'is_correct' => true],
                    ['text' => 'Menunggu hasil klarifikasi publik sebelum mengambil langkah pembinaan.', 'is_correct' => false],
                ],
                'explanation' => 'Integritas ASN mencakup keteladanan, etika, dan akuntabilitas, termasuk di ruang digital.<br><br>Pilihan D sejalan dengan pemahaman bahwa integritas bukan hanya soal tidak korupsi, tetapi juga:<br><li>Keteladanan</li><li>Kesederhanaan</li><li>Menjaga kepercayaan publik</li>Sebagai pimpinan, Anda wajib melakukan pembinaan etik berbasis:<br><li>Dialog</li><li>Klarifikasi</li><li>Penegakan aturan tertulis</li>Ini sejalan dengan:<br><li>Nilai BerAKHLAK – Harmonis dan Akuntabel</li><li>Prinsip good governance: masalah perilaku ASN tidak cukup diatasi di permukaan, tetapi menyentuh akar budaya integritas</li><li>Kode etik kementerian/lembaga yang menegaskan integritas mencakup tidak menunjukkan gaya hidup hedonis dan menggunakan media sosial secara bijak</li>',
            ],
            // Soal 11
            [
                'question_text' => 'Laporan menunjukkan bahwa korupsi di sektor publik sering berkaitan dengan manipulasi anggaran dan laporan kinerja, mulai dari mark-up hingga proyek fiktif. Seorang atasan meminta Anda mengubah laporan realisasi program: "Naikin sedikit persentase keberhasilan, jangan ditulis ada kegiatan yang gagal. Ini demi citra dinas. Nanti tahun depan kita perbaiki sungguhan." <br><br>Dalam perspektif integritas dan akuntabilitas kinerja ASN, sikap yang PALING benar adalah...',
                'options' => [
                    ['text' => 'Menyesuaikan redaksi laporan agar tetap terlihat positif tanpa mengubah data inti secara signifikan.', 'is_correct' => false],
                    ['text' => 'Menyampaikan laporan sesuai kondisi riil, termasuk capaian dan kegagalan, serta menjelaskan faktor penghambat sebagai bahan evaluasi perbaikan.', 'is_correct' => true],
                    ['text' => 'Mengikuti arahan atasan karena penilaian kinerja bersifat kolektif dan bertujuan menjaga reputasi instansi.', 'is_correct' => false],
                    ['text' => 'Menunda penyampaian laporan sampai ada arahan tertulis agar tidak disalahkan di kemudian hari.', 'is_correct' => false],
                    ['text' => 'Mengoreksi laporan secara bertahap agar selaras dengan target perencanaan jangka panjang dinas.', 'is_correct' => false],
                ],
                'explanation' => 'Integritas dan akuntabilitas kinerja ASN menuntut kejujuran dalam pelaporan serta kesediaan mempertanggungjawabkan hasil kerja apa adanya.<br><br>Pilihan B sesuai dengan konsep akuntabilitas sebagai bagian inti integritas:<br><li>Laporan kinerja adalah bentuk pertanggungjawaban kepada publik</li><li>Harus jujur dan berbasis data</li><li>Bukan alat pencitraan, melainkan instrumen evaluasi kebijakan dan perbaikan pelayanan publik</li>Nilai BerAKHLAK – Akuntabel berarti ASN:<br><li>Bertanggung jawab atas hasil dan proses</li><li>Berani menyampaikan fakta apa adanya</li><li>Proaktif menawarkan perbaikan, bukan memoles data semu demi citra instansi</li>',
            ],
            // Soal 12
            [
                'question_text' => 'Di unit Anda, sudah beberapa tahun ada pola mark-up rutin dalam pengadaan barang yang melibatkan beberapa pejabat. Anda memiliki bukti kuat (dokumen dan rekaman). Rekan kerja berbisik: "Kalau kamu bongkar, nama instansi rusak, kariermu juga tamat. Ingat loyalitas sama atasan." Dalam kerangka integritas dan makna loyalitas ASN, langkah yang PALING tepat adalah...',
                'options' => [
                    ['text' => 'Menjaga kerahasiaan temuan demi stabilitas organisasi dan keharmonisan internal.', 'is_correct' => false],
                    ['text' => 'Menunggu momentum yang lebih aman agar pengungkapan tidak berdampak negatif pada karier pribadi.', 'is_correct' => false],
                    ['text' => 'Melaporkan temuan tersebut melalui mekanisme pengaduan resmi dan perlindungan pelapor sesuai ketentuan yang berlaku.', 'is_correct' => true],
                    ['text' => 'Mengonfirmasi terlebih dahulu kepada atasan yang terlibat agar masalah dapat diselesaikan secara internal.', 'is_correct' => false],
                    ['text' => 'Menghentikan keterlibatan pribadi tanpa melaporkan agar tidak ikut terseret risiko hukum.', 'is_correct' => false],
                ],
                'explanation' => 'Integritas ASN menempatkan kepentingan negara dan kepatuhan hukum di atas loyalitas personal.<br><br>Loyalitas ASN sejatinya adalah kepada:<br><li>Konstitusi</li><li>Hukum</li><li>Kepentingan publik</li><li>Bukan pada praktik menyimpang</li>Pilihan C mencerminkan pemahaman bahwa loyalitas ASN pertama-tama kepada bangsa, negara, dan konstitusi, bukan kepada individu atasan.<br><br>Melapor melalui mekanisme whistleblowing yang sah menunjukkan integritas:<br><li>Berani mengungkap pelanggaran dengan cara yang terukur</li><li>Terlindungi</li><li>Bertanggung jawab, bukan lewat gosip atau pembocoran liar</li>Ini sejalan dengan nilai BerAKHLAK – Loyal dan Akuntabel: setia pada kepentingan publik dan berani mempertanggungjawabkan tindakan demi pemerintahan yang bersih.',
            ],
            // Soal 13
            [
                'question_text' => 'Tahun 2024, Pusat Data Nasional Sementara (PDNS) diserang ransomware hingga mengganggu berbagai layanan publik strategis (imigrasi, layanan bandara, dll). Sebagai ASN di Dinas Kominfo provinsi, kamu diminta merumuskan respon jangka pendek dan jangka menengah di daerah. Langkah yang PALING mencerminkan sikap bela negara dalam menghadapi ancaman non-militer (siber) adalah...',
                'options' => [
                    ['text' => 'Mengutamakan pemulihan layanan publik secepat mungkin meskipun harus menggunakan sistem darurat tanpa evaluasi keamanan mendalam.', 'is_correct' => false],
                    ['text' => 'Menunggu arahan penuh dari pemerintah pusat agar kebijakan daerah tetap selaras secara nasional.', 'is_correct' => false],
                    ['text' => 'Memfokuskan sosialisasi kepada masyarakat agar memahami bahwa serangan siber adalah risiko global yang sulit dihindari.', 'is_correct' => false],
                    ['text' => 'Memperkuat keamanan sistem daerah, meningkatkan literasi keamanan siber ASN, serta berkoordinasi dengan BSSN dan instansi terkait.', 'is_correct' => true],
                    ['text' => 'Membatasi akses digital layanan publik sementara waktu demi mencegah serangan lanjutan.', 'is_correct' => false],
                ],
                'explanation' => 'Bela negara menurut UU No. 3 Tahun 2002 adalah segala usaha untuk mempertahankan kedaulatan, keutuhan wilayah, dan keselamatan bangsa dari berbagai ancaman, termasuk ancaman non-militer seperti serangan siber.<br><br>Bela negara dalam ancaman non-militer mencakup:<br><li>Perlindungan kedaulatan digital</li><li>Keberlangsungan layanan publik</li>Opsi D mencerminkan kesiapsiagaan negara menghadapi perang siber:<br><li>Penguatan sistem</li><li>Peningkatan kapasitas ASN</li><li>Koordinasi lintas lembaga</li>Bela negara di era digital bukan sekadar tindakan teknis sempit, tetapi penguatan budaya aman dan tangguh di ruang siber sebagai bagian dari pertahanan negara.',
            ],
            // Soal 14
            [
                'question_text' => 'Indonesia termasuk negara dengan indeks risiko bencana sedang–berat; partisipasi masyarakat dalam penanggulangan bencana diakui sangat menentukan pengurangan dampak bencana. Di sebuah kabupaten rawan banjir, pemerintah daerah mengajak warga memaknai penanggulangan bencana sebagai bagian dari bela negara. Program yang PALING mencerminkan bela negara non-militer di tingkat masyarakat adalah...',
                'options' => [
                    ['text' => 'Pelibatan warga dalam simulasi evakuasi, relawan kebencanaan, dan edukasi kesiapsiagaan berbasis komunitas.', 'is_correct' => true],
                    ['text' => 'Peningkatan anggaran infrastruktur penanggulangan bencana yang dikelola sepenuhnya oleh pemerintah daerah.', 'is_correct' => false],
                    ['text' => 'Penugasan aparat keamanan untuk mengendalikan warga saat terjadi bencana.', 'is_correct' => false],
                    ['text' => 'Penyediaan bantuan logistik pascabencana sebagai fokus utama kebijakan daerah.', 'is_correct' => false],
                    ['text' => 'Penetapan status darurat bencana agar pemerintah pusat turun tangan penuh.', 'is_correct' => false],
                ],
                'explanation' => 'Penelitian dan pedoman kebencanaan menekankan bahwa partisipasi aktif masyarakat dalam mitigasi, kesiapsiagaan, tanggap darurat, dan pemulihan adalah kunci mengurangi risiko bencana.<br><br>Dalam perspektif bela negara:<br><li>Konsep bela negara dalam kebencanaan memaknai pengurangan risiko bencana sebagai wujud cinta tanah air dan tanggung jawab melindungi sesama warga</li><li>Nilai dasar bela negara seperti cinta tanah air, kesadaran berbangsa, rela berkorban, dan kemampuan awal bela negara tercermin dalam kesiapan warga terlatih, bukan hanya sebagai penerima bantuan</li>Bela negara non-militer menekankan partisipasi aktif warga dalam menjaga keselamatan bangsa. Keterlibatan masyarakat dalam kesiapsiagaan dan mitigasi bencana memperkuat ketahanan nasional dari bawah, sesuai konsep bela negara sebagai tanggung jawab seluruh rakyat.',
            ],
            // Soal 15
            [
                'question_text' => 'Di sebuah kecamatan perbatasan, sering terjadi:<br>• penyelundupan barang,<br>• penangkapan ikan ilegal oleh kapal asing,<br>• masuknya paham separatis melalui media sosial.<br><br>Sebagai camat (ASN) yang mengikuti pelatihan bela negara, langkah yang PALING menggambarkan penerapan sistem pertahanan dan keamanan rakyat semesta (Sishankamrata) dalam konteks bela negara adalah...',
                'options' => [
                    ['text' => 'Menyerahkan sepenuhnya penanganan keamanan perbatasan kepada TNI dan Polri.', 'is_correct' => false],
                    ['text' => 'Memperkuat patroli aparat desa untuk mencegah aktivitas ilegal.', 'is_correct' => false],
                    ['text' => 'Membangun kolaborasi antara aparat keamanan, pemerintah desa, nelayan, tokoh masyarakat, dan pemuda dalam pengawasan wilayah.', 'is_correct' => true],
                    ['text' => 'Membatasi akses masyarakat ke wilayah perbatasan demi alasan keamanan.', 'is_correct' => false],
                    ['text' => 'Mengoptimalkan pengawasan administratif keluar-masuk penduduk.', 'is_correct' => false],
                ],
                'explanation' => 'Konsep Sistem Pertahanan Keamanan Rakyat Semesta (Sishankamrata) menegaskan bahwa pertahanan Indonesia bersifat semesta: melibatkan seluruh rakyat, seluruh wilayah, dan segenap sumber daya nasional secara terintegrasi, dengan TNI sebagai komponen utama, didukung rakyat sebagai komponen cadangan/pendukung.<br><br>Opsi C paling tepat karena:<br><li>Menerjemahkan Sishankamrata dalam bentuk kewaspadaan dini berbasis masyarakat di wilayah perbatasan</li><li>Menyatukan aspek wawasan kebangsaan, ekonomi, sosial, dan keamanan sebagai wujud bela negara yang komprehensif, bukan hanya militeristik</li><li>Selaras dengan UU Pertahanan yang menyebut bahwa tiap warga negara punya hak dan kewajiban ikut serta dalam upaya bela negara</li>Jadi, bela negara di perbatasan bukan hanya soal penambahan pos militer, tetapi juga pengorganisasian warga sebagai bagian dari ketahanan nasional.',
            ],
            // Soal 16
            [
                'question_text' => 'Beredar masif hoaks di media sosial: "NKRI akan bubar tahun depan, beberapa daerah sudah sepakat referendum. Pemerintah pusat menyembunyikan fakta ini." Hoaks semacam ini berpotensi menurunkan kepercayaan publik pada negara dan memicu konflik SARA. Sebagai ASN muda dan penggiat konten edukatif, langkah yang PALING mencerminkan sikap bela negara di ruang digital adalah...',
                'options' => [
                    ['text' => 'Melaporkan akun penyebar hoaks ke platform dan membokir semua kontak yang menyebarkan konten serupa.', 'is_correct' => false],
                    ['text' => 'Membuat konten tandingan yang berisi ejekan dan meme terhadap penyebar hoaks agar mereka malu.', 'is_correct' => false],
                    ['text' => 'Menghasilkan konten edukasi yang menjelaskan fakta hukum tentang keutuhan NKRI (UUD 1945, pasal-pasal kedaulatan), data resmi pemerintah.', 'is_correct' => true],
                    ['text' => 'Mengingatkan di lingkaran pribadi saja (grup keluarga/teman), karena di luar itu bukan tanggung jawab pribadi.', 'is_correct' => false],
                    ['text' => 'Mengusulkan pemblokiran total akses ke platform media sosial tertentu di Indonesia.', 'is_correct' => false],
                ],
                'explanation' => 'Ancaman disinformasi dan hoaks yang melemahkan kepercayaan terhadap NKRI kini dikategorikan sebagai bentuk ancaman non-militer terhadap ketahanan nasional.<br><br>Dalam konteks bela negara, warga – termasuk ASN – dipanggil untuk melawan ancaman informasi dengan cara yang cerdas dan konstitusional.<br><br>Opsi C paling tepat karena:<br><li>Menggabungkan literasi hukum dan konstitusi (penjelasan dasar hukum keutuhan NKRI) dengan literasi digital (cek fakta)</li><li>Selaras dengan nilai-nilai bela negara: yakin Pancasila, sadar berbangsa dan bernegara, cinta tanah air, serta kemampuan awal bela negara dalam mengidentifikasi dan merespons ancaman di lingkungan sendiri</li><li>Memaknai bela negara sebagai tindakan aktif menjaga ruang publik digital agar tetap sehat, bukan sekadar reaktif memblokir atau mengejek</li>Ini sesuai dengan modul bela negara yang menekankan perlunya sikap kritis dan tanggung jawab warga terhadap ancaman ideologis dan informasi.',
            ],
            // Soal 17
            [
                'question_text' => 'Mahasiswa diajak mengikuti aksi demonstrasi menolak sebuah RUU yang dinilai mengancam hak warga. Dalam poster ajakan tertulis: "Kalau perlu, kita duduki gedung DPR sampai rusak. Kalau negara tidak dengar, biar hancur sekalian!" Sebagai ASN yang juga narasumber dalam diskusi kampus tentang bela negara, sikap yang PALING tepat sesuai konsep bela negara dalam kerangka negara demokratis adalah...',
                'options' => [
                    ['text' => 'Mendukung aksi tersebut sebagai wujud keberanian melawan ketidakadilan.', 'is_correct' => false],
                    ['text' => 'Menolak demonstrasi karena berpotensi mengganggu stabilitas negara.', 'is_correct' => false],
                    ['text' => 'Menekankan bahwa bela negara berarti selalu mendukung kebijakan pemerintah.', 'is_correct' => false],
                    ['text' => 'Menjelaskan bahwa menyampaikan aspirasi adalah hak warga, namun harus dilakukan secara damai, konstitusional, dan menjaga keutuhan negara.', 'is_correct' => true],
                    ['text' => 'Menyarankan mahasiswa fokus pada jalur akademik untuk mendukung ide/gagasan pada saat melakukan unjuk rasa.', 'is_correct' => false],
                ],
                'explanation' => 'Bela negara dalam negara demokratis mengakui hak berpendapat, namun menolak kekerasan dan perusakan.<br><br>Menjaga keseimbangan antara kebebasan sipil dan keutuhan negara adalah inti bela negara berbasis konstitusi.<br><br>Opsi D paling tepat karena:<br><li>Mengakui hak konstitusional warga untuk berpendapat</li><li>Menegaskan pentingnya cara-cara damai dan konstitusional</li><li>Menjaga keutuhan negara sebagai prinsip utama</li><li>Mendorong partisipasi politik yang bertanggung jawab</li>Ini sejalan dengan nilai-nilai Pancasila dan prinsip negara hukum yang menghargai hak asasi manusia sekaligus menjaga ketertiban umum.',
            ],
            // Soal 18
            [
                'question_text' => 'Dalam situasi ancaman penyakit menular baru yang berpotensi pandemi, pemerintah mengeluarkan protokol kewaspadaan dini. Banyak hoaks yang menolak vaksin dan meragukan fasilitas kesehatan pemerintah. Sebagai tenaga kesehatan ASN di puskesmas, tindakan yang PALING mencerminkan bela negara melalui pengabdian profesi adalah...',
                'options' => [
                    ['text' => 'Mengikuti kebijakan pusat tanpa terlibat dalam edukasi publik.', 'is_correct' => false],
                    ['text' => 'Memberikan pelayanan kesehatan rutin sambil menunggu instruksi lanjutan.', 'is_correct' => false],
                    ['text' => 'Menyampaikan edukasi kesehatan berbasis sains, melayani masyarakat secara profesional, dan menjadi teladan kepatuhan protokol.', 'is_correct' => true],
                    ['text' => 'Menghindari diskusi publik agar tidak terlibat polemik.', 'is_correct' => false],
                    ['text' => 'Menyerahkan penanganan hoaks sepenuhnya kepada dinas komunikasi.', 'is_correct' => false],
                ],
                'explanation' => 'Konsepsi bela negara menegaskan bahwa pengabdian sesuai profesi merupakan salah satu bentuk konkret bela negara non-militer.<br><br>Tenaga kesehatan berperan menjaga keselamatan segenap bangsa di bidang kesehatan, yang langsung berkaitan dengan ketahanan nasional.<br><br>Opsi C paling tepat karena:<br><li>Mengaktualisasikan nilai cinta tanah air dan rela berkorban melalui pelayanan kesehatan yang profesional dan proaktif, bukan minimalis</li><li>Menunjukkan kemampuan awal bela negara dalam bentuk kompetensi teknis (medis) dan sosial (edukasi, kolaborasi, komunikasi publik)</li><li>Selaras dengan definisi bela negara sebagai tekad, sikap, dan tindakan warga negara yang dilandasi kecintaan pada tanah air, kesadaran berbangsa dan bernegara, yakin Pancasila, dan rela berkorban untuk menjaga eksistensi NKRI</li>Dengan begitu, bela negara bukan hanya di medan tempur, tetapi juga di ruang praktik profesi yang langsung menyentuh kehidupan warga.',
            ],
            // Soal 19
            [
                'question_text' => 'Sebuah perda kabupaten mengatur bahwa warga penganut aliran kepercayaan tidak boleh menggunakan fasilitas pemakaman umum, dan harus membangun pemakaman sendiri. Sebagian warga menggugat karena merasa didiskriminasi. Sebagai analis kebijakan di provinsi, rekomendasi yang PALING tepat berdasarkan pilar negara, khususnya Pancasila sebagai sumber dari segala sumber hukum adalah...',
                'options' => [
                    ['text' => 'Merekomendasikan revisi/substansi perda agar selaras dengan nilai Pancasila (kemanusiaan yang adil dan beradab serta keadilan sosial), menjamin perlakuan setara bagi penghayat kepercayaan, dan memastikan fasilitas publik tidak dikelola secara diskriminatif.', 'is_correct' => true],
                    ['text' => 'Mendorong pemerintah kabupaten membuat fasilitas pemakaman khusus penghayat kepercayaan sebagai bentuk pengakuan identitas, tanpa mengubah perda yang sudah berjalan.', 'is_correct' => false],
                    ['text' => 'Menyarankan penyelesaian melalui musyawarah adat setempat agar tidak menimbulkan kegaduhan politik, sementara perda tetap diberlakukan.', 'is_correct' => false],
                    ['text' => 'Menilai bahwa perda merupakan kewenangan otonomi daerah sehingga pemerintah provinsi sebaiknya tidak ikut campur, selama tidak memicu konflik terbuka.', 'is_correct' => false],
                    ['text' => 'Menetapkan kebijakan transisi: penghayat boleh memakai TPU jika ada persetujuan warga mayoritas setempat untuk menjaga harmoni sosial.', 'is_correct' => false],
                ],
                'explanation' => 'Pancasila sebagai sumber dari segala sumber hukum menuntut setiap kebijakan daerah berlandaskan nilai kemanusiaan, persatuan, dan keadilan sosial.<br><br>Fasilitas publik seperti pemakaman umum pada prinsipnya adalah layanan negara/daerah untuk seluruh warga tanpa diskriminasi.<br><br>Opsi A paling tepat karena:<br><li>Mendorong penyesuaian substansi perda agar sejalan dengan nilai Pancasila dan prinsip kesetaraan warga negara</li><li>Memastikan fasilitas publik dikelola secara inklusif</li><li>Mencerminkan fungsi pembinaan dan harmonisasi kebijakan di tingkat provinsi agar regulasi daerah tidak bertentangan dengan nilai dasar bernegara</li><li>Selaras dengan sila ke-2 (Kemanusiaan yang Adil dan Beradab) dan sila ke-5 (Keadilan Sosial)</li>',
            ],
            // Soal 20
            [
                'question_text' => 'Dalam sebuah diskusi, seorang tokoh menyatakan: "Selama pemerintah niatnya baik untuk rakyat, melanggar prosedur hukum sepanjang hasilnya bagus itu boleh. Yang penting hasil, bukan aturan." Sebagai calon ASN yang memahami pilar UUD 1945 dan prinsip negara hukum, tanggapan yang PALING tepat adalah...',
                'options' => [
                    ['text' => 'Menjelaskan bahwa dalam kondisi darurat, tindakan ekstra-prosedural dapat dibenarkan sepanjang untuk kepentingan rakyat.', 'is_correct' => false],
                    ['text' => 'Menegaskan bahwa niat baik tidak cukup; dalam negara hukum, tujuan harus dicapai melalui prosedur konstitusional dan akuntabel karena UUD 1945 membatasi kekuasaan agar tidak sewenang-wenang.', 'is_correct' => true],
                    ['text' => 'Menyatakan bahwa pelanggaran prosedur dapat ditoleransi bila hasilnya terbukti meningkatkan kesejahteraan.', 'is_correct' => false],
                    ['text' => 'Mengajak fokus pada evaluasi manfaat kebijakan daripada memperdebatkan aspek legal-formal.', 'is_correct' => false],
                    ['text' => 'Menyarankan kompromi: prosedur boleh disederhanakan informal asalkan ada persetujuan publik.', 'is_correct' => false],
                ],
                'explanation' => 'UUD 1945 menegaskan Indonesia sebagai negara hukum, artinya penyelenggaraan kekuasaan harus tunduk pada aturan, prosedur, dan mekanisme pertanggungjawaban.<br><br>Prinsip negara hukum dibangun untuk mencegah kekuasaan yang berjalan atas dasar "niat baik" semata, karena:<br><li>Niat tidak selalu dapat diverifikasi</li><li>Mudah berubah menjadi pembenaran tindakan sewenang-wenang</li>Opsi B paling tepat karena menegaskan bahwa tujuan kebijakan (hasil) tetap harus ditempuh melalui:<br><li>Prosedur yang sah</li><li>Transparan</li><li>Akuntabel sesuai konstitusi</li><li>Termasuk mekanisme pengawasan dan koreksi jika terjadi penyimpangan</li>',
            ],
            // Soal 21
            [
                'question_text' => 'Di sebuah daerah yang kaya sumber daya alam, muncul gerakan yang menuntut referendum dengan alasan: "Daerah kami menyumbang pendapatan besar, tapi pembangunan minim. Lebih baik kami lepas saja dari Indonesia agar bisa mengatur diri sendiri." Sebagai pejabat pusat yang datang berdialog, pendekatan yang PALING sesuai dengan pilar negara, khususnya NKRI sebagai pilar kebangsaan adalah...',
                'options' => [
                    ['text' => 'Mengajak dialog dengan menegaskan finalitas NKRI, sambil menyusun paket kebijakan pemerataan: transparansi bagi hasil, percepatan layanan dasar, dan mekanisme partisipasi daerah dalam perencanaan pembangunan.', 'is_correct' => true],
                    ['text' => 'Menolak berdialog karena tuntutan referendum sudah jelas bertentangan dengan konstitusi.', 'is_correct' => false],
                    ['text' => 'Menjanjikan peningkatan anggaran besar-besaran segera agar tuntutan mereda, tanpa perlu membahas isu kebangsaan.', 'is_correct' => false],
                    ['text' => 'Menekankan bahwa keamanan nasional prioritas, dan gerakan tersebut harus ditindak tegas agar tidak menyebar.', 'is_correct' => false],
                    ['text' => 'Meminta tokoh lokal mengendalikan massa dan menyerahkan seluruh penyelesaian pada aparat keamanan.', 'is_correct' => false],
                ],
                'explanation' => 'NKRI sebagai pilar kebangsaan menekankan keutuhan wilayah dan persatuan bangsa sebagai harga mati, namun pendekatan kebangsaan yang matang juga menuntut negara hadir menjawab akar keluhan warga.<br><br>Opsi A paling tepat karena menggabungkan:<br><li>Narasi persatuan dan konstitusionalitas (finalitas NKRI)</li><li>Agenda pemerataan yang terukur</li><li>Transparansi tata kelola sumber daya</li><li>Percepatan layanan dasar</li><li>Mekanisme partisipasi daerah dalam perencanaan pembangunan</li>Dialog yang menegaskan finalitas NKRI harus disertai langkah kebijakan yang kredibel untuk mengurangi ketimpangan, memperkuat rasa keadilan, dan memastikan daerah merasa menjadi bagian utuh dari bangsa.',
            ],
            // Soal 22
            [
                'question_text' => 'Sebuah kota sedang berkembang sebagai destinasi wisata religi. Pemerintah kota kemudian mengeluarkan imbauan non-formal kepada hotel dan restoran: "Agar lebih seragam dan sesuai identitas kota, diharapkan hanya mempekerjakan karyawan dari kelompok agama mayoritas." Sebagian pelaku usaha merasa dilema; aturan ini tidak tertulis, tapi menjadi tekanan sosial. Sebagai ASN di inspektorat daerah, respons yang PALING selaras dengan pilar Bhinneka Tunggal Ika adalah...',
                'options' => [
                    ['text' => 'Memahami konteks lokal dan membiarkan imbauan berjalan selama tidak menimbulkan konflik terbuka.', 'is_correct' => false],
                    ['text' => 'Mendorong pelaku usaha mengikuti imbauan sementara agar stabilitas sosial dan citra wisata tetap terjaga.', 'is_correct' => false],
                    ['text' => 'Menyusun teguran pembinaan kepada perangkat daerah agar menghentikan praktik diskriminatif, menguatkan kebijakan layanan publik yang inklusif, serta memastikan rekrutmen kerja menghormati kesetaraan warga.', 'is_correct' => true],
                    ['text' => 'Mengarahkan agar imbauan diubah menjadi peraturan tertulis supaya lebih jelas dan bisa dikontrol.', 'is_correct' => false],
                    ['text' => 'Menyarankan sistem kuota: mayoritas tetap dominan, minoritas boleh masuk terbatas agar ada keseimbangan.', 'is_correct' => false],
                ],
                'explanation' => 'Bhinneka Tunggal Ika menegaskan bahwa keberagaman adalah realitas bangsa yang harus dirawat dalam persatuan, bukan dijadikan alasan mengecualikan kelompok tertentu.<br><br>Imbauan yang mendorong perekrutan berbasis agama—meskipun tidak tertulis—berpotensi:<br><li>Melahirkan diskriminasi sistemik</li><li>Merusak prinsip kesetaraan warga negara dalam ruang kerja dan pelayanan publik</li>Opsi C paling selaras karena:<br><li>Melakukan pembinaan dan koreksi kebijakan</li><li>Memastikan pemerintah daerah tidak memfasilitasi diskriminasi</li><li>Mendorong praktik pemerintahan yang adil, inklusif</li><li>Menjaga harmoni sosial melalui penghormatan atas keberagaman</li>',
            ],
            // Soal 23
            [
                'question_text' => 'Dalam rangka penguatan karakter kebangsaan, sebuah sekolah negeri menyusun modul "Empat Pilar" untuk siswa. Draft awal modul tersebut membahas:<br>• Pancasila: hanya sebagai kumpulan sila yang dihafal.<br>• UUD 1945: fokus pada pasal-pasal yang mengatur hak warga, tanpa menyentuh kewajiban.<br>• NKRI: digambarkan terutama sebagai simbol batas wilayah.<br>• Bhinneka Tunggal Ika: hanya ditekankan pada aspek budaya (tarian, pakaian adat).<br><br>Sebagai guru PPKn CPNS, usulan perbaikan yang PALING menggambarkan pemahaman utuh terhadap empat pilar adalah...',
                'options' => [
                    ['text' => 'Menambahkan lebih banyak latihan hafalan sila dan pasal agar siswa kuat mengingat dasar negara.', 'is_correct' => false],
                    ['text' => 'Mengubah modul menjadi diskusi sejarah pembentukan negara agar siswa memahami asal-usul pilar.', 'is_correct' => false],
                    ['text' => 'Menekankan Bhinneka Tunggal Ika melalui festival budaya rutin agar toleransi tumbuh secara alami.', 'is_correct' => false],
                    ['text' => 'Mendesain modul berbasis kasus sebagai praktik menghormati perbedaan dalam kehidupan sekolah dan warga negara.', 'is_correct' => true],
                    ['text' => 'Memfokuskan materi pada NKRI dan keamanan wilayah karena itu inti pilar kebangsaan.', 'is_correct' => false],
                ],
                'explanation' => 'Pemahaman utuh empat pilar menuntut pengajaran yang tidak berhenti pada simbol dan hafalan, tetapi menghubungkan pilar dengan praktik kewarganegaraan sehari-hari.<br><br>Empat pilar harus dipahami secara komprehensif:<br><li>Pancasila: harus hadir sebagai kerangka nilai dan etika publik</li><li>UUD 1945: harus dipahami sebagai dasar negara hukum yang mengatur hak dan kewajiban sekaligus membatasi kekuasaan</li><li>NKRI: bukan sekadar garis batas, melainkan komitmen persatuan serta solidaritas nasional</li><li>Bhinneka Tunggal Ika: harus dipraktikkan dalam sikap inklusif dan anti-diskriminasi di sekolah</li>Opsi D paling tepat karena modul berbasis kasus membuat siswa mampu:<br><li>Menenalar</li><li>Mengambil sikap</li><li>Menerapkan pilar dalam situasi nyata</li>Ini yang paling sesuai dengan tujuan pendidikan karakter kebangsaan.',
            ],
            // Soal 24
            [
                'question_text' => 'Ada usulan revisi undang-undang yang memperberat sanksi bagi perusakan bendera dan lambang negara. Sebagian kelompok khawatir langkah ini akan mengurangi kebebasan berekspresi, sementara pemerintah berargumen bahwa hal ini penting untuk menjaga wibawa negara dan persatuan. Sebagai staf ahli DPR, kajian yang PALING mencerminkan penggunaan empat pilar sebagai landasan menilai kebijakan adalah...',
                'options' => [
                    ['text' => 'Mendukung penuh pemberatan sanksi karena simbol negara harus dilindungi tanpa pengecualian.', 'is_correct' => false],
                    ['text' => 'Menolak revisi karena kebebasan berekspresi harus selalu diutamakan.', 'is_correct' => false],
                    ['text' => 'Menganalisis keseimbangan pilar negara, lalu merekomendasikan rumusan pasal yang tegas namun tidak overkriminalisasi.', 'is_correct' => true],
                    ['text' => 'Menyarankan pendekatan non-hukum seperti kampanye nasional agar tidak menimbulkan polemik.', 'is_correct' => false],
                    ['text' => 'Mengusulkan agar sanksi diperberat hanya di wilayah tertentu yang rawan konflik.', 'is_correct' => false],
                ],
                'explanation' => 'Empat pilar kebangsaan berfungsi sebagai kerangka analisis komprehensif dalam menyusun dan menilai kebijakan publik:<br><br>Masing-masing pilar memberikan perspektif berbeda:<br><li>Pancasila: memberikan nilai (penghormatan martabat bangsa, keadilan, persatuan)</li><li>UUD 1945: memberikan batasan konstitusional terkait hak dasar (kebebasan berekspresi) dan ruang pembatasannya yang sah dan proporsional</li><li>NKRI: mengingatkan pentingnya simbol negara sebagai perekat persatuan</li><li>Bhinneka Tunggal Ika: mendorong pendekatan dialog dan edukasi dalam mengelola perbedaan, bukan semata hukuman</li>Opsi C paling tepat karena memanfaatkan keempat pilar secara seimbang, sehingga rancangan kebijakan:<br><li>tetap menjaga wibawa simbol negara dan persatuan (Pancasila, NKRI)</li><li>tidak mengabaikan hak konstitusional warga (UUD 1945)</li><li>mendorong pendekatan edukatif bagi masyarakat yang majemuk (Bhinneka Tunggal Ika)</li>',
            ],
            // Soal 25
            [
                'question_text' => 'Perhatikan kalimat berikut: "Karena belum disosialisasikan dengan baik, banyak pegawai yang salah memahami aturan baru tersebut."<br><br>Kalimat di atas termasuk kalimat efektif. Manakah perubahan kalimat berikut yang masih tetap efektif dan tidak mengubah makna?',
                'options' => [
                    ['text' => 'Banyak pegawai salah memahami aturan baru tersebut karena belum disosialisasikan dengan baik.', 'is_correct' => false],
                    ['text' => 'Aturan baru tersebut belum disosialisasikan dengan baik sehingga salah memahami banyak pegawai.', 'is_correct' => false],
                    ['text' => 'Karena belum disosialisasikan dengan baik aturan baru tersebut, banyak pegawai salah memahami.', 'is_correct' => false],
                    ['text' => 'Banyak pegawai yang salah memahami karena aturan baru tersebut belum disosialisasikan dengan baik.', 'is_correct' => false],
                    ['text' => 'Aturan baru tersebut salah dipahami banyak pegawai karena belum disosialisasikan dengan baik.', 'is_correct' => true],
                ],
                'explanation' => 'Kalimat efektif menekankan ketepatan struktur (S-P-O-K), kejelasan makna, dan kehematan.<br><br>Pada opsi E, strukturnya jelas dan runtut:<br><li>Subjek (S): aturan baru tersebut</li><li>Predikat (P): salah dipahami</li><li>Objek/Pelengkap (O/Pel.): banyak pegawai</li><li>Keterangan (K): karena belum disosialisasikan dengan baik</li>Makna tidak berubah dari kalimat asal: penyebab utama kesalahpahaman adalah kurangnya sosialisasi.<br><br>Secara kaidah, kalimat pasif seperti ini tetap efektif sepanjang susunannya jelas dan logis.',
            ],
            // Soal 26
            [
                'question_text' => 'Manakah kalimat berikut yang seluruh penulisan kata depan dan imbuhannya sudah sesuai PUEBI?',
                'options' => [
                    ['text' => 'Surat tersebut sudah dikirim di kantor pusat dan akan di bagikan di masing-masing unit.', 'is_correct' => false],
                    ['text' => 'Pegawai diminta di ruang rapat untuk di berikan pengarahan oleh pimpinan.', 'is_correct' => false],
                    ['text' => 'Semua data diinput di sistem sebelum di proses oleh operator.', 'is_correct' => false],
                    ['text' => 'Laporan itu telah dikumpulkan di bagian keuangan untuk diproses lebih lanjut.', 'is_correct' => true],
                    ['text' => 'Barang-barang akan di simpan di gudang sebelum di distribusikan ke cabang.', 'is_correct' => false],
                ],
                'explanation' => 'Dalam PUEBI:<br><li>Kata depan <strong>di</strong> ditulis terpisah jika diikuti kata yang menunjukkan tempat (misalnya: di rumah, di sekolah, di kantor)</li><li>Imbuhan <strong>di-</strong> sebagai awalan kata kerja pasif ditulis serangkai dengan kata yang mengikutinya (misalnya: dikumpulkan, diproses, dikirimkan)</li>Pada opsi D:<br><li><strong>dikumpulkan</strong> → awalan di- + kata kerja → serangkai ✓</li><li><strong>di bagian keuangan</strong> → di sebagai kata depan tempat → dipisah ✓</li><li><strong>diproses</strong> → awalan di- + kata kerja → serangkai ✓</li>Semua penulisan di- sudah sesuai kaidah ejaan yang berlaku.',
            ],
            // Soal 27
            [
                'question_text' => 'Manakah kalimat berikut yang menggunakan seluruh kata baku dengan tepat?',
                'options' => [
                    ['text' => 'Untuk mensosialisasikan program tersebut, perlu dibuat brosur dan spanduk-spanduk di berbagai titik.', 'is_correct' => false],
                    ['text' => 'Hasil rapat koordinir itu akan menjadi acuan standart pelayanan instansi.', 'is_correct' => false],
                    ['text' => 'Pimpinan meminta masukan dari seluruh pegawai sebelum menetapkan kebijakan baru.', 'is_correct' => true],
                    ['text' => 'Kami akan mengirimkan undangan resmi melalui e-mail kepada seluruh nasabah kantor cabang.', 'is_correct' => false],
                    ['text' => 'Tim khusus dibentuk untuk melakukan pendataan ulang terhadap obyek pajak yang belum terdapat.', 'is_correct' => false],
                ],
                'explanation' => 'Dalam ragam baku Bahasa Indonesia:<br><li><strong>masukan</strong> (nomina) → bentuk baku untuk "saran/gagasan"</li><li><strong>kebijakan</strong> → bentuk baku dari "kebijaksanaan" dalam konteks keputusan formal</li>Pada kalimat C, seluruh diksi yang digunakan baku dan tepat makna:<br><li>Kalimatnya wajar untuk konteks administrasi dan birokrasi</li><li>Tidak memuat bentuk-bentuk tidak baku seperti standart, koordinir, mensosialisasikan (yang seharusnya: standar, koordinasi, menyosialisasikan)</li>Kalimat ini sudah sesuai prinsip penggunaan kata baku dalam dokumen resmi.',
            ],
            // Soal 28
            [
                'question_text' => 'Perhatikan kalimat berikut: "Kepala bagian meminta staf keuangan yang teliti membuat laporan anggaran."<br><br>Kalimat tersebut berpotensi menimbulkan makna ganda. Perubahan kalimat berikut yang paling tepat untuk menghilangkan ambiguitas adalah...',
                'options' => [
                    ['text' => 'Kepala bagian meminta staf keuangan membuat laporan anggaran yang teliti.', 'is_correct' => false],
                    ['text' => 'Kepala bagian meminta staf keuangan yang teliti untuk membuat laporan anggaran.', 'is_correct' => false],
                    ['text' => 'Kepala bagian meminta staf yang teliti pada bagian keuangan membuat laporan anggaran.', 'is_correct' => false],
                    ['text' => 'Kepala bagian meminta laporan anggaran dibuat oleh staf keuangan yang teliti.', 'is_correct' => false],
                    ['text' => 'Kepala bagian meminta agar laporan anggaran dibuat dengan teliti oleh staf keuangan.', 'is_correct' => true],
                ],
                'explanation' => 'Kalimat awal ambigu:<br><li>Apakah "staf keuangan yang teliti" → hanya staf tertentu yang teliti,</li><li>Atau yang dituntut teliti adalah cara membuat laporannya.</li>Opsi E menegaskan bahwa:<br><li>"dengan teliti" → keterangan cara pembuatan laporan</li><li>"oleh staf keuangan" → jelas pelakunya</li>Susunan ini menjadikan kalimat efektif, jelas, dan tidak ambigu sesuai prinsip kalimat efektif:<br><li>Struktur jelas</li><li>Makna tunggal</li><li>Hubungan pelaku–tindakan–cara tersusun logis</li>',
            ],
            // Soal 29
            [
                'question_text' => 'Perhatikan paragraf berikut:<br>(1) Dalam era digital, pegawai dituntut mampu beradaptasi dengan berbagai aplikasi dan sistem daring. (2) Banyak tugas administrasi kini dilakukan secara elektronik, mulai dari persuratan hingga pengelolaan arsip. (3) Namun, sebagian pegawai masih enggan belajar karena merasa sudah terlalu lama bekerja. (4) Agar pelayanan tetap prima, organisasi perlu memberikan pelatihan berkelanjutan bagi pegawai. (5) Oleh karena itu, kemampuan literasi digital menjadi salah satu kompetensi dasar yang harus dimiliki ASN masa kini.<br><br>Kalimat yang paling tepat dianggap sebagai kalimat utama paragraf tersebut adalah...',
                'options' => [
                    ['text' => '(1)', 'is_correct' => true],
                    ['text' => '(2)', 'is_correct' => false],
                    ['text' => '(3)', 'is_correct' => false],
                    ['text' => '(4)', 'is_correct' => false],
                    ['text' => '(5)', 'is_correct' => false],
                ],
                'explanation' => 'Kalimat utama biasanya mengandung gagasan pokok dan kalimat lain menjadi kalimat penjelas yang mengembangkan ide tersebut.<br><br>Pada paragraf di atas:<br><li>Kalimat (1) menyatakan gagasan umum: Pegawai dituntut mampu beradaptasi dengan berbagai aplikasi dan sistem daring dalam era digital.</li><li>Kalimat (2), (3), (4), dan (5) memberikan rincian dan akibat dari tuntutan tersebut:<br>  - contoh bentuk tugas (2)<br>  - hambatan (3)<br>  - solusi organisasi (4)<br>  - penegasan literasi digital sebagai kompetensi dasar (5)</li>Struktur seperti ini menunjukkan kalimat (1) berperan sebagai kalimat utama di awal (paragraf deduktif), sedangkan yang lain menjadi penjelasnya.',
            ],
            // Soal 30
            [
                'question_text' => 'Manakah kalimat berikut yang paling tepat penggunaan imbuhan me- dan pe--nya menurut kaidah pembentukan kata Bahasa Indonesia?',
                'options' => [
                    ['text' => 'Pemerintah akan mensukseskan program tersebut dengan melibatkan para partisipan dan penggiat sosial di berbagai daerah.', 'is_correct' => false],
                    ['text' => 'Kami berharap masyarakat dapat memfasilitasi kegiatan dan menjadi penggerak utama perubahan perilaku.', 'is_correct' => true],
                    ['text' => 'Instansi itu berupaya mensinergikan seluruh unit agar menjadi pemimpin-pemimpin yang berkualitas.', 'is_correct' => false],
                    ['text' => 'Panitia akan mengkoordinir peserta dan menunjuk beberapa pengkoordinir di setiap wilayah.', 'is_correct' => false],
                    ['text' => 'Mereka diminta untuk mensosialisasikan aturan kepada pengsosialisasi di lapangan.', 'is_correct' => false],
                ],
                'explanation' => 'Dalam kaidah pembentukan kata Bahasa Indonesia:<br><li>Awalan <strong>me-</strong> berfungsi membentuk kata kerja aktif (misal: memfasilitasi, mengolah, mengawasi)</li><li>Awalan <strong>pe-</strong> membentuk kata benda pelaku dari verba berawalan me- (misal: menggerakkan → penggerak)</li><li>Bentuk serapan asing yang mengandung huruf awal <strong>f</strong> lazim diterima apa adanya (misal: fasilitasi → memfasilitasi)</li>Pada opsi B:<br><li><strong>memfasilitasi</strong> → bentuk kata kerja aktif yang benar</li><li><strong>penggerak</strong> → bentuk nomina pelaku yang benar dari verba menggerakkan</li>Kalimat tersebut memenuhi kaidah imbuhan me-/pe- yang baku dan wajar digunakan dalam konteks resmi.',
            ],
        ];

        // Insert semua soal
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
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TWK dari PDF berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
