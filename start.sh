#!/usr/bin/env bash
set -e

mkdir -p database storage/framework/cache storage/framework/views storage/framework/sessions storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache database

# Cek apakah file database.sqlite sudah ada (biar data lama lu gak kehapus/ke-reset)
if [ ! -f "database/database.sqlite" ]; then
    touch database/database.sqlite
    php artisan migrate --force
    php artisan db:seed --force || true
fi

php artisan serve --host=0.0.0.0 --port=${PORT:-10000}