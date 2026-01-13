<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pengempu-Waterfall</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="/images/Pengempuh.png" style="width: 100%; height: auto;">
    <link rel="icon" href="/images/Pengempuh.png" rel="apple-touch-icon" style="width: 100%; height: auto;">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script stack will be rendered before closing body to avoid duplicate Snap loads --}}

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}">


    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <!-- Main CSS File -->
    {{-- <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/testimoni.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset(path: 'css/main.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset(path: 'css/app.css') }}">
    <link rel="stylesheet" href="{{ asset(path: 'css/product.css') }}">
    <link rel="stylesheet" href="/css/wa.css">
    <link rel="stylesheet" href="/css/booking.css">


    <!-- font aweosome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script> -->


    <!-- =======================================================
  * Template Name: Gp
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Updated: Aug 15 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .header {

            /* background-color: var(--background-color); */
            /* background-color: #033126; */
            background-image: linear-gradient(to right, #033126, #008c4b);

        }
    </style>
</head>

<body class="index-page">
    <main>
        <header>
            @include('publik.komponen.navbar')
        </header>
        <section>
            @yield('content')
        </section>
        <footer>
            @include('publik.komponen.footer')
        </footer>
    </main>

    <!-- Scroll Top -->
    <div class="bawahsc">

        {{-- <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center mb-2"><i
                class="bi bi-whatsapp"></i></a> --}}

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
        <a href="https://wa.me/6281234567890" target="_blank" id="wa-float"
            class="wa-float d-flex align-items-center justify-content-center">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- disable kilk kanan -->
    <!-- <div id="toast" style="display:none;">Right click is disabled!</div> -->
    <!-- <div id="toast" style="display:none;">Right click is disabled!</div> -->


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>



    <!-- Main JS File -->
    {{-- <script src="assets/js/main.js"></script> --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="/js/product.js"></script>
    <script src="/js/behavior.js"></script>
    <script src="/js/testimonials-efek.js"></script>
    <script src="/js/place.js"></script>
    <script src="/js/booking.js"></script>
    <script src="/js/snap.js"></script>
    <!-- <script src="assets/js/klik.js"></script> -->

    <!-- animasi JS -->
    <!-- <script src="assets/js/animasi.js"></script> -->

    <script></script>

    @stack('scripts')

</body>

</html>
