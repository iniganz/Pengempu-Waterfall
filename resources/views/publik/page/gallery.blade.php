@extends('publik.layout.index')

@section('content')
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
        <!-- Section Title -->

        <div class="section-title container" data-aos="fade-up">
            <!-- <h2>Services</h2> -->
            <p class="cuypy text-center">Gallery Pengunjung</p>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                <form method="GET" class="mb-3">
                    <label>Urutkan: </label>
                    <select name="filter" onchange="this.form.submit()">
                        <option value="latest" {{ $filter == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ $filter == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @forelse($galleryPosts as $post)
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-gallery">
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid"
                                alt="{{ $post->caption ?? $post->name }}">
                            <div class="portfolio-info">
                                <h4>{{ $post->name }}</h4>
                                <p>{{ $post->caption }}</p>
                                <a href="{{ asset('storage/' . $post->image_path) }}"
                                    title="{{ $post->caption ?? $post->name }}" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center"><em>Belum ada foto dari pengunjung.</em></div>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $galleryPosts->links() }}
                </div>
            </div>
        </div>
        <div class="p-portfolio" data-aos="fade-up">
                <a href="/post-foto">
                    <p>Post Your Experience!</p>
                </a>
            </div>
        <div class="gallery-video-container container">
            <div class="card bg-dark mt-6 p-4 text-white" data-aos="fade-up" data-aos-delay="200">
                <video src="/images/video-gallery.mp4" autoplay controls class="card-img-top opacity-75"
                    style="width: 100%; height: 750px;"></video>
                {{-- <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" allowfullscreen></iframe>

                </div> --}}

            </div>
        </div>


    </section><!-- /Portfolio Section -->
@endsection
