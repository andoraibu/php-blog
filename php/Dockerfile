FROM php:7.4-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./composer.* ./

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

COPY . .



