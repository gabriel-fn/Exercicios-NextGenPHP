FROM php:8.3-fpm-alpine

RUN docker-php-ext-install pdo_mysql opcache

RUN apk update \
    && apk add build-base autoconf

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN apk del build-base autoconf \
    && apk cache clean
