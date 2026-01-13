@extends('publik.layout.index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5 text-center">
                        <!-- Status Icon & Badge -->
                        @if($status === 'valid')
                            <div class="mb-4">
                                <i class="bi bi-check-circle" style="font-size: 5rem; color: #16a34a;"></i>
                            </div>
                            <h2 class="text-success fw-bold mb-2">Tiket Berhasil Divalidasi ✓</h2>
                            <p class="text-muted mb-4">Tiket pengunjung telah dikonfirmasi dan dapat masuk</p>

                            <div class="alert alert-success border-0 mb-4">
                                <h5 class="mb-3">📋 Detail Validasi</h5>
                                <hr>
                                <div class="text-start">
                                    <div class="mb-2">
                                        <small class="text-muted">Nama Pengunjung:</small>
                                        <div class="fw-bold">{{ $ticket->order->name }}</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Kode Tiket:</small>
                                        <div class="fw-bold font-monospace">{{ $ticket->ticket_code }}</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Destinasi:</small>
                                        <div class="fw-bold">{{ $ticket->order->product->title ?? '-' }}</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Tanggal Kunjungan:</small>
                                        <div class="fw-bold">{{ \Carbon\Carbon::parse($ticket->order->reserve_date)->format('d F Y') }}</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Jumlah Tiket:</small>
                                        <div class="fw-bold">{{ $ticket->order->qty }} orang</div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info border-0 mb-0">
                                <div class="row text-start">
                                    <div class="col-6">
                                        <small class="text-muted">Divalidasi oleh:</small>
                                        <p class="mb-0 fw-bold">{{ $validator->name ?? 'Admin' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Waktu Validasi:</small>
                                        <p class="mb-0 fw-bold">{{ $ticket->validated_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                        @elseif($status === 'used')
                            <div class="mb-4">
                                <i class="bi bi-exclamation-circle" style="font-size: 5rem; color: #f59e0b;"></i>
                            </div>
                            <h2 class="text-warning fw-bold mb-2">Tiket Sudah Divalidasi</h2>
                            <p class="text-muted mb-4">Tiket ini telah divalidasi sebelumnya</p>

                            <div class="alert alert-warning border-0">
                                <h5 class="mb-3">📋 Detail Tiket</h5>
                                <div class="text-start">
                                    <div class="mb-2">
                                        <small class="text-muted">Nama Pengunjung:</small>
                                        <div class="fw-bold">{{ $ticket->order->name }}</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Kode Tiket:</small>
                                        <div class="fw-bold font-monospace">{{ $ticket->ticket_code }}</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Divalidasi oleh:</small>
                                        <div class="fw-bold">{{ $ticket->validator?->name ?? 'Admin' }}</div>
                                    </div>
                                    <div class="mb-0">
                                        <small class="text-muted">Waktu Validasi:</small>
                                        <div class="fw-bold">{{ $ticket->validated_at->format('d-m-Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>

                        @elseif($status === 'unpaid')
                            <div class="mb-4">
                                <i class="bi bi-credit-card" style="font-size: 5rem; color: #ef4444;"></i>
                            </div>
                            <h2 class="text-danger fw-bold mb-2">Pembayaran Belum Dikonfirmasi</h2>
                            <p class="text-muted mb-4">Tiket tidak dapat divalidasi</p>

                            <div class="alert alert-danger border-0">
                                <div class="text-start">
                                    <small class="text-muted">Status pembayaran:</small>
                                    <p class="fw-bold mb-2">{{ $ticket->order->payment_status }}</p>
                                    <small class="text-muted">Order ID:</small>
                                    <p class="fw-bold">{{ $ticket->order->order_id }}</p>
                                </div>
                            </div>

                        @else
                            <div class="mb-4">
                                <i class="bi bi-x-circle" style="font-size: 5rem; color: #dc2626;"></i>
                            </div>
                            <h2 class="text-danger fw-bold mb-2">Tiket Tidak Valid</h2>
                            <p class="text-muted mb-4">{{ $message ?? 'Tiket tidak ditemukan dalam sistem' }}</p>

                            <div class="alert alert-danger border-0">
                                <p class="mb-0">Periksa kembali kode QR atau hubungi support</p>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-secondary">Kembali ke Orders</a>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="card mt-4 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">🔐 Mode Validasi Pengelola</h6>
                        <ul class="small mb-0">
                            <li>Anda login sebagai <strong>{{ auth()->user()->name }}</strong></li>
                            <li>Tiket yang divalidasi akan <strong>TIDAK DAPAT</strong> divalidasi lagi</li>
                            <li>Sistem otomatis mencatat <strong>waktu</strong> dan <strong>siapa</strong> yang validasi</li>
                            <li>Pengunjung dapat melihat detail tiket tanpa perlu validasi</li>
                            <li>Hanya validasi dari pengelola yang mengubah status tiket</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bi {
            display: inline-block;
        }
    </style>
@endsection
