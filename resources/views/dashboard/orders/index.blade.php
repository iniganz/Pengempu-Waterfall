<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Manajemen Order
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-x-auto rounded-lg bg-white p-6 shadow">
                <form method="GET" class="mb-3">
                    <label>Filter: </label>
                    <select name="status" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status')==='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="settlement" {{ request('status')==='settlement' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </form>
                <table class="w-full text-sm">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2 text-left">Order ID</th>
                            <th class="py-2 text-left">Nama</th>
                            <th class="py-2 text-left">Tanggal</th>
                            <th class="py-2 text-left">Status</th>
                            <th class="py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b">
                                <td class="py-2 font-semibold">{{ $order->order_id }}</td>
                                <td class="py-2">{{ $order->name }}</td>
                                <td class="py-2">{{ $order->reserve_date }}</td>
                                <td class="py-2">
                                    @if ($order->payment_status == 'settlement')
                                        <span class="font-semibold text-green-600">Lunas</span>
                                    @else
                                        <span class="text-yellow-600">Pending</span>
                                    @endif
                                </td>
                                <td class="flex flex-wrap gap-2 py-2">
                                    <a href="{{ route('dashboard.orders.show', $order) }}" class="rounded bg-blue-600 px-3 py-1 text-xs text-white">View</a>
                                    @if($order->ticket)
                                        <a href="{{ route('ticket.verify', $order->ticket->qr_token) }}" target="_blank" class="rounded bg-green-600 px-3 py-1 text-xs text-white">QR</a>
                                    @endif
                                    <form method="POST" action="{{ route('dashboard.orders.destroy', $order) }}" style="display: inline;" onsubmit="return confirm('Hapus order ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded bg-red-600 px-3 py-1 text-xs text-white">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($orders->isEmpty())
                    <div class="mt-4 text-center text-gray-500">Belum ada order.</div>
                @endif
                <div class="mt-4">
                    {{ $orders->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
