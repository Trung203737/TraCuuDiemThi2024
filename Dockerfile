# Base image PHP + Apache
FROM php:8.2-apache

# Cài các extension cần cho Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip

# Bật rewrite module
RUN a2enmod rewrite

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy toàn bộ code
COPY . /var/www/html

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Cài dependency
RUN composer install --no-dev --optimize-autoloader

# Quyền cho storage và cache
RUN chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
