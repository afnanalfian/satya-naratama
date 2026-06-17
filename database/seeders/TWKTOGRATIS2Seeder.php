<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TWKTOGRATIS2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 48
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 48]
        );

        $questions = [
            // Soal 1
            [
                'question_text' => 'Setiap pegawai harus membuka diri terhadap hak masyarakat untuk memberikan informasi secara jujur, benar, dan tidak diskriminatif terhadap masyarakat karena menganut asas..',
                'explanation' => '<p><strong>Pembahasan:</strong> Asas keterbukaan mengharuskan setiap pegawai membuka diri terhadap hak masyarakat untuk mendapatkan informasi secara jujur, benar, dan tidak diskriminatif.</p><p><strong>Kunci Jawaban: D. Keterbukaan</strong></p>',
                'options' => [
                    ['text' => 'Proposionalitas', 'correct' => false],
                    ['text' => 'Efektifitas', 'correct' => false],
                    ['text' => 'Kepentingan Umum', 'correct' => false],
                    ['text' => 'Keterbukaan', 'correct' => true],
                    ['text' => 'Tertib penyelenggara negara', 'correct' => false],
                ]
            ],
            // Soal 2
            [
                'question_text' => 'Nilai-nilai berikut yang termasuk dalam nilai antikorupsi pada aspek etos kerja adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Nilai antikorupsi pada aspek etos kerja meliputi kerja keras, mandiri, dan sederhana.</p><p><strong>Kunci Jawaban: C. Kerja keras, mandiri dan sederhana</strong></p>',
                'options' => [
                    ['text' => 'Jujur, tanggung jawab, dan adil', 'correct' => false],
                    ['text' => 'Tanggung jawab, peduli, dan mandiri', 'correct' => false],
                    ['text' => 'Kerja keras, mandiri dan sederhana', 'correct' => true],
                    ['text' => 'Berani dan peduli', 'correct' => false],
                    ['text' => 'Jujur, disiplin, dan tanggung jawab', 'correct' => false],
                ]
            ],
            // Soal 3
            [
                'question_text' => 'Ada sembilan nilai integritas dalam antikorupsi yang terbagi dalam 3 aspek, yaitu........',
                'explanation' => '<p><strong>Pembahasan:</strong> Sembilan nilai integritas dalam antikorupsi terbagi dalam 3 aspek: aspek inti, aspek sikap, dan aspek etos kerja.</p><p><strong>Kunci Jawaban: A. Inti, sikap, dan etos kerja</strong></p>',
                'options' => [
                    ['text' => 'Inti, sikap, dan etos kerja', 'correct' => true],
                    ['text' => 'Personal, perilaku, dan norma', 'correct' => false],
                    ['text' => 'Kepribadian, agama, dan etos kerja', 'correct' => false],
                    ['text' => 'Nilai, norma, dan kepribadian', 'correct' => false],
                    ['text' => 'Inti, personal, dan sikap', 'correct' => false],
                ]
            ],
            // Soal 4
            [
                'question_text' => 'Eko berhasil menyelesaikan studi S2 di Australia. Eko kemudian mendapat tawaran bekerja di perusahaan asing dengan gaji tinggi. Akan tetapi, Eko menolak dan lebih mengembangkan desa kelahiran. Eko bekerja sama dengan teman-teman mengembangkan daerah tempat tinggalnya. Pada penjelasan tersebut, kerjasama sesuai dengan salah satu dari 5 dasar bela negara, yaitu...',
                'explanation' => '<p><strong>Pembahasan:</strong> Sikap Eko yang memilih mengembangkan desa kelahirannya daripada bekerja di perusahaan asing dengan gaji tinggi menunjukkan sikap cinta tanah air.</p><p><strong>Kunci Jawaban: D. Memegang teguh sikap cinta tanah air</strong></p>',
                'options' => [
                    ['text' => 'Meyakini Pancasila sebagai ideologi negara', 'correct' => false],
                    ['text' => 'Menjunjung tinggi sikap bela negara', 'correct' => false],
                    ['text' => 'Rela berkorban untuk bangsa dan negara', 'correct' => false],
                    ['text' => 'Memegang teguh sikap cinta tanah air', 'correct' => true],
                    ['text' => 'Menjunjung tinggi rasa kedaerahan', 'correct' => false],
                ]
            ],
            // Soal 5
            [
                'question_text' => 'Implementasi dalam kehidupan nyata penerapan pancasila sebagai dasar negara tercermin kegiatan sebagai berikut...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memasang sabuk pengaman saat mengendarai mobil sesuai dengan tata tertib lalu lintas adalah bentuk implementasi nilai disiplin dan kepatuhan terhadap aturan yang merupakan cerminan pengamalan Pancasila.</p><p><strong>Kunci Jawaban: E. Memasang sabuk pengaman saat mengendarai mobil sesuai dengan tata tertib lalu lintas</strong></p>',
                'options' => [
                    ['text' => 'Mengikuti upacara kebangkitan Pancasila dengan khidmat berlandaskan jiwa nasionalisme', 'correct' => false],
                    ['text' => 'Mengerjakan tugas kantor sesuai dengan arahan', 'correct' => false],
                    ['text' => 'Memberikan bantuan sosial kepada kaum duafa', 'correct' => false],
                    ['text' => 'Pulang setelah jam kantor selesai dan memberi salam kepada atasan dan rekan kerja', 'correct' => false],
                    ['text' => 'Memasang sabuk pengaman saat mengendarai mobil sesuai dengan tata tertib lalu lintas', 'correct' => true],
                ]
            ],
            // Soal 6
            [
                'question_text' => 'Oleh PPKI, bahwa nilai-nilai Pancasila sebagai dasar negara Republik Indonesia telah ada pada bangsa Indonesia sejak zaman dahulu kala. Nilai-nilai tersebut kemudian digali oleh para pendiri negara dan dijadikan sebagai falsafah hidup bangsa Indonesia. Menurut penggagas awal (Ir. Soekarno) bahwa Pancasila digali dari bumi Indonesia sendiri dan dikristalisasi dari nilai-nilai yang berkembang dalam kehidupan rakyat Indonesia yang beraneka ragam. Berikut merupakan Pancasila yang kita gali dari bangsa sendiri, kecuali…',
                'explanation' => '<p><strong>Pembahasan:</strong> Pancasila digali dari jiwa dan kepribadian bangsa Indonesia, tujuan yang akan dicapai, pandangan hidup bangsa, serta memberikan corak yang khas bagi bangsa Indonesia. Sumber pengetahuan manusia bukan merupakan sumber penggalian Pancasila.</p><p><strong>Kunci Jawaban: B. Sumber pengetahuan manusia</strong></p>',
                'options' => [
                    ['text' => 'Jiwa dan kepribadian bangsa Indonesia', 'correct' => false],
                    ['text' => 'Sumber pengetahuan manusia', 'correct' => true],
                    ['text' => 'Tujuan yang akan dicapai bangsa Indonesia', 'correct' => false],
                    ['text' => 'Pandangan hidup bangsa Indonesia yang dapat mempersatukan serta memberikan petunjuk dalam masyarakat kita yang beraneka ragam sifatnya', 'correct' => false],
                    ['text' => 'Pancasila memberikan corak yang khas dan tak dapat dipisahkan dari bangsa Indonesia', 'correct' => false],
                ]
            ],
            // Soal 7
            [
                'question_text' => 'A. Maramis menyampaikan bahwa wakil-wakil umat Protestan dan Katolik yang berada dalam wilayah kekuasaan Angkatan Laut Jepang sangat keberatan dengan bagian kalimat dalam Pembukaan Undang-Undang Dasar, yang berbunyi, "Ketuhanan dengan kewajiban menjalankan syariat Islam bagi pemeluk-pemeluknya". Mereka sadar bahwa bagian kalimat itu tidak mengikat mereka, namun dengan mencantumkan ketetapan seperti itu dalam pembukaan dan dasar berdirinya suatu negara merupakan "diskriminasi" terhadap mereka golongan minoritas. Dalam buku autobiografi Bung Hatta disebutkan bahwa jika "diskriminasi" itu ditetapkan juga, mereka lebih suka berdiri di luar Republik Indonesia. Bangsa Indonesia menyadari prihal kemajemukan rakyatnya. Akibat apa yang mungkin terjadi jika seseorang memaksakan agamanya kepada orang lain yang telah beragama adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memaksakan agama kepada orang lain dapat menimbulkan perselisihan antar umat beragama karena melanggar prinsip toleransi dan kebebasan beragama.</p><p><strong>Kunci Jawaban: B. Perselisihan antar umat beragama</strong></p>',
                'options' => [
                    ['text' => 'Rusaknya kemajemukan', 'correct' => false],
                    ['text' => 'Perselisihan antar umat beragama', 'correct' => true],
                    ['text' => 'Hilangnya kewibawaan agama', 'correct' => false],
                    ['text' => 'Putusnya tali persaudaraan', 'correct' => false],
                    ['text' => 'Kekacauan dalam hal beragama', 'correct' => false],
                ]
            ],
            // Soal 8
            [
                'question_text' => 'Awal perumusan Pancasila dimulai dari sidang pertama BPUPKI. Proses perumusan pancasila sebagai dasar negara melalui proses yang tidak singkat. Terdapat beberapa golongan yang merumuskan ada golongan nasionalis dan agamis. Ada beberapa pendapat yang mengemukakan sila dalam pancasila dan akhirnya lahirlah pancasila. Salah satu aplikasi/penerapan dari sila ke-4 yang dapat digali dari penggalan kalimat tersebut adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Sila ke-4 Pancasila (Kerakyatan yang dipimpin oleh hikmat kebijaksanaan dalam permusyawaratan/perwakilan) mengajarkan untuk tidak memaksakan kehendak dan pendapat kepada orang lain.</p><p><strong>Kunci Jawaban: D. Tidak memaksakan kehendak dan pendapat orang lain</strong></p>',
                'options' => [
                    ['text' => 'Mengalah dan tidak menonjolkan golongan', 'correct' => false],
                    ['text' => 'Mematuhi peraturan yang ada', 'correct' => false],
                    ['text' => 'Mengikuti suara terbanyak', 'correct' => false],
                    ['text' => 'Tidak memaksakan kehendak dan pendapat orang lain', 'correct' => true],
                    ['text' => 'Menonjolkan ras', 'correct' => false],
                ]
            ],
            // Soal 9
            [
                'question_text' => 'Derasnya arus globalisasi, modernisasi dan ketatnya persaingan dikhawatirkan dapat mengakibatkan terkikisnya rasa kecintaan terhadap kebudayaan lokal. Sehingga kebudayaan lokal yang merupakan warisan leluhur terinjak-injak oleh budaya asing, terlupakan oleh para pewarisnya, bahkan banyak pemuda yang tak mengenali budaya daerahnya sendiri. Mereka cenderung lebih bangga dengan karya-karya asing, dan gaya hidup yang kebarat-baratan dibandingkan dengan kebudayaan lokal di daerah mereka sendiri. Modernisasi mengikis...',
                'explanation' => '<p><strong>Pembahasan:</strong> Modernisasi yang tidak terkendali dapat mengikis nilai-nilai kebudayaan lokal dan membuat generasi muda lebih bangga dengan budaya asing.</p><p><strong>Kunci Jawaban: C. 3</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => true],
                    ['text' => '4', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                ]
            ],
            // Soal 10
            [
                'question_text' => 'Batik merupakan salah satu simbol karakteristik dari Indonesia. Maka, memakai busana batik adalah kebanggaan sendiri bagi masyarakatnya. Hal ini selaras dengan pengamalan pancasila sila ke...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memakai batik sebagai bentuk kebanggaan terhadap budaya Indonesia mencerminkan pengamalan sila ke-3 Pancasila (Persatuan Indonesia) yang menjunjung tinggi rasa cinta tanah air dan kebanggaan sebagai bangsa Indonesia.</p><p><strong>Kunci Jawaban: C. 3</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => true],
                    ['text' => '4', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                ]
            ],
            // Soal 11
            [
                'question_text' => 'Pemda Karawang menghentikan aktivitas produksi anak perusahaan PT Sinar Mas, PT Pindo Deli Pulp & Paper mills 3 di Desa Tamanmekar, Kecamatan Pangkalan. Penghentian ini dilakukan setelah banyak keluhan dari warga sekitar dan juga pemerhati lingkungan karena Pindo Deli 3 membuang limbah cair secara langsung ke Sungai Cibeet. Tindakan tegas kami lakukan dengan menghentikan seluruh aktivitas produksi Pindo Deli 3 karena mereka memang belum memiliki izin lingkungan dan surat keputusan kelayakan lingkungan hidup (SKKLH), namun masih tetap operasional. Langkah antisipatif yang dilakukan oleh Pemda Karawang sejalan dengan realitas pencerminan pancasila sila ke...',
                'explanation' => '<p><strong>Pembahasan:</strong> Tindakan menghentikan aktivitas produksi yang mencemari lingkungan mencerminkan pengamalan sila ke-5 (Keadilan sosial bagi seluruh rakyat Indonesia) karena memperjuangkan hak masyarakat atas lingkungan yang sehat dan berkelanjutan.</p><p><strong>Kunci Jawaban: E. 5</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => false],
                    ['text' => '4', 'correct' => false],
                    ['text' => '5', 'correct' => true],
                ]
            ],
            // Soal 12
            [
                'question_text' => 'KPK menyebutkan uang yang disita dari Gubernur Kepulauan Riau nonaktif Nurdin Basirun berjumlah hingga Rp6,1 miliar. Nurdin terjerat kasus suap izin reklamasi di Kepulauan Riau dan gratifikasi terkait jabatannya. KPK menduga gratifikasi itu berasal dari sejumlah pihak yang memiliki hubungan jabatan dan kewenangan terkait posisi Nurdin sebagai Gubernur Kepri. Kasus diatas bertentangan dengan pengamalan pancasila ke...',
                'explanation' => '<p><strong>Pembahasan:</strong> Kasus korupsi dan gratifikasi bertentangan dengan sila ke-4 (Kerakyatan yang dipimpin oleh hikmat kebijaksanaan dalam permusyawaratan/perwakilan) karena penyalahgunaan wewenang dan jabatan untuk kepentingan pribadi.</p><p><strong>Kunci Jawaban: B. 4</strong></p>',
                'options' => [
                    ['text' => '5', 'correct' => false],
                    ['text' => '4', 'correct' => true],
                    ['text' => '3', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                ]
            ],
            // Soal 13
            [
                'question_text' => 'Kasih sayang dan perhatian tidak hanya dibutuhkan untuk anak kecil, orang tua yang sudah lansia juga membutuhkannya. Tindakan yang ditunjukkan oleh Irwan Hidayat (Direktur PT Sido Muncul) memberikan perhatian bagi lansia-lansia melalui bantuan tunai merupakan pencerminan pancasila sila ke...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memberikan perhatian dan bantuan kepada lansia mencerminkan pengamalan sila ke-2 (Kemanusiaan yang adil dan beradab) karena mewujudkan rasa kemanusiaan dan kepedulian terhadap sesama.</p><p><strong>Kunci Jawaban: D. 2</strong></p>',
                'options' => [
                    ['text' => '5', 'correct' => false],
                    ['text' => '4', 'correct' => false],
                    ['text' => '3', 'correct' => false],
                    ['text' => '2', 'correct' => true],
                    ['text' => '1', 'correct' => false],
                ]
            ],
            // Soal 14
            [
                'question_text' => 'Upaya yang dilakukan oleh Kepala Bidang Perizinan dan Informasi Keimigrasian Kanwil Kemenkumham Jatim Taty Sufiani dalam menanggulangi pemalsuan dokumen sebagai upaya pencegahan human trafficking merupakan pencerminan dari sila Pancasila ke...',
                'explanation' => '<p><strong>Pembahasan:</strong> Upaya penegakan hukum dan pencegahan kejahatan mencerminkan pengamalan sila ke-2 (Kemanusiaan yang adil dan beradab) karena melindungi hak asasi manusia dari tindak perdagangan manusia.</p><p><strong>Kunci Jawaban: B. 2</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => true],
                    ['text' => '3', 'correct' => false],
                    ['text' => '4', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                ]
            ],
            // Soal 15
            [
                'question_text' => 'Repelita atau rencana pembangunan lima tahun adalah satuan perencanaan yang dibuat oleh pemerintah Orde Baru di Indonesia. Hasil dari Repelita 1 adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Repelita I (1969-1974) bertujuan memenuhi kebutuhan dasar dan infrastruktur dengan penekanan pada bidang pertanian.</p><p><strong>Kunci Jawaban: C. Memenuhi kebutuhan dasar dan infrastruktur dengan penekanan pada bidang pertanian</strong></p>',
                'options' => [
                    ['text' => 'Meningkatkan pembangunan di pulau-pulau selain Jawa, Bali, dan Madura diantaranya melalui transmigrasi', 'correct' => false],
                    ['text' => 'Menekankan bidang industri padat karya untuk meningkatkan ekspor', 'correct' => false],
                    ['text' => 'Memenuhi kebutuhan dasar dan infrastruktur dengan penekanan pada bidang pertanian', 'correct' => true],
                    ['text' => 'Menciptakan lapangan kerja baru dan industri', 'correct' => false],
                    ['text' => 'Menciptakan lapangan kerja baru dan industri bidang transportasi komunikasi dan pendidikan', 'correct' => false],
                ]
            ],
            // Soal 16
            [
                'question_text' => 'Spirit nasionalisme muda ditunjukkan dalam peristiwa Rengasdengklok. Berdasarkan dengan pemahaman wacana di atas, hal apa yang pemuda masa kini bisa dilakukan?',
                'explanation' => '<p><strong>Pembahasan:</strong> Spirit nasionalisme dapat menjadi kata sakti melawan radikalisme dan tindakan intoleran, sesuai dengan tantangan zaman yang dihadapi pemuda masa kini.</p><p><strong>Kunci Jawaban: A. Spirit nasionalisme bisa menjadi kata sakti melawan radikalisme dan tindakan intoleran</strong></p>',
                'options' => [
                    ['text' => 'Spirit nasionalisme bisa menjadi kata sakti melawan radikalisme dan tindakan intoleran', 'correct' => true],
                    ['text' => 'Mengisi kemerdekaan dengan memajukan ilmu pengetahuan dan teknologi', 'correct' => false],
                    ['text' => 'Membangun spirit eksklusif dalam beragama dan beryakinan demi terciptanya solidaritas umat agama tertentu', 'correct' => false],
                    ['text' => 'Memaksakan wakil rakyat untuk segera merevisi undang-undang yang dianggap tidak sesuai dengan kepentingan rakyat demo anarkis', 'correct' => false],
                    ['text' => 'Membangan usaha rintisan yang diinisiasi oleh para pemuda untuk menciptakan lapangan kerja sebanyak-banyaknya', 'correct' => false],
                ]
            ],
            // Soal 17
            [
                'question_text' => 'Ketetapan MPR nomor V/MPR/2000 merupakan salah satu nilai instrumental dalam menjalankan nilai-nilai yang terkandung dalam Pancasila terutama sila ke...',
                'explanation' => '<p><strong>Pembahasan:</strong> Ketetapan MPR Nomor V/MPR/2000 tentang pemantapan persatuan dan kesatuan nasional berkaitan dengan sila ke-3 Pancasila (Persatuan Indonesia).</p><p><strong>Kunci Jawaban: C. 3</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => true],
                    ['text' => '4', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                ]
            ],
            // Soal 18
            [
                'question_text' => 'Amandemen UUD 1945 terjadi sebanyak ... kali',
                'explanation' => '<p><strong>Pembahasan:</strong> Amandemen UUD 1945 dilakukan sebanyak 4 kali: Amandemen I (1999), Amandemen II (2000), Amandemen III (2001), dan Amandemen IV (2002).</p><p><strong>Kunci Jawaban: D. 4</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => false],
                    ['text' => '4', 'correct' => true],
                    ['text' => '5', 'correct' => false],
                ]
            ],
            // Soal 19
            [
                'question_text' => 'Arga meminta uang kepada orangtuanya untuk dibelikan sebuah motor, namun karena orangtuanya hanya bekerja serabutan tidak bisa menuruti keinginannya. Karena menerima penolakan akhirnya Arga pun kesal dan marah hingga bersama teman-temannya pergi ke orkes musik dan mabuk. Saat melewati desa tetangga, Arga melihat sebuah motor. Awalnya Arga tidak ingin mencuri, karena keinginan hatinya berubah dia ingin mencuri motor tersebut. Salah seorang warga melihat hal tersebut lalu meneriakinya maling dan melaporkan Arga ke pihak yang berwajib. Sikap warga menunjukkan...',
                'explanation' => '<p><strong>Pembahasan:</strong> Sikap warga yang melaporkan tindak kejahatan kepada pihak berwajib menunjukkan profesionalisme karena bertindak sesuai dengan aturan dan prosedur yang berlaku.</p><p><strong>Kunci Jawaban: B. Profesionalisme</strong></p>',
                'options' => [
                    ['text' => 'Integritas', 'correct' => false],
                    ['text' => 'Profesionalisme', 'correct' => true],
                    ['text' => 'Solidaritas', 'correct' => false],
                    ['text' => 'Tenggang rasa', 'correct' => false],
                    ['text' => 'Rela berkorban', 'correct' => false],
                ]
            ],
            // Soal 20
            [
                'question_text' => 'Keberagaman di Indonesia menjadikan negara ini menjadi penuh warna begitu pula cara untuk mengambil keputusan dalam sebuah rapat banyak cara yang digunakan. Cara yang cocok untuk bangsa Indonesia adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Musyawarah mufakat adalah cara yang paling cocok untuk bangsa Indonesia karena mencerminkan nilai-nilai demokrasi Pancasila dan kebersamaan dalam mengambil keputusan.</p><p><strong>Kunci Jawaban: E. Musyawarah mufakat</strong></p>',
                'options' => [
                    ['text' => 'Suara terbanyak', 'correct' => false],
                    ['text' => 'Tergantung pada pemimpin', 'correct' => false],
                    ['text' => 'Aklamasi', 'correct' => false],
                    ['text' => 'Perwakilan', 'correct' => false],
                    ['text' => 'Musyawarah mufakat', 'correct' => true],
                ]
            ],
            // Soal 21
            [
                'question_text' => 'Desa yang sejahtera lahir dan batin adalah masyarakat yang telah terpenuhi kebutuhan dasarnya yaitu...',
                'explanation' => '<p><strong>Pembahasan:</strong> Kebutuhan dasar manusia meliputi sandang (pakaian), papan (rumah tinggal), dan pangan (makanan).</p><p><strong>Kunci Jawaban: B. Pakaian, rumah tinggal, makanan</strong></p>',
                'options' => [
                    ['text' => 'Pakaian, kendaraan, dan rumah tinggal', 'correct' => false],
                    ['text' => 'Pakaian, rumah tinggal, makanan', 'correct' => true],
                    ['text' => 'Rumah tinggal, makan dan kendaraan, kebun, makan, kendaraan', 'correct' => false],
                    ['text' => 'Rumah tinggal, alat komunikasi, dan kebun', 'correct' => false],
                    ['text' => 'Kebun, makan, dan kendaraan', 'correct' => false],
                ]
            ],
            // Soal 22
            [
                'question_text' => 'Banyaknya suku dan budaya di Indonesia mengharuskan negara ini memiliki sistem stabilitas yang kuat. Unsur-unsur utama dari program stabilitas dan reformasi nasional yang mendesak dan perlu dilakukan oleh pemerintah yaitu...',
                'explanation' => '<p><strong>Pembahasan:</strong> Menyelesaikan efisiensi dunia usaha merupakan unsur utama dalam program stabilitas dan reformasi nasional yang mendesak dilakukan pemerintah.</p><p><strong>Kunci Jawaban: C. Menyelesaikan efisiensi dunia usaha</strong></p>',
                'options' => [
                    ['text' => 'Pembangunan lembaga keuangan', 'correct' => false],
                    ['text' => 'Penyelesaian hutang dunia usaha', 'correct' => false],
                    ['text' => 'Menyelesaikan efisiensi dunia usaha', 'correct' => true],
                    ['text' => 'Meningkatkan keterbukaan', 'correct' => false],
                    ['text' => 'Menegakan hukum yang adil', 'correct' => false],
                ]
            ],
            // Soal 23
            [
                'question_text' => 'Semua pilihan atau tindakan yang dilakukan oleh pemerintah dalam arti baik dan buruk dikenal dengan istilah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Kebijakan pemerintah adalah semua pilihan atau tindakan yang dilakukan oleh pemerintah, baik yang dinilai baik maupun buruk.</p><p><strong>Kunci Jawaban: E. Keputusan pemerintah</strong></p>',
                'options' => [
                    ['text' => 'Keadilan pemerintah', 'correct' => false],
                    ['text' => 'Kebijakan pemerintah', 'correct' => false],
                    ['text' => 'Peraturan pemerintah', 'correct' => false],
                    ['text' => 'Strategi pemerintah', 'correct' => false],
                    ['text' => 'Keputusan pemerintah', 'correct' => true],
                ]
            ],
            // Soal 24
            [
                'question_text' => 'Komisi DPR yang membidangi urusan kependudukan dan kesehatan adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Komisi IX DPR RI membidangi urusan kependudukan, kesehatan, tenaga kerja, dan transmigrasi.</p><p><strong>Kunci Jawaban: C. IX</strong></p>',
                'options' => [
                    ['text' => 'VII', 'correct' => false],
                    ['text' => 'VIII', 'correct' => false],
                    ['text' => 'IX', 'correct' => true],
                    ['text' => 'X', 'correct' => false],
                    ['text' => 'XI', 'correct' => false],
                ]
            ],
            // Soal 25
            [
                'question_text' => 'Alat perlengkapan negara menurut UUD 1945 yaitu...',
                'explanation' => '<p><strong>Pembahasan:</strong> Alat perlengkapan negara menurut UUD 1945 terdiri dari MPR, DPR, DPRD, MA, MK.</p><p><strong>Kunci Jawaban: A. MPR, DPR, DPRD, MA, MK</strong> (opsi dalam jawaban disesuaikan)</p>',
                'options' => [
                    ['text' => 'Menteri, senat, DPR, MA, DPK', 'correct' => false],
                    ['text' => 'Presiden, wakil presiden, menteri, DPR, MA, DPK', 'correct' => false],
                    ['text' => 'Perdana Menteri, senat, DPR, MA, DPK, DPD', 'correct' => false],
                    ['text' => 'Presiden, menteri, senat, DPR, MK, DPR, DPD', 'correct' => false],
                    ['text' => 'Presiden dan Wakil presiden', 'correct' => false],
                ]
            ],
            // Soal 26
            [
                'question_text' => 'Jika anggota DPR diduga melakukan perbuatan pidana maka pemanggilan permintaan keterangan dan penyidikan yang bersangkutan harus mendapat persetujuan tertulis dari...',
                'explanation' => '<p><strong>Pembahasan:</strong> Persetujuan tertulis untuk pemanggilan dan penyidikan anggota DPR harus mendapat persetujuan dari Presiden sesuai dengan ketentuan yang berlaku.</p><p><strong>Kunci Jawaban: D. Ketua DPR dengan pertimbangan presiden</strong></p>',
                'options' => [
                    ['text' => 'Ketua DPR', 'correct' => false],
                    ['text' => 'Ketua fraksi', 'correct' => false],
                    ['text' => 'Ketua DPR dengan pertimbangan ketua DPD', 'correct' => false],
                    ['text' => 'Ketua DPR dengan pertimbangan presiden', 'correct' => true],
                    ['text' => 'Presiden', 'correct' => false],
                ]
            ],
            // Soal 27
            [
                'question_text' => '(1) akan tetapi dia tidak patah semangat. (2) Dia terus menerus mengirimkan karya-karyanya dengan posisi tetap seperti itu. (3) Sayang keadaan tidak juga berubah. (4) Karya-karyanya yang selalu diakhiri dengan disertai perangko terus-terusan dikembalikan. (5) Kenyataan ini akhirnya sangat menyukainya. Kalimat yang menggunakan ragam bahasa tidak baku adalah kalimat nomor ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Kata "perangko" seharusnya "prangko" (tanpa huruf e). Kata "terus-terusan" biasa dipakai dalam bahasa Sunda, dalam bahasa Indonesia bentuk bakunya adalah "terus menerus".</p><p><strong>Kunci Jawaban: D. 4</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => false],
                    ['text' => '4', 'correct' => true],
                    ['text' => '5', 'correct' => false],
                ]
            ],
            // Soal 28
            [
                'question_text' => 'Kalimat yang didalamnya terdapat kata tidak baku adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Kata "praktek" bentuk bakunya adalah "praktik". Untuk mencari bentuk baku suatu kata dalam bahasa Indonesia, bisa dianalogikan dengan bentuk kata yang sederderan morfologis misalnya praktek-praktikan-praktikum.</p><p><strong>Kunci Jawaban: C. Seorang dokter selain bertugas di rumah sakit ia pun bisa mengadakan praktek di rumah</strong></p>',
                'options' => [
                    ['text' => 'Atlet-atlet Indonesia memenangkan berbagai pertandingan Indonesia internasional', 'correct' => false],
                    ['text' => 'Pagi itu bapak presiden meresmikan kilang minyak di lepas pantai', 'correct' => false],
                    ['text' => 'Seorang dokter selain bertugas di rumah sakit ia pun bisa mengadakan praktek di rumah', 'correct' => true],
                    ['text' => 'Dalam segi pengadaan dana sebenarnya TVRI mempunyai beberapa fasilitas yang menguntungkan', 'correct' => false],
                    ['text' => 'Peledakan jumlah penduduk di kota-kota besar pada umumnya disebabkan oleh urbanisasi', 'correct' => false],
                ]
            ],
            // Soal 29
            [
                'question_text' => 'Salah satu ciri khas bangsa Amerika adalah kesukaannya membuat peringkat. Apapun di peringkat. Tidak terkecuali dunia bisnis. Majalah terkenal seperti Fortune atau US News sering menampilkan peringkat perusahaan berdasarkan penjualan, besarnya aset yang dimiliki, atau berdasarkan besarnya tingkat keuntungan. Kedua, iklim kompetisi yang semakin ketat. Jelaslah bahwa membuat peringkat bagi masyarakat Amerika merupakan hal yang biasa. Titik pandang pemikiran yang dapat menjadi konsep dasar adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Titik pandang pemikiran yang menjadi konsep dasar terdapat pada kalimat simpulan, yaitu "Bangsa Amerika suka membuat peringkat".</p><p><strong>Kunci Jawaban: C. Bangsa Amerika suka membuat peringkat</strong></p>',
                'options' => [
                    ['text' => 'Apapun bisa di peringkat', 'correct' => false],
                    ['text' => 'Kebiasaan bisnis bangsa Amerika', 'correct' => false],
                    ['text' => 'Bangsa Amerika suka membuat peringkat', 'correct' => true],
                    ['text' => 'Kegiatan bisnis majalah Fortune dan US News', 'correct' => false],
                    ['text' => 'Pembuatan peringkat dipengaruhi oleh beberapa faktor', 'correct' => false],
                ]
            ],
            // Soal 30
            [
                'question_text' => 'Kalimat dibawah ini yang menggunakan kata berhiponim adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Hiponim adalah hubungan antara makna spesifik dan makna generik. Minyak tanah, bensin, solar adalah kata hiponim dari bahan bakar minyak.</p><p><strong>Kunci Jawaban: A. Pemerintah menaikkan bahan bakar minyak diantaranya bensin, minyak tanah, solar</strong></p>',
                'options' => [
                    ['text' => 'Pemerintah menaikkan bahan bakar minyak diantaranya bensin, minyak tanah, solar', 'correct' => true],
                    ['text' => 'Kita tahu bahwa tahu adalah makanan bergizi', 'correct' => false],
                    ['text' => 'Bisa ular bisa mematikan seseorang', 'correct' => false],
                    ['text' => 'Pukul berapa ia kena pukul', 'correct' => false],
                    ['text' => 'Syarat menjadi guru teladan harus sarat pengalaman', 'correct' => false],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => $material->id,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $order = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['correct'],
                    'order' => $order,
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order++;
            }
        }

        $this->command->info('Seeder TWK TO SKD Gratis 2 berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questions));
    }
}
