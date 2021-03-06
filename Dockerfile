FROM php:8.0.5-fpm-alpine

WORKDIR /var/www

RUN apk update && apk add \
    build-base \
    vim


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

USER www
COPY --chown=www:www . /var/www

RUN composer install --ignore-platform-reqs --no-scripts

EXPOSE 9000
