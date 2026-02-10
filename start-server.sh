#!/bin/bash
set -e

echo "Clearing old route and config caches..."
rm -f bootstrap/cache/routes.php
rm -f bootstrap/cache/config.php
php artisan config:cache
php artisan route:cache

echo "Starting Laravel application..."
php artisan serve --host 0.0.0.0 --port ${PORT}
