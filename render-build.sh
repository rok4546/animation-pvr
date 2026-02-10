#!/bin/bash
set -e

echo "Installing composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

echo "Installing npm dependencies..."
npm install --production

echo "Building frontend assets..."
npm run build

echo "Creating database..."
touch /tmp/database.sqlite

echo "Running database migrations..."
php artisan migrate --force --no-interaction

echo "Clearing old caches..."
php artisan config:clear
php artisan route:clear
php artisan cache:clear

echo "Regenerating Laravel caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "Build and setup completed successfully!"
