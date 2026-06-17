<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TIUTOPAKET3Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Soal TIU nomor 31-65
        $questions = [
            // --- Soal 31 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Musik : Nada : Planet : ...',
                'explanation' => 'Hubungan ini menunjukkan bahwa nada adalah bagian dari musik, sedangkan galaksi adalah bagian dari planet.',
                'options' => [
                    ['Galaksi', 1],
                    ['Matahari', 0],
                    ['Satelit', 0],
                    ['Bumi', 0],
                    ['Bintang', 0],
                ],
            ],
            // --- Soal 32 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Hubungan objek pada kalimat "Ayah menangkap belalang, mengusir katak dan mengejar seekor ular besar." Setara dengan.',
                'explanation' => '',
                'options' => [
                    ['Kakak memotong rumput setelah itu memberi makan sapi dan bekerja bersama manusia lainnya', 1],
                    ['Pak Budi menangkap cacing untuk memberi makan ayam dan bebek peliharaannya.', 0],
                    ['Ibu menanam bunga dari jenis mawar hingga Melati', 0],
                    ['Nelayan membuat umpan untuk menangkap ikan dan udang di laut', 0],
                    ['Adik meminum susu yang berasal dari susu sapi segar yang baik untuk kesehatan tubuh', 0],
                ],
            ],
            // --- Soal 33 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Hubungan objek pada kalimat "Setiap nasabah prioritas memiliki uang miliaran di bank". Setara dengan.',
                'explanation' => '',
                'options' => [
                    ['Pak Rustam menebang kayu di hutan', 0],
                    ['Pak Tani menyimpan padi hasil panen di lumbung', 1],
                    ['Ibu membeli lusinan baju langsung dan pabrik tekstil', 0],
                    ['Kakak mencuci pakaian miliknya di jasa laundry', 0],
                    ['Rahmi memasak nasi di dapur.', 0],
                ],
            ],
            // --- Soal 34 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Gelas kosong : gelas penuh air : air dalam gelas tumpah.<br>Hubungan kata di atas setara dengan...',
                'explanation' => 'Tas kosong : tas penuh buku : buku berserakan<br>Karena menunjukkan urutan logis dari kondisi wadah yang kosong, kemudian terisi penuh, dan akhirnya isinya keluar/berantakan, sama seperti pola soal.',
                'options' => [
                    ['perut lapar : perut kenyang : muntah', 0],
                    ['dompet kosong : dompet berisi : uang hilang', 0],
                    ['tas kosong : tas penuh buku : buku berserakan', 1],
                    ['pikiran kosong : pikiran penuh ide : ide terbuang', 0],
                    ['mobil kosong : mobil penumpang penuh : kecelakaan', 0],
                ],
            ],
            // --- Soal 35 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ada cita-cita : ada peluang<br>Hubungan kata di atas setara dengan...',
                'explanation' => 'Ada niat : ada jalan<br>Karena menunjukkan hubungan sebab-akibat antara keinginan dan kesempatan untuk mewujudkannya, sama seperti pola soal.',
                'options' => [
                    ['ada masalah : ada Solusi', 0],
                    ['ada uang : ada barang', 0],
                    ['ada waktu : ada kegiatan', 0],
                    ['ada niat : ada jalan', 1],
                    ['ada kerja : ada hasil', 0],
                ],
            ],
            // --- Soal 36 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Semua mahasiswa berprestasi memiliki kesempatan bertemu Presiden.<br>Semua peserta program beasiswa ini adalah mahasiswa berprestasi.<br>Simpulan yang tepat atas pernyataan di atas adalah',
                'explanation' => 'Simpulan yang tepat atas pernyataan di atas adalah: C. Semua peserta program beasiswa ini memiliki kesempatan bertemu Presiden. Karena semua mahasiswa berprestasi memiliki kesempatan bertemu Presiden, dan semua peserta program beasiswa adalah mahasiswa berprestasi.',
                'options' => [
                    ['Tidak semua mahasiswa dapat bertemu Presiden.', 0],
                    ['Tidak semua mahasiswa menjadi peserta program beasiswa ini.', 0],
                    ['Semua peserta program beasiswa ini memiliki kesempatan bertemu Presiden.', 1],
                    ['Sebagian peserta program beasiswa ini memiliki kesempatan bertemu Presiden.', 0],
                    ['Semua mahasiswa yang memiliki kesempatan bertemu Presiden adalah peserta program beasiswa ini.', 0],
                ],
            ],
            // --- Soal 37 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Metode penanganan kanker semakin modern. Sejak pertama diketahui mengidap kanker, pada tahun 1950-an, 60% penderita kanker hidup selama 5 tahun. Sedangkan tahun 1980-an, 65% penderita kanker hidup selama 8 tahun. Simpulan yang tepat adalah ....',
                'explanation' => '',
                'options' => [
                    ['Tahun 1950-an, hanya 60% penderita kanker yang ditangani, sedangkan 1980-an persentase penderita kanker yang ditangani lebih tinggi.', 0],
                    ['Tahun 1980-an, 35% penderita kanker tidak ditangani seperti penderita pada tahun 1950-an.', 0],
                    ['Tahun 1950-an tidak pernah dilakukan pendeteksian terhadap pengidap kanker secara lebih awal seperti pada tahun 1980-an.', 0],
                    ['Tahun 1980-an lebih banyak penderita kanker yang ditangani lebih baik daripada penderita kanker pada tahun 1950-an.', 1],
                    ['Tahun 1980-an jumlah penderita kanker lebih banyak daripada jumlah penderita kanker tahun 1950-an.', 0],
                ],
            ],
            // --- Soal 38 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Kulit ketiak merupakan bagian tubuh yang banyak mengandung bakteri daripada bagian tubuh yang lain. Makin banyak bakteri terdapat pada tubuh seseorang, makin besar risiko seseorang memiliki bau badan yang tidak sedap.<br>Berdasarkan informasi di atas, manakah pernyataan Berikut PALING MUNGKIN BENAR?',
                'explanation' => '',
                'options' => [
                    ['Yang memiliki bau badan yang tidak sedap memiliki banyak bakteri di kulit ketiaknya.', 0],
                    ['Orang yang memiliki bau badan yang harum tidak memiliki bakteri di kulit ketiaknya.', 0],
                    ['Kulit ketiak yang sering dibersihkan tidak menimbulkan bau badan.', 0],
                    ['Bagian tubuh selain kulit ketiak tidak mengandung bakteri penyebab bau badan.', 0],
                    ['Orang yang memiliki banyak bakteri pada kulit ketiaknya cenderung mengalami bau badan tidak sedap.', 1],
                ],
            ],
            // --- Soal 39 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Tidak ada peserta debat bahasa RR menggunakan kemeja putih.<br>Semua anggota klub olah raga BB menggunakan kemeja putih.<br>Simpulan yang tepat atas pernyataan di atas adalah ...',
                'explanation' => 'Simpulan yang tepat atas pernyataan di atas adalah: E. Tidak ada anggota klub olah raga BB yang merupakan peserta debat bahasa RR. Karena semua anggota klub olahraga BB menggunakan kemeja putih, sedangkan tidak ada peserta debat yang menggunakan kemeja putih.',
                'options' => [
                    ['sebagian anggota klub olah raga BB merupakan peserta debat bahasa RR.', 0],
                    ['semua anggota klub olah raga BB merupakan peserta debat bahasa RR.', 0],
                    ['beberapa anggota klub olah raga BB merupakan peserta debat bahasa RR.', 0],
                    ['ada anggota klub olah raga BB merupakan peserta debat bahasa RR.', 0],
                    ['tidak ada anggota klub olah raga BB yang merupakan peserta debat bahasa RR.', 1],
                ],
            ],
            // --- Soal 40 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Terdapat enam orang pembalap motor: A, B, C, D, E, dan F. Kecepatan pembalap A lebih cepat daripada B. Kecepatan pembalap D dan F sama cepatnya. Kecepatan pembalap C sama cepat dengan pembalap B dan lebih cepat daripada pembalap E. Jika kecepatan pembalap D lebih cepat daripada A, maka...',
                'explanation' => '',
                'options' => [
                    ['pembalap A hanya dikalahkan oleh pembalap D.', 0],
                    ['pembalap C lebih cepat daripada pembalap F.', 0],
                    ['pembalap F lebih cepat daripada pembalap B.', 1],
                    ['pembalap E lebih cepat daripada pembalap B.', 0],
                    ['pembalap D lebih cepat daripada semuanya.', 0],
                ],
            ],
            // --- Soal 41 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dua baris kursi disediakan untuk 6 enam orang yang diatur saling berhadapan. Pada baris kursi pertama, kursi kosong berada di antara Dina dan Rika serta Dina berhadapan dengan Eka. Pada baris kursi yang lain terdapat Putri yang duduk diapit oleh Eka dan Irma. Selain Eka, ada Siti yang duduk di ujung baris kursi kedua. Siapakah yang duduk di depan Rika?',
                'explanation' => '',
                'options' => [
                    ['Putri', 0],
                    ['Dina', 0],
                    ['Irma', 1],
                    ['Rika', 0],
                    ['Siti', 0],
                ],
            ],
            // --- Soal 42 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Empat anak bermain ular tangga dan dua orang lagi bergabung untuk melihat permainan sehingga mereka duduk melingkar. Gino duduk persis di sebelah Ana dan di samping kanan Sofi. Tomi duduk di sebelah kanan Ana dan berjarak dua orang dengan Sofi. Tomi duduk di sebelah kiri Iita dan berjarak satu orang dengan Rudi. Siapakah yang duduk di sebelah kanan Rudi?',
                'explanation' => '',
                'options' => [
                    ['Iita', 0],
                    ['Sofi', 1],
                    ['Ana', 0],
                    ['Gino', 0],
                    ['Tomi', 0],
                ],
            ],
            // --- Soal 43 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Sari sedang menata lima tanamannya berdasarkan posisi rak dan warna pot yang digunakan. Bunga Mawar dimasukkan dalam pot warna putih dan diletakkan di rak paling bawah, sama dengan bunga melati. Bunga kenanga dan bunga tulip diletakkan di rak tengah. Bunga anggrek diletakkan di rak yang berbeda dengan mawar dan kenanga, namun dalam pot yang sama dengan kenanga yaitu pot coklat. Bunga lainnya yang ada di rak tengah dimasukkan dalam pot warna hijau. Bunga apakah yang disimpan di rak tengah dan memiliki pot warna hijau?',
                'explanation' => 'Dari informasi yang diberikan, bunga tulip berada di rak tengah dan pot warna hijau. Bunga kenanga berada di pot coklat di rak yang berbeda dari mawar dan kenanga.',
                'options' => [
                    ['Mawar', 0],
                    ['Melati', 0],
                    ['Kenanga', 0],
                    ['Tulip', 1],
                    ['Sepatu', 0],
                ],
            ],
            // --- Soal 44 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '8,5 + 12½ - 9 = ....',
                'explanation' => '8.5 + 12.5 - 9 = 21 - 9 = 12',
                'options' => [
                    ['6', 0],
                    ['8', 0],
                    ['12', 1],
                    ['16', 0],
                    ['20', 0],
                ],
            ],
            // --- Soal 45 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '1000 – 20 – 57,5 + 15,25 = ...',
                'explanation' => '1000 - 20 = 980<br>980 - 57.5 = 922.5<br>922.5 + 15.25 = 937.75',
                'options' => [
                    ['922,5', 0],
                    ['937,75', 1],
                    ['973,15', 0],
                    ['980,25', 0],
                    ['1001,75', 0],
                ],
            ],
            // --- Soal 46 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '3 × 2⅓ : 3 + 2 – 5 = ...',
                'explanation' => '',
                'options' => [
                    ['2', 0],
                    ['4', 0],
                    ['6', 0],
                    ['8', 0],
                    ['10', 1],
                ],
            ],
            // --- Soal 47 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '-21, -18, -15, -12, -9, -6, -3, ...., ...',
                'explanation' => '',
                'options' => [
                    ['0, 3', 1],
                    ['0, 6', 0],
                    ['3, 6', 0],
                    ['3, 9', 0],
                    ['6, 9', 0],
                ],
            ],
            // --- Soal 48 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '1, 3, 9, 27, 81, 243, 729, ...., ....',
                'explanation' => '',
                'options' => [
                    ['972, 1215', 0],
                    ['1558, 2187', 0],
                    ['2187, 2816', 0],
                    ['2816, 6561', 0],
                    ['2187, 6561', 1],
                ],
            ],
            // --- Soal 49 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '81, 162, 54, 108, 36, 72, 24, ...., ....',
                'explanation' => '',
                'options' => [
                    ['48, 16', 1],
                    ['18, 32', 0],
                    ['15, 32', 0],
                    ['15, 18', 0],
                    ['8, 18', 0],
                ],
            ],
            // --- Soal 50 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diberikan barisan bilangan dengan pola sebagai berikut:<br>1, 2, 2, 6, 4, 18, 8, ...., ....<br>Bilangan yang ke-8 dan ke-9 dari barisan tersebut adalah .....',
                'explanation' => '',
                'options' => [
                    ['18, 4', 0],
                    ['20, 10', 0],
                    ['54, 16', 1],
                    ['36, 24', 0],
                    ['9, 10', 0],
                ],
            ],
            // --- Soal 51 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '<table border="1" cellpadding="5"><tr><td>x</td><td>y</td></tr><tr><td>76 : 1/2</td><td>152 : 4/2</td></tr></table><br>Hubungan antara x dan y adalah ...',
                'explanation' => '',
                'options' => [
                    ['x = y', 0],
                    ['3x = y', 0],
                    ['x = 3y', 0],
                    ['2x = y', 0],
                    ['x = 2y', 1],
                ],
            ],
            // --- Soal 52 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '<table border="1" cellpadding="5"><tr><td>a</td><td>b</td></tr><tr><td>Ahmad mempunyai 54% dari saham perusahaan. Karena sudah lanjut usia, dia membagi saham tersebut kepada tiga orang anaknya secara rata.</td><td>3/16</td></tr></table><br>Hubungan antara a dan b adalah ...',
                'explanation' => '',
                'options' => [
                    ['a = b', 0],
                    ['a > b', 0],
                    ['a < b', 1],
                    ['2a = b', 0],
                    ['a = 2b', 0],
                ],
            ],
            // --- Soal 53 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => '<table border="1" cellpadding="5"><tr><td>X = 2p + q</td><td>Y = p + 7q</td></tr></table><br>Jika p = 7 dan q = 1, maka ....',
                'explanation' => '',
                'options' => [
                    ['X = Y + 1', 1],
                    ['X = Y - 1', 0],
                    ['X = Y', 0],
                    ['X = 2Y', 0],
                    ['X', 0],
                ],
            ],
            // --- Soal 54 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Soal perbandingan atau persentase (teks tidak lengkap di file).',
                'explanation' => '',
                'options' => [
                    ['Opsi A', 0],
                    ['Opsi B', 1],
                    ['Opsi C', 0],
                    ['Opsi D', 0],
                    ['Opsi E', 0],
                ],
            ],
            // --- Soal 55 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Soal perbandingan atau persentase (teks tidak lengkap di file).',
                'explanation' => '',
                'options' => [
                    ['Opsi A', 0],
                    ['Opsi B', 0],
                    ['Opsi C', 0],
                    ['Opsi D', 1],
                    ['Opsi E', 0],
                ],
            ],
            // --- Soal 56 ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Soal tabel atau perbandingan (teks tidak lengkap di file).',
                'explanation' => '',
                'options' => [
                    ['Opsi A', 0],
                    ['Opsi B', 0],
                    ['Opsi C', 0],
                    ['Opsi D', 1],
                    ['Opsi E', 0],
                ],
            ],
            // --- Soal 57 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 57 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 57 (benar)', 1],
                    ['Ini opsi B soal nomor 57 (salah)', 0],
                    ['Ini opsi C soal nomor 57 (salah)', 0],
                    ['Ini opsi D soal nomor 57 (salah)', 0],
                    ['Ini opsi E soal nomor 57 (salah)', 0],
                ],
            ],
            // --- Soal 58 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 58 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 58 (benar)', 1],
                    ['Ini opsi B soal nomor 58 (salah)', 0],
                    ['Ini opsi C soal nomor 58 (salah)', 0],
                    ['Ini opsi D soal nomor 58 (salah)', 0],
                    ['Ini opsi E soal nomor 58 (salah)', 0],
                ],
            ],
            // --- Soal 59 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 59 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 59 (salah)', 0],
                    ['Ini opsi B soal nomor 59 (salah)', 0],
                    ['Ini opsi C soal nomor 59 (salah)', 0],
                    ['Ini opsi D soal nomor 59 (benar)', 1],
                    ['Ini opsi E soal nomor 59 (salah)', 0],
                ],
            ],
            // --- Soal 60 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 60 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 60 (salah)', 0],
                    ['Ini opsi B soal nomor 60 (salah)', 0],
                    ['Ini opsi C soal nomor 60 (benar)', 1],
                    ['Ini opsi D soal nomor 60 (salah)', 0],
                    ['Ini opsi E soal nomor 60 (salah)', 0],
                ],
            ],
            // --- Soal 61 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 61 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 61 (salah)', 0],
                    ['Ini opsi B soal nomor 61 (salah)', 0],
                    ['Ini opsi C soal nomor 61 (benar)', 1],
                    ['Ini opsi D soal nomor 61 (salah)', 0],
                    ['Ini opsi E soal nomor 61 (salah)', 0],
                ],
            ],
            // --- Soal 62 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 62 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 62 (salah)', 0],
                    ['Ini opsi B soal nomor 62 (salah)', 0],
                    ['Ini opsi C soal nomor 62 (benar)', 1],
                    ['Ini opsi D soal nomor 62 (salah)', 0],
                    ['Ini opsi E soal nomor 62 (salah)', 0],
                ],
            ],
            // --- Soal 63 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 63 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 63 (salah)', 0],
                    ['Ini opsi B soal nomor 63 (salah)', 0],
                    ['Ini opsi C soal nomor 63 (salah)', 0],
                    ['Ini opsi D soal nomor 63 (salah)', 0],
                    ['Ini opsi E soal nomor 63 (benar)', 1],
                ],
            ],
            // --- Soal 64 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 64 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 64 (salah)', 0],
                    ['Ini opsi B soal nomor 64 (salah)', 0],
                    ['Ini opsi C soal nomor 64 (salah)', 0],
                    ['Ini opsi D soal nomor 64 (salah)', 0],
                    ['Ini opsi E soal nomor 64 (benar)', 1],
                ],
            ],
            // --- Soal 65 (Gambar) ---
            [
                'material_id' => 31,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ini soal nomor 65 (soal gambar).',
                'explanation' => '',
                'options' => [
                    ['Ini opsi A soal nomor 65 (salah)', 0],
                    ['Ini opsi B soal nomor 65 (salah)', 0],
                    ['Ini opsi C soal nomor 65 (salah)', 0],
                    ['Ini opsi D soal nomor 65 (benar)', 1],
                    ['Ini opsi E soal nomor 65 (salah)', 0],
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
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder untuk TIU Paket 3 (35 soal) berhasil ditambahkan.');
    }
}
