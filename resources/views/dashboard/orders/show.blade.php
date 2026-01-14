<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detail Order - {{ $order->order_id }}
            </h2>
            <a href="{{ route('dashboard.orders.index') }}" class="rounded bg-gray-500 px-4 py-2 text-xs text-white hover:bg-gray-600">Kembali</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow mb-4">
                <div class="mb-4 flex justify-between items-start">
                    <div>
                        <div class="text-sm text-gray-600">Order ID</div>
                        <div class="text-2xl font-bold">{{ $order->order_id }}</div>
                    </div>
                    <div>
                        @if ($order->payment_status == 'settlement')
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded">LUNAS</span>
                        @else
                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded">PENDING</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                    <div>
                        <div class="text-xs text-gray-500">Nama</div>
                        <div class="font-semibold">{{ $order->name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Email</div>
                        <div>{{ $order->email }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Telepon</div>
                        <div>{{ $order->phone }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Tanggal Reservasi</div>
                        <div>{{ $order->reserve_date }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Produk</div>
                        <div>{{ $order->product->title ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Qty</div>
                        <div>{{ $order->qty }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Total</div>
                        <div class="font-bold text-green-600">IDR {{ number_format($order->total, 0, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Dibuat</div>
                        <div>{{ $order->created_at->format('d-m-Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <div class="mb-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Tiket</h3>
                    <div class="flex items-center gap-2">
                        @if ($order->payment_status == 'settlement')
                            <form method="POST" action="{{ route('dashboard.orders.resendTicket', $order) }}">
                                @csrf
                                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-xs text-white hover:bg-blue-700">
                                    Kirim Ulang Tiket
                                </button>
                            </form>
                        @endif

                    @if($order->ticket)
                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded">TERBIT</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded">BELUM TERBIT</span>
                    @endif
                    </div>
                </div>

                @if($order->ticket)
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <div class="text-xs text-gray-500">Ticket Code</div>
                            <div class="font-semibold">{{ $order->ticket->ticket_code }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">QR Token</div>
                            <div class="break-all text-sm font-mono">{{ $order->ticket->qr_token }}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('ticket.verify', $order->ticket->qr_token) }}" target="_blank" class="inline-block rounded bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">Lihat QR Ticket</a>
                    </div>
                @else
                    <p class="text-gray-600">Tiket akan terbit setelah pembayaran settlement.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
