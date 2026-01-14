#!/bin/bash

# Clear caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Ensure storage symlink exists (Railway/Nixpacks runtime can lose it)
php artisan storage:link || true

# Start web server in foreground
# Queue disabled - using QUEUE_CONNECTION=sync for immediate email sending
php artisan serve --host=0.0.0.0 --port=$PORT
