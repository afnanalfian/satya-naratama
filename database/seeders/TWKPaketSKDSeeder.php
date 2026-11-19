<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TWKPaketSKDSeeder extends Seeder
{
    /**
     * Seeder TWK Paket SKD - soal nomor 1-30
     *
     * - material_id : 12
     * - type        : mcq (pilihan ganda, satu jawaban benar)
     * - test_type   : twk
     *
     * Ekspresi matematika ditulis dalam LaTeX kompatibel MathQuill di dalam \( ... \).
     * Tanda < dan > di dalam math memakai \lt dan \gt agar aman untuk HTML.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $materialId = 12;

        $questions = [
            // Soal 1 | Kunci: B
            [
                'no' => 1,
                'question_text' => '<p>Sidang pertama Badan Penyelidik Usaha-usaha Persiapan Kemerdekaan Indonesia (BPUPKI) yang berlangsung pada 29 Mei sampai 1 Juni 1945 secara khusus membahas ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Rancangan Undang-Undang Dasar', 'image' => null, 'is_correct' => false],
                    ['text' => 'Dasar negara Indonesia merdeka', 'image' => null, 'is_correct' => true],
                    ['text' => 'Pembentukan Panitia Persiapan Kemerdekaan Indonesia', 'image' => null, 'is_correct' => false],
                    ['text' => 'Persiapan pembacaan teks proklamasi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Batas wilayah negara Indonesia', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>BPUPKI mengadakan dua kali sidang resmi:</p>
            <ul>
            <li><strong>Sidang I (29 Mei – 1 Juni 1945):</strong> membahas <strong>dasar negara</strong>. Pada sidang ini Muh. Yamin, Mr. Soepomo, dan Ir. Soekarno menyampaikan gagasan dasar negara. Pidato Soekarno pada 1 Juni 1945 kemudian diperingati sebagai Hari Lahir Pancasila.</li>
            <li><strong>Sidang II (10 – 17 Juli 1945):</strong> membahas rancangan Undang-Undang Dasar, bentuk negara, dan wilayah negara.</li>
            </ul>
            <p>Opsi A dan E adalah materi sidang kedua. PPKI dibentuk pada 7 Agustus 1945 setelah BPUPKI dibubarkan, sehingga bukan bahasan sidang BPUPKI.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 2 | Kunci: C
            [
                'no' => 2,
                'question_text' => '<p>Pada 18 Agustus 1945, rumusan sila pertama dalam Piagam Jakarta "Ketuhanan dengan kewajiban menjalankan syariat Islam bagi pemeluk-pemeluknya" diubah menjadi "Ketuhanan Yang Maha Esa". Alasan utama perubahan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Menyesuaikan dengan permintaan pemerintah pendudukan Jepang', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rumusan lama dianggap terlalu panjang untuk sebuah dasar negara', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menjaga persatuan dan kesatuan seluruh bangsa Indonesia yang majemuk', 'image' => null, 'is_correct' => true],
                    ['text' => 'Mengikuti rumusan dasar negara dari negara-negara sekutu', 'image' => null, 'is_correct' => false],
                    ['text' => 'Mayoritas anggota PPKI menolak keberadaan nilai agama dalam dasar negara', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Menjelang sidang PPKI 18 Agustus 1945, Mohammad Hatta menerima keberatan dari wakil-wakil Indonesia bagian timur atas rumusan "tujuh kata" pada sila pertama. Setelah berkonsultasi dengan tokoh-tokoh Islam seperti Ki Bagus Hadikusumo, K.H. Wahid Hasyim, Kasman Singodimedjo, dan Teuku Mohammad Hasan, disepakati perubahan menjadi "Ketuhanan Yang Maha Esa".</p>
            <p>Perubahan ini merupakan bentuk <strong>pengorbanan dan kebesaran jiwa</strong> para tokoh bangsa demi <strong>menjaga persatuan</strong> Indonesia yang majemuk.</p>
            <p>Opsi E keliru karena nilai ketuhanan tetap menjadi sila pertama; yang diubah hanya rumusannya agar dapat diterima semua golongan.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 3 | Kunci: B
            [
                'no' => 3,
                'question_text' => '<p>Ketika terjadi banjir bandang di sebuah kabupaten, Rahmat menjadi relawan dan membagikan bantuan kepada seluruh korban tanpa membeda-bedakan suku, agama, maupun status sosial mereka. Sikap Rahmat paling mencerminkan pengamalan Pancasila sila ke- ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pertama', 'image' => null, 'is_correct' => false],
                    ['text' => 'Kedua', 'image' => null, 'is_correct' => true],
                    ['text' => 'Ketiga', 'image' => null, 'is_correct' => false],
                    ['text' => 'Keempat', 'image' => null, 'is_correct' => false],
                    ['text' => 'Kelima', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Sila kedua, <strong>"Kemanusiaan yang adil dan beradab"</strong>, mengandung nilai:</p>
            <ul>
            <li>mengakui persamaan derajat dan martabat setiap manusia tanpa membedakan suku, agama, ras, maupun status sosial;</li>
            <li>mengembangkan sikap tenggang rasa dan gemar melakukan kegiatan kemanusiaan;</li>
            <li>berani membela kebenaran dan keadilan.</li>
            </ul>
            <p>Menjadi relawan bencana dan menolong semua korban secara setara adalah wujud langsung <strong>kegiatan kemanusiaan</strong> dan <strong>persamaan derajat</strong>.</p>
            <p><strong>Jebakan:</strong> Kata "tanpa membedakan agama" bisa menggiring ke sila pertama, padahal inti tindakannya adalah kemanusiaan, bukan kehidupan beragama.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 4 | Kunci: D
            [
                'no' => 4,
                'question_text' => '<p>Ketentuan dalam UUD NRI Tahun 1945 yang menyatakan bahwa "Negara Indonesia adalah negara hukum" terdapat pada ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pasal 1 ayat (1)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 1 ayat (2)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 27 ayat (1)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 1 ayat (3)', 'image' => null, 'is_correct' => true],
                    ['text' => 'Pasal 28D ayat (1)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Isi Pasal 1 UUD NRI Tahun 1945:</p>
            <ul>
            <li><strong>Ayat (1):</strong> Negara Indonesia ialah Negara Kesatuan, yang berbentuk Republik.</li>
            <li><strong>Ayat (2):</strong> Kedaulatan berada di tangan rakyat dan dilaksanakan menurut Undang-Undang Dasar.</li>
            <li><strong>Ayat (3):</strong> Negara Indonesia adalah negara hukum.</li>
            </ul>
            <p>Pasal 1 ayat (3) merupakan hasil Perubahan Ketiga UUD 1945 (tahun 2001).</p>
            <p>Pasal 27 ayat (1) dan Pasal 28D ayat (1) memang berkaitan dengan hukum (persamaan kedudukan di dalam hukum), tetapi bukan pernyataan bahwa Indonesia adalah negara hukum.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 5 | Kunci: E
            [
                'no' => 5,
                'question_text' => '<p>"Kedaulatan berada di tangan rakyat dan dilaksanakan menurut Undang-Undang Dasar." Ketentuan tersebut tercantum dalam UUD NRI Tahun 1945 ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pasal 1 ayat (1)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 2 ayat (1)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 3 ayat (1)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 1 ayat (3)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 1 ayat (2)', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 1 ayat (2) UUD NRI Tahun 1945 (hasil Perubahan Ketiga) berbunyi: <em>"Kedaulatan berada di tangan rakyat dan dilaksanakan menurut Undang-Undang Dasar."</em></p>
            <p>Sebelum amandemen, ayat ini berbunyi "... dilakukan sepenuhnya oleh Majelis Permusyawaratan Rakyat". Perubahan ini menegaskan bahwa MPR <strong>bukan lagi lembaga tertinggi negara</strong>; kedaulatan rakyat dijalankan oleh berbagai lembaga sesuai UUD.</p>
            <ul>
            <li>Pasal 2 ayat (1): susunan keanggotaan MPR (anggota DPR dan DPD).</li>
            <li>Pasal 3 ayat (1): wewenang MPR mengubah dan menetapkan UUD.</li>
            </ul>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 6 | Kunci: A
            [
                'no' => 6,
                'question_text' => '<p>Perubahan (amandemen) UUD 1945 dilakukan sebanyak empat kali. Perubahan keempat ditetapkan pada tahun ....</p>',
                'image' => null,
                'options' => [
                    ['text' => '2002', 'image' => null, 'is_correct' => true],
                    ['text' => '1999', 'image' => null, 'is_correct' => false],
                    ['text' => '2000', 'image' => null, 'is_correct' => false],
                    ['text' => '2001', 'image' => null, 'is_correct' => false],
                    ['text' => '2004', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Urutan amandemen UUD 1945 oleh MPR:</p>
            <ul>
            <li><strong>Perubahan Pertama:</strong> 19 Oktober 1999</li>
            <li><strong>Perubahan Kedua:</strong> 18 Agustus 2000</li>
            <li><strong>Perubahan Ketiga:</strong> 9 November 2001</li>
            <li><strong>Perubahan Keempat:</strong> 10 Agustus 2002</li>
            </ul>
            <p>Tips mengingat: amandemen berlangsung setiap tahun berturut-turut, 1999 – 2000 – 2001 – 2002.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 7 | Kunci: C
            [
                'no' => 7,
                'question_text' => '<p>Sekelompok warga menilai sebuah undang-undang bertentangan dengan hak konstitusional mereka. Lembaga negara yang berwenang menguji undang-undang terhadap UUD NRI Tahun 1945 adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Mahkamah Agung', 'image' => null, 'is_correct' => false],
                    ['text' => 'Dewan Perwakilan Rakyat', 'image' => null, 'is_correct' => false],
                    ['text' => 'Mahkamah Konstitusi', 'image' => null, 'is_correct' => true],
                    ['text' => 'Komisi Yudisial', 'image' => null, 'is_correct' => false],
                    ['text' => 'Majelis Permusyawaratan Rakyat', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Berdasarkan <strong>Pasal 24C ayat (1) UUD NRI Tahun 1945</strong>, Mahkamah Konstitusi berwenang mengadili pada tingkat pertama dan terakhir yang putusannya bersifat final untuk:</p>
            <ol>
            <li>menguji undang-undang terhadap UUD;</li>
            <li>memutus sengketa kewenangan lembaga negara yang kewenangannya diberikan oleh UUD;</li>
            <li>memutus pembubaran partai politik; dan</li>
            <li>memutus perselisihan tentang hasil pemilihan umum.</li>
            </ol>
            <p><strong>Jebakan:</strong> Mahkamah Agung (Pasal 24A) menguji peraturan perundang-undangan <em>di bawah</em> undang-undang terhadap undang-undang, bukan undang-undang terhadap UUD.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 8 | Kunci: B
            [
                'no' => 8,
                'question_text' => '<p>Pasal dalam UUD NRI Tahun 1945 yang menyatakan bahwa setiap warga negara berhak dan wajib ikut serta dalam <em>upaya pembelaan negara</em> adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pasal 27 ayat (2)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 27 ayat (3)', 'image' => null, 'is_correct' => true],
                    ['text' => 'Pasal 30 ayat (2)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 28 ayat (1)', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 31 ayat (1)', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <ul>
            <li><strong>Pasal 27 ayat (3):</strong> "Setiap warga negara berhak dan wajib ikut serta dalam upaya pembelaan negara." ✔</li>
            <li>Pasal 27 ayat (2): hak atas pekerjaan dan penghidupan yang layak.</li>
            <li>Pasal 30 ayat (1): hak dan kewajiban ikut serta dalam usaha <em>pertahanan dan keamanan negara</em>; ayat (2) mengatur sistem pertahanan dan keamanan rakyat semesta (Sishankamrata).</li>
            <li>Pasal 31 ayat (1): hak mendapat pendidikan.</li>
            </ul>
            <p><strong>Perhatikan kata kunci:</strong> "upaya pembelaan negara" → Pasal 27 ayat (3), sedangkan "usaha pertahanan dan keamanan negara" → Pasal 30 ayat (1).</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 9 | Kunci: D
            [
                'no' => 9,
                'question_text' => '<p>Semboyan "Bhinneka Tunggal Ika" diambil dari kitab ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Negarakertagama karya Mpu Prapanca', 'image' => null, 'is_correct' => false],
                    ['text' => 'Arjunawiwaha karya Mpu Kanwa', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pararaton', 'image' => null, 'is_correct' => false],
                    ['text' => 'Sutasoma karya Mpu Tantular', 'image' => null, 'is_correct' => true],
                    ['text' => 'Bharatayudha karya Mpu Sedah dan Mpu Panuluh', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Semboyan "Bhinneka Tunggal Ika" berasal dari <strong>Kitab Sutasoma</strong> karya <strong>Mpu Tantular</strong> yang ditulis pada masa Kerajaan Majapahit (abad ke-14).</p>
            <p>Kalimat lengkapnya: <em>"Bhinneka tunggal ika tan hana dharma mangrwa"</em>, artinya "berbeda-beda tetapi tetap satu, tidak ada kebenaran yang mendua".</p>
            <p>Pada masa itu semboyan ini menggambarkan kerukunan antara umat Hindu (Siwa) dan Buddha. Kini semboyan tersebut menjadi simbol persatuan bangsa Indonesia yang majemuk.</p>
            <p><strong>Jebakan:</strong> Kitab Negarakertagama karya Mpu Prapanca juga berasal dari masa Majapahit, tetapi isinya menggambarkan kebesaran kerajaan, bukan asal semboyan ini.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 10 | Kunci: E
            [
                'no' => 10,
                'question_text' => '<p>Ketentuan mengenai lambang negara Garuda Pancasila dengan semboyan Bhinneka Tunggal Ika diatur dalam UUD NRI Tahun 1945 ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pasal 35', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 36', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 36B', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 36C', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pasal 36A', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Bab XV UUD NRI Tahun 1945 mengatur Bendera, Bahasa, dan Lambang Negara, serta Lagu Kebangsaan:</p>
            <ul>
            <li><strong>Pasal 35:</strong> Bendera Negara Indonesia ialah Sang Merah Putih.</li>
            <li><strong>Pasal 36:</strong> Bahasa Negara ialah Bahasa Indonesia.</li>
            <li><strong>Pasal 36A:</strong> Lambang Negara ialah Garuda Pancasila dengan semboyan Bhinneka Tunggal Ika. ✔</li>
            <li><strong>Pasal 36B:</strong> Lagu Kebangsaan ialah Indonesia Raya.</li>
            <li><strong>Pasal 36C:</strong> Ketentuan lebih lanjut diatur dengan undang-undang (yaitu UU Nomor 24 Tahun 2009).</li>
            </ul>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 11 | Kunci: C
            [
                'no' => 11,
                'question_text' => '<p>Deklarasi Djuanda pada 13 Desember 1957 memiliki arti penting bagi bangsa Indonesia karena ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Menetapkan batas wilayah udara Indonesia', 'image' => null, 'is_correct' => false],
                    ['text' => 'Mengakhiri konfrontasi dengan Malaysia', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menegaskan Indonesia sebagai negara kepulauan dengan laut sebagai pemersatu wilayah', 'image' => null, 'is_correct' => true],
                    ['text' => 'Mengembalikan Irian Barat ke pangkuan Indonesia', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menetapkan lebar laut teritorial 3 mil dari garis pantai setiap pulau', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Sebelum 1957, wilayah laut Indonesia mengikuti aturan kolonial <em>Territoriale Zee en Maritieme Kringen Ordonantie</em> 1939, yaitu laut teritorial selebar <strong>3 mil</strong> dari garis pantai setiap pulau. Akibatnya terdapat laut bebas di antara pulau-pulau Indonesia.</p>
            <p>Melalui <strong>Deklarasi Djuanda</strong>, Indonesia menyatakan bahwa laut di sekitar, di antara, dan di dalam kepulauan Indonesia merupakan satu kesatuan wilayah NKRI. Konsep <strong>negara kepulauan</strong> (<em>archipelagic state</em>) ini kemudian diakui dunia melalui UNCLOS 1982 dan menjadi dasar <strong>Wawasan Nusantara</strong>.</p>
            <p><strong>Jebakan:</strong> Opsi E justru aturan kolonial yang digantikan oleh Deklarasi Djuanda.</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 12 | Kunci: B
            [
                'no' => 12,
                'question_text' => '<p>Kongres Pemuda II yang menghasilkan Sumpah Pemuda pada 28 Oktober 1928 dipimpin oleh ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Mohammad Yamin', 'image' => null, 'is_correct' => false],
                    ['text' => 'Soegondo Djojopoespito', 'image' => null, 'is_correct' => true],
                    ['text' => 'Wage Rudolf Supratman', 'image' => null, 'is_correct' => false],
                    ['text' => 'Mohammad Tabrani', 'image' => null, 'is_correct' => false],
                    ['text' => 'Amir Sjarifuddin', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Kongres Pemuda II (27 – 28 Oktober 1928) di Batavia diketuai oleh <strong>Soegondo Djojopoespito</strong> dari Perhimpunan Pelajar-Pelajar Indonesia (PPPI).</p>
            <ul>
            <li><strong>Mohammad Yamin</strong> menjabat sekretaris dan merumuskan teks Sumpah Pemuda.</li>
            <li><strong>Amir Sjarifuddin</strong> menjabat bendahara.</li>
            <li><strong>W.R. Supratman</strong> memperdengarkan lagu "Indonesia Raya" secara instrumental pada kongres ini.</li>
            <li><strong>Mohammad Tabrani</strong> adalah ketua Kongres Pemuda I (1926).</li>
            </ul>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 13 | Kunci: A
            [
                'no' => 13,
                'question_text' => '<p>Tanggal berdirinya sebuah organisasi pergerakan pada tahun 1908 kini diperingati sebagai Hari Kebangkitan Nasional. Organisasi yang dimaksud adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Budi Utomo', 'image' => null, 'is_correct' => true],
                    ['text' => 'Sarekat Islam', 'image' => null, 'is_correct' => false],
                    ['text' => 'Indische Partij', 'image' => null, 'is_correct' => false],
                    ['text' => 'Perhimpunan Indonesia', 'image' => null, 'is_correct' => false],
                    ['text' => 'Partai Nasional Indonesia', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Budi Utomo</strong> didirikan pada <strong>20 Mei 1908</strong> oleh dr. Soetomo dan para pelajar STOVIA atas gagasan dr. Wahidin Sudirohusodo. Budi Utomo dianggap sebagai organisasi modern pertama yang menandai lahirnya kesadaran berbangsa, sehingga 20 Mei diperingati sebagai <strong>Hari Kebangkitan Nasional</strong>.</p>
            <ul>
            <li>Sarekat Islam berawal dari Sarekat Dagang Islam (1905/1911).</li>
            <li>Indische Partij berdiri pada 1912.</li>
            <li>Perhimpunan Indonesia adalah perubahan nama Indische Vereeniging (1908) di Belanda pada 1925.</li>
            <li>PNI berdiri pada 1927.</li>
            </ul>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 14 | Kunci: D
            [
                'no' => 14,
                'question_text' => '<p>Organisasi pergerakan nasional yang pertama kali secara terang-terangan menuntut kemerdekaan Hindia Belanda dan dipimpin oleh Tiga Serangkai adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Budi Utomo', 'image' => null, 'is_correct' => false],
                    ['text' => 'Muhammadiyah', 'image' => null, 'is_correct' => false],
                    ['text' => 'Taman Siswa', 'image' => null, 'is_correct' => false],
                    ['text' => 'Indische Partij', 'image' => null, 'is_correct' => true],
                    ['text' => 'Jong Java', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Indische Partij</strong> didirikan pada 25 Desember 1912 oleh <strong>Tiga Serangkai</strong>: Ernest Douwes Dekker (Danudirja Setiabudi), dr. Tjipto Mangoenkoesoemo, dan Suwardi Suryaningrat (Ki Hajar Dewantara).</p>
            <p>Indische Partij merupakan partai politik pertama di Hindia Belanda dengan semboyan <em>"Indie los van Holland"</em> (Hindia lepas dari Belanda). Karena sikapnya yang radikal, pemerintah kolonial menolak memberikan badan hukum dan para pemimpinnya diasingkan.</p>
            <p>Taman Siswa (1922) memang didirikan oleh Ki Hajar Dewantara, tetapi bergerak di bidang pendidikan, bukan politik.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 15 | Kunci: C
            [
                'no' => 15,
                'question_text' => '<p>Sinta adalah pegawai di bagian pengadaan sebuah instansi pemerintah. Setelah proses pengadaan selesai, salah satu penyedia barang mengirimkan parsel berisi barang mewah ke rumahnya sebagai "ucapan terima kasih". Tindakan yang paling tepat dilakukan Sinta adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Menerimanya karena proses pengadaan sudah selesai sehingga tidak memengaruhi keputusan', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menerimanya lalu membagikannya kepada rekan kerja agar tidak dinikmati sendiri', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menolak atau mengembalikan parsel tersebut dan melaporkannya kepada unit pengendalian gratifikasi atau KPK', 'image' => null, 'is_correct' => true],
                    ['text' => 'Menyimpan parsel tersebut sambil menunggu arahan dari atasan', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menerima parsel tersebut asalkan nilainya tidak melebihi gaji bulanannya', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pemberian dari penyedia barang yang berhubungan dengan jabatan Sinta termasuk <strong>gratifikasi</strong>. Gratifikasi kepada pegawai negeri yang berhubungan dengan jabatan dan berlawanan dengan kewajibannya dianggap suap (Pasal 12B UU Tipikor).</p>
            <p>Berdasarkan Pasal 12C UU Nomor 20 Tahun 2001, penerima gratifikasi wajib <strong>melaporkannya kepada KPK paling lambat 30 hari kerja</strong> sejak gratifikasi diterima. Langkah terbaik adalah menolak atau mengembalikan pemberian, lalu melaporkannya melalui Unit Pengendalian Gratifikasi (UPG) instansi atau langsung ke KPK.</p>
            <ul>
            <li>A: Pemberian setelah pengadaan tetap gratifikasi karena berhubungan dengan jabatan.</li>
            <li>B: Membagikan tidak menghapus status gratifikasi.</li>
            <li>D: Menunda tanpa melapor berisiko melewati batas waktu pelaporan.</li>
            <li>E: Besaran nilai tidak menjadi dasar kebolehan menerima gratifikasi terkait jabatan.</li>
            </ul>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 16 | Kunci: E
            [
                'no' => 16,
                'question_text' => '<p>Di era globalisasi, wujud sikap nasionalisme yang paling tepat ditunjukkan oleh generasi muda adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Menolak semua produk dan budaya yang berasal dari luar negeri', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hanya bergaul dengan sesama warga yang berasal dari daerah yang sama', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menggunakan bahasa asing dalam seluruh kegiatan sehari-hari agar terlihat modern', 'image' => null, 'is_correct' => false],
                    ['text' => 'Membatasi diri dari penggunaan teknologi informasi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Mengembangkan dan mempromosikan produk usaha lokal hingga mampu bersaing di pasar internasional', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Nasionalisme di era globalisasi bukan berarti menutup diri, melainkan <strong>mencintai dan memajukan bangsa sendiri sambil tetap terbuka</strong> terhadap perkembangan dunia.</p>
            <p>Mengembangkan dan mempromosikan produk lokal hingga go internasional menunjukkan:</p>
            <ul>
            <li>kebanggaan terhadap produk bangsa sendiri;</li>
            <li>kontribusi nyata bagi perekonomian nasional;</li>
            <li>kemampuan bersaing secara global.</li>
            </ul>
            <p>Opsi A dan D mencerminkan <em>chauvinisme</em> atau sikap tertutup. Opsi B mencerminkan <em>primordialisme/kedaerahan</em>. Opsi C justru melunturkan identitas bangsa.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 17 | Kunci: B
            [
                'no' => 17,
                'question_text' => '<p>Berikut ini yang <strong>bukan</strong> merupakan nilai dasar bela negara sebagaimana diatur dalam Undang-Undang Nomor 23 Tahun 2019 tentang Pengelolaan Sumber Daya Nasional untuk Pertahanan Negara adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Cinta tanah air', 'image' => null, 'is_correct' => false],
                    ['text' => 'Wajib mengikuti pendidikan militer bagi seluruh warga negara', 'image' => null, 'is_correct' => true],
                    ['text' => 'Sadar berbangsa dan bernegara', 'image' => null, 'is_correct' => false],
                    ['text' => 'Setia pada Pancasila sebagai ideologi negara', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rela berkorban untuk bangsa dan negara', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Nilai dasar bela negara menurut UU Nomor 23 Tahun 2019 meliputi:</p>
            <ol>
            <li>cinta tanah air;</li>
            <li>sadar berbangsa dan bernegara;</li>
            <li>setia pada Pancasila sebagai ideologi negara;</li>
            <li>rela berkorban untuk bangsa dan negara; dan</li>
            <li>kemampuan awal bela negara.</li>
            </ol>
            <p>Pendidikan militer <strong>tidak diwajibkan bagi seluruh warga negara</strong>. Bela negara dapat dilakukan melalui pendidikan kewarganegaraan, pelatihan dasar kemiliteran secara sukarela (Komponen Cadangan), pengabdian sesuai profesi, maupun pengabdian sebagai prajurit TNI.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 18 | Kunci: A
            [
                'no' => 18,
                'question_text' => '<p>Menurut Undang-Undang Nomor 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-undangan, kedudukan Pancasila dalam sistem hukum nasional adalah sebagai ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Sumber segala sumber hukum negara', 'image' => null, 'is_correct' => true],
                    ['text' => 'Peraturan perundang-undangan tertinggi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hukum dasar tertulis', 'image' => null, 'is_correct' => false],
                    ['text' => 'Pedoman pelaksanaan undang-undang', 'image' => null, 'is_correct' => false],
                    ['text' => 'Ketetapan MPR yang bersifat mengatur', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Pasal 2 UU Nomor 12 Tahun 2011</strong> menyatakan: <em>"Pancasila merupakan sumber segala sumber hukum negara."</em></p>
            <p>Artinya, setiap materi muatan peraturan perundang-undangan tidak boleh bertentangan dengan nilai-nilai Pancasila.</p>
            <p><strong>Jebakan:</strong> Opsi B dan C adalah kedudukan <strong>UUD NRI Tahun 1945</strong>, yaitu hukum dasar tertulis yang berada di puncak hierarki peraturan perundang-undangan. Pancasila sendiri tidak termasuk jenis peraturan dalam hierarki tersebut.</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 19 | Kunci: D
            [
                'no' => 19,
                'question_text' => '<p>Urutan jenis dan hierarki peraturan perundang-undangan yang benar menurut Pasal 7 ayat (1) Undang-Undang Nomor 12 Tahun 2011 adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'UUD NRI 1945 – UU/Perppu – Ketetapan MPR – Peraturan Pemerintah – Peraturan Presiden – Perda', 'image' => null, 'is_correct' => false],
                    ['text' => 'UUD NRI 1945 – Ketetapan MPR – Peraturan Pemerintah – UU/Perppu – Peraturan Presiden – Perda', 'image' => null, 'is_correct' => false],
                    ['text' => 'Ketetapan MPR – UUD NRI 1945 – UU/Perppu – Peraturan Pemerintah – Peraturan Presiden – Perda', 'image' => null, 'is_correct' => false],
                    ['text' => 'UUD NRI 1945 – Ketetapan MPR – UU/Perppu – Peraturan Pemerintah – Peraturan Presiden – Perda Provinsi – Perda Kabupaten/Kota', 'image' => null, 'is_correct' => true],
                    ['text' => 'UUD NRI 1945 – Ketetapan MPR – UU/Perppu – Peraturan Presiden – Peraturan Pemerintah – Perda Provinsi – Perda Kabupaten/Kota', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 7 ayat (1) UU Nomor 12 Tahun 2011 menetapkan hierarki sebagai berikut:</p>
            <ol>
            <li>Undang-Undang Dasar Negara Republik Indonesia Tahun 1945;</li>
            <li>Ketetapan Majelis Permusyawaratan Rakyat;</li>
            <li>Undang-Undang/Peraturan Pemerintah Pengganti Undang-Undang;</li>
            <li>Peraturan Pemerintah;</li>
            <li>Peraturan Presiden;</li>
            <li>Peraturan Daerah Provinsi; dan</li>
            <li>Peraturan Daerah Kabupaten/Kota.</li>
            </ol>
            <p><strong>Jebakan:</strong> Opsi E menukar posisi Peraturan Presiden dan Peraturan Pemerintah. Ingat: PP dibuat untuk menjalankan UU, sehingga posisinya tepat di bawah UU.</p>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 20 | Kunci: B
            [
                'no' => 20,
                'question_text' => '<p>Berdasarkan Pasal 37 ayat (5) UUD NRI Tahun 1945, hal yang tidak dapat dilakukan perubahan adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pembukaan UUD NRI Tahun 1945', 'image' => null, 'is_correct' => false],
                    ['text' => 'Bentuk Negara Kesatuan Republik Indonesia', 'image' => null, 'is_correct' => true],
                    ['text' => 'Sistem pemerintahan presidensial', 'image' => null, 'is_correct' => false],
                    ['text' => 'Jumlah pasal dalam UUD NRI Tahun 1945', 'image' => null, 'is_correct' => false],
                    ['text' => 'Lambang negara Garuda Pancasila', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 37 ayat (5) UUD NRI Tahun 1945 berbunyi: <em>"Khusus mengenai bentuk Negara Kesatuan Republik Indonesia tidak dapat dilakukan perubahan."</em></p>
            <p><strong>Catatan:</strong> Pembukaan UUD 1945 juga disepakati tidak diubah oleh MPR, tetapi hal itu merupakan <strong>kesepakatan dasar</strong> MPR saat amandemen, bukan isi Pasal 37 ayat (5). Kesepakatan dasar lainnya adalah mempertahankan sistem presidensial dan melakukan perubahan secara adendum.</p>
            <p>Karena soal menanyakan isi Pasal 37 ayat (5), jawabannya adalah bentuk NKRI.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 21 | Kunci: E
            [
                'no' => 21,
                'question_text' => '<p>Kalimat berikut yang seluruh kata-katanya ditulis sesuai kaidah baku bahasa Indonesia adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Hasil analisa data menunjukkan kwalitas pelayanan apotik meningkat.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Praktek kerja lapangan dilaksanakan sesuai jadwal yang di tentukan.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hasil analisa tersebut sudah diserahkan kepada Pak Lurah kemarin sore.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Karyawan itu ijin tidak masuk karena sakit sejak hari senin.', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hasil analisis menunjukkan kualitas layanan apotek meningkat secara signifikan.', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 36 UUD NRI 1945 menetapkan Bahasa Indonesia sebagai bahasa negara; penggunaan bahasa yang baik dan benar adalah wujud sikap nasionalisme.</p>
            <table border="1" style="border-collapse: collapse; margin: 10px 0;">
            <tr><th>Tidak Baku</th><th>Baku</th></tr>
            <tr><td>analisa</td><td>analisis</td></tr>
            <tr><td>kwalitas</td><td>kualitas</td></tr>
            <tr><td>apotik</td><td>apotek</td></tr>
            <tr><td>praktek</td><td>praktik</td></tr>
            <tr><td>di tentukan</td><td>ditentukan (di- sebagai awalan ditulis serangkai)</td></tr>
            <tr><td>ijin</td><td>izin</td></tr>
            <tr><td>hari senin</td><td>hari Senin (nama hari diawali huruf kapital)</td></tr>
            </table>
            <p>Hanya opsi E yang seluruh katanya baku: <em>analisis, kualitas, apotek, signifikan</em>.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 22 | Kunci: C
            [
                'no' => 22,
                'question_text' => '<p>Menurut Pasal 28I ayat (1) UUD NRI Tahun 1945, terdapat hak asasi manusia yang tidak dapat dikurangi dalam keadaan apa pun (<em>non-derogable rights</em>). Hak berikut yang <strong>tidak</strong> termasuk di dalamnya adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Hak untuk hidup', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hak untuk tidak disiksa', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hak atas kebebasan berserikat dan berkumpul', 'image' => null, 'is_correct' => true],
                    ['text' => 'Hak beragama', 'image' => null, 'is_correct' => false],
                    ['text' => 'Hak untuk tidak dituntut atas dasar hukum yang berlaku surut', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 28I ayat (1) UUD NRI Tahun 1945 menyebutkan hak yang tidak dapat dikurangi dalam keadaan apa pun:</p>
            <ol>
            <li>hak untuk hidup;</li>
            <li>hak untuk tidak disiksa;</li>
            <li>hak kemerdekaan pikiran dan hati nurani;</li>
            <li>hak beragama;</li>
            <li>hak untuk tidak diperbudak;</li>
            <li>hak untuk diakui sebagai pribadi di hadapan hukum; dan</li>
            <li>hak untuk tidak dituntut atas dasar hukum yang berlaku surut.</li>
            </ol>
            <p>Hak atas kebebasan <strong>berserikat dan berkumpul</strong> diatur dalam Pasal 28E ayat (3) dan dapat dibatasi dengan undang-undang sesuai Pasal 28J ayat (2).</p>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 23 | Kunci: A
            [
                'no' => 23,
                'question_text' => '<p>Pasal 18 ayat (2) UUD NRI Tahun 1945 menyatakan bahwa pemerintahan daerah provinsi, kabupaten, dan kota mengatur dan mengurus sendiri urusan pemerintahan menurut asas ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Otonomi dan tugas pembantuan', 'image' => null, 'is_correct' => true],
                    ['text' => 'Sentralisasi dan desentralisasi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Dekonsentrasi dan sentralisasi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Desentralisasi dan dekonsentrasi', 'image' => null, 'is_correct' => false],
                    ['text' => 'Otonomi seluas-luasnya dan sentralisasi', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 18 ayat (2) UUD NRI Tahun 1945: <em>"Pemerintahan daerah provinsi, daerah kabupaten, dan kota mengatur dan mengurus sendiri urusan pemerintahan menurut asas <strong>otonomi dan tugas pembantuan</strong>."</em></p>
            <p>Adapun Pasal 18 ayat (5) menyatakan bahwa pemerintah daerah menjalankan <strong>otonomi seluas-luasnya</strong>, kecuali urusan yang oleh undang-undang ditentukan sebagai urusan pemerintah pusat.</p>
            <p><strong>Jebakan:</strong> Opsi D (desentralisasi dan dekonsentrasi) adalah asas penyelenggaraan pemerintahan daerah yang diatur dalam UU Pemerintahan Daerah, bukan rumusan Pasal 18 ayat (2).</p>
            <p><strong>Jawaban: A</strong></p>',
            ],
            // Soal 24 | Kunci: D
            [
                'no' => 24,
                'question_text' => '<p>Pemilihan umum di Indonesia dilaksanakan berdasarkan asas sebagaimana diatur dalam Pasal 22E ayat (1) UUD NRI Tahun 1945, yaitu ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Langsung, umum, bebas, terbuka, jujur, dan adil', 'image' => null, 'is_correct' => false],
                    ['text' => 'Langsung, umum, aman, rahasia, jujur, dan adil', 'image' => null, 'is_correct' => false],
                    ['text' => 'Luber dan jurdil yang dilaksanakan setiap empat tahun', 'image' => null, 'is_correct' => false],
                    ['text' => 'Langsung, umum, bebas, rahasia, jujur, dan adil', 'image' => null, 'is_correct' => true],
                    ['text' => 'Langsung, umum, bebas, rahasia, transparan, dan akuntabel', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Pasal 22E ayat (1) UUD NRI Tahun 1945: <em>"Pemilihan umum dilaksanakan secara <strong>langsung, umum, bebas, rahasia, jujur, dan adil</strong> setiap lima tahun sekali."</em> Asas ini dikenal dengan singkatan <strong>LUBER JURDIL</strong>.</p>
            <ul>
            <li>A: "terbuka" bertentangan dengan asas rahasia.</li>
            <li>B: "aman" bukan asas pemilu.</li>
            <li>C: pemilu dilaksanakan setiap <strong>lima</strong> tahun, bukan empat tahun.</li>
            <li>E: transparan dan akuntabel adalah prinsip penyelenggara pemilu, bukan asas Pasal 22E ayat (1).</li>
            </ul>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 25 | Kunci: B
            [
                'no' => 25,
                'question_text' => '<p>Dimas sedang menyusun laporan penelitian untuk tugas akhir. Ia menemukan sebuah artikel yang isinya sangat sesuai dengan topiknya. Tindakan yang paling mencerminkan integritas akademik adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Menyalin seluruh isi artikel karena sudah dipublikasikan secara bebas di internet', 'image' => null, 'is_correct' => false],
                    ['text' => 'Mengutip atau memparafrasakan bagian yang diperlukan dan mencantumkan sumbernya secara lengkap', 'image' => null, 'is_correct' => true],
                    ['text' => 'Mengubah beberapa kata dalam artikel agar tidak terdeteksi oleh aplikasi pemeriksa plagiarisme', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menggunakan isi artikel tanpa mencantumkan sumber asalkan dosen tidak mengetahuinya', 'image' => null, 'is_correct' => false],
                    ['text' => 'Meminta temannya menuliskan ulang isi artikel tersebut untuk laporannya', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Integritas</strong> berarti bertindak jujur dan konsisten antara nilai yang diyakini dan perbuatan, termasuk ketika tidak ada yang mengawasi.</p>
            <p>Dalam dunia akademik, integritas ditunjukkan dengan <strong>menghargai karya orang lain</strong>: mengutip atau memparafrasakan seperlunya dan selalu mencantumkan sumber.</p>
            <ul>
            <li>A, C, dan D termasuk <strong>plagiarisme</strong>; publikasi bebas tidak berarti boleh diklaim sebagai karya sendiri.</li>
            <li>E termasuk kecurangan karena laporan tidak dikerjakan sendiri.</li>
            </ul>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 26 | Kunci: E
            [
                'no' => 26,
                'question_text' => '<p>Dalam rapat warga untuk menentukan lokasi pembangunan pos ronda, terdapat dua usulan yang berbeda. Setelah melalui diskusi panjang, rapat memutuskan lokasi berdasarkan pertimbangan kemanfaatan bersama. Warga yang usulannya tidak dipilih tetap menerima dan ikut melaksanakan keputusan tersebut dengan ikhlas. Sikap warga tersebut mencerminkan pengamalan Pancasila sila ke- ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Pertama', 'image' => null, 'is_correct' => false],
                    ['text' => 'Kedua', 'image' => null, 'is_correct' => false],
                    ['text' => 'Ketiga', 'image' => null, 'is_correct' => false],
                    ['text' => 'Kelima', 'image' => null, 'is_correct' => false],
                    ['text' => 'Keempat', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Sila keempat, <strong>"Kerakyatan yang dipimpin oleh hikmat kebijaksanaan dalam permusyawaratan/perwakilan"</strong>, antara lain mengandung nilai:</p>
            <ul>
            <li>mengutamakan musyawarah untuk mencapai mufakat dalam mengambil keputusan bersama;</li>
            <li>tidak memaksakan kehendak kepada orang lain;</li>
            <li>menerima dan melaksanakan hasil musyawarah dengan <strong>itikad baik dan tanggung jawab</strong>;</li>
            <li>mengutamakan kepentingan bersama di atas kepentingan pribadi dan golongan.</li>
            </ul>
            <p>Menerima hasil musyawarah dengan ikhlas meskipun usulan pribadi tidak terpilih adalah wujud nyata nilai sila keempat.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
            // Soal 27 | Kunci: C
            [
                'no' => 27,
                'question_text' => '<p>Kebijakan pemerintah berikut yang paling mencerminkan pengamalan sila kelima Pancasila adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Menyelenggarakan upacara peringatan hari besar nasional secara serentak', 'image' => null, 'is_correct' => false],
                    ['text' => 'Membangun rumah ibadah di setiap kecamatan', 'image' => null, 'is_correct' => false],
                    ['text' => 'Memberikan bantuan biaya pendidikan bagi siswa dari keluarga kurang mampu', 'image' => null, 'is_correct' => true],
                    ['text' => 'Mengadakan pemilihan kepala daerah secara langsung', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menyelenggarakan festival budaya dari berbagai daerah', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Sila kelima, <strong>"Keadilan sosial bagi seluruh rakyat Indonesia"</strong>, menekankan pemerataan kesejahteraan dan kesempatan, terutama bagi kelompok yang kurang beruntung.</p>
            <p>Bantuan biaya pendidikan bagi siswa dari keluarga kurang mampu membuka <strong>kesempatan yang setara</strong> untuk memperoleh pendidikan, sejalan dengan Pasal 31 UUD NRI 1945 tentang hak setiap warga negara atas pendidikan.</p>
            <ul>
            <li>A dan E lebih dekat dengan sila ketiga (persatuan).</li>
            <li>B berkaitan dengan sila pertama.</li>
            <li>D berkaitan dengan sila keempat (demokrasi).</li>
            </ul>
            <p><strong>Jawaban: C</strong></p>',
            ],
            // Soal 28 | Kunci: D
            [
                'no' => 28,
                'question_text' => '<p>Naskah teks Proklamasi Kemerdekaan Indonesia dirumuskan pada dini hari 17 Agustus 1945 di ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Gedung Pejambon', 'image' => null, 'is_correct' => false],
                    ['text' => 'Jalan Pegangsaan Timur Nomor 56', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rengasdengklok', 'image' => null, 'is_correct' => false],
                    ['text' => 'Rumah Laksamana Tadashi Maeda', 'image' => null, 'is_correct' => true],
                    ['text' => 'Gedung Chuo Sangi In', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Setelah kembali dari Rengasdengklok pada malam 16 Agustus 1945, Soekarno, Mohammad Hatta, dan Achmad Soebardjo merumuskan naskah proklamasi di <strong>rumah Laksamana Tadashi Maeda</strong> di Jalan Imam Bonjol Nomor 1, Jakarta (kini Museum Perumusan Naskah Proklamasi). Naskah tulisan tangan kemudian diketik oleh Sayuti Melik.</p>
            <ul>
            <li>Jalan Pegangsaan Timur Nomor 56 adalah tempat <strong>pembacaan</strong> proklamasi.</li>
            <li>Rengasdengklok adalah lokasi "pengamanan" Soekarno–Hatta oleh golongan muda.</li>
            <li>Gedung Pejambon (Chuo Sangi In) adalah tempat sidang BPUPKI.</li>
            </ul>
            <p><strong>Jawaban: D</strong></p>',
            ],
            // Soal 29 | Kunci: B
            [
                'no' => 29,
                'question_text' => '<p>Pada 16 Agustus 1945, golongan muda membawa Soekarno dan Mohammad Hatta ke Rengasdengklok. Tujuan utama tindakan tersebut adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Mengamankan Soekarno–Hatta dari serangan tentara Sekutu yang mendarat di Jakarta', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menjauhkan Soekarno–Hatta dari pengaruh Jepang agar proklamasi segera dilaksanakan tanpa menunggu PPKI', 'image' => null, 'is_correct' => true],
                    ['text' => 'Mempersiapkan pembacaan teks proklamasi di Rengasdengklok', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menyusun rancangan Undang-Undang Dasar negara', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menunggu kepastian berita kekalahan Jepang dari pemerintah Jepang di Tokyo', 'image' => null, 'is_correct' => false],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p>Setelah mendengar kabar kekalahan Jepang dari Sekutu (14–15 Agustus 1945), golongan muda (antara lain Sukarni, Wikana, dan Chaerul Saleh) mendesak agar kemerdekaan segera diproklamasikan tanpa menunggu PPKI, yang mereka anggap bentukan Jepang.</p>
            <p>Golongan tua berpendapat proklamasi perlu dibicarakan dahulu dalam PPKI. Untuk <strong>menjauhkan Soekarno–Hatta dari pengaruh Jepang</strong> dan mendesak proklamasi segera, golongan muda membawa keduanya ke Rengasdengklok pada 16 Agustus 1945.</p>
            <p>Peristiwa berakhir setelah Achmad Soebardjo menjamin proklamasi dilaksanakan paling lambat 17 Agustus 1945 pukul 12.00.</p>
            <p><strong>Jawaban: B</strong></p>',
            ],
            // Soal 30 | Kunci: E
            [
                'no' => 30,
                'question_text' => '<p>Berikut ini yang <strong>bukan</strong> merupakan hasil sidang pertama PPKI pada 18 Agustus 1945 adalah ....</p>',
                'image' => null,
                'options' => [
                    ['text' => 'Mengesahkan Undang-Undang Dasar negara', 'image' => null, 'is_correct' => false],
                    ['text' => 'Memilih Ir. Soekarno sebagai Presiden', 'image' => null, 'is_correct' => false],
                    ['text' => 'Memilih Drs. Mohammad Hatta sebagai Wakil Presiden', 'image' => null, 'is_correct' => false],
                    ['text' => 'Menetapkan bahwa untuk sementara Presiden dibantu oleh sebuah Komite Nasional', 'image' => null, 'is_correct' => false],
                    ['text' => 'Membagi wilayah Indonesia menjadi delapan provinsi', 'image' => null, 'is_correct' => true],
                ],
                'explanation' => '<p><strong>Pembahasan:</strong></p>
            <p><strong>Sidang PPKI I (18 Agustus 1945):</strong></p>
            <ol>
            <li>mengesahkan UUD 1945;</li>
            <li>memilih Ir. Soekarno sebagai Presiden dan Drs. Mohammad Hatta sebagai Wakil Presiden;</li>
            <li>menetapkan bahwa untuk sementara waktu Presiden dibantu oleh sebuah Komite Nasional.</li>
            </ol>
            <p><strong>Sidang PPKI II (19 Agustus 1945):</strong> membagi wilayah Indonesia menjadi <strong>8 provinsi</strong> dan membentuk 12 kementerian (departemen).</p>
            <p><strong>Sidang PPKI III (22 Agustus 1945):</strong> membentuk Komite Nasional Indonesia, Partai Nasional Indonesia, dan Badan Keamanan Rakyat.</p>
            <p><strong>Jawaban: E</strong></p>',
            ],
        ];

        DB::transaction(function () use ($questions, $materialId, $now) {
            foreach ($questions as $question) {
                $questionId = DB::table('questions')->insertGetId([
                    'material_id'   => $materialId,
                    'type'          => 'mcq',
                    'test_type'     => 'twk',
                    'question_text' => $question['question_text'],
                    'image'         => $question['image'],
                    'explanation'   => $question['explanation'],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);

                foreach ($question['options'] as $order => $option) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'option_text' => $option['text'],
                        'image'       => $option['image'],
                        'is_correct'  => $option['is_correct'],
                        'order'       => $order + 1,
                        'weight'      => 0,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            }
        });

        $this->command->info('Seeder TWK Paket SKD - soal nomor 1-30 berhasil dijalankan!');
        $this->command->info('Total soal: ' . count($questions));
        $this->command->info('Material ID: ' . $materialId);
    }
}
