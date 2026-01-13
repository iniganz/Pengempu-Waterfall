@extends('publik.layout.index')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="text-center py-5">
                    <!-- Icon / Illustration -->
                    <div style="font-size: 120px; color: #ff6b6b; margin-bottom: 20px;">
                        ⚠️
                    </div>

                    <h1 class="display-5 fw-bold mb-3" style="color: #333;">
                        Oops! Booking Incomplete
                    </h1>

                    <p class="lead text-muted mb-4">
                        Sepertinya Anda mencoba mengakses halaman pembayaran tanpa mengisi data booking terlebih dahulu.
                    </p>

                    <div class="alert alert-warning" role="alert">
                        <strong>Apa yang perlu Anda lakukan:</strong>
                        <ul class="mb-0 mt-2 text-start">
                            <li>✓ Isi data lengkap (Nama, Email, No HP)</li>
                            <li>✓ Pilih tanggal dan jumlah tiket</li>
                            <li>✓ Lanjutkan ke pembayaran</li>
                        </ul>
                    </div>

                    <!-- Button -->
                    <div class="mt-5">
                        <a href="{{ route('product') }}" class="btn btn-primary btn-lg me-2">
                            <i class="bi bi-arrow-left"></i> Kembali ke Booking
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg mt-2 mt-md-0">
                            Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-5 p-4" style="background: #f8f9fa; border-radius: 8px;">
                        <p class="text-muted small mb-0">
                            Jika Anda merasa ini adalah kesalahan, silakan hubungi tim support kami di
                            <strong>{{ config('app.support_email', 'pengempuw@gmail.com') }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
