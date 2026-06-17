<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TKPSeederSKD10Part2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari material dengan id 56
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 42]
        );

        // Soal TKP 82-110
        $questions = [
            // Soal 82 - 12453
            [
                'question_text' => 'Dimas adalah mahasiswa baru di sebuah kampus. Kehidupan kampus merupakan tempat untuk optimalisasi perkembangan mahasiswa, baik dari sisi akademik maupun non-akademiknya. Di dalamnya terdapat keragaman budaya, nilai-nilai norma, agama, dan lainnya. Apa yang harus dilakukan Dimas?',
                'explanation' => '<p><strong>Kunci Bobot: 12453</strong></p>
                <p>1 = Dimas percaya bahwa untuk hidup di kampus tidak perlu mempertimbangkan perbedaan-perbedaan yang ada di sekitarnya.<br>
                2 = Dimas menyadari bahwa adanya perbedaan-perbedaan budaya dengan orang lain akan menimbulkan permasalahan di kemudian hari.<br>
                4 = Dimas akan mempelajari dan berusaha menjalankan penghormatan terhadap perbedaan nilai, budaya, fisik, disabilitas, gender, dan agama<br>
                5 = Berusaha untuk selalu menjadi penggerak dalam lingkungan terdekatnya dan mengingatkan mahasiswa lainnya untuk menghormati adanya perbedaan<br>
                3 = Menampilkan rasa hormat terhadap teman-teman yang memiliki perbedaan nilai, budaya, fisik, disabilitas, gender, dan agama dengan orang lain.</p>',
                'options' => [
                    ['text' => 'Dimas percaya bahwa untuk hidup di kampus tidak perlu mempertimbangkan perbedaan-perbedaan yang ada di sekitarnya.', 'weight' => 1],
                    ['text' => 'Dimas menyadari bahwa adanya perbedaan-perbedaan budaya dengan orang lain akan menimbulkan permasalahan di kemudian hari.', 'weight' => 2],
                    ['text' => 'Dimas akan mempelajari dan berusaha menjalankan penghormatan terhadap perbedaan nilai, budaya, fisik, disabilitas, gender, dan agama', 'weight' => 4],
                    ['text' => 'Berusaha untuk selalu menjadi penggerak dalam lingkungan terdekatnya dan mengingatkan mahasiswa lainnya untuk menghormati adanya perbedaan', 'weight' => 5],
                    ['text' => 'Menampilkan rasa hormat terhadap teman-teman yang memiliki perbedaan nilai, budaya, fisik, disabilitas, gender, dan agama dengan orang lain.', 'weight' => 3],
                ]
            ],
            // Soal 83 - 43152
            [
                'question_text' => 'Tio berasal dari suku yang terbiasa berpendapat lugas, sedangkan lingkungannya saat ini menekankan sopan santun dalam bersikap. Cara Tio berpendapat membuat anggota karang taruna tersinggung sehingga menolak kehadiran Tio. Bagaimana seharusnya sikap Eko sebagai ketua?',
                'explanation' => '<p><strong>Kunci Bobot: 43152</strong></p>
                <p>4 = Berusaha menjadi mediator antara Tio dan anggota karang taruna yang tersinggung<br>
                3 = Meminta masukan dari pengurus karang taruna terkait permasalahan tersebut.<br>
                1 = Mencari alasan agar tidak perlu mengundang Tio dalam rapat karang taruna.<br>
                5 = Mengingatkan seluruh anggota agar saling menghargai perbedaan kebiasaan suku.<br>
                2 = Menanyakan pendapat wakil ketua terkait sikap lugas Tio dalam rapat.</p>',
                'options' => [
                    ['text' => 'Berusaha menjadi mediator antara Tio dan anggota karang taruna yang tersinggung', 'weight' => 4],
                    ['text' => 'Meminta masukan dari pengurus karang taruna terkait permasalahan tersebut.', 'weight' => 3],
                    ['text' => 'Mencari alasan agar tidak perlu mengundang Tio dalam rapat karang taruna.', 'weight' => 1],
                    ['text' => 'Mengingatkan seluruh anggota agar saling menghargai perbedaan kebiasaan suku.', 'weight' => 5],
                    ['text' => 'Menanyakan pendapat wakil ketua terkait sikap lugas Tio dalam rapat.', 'weight' => 2],
                ]
            ],
            // Soal 84 - PROFESIONALISME ; 15234
            [
                'question_text' => 'Proyek tugas sekolah dari guru kelas membutuhkan kontribusi dari seluruh anggota kelompok. Kebetulan kelompok Anda mendapatkan anggota baru yang merupakan siswa pertukaran pelajar dari negara lain. Apa yang akan Anda lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 15234</strong></p>
                <p>1 = Meminta kepada guru untuk pindah kelompok agar nyaman<br>
                5 = Mengajak anggota kelompok untuk bekerja bersama-sama<br>
                2 = Mencoba berinteraksi, jika tidak cocok, dibiarkan saja.<br>
                3 = Akan memberi bagian tugas yang menguntungkan kelompok.<br>
                4 = Memberinya kesempatan untuk bekerja sama dalam kelompok.</p>',
                'options' => [
                    ['text' => 'Meminta kepada guru untuk pindah kelompok agar nyaman', 'weight' => 1],
                    ['text' => 'Mengajak anggota kelompok untuk bekerja bersama-sama', 'weight' => 5],
                    ['text' => 'Mencoba berinteraksi, jika tidak cocok, dibiarkan saja.', 'weight' => 2],
                    ['text' => 'Akan memberi bagian tugas yang menguntungkan kelompok.', 'weight' => 3],
                    ['text' => 'Memberinya kesempatan untuk bekerja sama dalam kelompok.', 'weight' => 4],
                ]
            ],
            // Soal 85 - 15432
            [
                'question_text' => 'Rudi sering melihat Yolanda diejek teman-teman sekelasnya karena ia berasal dari kelompok etnis minoritas yang memiliki penampilan fisik berbeda. Bahkan, sahabat-sahabat Rudi sendiri juga sering merundung Yolanda. Apa yang harus dilakukan oleh Rudi?',
                'explanation' => '<p><strong>Kunci Bobot: 15432</strong></p>
                <p>1 = Menjaga jarak dari Yolanda karena tidak mau melibatkan diri dalam permasalahan orang lain<br>
                5 = Mendekati Yolanda dan bergaul dengannya untuk memberikan contoh kepada teman-teman yang lain<br>
                4 = Berusaha memediasi permasalahan Yolanda dan teman-teman sekelasnya agar tidak berlarut-larut<br>
                3 = Meminta para sahabat dan teman-teman sekelas yang lain untuk tidak mengganggu Yolanda<br>
                2 = Tidak ikut campur dalam masalah Yolanda karena dapat mengganggu hubungannya dengan para sahabatnya</p>',
                'options' => [
                    ['text' => 'Menjaga jarak dari Yolanda karena tidak mau melibatkan diri dalam permasalahan orang lain', 'weight' => 1],
                    ['text' => 'Mendekati Yolanda dan bergaul dengannya untuk memberikan contoh kepada teman-teman yang lain', 'weight' => 5],
                    ['text' => 'Berusaha memediasi permasalahan Yolanda dan teman-teman sekelasnya agar tidak berlarut-larut', 'weight' => 4],
                    ['text' => 'Meminta para sahabat dan teman-teman sekelas yang lain untuk tidak mengganggu Yolanda', 'weight' => 3],
                    ['text' => 'Tidak ikut campur dalam masalah Yolanda karena dapat mengganggu hubungannya dengan para sahabatnya', 'weight' => 2],
                ]
            ],
            // Soal 86 - TIK ; 14532
            [
                'question_text' => 'Sebagai pelamar kerja, Risa biasa datang langsung ke perusahaan-perusahaan untuk mengantarkan surat lamaran. Tina menganjurkan agar Risa menggunakan aplikasi lowongan kerja sehingga bisa mendapatkan informasi pekerjaan tanpa harus mendatangi satu per satu perusahaan. Bagaimana Risa menyikapi hal tersebut?',
                'explanation' => '<p><strong>Kunci Bobot: 14532</strong></p>
                <p>1 = Datang ke perusahaan langsung karena menggunakan aplikasi lowongan kerja membutuhkan banyak biaya dan usaha.<br>
                4 = Menggunakan aplikasi lowongan kerja karena memudahkan mendapatkan informasi secara lengkap dan akurat.<br>
                5 = Menggunakan aplikasi lowongan kerja karena informasi yang didapat lebih cepat dan dapat disebarluaskan kepada teman lain.<br>
                3 = Memanfaatkan aplikasi lowongan kerja pastinya membawa keuntungan untuk perusahaan secara keseluruhan.<br>
                2 = Tetap datang langsung ke perusahaan karena akan membantunya lebih cepat mendapatkan informasi tentang pekerjaan.</p>',
                'options' => [
                    ['text' => 'Datang ke perusahaan langsung karena menggunakan aplikasi lowongan kerja membutuhkan banyak biaya dan usaha.', 'weight' => 1],
                    ['text' => 'Menggunakan aplikasi lowongan kerja karena memudahkan mendapatkan informasi secara lengkap dan akurat.', 'weight' => 4],
                    ['text' => 'Menggunakan aplikasi lowongan kerja karena informasi yang didapat lebih cepat dan dapat disebarluaskan kepada teman lain.', 'weight' => 5],
                    ['text' => 'Memanfaatkan aplikasi lowongan kerja pastinya membawa keuntungan untuk perusahaan secara keseluruhan.', 'weight' => 3],
                    ['text' => 'Tetap datang langsung ke perusahaan karena akan membantunya lebih cepat mendapatkan informasi tentang pekerjaan.', 'weight' => 2],
                ]
            ],
            // Soal 87 - TIK ; 12345
            [
                'question_text' => 'Nauval diminta oleh atasan untuk membuat rekapitulasi data karyawan dalam bentuk grafik/gambar yang menarik. Atasannya mengusulkan penggunaan aplikasi edit gambar di komputer, tetapi Nauval belum pernah menggunakan sebelumnya. Apa tindakan Nauval?',
                'explanation' => '<p><strong>Kunci Bobot: 12345</strong></p>
                <p>1 = Mengerjakannya secara manual saja mengingat waktu yang terbatas untuk mengerjakan dan hal itu tidak terlalu penting untuk dipelajari<br>
                2 = Mempelajari aplikasi seadanya saja hanya untuk membuat tulisan karena sebagian masih bisa dikerjakan secara manual dengan hasil yang rapi.<br>
                3 = Menerima usul teman dan mempelajari cara penggunaan aplikasi tersebut agar kelak dapat mengerjakannya sendiri.<br>
                4 = Mengerjakannya dengan menggunakan aplikasi yang diusulkan serta mencari informasi mengenai aplikasi lain yang mendukung pekerjaan bagian lain.<br>
                5 = Mempelajari aplikasi tersebut dengan antusias dan mencari semua aplikasi yang mendukung penyelesaian tugas di perusahaan.</p>',
                'options' => [
                    ['text' => 'Mengerjakannya secara manual saja mengingat waktu yang terbatas untuk mengerjakan dan hal itu tidak terlalu penting untuk dipelajari', 'weight' => 1],
                    ['text' => 'Mempelajari aplikasi seadanya saja hanya untuk membuat tulisan karena sebagian masih bisa dikerjakan secara manual dengan hasil yang rapi.', 'weight' => 2],
                    ['text' => 'Menerima usul teman dan mempelajari cara penggunaan aplikasi tersebut agar kelak dapat mengerjakannya sendiri.', 'weight' => 3],
                    ['text' => 'Mengerjakannya dengan menggunakan aplikasi yang diusulkan serta mencari informasi mengenai aplikasi lain yang mendukung pekerjaan bagian lain.', 'weight' => 4],
                    ['text' => 'Mempelajari aplikasi tersebut dengan antusias dan mencari semua aplikasi yang mendukung penyelesaian tugas di perusahaan.', 'weight' => 5],
                ]
            ],
            // Soal 88 - TIK ; 12453
            [
                'question_text' => 'Rian adalah seorang karyawan yang bertugas merancang bangunan secara manual dengan hasil kerja berupa maket. Saat ini perusahaan telah menyediakan komputer berteknologi tinggi membuat rancangan secara digital. Bagaimana sikap Rian terhadap hal tersebut?',
                'explanation' => '<p><strong>Kunci Bobot: 12453</strong></p>
                <p>1 = Kurang tertarik mempelajari perangkat lunak untuk membuat rancang bangunan secara digital.<br>
                2 = Bersedia menggunakan perangkat lunak tersebut karena teman lain telah menggunakannya juga.<br>
                4 = (opsi 3)<br>
                5 = (opsi 4)<br>
                3 = (opsi 5)</p>',
                'options' => [
                    ['text' => 'Kurang tertarik mempelajari perangkat lunak untuk membuat rancang bangunan secara digital.', 'weight' => 1],
                    ['text' => 'Bersedia menggunakan perangkat lunak tersebut karena teman lain telah menggunakannya juga.', 'weight' => 2],
                    ['text' => 'Mempelajari perangkat lunak tersebut secara bertahap dan menggunakannya untuk pekerjaan.', 'weight' => 4],
                    ['text' => 'Antusias mempelajari dan menguasai perangkat lunak digital untuk meningkatkan kualitas kerja.', 'weight' => 5],
                    ['text' => 'Menggunakan perangkat lunak hanya jika diperintahkan atasan secara langsung.', 'weight' => 3],
                ]
            ],
            // Soal 89 - TIK ; 42513
            [
                'question_text' => 'Kampus Dania sedang mengadakan kompetisi fotografi untuk memperingati Hari Sumpah Pemuda. Persyaratan lomba adalah peserta menggunakan aplikasi sunting gambar hasil karya salah satu mahasiswa. Namun, aplikasi tersebut belum memiliki fitur yang lengkap. Sebagai salah satu peserta lomba, apa yang sebaiknya Diana lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 42513</strong></p>
                <p>4 = Tetap mencoba menggunakan aplikasi tersebut untuk menyunting gambar yang akan Diana ikutkan dalam kompetisi<br>
                2 = Tetap menyunting gambar dengan menggunakan aplikasi konvensional yang lebih terjamin keamanannya.<br>
                5 = Mencoba menggunakan aplikasi tersebut dan memodifikasinya dengan aplikasi lain untuk hasil gambar yang lebih optimal.<br>
                1 = Menggunakan aplikasi tersebut hanya pada penyelesaian tugas-tugas kuliah dari dosen.<br>
                3 = Menggunakan aplikasi tersebut dan mencari kelebihannya agar bisa digunakan pada tugas lain, selain menyunting gambar.</p>',
                'options' => [
                    ['text' => 'Tetap mencoba menggunakan aplikasi tersebut untuk menyunting gambar yang akan Diana ikutkan dalam kompetisi', 'weight' => 4],
                    ['text' => 'Tetap menyunting gambar dengan menggunakan aplikasi konvensional yang lebih terjamin keamanannya.', 'weight' => 2],
                    ['text' => 'Mencoba menggunakan aplikasi tersebut dan memodifikasinya dengan aplikasi lain untuk hasil gambar yang lebih optimal.', 'weight' => 5],
                    ['text' => 'Menggunakan aplikasi tersebut hanya pada penyelesaian tugas-tugas kuliah dari dosen.', 'weight' => 1],
                    ['text' => 'Menggunakan aplikasi tersebut dan mencari kelebihannya agar bisa digunakan pada tugas lain, selain menyunting gambar.', 'weight' => 3],
                ]
            ],
            // Soal 90 - TIK ; 23451
            [
                'question_text' => 'Organisasi daur ulang sampah tempat Ananta bergabung beberapa bulan terakhir sering mengalami masalah kesulitan melacak pengumpulan sampah dari berbagai tempat pembuangan akhir. Hal ini mengakibatkan terjadinya lambatnya pengolahan daur ulang sampah. Sebagai salah satu anggota tim teknologi informasi, apa yang bisa Ananta lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 23451</strong></p>
                <p>2 = Meminta tim pelacakan sampah untuk menggunakan aplikasi yang telah dibuat oleh tim kerjanya<br>
                3 = Mencari organisasi teknologi informasi yang lebih berpengalaman untuk bekerja sama dalam pembuatan aplikasi yang sesuai.<br>
                4 = Mencoba membuat aplikasi yang dibutuhkan organisasi dengan kemampuan yang dikuasai Ananta.<br>
                5 = Mempelajari aplikasi yang sesuai dengan kebutuhan organisasi dan membuat aplikasi yang komprehensif.<br>
                1 = Menggunakan fitur telepon dan pesan singkat untuk melacak pengumpulan sampah seperti tahun-tahun sebelumnya.</p>',
                'options' => [
                    ['text' => 'Meminta tim pelacakan sampah untuk menggunakan aplikasi yang telah dibuat oleh tim kerjanya', 'weight' => 2],
                    ['text' => 'Mencari organisasi teknologi informasi yang lebih berpengalaman untuk bekerja sama dalam pembuatan aplikasi yang sesuai.', 'weight' => 3],
                    ['text' => 'Mencoba membuat aplikasi yang dibutuhkan organisasi dengan kemampuan yang dikuasai Ananta.', 'weight' => 4],
                    ['text' => 'Mempelajari aplikasi yang sesuai dengan kebutuhan organisasi dan membuat aplikasi yang komprehensif.', 'weight' => 5],
                    ['text' => 'Menggunakan fitur telepon dan pesan singkat untuk melacak pengumpulan sampah seperti tahun-tahun sebelumnya.', 'weight' => 1],
                ]
            ],
            // Soal 91 - TIK ; 32541
            [
                'question_text' => 'Universitas "Jaya" memberlakukan sistem single sign on yang berarti semua layanan sistem informasi terpusat pada satu akun dari institusi termasuk akses internet. Penggunaan internet seringkali menjadi terbatas bagi orang dari luar institusi. Apa sebaiknya yang dilakukan Yayuk saat mendapatkan kunjungan dari mitra?',
                'explanation' => '<p><strong>Kunci Bobot: 32541</strong></p>
                <p>3 = Memberikan akses menggunakan ID dan passwordnya kepada orang lain untuk menjaga kerjasama yang dibangun.<br>
                2 = Menyampaikan bahwa akses layanan dari universitas terpusat dan tidak bisa digunakan oleh mitra dari luar.<br>
                5 = Menyampaikan masukan kepada institusi agar tersedia jaringan yang lebih mudah diakses oleh pengguna luar<br>
                4 = Menyarankan penggunaan layanan paket data yang biasa digunakan oleh mitra selama berkunjung.<br>
                1 = Meminta maaf karena tidak bisa membantu memberikan akses layanan dari universitas yang telah dibatasi</p>',
                'options' => [
                    ['text' => 'Memberikan akses menggunakan ID dan passwordnya kepada orang lain untuk menjaga kerjasama yang dibangun.', 'weight' => 3],
                    ['text' => 'Menyampaikan bahwa akses layanan dari universitas terpusat dan tidak bisa digunakan oleh mitra dari luar.', 'weight' => 2],
                    ['text' => 'Menyampaikan masukan kepada institusi agar tersedia jaringan yang lebih mudah diakses oleh pengguna luar', 'weight' => 5],
                    ['text' => 'Menyarankan penggunaan layanan paket data yang biasa digunakan oleh mitra selama berkunjung.', 'weight' => 4],
                    ['text' => 'Meminta maaf karena tidak bisa membantu memberikan akses layanan dari universitas yang telah dibatasi', 'weight' => 1],
                ]
            ],
            // Soal 92 - PROFESIONALISME ; 53421
            [
                'question_text' => 'Dalam sebuah komunitas daring pegiat kesehatan, Dona diminta untuk memberikan tanggapan atas permasalahan saat melakukan psikoedukasi kepada masyarakat. Ia menyadari bahwa banyak keterbatasan dari program yang justru kontraproduktif. Apa yang seharusnya Dona lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 53421</strong></p>
                <p>5 = Mengemas kritik dalam bahasan yang dapat diterima pelaksana sebagai bahan diskusi.<br>
                3 = Memberikan komentar yang ringan agar tidak berakibat menyakiti pelaksana program<br>
                4 = Memberikan kritik keras atas keterbatasan yang ditemukan mengenai program tersebut.<br>
                2 = Memikirkan kemungkinan saran perbaikan alih-alih kritik meskipun bukan hal mudah.<br>
                1 = Menjaga kritik yang disampaikan karena juga pernah merasa tersinggung dengan kritik.</p>',
                'options' => [
                    ['text' => 'Mengemas kritik dalam bahasan yang dapat diterima pelaksana sebagai bahan diskusi.', 'weight' => 5],
                    ['text' => 'Memberikan komentar yang ringan agar tidak berakibat menyakiti pelaksana program', 'weight' => 3],
                    ['text' => 'Memberikan kritik keras atas keterbatasan yang ditemukan mengenai program tersebut.', 'weight' => 4],
                    ['text' => 'Memikirkan kemungkinan saran perbaikan alih-alih kritik meskipun bukan hal mudah.', 'weight' => 2],
                    ['text' => 'Menjaga kritik yang disampaikan karena juga pernah merasa tersinggung dengan kritik.', 'weight' => 1],
                ]
            ],
            // Soal 93 - TIK ; 34251
            [
                'question_text' => 'Ardi adalah seorang penulis artikel populer untuk platform keuangan. Ia mendapati banyak informasi dari internet, baik yang bersumber dari data ilmiah maupun pendapat masyarakat yang beragam. Apa tindakan Ardi?',
                'explanation' => '<p><strong>Kunci Bobot: 34251</strong></p>
                <p>3 = Hanya menggunakan informasi yang teruji kebenarannya saja karena ia pernah membuat kesalahan dan mendapatkan teguran<br>
                4 = Cermat dalam memilih informasi dari situs dunia maya karena kesalahan dalam memilih referensi akan berpengaruh pada kredibilitas saya.<br>
                2 = Mendorong rekan keluarga untuk berhati-hati dalam menyikapi informasi dari dunia maya karena tidak semua informasi bernilai benar.<br>
                5 = Mendorong pengelola platform untuk melakukan seleksi artikel berdasarkan informasi yang akurat dan dapat dipertanggungjawabkan<br>
                1 = Menulis artikel populer sebisanya saja selama ia bisa memenuhi tenggat waktu dan mendapatkan jumlah pembaca yang ditargetkan</p>',
                'options' => [
                    ['text' => 'Hanya menggunakan informasi yang teruji kebenarannya saja karena ia pernah membuat kesalahan dan mendapatkan teguran', 'weight' => 3],
                    ['text' => 'Cermat dalam memilih informasi dari situs dunia maya karena kesalahan dalam memilih referensi akan berpengaruh pada kredibilitas saya.', 'weight' => 4],
                    ['text' => 'Mendorong rekan keluarga untuk berhati-hati dalam menyikapi informasi dari dunia maya karena tidak semua informasi bernilai benar.', 'weight' => 2],
                    ['text' => 'Mendorong pengelola platform untuk melakukan seleksi artikel berdasarkan informasi yang akurat dan dapat dipertanggungjawabkan', 'weight' => 5],
                    ['text' => 'Menulis artikel populer sebisanya saja selama ia bisa memenuhi tenggat waktu dan mendapatkan jumlah pembaca yang ditargetkan', 'weight' => 1],
                ]
            ],
            // Soal 94 - 34521
            [
                'question_text' => 'Susi menggunakan foto Anda untuk ditunjukkan kepada pria yang baru dikenalnya di media sosial. Alasannya adalah dia hanya ingin bermain-main dan tidak ingin menganggap serius pertemanan yang terjadi di media sosial tersebut. Apa tindakan Anda?',
                'explanation' => '<p><strong>Kunci Bobot: 34521</strong></p>
                <p>3 = Menegur Susi bahwa tindakannya itu akan merugikan diri sendiri dan orang lain.<br>
                4 = Meminta Susi untuk jujur dengan identitasnya di media sosial demi nama baiknya.<br>
                5 = Memastikan agar Susi tidak melakukan hal itu baik dengan foto saya maupun foto orang lain.<br>
                2 = Tidak ikut campur dengan perilaku Susi di media sosial karena yang rugi adalah dirinya sendiri.<br>
                1 = Membolehkan tindakan Susi selama sebatas untuk keperluan tersebut saja.</p>',
                'options' => [
                    ['text' => 'Menegur Susi bahwa tindakannya itu akan merugikan diri sendiri dan orang lain.', 'weight' => 3],
                    ['text' => 'Meminta Susi untuk jujur dengan identitasnya di media sosial demi nama baiknya.', 'weight' => 4],
                    ['text' => 'Memastikan agar Susi tidak melakukan hal itu baik dengan foto saya maupun foto orang lain.', 'weight' => 5],
                    ['text' => 'Tidak ikut campur dengan perilaku Susi di media sosial karena yang rugi adalah dirinya sendiri.', 'weight' => 2],
                    ['text' => 'Membolehkan tindakan Susi selama sebatas untuk keperluan tersebut saja.', 'weight' => 1],
                ]
            ],
            // Soal 95 - TIK ; 23145
            [
                'question_text' => 'Binbin mendapatkan tugas untuk melakukan presentasi salah satu materi pelajaran IPA. Selama ini Binbin belum pernah memiliki pengalaman untuk melakukan presentasi, padahal jadwal gilirannya kurang dari 3 hari lagi. Apa yang seharusnya dilakukan oleh Binbin?',
                'explanation' => '<p><strong>Kunci Bobot: 23145</strong></p>
                <p>2 = Meminta saran dari teman-temannya tentang metode presentasi yang baik.<br>
                3 = Menggunakan alat peraga yang berkaitan dengan materi IPA pada saat melakukan presentasi<br>
                1 = Mempresentasikan materi IPA dengan cara membaca materi yang ada di buku<br>
                4 = Menggunakan Power Point yang berisi materi IPA pada saat melakukan presentasi.<br>
                5 = Menggunakan tampilan video serta mengajak teman di kelas untuk aktif saat melakukan presentasi.</p>',
                'options' => [
                    ['text' => 'Meminta saran dari teman-temannya tentang metode presentasi yang baik.', 'weight' => 2],
                    ['text' => 'Menggunakan alat peraga yang berkaitan dengan materi IPA pada saat melakukan presentasi', 'weight' => 3],
                    ['text' => 'Mempresentasikan materi IPA dengan cara membaca materi yang ada di buku', 'weight' => 1],
                    ['text' => 'Menggunakan Power Point yang berisi materi IPA pada saat melakukan presentasi.', 'weight' => 4],
                    ['text' => 'Menggunakan tampilan video serta mengajak teman di kelas untuk aktif saat melakukan presentasi.', 'weight' => 5],
                ]
            ],
            // Soal 96 - 35421
            [
                'question_text' => 'Asep koordinator Kegiatan perkemahan adik tingkat di sekolah. Pada waktu acara pembukaan, Asep mendapat kabar bahwa kepala sekolah berhalangan hadir karena ada kegiatan lain yang tidak dapat ditinggalkan. Sebagai koordinator, apa yang akan Asep lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 35421</strong></p>
                <p>3 = Berdiskusi dengan anggota kelompok dan mengambil alih pembukaan tersebut.<br>
                5 = Berkoordinasi dengan guru lain untuk membuka acara perkemahan.<br>
                4 = Menelepon kepala sekolah untuk mencarikan pengganti sebagai pembuka kegiatan.<br>
                2 = Menggantikan secara langsung posisi kepala sekolah untuk membuka acara.<br>
                1 = Menyerahkan kepada teman anggota lain untuk memutuskan</p>',
                'options' => [
                    ['text' => 'Berdiskusi dengan anggota kelompok dan mengambil alih pembukaan tersebut.', 'weight' => 3],
                    ['text' => 'Berkoordinasi dengan guru lain untuk membuka acara perkemahan.', 'weight' => 5],
                    ['text' => 'Menelepon kepala sekolah untuk mencarikan pengganti sebagai pembuka kegiatan.', 'weight' => 4],
                    ['text' => 'Menggantikan secara langsung posisi kepala sekolah untuk membuka acara.', 'weight' => 2],
                    ['text' => 'Menyerahkan kepada teman anggota lain untuk memutuskan', 'weight' => 1],
                ]
            ],
            // Soal 97 - 41523
            [
                'question_text' => 'Haris menyanggupi permintaan guru untuk menyelesaikan purwarupa kincir angin dari kertas dalam waktu lima hari. Secara mendadak, ia harus mengurus adik yang berkebutuhan khusus karena ibu harus ke luar kota. Apa yang sebaiknya Haris lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 41523</strong></p>
                <p>4 = Mengurus kebutuhan adik sehari-hari sambil mengerjakan purwarupa di sela waktu.<br>
                1 = Menyelesaikan purwarupa sambil menitipkan adik di penitipan anak selama ia mengerjakan tugas.<br>
                5 = Membuat perincian aktivitas mengurus adik dan langkah pengerjaan purwarupa agar waktunya dapat diatur.<br>
                2 = Segera menyelesaikan purwarupa kincir angin karena khawatir akan berpengaruh pada penilaian.<br>
                3 = Meminta bantuan saudara untuk mengurus adik saat ia mengerjakan purwarupa agar dapat selesai sesuai dengan jadwal.</p>',
                'options' => [
                    ['text' => 'Mengurus kebutuhan adik sehari-hari sambil mengerjakan purwarupa di sela waktu.', 'weight' => 4],
                    ['text' => 'Menyelesaikan purwarupa sambil menitipkan adik di penitipan anak selama ia mengerjakan tugas.', 'weight' => 1],
                    ['text' => 'Membuat perincian aktivitas mengurus adik dan langkah pengerjaan purwarupa agar waktunya dapat diatur.', 'weight' => 5],
                    ['text' => 'Segera menyelesaikan purwarupa kincir angin karena khawatir akan berpengaruh pada penilaian.', 'weight' => 2],
                    ['text' => 'Meminta bantuan saudara untuk mengurus adik saat ia mengerjakan purwarupa agar dapat selesai sesuai dengan jadwal.', 'weight' => 3],
                ]
            ],
            // Soal 98 - 12354
            [
                'question_text' => 'Sebagai pengurus senior, Gita harus mewawancarai calon pengurus OSIS pada jadwal yang telah ditentukan. Dalam perjalanan menuju sekolah, Gita melihat kecelakaan lalu lintas dan ingin membantu korban tersebut. Bagaimana Gita bertindak dalam situasi itu sementara ia harus segera sampai di sekolah?',
                'explanation' => '<p><strong>Kunci Bobot: 12354</strong></p>
                <p>1 = Tetap melanjutkan perjalanan ke sekolah karena ia harus menjadi panutan yang baik bagi juniornya.<br>
                2 = Menolong korban meskipun konsekuensinya ia akan terlambat sampai di sekolah untuk melakukan wawancara<br>
                3 = Membantu korban karena merasa iba dan segera mengantarkannya ke kantor polisi atau rumah sakit terdekat.<br>
                5 = Tetap melanjutkan perjalanan menuju sekolah setelah mengontak nomor layanan yang dapat membantu korban.<br>
                4 = Berencana mengontak panitia perekrutan bahwa ada kemungkinan ia akan terlambat tiba di sekolah.</p>',
                'options' => [
                    ['text' => 'Tetap melanjutkan perjalanan ke sekolah karena ia harus menjadi panutan yang baik bagi juniornya.', 'weight' => 1],
                    ['text' => 'Menolong korban meskipun konsekuensinya ia akan terlambat sampai di sekolah untuk melakukan wawancara', 'weight' => 2],
                    ['text' => 'Membantu korban karena merasa iba dan segera mengantarkannya ke kantor polisi atau rumah sakit terdekat.', 'weight' => 3],
                    ['text' => 'Tetap melanjutkan perjalanan menuju sekolah setelah mengontak nomor layanan yang dapat membantu korban.', 'weight' => 5],
                    ['text' => 'Berencana mengontak panitia perekrutan bahwa ada kemungkinan ia akan terlambat tiba di sekolah.', 'weight' => 4],
                ]
            ],
            // Soal 99 - 54132
            [
                'question_text' => 'Teman sekelompok tiba-tiba sakit dan harus beristirahat total di rumah sakit. Padahal, tugas kelompok tentang wawancara dengan tokoh masyarakat harus selesai dalam minggu ini. Sebagai koordinator kelompok, apa yang akan Anda lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 54132</strong></p>
                <p>5 = Membuat perencanaan isi materi yang akan ditanyakan kepada tokoh dengan sisa kelompok yang ada<br>
                4 = Memaksimalkan fungsi dan peran anggota kelompok tanpa kehadiran anggota lain yang sakit.<br>
                1 = Meminta anggota untuk memundurkan jadwal pengumpulan tugas sambil menunggu teman sehat.<br>
                3 = Mengerjakan sesuai dengan kemampuan kelompok yang hadir meskipun ada anggota kelompok yang tidak masuk<br>
                2 = Ikut terlibat dalam wawancara ketika tenaga dan pikirannya dibutuhkan oleh anggota kelompok</p>',
                'options' => [
                    ['text' => 'Membuat perencanaan isi materi yang akan ditanyakan kepada tokoh dengan sisa kelompok yang ada', 'weight' => 5],
                    ['text' => 'Memaksimalkan fungsi dan peran anggota kelompok tanpa kehadiran anggota lain yang sakit.', 'weight' => 4],
                    ['text' => 'Meminta anggota untuk memundurkan jadwal pengumpulan tugas sambil menunggu teman sehat.', 'weight' => 1],
                    ['text' => 'Mengerjakan sesuai dengan kemampuan kelompok yang hadir meskipun ada anggota kelompok yang tidak masuk', 'weight' => 3],
                    ['text' => 'Ikut terlibat dalam wawancara ketika tenaga dan pikirannya dibutuhkan oleh anggota kelompok', 'weight' => 2],
                ]
            ],
            // Soal 100 - 35412
            [
                'question_text' => 'Jario adalah ketua organisasi siswa. Cukup banyak kegiatan yang ia tangani dan ia melibatkan banyak siswa. Ia terbantu, tetapi ada kendala, yaitu tidak semua siswa mengerti cara kerjanya. Saat evaluasi tengah tahun beberapa kegiatan belum terlaksana. Apa tindakan Jario?',
                'explanation' => '<p><strong>Kunci Bobot: 35412</strong></p>
                <p>3 = Mengatur pelaksanaan kegiatan dari tengah sampai akhir tahun dengan detail.<br>
                5 = Mempercepat pelaksanaan kegiatan sambil mempersiapkan alternatif kegiatan baru<br>
                4 = Merencanakan kegiatan yang dapat segera dilakukan sebagai prioritas<br>
                1 = Optimis mendorong para penanggung jawab karena masih ada waktu<br>
                2 = Melaksanakan kegiatan sesuai waktu yang tersedia</p>',
                'options' => [
                    ['text' => 'Mengatur pelaksanaan kegiatan dari tengah sampai akhir tahun dengan detail.', 'weight' => 3],
                    ['text' => 'Mempercepat pelaksanaan kegiatan sambil mempersiapkan alternatif kegiatan baru', 'weight' => 5],
                    ['text' => 'Merencanakan kegiatan yang dapat segera dilakukan sebagai prioritas', 'weight' => 4],
                    ['text' => 'Optimis mendorong para penanggung jawab karena masih ada waktu', 'weight' => 1],
                    ['text' => 'Melaksanakan kegiatan sesuai waktu yang tersedia', 'weight' => 2],
                ]
            ],
            // Soal 101 - 32541
            [
                'question_text' => 'Ami ditunjuk oleh wali kelasnya menjadi ketua panitia kunjungan industri ke luar kota. Waktu pelaksanaannya kurang 1 minggu, ia mendapat laporan bahwa bus yang disewa mengalami kerusakan. Apa tindakan Ami selanjutnya?',
                'explanation' => '<p><strong>Kunci Bobot: 32541</strong></p>
                <p>3 = Menugasi panitia bagian transportasi mencari cara menyelesaikannya.<br>
                2 = Melakukan pemonitoran dan evaluasi terhadap tim panitia terkait dengan persiapan kegiatan<br>
                5 = Bersama dengan anggota panitia segera mencari alternatif transportasi lain.<br>
                4 = Meminta panitia saling membantu terkait dengan transportasi agar kegiatan bisa terlaksana<br>
                1 = Memberikan umpan balik terkait dengan berbagai jenis persiapan kunjungan industri</p>',
                'options' => [
                    ['text' => 'Menugasi panitia bagian transportasi mencari cara menyelesaikannya.', 'weight' => 3],
                    ['text' => 'Melakukan pemonitoran dan evaluasi terhadap tim panitia terkait dengan persiapan kegiatan', 'weight' => 2],
                    ['text' => 'Bersama dengan anggota panitia segera mencari alternatif transportasi lain.', 'weight' => 5],
                    ['text' => 'Meminta panitia saling membantu terkait dengan transportasi agar kegiatan bisa terlaksana', 'weight' => 4],
                    ['text' => 'Memberikan umpan balik terkait dengan berbagai jenis persiapan kunjungan industri', 'weight' => 1],
                ]
            ],
            // Soal 102 - 42513
            [
                'question_text' => 'Sejumlah suporter mahasiswa dari dua fakultas yang sedang bertanding sepak bola antarfakultas terlibat perkelahian karena ada mahasiswa yang saling mengolok dan mengejek. Umar merupakan mahasiswa dari salah satu fakultas yang sedang bertanding sekaligus panitia divisi ketertiban dan keamanan. Apa tindakan Umar?',
                'explanation' => '<p><strong>Kunci Bobot: 42513</strong></p>
                <p>4 = Melaporkan kejadian pada ketua panitia dan ketua BEM dan berharap mahasiswa dari kedua fakultas dapat berdamai<br>
                2 = Menyayangkan perbuatan teman mahasiswa yang memicu terjadinya kericuhan pada pertandingan sepak bola antar fakultas tersebut<br>
                5 = Melerai perkelahian dan mengajak seluruh mahasiswa yang terlibat perkelahian untuk saling memaafkan serta mengutamakan menjaga perdamaian.<br>
                1 = Merasakan perlunya ada meta kuliah atau kegiatan-kegiatan yang dapat menumbuhkan nilai-nilai perdamaian<br>
                3 = Ingin menyampaikan kepada seluruh rekan mahasiswa untuk dapat menjaga ketertiban dan kerukunan sesama demi menjaga nama baik diri sendiri dan kampus.</p>',
                'options' => [
                    ['text' => 'Melaporkan kejadian pada ketua panitia dan ketua BEM dan berharap mahasiswa dari kedua fakultas dapat berdamai', 'weight' => 4],
                    ['text' => 'Menyayangkan perbuatan teman mahasiswa yang memicu terjadinya kericuhan pada pertandingan sepak bola antar fakultas tersebut', 'weight' => 2],
                    ['text' => 'Melerai perkelahian dan mengajak seluruh mahasiswa yang terlibat perkelahian untuk saling memaafkan serta mengutamakan menjaga perdamaian.', 'weight' => 5],
                    ['text' => 'Merasakan perlunya ada meta kuliah atau kegiatan-kegiatan yang dapat menumbuhkan nilai-nilai perdamaian', 'weight' => 1],
                    ['text' => 'Ingin menyampaikan kepada seluruh rekan mahasiswa untuk dapat menjaga ketertiban dan kerukunan sesama demi menjaga nama baik diri sendiri dan kampus.', 'weight' => 3],
                ]
            ],
            // Soal 103 - 12345
            [
                'question_text' => 'Reno adalah anggota karang taruna dan sering melakukan kegiatan bersih desa. Fandi adalah anggota organisasi kepemudaan lain dan sering bertikai dengan kelompok Reno tanpa alasan yang jelas. Sebagai anggota masyarakat yang tinggal di situ, apa yang Anda lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 12345</strong></p>
                <p>1 = Saya membela karang taruna dan memusuhi kelompok Reno.<br>
                2 = Seharusnya mereka bekerja sama dan tidak saling bermusuhan.<br>
                3 = Saya ingin agar kedua kelompok bisa bekerja sama untuk membangun desa.<br>
                4 = (opsi 4)<br>
                5 = (opsi 5)</p>',
                'options' => [
                    ['text' => 'Saya membela karang taruna dan memusuhi kelompok Reno.', 'weight' => 1],
                    ['text' => 'Seharusnya mereka bekerja sama dan tidak saling bermusuhan.', 'weight' => 2],
                    ['text' => 'Saya ingin agar kedua kelompok bisa bekerja sama untuk membangun desa.', 'weight' => 3],
                    ['text' => 'Saya akan menjadi mediator untuk mendamaikan kedua kelompok.', 'weight' => 4],
                    ['text' => 'Saya mengajak kedua kelompok untuk berdialog mencari solusi terbaik.', 'weight' => 5],
                ]
            ],
            // Soal 104 - 14325
            [
                'question_text' => 'Julvri merupakan petugas keamanan di daerah konflik dan menemukan banyak kebiasaan masyarakat terkait tatanan kehidupan bermasyarakat, berbangsa dan bernegara yang sudah mulai luntur di daerah itu. Apa yang seharusnya dilakukan oleh Julvri?',
                'explanation' => '<p><strong>Kunci Bobot: 14325</strong></p>
                <p>1 = Memasang atribut Indonesia pada tempat-tempat yang belum mendapatkan sentuhan dari pemerintah<br>
                4 = Mengajak masyarakat untuk berdialog tentang kehidupan bermasyarakat, berbangsa dan bernegara.<br>
                3 = Menginisiasi sebuah kegiatan yang menumbuhkan rasa bermasyarakat, berbangsa, dan bernegara<br>
                2 = Menggunakan atribut Republik Indonesia di mana pun dia berada.<br>
                5 = Mengajarkan nilai-nilai kehidupan bermasyarakat, berbangsa, dan bernegara kepada masyarakat sekitar.</p>',
                'options' => [
                    ['text' => 'Memasang atribut Indonesia pada tempat-tempat yang belum mendapatkan sentuhan dari pemerintah', 'weight' => 1],
                    ['text' => 'Mengajak masyarakat untuk berdialog tentang kehidupan bermasyarakat, berbangsa dan bernegara.', 'weight' => 4],
                    ['text' => 'Menginisiasi sebuah kegiatan yang menumbuhkan rasa bermasyarakat, berbangsa, dan bernegara', 'weight' => 3],
                    ['text' => 'Menggunakan atribut Republik Indonesia di mana pun dia berada.', 'weight' => 2],
                    ['text' => 'Mengajarkan nilai-nilai kehidupan bermasyarakat, berbangsa, dan bernegara kepada masyarakat sekitar.', 'weight' => 5],
                ]
            ],
            // Soal 105 - 31245
            [
                'question_text' => 'Yusuf memiliki rekan karib yang berlatar belakang sama bernama Iwan. Setelah selesai kuliah, Iwan berubah menjadi seorang yang intoleran dan sering melihat sebelah mata kelompok lain. Bagaimana sikap Yusuf?',
                'explanation' => '<p><strong>Kunci Bobot: 31245</strong></p>
                <p>3 = Menasihati Iwan bahwa sikap tersebut tidak sebaiknya dilakukan.<br>
                1 = Menghargai tindakan yang diambil Iwan<br>
                2 = Membiarkan karena setiap orang berhak menentukan sikapnya sendiri.<br>
                4 = Mengajak Iwan untuk menjadi lebih toleran<br>
                5 = Mengajak Iwan untuk mengikuti kegiatan-kegiatan yang menumbuhkan sikap toleransi.</p>',
                'options' => [
                    ['text' => 'Menasihati Iwan bahwa sikap tersebut tidak sebaiknya dilakukan.', 'weight' => 3],
                    ['text' => 'Menghargai tindakan yang diambil Iwan', 'weight' => 1],
                    ['text' => 'Membiarkan karena setiap orang berhak menentukan sikapnya sendiri.', 'weight' => 2],
                    ['text' => 'Mengajak Iwan untuk menjadi lebih toleran', 'weight' => 4],
                    ['text' => 'Mengajak Iwan untuk mengikuti kegiatan-kegiatan yang menumbuhkan sikap toleransi.', 'weight' => 5],
                ]
            ],
            // Soal 106 - 21534
            [
                'question_text' => 'Hana tidak menyukai kegiatan bersama dengan teman-teman yang tidak terlalu dikenalinya. Padahal setelah menjadi mahasiswa, angkatannya secara rutin mengadakan pertemuan untuk saling berbagai dan mendukung. Apa yang dilakukan oleh Hana?',
                'explanation' => '<p><strong>Kunci Bobot: 21534</strong></p>
                <p>2 = Mempertimbangkan untuk hadir di pertemuan tersebut<br>
                1 = Memutuskan untuk tidak hadir karena merasa tidak nyaman<br>
                5 = Menawarkan diri secara sukarela untuk terlibat menyiapkan pertemuan<br>
                3 = Mencari informasi lebih mengenai konsep pertemuan tersebut<br>
                4 = Mendukung sepenuhnya agar pertemuan tersebut terlaksana</p>',
                'options' => [
                    ['text' => 'Mempertimbangkan untuk hadir di pertemuan tersebut', 'weight' => 2],
                    ['text' => 'Memutuskan untuk tidak hadir karena merasa tidak nyaman', 'weight' => 1],
                    ['text' => 'Menawarkan diri secara sukarela untuk terlibat menyiapkan pertemuan', 'weight' => 5],
                    ['text' => 'Mencari informasi lebih mengenai konsep pertemuan tersebut', 'weight' => 3],
                    ['text' => 'Mendukung sepenuhnya agar pertemuan tersebut terlaksana', 'weight' => 4],
                ]
            ],
            // Soal 107 - 12345
            [
                'question_text' => 'Di lingkungan Anda tinggal ada sebuah keluarga yang perilakunya mencurigakan. Mereka tidak pernah bergaul dengan warga yang lain dan sering pulang malam membawa tamu. Anda mengetahui hal itu karena mereka selalu lewat depan rumah Anda. Apa tindakan Anda?',
                'explanation' => '<p><strong>Kunci Bobot: 12345</strong></p>
                <p>1 = Saya tidak suka mencampuri urusan orang lain<br>
                2 = Saya akan menyampaikan informasi tersebut kepada teman dekat.<br>
                3 = Saya akan menyampaikan informasi tersebut kepada ketua RT<br>
                4 = Saya akan meminta ketua RT untuk menyikapi kondisi tersebut<br>
                5 = Saya berusaha untuk berpikir positif tentang keluarga tersebut.</p>',
                'options' => [
                    ['text' => 'Saya tidak suka mencampuri urusan orang lain', 'weight' => 1],
                    ['text' => 'Saya akan menyampaikan informasi tersebut kepada teman dekat.', 'weight' => 2],
                    ['text' => 'Saya akan menyampaikan informasi tersebut kepada ketua RT', 'weight' => 3],
                    ['text' => 'Saya akan meminta ketua RT untuk menyikapi kondisi tersebut', 'weight' => 4],
                    ['text' => 'Saya berusaha untuk berpikir positif tentang keluarga tersebut.', 'weight' => 5],
                ]
            ],
            // Soal 108 - 12543
            [
                'question_text' => 'Baru-baru ini, di sekolah Denny terjadi penggantian kepala sekolah, pindahan dari sekolah lain. Tersiar kabar bahwa kepala sekolah tersebut merupakan misionaris. Teman-teman Denny dan guru-guru yang berbeda keyakinan merasa kesal. Bagaimana sebaiknya sikap Denny?',
                'explanation' => '<p><strong>Kunci Bobot: 12543</strong></p>
                <p>1 = Ikut merasa kesal karena tidak pantas seorang misionaris diberi jabatan menjadi kepala sekolah<br>
                2 = Menanggapinya dengan tidak terlalu berlebihan karena desas-desus tersebut tidak jelas sumbernya.<br>
                5 = Mengajak teman-temannya untuk bersama-sama mencari informasi dari sumber-sumber yang terpercaya<br>
                4 = Mencoba memastikan sumbernya terlebih dahulu untuk menentukan informasi tersebut patut dipercaya atau tidak<br>
                3 = Mencoba bertanya kepada beberapa guru yang dikenal baik untuk menyelidiki kebenaran informasi itu</p>',
                'options' => [
                    ['text' => 'Ikut merasa kesal karena tidak pantas seorang misionaris diberi jabatan menjadi kepala sekolah', 'weight' => 1],
                    ['text' => 'Menanggapinya dengan tidak terlalu berlebihan karena desas-desus tersebut tidak jelas sumbernya.', 'weight' => 2],
                    ['text' => 'Mengajak teman-temannya untuk bersama-sama mencari informasi dari sumber-sumber yang terpercaya', 'weight' => 5],
                    ['text' => 'Mencoba memastikan sumbernya terlebih dahulu untuk menentukan informasi tersebut patut dipercaya atau tidak', 'weight' => 4],
                    ['text' => 'Mencoba bertanya kepada beberapa guru yang dikenal baik untuk menyelidiki kebenaran informasi itu', 'weight' => 3],
                ]
            ],
            // Soal 109 - 13452
            [
                'question_text' => 'Seorang warga suku X mengalami cedera akibat tabrakan motor dengan seorang warga suku Y. Sebelum kejadian hubungan kedua suku tersebut memang tidak harmonis. Peristiwa ini makin memicu konfrontasi di antara keduanya. Sebagai warga suku X, apa tindakan Anda?',
                'explanation' => '<p><strong>Kunci Bobot: 13452</strong></p>
                <p>1 = Mendukung tindakan yang akan dilakukan tetua suku dan memviralkan kejadian ini di media sosial.<br>
                3 = Memikirkan alternatif penyelesaian masalah yang damai agar peristiwa ini tidak berkembang menjadi masalah yang lebih besar.<br>
                4 = Menyerahkan sepenuhnya keputusan untuk menyelesaikan masalah ini kepada orang-orang yang dituakan di suku saya.<br>
                5 = Berinisiatif memfasilitasi dialog antarkedua suku untuk berembuk bersama dan mendiskusikan bagaimana persoalan ini dapat diselesaikan secara damai.<br>
                2 = Mencoba berbicara dengan orang-orang yang dituakan di suku saya untuk mengajak menahan diri dan tidak membawa permasalahan ini ke isu kesukuan.</p>',
                'options' => [
                    ['text' => 'Mendukung tindakan yang akan dilakukan tetua suku dan memviralkan kejadian ini di media sosial.', 'weight' => 1],
                    ['text' => 'Memikirkan alternatif penyelesaian masalah yang damai agar peristiwa ini tidak berkembang menjadi masalah yang lebih besar.', 'weight' => 3],
                    ['text' => 'Menyerahkan sepenuhnya keputusan untuk menyelesaikan masalah ini kepada orang-orang yang dituakan di suku saya.', 'weight' => 4],
                    ['text' => 'Berinisiatif memfasilitasi dialog antarkedua suku untuk berembuk bersama dan mendiskusikan bagaimana persoalan ini dapat diselesaikan secara damai.', 'weight' => 5],
                    ['text' => 'Mencoba berbicara dengan orang-orang yang dituakan di suku saya untuk mengajak menahan diri dan tidak membawa permasalahan ini ke isu kesukuan.', 'weight' => 2],
                ]
            ],
            // Soal 110 - 45321
            [
                'question_text' => 'Bombom adalah salah satu pemimpin ormas keagamaan di kampus, tetapi pemikirannya cenderung radikal sehingga membuat organisasinya dicap ekstrim. Sebelumnya organisasi tersebut sangat terkenal dengan kesantunan dan cinta damai sehingga sebagian anggota memikirkan cara untuk menyelamatkan organisasi ini. Sebagai anggota, apa yang anda lakukan?',
                'explanation' => '<p><strong>Kunci Bobot: 45321</strong></p>
                <p>4 = Mengajak beberapa teman yang berkomitmen melakukan tindakan penyelamatan organisasi dan penyusunan program<br>
                5 = Menyusun strategi untuk membuat berbagai kegiatan organisasi yang mempertahankan nilai-nilai cinta damai.<br>
                3 = Memiliki keinginan untuk mempertahankan kegiatan organisasi yang menjunjung tinggi kehidupan yang cinta damai.<br>
                2 = Memahami adanya ketidakseimbangan dalam organisasi, tetapi belum memiliki program yang sesuai.<br>
                1 = Belum merasakan akibat langsung yang negatif dilakukan oleh Bombom sehingga bersikap netral saja.</p>',
                'options' => [
                    ['text' => 'Mengajak beberapa teman yang berkomitmen melakukan tindakan penyelamatan organisasi dan penyusunan program', 'weight' => 4],
                    ['text' => 'Menyusun strategi untuk membuat berbagai kegiatan organisasi yang mempertahankan nilai-nilai cinta damai.', 'weight' => 5],
                    ['text' => 'Memiliki keinginan untuk mempertahankan kegiatan organisasi yang menjunjung tinggi kehidupan yang cinta damai.', 'weight' => 3],
                    ['text' => 'Memahami adanya ketidakseimbangan dalam organisasi, tetapi belum memiliki program yang sesuai.', 'weight' => 2],
                    ['text' => 'Belum merasakan akibat langsung yang negatif dilakukan oleh Bombom sehingga bersikap netral saja.', 'weight' => 1],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => $material->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at'=> now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => false,
                    'order' => $optionData['weight'],
                    'weight' => $optionData['weight'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder TKP Paket 10 Part 2 (soal 82-110) berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questions));
    }
}
