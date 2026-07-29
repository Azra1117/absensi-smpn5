# ==========================
# Stage 1 - Build frontend
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
FROM dunglas/frankenphp:php8.2

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
        gd \
        zip \
        pdo_mysql \
        bcmath \
        exif

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]