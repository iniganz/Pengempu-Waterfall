@extends('publik.layout.index')


@section('content')
    <section class="section testimonials">
        <div class="section-title container" data-aos="fade-up">
            <!-- <h2>Services</h2> -->

            <p class="cuypy text-center" style="font-size: 30px;">Kirim Testimonial</p>
        </div><!-- End Section Title -->
        <div class="container" style="max-width:600px">


            {{-- alert sukses --}}
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('testimonial.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-control" required>
                        <option value="">-- Pilih Rating --</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Testimonial</label>
                    <textarea name="description" rows="5" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Kirim Testimonial
                </button>
            </form>

        </div>
    </section>
@endsection
