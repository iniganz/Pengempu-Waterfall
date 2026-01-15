<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TicketMail;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Services\ResendMailer;
use App\Services\SendGridMailer;
use App\Services\BrevoMailer;

class OrderAdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $orders = Order::with(['product', 'ticket'])
            ->when($status, fn ($q) => $q->where('payment_status', $status))
            ->latest()
            ->paginate(12);

        return view('dashboard.orders.index', compact('orders', 'status'));
    }

    public function show(Order $order)
    {
        $order->load(['product', 'ticket']);

        return view('dashboard.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('dashboard.orders.index')
            ->with('success', 'Order berhasil dihapus.');
    }

    public function resendTicket(Order $order)
    {
        $order->load(['product', 'ticket']);

        if (! $order->email) {
            return back()->with('error', 'Email customer kosong.');
        }

        try {
            // Ensure ticket exists
            $ticket = $order->ticket;
            if (! $ticket) {
                $ticket = Ticket::create([
                    'order_id' => $order->id,
                    'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
                    'qr_token' => (string) Str::uuid(),
                ]);
                $order->setRelation('ticket', $ticket);
                Log::info('Ticket created in resendTicket', ['ticket_code' => $ticket->ticket_code]);
            }

            // DEBUG: Log environment variables
            error_log('[OrderAdmin] BEFORE email send - MAIL_MAILER: ' . env('MAIL_MAILER') . ', RESEND_API_KEY exists: ' . (env('RESEND_API_KEY') ? 'YES' : 'NO'));

            Log::info('BEFORE email send - checking environment', [
                'MAIL_MAILER' => env('MAIL_MAILER'),
                'RESEND_API_KEY_exists' => env('RESEND_API_KEY') ? 'YES' : 'NO',
                'config_mail_from' => config('mail.from.address'),
                'order_email' => $order->email,
            ]);

            // Send using the same design (TicketMail / mail.ticket), only transport differs.
            $mailMailer = env('MAIL_MAILER');
            $resendKey = env('RESEND_API_KEY');
            $sendGridKey = env('SENDGRID_API_KEY');
            $brevoKey = env('BREVO_API_KEY');

            // Determine which email service to use
            $useSmtp = ($mailMailer === 'smtp' || $mailMailer === 'gmail');
            $useResend = ($mailMailer === 'resend' && $resendKey);
            $useSendGrid = ($mailMailer === 'sendgrid' && $sendGridKey);
            $useBrevo = ($mailMailer === 'brevo' && $brevoKey);

            $conditionResult = $useBrevo
                ? 'WILL_USE_BREVO'
                : ($useSendGrid
                    ? 'WILL_USE_SENDGRID'
                    : ($useSmtp ? 'WILL_USE_GMAIL_SMTP' : ($useResend ? 'WILL_USE_RESEND' : 'WILL_USE_DEFAULT_MAILER')));
            error_log('[OrderAdmin] Conditional check: ' . $conditionResult);

            Log::info('Conditional check', [
                'MAIL_MAILER_value' => $mailMailer,
                'useBrevo' => $useBrevo,
                'useSendGrid' => $useSendGrid,
                'useSmtp' => $useSmtp,
                'useResend' => $useResend,
                'condition_result' => $conditionResult,
            ]);

            // Send email based on mailer config
            if ($useBrevo) {
                Log::info('Using Brevo API');

                $html = View::make('mail.ticket', [
                    'order' => $order,
                    'ticket' => $ticket,
                    'qrUrl' => route('ticket.verify', $ticket->qr_token),
                ])->render();

                BrevoMailer::send(
                    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Pengempu Waterfall'), (string) config('mail.from.address', 'pengempuw@gmail.com')),
                    to: $order->email,
                    subject: 'Tiket Resmi - ' . $order->order_id,
                    html: $html
                );

                Log::info('Admin resend ticket sent via Brevo', ['order_id' => $order->order_id, 'to' => $order->email]);
                $resendId = null;
            } elseif ($useSendGrid) {
                Log::info('Using SendGrid API');

                $html = View::make('mail.ticket', [
                    'order' => $order,
                    'ticket' => $ticket,
                    'qrUrl' => route('ticket.verify', $ticket->qr_token),
                ])->render();

                SendGridMailer::send(
                    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'pengempuw@gmail.com')),
                    to: $order->email,
                    subject: 'Tiket Resmi - ' . $order->order_id,
                    html: $html
                );

                Log::info('Admin resend ticket sent via SendGrid', ['order_id' => $order->order_id, 'to' => $order->email]);
                $resendId = null;
            } elseif ($useSmtp) {
                Log::info('Using Gmail SMTP (sync mode)');

                Mail::to($order->email)->send(new TicketMail($order, $ticket));

                Log::info('Admin resend ticket sent via Gmail SMTP', ['order_id' => $order->order_id, 'to' => $order->email]);
                $resendId = null;
            } elseif ($useResend) {
                error_log('[OrderAdmin] INSIDE Resend branch - about to render view');
                Log::info('INSIDE Resend branch - about to render view');

                $html = View::make('mail.ticket', [
                    'order' => $order,
                    'ticket' => $ticket,
                    'qrUrl' => route('ticket.verify', $ticket->qr_token),
                ])->render();

                Log::info('View rendered, calling ResendMailer::send()');

                // Resend free tier: kirim ke pengempuw@gmail.com, lalu forward manual ke customer
                $adminEmail = 'pengempuw@gmail.com';
                $customerEmail = (string) $order->email;

                // Tambahkan info customer di awal HTML untuk memudahkan forward
                $forwardInfo = '<div style="background:#fff3cd;padding:15px;margin-bottom:20px;border:1px solid #ffc107;border-radius:5px;">';
                $forwardInfo .= '<strong>⚠️ FORWARD EMAIL INI KE CUSTOMER:</strong><br>';
                $forwardInfo .= 'Email Customer: <strong>' . $customerEmail . '</strong><br>';
                $forwardInfo .= 'Order ID: ' . $order->order_id . '<br>';
                $forwardInfo .= '<small>(Hapus kotak kuning ini sebelum forward)</small>';
                $forwardInfo .= '</div>';

                $htmlWithForwardInfo = $forwardInfo . $html;

                Log::info('Sending ticket to admin email for forwarding', [
                    'admin_email' => $adminEmail,
                    'customer_email' => $customerEmail,
                ]);

                $res = ResendMailer::send(
                    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'onboarding@resend.dev')),
                    to: $adminEmail,
                    subject: '[FORWARD KE: ' . $customerEmail . '] Tiket Resmi - ' . $order->order_id,
                    html: $htmlWithForwardInfo
                );

                Log::info('Admin resend ticket via Resend', ['order_id' => $order->order_id, 'admin_email' => $adminEmail, 'customer_email' => $customerEmail]);
                $resendId = $res['id'] ?? null;
            } else {
                Log::info('INSIDE Laravel mailer branch (fallback)');
                Mail::to($order->email)->send(new TicketMail($order, $ticket));
                Log::info('Admin resend ticket via Laravel mailer', ['order_id' => $order->order_id, 'to' => $order->email]);
                $resendId = null;
            }

            $msg = 'Tiket berhasil diproses untuk dikirim ke email: ' . $order->email;
            if (!empty($resendId)) {
                $msg .= ' (Resend id: ' . $resendId . ')';
            }

            return back()->with('success', $msg);
        } catch (\Throwable $e) {
            Log::error('Admin resend ticket failed', ['order_id' => $order->order_id, 'to' => $order->email, 'error' => $e->getMessage()]);
            return back()->with('error', 'Gagal kirim ulang tiket: ' . $e->getMessage());
        }
    }
}
