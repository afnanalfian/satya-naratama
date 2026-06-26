<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TKPTOGRATIS2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 49
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 3]
        );

        $questions = [
            // Soal 66
            [
                'question_text' => 'Seorang oknum perusahaan menawarkan anda untuk dapat naik jabatan dengan memberi sejumlah uang. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Menolak karena ingin naik jabatan karena kemampuan sendiri adalah sikap yang paling profesional dan berintegritas.</p>
                <p><strong>Kunci Bobot: 5=c, 4=a, 3=d, 2=b, 1=e</strong></p>
                <p>5 = Menolak karena anda ingin naik jabatan karena kemampuan yang anda miliki (c)<br>
                4 = Melaporkan hal tersebut kepada bagian disiplin pegawai (a)<br>
                3 = Mempertimbangkan risikonya (d)<br>
                2 = Mencoba terlebih dahulu cara yang resmi sebelum melalui cara seperti itu (b)<br>
                1 = Menerima tawaran akibat persaingan yang ketat (e)</p>',
                'options' => [
                    ['text' => 'Melaporkan hal tersebut kepada bagian disiplin pegawai', 'weight' => 4],
                    ['text' => 'Mencoba terlebih dahulu cara yang resmi sebelum melalui cara seperti itu', 'weight' => 2],
                    ['text' => 'Menolak karena anda ingin naik jabatan karena kemampuan yang anda miliki', 'weight' => 5],
                    ['text' => 'Mempertimbangkan risikonya', 'weight' => 3],
                    ['text' => 'Menerima tawaran akibat persaingan yang ketat', 'weight' => 1],
                ]
            ],
            // Soal 67
            [
                'question_text' => 'Melakukan plagiasi karya tulis dari internet untuk keperluan tugas kuliah adalah hal yang...',
                'explanation' => '<p><strong>Pembahasan:</strong> Plagiasi adalah tindakan melanggar hak cipta dan tidak boleh dilakukan.</p>
                <p><strong>Kunci Bobot: 5=d, 4=e, 3=b, 2=c, 1=a</strong></p>
                <p>5 = Tidak boleh dilakukan (d)<br>
                4 = Tidak bisa dibiarkan (e)<br>
                3 = Melanggar hak orang lain (b)<br>
                2 = Mempermudah hidup (c)<br>
                1 = Wajar (a)</p>',
                'options' => [
                    ['text' => 'Wajar', 'weight' => 1],
                    ['text' => 'Melanggar hak orang lain', 'weight' => 3],
                    ['text' => 'Mempermudah hidup', 'weight' => 2],
                    ['text' => 'Tidak boleh dilakukan', 'weight' => 5],
                    ['text' => 'Tidak bisa dibiarkan', 'weight' => 4],
                ]
            ],
            // Soal 68
            [
                'question_text' => 'Bagaimana cara anda membanggakan orang tua dan tanah air?',
                'explanation' => '<p><strong>Pembahasan:</strong> Dimanapun berkarya, memberikan kontribusi terhadap pembangunan bangsa adalah bentuk kebanggaan yang tulus.</p>
                <p><strong>Kunci Bobot: 5=a, 4=e, 3=d, 2=c, 1=b</strong></p>
                <p>5 = Di mana pun anda berkarya, anda akan turut memberikan kontribusi terhadap pembangunan bangsa (a)<br>
                4 = Di mana pun anda berkarya, anda akan turut memberikan kontribusi terhadap pembangunan bangsa dengan syarat didukung oleh pemerintah (e)<br>
                3 = Ketika anda menjadi anggota Dewan Perwakilan Rakyat (d)<br>
                2 = Ketika anda menjadi seorang birokrat tingkat atas (c)<br>
                1 = Jika anda berkarya sebagai pegawai negeri sipil (b)</p>',
                'options' => [
                    ['text' => 'Di mana pun anda berkarya, anda akan turut memberikan kontribusi terhadap pembangunan bangsa', 'weight' => 5],
                    ['text' => 'Jika anda berkarya sebagai pegawai negeri sipil', 'weight' => 1],
                    ['text' => 'Ketika anda menjadi seorang birokrat tingkat atas', 'weight' => 2],
                    ['text' => 'Ketika anda menjadi anggota Dewan Perwakilan Rakyat', 'weight' => 3],
                    ['text' => 'Di mana pun anda berkarya, anda akan turut memberikan kontribusi terhadap pembangunan bangsa dengan syarat didukung oleh pemerintah', 'weight' => 4],
                ]
            ],
            // Soal 69
            [
                'question_text' => 'Saat sedang cuti dan berkumpul bersama keluarga, atasan menyuruh saya untuk ke kantor dan menyelesaikan pekerjaan yang sangat penting. Sikap saya...',
                'explanation' => '<p><strong>Pembahasan:</strong> Meminta pertimbangan keluarga adalah sikap bijaksana yang menghargai kedua belah pihak.</p>
                <p><strong>Kunci Jawaban: b. Meminta pertimbangan keluarga</strong></p>',
                'options' => [
                    ['text' => 'Menolak karena ingin berkumpul dengan keluarga', 'weight' => 2],
                    ['text' => 'Meminta pertimbangan keluarga', 'weight' => 5],
                    ['text' => 'Menolak karena ingin bersantai', 'weight' => 1],
                    ['text' => 'Menolak karena sedang berlibur di luar kota', 'weight' => 3],
                    ['text' => 'Siap ke kantor dan menyelesaikan pekerjaan', 'weight' => 4],
                ]
            ],
            // Soal 70
            [
                'question_text' => 'Karena pimpinan sedang di luar kota, anda ditunjuk untuk memimpin rapat. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memberikan gagasan dan solusi secara langsung menunjukkan inovasi dan kreasi dalam bekerja.</p>
                <p><strong>Kunci Bobot: 5=e, 4=a, 3=b, 2=d, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Anda memberi orang lain pertanyaan menantang', 'weight' => 4],
                    ['text' => 'Anda memberi pernyataan awal lalu sebagai pengamat', 'weight' => 3],
                    ['text' => 'Anda mengarahkan alur diskusi sesuai dengan harapan anda', 'weight' => 1],
                    ['text' => 'Anda cukup menjadi penengah dan mengambil pilihan terbanyak', 'weight' => 2],
                    ['text' => 'Anda selalu memberikan gagasan dan solusi secara langsung saat diskusi', 'weight' => 5],
                ]
            ],
            // Soal 71
            [
                'question_text' => 'Ketika menjadi ASN, anda dituntut untuk kreatif dan inovatif, maka yang anda lakukan adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Bereksperimen adalah bentuk nyata dari kreativitas dan inovasi.</p>
                <p><strong>Kunci Bobot: 5=b, 4=e, 3=d, 2=c, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Diam', 'weight' => 1],
                    ['text' => 'Bereksperimen', 'weight' => 5],
                    ['text' => 'Mengikuti orang lain', 'weight' => 2],
                    ['text' => 'Rajin membaca', 'weight' => 3],
                    ['text' => 'Berani mengambil resiko', 'weight' => 4],
                ]
            ],
            // Soal 72
            [
                'question_text' => 'Kreatif harus dilakukan untuk hal-hal yang positif. Berikut adalah bentuk kreatif yang harus dihindari...',
                'explanation' => '<p><strong>Pembahasan:</strong> Mencari celah peraturan untuk dilanggar adalah kreativitas negatif yang harus dihindari.</p>
                <p><strong>Kunci Bobot: 5=c, 4=a, 3=d, 2=b, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Mengkritisi peraturan kantor yang melanggar hak karyawan', 'weight' => 4],
                    ['text' => 'Mengembangkan program komputer yang meringankan pekerjaan kantor', 'weight' => 2],
                    ['text' => 'Mencari celah peraturan kantor untuk dilanggar', 'weight' => 5],
                    ['text' => 'Memecahkan masalah yang ada di kantor', 'weight' => 3],
                    ['text' => 'Menemukan sistem agar karyawan selalu datang tepat waktu', 'weight' => 1],
                ]
            ],
            // Soal 73
            [
                'question_text' => 'Kesuksesan jenjang karir ASN tergantung pada...',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengembangkan hal-hal baru yang belum pernah diciptakan sebelumnya adalah kunci kesuksesan ASN.</p>
                <p><strong>Kunci Bobot: 5=d, 4=c, 3=b, 2=e, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Mengikuti perintah dan arahan pimpinan secara royal dan penuh kepatuhan', 'weight' => 1],
                    ['text' => 'Menciptakan hubungan baik dengan setiap orang', 'weight' => 3],
                    ['text' => 'Melakukan pekerjaan yang terbaik dengan standar kinerja yang tinggi', 'weight' => 4],
                    ['text' => 'Mengembangkan hal-hal baru yang belum pernah diciptakan sebelumnya', 'weight' => 5],
                    ['text' => 'Bekerja sesuai dengan ketentuan yang telah ditetapkan oleh pimpinan', 'weight' => 2],
                ]
            ],
            // Soal 74
            [
                'question_text' => 'Anda mengetahui bahwa pimpinan melakukan kesalahan, tetapi tidak ada yang berani mengingatkan. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memberitahu dan meminta ijin menyampaikan perbaikan adalah sikap yang berani dan bijaksana.</p>
                <p><strong>Kunci Bobot: 5=a, 4=e, 3=d, 2=b, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Memberitahunya dan meminta ijin menyampaikan perbaikan', 'weight' => 5],
                    ['text' => 'Takut memberitahu karena akan menyinggung perasaannya', 'weight' => 2],
                    ['text' => 'Ikut diam karena tidak mau mengambil risiko', 'weight' => 1],
                    ['text' => 'Berdoa agar pimpinan segera menyadarinya', 'weight' => 3],
                    ['text' => 'Menyuruh rekan yang lain menegur', 'weight' => 4],
                ]
            ],
            // Soal 75
            [
                'question_text' => 'Seorang rekan kerja di kantor sering meminta bantuan atas pekerjaan yang belum ia kuasai. Sikap saya...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memberi arahan dan bantuan adalah sikap kepedulian yang terbaik.</p>
                <p><strong>Kunci Bobot: 5=e, 4=d, 3=c, 2=a, 1=b</strong></p>',
                'options' => [
                    ['text' => 'Memberinya buku petunjuk untuk belajar', 'weight' => 2],
                    ['text' => 'Memintanya bertanya kepada rekan kerja lain karena anda sedang sibuk', 'weight' => 1],
                    ['text' => 'Membantunya ketika anda tidak ada pekerjaan lain', 'weight' => 3],
                    ['text' => 'Mengajarinya setelah jam kerja', 'weight' => 4],
                    ['text' => 'Memberinya arahan dan bantuan', 'weight' => 5],
                ]
            ],
            // Soal 76
            [
                'question_text' => 'Bulan ini sahabat dekat anda berulang tahun, sementara uang anda semakin menipis karena ada kebutuhan tidak terduga. Maka anda akan...',
                'explanation' => '<p><strong>Pembahasan:</strong> Membeli kado sesuai kemampuan adalah sikap yang bijaksana dan realistis.</p>
                <p><strong>Kunci Bobot: 5=b, 4=e, 3=c, 2=a, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Berutang agar bisa membeli kado', 'weight' => 2],
                    ['text' => 'Membeli kado sesuai kemampuan', 'weight' => 5],
                    ['text' => 'Meminta maaf karena tidak bisa memberinya kado', 'weight' => 3],
                    ['text' => 'Menghindari sahabat anda', 'weight' => 1],
                    ['text' => 'Berjanji akan memberinya kado saat gajian', 'weight' => 4],
                ]
            ],
            // Soal 77
            [
                'question_text' => 'Saat menyampaikan pendapat, anda berusaha agar...',
                'explanation' => '<p><strong>Pembahasan:</strong> Tidak menyinggung perasaan orang lain adalah prioritas utama dalam menyampaikan pendapat.</p>
                <p><strong>Kunci Bobot: 5=a, 4=b, 3=e, 2=c, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Tidak menyinggung perasaan orang lain', 'weight' => 5],
                    ['text' => 'Membuat semua orang merasa dihargai', 'weight' => 4],
                    ['text' => 'Pendapat anda diterima', 'weight' => 2],
                    ['text' => 'Menunjukkan kemampuan anda', 'weight' => 1],
                    ['text' => 'Membahagiakan orang lain', 'weight' => 3],
                ]
            ],
            // Soal 78
            [
                'question_text' => 'Orang tua anda tiba-tiba masuk rumah sakit, sementara anda memiliki jadwal rapat yang sangat penting dengan klien. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Meminta pengertian klien untuk mengganti jadwal adalah solusi terbaik.</p>
                <p><strong>Kunci Bobot: 5=c, 4=a, 3=b, 2=d, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Tetap ikut rapat', 'weight' => 4],
                    ['text' => 'Meminta rekan kerja yang lain untuk menggantikan anda', 'weight' => 3],
                    ['text' => 'Meminta pengertian klien untuk mengganti jadwal', 'weight' => 5],
                    ['text' => 'Tidak konsentrasi saat rapat', 'weight' => 2],
                    ['text' => 'Tidak memberi kabar', 'weight' => 1],
                ]
            ],
            // Soal 79
            [
                'question_text' => 'Apa yang akan anda lakukan jika pekerjaan anda saat ini telah selesai?',
                'explanation' => '<p><strong>Pembahasan:</strong> Mempersiapkan pekerjaan selanjutnya adalah sikap proaktif.</p>
                <p><strong>Kunci Bobot: 5=e, 4=c, 3=b, 2=a, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Bermain game', 'weight' => 2],
                    ['text' => 'Mengobrol dengan rekan kerja', 'weight' => 3],
                    ['text' => 'Menawarkan bantuan kepada rekan', 'weight' => 4],
                    ['text' => 'Tidur', 'weight' => 1],
                    ['text' => 'Mempersiapkan pekerjaan selanjutnya', 'weight' => 5],
                ]
            ],
            // Soal 80
            [
                'question_text' => 'Apa pertimbangan anda ketika menerima pekerjaan?',
                'explanation' => '<p><strong>Pembahasan:</strong> Kemampuan bekerja sendiri adalah pertimbangan utama untuk mandiri.</p>
                <p><strong>Kunci Bobot: 5=a, 4=e, 3=b, 2=d, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Kemampuan bekerja saya', 'weight' => 5],
                    ['text' => 'Imbalan yang diberikan', 'weight' => 3],
                    ['text' => 'Bantuan orang lain', 'weight' => 1],
                    ['text' => 'Pekerjaan tersebut mudah', 'weight' => 2],
                    ['text' => 'Pekerjaan yang telah selesai', 'weight' => 4],
                ]
            ],
            // Soal 81
            [
                'question_text' => 'Di antara rekan anda, anda dikenal sebagai orang yang…',
                'explanation' => '<p><strong>Pembahasan:</strong> Ulet adalah sifat yang paling menggambarkan ketekunan dalam bekerja.</p>
                <p><strong>Kunci Bobot: 5=b, 4=d, 3=e, 2=c, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Baik hati', 'weight' => 1],
                    ['text' => 'Ulet', 'weight' => 5],
                    ['text' => 'Kaya', 'weight' => 2],
                    ['text' => 'Rajin', 'weight' => 4],
                    ['text' => 'Lucu', 'weight' => 3],
                ]
            ],
            // Soal 82
            [
                'question_text' => 'Instansi tempat anda bekerja memiliki program pertukaran karyawan dengan cabang di negara lain. Mengetahui hal tersebut, yang akan anda lakukan…',
                'explanation' => '<p><strong>Pembahasan:</strong> Mencari informasi pada rekan kerja yang telah lebih dulu mengikuti program adalah langkah bijak.</p>
                <p><strong>Kunci Bobot: 5=d, 4=c, 3=b, 2=a, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Meminta izin kepada keluarga', 'weight' => 2],
                    ['text' => 'Mempertimbangkan segala kemungkinan yang dapat terjadi', 'weight' => 3],
                    ['text' => 'Segera mendaftar dan mempersiapkan diri sebaik mungkin', 'weight' => 4],
                    ['text' => 'Mencari informasi pada rekan kerja yang telah lebih dulu mengikuti program tersebut', 'weight' => 5],
                    ['text' => 'Tidak mendaftar karena merasa hal tersebut kurang berguna', 'weight' => 1],
                ]
            ],
            // Soal 83
            [
                'question_text' => 'Pendapat anda tentang orang yang banyak bertanya adalah..',
                'explanation' => '<p><strong>Pembahasan:</strong> Orang yang banyak bertanya menunjukkan antusiasme.</p>
                <p><strong>Kunci Bobot: 5=a, 4=b, 3=c, 2=d, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Antusias', 'weight' => 5],
                    ['text' => 'Ingin mencari tahu', 'weight' => 4],
                    ['text' => 'Tidak punya kompetensi yang memadai', 'weight' => 3],
                    ['text' => 'Kritis dan mau belajar', 'weight' => 2],
                    ['text' => 'Berisik', 'weight' => 1],
                ]
            ],
            // Soal 84
            [
                'question_text' => 'Besok anda akan mengikuti ujian untuk melanjutkan pendidikan, sementara anda diminta untuk lembur karena banyaknya pekerjaan. Sikap anda adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Menolak untuk ikut lembur demi pendidikan adalah prioritas yang tepat.</p>
                <p><strong>Kunci Bobot: 5=c, 4=e, 3=d, 2=b, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Meminta izin kepada pimpinan untuk pulang lebih dahulu', 'weight' => 1],
                    ['text' => 'Pulang diam-diam karena anda harus belajar', 'weight' => 2],
                    ['text' => 'Menolak untuk ikut lembur', 'weight' => 5],
                    ['text' => 'Meminta pengertian rekan kerja yang lain untuk menggantikan anda', 'weight' => 3],
                    ['text' => 'Berjanji akan menyelesaikan pekerjaan setelah ujian selesai', 'weight' => 4],
                ]
            ],
            // Soal 85
            [
                'question_text' => 'Anda sudah beberapa kali gagal lolos ujian masuk untuk melanjutkan kuliah S2. Sikap anda adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengganti jurusan yang dituju adalah strategi adaptif.</p>
                <p><strong>Kunci Bobot: 5=b, 4=e, 3=d, 2=a, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Belajar lebih giat', 'weight' => 2],
                    ['text' => 'Mengganti jurusan yang dituju', 'weight' => 5],
                    ['text' => 'Menyerah', 'weight' => 1],
                    ['text' => 'Mencoba tes di Universitas lain', 'weight' => 3],
                    ['text' => 'Sedih dan takut gagal lagi', 'weight' => 4],
                ]
            ],
            // Soal 86
            [
                'question_text' => 'Kantor anda menuntut agar setiap karyawan memiliki kemampuan bahasa asing. Sikap anda adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengikuti kursus bahasa asing adalah cara paling efektif.</p>
                <p><strong>Kunci Bobot: 5=a, 4=c, 3=b, 2=d, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Mengikuti kursus bahasa asing', 'weight' => 5],
                    ['text' => 'Belajar dari buku-buku perpustakaan', 'weight' => 3],
                    ['text' => 'Berbohong bahwa anda bisa berbahasa asing', 'weight' => 4],
                    ['text' => 'Belajar dari rekan yang pandai berbahasa asing', 'weight' => 2],
                    ['text' => 'Belajar bahasa asing melalui film dan lagu', 'weight' => 1],
                ]
            ],
            // Soal 87
            [
                'question_text' => 'Suatu hari pekerjaan anda sangat banyak, sementara rekan kerja lain terlihat santai. Yang akan anda lakukan adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Meminta bantuan adalah cara yang tepat.</p>
                <p><strong>Kunci Bobot: 5=d, 4=b, 3=a, 2=e, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Menyindirnya karena hanya bersantai', 'weight' => 3],
                    ['text' => 'Meminta izin atasan untuk meminta bantuan rekan', 'weight' => 4],
                    ['text' => 'Ikut berbincang dengannya', 'weight' => 1],
                    ['text' => 'Meminta bantuan', 'weight' => 5],
                    ['text' => 'Memaksanya untuk ikut mengerjakan', 'weight' => 2],
                ]
            ],
            // Soal 88
            [
                'question_text' => 'Instansi tempat anda bekerja mengadakan bakti sosial di daerah padat penduduk. Agar acara tersebut berjalan dengan lancar, yang akan anda perhatikan adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Perizinan penyelenggaraan adalah hal utama yang harus diperhatikan.</p>
                <p><strong>Kunci Bobot: 5=a, 4=c, 3=d, 2=e, 1=b</strong></p>',
                'options' => [
                    ['text' => 'Tentang perizinan penyelenggaraan acara bakti sosial', 'weight' => 5],
                    ['text' => 'Pendistribusian bantuan', 'weight' => 1],
                    ['text' => 'Jumlah warga yang akan diberikan bantuan', 'weight' => 4],
                    ['text' => 'Transportasi menuju lokasi', 'weight' => 3],
                    ['text' => 'Jenis bantuan dan koordinasi dengan pihak terkait agar acara berlangsung dengan tertib', 'weight' => 2],
                ]
            ],
            // Soal 89
            [
                'question_text' => 'Ketika sedang mengerjakan tugas bersama yang harus selesai pada hari yang sama, seorang rekan akan meninggalkan terlebih dahulu, yang saya lakukan…',
                'explanation' => '<p><strong>Pembahasan:</strong> Memintanya untuk mempertimbangkan adalah sikap persuasif.</p>
                <p><strong>Kunci Bobot: 5=c, 4=b, 3=d, 2=e, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Ikut pergi juga', 'weight' => 1],
                    ['text' => 'Membujuknya untuk menyelesaikan tugas', 'weight' => 4],
                    ['text' => 'Memintanya untuk mempertimbangkan', 'weight' => 5],
                    ['text' => 'Meminta pertimbangan rekan lain', 'weight' => 3],
                    ['text' => 'Memaksanya untuk tetap tinggal', 'weight' => 2],
                ]
            ],
            // Soal 90
            [
                'question_text' => 'Setelah mematangkan rencana…',
                'explanation' => '<p><strong>Pembahasan:</strong> Meminta pertimbangan orang lain untuk memperbaiki kekurangan adalah sikap terbuka.</p>
                <p><strong>Kunci Bobot: 5=d, 4=a, 3=e, 2=b, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Berdoa dengan tekun', 'weight' => 4],
                    ['text' => 'Manusia hanya bisa pasrah pada Tuhan', 'weight' => 2],
                    ['text' => 'Menghalalkan segala cara agar berhasil', 'weight' => 1],
                    ['text' => 'Meminta pertimbangan orang lain untuk memperbaiki kekurangan', 'weight' => 5],
                    ['text' => 'Khawatir gagal', 'weight' => 3],
                ]
            ],
            // Soal 91
            [
                'question_text' => 'Manfaat kerja bakti menurut anda adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Mempercepat pekerjaan karena dilakukan bersama.</p>
                <p><strong>Kunci Bobot: 5=d, 4=e, 3=b, 2=c, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Membuang-buang waktu', 'weight' => 1],
                    ['text' => 'Memelihara kerukunan', 'weight' => 3],
                    ['text' => 'Tidak peduli pada kegiatan warga', 'weight' => 2],
                    ['text' => 'Mempercepat pekerjaan karena dilakukan bersama', 'weight' => 5],
                    ['text' => 'Mempererat silaturahmi', 'weight' => 4],
                ]
            ],
            // Soal 92
            [
                'question_text' => 'Salah satu anggota tim anda malas-malasan dalam bekerja. Sikap anda adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Menasehatinya dengan baik adalah langkah pertama yang tepat.</p>
                <p><strong>Kunci Bobot: 5=a, 4=d, 3=b, 2=c, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Menasehatinya dengan baik', 'weight' => 5],
                    ['text' => 'Mengeluarkannya dari tim', 'weight' => 3],
                    ['text' => 'Memarahinya di depan anggota tim lain', 'weight' => 2],
                    ['text' => 'Mengadukannya kepada pimpinan', 'weight' => 4],
                    ['text' => 'Tidak peduli', 'weight' => 1],
                ]
            ],
            // Soal 93
            [
                'question_text' => 'Tim anda dipindahkan ke ruangan yang baru direnovasi sehingga masih kotor. Sikap anda adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Bekerja sama untuk membersihkan adalah tanggung jawab bersama.</p>
                <p><strong>Kunci Bobot: 5=d, 4=a, 3=c, 2=b, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Meminta cleaning service untuk membersihkan', 'weight' => 4],
                    ['text' => 'Menempati ruangan meskipun kotor', 'weight' => 2],
                    ['text' => 'Menolak untuk pindah', 'weight' => 3],
                    ['text' => 'Bekerja sama untuk membersihkan', 'weight' => 5],
                    ['text' => 'Menyuruh anggota termuda untuk membersihkan', 'weight' => 1],
                ]
            ],
            // Soal 94
            [
                'question_text' => 'Tujuan dari memberikan pendapat adalah…',
                'explanation' => '<p><strong>Pembahasan:</strong> Meningkatkan kinerja tim.</p>
                <p><strong>Kunci Bobot: 5=a, 4=e, 3=d, 2=b, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Meningkatkan kinerja tim', 'weight' => 5],
                    ['text' => 'Memberitahu kemampuan kita kepada tim', 'weight' => 2],
                    ['text' => 'Menguntungkan kita', 'weight' => 1],
                    ['text' => 'Memberikan kepedulian kepada tim', 'weight' => 3],
                    ['text' => 'Membantu memecahkan masalah', 'weight' => 4],
                ]
            ],
            // Soal 95
            [
                'question_text' => 'Jika orang lain marah kepada saya, saya akan…',
                'explanation' => '<p><strong>Pembahasan:</strong> Segera meminta maaf adalah sikap yang bijaksana.</p>
                <p><strong>Kunci Jawaban: e. Segera meminta maaf</strong></p>',
                'options' => [
                    ['text' => 'Menunggu ia meminta maaf', 'weight' => 2],
                    ['text' => 'Biasa saja', 'weight' => 3],
                    ['text' => 'Sedih', 'weight' => 1],
                    ['text' => 'Tidak fokus melakukan pekerjaan', 'weight' => 4],
                    ['text' => 'Segera meminta maaf', 'weight' => 5],
                ]
            ],
            // Soal 96
            [
                'question_text' => 'Ketika rekan kerja anda melakukan kesalahan, sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Memberi saran untuk memperbaiki kesalahan adalah sikap yang paling bijak.</p>
                <p><strong>Kunci Bobot: 5=e, 4=a, 3=c, 2=b, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Menasehatinya untuk meminta bantuan atasan', 'weight' => 4],
                    ['text' => 'Mengadukannya pada atasan', 'weight' => 2],
                    ['text' => 'Memakinya', 'weight' => 3],
                    ['text' => 'Membicarakan kesalahannya pada rekan lain', 'weight' => 1],
                    ['text' => 'Memberinya saran untuk memperbaiki kesalahannya', 'weight' => 5],
                ]
            ],
            // Soal 97
            [
                'question_text' => 'Saat sedang melayani antrian pembeli, ada seorang pembeli yang marah-marah karena tidak segera dilayani. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Mempersilahkan pembeli tersebut antre di tempat lain adalah solusi terbaik.</p>
                <p><strong>Kunci Bobot: 5=d, 4=a, 3=b, 2=e, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Membiarkannya saja', 'weight' => 4],
                    ['text' => 'Memakinya karena berisik', 'weight' => 3],
                    ['text' => 'Menyuruh satpam mengusirnya', 'weight' => 1],
                    ['text' => 'Mempersilahkan pembeli tersebut antre di tempat lain', 'weight' => 5],
                    ['text' => 'Memintanya bersabar karena akan dilayani sesuai antrean', 'weight' => 2],
                ]
            ],
            // Soal 98
            [
                'question_text' => 'Saya senang dengan suasana yang...',
                'explanation' => '<p><strong>Pembahasan:</strong> Tidak tergantung pada suasana apapun adalah sikap yang stabil.</p>
                <p><strong>Kunci Bobot: 5=c, 4=b, 3=d, 2=a, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Ramai', 'weight' => 2],
                    ['text' => 'Tenang', 'weight' => 4],
                    ['text' => 'Tidak tergantung pada suasana apapun', 'weight' => 5],
                    ['text' => 'Nyaman', 'weight' => 3],
                    ['text' => 'Tergantung pada suasana hati', 'weight' => 1],
                ]
            ],
            // Soal 99
            [
                'question_text' => 'Saat jam istirahat, anda lebih banyak...',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengobrol dengan rekan kerja lain.</p>
                <p><strong>Kunci Bobot: 5=e, 4=c, 3=b, 2=a, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Menyendiri', 'weight' => 2],
                    ['text' => 'Melanjutkan pekerjaan yang belum selesai', 'weight' => 3],
                    ['text' => 'Berbincang sekedarnya', 'weight' => 4],
                    ['text' => 'Menghindari rekan kerja yang lain', 'weight' => 1],
                    ['text' => 'Mengobrol dengan rekan kerja yang lain', 'weight' => 5],
                ]
            ],
            // Soal 100
            [
                'question_text' => 'Apakah anda selalu memastikan berpenampilan rapi dan sopan setiap hari?',
                'explanation' => '<p><strong>Pembahasan:</strong> Selalu karena tidak tahu apa yang akan dihadapi.</p>
                <p><strong>Kunci Bobot: 5=b, 4=c, 3=d, 2=e, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Saya tidak terlalu peduli', 'weight' => 1],
                    ['text' => 'Selalu, karena tidak tahu apa yang akan dihadapi', 'weight' => 5],
                    ['text' => 'Jika hanya ada acara tertentu', 'weight' => 4],
                    ['text' => 'Hanya jika saya sedang dalam kondisi baik', 'weight' => 3],
                    ['text' => 'Saya hanya berpenampilan seperti biasa, yang penting nyaman', 'weight' => 2],
                ]
            ],
            // Soal 101
            [
                'question_text' => 'Suatu hari anda ingin memiliki rumah yang...',
                'explanation' => '<p><strong>Pembahasan:</strong> Banyak tetangga.</p>
                <p><strong>Kunci Bobot: 5=d, 4=a, 3=c, 2=b, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Aman', 'weight' => 4],
                    ['text' => 'Sunyi', 'weight' => 2],
                    ['text' => 'Nyaman', 'weight' => 3],
                    ['text' => 'Banyak tetangga', 'weight' => 5],
                    ['text' => 'Jauh dari keramaian kota', 'weight' => 1],
                ]
            ],
            // Soal 102
            [
                'question_text' => 'Ketika anda diberi pekerjaan baru, apa yang akan anda rasakan?',
                'explanation' => '<p><strong>Pembahasan:</strong> Tertantang, bersemangat, dan segera menyesuaikan.</p>
                <p><strong>Kunci Bobot: 5=a, 4=b, 3=e, 2=d, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Tertantang, bersemangat, dan segera menyesuaikan', 'weight' => 5],
                    ['text' => 'Biasa saja dan melakukannya', 'weight' => 4],
                    ['text' => 'Marah-marah dan mengeluh', 'weight' => 1],
                    ['text' => 'Panik dan gelisah', 'weight' => 2],
                    ['text' => 'Melakukan sesuai jadwal', 'weight' => 3],
                ]
            ],
            // Soal 103
            [
                'question_text' => 'Yang anda pertimbangkan ketika memilih bank tempat anda menabung adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Aman.</p>
                <p><strong>Kunci Bobot: 5=c, 4=a, 3=b, 2=e, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Karyawannya ramah', 'weight' => 4],
                    ['text' => 'Bunga', 'weight' => 3],
                    ['text' => 'Aman', 'weight' => 5],
                    ['text' => 'Hadiah', 'weight' => 1],
                    ['text' => 'Dekat dengan tempat tinggal', 'weight' => 2],
                ]
            ],
            // Soal 104
            [
                'question_text' => 'Saat anda sedang berada di pusat perbelanjaan, anda bertemu dengan rekan kerja secara kebetulan tetapi anda lupa namanya. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Menyapanya terlebih dahulu.</p>
                <p><strong>Kunci Jawaban: a. Menyapanya terlebih dahulu</strong></p>',
                'options' => [
                    ['text' => 'Menyapanya terlebih dahulu', 'weight' => 5],
                    ['text' => 'Diam saja', 'weight' => 2],
                    ['text' => 'Tersenyum', 'weight' => 4],
                    ['text' => 'Menghindar', 'weight' => 1],
                    ['text' => 'Tidak menyapa karena anda lupa', 'weight' => 3],
                ]
            ],
            // Soal 105
            [
                'question_text' => 'Anda melihat seorang klien telah menunggu cukup lama karena rekan kerja anda terlambat. Sikap anda adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Menghubungi rekan kerja anda agar datang secepatnya.</p>
                <p><strong>Kunci Bobot: 5=b, 4=e, 3=a, 2=d, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Memberinya minuman untuk menemaninya menunggu', 'weight' => 3],
                    ['text' => 'Menghubungi rekan kerja anda agar datang secepatnya', 'weight' => 5],
                    ['text' => 'Membiarkannya menunggu', 'weight' => 1],
                    ['text' => 'Menggantikan rekan kerja anda', 'weight' => 2],
                    ['text' => 'Menanyakan keperluannya datang ke kantor anda', 'weight' => 4],
                ]
            ],
            // Soal 106
            [
                'question_text' => 'Apa pendapat anda terhadap moto senyum, salam, dan sapa pada sebuah tempat pelayanan publik?',
                'explanation' => '<p><strong>Pembahasan:</strong> Sangat bagus untuk dilakukan.</p>
                <p><strong>Kunci Bobot: 5=d, 4=b, 3=c, 2=e, 1=a</strong></p>',
                'options' => [
                    ['text' => 'Buang-buang waktu', 'weight' => 1],
                    ['text' => 'Terkadang boleh dilakukan', 'weight' => 4],
                    ['text' => 'Biasa saja', 'weight' => 3],
                    ['text' => 'Sangat bagus untuk dilakukan', 'weight' => 5],
                    ['text' => 'Tidak penting', 'weight' => 2],
                ]
            ],
            // Soal 107
            [
                'question_text' => 'Setiap orang dalam hidupnya pasti pernah mengalami kegagalan. Jika kegagalan tersebut terjadi pada saya, sikap saya terhadap hal tersebut adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Berusaha lebih giat lagi.</p>
                <p><strong>Kunci Bobot: 5=b, 4=d, 3=c, 2=a, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Tanda bahwa saya harus menyerah', 'weight' => 2],
                    ['text' => 'Berusaha lebih giat lagi', 'weight' => 5],
                    ['text' => 'Membuat saya lemah', 'weight' => 3],
                    ['text' => 'Pasrah dan berusaha tidak menyerah', 'weight' => 4],
                    ['text' => 'Mencari kesalahan orang lain yang mengakibatkan kegagalan tersebut', 'weight' => 1],
                ]
            ],
            // Soal 108
            [
                'question_text' => 'Menurut anda, kriteria seseorang dapat dikatakan profesional adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Semangat dan apresiasi yang selalu tercurahkan maksimal.</p>
                <p><strong>Kunci Bobot: 5=d, 4=a, 3=b, 2=c, 1=e</strong></p>',
                'options' => [
                    ['text' => 'Kreativitas yang seolah tak pernah habis', 'weight' => 4],
                    ['text' => 'Cermat dalam mengatasi setiap deadline yang datang', 'weight' => 3],
                    ['text' => 'Ambisinya yang senantiasa mengebu', 'weight' => 2],
                    ['text' => 'Semangat dan apresiasi yang selalu tercurahkan maksimal', 'weight' => 5],
                    ['text' => 'Harapan dan ekspektasinya yang besar', 'weight' => 1],
                ]
            ],
            // Soal 109
            [
                'question_text' => 'Segala rintangan yang menghalangi saya untuk mencapai tujuan selalu bisa saya atasi. Hal tersebut karena...',
                'explanation' => '<p><strong>Pembahasan:</strong> Saya meminta bantuan orang lain.</p>
                <p><strong>Kunci Bobot: 5=b, 4=e, 3=a, 2=d, 1=c</strong></p>',
                'options' => [
                    ['text' => 'Saya tidak pernah putus asa', 'weight' => 3],
                    ['text' => 'Saya meminta bantuan orang lain', 'weight' => 5],
                    ['text' => 'Saya tidak berani mengambil risiko yang besar', 'weight' => 1],
                    ['text' => 'Saya menggunakan segala cara untuk mencapai tujuan', 'weight' => 2],
                    ['text' => 'Takdir', 'weight' => 4],
                ]
            ],
            // Soal 110
            [
                'question_text' => 'Saat diberikan pekerjaan yang berat yang membutuhkan kompetensi yang tinggi, saya akan...',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengerjakan semampunya meskipun butuh waktu yang lama.</p>
                <p><strong>Kunci Bobot: 5=b, 4=e, 3=c, 2=a, 1=d</strong></p>',
                'options' => [
                    ['text' => 'Menyuruh rekan lain untuk mengerjakannya', 'weight' => 2],
                    ['text' => 'Mengerjakan semampunya meskipun butuh waktu yang lama', 'weight' => 5],
                    ['text' => 'Meminta bantuan rekan untuk mengerjakannya', 'weight' => 3],
                    ['text' => 'Menolaknya', 'weight' => 1],
                    ['text' => 'Mencari cara agar bisa mengerjakan pekerjaan tersebut sebaik mungkin', 'weight' => 4],
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
                'updated_at' => now(),
            ]);

            $order = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => false,
                    'order' => $order,
                    'weight' => $optionData['weight'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order++;
            }
        }

        $this->command->info('Seeder TKP TO SKD Gratis 2 berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questions));
    }
}
