FROM php:7.4-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev libcurl4-openssl-dev pkg-config libssl-dev \
    && docker-php-ext-install intl opcache \
    && pecl install mongodb apcu \
    && docker-php-ext-enable mongodb apcu opcache \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/slim_app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "erichfr1@hotmail.com" \
    && git config --global user.name "Erich Fournier"