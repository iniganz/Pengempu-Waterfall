#!/bin/bash

# Clear caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Ensure storage symlink exists (Railway/Nixpacks runtime can lose it)
php artisan storage:link || true

# Queue worker disabled: production uses QUEUE_CONNECTION=sync on Railway
# (Starting a database worker without a dedicated worker service can cause issues)

# Start web server in foreground
php artisan serve --host=0.0.0.0 --port=$PORT
