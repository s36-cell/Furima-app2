FROM php:8.4-fpm

# 必須ライブラリ
RUN apt-get update \
    && apt-get install -y \
        zip unzip git vim libonig-dev libxml2-dev \
        default-mysql-client \
    && docker-php-ext-install pdo_mysql

WORKDIR /var/www/html