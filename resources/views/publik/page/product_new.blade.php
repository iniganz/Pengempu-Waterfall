@extends('publik.layout.index')

@section('content')

<section id="product" class="product section py-5">
  <div class="container section-title" data-aos="fade-up">
    <p class="cuypg text-center">Check our Gallery</p>
  </div>

  <div class="container product-container">
    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

      <!-- Left: Main image + thumbnails (Desktop) -->
      <div class="col-lg-8">
        <!-- Main Image -->
        <div class="card mb-3 rounded-lg overflow-hidden bg-gray-200">
          <img id="mainImage"
               src="{{ $product->images->isNotEmpty() ? asset('storage/' . $product->images[0]->image_url) : asset('assets/img/placeholder.png') }}"
               class="img-fluid w-100" alt="{{ $product->title }}">
        </div>

        <!-- Desktop: Thumbnails Grid (max 5) -->
        <div id="thumbnails-desktop" class="d-none d-lg-flex gap-2 flex-wrap">
          @foreach($product->images->take(5) as $index => $image)
            <img src="{{ asset('storage/' . $image->image_url) }}"
                 data-full="{{ asset('storage/' . $image->image_url) }}"
                 class="thumb-desktop img-thumbnail {{ $index === 0 ? 'active' : '' }}"
                 style="width:120px; height:80px; object-fit:cover; cursor:pointer; transition: transform 0.2s; border: 2px solid {{ $index === 0 ? '#198754' : '#dee2e6' }};"
                 alt="thumb-{{ $index }}"
                 onclick="changeMainImage(this)">
          @endforeach
        </div>

        <!-- Mobile: Horizontal Scroll Gallery -->
        <div id="gallery-mobile" class="d-lg-none overflow-auto pb-3" style="scroll-behavior: smooth;">
          <div class="d-flex gap-2" style="min-width: min-content;">
            @foreach($product->images as $index => $image)
              <img src="{{ asset('storage/' . $image->image_url) }}"
                   class="gallery-slide {{ $index === 0 ? 'active' : '' }}"
                   style="width: 280px; height: 280px; object-fit: cover; border-radius: 8px; cursor: pointer; transition: opacity 0.2s; flex-shrink: 0;"
                   alt="slide-{{ $index }}"
                   onclick="scrollToImage({{ $index }})">
            @endforeach
          </div>
          <p class="text-muted text-center mt-2" style="font-size: 0.875rem;">← {{ __('Scroll to see more') }} →</p>
        </div>
      </div>

      <!-- Right: Info, price, location -->
      <div class="col-lg-4">
        <h3 class="mb-2">{{ $product->title }}</h3>
        <p class="text-muted">{{ $product->description }}</p>

        <!-- Features -->
        @if($product->feature)
          <div class="mb-3 p-3 rounded" style="background:#e6f7ee;">
            <strong>{{ __('Features') }}</strong>
            <p class="mt-2 mb-0">{{ $product->feature }}</p>
          </div>
        @endif

        <!-- Price Section -->
        <div class="mb-3 p-3 rounded" style="background:#e6f7ee;">
          <strong>{{ __('Price') }}</strong>
          <div class="mt-2">IDR 30k / person (Adult and Child same price)</div>
        </div>

        <!-- Booking Button -->
        <button class="btn btn-success btn-lg mb-3 w-100 d-flex align-items-center justify-content-center gap-2">
          <i class="bi bi-ticket-fill"></i>
          {{ __('Booking') }}
        </button>

        <!-- Location Map -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ __('Location') }}</h5>
            <div class="ratio ratio-16x9">
              <iframe
                src="https://www.google.com/maps?q={{ urlencode('https://maps.app.goo.gl/BzWPqgWxfoSErGYo8') }}&output=embed"
                style="border:0;"
                allowfullscreen="" loading="lazy"></iframe>
            </div>
            <p class="mt-2 small">
              <a href="https://maps.app.goo.gl/BzWPqgWxfoSErGYo8" target="_blank" rel="noopener">
                {{ __('Open in Google Maps') }}
              </a>
            </p>
          </div>
        </div>

        <!-- Additional Info -->
        @if($product->additional_info)
          <div class="mt-4 p-3 rounded bg-light">
            <strong>{{ __('Additional Information') }}</strong>
            <p class="mt-2 mb-0">{{ $product->additional_info }}</p>
          </div>
        @endif
      </div>

    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
  /* Desktop Thumbnails */
  .thumb-desktop {
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .thumb-desktop:hover {
    transform: scale(1.08);
    border-color: #198754 !important;
  }

  .thumb-desktop.active {
    border-color: #198754 !important;
    box-shadow: 0 0 8px rgba(25, 135, 84, 0.5);
  }

  /* Mobile Gallery Slides */
  .gallery-slide {
    opacity: 0.6;
    transition: opacity 0.3s ease;
  }

  .gallery-slide.active {
    opacity: 1;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
  }

  /* Main Image */
  #mainImage {
    transition: opacity 0.3s ease;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .card {
      margin-bottom: 1.5rem;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  // Desktop: Change main image when clicking thumbnail
  function changeMainImage(thumbnail) {
    const mainImg = document.getElementById('mainImage');
    const fullImageUrl = thumbnail.dataset.full;

    if (fullImageUrl) {
      mainImg.style.opacity = '0.5';
      mainImg.src = fullImageUrl;

      setTimeout(() => {
        mainImg.style.opacity = '1';
      }, 150);

      // Update active state
      document.querySelectorAll('.thumb-desktop').forEach(thumb => {
        thumb.classList.remove('active');
        thumb.style.borderColor = '#dee2e6';
      });
      thumbnail.classList.add('active');
      thumbnail.style.borderColor = '#198754';
    }
  }

  // Mobile: Scroll to specific image
  function scrollToImage(index) {
    const gallery = document.getElementById('gallery-mobile');
    const slides = gallery.querySelectorAll('.gallery-slide');

    if (slides[index]) {
      slides[index].scrollIntoView({
        behavior: 'smooth',
        block: 'nearest',
        inline: 'center'
      });

      // Update active state
      slides.forEach((slide, i) => {
        if (i === index) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });
    }
  }

  // Initialize on load
  document.addEventListener('DOMContentLoaded', function() {
    // Desktop: Set initial active state
    const thumbs = document.querySelectorAll('.thumb-desktop');
    if (thumbs.length > 0) {
      thumbs[0].classList.add('active');
    }

    // Mobile: Set initial active state
    const slides = document.querySelectorAll('.gallery-slide');
    if (slides.length > 0) {
      slides[0].classList.add('active');
    }
  });
</script>
@endpush
