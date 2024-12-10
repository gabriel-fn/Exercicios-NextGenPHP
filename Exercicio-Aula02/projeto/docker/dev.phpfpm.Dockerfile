FROM php:8.2-fpm-alpine

RUN apk update \
    && apk --no-cache add postgresql-dev build-base autoconf

RUN docker-php-ext-install pdo_pgsql opcache 

RUN	apk add --no-cache --update linux-headers \
    && pecl install xdebug-3.2.1 \
	&& docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"