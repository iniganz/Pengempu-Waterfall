<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Data Tempat
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="{{ route('dashboard.places.create') }}" class="mb-4 inline-block rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700">+ Tambah Tempat</a>

            <div class="overflow-x-auto rounded-lg bg-white p-6 shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Kategori</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Rating</th>
                            <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($places as $place)
                        <tr>
                            <td class="px-4 py-2">{{ $place->name }}</td>
                            <td class="px-4 py-2">{{ $place->category }}</td>
                            <td class="px-4 py-2">{{ $place->rating }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('dashboard.places.edit',$place->id) }}" class="rounded bg-yellow-500 px-3 py-1 text-xs text-white hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('dashboard.places.destroy',$place->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data?')">
                                    @csrf @method('DELETE')
                                    <button class="rounded bg-red-600 px-3 py-1 text-xs text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
