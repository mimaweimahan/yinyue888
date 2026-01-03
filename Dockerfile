FROM php:8.2-fpm

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    libmagickwand-dev libicu-dev libzip-dev zip unzip git curl \
    --no-install-recommends && rm -rf /var/lib/apt/lists/*

# 安装 PHP 标准扩展
RUN docker-php-ext-install intl zip bcmath gd mysqli pdo_mysql

# 安装 ImageMagick 和 Redis
RUN pecl install imagick redis && docker-php-ext-enable imagick redis

# 安装 ionCube Loader
RUN curl -fSL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o ioncube.tar.gz \
    && tar -xzf ioncube.tar.gz \
    && cp ioncube/ioncube_loader_lin_8.2.so $(php -r "echo ini_get('extension_dir');") \
    && echo "zend_extension=ioncube_loader_lin_8.2.so" > /usr/local/etc/php/conf.d/00-ioncube.ini \
    && rm -rf ioncube.tar.gz ioncube

# --- 编译安装多版本 Swoole ---

# 1. 编译 Swoole 4.8.x (适合旧项目)
RUN pecl install swoole-4.8.12 && mv $(php -r "echo ini_get('extension_dir');")/swoole.so $(php -r "echo ini_get('extension_dir');")/swoole4.so

# 2. 编译 Swoole 5.x (当前主流)
RUN pecl install swoole-5.1.1 && mv $(php -r "echo ini_get('extension_dir');")/swoole.so $(php -r "echo ini_get('extension_dir');")/swoole5.so

# 3. 编译 Swoole 6.x (预览/最新)
# 注意：如果 pecl 还没有正式版，可能需要从源码编译，这里先演示 6.0.0-alpha
RUN pecl install swoole-6.0.0 && mv $(php -r "echo ini_get('extension_dir');")/swoole.so $(php -r "echo ini_get('extension_dir');")/swoole6.so

# 默认启用 Swoole 5
RUN echo "extension=swoole5.so" > /usr/local/etc/php/conf.d/docker-php-ext-swoole.ini

WORKDIR /workspaces/${localWorkspaceFolderBasename}