@csrf

{{-- tailwindcss: disable conflicting-classes --}}
<div class="space-y-6">
    <!-- Nama Tempat -->
    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">
            Nama Tempat
        </label>
        <input type="text" id="name" name="name"
            class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('name') border-red-500 @else border-gray-300 @enderror"
            placeholder="Masukkan nama tempat..." value="{{ old('name', $place->name ?? '') }}">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Kategori -->
    <div>
        <label for="category" class="mb-2 block text-sm font-semibold text-gray-700">
            Kategori
        </label>
        <select name="category" id="category"
            class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('category') border-red-500 @else border-gray-300 @enderror">
            <option value="">-- Pilih Kategori --</option>
            <option value="wisata" {{ old('category', $place->category ?? '') === 'wisata' ? 'selected' : '' }}>🏞️
                Wisata</option>
            <option value="kuliner" {{ old('category', $place->category ?? '') === 'kuliner' ? 'selected' : '' }}>🍴
                Kuliner</option>
            <option value="umkm" {{ old('category', $place->category ?? '') === 'umkm' ? 'selected' : '' }}>🏪 UMKM
            </option>
        </select>
        @error('category')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Rating -->
    <div>
        <label for="rating" class="mb-2 block text-sm font-semibold text-gray-700">
            Rating (0-5)
        </label>
        <input type="number" id="rating" step="0.1" min="0" max="5" name="rating"
            class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('rating') border-red-500 @else border-gray-300 @enderror"
            placeholder="Contoh: 4.5" value="{{ old('rating', $place->rating ?? '') }}">
        @error('rating')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Alamat -->
    <div>
        <label for="address" class="mb-2 block text-sm font-semibold text-gray-700">
            Alamat
        </label>
        <input type="text" id="address" name="address"
            class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('address') border-red-500 @else border-gray-300 @enderror"
            placeholder="Masukkan alamat lengkap..." value="{{ old('address', $place->address ?? '') }}">
        @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Latitude & Longitude -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="lat" class="mb-2 block text-sm font-semibold text-gray-700">
                Latitude
            </label>
            <input type="text" id="lat" name="lat"
                class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('lat') border-red-500 @else border-gray-300 @enderror"
                placeholder="Contoh: -6.1234" value="{{ old('lat', $place->lat ?? '') }}">
            @error('lat')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="lng" class="mb-2 block text-sm font-semibold text-gray-700">
                Longitude
            </label>
            <input type="text" id="lng" name="lng"
                class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('lng') border-red-500 @else border-gray-300 @enderror"
                placeholder="Contoh: 106.1234" value="{{ old('lng', $place->lng ?? '') }}">
            @error('lng')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Deskripsi -->
    <div>
        <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">
            Deskripsi
        </label>
        <textarea name="description" id="description" rows="4"
            class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('description') border-red-500 @else border-gray-300 @enderror"
            placeholder="Tuliskan deskripsi lengkap tentang tempat ini...">{{ old('description', $place->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Gambar -->
    {{-- <div>
        <label for="image" class="mb-2 block text-sm font-semibold text-gray-700">
            Gambar
        </label>
        <div class="cursor-pointer rounded-lg border-2 border-dashed border-gray-300 p-6 text-center transition hover:border-blue-500"
            id="imageDropZone">
            <input type="file" id="image" name="image" class="hidden" accept="image/*">
            <div>
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path
                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-12l-3.172-3.172a4 4 0 00-5.656 0L28 28M12 28l-3.172-3.172a4 4 0 00-5.656 0L2 28m26-10l4 4m0 0l4 4m-4-4l-4 4m4-4l4-4"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <p class="mt-2 text-sm text-gray-600">
                    <span class="font-semibold text-blue-600 hover:text-blue-700">Click to upload</span> atau drag and
                    drop
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                <img id="imagePreview" class="mx-auto mt-4 hidden max-h-48 rounded-lg" />
            </div>
        </div>
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div> --}}

    <!-- Map Embed -->
    <div>
        <label for="map_embed" class="mb-2 block text-sm font-semibold text-gray-700">
            Embed Peta (Google Maps)
        </label>
        <textarea name="map_embed" id="map_embed" rows="3"
            class="w-full rounded-lg px-4 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 border @error('map_embed') border-red-500 @else border-gray-300 @enderror"
            placeholder="Paste embed code dari Google Maps...">{{ old('map_embed', $place->map_embed ?? '') }}</textarea>
        <p class="mt-1 text-xs text-gray-500">
            💡 Cara: Buka Google Maps → Share → Embed → Copy HTML → Paste di sini
        </p>
        @error('map_embed')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<script>
    // Handle image upload & preview
    const imageInput = document.getElementById('image');
    const imageDropZone = document.getElementById('imageDropZone');
    const imagePreview = document.getElementById('imagePreview');

    // Click to upload
    imageDropZone.addEventListener('click', () => imageInput.click());

    // Drag and drop
    imageDropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageDropZone.classList.add('border-blue-500', 'bg-blue-50');
    });

    imageDropZone.addEventListener('dragleave', () => {
        imageDropZone.classList.remove('border-blue-500', 'bg-blue-50');
    });

    imageDropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        imageDropZone.classList.remove('border-blue-500', 'bg-blue-50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            previewImage();
        }
    });

    // File input change
    imageInput.addEventListener('change', previewImage);

    function previewImage() {
        const file = imageInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>
