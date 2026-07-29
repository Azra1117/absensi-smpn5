# ==========================
# Stage 1 - Build Frontend
# ==========================
FROM node:22 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build

# ==========================
# Stage 2 - PHP
# ==========================
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        gd \
        zip \
        bcmath \
        exif

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p storage/framework/cache \
    storage/framework/views \
    storage/framework/sessions \
    storage/framework/testing \
    storage/logs \
    bootstrap/cache

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-10000}