# Base image PHP + Apache
FROM php:8.2-apache

# Cài extension cần cho Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Cài Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Bật rewrite module (Laravel cần để routing hoạt động)
RUN a2enmod rewrite

# Trỏ Apache tới thư mục public của Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy toàn bộ code vào container
COPY . /var/www/html

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Cài đặt dependencies của Laravel
RUN composer install --no-dev --optimize-autoloader

# Thiết lập quyền cho storage & bootstrap
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Chạy Apache
CMD ["apache2-foreground"]
