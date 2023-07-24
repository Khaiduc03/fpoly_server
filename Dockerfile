# Sử dụng PHP-FPM như base image
FROM php:8-fpm

# Cài đặt các extension PHP cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Sao chép mã nguồn ứng dụng vào container
COPY . /var/www/html

# Thiết lập quyền truy cập cho thư mục
RUN chown -R www-data:www-data /var/www



# Thiết lập user và group mặc định cho PHP-FPM
RUN sed -i "s/www-data:\/var\/www:\/usr\/sbin\/nologin/www-data:\/var\/www:\/bin\/bash/" /etc/passwd

# Thiết lập quyền truy cập cho PHP-FPM
RUN sed -i "s/www-data:x:33:33:/www-data:x:1000:1000:/" /etc/passwd

# Expose cổng 9000 cho PHP-FPM
EXPOSE 9000