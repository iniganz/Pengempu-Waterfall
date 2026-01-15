<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Manajemen Gallery Post
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
                <form method="GET" class="mb-3">
                    <label>Filter: </label>
                    <select name="filter" onchange="this.form.submit()">
                        <option value="latest" {{ $filter == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ $filter == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
                <table class="w-full text-sm">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2 text-left">Nama</th>
                            <th>Caption</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="border-b">
                                <td class="py-2">{{ $post->name }}</td>
                                <td class="max-w-xs truncate">{{ $post->caption }}</td>
                                <td class="text-center">
                                    @if ($post->status == 'approved')
                                        <span class="font-semibold text-green-600">Approved</span>
                                    @elseif ($post->status == 'pending')
                                        <span class="text-gray-500">Pending</span>
                                    @else
                                        <span class="text-red-500">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at->format('d-m-Y H:i') }}</td>
                                <td class="flex flex-wrap gap-2 py-2 justify-center">
                                    {{-- View Full Image --}}
                                    @php
                                        $viewUrl = null;
                                        $hasImage = false;
                                        if ($post->image_data) {
                                            $viewUrl = $post->image_data;
                                            $hasImage = true;
                                        } elseif (filter_var($post->image_path, FILTER_VALIDATE_URL)) {
                                            $viewUrl = $post->image_path;
                                            $hasImage = true;
                                        }
                                        // Don't use storage path - files don't persist on Railway
                                    @endphp
                                    @if($hasImage)
                                        <a href="{{ $viewUrl }}" target="_blank" class="rounded bg-blue-600 px-3 py-1 text-xs text-white">View</a>
                                    @else
                                        <span class="rounded bg-gray-400 px-3 py-1 text-xs text-white cursor-not-allowed" title="Gambar tidak tersedia (data lama)">No Image</span>
                                    @endif
                                    {{-- Approve --}}
                                    @if($post->status == 'pending')
                                    <form method="POST" action="{{ route('dashboard.post.approve', $post->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-green-600 rounded px-3 py-1 text-xs text-white">Approve</button>
                                    </form>
                                    {{-- Reject --}}
                                    <form method="POST" action="{{ route('dashboard.post.reject', $post->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-yellow-500 rounded px-3 py-1 text-xs text-white">Reject</button>
                                    </form>
                                    @endif
                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('dashboard.post.destroy', $post->id) }}" onsubmit="return confirm('Hapus post ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded bg-red-600 px-3 py-1 text-xs text-white">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
