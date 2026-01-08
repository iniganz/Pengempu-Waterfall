
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Tempat Baru
        </h2>
    </x-slot>
    <div class="container py-4">
        <form action="{{ route('dashboard.places.store') }}" method="POST" enctype="multipart/form-data">
            @include('dashboard.places.form')
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
</x-app-layout>
