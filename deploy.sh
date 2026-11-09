#!/usr/bin/env bash
# Update aplikasi Satya Naratama di server (jalankan sebagai user afnan dari folder aplikasi).
set -euo pipefail
cd "$(dirname "$0")"

php artisan down || true
git pull --ff-only
composer install --no-dev --optimize-autoloader --no-interaction
npm ci || npm install
npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan optimize
php artisan queue:restart
php artisan up

echo "✅ Deploy selesai: $(git log -1 --pretty='%h %s')"
