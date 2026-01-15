@extends('publik.layout.index')

@section('content')
<div class="container py-5">

    <a href="/explore-sekitar" class="btn btn-sm btn-outline-secondary mb-3">
        ← Kembali
    </a>

    @php
        // Helper function to get place image
        $getPlaceImage = function($place) {
            // Priority 1: base64 image_data
            if (!empty($place->image_data) && str_starts_with($place->image_data, 'data:image')) {
                return $place->image_data;
            }
            // Priority 2: Full URL
            if (filter_var($place->image, FILTER_VALIDATE_URL)) {
                return $place->image;
            }
            // Priority 3: Storage path (may not work on Railway)
            if ($place->image) {
                return asset('storage/' . $place->image);
            }
            // Fallback: placeholder
            return 'https://via.placeholder.com/600x400?text=No+Image';
        };
    @endphp

    <div class="row g-4">
        <div class="col-lg-7">
            <img src="{{ $getPlaceImage($place) }}"
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
