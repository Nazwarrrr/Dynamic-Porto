FROM php:8.4-cli

# Install dependensi sistem & ekstensi MySQL untuk Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install package PHP tanpa dev dependencies
RUN composer install --no-dev --optimize-autoloader

# Buat symlink storage & jalankan migration + server
CMD php artisan storage:link || true && php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
