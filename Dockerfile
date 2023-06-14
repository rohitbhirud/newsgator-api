FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql gd mbstring exif pcntl bcmath

# Set the working directory
WORKDIR /var/www/php

# Copy the application code
COPY ./src /var/www/php

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-scripts --no-plugins

# RUN vendor/bin/phinx migrate -e development