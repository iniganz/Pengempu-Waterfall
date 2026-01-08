@extends('publik.layout.index')


@section('content')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">

    <main id="main" class="main">

        <!-- ======= Product Detail Section ======= -->
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
                            <img id="main-product-image" src="" alt="" class="img-fluid rounded"
                                data-aos="zoom-in">
                            <div class="product-thumbnails" id="product-thumbnails">
                                <!-- Thumbnails will be added by JavaScript -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-info">
                            <h1 id="product-title">Product Title</h1>
                            <p class="text-muted" id="product-category">Category</p>
                            <div class="product-description">
                                <p id="product-description" class="produk-int">Loading product details...</p>
                            </div>
                            <div class="product-features">
                                <h4>Features</h4>
                                <ul id="product-features">
                                    <!-- Features will be added by JavaScript -->
                                    {{-- <p id="product-deskripsi">Loading feature details...</p> --}}
                                </ul>
                            </div>
                            <div class="product-meta">
                                <p><strong>Release Date:</strong> <span id="product-date">Not specified</span></p>
                                <p><strong>Platform:</strong> <span id="product-platform">Multiple</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="product-additional-info">
                            <h3>Additional Information</h3>
                            <div id="product-additional-info">
                                <!-- Additional info will be added by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Product Detail Section -->
    </main>

        <script src="{{ asset('js/portfolio-detail.js') }}"></script>
    @endsection
