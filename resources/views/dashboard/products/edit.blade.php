<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
            <a href="{{ route('admin.products.show', $product) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                ← {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Product Title') }} *
                            </label>
                            <input type="text" name="title" id="title"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                   value="{{ old('title', $product->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Category') }} *
                            </label>
                            <select name="category_id" id="category_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror"
                                    required>
                                <option value="">-- {{ __('Select Category') }} --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Description') }} *
                            </label>
                            <textarea name="description" id="description" rows="5"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                      required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Feature -->
                        <div>
                            <label for="feature" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Features') }}
                            </label>
                            <textarea name="feature" id="feature" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter product features...">{{ old('feature', $product->feature) }}</textarea>
                            @error('feature')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Info -->
                        <div>
                            <label for="additional_info" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Additional Information') }}
                            </label>
                            <textarea name="additional_info" id="additional_info" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter additional information...">{{ old('additional_info', $product->additional_info) }}</textarea>
                            @error('additional_info')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Date') }}
                            </label>
                            <input type="date" name="date" id="date"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('date', $product->date?->format('Y-m-d')) }}">
                            @error('date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Platform -->
                        <div>
                            <label for="platform" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Platform') }}
                            </label>
                            <input type="text" name="platform" id="platform"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Web, Mobile, Desktop"
                                   value="{{ old('platform', $product->platform) }}">
                            @error('platform')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Platforms Multi-select -->
                        <div>
                            <label for="platforms" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Associated Platforms') }}
                            </label>
                            <select name="platforms[]" id="platforms" multiple
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                @foreach($platforms as $platform)
                                    <option value="{{ $platform->id }}"
                                        {{ $product->platforms->contains($platform->id) ? 'selected' : '' }}>
                                        {{ $platform->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">{{ __('Hold Ctrl/Cmd to select multiple') }}</p>
                            @error('platforms')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Images -->
                        @if($product->images->isNotEmpty())
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    {{ __('Current Images') }}
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($product->images as $image)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $image->image_url) }}"
                                                 alt="Product image"
                                                 class="w-full h-24 object-cover rounded border border-gray-300">
                                            <form action="{{ route('product-images.destroy', $image) }}" method="POST" class="absolute inset-0 hidden group-hover:flex items-center justify-center bg-black bg-opacity-50 rounded"
                                                  onsubmit="return confirm('Delete this image?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-white text-sm font-semibold">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- New Images -->
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Add New Images') }}
                            </label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">{{ __('You can select multiple images. Max 2MB per image.') }}</p>
                            @error('images')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <button type="submit"
                                    class="flex-1 px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                                {{ __('Update Product') }}
                            </button>
                            <a href="{{ route('admin.products.show', $product) }}"
                               class="flex-1 text-center px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 transition">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
