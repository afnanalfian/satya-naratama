# Satya Naratama — TALL Stack

Aplikasi bimbel persiapan **sekolah kedinasan & TNI–POLRI** (Pangkep), dibangun ulang dengan **TALL Stack**: Tailwind CSS 3 · Alpine.js · Laravel 11 · Livewire 3, memakai tema baru **"Garnet & Saffron"** (merah garnet + emas kunyit, diambil dari logo elang).

**Data lama tetap dipakai.** Skema database, nama migrasi, `APP_KEY`, dan path file unggahan tidak berubah, sehingga versi ini bisa langsung menggantikan aplikasi lama di server memakai database yang sama.

## Dokumentasi

| Dokumen | Isi |
|---|---|
| [`docs/GANTI-PROYEK-VPS.md`](docs/GANTI-PROYEK-VPS.md) | **Mengganti proyek lama di VPS**: backup, deploy ke folder baru, tukar folder, cek, rollback, Nginx 1.24, upload besar |
| [`docs/INSTALL-LOKAL.md`](docs/INSTALL-LOKAL.md) | Menjalankan di komputer sendiri + data contoh |
| [`docs/PERUBAHAN.md`](docs/PERUBAHAN.md) | Daftar modul, apa yang berubah, perbaikan bug, catatan kompatibilitas |
| `deploy.sh` | Script update aplikasi di server |

## Modul

- **Publik**: landing page baru, tutorial, pendaftaran bimbel 4 langkah (+ unggah bukti transfer), cek status pendaftaran, rapor publik untuk orang tua (`/pantau/{token}`).
- **Akun**: masuk (selalu "ingat saya"), daftar akun umum, lupa/atur ulang password, verifikasi email, profil, ganti password, nonaktifkan akun.
- **Dashboard**: admin (statistik, grafik penjualan per minggu, pesanan menunggu, jadwal), tentor, siswa.
- **Pengguna**: siswa (cari, filter, aktif/nonaktif, detail, ubah data), tentor (angkat dari siswa, kelas yang diampu), pendaftaran (verifikasi → akun otomatis, tolak, ekspor CSV), hak akses siswa (lihat, beri & cabut manual).
- **Akademik**: kelas (akademik/jasmani), pertemuan (mulai/selesai, Zoom), materi PDF, video YouTube/Bunny, blind test & post-test, jadwal kalender.
- **Presensi & monitoring**: scanner QR (kamera/scanner USB), presensi manual & massal, rekap + grafik + matriks + ekspor CSV, kartu QR cetak, QR siswa, evaluasi jasmani bulanan (input grid, perbandingan, CSV), data fisik bulanan (IMT, keluhan kesehatan), rapor siswa & link orang tua.
- **Ujian**: tryout & kuis (SKD, TPA, TBI, MTK STIS/TKA, umum), penyusun soal dari bank soal, prasyarat tryout, mesin ujian CAT (timer server, simpan otomatis + cadangan offline, ragu-ragu, pintasan keyboard, zoom teks, layar penuh, kumpul otomatis), hasil & pembahasan, peringkat, analisis per soal.
- **Bank soal**: kategori → materi → soal; PG, PG kompleks, benar/salah, isian, majemuk; TKP berbobot; editor rumus MathQuill + pratinjau KaTeX.
- **Penjualan**: beli paket kelas/pertemuan/tryout/addon kuis, keranjang, diskon & voucher, pembayaran QRIS + unggah bukti, verifikasi admin, invoice PDF, produk, aturan harga, bonus produk, pengaturan pembayaran, laporan pendapatan (+PDF), promo & banner landing.
- **Lainnya**: notifikasi (lonceng real-time + halaman), game matematika & snake.

## Sesi tidak habis

- `SESSION_LIFETIME` minimal 1 tahun (dipaksa di `config/session.php`) dan diperpanjang setiap kali aplikasi dibuka.
- Login selalu memakai *remember me* (cookie ± 400 hari).
- Frontend memperbarui token CSRF setiap 10 menit (`/keep-alive`) dan saat tab dibuka kembali, sehingga form & Livewire tidak kena `419`.

Pengguna hanya keluar bila menekan **Keluar**.

## Teknologi

PHP 8.2+ (disarankan 8.3), Laravel 11, Livewire 3.7 (Alpine bawaan Livewire), Tailwind 3, Vite 5, MySQL/MariaDB. Chart.js, html5-qrcode, qrcodejs & KaTeX di-*host* sendiri di `public/vendor`.

## Pengujian

```bash
php artisan migrate:fresh --seed && php artisan db:seed --class=DemoDataSeeder   # DB lokal saja!
php artisan test
```

`SmokeTest` membuka seluruh halaman untuk tamu/admin/tentor/siswa; `FlowTest` menguji alur beli → bayar → verifikasi → akses, pengerjaan tryout, pendaftaran bimbel, presensi QR, dan login permanen.
