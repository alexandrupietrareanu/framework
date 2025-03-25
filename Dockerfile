FROM php:8.3-cli-alpine

RUN apk add --no-cache postgresql-dev git zip unzip \
    && docker-php-ext-install pdo_pgsql

# Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8000

COPY . /var/www/html

RUN composer install

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
