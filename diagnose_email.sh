#!/bin/bash
# Quick test script to diagnose ticket email issue on Railway

echo "=== RESEND EMAIL DIAGNOSTIC ==="
echo ""

# Test 1: Check if Resend package installed
echo "1. Checking Resend package..."
php -r "require 'vendor/autoload.php'; echo class_exists('Resend') ? '✅ Resend class exists' : '❌ Resend not found'; echo PHP_EOL;"

# Test 2: Check environment variables
echo ""
echo "2. Checking environment variables..."
php -r "
require 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$app->boot();

echo 'MAIL_MAILER: ' . env('MAIL_MAILER', 'NOT SET') . PHP_EOL;
echo 'RESEND_API_KEY: ' . (env('RESEND_API_KEY') ? 'SET (' . substr(env('RESEND_API_KEY'), 0, 15) . '...)' : 'NOT SET') . PHP_EOL;
echo 'MAIL_FROM_ADDRESS: ' . config('mail.from.address', 'NOT SET') . PHP_EOL;
echo 'MAIL_FROM_NAME: ' . config('mail.from.name', 'NOT SET') . PHP_EOL;
"

# Test 3: Find a test order
echo ""
echo "3. Finding test order..."
php artisan tinker --execute="
\$order = \App\Models\Order::where('payment_status', 'settlement')->with('ticket')->first();
if (!\$order) {
    echo '❌ No settlement order found' . PHP_EOL;
    exit(1);
}
echo '✅ Order found: ' . \$order->order_id . PHP_EOL;
echo '   Email: ' . \$order->email . PHP_EOL;
echo '   Has ticket: ' . (\$order->ticket ? 'YES' : 'NO') . PHP_EOL;
"

# Test 4: Test Resend API directly
echo ""
echo "4. Testing Resend API directly..."
php artisan tinker --execute="
use App\Services\ResendMailer;

\$order = \App\Models\Order::where('payment_status', 'settlement')->first();
if (!\$order) exit(1);

try {
    \$response = ResendMailer::send(
        from: config('mail.from.name') . ' <' . config('mail.from.address') . '>',
        to: \$order->email,
        subject: 'TEST - Railway Diagnostic',
        html: '<h1>Test Email</h1><p>If you receive this, Resend API works!</p>'
    );

    echo '✅ Email sent successfully!' . PHP_EOL;
    echo '   Resend ID: ' . (\$response['id'] ?? 'N/A') . PHP_EOL;
    echo '   Response: ' . json_encode(\$response) . PHP_EOL;
} catch (\Throwable \$e) {
    echo '❌ Error: ' . \$e->getMessage() . PHP_EOL;
    echo '   File: ' . \$e->getFile() . ':' . \$e->getLine() . PHP_EOL;
}
"

echo ""
echo "=== DIAGNOSTIC COMPLETE ==="
