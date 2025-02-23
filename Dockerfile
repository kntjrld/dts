FROM php:8.2-apache

RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install additional PHP extensions
RUN docker-php-ext-install pdo

# Disable a PHP extension
RUN docker-php-ext-disable pdo_mysql