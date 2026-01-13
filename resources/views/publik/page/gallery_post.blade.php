@extends('publik.layout.index')

@section('content')
    <div class="testimonials container py-5">
        @if(session('success'))
            <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center mb-4">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger text-center mb-4">
                <ul class="mb-0" style="list-style:none;padding-left:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Section Title -->
        <div class="section-title container" data-aos="fade-up">
            <p class="cuypy text-center" style="font-size: 20px;">Post Your Experience at Pengempu Waterfall</p>
        </div><!-- End Section Title -->

        <!-- Gallery Post Form Container -->
        <div class="gallery-form-container" data-aos="fade-up">
            <form action="{{ route('gallery-post.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm" class="gallery-form-card">
                @csrf

                <!-- Form Title -->
                <div class="form-header">
                    <p class="form-title">📸 BAGIKAN PENGALAMAN ANDA</p>
                </div>

                <!-- Form Body -->
                <div class="form-body">
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Nama Anda</label>
                        <input
                            type="text"
                            class="form-control form-input"
                            id="name"
                            name="name"
                            required
                            maxlength="100"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama Anda"
                        >
                    </div>

                    <!-- Caption Field -->
                    <div class="mb-4">
                        <label for="caption" class="form-label fw-bold">Caption (opsional)</label>
                        <input
                            type="text"
                            class="form-control form-input"
                            id="caption"
                            name="caption"
                            maxlength="255"
                            value="{{ old('caption') }}"
                            placeholder="Berikan judul untuk foto Anda"
                        >
                    </div>

                    <!-- Photo Field -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">📷 Pilih Foto</label>
                        <div class="file-input-wrapper">
                            <input
                                type="file"
                                class="form-control form-input"
                                id="image"
                                name="image"
                                accept="image/*"
                                required
                            >
                            <small class="text-muted d-block mt-2">
                                ✓ Format: JPEG, PNG, JPG, GIF, WebP<br>
                                ✓ Ukuran maksimal: 2MB
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button
                            type="submit"
                            class="btn btn-upload fw-bold"
                            id="submitBtn"
                        >
                            🚀 UPLOAD FOTO
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Info Section -->
        <div class="gallery-info-section mt-5">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-icon">✅</div>
                        <h5>Mudah</h5>
                        <p>Upload foto dalam beberapa detik</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-icon">⭐</div>
                        <h5>Dipilih</h5>
                        <p>Foto terbaik ditampilkan di gallery</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <div class="info-icon">🎁</div>
                        <h5>Hadiah</h5>
                        <p>Kesempatan menang hadiah menarik</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('galleryForm').addEventListener('submit', function(e) {
            console.log('Form submitted!');
            console.log('Form action:', this.action);
            console.log('Has file:', document.getElementById('image').files.length > 0);
            console.log('File name:', document.getElementById('image').files[0]?.name);
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').textContent = '⏳ Mengupload...';
        });

        // Preview file name when selected
        document.getElementById('image').addEventListener('change', function(e) {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
                console.log(`File selected: ${fileName} (${fileSize}MB)`);
            }
        });
    </script>
@endsection

