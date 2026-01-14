<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Mail\TicketMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Services\ResendMailer;

class MidtransController extends Controller
{
    public function handle(Request $request)
    {
        // Get Midtrans webhook data
        $orderId = $request->input('order_id');
        $transactionStatus = $request->input('transaction_status');

        Log::info('Midtrans webhook received', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
        ]);

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            Log::error('Order not found for webhook', ['order_id' => $orderId]);
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($transactionStatus === 'settlement') {
            Log::info('Processing settlement for order: ' . $order->order_id);

            $order->update(['payment_status' => 'settlement']);

            // Buat tiket SEKALI SAJA
            if (!$order->ticket) {
                $ticket = Ticket::create([
                    'order_id'   => $order->id,
                    'ticket_code'=> 'TKT-' . strtoupper(Str::random(8)),
                    'qr_token'   => Str::uuid(),
                ]);

                Log::info('Ticket created', ['ticket_code' => $ticket->ticket_code]);

                // Send ticket email (prefer Resend API in production)
                try {
                    Log::info('MidtransController: About to send ticket email', [
                        'order_id' => $order->order_id,
                        'email' => $order->email,
                        'MAIL_MAILER' => env('MAIL_MAILER'),
                        'RESEND_API_KEY_exists' => env('RESEND_API_KEY') ? 'YES' : 'NO',
                    ]);

                    if (env('MAIL_MAILER') === 'resend' || env('RESEND_API_KEY')) {
                        Log::info('MidtransController: Using Resend branch');

                        $html = View::make('mail.ticket', [
                            'order' => $order,
                            'ticket' => $ticket,
                        ])->render();

                        Log::info('MidtransController: View rendered, calling ResendMailer');

                        // TEMPORARY FIX: Resend free account only sends to pengempuw@gmail.com
                        $recipientEmail = env('APP_ENV') === 'production' ? 'pengempuw@gmail.com' : (string) $order->email;
                        
                        Log::warning('Resend limitation: sending to verified email only', [
                            'original_recipient' => $order->email,
                            'actual_recipient' => $recipientEmail,
                        ]);

                        ResendMailer::send(
                            from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'onboarding@resend.dev')),
                            to: $recipientEmail,
                            subject: 'Tiket Anda - Pengempu Waterfall (untuk: ' . $order->email . ')',
                            html: $html
                        );
                        Log::info('Ticket email sent via Resend', ['to' => $recipientEmail, 'order_id' => $order->order_id]);
                    } else {
                        Log::info('MidtransController: Using Laravel mailer fallback');
                        Mail::to($order->email)->send(new TicketMail($order, $ticket));
                        Log::info('Ticket email dispatched via Laravel mailer to: ' . $order->email);
                    }
                } catch (\Throwable $e) {
                    Log::error('Failed to send ticket email', [
                        'order_id' => $order->order_id,
                        'to' => $order->email,
                        'error' => $e->getMessage(),
                    ]);
                }
            } else {
                Log::info('Ticket already exists for order: ' . $order->order_id);
            }
        }

        return response()->json(['ok' => true]);
    }
}

