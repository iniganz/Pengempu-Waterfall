<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Mail\TicketMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Midtrans webhook received', [
            'order_id' => $request->order_id,
            'transaction_status' => $request->transaction_status,
        ]);

        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            Log::error('Order not found for webhook', ['order_id' => $request->order_id]);
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($request->transaction_status === 'settlement') {
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

                try {
                    Mail::to($order->email)->send(
                        new TicketMail($order, $ticket)
                    );
                    Log::info('Ticket email sent to: ' . $order->email);
                } catch (\Exception $e) {
                    Log::error('Failed to send ticket email: ' . $e->getMessage());
                }
            } else {
                Log::info('Ticket already exists for order: ' . $order->order_id);
            }
        }

        return response()->json(['ok' => true]);
    }
}

