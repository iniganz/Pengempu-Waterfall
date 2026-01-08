@extends('publik.layout.index')

@section('content')
<style>
    .gallery-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 40px 0;
        display: flex;
        align-items: center;
    }

    .product-section {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    /* Desktop Gallery Layout */
    .gallery-layout {
        display: grid;
        grid-template-columns: 1fr 0.4fr;
        gap: 30px;
        padding: 40px;
    }

    /* Main Image */
    .main-image-container {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
        position: relative;
    }

    #mainImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease;
    }

    /* Thumbnails Grid */
    .thumbnails-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .thumb {
        aspect-ratio: 1;
        border-radius: 8px;
        cursor: pointer;
        overflow: hidden;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        background: #f0f0f0;
    }

    .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .thumb:hover img {
        transform: scale(1.05);
    }

    .thumb.active {
        border-color: #667eea;
        box-shadow: 0 0 15px rgba(102, 126, 234, 0.5);
    }

    /* Info Section */
    .info-section {
        padding: 40px;
        background: #fff;
        border-radius: 15px;
    }

    .info-section h1 {
        color: #333;
        font-size: 2rem;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .info-section .description {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .price-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .price-box .label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 8px;
    }

    .price-box .price {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .features-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .features-box h3 {
        color: #333;
        font-size: 1.1rem;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .features-list li {
        color: #555;
        padding: 8px 0;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .features-list li:before {
        content: "✓";
        color: #667eea;
        font-weight: bold;
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .booking-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .booking-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .map-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .map-container iframe {
        width: 100%;
        height: 400px;
        border: none;
        border-radius: 10px;
    }

    .map-link {
        margin-top: 10px;
        text-align: center;
    }

    .map-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .map-link a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    /* Mobile Layout */
    @media (max-width: 768px) {
        .gallery-layout {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px;
        }

        .thumbnails-container {
            grid-template-columns: repeat(3, 1fr);
            max-height: none;
        }

        .main-image-container {
            aspect-ratio: 1.2;
        }

        .info-section {
            padding: 25px;
        }

        .info-section h1 {
            font-size: 1.5rem;
        }

        .features-box {
            padding: 15px;
        }

        .features-list li {
            font-size: 0.9rem;
        }

        .map-container iframe {
            height: 300px;
        }
    }

    @media (max-width: 480px) {
        .gallery-container {
            padding: 20px 0;
        }

        .gallery-layout {
            padding: 15px;
            gap: 15px;
        }

        .info-section {
            padding: 15px;
        }

        .info-section h1 {
            font-size: 1.3rem;
        }

        .thumbnails-container {
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        .price-box .price {
            font-size: 1.5rem;
        }

        .booking-btn {
            padding: 12px 20px;
            font-size: 1rem;
        }

        .map-container iframe {
            height: 250px;
        }
    }

    /* Scrollbar styling */
    .thumbnails-container::-webkit-scrollbar {
        width: 6px;
    }

    .thumbnails-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .thumbnails-container::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 10px;
    }

    .thumbnails-container::-webkit-scrollbar-thumb:hover {
        background: #764ba2;
    }

    /* Loading state */
    .no-images {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .no-images p {
        font-size: 1.1rem;
        margin: 0;
    }

    /* Section Title */
    .section-title-wrapper {
        text-align: center;
        margin-bottom: 40px;
        color: white;
    }

    .section-title-wrapper h2 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .section-title-wrapper p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
</style>

<section class="gallery-container">
    <div class="container">
        <div class="section-title-wrapper">
            <h2>{{ $product->title ?? 'Pengempu Waterfall' }}</h2>
            <p>Discover the beauty of nature</p>
        </div>

        <div class="product-section">
            @if($product->images && $product->images->count() > 0)
                <div class="gallery-layout">
                    <!-- Main Image Column -->
                    <div>
                        <div class="main-image-container">
                            <img id="mainImage"
                                 src="{{ asset('storage/' . $product->images[0]->image_url) }}"
                                 alt="{{ $product->title }}"
                                 class="main-image">
                        </div>
                    </div>

                    <!-- Thumbnails and Info Column -->
                    <div>
                        <div class="thumbnails-container">
                            @forelse($product->images as $index => $image)
                                <div class="thumb {{ $index === 0 ? 'active' : '' }}"
                                     data-image="{{ asset('storage/' . $image->image_url) }}">
                                    <img src="{{ asset('storage/' . $image->image_url) }}"
                                         alt="Thumbnail {{ $index + 1 }}"
                                         loading="lazy">
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
                    <p class="description">{{ $product->description ?? 'A beautiful destination waiting to be explored.' }}</p>

                    <div class="price-box">
                        <div class="label">Starting Price</div>
                        <div class="price">IDR 30.000 <span style="font-size: 1rem; opacity: 0.8;"> / person</span></div>
                    </div>

                    @if($product->feature)
                        <div class="features-box">
                            <h3>Highlights</h3>
                            <ul class="features-list">
                                @foreach(explode(',', $product->feature) as $feature)
                                    <li>{{ trim($feature) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button class="booking-btn" onclick="handleBooking()">
                        <i class="bi bi-ticket-fill" style="font-size: 1.2rem;"></i>
                        Book Now
                    </button>

                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8207547829335!2d110.37926!3d-7.6450000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a147b7b7b7b7b%3A0x7b7b7b7b7b7b7b7b!2sNgebul%20Waterfall!5e0!3m2!1sen!2sid!4v1000000000000"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="map-link">
                        <a href="https://maps.google.com/maps?q=pengempu+waterfall" target="_blank" rel="noopener">
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
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        const thumbs = document.querySelectorAll('.thumb');

        if (mainImage && thumbs.length > 0) {
            thumbs.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const imageUrl = this.dataset.image;
                    if (imageUrl) {
                        mainImage.src = imageUrl;
                        mainImage.style.opacity = '0';

                        setTimeout(() => {
                            mainImage.style.opacity = '1';
                        }, 50);

                        thumbs.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
        }
    });

    function handleBooking() {
        alert('Booking feature coming soon! Contact us for more information.');
        // You can replace this with actual booking route
        // window.location.href = '{{ route("booking.form") }}';
    }
</script>

<style>
    #mainImage {
        transition: opacity 0.3s ease;
    }
</style>
@endpush
