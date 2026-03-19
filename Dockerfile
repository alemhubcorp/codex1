FROM php:8.2-cli-bookworm

WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    libzip-dev \
    libicu-dev \
    libcurl4-openssl-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        curl \
        exif \
        gd \
        intl \
        mbstring \
        pdo_mysql \
        soap \
        xml \
        xmlwriter \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json ./
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader --no-scripts

COPY . .

RUN php artisan package:discover --ansi || true \
    && chmod -R 775 storage bootstrap/cache

ENV PORT=8080
EXPOSE 8080

CMD ["sh", "-c", "php artisan serve --host 0.0.0.0 --port ${PORT:-8080}"]
