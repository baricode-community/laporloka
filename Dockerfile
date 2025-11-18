FROM php:8.3-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install zip intl pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
