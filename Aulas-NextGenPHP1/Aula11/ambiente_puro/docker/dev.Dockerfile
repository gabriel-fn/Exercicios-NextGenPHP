FROM php:8.4-fpm-alpine

RUN curl https://getcomposer.org/download/2.8.4/composer.phar --output /usr/bin/composer \
    && chmod +x /usr/bin/composer

RUN apk update \
    && apk add --no-cache build-base autoconf linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN deluser www-data && addgroup -g 1000 www-data \
    && adduser -G www-data -u 1000 www-data -D
