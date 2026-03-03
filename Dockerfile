# Build from repo root so Render finds this file. All app code is in laravel-app/.

# Stage 1: Build dependencies and frontend assets (PHP 8.4 required by composer.lock)
FROM php:8.2-cli AS builder

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libpng-dev libonig-dev libpq-dev \
    nodejs npm \
    && docker-php-ext-install zip pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY laravel-app/composer.json laravel-app/composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY laravel-app/ .
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

# Inline start script so we don't depend on docker/start.sh in repo
RUN echo '#!/bin/bash' > /start.sh \
 && echo 'set -e' >> /start.sh \
 && printf '%s\n' 'if [ -n "$WEBROOT" ]; then sed -i "s#root /var/www/html;#root ${WEBROOT};#g" /etc/nginx/sites-available/default.conf; fi' >> /start.sh \
 && echo 'cd /var/www/html' >> /start.sh \
 && echo 'php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan migrate --force' >> /start.sh \
 && echo 'mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache' >> /start.sh \
 && echo 'chown -Rf nginx.nginx storage bootstrap/cache 2>/dev/null || true' >> /start.sh \
 && echo 'exec /usr/bin/supervisord -n -c /etc/supervisord.conf' >> /start.sh \
 && chmod +x /start.sh

CMD ["/start.sh"]
