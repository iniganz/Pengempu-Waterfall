@extends('publik.layout.index')

@section('content')
    <div class="container my-5">
        @if (session('booking_success'))
            <div class="alert alert-success">{{ session('booking_success') }}</div>
        @endif
        {{-- STEP PROGRESS --}}
        @include('publik.booking._steps')

        {{-- PRODUCT HEADER --}}
        <div class="row mb-3">
            <div class="col-md-8">
                <h3 class="fw-bold">{{ ($product->title ?? 'Air Terjun Pengempu') . ' Tiket' }}</h3>
                {{-- <p class="text-muted mb-0 d-flex align-items-center gap-1">
                <i class="bi bi-geo-alt text-danger"></i>
                <span>{{ $product->additional_info ?? 'Cau Blayu, Tabanan, Bali, Indonesia' }}</span>
            </p> --}}
            </div>
        </div>

        @php $price = $product->price ?? 30000; @endphp

        {{-- BOOKING & IDENTITY --}}
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('booking.store', $product) }}" id="booking-form">
                            @csrf
                            <input type="hidden" name="total" id="total-input" value="{{ $price }}">

                            <div class="d-flex align-items-start flex-wrap gap-3">
                                <div style="flex:1 1 260px;">
                                    <div class="fw-semibold">Person @error('qty')
                                            <span class="text-danger">*</span>
                                        @enderror
                                    </div>
                                    <div class="text-muted small">IDR {{ number_format($price, 0, ',', '.') }} / Ticket
                                    </div>
                                    <div class="d-flex align-items-center mt-2 gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            id="qty-dec">−</button>
                                        <input id="qty-input" name="qty" type="number" min="1"
                                            value="{{ old('qty', 1) }}"
                                            class="form-control form-control-sm @error('qty') is-invalid @enderror"
                                            style="max-width:80px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            id="qty-inc">+</button>
                                    </div>
                                    @error('qty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div style="flex:1 1 260px;">
                                    <label class="form-label fw-semibold">Reserve Date @error('reserve_date')
                                            <span class="text-danger">*</span>
                                        @enderror
                                    </label>
                                    <input type="date" id="reserve-date" name="reserve_date"
                                        class="form-control @error('reserve_date') is-invalid @enderror"
                                        value="{{ old('reserve_date', $product->date ?? now()->toDateString()) }}">
                                    @error('reserve_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="ms-auto text-end" style="min-width: 180px;">
                                    <div class="text-muted">Total</div>
                                    <div class="fs-4 fw-bold text-success" id="total-price">IDR
                                        {{ number_format($price, 0, ',', '.') }}</div>
                                    <button type="submit" class="btn btn-success w-100 mt-2"
                                        id="btn-continue">Continue</button>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Nama @error('name')
                                            <span class="text-danger">*</span>
                                        @enderror
                                    </label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email @error('email')
                                            <span class="text-danger">*</span>
                                        @enderror
                                    </label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="email@example.com" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No HP @error('phone')
                                            <span class="text-danger">*</span>
                                        @enderror
                                    </label>
                                    <input type="tel" id="phone" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxx"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="fw-semibold mb-2">Description</div>
                        <p class="text-muted small mb-3">
                            {{ $product->description ?? 'Pengempu Waterfall adalah destinasi alam yang tenang dan asri.' }}
                        </p>
                        <table class="table-sm mb-0 table">
                            <tr>
                                <th class="small">Reserve Date</th>
                                <td class="small" id="reserve-date-display">{{ $product->date ?? now()->toDateString() }}
                                </td>
                            </tr>
                            <tr>
                                <th class="small">Person</th>
                                <td class="small" id="person-display">1 Person</td>
                            </tr>
                            <tr>
                                <th class="small">Location</th>
                                <td class="small">Jl. Seribupati, Cau Belayu, Kec. Marga, Kabupaten Tabanan, Bali 82181
                                </td>
                            </tr>
                            <tr>
                                <th class="small">Duration</th>
                                <td class="small">Flexible / No Time Limit</td>
                            </tr>
                            <tr>
                                <th class="small">Minimum Order</th>
                                <td class="small">1 Person</td>
                            </tr>
                            <tr>
                                <th class="small">Available For</th>
                                <td class="small">Every Day</td>
                            </tr>
                        </table>

                        <div id="identity-summary" class="mt-3" style="display:none;">
                            <div class="fw-semibold mb-1">Detail Pengunjung</div>
                            <ul class="small mb-0" id="identity-list"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div id="confirm-overlay" class="confirm-overlay">
        <div class="confirm-card">
            <h5 class="fw-bold mb-3">Konfirmasi Booking</h5>
            <ul class="list-unstyled small mb-3" id="confirm-list"></ul>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary" id="confirm-cancel">Periksa lagi</button>
                <button type="button" class="btn btn-success" id="confirm-yes">Ya, kirim</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const basePrice = Number({{ $price }}) || 0;

            const qtyInput = document.getElementById('qty-input');
            const decBtn = document.getElementById('qty-dec');
            const incBtn = document.getElementById('qty-inc');
            const totalEl = document.getElementById('total-price');
            const totalInput = document.getElementById('total-input');
            const reserveInput = document.getElementById('reserve-date');
            const reserveDisplay = document.getElementById('reserve-date-display');
            const personDisplay = document.getElementById('person-display');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const identityBox = document.getElementById('identity-summary');
            const identityList = document.getElementById('identity-list');
            const form = document.getElementById('booking-form');
            const overlay = document.getElementById('confirm-overlay');
            const overlayList = document.getElementById('confirm-list');
            const overlayYes = document.getElementById('confirm-yes');
            const overlayCancel = document.getElementById('confirm-cancel');

            const formatIDR = (n) => `IDR ${n.toLocaleString('id-ID')}`;

            function clampQty(val) {
                const num = parseInt(val, 10);
                return Number.isFinite(num) && num > 0 ? num : 1;
            }

            function syncQtyTotal() {
                if (!qtyInput || !totalEl) return;
                const qty = clampQty(qtyInput.value);
                qtyInput.value = qty;
                const total = basePrice * qty;
                totalEl.textContent = formatIDR(total);
                if (totalInput) totalInput.value = total;
                if (personDisplay) personDisplay.textContent = qty + (qty > 1 ? ' Persons' : ' Person');
            }

            function syncReserveDisplay() {
                if (reserveDisplay && reserveInput) {
                    reserveDisplay.textContent = reserveInput.value || reserveDisplay.textContent;
                }
            }

            function updateIdentitySummary(async) {
                const nameVal = nameInput && nameInput.value ? nameInput.value.trim() : '';
                const emailVal = emailInput && emailInput.value ? emailInput.value.trim() : '';
                const phoneVal = phoneInput && phoneInput.value ? phoneInput.value.trim() : '';
                const allFilled = nameVal && emailVal && phoneVal;

                if (identityBox && identityList) {
                    if (allFilled) {
                        identityList.innerHTML = `
                        <li>Nama: ${nameVal}</li>
                        <li>Email: ${emailVal}</li>
                        <li>No HP: ${phoneVal}</li>
                    `;
                        identityBox.style.display = 'block';
                    } else {
                        identityBox.style.display = 'none';
                        identityList.innerHTML = '';
                    }
                }
                return allFilled;
            }

            if (decBtn && qtyInput) {
                decBtn.addEventListener('click', function() {
                    qtyInput.value = Math.max(1, clampQty(qtyInput.value) - 1);
                    syncQtyTotal();
                });
            }

            if (incBtn && qtyInput) {
                incBtn.addEventListener('click', function() {
                    qtyInput.value = clampQty(qtyInput.value) + 1;
                    syncQtyTotal();
                });
            }

            if (qtyInput) {
                qtyInput.addEventListener('input', syncQtyTotal);
            }
            if (nameInput) nameInput.addEventListener('input', updateIdentitySummary);
            if (emailInput) emailInput.addEventListener('input', updateIdentitySummary);
            if (phoneInput) phoneInput.addEventListener('input', updateIdentitySummary);

            syncQtyTotal();
            syncReserveDisplay();
            updateIdentitySummary();

            if (reserveInput) {
                reserveInput.addEventListener('change', syncReserveDisplay);
                reserveInput.addEventListener('input', syncReserveDisplay);
            }

            if (form) {
                form.addEventListener('submit', function(e) {

                    const qtyOk = qtyInput && parseInt(qtyInput.value, 10) >= 1;
                    const dateOk = reserveInput && reserveInput.value;
                    const nameOk = nameInput && nameInput.value.trim() !== '';
                    const emailOk = emailInput && emailInput.value.trim() !== '';
                    const phoneOk = phoneInput && phoneInput.value.trim() !== '';

                    const allValid = qtyOk && dateOk && nameOk && emailOk && phoneOk;

                    // ❌ JIKA BELUM VALID → BIARKAN LARAVEL BEKERJA
                    if (!allValid) {
                        // JANGAN preventDefault
                        return;
                    }

                    // ✅ JIKA SUDAH VALID → TAMPILKAN OVERLAY
                    if (overlay && overlayList && totalEl) {
                        e.preventDefault(); // tahan submit

                        overlayList.innerHTML = `
                <li><strong>Nama:</strong> ${nameInput.value}</li>
                <li><strong>Email:</strong> ${emailInput.value}</li>
                <li><strong>No HP:</strong> ${phoneInput.value}</li>
                <li><strong>Tanggal:</strong> ${reserveInput.value}</li>
                <li><strong>Qty:</strong> ${qtyInput.value}</li>
                <li><strong>Total:</strong> ${totalEl.textContent}</li>
            `;

                        overlay.style.display = 'flex';
                    }
                });
            }


            if (overlayCancel) {
                overlayCancel.addEventListener('click', function() {
                    if (overlay) overlay.style.display = 'none';
                });
            }

            if (overlayYes) {
                overlayYes.addEventListener('click', async function() {
                    if (overlay) overlay.style.display = 'none';

                    // Kirim form agar diarahkan ke halaman payment terpisah
                    if (form) form.submit();
                });
            }


        });
    </script>
@endpush
