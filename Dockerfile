FROM composer as composer
FROM php:8.2-fpm-alpine
WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install

