# Base image PHP + Apache
FROM php:8.2-apache

# Cài extension cần cho Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Bật rewrite module (Laravel cần để routing hoạt động)
RUN a2enmod rewrite

# Chỉ định Apache phục vụ thư mục public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy toàn bộ code vào container
COPY . /var/www/html

# Thiết lập quyền cho thư mục storage & bootstrap
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80
