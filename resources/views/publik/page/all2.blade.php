{{-- @dd($products) --}}

@extends('publik.layout.index')


@section('content')
    <main class="main">

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="section-title container" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>Check our Portfolio</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-pc">PC & Console</li>
                        <li data-filter=".filter-hp">Mobile Games</li>
                        <li data-filter=".filter-aset">Game Assets</li>
                    </ul><!-- End Portfolio Filters -->
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        @foreach ($products as $product)
                            @php
                                // Tentukan kelas filter berdasarkan kategori
                                $filterClass = '';
                                if (str_contains(strtolower($product->category->slug), 'pc')) {
                                    $filterClass = 'filter-pc';
                                } elseif (str_contains(strtolower($product->category->slug), 'mobile')) {
                                    $filterClass = 'filter-hp';
                                } elseif (str_contains(strtolower($product->category->slug), 'art')) {
                                    $filterClass = 'filter-aset';
                                }
                            @endphp

                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ $filterClass }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                                <div class="portfolio-info">
                                    <h4>{{ $product->title }}</h4>
                                    <p>{{ $product->category->name }}</p>
                                    <a href="{{ asset('storage/' . $product->image) }}" title="{{ $product->title }}"
                                        data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="{{ route('product.show', $product->slug) }}" title="More Details" class="details-link">
                                        <i class="bi bi-link-45deg"></i>
                                    </a>
                                </div>
                            </div><!-- End Portfolio Item -->
                        @endforeach

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->
    </main>
@endsection


