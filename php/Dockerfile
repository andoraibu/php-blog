FROM php:7.4-fpm

RUN docker-php-ext-install pdo pdo_mysql

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

COPY ./composer.* ./

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

RUN composer update

COPY . .



