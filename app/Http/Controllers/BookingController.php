<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Product;
use App\Mail\TicketMail;
use Midtrans\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\SendTicketEmail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Show booking page
     */
    public function index(Product $product)
    {
        return view('publik.booking.index', compact('product'));
    }

    /**
     * Save booking data (before payment)
     */
    public function store(Request $request, Product $product)
    {
        $price = $product->price ?? 30000;

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'reserve_date' => 'required|date',
            'qty' => 'required|integer|min:1',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'Nomor HP wajib diisi',
            'reserve_date.required' => 'Tanggal reservasi wajib dipilih',
            'qty.min' => 'Minimal 1 tiket',
        ]);

        $data['total'] = $price * $data['qty'];

        session()->flash('booking_success', 'Data booking berhasil disimpan.');
        session()->forget('booking_ticket_sent');
        session()->put('booking_data', $data);

        // Simpan order pending ke database
        $order = Order::create([
            'order_id' => 'ORDER-' . now()->timestamp . '-' . random_int(1000, 9999),
            'product_id' => $product->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'reserve_date' => $data['reserve_date'],
            'qty' => $data['qty'],
            'total' => $data['total'],
            'payment_status' => 'pending',
        ]);

        session(['booking_order_id' => $order->order_id]);

        return redirect()->route('booking.payment', $product);
    }

    /**
     * Generate Midtrans Snap Token
     */
    public function snapToken(Request $request, Product $product)
    {
        $price = $product->price ?? 30000;

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'reserve_date' => 'required|date',
            'qty' => 'required|integer|min:1',
        ]);

        $grossAmount = $price * $data['qty'];

        // Midtrans config (server only)
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        Log::info('Midtrans snapToken config', [
            'server_key_prefix' => substr((string) Config::$serverKey, 0, 8),
            'is_production' => Config::$isProduction,
        ]);

        // PENTING: Gunakan order_id dari session yang sudah dibuat di store()
        // JANGAN buat order ID baru di sini!
        $orderId = session('booking_order_id');

        if (!$orderId) {
            return response()->json(['error' => 'Order ID tidak ditemukan. Silakan ulangi booking.'], 400);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => [[
                'id' => $product->id,
                'price' => $price,
                'quantity' => $data['qty'],
                'name' => $product->title ?? 'Ticket',
            ]],
            'customer_details' => [
                'first_name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ],
            'callbacks' => [
                'finish' => route('booking.finish', $product),
                'error' => route('booking.payment', $product),
                'pending' => route('booking.payment', $product),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['token' => $snapToken, 'order_id' => $orderId]);
        } catch (Exception $e) {
            Log::error('Midtrans snap token error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil snap token', 'detail' => $e->getMessage()], 500);
        }
    }


    /**
     * Show payment page with embedded Midtrans Snap.
     */
    public function payment(Request $request, Product $product)
    {
        $booking = session('booking_data');
        $orderCode = session('booking_order_id');

        // Validasi booking data lengkap
        if (!$booking || !$orderCode) {
            return view('errors.booking-incomplete');
        }

        // Cek apakah data booking valid (tidak kosong)
        if (empty($booking['name']) || empty($booking['email']) || empty($booking['phone'])) {
            return view('errors.booking-incomplete');
        }

        $order = Order::where('order_id', $orderCode)->first();

        if (!$order) {
            return view('errors.booking-incomplete');
        }

        $price = $product->price ?? 30000;
        $grossAmount = $order->total;

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        $orderId = $order->order_id;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
            ],
            'item_details' => [[
                'id' => $product->id,
                'price' => $price,
                'quantity' => $order->qty,
                'name' => $product->title,
            ]],
            'callbacks' => [
                'finish' => route('booking.finish', $product),
                'error' => route('booking.payment', $product),
                'pending' => route('booking.payment', $product),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans API Error', [
                'message' => $e->getMessage(),
                'order_id' => $orderId,
            ]);
            return view('errors.booking-incomplete');
        }

        $midSnapUrl = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';

        $midClientKey = config('services.midtrans.client_key');

        Log::info('Midtrans payment config', [
            'server_key_prefix' => substr((string) Config::$serverKey, 0, 8),
            'is_production' => Config::$isProduction,
            'snap_url' => $midSnapUrl,
        ]);

        return view('publik.booking.payment', compact(
            'product',
            'booking',
            'order',
            'snapToken',
            'orderId',
            'price',
            'midSnapUrl',
            'midClientKey'
        ));
    }



    /**
     * Finish page after successful payment.
     */
   /**
 * Finish page after successful payment.
 */
public function finish(Request $request, Product $product)
{
    $booking = session('booking_data');
    $orderId = session('booking_order_id');

    if (!$booking || !$orderId) {
        return redirect()->route('booking.show', $product)
            ->with('error', 'Transaksi tidak ditemukan. Silakan ulangi pemesanan.');
    }

    $order = Order::where('order_id', $orderId)
        ->with('ticket')
        ->first();

    if (!$order) {
        return redirect()->route('booking.show', $product)
            ->with('error', 'Order tidak ditemukan.');
    }

    // Jika masih pending → cek ke Midtrans
    if ($order->payment_status === 'pending') {
        try {
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');

            // Get transaction status from Midtrans
            // @phpstan-ignore-next-line
            $statusResponse = (array) Transaction::status($orderId);

            // ✅ FIX MERAH DI SINI
            if (
                isset($statusResponse['transaction_status']) &&
                $statusResponse['transaction_status'] === 'settlement'
            ) {
                // Update status pembayaran
                $order->update([
                    'payment_status' => 'settlement',
                ]);

                // Buat tiket jika belum ada
                if (!$order->ticket) {
                    $ticket = Ticket::create([
                        'order_id'   => $order->id, // FK ke orders.id
                        'ticket_code'=> 'TKT-' . strtoupper(Str::random(8)),
                        'qr_token'   => (string) Str::uuid(),
                    ]);

                    // Send email after response (non-blocking)
                    register_shutdown_function(function() use ($order, $ticket) {
                        try {
                            Mail::to($order->email)->send(
                                new TicketMail($order, $ticket)
                            );
                            Log::info('Ticket email sent successfully to: ' . $order->email);
                        } catch (\Exception $emailEx) {
                            Log::error('Failed to send ticket email: ' . $emailEx->getMessage());
                        }
                    });

                    Log::info('Ticket created and email scheduled: ' . $ticket->ticket_code);
                }

                $order = $order->fresh();
            }

        } catch (\Exception $e) {
            Log::error('Manual status check failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    return view('publik.booking.finish', compact(
        'product',
        'booking',
        'orderId',
        'order'
    ));
}

}

