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
                            <h2 class="text-success fw-bold mb-2">Tiket Valid! ✓</h2>
                            <p class="text-muted mb-4">Data tiket Anda telah terverifikasi</p>

                            <div class="alert alert-success border-0 mb-4">
                                <h5 class="mb-3">📋 Detail Tiket Anda</h5>
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
                                    <div class="mb-0">
                                        <small class="text-muted">Jumlah Tiket:</small>
                                        <div class="fw-bold">{{ $ticket->order->qty }} orang</div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info border-0">
                                <p class="mb-0"><small>Tunjukkan halaman ini kepada pengelola untuk proses entry 📱</small></p>
                            </div>

                        @elseif($status === 'used')
                            <div class="mb-4">
                                <i class="bi bi-exclamation-circle" style="font-size: 5rem; color: #f59e0b;"></i>
                            </div>
                            <h2 class="text-warning fw-bold mb-2">Tiket Sudah Digunakan</h2>
                            <p class="text-muted mb-4">Tiket ini telah dipakai sebelumnya</p>

                            <div class="alert alert-warning border-0">
                                <p class="mb-0"><strong>Digunakan pada:</strong> {{ $ticket->used_at->format('d-m-Y H:i') }}</p>
                                <p class="mb-0"><strong>Nama:</strong> {{ $ticket->order->name }}</p>
                            </div>

                        @elseif($status === 'unpaid')
                            <div class="mb-4">
                                <i class="bi bi-credit-card" style="font-size: 5rem; color: #ef4444;"></i>
                            </div>
                            <h2 class="text-danger fw-bold mb-2">Pembayaran Belum Dikonfirmasi</h2>
                            <p class="text-muted mb-4">Tiket tidak dapat digunakan</p>

                            <div class="alert alert-danger border-0">
                                <p class="mb-0">Status pembayaran: <strong>{{ $ticket->order->payment_status }}</strong></p>
                                <p class="mb-0">Silakan hubungi admin untuk verifikasi pembayaran</p>
                            </div>

                        @else
                            <div class="mb-4">
                                <i class="bi bi-x-circle" style="font-size: 5rem; color: #dc2626;"></i>
                            </div>
                            <h2 class="text-danger fw-bold mb-2">Tiket Tidak Valid</h2>
                            <p class="text-muted mb-4">{{ $message ?? 'Tiket tidak ditemukan dalam sistem' }}</p>

                            <div class="alert alert-danger border-0">
                                <p class="mb-0">Silakan hubungi admin untuk bantuan</p>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Beranda</a>
                            <a href="{{ route('contact') }}" class="btn btn-primary">Hubungi Admin</a>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="card mt-4 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">📱 Cara Scan QR Code:</h6>
                        <ul class="small mb-0">
                            <li>Buka <strong>Camera</strong> aplikasi bawaan HP Anda</li>
                            <li>Arahkan ke <strong>QR Code</strong> tiket</li>
                            <li>Tunggu hingga notifikasi muncul</li>
                            <li>Tap notifikasi untuk membuka halaman verifikasi</li>
                            <li>Halaman akan menampilkan status tiket Anda</li>
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
