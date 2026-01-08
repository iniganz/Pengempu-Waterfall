@extends('publik.layout.index')

@section('content')
    <style>
        body {
            background-color: #FFF1CA !important;
        }
    </style>
    <div class="testimonials container py-5">
        @if(session('success'))
            <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger text-center mb-4">
                <ul class="mb-0" style="list-style:none;padding-left:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="section-title container" data-aos="fade-up">
            <!-- <h2>Services</h2> -->
            <p class="cuypy text-center" style="font-size: 20px;">Post Your Experience at Pengempu Waterfall</p>
        </div><!-- End Section Title -->
        <form action="{{ route('gallery-post.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto"
            style="max-width:400px;">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="100">
            </div>
            <div class="mb-3">
                <label for="caption" class="form-label">Caption (optional)</label>
                <input type="text" class="form-control" id="caption" name="caption" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Photo</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Upload Photo</button>
        </form>
    </div>
@endsection
