FROM php:8.2-apache

WORKDIR /var/www/html

# Copy project
COPY . .

# Install dependencies
RUN apt-get update && apt-get install -y libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html
