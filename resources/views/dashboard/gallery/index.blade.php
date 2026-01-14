<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Gallery Management - Pengempu Waterfall') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">

            @if(app()->environment('production') && config('filesystems.default') === 'local')
            <!-- Warning for Production -->
            <div class="mb-6 rounded-lg border-l-4 border-yellow-500 bg-yellow-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                            ⚠️ Production Storage Warning
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Railway menggunakan <strong>ephemeral filesystem</strong>. Upload gambar akan <strong>hilang saat restart/redeploy</strong>.</p>
                            <p class="mt-1"><strong>Rekomendasi:</strong> Gunakan cloud storage (S3/Cloudinary) atau Railway Volume untuk file upload permanen.</p>
                            <p class="mt-1 text-xs">Lihat <code>RAILWAY_DEPLOYMENT.md</code> untuk setup cloud storage.</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Upload Section -->
            <div class="mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">{{ __('Upload New Image') }}</h3>

                    <form action="{{ route('admin.gallery.upload') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf

                        <div>
                            <label for="image" class="mb-2 block text-sm font-medium text-gray-700">
                                {{ __('Select Image') }} (Max 3MB)
                            </label>
                            <input type="file" name="image" id="image" accept="image/*" required
                                class="@error('image') border-red-500 @enderror w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">
                                {{ __('Supported formats: JPEG, PNG, JPG, GIF, WebP') }}
                            </p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="rounded-md bg-blue-600 px-6 py-2 font-semibold text-white transition hover:bg-blue-700">
                            {{ __('Upload Image') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Current Gallery -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">
                        {{ __('Current Gallery') }} ({{ $product->images->count() }} {{ __('images') }})
                    </h3>

                    @if ($product->images->isNotEmpty())
                        <!-- Desktop View: Grid -->
                        <div class="hidden gap-4 md:grid md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($product->images as $index => $image)
                                <div class="group relative aspect-square overflow-hidden rounded-lg bg-gray-200">
                                    <img src="{{ asset('storage/' . $image->image_url) }}"
                                        alt="Image {{ $index + 1 }}" class="h-full w-full object-cover">

                                    <!-- Overlay on hover -->
                                    <div
                                        class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-black bg-opacity-50 opacity-0 transition group-hover:opacity-100">
                                        @if ($index !== 0)
                                            <form action="{{ route('admin.gallery.setMain', $image) }}" method="POST"
                                                class="w-full px-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="w-full rounded bg-yellow-600 px-3 py-2 text-xs font-semibold text-white hover:bg-yellow-700">
                                                    {{ __('Set as Main') }}
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="rounded bg-green-600 px-3 py-2 text-xs font-semibold text-white">
                                                {{ __('Main Image') }}
                                            </span>
                                        @endif

                                        @if ($product->images->count() > 1)
                                            <form action="{{ route('admin.gallery.delete', $image) }}" method="POST"
                                                class="w-full px-2"
                                                onsubmit="return confirm('{{ __('Delete this image?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full rounded bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="rounded bg-gray-600 px-3 py-2 text-xs font-semibold text-white">
                                                {{ __('Cannot delete last image') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Mobile View: Horizontal Scroll -->
                        <div class="overflow-x-auto pb-4 md:hidden gallery-scroll-container">
                            <div class="flex gap-4" style="min-width: min-content; -webkit-overflow-scrolling: touch;">
                                @foreach ($product->images as $index => $image)
                                    <div class="group relative flex-shrink-0 overflow-hidden rounded-lg bg-gray-200"
                                        style="width: 200px; height: 200px;">
                                        <img src="{{ asset('storage/' . $image->image_url) }}"
                                            alt="Image {{ $index + 1 }}" class="h-full w-full object-cover">

                                        <!-- Overlay on tap/hover -->
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-black bg-opacity-50 p-2 opacity-0 transition group-hover:opacity-100 group-active:opacity-100">
                                            @if ($index !== 0)
                                                <form action="{{ route('admin.gallery.setMain', $image) }}"
                                                    method="POST" class="w-full">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="w-full rounded bg-yellow-600 px-2 py-1 text-xs font-semibold text-white hover:bg-yellow-700">
                                                        {{ __('Main') }}
                                                    </button>
                                                </form>
                                            @else
                                                <span
                                                    class="rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white">
                                                    {{ __('Main') }}
                                                </span>
                                            @endif

                                            @if ($product->images->count() > 1)
                                                <form action="{{ route('admin.gallery.delete', $image) }}"
                                                    method="POST" class="w-full"
                                                    onsubmit="return confirm('{{ __('Delete?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white hover:bg-red-700">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">← {{ __('Scroll to see more') }} →</p>
                        </div>
                    @else
                        <div class="py-8 text-center text-gray-500">
                            <p>{{ __('No images yet. Upload your first image above.') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Image Preview Info -->
            <div class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-4">
                <h4 class="mb-2 font-semibold text-blue-900">ℹ️ {{ __('Image Display Info') }}</h4>
                <ul class="space-y-1 text-sm text-blue-800">
                    <li>✓ {{ __('Desktop: Main image + 5 thumbnails') }}</li>
                    <li>✓ {{ __('Mobile: Horizontal scroll gallery') }}</li>
                    <li>✓ {{ __('First image is set as main/hero image') }}</li>
                    <li>✓ {{ __('Click/tap thumbnails to change main image') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .gallery-scroll-container {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: #3b82f6 #f3f4f6;
        }

        .gallery-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        .gallery-scroll-container::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 10px;
        }

        .gallery-scroll-container::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6 0%, #1e40af 100%);
            border-radius: 10px;
        }

        .gallery-scroll-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
        }
    </style>
</x-app-layout>
