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
use App\Services\SendGridMailer;
use App\Services\BrevoMailer;

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
                        'SENDGRID_API_KEY_exists' => env('SENDGRID_API_KEY') ? 'YES' : 'NO',
                    ]);

                    $mailMailer = env('MAIL_MAILER');
                    $resendKey = env('RESEND_API_KEY');
                    $sendGridKey = env('SENDGRID_API_KEY');
                    $brevoKey = env('BREVO_API_KEY');
                    $useBrevo = ($mailMailer === 'brevo' && $brevoKey);
                    $useSendGrid = ($mailMailer === 'sendgrid' && $sendGridKey);
                    $useResend = ($mailMailer === 'resend' && $resendKey);
                    $useSmtp = ($mailMailer === 'smtp' || $mailMailer === 'gmail');

                    Log::info('MidtransController: Email dispatch decision', [
                        'MAIL_MAILER_value' => $mailMailer,
                        'useBrevo' => $useBrevo,
                        'useSendGrid' => $useSendGrid,
                        'useResend' => $useResend,
                        'useSmtp' => $useSmtp,
                    ]);

                    if ($useBrevo) {
                        Log::info('MidtransController: Using Brevo branch');

                        $html = View::make('mail.ticket', [
                            'order' => $order,
                            'ticket' => $ticket,
                        ])->render();

                        BrevoMailer::send(
                            from: sprintf('%s <%s>', (string) config('mail.from.name', 'Pengempu Waterfall'), (string) config('mail.from.address', 'pengempuw@gmail.com')),
                            to: $order->email,
                            subject: 'Tiket Anda - Pengempu Waterfall',
                            html: $html
                        );

                        Log::info('Ticket email sent via Brevo', ['to' => $order->email, 'order_id' => $order->order_id]);
                    } elseif ($useSendGrid) {
                        Log::info('MidtransController: Using SendGrid branch');

                        $html = View::make('mail.ticket', [
                            'order' => $order,
                            'ticket' => $ticket,
                        ])->render();

                        Log::info('MidtransController: View rendered, calling SendGridMailer');

                        SendGridMailer::send(
                            from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'pengempuw@gmail.com')),
                            to: $order->email,
                            subject: 'Tiket Anda - Pengempu Waterfall',
                            html: $html
                        );

                        Log::info('Ticket email sent via SendGrid', ['to' => $order->email, 'order_id' => $order->order_id]);
                    } elseif ($useResend) {
                        Log::info('MidtransController: Using Resend branch');

                        $html = View::make('mail.ticket', [
                            'order' => $order,
                            'ticket' => $ticket,
                        ])->render();

                        // Resend free tier: kirim ke admin, lalu forward ke customer
                        $adminEmail = 'pengempuw@gmail.com';
                        $customerEmail = (string) $order->email;

                        $forwardInfo = '<div style="background:#fff3cd;padding:15px;margin-bottom:20px;border:1px solid #ffc107;border-radius:5px;">';
                        $forwardInfo .= '<strong>⚠️ FORWARD EMAIL INI KE CUSTOMER:</strong><br>';
                        $forwardInfo .= 'Email Customer: <strong>' . $customerEmail . '</strong><br>';
                        $forwardInfo .= 'Order ID: ' . $order->order_id . '<br>';
                        $forwardInfo .= '<small>(Hapus kotak kuning ini sebelum forward)</small>';
                        $forwardInfo .= '</div>';

                        Log::info('MidtransController: View rendered, calling ResendMailer');

                        ResendMailer::send(
                            from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'onboarding@resend.dev')),
                            to: $adminEmail,
                            subject: '[FORWARD KE: ' . $customerEmail . '] Tiket - ' . $order->order_id,
                            html: $forwardInfo . $html
                        );
                        Log::info('Ticket email sent via Resend to admin for forwarding', ['admin' => $adminEmail, 'customer' => $customerEmail, 'order_id' => $order->order_id]);
                    } elseif ($useSmtp) {
                        Log::info('MidtransController: Using SMTP mailer');
                        Mail::to($order->email)->send(new TicketMail($order, $ticket));
                        Log::info('Ticket email dispatched via Laravel mailer to: ' . $order->email);
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

