@extends('publik.layout.index')

@section('content')
    <style>
        .booking-steps {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            margin: 16px 0;
        }

        .step-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .step-item.done {
            color: #1e90ff;
        }

        .step-badge {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            border: 1px solid currentColor;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .booking-card {
            margin-top: 18px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .booking-row {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 18px;
            align-items: center;
        }

        .booking-row .box {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px 16px;
            background: #fafafa;
        }

        .qty-control {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid #d1d5db;
            background: #fff;
            display: grid;
            place-items: center;
            cursor: pointer;
        }

        .total-card {
            border-radius: 12px;
            padding: 16px;
            background: #f0f9ff;
            border: 1px solid #e0f2fe;
            text-align: center;
        }

        .total-card .price {
            font-size: 1.35rem;
            font-weight: 700;
            color: #111827;
        }

        .summary-table {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 12px;
        }

        .summary-table table {
            width: 100%;
            margin: 0;
        }

        .summary-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        .summary-table tr:last-child td {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .booking-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="gallery-container">
        <div class="container ">
            <div class="section-title-wrapper product-container cuypg">
                <h2 style="color: white !important;">{{ $product->title ?? 'Pengempu Waterfall' }}</h2>
                <p>Discover the beauty of nature</p>
            </div>

            <div class="product-section">
                @if ($product->images && $product->images->count() > 0)
                    <div class="gallery-layout">
                        <!-- Main Image Column -->
                        <div>
                            <div class="main-image-container">
                                <img id="mainImage" src="{{ asset('storage/' . $product->images[0]->image_url) }}"
                                    alt="{{ $product->title }}" class="main-image">
                            </div>
                        </div>

                        <!-- Thumbnails and Info Column -->
                        <div>
                            <div class="thumbnails-container">
                                @forelse($product->images as $index => $image)
                                    <div class="thumb {{ $index === 0 ? 'active' : '' }}"
                                        data-image="{{ asset('storage/' . $image->image_url) }}">
                                        <img src="{{ asset('storage/' . $image->image_url) }}"
                                            alt="Thumbnail {{ $index + 1 }}" loading="lazy">
                                    </div>
                                @empty
                                    <div class="no-images">
                                        <p>No images available</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="info-section">
                        <div class="booking-steps">
                            <div class="step-item done">
                                <span class="step-badge">1</span>
                                Product List
                            </div>
                            <div class="step-item done">
                                <span class="step-badge">2</span>
                                Product Detail
                            </div>
                            <div class="step-item">
                                <span class="step-badge">3</span>
                                Shopping Cart
                            </div>
                            <div class="step-item">
                                <span class="step-badge">4</span>
                                Booking Detail
                            </div>
                            <div class="step-item">
                                <span class="step-badge">5</span>
                                Payment
                            </div>
                            <div class="step-item">
                                <span class="step-badge">6</span>
                                Finish
                            </div>
                        </div>

                        <h1>{{ $product->title }}</h1>
                        <p class="description">
                            {{ $product->description ?? 'A beautiful destination waiting to be explored.' }}</p>

                        <div class="booking-card" data-price="30000">
                            <div class="booking-row">
                                <div class="box">
                                    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
                                        <div>
                                            <div style="font-weight:700;">Person</div>
                                            <div style="color:#6b7280;font-size:0.9rem;">IDR 30.000 / Ticket</div>
                                        </div>
                                        <div class="qty-control">
                                            <button type="button" class="qty-btn" id="qty-dec">-</button>
                                            <input id="qty-input" type="number" min="1" value="1" style="width:60px;text-align:center;border:1px solid #d1d5db;border-radius:8px;padding:6px 8px;" />
                                            <button type="button" class="qty-btn" id="qty-inc">+</button>
                                        </div>
                                    </div>

                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;gap:12px;flex-wrap:wrap;">
                                        <div>
                                            <div style="font-weight:700;">Reserve Date</div>
                                            <input type="date" id="reserve-date" class="form-control" style="max-width: 220px;" value="{{ $product->date ?? now()->toDateString() }}">
                                        </div>
                                        <div>
                                            <div style="font-weight:700;">Our Location</div>
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <i class="bi bi-geo-alt" style="color:#ef4444;"></i>
                                                <span>{{ $product->additional_info ?? 'Cau Blayu,Tabanan,Bali' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="total-card">
                                    <div style="color:#6b7280;font-weight:600;">Total</div>
                                    <div class="price" id="total-price">IDR 30.000</div>
                                    <button class="btn btn-success w-100" style="margin-top:10px;">Book Now</button>
                                </div>
                            </div>
                        </div>

                        @if ($product->feature)
                            <div class="features-box" style="margin-top:18px;">
                                <h3>Highlights</h3>
                                <ul class="features-list">
                                    @foreach (explode(',', $product->feature) as $feature)
                                        <li>{{ trim($feature) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4681.103191795955!2d115.20089157575923!3d-8.46932968564576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd223428135bb67%3A0xbc9889d658b497a4!2sAir%20Terjun%20Pengempu!5e1!3m2!1sid!2sid!4v1766902537301!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div id="distance-box" class="distance-box" data-lat="-8.4693297" data-lng="115.2008916"
                            style="margin-top: 16px; padding: 12px; background: #f7f7f7; border-radius: 8px;">
                            <strong>Jarak Anda ke lokasi:</strong>
                            <span id="distance-value">Menghitung...</span>
                        </div>

                        <div class="map-link">
                            <a href="https://maps.app.goo.gl/ZyYr8FFmCTpqRQuD8" target="_blank" rel="noopener">
                                📍 Open in Google Maps
                            </a>
                        </div>
                    </div>
                @else
                    <div style="text-align: center; padding: 60px 20px;">
                        <p style="font-size: 1.2rem; color: #999;">No product information available</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="container" style="margin-top: 32px;">
        <div class="booking-card">
            <h4 style="margin-bottom:10px; display:flex; align-items:center; gap:8px;">
                <i class="bi bi-list" style="font-size: 1.1rem;"></i>
                Description
            </h4>
            <p style="margin-bottom: 12px; color:#4b5563; line-height:1.6;">
                {{ $product->description ?? 'Pengempu Waterfall is a serene destination with lush greenery and a refreshing atmosphere.' }}
            </p>

            <div class="summary-table">
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td style="width:30%; font-weight:600;">Reserve Date</td>
                            <td>{{ $product->date ?? now()->toDateString() }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:600;">Location</td>
                            <td>{{ $product->additional_info ?? 'Cau Blayu,Tabanan,Bali' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:600;">Duration</td>
                            <td>{{ $product->aditional ?? '15 Menit' }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight:600;">Minimum Order</td>
                            <td>1 Person</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    (function () {
        const box = document.getElementById('distance-box');
        if (!box) return;

        const targetLat = parseFloat(box.dataset.lat);
        const targetLng = parseFloat(box.dataset.lng);
        const valueEl = document.getElementById('distance-value');

        function haversine(lat1, lon1, lat2, lon2) {
            const R = 6371; // km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) ** 2;
            return (R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))).toFixed(2);
        }

        function setText(text) {
            if (valueEl) valueEl.textContent = text;
        }

        if (!navigator.geolocation) {
            setText('Geolocation tidak didukung browser Anda.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const d = haversine(pos.coords.latitude, pos.coords.longitude, targetLat, targetLng);
                setText(`${d} km dari Anda`);
            },
            () => setText('Tidak bisa mendapatkan lokasi Anda.'),
            { enableHighAccuracy: true, timeout: 8000 }
        );
    })();

    // Booking qty & total calculator
    (function () {
        const card = document.querySelector('.booking-card[data-price]');
        if (!card) return;

        const basePrice = parseInt(card.dataset.price, 10) || 0;
        const qtyInput = document.getElementById('qty-input');
        const decBtn = document.getElementById('qty-dec');
        const incBtn = document.getElementById('qty-inc');
        const totalEl = document.getElementById('total-price');

        const formatIDR = (n) => `IDR ${n.toLocaleString('id-ID')}`;

        function clampQty(val) {
            const num = parseInt(val, 10);
            return Number.isFinite(num) && num > 0 ? num : 1;
        }

        function updateTotal() {
            const qty = clampQty(qtyInput.value);
            qtyInput.value = qty;
            const total = basePrice * qty;
            totalEl.textContent = formatIDR(total);
        }

        decBtn?.addEventListener('click', () => {
            qtyInput.value = Math.max(1, clampQty(qtyInput.value) - 1);
            updateTotal();
        });

        incBtn?.addEventListener('click', () => {
            qtyInput.value = clampQty(qtyInput.value) + 1;
            updateTotal();
        });

        qtyInput?.addEventListener('input', updateTotal);

        updateTotal();
    })();
</script>
@endpush
