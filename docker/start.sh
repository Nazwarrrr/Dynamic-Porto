#!/bin/sh
set -e

if [ -n "${ADMIN_EMAIL:-}" ] || [ -n "${ADMIN_PASSWORD:-}" ]; then
    if [ -z "${ADMIN_EMAIL:-}" ] || [ -z "${ADMIN_PASSWORD:-}" ]; then
        printf '%s\n' 'Both ADMIN_EMAIL and ADMIN_PASSWORD must be set to sync admin credentials.' >&2
        exit 1
    fi
fi

php artisan storage:link --force || true
php artisan migrate --force
if [ -n "${ADMIN_EMAIL:-}" ]; then
    php artisan db:seed --class='Database\Seeders\AdminUserSeeder' --force
fi
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
