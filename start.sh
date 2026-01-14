#!/bin/bash

# Clear caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Start queue worker in background
php artisan queue:work --daemon --tries=3 --timeout=90 &

# Start web server in foreground
php artisan serve --host=0.0.0.0 --port=$PORT
