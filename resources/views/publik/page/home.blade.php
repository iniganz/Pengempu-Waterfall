@extends('publik.layout.index')


@section('content')
    <link rel="stylesheet" href="{{ asset('css/testimoni.css') }}">
    <main class="main">
        <section id="hero" class="hero section dark-background">

            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">


                <div class="carousel-item active">
                    <img src="/images/air_terjun1.jpg" alt="">
                    {{-- <img src="/images/download.jpeg" alt=""> --}}

                </div>
                <!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="/images/air_terjun2.jpg" alt="">

                </div>
                <!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="/images/air_terjun3.jpg" alt="">



                </div>
                <div class="carousel-item">
                    <img src="/images/air_terjun1.jpg" alt="">



                </div>
            </div> <!-- End Carousel Item -->

            <div class="carousel-container">
                <!-- <h2 class="changing-text">CRAFTING <br> <span id="gsap-word">EXPERIENCE</span> <br> GAMES</h2> -->
                <h2 class="text-container text-atas">
                    PENGEMPU WATERFALL
                    {{-- CRAFTING <br>
                    <span class="text-wrapper">
                        <span id="typed-text">INNOVATING</span>
                    </span>
                    <br> GAMES --}}
                </h2>


                <a href="#about" class="btn-get-started border border-white shadow-lg">GET STARTED NOW</a>
            </div>

            </div>

        </section>


        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="order-lg-1 content center order-2">
                        <h3>Ways You Can pay</h3>
                        <img src="/images/payment-method.png" alt="Payment Methods" class="img-payment-about">
                        <h1>PENGEMPU WATERFALL</h1>
                        <p>Link web ni</p>
                        <h3>Nikmati Ketenangan Alam Bali dari Sisi yang Berbeda bersama Pengempu Waterfall</h3>

                        <!-- Desktop Description (Panjang) -->
                        <p class="text-justify d-none d-md-block">
                            Pengempu Waterfall adalah destinasi wisata alam tersembunyi yang menawarkan keasrian aliran air
                            terjun jernih di tengah rimbunnya pepohonan Bali. Berbeda dengan wisata air terjun pada umumnya
                            yang seringkali sulit dijangkau dengan medan berat, Pengempu Waterfall memiliki akses jalur yang
                            sangat mudah dan aman, menjadikannya pilihan yang sangat bersahabat bagi anak-anak maupun
                            keluarga namun tetap penuh dengan pesona alam yang memukau. Sensasi berada di sini adalah
                            perpaduan antara suara gemericik air yang menenangkan dan keindahan tebing batu alami yang
                            eksotis.
                            Dikelola secara profesional untuk menjamin keamanan dan kenyamanan pengunjung, Anda dapat
                            mempercayakan perjalanan wisata Anda kepada kami untuk mendapatkan pengalaman yang aman,
                            menyenangkan, dan tak terlupakan. Pengempu Waterfall bangga dapat bekerja sama dengan komunitas
                            lokal guna memastikan setiap kunjungan Anda tetap terasa otentik dan terjaga kualitasnya.
                            Jarak tempuh menuju lokasi ini juga lebih singkat dibandingkan dengan destinasi wisata alam
                            serupa di area pegunungan jauh. Terletak di kawasan Desa Cau Belayu, Tabanan, tempat ini menjadi
                            solusi sempurna bagi Anda yang ingin menyegarkan pikiran tanpa harus menempuh perjalanan yang
                            melelahkan.
                            Mana yang paling cocok untuk rencana liburan Anda dan keluarga? Mari simak detailnya di bawah
                            ini:
                        </p>

                        <!-- Mobile Description (Ringkas) -->
                        <p class="text-justify d-block d-md-none">
                            Pengempu Waterfall adalah destinasi wisata alam tersembunyi dengan akses jalur yang mudah dan aman, cocok untuk keluarga dan anak-anak. Nikmati kesegaran air terjun jernih dengan suara gemericik air yang menenangkan, dikelola secara profesional untuk keamanan dan kenyamanan Anda. Terletak di Desa Cau Belayu, Tabanan – hanya perjalanan singkat dari pusat kota.
                        </p>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->
        <section id="services" class="services section">
            <div class="section-title container" data-aos="fade-up" data-aos-delay="200">
                <p class="cuyp text-center">PENGEMPU WATERFALL PACKAGES</p>
            </div>
            <div class="container">
                <div class="row gy-4 justify-content-center" data-aos="fade-up">
                    <!-- Service 1: Custom Game Development -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center mb-4">
                        <div class="waterfall-card">

                            <!-- IMAGE -->
                            <div class="waterfall-image">
                                <img src="/images/water1.jpg" alt="Pengempu Waterfall">
                                <!-- WAVES -->
                                <div class="wave wave-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                                        preserveAspectRatio="none">
                                        <path fill="#ffffff"
                                            d="M0,128L30,133.3C60,139,120,149,180,176C240,203,300,245,360,240C420,235,480,181,540,176C600,171,660,213,720,202.7C780,192,840,128,900,101.3C960,75,1020,85,1080,117.3C1140,149,1200,203,1260,202.7C1320,203,1380,149,1410,122.7L1440,96L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="wave wave-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                                        preserveAspectRatio="none">
                                        <path fill="#ffffff"
                                            d="M0,224L26.7,192C53.3,160,107,96,160,101.3C213.3,107,267,181,320,218.7C373.3,256,427,256,480,250.7C533.3,245,587,235,640,229.3C693.3,224,747,224,800,197.3C853.3,171,907,117,960,128C1013.3,139,1067,213,1120,213.3C1173.3,213,1227,139,1280,122.7C1333.3,107,1387,149,1413,170.7L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="wave wave-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                                        preserveAspectRatio="none">
                                        <path fill="#ffffff"
                                            d="M0,32L26.7,42.7C53.3,53,107,75,160,106.7C213.3,139,267,181,320,170.7C373.3,160,427,96,480,96C533.3,96,587,160,640,186.7C693.3,213,747,203,800,192C853.3,181,907,171,960,144C1013.3,117,1067,75,1120,80C1173.3,85,1227,139,1280,154.7C1333.3,171,1387,149,1413,138.7L1440,128L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <!-- CONTENT -->
                            <div class="waterfall-content">
                                <h3>PENGEMPU WATERFALL</h3>

                                <p class="price">
                                    Start Price:<br>
                                    <strong>IDR 30K</strong> / person
                                </p>

                                <p class="desc">
                                    Rasakan ketenangan tiada tara saat Anda memasuki kawasan tersembunyi
                                    Pengempu Waterfall. Nikmati kesegaran kolam alami dengan akses jalur
                                    yang sangat mudah, berlokasi di Desa Cau Belayu, Tabanan – BALI.
                                </p>

                                <a href="{{ route('product') }}" class="btn-more">More Info</a>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </section>






        <!-- Services Section -->

        <svg class="svg-testimonial" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
            style="width: 100%; height: auto; display: block;">
            <path fill="#EAFFEF" fill-opacity="1"
                d="M0,32L26.7,42.7C53.3,53,107,75,160,106.7C213.3,139,267,181,320,170.7C373.3,160,427,96,480,96C533.3,96,587,160,640,186.7C693.3,213,747,203,800,192C853.3,181,907,171,960,144C1013.3,117,1067,75,1120,80C1173.3,85,1227,139,1280,154.7C1333.3,171,1387,149,1413,138.7L1440,128L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
            </path>
        </svg>
        <!-- Clients Section -->
        <section id="clients" class="clients section">
            <div class="section-title container" data-aos="fade-up">
                <!-- <h2>Services</h2> -->
                <p class="cuypy text-center">Why Choose Us?</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="why-choose-card p-4 text-center">
                            <div class="why-choose-icon mb-3">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h4 class="mb-3">Ketenangan Alam yang Otentik</h4>
                            <p>Pengampu Waterfall menawarkan sensasi relaksasi yang nyata dengan suara gemericik air yang
                                menenangkan dan tebing batu alami yang eksotis. Tempat ini adalah pilihan sempurna dari
                                kerumahan kota untuk menyegarkan pikiran Anda.</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="why-choose-card p-4 text-center">
                            <div class="why-choose-icon mb-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <h4 class="mb-3">Akses Ramah Keluarga</h4>
                            <p>Berbeda dengan banyak air terjun lainnya yang sulit dijangkau dengan medan berat, Waterfall
                                sangat ramah anak-anak maupun keluarga. Waterfall sangat aman untuk dikunjungi keluarga
                                Anda.</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="why-choose-card p-4 text-center">
                            <div class="why-choose-icon mb-3">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h4 class="mb-3">Dekat dengan Destinasi Utama</h4>
                            <p>Terletak secara strategis di Desa Cau Belayu, Tabanan, lokasi kami hanya berjarak singkat
                                dari pusat kota. Anda bisa menikmati wisata alam alam tanpa harus menghabiskan waktu
                                berjam-jam di perjalanan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                style="width: 100%; height: auto; display: block; margin-bottom: -1px;">
                <path fill="#FFF1CA" fill-opacity="1"
                    d="M0,32L26.7,42.7C53.3,53,107,75,160,106.7C213.3,139,267,181,320,170.7C373.3,160,427,96,480,96C533.3,96,587,160,640,186.7C693.3,213,747,203,800,192C853.3,181,907,171,960,144C1013.3,117,1067,75,1120,80C1173.3,85,1227,139,1280,154.7C1333.3,171,1387,149,1413,138.7L1440,128L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                </path>
            </svg>
        </section>
        <!-- /Clients Section -->





        <!-- Testimonials Section -->


        <section id="testimonials" class="testimonials section">
            <div class="section-title container" data-aos="fade-up">
                <!-- <h2>Services</h2> -->
                <p class="cuypy text-center">Testimonials People</p>
            </div><!-- End Section Title -->
            <div class="testimonials-viewport">
                <div class="swiper testimonials-slider">
                    <div class="swiper-wrapper">

                        @foreach ($testimonials as $item)
                            <div class="swiper-slide">
                                <div class="testimonial-card">

                                    <div class="quote-badge">
                                        <i class="bi bi-quote"></i>
                                    </div>

                                    <h3 class="testimonial-name">{{ $item->name }}</h3>

                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $item->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>

                                    <p class="testimonial-text">
                                        {{ $item->description }}
                                    </p>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="p-testimonial">
                <a href="/testimonial">
                    <p>Berikan Testimoni kamu!</p>
                </a>
            </div>
        </section>
        {{-- <x-svg-waves /> --}}


        <!-- /Testimonials Section -->

    </main>
@endsection
