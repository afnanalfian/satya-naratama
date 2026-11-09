# Apa yang berubah

## Kompatibilitas data (tidak berubah)

- **73 migrasi sama persis namanya**; tidak ada migrasi baru. `migrate` pada database lama → *Nothing to migrate*.
  (Tiga migrasi `MODIFY ENUM` diberi cabang khusus SQLite agar bisa diuji lokal; di MySQL perilakunya identik.)
- Model, observer, event/listener, notifikasi, mail, perintah terjadwal, kebijakan akses, & layanan lama dipakai ulang.
- Path unggahan tetap: `avatars/`, `avatars/pendaftaran/`, `courses/`, `meeting-materials/`, `questions/`, `question-options/`, `payments/proofs/`, `payment_proofs/`, `payment/qris/`, `promo-banners/`, `bank/category/`.
- Semua **nama route & URL lama dipertahankan** (link di email & notifikasi lama tetap jalan).
- Format jawaban ujian (`exam_answers.selected_options`) dan penilaian (`ExamScoringService`) tidak diubah.

## Arsitektur

- Halaman interaktif kini **komponen Livewire full-page**: login, daftar, lupa/atur ulang password, pendaftaran bimbel, pembayaran pendaftaran, cek status, dashboard admin, profil, siswa, tentor, kelas, tryout/kuis, penyusun soal, bank soal, toko, keranjang, checkout, pembayaran, pesanan saya, pesanan admin, produk, harga, diskon, pengaturan pembayaran, hak akses, promo, pendaftaran, link orang tua, notifikasi, jadwal.
- Halaman laporan/berat data tetap controller Blade (dengan tampilan baru), endpoint JSON (simpan jawaban, sinkron waktu, scan QR) tetap controller.
- Logika keranjang dipindah ke `App\Services\CartService`, verifikasi pesanan ke `App\Services\OrderVerificationService` — controller lama memanggil layanan yang sama.
- Tanpa SweetAlert, Tom Select, Uppy, jQuery (kecuali editor rumus admin): dialog konfirmasi, toast, & unggahan memakai Alpine/Livewire.
- MathJax diganti **KaTeX lokal** (`public/vendor/katex`) — lebih cepat & tanpa CDN untuk siswa. Delimiter `\( \)`, `\[ \]`, `$ $`, `$$ $$` tetap didukung.

## Tampilan

- Tema **Garnet & Saffron**: ungu gelap (ink) untuk sidebar/hero, garnet untuk aksi, saffron untuk sorotan, lagoon untuk status sukses, latar cream hangat. Font Plus Jakarta Sans + Bricolage Grotesque.
- Semua halaman responsif (sidebar laci di HP, tabel bisa digeser, navigasi soal ujian sebagai panel geser).
- Email & PDF (invoice, laporan) diselaraskan dengan warna baru.

## Fitur tambahan kecil

- Sesi tidak habis sampai logout (lihat README).
- Mesin ujian: cadangan jawaban offline (`localStorage`) + sinkron ulang otomatis, peringatan saat keluar halaman bila ada jawaban belum terkirim, layar penuh, ukuran huruf.
- Admin bisa **memberi/mencabut hak akses** manual di *Hak Akses Siswa*.
- Pesanan: verifikasi cepat lewat modal (lihat bukti → setujui/tolak) tanpa pindah halaman.
- **Ekspor CSV pendaftaran** (sebelumnya "sedang dikembangkan").
- Kontak WA, rekening, & biaya pendaftaran bisa diubah lewat `.env` (`config/satya.php`).

## Bug lama yang diperbaiki

| Masalah | Perbaikan |
|---|---|
| Menambah pertemuan satuan ke keranjang **menghapus pertemuan lain dari kelas yang sama** | Sekarang beberapa pertemuan bisa dibeli sekaligus (harga per unit mengikuti jumlah); yang diblok hanya pertemuan yang paketnya sudah ada di keranjang |
| Kirim ulang email verifikasi selalu "harap tunggu" (selisih waktu bernilai negatif di Carbon 3) | Memakai nilai absolut |
| Sisa waktu ujian bisa lebih besar dari durasi pada accessor `remaining_seconds` | Dihitung dengan nilai absolut |
| Menolak pendaftaran error karena `notify_user()` dipanggil pada model pendaftaran | Pemberitahuan cukup lewat email penolakan |
| `/admin/registrations/export` tertangkap route `/{id}` | Urutan route diperbaiki |
| Halaman hak akses siswa bisa dibuka non-admin | Dibatasi `role:admin` |
| `/exams`, `/exams/create`, `/tutorial`, `/promo-banners/{id}` error | Diarahkan/diimplementasikan |
| Dashboard tentor error bila akun tentor belum punya data `teachers` & memakai kolom lama `is_present` | Aman null & memakai `status = hadir` |
| Route uji publik `/test-notif-admin` | Dihapus |
| Siswa umum (tanpa data pendaftaran) tidak bisa diubah admin | Form hanya memvalidasi data akun bila tidak ada data pendaftaran |
| Soal yang sedang dipakai ujian bisa terhapus dari daftar soal | Dicegah; lepaskan dulu dari ujian |
