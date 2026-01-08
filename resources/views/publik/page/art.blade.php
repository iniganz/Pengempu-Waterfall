@extends('publik.layout.index')

@section('content')
<main class="main">

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Portfolio</h2>
            <p>Check our Art Portfolio</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-aset">
                            <img src="{{ asset('storage/images/' . $product->image) }}" class="img-fluid" alt="{{ $product->title }}">
                            <div class="portfolio-info">
                                <h4>{{ $product->title }}</h4>
                                <p>{{ $product->description }}</p>
                                <a href="{{ asset('storage/images/' . $product->image) }}" title="{{ $product->title }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="{{ route('product.show', $product->slug) }}" title="More Details" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->
</main>
@endsection
