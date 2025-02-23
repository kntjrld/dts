RUN pecl install mongodb && docker-php-ext-enable mongodb
# Install additional PHP extensions
RUN docker-php-ext-install pdo