#!/bin/bash

# Clear caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Start queue worker in background with verbose logging
php artisan queue:work database --tries=3 --timeout=90 --sleep=3 --verbose &

# Get the PID of queue worker
QUEUE_PID=$!
echo "Queue worker started with PID: $QUEUE_PID"

# Start web server in foreground
php artisan serve --host=0.0.0.0 --port=$PORT
