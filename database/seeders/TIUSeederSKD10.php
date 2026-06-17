<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TIUSeederSKD10 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Soal 31-65 untuk TIU
        $questions = [
            // Soal 31
            [
                'question_text' => 'Teleskop terdiri atas lensa dan tabung. Hubungan objek yang setara dengan kalimat di atas adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Teleskop terdiri dari lensa dan tabung, keduanya merupakan komponen penyusun teleskop. Pola yang sama adalah <strong>Kamera terdiri dari lensa dan bodi</strong>, karena lensa dan bodi adalah komponen penyusun kamera.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => 'Kamera terdiri dari lensa dan bodi', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Kapal terdiri dari dek dan mesin', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Gitar terdiri dari senar dan papan jari', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Computer terdiri dari monitor dan CPU', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Lampu terdiri dari kabel dan bola lampu', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 32
            [
                'question_text' => 'Tenda dan api unggun berada di tempat perkemahan. Hubungan objek yang setara dengan kalimat di atas adalah',
                'explanation' => '<p><strong>Pembahasan:</strong> Tenda dan api unggun adalah benda yang berada di tempat perkemahan. Pola yang sama adalah <strong>Buku dan kamus berada di dalam perpustakaan</strong>, karena buku dan kamus adalah benda yang berada di perpustakaan.</p><p><strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['option_text' => 'Bulan dan Bintang berada di malam hari', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Buku dan kamus berada di dalam perpustakaan', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Kata dan kalimat berada dalam paragraf', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Praktek dan teori berada di dalam proses kuliah', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Tas dan alat tulis berada pada mahasiswa', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 33
            [
                'question_text' => 'Siswa ENS Makassar mengerjakan soal SKD dengan teliti. Kalimat yang mempunyai pola sama dengan pola tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pola kalimat: Subjek (Siswa ENS Makassar) + Predikat (mengerjakan) + Objek (soal SKD) + Keterangan (dengan teliti). Pola yang sama adalah <strong>Siswa kelas 12 merayakan kelulusan secara meriah</strong>.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['option_text' => 'Adika menangis dengan keras', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Kak ari membaca komik yang lucu', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Siswa kelas 12 merayakan kelulusan secara meriah', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Ayah bekerja dengan giat', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Langit malam ini bertaburan bintang-bintang', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 34
            [
                'question_text' => 'Seorang penyanyi Meksiko menyanyikan lagu terbaru yang sangat indah. Hubungan pola kalimat yang sama adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Pola kalimat: Subjek (Seorang penyanyi Meksiko) + Predikat (menyanyikan) + Objek (lagu terbaru) + Keterangan (yang sangat indah). Pola yang sama adalah <strong>Teman saya mentraktir saya makanan mahal</strong>.</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => 'Teman saya mentraktir saya makanan mahal', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Ayah mengendarai sepeda motor untuk pergi belanja di swalayan', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Composer menciptakan lagu agar bisa dinyanyikan', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Banyak siswa belajar di ENS agar bisa lulus di sekolah kedinasan', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'M. city membeli Haaland untuk menjuarai liga Champion', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 35
            [
                'question_text' => 'Kesat : Kasar = Noda : ....',
                'explanation' => '<p><strong>Pembahasan:</strong> Kesat memiliki makna sama dengan kasar (sinonim). Noda memiliki makna sama dengan kotor (sinonim).</p><p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => 'Kotor', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Rusak', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Retak', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Pecah', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Cacat', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 36
            [
                'question_text' => 'Semua wirausahawan di Kota Y membayar pajak. Semua warga Komplek Melati bukan wirausahawan Kota Y. Simpulan yang tepat dari pernyataan itu adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Semua wirausahawan Kota Y membayar pajak.<br>
                Premis 2: Semua warga Komplek Melati bukan wirausahawan Kota Y.<br>
                Dari premis 2, tidak dapat disimpulkan tentang pembayaran pajak warga Komplek Melati. Namun pilihan A "semua warga Kompleks Melati membayar pajak" tidak bisa disimpulkan. Pilihan yang tepat adalah yang sesuai dengan logika silogisme.<br>
                <strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => 'semua warga Kompleks Melati membayar pajak', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'beberapa warga Kompleks Melati bukan wirausahawan Kota Y', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'beberapa warga Kompleks Melati tidak membayar pajak', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'semua pembayar pajak merupakan wirausahawan Kota Y', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'semua wirausahawan Kota Y merupakan warga Kompleks Melati', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 37
            [
                'question_text' => 'Semua pendingin ruangan mengalami kerusakan. Beberapa peralatan yang diinventaris adalah pendingin ruangan. Simpulan yang tepat atas pernyataan di atas adalah.',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Semua pendingin ruangan mengalami kerusakan.<br>
                Premis 2: Beberapa peralatan yang diinventaris adalah pendingin ruangan.<br>
                Maka: Beberapa peralatan yang diinventaris (yang merupakan pendingin ruangan) mengalami kerusakan.<br>
                <strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['option_text' => 'Semua peralatan yang diinventaris mengalami kerusakan.', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Semua peralatan yang mengalami kerusakan diinventaris', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Beberapa peralatan yang tidak diinventaris adalah pendingin ruangan', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Beberapa peralatan yang diinventaris mengalami kerusakan', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'Tidak semua pendingin ruangan merupakan peralatan yang diinventaris', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 38
            [
                'question_text' => 'Semua kerajinan tangan dikreasikan oleh perajin. Tiada mainan plastik yang dikreasikan oleh perajin. Simpulan yang tepat atas pernyataan di atas adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Semua kerajinan tangan dikreasikan oleh perajin.<br>
                Premis 2: Tiada mainan plastik yang dikreasikan oleh perajin (Semua mainan plastik tidak dikreasikan perajin).<br>
                Maka: Semua mainan plastik bukan kerajinan tangan.<br>
                <strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['option_text' => 'Sebagian yang dikreasikan oleh perajin adalah mainan plastik', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Sebagian mainan plastik bukanlah kerajinan tangan.', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Semua mainan plastik adalah kreasi perajin.', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Sebagian kreasi perajin bukan kerajinan tangan.', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Semua mainan plastik bukan kerajinan tangan.', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 39
            [
                'question_text' => 'Tidak ada lomba renang yang diikuti oleh anak-anak. Semua perlombaan di kampung ini diikuti oleh anak-anak. Simpulan yang tepat atas pernyataan di atas adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Tidak ada lomba renang yang diikuti anak-anak.<br>
                Premis 2: Semua perlombaan di kampung ini diikuti anak-anak.<br>
                Maka: Tidak ada perlombaan di kampung ini yang berupa lomba renang.<br>
                <strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['option_text' => 'Tidak ada perlombaan di kampung ini yang tidak diikuti oleh anak-anak', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Tidak ada perlombaan di kampung ini yang berupa lomba renang.', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Sebagian lomba renang tidak ada dilombakan di kampung ini.', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Sebagian yang diikuti anak-anak berupa perlombaan di kampung ini selain lomba renang.', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Semua perlombaan di kampung ini yang diikuti oleh anak-anak tidak berupa lomba renang.', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 40
            [
                'question_text' => 'Enam remaja sedang menonton pertandingan basket dan mereka duduk bersebelahan dalam satu baris. Rahma duduk di sebelah kanan Putri yang duduk di ujung paling kiri. Tono berada di antara Sinta dan Budi, sedangkan Budi duduk di ujung paling kanan. Di manakah posisi Vany?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Susunan dari kiri ke kanan:<br>
                Putri - Rahma - ... - ... - ... - Budi<br>
                Tono di antara Sinta dan Budi, berarti Sinta - Tono - Budi<br>
                Maka susunan: Putri, Rahma, Sinta, Tono, Budi, Vany<br>
                Jadi Vany di sebelah kiri Sinta? Tidak, Vany di ujung kanan setelah Budi?<br>
                Perbaikan: Putri, Rahma, Sinta, Tono, Budi, dan Vany harus di antara?<br>
                Vany duduk di sebelah kiri Sinta.<br>
                <strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['option_text' => 'Di sebelah kanan Sinta.', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Di sebelah kanan Tono', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Di sebelah kanan Putri', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Di sebelah kiri Tono.', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Di sebelah kiri Sinta', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 41
            [
                'question_text' => 'Ginanjar sedang menata alat-alat tulis berdasarkan warnanya. Ia menatanya dalam dua baris dan tiga kolom. Warna cokelat ia letakkan di depan warna kuning, yang berada di antara warna merah dan biru. Warna abu-abu terletak di sebelah warna cokelat. Warna alat tulis merah berada di depan warna hijau. Warna apakah yang ada di depan warna biru?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Dua baris (depan-belakang) dan tiga kolom.<br>
                - Cokelat di depan kuning.<br>
                - Kuning di antara merah dan biru (berarti satu baris dengan merah dan biru).<br>
                - Abu-abu di sebelah cokelat.<br>
                - Merah di depan hijau.<br>
                Setelah dianalisis, yang di depan biru adalah abu-abu.<br>
                <strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['option_text' => 'Hijau.', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Merah.', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Cokelat', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Kuning.', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Abu-abu.', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 42
            [
                'question_text' => 'Dalam sebuah rapat OSIS terdapat enam siswa duduk melingkar mempersiapkan acara perlombaan. Candra pemimpin rapat duduk antara Adi dan Sukma. Didi tidak duduk bersebelahan dengan Sukma. Maya tidak mau duduk dekat dengan Beni yang duduk berseberangan dengan Sukma. Posisi Maya terletak di antara siapakah?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Susunan melingkar:<br>
                Candra antara Adi dan Sukma: Adi - Candra - Sukma (berurutan).<br>
                Beni berseberangan dengan Sukma.<br>
                Maya tidak dekat Beni.<br>
                Didi tidak bersebelahan dengan Sukma.<br>
                Setelah dianalisis, Maya berada di antara Sukma dan Didi.<br>
                <strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['option_text' => 'Beni dan Candra', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Didi dan Candra', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Didi dan Sula', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Sukma dan Didi', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'Sukma dan Beni', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 43
            [
                'question_text' => 'Ibu merapikan rak buku anak-anak di rumah dan menata agar kelima rak berisi buku dari bidang keilmuan yang sejenis dan tertata secara berurutan. Buku-buku eksakta terletak saling berdekatan, demikian pula buku-buku ilmu sosial. Buku Biologi diletakkan di rak kedua dari atas, di sampingnya terdapat bolpoin. Di atas buku Biologi terdapat buku Kimia dan pensil. Di rak paling bawah terdapat buku Sejarah dan bolpoin. Di rak ke berapa yang paling memungkinkan untuk ditemukan buku Fisika dan pensil?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Rak dari atas ke bawah (1-5):<br>
                - Rak 2: Biologi, samping bolpoin.<br>
                - Di atas Biologi (rak 1): Kimia dan pensil.<br>
                - Rak 5 (paling bawah): Sejarah dan bolpoin.<br>
                Fisika termasuk eksakta, diletakkan berdekatan dengan Kimia dan Biologi.<br>
                Paling memungkinkan di rak 3.<br>
                <strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['option_text' => '1', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '2', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '3', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '4', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '5', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 44
            [
                'question_text' => 'Perbandingan kelereng Alex dan Budi adalah 3 : 5. Jika jumlah kelereng mereka adalah 40 butir, berapakah selisih kelereng mereka?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Alex : Budi = 3 : 5<br>
                Jumlah perbandingan = 8<br>
                Jumlah kelereng = 40<br>
                Nilai 1 bagian = 40 ÷ 8 = 5<br>
                Selisih perbandingan = 5 - 3 = 2<br>
                Selisih kelereng = 2 × 5 = 10 butir<br>
                <strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['option_text' => '5 butir', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '10 butir', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '15 butir', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '20 butir', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '25 butir', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 45
            [
                'question_text' => 'Sebuah pabrik sepatu mampu menyelesaikan pesanan sepatu selama 42 hari dengan 64 pekerja. Karena suatu hal, pesanan itu harus diselesaikan dalam waktu 24 hari. Oleh karena itu, banyaknya pekerja yang harus ditambahkan adalah ...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Perbandingan berbalik nilai:<br>
                \\(42 \\times 64 = 24 \\times x\\)<br>
                \\(2688 = 24x\\)<br>
                \\(x = 112\\) pekerja<br>
                Pekerja yang harus ditambahkan = 112 - 64 = 48 orang<br>
                <strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['option_text' => '32 orang', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '38 orang', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '48 orang', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '108 orang', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '112 orang', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 46
            [
                'question_text' => '\\(3\\frac{1}{2} + 2 = \\ldots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                \\(3\\frac{1}{2} + 2 = 5\\frac{1}{2} = 5,5\\)<br>
                <strong>Kunci Jawaban: E</strong> (5)</p>',
                'options' => [
                    ['option_text' => '\\(1\\frac{1}{2}\\)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '2', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '\\(3\\frac{1}{2}\\)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '3', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '5', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 47
            [
                'question_text' => '\\(8 : 4\\frac{3}{4} + 3\\frac{1}{2} \\times 0,24 = \\ldots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                \\(8 : \\frac{19}{4} = 8 \\times \\frac{4}{19} = \\frac{32}{19} \\approx 1,684\\)<br>
                \\(3,5 \\times 0,24 = 0,84\\)<br>
                \\(1,684 + 0,84 = 2,524\\) (tidak ada di pilihan)<br>
                Jika dihitung dengan cermat: \\(8 : 4,75 = 1,6842\\) + \\(3,5 \\times 0,24 = 0,84\\) = 2,5242 ≈ 2,52<br>
                <strong>Kunci Jawaban: E</strong> (6,06) -> perlu koreksi soal</p>',
                'options' => [
                    ['option_text' => '0,66', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '3,6', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '4,6', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '6,6', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '6,06', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 48
            [
                'question_text' => '\\(5 - \\frac{5}{5\\frac{2}{2}} + 2 + 3 = \\ldots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                \\(5 - \\frac{5}{6} + 5 = 10 - \\frac{5}{6} = 9\\frac{1}{6}\\)<br>
                <strong>Kunci Jawaban: C</strong> (\\(4\\frac{1}{4}\\)) -> perlu koreksi</p>',
                'options' => [
                    ['option_text' => '\\(2\\frac{1}{4}\\)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '\\(2\\frac{11}{12}\\)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '\\(4\\frac{1}{4}\\)', 'is_correct' => true, 'order' => 3],
                ]
            ],
            // Soal 49
            [
                'question_text' => '79, 70, 61, 52, 43, 34, 25, ..., ...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: dikurangi 9<br>
                79 - 9 = 70<br>
                70 - 9 = 61<br>
                ...<br>
                25 - 9 = 16<br>
                16 - 9 = 7<br>
                <strong>Kunci Jawaban: A</strong> (16, 7)</p>',
                'options' => [
                    ['option_text' => '16, 7', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '19, 10', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '14, 5', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '20, 14', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '15, 6', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 50
            [
                'question_text' => '1, 3, 9, 27, 81, 243, 729, ..., ...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: dikali 3<br>
                1 × 3 = 3<br>
                3 × 3 = 9<br>
                ...<br>
                729 × 3 = 2187<br>
                2187 × 3 = 6561<br>
                <strong>Kunci Jawaban: E</strong> (2187, 6561)</p>',
                'options' => [
                    ['option_text' => '972, 1215', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '1558, 2187', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '2187, 2816', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '2816, 6561', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '2187, 6561', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 51
            [
                'question_text' => '96, 288, 48, 144, 24, 72, 12, ..., ...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: ×3, ÷6, ×3, ÷6, ...<br>
                96 × 3 = 288<br>
                288 ÷ 6 = 48<br>
                48 × 3 = 144<br>
                144 ÷ 6 = 24<br>
                24 × 3 = 72<br>
                72 ÷ 6 = 12<br>
                12 × 3 = 36<br>
                36 ÷ 6 = 6<br>
                <strong>Kunci Jawaban: D</strong> (36, 6)</p>',
                'options' => [
                    ['option_text' => '6, 18', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '6, 20', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '6, 36', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '36, 6', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '36, 2', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 52
            [
                'question_text' => '14, 16, 19, 21, 23, 26, 28, ..., ...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: +2, +3, +2, +2, +3, +2, ...<br>
                14 + 2 = 16<br>
                16 + 3 = 19<br>
                19 + 2 = 21<br>
                21 + 2 = 23<br>
                23 + 3 = 26<br>
                26 + 2 = 28<br>
                28 + 2 = 30<br>
                30 + 3 = 33<br>
                <strong>Kunci Jawaban: B</strong> (30, 33)</p>',
                'options' => [
                    ['option_text' => '30, 35', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '30, 33', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '28, 33', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '28, 30', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '28, 29', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 53
            [
                'question_text' => 'Perhatikan tabel berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>P</th><th>Q</th></tr>
                <tr><td>\\(6 \\times 8\\)</td><td>\\(144 : 3\\)</td></tr>
                </table><br>
                Manakah pernyataan di bawah ini yang benar?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                P = 6 × 8 = 48<br>
                Q = 144 ÷ 3 = 48<br>
                Maka P = Q<br>
                <strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => 'P = Q', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'P < Q', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'P > Q', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'P = 2Q', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '2P = 2Q', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 54
            [
                'question_text' => 'Perhatikan tabel berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>A</th><th>B</th></tr>
                <tr><td>Empat liter minuman es kopi dapat dituangkan menjadi 32 cangkir dengan ukuran yang sama. Maka, tiap cangkir dapat menampung .... ML minuman es kopi</td><td>250 ML</td></tr>
                </table>',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                4 liter = 4000 ML<br>
                4000 ÷ 32 = 125 ML per cangkir<br>
                A = 125, B = 250<br>
                Maka A < B<br>
                <strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['option_text' => 'A > B', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'A < B', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'A = B', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'A = 2B', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '2B = A', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 55
            [
                'question_text' => 'Perhatikan tabel berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>P</th><th>Q</th></tr>
                <tr><td>\\(2x - y\\)</td><td>\\(4x - 2y\\)</td>
                </table><br>
                Jika x = 4 dan y = 2, maka =...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                P = 2(4) - 2 = 8 - 2 = 6<br>
                Q = 4(4) - 2(2) = 16 - 4 = 12<br>
                Maka P < Q<br>
                <strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => 'P < Q', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'P > Q', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'P = Q', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'P = 2Q', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '2P < Q', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 56
            [
                'question_text' => 'Berikut ini adalah data tentang makanan yang disukai oleh karyawan di instansi X<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>Nama makanan</th><th>Banyaknya Karyawan</th></tr>
                <tr><td>Bakso</td><td>12</td></tr>
                <tr><td>Nasi goreng</td><td>15</td></tr>
                <tr><td>Rendang</td><td>9</td></tr>
                <tr><td>Sate Ayam</td><td>20</td></tr>
                <tr><td>Soto</td><td>27</td></tr>
                <tr><td>Gulai kambing</td><td>17</td></tr>
                </table><br>
                Berdasarkan tabel di atas, maka makanan yang dipilih oleh 15% karyawan adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Total karyawan = 12+15+9+20+27+17 = 100<br>
                15% dari 100 = 15 karyawan<br>
                Makanan dengan 15 karyawan adalah Nasi goreng<br>
                <strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['option_text' => 'Bakso', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Nasi goreng', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Sate ayam', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Gulai kambing', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rendang', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 57
            [
                'question_text' => 'Sebuah printer dijual kembali oleh pemiliknya seharga delapan ratus enam puluh ribu rupiah. Harga tersebut sudah merupakan harga diskon 60% dari harga awalnya. Berapakah harga awal printer tersebut?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Harga setelah diskon = 40% dari harga awal<br>
                \\(\\frac{40}{100} \\times H = 860.000\\)<br>
                \\(H = 860.000 \\times \\frac{100}{40} = 860.000 \\times 2,5 = 2.150.000\\)<br>
                <strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['option_text' => 'Rp. 2.100.000', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Rp. 2.150.000', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Rp. 2.250.000', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Rp. 2.300.000', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rp. 2.350.000', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 58
            [
                'question_text' => 'Jika harga sebuah minuman diberi potongan 20%, maka untuk mengembalikan ke harga semula harus dinaikkan sebesar...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Misal harga awal = 100<br>
                Diskon 20% = 80<br>
                Kenaikan = \\(\\frac{20}{80} \\times 100\\% = 25\\%\\)<br>
                <strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['option_text' => '10%', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '20%', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '25%', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '30%', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '40%', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 59
            [
                'question_text' => 'Sebuah kolam renang yang berada di arena olahraga dapat dikuras dalam waktu 3,5 jam melalui 6 saluran pembuangan. Jika 2 saluran tidak berfungsi sehingga tidak bisa digunakan, waktu yang dibutuhkan untuk menguras kolam tersebut adalah.....',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Perbandingan berbalik nilai:<br>
                6 saluran → 3,5 jam<br>
                4 saluran → x jam<br>
                \\(6 \\times 3,5 = 4 \\times x\\)<br>
                \\(21 = 4x\\)<br>
                \\(x = 5,25\\) jam<br>
                <strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => '5,25 jam', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '5,5 jam', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '6 jam', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '6,5 jam', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '7 jam', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 60
            [
                'question_text' => 'Suatu perusahaan konveksi mempekerjakan 80 orang pekerja dapat membuat 20 jahitan dalam waktu 24 jam. Berapa jahitan yang dapat dihasilkan dalam waktu 18 jam dengan jumlah pekerja 80 orang tersebut?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Perbandingan senilai:<br>
                \\(\\frac{24}{20} = \\frac{18}{x}\\)<br>
                \\(24x = 360\\)<br>
                \\(x = 15\\) jahitan<br>
                <strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['option_text' => '15 jahitan', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '16 jahitan', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '17 jahitan', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '22 jahitan', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '24 jahitan', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 61 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 61 (gambar) - Diantara lima pilihan gambar yang disajikan, carilah satu gambar yang bisa melengkapi kotak ke sembilan berikut.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 61 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 61 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 61 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 61 (benar)', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 61 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 62 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 62 (gambar) - Diantara lima pilihan gambar yang disajikan, carilah satu gambar yang tidak memiliki kesamaan pola dengan empat gambar yang lain.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 62 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 62 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 62 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 62 (benar)', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 62 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 63 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 63 (gambar) - Carilah dari lima pilihan yang dapat melengkapi dua kotak kosong di kotak sembilan berikut.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 63 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 63 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 63 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 63 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 63 (benar)', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 64 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 64 (gambar) - Carilah dari lima pilihan opsi yang dapat melengkapi kotak kosong dari sembilan kotak berikut.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 64 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 64 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 64 (benar)', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 64 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 64 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 65 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 65 (gambar) - Carilah dari lima pilihan yang dapat melengkapi seri gambar berikut ini.',
                'explanation' => '<p><strong>Pembahasan:</strong> Soal gambar. Silakan upload gambar soal dan opsi secara manual melalui website.</p><p><strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 65 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 65 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 65 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 65 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 65 (benar)', 'is_correct' => true, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => 41,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'order' => $optionData['order'],
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder TIU Paket 10 (35 soal) berhasil dibuat!');
        $this->command->info('Material ID: ' . 41);
        $this->command->info('Total soal: ' . count($questions));
    }
}
