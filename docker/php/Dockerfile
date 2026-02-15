FROM php:8.3-fpm-alpine

# Системные зависимости для сборки расширений
RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    postgresql-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) \
    intl \
    zip \
    pdo \
    pdo_pgsql \
    gd \
    opcache


WORKDIR /var/www/html

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN addgroup -g 1000 -S developer \
 && adduser -u 1000 -G developer -S -D -H developer

USER developer