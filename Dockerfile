FROM php:8.2-fpm

# 1. 安装系统底层依赖 (Imagick, GD, intl 必须)
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    --no-install-recommends && rm -rf /var/lib/apt/lists/*

# 2. 安装 PHP 核心扩展
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) intl zip bcmath gd mysqli pdo_mysql

# 3. 安装 Redis 和 ImageMagick (这两个安装很快)
RUN pecl install redis imagick \
    && docker-php-ext-enable redis imagick

# 4. 安装 ionCube Loader (PHP 8.2 专用)
RUN curl -fSL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o ioncube.tar.gz \
    && tar -xzf ioncube.tar.gz \
    && cp ioncube/ioncube_loader_lin_8.2.so $(php -r "echo ini_get('extension_dir');") \
    && echo "zend_extension=ioncube_loader_lin_8.2.so" > /usr/local/etc/php/conf.d/00-ioncube.ini \
    && rm -rf ioncube.tar.gz ioncube

# 暂时不安装 Swoole，确保构建成功率
# RUN pecl install swoole

# 设置工作目录
WORKDIR /var/www/html/yinyue888
