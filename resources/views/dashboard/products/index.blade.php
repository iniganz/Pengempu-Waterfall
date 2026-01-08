<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                + {{ __('Add Product') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-4">
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}"
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                            {{ __('Search') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            @if($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images[0]->image_url) }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600">
                                    {{ __('No Image') }}
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $product->title }}</h3>

                            @if($product->category)
                                <p class="text-xs text-gray-600 mb-3">
                                    {{ $product->category->name }}
                                </p>
                            @endif

                            <p class="text-sm text-gray-700 mb-4 line-clamp-3">{{ $product->description }}</p>

                            <!-- Meta Info -->
                            <div class="flex justify-between items-center text-xs text-gray-600 mb-4 pb-4 border-b border-gray-200">
                                <span>{{ $product->images->count() }} {{ __('images') }}</span>
                                <span>{{ $product->created_at->format('d M Y') }}</span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.show', $product) }}"
                                   class="flex-1 text-center px-3 py-2 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                    {{ __('View') }}
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="flex-1 text-center px-3 py-2 bg-yellow-600 text-white text-xs font-semibold rounded hover:bg-yellow-700 transition">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full px-3 py-2 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-center text-gray-600">
                                {{ __('No products found.') }}
                                <a href="{{ route('admin.products.create') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                    {{ __('Create your first product') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
