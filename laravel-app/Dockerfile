# Stage 1: Build dependencies and frontend assets
FROM php:8.2-cli AS builder

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libpng-dev libonig-dev libpq-dev \
    nodejs npm \
    && docker-php-ext-install zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY . .
RUN composer dump-autoload --optimize --no-dev

RUN npm ci && npm run build && rm -rf node_modules

# Stage 2: Production runtime
FROM richarvey/nginx-php-fpm:3.1.6

COPY --from=builder /var/www/html /var/www/html

ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

# Start script: cache config, run migrations, then start nginx/php-fpm
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
