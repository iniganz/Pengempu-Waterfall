<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
}
