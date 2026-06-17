<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TKPTOPAKET3Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Soal TKP nomor 66-110
        $questions = [
            // --- Soal 66 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Untuk memberikan apresiasi terhadap para pelanggan setia perusahaan, Anda dan tim akan membuat satu program rancangan yang baru. Selama ini, program reward yang sudah ada masih memunculkan keluhan sehingga kurang diminat pelanggan. Yang sebaiknya Anda lakukan adalah',
                'explanation' => 'Kunci bobot: 52134',
                'options' => [
                    ['mengupayakan untuk dapat mempromosikan program reward yang sesuai dengan kebutuhan pelanggan', 5],
                    ['mencoba mencari-cari informasi tentang berbagai program reward yang sudah pernah ada untuk para pelanggan', 2],
                    ['menunggu arahan pimpinan untuk merancang program reward yang disarankan untuk dibuat', 1],
                    ['bertanya kepada pelanggan tentang usulan-usulan program reward yang paling menarik bagi para pelanggan.', 3],
                    ['mendiskusikan dengan rekan dalam tim berbagai informasi tentang program reward yang ada untuk para pelanggan', 4],
                ],
            ],
            // --- Soal 67 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Rini sedang menyelesaikan laporan audit untuk dirapatkan hari itu juga. Ketika laporan sudah selesai dan diserahkan pada pimpinan, ternyata ada bagian yang masih harus diperbaiki, sedangkan rapat akan segera dimulai. Apa yang dilakukan Rini?',
                'explanation' => 'Kunci bobot: 32514',
                'options' => [
                    ['Mendiskusikan poin - poin yang perlu diperbaiki', 3],
                    ['Menyampaikan bahwa laporan akan diperbaiki', 2],
                    ['Memastikan laporan diperbaiki sebelum rapat dimulai.', 5],
                    ['Menunjukkan wajah panik karena waktu yang mepet', 1],
                    ['Memanfaatkan waktu yang ada untuk memperbaiki.', 4],
                ],
            ],
            // --- Soal 68 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Setelah lembur beberapa hari, Amir akhirnya menyerahkan laporan audit kepada pimpinan. Amir sedang bersiap mengerjakan tugas lainnya ketika pimpinan menegur keras karena terdapat kekurangan data dalam laporan audit. Apa yang dilakukan Amir?',
                'explanation' => 'Kunci bobot: 13254',
                'options' => [
                    ['Menunjukkan wajah kesal atas teguran tersebut.', 1],
                    ['Memeriksa kembali data laporan yang dimaksud.', 3],
                    ['Mengatakan bahwa semua data sudah lengkap', 2],
                    ['Menerima teguran pimpinan dengan terbuka', 5],
                    ['Menjawab bahwa akan memeriksa Kembali', 4],
                ],
            ],
            // --- Soal 69 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Piko adalah staf di sebuah perusahaan jasa. Saat Piko sedang melintas di depan loket layanan, ada pelanggan yang marah-marah karena merasa tagihan terlalu mahal sambil menunjuk ke arah Piko. Padahal Piko harus segera menghadiri rapat. Apa yang sebaiknya dilakukan Piko?',
                'explanation' => 'Kunci bobot: 12354',
                'options' => [
                    ['Merasa kesal dan menegur pelanggan yang telah menuduh sembarangan.', 1],
                    ['Merasa kesal dan membiarkan rekan kerja di bagian pelayanan yang menegur pelanggan.', 2],
                    ['Segera pergi ke ruang rapat agar rekan-rekan lain tidak tersulut emosinya', 3],
                    ['Dengan ramah meminta pelanggan dan rekan-rekan di bagian pelayanan untuk tenang', 5],
                    ['Bersikap tenang dan mengajak pelanggan untuk mencurahkan keluhannya secara personal', 4],
                ],
            ],
            // --- Soal 70 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dinar bertugas di loket layanan konsumen. Suatu ketika, datang seorang ibu yang marah-marah karena pengurusan berkasnya belum selesai, padahal seharusnya sudah bisa diambil. Apa yang dilakukan Dinar?',
                'explanation' => 'Kunci bobot: 41325',
                'options' => [
                    ['Memberitahu dengan sopan agar bersabar menunggu.', 4],
                    ['Mengecek berkas ketika diminta oleh pelanggan', 1],
                    ['Meminta bagian berkas untuk segera melayaninya.', 3],
                    ['Melayani dengan datar karena ia ikut merasa kesal', 2],
                    ['Menyelesaikan proses berkasnya dengan segera', 5],
                ],
            ],
            // --- Soal 71 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Seorang rekan kerja bertanya kepada Tino tentang cara mengolah data yang diminta atasan. Tino sudah menjelaskan, tetapi rekannya belum mengerti dan terus bertanya. Pada saat yang bersamaan Tino juga ada tugas yang harus diselesaikan. Apa yang sebaiknya dilakukan Tino?',
                'explanation' => 'Kunci bobot: 52143',
                'options' => [
                    ['la mencarikan media lain yang bisa membantu rekan untuk memahami', 5],
                    ['la menawarkan untuk membantu mengolah data agar bisa cepat selesai', 2],
                    ['la mengatakan bahwa ia juga memiliki tugas yang harus diselesaikan segera', 1],
                    ['la mencari cara yang bisa membuat rekannya lebih mudah memahami', 4],
                    ['la mendengarkan pertanyaan, tetapi tetap sambil mengerjakan tugasnya', 3],
                ],
            ],
            // --- Soal 72 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Ini adalah hari pertama Clarissa menjalani percobaan sebagai tenaga layanan pelanggan sebuah bank. Hari ini, antrean nasabah sangat panjang. Menjelang istirahat, seorang nasabah mengeluhkan pelayanan Clarissa yang lambat. Keluhan tersebut berpotensi didengarkan oleh pengawas. Apa yang Clarissa lakukan?',
                'explanation' => 'Kunci bobot: 14253',
                'options' => [
                    ['Karena sudah waktu istirahat, tidak ada keharusan untuk menanggapi keluhan nasabah.', 1],
                    ['Mencatat keluhan yang diberikan nasabah dan memintanya untuk kembali lagi setelah jam istirahat usai', 4],
                    ['Meluangkan waktu sebentar untuk memberikan kesempatan nasabah menyampaikan keluhannya', 2],
                    ['Memperbaiki waktu layanan untuk tiap nasabah dengan memasang timer sehingga waktu layanan menjadi tidak terlalu lama.', 5],
                    ['Menanyakan apakah nasabah tersebut ada keperluan mendesak untuk melihat kemungkinan nomor antreannya didahulukan', 3],
                ],
            ],
            // --- Soal 73 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Perusahaan W mendapatkan tawaran agar mengirimkan stafnya untuk mengikuti pelatihan SDM dari lembaga sertifikasi SDM. Saat mewakili perusahaan untuk mengikuti pelatihan, Michael malah diminta menjadi part time partner bagi lembaga sertifikasi SDM tersebut meskipun berstatus karyawan tetap di perusahaannya. Bagaimana seharusnya sikap Michael?',
                'explanation' => 'Kunci bobot: 45231',
                'options' => [
                    ['Setuju bekerja sama dengan lembaga sertifikasi SDM dengan sepengetahuan dan persetujuan perusahaan.', 4],
                    ['Menolak tawaran karena khawatir terjadi konflik kepentingan dengan pekerjaan utamanya.', 5],
                    ['Menerima tawaran secara diam-diam dan melakukannya di luar jam kerja.', 2],
                    ['Meminta waktu untuk berpikir dan berkonsultasi dengan atasan di perusahaan.', 3],
                    ['Langsung melaporkan tawaran tersebut kepada atasan perusahaan.', 1],
                ],
            ],
            // --- Soal 74 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Bersama satu mahasiswa lain, Ratri menjadi asisten peneliti dosen dan harus melaksanakan penelitian sesuai jadwal. Mendadak Ratri mendapatkan jadwal ujian magang yang waktunya bersamaan dengan jadwal pelaksanaan penelitian. Apa pilihan paling tepat yang semestinya diambil Ratri?',
                'explanation' => 'Kunci bobot: 54123',
                'options' => [
                    ['Membicarakan dengan rekan asisten untuk mencari kawan lain yang bisa membantu melaksanakan penelitian', 5],
                    ['Menghubungi kawan yang lain untuk menggantikan tugas mengambil data penelitian di lapangan', 4],
                    ['Memutuskan mengikuti ujian magang tanpa mempertimbangkan rekannya', 1],
                    ['Mengharap tawaran bantuan dari sesama asisten peneliti yang menjadi mitranya', 2],
                    ['Meminta bantuan teman sesama asisten peneliti dosen untuk saling bertukar jadwal tugas.', 3],
                ],
            ],
            // --- Soal 75 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dinda mendapat tugas ketua kegiatan. Pimpinan memberi kebebasan kepada Dinda memilih anggota tim. Namun, dia khawatir pilihannya kurang tepat dan akan mengecewakan beberapa teman yang lain. Bagaimana tindakan Dinda?',
                'explanation' => 'Kunci bobot: 41352',
                'options' => [
                    ['Menerima rekan-rekan yang menawarkan diri untuk bergabung', 4],
                    ['Menawari siapa saja yang lebih dulu ditemui untuk bergabung', 1],
                    ['Membuat daftar rekan yang potensial untuk diajak kerja sama', 3],
                    ['Menghubungi rekan yang tepat sesuai dengan kompetensi yang dibutuhkan timnya', 5],
                    ['Memasukkan teman-teman yang dikenal ke dalam tim yang dipimpinnya', 2],
                ],
            ],
            // --- Soal 76 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Ani menyatakan sanggup mendesain produk baru selama dua minggu kepada Dita yang notabene pimpinannya. Namun, sudah menjelang dua minggu waktu berjalan, pekerjaan Ani belum ada tanda-tanda selesai. Padahal, desain produk tersebut akan segera digunakan. Apa yang sebaiknya dilakukan Dita?',
                'explanation' => 'Kunci bobot: 12534',
                'options' => [
                    ['Mengungkapkan kemarahannya kepada Ani karena tidak bisa menepati janji pelaksanaan kerja yang telah disanggupinya.', 1],
                    ['Memaafkan Ani karena Dita paham sulitnya membuat desain produk baru dan selanjutnya memberikan tenggang waktu tambahan', 2],
                    ['Berkomunikasi dengan Ani karena bisa jadi Ani mengalami kesulitan dan menyatakan kesanggupannya untuk mengerahkan sumber daya', 5],
                    ['Percaya bahwa Ani akan bertanggung jawab menyelesaikan desain produk tersebut karena sudah ada kontrak perjanjian.', 3],
                    ['Percaya bahwa Ani bekerja dengan baik karena sebelumnya Ani pernah melaksanakan tugas sejenis dan hasilnya memuaskan.', 4],
                ],
            ],
            // --- Soal 77 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dino mahasiswa pendiam yang berprestasi. Bersama Dita dipilih menjadi wakil pertukaran mahasiswa internasional. Dino belum pernah pergi ke luar negeri dan ingin bertanya pada Dita, tetapi Dino takut karena dirinya jarang bicara dengan lawan jenis. Apa tindakan Dino?',
                'explanation' => 'Kunci bobot: 24153',
                'options' => [
                    ['Mencari sendiri informasi terkait negara tujuan melalui internet', 2],
                    ['Memberanikan diri bertanya ke Dita dengan mengajak teman.', 4],
                    ['Menunggu Dita datang lebih dulu untuk memberikan informasi', 1],
                    ['Melakukan koordinasi dengan Dita untuk mempersiapkan segala sesuatu yang diperlukan bersama.', 5],
                    ['Menanyakan informasi yang dibutuhkan pada Dita melalui pesan Whatsapp.', 3],
                ],
            ],
            // --- Soal 78 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Pimpinan mengembalikan laporan bulanan teman Andi karena tidak sesuai dengan ketentuan. Mereka harus mengumpulkannya kembali besok sore. Mereka tidak memahami ketentuan pelaporan karena datang terlambat saat pimpinan menjelaskannya. Bagaimana sikap Andi?',
                'explanation' => 'Kunci bobot: 14523',
                'options' => [
                    ['Diam saja karena memang kesalahan mereka datang terlambat.', 1],
                    ['Meminjamkan catatan tentang prosedur membuat laporan bulanan', 4],
                    ['Menjelaskan secara detail bagian-bagian yang harus ada dalam laporan', 5],
                    ['Memberitahukan ketentuan pelaporan yang telah disepakati jika mereka bertanya.', 2],
                    ['Menjelaskan kembali masukan dari pimpinan dan menawarkan bantuan untuk memperbaiki laporan.', 3],
                ],
            ],
            // --- Soal 79 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Indra merupakan anggota paling senior dan berkompeten dalam UKM Jurnalistik di kampusnya. Di sisi lain, ada rencana kegiatan oleh komunitas tersebut untuk meningkatkan kompetensi anggota baru yang di bidang jurnalistik. Apa tindakan Indra selanjutnya?',
                'explanation' => 'Kunci bobot: 15423',
                'options' => [
                    ['Memilih tidak melibatkan diri dalam upaya meningkatkan kompetensi anggota baru karena sudah seharusnya setiap anggota baru berproses', 1],
                    ['Mengajak rekan-rekan di dalam komunitas untuk membuat acara berbagi pengetahuan saat melakukan pertemuan rutin tiap bulan.', 5],
                    ['Bersedia menjelaskan teknik-teknik jurnalistik yang diketahui ketika diadakan acara perkumpulan anggota komunitas', 4],
                    ['Melakukan upaya berbagi informasi saat ada kegiatan agar ia mendapatkan publikasi dan pengakuan sebagai jurnalis andal.', 2],
                    ['Membagikan informasi dan pengetahuan mengenai jurnalistik yang dimiliki saat ada instruksi dari dosen pembimbing UKM Jurnalistik', 3],
                ],
            ],
            // --- Soal 80 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Sebagai karyawan baru bagian teknologi informasi, Kedasih sangat membutuhkan pelatihan aplikasi komputer dari kantor. Namun, jadwal pelatihan dari kantor berbarengan dengan jadwal ibadah rutin Kedasih, sedangkan Kedasih sungkan untuk melapor. Apa yang sebaiknya dilakukan oleh kepala bagian Kedasih yang mengetahui kesulitan yang dialami anak buahnya tersebut?',
                'explanation' => 'Kunci bobot: 43521',
                'options' => [
                    ['Melakukan penjarangan kebutuhan pelatihan pada karyawan dengan agama yang berbeda', 4],
                    ['Berdiskusi dengan karyawan mengenai kebutuhan pelatihan yang dapat difasilitasi oleh kantor', 3],
                    ['Menyelenggarakan rapat perencanaan kegiatan pelatihan dengan mengundang seluruh karyawan', 5],
                    ['Menyarankan Kedasih untuk mengikuti pelatihan di luar kantor sebagai konsekuensinya', 2],
                    ['Memberikan opsi jadwal lain atau materi pelatihan secara mandiri untuk Kedasih.', 1],
                ],
            ],
            // --- Soal 81 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Made mendapat izin dari dosen untuk mengumpulkan tugas kuliah melebihi deadline karena mengikuti upacara keagamaan. Toni merasa iri dan meminta Ridwan, koordinator kelas, untuk menemui dosen agar membatalkan izin tersebut. Apa yang seharusnya dilakukan Ridwan?',
                'explanation' => 'Kunci bobot: 12543',
                'options' => [
                    ['Mendukung Toni bahwa semua mahasiswa memiliki hak dan kewajiban yang sama terkait tugas kuliah.', 1],
                    ['Mendorong Toni untuk memahami kewajiban Made melakukan upacara keagamaan', 2],
                    ['Menjelaskan kepada Toni persetujuannya atas keputusan dosen dan mengajak Toni memahami kewajiban Made mengikuti upacara keagamaan', 5],
                    ['Memberikan pemahaman kepada Toni tentang kewajiban Made melakukan upacara keagamaan', 4],
                    ['Meminta dosen menjelaskan kepada semua mahasiswa tentang upacara keagamaan yang dihadiri Made.', 3],
                ],
            ],
            // --- Soal 82 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Tim kerja Anda dipindahkan ke kabupaten yang baru untuk pengembangan bisnis. Di tempat yang baru itu salah satu anggota tim selalu membuat lelucon mengenai kebiasaan warga dengan nada merendahkan. Apa yang harus Anda lakukan?',
                'explanation' => 'Kunci bobot: 53142',
                'options' => [
                    ['Menunjukkan rasa hormat dan mengapresiasi sambil terus mengajak teman untuk menyesuaikan diri.', 5],
                    ['Menyampaikan bahwa pendapat temannya tidak selalu benar dan temannya itu agar mampu mengapresiasi', 3],
                    ['Membiarkan sampai teman tersebut menyadari bahwa tindakan dan pemikirannya salah.', 1],
                    ['Memberikan pengertian kepada teman dan mengajaknya memahami kebiasaan setempat.', 4],
                    ['Menanyakan mengapa ia membuat lelucon yang merendahkan kebiasaan warga setempat', 2],
                ],
            ],
            // --- Soal 83 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Teresia seorang tunadaksa dan anggota paduan suara. Saat ada perlombaan di luar kota, Teresia tidak dapat mengikuti karena kondisi fisiknya. Hal ini membuat tim kekurangan anggota. Apa yang harus dilakukan Bella sebagai ketua?',
                'explanation' => 'Kunci bobot: 54213',
                'options' => [
                    ['Meminta izin kepada Teresia untuk mencari tambahan anggota yang menggantikan posisinya.', 5],
                    ['Memberikan pengertian kepada anggota lain untuk menghargai keputusan Teresia.', 4],
                    ['Berdiskusi dengan anggota lain untuk mengetahui pandangan mereka terhadap keputusan Teresia', 2],
                    ['Meminta Teresia untuk tetap ikut agar tim paduan suara dapat mengikuti perlombaan.', 1],
                    ['Memahami keputusan Teresia yang tidak dapat mengikuti perlombaan karena kondisi fisiknya', 3],
                ],
            ],
            // --- Soal 84 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Untuk mendapatkan penilaian atas laporan kerja unit, perlu dilakukan jajak pendapat. Berdasarkan hasil jajak pendapat, ternyata didapatkan banyak kritikan dan masukan, baik dari pimpinan maupun anggota unit kerja lain. Apa tindakan Anda?',
                'explanation' => 'Kunci bobot: 54321',
                'options' => [
                    ['Memilih hasil jajak pendapat yang relevan untuk segera ditindaklanjuti dalam proses perbaikan laporan kerja.', 5],
                    ['Mengumpulkan semua hasil jajak pendapat dan membuat daftar tindak lanjut dari masukan dan kritikan yang ada', 4],
                    ['Mengingatkan rekan kerja untuk menerima semua hasil jajak pendapat tanpa peduli siapa yang memberikan pendapat', 3],
                    ['Mempertimbangkan faktor latar belakang orang yang memberikan kritikan dan masukan sehingga hasilnya benar-benar objektif', 2],
                    ['Menganggap jajak pendapat hanya formalitas saja karena laporan kerja disusun secara detail dan sesuai dengan aturan yang berlaku', 1],
                ],
            ],
            // --- Soal 85 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Tria adalah mahasiswa luar Jawa. Dia acapkali kesulitan memahami candaan teman-teman kuliahnya yang mayoritas asli jawa sehingga menimbulkan kecanggungan pada dirinya. Bagaimana sebaiknya sikap Tria dalam pergaulan dengan rekan-rekan kuliah di kampus?',
                'explanation' => 'Kunci bobot: 45213',
                'options' => [
                    ['Berterus terang kepada teman-temannya bahwa ia tidak terlalu mengerti bahasa Jawa', 4],
                    ['Berinisiatif untuk memulai interaksi dalam bahasa Indonesia sambil belajar bahasa Jawa dengan teman asli Jawa', 5],
                    ['Bergaul dengan teman-teman kuliah yang berasal dari daerah yang sama/berdekatan dengan asalnya', 2],
                    ['Bekerja sama dengan teman-teman yang berasal dari Jawa ketika diwajibkan oleh dosen', 1],
                    ['Berinteraksi dengan sesama teman luar Jawa, tetapi beda daerah sehingga leluasa berbahasa Indonesia', 3],
                ],
            ],
            // --- Soal 86 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anjani kedatangan Sonya, yaitu pegawai magang yang merupakan anak dari salah satu anggota direksi. Banyak pegawai mengeluhkan sikap Sonya yang dianggap tidak sopan. Anjani didesak pegawai untuk menegurnya, tetapi ia khawatir hal itu akan berdampak pada kariernya. Apa yang sebaiknya dilakukan oleh Anjani?',
                'explanation' => 'Kunci bobot: 25134',
                'options' => [
                    ['Mendengarkan keluhan dan menegur Sonya', 2],
                    ['Mengenalkan Sonya kepada pegawai lainnya dan menjelaskan aturan selama bekerja di kantor.', 5],
                    ['Mendengarkan keluhan tersebut, tetapi membiarkan saja', 1],
                    ['Memanggil Sonya dan mendengarkan pendapatnya', 3],
                    ['Mengenalkan Sonya kepada pegawai lain agar mereka bisa saling memahami', 4],
                ],
            ],
            // --- Soal 87 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Alfredo tergabung dalam sebuah tim untuk menyelesaikan proyek kerja. Perusahaannya kini berlangganan penyimpanan data berbasis daring dengan harga yang cukup mahal dan menyarankan ke setiap anggota tim untuk memanfaatkannya. Apa tindakan Alfredo?',
                'explanation' => 'Kunci bobot: 32154',
                'options' => [
                    ['Menggunakan penyimpanan data karena yakin bahwa dengan cara penyimpanan tersebut data perusahaan menjadi lebih aman.', 3],
                    ['Menolak penggunaan karena meyakini beberapa jenis data sulit untuk diunggah sehingga membuat penyelesaian kerja menjadi lebih lama', 2],
                    ['Menolak penggunaan karena berlangganan penyimpanan berbasis daring cukup menyita keuangan perusahaan.', 1],
                    ['Menggunakan penyimpanan data karena dengan penyimpanan tersebut anggota tim mudah untuk saling memeriksa pekerjaan rekan.', 5],
                    ['Menggunakan penyimpanan data karena meyakini bahwa penyimpanan tersebut membuat dirinya lebih cepat dalam mengakses data', 4],
                ],
            ],
            // --- Soal 88 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Rusy adalah seorang pengajar senior yang sibuk. Saat ini sekolah tempatnya bekerja telah menggunakan aplikasi deteksi khusus untuk menghindari kecurangan saat proses belajar mengajar. Padahal, ia belum pernah menggunakannya sehingga Rusy...',
                'explanation' => 'Kunci bobot: 12345',
                'options' => [
                    ['mengeluh kepada pimpinan dengan kebijakan ini karena risiko kecurangan dalam belajar mengajar sangat minim terjadi', 1],
                    ['tidak menggunakan secara optimal karena cara otorisasi ini dapat dilakukan oleh staf administrasi pembelajaran saja', 2],
                    ['segera belajar untuk memahami bagaimana penggunaan aplikasi ini untuk mata pelajarannya.', 3],
                    ['segera belajar untuk memahami bagaimana pemanfaatan aplikasi ini pada berbagai mata Pelajaran', 4],
                    ['mempelajari buku dan video panduan untuk mengetahui seluk beluk penggunaan aplikasi ini secara utuh di sekolahnya', 5],
                ],
            ],
            // --- Soal 89 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Uang digital dipercaya dapat menjadi alternatif pengganti mata uang konvensional. Dani adalah seorang pekerja di divisi pengembangan bisnis yang baru masuk ke industri uang digital. Apa tindakan Dani?',
                'explanation' => 'Kunci bobot: 52143',
                'options' => [
                    ['Mengumpulkan, memilah, dan mengevaluasi informasi terkait uang digital dengan apa yang dibutuhkan rekan kerja', 5],
                    ['Menganalisis sampai sejauh mana informasi terkait uang digital sudah menyentuh lingkungan pertemanan kemudian mendiskusikannya', 2],
                    ['Mengumpulkan informasi dan mempelajari bagaimana uang digital dapat membawa manfaat positif.', 1],
                    ['Mengumpulkan informasi dari sumber terpercaya mengenai hal itu karena harus selalu siap dengan perkembangan zaman.', 4],
                    ['Memperhatikan regulasi dan perangkat hukum yang berlaku karena uang digital sangat rawan melanggar regulasi pemerintah.', 3],
                ],
            ],
            // --- Soal 90 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda memiliki pengalaman yang kurang baik terkait dengan TI. Namun, hari ini Anda mendengar bahwa pimpinan meminta Anda untuk mengaktifkan kembali penggunaan teknologi informasi. Apa yang akan Anda lakukan ketika menemui situasi seperti ini?',
                'explanation' => 'Kunci bobot: 41352',
                'options' => [
                    ['Menjalankan instruksi pimpinan dan belajar dari pengalaman sebelumnya.', 4],
                    ['Menolak instruksi pimpinan demi keamanan informasi di kantor karena kesalahan dapat terulang', 1],
                    ['Meminta pimpinan untuk mempersiapkan infrastruktur sebelum mengaktifkan penggunaan TI', 3],
                    ['Mengikuti instruksi pimpinan setelah semua lini memiliki kesiapan untuk menerapkan kembali.', 5],
                    ['Secara halus menolak instruksi pimpinan karena adanya pengalaman yang kurang baik', 2],
                ],
            ],
            // --- Soal 91 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Grup media sosial dengan anggota, baik pimpinan maupun karyawan, mulai banyak digunakan untuk tujuan resmi, yaitu berkomunikasi dalam pekerjaan. Sangat banyak informasi bisa dibagikan dalam satu hari saja, sedangkan Ratna masih sangat awam dengan teknologi. Apa yang seharusnya dilakukan oleh Ratna?',
                'explanation' => 'Kunci bobot: 43152',
                'options' => [
                    ['Mencari tutorial melalui situs yang dipahami untuk mendapatkan cara pemanfaatan media sosial lebih baik.', 4],
                    ['Berdiskusi dengan rekan lain untuk mencari cara sehingga dapat memanfaatkannya dalam pekerjaan', 3],
                    ['Membatasi akses ke media sosial karena sudah terlalu banyak menggunakannya akibat pekerjaan', 1],
                    ['Turut memanfaatkan media sosial untuk mendapatkan informasi terkait pekerjaan alih-alih mengunggah informasi', 5],
                    ['Apabila diminta, berusaha menggunakan cara sederhana yang diketahui saja untuk mengunggah informasi', 2],
                ],
            ],
            // --- Soal 92 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Brigita bekerja sebagai staf teknologi di klinik layanan kesehatan. Ia memegang puluhan ribu data pasien di pusat data sentral. Akhir-akhir ini sedang marak terjadi kebocoran data pasien. Apa yang Brigita lakukan?',
                'explanation' => 'Kunci bobot: 43215',
                'options' => [
                    ['Mengusulkan kepada manajemen klinik untuk membuat prosedur pengamanan data seluruh sistem', 4],
                    ['Menggunakan pusat data sentral seperti biasa karena yakin akan keamanan sistem data yang ada.', 3],
                    ['Menutup sistem data di pusat apabila terjadi kebocoran data kerabat yang berobat ke klinik', 2],
                    ['Menutup sistem data di pusat apabila terjadi kebocoran data ratusan pasien klinik', 1],
                    ['Meminta rekan staf di bidang teknologi untuk melakukan enkripsi agar tidak terjadi kebocoran data', 5],
                ],
            ],
            // --- Soal 93 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Perusahaan saat ini diharuskan mengembangkan informasi berbasis dalam jaringan untuk meningkatkan citra perusahaan. Dini adalah satu-satunya staf yang memiliki seluruh data perusahaan dan memegang kata sandi untuk dapat mengakses data tersebut. Bagaimana sikap Dini terkait dengan hal tersebut?',
                'explanation' => 'Kunci bobot: 12435',
                'options' => [
                    ['Menghentikan penggunaan media tersebut saat menyinggung penyalahgunaan data pribadi para karyawan oleh pihak lain.', 1],
                    ['Mengingatkan rekan kerja untuk menghentikan akses ke dalam jaringan tersebut karena berpotensi terjadi kebocoran data.', 2],
                    ['Memberikan kata sandi untuk mengakses aplikasi dalam jaringan tersebut kepada rekan kerja lain agar bisa membantu pekerjaannya.', 4],
                    ['Menghentikan akses ke dalam jaringan tersebut saat mengetahui data pribadinya bisa dilihat oleh pihak ketiga.', 3],
                    ['Mencari jaringan lain yang lebih aman untuk menyimpan data karyawan dan membuat laman perusahaan lebih efektif', 5],
                ],
            ],
            // --- Soal 94 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Budi sebagai staf TI fakultas ditawari program pengelola sistem akademik yang harganya lebih murah daripada biasa. Namun, program tersebut merupakan versi uji coba sehingga harganya murah. Apa yang akan Budi lakukan?',
                'explanation' => 'Kunci bobot: 51324',
                'options' => [
                    ['Budi meminta pimpinan fakultas mengkaji kelebihan dan kelemahan program', 5],
                    ['Budi mengajak rekan-rekan untuk menolak program tersebut karena merugikan', 1],
                    ['Program akan digunakan jika potensi mengalami kerusakan kecil.', 3],
                    ['Budi akan menghentikan program tersebut jika terbukti merugikan', 2],
                    ['Tetap menganjurkan penggunaan karena harga murah dan fitur bermanfaat', 4],
                ],
            ],
            // --- Soal 95 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Fitri diterima sebagai pegawai pemerintah. Fitri sangat bersemangat dan mulai merekam aktivitasnya. Suatu hari secara tidak sengaja dokumen rahasia terekam dan terunggah di akun media sosialnya. Fitri mendapatkan teguran atas hal itu. Apa sebaiknya yang Fitri lakukan?',
                'explanation' => 'Kunci bobot: 13245',
                'options' => [
                    ['Tidak perlu dibesar-besarkan karena hal seperti itu kadang terjadi dan orang lain pun tidak berkepentingan akan unggahan tersebut', 1],
                    ['Memilah dalam menggunakan media sosial karena dapat menjadi ancaman bagi Fitri maupun institusi tempat Fitri bekerja', 3],
                    ['Berhenti merekam dan mengunggah aktivitas pekerjaan di media sosial karena ternyata merugikan diri pribadi', 2],
                    ['Menjadikan pengalamannya itu sebagai pelajaran bagi rekan kerja untuk tidak sembarang merekam di tempat kerja.', 4],
                    ['Lebih berhati-hati mengunggah informasi dan mengajak instansi untuk membuat kebijakan mengenai unggah kegiatan di kantor', 5],
                ],
            ],
            // --- Soal 96 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Rina adalah tim suatu proyek unggulan. Dalam perjalanan proyek tersebut menghadapi banyak kendala. Hal itu menyebabkan hasil proyek kurang memuaskan. Beberapa rekannya memberikan usulan untuk mengatasi kendala tersebut. Apa yang sebaiknya dilakukan Rina?',
                'explanation' => 'Kunci bobot: 12354',
                'options' => [
                    ['Menyusun rancangan baru untuk memaksimalkan hasil akhir proyek tersebut.', 1],
                    ['Mencari tahu lebih dalam hal-hal yang perlu diperbaiki dalam proses kerja', 2],
                    ['Tetap melaksanakan proyek seperti rencana awal karena sudah hampir selesai', 3],
                    ['Rina akan mengajak anggota timnya berdiskusi dan bersama-sama menemukan solusi terbaik', 5],
                    ['Memodifikasi ide dari proyek lain saat menghadapi kendala yang sama dengan yang dihadapinya.', 4],
                ],
            ],
            // --- Soal 97 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Sebagai kepala biro Pak Yanto menerima pengaduan dari dua orang pegawai yang gagal dalam seleksi promosi jabatan. Mereka menilai terjadi penyimpangan dalam proses seleksi dan akan mengajukan kasus ini ke ranah hukum. Apa yang sebaiknya Pak Yanto lakukan?',
                'explanation' => 'Kunci bobot: 54123',
                'options' => [
                    ['Melakukan analisis dengan mempertimbangkan beberapa hal dan sudut pandang untuk mengambil keputusan dan memantau hasilnya.', 5],
                    ['Langsung mengoreksi keputusan hasil seleksi promosi jabatan berdasarkan laporan yang diterima agar konflik reda', 4],
                    ['Mempelajari kembali manual promosi jabatan untuk mengambil keputusan yang tepat berdasarkan dasar hukum tersebut.', 1],
                    ['Mempelajari berbagai aturan yang terkait dengan pengaduan karyawan tersebut sebagai dasar langkah tindak lanjut yang diambil', 2],
                    ['Mengambil keputusan cepat dengan mempertimbangkan kondisi yang mendesak dan konsekuensi atas keputusan yang diambil.', 3],
                ],
            ],
            // --- Soal 98 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Sebagai pengacara, Tito mendapat kasus A, B, dan C. Kasus B hanya memerlukan pendampingan untuk sidang kedua pada dua bulan mendatang. Sementara untuk kasus A dan C, Tito sangat membutuhkan tambahan data penting untuk sidang pertama bulan depan di pengadilan tinggi. Apa tindakan Tito dalam situasi ini?',
                'explanation' => 'Kunci bobot: 12543',
                'options' => [
                    ['Lebih tenang berfokus pada kasus B di pengadilan negeri yang telah dilengkapi dengan bahan keperluan sidang', 1],
                    ['Berkonsentrasi pada kasus A dan C yang masih membutuhkan data padahal jadwal persidangannya sudah dekat.', 2],
                    ['Mendampingi proses persidangan kasus A, B, dan C di lokasi masing-masing sesuai dengan urutan jadwal persidangannya.', 5],
                    ['Membentuk tim untuk segera menyiapkan data sesuai dengan keperluan penanganan kasus A dan C dan mempersiapkan diri untuk kasus B', 4],
                    ['Menjadwalkan dua jam per minggu untuk melengkapi data kasus A dan C sambil terus memantau proses persidangan kasus B', 3],
                ],
            ],
            // --- Soal 99 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Tugas Wartono adalah menyelesaikan pembelian dari petugas sebelumnya. Beberapa barang yang dibeli tidak sesuai sehingga pengadaan ditunda dan serapan anggaran menurun menjelang akhir tahun. Sementara itu, perintah pimpinan anggaran harus terserap 90% di akhir tahun ini sesuai rencana pengadaan. Apa yang seharusnya dilakukan Wartono?',
                'explanation' => 'Kunci bobot: 12345',
                'options' => [
                    ['Mengajukan protes ke pimpinan tentang rencana pembelian yang berantakan', 1],
                    ['Membuat rencana baru untuk pembelian dengan transaksi yang dipercepat', 2],
                    ['Mengevaluasi kembali rencana pengadaan dengan bagian-bagian yang memerlukan', 3],
                    ['Memeriksa barang-barang yang sudah dibeli jika mungkin dimanfaatkan lebih dulu.', 4],
                    ['Melanjutkan pembelian yang sudah terencana agar serapan anggaran meningkat', 5],
                ],
            ],
            // --- Soal 100 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Linda diberi tugas pimpinan untuk menyelesaikan laporan pertanggungjawaban kegiatan kantor dalam waktu yang singkat. Linda adalah manajer yang dapat dipercaya pimpinan untuk menyelesaikan laporan tersebut, sedangkan tugas Linda yang lain juga menumpuk. Apa yang akan Linda lakukan?',
                'explanation' => 'Kunci bobot: 32514',
                'options' => [
                    ['Sambil mengerjakan tugas utama kantor, sesekali mengoordinas bawahan untuk menyiapkan laporan', 3],
                    ['Merencanakan detail kegiatan dengan membagikan kegiatan penyusunan laporan kepada bawahan.', 2],
                    ['Berperan aktif dan kolaboratif dengan bawahannya untuk menyelesaikan laporan itu dengan baik.', 5],
                    ['Menyerahkan kegiatan laporan pertanggungjawaban kepada bawahan untuk segera diselesaikan', 1],
                    ['Membuat tim kecil untuk mengerjakan tugas sambil melihat perkembangan jika dibutuhkan', 4],
                ],
            ],
            // --- Soal 101 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anto dipromosikan sebagai kepala cabang kantornya setelah menunjukkan performa kerja yang memuaskan selama lima tahun bekerja. Ia dilantik pada akhir bulan Januari, sedangkan pada awal Maret, ia ditugasi untuk mengikuti konferensi ekonomi di Jepang. Apa yang dilakukan Anto sehingga ia dapat bekerja secara efektif sebelum berangkat ke Jepang?',
                'explanation' => 'Kunci bobot: 25143',
                'options' => [
                    ['Menyelesaikan semua pekerjaan lebih awal agar tidak ada yang terbengkalai selama dia mengikuti konferensi di Jepang', 2],
                    ['Membuat prosedur operasional standar yang dapat digunakan bawahannya meskipun dia mengikuti konferensi di Jepang', 5],
                    ['Tetap bekerja seperti biasanya dan akan membawa pekerjaan yang belum terselesaikan selama berada di Jepang', 1],
                    ['Mendelegasikan pekerjaan kepada para staf sejak ia masih di Indonesia hingga saat dia mengikuti konferensi di Jepang', 4],
                    ['Mempersiapkan beberapa staf yang potensial untuk menjadi pelaksana tugas selama dia mengikuti konferensi di Jepang', 3],
                ],
            ],
            // --- Soal 102 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di unit Wahyu terjadi persaingan yang tidak sehat di antara para petugas pemasaran yang cenderung menggunakan cara yang tidak adil untuk mengejar bonus. Hal itu terdengar ke telinga manajemen dan membuatnya malu. Apa yang sebaiknya Wahyu lakukan sebagai kepala unit pemasaran?',
                'explanation' => 'Kunci bobot: 35241',
                'options' => [
                    ['Memantau langsung kinerja para pemasar untuk memastikan target penjualan tercapai dengan cara positif', 3],
                    ['Memberikan umpan balik pada para pemasar tentang pentingnya kerja sama tim serta berkompetisi secara sehat, terbuka, dan adil.', 5],
                    ['Membangun kerja sama antar-pemasar dengan menunjukkan kemampuan terbaik dalam menjual produk melalui kompetisi yang sehat.', 2],
                    ['Meminta pemasar senior di unitnya untuk memberikan pembekalan dan pengarahan agar pemasar bekerja secara jujur dan sportif', 4],
                    ['Mengadakan pertemuan berkala untuk memfasilitasi para pemasar bertukar pengalaman sehingga tim menjadi makin kompak dan produktif.', 1],
                ],
            ],
            // --- Soal 103 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Fredi adalah seorang pegawai kantor pusat di Jakarta. Ia dipindahkan ke kantor cabang yang dianggap bermasalah karena sering terjadi konflik di sana. Hal itu membuat proses bisnis perusahaan secara keseluruhan terganggu. Tindakan apa yang sebaiknya dilakukan Fredi?',
                'explanation' => 'Kunci bobot: 12345',
                'options' => [
                    ['Menghindari konflik dan menjalankan aktivitas yang sama seperti yang dilakukan di kantor pusat.', 1],
                    ['Mencari informasi terkait penyebab konflik di unit kerja yang baru.', 2],
                    ['Berdiskusi dengan rekan kerja untuk mengakhiri konflik yang sering terjadi', 3],
                    ['Membuat rencana untuk menyelesaikan berbagai masalah yang terjadi di kantor cabang', 4],
                    ['Melakukan mediasi dan membangun komunikasi yang sehat antaranggota di kantor cabang.', 5],
                ],
            ],
            // --- Soal 104 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Setiap kelompok kerja di kelas, Dani diberikan kesempatan untuk pulang lebih awal jika lebih dulu menyelesaikan tugas. Dani melihat perlu segera pulang karena ada acara di rumah. Agar kelompoknya mendapatkan kesempatan pulang lebih awal, apakah yang dapat dilakukan oleh Dani?',
                'explanation' => 'Kunci bobot: 12543',
                'options' => [
                    ['Kelompoknya harus unggul dengan cara apapun', 1],
                    ['Berusaha tidak berkonflik dengan kelompok lain.', 2],
                    ['Mengajak kelompok untuk bekerja dengan cepat dan jujur.', 5],
                    ['Meski ingin pulang duluan, tetapi Dani berusaha bekerja jujur', 4],
                    ['Suasana kelas yang bersahabat lebih penting daripada kompetisi', 3],
                ],
            ],
            // --- Soal 105 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Tono, teman seangkatan Anda, sering mengkritik bentuk negara NKRI. Akhir-akhir ini ia semakin sering mengajak berbicara Anda dan teman-teman lain untuk menyebarkan gagasan mengenai suatu bentuk negara tertentu untuk mengganti NKRI. Apa yang Anda lakukan?',
                'explanation' => 'Kunci bobot: 24135',
                'options' => [
                    ['Tidak menanggapi Tono karena percaya NKRI adalah bentuk final dan terbaik negara Indonesia yang tidak boleh disangsikan lagi.', 2],
                    ['Berbicara dengan Tono guna menyampaikan bahwa menyebarkan gagasan seperti yang dilakukannya itu melanggar hukum', 4],
                    ['Merasa khawatir jika Tono menyebarluaskan gagasannya kepada banyak orang di luar sana yang mungkin akan terpengaruh', 1],
                    ['Berusaha menghentikan pemikiran Tono karena jangan sampai mempengaruhi orang banyak.', 3],
                    ['Memperingatkan Tono dan mengajak berdiskusi teman-teman agar mereka tidak mudah dipengaruhi oleh ideologi tersebut', 5],
                ],
            ],
            // --- Soal 106 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Terjadi sebuah bencana alam di daerah A dan kemudian banyak pihak mengirim bantuan kemanusiaan ke sana. Sayangnya, tidak semua bantuan sampai kepada warga yang membutuhkan karena ada bantuan yang hanya ditujukan kepada kelompok tertentu. Melihat kondisi tersebut apa yang akan Anda lakukan?',
                'explanation' => 'Kunci bobot: 54123',
                'options' => [
                    ['Meminta kepada semua pihak yang menyalurkan bantuan agar untuk mengoordinasikan pemberian bantuan di bawah BNPB.', 5],
                    ['Mendukung BNPB untuk mengelola penyaluran bantuan agar tepat sasaran dan merata.', 4],
                    ['Menyayangkan kejadian tersebut karena seharusnya bantuan disalurkan secara merata meskipun jumlahnya sedikit', 1],
                    ['Memaklumi skala prioritas penyaluran bantuan dari setiap penyumbang', 2],
                    ['Menganggap hal tersebut bisa diselesaikan jika jumlah bantuan yang datang lebih banyak', 3],
                ],
            ],
            // --- Soal 107 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Ketua RT di lingkungan Anda tinggal mengundurkan diri karena sakit sehingga dilakukan pemilihan pada pertemuan yang akan dilakukan tiga hari lagi. Anda disebut-sebut sebagai salah satu kandidat, tetapi kesibukan kerja Anda sangat tinggi. Apa yang akan Anda lakukan?',
                'explanation' => 'Kunci bobot: 13245',
                'options' => [
                    ['Saya belum siap untuk berperan di masyarakat karena tanggung jawab tugas saya yang besar dalam pekerjaan', 1],
                    ['Saya akan menerima jika saya diminta untuk mengemban tanggung jawab itu', 3],
                    ['Meskipun saya tidak bersedia untuk dipilih, saya akan menghadiri kegiatan tersebut.', 2],
                    ['Saya akan datang untuk mengikuti kegiatan pemilihan tersebut dan menyerahkan keputusan pada proses pemilihan', 4],
                    ['Saya akan datang dan mendorong warga yang lain untuk memilih ketua RT yang paling siap dari sisi kemampuan dan waktu.', 5],
                ],
            ],
            // --- Soal 108 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Selepas lulus kuliah, Anda bergabung dengan sebuah tim riset lepas dan dikirim ke daerah untuk penelitian. Belakangan Anda sadar bahwa proyek ini menjadi kendaraan untuk sebuah misi rahasia menanamkan paham radikal kepada penduduk setempat. Apa yang Anda lakukan?',
                'explanation' => 'Kunci bobot: 13245',
                'options' => [
                    ['Meskipun tahu ini salah, sebaiknya saya tetap menjalankan tugas yang diberikan kepada saya demi keselamatan saya pribadi', 1],
                    ['Lebih baik segera mengundurkan diri dari pekerjaan ini daripada saya harus terlibat dalam penyebaran paham radikal', 3],
                    ['Saya akan menyelesaikan program ini dengan secepatnya dan kemudian mengundurkan diri agar tidak terlibat lebih jauh', 2],
                    ['Langsung mengundurkan diri dan menyampaikan kepada atasan bahwa program ini membahayakan dan sebaiknya diakhiri', 4],
                    ['Mengajak kawan saya untuk menyampaikan keberatan kepada atasan dan mempertanyakan tujuan sebenarnya proyek ini', 5],
                ],
            ],
            // --- Soal 109 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Indah sangat aktif menggunakan media sosial. Indah mendapati sebagian besar warganet yang berkomentar menuliskan kalimat negatif dan menambahi dengan pendapat-pendapat pribadi yang bersifat memojokkan subjek beritanya. Apa yang harus dilakukan oleh Indah?',
                'explanation' => 'Kunci bobot: 42153',
                'options' => [
                    ['Membuat akun media sosial dengan tujuan edukasi kepada khalayak agar lebih toleran', 4],
                    ['Ikut berkomentar karena berita yang sedang dibicarakan merupakan berita terkini', 2],
                    ['Membenarkan berita tersebut dan membagikan kepada teman-temannya yang lain.', 1],
                    ['Membuka platform berita yang lain dengan topik yang sama untuk mencari kebenarannya', 5],
                    ['Mengumpulkan sumber berita untuk pembanding', 3],
                ],
            ],
            // --- Soal 110 ---
            [
                'material_id' => 33,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Reni merupakan orang yang diandalkan untuk menyelesaikan salah satu tugas penting di dalam tim agar mereka mendapatkan bonus. Namun, Reni merasa ketua tim memanfaatkan dia untuk menyelesaikan semua tugas. Apakah yang dilakukan Reni?',
                'explanation' => 'Kunci bobot: 25413',
                'options' => [
                    ['Menghadap ketua tim untuk menjelaskan apa yang ia rasakan dan mencari solusi Bersama', 2],
                    ['Meminta teman lain mengerjakan tugas yang diberikan dan hanya mengerjakan tanggung jawab utamanya', 5],
                    ['Meminta ketua tim mendiskusikan dan mengatur ulang pembagian kerja di tim', 4],
                    ['Menyampaikan secara terbuka kepada ketua tim apa yang ia rasakan', 1],
                    ['Memprotes keputusan ketua tim karena melakukan sesuatu yang tidak adil ketika memimpin', 3],
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
                    'is_correct' => 0, // TKP selalu 0
                    'order' => $order++,
                    'weight' => $option[1],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder untuk TKP Paket 3 (45 soal) berhasil ditambahkan.');
    }
}
