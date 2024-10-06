FROM php:8.1-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN apt-get update && apt-get install -y \
    git \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction && composer dump-autoload
CMD ["composer", "install"]







