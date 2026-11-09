# Mengganti Satya Naratama lama dengan versi TALL di VPS

Panduan ini mengganti **kode** aplikasi di VPS tanpa menyentuh **data**. Database, file unggahan (`storage/app/public`), akun, sesi login, dan `APP_KEY` tetap dipakai apa adanya.

> Versi baru **tidak menambah atau mengubah satu pun migrasi**. Saat `php artisan migrate` dijalankan, hasilnya harus `Nothing to migrate`. Kalau muncul migrasi lain, **berhenti** dan cek lagi (lihat bagian *Pemeriksaan sebelum ganti*).

Asumsi (sesuaikan bila berbeda):

| Item | Nilai di panduan |
|---|---|
| User Linux | `afnan` (login SSH dengan key, root login dimatikan) |
| Folder aplikasi lama | `/var/www/satya-naratama` |
| Domain | `satyanaratama.id` |
| PHP | 8.3-FPM, Nginx 1.24, MySQL/MariaDB, Supervisor (queue), cron (scheduler) |

Semua perintah dijalankan sebagai **afnan**. Gunakan `sudo` hanya pada perintah yang ditandai `sudo`.

---

## 0. Cek lokasi & kondisi aplikasi lama

```bash
# Lokasi folder yang dipakai Nginx
grep -R "root " /etc/nginx/sites-enabled/ | grep -i satya

# Pastikan .env & migrasi lama aman
cd /var/www/satya-naratama
grep -E "^(APP_KEY|DB_DATABASE|DB_USERNAME|SESSION_DRIVER)=" .env
php artisan migrate:status | tail -5
```

Catat path-nya. Kalau path-mu bukan `/var/www/satya-naratama`, ganti semua path di bawah.

---

## 1. Backup (wajib)

```bash
mkdir -p ~/backup-satya && cd ~/backup-satya
STAMP=$(date +%Y%m%d-%H%M)

# Database (isi DB_* sesuai .env)
mysqldump -h 127.0.0.1 -u USER_DB -p --single-transaction --routines NAMA_DB > db-$STAMP.sql

# File unggahan + .env
tar czf storage-$STAMP.tgz -C /var/www/satya-naratama storage/app
cp /var/www/satya-naratama/.env env-$STAMP.backup

ls -lh
```

---

## 2. Ambil kode baru ke folder terpisah

Pilih **salah satu**.

### A. Lewat Git (disarankan)

Di komputer lokal, ekstrak `satya-tall.zip`, lalu ganti isi repo `afnanalfian/satya-naratama` pada branch baru:

```bash
git clone https://github.com/afnanalfian/satya-naratama.git
cd satya-naratama
git checkout -b tall
# hapus isi lama kecuali .git, lalu salin isi satya-tall/ ke sini
find . -mindepth 1 -maxdepth 1 ! -name .git -exec rm -rf {} +
cp -r /path/ke/satya-tall/. .
git add -A && git commit -m "Rebuild TALL stack (Livewire) + tema Garnet & Saffron"
git push -u origin tall
```

Di VPS:

```bash
cd /var/www
git clone -b tall https://github.com/afnanalfian/satya-naratama.git satya-tall
```

### B. Upload zip

```bash
# dari komputer lokal
scp satya-tall.zip afnan@IP_VPS:/tmp/

# di VPS
cd /var/www && unzip -q /tmp/satya-tall.zip -d /var/www/   # menghasilkan /var/www/satya-tall
```

---

## 3. Siapkan folder baru

