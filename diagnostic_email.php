<?php

/**
 * COMPREHENSIVE EMAIL DIAGNOSTICS SCRIPT
 *
 * Jalankan: php artisan tinker
 * Paste semua code ini di tinker untuk test email end-to-end
 */

echo "=== PENGEMPU WATERFALL - EMAIL DIAGNOSTIC ===\n\n";

// Step 1: Check environment variables
echo "1. Environment Variables Check:\n";
echo "   MAIL_MAILER: " . env('MAIL_MAILER', 'NOT SET') . "\n";
echo "   MAIL_FROM_ADDRESS: " . config('mail.from.address', 'NOT SET') . "\n";
echo "   MAIL_FROM_NAME: " . config('mail.from.name', 'NOT SET') . "\n";
echo "   RESEND_API_KEY: " . (env('RESEND_API_KEY') ? 'SET (' . substr(env('RESEND_API_KEY'), 0, 10) . '...)' : 'NOT SET') . "\n";
echo "\n";

// Step 2: Test Resend API directly
echo "2. Testing Resend API Connection:\n";
try {
    $apiKey = env('RESEND_API_KEY');
    if (!$apiKey) {
        echo "   ❌ RESEND_API_KEY not set!\n\n";
    } else {
        $resend = Resend::client($apiKey);

        // Test send to YOUR email (ganti ini!)
        $testEmail = 'TEST_EMAIL_DISINI@gmail.com'; // ⚠️ GANTI INI!

        echo "   Sending test to: $testEmail\n";

        $response = $resend->emails->send([
            'from' => config('mail.from.name', 'Admin') . ' <' . config('mail.from.address', 'onboarding@resend.dev') . '>',
            'to' => [$testEmail],
            'subject' => 'Test Email - Diagnostic',
            'html' => '<p><strong>Success!</strong> Resend API bekerja. Timestamp: ' . now() . '</p>',
        ]);

        $res = (array) $response;
        echo "   ✅ Resend API Response:\n";
        echo "      ID: " . ($res['id'] ?? 'N/A') . "\n";
        echo "      Full: " . json_encode($res, JSON_PRETTY_PRINT) . "\n";
    }
} catch (\Throwable $e) {
    echo "   ❌ Resend API Error:\n";
    echo "      " . $e->getMessage() . "\n";
}
echo "\n";

// Step 3: Test with actual Order + Ticket
echo "3. Testing with Real Order Data:\n";
try {
    $order = \App\Models\Order::where('payment_status', 'settlement')->with('ticket')->first();

    if (!$order) {
        echo "   ⚠️  No settlement order found. Create one first.\n\n";
    } else {
        echo "   Order ID: " . $order->order_id . "\n";
        echo "   Email: " . $order->email . "\n";
        echo "   Ticket: " . ($order->ticket ? $order->ticket->ticket_code : 'NOT CREATED') . "\n";

        if (!$order->ticket) {
            echo "   Creating ticket...\n";
            $ticket = \App\Models\Ticket::create([
                'order_id' => $order->id,
                'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
                'qr_token' => (string) Str::uuid(),
            ]);
            echo "   ✅ Ticket created: " . $ticket->ticket_code . "\n";
        } else {
            $ticket = $order->ticket;
        }

        // Render Blade view
        echo "   Rendering mail.ticket view...\n";
        $html = View::make('mail.ticket', [
            'order' => $order,
            'ticket' => $ticket,
            'qrUrl' => route('ticket.verify', $ticket->qr_token),
        ])->render();

        echo "   ✅ View rendered (length: " . strlen($html) . " chars)\n";

        // Send via Resend
        echo "   Sending via ResendMailer...\n";
        $response = \App\Services\ResendMailer::send(
            from: config('mail.from.name', 'Admin') . ' <' . config('mail.from.address', 'onboarding@resend.dev') . '>',
            to: $order->email,
            subject: 'Tiket Resmi - ' . $order->order_id,
            html: $html
        );

        echo "   ✅ Email sent!\n";
        echo "      Resend ID: " . ($response['id'] ?? 'N/A') . "\n";
        echo "      Response: " . json_encode($response, JSON_PRETTY_PRINT) . "\n";
    }
} catch (\Throwable $e) {
    echo "   ❌ Error sending ticket email:\n";
    echo "      " . $e->getMessage() . "\n";
    echo "      File: " . $e->getFile() . ':' . $e->getLine() . "\n";
}
echo "\n";

echo "=== DIAGNOSTIC COMPLETE ===\n";
echo "Check your email inbox (and SPAM folder)!\n";
