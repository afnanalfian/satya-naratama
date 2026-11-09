# Menjalankan di komputer lokal

Kebutuhan: PHP 8.2+ (ekstensi `pdo_mysql`, `gd`, `intl`, `zip`, `mbstring`), Composer 2, Node 18+, MySQL/MariaDB.

```bash
cd satya-tall
composer install
cp .env.example .env
php artisan key:generate          # JANGAN dijalankan di server — server memakai APP_KEY lama
```

Isi `DB_*` di `.env`, lalu:

```bash
php artisan migrate --seed                     # wilayah, peran, akun admin
php artisan db:seed --class=KecamatanSeeder
php artisan db:seed --class=KelurahanSeeder
php artisan db:seed --class=DemoDataSeeder     # data contoh (opsional)
php artisan storage:link
npm install
npm run dev        # atau: npm run build
php artisan serve
```

Akun contoh dari `DemoDataSeeder` (password `password`): `admin@demo.test`, `tentor@demo.test`, `siswa@demo.test`.

Jalankan antrean & penjadwal bila perlu:

```bash
php artisan queue:work
php artisan schedule:work
```

## Memakai salinan database produksi

1. Di server: `mysqldump --single-transaction -u USER -p NAMA_DB > satya.sql`
2. Di lokal: `mysql -u root -p satya_naratama < satya.sql`
3. Salin `APP_KEY` dari `.env` server (agar data terenkripsi & sesi cocok).
4. Salin isi `storage/app/public` server ke `storage/app/public` lokal agar gambar muncul.
5. `php artisan migrate:status` → semua **Ran**, tidak ada **Pending**.

## Struktur penting

```
app/Livewire/          Komponen halaman (Auth, Daftar, Dashboard, Users, Courses, Exams, Bank, Shop, Admin, ...)
app/Services/          CartService & OrderVerificationService (baru) + layanan lama (Pricing, Discount, Checkout, Attendance, ...)
app/Support/Menu.php   Menu sidebar per peran
config/satya.php       Kontak WA, rekening & biaya pendaftaran (dari .env)
resources/js/          app.js (Livewire ESM), session.js (sesi abadi), ui.js (toast, konfirmasi, grafik, rumus)
resources/css/app.css  Design system Garnet & Saffron (card, btn-*, input, badge-*, table, ...)
resources/views/       components/layouts (app, public, auth, exam), livewire/*, halaman Blade per modul
```
