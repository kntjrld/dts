RUN pecl install mongodb && docker-php-ext-enable mongodb
# restart
docker-compose up -d --build