```bash
cd /var/www/satya-tall

# 3.1 .env lama → baru (APP_KEY & DB tetap sama)
cp /var/www/satya-naratama/.env .env

# 3.2 tambahkan/ubah variabel baru (lihat .env.example)
sed -i 's/^SESSION_LIFETIME=.*/SESSION_LIFETIME=525600/' .env
grep -q '^SATYA_ADMIN_WA=' .env || cat >> .env <<'EOF'

SATYA_ADMIN_WA=6282154734819
SATYA_CS_WA=6285141339645
SATYA_EMAIL=satyanaratama@gmail.com
SATYA_REGISTRATION_FEE=6000000
SATYA_BANK_CODE=BRI
SATYA_BANK_NAME="Bank Rakyat Indonesia"
SATYA_BANK_NUMBER=022301059553505
SATYA_BANK_OWNER="Muhammad Afnan Alfian"
EOF

# 3.3 salin SEMUA file unggahan (avatar, thumbnail, bukti bayar, gambar soal, materi PDF, QRIS, banner)
rsync -a /var/www/satya-naratama/storage/app/ ./storage/app/

# 3.4 dependensi & aset
composer install --no-dev --optimize-autoloader
npm ci || npm install
npm run build

# 3.5 izin folder (afnan pemilik, www-data grup)
sudo chown -R afnan:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache
php artisan storage:link
```

---

## 4. Pemeriksaan sebelum ganti

```bash
cd /var/www/satya-tall
php artisan migrate:status | grep -c Pending   # harus 0
php artisan about | head -25
php artisan route:list | wc -l                 # ± 240 route
```

`Pending` harus **0**. Database tidak perlu diubah sama sekali.

---

## 5. Ganti (± 30 detik downtime)

Cara paling aman: **tukar nama folder**, sehingga konfigurasi Nginx, Supervisor & cron yang lama tidak perlu diubah.

```bash
cd /var/www/satya-naratama && php artisan down || true   # aplikasi LAMA masuk mode perawatan
rsync -a /var/www/satya-naratama/storage/app/ /var/www/satya-tall/storage/app/   # sinkron ulang unggahan terbaru

sudo mv /var/www/satya-naratama /var/www/satya-naratama-lama
sudo mv /var/www/satya-tall /var/www/satya-naratama

cd /var/www/satya-naratama
php artisan migrate --force          # → "Nothing to migrate"
php artisan optimize:clear
php artisan optimize                  # cache config, route, view, event
php artisan up

sudo systemctl reload php8.3-fpm
sudo supervisorctl restart all       # worker antrean
```

Buka `https://satyanaratama.id`, lalu tekan **Ctrl+Shift+R** (hard refresh) sekali.

> Pengguna yang sedang login **tidak** perlu login ulang: tabel `sessions` & `APP_KEY` sama.

---

## 6. Cek cepat setelah ganti

- [ ] Halaman depan, `/login`, `/daftar`, `/daftar/status` tampil.
- [ ] Login admin → dashboard, **Pesanan**, **Pendaftaran**, **Bank Soal**, **Rekap Presensi** terbuka.
- [ ] Gambar lama (avatar, thumbnail kelas, gambar soal, bukti bayar, QRIS) muncul.
- [ ] Login siswa → buka tryout aktif, kerjakan 1 soal, cek tersimpan (`n/N terjawab · tersimpan`).
- [ ] Scan QR di **Scan Presensi** (izinkan kamera browser).
- [ ] Unduh invoice PDF & laporan pendapatan PDF.
- [ ] `tail -f storage/logs/laravel.log` tidak ada error baru.

---

## 7. Rollback (kalau ada masalah)

```bash
sudo mv /var/www/satya-naratama /var/www/satya-tall-gagal
sudo mv /var/www/satya-naratama-lama /var/www/satya-naratama
cd /var/www/satya-naratama && php artisan optimize:clear && php artisan optimize
sudo systemctl reload php8.3-fpm && sudo supervisorctl restart all
```

Data aman karena database tidak diubah. **Catatan:** file yang diunggah pengguna *setelah* ganti tersimpan di folder baru; salin balik dengan
`rsync -a /var/www/satya-tall-gagal/storage/app/public/ /var/www/satya-naratama/storage/app/public/`.

Setelah 1–2 minggu stabil, folder lama boleh dihapus: `sudo rm -rf /var/www/satya-naratama-lama`.

---

## 8. Update berikutnya

