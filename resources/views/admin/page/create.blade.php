@extends('admin.layout.index')

@section('content')
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
        <h1 class="h2">Create New Post</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/posts" enctype="multipart/form-data" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" required autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    required value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Catergory</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        @if (old('category_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                <trix-editor input="description"></trix-editor>
            </div>
            <div class="mb-3">
                <label for="feature" class="form-label">Feature</label>
                @error('feature')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input type="hidden" name="feature" id="feature" value="{{ old('feature') }}">
                <trix-editor input="feature"></trix-editor>
            </div>
            <div class="mb-3">
                <label for="aditional" class="form-label">Additional Information</label>
                @error('aditional')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input type="hidden" name="aditional" id="aditional" value="{{ old('aditional') }}">
                <trix-editor input="aditional"></trix-editor>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal Rilis</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                    value="{{ old('date') }}">
                @error('date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Platforms</label>
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($platforms as $platform)
                        <div class="form-check platform-item bg-light mb-2 me-3 mr-4 rounded border p-2"
                            style="min-width: 150px;">
                            <input class="form-check-input me-1" style="padding-right:" type="checkbox" name="platforms[]"
                                id="platform-{{ $platform->id }}" value="{{ $platform->id }}"
                                {{ is_array(old('platforms')) && in_array($platform->id, old('platforms')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="platform-{{ $platform->id }}">
                                {{ $platform->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('platforms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div id="preview-containerw" class="d-flex mt-3 flex-wrap gap-2"></div>
            </div>
            <div class="mb-3">
                <label for="gallery" class="form-label">Gallery Images</label>
                <input class="form-control @error('gallery') is-invalid @enderror @error('gallery.*') is-invalid @enderror"
                    type="file" id="gallery" name="gallery[]" multiple accept="image/*">

                @error('gallery')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                @error('gallery.*')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Preview Gambar -->
                <div id="preview-container" class="d-flex mt-3 flex-wrap gap-2"></div>
            </div>

            @if (old('old_image'))
                <div class="mb-2">
                    <img src="{{ asset('storage/' . old('old_image')) }}" alt="Old Image" style="max-height:120px;">
                    <input type="hidden" name="old_image" value="{{ old('old_image') }}">
                </div>
            @endif

            @if (old('old_gallery'))
                <div class="d-flex mb-2 gap-2">
                    @foreach (old('old_gallery') as $img)
                        <img src="{{ asset('storage/' . $img) }}" style="height:80px;">
                        <input type="hidden" name="old_gallery[]" value="{{ $img }}">
                    @endforeach
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
        title.addEventListener('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
            alert('File upload is not allowed');
        });

        // Preview untuk GALLERY
        const galleryInput = document.getElementById('gallery');
        const galleryPreviewContainer = document.getElementById('preview-container');
        let gallerySelectedFiles = [];

        galleryInput.addEventListener('change', function() {
            gallerySelectedFiles = Array.from(this.files);
            showGalleryPreviews();
        });

        function showGalleryPreviews() {
            galleryPreviewContainer.innerHTML = '';
            gallerySelectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "position-relative";
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="height:100px;border:1px solid #ccc;padding:2px;border-radius:8px;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" style="transform:translate(50%,-50%);" onclick="removeGalleryImage(${index})">×</button>
                        <button type="button" class="btn btn-primary btn-sm position-absolute bottom-0 start-0" style="transform:translate(-30%,-30%);" onclick="moveGalleryImageToFirst(${index})">&#8592;</button>
                    `;
                    galleryPreviewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            const dataTransfer = new DataTransfer();
            gallerySelectedFiles.forEach(file => dataTransfer.items.add(file));
            galleryInput.files = dataTransfer.files;
        }

        window.removeGalleryImage = function(index) {
            gallerySelectedFiles.splice(index, 1);
            showGalleryPreviews();
        }

        window.moveGalleryImageToFirst = function(index) {
            const file = gallerySelectedFiles.splice(index, 1)[0];
            gallerySelectedFiles.unshift(file);
            showGalleryPreviews();
        }

        // Preview & hapus untuk PRODUCT IMAGE (gambar utama)
        const imageInput = document.getElementById('image');
        const imagePreviewContainer = document.getElementById('preview-containerw');
        let imageSelectedFiles = [];

        imageInput.addEventListener('change', function() {
            imageSelectedFiles = Array.from(this.files);
            showImagePreviews();
        });

        function showImagePreviews() {
            imagePreviewContainer.innerHTML = '';
            imageSelectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "position-relative";
                    div.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="height:100px;border:1px solid #ccc;padding:2px;border-radius:8px;">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                    style="transform:translate(50%,-50%);" onclick="removeImageFile(${index})">×</button>
            `;
                    imagePreviewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            // Sinkronkan file input
            const dataTransfer = new DataTransfer();
            imageSelectedFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }

        window.removeImageFile = function(index) {
            imageSelectedFiles.splice(index, 1);
            showImagePreviews();
        }
    </script>
    {{-- <div class="mb-3">
                <label for="gallery" class="form-label">Gallery Images</label>
                <input class="form-control @error('gallery') is-invalid @enderror @error('gallery.*') is-invalid @enderror"
                    type="file" id="gallery" name="gallery[]" multiple>
                @error('gallery')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                @error('gallery.*')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
@endsection
