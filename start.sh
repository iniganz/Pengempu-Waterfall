#!/bin/bash

# Clear caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Ensure storage symlink exists (Railway/Nixpacks runtime can lose it)
php artisan storage:link || true

# Start queue worker in background for email sending
php artisan queue:work database --sleep=3 --tries=3 --max-time=3600 &

# Start web server in foreground
php artisan serve --host=0.0.0.0 --port=$PORT
