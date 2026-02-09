#!/bin/bash

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader
npm install
npm run build

echo "Generating Laravel optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running database migrations..."
php artisan migrate --force

echo "Build completed successfully!"
