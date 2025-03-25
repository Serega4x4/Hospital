#!/bin/bash

# Wait for MySQL to be ready
until mysqladmin ping -h db -u root --silent; do
    echo "Waiting for MySQL to be ready..."
    sleep 2
done

# Run migrations and seeders
php artisan migrate --force
php artisan migrate --seed --force
php artisan db:seed --class=DatabaseSeeder --force
php artisan db:seed --class=SuperadminSeeder --force

# Start PHP-FPM
exec php-fpm