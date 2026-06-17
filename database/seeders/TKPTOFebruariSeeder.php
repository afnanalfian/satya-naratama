<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TKPTOFebruariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk kategori 8 (TRYOUT SKD FEBRUARI) - soal TKP lengkap 45 soal
        $materialTKP = QuestionMaterial::create([
            'category_id' => 8,
            'name' => 'TKP',
            'slug' => 'tkp-full',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 1-45 untuk TKP
        $questionsTKP = [
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Akibat gangguan di pusat data nasional, beberapa layanan daring di instansi Anda tidak bisa diakses, termasuk layanan perpanjangan izin usaha online. Di loket informasi, warga mengeluh karena mereka sudah terlanjur menutup usaha sementara untuk mengurus perpanjangan izin. Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: D C A E B</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Mencerminkan pelayanan publik ideal TKP: empatik, transparan, komunikatif, dan memberi solusi konkret tanpa melampaui kewenangan. Fokus pada perlindungan hak warga dan keberlanjutan layanan.<br><br>
                <strong>• C – Poin 4</strong><br>
                Sudah proaktif dan bertanggung jawab dengan pencatatan serta koordinasi internal, namun solusi kepada warga masih bersifat tidak langsung.<br><br>
                <strong>• A – Poin 3</strong><br>
                Komunikasi dan empati ada, tetapi sikap masih menunggu tanpa inisiatif solusi bagi warga terdampak.<br><br>
                <strong>• E – Poin 2</strong><br>
                Tetap melayani dan mengarahkan secara formal, namun pendekatannya administratif dan kurang responsif terhadap urgensi kebutuhan warga.<br><br>
                <strong>• B – Poin 1</strong><br>
                Informasi disampaikan, tetapi lebih berorientasi pada efisiensi internal daripada kebutuhan dan kondisi warga yang dirugikan.',
                'options' => [
                    ['option_text' => 'Menyampaikan permohonan maaf atas gangguan yang terjadi, menjelaskan situasi secara ringkas, serta meminta warga bersabar sambil menunggu pemulihan sistem dari pusat.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Menjelaskan bahwa gangguan berasal dari pusat data nasional, lalu mengarahkan warga untuk memantau informasi resmi melalui kanal daring instansi agar tidak datang berulang kali.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menjelaskan kondisi gangguan secara terbuka, mencatat kebutuhan warga yang terdampak, serta berkoordinasi dengan atasan untuk menyiapkan mekanisme sementara agar proses administrasi tetap terdokumentasi.', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Memberikan penjelasan lengkap kepada warga, menunjukkan dasar informasi resmi, serta menawarkan solusi sementara seperti pencatatan manual/daftar prioritas agar hak warga tetap terlindungi meski sistem belum pulih.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Menyarankan warga menyampaikan pengaduan tertulis agar dapat diteruskan ke instansi teknis terkait, sambil tetap melayani pertanyaan secara bergantian di loket.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Pemerintah sedang menyalurkan bantuan sosial yang datanya diambil dari data terpadu kesejahteraan. Seorang warga datang marah-marah karena merasa sangat berhak menerima bantuan, tetapi namanya tidak ada di daftar penerima. Ia menuduh petugas "pilih kasih" dan menerima "titipan".<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B A C D E</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Menggabungkan empati, transparansi, dan solusi prosedural resmi yang menjaga keadilan serta akuntabilitas bantuan sosial.<br><br>
                <strong>• A – Poin 4</strong><br>
                Memberi penjelasan benar dan menenangkan, tetapi belum cukup membantu secara langsung.<br><br>
                <strong>• C – Poin 3</strong><br>
                Profesional dan jujur, namun sangat kaku dan minim pelayanan.<br><br>
                <strong>• D – Poin 2</strong><br>
                Mengarah ke jalur informal yang rawan ketidakadilan.<br><br>
                <strong>• E – Poin 1</strong><br>
                Tidak menjamin tindak lanjut dan melemahkan akuntabilitas.',
                'options' => [
                    ['option_text' => 'Menjelaskan bahwa data berasal dari sistem nasional dan mengajak warga mengikuti evaluasi data berikutnya.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menenangkan warga, lalu menawarkan mekanisme pengaduan resmi dan pembaruan data sambil menjelaskan alur serta perkiraan waktunya.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Menyampaikan bahwa petugas lapangan tidak berwenang mengubah daftar penerima.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Mengarahkan warga berdiskusi dengan perangkat desa agar dapat diperjuangkan pada penyaluran berikutnya.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Mencatat keluhan warga secara internal agar tidak terulang, tanpa melibatkan proses formal.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Puskesmas tempat Anda bekerja mulai menerapkan layanan kesehatan terintegrasi dengan NIK dan aplikasi digital. Seorang pasien muda mengeluh karena antrean menjadi lebih lama akibat input data, dan berkata, "Kalau pakai aplikasi malah makin ribet, mending manual saja!" Sikap Anda yang paling tepat sebagai petugas adalah ....',
                'explanation' => '<strong>Jawaban: C D B A E</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Menggabungkan empati, edukasi kebijakan, dan upaya nyata menjaga kualitas layanan saat masa transisi.<br><br>
                <strong>• D – Poin 4</strong><br>
                Solusi praktis jangka pendek, meski tidak menyentuh substansi perubahan sistem.<br><br>
                <strong>• B – Poin 3</strong><br>
                Responsif terhadap keluhan, tetapi kurang komunikatif kepada pasien.<br><br>
                <strong>• A – Poin 2</strong><br>
                Normatif dan minim empati.<br><br>
                <strong>• E – Poin 1</strong><br>
                Kaku dan tidak berorientasi pelayanan.',
                'options' => [
                    ['option_text' => 'Menyampaikan bahwa semua perubahan butuh waktu adaptasi dan meminta pasien bersabar.', 'weight' => 2, 'order' => 1],
                    ['option_text' => 'Mengakui keluhan pasien sebagai masukan dan akan menyampaikannya ke pimpinan.', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Menjelaskan manfaat sistem baru, meminta maaf atas ketidaknyamanan, dan berupaya mempercepat input data.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Menyarankan pasien datang di jam yang lebih sepi.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Menegaskan bahwa kebijakan digitalisasi harus dijalankan apa pun kondisinya.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam proses PPDB online, banyak orang tua datang ke sekolah karena kebingungan dengan sistem zonasi dan unggah berkas. Seorang orang tua memaksa agar berkas anaknya diterima saja secara manual tanpa lewat sistem, dengan alasan takut "ketinggalan" dan kuota habis. Sikap Anda sebagai petugas front office adalah ....',
                'explanation' => '<strong>Jawaban: A C E B D</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menjaga integritas sistem PPDB sekaligus memberi bantuan konkret dan empatik agar hak anak tetap terlindungi.<br><br>
                <strong>• C – Poin 4</strong><br>
                Masih memberi alternatif solusi, meskipun tanggung jawab pelayanan tidak sepenuhnya diambil.<br><br>
                <strong>• E – Poin 3</strong><br>
                Memberi arahan prosedural, tetapi kurang membantu pada situasi mendesak.<br><br>
                <strong>• B – Poin 2</strong><br>
                Berniat menolong, namun melanggar prosedur dan membuka potensi ketidakadilan.<br><br>
                <strong>• D – Poin 1</strong><br>
                Taat aturan tetapi sama sekali tidak berorientasi pelayanan dan empati.',
                'options' => [
                    ['option_text' => 'Menjelaskan kembali bahwa seluruh pendaftaran wajib melalui sistem online, lalu menawarkan pendampingan langsung di ruang komputer sekolah untuk membantu proses unggah berkas.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menerima saja berkas manual orang tua tersebut untuk "diamankan dulu", nanti Anda masukkan diam-diam ke sistem.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Menyuruh orang tua mencari jasa warnet atau pihak ketiga, karena Anda tidak ingin bertanggung jawab jika salah input.', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Menyarankan orang tua menunggu pengumuman akhir saja; kalau tidak lolos, baru mengurus ke sekolah lain.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menolak dengan tegas tanpa menawarkan bantuan apa pun, karena aturan sudah jelas online.', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam proses verifikasi bantuan pendidikan, seorang warga menghubungi nomor layanan WhatsApp resmi dinas dan diminta oleh petugas piket lain (sebelumnya) untuk mengirim foto KTP dan Kartu Keluarga ke nomor pribadi petugas tersebut "agar lebih cepat dicek". Warga kemudian ragu dan menanyakan kepada Anda apakah itu aman.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A D B C E</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menegakkan perlindungan data pribadi dan kanal resmi, sekaligus memberi solusi praktis.<br><br>
                <strong>• D – Poin 4</strong><br>
                Mengajak datang langsung lebih aman, tetapi tidak sekaligus mengedukasi soal keamanan data.<br><br>
                <strong>• B – Poin 3</strong><br>
                Menenangkan warga, tetapi mengabaikan prinsip perlindungan data.<br><br>
                <strong>• C – Poin 2</strong><br>
                Tidak bertanggung jawab dan membiarkan potensi risiko.<br><br>
                <strong>• E – Poin 1</strong><br>
                Mengabaikan peran pelayanan publik.',
                'options' => [
                    ['option_text' => 'Menjelaskan bahwa seluruh pengiriman dokumen pribadi seharusnya hanya melalui kanal resmi, dan menyarankan warga tidak mengirim ke nomor pribadi, lalu membantu memberi jalur resmi pengunggahan berkas.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menenangkan warga bahwa selama itu petugas dinas, tidak masalah mengirim dokumen ke nomor pribadi karena untuk keperluan verifikasi.', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Mengatakan bahwa Anda tidak tahu prosedur tersebut dan menyarankan warga mengikuti saja instruksi petugas sebelumnya.', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Meminta warga datang langsung ke kantor tanpa menjelaskan masalah keamanan data, karena itu urusan internal.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Mengabaikan pertanyaan warga, karena tidak ingin terlibat dalam urusan yang sudah ditangani petugas lain.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di kecamatan, Anda menjadi narahubung warga terkait informasi awal pemindahan sebagian kantor pusat kementerian ke ibu kota baru. Seorang warga bertanya dengan nada khawatir, "Kalau ASN pindah, apakah pelayanan di sini akan berkurang? Kami takut malah jadi makin sulit mengurus apa-apa."<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B D C A E</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Berbasis informasi resmi, menenangkan warga secara faktual, dan menyalurkan aspirasi.<br><br>
                <strong>• D – Poin 4</strong><br>
                Hati-hati dan tidak spekulatif, tetapi kurang informatif.<br><br>
                <strong>• C – Poin 3</strong><br>
                Jujur, namun pasif.<br><br>
                <strong>• A – Poin 2</strong><br>
                Memberi kepastian tanpa dasar.<br><br>
                <strong>• E – Poin 1</strong><br>
                Menghindari tugas pelayanan informasi.',
                'options' => [
                    ['option_text' => 'Menenangkan warga dengan memastikan tidak akan ada perubahan apa pun.', 'weight' => 2, 'order' => 1],
                    ['option_text' => 'Menjelaskan berdasarkan informasi resmi bahwa layanan daerah tetap berjalan dan mencatat aspirasi warga.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Menyatakan bahwa Anda belum tahu detail kebijakan tersebut.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menyarankan warga menunggu karena kebijakan masih berkembang.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Mengalihkan pembicaraan agar tidak menimbulkan keresahan.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Hasil survei internal menunjukkan bahwa:<br><br>• 60% warga merasa terbantu dengan adanya layanan online (aplikasi/website),<br>• tetapi 40% responden berusia di atas 55 tahun lebih memilih layanan tatap muka karena merasa kesulitan menggunakan perangkat digital.<br><br>Pimpinan meminta saran awal dari Anda sebagai staf pelayanan.<br><br>Tindakan awal yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C B A D E</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Menggunakan data survei secara seimbang: memaksimalkan digital tapi tetap inklusif untuk lansia dengan pendampingan.<br><br>
                <strong>• B – Poin 4</strong><br>
                Niat baik, tetapi terlalu luas dan belum realistis tanpa perencanaan sumber daya.<br><br>
                <strong>• A – Poin 3</strong><br>
                Melindungi kelompok yang kesulitan, tapi mengorbankan 60% warga yang sudah terbantu layanan online.<br><br>
                <strong>• D – Poin 2</strong><br>
                Mengabaikan data tanpa analisis lebih lanjut.<br><br>
                <strong>• E – Poin 1</strong><br>
                Memaksa warga tanpa mempertimbangkan kemampuan dan akses, sangat tidak inklusif.',
                'options' => [
                    ['option_text' => 'Mengusulkan penghentian layanan online karena masih banyak warga yang kesulitan, dan fokus saja pada layanan tatap muka.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Mengusulkan pelatihan digital untuk seluruh warga di balai desa, meski belum ada anggaran dan fasilitas yang jelas.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Mengusulkan kombinasi: mempertahankan dan meningkatkan layanan online, sekaligus menyediakan helpdesk khusus/pendampingan di loket bagi kelompok rentan (lansia) yang datang langsung, berdasarkan hasil survei tersebut.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Mengabaikan hasil survei karena jumlah responden dianggap belum mewakili seluruh warga.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Mengusulkan agar layanan tatap muka dihapus secara bertahap untuk memaksa warga beralih ke layanan digital.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Pemerintah pusat mendorong percepatan penurunan stunting melalui integrasi data kesehatan, bantuan sosial, dan sanitasi. Di daerah Anda, program sudah berjalan, tetapi koordinasi antarinstansi (dinas kesehatan, dinas sosial, desa, dan puskesmas) sering tidak sinkron. Masing-masing instansi merasa sudah bekerja sesuai tugasnya, namun data sasaran berbeda dan warga bingung harus melapor ke mana.<br><br>Sebagai ASN yang ditunjuk sebagai koordinator teknis lapangan, sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A B D E C</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menginisiasi forum koordinasi rutin lintas instansi untuk menyepakati satu basis data sasaran stunting, alur layanan yang jelas, serta mekanisme pelaporan terpadu bagi masyarakat.<br><br>
                <strong>• B – Poin 4</strong><br>
                Menghimpun seluruh data dari masing-masing instansi, lalu menyusunnya kembali menjadi laporan terpadu sebagai bahan evaluasi internal pemerintah daerah.<br><br>
                <strong>• D – Poin 3</strong><br>
                Fokus memperkuat peran puskesmas sebagai pusat layanan stunting karena puskesmas paling dekat dengan masyarakat dan memahami kondisi kesehatan warga.<br><br>
                <strong>• E – Poin 2</strong><br>
                Mengarahkan masyarakat untuk mengikuti jalur pelaporan yang sudah ditetapkan oleh desa agar tidak terjadi tumpang tindih laporan antarinstansi.<br><br>
                <strong>• C – Poin 1</strong><br>
                Meminta setiap instansi tetap menjalankan tugas sesuai kewenangannya sambil melaporkan kendala koordinasi kepada pimpinan daerah untuk ditindaklanjuti.',
                'options' => [
                    ['option_text' => 'Menginisiasi forum koordinasi rutin lintas instansi untuk menyepakati satu basis data sasaran stunting, alur layanan yang jelas, serta mekanisme pelaporan terpadu bagi masyarakat.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menghimpun seluruh data dari masing-masing instansi, lalu menyusunnya kembali menjadi laporan terpadu sebagai bahan evaluasi internal pemerintah daerah.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Meminta setiap instansi tetap menjalankan tugas sesuai kewenangannya sambil melaporkan kendala koordinasi kepada pimpinan daerah untuk ditindaklanjuti.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Fokus memperkuat peran puskesmas sebagai pusat layanan stunting karena puskesmas paling dekat dengan masyarakat dan memahami kondisi kesehatan warga.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Mengarahkan masyarakat untuk mengikuti jalur pelaporan yang sudah ditetapkan oleh desa agar tidak terjadi tumpang tindih laporan antarinstansi.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Pemerintah pusat meminta daerah mempercepat pematukhiran data penerima bantuan berbasis NIK. Di daerah Anda, dinas sosial, dinas kependudukan, dan pemerintah desa sering saling menyalahkan ketika data tidak sinkron, sementara warga terus mendesak kejelasan.<br><br>Sebagai ASN yang ditugaskan membantu koordinasi, sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: D B E A C</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Mengusulkan pembentukan tim kecil lintas instansi yang bertugas memverifikasi data NIK prioritas secara bertahap dan menyepakati rujukan data yang digunakan bersama.<br><br>
                <strong>• B – Poin 4</strong><br>
                Mengambil peran sebagai penghubung teknis dengan menyelaraskan data NIK yang ada melalui diskusi terbatas, sekaligus membantu menyusun kesepakatan kerja agar kesalahan serupa tidak berulang.<br><br>
                <strong>• E – Poin 3</strong><br>
                Mendorong pemerintah desa untuk menyesuaikan data warganya dengan data dinas kependudukan agar tidak terjadi perbedaan saat penyaluran bantuan.<br><br>
                <strong>• A – Poin 2</strong><br>
                Memastikan setiap instansi menyampaikan pembaruan data sesuai jadwal yang telah ditetapkan sambil mencatat perbedaan data yang muncul untuk ditindaklanjuti kemudian.<br><br>
                <strong>• C – Poin 1</strong><br>
                Menyampaikan kepada warga bahwa proses pematukhiran data membutuhkan waktu karena melibatkan beberapa instansi, sembari menunggu hasil final dari pemerintah daerah.',
                'options' => [
                    ['option_text' => 'Memastikan setiap instansi menyampaikan pembaruan data sesuai jadwal yang telah ditetapkan sambil mencatat perbedaan data yang muncul untuk ditindaklanjuti kemudian.', 'weight' => 2, 'order' => 1],
                    ['option_text' => 'Mengambil peran sebagai penghubung teknis dengan menyelaraskan data NIK yang ada melalui diskusi terbatas, sekaligus membantu menyusun kesepakatan kerja agar kesalahan serupa tidak berulang.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Menyampaikan kepada warga bahwa proses pematukhiran data membutuhkan waktu karena melibatkan beberapa instansi, sembari menunggu hasil final dari pemerintah daerah.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mengusulkan pembentukan tim kecil lintas instansi yang bertugas memverifikasi data NIK prioritas secara bertahap dan menyepakati rujukan data yang digunakan bersama.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Mendorong pemerintah desa untuk menyesuaikan data warganya dengan data dinas kependudukan agar tidak terjadi perbedaan saat penyaluran bantuan.', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam penanganan banjir, BPBD, dinas PU, relawan, dan aparat desa sama-sama turun ke lapangan. Namun di hari pertama bencana, distribusi logistik tumpang tindih dan ada wilayah yang terlewat.<br><br>Sebagai ASN yang ditugaskan di posko utama, tindakan Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: E C A D B</strong><br><br>
                <strong>• E – Poin 5</strong><br>
                Menyusun pemetaan cepat wilayah terdampak bersama perwakilan tiap unsur di posko, lalu menyesuaikan kembali distribusi logistik secara terkoordinasi.<br><br>
                <strong>• C – Poin 4</strong><br>
                Membagi wilayah terdampak ke dalam sektor-sektor kecil dan menugaskan masing-masing pihak fokus pada sektor tertentu berdasarkan kapasitasnya.<br><br>
                <strong>• A – Poin 3</strong><br>
                Mengarahkan setiap pihak untuk melaporkan kegiatan distribusi yang telah dilakukan agar posko memiliki gambaran wilayah yang sudah dan belum terjangkau.<br><br>
                <strong>• D – Poin 2</strong><br>
                Meminta BPBD sebagai leading sector untuk mengambil alih sepenuhnya pengaturan distribusi agar tidak terjadi tumpang tindih antarpetugas.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menunggu laporan lengkap dari lapangan sebelum mengubah pola distribusi agar keputusan yang diambil tidak menimbulkan kebingungan baru.',
                'options' => [
                    ['option_text' => 'Mengarahkan setiap pihak untuk melaporkan kegiatan distribusi yang telah dilakukan agar posko memiliki gambaran wilayah yang sudah dan belum terjangkau.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Menunggu laporan lengkap dari lapangan sebelum mengubah pola distribusi agar keputusan yang diambil tidak menimbulkan kebingungan baru.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Membagi wilayah terdampak ke dalam sektor-sektor kecil dan menugaskan masing-masing pihak fokus pada sektor tertentu berdasarkan kapasitasnya.', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Meminta BPBD sebagai leading sector untuk mengambil alih sepenuhnya pengaturan distribusi agar tidak terjadi tumpang tindih antarpetugas.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menyusun pemetaan cepat wilayah terdampak bersama perwakilan tiap unsur di posko, lalu menyesuaikan kembali distribusi logistik secara terkoordinasi.', 'weight' => 5, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Program digitalisasi layanan perizinan daerah mengharuskan kerja sama dengan dinas lain dan penyedia sistem pusat. Dalam pelaksanaan, tiap pihak berjalan sendiri-sendiri karena merasa sudah "sesuai tupoksi".<br><br>Sebagai ASN anggota tim implementasi, sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C A E D B</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Mengusulkan pembahasan teknis terbatas untuk mengidentifikasi titik temu antarproses kerja, sekaligus menyepakati mekanisme koordinasi selama implementasi berlangsung.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menyelaraskan kembali tahapan kerja dengan memahami proses masing-masing pihak, lalu menyusun kesepakatan teknis agar integrasi sistem dapat berjalan tanpa saling tumpang tindih.<br><br>
                <strong>• E – Poin 3</strong><br>
                Meminta setiap pihak mendokumentasikan progres pekerjaannya agar mudah diketahui bagian mana yang sudah dan belum terintegrasi.<br><br>
                <strong>• D – Poin 2</strong><br>
                Melaporkan kondisi kurangnya sinergi kepada pimpinan tim agar diberikan arahan resmi kepada seluruh pihak yang terlibat.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menjalankan tugas yang menjadi bagian Anda secara maksimal sambil menyesuaikan diri dengan perkembangan yang dilakukan oleh pihak lain.',
                'options' => [
                    ['option_text' => 'Menyelaraskan kembali tahapan kerja dengan memahami proses masing-masing pihak, lalu menyusun kesepakatan teknis agar integrasi sistem dapat berjalan tanpa saling tumpang tindih.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menjalankan tugas yang menjadi bagian Anda secara maksimal sambil menyesuaikan diri dengan perkembangan yang dilakukan oleh pihak lain.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengusulkan pembahasan teknis terbatas untuk mengidentifikasi titik temu antarproses kerja, sekaligus menyepakati mekanisme koordinasi selama implementasi berlangsung.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Melaporkan kondisi kurangnya sinergi kepada pimpinan tim agar diberikan arahan resmi kepada seluruh pihak yang terlibat.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Meminta setiap pihak mendokumentasikan progres pekerjaannya agar mudah diketahui bagian mana yang sudah dan belum terintegrasi.', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam program penanganan stunting, kader desa merasa tidak dilibatkan dalam pengambilan keputusan, sementara puskesmas merasa kader kurang disiplin melaporkan data.<br><br>Sebagai ASN pendamping program, langkah Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: D A C B E</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Menyusun mekanisme kerja sederhana yang memungkinkan kader terlibat dalam tahapan tertentu program, sekaligus memperjelas alur pelaporan data kepada puskesmas.<br><br>
                <strong>• A – Poin 4</strong><br>
                Mengajak perwakilan kader desa dan puskesmas menyepakati ulang peran masing-masing, termasuk ruang keterlibatan kader dan standar pelaporan yang realistis sesuai kondisi lapangan.<br><br>
                <strong>• C – Poin 3</strong><br>
                Menghimpun masukan dari kedua pihak secara terpisah untuk memahami akar permasalahan sebelum menentukan langkah lanjutan.<br><br>
                <strong>• B – Poin 2</strong><br>
                Meminta kader desa menyesuaikan pola kerja dengan ketentuan puskesmas agar pelaporan data dapat berjalan lebih tertib dan terkontrol.<br><br>
                <strong>• E – Poin 1</strong><br>
                Menjelaskan kepada kedua pihak bahwa perbedaan pandangan merupakan hal wajar dalam program lintas sektor dan meminta mereka tetap menjalankan tugas masing-masing.',
                'options' => [
                    ['option_text' => 'Mengajak perwakilan kader desa dan puskesmas menyepakati ulang peran masing-masing, termasuk ruang keterlibatan kader dan standar pelaporan yang realistis sesuai kondisi lapangan.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Meminta kader desa menyesuaikan pola kerja dengan ketentuan puskesmas agar pelaporan data dapat berjalan lebih tertib dan terkontrol.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Menghimpun masukan dari kedua pihak secara terpisah untuk memahami akar permasalahan sebelum menentukan langkah lanjutan.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menyusun mekanisme kerja sederhana yang memungkinkan kader terlibat dalam tahapan tertentu program, sekaligus memperjelas alur pelaporan data kepada puskesmas.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Menjelaskan kepada kedua pihak bahwa perbedaan pandangan merupakan hal wajar dalam program lintas sektor dan meminta mereka tetap menjalankan tugas masing-masing.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam pelaksanaan program UMKM daerah, terdapat bantuan dari kementerian, pemda, dan BUMN. Pelaku UMKM bingung karena syarat dan jadwal berbeda-beda.<br><br>Sebagai ASN di dinas terkait, sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A E C B D</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menginventarisasi seluruh skema bantuan yang ada, lalu menyusun ringkasan informasi agar pelaku UMKM dapat memilih program yang sesuai dengan kebutuhannya.<br><br>
                <strong>• E – Poin 4</strong><br>
                Memfasilitasi pertemuan lintas penyelenggara bantuan untuk menyelaraskan informasi dasar, sambil tetap menghormati kewenangan masing-masing pihak.<br><br>
                <strong>• C – Poin 3</strong><br>
                Mengkoordinasikan penyampaian informasi bantuan melalui satu jalur komunikasi resmi sehingga pelaku UMKM memperoleh kejelasan meskipun program berasal dari berbagai pihak.<br><br>
                <strong>• B – Poin 2</strong><br>
                Mengusulkan penyesuaian jadwal dan persyaratan bantuan kepada pihak-pihak terkait agar pelaku UMKM tidak merasa terbabani oleh perbedaan ketentuan.<br><br>
                <strong>• D – Poin 1</strong><br>
                Menyarankan pelaku UMKM untuk fokus mengikuti salah satu program bantuan agar tidak kebingungan dengan banyaknya pilihan yang tersedia.',
                'options' => [
                    ['option_text' => 'Menginventarisasi seluruh skema bantuan yang ada, lalu menyusun ringkasan informasi agar pelaku UMKM dapat memilih program yang sesuai dengan kebutuhannya.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Mengusulkan penyesuaian jadwal dan persyaratan bantuan kepada pihak-pihak terkait agar pelaku UMKM tidak merasa terbabani oleh perbedaan ketentuan.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Mengkoordinasikan penyampaian informasi bantuan melalui satu jalur komunikasi resmi sehingga pelaku UMKM memperoleh kejelasan meskipun program berasal dari berbagai pihak.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menyarankan pelaku UMKM untuk fokus mengikuti salah satu program bantuan agar tidak kebingungan dengan banyaknya pilihan yang tersedia.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Memfasilitasi pertemuan lintas penyelenggara bantuan untuk menyelaraskan informasi dasar, sambil tetap menghormati kewenangan masing-masing pihak.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam penanganan isu kesehatan lingkungan, LSM lokal aktif melakukan advokasi dan pengumpulan data. Sebagian ASN merasa keberadaan LSM "mengganggu" kerja pemerintah.<br><br>Sebagai ASN yang terlibat langsung, sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: D A C E B</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Memfasilitasi ruang komunikasi informal antara LSM dan ASN terkait untuk menyamakan persepsi tujuan dan meminimalkan kesalahpahaman.<br><br>
                <strong>• A – Poin 4</strong><br>
                Mengajak LSM berdiskusi untuk memahami fokus advokasinya, sekaligus menyampaikan batasan kewenangan pemerintah agar kerja masing-masing tidak saling tumpang tindih.<br><br>
                <strong>• C – Poin 3</strong><br>
                Menginventarisasi data yang dikumpulkan LSM dan membandingkannya dengan data pemerintah sebagai bahan pertimbangan internal.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menyampaikan keberatan ASN terhadap aktivitas LSM kepada pimpinan agar ada kebijakan yang mengatur keterlibatan pihak eksternal.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menjaga jarak kerja dengan LSM agar proses penanganan isu tetap berjalan sesuai mekanisme internal pemerintah.',
                'options' => [
                    ['option_text' => 'Mengajak LSM berdiskusi untuk memahami fokus advokasinya, sekaligus menyampaikan batasan kewenangan pemerintah agar kerja masing-masing tidak saling tumpang tindih.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menjaga jarak kerja dengan LSM agar proses penanganan isu tetap berjalan sesuai mekanisme internal pemerintah.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menginventarisasi data yang dikumpulkan LSM dan membandingkannya dengan data pemerintah sebagai bahan pertimbangan internal.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Memfasilitasi ruang komunikasi informal antara LSM dan ASN terkait untuk menyamakan persepsi tujuan dan meminimalkan kesalahpahaman.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Menyampaikan keberatan ASN terhadap aktivitas LSM kepada pimpinan agar ada kebijakan yang mengatur keterlibatan pihak eksternal.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda adalah ASN baru yang ditugaskan dalam tim sosialisasi program di beberapa daerah. Di wilayah A, warga terbiasa berbicara dengan suara keras dan banyak menyela, sedangkan di wilayah B, warga cenderung diam dan hanya menjawab jika ditanya. Seorang rekan menilai warga wilayah A "kasar" dan warga wilayah B "pasif dan tidak peduli".<br><br>Sikap Anda untuk menjaga keharmonisan sosial budaya dalam tim adalah ....',
                'explanation' => '<strong>Jawaban: B D A E C</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengajak rekan berdiskusi santai untuk berbagi pengalaman lapangan, sekaligus mengingatkan pentingnya memahami karakter sosial budaya masyarakat setempat.<br><br>
                <strong>• D – Poin 4</strong><br>
                Menyesuaikan pendekatan sosialisasi dengan karakter masyarakat di tiap wilayah, sambil mendorong tim untuk lebih terbuka terhadap perbedaan gaya komunikasi.<br><br>
                <strong>• A – Poin 3</strong><br>
                Menjelaskan kepada rekan bahwa perbedaan cara berkomunikasi dipengaruhi latar belakang budaya, sehingga penilaian pribadi sebaiknya tidak dijadikan dasar sikap tim.<br><br>
                <strong>• E – Poin 2</strong><br>
                Membiarkan penilaian rekan tersebut karena setiap orang memiliki sudut pandang masing-masing selama tidak mengganggu pelaksanaan tugas.<br><br>
                <strong>• C – Poin 1</strong><br>
                Menyarankan agar tim menggunakan pola sosialisasi yang sama di semua wilayah supaya tidak terjadi perbedaan perlakuan terhadap masyarakat.',
                'options' => [
                    ['option_text' => 'Menjelaskan kepada rekan bahwa perbedaan cara berkomunikasi dipengaruhi latar belakang budaya, sehingga penilaian pribadi sebaiknya tidak dijadikan dasar sikap tim.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Mengajak rekan berdiskusi santai untuk berbagi pengalaman lapangan, sekaligus mengingatkan pentingnya memahami karakter sosial budaya masyarakat setempat.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Menyarankan agar tim menggunakan pola sosialisasi yang sama di semua wilayah supaya tidak terjadi perbedaan perlakuan terhadap masyarakat.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Menyesuaikan pendekatan sosialisasi dengan karakter masyarakat di tiap wilayah, sambil mendorong tim untuk lebih terbuka terhadap perbedaan gaya komunikasi.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Membiarkan penilaian rekan tersebut karena setiap orang memiliki sudut pandang masing-masing selama tidak mengganggu pelaksanaan tugas.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di ruang pelayanan, beberapa pegawai mulai memasang simbol keagamaan yang cukup besar dan mencolok di meja masing-masing. Seorang warga minoritas menyampaikan bahwa ia merasa sedikit tidak nyaman karena ruangan terkesan milik kelompok agama tertentu saja.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: D B A C E</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Mengajak rekan kerja mendiskusikan penataan ruang pelayanan agar tetap menghormati keyakinan pribadi sekaligus menjaga kenyamanan masyarakat yang beragam.<br><br>
                <strong>• B – Poin 4</strong><br>
                Mengingatkan rekan kerja secara informal bahwa ruang pelayanan bersifat umum dan sebaiknya mencerminkan suasana yang netral dan inklusif bagi semua warga.<br><br>
                <strong>• A – Poin 3</strong><br>
                Menyampaikan masukan tersebut kepada pimpinan unit agar ditentukan kebijakan resmi terkait penempatan simbol keagamaan di ruang pelayanan.<br><br>
                <strong>• C – Poin 2</strong><br>
                Menjelaskan kepada warga bahwa setiap pegawai memiliki kebebasan menjalankan keyakinannya selama tidak mengganggu pelayanan.<br><br>
                <strong>• E – Poin 1</strong><br>
                Membiarkan kondisi tersebut selama tidak ada aturan tertulis yang melarang pemasangan simbol keagamaan di ruang kerja.',
                'options' => [
                    ['option_text' => 'Menyampaikan masukan tersebut kepada pimpinan unit agar ditentukan kebijakan resmi terkait penempatan simbol keagamaan di ruang pelayanan.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Mengingatkan rekan kerja secara informal bahwa ruang pelayanan bersifat umum dan sebaiknya mencerminkan suasana yang netral dan inklusif bagi semua warga.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Menjelaskan kepada warga bahwa setiap pegawai memiliki kebebasan menjalankan keyakinannya selama tidak mengganggu pelayanan.', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Mengajak rekan kerja mendiskusikan penataan ruang pelayanan agar tetap menghormati keyakinan pribadi sekaligus menjaga kenyamanan masyarakat yang beragam.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Membiarkan kondisi tersebut selama tidak ada aturan tertulis yang melarang pemasangan simbol keagamaan di ruang kerja.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda bekerja di kantor pelayanan yang pegawainya didominasi oleh satu suku/bahasa daerah. Saat jam kerja, beberapa pegawai sering bercakap-cakap dengan bahasa daerah tersebut, bahkan ketika ada rekan dari suku lain di ruangan itu. Rekan minoritas itu terlihat canggung dan jarang ikut berdiskusi.<br><br>Sikap Anda untuk menjaga keharmonisan sosial budaya di tempat kerja adalah ....',
                'explanation' => '<strong>Jawaban: D A E C B</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Menganisiasi kebiasaan diskusi tim dengan bahasa yang dipahami bersama, sambil tetap menghargai penggunaan bahasa daerah di luar konteks kerja formal.<br><br>
                <strong>• A – Poin 4</strong><br>
                Mengajak rekan kerja menggunakan bahasa Indonesia dalam diskusi bersama, terutama saat jam kerja, agar semua pegawai dapat terlibat secara setara.<br><br>
                <strong>• E – Poin 3</strong><br>
                Menyampaikan kondisi tersebut kepada pimpinan agar dibuat aturan tertulis mengenai penggunaan bahasa di lingkungan kerja.<br><br>
                <strong>• C – Poin 2</strong><br>
                Membiarkan kebiasaan tersebut selama tidak mengganggu penyelesaian pekerjaan utama.<br><br>
                <strong>• B – Poin 1</strong><br>
                Mengingatkan rekan minoritas tersebut bahwa perbedaan budaya merupakan hal wajar dan ia perlu menyesuaikan diri dengan lingkungan kerja.',
                'options' => [
                    ['option_text' => 'Mengajak rekan kerja menggunakan bahasa Indonesia dalam diskusi bersama, terutama saat jam kerja, agar semua pegawai dapat terlibat secara setara.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengingatkan rekan minoritas tersebut bahwa perbedaan budaya merupakan hal wajar dan ia perlu menyesuaikan diri dengan lingkungan kerja.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Membiarkan kebiasaan tersebut selama tidak mengganggu penyelesaian pekerjaan utama.', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Menganisiasi kebiasaan diskusi tim dengan bahasa yang dipahami bersama, sambil tetap menghargai penggunaan bahasa daerah di luar konteks kerja formal.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Menyampaikan kondisi tersebut kepada pimpinan agar dibuat aturan tertulis mengenai penggunaan bahasa di lingkungan kerja.', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Seorang rekan kerja membagikan video di grup WhatsApp kantor yang menggambarkan stereotip negatif tentang suatu suku di Indonesia dengan nada bercanda. Beberapa rekan tertawa, tetapi Anda tahu ada pegawai dari suku tersebut di dalam grup.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A B D E C</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menghubungi rekan yang membagikan video tersebut secara pribadi untuk menyampaikan bahwa konten tersebut berpotensi menyinggung dan kurang pantas dibagikan di grup kerja.<br><br>
                <strong>• B – Poin 4</strong><br>
                Menyampaikan di grup bahwa candaan yang mengandung stereotip sebaiknya dihindari agar suasana kerja tetap nyaman bagi semua pihak.<br><br>
                <strong>• D – Poin 3</strong><br>
                Mengalihkan percakapan grup ke topik pekerjaan agar diskusi tidak berlanjut ke arah yang sensitif.<br><br>
                <strong>• E – Poin 2</strong><br>
                Melaporkan kejadian tersebut kepada atasan atau pengelola grup agar diberikan teguran resmi.<br><br>
                <strong>• C – Poin 1</strong><br>
                Membiarkan situasi tersebut karena video dibagikan dalam konteks bercanda dan tidak dimaksudkan untuk menyakiti siapa pun.',
                'options' => [
                    ['option_text' => 'Menghubungi rekan yang membagikan video tersebut secara pribadi untuk menyampaikan bahwa konten tersebut berpotensi menyinggung dan kurang pantas dibagikan di grup kerja.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menyampaikan di grup bahwa candaan yang mengandung stereotip sebaiknya dihindari agar suasana kerja tetap nyaman bagi semua pihak.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Membiarkan situasi tersebut karena video dibagikan dalam konteks bercanda dan tidak dimaksudkan untuk menyakiti siapa pun.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mengalihkan percakapan grup ke topik pekerjaan agar diskusi tidak berlanjut ke arah yang sensitif.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Melaporkan kejadian tersebut kepada atasan atau pengelola grup agar diberikan teguran resmi.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Tim Anda terdiri dari berbagai agama. Saat pelaksanaan kegiatan di luar kota, jadwal agenda sangat padat. Seorang anggota tim meminta waktu sejenak untuk melaksanakan ibadah, sementara rekan lain mengeluh bahwa jika ditunggu jadwal akan molor dan kegiatan bisa tidak selesai.<br><br>Sikap Anda yang paling tepat sebagai koordinator tim adalah ....',
                'explanation' => '<strong>Jawaban: A C D E B</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menyesuaikan kembali alur kegiatan dengan memberi waktu ibadah secara terbatas, sambil mengatur pembagian tugas agar agenda tetap dapat berjalan efektif.<br><br>
                <strong>• C – Poin 4</strong><br>
                Mengajak tim berdiskusi singkat untuk mencari kesepakatan bersama agar kebutuhan ibadah tetap dihormati tanpa mengganggu target kegiatan.<br><br>
                <strong>• D – Poin 3</strong><br>
                Mengizinkan anggota yang ingin beribadah untuk melaksanakannya, sementara tim lain tetap melanjutkan agenda sesuai jadwal.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menjelaskan kepada tim bahwa kondisi lapangan menuntut fleksibilitas, sehingga setiap anggota perlu saling memahami keterbatasan masing-masing.<br><br>
                <strong>• B – Poin 1</strong><br>
                Meminta anggota tim menunda ibadah hingga kegiatan selesai demi menjaga kelancaran agenda yang sudah disepakati.',
                'options' => [
                    ['option_text' => 'Menyesuaikan kembali alur kegiatan dengan memberi waktu ibadah secara terbatas, sambil mengatur pembagian tugas agar agenda tetap dapat berjalan efektif.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Meminta anggota tim menunda ibadah hingga kegiatan selesai demi menjaga kelancaran agenda yang sudah disepakati.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengajak tim berdiskusi singkat untuk mencari kesepakatan bersama agar kebutuhan ibadah tetap dihormati tanpa mengganggu target kegiatan.', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Mengizinkan anggota yang ingin beribadah untuk melaksanakannya, sementara tim lain tetap melanjutkan agenda sesuai jadwal.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menjelaskan kepada tim bahwa kondisi lapangan menuntut fleksibilitas, sehingga setiap anggota perlu saling memahami keterbatasan masing-masing.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda bertugas di kelurahan yang warganya heterogen. Saat perayaan hari besar keagamaan mayoritas, sejumlah warga pendatang non-pemeluk agama tersebut merasa kurang nyaman karena seluruh jalan lingkungan ditutup dan aktivitas mereka terganggu, tetapi mereka enggan menyampaikan langsung kepada panitia.<br><br>Sikap Anda yang paling tepat sebagai aparat kelurahan adalah ....',
                'explanation' => '<strong>Jawaban: C E A B D</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Menjadi perantara dengan menyerap aspirasi warga pendatang secara informal, lalu menyampaikannya kepada panitia secara bijak tanpa menyebutkan pihak tertentu.<br><br>
                <strong>• E – Poin 4</strong><br>
                Mengusulkan kepada panitia agar menyediakan jalur alternatif atau pengaturan waktu tertentu sehingga aktivitas warga tetap dapat berlangsung.<br><br>
                <strong>• A – Poin 3</strong><br>
                Mengajak panitia kegiatan berdiskusi untuk meninjau kembali pengaturan lingkungan agar perayaan tetap berjalan tanpa mengabaikan kebutuhan warga lain.<br><br>
                <strong>• B – Poin 2</strong><br>
                Menyampaikan kepada warga pendatang bahwa kegiatan keagamaan tersebut bersifat sementara dan perlu dipahami sebagai bagian dari tradisi setempat.<br><br>
                <strong>• D – Poin 1</strong><br>
                Membiarkan kondisi tersebut karena warga yang tidak nyaman tidak menyampaikan keberatan secara langsung.',
                'options' => [
                    ['option_text' => 'Mengajak panitia kegiatan berdiskusi untuk meninjau kembali pengaturan lingkungan agar perayaan tetap berjalan tanpa mengabaikan kebutuhan warga lain.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Menyampaikan kepada warga pendatang bahwa kegiatan keagamaan tersebut bersifat sementara dan perlu dipahami sebagai bagian dari tradisi setempat.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Menjadi perantara dengan menyerap aspirasi warga pendatang secara informal, lalu menyampaikannya kepada panitia secara bijak tanpa menyebutkan pihak tertentu.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Membiarkan kondisi tersebut karena warga yang tidak nyaman tidak menyampaikan keberatan secara langsung.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Mengusulkan kepada panitia agar menyediakan jalur alternatif atau pengaturan waktu tertentu sehingga aktivitas warga tetap dapat berlangsung.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda seorang guru ASN yang diminta membuat kegiatan proyek profil kebudayaan di sekolah. Sebagian siswa berasal dari suku minoritas dan agama berbeda. Sebuah kelompok siswa ingin menampilkan pertunjukan yang menonjolkan satu budaya mayoritas secara dominan dan cenderung mengesampingkan yang lain.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C E A D B</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Mengajak siswa berdiskusi mengenai makna proyek kebudayaan, lalu mendorong mereka menemukan cara menampilkan budaya mayoritas tanpa meniadakan keberadaan budaya lain.<br><br>
                <strong>• E – Poin 4</strong><br>
                Memberikan contoh alternatif konsep pertunjukan yang lebih inklusif dan meminta siswa menyesuaikannya dengan kreativitas mereka sendiri.<br><br>
                <strong>• A – Poin 3</strong><br>
                Mengarahkan kelompok tersebut untuk meninjau kembali konsep pertunjukan dengan mempertimbangkan keberagaman latar belakang siswa agar tujuan pembelajaran tetap tercapai.<br><br>
                <strong>• D – Poin 2</strong><br>
                Menyarankan agar setiap kelompok wajib menampilkan unsur budaya yang berbeda-beda supaya semua latar belakang siswa terwakili secara merata.<br><br>
                <strong>• B – Poin 1</strong><br>
                Membiarkan pilihan kelompok tersebut sebagai bentuk kebebasan berekspresi siswa selama tidak melanggar aturan sekolah.',
                'options' => [
                    ['option_text' => 'Mengarahkan kelompok tersebut untuk meninjau kembali konsep pertunjukan dengan mempertimbangkan keberagaman latar belakang siswa agar tujuan pembelajaran tetap tercapai.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Membiarkan pilihan kelompok tersebut sebagai bentuk kebebasan berekspresi siswa selama tidak melanggar aturan sekolah.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengajak siswa berdiskusi mengenai makna proyek kebudayaan, lalu mendorong mereka menemukan cara menampilkan budaya mayoritas tanpa meniadakan keberadaan budaya lain.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Menyarankan agar setiap kelompok wajib menampilkan unsur budaya yang berbeda-beda supaya semua latar belakang siswa terwakili secara merata.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Memberikan contoh alternatif konsep pertunjukan yang lebih inklusif dan meminta siswa menyesuaikannya dengan kreativitas mereka sendiri.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda menerima file berisi data pribadi penerima bantuan (nama, NIK, alamat) untuk diverifikasi. Rekan Anda meminta file tersebut dikirim lewat aplikasi chat pribadi karena ia sedang dinas luar dan mengaku "lebih cepat lewat WA saja" dibanding lewat sistem resmi yang sedikit lebih rumit.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: D A C E B</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Menanyakan kepada atasan atau pengelola sistem apakah terdapat mekanisme resmi yang memungkinkan akses jarak jauh tanpa melanggar ketentuan keamanan data.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menjelaskan kepada rekan bahwa data tersebut bersifat sensitif dan mengusulkan penggunaan akses sistem resmi atau alternatif resmi yang tetap menjaga keamanan data.<br><br>
                <strong>• C – Poin 3</strong><br>
                Meminta rekan menunggu hingga Anda dapat mengunggah file melalui sistem resmi meskipun prosesnya memerlukan waktu lebih lama.<br><br>
                <strong>• E – Poin 2</strong><br>
                Mengaburkan sebagian data pribadi sebelum mengirimkannya melalui aplikasi chat agar risiko penyalahgunaan dapat dikurangi.<br><br>
                <strong>• B – Poin 1</strong><br>
                Mengirimkan file melalui aplikasi chat pribadi dengan catatan rekan tersebut segera menghapus file setelah selesai digunakan.',
                'options' => [
                    ['option_text' => 'Menjelaskan kepada rekan bahwa data tersebut bersifat sensitif dan mengusulkan penggunaan akses sistem resmi atau alternatif resmi yang tetap menjaga keamanan data.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengirimkan file melalui aplikasi chat pribadi dengan catatan rekan tersebut segera menghapus file setelah selesai digunakan.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Meminta rekan menunggu hingga Anda dapat mengunggah file melalui sistem resmi meskipun prosesnya memerlukan waktu lebih lama.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menanyakan kepada atasan atau pengelola sistem apakah terdapat mekanisme resmi yang memungkinkan akses jarak jauh tanpa melanggar ketentuan keamanan data.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Mengaburkan sebagian data pribadi sebelum mengirimkannya melalui aplikasi chat agar risiko penyalahgunaan dapat dikurangi.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda diminta menyusun rancangan surat edaran. Untuk menghemat waktu, Anda ingin memanfaatkan aplikasi AI generatif online. Draft surat tersebut memuat poin kebijakan internal dan beberapa data non-publik.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C A E D B</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Memastikan terlebih dahulu apakah penggunaan aplikasi AI generatif tersebut telah diatur atau direkomendasikan oleh instansi sebelum memanfaatkannya.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menggunakan aplikasi AI generatif hanya untuk menyusun kerangka umum surat, tanpa memasukkan data non-publik maupun detail kebijakan internal.<br><br>
                <strong>• E – Poin 3</strong><br>
                Menggunakan aplikasi AI generatif dengan mengganti istilah dan konteks sensitif menjadi umum agar tidak secara langsung mengungkap data internal.<br><br>
                <strong>• D – Poin 2</strong><br>
                Menyusun draft surat secara manual karena melibatkan data non-publik, meskipun membutuhkan waktu lebih lama.<br><br>
                <strong>• B – Poin 1</strong><br>
                Memasukkan seluruh poin kebijakan ke dalam aplikasi AI generatif agar hasilnya lebih cepat dan rapi, lalu melakukan penyuntingan ulang sebelum digunakan.',
                'options' => [
                    ['option_text' => 'Menggunakan aplikasi AI generatif hanya untuk menyusun kerangka umum surat, tanpa memasukkan data non-publik maupun detail kebijakan internal.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Memasukkan seluruh poin kebijakan ke dalam aplikasi AI generatif agar hasilnya lebih cepat dan rapi, lalu melakukan penyuntingan ulang sebelum digunakan.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Memastikan terlebih dahulu apakah penggunaan aplikasi AI generatif tersebut telah diatur atau direkomendasikan oleh instansi sebelum memanfaatkannya.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Menyusun draft surat secara manual karena melibatkan data non-publik, meskipun membutuhkan waktu lebih lama.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menggunakan aplikasi AI generatif dengan mengganti istilah dan konteks sensitif menjadi umum agar tidak secara langsung mengungkap data internal.', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda menerima email yang mengatasnamakan pimpinan, berisi permintaan agar Anda segera mengklik tautan dan mengisi ulang data akun sistem kepegawaian karena "ada pembaruan keamanan". Alamat pengirim tampak mirip, tetapi ketika diarahkan ke tautan, domainnya sedikit berbeda dari domain resmi instansi.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B A D C E</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Meneruskan email tersebut ke pengelola TIK atau tim keamanan informasi instansi untuk dilaporkan sebagai potensi ancaman.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menunda membuka tautan tersebut dan mengonfirmasi kebenaran email melalui saluran resmi lain sebelum melakukan tindakan apa pun.<br><br>
                <strong>• D – Poin 3</strong><br>
                Menghubungi langsung pimpinan yang bersangkutan untuk menanyakan apakah email tersebut benar dikirim olehnya.<br><br>
                <strong>• C – Poin 2</strong><br>
                Mengabaikan email tersebut tanpa menindaklanjuti karena indikasinya tidak sesuai dengan domain resmi.<br><br>
                <strong>• E – Poin 1</strong><br>
                Membuka tautan tersebut dengan hati-hati tanpa memasukkan data apa pun hanya untuk memastikan isi pembaruan yang dimaksud.',
                'options' => [
                    ['option_text' => 'Menunda membuka tautan tersebut dan mengonfirmasi kebenaran email melalui saluran resmi lain sebelum melakukan tindakan apa pun.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Meneruskan email tersebut ke pengelola TIK atau tim keamanan informasi instansi untuk dilaporkan sebagai potensi ancaman.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Mengabaikan email tersebut tanpa menindaklanjuti karena indikasinya tidak sesuai dengan domain resmi.', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Menghubungi langsung pimpinan yang bersangkutan untuk menanyakan apakah email tersebut benar dikirim olehnya.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Membuka tautan tersebut dengan hati-hati tanpa memasukkan data apa pun hanya untuk memastikan isi pembaruan yang dimaksud.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Instansi Anda memiliki grup WhatsApp resmi untuk informasi pelayanan publik. Grup ini hanya boleh digunakan untuk pengumuman dan tanya jawab terkait layanan. Salah satu rekan admin sering mengirim konten lucu, meme, dan berita politik ke grup sehingga mulai memicu perdebatan antaranggota.<br><br>Sikap Anda yang paling tepat sebagai sesama admin adalah ....',
                'explanation' => '<strong>Jawaban: A D B E C</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Mengingatkan rekan admin tersebut secara pribadi mengenai fungsi grup dan dampak konten di luar layanan terhadap persepsi publik.<br><br>
                <strong>• D – Poin 4</strong><br>
                Mengusulkan penegasan ulang aturan penggunaan grup kepada seluruh admin dan anggota agar fungsi grup kembali sesuai tujuan awal.<br><br>
                <strong>• B – Poin 3</strong><br>
                Menegur rekan admin tersebut langsung di grup agar anggota mengetahui bahwa konten seperti itu tidak dibenarkan.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menghapus konten yang tidak sesuai dan membatasi sementara akses admin tersebut tanpa melakukan komunikasi terlebih dahulu.<br><br>
                <strong>• C – Poin 1</strong><br>
                Membiarkan situasi tersebut karena konten lucu dapat membuat suasana grup lebih santai dan akrab.',
                'options' => [
                    ['option_text' => 'Mengingatkan rekan admin tersebut secara pribadi mengenai fungsi grup dan dampak konten di luar layanan terhadap persepsi publik.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menegur rekan admin tersebut langsung di grup agar anggota mengetahui bahwa konten seperti itu tidak dibenarkan.', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Membiarkan situasi tersebut karena konten lucu dapat membuat suasana grup lebih santai dan akrab.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mengusulkan penegasan ulang aturan penggunaan grup kepada seluruh admin dan anggota agar fungsi grup kembali sesuai tujuan awal.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Menghapus konten yang tidak sesuai dan membatasi sementara akses admin tersebut tanpa melakukan komunikasi terlebih dahulu.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Instansi Anda belum menyediakan laptop untuk semua pegawai. Anda sering diminta mengerjakan laporan di rumah. Rekan menyarankan agar Anda menghubungkan laptop pribadi langsung ke jaringan internal kantor menggunakan password wifi kantor yang ia berikan, agar bisa mengakses folder bersama tanpa harus datang ke kantor.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C A D E B</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Menanyakan kepada pengelola TIK apakah tersedia akses resmi jarak jauh atau kebijakan penggunaan perangkat pribadi untuk keperluan dinas.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menolak menggunakan jaringan internal kantor dari perangkat pribadi dan menyarankan penggunaan mekanisme resmi yang disediakan instansi, meskipun aksesnya lebih terbatas.<br><br>
                <strong>• D – Poin 3</strong><br>
                Mengakses folder bersama melalui perangkat pribadi hanya untuk dokumen yang tidak bersifat sensitif.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menggunakan password wifi kantor yang diberikan rekan dengan tetap berhati-hati dan tidak menyimpan data kantor di laptop pribadi.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menggunakan jaringan internal kantor dari laptop pribadi karena bertujuan untuk menyelesaikan pekerjaan dan meningkatkan efisiensi.',
                'options' => [
                    ['option_text' => 'Menolak menggunakan jaringan internal kantor dari perangkat pribadi dan menyarankan penggunaan mekanisme resmi yang disediakan instansi, meskipun aksesnya lebih terbatas.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menggunakan jaringan internal kantor dari laptop pribadi karena bertujuan untuk menyelesaikan pekerjaan dan meningkatkan efisiensi.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menanyakan kepada pengelola TIK apakah tersedia akses resmi jarak jauh atau kebijakan penggunaan perangkat pribadi untuk keperluan dinas.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Mengakses folder bersama melalui perangkat pribadi hanya untuk dokumen yang tidak bersifat sensitif.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menggunakan password wifi kantor yang diberikan rekan dengan tetap berhati-hati dan tidak menyimpan data kantor di laptop pribadi.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda salah menginput nilai bantuan untuk seorang warga dalam sistem, sehingga tercatat menerima jumlah lebih besar dari seharusnya. Warga tersebut belum mencairkan bantuannya. Sistem tidak memiliki fitur "hapus", hanya "koreksi" yang akan meninggalkan riwayat perubahan dapat dilihat oleh atasan.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C A E D B</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Melaporkan kesalahan tersebut kepada atasan sebelum melakukan koreksi agar langkah perbaikan tercatat secara resmi.<br><br>
                <strong>• A – Poin 4</strong><br>
                Segera melakukan koreksi pada sistem sesuai nilai yang benar dan menyiapkan penjelasan jika diminta oleh atasan.<br><br>
                <strong>• E – Poin 3</strong><br>
                Menunda koreksi sambil memastikan kembali data pendukung agar tidak terjadi kesalahan lanjutan.<br><br>
                <strong>• D – Poin 2</strong><br>
                Mengoreksi data di sistem tanpa memberi tahu siapa pun karena kesalahan dapat diperbaiki dan tidak berdampak pada warga.<br><br>
                <strong>• B – Poin 1</strong><br>
                Membiarkan data sementara karena bantuan belum dicairkan dan berencana memperbaikinya jika ada instruksi lebih lanjut.',
                'options' => [
                    ['option_text' => 'Segera melakukan koreksi pada sistem sesuai nilai yang benar dan menyiapkan penjelasan jika diminta oleh atasan.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Membiarkan data sementara karena bantuan belum dicairkan dan berencana memperbaikinya jika ada instruksi lebih lanjut.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Melaporkan kesalahan tersebut kepada atasan sebelum melakukan koreksi agar langkah perbaikan tercatat secara resmi.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Mengoreksi data di sistem tanpa memberi tahu siapa pun karena kesalahan dapat diperbaiki dan tidak berdampak pada warga.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menunda koreksi sambil memastikan kembali data pendukung agar tidak terjadi kesalahan lanjutan.', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Instansi Anda baru saja mengimplementasikan aplikasi e-office untuk disposisi dan arsip digital. Beberapa pegawai senior kesulitan menggunakan aplikasi dan sering meminta bantuan Anda. Hal ini membuat Anda merasa pekerjaan sendiri jadi tertunda.<br><br>Sikap Anda yang paling tepat sebagai pegawai yang lebih melek TIK adalah ....',
                'explanation' => '<strong>Jawaban: B A C D E</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengusulkan dibuatnya panduan singkat atau sesi pendampingan bersama agar pegawai senior dapat lebih mandiri dan tidak selalu bergantung pada bantuan personal.<br><br>
                <strong>• A – Poin 4</strong><br>
                Tetap membantu pegawai senior saat diminta sambil mengatur ulang prioritas pekerjaan pribadi agar semua tugas tetap terselesaikan.<br><br>
                <strong>• C – Poin 3</strong><br>
                Membantu pegawai senior hanya jika pekerjaan Anda sudah selesai agar target pribadi tidak terganggu.<br><br>
                <strong>• D – Poin 2</strong><br>
                Menyarankan pegawai senior untuk belajar secara mandiri melalui panduan resmi yang sudah tersedia.<br><br>
                <strong>• E – Poin 1</strong><br>
                Menyampaikan kepada atasan bahwa seringnya permintaan bantuan menghambat kinerja Anda sehingga perlu penugasan khusus pendamping TIK.',
                'options' => [
                    ['option_text' => 'Tetap membantu pegawai senior saat diminta sambil mengatur ulang prioritas pekerjaan pribadi agar semua tugas tetap terselesaikan.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengusulkan dibuatnya panduan singkat atau sesi pendampingan bersama agar pegawai senior dapat lebih mandiri dan tidak selalu bergantung pada bantuan personal.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Membantu pegawai senior hanya jika pekerjaan Anda sudah selesai agar target pribadi tidak terganggu.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menyarankan pegawai senior untuk belajar secara mandiri melalui panduan resmi yang sudah tersedia.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menyampaikan kepada atasan bahwa seringnya permintaan bantuan menghambat kinerja Anda sehingga perlu penugasan khusus pendamping TIK.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Instansi Anda mulai menerapkan verifikasi dua langkah (password + OTP via SMS) untuk mengakses aplikasi kepegawaian. Suatu hari, rekan kerja Anda yang dikenal dekat meminta: "Tolong kasih aku kode OTP-mu sebentar, aku mau bantu approve beberapa dokumen pakai akunmu saja biar cepat. Nanti aku tanggung jawab kalau ada apa-apa."<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A B D E C</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menolak memberikan kode OTP dan menyarankan rekan tersebut menggunakan akun serta kewenangannya sendiri sesuai prosedur yang berlaku.<br><br>
                <strong>• B – Poin 4</strong><br>
                Menjelaskan bahwa OTP bersifat rahasia, lalu menawarkan untuk membantu proses persetujuan dengan cara yang tidak melanggar keamanan akun.<br><br>
                <strong>• D – Poin 3</strong><br>
                Menyarankan agar permintaan tersebut disampaikan secara resmi kepada atasan atau admin sistem jika memang diperlukan percepatan proses.<br><br>
                <strong>• E – Poin 2</strong><br>
                Mengizinkan penggunaan akun Anda kali ini saja dengan catatan tidak diulangi dan dilakukan atas dasar saling percaya.<br><br>
                <strong>• C – Poin 1</strong><br>
                Memberikan kode OTP karena rekan tersebut dapat dipercaya dan bertujuan membantu pekerjaan agar tidak tertunda.',
                'options' => [
                    ['option_text' => 'Menolak memberikan kode OTP dan menyarankan rekan tersebut menggunakan akun serta kewenangannya sendiri sesuai prosedur yang berlaku.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menjelaskan bahwa OTP bersifat rahasia, lalu menawarkan untuk membantu proses persetujuan dengan cara yang tidak melanggar keamanan akun.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Memberikan kode OTP karena rekan tersebut dapat dipercaya dan bertujuan membantu pekerjaan agar tidak tertunda.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Menyarankan agar permintaan tersebut disampaikan secara resmi kepada atasan atau admin sistem jika memang diperlukan percepatan proses.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Mengizinkan penggunaan akun Anda kali ini saja dengan catatan tidak diulangi dan dilakukan atas dasar saling percaya.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda menyadari bahwa laporan yang sudah Anda kirim ke atasan mengandung kesalahan angka rekapitulasi. Laporan itu belum digunakan untuk rapat, tetapi sudah disalin oleh beberapa rekan.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A D C B E</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Segera mengoreksi laporan, menyampaikan kesalahan kepada atasan, serta menginformasikan versi perbaikan kepada rekan yang telah menerima salinan.<br><br>
                <strong>• D – Poin 4</strong><br>
                Memberi tahu rekan terdekat terlebih dahulu sambil memastikan kembali data sebelum menyampaikan kepada atasan.<br><br>
                <strong>• C – Poin 3</strong><br>
                Memperbaiki laporan dan mengirim ulang kepada atasan tanpa perlu menjelaskan adanya kesalahan sebelumnya.<br><br>
                <strong>• B – Poin 2</strong><br>
                Menunggu arahan dari atasan karena laporan belum digunakan secara resmi dalam rapat.<br><br>
                <strong>• E – Poin 1</strong><br>
                Membiarkan laporan tersebut karena kesalahan belum berdampak langsung pada pengambilan keputusan.',
                'options' => [
                    ['option_text' => 'Segera mengoreksi laporan, menyampaikan kesalahan kepada atasan, serta menginformasikan versi perbaikan kepada rekan yang telah menerima salinan.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menunggu arahan dari atasan karena laporan belum digunakan secara resmi dalam rapat.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Memperbaiki laporan dan mengirim ulang kepada atasan tanpa perlu menjelaskan adanya kesalahan sebelumnya.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Memberi tahu rekan terdekat terlebih dahulu sambil memastikan kembali data sebelum menyampaikan kepada atasan.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Membiarkan laporan tersebut karena kesalahan belum berdampak langsung pada pengambilan keputusi.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda diberi target menyelesaikan verifikasi berkas dalam 2 hari. Pada hari kedua, masih ada berkas yang belum dicek. Jika dipaksakan selesai hari itu, kualitas pengecekan berpotensi menurun dan kesalahan bisa terjadi.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A E C D B</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menyampaikan kondisi tersebut kepada atasan disertai gambaran risiko jika dipaksakan, serta mengusulkan penyesuaian waktu atau prioritas berkas.<br><br>
                <strong>• E – Poin 4</strong><br>
                Mengatur ulang ritme kerja secara mandiri dengan memperpanjang jam kerja agar target dan kualitas dapat terpenuhi sekaligus.<br><br>
                <strong>• C – Poin 3</strong><br>
                Memfokuskan pengecekan mendalam pada berkas yang paling krusial, sementara berkas lain diperiksa secara lebih ringkas agar target tetap tercapai.<br><br>
                <strong>• D – Poin 2</strong><br>
                Menyelesaikan pekerjaan sebisanya pada hari itu dan melanjutkan sisa verifikasi keesokan harinya tanpa perlu menyampaikan alasan secara khusus.<br><br>
                <strong>• B – Poin 1</strong><br>
                Tetap menyelesaikan seluruh berkas sesuai target waktu meskipun kualitas pengecekan tidak bisa optimal.',
                'options' => [
                    ['option_text' => 'Menyampaikan kondisi tersebut kepada atasan disertai gambaran risiko jika dipaksakan, serta mengusulkan penyesuaian waktu atau prioritas berkas.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Tetap menyelesaikan seluruh berkas sesuai target waktu meskipun kualitas pengecekan tidak bisa optimal.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Memfokuskan pengecekan mendalam pada berkas yang paling krusial, sementara berkas lain diperiksa secara lebih ringkas agar target tetap tercapai.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menyelesaikan pekerjaan sebisanya pada hari itu dan melanjutkan sisa verifikasi keesokan harinya tanpa perlu menyampaikan alasan secara khusus.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Mengatur ulang ritme kerja secara mandiri dengan memperpanjang jam kerja agar target dan kualitas dapat terpenuhi sekaligus.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Atasan mengkritik hasil kerja Anda di depan tim dengan nada cukup keras. Anda merasa sudah berusaha maksimal dan sedikit tersinggung.<br><br>Sikap paling profesional adalah ....',
                'explanation' => '<strong>Jawaban: A C D B E</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menerima kritik tersebut dengan tenang, lalu setelah suasana kondusif menyampaikan klarifikasi atau masukan secara pribadi kepada atasan.<br><br>
                <strong>• C – Poin 4</strong><br>
                Menahan perasaan dan memilih fokus memperbaiki hasil kerja tanpa menanggapi kritik tersebut lebih lanjut.<br><br>
                <strong>• D – Poin 3</strong><br>
                Menganggap kritik tersebut sebagai bentuk tekanan kerja dan berusaha mengabaikannya agar emosi tidak berlarut-larut.<br><br>
                <strong>• B – Poin 2</strong><br>
                Menjelaskan pembelaan diri Anda saat itu juga agar atasan dan tim memahami usaha yang telah Anda lakukan.<br><br>
                <strong>• E – Poin 1</strong><br>
                Menyampaikan keberatan Anda kepada rekan kerja lain karena merasa cara penyampaian atasan kurang tepat.',
                'options' => [
                    ['option_text' => 'Menerima kritik tersebut dengan tenang, lalu setelah suasana kondusif menyampaikan klarifikasi atau masukan secara pribadi kepada atasan.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menjelaskan pembelaan diri Anda saat itu juga agar atasan dan tim memahami usaha yang telah Anda lakukan.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Menahan perasaan dan memilih fokus memperbaiki hasil kerja tanpa menanggapi kritik tersebut lebih lanjut.', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Menganggap kritik tersebut sebagai bentuk tekanan kerja dan berusaha mengabaikannya agar emosi tidak berlarut-larut.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menyampaikan keberatan Anda kepada rekan kerja lain karena merasa cara penyampaian atasan kurang tepat.', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Seorang rekanan kantor mengirim paket hadiah cukup mahal ke meja Anda, sebagai "ucapan terima kasih" atas kerja sama proyek yang sedang berjalan. Tidak ada perjanjian formal tentang hadiah ini.<br><br>Sikap paling profesional adalah ....',
                'explanation' => '<strong>Jawaban: C A D E B</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Melaporkan penerimaan hadiah tersebut kepada atasan atau unit terkait sesuai ketentuan yang berlaku untuk mendapatkan arahan lebih lanjut.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menolak atau mengembalikan hadiah tersebut dengan cara yang sopan sambil menjelaskan bahwa Anda tidak dapat menerima hadiah terkait pekerjaan.<br><br>
                <strong>• D – Poin 3</strong><br>
                Menyimpan hadiah tersebut sementara sambil mencari informasi apakah nilai dan konteksnya termasuk kategori yang perlu dilaporkan.<br><br>
                <strong>• E – Poin 2</strong><br>
                Membagi hadiah tersebut kepada rekan kerja lain agar tidak terkesan sebagai pemberian pribadi.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menerima hadiah tersebut karena tidak ada perjanjian resmi dan menganggapnya sebagai bentuk apresiasi pribadi.',
                'options' => [
                    ['option_text' => 'Menolak atau mengembalikan hadiah tersebut dengan cara yang sopan sambil menjelaskan bahwa Anda tidak dapat menerima hadiah terkait pekerjaan.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menerima hadiah tersebut karena tidak ada perjanjian resmi dan menganggapnya sebagai bentuk apresiasi pribadi.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Melaporkan penerimaan hadiah tersebut kepada atasan atau unit terkait sesuai ketentuan yang berlaku untuk mendapatkan arahan lebih lanjut.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Menyimpan hadiah tersebut sementara sambil mencari informasi apakah nilai dan konteksnya termasuk kategori yang perlu dilaporkan.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Membagi hadiah tersebut kepada rekan kerja lain agar tidak terkesan sebagai pemberian pribadi.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda sedang menghadapi masalah keluarga yang berat, sehingga sulit konsentrasi bekerja. Tugas Anda mulai tertunda dan beberapa rekan mulai menutupi pekerjaan Anda.<br><br>Sikap paling profesional adalah ....',
                'explanation' => '<strong>Jawaban: A E C B D</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Menyampaikan kondisi yang Anda alami kepada atasan secara terbuka dan mendiskusikan penyesuaian sementara terhadap beban kerja atau tenggat waktu.<br><br>
                <strong>• E – Poin 4</strong><br>
                Menyiapkan permohonan cuti atau ijin dinas untuk sementara waktu, sambil berkoordinasi dengan rekan agar pekerjaan tetap dapat diselesaikan.<br><br>
                <strong>• C – Poin 3</strong><br>
                Mengucapkan terima kasih kepada rekan yang membantu, dan berjanji akan mengembalikan bantuan tersebut ketika kondisi sudah membaik.<br><br>
                <strong>• B – Poin 2</strong><br>
                Berusaha menyelesaikan pekerjaan sendiri tanpa melibatkan siapa pun agar masalah pribadi tidak memengaruhi tim.<br><br>
                <strong>• D – Poin 1</strong><br>
                Membiarkan rekan terus membantu tanpa komunikasi apa pun karena merasa memang butuh bantuan.',
                'options' => [
                    ['option_text' => 'Menyampaikan kondisi yang Anda alami kepada atasan secara terbuka dan mendiskusikan penyesuaian sementara terhadap beban kerja atau tenggat waktu.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Berusaha menyelesaikan pekerjaan sendiri tanpa melibatkan siapa pun agar masalah pribadi tidak memengaruhi tim.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Mengucapkan terima kasih kepada rekan yang membantu, dan berjanji akan mengembalikan bantuan tersebut ketika kondisi sudah membaik.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Membiarkan rekan terus membantu tanpa komunikasi apa pun karena merasa memang butuh bantuan.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyiapkan permohonan cuti atau ijin dinas untuk sementara waktu, sambil berkoordinasi dengan rekan agar pekerjaan tetap dapat diselesaikan.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda melihat ada rekan kerja yang sering melakukan kesalahan teknis karena belum menguasai aplikasi baru. Kesalahan ini mulai memengaruhi hasil tim.<br><br>Sikap paling profesional adalah ....',
                'explanation' => '<strong>Jawaban: E A B C D</strong><br><br>
                <strong>• E – Poin 5</strong><br>
                Mengusulkan kepada tim adanya pembelajaran singkat bersama terkait aplikasi baru agar kesalahan serupa tidak terulang.<br><br>
                <strong>• A – Poin 4</strong><br>
                Mengajak rekan tersebut berdiskusi secara pribadi untuk menawarkan bantuan atau berbagai cara penggunaan aplikasi agar kinerjanya membaik.<br><br>
                <strong>• B – Poin 3</strong><br>
                Menyampaikan kondisi tersebut kepada atasan agar rekan tersebut mendapatkan arahan atau pelatihan resmi.<br><br>
                <strong>• C – Poin 2</strong><br>
                Memperbaiki hasil kerja rekan tersebut secara diam-diam agar target tim tetap tercapai.<br><br>
                <strong>• D – Poin 1</strong><br>
                Membiarkan rekan tersebut belajar sendiri dari kesalahannya karena setiap orang memiliki tanggung jawab atas pekerjaannya.',
                'options' => [
                    ['option_text' => 'Mengajak rekan tersebut berdiskusi secara pribadi untuk menawarkan bantuan atau berbagai cara penggunaan aplikasi agar kinerjanya membaik.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menyampaikan kondisi tersebut kepada atasan agar rekan tersebut mendapatkan arahan atau pelatihan resmi.', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Memperbaiki hasil kerja rekan tersebut secara diam-diam agar target tim tetap tercapai.', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Membiarkan rekan tersebut belajar sendiri dari kesalahannya karena setiap orang memiliki tanggung jawab atas pekerjaannya.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Mengusulkan kepada tim adanya pembelajaran singkat bersama terkait aplikasi baru agar kesalahan serupa tidak terulang.', 'weight' => 5, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda mendapat kesempatan mengikuti pelatihan yang sangat relevan dengan tugas, tetapi pelatihan diselenggarakan di luar jam kerja (malam hari/akhir pekan) dan mengurangi waktu santai Anda.<br><br>Sikap paling profesional adalah ....',
                'explanation' => '<strong>Jawaban: D A C E B</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Mendiskusikan dengan atasan mengenai manfaat pelatihan dan kemungkinan penyesuaian beban kerja atau pengakuan jam belajar.<br><br>
                <strong>• A – Poin 4</strong><br>
                Mengikuti pelatihan tersebut karena relevan dengan tugas, sambil mengatur ulang waktu pribadi agar tetap seimbang.<br><br>
                <strong>• C – Poin 3</strong><br>
                Mengikuti sebagian sesi pelatihan yang paling relevan agar tetap mendapatkan manfaat tanpa terlalu mengorbankan waktu pribadi.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menunda mengikuti pelatihan dan menunggu kesempatan lain yang diselenggarakan pada jam kerja.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menolak mengikuti pelatihan karena dilaksanakan di luar jam kerja dan berpotensi mengganggu waktu istirahat.',
                'options' => [
                    ['option_text' => 'Mengikuti pelatihan tersebut karena relevan dengan tugas, sambil mengatur ulang waktu pribadi agar tetap seimbang.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menolak mengikuti pelatihan karena dilaksanakan di luar jam kerja dan berpotensi mengganggu waktu istirahat.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengikuti sebagian sesi pelatihan yang paling relevan agar tetap mendapatkan manfaat tanpa terlalu mengorbankan waktu pribadi.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Mendiskusikan dengan atasan mengenai manfaat pelatihan dan kemungkinan penyesuaian beban kerja atau pengakuan jam belajar.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Menunda mengikuti pelatihan dan menunggu kesempatan lain yang diselenggarakan pada jam kerja.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda punya akun media sosial publik. Beberapa kali Anda tergoda memposting keluhan tentang kebijakan kantor dan menyebut nama instansi, karena merasa tidak didengar di internal.<br><br>Sikap paling profesional adalah ....',
                'explanation' => '<strong>Jawaban: D A C E B</strong><br><br>
                <strong>• D – Poin 5</strong><br>
                Mendiskusikan permasalahan tersebut dengan atasan atau pihak terkait secara langsung, serta mencari saluran komunikasi yang lebih efektif di internal.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menyampaikan keberatan dan masukan melalui mekanisme internal yang tersedia, sambil menahan diri untuk tidak mengungkapkannya di media sosial.<br><br>
                <strong>• C – Poin 3</strong><br>
                Mengalihkan kebutuhan mengekspresikan pendapat ke forum atau media yang tidak mengaitkan identitas Anda sebagai ASN.<br><br>
                <strong>• E – Poin 2</strong><br>
                Memposting keluhan secara terbatas hanya kepada pengikut tertentu yang dianggap memahami situasi Anda.<br><br>
                <strong>• B – Poin 1</strong><br>
                Menuliskan keluhan di media sosial dengan bahasa yang halus dan tidak menyerang individu tertentu agar tetap aman secara etika.',
                'options' => [
                    ['option_text' => 'Menyampaikan keberatan dan masukan melalui mekanisme internal yang tersedia, sambil menahan diri untuk tidak mengungkapkannya di media sosial.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menuliskan keluhan di media sosial dengan bahasa yang halus dan tidak menyerang individu tertentu agar tetap aman secara etika.', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengalihkan kebutuhan mengekspresikan pendapat ke forum atau media yang tidak mengaitkan identitas Anda sebagai ASN.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Mendiskusikan permasalahan tersebut dengan atasan atau pihak terkait secara langsung, serta mencari saluran komunikasi yang lebih efektif di internal.', 'weight' => 5, 'order' => 4],
                    ['option_text' => 'Memposting keluhan secara terbatas hanya kepada pengikut tertentu yang dianggap memahami situasi Anda.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda menjadi admin salah satu grup WhatsApp himpunan mahasiswa. Akhir-akhir ini, ada anggota baru yang sering mengirim tautan video ceramah dari kanal tidak jelas, berisi narasi "negara kafir", mendelegitimasi pemerintah, dan mendorong ketidaktaatan pada hukum. Sebagian anggota mulai memberi emoji jempol, sebagian lain diam saja. BNPT baru saja menggelar kampanye mitigasi radikalisasi digital di kampus Anda.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B D A E C</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengajak pengirim tautan berdiskusi secara pribadi untuk memahami latar belakangnya, sambil menjelaskan risiko penyebaran narasi radikal di ruang digital.<br><br>
                <strong>• D – Poin 4</strong><br>
                Mengarahkan grup untuk mengikuti diskusi atau materi literasi digital dari BNPT agar anggota lebih kritis terhadap konten keagamaan dan kebangsaan di media sosial.<br><br>
                <strong>• A – Poin 3</strong><br>
                Menghapus tautan tersebut dari grup dan mengingatkan secara umum bahwa konten yang berpotensi memecah belah dan bertentangan dengan hukum tidak sesuai dengan tujuan grup.<br><br>
                <strong>• E – Poin 2</strong><br>
                Melaporkan keberadaan konten tersebut kepada pihak kampus atau pengelola kegiatan mitigasi radikalisasi digital untuk mendapatkan arahan lanjutan.<br><br>
                <strong>• C – Poin 1</strong><br>
                Membiarkan diskusi berjalan sebagai bentuk kebebasan berekspresi mahasiswa, selama belum terjadi konflik terbuka.',
                'options' => [
                    ['option_text' => 'Menghapus tautan tersebut dari grup dan mengingatkan secara umum bahwa konten yang berpotensi memecah belah dan bertentangan dengan hukum tidak sesuai dengan tujuan grup.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Mengajak pengirim tautan berdiskusi secara pribadi untuk memahami latar belakangnya, sambil menjelaskan risiko penyebaran narasi radikal di ruang digital.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Membiarkan diskusi berjalan sebagai bentuk kebebasan berekspresi mahasiswa, selama belum terjadi konflik terbuka.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mengarahkan grup untuk mengikuti diskusi atau materi literasi digital dari BNPT agar anggota lebih kritis terhadap konten keagamaan dan kebangsaan di media sosial.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Melaporkan keberadaan konten tersebut kepada pihak kampus atau pengelola kegiatan mitigasi radikalisasi digital untuk mendapatkan arahan lanjutan.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di perpustakaan komunitas warga, muncul sumbangan beberapa buku agama dari sumber tidak resmi. Saat Anda baca sepintas, isinya banyak menjustifikasi kekerasan, mengkafirkan kelompok lain, dan memuja tokoh yang pernah terlibat tindak teror. Baru-baru ini, BNPT dan salah satu kampus besar mengevaluasi dan memusnahkan ribuan buku bermuatan radikal yang disita dari kasus pidana terorisme.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: A B C E D</strong><br><br>
                <strong>• A – Poin 5</strong><br>
                Mengamankan sementara buku-buku tersebut dari ruang baca umum, lalu berkoordinasi dengan pengelola dan pihak berwenang untuk penilaian lebih lanjut.<br><br>
                <strong>• B – Poin 4</strong><br>
                Mengajak pengelola perpustakaan berdiskusi untuk meninjau isi buku secara kritis dan menyepakati standar koleksi yang aman bagi masyarakat.<br><br>
                <strong>• C – Poin 3</strong><br>
                Melaporkan temuan tersebut kepada aparat penegak hukum atau instansi terkait agar ditangani sesuai ketentuan.<br><br>
                <strong>• E – Poin 2</strong><br>
                Mengganti buku-buku tersebut dengan literatur keagamaan moderat dan kebangsaan tanpa membahas lebih lanjut asal-usul sumbangan.<br><br>
                <strong>• D – Poin 1</strong><br>
                Membiarkan buku tetap tersedia karena perpustakaan bersifat terbuka dan masyarakat dapat menilai sendiri isi bacaan.',
                'options' => [
                    ['option_text' => 'Mengamankan sementara buku-buku tersebut dari ruang baca umum, lalu berkoordinasi dengan pengelola dan pihak berwenang untuk penilaian lebih lanjut.', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Mengajak pengelola perpustakaan berdiskusi untuk meninjau isi buku secara kritis dan menyepakati standar koleksi yang aman bagi masyarakat.', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Melaporkan temuan tersebut kepada aparat penegak hukum atau instansi terkait agar ditangani sesuai ketentuan.', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Membiarkan buku tetap tersedia karena perpustakaan bersifat terbuka dan masyarakat dapat menilai sendiri isi bacaan.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Mengganti buku-buku tersebut dengan literatur keagamaan moderat dan kebangsaan tanpa membahas lebih lanjut asal-usul sumbangan.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di lingkungan Anda, sekelompok warga mendesak agar kegiatan ibadah sebuah komunitas minoritas dihentikan dengan alasan "tidak sesuai budaya setempat". Mereka meminta Anda, sebagai pengurus RT, ikut menandatangani petisi agar rumah ibadah mereka ditutup. Padahal laporan lembaga pemantau menunjukkan tren kenaikan kasus pelanggaran kebebasan beragama dan intoleransi di Indonesia.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B A D E C</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengajak perwakilan warga dan komunitas minoritas berdialog untuk mencari solusi yang menjaga ketertiban lingkungan tanpa melanggar hak beribadah.<br><br>
                <strong>• A – Poin 4</strong><br>
                Menolak menandatangani petisi tersebut dan menjelaskan kepada warga bahwa kebebasan beragama dijamin oleh hukum serta perlu dijaga bersama.<br><br>
                <strong>• D – Poin 3</strong><br>
                Melaporkan tekanan warga tersebut kepada pihak kelurahan atau aparat terkait untuk mendapatkan pendampingan dan arahan resmi.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menunda sikap dan meminta waktu agar situasi tidak memanas, sambil mengamati perkembangan di lingkungan.<br><br>
                <strong>• C – Poin 1</strong><br>
                Menandatangani petisi demi menjaga ketenangan lingkungan sambil berharap persoalan tidak berkembang menjadi konflik terbuka.',
                'options' => [
                    ['option_text' => 'Menolak menandatangani petisi tersebut dan menjelaskan kepada warga bahwa kebebasan beragama dijamin oleh hukum serta perlu dijaga bersama.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengajak perwakilan warga dan komunitas minoritas berdialog untuk mencari solusi yang menjaga ketertiban lingkungan tanpa melanggar hak beribadah.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Menandatangani petisi demi menjaga ketenangan lingkungan sambil berharap persoalan tidak berkembang menjadi konflik terbuka.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Melaporkan tekanan warga tersebut kepada pihak kelurahan atau aparat terkait untuk mendapatkan pendampingan dan arahan resmi.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menunda sikap dan meminta waktu agar situasi tidak memanas, sambil mengamati perkembangan di lingkungan.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Sebagai pengurus BEM, Anda mendapat tawaran kerja sama dari sebuah kelompok luar kampus untuk mengadakan "kajian eksklusif" di luar jadwal resmi. Mereka menolak dicantumkan sebagai organisasi di poster, meminta acara tidak diumumkan di kanal resmi kampus, dan mensyaratkan peserta menyerahkan fotokopi KTP. Isu terkini menunjukkan bahwa beberapa jaringan radikal memanfaatkan kegiatan kajian tertutup di kampus untuk rekrutmen kader.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C E B A D</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Mengonsultasikan tawaran kegiatan tersebut kepada pihak kampus atau pembina kemahasiswaan untuk mendapatkan arahan dan pertimbangan keamanan.<br><br>
                <strong>• E – Poin 4</strong><br>
                Menyarankan agar kegiatan dialihkan menjadi acara terbuka dengan prosedur resmi kampus jika ingin bekerja sama dengan BEM.<br><br>
                <strong>• B – Poin 3</strong><br>
                Mengajak pihak penawar berdiskusi untuk meminta kejelasan identitas, tujuan kegiatan, dan mekanisme pelaksanaan sebelum mengambil keputusan.<br><br>
                <strong>• A – Poin 2</strong><br>
                Menolak kerja sama tersebut karena tidak sesuai dengan prinsip transparansi kegiatan kemahasiswaan dan berpotensi menimbulkan risiko.<br><br>
                <strong>• D – Poin 1</strong><br>
                Mengizinkan kegiatan berlangsung secara terbatas karena bersifat kajian dan tidak diumumkan ke publik luas.',
                'options' => [
                    ['option_text' => 'Menolak kerja sama tersebut karena tidak sesuai dengan prinsip transparansi kegiatan kemahasiswaan dan berpotensi menimbulkan risiko.', 'weight' => 2, 'order' => 1],
                    ['option_text' => 'Mengajak pihak penawar berdiskusi untuk meminta kejelasan identitas, tujuan kegiatan, dan mekanisme pelaksanaan sebelum mengambil keputusan.', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Mengonsultasikan tawaran kegiatan tersebut kepada pihak kampus atau pembina kemahasiswaan untuk mendapatkan arahan dan pertimbangan keamanan.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Mengizinkan kegiatan berlangsung secara terbatas karena bersifat kajian dan tidak diumumkan ke publik luas.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyarankan agar kegiatan dialihkan menjadi acara terbuka dengan prosedur resmi kampus jika ingin bekerja sama dengan BEM.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Densus 88 dan instansi terkait mengadakan sosialisasi kebangsaan dan kerukunan di daerah Anda, karena sebelumnya ada indikasi peningkatan intoleransi. Sebagian warga berbisik bahwa acara ini hanya "alat stigmatisasi" dan menolak hadir. Ketua RW meminta Anda membantu meningkatkan kehadiran warga.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B D A E C</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengajak tokoh masyarakat setempat untuk ikut mendukung dan menjembatani komunikasi agar warga merasa lebih nyaman menghadiri kegiatan.<br><br>
                <strong>• D – Poin 4</strong><br>
                Mengusulkan kepada panitia agar format kegiatan dibuat lebih dialogis dan melibatkan warga secara aktif, sehingga tidak terkesan satu arah.<br><br>
                <strong>• A – Poin 3</strong><br>
                Menjelaskan kepada warga bahwa kegiatan tersebut bertujuan memperkuat kebersamaan dan ketahanan sosial, bukan menuding pihak tertentu.<br><br>
                <strong>• E – Poin 2</strong><br>
                Membiarkan warga yang menolak hadir karena kehadiran tidak dapat dipaksakan dan berpotensi menimbulkan resistensi.<br><br>
                <strong>• C – Poin 1</strong><br>
                Meminta warga tetap hadir karena kegiatan tersebut melibatkan aparat negara dan bersifat resmi.',
                'options' => [
                    ['option_text' => 'Menjelaskan kepada warga bahwa kegiatan tersebut bertujuan memperkuat kebersamaan dan ketahanan sosial, bukan menuding pihak tertentu.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Mengajak tokoh masyarakat setempat untuk ikut mendukung dan menjembatani komunikasi agar warga merasa lebih nyaman menghadiri kegiatan.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Meminta warga tetap hadir karena kegiatan tersebut melibatkan aparat negara dan bersifat resmi.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mengusulkan kepada panitia agar format kegiatan dibuat lebih dialogis dan melibatkan warga secara aktif, sehingga tidak terkesan satu arah.', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Membiarkan warga yang menolak hadir karena kehadiran tidak dapat dipaksakan dan berpotensi menimbulkan resistensi.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Beberapa tahun terakhir, hampir tidak ada serangan teror besar di Indonesia. Seorang rekan kantor berkata, "Berarti ancaman terorisme sudah selesai. Program antiradikalisme nggak penting lagi, buang-buang anggaran." Padahal, kajian menunjukkan bahwa jaringan teror beralih ke pola radikalisasi online dan lone-wolf.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B E A D C</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengajak rekan tersebut berdiskusi dengan menunjukkan data dan kajian terbaru tentang pergeseran pola radikalisasi ke ruang digital.<br><br>
                <strong>• E – Poin 4</strong><br>
                Menyarankan agar evaluasi anggaran dilakukan tanpa mengabaikan fungsi pencegahan, dengan menyesuaikan pendekatan terhadap tantangan radikalisasi digital.<br><br>
                <strong>• A – Poin 3</strong><br>
                Menjelaskan secara singkat bahwa menurunnya serangan fisik justru merupakan hasil dari upaya pencegahan, termasuk program antiradikalisme.<br><br>
                <strong>• D – Poin 2</strong><br>
                Menyampaikan bahwa program antiradikalisme tetap penting sebagai langkah pencegahan jangka panjang meskipun ancaman tidak terlihat secara kasat mata.<br><br>
                <strong>• C – Poin 1</strong><br>
                Membiarkan pendapat tersebut karena setiap orang berhak memiliki pandangan sendiri terkait kebijakan pemerintah.',
                'options' => [
                    ['option_text' => 'Menjelaskan secara singkat bahwa menurunnya serangan fisik justru merupakan hasil dari upaya pencegahan, termasuk program antiradikalisme.', 'weight' => 3, 'order' => 1],
                    ['option_text' => 'Mengajak rekan tersebut berdiskusi dengan menunjukkan data dan kajian terbaru tentang pergeseran pola radikalisasi ke ruang digital.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Membiarkan pendapat tersebut karena setiap orang berhak memiliki pandangan sendiri terkait kebijakan pemerintah.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Menyampaikan bahwa program antiradikalisme tetap penting sebagai langkah pencegahan jangka panjang meskipun ancaman tidak terlihat secara kasat mata.', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menyarankan agar evaluasi anggaran dilakukan tanpa mengabaikan fungsi pencegahan, dengan menyesuaikan pendekatan terhadap tantangan radikalisasi digital.', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam diskusi internal kantor soal program deradikalisasi, seorang rekan berkata, "Kalau bicara radikalisme ya pasti terkait agama X, jadi program ini sebenarnya menyasar kelompok itu saja." Padahal berbagai kajian mengingatkan agar tidak menggeneralisasi dan menstigmatisasi kelompok agama tertentu dalam isu terorisme.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: B A D E C</strong><br><br>
                <strong>• B – Poin 5</strong><br>
                Mengajak rekan tersebut berdiskusi lebih lanjut dengan merujuk pada kajian dan kebijakan resmi yang menekankan pendekatan non-diskriminatif dalam penanganan radikalisme.<br><br>
                <strong>• A – Poin 4</strong><br>
                Meluruskan pernyataan tersebut dengan menyampaikan bahwa radikalisme tidak melekat pada agama tertentu dan program deradikalisasi bertujuan mencegah kekerasan ekstrem dari berbagai latar belakang.<br><br>
                <strong>• D – Poin 3</strong><br>
                Menyampaikan bahwa penyederhanaan isu radikalisme justru berisiko menimbulkan stigma dan kontraproduktif terhadap tujuan pencegahan.<br><br>
                <strong>• E – Poin 2</strong><br>
                Menyarankan agar diskusi difokuskan pada aspek teknis program tanpa membahas latar belakang agama pelaku radikalisme.<br><br>
                <strong>• C – Poin 1</strong><br>
                Membiarkan pernyataan tersebut agar diskusi tetap berjalan dan tidak menimbulkan perdebatan yang sensitif.',
                'options' => [
                    ['option_text' => 'Meluruskan pernyataan tersebut dengan menyampaikan bahwa radikalisme tidak melekat pada agama tertentu dan program deradikalisasi bertujuan mencegah kekerasan ekstrem dari berbagai latar belakang.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengajak rekan tersebut berdiskusi lebih lanjut dengan merujuk pada kajian dan kebijakan resmi yang menekankan pendekatan non-diskriminatif dalam penanganan radikalisme.', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Membiarkan pernyataan tersebut agar diskusi tetap berjalan dan tidak menimbulkan perdebatan yang sensitif.', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Menyampaikan bahwa penyederhanaan isu radikalisme justru berisiko menimbulkan stigma dan kontraproduktif terhadap tujuan pencegahan.', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menyarankan agar diskusi difokuskan pada aspek teknis program tanpa membahas latar belakang agama pelaku radikalisme.', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialTKP->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Komunitas pemuda tempat Anda aktif diundang ikut kerja sama dengan BNPT dan lembaga internasional untuk kampanye anti-radikalisasi online. Beberapa anggota menolak karena khawatir dituduh "alat penguasa" dan lebih suka komunitas bersikap netral. Padahal laporan menunjukkan pentingnya kolaborasi pemerintah–masyarakat sipil dalam mencegah ekstremisme kekerasan.<br><br>Sikap Anda yang paling tepat adalah ....',
                'explanation' => '<strong>Jawaban: C A E B D</strong><br><br>
                <strong>• C – Poin 5</strong><br>
                Mengusulkan bentuk kerja sama yang tetap menjaga identitas dan kemandirian komunitas, misalnya fokus pada literasi digital dan kampanye damai tanpa narasi politis.<br><br>
                <strong>• A – Poin 4</strong><br>
                Mengajak anggota komunitas berdiskusi terbuka untuk menjelaskan tujuan kerja sama, ruang independensi komunitas, dan manfaat pencegahan radikalisme bagi masyarakat luas.<br><br>
                <strong>• E – Poin 3</strong><br>
                Menyarankan agar komunitas menunda keputusan sambil mengamati respons publik terhadap kerja sama serupa di tempat lain.<br><br>
                <strong>• B – Poin 2</strong><br>
                Menerima kerja sama tersebut tanpa banyak diskusi internal karena program antiradikalisasi merupakan kepentingan bersama.<br><br>
                <strong>• D – Poin 1</strong><br>
                Menolak kerja sama agar komunitas tetap netral dan terhindar dari risiko stigma di masyarakat.',
                'options' => [
                    ['option_text' => 'Mengajak anggota komunitas berdiskusi terbuka untuk menjelaskan tujuan kerja sama, ruang independensi komunitas, dan manfaat pencegahan radikalisme bagi masyarakat luas.', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menerima kerja sama tersebut tanpa banyak diskusi internal karena program antiradikalisasi merupakan kepentingan bersama.', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Mengusulkan bentuk kerja sama yang tetap menjaga identitas dan kemandirian komunitas, misalnya fokus pada literasi digital dan kampanye damai tanpa narasi politis.', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Menolak kerja sama agar komunitas tetap netral dan terhindar dari risiko stigma di masyarakat.', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyarankan agar komunitas menunda keputusan sambil mengamati respons publik terhadap kerja sama serupa di tempat lain.', 'weight' => 3, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal untuk TKP
        foreach ($questionsTKP as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => false,
                    'weight' => $optionData['weight'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder TKP lengkap berhasil dibuat!');
        $this->command->info('Total soal TKP: ' . count($questionsTKP) . ' soal');
    }
}
