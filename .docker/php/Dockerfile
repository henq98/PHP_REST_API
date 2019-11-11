FROM php:7.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    apt-utils \
    autoconf \
    build-essential \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev

RUN docker-php-ext-install pdo mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 80
