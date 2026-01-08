@extends('publik.layout.index')

@section('content')
<div class="container exploreS py-5">
      <div class="section-title container" data-aos="fade-up">
            <!-- <h2>Services</h2> -->
            <p class="cuypy text-center">Explore Sekitar</p>
        </div><!-- End Section Title -->

    <div class="row g-4">
        @foreach ($places as $place)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm place-card"
                 data-lat="{{ $place->lat }}"
                 data-lng="{{ $place->lng }}">

                <img src="{{ asset('storage/'.$place->image) }}"
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                <div class="card-body">
                    <span class="badge bg-success mb-2">
                        {{ ucfirst($place->category) }}
                    </span>

                    <h5 class="card-title">{{ $place->name }}</h5>

                    <p class="text-muted small mb-2">
                        ⭐ {{ $place->rating }} ·
                        <span class="distance">Menghitung jarak...</span>
                    </p>

                    <p class="card-text small">
                        {{ Str::limit($place->description, 90) }}
                    </p>

                    <a href="{{ url('/explore-sekitar/'.$place->slug) }}"
                       class="btn btn-sm btn-success">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Hitung jarak user --}}
<script>
navigator.geolocation.getCurrentPosition(pos => {
    const uLat = pos.coords.latitude;
    const uLng = pos.coords.longitude;

    document.querySelectorAll('.place-card').forEach(card => {
        const pLat = card.dataset.lat;
        const pLng = card.dataset.lng;

        const d = distance(uLat, uLng, pLat, pLng);
        card.querySelector('.distance').innerText = d + ' km dari Anda';
    });
});

function distance(lat1, lon1, lat2, lon2) {
    const R = 6371;
    const dLat = (lat2-lat1) * Math.PI/180;
    const dLon = (lon2-lon1) * Math.PI/180;
    const a =
        Math.sin(dLat/2)**2 +
        Math.cos(lat1*Math.PI/180) *
        Math.cos(lat2*Math.PI/180) *
        Math.sin(dLon/2)**2;
    return (R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))).toFixed(2);
}
</script>
@endsection
