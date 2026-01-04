FROM php:8.2-fpm

# 安装系统依赖和 PHP 扩展 (mysqli, pdo, gd, zip, redis)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) mysqli pdo_mysql gd zip \
    && pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /var/www/html/yinyue888
