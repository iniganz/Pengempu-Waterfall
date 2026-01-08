@extends('publik.layout.index')

@section('content')
<div class="container py-5">

    <a href="/explore-sekitar" class="btn btn-sm btn-outline-secondary mb-3">
        ← Kembali
    </a>

    <div class="row g-4">
        <div class="col-lg-7">
            <img src="{{ asset('storage/'.$place->image) }}"
                 class="img-fluid rounded shadow">
        </div>

        <div class="col-lg-5">
            <h2 class="fw-bold">{{ $place->name }}</h2>

            <p class="text-muted">
                ⭐ {{ $place->rating }} · {{ ucfirst($place->category) }}
            </p>

            <p>{{ $place->description }}</p>

            <p class="small">
                📍 {{ $place->address }}
            </p>

            <a href="https://www.google.com/maps?q={{ $place->lat }},{{ $place->lng }}"
               target="_blank"
               class="btn btn-success btn-sm">
                Buka di Maps
            </a>
        </div>
    </div>

    @if($place->map_embed)
    <div class="mt-5">
        <h5>Lokasi</h5>
        <div class="ratio ratio-16x9">
            {!! $place->map_embed !!}
        </div>
    </div>
    @endif
</div>
@endsection
