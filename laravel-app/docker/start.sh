#!/bin/bash
set -e

# Laravel nginx config routes /api/* and all paths through public/index.php
if [ -f /var/www/html/conf/nginx/nginx-site.conf ]; then
  cp /var/www/html/conf/nginx/nginx-site.conf /etc/nginx/sites-available/default.conf
elif [ -n "$WEBROOT" ]; then
  sed -i "s#root /var/www/html;#root ${WEBROOT};#g" /etc/nginx/sites-available/default.conf
fi

cd /var/www/html

# Laravel optimizations, migrations, and seed data (team, projects, stats)
php artisan config:cache
php artisan view:cache
php artisan migrate --force
php artisan db:seed --force

# Ensure writable storage and bootstrap/cache
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -Rf nginx.nginx storage bootstrap/cache 2>/dev/null || true

# Start nginx and php-fpm
exec /usr/bin/supervisord -n -c /etc/supervisord.conf
