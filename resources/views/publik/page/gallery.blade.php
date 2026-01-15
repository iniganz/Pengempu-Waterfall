@extends('publik.layout.index')

@section('content')
    <!-- Pending Alert Modal -->
    @if(session('success') && session('pending_post_id'))
        <div class="modal fade show" id="pendingModal" tabindex="-1" role="dialog" aria-labelledby="pendingModalLabel" aria-modal="true" style="display: block; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-warning">
                    <div class="modal-header bg-warning text-dark border-warning">
                        <h5 class="modal-title" id="pendingModalLabel">⏳ Foto Menunggu Persetujuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <div style="font-size: 60px; margin-bottom: 15px;">📸</div>
                        <p class="fs-5 fw-bold text-dark">Terima Kasih, {{ session('pending_post_name') }}!</p>
                        <p class="text-muted">Foto Anda telah berhasil diupload.</p>
                        <hr>
                        <div class="alert alert-warning mb-3" role="alert">
                            <strong>Status:</strong> Menunggu Persetujuan Admin
                        </div>
                        <p class="small text-muted mb-2">📋 Tim kami sedang mereview foto Anda.</p>
                        <p class="small text-muted">Foto akan ditampilkan di gallery setelah mendapat persetujuan dari admin. Mohon bersabar! 🙏</p>
                        <hr>
                        <p class="text-success small"><strong>✓ Anda akan melihat foto Anda segera!</strong></p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-warning btn-lg" data-bs-dismiss="modal">Mengerti</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('pendingModal'));
                modal.show();

                // Auto-close after 6 seconds
                setTimeout(() => {
                    modal.hide();
                }, 6000);
            });
        </script>
    @endif

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
                        @php
                            // Handle: base64 from database, full URL, or local storage
                            if ($post->image_data) {
                                $imageUrl = $post->image_data; // base64 data URL
                            } elseif (filter_var($post->image_path, FILTER_VALIDATE_URL)) {
                                $imageUrl = $post->image_path; // Cloudinary or external URL
                            } else {
                                $imageUrl = asset('storage/' . $post->image_path); // local storage
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-gallery">
                            <img src="{{ $imageUrl }}" class="img-fluid" loading="lazy"
                                alt="{{ $post->caption ?? $post->name }}">
                            <div class="portfolio-info">
                                <h4>{{ $post->name }}</h4>
                                <p>{{ $post->caption }}</p>
                                <a href="{{ $imageUrl }}"
                                    title="{{ $post->caption ?? $post->name }}" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center"><em>Belum ada foto dari pengunjung.</em></div>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $galleryPosts->links('pagination::bootstrap-4') }}
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
