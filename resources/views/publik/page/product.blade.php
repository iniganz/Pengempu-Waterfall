@extends('publik.layout.index')

@section('content')

    <section class="gallery-container">
        <div class="container">
            <div class="section-title-wrapper product-container cuypg">
                <h2 >{{ $product->title ?? 'Pengempu Waterfall' }}</h2>
                <p>Discover the beauty of nature</p>
            </div>

            <div class="product-section">
                @if ($product->images && $product->images->count() > 0)
                    @php
                        // Helper: determine image path (check if starts with 'images/' for public/images, else use storage)
                        $getImageUrl = function($imagePath) {
                            // Check if it's a full URL (http/https)
                            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                return $imagePath;
                            }
                            // Check if it starts with 'images/' (public folder)
                            if (strpos($imagePath, 'images/') === 0) {
                                return asset($imagePath);
                            }
                            // Otherwise use storage path
                            return asset('storage/' . $imagePath);
                        };
                    @endphp
                    <div class="gallery-layout">
                        <!-- Main Image Column -->
                        <div>
                            <div class="main-image-container">
                                <img id="mainImage" src="{{ $getImageUrl($product->images[0]->image_url) }}"
                                    alt="{{ $product->title }}" class="main-image">
                            </div>
                        </div>

                        <!-- Thumbnails and Info Column -->
                        <div>
                            <div class="thumbnails-container">
                                @forelse($product->images as $index => $image)
                                    <div class="thumb {{ $index === 0 ? 'active' : '' }}"
                                        data-image="{{ $getImageUrl($image->image_url) }}">
                                        <img src="{{ $getImageUrl($image->image_url) }}"
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
                        <h1>{{ $product->title }}</h1>
                        <p class="description">
                            {{ $product->description ?? 'A beautiful destination waiting to be explored.' }}</p>

                        <div class="price-box">
                            <div class="label">Starting Price</div>
                            <div class="price">IDR 30.000 <span style="font-size: 1rem; opacity: 0.8;"> / person</span>
                            </div>
                        </div>

                        @if ($product->feature)
                            <div class="features-box">
                                <h3>Highlights</h3>
                                <ul class="features-list">
                                    @foreach (explode(',', $product->feature) as $feature)
                                        <li>{{ trim($feature) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button class="booking-btn" onclick="window.location='{{ route('booking.show', $product) }}'">
                            <i class="bi bi-ticket-fill" style="font-size: 1.2rem;"></i>
                            Book Now
                        </button>


                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4681.103191795955!2d115.20089157575923!3d-8.46932968564576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd223428135bb67%3A0xbc9889d658b497a4!2sAir%20Terjun%20Pengempu!5e1!3m2!1sid!2sid!4v1766902537301!5m2!1sid!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" style="border:0;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
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

@endsection

@push('scripts')
    <script>
        (function() {
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
                () => setText('Tidak bisa mendapatkan lokasi Anda.'), {
                    enableHighAccuracy: true,
                    timeout: 8000
                }
            );
        })();
    </script>
@endpush
