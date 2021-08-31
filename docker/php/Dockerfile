FROM php:7.4-fpm

RUN apt-get update && apt-get install -y libxml2-dev libicu-dev libzip-dev git zip unzip && \
    docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install pdo_mysql soap mysqli pdo_mysql zip \
    && apt-get purge -y libicu-dev \
    && mkdir -p /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /app

WORKDIR /app