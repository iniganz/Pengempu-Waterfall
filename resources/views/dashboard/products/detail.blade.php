<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Product Detail') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">{{ $product->title }}</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                ← {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Left: Images -->
                        <div class="lg:col-span-2">
                            <!-- Main Image -->
                            <div class="mb-4 rounded-lg overflow-hidden bg-gray-200">
                                <img id="mainImage"
                                     src="{{ $product->images->isNotEmpty() ? asset('storage/' . $product->images[0]->image_url) : asset('assets/img/placeholder.png') }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-96 object-cover">
                            </div>

                            <!-- Thumbnails -->
                            @if($product->images->isNotEmpty())
                                <div class="flex gap-2 flex-wrap">
                                    @foreach($product->images as $index => $image)
                                        <img src="{{ asset('storage/' . $image->image_url) }}"
                                             data-full="{{ asset('storage/' . $image->image_url) }}"
                                             class="thumb cursor-pointer rounded h-20 w-24 object-cover transition hover:scale-105 border-2 {{ $index === 0 ? 'border-green-500' : 'border-gray-300' }}"
                                             alt="thumb-{{ $index }}">
                                    @endforeach
                                </div>
                            @endif

                            <!-- Description -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Description') }}</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                            </div>

                            <!-- Features -->
                            @if($product->feature)
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Features') }}</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $product->feature }}</p>
                                </div>
                            @endif

                            <!-- Additional Info -->
                            @if($product->additional_info)
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Additional Information') }}</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $product->additional_info }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Right: Product Info -->
                        <div>
                            <!-- Product Title -->
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->title }}</h1>

                            <!-- Category -->
                            @if($product->category)
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>
                                </div>
                            @endif

                            <!-- Product Meta -->
                            <div class="border-t border-b border-gray-200 py-4 my-4">
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-600">{{ __('SKU') }}</p>
                                        <p class="font-semibold text-gray-900">{{ $product->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">{{ __('Status') }}</p>
                                        <p class="font-semibold text-gray-900">Active</p>
                                    </div>
                                    @if($product->date)
                                        <div>
                                            <p class="text-gray-600">{{ __('Date') }}</p>
                                            <p class="font-semibold text-gray-900">{{ $product->date->format('d M Y') }}</p>
                                        </div>
                                    @endif
                                    @if($product->platform)
                                        <div>
                                            <p class="text-gray-600">{{ __('Platform') }}</p>
                                            <p class="font-semibold text-gray-900">{{ $product->platform }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Platforms -->
                            @if($product->platforms->isNotEmpty())
                                <div class="mb-6">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-2">{{ __('Available on Platforms') }}</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($product->platforms as $platform)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $platform->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="space-y-2">
                                <a href="{{ route('product', ['product' => $product->slug]) }}"
                                   class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">
                                    {{ __('View Public') }}
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>

                            <!-- Timestamps -->
                            <div class="mt-6 pt-6 border-t border-gray-200 text-xs text-gray-600">
                                <p>{{ __('Created') }}: {{ $product->created_at->format('d M Y H:i') }}</p>
                                <p>{{ __('Updated') }}: {{ $product->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('mainImage');
            const thumbs = document.querySelectorAll('.thumb');

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const fullImageUrl = this.dataset.full;
                    if (fullImageUrl) {
                        mainImage.src = fullImageUrl;

                        // Update active state
                        thumbs.forEach(t => t.classList.remove('border-green-500'));
                        thumbs.forEach(t => t.classList.add('border-gray-300'));
                        this.classList.remove('border-gray-300');
                        this.classList.add('border-green-500');
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
