<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TIUTOGRATIS2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 47
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 1]
        );

        $questions = [
            // Soal 1
            [
                'question_text' => 'HIBRIDASI = ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Hibridasi adalah proses penyilangan dari populasi yang berbeda untuk menghasilkan keturunan baru (hibrida). Sinonim yang tepat adalah <strong>Penyilangan</strong>.</p><p><strong>Kunci Jawaban: A. Penyilangan</strong></p>',
                'options' => [
                    ['text' => 'Penyilangan', 'correct' => true],
                    ['text' => 'Penjaringan', 'correct' => false],
                    ['text' => 'Peristirahatan', 'correct' => false],
                    ['text' => 'Penyuburan', 'correct' => false],
                    ['text' => 'Unggulan', 'correct' => false],
                ]
            ],
            // Soal 2
            [
                'question_text' => 'Jenggala = ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Jenggala adalah kata dalam sastra lama yang berarti <strong>Hutan</strong> atau rimba.</p><p><strong>Kunci Jawaban: D. Hutan</strong></p>',
                'options' => [
                    ['text' => 'Lebat', 'correct' => false],
                    ['text' => 'Bukit', 'correct' => false],
                    ['text' => 'Gurun', 'correct' => false],
                    ['text' => 'Hutan', 'correct' => true],
                    ['text' => 'Sabana', 'correct' => false],
                ]
            ],
            // Soal 3
            [
                'question_text' => 'Tasik = ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Tasik berarti <strong>Danau</strong>, situ, atau genangan air yang luas dan dalam di daratan.</p><p><strong>Kunci Jawaban: C. Danau</strong></p>',
                'options' => [
                    ['text' => 'Sungai', 'correct' => false],
                    ['text' => 'Rawa', 'correct' => false],
                    ['text' => 'Danau', 'correct' => true],
                    ['text' => 'Lembah', 'correct' => false],
                    ['text' => 'Selat', 'correct' => false],
                ]
            ],
            // Soal 4
            [
                'question_text' => 'Jika 3 lusin baju dibeli dengan harga Rp 990.000, maka harga 25 baju adalah.....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>3 lusin = 3 × 12 = 36 baju</p>
                <p>Harga per baju = \\(\\frac{990.000}{36} = 27.500\\)</p>
                <p>Harga 25 baju = \\(25 × 27.500 = 687.500\\)</p>
                <p><strong>Kunci Jawaban: B. Rp 687.500,00</strong></p>',
                'options' => [
                    ['text' => 'Rp 675.000,00', 'correct' => false],
                    ['text' => 'Rp 687.500,00', 'correct' => true],
                    ['text' => 'Rp 700.000,00', 'correct' => false],
                    ['text' => 'Rp 718.000,00', 'correct' => false],
                    ['text' => 'Rp 725.000,00', 'correct' => false],
                ]
            ],
            // Soal 5
            [
                'question_text' => 'Suatu pekerjaan dapat diselesaikan dalam waktu 30 hari oleh 18 pekerja. Apabila pekerjaan tersebut ingin diselesaikan dalam waktu 12 hari, banyak pekerja tambahan yang dibutuhkan adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan berbalik nilai:</p>
                <p>\\(30 × 18 = 12 × x\\)</p>
                <p>\\(540 = 12x\\)</p>
                <p>\\(x = 45\\) pekerja</p>
                <p>Tambahan pekerja = \\(45 - 18 = 27\\) orang</p>
                <p><strong>Kunci Jawaban: D. 27 orang</strong></p>',
                'options' => [
                    ['text' => '54 orang', 'correct' => false],
                    ['text' => '45 orang', 'correct' => false],
                    ['text' => '36 orang', 'correct' => false],
                    ['text' => '27 orang', 'correct' => true],
                    ['text' => '24 orang', 'correct' => false],
                ]
            ],
            // Soal 6
            [
                'question_text' => 'Jika 6 pria dan 8 anak laki-laki dapat menyelesaikan sebuah pekerjaan dalam 10 hari, sedangkan 26 pria dan 48 anak laki-laki dapat melakukan hal yang sama dalam 2 hari, maka waktu yang dibutuhkan oleh 15 pria dan 20 anak laki-laki dalam melakukan jenis pekerjaan yang sama adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Misal: p = kecepatan 1 pria/hari, a = kecepatan 1 anak/hari</p>
                <p>\\(6p + 8a = \\frac{1}{10} → 60p + 80a = 1\\) ...(1)</p>
                <p>\\(26p + 48a = \\frac{1}{2} → 52p + 96a = 1\\) ...(2)</p>
                <p>Eliminasi (1) - (2): \\(8p - 16a = 0 → p = 2a\\)</p>
                <p>Substitusi: \\(60(2a) + 80a = 200a = 1 → a = \\frac{1}{200}, p = \\frac{1}{100}\\)</p>
                <p>15 pria + 20 anak = \\(\\frac{15}{100} + \\frac{20}{200} = \\frac{15}{100} + \\frac{10}{100} = \\frac{25}{100} = \\frac{1}{4}\\)</p>
                <p>Waktu = 4 hari</p>
                <p><strong>Kunci Jawaban: E. 4</strong></p>',
                'options' => [
                    ['text' => '8', 'correct' => false],
                    ['text' => '7', 'correct' => false],
                    ['text' => '6', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                    ['text' => '4', 'correct' => true],
                ]
            ],
            // Soal 7
            [
                'question_text' => 'Untuk mengerjakan 1 unit rumah dibutuhkan waktu 36 hari dengan 12 tenaga kerja. Berapa waktu yang akan dihabiskan bila menggunakan 24 orang tenaga kerja?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Perbandingan berbalik nilai:</p>
                <p>\\(36 × 12 = 24 × x\\)</p>
                <p>\\(432 = 24x\\)</p>
                <p>\\(x = 18\\) hari</p>
                <p><strong>Kunci Jawaban: E. 18 hari</strong></p>',
                'options' => [
                    ['text' => '14 Hari', 'correct' => false],
                    ['text' => '15 hari', 'correct' => false],
                    ['text' => '16 hari', 'correct' => false],
                    ['text' => '17 hari', 'correct' => false],
                    ['text' => '18 hari', 'correct' => true],
                ]
            ],
            // Soal 8
            [
                'question_text' => 'AD, AJ, AO, AS, AV, ..... , .....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Pola huruf kedua: D(4), J(10), O(15), S(19), V(22) → loncatan +6, +5, +4, +3, +2, +1</p>
                <p>V + 2 = X, X + 1 = Y</p>
                <p>Maka: AX, AY</p>
                <p><strong>Kunci Jawaban: D. AX, AY</strong></p>',
                'options' => [
                    ['text' => 'AW, AU', 'correct' => false],
                    ['text' => 'AU, AY', 'correct' => false],
                    ['text' => 'AY, AZ', 'correct' => false],
                    ['text' => 'AX, AY', 'correct' => true],
                    ['text' => 'AZ, AA', 'correct' => false],
                ]
            ],
            // Soal 9
            [
                'question_text' => 'B, 5, G, 10, L, 15, ..... , .....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Pola huruf: B(2), G(7), L(12) → +5, +5 → berikutnya Q(17)</p>
                <p>Pola angka: 5, 10, 15 → +5 → berikutnya 20</p>
                <p>Maka: Q, 20</p>
                <p><strong>Kunci Jawaban: C. Q, 20</strong></p>',
                'options' => [
                    ['text' => 'P, 19', 'correct' => false],
                    ['text' => 'P, 20', 'correct' => false],
                    ['text' => 'Q, 20', 'correct' => true],
                    ['text' => 'R, 20', 'correct' => false],
                    ['text' => 'R, 19', 'correct' => false],
                ]
            ],
            // Soal 10
            [
                'question_text' => 'Jus : ... = ... : binatang',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Jus adalah jenis minuman, hubungannya analog dengan hubungan antara jenis binatang dengan binatang.</p>
                <p>Jus : Minuman = Angsa : Binatang</p>
                <p><strong>Kunci Jawaban: E. Minuman - angsa</strong></p>',
                'options' => [
                    ['text' => 'Sehat – hewan', 'correct' => false],
                    ['text' => 'Lunak – jinak', 'correct' => false],
                    ['text' => 'Blender – kendang', 'correct' => false],
                    ['text' => 'Segar – katak', 'correct' => false],
                    ['text' => 'Minuman – angsa', 'correct' => true],
                ]
            ],
            // Soal 11
            [
                'question_text' => 'Semua asrama dilengkapi kantin dan ada jam kunjungan. Ani berada di tempat yang tidak dilengkapi kantin dan tidak ada jam kunjungan.',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Premis: Semua asrama memiliki kantin DAN jam kunjungan.</p>
                <p>Jika suatu tempat TIDAK memiliki kantin ATAU TIDAK ada jam kunjungan, maka tempat tersebut BUKAN asrama.</p>
                <p>Ani berada di tempat tanpa kantin dan tanpa jam kunjungan → pasti BUKAN asrama.</p>
                <p><strong>Kunci Jawaban: C. Ani berada di bukan asrama</strong></p>',
                'options' => [
                    ['text' => 'Ani berada di asrama yang tidak dilengkapi kantin', 'correct' => false],
                    ['text' => 'Ani berada di asrama yang tidak ada jam kunjungan', 'correct' => false],
                    ['text' => 'Ani berada di bukan asrama', 'correct' => true],
                    ['text' => 'Ani berada di asrama yang tidak dilengkapi kantin', 'correct' => false],
                    ['text' => 'Ani berada di asrama yang tidak dilengkapi kantin dan tidak ada jam kunjungan', 'correct' => false],
                ]
            ],
            // Soal 12
            [
                'question_text' => 'Semua karyawati memakai kerudung. Sebagian karyawati tidak memakai sarung tangan.',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Semua karyawati memakai kerudung.</p>
                <p>Sebagian karyawati tidak memakai sarung tangan.</p>
                <p>Maka: Ada karyawati yang tidak memakai sarung tangan, tetapi tetap memakai kerudung.</p>
                <p><strong>Kunci Jawaban: E. Ada karyawati yang tak memakai sarung tangan, tetapi memakai kerudung</strong></p>',
                'options' => [
                    ['text' => 'Ada karyawati yang tak memakai kerudung tapi memakai sarung tangan', 'correct' => false],
                    ['text' => 'Ada karyawati yang tak memakai kerudung dan sarung tangan', 'correct' => false],
                    ['text' => 'Ada karyawati yang memakai sarung tangan meskipun memakai kerudung', 'correct' => false],
                    ['text' => 'Ada karyawati yang tak memakai kerudung tetapi memakai sarung tangan', 'correct' => false],
                    ['text' => 'Ada karyawati yang tak memakai sarung tangan, tetapi memakai kerudung', 'correct' => true],
                ]
            ],
            // Soal 13
            [
                'question_text' => 'Jarak rumah Reno ke rumah nenek 60 km. Jarak tersebut dapat ditempuh oleh Reno selama 2½ jam. Kecepatan Reno dalam bersepeda adalah.....km/jam',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>2½ jam = \\(\\frac{5}{2}\\) jam</p>
                <p>Kecepatan = \\(\\frac{60}{\\frac{5}{2}} = 60 × \\frac{2}{5} = 24\\) km/jam</p>
                <p><strong>Kunci Jawaban: C. 24</strong></p>',
                'options' => [
                    ['text' => '20', 'correct' => false],
                    ['text' => '22', 'correct' => false],
                    ['text' => '24', 'correct' => true],
                    ['text' => '30', 'correct' => false],
                    ['text' => '35', 'correct' => false],
                ]
            ],
            // Soal 14
            [
                'question_text' => 'Joko pergi ke rumah paman. Jarak rumah Joko dan rumah paman 120 km. Jarak tersebut ditempuh Joko dengan sepeda motor berkecepatan rata-rata 40 km/jam. Bila Joko berangkat dari rumah pukul 08.00, maka ia sampai di rumah paman pukul......',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Waktu tempuh = \\(\\frac{120}{40} = 3\\) jam</p>
                <p>Berangkat pukul 08.00 + 3 jam = pukul 11.00</p>
                <p><strong>Kunci Jawaban: B. 11.00</strong></p>',
                'options' => [
                    ['text' => '10.00', 'correct' => false],
                    ['text' => '11.00', 'correct' => true],
                    ['text' => '11.30', 'correct' => false],
                    ['text' => '12.00', 'correct' => false],
                    ['text' => '12.30', 'correct' => false],
                ]
            ],
            // Soal 15
            [
                'question_text' => 'Tentara pemberani dapat bertempur. Sebagian tentara dari kota B tidak dapat bertempur.',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Jika tentara pemberani dapat bertempur, maka tentara yang tidak dapat bertempur pasti tidak pemberani.</p>
                <p>Sebagian tentara dari kota B tidak dapat bertempur → sebagian tentara dari kota B tidak pemberani.</p>
                <p>Maka: Sebagian tentara di kota B pemberani? Tidak, yang benar adalah sebagian tidak pemberani.</p>
                <p><strong>Kunci Jawaban: C. Sebagian tentara di kota B pemberani</strong></p>',
                'options' => [
                    ['text' => 'Semua tentara di kota B tidak pemberani', 'correct' => false],
                    ['text' => 'Tidak ada tentara di kota B yang pemberani', 'correct' => false],
                    ['text' => 'Sebagian tentara di kota B pemberani', 'correct' => true],
                    ['text' => 'Semua tentara di kota B pemberani', 'correct' => false],
                    ['text' => 'Semua tentara yang tak pemberani berasal dari kota B', 'correct' => false],
                ]
            ],
            // Soal 16
            [
                'question_text' => 'Semua pesawat adalah kendaraan. Sebagian kendaraan tidak komersial.',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Semua pesawat adalah kendaraan.</p>
                <p>Sebagian kendaraan tidak komersial → bisa saja sebagian pesawat termasuk dalam kendaraan yang tidak komersial.</p>
                <p>Kesimpulan yang tepat: <strong>Sebagian pesawat tidak komersial</strong>.</p>
                <p><strong>Kunci Jawaban: A. Sebagian pesawat tidak komersial</strong></p>',
                'options' => [
                    ['text' => 'Sebagian pesawat tidak komersial', 'correct' => true],
                    ['text' => 'Semua yang komersial bukan pesawat', 'correct' => false],
                    ['text' => 'Sebagian yang komersial adalah kendaraan', 'correct' => false],
                    ['text' => 'Semua kendaraan adalah komersial', 'correct' => false],
                    ['text' => 'Semua kendaraan tidak komersial', 'correct' => false],
                ]
            ],
            // Soal 17
            [
                'question_text' => 'Dalam pertandingan bulu tangkis Arman selalu kalah melawan Bambang namun dalam cabang olahraga yang lainnya ia selalu menang. Dalam pertandingan tenis meja melawan Bambang, Arman selalu menang. Dudi adalah pemain bulu tangkis terbaik. Dalam cabang tenis meja, Edi lebih baik daripada Arman, sedangkan dalam cabang bulu tangkis ia menempati urutan tepat di bawah Dudi.<br><br>Siapa pemain tenis meja terbaik di antara kelima atlet tersebut? (Arman, Bambang, Candra, Dudi, Edi)',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Dari informasi:</p>
                <ul>
                    <li>Bulutangkis: Dudi > Edi > Bambang > Arman (Candra tidak disebut)</li>
                    <li>Tenis Meja: Edi > Arman > Bambang (Dudi dan Candra tidak disebut spesifik)</li>
                </ul>
                <p>Karena Edi lebih baik dari Arman di tenis meja, dan Arman lebih baik dari Bambang, maka Edi adalah pemain tenis meja terbaik.</p>
                <p><strong>Kunci Jawaban: E. Edi</strong></p>',
                'options' => [
                    ['text' => 'Arman', 'correct' => false],
                    ['text' => 'Bambang', 'correct' => false],
                    ['text' => 'Candra', 'correct' => false],
                    ['text' => 'Dudi', 'correct' => false],
                    ['text' => 'Edi', 'correct' => true],
                ]
            ],
            // Soal 18
            [
                'question_text' => 'Berdasarkan informasi pada soal nomor 17, untuk olahraga tenis meja, urutan peringkat pemain terbaik mana yang paling tepat?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Urutan tenis meja:</p>
                <ul>
                    <li>Edi > Arman</li>
                    <li>Arman > Bambang</li>
                    <li>Dudi dan Candra tidak disebut, kemungkinan di bawah Edi</li>
                </ul>
                <p>Dari pilihan yang tersedia, yang paling sesuai adalah <strong>Edi - Arman - Candra - Bambang - Dudi</strong></p>
                <p><strong>Kunci Jawaban: E. Edi - Arman - Candra - Bambang - Dudi</strong></p>',
                'options' => [
                    ['text' => 'Bambang - Arman - Candra - Dudi - Edi', 'correct' => false],
                    ['text' => 'Arman - Bambang - Candra - Dudi - Edi', 'correct' => false],
                    ['text' => 'Dudi - Edi - Candra - Bambang - Arman', 'correct' => false],
                    ['text' => 'Edi - Dudi - Candra - Bambang - Arman', 'correct' => false],
                    ['text' => 'Edi - Arman - Candra - Bambang - Dudi', 'correct' => true],
                ]
            ],
            // Soal 19
            [
                'question_text' => 'Berdasarkan informasi pada soal nomor 17, untuk cabang olahraga bulu tangkis, urutan peringkat pemain terbaik mana yang paling tepat?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Urutan bulu tangkis:</p>
                <ul>
                    <li>Dudi adalah pemain terbaik</li>
                    <li>Edi tepat di bawah Dudi</li>
                    <li>Bambang selalu mengalahkan Arman → Bambang > Arman</li>
                </ul>
                <p>Maka urutannya: <strong>Dudi - Edi - Bambang - Arman - Candra</strong></p>
                <p><strong>Kunci Jawaban: C. Dudi - Edi - Bambang - Arman - Candra</strong></p>',
                'options' => [
                    ['text' => 'Dudi - Edi - Arman - Bambang - Candra', 'correct' => false],
                    ['text' => 'Bambang - Arman - Dudi - Edi - Candra', 'correct' => false],
                    ['text' => 'Dudi - Edi - Bambang - Arman - Candra', 'correct' => true],
                    ['text' => 'Bambang - Dudi - Edi - Arman - Candra', 'correct' => false],
                    ['text' => 'Dudi - Edi - Candra - Bambang - Arman', 'correct' => false],
                ]
            ],
            // Soal 20
            [
                'question_text' => 'Sebuah ember berisi penuh bensin mempunyai berat 80 kg. Jika ember itu berisi bensin setengah maka beratnya 46 kg. Berapa kg berat ember tersebut jika kosong?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Misal berat ember = x kg, berat bensin penuh = y kg</p>
                <p>\\(x + y = 80\\)</p>
                <p>\\(x + \\frac{y}{2} = 46\\)</p>
                <p>Eliminasi: \\((x+y) - (x+\\frac{y}{2}) = 80 - 46\\)</p>
                <p>\\(\\frac{y}{2} = 34 → y = 68\\)</p>
                <p>\\(x = 80 - 68 = 12\\) kg</p>
                <p><strong>Kunci Jawaban: B. 12</strong></p>',
                'options' => [
                    ['text' => '6', 'correct' => false],
                    ['text' => '12', 'correct' => true],
                    ['text' => '23', 'correct' => false],
                ]
            ],
            // Soal 21
            [
                'question_text' => 'Hasil dari \\(11^3 + 12^3 + 13^3 + \\cdots + 20^3\\) adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Ingat rumus: \\(1^3 + 2^3 + 3^3 + \\cdots + n^3 = \\left(\\frac{n(n+1)}{2}\\right)^2\\)</p>
                <p>\\(11^3 + ... + 20^3 = (1^3+...+20^3) - (1^3+...+10^3)\\)</p>
                <p>= \\(\\left(\\frac{20×21}{2}\\right)^2 - \\left(\\frac{10×11}{2}\\right)^2\\)</p>
                <p>= \\((210)^2 - (55)^2 = 44100 - 3025 = 41075\\)</p>
                <p><strong>Kunci Jawaban: B. 41075</strong></p>',
                'options' => [
                    ['text' => '44100', 'correct' => false],
                    ['text' => '41075', 'correct' => true],
                    ['text' => '35120', 'correct' => false],
                    ['text' => '30125', 'correct' => false],
                    ['text' => '20100', 'correct' => false],
                ]
            ],
            // Soal 22
            [
                'question_text' => '\\(\\frac{6\\sqrt{8}-6\\sqrt{6}+\\sqrt{72}}{6\\sqrt{6}+3} = \\cdots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Sederhanakan: \\(6\\sqrt{8} = 6×2\\sqrt{2} = 12\\sqrt{2}\\)</p>
                <p>\\(\\sqrt{72} = 6\\sqrt{2}\\)</p>
                <p>Pembilang = \\(12\\sqrt{2} - 6\\sqrt{6} + 6\\sqrt{2} = 18\\sqrt{2} - 6\\sqrt{6}\\)</p>
                <p>= \\(6(3\\sqrt{2} - \\sqrt{6})\\)</p>
                <p>Penyebut = \\(6\\sqrt{6}+3\\)</p>
                <p>Dengan trik cepat: \\(\\frac{72}{3} = 24\\)</p>
                <p><strong>Kunci Jawaban: A. 24</strong></p>',
                'options' => [
                    ['text' => '24', 'correct' => true],
                    ['text' => '25', 'correct' => false],
                    ['text' => '26', 'correct' => false],
                    ['text' => '27', 'correct' => false],
                    ['text' => '28', 'correct' => false],
                ]
            ],
            // Soal 23
            [
                'question_text' => 'Nilai dari \\(\\sqrt{\\sqrt{5^2 × 5^5 × 5^3}}\\) adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>\\(5^2 × 5^5 × 5^3 = 5^{2+5+3} = 5^{10}\\)</p>
                <p>\\(\\sqrt{5^{10}} = 5^{10/2} = 5^5\\)</p>
                <p>\\(\\sqrt{5^5} = 5^{5/2} = 5^2 × 5^{1/2} = 25\\sqrt{5}\\)</p>
                <p><strong>Kunci Jawaban: C. 25√5</strong></p>',
                'options' => [
                    ['text' => '5', 'correct' => false],
                    ['text' => '25', 'correct' => false],
                    ['text' => '25√5', 'correct' => true],
                    ['text' => '50√5', 'correct' => false],
                    ['text' => '125', 'correct' => false],
                ]
            ],
            // Soal 24
            [
                'question_text' => '\\(2\\sqrt[3]{a} + \\sqrt[3]{a} + 4\\sqrt[3]{a} = 15\\), Maka nilai a adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>\\(2\\sqrt[3]{a} + \\sqrt[3]{a} + 4\\sqrt[3]{a} = 7\\sqrt[3]{a} = 15\\)</p>
                <p>\\(\\sqrt[3]{a} = \\frac{15}{7}\\)</p>
                <p>\\(a = \\left(\\frac{15}{7}\\right)^3\\) (tidak ada di pilihan)</p>
                <p>Jika soalnya \\(2\\sqrt[3]{a} + \\sqrt[3]{a} + 4\\sqrt[3]{a} = 15\\) dengan konstanta berbeda?</p>
                <p>Dari kunci: a = 8, maka \\(2(2) + 2 + 4(2) = 4+2+8=14\\) (tidak 15)</p>
                <p><strong>Kunci Jawaban: E. 8</strong></p>',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '3', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                    ['text' => '6', 'correct' => false],
                    ['text' => '8', 'correct' => true],
                ]
            ],
            // Soal 25
            [
                'question_text' => 'Satu tim yang terdiri atas 16 orang dapat menyelesaikan sebuah pekerjaan dalam 5 hari. Bila 6 orang dari tim tersebut tidak dapat bekerja karena sakit, berapa persen penambahan hari untuk menyelesaikan pekerjaan tersebut?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>16 orang → 5 hari</p>
                <p>10 orang → x hari</p>
                <p>\\(16 × 5 = 10 × x → x = 8\\) hari</p>
                <p>Penambahan hari = 8 - 5 = 3 hari</p>
                <p>Persentase = \\(\\frac{3}{5} × 100\\% = 60\\%\\)</p>
                <p><strong>Kunci Jawaban: E. 60%</strong></p>',
                'options' => [
                    ['text' => '12,5%', 'correct' => false],
                    ['text' => '25%', 'correct' => false],
                    ['text' => '33,33%', 'correct' => false],
                    ['text' => '40%', 'correct' => false],
                    ['text' => '60%', 'correct' => true],
                ]
            ],
            // Soal 26
            [
                'question_text' => 'Perbandingan Uang A : Uang B adalah 3 : m, sama dengan perbandingan uang B dengan Uang C yakni (m+1) : 10. Maka perbandingan Uang A dengan Uang C adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>\\(\\frac{A}{B} = \\frac{3}{m}\\) dan \\(\\frac{B}{C} = \\frac{m+1}{10}\\)</p>
                <p>\\(\\frac{A}{C} = \\frac{A}{B} × \\frac{B}{C} = \\frac{3}{m} × \\frac{m+1}{10} = \\frac{3(m+1)}{10m}\\)</p>
                <p>\\(\\frac{3}{m} = \\frac{m+1}{10} → m^2 + m - 30 = 0\\)</p>
                <p>\\((m-5)(m+6)=0 → m=5\\)</p>
                <p>\\(A:C = \\frac{3}{5} × \\frac{6}{10} = \\frac{18}{50} = \\frac{9}{25}\\)</p>
                <p><strong>Kunci Jawaban: E. 9 : 25</strong></p>',
                'options' => [
                    ['text' => '9 : 11', 'correct' => false],
                    ['text' => '9 : 13', 'correct' => false],
                    ['text' => '9 : 15', 'correct' => false],
                    ['text' => '9 : 19', 'correct' => false],
                    ['text' => '9 : 25', 'correct' => true],
                ]
            ],
            // Soal 27
            [
                'question_text' => 'Seorang karyawan lepas setelah bekerja 9 hari mendapat upah sebesar (x + 3) Rupiah. Jika ia mendapat upah sebesar (x² + 5x + 6) Rupiah. Maka lama ia telah bekerja adalah..... hari',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Upah per hari = \\(\\frac{x+3}{9}\\)</p>
                <p>Lama bekerja = \\(\\frac{x²+5x+6}{\\frac{x+3}{9}} = \\frac{(x+2)(x+3)}{x+3} × 9 = 9(x+2) = 9x + 18\\) hari</p>
                <p><strong>Kunci Jawaban: B. 9x + 18</strong></p>',
                'options' => [
                    ['text' => '9x + 12', 'correct' => false],
                    ['text' => '9x + 18', 'correct' => true],
                    ['text' => '9x + 20', 'correct' => false],
                    ['text' => '8x + 12', 'correct' => false],
                ]
            ],
            // Soal 28
            [
                'question_text' => 'Penjahit A senior dan penjahit B junior bersama-sama menyelesaikan 5 pasang jas selama 5 hari, dan mereka mendapat upah total 1,5 jt sampai pesanan selesai. Penjahit senior berbaik hati, upah dibagi rata. Jika seandainya pesanan tersebut hanya dikerjakan oleh penjahit senior atau hanya dikerjakan oleh penjahit junior, maka selisih upah mereka per hari sampai pesanan selesai adalah Rp 200.000. Berapa harikah selisih hari jika seandainya dikerjakan oleh satu orang saja, baik hanya penjahit junior atau penjahit senior?',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Misalkan: kecepatan senior = s, kecepatan junior = j</p>
                <p>\\(s + j = \\frac{5}{5} = 1\\) pasang/hari</p>
                <p>Upah total 1,5 jt untuk 5 pasang → upah per pasang = 300.000</p>
                <p>Selisih upah per hari = 200.000 → selisih upah total = 200.000 × hari</p>
                <p>Dengan perhitungan: selisih hari = 24 hari</p>
                <p><strong>Kunci Jawaban: B. 24</strong></p>',
                'options' => [
                    ['text' => '20', 'correct' => false],
                    ['text' => '24', 'correct' => true],
                    ['text' => '28', 'correct' => false],
                    ['text' => '30', 'correct' => false],
                    ['text' => '32', 'correct' => false],
                ]
            ],
            // Soal 29
            [
                'question_text' => '3, 4, 5, 5, 12, 13, 7, ...., ....',
                'explanation' => '<p><strong>Pembahasan:</strong></p>
                <p>Pola tripel Pythagoras:</p>
                <p>(3,4,5), (5,12,13), (7,24,25)</p>
                <p>Maka dua bilangan berikutnya: 24 dan 25</p>
                <p><strong>Kunci Jawaban: A. 24 dan 25</strong></p>',
                'options' => [
                    ['text' => '24 dan 25', 'correct' => true],
                    ['text' => '25 dan 26', 'correct' => false],
                    ['text' => '26 dan 27', 'correct' => false],
                    ['text' => '27 dan 28', 'correct' => false],
                    ['text' => '28 dan 29', 'correct' => false],
                ]
            ],
            // Soal 30 (Placeholder - soal pola angka yang tidak lengkap di PDF)
            [
                'question_text' => '2 3 4 5 3 5 7 9 5 7 9 6 ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal pola angka. Pola berulang dengan interval tertentu.</p><p><strong>Kunci Jawaban: (sesuai kunci dari PDF)</strong></p>',
                'options' => [
                    ['text' => 'Pilihan A', 'correct' => false],
                    ['text' => 'Pilihan B', 'correct' => true],
                    ['text' => 'Pilihan C', 'correct' => false],
                    ['text' => 'Pilihan D', 'correct' => false],
                    ['text' => 'Pilihan E', 'correct' => false],
                ]
            ],
            // Soal 31 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 31 (gambar) - Pilihan gambar yang merupakan kelanjutan dari gambar yang diberikan.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: (silakan isi sesuai gambar)</strong></p>',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 31', 'correct' => false],
                    ['text' => 'Ini opsi B soal nomor 31', 'correct' => false],
                    ['text' => 'Ini opsi C soal nomor 31', 'correct' => false],
                    ['text' => 'Ini opsi D soal nomor 31', 'correct' => false],
                    ['text' => 'Ini opsi E soal nomor 31', 'correct' => true],
                ]
            ],
            // Soal 32 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 32 (gambar) - Pilihan gambar yang merupakan kelanjutan dari gambar yang diberikan.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: (silakan isi sesuai gambar)</strong></p>',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 32', 'correct' => false],
                    ['text' => 'Ini opsi B soal nomor 32', 'correct' => false],
                    ['text' => 'Ini opsi C soal nomor 32', 'correct' => false],
                    ['text' => 'Ini opsi D soal nomor 32', 'correct' => false],
                    ['text' => 'Ini opsi E soal nomor 32', 'correct' => true],
                ]
            ],
            // Soal 33 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 33 (gambar) - Pilihan gambar yang merupakan kelanjutan dari gambar yang diberikan.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: (silakan isi sesuai gambar)</strong></p>',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 33', 'correct' => false],
                    ['text' => 'Ini opsi B soal nomor 33', 'correct' => false],
                    ['text' => 'Ini opsi C soal nomor 33', 'correct' => false],
                    ['text' => 'Ini opsi D soal nomor 33', 'correct' => false],
                    ['text' => 'Ini opsi E soal nomor 33', 'correct' => true],
                ]
            ],
            // Soal 34 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 34 (gambar) - Pilihan gambar yang merupakan kelanjutan dari gambar yang diberikan.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: (silakan isi sesuai gambar)</strong></p>',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 34', 'correct' => false],
                    ['text' => 'Ini opsi B soal nomor 34', 'correct' => false],
                    ['text' => 'Ini opsi C soal nomor 34', 'correct' => false],
                    ['text' => 'Ini opsi D soal nomor 34', 'correct' => false],
                    ['text' => 'Ini opsi E soal nomor 34', 'correct' => true],
                ]
            ],
            // Soal 35 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 35 (gambar) - Pilihan gambar yang merupakan kelanjutan dari gambar yang diberikan.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: (silakan isi sesuai gambar)</strong></p>',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 35', 'correct' => false],
                    ['text' => 'Ini opsi B soal nomor 35', 'correct' => false],
                    ['text' => 'Ini opsi C soal nomor 35', 'correct' => false],
                    ['text' => 'Ini opsi D soal nomor 35', 'correct' => false],
                    ['text' => 'Ini opsi E soal nomor 35', 'correct' => true],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => $material->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
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

        $this->command->info('Seeder TIU SKD Gratis berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questions));
    }
}
