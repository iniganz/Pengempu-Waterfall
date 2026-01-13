@extends('publik.layout.index')

@section('content')
    <div class="container my-5">
        @include('publik.booking._steps')

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm {{ $order && $order->payment_status === 'settlement' ? 'border-success' : 'border-warning' }}">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            @if($order && $order->payment_status === 'settlement')
                                <span class="badge bg-success-subtle text-success border border-success px-3 py-2">
                                    Pembayaran Berhasil
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-2">
                                    Pembayaran Diproses
                                </span>
                            @endif
                        </div>
                        <h4 class="fw-bold mb-2">Terima kasih!</h4>
                        <p class="text-muted mb-3">Order ID: {{ $orderId }}</p>
                        <p class="mb-4">
                            @if($order && $order->payment_status === 'settlement')
                                Tiket akan dikirim ke email <strong>{{ $booking['email'] ?? '-' }}</strong>.
                                Mohon cek inbox atau folder spam Anda.
                            @else
                                Pembayaran Anda sedang diproses. Tiket akan dikirim ke email <strong>{{ $booking['email'] ?? '-' }}</strong>
                                setelah konfirmasi pembayaran.
                            @endif
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Beranda</a>
                            <a href="{{ route('contact') }}" class="btn btn-success">Butuh Bantuan?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
