FROM php:8.3-fpm

# Cài đặt các extensions cần thiết cho Laravel
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# Cài đặt các package bổ sung như GD, zip, git, và Xdebug
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Đặt thư mục làm việc trong container
WORKDIR /var/www/html

# Sao chép mã nguồn từ máy host vào container
COPY . /var/www/html

# Cài đặt các thư viện Laravel qua Composer
RUN composer install

# Sinh key cho Laravel nếu chưa có
RUN php artisan key:generate

# Cấu hình quyền sở hữu cho các thư mục cần thiết
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Chạy PHP-FPM
CMD ["php-fpm"]
