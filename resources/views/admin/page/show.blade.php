 @extends('admin.layout.index')

 @section('content')
  <link rel="stylesheet" href="{{ asset('css/detail2.css') }}">


    <main id="main" class="main mb-5">
        <!-- Product Detail Section -->
        <section id="product-detail " class="product-detail">
            <div class="container" data-aos="fade-up">

                <div class="back-button">
                    <a href="/dashboard/posts" class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square"> Back to Portfolio</i></a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square"> Edit</i></a>
                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                        @method('delete')
                            @csrf
                            <button class="btn btn-outline-dark" onclick="return confirm('Kamu yakin?')"><i class="fa-solid fa-circle-xmark"> Delete</i></button>
                    </form>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="product-gallery">
                            <img id="main-product-image" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded thumbnail" data-aos="zoom-in">
                            <div class="product-thumbnails" id="product-thumbnails">
                                @foreach($post->images as $image)
                                    <div class="thumbnail-wrapper">
                                        <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail" alt="Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-info detail-box">
                            <h1>{{ $post->title }}</h1>
                            <p class="text-light">{{ $post->category->name }}</p>
                            <div class="product-description" style="text-align: justify !important;">
                                <p class="produk-int" >{!! $post->description !!}</p>
                            </div>
                            <div class="product-features" style="text-align: justify !important;">
                                <h4>Features</h4>
                                <p class="produk-int" >{!! $post->feature !!}</p>
                            </div>
                            {{-- <div class="product-features">
                                <ul>
                                    @foreach($post->features as $feature)
                                        <li>{{ $feature->feature }}</li>
                                    @endforeach
                                </ul>
                            </div> --}}
                            <div class="product-meta">
                                <p><strong>Release Date:</strong> {{ $post->date }}</p>
                                <p><strong>Platform:</strong> {{ $post->platforms->pluck('name')->join(', ') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="product-additional-info detail-box" >
                            <h3>Additional Information</h3>
                            <p class="produk-int" >{!! $post->aditional !!}</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <script src="{{ asset('js/portfolio-detail.js') }}"></script>
    <script src="{{ asset('js/klikgambar.js') }}"></script>
 @endsection
