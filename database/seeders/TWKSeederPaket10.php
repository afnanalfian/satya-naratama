<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TWKSeederPaket10 extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Material dengan id = 54 (TWK Paket 10)
        $materialId = 40;

        $questions = [
            // Soal 1
            [
                'question_text' => 'Sebelum UUD NRI Tahun 1945 diamandemen, MPR merupakan lembaga tertinggi negara. Setelah UUD NRI Tahun 1945 diamandemen, MPR memiliki kedudukan sama dengan lembaga negara yang lainnya. Meskipun demikian, baik sebelum dan sesudah amendemen UUD NRI Tahun 1945, MPR memiliki kewenangan seperti lembaga konstituante yaitu...',
                'options' => [
                    ['text' => 'melantik presiden dan wakil presiden', 'is_correct' => false],
                    ['text' => 'membuat garis-garis besar haluan negara', 'is_correct' => false],
                    ['text' => 'mengubah dan menetapkan Undang-Undang Dasar', 'is_correct' => true],
                    ['text' => 'melakukan sosialisasi empat konsensus dasar nasional', 'is_correct' => false],
                    ['text' => 'melaksanakan kedaulatan rakyat berdasarkan Undang-Undang Dasar', 'is_correct' => false],
                ],
                'explanation' => 'MPR memiliki kewenangan mengubah dan menetapkan Undang-Undang Dasar, baik sebelum maupun sesudah amendemen. Ini adalah fungsi MPR sebagai lembaga konstituante.',
            ],
            // Soal 2
            [
                'question_text' => 'Perlakuan mengolok-olok bentuk fisik (body shaming) selain menyakiti hati seseorang, juga merupakan perilaku yang bertentangan dengan Pancasila, karena.....',
                'options' => [
                    ['text' => 'menghormati seseorang hanya dari penampilan fisiknya', 'is_correct' => false],
                    ['text' => 'menghina makhluk Tuhan yang memiliki kesempurnaan dalam penciptaan', 'is_correct' => true],
                    ['text' => 'merendahkan martabat satu orang sama dengan merendahkan semua orang di dunia', 'is_correct' => false],
                    ['text' => 'bertentangan dengan kepribadian bangsa Indonesia yang ramah tamah', 'is_correct' => false],
                    ['text' => 'merendahkan orang lain sama dengan merendahkan martabat dirinya sendiri', 'is_correct' => false],
                ],
                'explanation' => 'Body shaming bertentangan dengan sila pertama Pancasila karena menghina ciptaan Tuhan yang telah diciptakan dengan sempurna. Setiap manusia adalah makhluk Tuhan yang memiliki martabat dan kehormatan.',
            ],
            // Soal 3
            [
                'question_text' => 'Indonesia merupakan negara dengan jumlah penduduk terbanyak se-ASEAN yang mampu berperan di berbagai sektor, seperti politik, sosial, budaya, hingga ekonomi. Salah satu peranan Indonesia dalam bidang ekonomi di ASEAN adalah...',
                'options' => [
                    ['text' => 'mendirikan Industri Pupuk ASEAN di Aceh', 'is_correct' => true],
                    ['text' => 'menjadi jalur perdagangan India dan Australia', 'is_correct' => false],
                    ['text' => 'perbaikan infrastruktur di seluruh negara ASEAN', 'is_correct' => false],
                    ['text' => 'membentuk SEATO untuk pengembangan ekonomi merata', 'is_correct' => false],
                    ['text' => 'menyelenggarakan pertemuan bidang ekonomi untuk ASEAN', 'is_correct' => false],
                ],
                'explanation' => 'Indonesia berperan dalam mendirikan Industri Pupuk ASEAN (ASEAN Fertilizer Industry) yang berlokasi di Aceh sebagai bentuk kerja sama ekonomi di kawasan ASEAN.',
            ],
            // Soal 4
            [
                'question_text' => 'Banyaknya pendatang baru dari perkotaan membawa perubahan yang cukup signifikan terhadap kehidupan di pedesaan. Respons yang sesuai dengan konsep kebinekaan terhadap fenomena tersebut adalah...',
                'options' => [
                    ['text' => 'menanamkan kehati-hatian agar tidak terpengaruh', 'is_correct' => false],
                    ['text' => 'menerima pendatang baru sebagai bagian masyarakat', 'is_correct' => true],
                    ['text' => 'menolak kehadirannya dan menyuruhnya untuk kembali', 'is_correct' => false],
                    ['text' => 'memperlakukan secara biasa saja karena baru mengenal', 'is_correct' => false],
                    ['text' => 'menerima kehadirannya dengan menanamkan kontroversi', 'is_correct' => false],
                ],
                'explanation' => 'Sikap yang sesuai dengan konsep kebinekaan adalah menerima pendatang baru sebagai bagian dari masyarakat, karena kebinekaan mengajarkan kita untuk hidup berdampingan dengan perbedaan.',
            ],
            // Soal 5
            [
                'question_text' => 'Salah satu pergerakan untuk mencapai kemerdekaan diwarnai oleh lahirnya Sarekat Dagang Islam yang didirikan oleh Haji Samanhudi di Solo pada 1911. Gerakan ini berusaha membangun kekuatan serta persatuan bangsa melalui penguatan dalam bidang...',
                'options' => [
                    ['text' => 'ekonomi melalui perlindungan pengusaha lokal agar mampu bersaing dengan pengusaha nonlocal', 'is_correct' => true],
                    ['text' => 'kebudayaan melalui pengembangan kesenian-kesenian daerah agar mampu mengharumkan nama baik Indonesia', 'is_correct' => false],
                    ['text' => 'pendidikan melalui pengajaran serta menjadi pemantik persatuan dan kesatuan bangsa Indonesia', 'is_correct' => false],
                    ['text' => 'keagamaan yang memobilisasi gerakan rakyat dengan dasar keyakinan pada nilai-nilai Ketuhanan', 'is_correct' => false],
                    ['text' => 'politik melalui pengembangan kebijakan yang berpihak masyarakat lokal dibanding masyarakat nonlocal', 'is_correct' => false],
                ],
                'explanation' => 'Sarekat Dagang Islam (SDI) didirikan untuk melindungi pengusaha lokal (pribumi) agar mampu bersaing dengan pengusaha nonpribumi, terutama di bidang ekonomi.',
            ],
            // Soal 6
            [
                'question_text' => 'Penutupan tempat ibadah oleh masyarakat secara sepihak karena tidak memiliki izin untuk mendirikan tempat ibadah di lingkungan tersebut dapat menimbulkan konflik di masyarakat. Sikap yang harus diambil oleh seorang warga negara yang baik adalah...',
                'options' => [
                    ['text' => 'tidak peduli dengan kondisi yang terjadi', 'is_correct' => false],
                    ['text' => 'memediasi antara jamaah dengan warga sekitar untuk mendapat jalan keluar', 'is_correct' => true],
                    ['text' => 'mencarikan lokasi baru untuk berdirinya tempat ibadah', 'is_correct' => false],
                    ['text' => 'membantu untuk mengurus perizinan pembangunan tempat ibadah', 'is_correct' => false],
                    ['text' => 'ikut menolak berdirinya tempat ibadah tersebut', 'is_correct' => false],
                ],
                'explanation' => 'Sikap yang harus diambil sebagai warga negara yang baik adalah memediasi antara kedua belah pihak untuk mencari solusi terbaik, bukan memihak atau mengabaikan konflik.',
            ],
            // Soal 7
            [
                'question_text' => 'Salah satu hal yang tidak dapat dihindari ketika bekerja adalah keharusan bekerja dalam tim. Bekerja dalam tim harus dilandasi oleh beberapa nilai, di antaranya adalah nilai persatuan, saling menghormati, dan kejujuran. Berdasarkan ilustrasi di atas, tindakan anggota tim yang tidak dilandasi nilai kejujuran adalah...',
                'options' => [
                    ['text' => 'melaporkan kepada atasan mengenai tindakan rekan yang tidak jujur', 'is_correct' => false],
                    ['text' => 'mengirimkan hasil kerja yang merupakan hasil plagiarisme', 'is_correct' => true],
                    ['text' => 'berusaha menyadarkan rekan yang menggelapkan dana kantor', 'is_correct' => false],
                    ['text' => 'melakukan pekerjaan sebaik mungkin walaupun masih kurang baik', 'is_correct' => false],
                    ['text' => 'selalu berusaha dapat menjaga kekompakan anggota tim kerja', 'is_correct' => false],
                ],
                'explanation' => 'Plagiarisme (mengakui karya orang lain sebagai karya sendiri) adalah tindakan tidak jujur karena mencuri ide atau karya orang lain tanpa memberikan kredit yang semestinya.',
            ],
            // Soal 8
            [
                'question_text' => 'Sejarah Indonesia mencatat bahwa beberapa kali ideologi Pancasila dirongrong oleh ideologi komunis. Berikut ini alasan pentingnya upaya pelestarian Pancasila terkait ancaman dari komunisme, kecuali...',
                'options' => [
                    ['text' => 'komunisme menolak nasionalisme', 'is_correct' => false],
                    ['text' => 'komunisme mengakui adanya Tuhan', 'is_correct' => true],
                    ['text' => 'komunisme mengakui pertentangan kelas', 'is_correct' => false],
                    ['text' => 'komunisme mengajarkan agitasi dan propaganda', 'is_correct' => false],
                ],
                'explanation' => 'Komunisme tidak mengakui adanya Tuhan (ateis), sehingga pernyataan "komunisme mengakui adanya Tuhan" adalah salah. Ini menjadi alasan mengapa komunisme bertentangan dengan Pancasila sila pertama.',
            ],
            // Soal 9
            [
                'question_text' => 'Dalam perumusan dan penetapan UUD NRI Tahun 1945 dalam sidang BPUPK dan PPKI, ada yang menjabat sebagai Ketua Panitia Persiapan Kemerdekaan Indonesia, Ketua Panitia Perancangan Ekonomi, konseptor naskah teks proklamasi kemerdekaan, dan sebagainya. Dalam hal ini, nilai persatuan ditunjukkan dengan adanya kerja sama pendiri negara berdasarkan...',
                'options' => [
                    ['text' => 'profesinya masing-masing', 'is_correct' => false],
                    ['text' => 'penunjukan masing-masing', 'is_correct' => false],
                    ['text' => 'asalnya masing-masing', 'is_correct' => false],
                    ['text' => 'perannya masing-masing', 'is_correct' => true],
                    ['text' => 'kerelaan hati masing-masing', 'is_correct' => false],
                ],
                'explanation' => 'Nilai persatuan ditunjukkan dengan kerja sama para pendiri negara berdasarkan perannya masing-masing dalam mempersiapkan kemerdekaan Indonesia.',
            ],
            // Soal 10
            [
                'question_text' => 'Dalam pidato pada sidang BPUPKI, Supomo mengemukakan 3 (tiga) teori negara. Teori-teori tersebut dibahas sebagai dasar untuk menguatkan pendapatnya atas teori yang ia pilih untuk diterapkan di Indonesia. Adapun penolakannya terhadap dua teori lainnya adalah bahwa jika dipilih teori negara class, negara akan digunakan sebagai alat oleh golongan mayoritas. Sementara itu, jika dipilih teori perseorangan, susunan negara akan berdasarkan individualisme. Teori negara integralistik dipandang dapat menyatukan seluruh bangsa heterogen sehingga diharapkan dapat mempersatukan bangsa tanpa membedakan golongan. Berdasarkan uraian di atas sudah seharusnya bangsa Indonesia memiliki sikap...',
                'options' => [
                    ['text' => 'tidak membeda-bedakan golongan', 'is_correct' => true],
                    ['text' => 'tidak menyukai golongan minoritas', 'is_correct' => false],
                    ['text' => 'berpihak kepada golongan mayoritas', 'is_correct' => false],
                    ['text' => 'berpihak pada yang menguntungkan', 'is_correct' => false],
                    ['text' => 'fleksibel dan luwes untuk dapat maju', 'is_correct' => false],
                ],
                'explanation' => 'Teori integralistik menekankan persatuan tanpa membedakan golongan. Oleh karena itu, bangsa Indonesia sudah seharusnya memiliki sikap tidak membeda-bedakan golongan dalam kehidupan bermasyarakat dan bernegara.',
            ],
            // Soal 11
            [
                'question_text' => 'Setelah mundur dari jabatannya sebagai wakil presiden, Drs. Moh. Hatta mendapatkan banyak tawaran untuk menempati berbagai jabatan dari tingkat nasional sampai tingkat internasional. Namun, Hatta menolak semuanya dan memilih untuk hidup dari uang pensiun. Mengapa perilaku tersebut mencerminkan integritas terhadap bangsa Indonesia?',
                'options' => [
                    ['text' => 'Perilaku tersebut mencerminkan pribadi yang oportunis', 'is_correct' => false],
                    ['text' => 'Perilaku tersebut mencerminkan sosok yang tidak mengejar jabatan dan harta', 'is_correct' => true],
                    ['text' => 'Perilaku tersebut mencerminkan pribadi yang menghindari kemajuan nasional', 'is_correct' => false],
                    ['text' => 'Perilaku tersebut mencerminkan sosok yang progresif dan rendah hati', 'is_correct' => false],
                    ['text' => 'Perilaku tersebut mencerminkan pribadi yang dekat dengan orang banyak', 'is_correct' => false],
                ],
                'explanation' => 'Perilaku Hatta mencerminkan integritas karena beliau adalah sosok yang tidak mengejar jabatan dan harta, lebih memilih hidup sederhana dengan uang pensiun.',
            ],
            // Soal 12
            [
                'question_text' => 'Semakin tersedianya infrastruktur dan pelayanan di bidang informasi dan telekomunikasi di Indonesia, masyarakat semakin mudah menggunakan internet. Salah satu akses dari kemudahan berkomunikasi menggunakan internet adalah terjadinya pertukaran informasi melalui media sosial yang tidak akurat dan tidak dapat dipertanggungjawabkan (berita palsu/hoax). Hoax yang sering kali disebarkan adalah berita mengenai SARA yang dapat mengancam integrasi bangsa kita. Untuk dapat mengatasi permasalahan berita palsu tersebut, Kemenkominfo dan juga beberapa media massa menyediakan layanan atau konten untuk cek fakta dari berita-berita yang beredar. Hal itu menunjukkan bahwa sesungguhnya bangsa kita memiliki keinginan yang kuat untuk menjaga persatuan. Berdasarkan ilustrasi di atas, hal yang paling penting dilakukan oleh bangsa kita dalam menjaga persatuan bangsa terhadap potensi konflik SARA adalah...',
                'options' => [
                    ['text' => 'tidak menyebarkan hoax mengenai agama yang berpotensi memecah belah bangsa', 'is_correct' => false],
                    ['text' => 'harus cerdas agar dapat menuliskan informasi mengenai hal-hal yang sensitif', 'is_correct' => false],
                    ['text' => 'menjadi bangsa yang melek teknologi agar dapat aktif menulis di media sosial', 'is_correct' => false],
                    ['text' => 'selalu aktif dalam mencari tahu dan menangkal berita hoax kepada teman-teman', 'is_correct' => true],
                    ['text' => 'selalu menulis informasi yang dapat menjadi sensasi sehingga dapat viral', 'is_correct' => false],
                ],
                'explanation' => 'Hal terpenting adalah selalu aktif mencari tahu kebenaran informasi dan menangkal berita hoax, serta mengedukasi teman-teman agar tidak mudah terpengaruh oleh berita palsu.',
            ],
            // Soal 13
            [
                'question_text' => 'Peran Bung Tomo pada masa pergerakan kemerdekaan dalam perspektif bela negara sangat besar bagi bangsa Indonesia, yakni...',
                'options' => [
                    ['text' => 'melakukan perang gerilya pada Agresi Militer di Jawa Timur', 'is_correct' => false],
                    ['text' => 'berjuang melawan Belanda bersama Tentara Nasional Indonesia', 'is_correct' => false],
                    ['text' => 'mengamankan kota Surabaya pada saat Proklamasi Kemerdekaan RI', 'is_correct' => false],
                    ['text' => 'menggerakkan pasukan gerilya bersama Panglima Jenderal Sudirman', 'is_correct' => false],
                    ['text' => 'menyiarkan pidato yang membakar semangat perjuangan arek-arek Surabaya', 'is_correct' => true],
                ],
                'explanation' => 'Peran Bung Tomo yang paling terkenal adalah melalui pidato-pidatonya yang membakar semangat juang rakyat Surabaya dalam melawan sekutu, terutama melalui siaran radio.',
            ],
            // Soal 14
            [
                'question_text' => 'Permasalahan bangsa Indonesia saat ini salah satunya adalah akibat menurunnya moralitas warga negara yang ditunjukkan dengan adanya berbagai perilaku yang bertentangan dengan nilai-nilai Pancasila. Buktikan upaya untuk mengatasi tantangan bangsa di bidang ideologi...',
                'options' => [
                    ['text' => 'Memberikan hak secara bebas kepada semua orang untuk menafsirkan Pancasila', 'is_correct' => false],
                    ['text' => 'Menangkap tokoh yang mengkritisi penerapan Pancasila dalam pemerintahan', 'is_correct' => false],
                    ['text' => 'Bertindak represif terhadap pihak yang dianggap menentang Pancasila', 'is_correct' => false],
                    ['text' => 'Mengandalkan berbagai kegiatan sosialisasi Pancasila dalam masyarakat', 'is_correct' => true],
                    ['text' => 'Menambah jam mata pelajaran Pendidikan Pancasila di sekolah', 'is_correct' => false],
                ],
                'explanation' => 'Upaya mengatasi tantangan di bidang ideologi dapat dilakukan dengan mengandalkan berbagai kegiatan sosialisasi Pancasila di masyarakat agar nilai-nilai Pancasila dapat dipahami dan diamalkan.',
            ],
            // Soal 15
            [
                'question_text' => 'Untuk melindungi produk usaha kecil dan menengah dari dampak negatif banjirnya produk-produk luar negeri, bisa dilakukan oleh setiap warga negara dengan cara meningkatkan....',
                'options' => [
                    ['text' => 'kesadaran berbangsa dan bernegara', 'is_correct' => false],
                    ['text' => 'kesadaran untuk menggunakan produk bangsa sendiri', 'is_correct' => true],
                    ['text' => 'kesadaran untuk menjaga tetap tegaknya NKRI', 'is_correct' => false],
                    ['text' => 'kesadaran mempertahankan identitas dan integritas bangsa', 'is_correct' => false],
                ],
                'explanation' => 'Meningkatkan kesadaran untuk menggunakan produk bangsa sendiri (cinta produk dalam negeri) adalah cara efektif melindungi UMKM dari gempuran produk luar negeri.',
            ],
            // Soal 16
            [
                'question_text' => 'Pengaruh sistem ekonomi kapitalis menjadi tantangan bagi bangsa Indonesia, merugikan rakyat dan mengurangi sektor pemasukan negara. Tunjukkan bukti manakah upaya bela negara untuk mempertahankan Bhinneka Tunggal Ika?',
                'options' => [
                    ['text' => 'Melarang masuknya investasi asing melakukan kegiatan usaha di Indonesia', 'is_correct' => false],
                    ['text' => 'Negara mengelola cabang-cabang produksi penting untuk kemakmuran rakyat', 'is_correct' => true],
                    ['text' => 'Melakukan bagi hasil antara pihak pengelola dengan pengusaha yang dipercaya', 'is_correct' => false],
                    ['text' => 'Bekerja sama dengan investor asing yang memiliki kedekatan dengan pemerintah', 'is_correct' => false],
                    ['text' => 'Menunjuk beberapa pengusaha Indonesia mengelola sumber daya alam vital negara', 'is_correct' => false],
                ],
                'explanation' => 'Upaya bela negara dalam bidang ekonomi adalah negara mengelola cabang-cabang produksi penting untuk kemakmuran rakyat, sesuai dengan Pasal 33 UUD 1945.',
            ],
            // Soal 17
            [
                'question_text' => 'Presiden dan wakil presiden yang memegang jabatan selama lima tahun, dan sesudahnya dapat dipilih kembali dalam jabatan yang sama, hanya untuk satu kali masa jabatan. Manakah dari pilihan di bawah ini yang menunjukkan bukti praktik ketatanegaraan tersebut merupakan penerapan paham konstitusionalisme dalam Negara Kesatuan Republik Indonesia?',
                'options' => [
                    ['text' => 'Menerapkan prinsip kedaulatan rakyat melalui pemilu secara tidak langsung', 'is_correct' => false],
                    ['text' => 'Menyelenggarakan pemerintahan yang bebas tanpa ada tekanan dari mana pun', 'is_correct' => false],
                    ['text' => 'Membatasi kekuasaan para penyelenggara negara supaya tidak sewenang-wenang', 'is_correct' => true],
                    ['text' => 'Memberikan kesempatan pihak oposisi mengevaluasi kinerja presiden setiap 5 tahun', 'is_correct' => false],
                    ['text' => 'Memberi kewenangan kepada presiden dan wakil presiden bebas untuk memimpin', 'is_correct' => false],
                ],
                'explanation' => 'Pembatasan masa jabatan presiden maksimal dua periode adalah bentuk pembatasan kekuasaan agar tidak terjadi kesewenang-wenangan, yang merupakan inti dari konstitusionalisme.',
            ],
            // Soal 18
            [
                'question_text' => 'Ideologi Pancasila mengandung nilai-nilai yang berasal dari jati diri bangsa Indonesia. Manakah dari pilihan di bawah ini yang merupakan aktualisasi nilai dalam Sila Pertama Pancasila dalam kehidupan bermasyarakat, berbangsa, dan bernegara?',
                'options' => [
                    ['text' => 'Melawan dengan tegas setiap larangan pendirian tempat ibadah', 'is_correct' => false],
                    ['text' => 'Saling menghormati pelaksanaan perayaan hari besar keagamaan', 'is_correct' => true],
                    ['text' => 'Menghormati kebebasan orang lain untuk tidak menjalankan ibadah', 'is_correct' => false],
                    ['text' => 'Menjaga keharmonisan hidup dengan anggota masyarakat yang seagama', 'is_correct' => false],
                    ['text' => 'Memahami aturan agamanya karena paling benar dan sesuai untuk diterapkan', 'is_correct' => false],
                ],
                'explanation' => 'Sila pertama Pancasila (Ketuhanan Yang Maha Esa) diaktualisasikan dengan sikap saling menghormati antarumat beragama, termasuk dalam pelaksanaan hari besar keagamaan masing-masing.',
            ],
            // Soal 19
            [
                'question_text' => 'Salah satu nilai Pancasila adalah keadilan yang praktik pengamalannya sudah dilakukan oleh masyarakat sejak zaman dahulu. Salah satu bukti yang dapat ditelusuri terkait pengamalan nilai tersebut adalah...',
                'options' => [
                    ['text' => 'terdapat dokumen silsilah masyarakat adat', 'is_correct' => false],
                    ['text' => 'tradisi memilih pemimpin berdasarkan keturunan', 'is_correct' => false],
                    ['text' => 'tradisi praktik pendidikan bagi semua golongan masyarakat', 'is_correct' => false],
                    ['text' => 'kerja sama warga masyarakat dalam bentuk perdagangan', 'is_correct' => true],
                    ['text' => 'banyaknya peninggalan benda pusaka dari leluhur masyarakat', 'is_correct' => false],
                ],
                'explanation' => 'Kerja sama dalam bentuk perdagangan mencerminkan nilai keadilan karena setiap pihak mendapat hak dan kewajiban yang seimbang, serta saling menguntungkan.',
            ],
            // Soal 20
            [
                'question_text' => 'Seorang bupati rajin melakukan kunjungan ke daerah di wilayah kerjanya. Tindakan bupati tersebut merupakan penerapan nilai-nilai Pancasila dalam kehidupan bernegara jika....',
                'options' => [
                    ['text' => 'dilakukan untuk menyapa rakyat pemilihnya', 'is_correct' => false],
                    ['text' => 'dalam rangka menjaga reputasinya', 'is_correct' => false],
                    ['text' => 'dilakukan untuk konsolidasi politik', 'is_correct' => false],
                    ['text' => 'untuk menyerap aspirasi rakyat', 'is_correct' => true],
                    ['text' => 'untuk merangkul tokoh-tokoh masyarakat', 'is_correct' => false],
                ],
                'explanation' => 'Kunjungan bupati ke daerah merupakan penerapan nilai Pancasila jika bertujuan untuk menyerap aspirasi rakyat, sesuai dengan sila keempat (kerakyatan yang dipimpin oleh hikmat kebijaksanaan).',
            ],
            // Soal 21
            [
                'question_text' => 'Kewenangan untuk membahas rancangan undang-undang berada di tangan DPR sebagai pemegang kekuasaan pembentuk undang-undang, sehingga jika tahapan pembahasan rancangan undang-undang ini tidak dilakukan oleh DPR...',
                'options' => [
                    ['text' => 'presiden dapat langsung mengundangkan dan mengesahkan rancangan undang-undang', 'is_correct' => false],
                    ['text' => 'presiden tidak dapat mengesahkan rancangan undang-undang menjadi undang-undang', 'is_correct' => false],
                    ['text' => 'rancangan undang-undang dapat diundangkan dan disahkan sebagai undang-undang', 'is_correct' => false],
                    ['text' => 'DPR dan presiden dapat langsung menyetujui rancangan undang-undang untuk disahkan', 'is_correct' => false],
                    ['text' => 'rancangan undang-undang tidak dapat diundangkan dan disahkan sebagai undang-undang', 'is_correct' => true],
                ],
                'explanation' => 'Karena DPR memegang kekuasaan pembentuk undang-undang, jika pembahasan RUU tidak dilakukan oleh DPR, maka RUU tersebut tidak dapat diundangkan dan disahkan menjadi undang-undang.',
            ],
            // Soal 22
            [
                'question_text' => 'Dalam Pasal 34 ayat (3) dinyatakan "Negara bertanggung jawab atas penyediaan fasilitas pelayanan kesehatan dan fasilitas pelayanan umum yang layak." Pentingnya hal tersebut diatur dalam UUD NRI Tahun 1945 adalah....',
                'options' => [
                    ['text' => 'menyadari bahwa kesehatan merupakan salah satu kebutuhan dasar (basic need) warga negara', 'is_correct' => true],
                    ['text' => 'menyadari bahwa pentingnya kesehatan jiwa bagi warga negara dalam melaksanakan perannya', 'is_correct' => false],
                    ['text' => 'mendukung keberhasilan pembangunan nasional', 'is_correct' => false],
                    ['text' => 'mempersiapkan warga negara sehat dan partisipatif', 'is_correct' => false],
                    ['text' => 'membangun karakter warga negara yang kuat dan produktif', 'is_correct' => false],
                ],
                'explanation' => 'Kesehatan adalah kebutuhan dasar (basic need) setiap warga negara. Oleh karena itu, negara bertanggung jawab menyediakan fasilitas pelayanan kesehatan yang layak.',
            ],
            // Soal 23
            [
                'question_text' => 'Berdasarkan amendemen UUD Negara RI Tahun 1945 Pasal 3, Majelis Permusyawaratan Rakyat (MPR) sebagai lembaga tinggi negara memiliki kewenangan untuk....',
                'options' => [
                    ['text' => 'mengangkat presiden dan/atau wakil presiden', 'is_correct' => false],
                    ['text' => 'mengubah dan menetapkan UUD Negara RI Tahun 1945', 'is_correct' => true],
                    ['text' => 'memilih presiden dan/atau wakil presiden', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 3 UUD 1945 menyatakan bahwa MPR berwenang mengubah dan menetapkan Undang-Undang Dasar.',
            ],
            // Soal 24
            [
                'question_text' => 'Bangsa Indonesia adalah bangsa yang majemuk. Perlu usaha yang sistematis agar dapat menjaga persatuan Indonesia. Salah satu bukti bahwa keberagaman bangsa Indonesia dapat memperkukuh persatuan NKRI adalah adanya....',
                'options' => [
                    ['text' => 'UUD NRI 1945 sebagai konstitusi negara', 'is_correct' => false],
                    ['text' => 'Pancasila sebagai dasar negara', 'is_correct' => false],
                    ['text' => 'sikap gotong royong yang terbina', 'is_correct' => false],
                    ['text' => 'simbol-simbol negara yang mempersatukan', 'is_correct' => false],
                    ['text' => 'bentuk negara kesatuan Republik Indonesia', 'is_correct' => true],
                ],
                'explanation' => 'Bentuk Negara Kesatuan Republik Indonesia (NKRI) adalah bukti bahwa keberagaman dapat memperkukuh persatuan, karena semua perbedaan disatukan dalam satu kesatuan negara.',
            ],
            // Soal 25
            [
                'question_text' => 'Cermati kalimat berikut!<br><br>"Produksi sejumlah komoditas perkebunan Indonesia, seperti kelapa sawit, kakao, kopi, dan kelapa, dinilai belum maksimal dan masih jauh di bawah potensi sebenarnya."<br><br>Perbaikan ejaan yang salah dalam kalimat tersebut adalah...',
                'options' => [
                    ['text' => 'komoditas seharusnya komoditi', 'is_correct' => false],
                    ['text' => 'tanda koma (,) setelah kata Indonesia dihilangkan', 'is_correct' => false],
                    ['text' => 'dinilai seharusnya dinilai', 'is_correct' => true],
                    ['text' => 'maksimal seharusnya maximal', 'is_correct' => false],
                    ['text' => 'di bawah seharusnya dibawah', 'is_correct' => false],
                ],
                'explanation' => 'Kata "dinilai" seharusnya ditulis serangkai menjadi "dinilai" karena merupakan kata kerja berimbuhan di- + nilai.',
            ],
            // Soal 26
            [
                'question_text' => 'Cermati kalimat berikut!<br><br>"Industri perikanan melibatkan banyak orang dan memiliki mata rantai hulu-hilir yang panjang, mulai produksi perikanan tangkap dan perikanan budi daya, distribusi, olahan, pengemasan, pengiriman, hingga logistik."<br><br>Perbaikan kata bentukan yang salah pada kalimat tersebut adalah...',
                'options' => [
                    ['text' => 'distribusi seharusnya pendistribusi', 'is_correct' => false],
                    ['text' => 'olahan seharusnya pengolahan', 'is_correct' => true],
                    ['text' => 'pengemasan seharusnya kemasan', 'is_correct' => false],
                    ['text' => 'pengiriman seharusnya kiriman', 'is_correct' => false],
                    ['text' => 'logistik seharusnya kelogistikan', 'is_correct' => false],
                ],
                'explanation' => 'Kata "olahan" seharusnya "pengolahan" karena yang dimaksud adalah proses mengolah, bukan hasil olahan.',
            ],
            // Soal 27
            [
                'question_text' => 'Cermati kutipan cerpen berikut!<br><br>"Di dekat sungai orang-orang proyek sudah berkumpul. Sebagian berpencar mengukur luas tanah. Lima alat berat buldozer dan bego, bergerak meratakan dan membuang permukaan tanah dari bebatuan. Satu bego mengeruk tanah, lalu mengeruk tepian sungai. Berisik suara kelima mesin alat berat itu, seperti hendak merobek-robek telinga. Tidak jauh dari hadapan, sudah dipatok plang bertuliskan "PEMBANGUNAN HOTEL". Terbelalak mata menyaksikan alat-alat berat merendam sungai dengan tanah dan bebatuan besar. Sebagian kebun cengkih telah rata; pohon-pohon cengkih digergaji dan ditumbangkan. Kalang-kabut. Sepasang mata merah menyala-nyala. Lelaki kampung yang menggantungkan rasa lapar pada sungai dan perkebunan cengkih geram. Berlari ke hadapan buldozer yang bergerak. Nyaris ditabrak jika seorang mandor tidak berteriak lewat handy talky dalam genggamannya. "Setop! Setop! Setop!" "Hei, kau. Minggir dari situ! Minggir sana! Pergi!" Orang-orang terdiam. Semua buldozer dan bego terhenti. Tidak ada ruangan mesin. Mati. Seorang mandor bukan main kesal. Sumpah-serapah. Naik pitam."<br><br>Nilai sosial dalam kutipan cerpen tersebut adalah...',
                'options' => [
                    ['text' => 'kepedulian warga masyarakat terhadap pelaksanaan pembangunan', 'is_correct' => false],
                    ['text' => 'manfaat pembangunan bagi kehidupan sosial masyarakat', 'is_correct' => false],
                    ['text' => 'pembangunan dapat berdampak pada kehidupan sosial', 'is_correct' => false],
                    ['text' => 'pentingnya keberanian untuk menyampaikan pendapat', 'is_correct' => true],
                    ['text' => 'pembangunan untuk kepentingan kehidupan masyarakat', 'is_correct' => false],
                ],
                'explanation' => 'Kutipan tersebut menunjukkan pentingnya keberanian untuk menyampaikan pendapat, seperti yang dilakukan lelaki kampung yang berani melawan pembangunan yang merusak sumber penghidupannya.',
            ],
            // Soal 28
            [
                'question_text' => 'Cermati paragraf berikut!<br><br>(1) Kota Jakarta memenangi penghargaan yang diberikan oleh Sustainable Transportation Award Committee.<br>(2) Komite ini terdiri dari berbagai lembaga-lembaga global yang mengkaji perkembangan jaringan angkutan umum terintegrasi dan ramah lingkungan.<br>(3) Penghargaan ini menilai gagasan inovatif pengembangan sarana transportasi, bukan berdasarkan infrastruktur fisik dan layanan publik yang telah dibangun.<br>(4) Dari aspek ini, Jakarta dinilai memiliki ambisi tinggi dengan target yang terukur dan perencanaan yang sistematis.<br>(5) Jakarta mampu mengalahkan kota-kota besar dunia, seperti Frankfurt, San Francisco, dan Auckland.<br><br>Perbaikan kalimat (2) agar menjadi kalimat efektif adalah...',
                'options' => [
                    ['text' => 'Komite ini terdiri atas berbagai lembaga global yang mengkaji perkembangan jaringan angkutan umum terintegrasi dan ramah lingkungan', 'is_correct' => true],
                    ['text' => 'Komite ini terdiri atas berbagai-bagai lembaga global yang mengkaji, perkembangan jaringan angkutan umum terintegrasi dan ramah lingkungan', 'is_correct' => false],
                    ['text' => 'Komite daripada lembaga-lembaga global yang mengkaji perkembangan jaringan angkutan umum terintegrasi dan ramah lingkungan', 'is_correct' => false],
                    ['text' => 'Komite ini dari berbagai lembaga-lembaga global yang mengkaji perkembangan jaringan angkutan umum terintegrasi dan ramah lingkungan', 'is_correct' => false],
                    ['text' => 'Komite terdiri atas berbagai lembaga-lembaga global yang mengkaji perkembangan jaringan angkutan umum terintegrasi dan ramah lingkungan', 'is_correct' => false],
                ],
                'explanation' => 'Kalimat efektif menggunakan kata "terdiri atas" (bukan "terdiri dari") dan menghilangkan pengulangan kata "lembaga-lembaga" menjadi "lembaga" saja.',
            ],
            // Soal 29
            [
                'question_text' => 'Cermati paragraf berikut!<br><br>"Film layar lebar (bioskop) ternyata mendapat saingan hebat dari perkembangan televisi, khususnya tayangan sinetron yang mendominasi prime time (pukul 18.00--22.00) dan tayang ulangnya mendominasi dari pagi sampai malam. Betapa banyaknya sinetron yang menjadi andalan stasiun televisi untuk menjaring iklan dan digemari. Media elektronik sudah memasuki era industri dan yang namanya industri harus mempertimbangkan untung rugi. Rating menjadi dewa dalam menentukan tayangan. Jika penonton senang suara yang keras membentak, maki-maki, ratapan, dialog dalam bahasa yang semau gue, pasti tema cerita akan mengarah pada yang disenangi pemirsa/penonton. Sementara itu, perkembangan stasiun televisi di tanah air pesat sekali. Konon Indonesia dikenal sebagai negeri "maju" sebab punya banyak stasiun televisi di ibu kotanya yang dapat ditangkap siarannya di provinsi lain dan bahkan ada yang tayang selama 24 jam. Belum lagi adanya jaringan televisi kabel yang diprediksi dalam waktu kurang sepuluh tahun bisa langsung ke pelosok desa."<br><br>Ide pokok paragraf tersebut adalah...',
                'options' => [
                    ['text' => 'persaingan sinetron dan film layar lebar', 'is_correct' => true],
                    ['text' => 'dominasi sinetron pada tayangan prime time di televisi', 'is_correct' => false],
                    ['text' => 'persaingan stasiun televisi di Indonesia', 'is_correct' => false],
                    ['text' => 'televisi sebagai pesaing film layar lebar', 'is_correct' => false],
                    ['text' => 'perkembangan televisi di tanah air', 'is_correct' => false],
                ],
                'explanation' => 'Ide pokok paragraf adalah persaingan antara sinetron (televisi) dengan film layar lebar (bioskop), di mana sinetron menjadi pesaing berat film bioskop.',
            ],
            // Soal 30
            [
                'question_text' => 'Cermati dua paragraf berikut!<br><br>"Indonesia merupakan salah satu negara yang meratifikasi konvensi International Centre for Settlement of International Disputes (ICSID) tahun 1958 melalui Undang-Undang Nomor 5 tahun 1968. Hal itu menandakan bahwa Indonesia telah mengikatkan diri dengan mekanisme ISDS sesuai dengan tujuan dibentuknya ICSID. Suatu perusahaan multinasional dapat menggugat negara tujuan investasi dengan syarat kedua negara sepakat untuk memasukkan mekanisme ISDS dalam bab penyelesaian sengketa pada perjanjian investasi bilateralnya.<br><br>Indonesia memiliki beberapa perjanjian investasi bilateral yang di dalamnya memasukkan mekanisme ISDS dalam bab penyelesaian sengketa. Sebagai contoh, perjanjian investasi bilateral yang mencantumkan mekanisme ISDS adalah Bilateral Investment Treaty (BIT) antara Indonesia dengan Singapura yang ditandatangani pada 11 Oktober 2018. Perjanjian RCEP merupakan perjanjian terbaru yang telah ditandatangani oleh Indonesia dan di dalamnya tidak mengatur mekanisme ISDS. Indonesia for Global Justice (IGJ) menilai bahwa peniadaan mekanisme ISDS dalam perjanjian RCEP merupakan hal yang tepat. Memasukkan mekanisme ISDS dalam bab penyelesaian sengketa dianggap merugikan kepentingan nasional."<br><br>Simpulan dua paragraf tersebut adalah...',
                'options' => [
                    ['text' => 'Ratifikasi ICSID menyebabkan Indonesia secara langsung terikat oleh ISDS', 'is_correct' => false],
                    ['text' => 'Indonesia terikat oleh ISDS dalam ICSID, tetapi tidak terikat oleh ISDS dalam RCEP', 'is_correct' => true],
                    ['text' => 'ISDS menguntungkan perusahaan multinasional, tetapi merugikan kepentingan nasional', 'is_correct' => false],
                    ['text' => 'Indonesia memiliki beberapa perjanjian investasi bilateral yang memasukkan mekanisme ISDS', 'is_correct' => false],
                    ['text' => 'RCEP tanpa ISDS menguntungkan Indonesia dan negara lain yang menandatangani RCEP', 'is_correct' => false],
                ],
                'explanation' => 'Simpulan yang tepat adalah Indonesia terikat oleh mekanisme ISDS dalam ICSID (karena telah meratifikasi), tetapi tidak terikat oleh ISDS dalam perjanjian RCEP (karena RCEP tidak mengatur mekanisme ISDS).',
            ],
        ];

        // Insert all questions
        foreach ($questions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => $question['question_text'],
                'explanation' => $question['explanation'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($question['options'] as $order => $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'],
                    'order' => $order + 1,
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TWK Paket 10 (30 soal) berhasil dijalankan!');
        $this->command->info('Material ID: ' . $materialId);
        $this->command->info('Total soal: ' . count($questions));
    }
}
