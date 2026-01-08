<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Manajemen Testimonial
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 font-medium text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg bg-white p-6 shadow">

                <table class="w-full text-sm">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2 text-left">Nama</th>
                            <th>Rating</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->name }}</td>

                                <td class="text-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="{{ $i <= $item->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                    @endfor
                                </td>

                                <td class="max-w-xs truncate">
                                    {{ $item->description }}
                                </td>

                                <td class="text-center">
                                    @if ($item->is_active)
                                        <span class="font-semibold text-green-600">Aktif</span>
                                    @else
                                        <span class="text-gray-500">Pending</span>
                                    @endif
                                </td>

                                <td class="flex justify-center gap-2 py-2">

                                    {{-- Toggle --}}
                                    <form method="POST"
                                        action="{{ route('dashboard.testimonials.toggle', $item->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="{{ $item->is_active ? 'bg-yellow-500' : 'bg-green-600' }} rounded px-3 py-1 text-xs text-white">
                                            {{ $item->is_active ? 'Nonaktifkan' : 'Approve' }}
                                        </button>
                                    </form>

                                    {{-- Delete --}}
                                    <form method="POST"
                                        action="{{ route('dashboard.testimonials.delete', $item->id) }}"
                                        onsubmit="return confirm('Hapus testimonial ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded bg-red-600 px-3 py-1 text-xs text-white">
                                            Hapus
                                        </button>
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
