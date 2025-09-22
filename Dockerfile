# ใช้ PHP + Apache
FROM php:8.2-apache

# ตั้งค่า working directory
WORKDIR /var/www/html

# Copy project ทั้งหมด
COPY . .

# ติดตั้ง dependencies ที่จำเป็น
RUN apt-get update && apt-get install -y libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip

# ติดตั้ง Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# ตั้ง permission ให้ Laravel
RUN chown -R www-data:www-data /var/www/html

# Apache ให้ชี้ไป public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite
