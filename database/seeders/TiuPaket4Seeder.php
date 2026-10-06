<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiuPaket4Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $materialId = 7;

        $questions = [
            [
                'text' => 'Sebuah pekerjaan dapat diselesaikan oleh sejumlah pekerja dalam waktu 24 hari. Jika jumlah pekerja ditambah 4 orang, berapa hari pekerjaan tersebut akan selesai?<br>(1) Jika jumlah pekerja awal dikurangi 4 orang, pekerjaan akan selesai dalam 36 hari.<br>(2) Jumlah pekerja awal adalah 12 orang.',
                'image' => null,
                'options' => [
                    ['Pernyataan (1) SAJA cukup untuk menjawab pertanyaan, tetapi pernyataan (2) SAJA tidak cukup.', 0],
                    ['Pernyataan (2) SAJA cukup untuk menjawab pertanyaan, tetapi pernyataan (1) SAJA tidak cukup.', 0],
                    ['DUA pernyataan BERSAMA-SAMA cukup untuk menjawab pertanyaan, tetapi SATU pernyataan SAJA tidak cukup.', 0],
                    ['Pernyataan (1) SAJA cukup untuk menjawab pertanyaan dan pernyataan (2) SAJA cukup.', 1],
                    ['Pernyataan (1) dan pernyataan (2) tidak cukup untuk menjawab pertanyaan.', 0],
                ],
            ],
            [
                'text' => 'Rina akan mengecat dinding rumahnya yang seluas 90 m². Berapa rupiah yang harus dibayar Rina untuk membeli cat tersebut?<br>(1) Satu kaleng cat cukup untuk mengecat dinding seluas 30 m².<br>(2) Harga satu kaleng cat adalah Rp250.000.',
                'image' => null,
                'options' => [
                    ['Pernyataan (1) SAJA cukup untuk menjawab pertanyaan, tetapi pernyataan (2) SAJA tidak cukup.', 0],
                    ['Pernyataan (2) SAJA cukup untuk menjawab pertanyaan, tetapi pernyataan (1) SAJA tidak cukup.', 0],
                    ['DUA pernyataan BERSAMA-SAMA cukup untuk menjawab pertanyaan, tetapi SATU pernyataan SAJA tidak cukup.', 1],
                    ['Pernyataan (1) SAJA cukup untuk menjawab pertanyaan dan pernyataan (2) SAJA cukup.', 0],
                    ['Pernyataan (1) dan pernyataan (2) tidak cukup untuk menjawab pertanyaan.', 0],
                ],
            ],
            [
                'text' => 'Siswa ENS Makassar mengerjakan soal SKD dengan teliti. Kalimat yang mempunyai pola sama dengan pola tersebut adalah….',
                'image' => null,
                'options' => [
                    ['Adika menangis dengan keras', 0],
                    ['Kak ari membaca komik yang lucu', 0],
                    ['Siswa kelas 12 merayakan kelulusan secara meriah', 1],
                    ['Ayah bekerja dengan giat', 0],
                    ['Langit mala mini bertaburan Bintang-bintang', 0],
                ],
            ],
            [
                'text' => 'Seorang penyanyi Meksiko menyanyikan lagu terbaru yang sangat indah. Hubungan pola kalimat yang sama adalah…',
                'image' => null,
                'options' => [
                    ['Teman saya mentraktir saya makanan mahal', 1],
                    ['Ayah mengendarai sepeda motor untuk pergi belanja di swalayan', 0],
                    ['Composer menciptakan lagu agar bisa di nyanyikan', 0],
                    ['Banyak siswa belajar di ENS agar bisa lulus di sekolah kedinasan', 0],
                    ['M. city membeli Haaland untuk menjuarai liga Champion', 0],
                ],
            ],
            [
                'text' => 'Peluh: Lelah = Asap:…',
                'image' => null,
                'options' => [
                    ['Api', 1],
                    ['Hitam', 0],
                    ['Putih', 0],
                    ['Tebal', 0],
                    ['Kabut', 0],
                ],
            ],
            [
                'text' => 'Semua peserta seminar di aula adalah penggiat pariwisata. Semua yang memakai kostum merah adalah peserta seminar di aula. Simpulan yang tepat untuk pernyataan di atas adalah…',
                'image' => null,
                'options' => [
                    ['Semua penggiat par iwisata harus berkostum merah.', 0],
                    ['Semua penggiat pariwisata adalah peserta seminar di aula.', 0],
                    ['Semua yang memakai kostum merah adalah penggiat pariwisata', 1],
                    ['Tidak semua yang berkostum merah adalah peserta seminar di aula', 0],
                    ['Hanya peserta seminar di aula yang berkostum merah saja yang merupakan penggiat pariwisata', 0],
                ],
            ],
            [
                'text' => 'Tidak semua ransel terbuat dari bahan anti air. Beberapa orang menyukai tas ransel. Simpulan yang tepat atas pernyataan di atas adalah…',
                'image' => null,
                'options' => [
                    ['tas ransel anti air disukai orang', 0],
                    ['beberapa tas ransel disukai orang', 0],
                    ['beberapa orang menyukai tas ransel anti air', 0],
                    ['beberapa orang menyukai tas yang bukan terbuat dari bahan anti air', 1],
                    ['bahan anti air disukai oleh beberapa orang yang menyukai tas ransel', 0],
                ],
            ],
            [
                'text' => 'Semua ruang rapat di PT Air Minum memiliki proyektor. Tidak ada ruang di lantai 2 di PT Air Minum memiliki proyektor. Simpulan yang tepat pernyataan di atas adalah',
                'image' => null,
                'options' => [
                    ['Sebagian ruang rapat di PT Air Minum menyediakan proyektor.', 0],
                    ['Sebagian ruang rapat PT Air Minum berada di lantai 2.', 0],
                    ['Tidak ada proyektor yang disediakan dalam ruang rapat di PT Air Minum.', 0],
                    ['Tidak ada ruang di lantai 2 di PT Air Minum yang merupakan ruang rapat.', 1],
                    ['Semua ruang di PT Air Minum dapat dijadikan ruang rapat.', 0],
                ],
            ],
            [
                'text' => 'Tidak ada warga desa ini yang menempuh pendidikan di kota. Semua kerabat jauh saya menempuh pendidikan di kota Simpulan yang tepat atas pernyataan di atas adalah..',
                'image' => null,
                'options' => [
                    ['Sebagian kerabat jauh saya mungkin tinggal di desa ini', 0],
                    ['Tidak ada kerabat jauh saya yang merupakan warga desa ini.', 0],
                    ['Sebagian warga desa ini bukan merupakan kerabat jauh saya.', 1],
                    ['Semua kerabat jauh saya pernah juga menempuh pendidikan di desa ini.', 0],
                    ['Sebagian warga desa ini merupakan kerabat jauh saya yang bersekolah di kota', 0],
                ],
            ],
            [
                'text' => 'Hasil penilaian guru atas hasil ujian dari lima siswa menunjukkan bahwa nilai Edi lebih tinggi daripada nilai Ana. Nilai Baba sama dengan nilai Okta. Nilai Kika lebih rendah daripada nilai Ana. Apabila nilai Baba lebih tinggi daripada Edi, tiga siswa yang memiliki nilai paling tinggi adalah',
                'image' => null,
                'options' => [
                    ['Kika, Baba, Edi', 0],
                    ['Ana. Baba. Okta', 0],
                    ['Edi, Okta, Baba', 1],
                    ['Okta, Edi, Kaka', 0],
                    ['Ana, Edi, Baba', 0],
                ],
            ],
            [
                'text' => 'Delapan remaja putri sedang duduk santai di dua buah bangku taman panjang dan saling berhadapan. Mawar duduk di sebelah kiri Gina dan berhadapan dengan Bela Marta duduk di antara Bela dan Asih. Siska duduk di sebelah Asih, di depan Kartika. Lili duduk di antara Gina dan Kartika. Siapakah yang duduk di depan Gina?',
                'image' => null,
                'options' => [
                    ['Bela', 0],
                    ['Asih', 0],
                    ['Marta', 1],
                    ['Mawar', 0],
                    ['Lili', 0],
                ],
            ],
            [
                'text' => 'Sebuah keluarga berdiskusi mengenai makanan yang ingin dimasak hari ini. Setiap orang memiliki kesukaan yang berbeda-beda berdasarkan tekstur, rasa, dan porsinya. Kakek dan Nenek lebih suka makanan yang teksturnya lembut, sedangkan Ayah, Tono, dan Ali menyukai yang alot. Ibu dan Sari lebih suka masakan yang rasanya asam. Nenek, Ayah, dan Dita lebih suka yang manis. Yang lain lebih suka rasa asin. Yang suka makan dengan porsi banyak hanya Ayah, Tono, dan Ali. Setelah berdiskusi, mereka sepakat akan memasak makanan yang alot, asin dan dalam porsi banyak. Makanan kesukaan siapa yang akan dimasak?',
                'image' => null,
                'options' => [
                    ['Tono dan Sari', 0],
                    ['Ibu dan Nenek', 0],
                    ['Ayah dan Kakek', 0],
                    ['Sari dan Dita', 0],
                    ['Tono dan Ali', 1],
                ],
            ],
            [
                'text' => 'Dalam suatu konferensi, delapan orang duduk melingkar. Rahma dan Vany duduk berhadapan. Joko dan Beni juga duduk berhadapan. Nisa berseberangan dengan Tiva dan di dekat Vany. Tiva di sebelah Joko. Sekar berseberangan dengan Puspita, tetapi tidak mau di dekat Joko ataupun Vany Di antara siapakah posisi Puspita?',
                'image' => null,
                'options' => [
                    ['Beni dan Rahma', 0],
                    ['Joko dan Rahma', 0],
                    ['Vany dan Joko.', 1],
                    ['Vany dan Beni', 0],
                    ['Nisa dan Sekar', 0],
                ],
            ],
            [
                'text' => '\\(3\\cdot4\\frac{1}{6}:5=....\\)',
                'image' => null,
                'options' => [
                    ['4', 0],
                    ['3  1/6', 0],
                    ['3', 0],
                    ['2  1/2', 1],
                    ['2  1/15', 0],
                ],
            ],
            [
                'text' => '\\(3\\cdot11-9\\cdot3\\frac{1}{3}=....\\)',
                'image' => null,
                'options' => [
                    ['3', 1],
                    ['13  1/3', 0],
                    ['63', 0],
                    ['80', 0],
                    ['140', 0],
                ],
            ],
            [
                'text' => '\\(\\frac{2}{8}\\cdot3+6\\cdot0,3:2=....\\)',
                'image' => null,
                'options' => [
                    ['1.25', 0],
                    ['1.65', 1],
                    ['2.25', 0],
                    ['2.65', 0],
                    ['3.25', 0],
                ],
            ],
            [
                'text' => '7, 35, 175, 875, 4375, 21875, 109375..',
                'image' => null,
                'options' => [
                    ['546875, 2734375', 1],
                    ['546877, 2734375', 0],
                    ['546871, 2734376', 0],
                    ['546877, 2734377', 0],
                    ['546879, 2734379', 0],
                ],
            ],
            [
                'text' => 'Jawaban yang tepat untuk mengisi tanda tanya tersebut adalah ...',
                'image' => 'questions/hjxpVFn7wQ9XIpOLrpaOZrqmd4vXyRM7YKpwc8ZK.png',
                'options' => [
                    ['45', 0],
                    ['49', 0],
                    ['47', 1],
                    ['43', 0],
                    ['51', 0],
                ],
            ],
            [
                'text' => 'Jawaban yang tepat untuk mengisi tanda tanya tersebut adalah ...',
                'image' => 'questions/nPxEtkUvSE0PTwrQNIEopXiSwFkLZp9yYjeIVWpC.png',
                'options' => [
                    ['28', 0],
                    ['32', 1],
                    ['36', 0],
                    ['30', 0],
                    ['34', 0],
                ],
            ],
            [
                'text' => 'Jawaban yang tepat untuk mengisi tanda tanya tersebut adalah ...',
                'image' => 'questions/wHNlQQ2hoM3TbAzpkXVZIu16940sXfgshdyRTe4o.png',
                'options' => [
                    ['127', 0],
                    ['137', 0],
                    ['142', 0],
                    ['132', 1],
                    ['122', 0],
                ],
            ],
            [
                'text' => 'Dari Data yang terdapat dalam table. Maka',
                'image' => 'questions/sEoBpPs7IxLFo7u6P3ppqtCdJBm3qrgsvIlGNDOK.png',
                'options' => [
                    ['A < B', 0],
                    ['B < A', 1],
                    ['A = B', 0],
                    ['3A = 2B', 0],
                    ['A = 2B', 0],
                ],
            ],
            [
                'text' => 'Perhatikan Tabel berikut',
                'image' => 'questions/rI4JkjdDePOkSQgyC4eKszAet8pIAkNtiXen0g4C.png',
                'options' => [
                    ['2A = B', 0],
                    ['A < B', 0],
                    ['A = B', 0],
                    ['3A = B', 0],
                    ['A = 2B', 1],
                ],
            ],
            [
                'text' => 'Perhatikan table berikut',
                'image' => 'questions/5zDJZogON3vHRAfUuqZHmyEz5VE5nJUOJRzkSQev.png',
                'options' => [
                    ['A = B', 0],
                    ['B = 2A', 0],
                    ['A = B', 0],
                    ['B < A', 1],
                    ['A < B', 0],
                ],
            ],
            [
                'text' => 'Ahsan mempunyai tanah kavling dengan panjang 30 meter dan lebar 18 meter. Temannya juga memiliki tanah kavling dengan luas yang sama. Jika lebar tanah adalah 20 meter dan  ingin bertukar tanah dengan Ahsan, panjang tanah milik temannya adalah',
                'image' => null,
                'options' => [
                    ['36 meter', 0],
                    ['33 meter', 0],
                    ['30 meter', 0],
                    ['27 meter', 1],
                    ['24 meter', 0],
                ],
            ],
            [
                'text' => 'Untuk menempuh perjalanan sejauh 48 km. sebuah motor memerlukan bensin sebanyak 3 liter. Jika perjalanan yang akan ditempuh adalah 80 km. bensin yang diperlukan motor tersebut adalah…',
                'image' => null,
                'options' => [
                    ['4 liter', 0],
                    ['5 liter', 1],
                    ['6 liter', 0],
                    ['7 liter', 0],
                    ['8 liter', 0],
                ],
            ],
            [
                'text' => 'Tabel di atas menunjukkan jumlah anak yang kecanduan game online A dan B. jika jumlah anak kecanduan game A dibandingkan dengan jumlah anak kecanduan game B, maka nila perbandingan di tahun berapakah yang terbesar?',
                'image' => 'questions/PNU0tWEjQDyVuhfDyEfwxl3lmYjiDQlpbxqU8BiK.png',
                'options' => [
                    ['2010', 1],
                    ['2011', 0],
                    ['2014', 0],
                    ['2015', 0],
                    ['2017', 0],
                ],
            ],
            [
                'text' => 'Manakah pasangan bilangan berikut yang hasilnya sama?',
                'image' => null,
                'options' => [
                    ['342 x 175 dan 218 x 264', 0],
                    ['465 x 120 dan 310 x 205', 0],
                    ['187 x 430 dan 526 x 148', 0],
                    ['150 x 240 dan 300 x 120', 1],
                    ['623 x 310 dan 415 x 172', 0],
                ],
            ],
            [
                'text' => 'Manakah pasangan bilangan berikut yang hasilnya sama?',
                'image' => null,
                'options' => [
                    ['140 x 350 dan 280 x 175', 1],
                    ['236 x 415 dan 318 x 270', 0],
                    ['507 x 128 dan 264 x 315', 0],
                    ['156 x 580 dan 391 x 240', 0],
                    ['729 x 105 dan 460 x 218', 0],
                ],
            ],
            [
                'text' => 'Manakah pasangan bilangan berikut yang hasilnya sama?',
                'image' => null,
                'options' => [
                    ['385 x 120 dan 214 x 273', 0],
                    ['452 x 360 dan 279 x 310', 0],
                    ['618 x 145 dan 350 x 236', 0],
                    ['197 x 430 dan 524 x 165', 0],
                    ['160 x 450 dan 320 x 225', 1],
                ],
            ],
            [
                'text' => 'Panitia seminar memesan nasi kotak untuk peserta. Isi dan harga tiap paket ditunjukkan pada tabel berikut.<br>Pernyataan:<br>Peserta seminar berjumlah 150 orang.<br>Setiap peserta mendapat satu kotak, sehingga jumlah kotak tidak boleh (1) kurang dari jumlah peserta.<br>(2) Paket dapat dipilih lebih dari satu jenis.<br>(3) Panitia ingin memilih kombinasi paket dengan biaya paling hemat.<br>Berdasarkan informasi tersebut, kombinasi paket yang paling hemat adalah ....',
                'image' => 'questions/8p0KYfUEtSrLbTdm4LMYrnxwC5vkInlraHTAu9FE.png',
                'options' => [
                    ['15 paket A', 0],
                    ['6 paket B', 0],
                    ['1 paket C dan 4 paket B', 0],
                    ['2 paket C dan 2 paket B', 0],
                    ['3 paket C', 1],
                ],
            ],
            [
                'text' => 'Untuk mengisi sebuah kolam, panitia menyewa beberapa pompa air. Debit dan biaya sewa tiap pompa ditunjukkan pada tabel berikut.<br>Pernyataan:<br>(1) Kolam berukuran 6.000 liter dan harus terisi penuh paling lama 1 jam.<br>(2) Pompa dapat dipilih lebih dari satu jenis dan dinyalakan bersamaan.<br>(3) Biaya sewa dihitung sesuai lama pemakaian. Panitia ingin memilih kombinasi pompa dengan biaya paling hemat.<br>Berdasarkan informasi tersebut, kombinasi pompa yang paling hemat adalah ....',
                'image' => 'questions/04dInfkRG0VBpgZrIoAVm1eIyRtvFA0PYJsUPW4a.png',
                'options' => [
                    ['5 pompa A', 0],
                    ['2 pompa B dan 2 pompa A', 0],
                    ['1 pompa C dan 1 pompa B', 0],
                    ['2 pompa C', 1],
                    ['1 pompa C, 1 pompa B, dan 1 pompa A', 0],
                ],
            ],
            [
                'text' => 'Tentukan gambar yang ada dari bentuk gambar serial berikut',
                'image' => 'questions/F45aclVF7pLSUUvpiYe5g1lvi2sTGbQX4GFsx667.png',
                'options' => [
                    ['A', 0],
                    ['B', 0],
                    ['C', 0],
                    ['D', 0],
                    ['E', 1],
                ],
            ],
            [
                'text' => 'Tentukan gambar yang ada dari bentuk gambar serial berikut',
                'image' => 'questions/57EY4Bnop6eFDG9MapC0JDnBCN2A0erk0r5WuyJD.png',
                'options' => [
                    ['A', 1],
                    ['B', 0],
                    ['C', 0],
                    ['D', 0],
                    ['E', 0],
                ],
            ],
            [
                'text' => 'Tentukan gambar yang ada dari bentuk gambar serial berikut',
                'image' => 'questions/ZTDBPFSWhzrCigRtX6u6n1yy5AJ13XLSmFdEesFf.png',
                'options' => [
                    ['A', 0],
                    ['B', 1],
                    ['C', 0],
                    ['D', 0],
                    ['E', 0],
                ],
            ],
            [
                'text' => 'Tentukan gambar berikut yang berbeda',
                'image' => 'questions/gRTQvob39HQqss7MRQGIls8vayD35ijwCdMzufth.png',
                'options' => [
                    ['A', 0],
                    ['B', 0],
                    ['C', 1],
                    ['D', 0],
                    ['E', 0],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
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

        $this->command->info('TIU Paket 4 seeder selesai: ' . count($questions) . ' soal + opsi.');
    }
}
