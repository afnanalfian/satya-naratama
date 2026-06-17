<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TKPProfesionalismeRadikalismeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Soal untuk material_id = 50 (TWK/TKP campuran)
        $materialId50 = 50;

        // Soal untuk material_id = 51
        $materialId51 = 51;

        // Soal untuk material_id = 50 (nomor 1,2,3,4,5,11,12,13,14,15)
        $questionsMaterial50 = [
            // Soal 1 - TKP
            [
                'question_text' => 'Anda merupakan pimpinan sebuah internal di perusahaan. Ketika rapat ada rekan kerja Anda yang mengusulkan ide yang sangat baik, namun menurut Anda hal tersebut sangat berisiko jika dilakukan. Ketika Anda memberikan tanggapan, teman tersebut tidak menanggapi dengan sikap yang baik. Sikap Anda adalah...',
                'explanation' => 'Kunci: A=3, B=4, C=2, D=5, E=1 (Urutan bobot: D(5), B(4), A(3), C(2), E(1))',
                'options' => [
                    ['text' => 'Memintanya untuk memberikan gagasan yang lebih realistis dan risikonya kecil', 'weight' => 3, 'order' => 1],
                    ['text' => 'Mengajaknya untuk bicara santai dan fokus pada tujuan awal', 'weight' => 4, 'order' => 2],
                    ['text' => 'Diam saja dan mengikuti semua gagasan yang lebih realistis dan risikonya kecil', 'weight' => 2, 'order' => 3],
                    ['text' => 'Memintanya untuk memikirkan kembali gagasan yang diusulkan', 'weight' => 5, 'order' => 4],
                    ['text' => 'Keluar dari ruang diskusi dan memikirkan kembali gagasan yang lebih realistis dan risikonya kecil', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 2 - TKP
            [
                'question_text' => 'Bagaimana Anda menyikapi isu terhadap salah satu rekan Anda yang melakukan korupsi terhadap uang perusahaan? Rekan Anda tersebut tidak masuk beberapa hari...',
                'explanation' => 'Kunci: A=4, B=5, C=3, D=1, E=2 (Urutan bobot: B(5), A(4), C(3), E(2), D(1))',
                'options' => [
                    ['text' => 'Anda menanyakan kebenaran informasi tersebut kepada rekan kerja Anda', 'weight' => 4, 'order' => 1],
                    ['text' => 'Kabar tersebut belum pasti sehingga Anda tidak mau menanggapi hal tersebut', 'weight' => 5, 'order' => 2],
                    ['text' => 'Menyebabkan kerugian besar kepada perusahaan', 'weight' => 3, 'order' => 3],
                    ['text' => 'Anda mendatangi rumah rekan kerja Anda yang diisukan melakukan korupsi', 'weight' => 1, 'order' => 4],
                    ['text' => 'Pihak perusahaan harus memberikan sanksi yang tegas terhadap pelaku', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 3 - TKP
            [
                'question_text' => 'Anda akan melaksanakan penempatan di salah satu instansi yang letaknya di luar pulau tempat Anda tinggal. Perjalanan hanya dapat ditempuh dengan pesawat karena besok sudah harus sampai di kantor tersebut. Ketika pesawat akan segera berangkat Anda melihat kakek tua yang kebingungan. Bagaimana sikap Anda...',
                'explanation' => 'Kunci: A=5, B=3, C=4, D=1, E=2 (Urutan bobot: A(5), C(4), B(3), E(2), D(1))',
                'options' => [
                    ['text' => 'Meminta bantuan satpam untuk membantu kakek tersebut', 'weight' => 5, 'order' => 1],
                    ['text' => 'Bergegas menuju pesawat dan berharap ada orang lain yang menolongnya', 'weight' => 3, 'order' => 2],
                    ['text' => 'Bertanya terlebih dahulu kepada kakek tersebut, jika sangat penting Anda akan membantunya', 'weight' => 4, 'order' => 3],
                    ['text' => 'Menyewa jasa orang lain untuk membantu kakek tersebut', 'weight' => 1, 'order' => 4],
                    ['text' => 'Membantu kakek tersebut menyelesaikan masalahnya', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 4 - TKP
            [
                'question_text' => 'Saya adalah seorang dokter yang bekerja di rumah sakit. Suatu ketika saya menemukan suatu penyakit dengan gejala yang belum pernah ditemukan sebelumnya. Mengetahui hal tersebut, yang akan Anda lakukan adalah...',
                'explanation' => 'Kunci: A=5, B=1, C=3, D=4, E=2 (Urutan bobot: A(5), D(4), C(3), E(2), B(1))',
                'options' => [
                    ['text' => 'Mempelajari lebih dalam tentang penyakit tersebut dan mendiskusikannya dengan tenaga ahli lain', 'weight' => 5, 'order' => 1],
                    ['text' => 'Menghindari pasien tersebut agar tidak tertular penyakit serupa', 'weight' => 1, 'order' => 2],
                    ['text' => 'Menyarankan pada pasien agar berobat pada dokter lain yang dianggap lebih ahli', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menyerahkan pemeriksaan penyakit pada dokter lain dan memohon maaf karena tidak bisa menangani', 'weight' => 4, 'order' => 4],
                    ['text' => 'Memberitahukan pada pasien bahwa penyakit tersebut belum banyak diketahui dan memperingatkannya agar berhati-hati', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 5 - TKP
            [
                'question_text' => 'Atasan Anda meminta Anda lembur karena ada kepentingan pribadi. Atasan Anda memberikan imbalan berupa membebaskan Anda untuk tidak masuk kantor selama satu hari. Saya akan...',
                'explanation' => 'Kunci: A=2, B=5, C=1, D=3, E=4 (Urutan bobot: B(5), E(4), D(3), A(2), C(1))',
                'options' => [
                    ['text' => 'Menerimanya karena bisa saya gunakan untuk beristirahat', 'weight' => 2, 'order' => 1],
                    ['text' => 'Tetap masuk kerja karena saya lembur bukan urusan kantor', 'weight' => 5, 'order' => 2],
                    ['text' => 'Menerimanya karena memang saya lelah membantunya', 'weight' => 1, 'order' => 3],
                    ['text' => 'Meminta jatah libur pada saat saya membutuhkan saja', 'weight' => 3, 'order' => 4],
                    ['text' => 'Tetap masuk kerja karena saya sudah mendapat imbalan', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 11 - TKP
            [
                'question_text' => 'Di lingkungan Anda terjadi pembicaraan tentang tetangga yang diklaim meneror warga lain lantaran kecewa terhadap pemerintah atas dana bansos yang dikorupsi. Anda sebaiknya bersikap...',
                'explanation' => 'Kunci: A=3, B=1, C=5, D=2, E=4 (Urutan bobot: C(5), E(4), A(3), D(2), B(1))',
                'options' => [
                    ['text' => 'Berdiam diri karena tidak ada yang meminta bantuan', 'weight' => 3, 'order' => 1],
                    ['text' => 'Membenarkan berita karena mendengar dari banyak orang', 'weight' => 1, 'order' => 2],
                    ['text' => 'Tidak secara langsung percaya karena kebenarannya belum ada', 'weight' => 5, 'order' => 3],
                    ['text' => 'Merasa tidak peduli', 'weight' => 2, 'order' => 4],
                    ['text' => 'Biasa saja karena kebenarannya belum terungkap', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 12 - TKP
            [
                'question_text' => 'Anda sebagai ASN baru dipindahkan ke rumah dinas. Di sana, ada seseorang yang dikucilkan dan keluarganya dianggap bukan sebagai warga sana hanya karena perbedaan kepercayaan. Anda sebagai orang baru harus...',
                'explanation' => 'Kunci: A=2, B=1, C=3, D=5, E=4 (Urutan bobot: D(5), E(4), C(3), A(2), B(1))',
                'options' => [
                    ['text' => 'Menerima mereka yang dikucilkan namun menyarankan untuk membatasi kegiatan keagamaan', 'weight' => 2, 'order' => 1],
                    ['text' => 'Memberitahu masyarakat bahwa menerima keberagaman dapat mengancam keharmonisan', 'weight' => 1, 'order' => 2],
                    ['text' => 'Menerima orang tersebut dan keluarganya, lalu memberikan mereka ruang untuk mengungkapkan kekecewaannya', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menyadarkan masyarakat sekitar bahwa keberagaman tidak perlu dijadikan permasalahan', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menyadarkan masyarakat agar memberikan kesempatan terhadap tetangganya ini agar bisa hidup dengan tenang di perumahan tersebut', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 13 - TKP
            [
                'question_text' => 'Charles dan Putri merupakan tetangga di suatu perumahan. Pada suatu hari, Putri merayakan Hari Raya Idul Fitri. Sikap Charles sebaiknya...',
                'explanation' => 'Kunci: A=2, B=5, C=3, D=4, E=1 (Urutan bobot: B(5), D(4), C(3), A(2), E(1))',
                'options' => [
                    ['text' => 'Menghormati agama kawannya', 'weight' => 2, 'order' => 1],
                    ['text' => 'Menjaga ketenangan selama perayaan', 'weight' => 5, 'order' => 2],
                    ['text' => 'Ikut merayakan', 'weight' => 3, 'order' => 3],
                    ['text' => 'Membiarkan Putri merayakannya dengan khidmat', 'weight' => 4, 'order' => 4],
                    ['text' => 'Ikut menjalankan ibadah', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 14 - TKP
            [
                'question_text' => 'Anda merupakan kepala desa di mana penduduknya terdiri atas beragam suku-agama akibat proses transmigrasi pemerintah. Pada suatu hari, orang-orang asli di sana berkonflik dengan pendatang hingga menyebabkan munculnya luka ringan. Masyarakat yang tidak berkonflik pun merasa resah dan meminta Anda untuk menyelesaikan permasalahannya. Apa yang Anda lakukan?',
                'explanation' => 'Kunci: A=4, B=5, C=2, D=3, E=1 (Urutan bobot: B(5), A(4), D(3), C(2), E(1))',
                'options' => [
                    ['text' => 'Menangkap provokator yang dianggap sebagai pemicu konflik', 'weight' => 4, 'order' => 1],
                    ['text' => 'Meminta bantuan pihak berwajib', 'weight' => 5, 'order' => 2],
                    ['text' => 'Melakukan penyuluhan untuk kedua pihak agar lebih bertoleransi', 'weight' => 2, 'order' => 3],
                    ['text' => 'Mengadakan rekonsiliasi', 'weight' => 3, 'order' => 4],
                    ['text' => 'Mewajarkan hal tersebut karena perbedaan kerap kali menimbulkan permasalahan', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 15 - TKP
            [
                'question_text' => 'Anda punya rekan yang dahulu sering menjalankan kegiatan organisasi. Namun, organisasi tersebut sudah dilarang keberadaannya dan teman Anda ternyata hingga saat ini masih aktif di sana. Bahkan, beberapa kali terlihat mengunggah postingan bertema radikalisme di media sosial. Sikap Anda seharusnya...',
                'explanation' => 'Kunci: A=1, B=2, C=5, D=4, E=3 (Urutan bobot: C(5), D(4), E(3), B(2), A(1))',
                'options' => [
                    ['text' => 'Berhenti mengikuti akun media sosial supaya tidak terpengaruh', 'weight' => 1, 'order' => 1],
                    ['text' => 'Menanggalkan komentar bertema antiradikalisme dengan bijaksana', 'weight' => 2, 'order' => 2],
                    ['text' => 'Menyadarkan kawan melalui diskusi', 'weight' => 5, 'order' => 3],
                    ['text' => 'Mengingatkan teman yang mempunyai kontak dengannya di media sosial agar hati-hati dengan konten tersebut', 'weight' => 4, 'order' => 4],
                    ['text' => 'Menyindir rekan lewat postingan berbahayanya radikalisme', 'weight' => 3, 'order' => 5],
                ]
            ],
        ];

        // Soal untuk material_id = 51 (nomor 6,7,8,9,10,16,17,18,19,20)
        $questionsMaterial51 = [
            // Soal 6 - TKP
            [
                'question_text' => 'Anda bekerja di perusahaan yang memiliki gaji yang kecil. Tetapi Anda nyaman bekerja di tempat tersebut. Permasalahannya orang tua Anda menyarankan untuk pindah tempat kerja. Sikap saya...',
                'explanation' => 'Kunci: A=1, B=4, C=5, D=3, E=2 (Urutan bobot: C(5), B(4), D(3), E(2), A(1))',
                'options' => [
                    ['text' => 'Menuruti saran orang tua dan mencari pekerjaan lainnya', 'weight' => 1, 'order' => 1],
                    ['text' => 'Menolak saran orang tua dan bekerja seperti biasa', 'weight' => 4, 'order' => 2],
                    ['text' => 'Tetap bekerja seperti biasa dan memberikan pengertian kepada orang tua', 'weight' => 5, 'order' => 3],
                    ['text' => 'Meminta saran dari teman-teman', 'weight' => 3, 'order' => 4],
                    ['text' => 'Meminta pertimbangan atasan Anda', 'weight' => 2, 'order' => 5],
                ]
            ],
            // Soal 7 - TKP
            [
                'question_text' => 'Anda adalah pegawai di suatu kantor swasta pada bagian pelayanan. Suatu hari anak Anda harus dibawa ke rumah sakit. Pada saat bersamaan, masih banyak tugas penting yang harus diselesaikan pada hari yang sama. Apa yang harus Anda lakukan...',
                'explanation' => 'Kunci: A=4, B=1, C=2, D=5, E=3 (Urutan bobot: D(5), A(4), E(3), C(2), B(1))',
                'options' => [
                    ['text' => 'Mengerjakan satu per satu tugas yang harus diselesaikan saat hari itu semampunya sekalipun banyak pikiran yang mengganggu', 'weight' => 4, 'order' => 1],
                    ['text' => 'Memilah tugas kantor yang dapat dibawa pulang untuk diselesaikan di rumah', 'weight' => 1, 'order' => 2],
                    ['text' => 'Memilih pekerjaan yang harus diselesaikan pada hari itu dan dapat diteruskan besok', 'weight' => 2, 'order' => 3],
                    ['text' => 'Mengerjakan tugas secepat mungkin agar dapat segera pulang dan mengantarkan anak ke rumah sakit', 'weight' => 5, 'order' => 4],
                    ['text' => 'Meminta pertolongan keluarga dekat untuk mengawasi anak dan meminta bantuan teman untuk bersama-sama menyelesaikan pekerjaan', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 8 - TKP
            [
                'question_text' => 'Anda merupakan ketua tim dalam perlombaan cerdas cermat. Pada saat akan berangkat, tiba-tiba adik Anda meminta Anda untuk mengantarkan ke sekolah. Yang seharusnya Anda lakukan adalah...',
                'explanation' => 'Kunci: A=3, B=4, C=5, D=2, E=1 (Urutan bobot: C(5), B(4), A(3), D(2), E(1))',
                'options' => [
                    ['text' => 'Pergi ke sekolah dengan tergesa-gesa kemudian langsung berangkat lomba cerdas cermat', 'weight' => 3, 'order' => 1],
                    ['text' => 'Menelpon ibu guru dan menceritakan kondisinya untuk mencari alternatif lainnya', 'weight' => 4, 'order' => 2],
                    ['text' => 'Mencari kerabat yang bersedia mengantarkan adiknya agar dia bisa berkonsentrasi saat pertandingan', 'weight' => 5, 'order' => 3],
                    ['text' => 'Mengantar adiknya ke sekolah tanpa memberitahu teman satu regunya', 'weight' => 2, 'order' => 4],
                    ['text' => 'Meninggalkan adiknya untuk berangkat lomba cerdas cermat', 'weight' => 1, 'order' => 5],
                ]
            ],
            // Soal 9 - TKP
            [
                'question_text' => 'Akhir-akhir ini Marsinah mendapat masukan mengenai model baru pengendalian mutu yang akan diterapkan dalam perusahaan, padahal model yang lama masih berjalan dengan baik. Sebagai kepala SDM, Marsinah sebaiknya...',
                'explanation' => 'Kunci: A=1, B=2, C=3, D=5, E=4 (Urutan bobot: D(5), E(4), C(3), B(2), A(1))',
                'options' => [
                    ['text' => 'Melakukan kegiatan sesuai yang telah dilakukan selama ini', 'weight' => 1, 'order' => 1],
                    ['text' => 'Melihat kemungkinan untuk melaksanakan model ini dengan baik', 'weight' => 2, 'order' => 2],
                    ['text' => 'Bekerja sama dengan konsultan yang mengetahui perkembangan terbaru mengenai hal tersebut', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menerapkan cara terbaik untuk melaksanakan model terbaru dengan mengintegrasikan dengan model lama', 'weight' => 5, 'order' => 4],
                    ['text' => 'Melibatkan seluruh unsur yang ada dalam organisasi untuk secara aktif bersama-sama melaksanakan program tersebut', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 10 - TKP
            [
                'question_text' => 'Anda diikutsertakan dalam pertemuan besok untuk mempersiapkan penyusunan rencana kerja tahun anggaran depan dan semua yang ikut serta diharapkan untuk memberikan usulan terhadap kegiatan tersebut. Sikap Anda adalah...',
                'explanation' => 'Kunci: A=2, B=1, C=5, D=4, E=3 (Urutan bobot: C(5), D(4), E(3), A(2), B(1))',
                'options' => [
                    ['text' => 'Walaupun usulan yang saya berikan berpeluang untuk tidak diterima, namun saya akan tetap mengajukan ide kegiatan tahun depan', 'weight' => 2, 'order' => 1],
                    ['text' => 'Tidak berminat sedikit pun untuk memberikan usulan terhadap rencana kerja tahun depan', 'weight' => 1, 'order' => 2],
                    ['text' => 'Akan mengajukan usulan jika diminta oleh atasan', 'weight' => 5, 'order' => 3],
                    ['text' => 'Mungkin akan mengajukan usulan, tergantung situasi dan kondisi besok', 'weight' => 4, 'order' => 4],
                    ['text' => 'Ragu dalam mengajukan usulan rencana kerja tersebut karena takut kecewa jika tidak diterima', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 16 - TKP
            [
                'question_text' => 'Teman Anda dahulu merupakan simpatisan HTI. Pemerintah sebenarnya sudah melarang keberadaan HTI tahun 2017 silam, namun teman Anda masih suka menyampaikan propaganda lewat akun media sosial. Apa yang seharusnya Anda lakukan?',
                'explanation' => 'Kunci: A=2, B=1, C=5, D=3, E=4 (Urutan bobot: C(5), E(4), D(3), A(2), B(1))',
                'options' => [
                    ['text' => 'Membuat unggahan yang bertentangan dengan konsep HTI', 'weight' => 2, 'order' => 1],
                    ['text' => 'Memblokir akun media sosialnya', 'weight' => 1, 'order' => 2],
                    ['text' => 'Mengamati lebih lanjut, menegur, dan mengajak diskusi', 'weight' => 5, 'order' => 3],
                    ['text' => 'Menegurnya secara langsung dengan pemahaman yang bertentangan', 'weight' => 3, 'order' => 4],
                    ['text' => 'Mengomentari unggahannya dengan sesuatu yang bertentangan', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 17 - TKP
            [
                'question_text' => 'Presiden Joko Widodo memfokuskan beberapa ancaman dari dunia digital, misalnya hoaks hingga radikalisme. Ia pun meminta kita untuk mengisi dunia tersebut dengan hal-hal positif. Apa yang Anda lakukan sebagai ASN?',
                'explanation' => 'Kunci: A=2, B=4, C=1, D=5, E=3 (Urutan bobot: D(5), B(4), E(3), A(2), C(1))',
                'options' => [
                    ['text' => 'Aktif di media sosial dengan pandai memilah konten', 'weight' => 2, 'order' => 1],
                    ['text' => 'Lebih waspada dan ikut mengedukasi masyarakat untuk bisa memahami konsep radikalisme', 'weight' => 4, 'order' => 2],
                    ['text' => 'Berhenti main media sosial', 'weight' => 1, 'order' => 3],
                    ['text' => 'Menjalankan tanggung jawab pekerjaan dan mendukung upaya melawan radikalisme', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menggelar diskusi dengan rekan kerja agar bisa mendeteksi radikalisme di lingkungan sekitar', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 18 - TKP
            [
                'question_text' => 'Ada grup WhatsApp yang ramai menyebut isu ujaran kebencian pada etnis lain. Hal ini terjadi karena satu cuitan teman Anda dan ditanggapi beberapa anggota grup lainnya. Anda dalam situasi ini seharusnya...',
                'explanation' => 'Kunci: A=2, B=1, C=3, D=5, E=4 (Urutan bobot: D(5), E(4), C(3), A(2), B(1))',
                'options' => [
                    ['text' => 'Tidak ikut menyebarkan ujaran kebencian karena belum tentu informasi yang disebarkan benar', 'weight' => 2, 'order' => 1],
                    ['text' => 'Keluar dari grup WA karena tidak sejalan', 'weight' => 1, 'order' => 2],
                    ['text' => 'Tidak mempercayai informasi tersebut dan mencari tahu kebenarannya', 'weight' => 3, 'order' => 3],
                    ['text' => 'Menguji informasi dan mengingatkan teman-teman grup agar tak terlalu cepat memercayai informasi yang beredar', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menguji kebenaran informasi dan menurunkan tensi obrolan', 'weight' => 4, 'order' => 5],
                ]
            ],
            // Soal 19 - TKP
            [
                'question_text' => 'Tawaran beasiswa begitu banyak, namun pasangan Anda tidak mengizinkan Anda untuk mengambil beasiswa dengan alasan Anda tidak bisa fokus pada pekerjaan dan keluarga. Maka Anda akan...',
                'explanation' => 'Kunci: A=2, B=5, C=4, D=1, E=3 (Urutan bobot: B(5), C(4), E(3), A(2), D(1))',
                'options' => [
                    ['text' => 'Marah kepada keadaan', 'weight' => 2, 'order' => 1],
                    ['text' => 'Memakluminya', 'weight' => 5, 'order' => 2],
                    ['text' => 'Meminta pasangan untuk mempertimbangkannya', 'weight' => 4, 'order' => 3],
                    ['text' => 'Keluar dari pekerjaan', 'weight' => 1, 'order' => 4],
                    ['text' => 'Sedih', 'weight' => 3, 'order' => 5],
                ]
            ],
            // Soal 20 - TKP
            [
                'question_text' => 'Jika suatu saat nanti Anda terpilih menjadi seorang pimpinan organisasi terbesar di Indonesia, hal pertama yang saudara lakukan adalah...',
                'explanation' => 'Kunci: A=2, B=3, C=1, D=5, E=4 (Urutan bobot: D(5), E(4), B(3), A(2), C(1))',
                'options' => [
                    ['text' => 'Membuat perubahan organisasi besar-besaran', 'weight' => 2, 'order' => 1],
                    ['text' => 'Memperbaiki kualitas SDM para anggota organisasi', 'weight' => 3, 'order' => 2],
                    ['text' => 'Merenovasi gedung sekretariat supaya lebih bagus', 'weight' => 1, 'order' => 3],
                    ['text' => 'Menciptakan suatu inovasi baru yang dapat memajukan masa depan bangsa', 'weight' => 5, 'order' => 4],
                    ['text' => 'Menerapkan manajemen modern seperti yang telah diterapkan di luar negeri', 'weight' => 4, 'order' => 5],
                ]
            ],
        ];

        // Insert questions untuk material_id = 50
        foreach ($questionsMaterial50 as $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId50,
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
                    'is_correct' => false,
                    'order' => $option['order'],
                    'weight' => $option['weight'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // Insert questions untuk material_id = 51
        foreach ($questionsMaterial51 as $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId51,
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
                    'is_correct' => false,
                    'order' => $option['order'],
                    'weight' => $option['weight'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TKP Profesionalisme dan Radikalisme berhasil dijalankan!');
        $this->command->info('Material ID 50: 10 soal (nomor 1,2,3,4,5,11,12,13,14,15)');
        $this->command->info('Material ID 51: 10 soal (nomor 6,7,8,9,10,16,17,18,19,20)');
    }
}
