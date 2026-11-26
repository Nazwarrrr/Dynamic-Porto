FROM node:22-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm run build && test -f public/build/manifest.json

FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction
COPY . .
RUN composer dump-autoload --optimize --no-dev

FROM php:8.4-cli
RUN apt-get update && apt-get install -y --no-install-recommends \
        libzip-dev libpng-dev libjpeg-dev libwebp-dev libonig-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd opcache \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY --from=vendor /app ./
COPY --from=assets /app/public/build ./public/build
COPY docker/start.sh /usr/local/bin/start
RUN sed -i 's/\r$//' /usr/local/bin/start && chmod +x /usr/local/bin/start
ENV PHP_CLI_SERVER_WORKERS=4
CMD ["start"]
