FROM php:8.2-apache

RUN apt-get update && apt-get install -y libzip-dev unzip libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring
RUN apt-get update && \
    apt-get install -y libicu-dev libcurl4-openssl-dev && \
    docker-php-ext-install intl
RUN docker-php-ext-install curl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 777 /var/www/html/writable

WORKDIR /var/www/html