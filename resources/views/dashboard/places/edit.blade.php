<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Tempat') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Edit informasi tentang: <strong>{{ $place->name }}</strong></p>
            </div>
            <a href="{{ route('dashboard.places.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form -->
                    <form action="{{ route('dashboard.places.update', $place) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @include('dashboard.places.form')

                        <!-- Buttons -->
                        <div class="mt-8 flex gap-3 justify-end">
                            <a href="{{ route('dashboard.places.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                ✏️ Perbarui Tempat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Image Section -->
            @if($place->image)
                <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">🖼️ Gambar Saat Ini</h3>
                    <div class="relative inline-block">
                        <img src="{{ Storage::url($place->image) }}" alt="{{ $place->name }}" class="max-w-xs h-auto rounded-lg shadow">
                        <p class="text-sm text-gray-600 mt-2">Upload gambar baru di atas untuk menggantinya</p>
                    </div>
                </div>
            @endif

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-900 mb-2">📝 Tips Edit:</h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>✓ Ubah hanya field yang ingin diperbarui</li>
                    <li>✓ Gambar lama akan dihapus jika upload gambar baru</li>
                    <li>✓ Pastikan koordinat akurat untuk fitur jarak</li>
                    <li>✓ Deskripsi singkat tapi detail</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
