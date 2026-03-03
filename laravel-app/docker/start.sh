#!/bin/bash
set -e

# Set Laravel public as nginx webroot
if [ -n "$WEBROOT" ]; then
  sed -i "s#root /var/www/html;#root ${WEBROOT};#g" /etc/nginx/sites-available/default.conf
fi

cd /var/www/html

# Laravel optimizations and migrations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Ensure writable storage and bootstrap/cache
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -Rf nginx.nginx storage bootstrap/cache 2>/dev/null || true

# Start nginx and php-fpm
exec /usr/bin/supervisord -n -c /etc/supervisord.conf
