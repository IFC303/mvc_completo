FROM php:8.1.3-fpm

# MySQL
RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Xdebug
RUN pecl install xdebug-3.1.2
ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini