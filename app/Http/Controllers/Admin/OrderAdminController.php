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

            $conditionResult = (($mailMailer === 'resend') || $resendKey) ? 'WILL_USE_RESEND' : 'WILL_USE_LARAVEL_MAILER';
            error_log('[OrderAdmin] Conditional check: ' . $conditionResult);

            Log::info('Conditional check', [
                'MAIL_MAILER_value' => $mailMailer,
                'MAIL_MAILER_is_resend' => ($mailMailer === 'resend'),
                'RESEND_API_KEY_truthy' => $resendKey ? 'TRUE' : 'FALSE',
                'condition_result' => $conditionResult,
            ]);

            if ($mailMailer === 'resend' || $resendKey) {
                error_log('[OrderAdmin] INSIDE Resend branch - about to render view');
                Log::info('INSIDE Resend branch - about to render view');

                $html = View::make('mail.ticket', [
                    'order' => $order,
                    'ticket' => $ticket,
                    'qrUrl' => route('ticket.verify', $ticket->qr_token),
                ])->render();

                Log::info('View rendered, calling ResendMailer::send()');

                $res = ResendMailer::send(
                    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'onboarding@resend.dev')),
                    to: (string) $order->email,
                    subject: 'Tiket Resmi - ' . $order->order_id,
                    html: $html
                );

                Log::info('Admin resend ticket via Resend', ['order_id' => $order->order_id, 'to' => $order->email]);
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
