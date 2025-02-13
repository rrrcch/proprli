#!/bin/sh

set -e

cp .env.example .env

echo "Running composer install..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "Generating application key..."
php artisan key:generate --force

echo "Running database migrations..."
php artisan migrate:fresh --seed --force
