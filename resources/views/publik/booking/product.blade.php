@extends('publik.layout.index')

@section('content')

<section class="gallery-container">
    <div class="container">

        <div class="section-title-wrapper cuypg">
            <h2>{{ $product->title }}</h2>
            <p>Discover the beauty of nature</p>
        </div>

        <div class="product-section">

            {{-- GALLERY (punya kamu, TIDAK diubah) --}}

            <div class="info-section">

                {{-- STEP --}}
                @include('booking._steps', ['currentStep' => 2])

                <h1>{{ $product->title }}</h1>
                <p class="description">{{ $product->description }}</p>

                {{-- SUMMARY / TICKET --}}
                @include('booking._summary', [
                    'price' => 30000,
                    'location' => $product->additional_info ?? 'Cau Blayu, Tabanan, Bali'
                ])

                {{-- FEATURES + MAP (punya kamu, aman) --}}

            </div>
        </div>
    </div>
</section>



@endsection
