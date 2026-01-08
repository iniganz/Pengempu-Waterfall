@extends('publik.layout.index')


@section('content')
<link rel="stylesheet" href="{{ asset('css/testimoni.css') }}">
    <main class="main">
        <section id="hero" class="hero section dark-background">

            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">


                <div class="carousel-item active">
                    <img src="assets/img/hero-carousel/img1.jpg" alt="">

                </div>
                <!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="assets/img/hero-carousel/img2.jpg" alt="">

                </div>
                <!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="assets/img/hero-carousel/img3.jpg" alt="">



                </div>
                <div class="carousel-item">
                    <img src="assets/img/hero-carousel/img5.jpg" alt="">



                </div>
            </div> <!-- End Carousel Item -->

            <div class="carousel-container">
                <!-- <h2 class="changing-text">CRAFTING <br> <span id="gsap-word">EXPERIENCE</span> <br> GAMES</h2> -->
                <h2 class="text-container">
                    CRAFTING <br>
                    <span class="text-wrapper">
                        <span id="typed-text">INNOVATING</span>
                    </span>
                    <br> GAMES
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
                        <!-- <h3>Tentang Kami</h3> -->
                        <p class="text-justify">
                            Kami adalah CuyNest, sebuah studio pengembangan game yang telah berdedikasi sejak 2005 untuk
                            menciptakan
                            pengalaman bermain yang inovatif, mendalam, dan menghibur. Dengan tim yang terdiri dari
                            pengembang,
                            desainer, dan kreator berbakat, kami berkomitmen menghadirkan game berkualitas tinggi yang dapat
                            dinikmati
                            oleh pemain di seluruh dunia.

                            Sebagai salah satu studio game terkemuka di Indonesia dan berkembang di Asia Tenggara, kami
                            menyediakan
                            layanan pengembangan game full-cycle, 3D game art, game porting, dan gamifikasi untuk berbagai
                            klien.
                            Dengan pengalaman lebih dari satu dekade, kami telah melayani 5.000.000+ pemain puas, merilis 9
                            game,
                            menghabiskan 5.000+ jam pengembangan, serta didukung oleh 32 talenta terbaik di tim kami.
                        </p>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->
        <section id="services" class="services section d-none d-md-block">
            <div class="section-title container" data-aos="fade-up">
                <p class="cuyp text-center">LAYANAN KAMI</p>
            </div>
            <div class="container">
                <div class="row gy-4">
                    <!-- Service 1: Custom Game Development -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <div class="icon">
                                            <i class="bi bi-controller"></i>
                                        </div>
                                        <h3>Costume Game Development</h3>
                                    </div>
                                    <div class="flip-card-back">
                                        <p>Kami menciptakan game unik dan berkualitas tinggi sesuai dengan visi dan
                                            kebutuhan klien.</p>
                                        <a href="/service?service_id=custom">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service 2: Cross-Platform Integration -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <div class="icon">
                                            <i class="bi bi-globe"></i>
                                        </div>
                                        <h3>Integrasi Lintas Platform</h3>
                                    </div>
                                    <div class="flip-card-back">
                                        <p>Kami mengembangkan game yang dapat dimainkan di berbagai platform.</p>
                                        <a href="/service?service_id=platform">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service 3: Game Art & Animation -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <div class="icon">
                                            <i class="bi bi-palette"></i>
                                        </div>
                                        <h3>Seni & Animasi Game</h3>
                                    </div>
                                    <div class="flip-card-back">
                                        <p>Visual memukau dengan desain karakter, lingkungan, dan animasi berkualitas
                                            tinggi.</p>
                                        <a href="/service?service_id=art">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Service 2: Mobile Game Development -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <div class="icon">
                                            <i class="bi bi-controller"></i>
                                        </div>
                                        <h3>Mobile Game Development</h3>
                                    </div>
                                    <div class="flip-card-back">
                                        <p>Kami menciptakan game unik dan berkualitas tinggi sesuai dengan visi dan
                                            kebutuhan klien.</p>
                                        <a href="/service?service_id=hp">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Service 1: Game PC & Console Development -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <div class="icon">
                                            <i class="bi bi-controller"></i>
                                        </div>
                                        <h3>Game PC & Console Development</h3>
                                    </div>
                                    <div class="flip-card-back">
                                        <p>Kami menciptakan game unik dan berkualitas tinggi sesuai dengan visi dan
                                            kebutuhan klien.</p>
                                        <a href="/service?service_id=pc">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






        <!-- Services Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">
            <div class="section-title container" data-aos="fade-up">
                <!-- <h2>Services</h2> -->
                <p class="cuyp text-center">OVER 200 SATISFED CLIENTS</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 3000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/spng/ferari.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/spng/honda.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/vid.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/telkom.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/spng/fanta.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/sprite.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/spng/coca.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/xl.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/neko.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 3200,
              "reverseDirection": true
            },
            "slidesPerView": "auto",

            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }

        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/spng/bca.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/bni.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/livin.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/bmw.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/hnime.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/oyo.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/atas/wibu.jpg" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/spng/toped.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/mylist.png" class="img-fluid"
                                alt=""></div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 3500
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/spng/sopi.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/gojek.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/hentai.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/spng/ea.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/ff.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/gpt.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/unhi.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/yt.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/spng/jarum.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>

        </section>
        <!-- /Clients Section -->
        <!-- Clients Section -->
        <section id="clients" class="clients section">
            <div class="section-title container" data-aos="fade-up">
                <p class="cuypy text-center">TECH STACKS</p>
                <h2>Services</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 1000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/sponsor/unity.png" class="img-fluid imgs"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/un.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/itc.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/poton.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/roko.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/epic.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/net.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/asep.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/go..png" class="img-fluid"
                                alt=""></div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>

            </div>

        </section>
        <!-- /Clients Section -->
        <!-- Clients Section -->
        <section id="clients" class="clients section">
            <div class="section-title container" data-aos="fade-up">
                <!-- <p class="cuypy text-center">TECH STACKS</p> -->
                <h2>platform </h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 2500
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/sponsor/ps4.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ps5.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/nitendo.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ps4.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ps5.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/nitendo.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ps4.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ps5.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/nitendo.png" class="img-fluid"
                                alt=""></div>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 2550,
              "reverseDirection": true
            },
            "slidesPerView": "auto",

            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }

        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/sponsor/xbox.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/xs.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/stm.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/nvi.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/xbox.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/xs.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/stm.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/nvi.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/xbox.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/xs.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/stm.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/nvi.png" class="img-fluid"
                                alt=""></div>

                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 2600
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/sponsor/win.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/hp.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ios.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/win.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/hp.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ios.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/win.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/hp.png" class="img-fluid" alt="">
                        </div>
                        <div class="swiper-slide"><img src="assets/img/sponsor/ios.png" class="img-fluid"
                                alt=""></div>

                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>

            </div>

        </section>
        <!-- /Clients Section -->



        <!-- Features Section -->
        <section id="features" class="features section">

            <div class="container">

                <div class="row gy-4">
                    <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img
                            src="assets/img/make.jpg" alt=""></div>
                    <div class="col-lg-6">

                        <div class="features-item d-flex ps-lg-3 pt-lg-0 ps-0 pt-4" data-aos="fade-up"
                            data-aos-delay="100">
                            <i class="bi bi-controller flex-shrink-0"></i>
                            <div>
                                <h4> Innovative <span class="gradient-color">Game Development</span></h4>
                                <p>Kami menciptakan dunia yang imersif dengan teknologi mutakhir, visual yang memukau, dan
                                    cerita yang
                                    memikat.</p>
                            </div>
                        </div><!-- End Features Item-->

                        <div class="features-item d-flex ps-lg-3 mt-5 ps-0" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-globe flex-shrink-0"></i>
                            <div>
                                <h4>Game <span class="gradient-color">Lintas Platform</span></h4>
                                <p>Dari PC hingga mobile dan konsol, game kami menghadirkan pengalaman terbaik bagi para
                                    pemain di mana
                                    saja.</p>
                            </div>
                        </div><!-- End Features Item-->

                        <div class="features-item d-flex ps-lg-3 mt-5 ps-0" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-robot flex-shrink-0"></i>
                            <div>
                                <h4>Grafis & AI <span class="gradient-color">Generasi Berikutnya</span></h4>
                                <p>Kami mengintegrasikan teknologi AI dan visual terbaru untuk menciptakan gameplay yang
                                    luar biasa.</p>
                            </div>
                        </div><!-- End Features Item-->

                        <div class="features-item d-flex ps-lg-3 mt-5 ps-0" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-chat flex-shrink-0"></i>
                            <div>
                                <h4>Pengembangan <span class="gradient-color">Berbasis Komunitas</span></h4>
                                <p>Kami mendengarkan pemain dan terus menyempurnakan game kami berdasarkan umpan balik serta
                                    antusiasme
                                    mereka.</p>
                            </div>
                        </div><!-- End Features Item-->

                    </div>
                </div>

            </div>

        </section><!-- /Features Section -->

        <!-- Call To Action Section -->
        <!-- <section id="call-to-action" class="call-to-action section dark-background">

        <img src="assets/img/cta-bg.jpg" alt="">

        <div class="container">
          <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-xl-10">
              <div class="text-center">
                <h3>Call To Action</h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                  laborum.</p>
                <a class="cta-btn" href="#">Call To Action</a>
              </div>
            </div>
          </div>
        </div>

      </section> -->
        <!-- /Call To Action Section -->


        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-lg-5">
                        <img src="assets/img/logo.png" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-6 stats-column">

                        <h3 class="fw-bold fs-2 mb-3">Membangun Dunia Virtual, Menciptakan Petualangan Epik!</h3>
                        <p>
                            Kami adalah tim developer game yang berdedikasi untuk menghadirkan pengalaman bermain yang luar
                            biasa.
                            Dengan teknologi terbaru dan kreativitas tanpa batas, kami telah mengembangkan berbagai game
                            yang
                            menghibur
                            dan inovatif. Dari konsep hingga rilis, kami memastikan setiap detail dirancang dengan sempurna
                            agar para
                            pemain dapat merasakan petualangan yang tak terlupakan.
                        </p>

                        <div class="row gy-4">

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-emoji-smile flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="5000000"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Happy Clients</strong> <span>Pemain Puas</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-journal-richtext flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="9"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Projects</strong> <span>Game Dirilis</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-headset flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="5000"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Hours Of Support</strong> <span>Jam Pengembangan</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-people flex-shrink-0"></i>
                                    <div>
                                        <span data-purecounter-start="0" data-purecounter-end="32"
                                            data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Hard Workers</strong> <span>Tim Developer</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section dark-background">

            <img src="../assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="Background Testimoni">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="section-title">
                    <!-- <h2 class="text-white">Apa Kata Mereka?</h2> -->
                    <p class="text-white-50">Testimoni jujur dari klien dan pemain game kami</p>
                </div>

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 1000,
        "autoplay": {
          "delay": 8000,
          "disableOnInteraction": false
        },
        "effect": "coverflow",
        "grabCursor": true,
        "centeredSlides": true,
        "slidesPerView": "auto",
        "coverflowEffect": {
          "rotate": 10,
          "stretch": 0,
          "depth": 100,
          "modifier": 2,
          "slideShadows": true
        },
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        }
      }
    </script>
                    <div class="swiper-wrapper">

                        <!-- Testimoni 1 -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-header">
                                    <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                        alt="Andi Pratama">
                                    <div class="user-info">
                                        <h3>Andi Pratama</h3>
                                        <h4>Gamer & Youtuber</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Gim buatan CuyNest beneran keren grafisnya! Awalnya coba-coba, eh malah ketagihan.
                                        Fitur
                                        multiplayer-nya lancar banget, gak ada lag sama sekali. Udah aku review di channel
                                        YouTube ku dan
                                        subscriber pada suka semua!</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <div class="game-info">
                                    <small>Game yang dimainkan: <strong>Legends of Nusantara</strong></small>
                                    <small>Waktu bermain: <strong>250+ jam</strong></small>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimoni 2 -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-header">
                                    <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                        alt="Budi Santoso">
                                    <div class="user-info">
                                        <h3>Budi Santoso</h3>
                                        <h4>CEO Startup Edukasi</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-half"></i>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Kami pesan game edukasi untuk produk kami dan hasilnya beyond expectation! Tim
                                        CuyNest sangat
                                        profesional, ngerti banget kebutuhan kami. Game-nya beneran membantu siswa belajar
                                        dengan cara yang
                                        menyenangkan. Pokoknya recommended banget!</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <div class="game-info">
                                    <small>Proyek: <strong>EduGame Matematika SD</strong></small>
                                    <small>Durasi pengerjaan: <strong>3 bulan</strong></small>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimoni 3 -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-header">
                                    <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                        alt="Rina Wijaya">
                                    <div class="user-info">
                                        <h3>Rina Wijaya</h3>
                                        <h4>Mobile Gamer</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Aku biasanya gak suka game mobile karena boros baterai, tapi game dari CuyNest ini
                                        optimasinya
                                        juara! Grafis bagus tapi ringan, gak bikin HP panas. Ceritanya juga seru banget,
                                        khas Indonesia
                                        banget. Udah nyelesaikan semua quest-nya!</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <div class="game-info">
                                    <small>Game yang dimainkan: <strong>Dewa Kalahari Mobile</strong></small>
                                    <small>Rating di Play Store: <strong>4.9/5</strong></small>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimoni 4 -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-header">
                                    <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                        alt="Agus Setiawan">
                                    <div class="user-info">
                                        <h3>Agus Setiawan</h3>
                                        <h4>Game Developer</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Sebagai sesama developer, aku sangat menghargai kualitas kode dan dokumentasi yang
                                        diberikan
                                        CuyNest. Waktu kami outsourcing bagian AR-nya, hasilnya rapi dan mudah
                                        diintegrasikan. Tim mereka
                                        responsif banget kalau ada revisi minor. Bakal pakai jasa mereka lagi!</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <div class="game-info">
                                    <small>Proyek: <strong>Augmented Reality Integration</strong></small>
                                    <small>Teknologi: <strong>Unity AR Foundation</strong></small>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimoni 5 -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-header">
                                    <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                        alt="Dewi Kartika">
                                    <div class="user-info">
                                        <h3>Dewi Kartika</h3>
                                        <h4>Illustrator</h4>
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Kolaborasi dengan CuyNest untuk game art sangat menyenangkan! Mereka menghargai
                                        karya artist dan
                                        memberikan kebebasan berkreasi. Hasil akhirnya persis seperti yang dibayangkan,
                                        bahkan lebih bagus!
                                        Proses revisinya juga cepat dan jelas.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <div class="game-info">
                                    <small>Proyek: <strong>Character Design Pack</strong></small>
                                    <small>Jumlah karakter: <strong>12 designs</strong></small>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>

                    <!-- Custom Navigation -->
                    <!-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> -->
                </div>

                <div class="mt-5 text-center">
                    <a href="contact.html" class="btn btn-primary btn-lg">Ingin Berikan Testimoni?</a>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

    </main>
@endsection
