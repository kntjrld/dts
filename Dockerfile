#Use PHP with Apache
FROM php:8.2-apache

#Enable mod_rewrite for .htaccess
RUN a2enmod rewrite