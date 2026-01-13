<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Tempat Baru') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Tambahkan destinasi wisata baru ke dalam platform</p>
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
                    <form action="{{ route('dashboard.places.store') }}" method="POST" enctype="multipart/form-data">
                        @include('dashboard.places.form')

                        <!-- Buttons -->
                        <div class="mt-8 flex gap-3 justify-end">
                            <a href="{{ route('dashboard.places.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                                💾 Simpan Tempat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-900 mb-2">📝 Tips Mengisi Form:</h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>✓ Gunakan nama yang deskriptif dan mudah diingat</li>
                    <li>✓ Rating harus antara 0-5 (contoh: 4.5)</li>
                    <li>✓ Koordinat bisa didapat dari Google Maps (klik lokasi → copy koordinat)</li>
                    <li>✓ Upload gambar berkualitas tinggi (landscape orientation recommended)</li>
                    <li>✓ Deskripsi harus jelas dan menarik untuk calon pengunjung</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