Gunakan `deploy.sh` di root proyek:

```bash
cd /var/www/satya-naratama && bash deploy.sh
```

---

## 9. Pengaturan server yang disarankan

**Upload besar** (bukti bayar, PDF materi hingga 10 MB, gambar soal). Pastikan:

```bash
# PHP
sudo sed -i 's/^upload_max_filesize.*/upload_max_filesize = 64M/; s/^post_max_size.*/post_max_size = 64M/; s/^memory_limit.*/memory_limit = 512M/' /etc/php/8.3/fpm/php.ini
sudo systemctl reload php8.3-fpm
# Nginx: di blok server satyanaratama.id
#   client_max_body_size 64M;
sudo nginx -t && sudo systemctl reload nginx
```

Livewire menyimpan unggahan sementara di `storage/app/livewire-tmp` (maks 50 MB, diatur di `config/livewire.php`) dan otomatis dibersihkan.

**Contoh blok Nginx 1.24** (jika ingin menulis ulang; perhatikan `listen 443 ssl http2;` — Nginx 1.24 belum mengenal `http2 on;`):

```nginx
server {
    listen 80;
    server_name satyanaratama.id www.satyanaratama.id;
    return 301 https://satyanaratama.id$request_uri;
}
server {
    listen 443 ssl http2;
    server_name www.satyanaratama.id;
    ssl_certificate     /etc/letsencrypt/live/satyanaratama.id/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/satyanaratama.id/privkey.pem;
    return 301 https://satyanaratama.id$request_uri;
}
server {
    listen 443 ssl http2;
    server_name satyanaratama.id;
    root /var/www/satya-naratama/public;
    index index.php;

    ssl_certificate     /etc/letsencrypt/live/satyanaratama.id/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/satyanaratama.id/privkey.pem;

    client_max_body_size 64M;
    charset utf-8;

    location / { try_files $uri $uri/ /index.php?$query_string; }
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    location ~* \.(?:css|js|woff2?|svg|png|jpe?g|webp|gif|ico)$ {
        expires 30d; access_log off; add_header Cache-Control "public";
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_read_timeout 120;
    }
    location ~ /\.(?!well-known).* { deny all; }
}
```

**Cron & antrean** (biasanya sudah ada dari versi lama):

```bash
crontab -l | grep schedule:run   # harus ada:
# * * * * * cd /var/www/satya-naratama && php artisan schedule:run >> /dev/null 2>&1
sudo supervisorctl status          # worker queue:work untuk email & notifikasi
```

Jika worker berjalan sebagai user lain (mis. `deploy`), ubah `user=afnan` di `/etc/supervisor/conf.d/*.conf`, lalu `sudo supervisorctl reread && sudo supervisorctl update`.

---

## Masalah umum

| Gejala | Solusi |
|---|---|
| Halaman tanpa gaya / `Vite manifest not found` | `npm ci && npm run build` di folder aplikasi |
| Gambar lama tidak muncul | `php artisan storage:link` lalu cek `ls -la public/storage`; pastikan langkah 3.3 (rsync) dijalankan |
| `419 Page Expired` saat submit | Sudah ditangani otomatis (token diperbarui di latar). Kalau tetap muncul, pastikan `SESSION_DOMAIN` kosong/`null` dan `APP_URL=https://satyanaratama.id` |
| Upload gagal ~2 MB | Atur `upload_max_filesize`, `post_max_size`, `client_max_body_size` (bagian 9) |
| `Permission denied` di storage | `sudo chown -R afnan:www-data storage bootstrap/cache && chmod -R ug+rwX storage bootstrap/cache` |
| Scanner kamera tidak jalan | Wajib HTTPS & izin kamera di browser |
| Rumus tidak tampil di editor soal | Editor memakai MathQuill & jQuery dari CDN; pastikan koneksi internet admin tidak memblokir `cdnjs.cloudflare.com` & `code.jquery.com`. Tampilan rumus untuk siswa memakai KaTeX lokal (tanpa CDN). |
