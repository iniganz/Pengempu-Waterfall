<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    📍 Data Tempat
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola semua destinasi wisata di platform</p>
            </div>
            <a href="{{ route('dashboard.places.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                <span>+</span> Tambah Tempat Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($places->count() === 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-gray-400 mb-3">📭</div>
                    <h3 class="text-gray-900 font-semibold mb-1">Belum ada tempat</h3>
                    <p class="text-gray-600 text-sm mb-4">Mulai tambahkan destinasi wisata baru ke platform</p>
                    <a href="{{ route('dashboard.places.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Tambah Tempat Pertama
                    </a>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Rating</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($places as $place)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $place->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $categoryEmoji = [
                                                'wisata' => '🏞️',
                                                'kuliner' => '🍴',
                                                'umkm' => '🏪'
                                            ];
                                            $categoryColor = [
                                                'wisata' => 'blue',
                                                'kuliner' => 'orange',
                                                'umkm' => 'purple'
                                            ];
                                            $emoji = $categoryEmoji[$place->category] ?? '📍';
                                            $color = $categoryColor[$place->category] ?? 'gray';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
                                            {{ $emoji }} {{ ucfirst($place->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <span class="text-yellow-400">⭐</span>
                                            <span class="font-semibold text-gray-900">{{ $place->rating }}/5</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-600 truncate max-w-xs">
                                            {{ \Str::limit($place->address, 50) }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('dashboard.places.edit', $place->id) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('dashboard.places.destroy', $place->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus tempat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 text-sm font-medium bg-red-100 text-red-700 rounded hover:bg-red-200 transition">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination (jika ada) -->
                @if($places->hasPages())
                    <div class="mt-6">
                        {{ $places->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
