# Base image PHP + Apache
FROM php:8.2-apache

# Cài các extension cần cho Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Bật rewrite module (Laravel cần để routing)
RUN a2enmod rewrite

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy toàn bộ source code
COPY . /var/www/html

# Thiết lập quyền
RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html

# Sửa cấu hình Apache để trỏ DocumentRoot đến public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Cho phép Laravel sử dụng .htaccess
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Cài dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Quyền cho storage và cache
RUN chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
