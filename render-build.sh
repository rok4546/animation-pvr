#!/bin/bash
set -e

echo "Installing composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "Installing npm dependencies..."
npm install

echo "Building frontend assets..."
npm run build

echo "Generating Laravel configuration cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Creating database and running migrations..."
touch /tmp/database.sqlite
php artisan migrate --force --no-interaction

echo "Clearing caches..."
php artisan cache:clear
php artisan config:clear

echo "Build and setup completed successfully!"
