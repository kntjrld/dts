#Use PHP with Apache
FROM php:8.2-apache

#Enable mod_rewrite for .htaccess
RUN a2enmod rewrite

#Copy project files to /var/www/html
WORKDIR /var/www/html
COPY . /var/www/html

#Set permissions for the project
RUN chown -R www-data:www-data /var/www/html

#Restart Apache
RUN service apache2 restart