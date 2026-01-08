@extends('publik.layout.index')

@section('content')
    {{-- <link rel="stylesheet" href="{{ asset('css/detail.css') }}">    --}}
    <link rel="stylesheet" href="{{ asset('css/detail2.css') }}">


    <main id="main" class="main">
        <!-- Product Detail Section -->
        <section id="product-detail" class="product-detail">
            <div class="container" data-aos="fade-up">

                <div class="back-button">
                    <a href="javascript:history.back()" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Back to Portfolio
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="product-gallery">
                            <img id="main-product-image" src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->title }}" class="img-fluid thumbnail rounded" data-aos="zoom-in">
                            <div class="product-thumbnails" id="product-thumbnails">
                                @foreach ($product->images as $image)
                                    <div class="thumbnail-wrapper">
                                        <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail"
                                            alt="Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-info">
                            <h1>{{ $product->title }}</h1>
                            <p class="text-muted">{{ $product->category->name }}</p>
                            <div class="product-description" style="text-align: justify;">
                                <p class="produk-int justify-normal">{!! $product->description !!}</p>
                            </div>
                            <div class="product-features" style="text-align: justify !important;">
                                <h4>Features</h4>
                                <p class="produk-int">{!! $product->feature !!}</p>
                            </div>
                            <div class="product-meta">
                                <p><strong>Release Date:</strong> {{ $product->date }}</p>
                                <p><strong>Platform:</strong> {{ $product->platforms->pluck('name')->join(', ') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="product-additional-info">
                            <h3>Additional Information</h3>
                            <p class="produk-int">{!! $product->aditional !!}</p>
                        </div>
                    </div>
                </div>

            </div>
           
        </section>
    </main>

    <script src="{{ asset('js/portfolio-detail.js') }}"></script>
    <script src="{{ asset('js/klikgambar.js') }}"></script>
    @endsection
