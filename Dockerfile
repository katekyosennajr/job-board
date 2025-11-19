FROM php:8.2-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY . .

RUN chmod -R 755 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
