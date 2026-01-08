@extends('publik.layout.index')


@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section class="hero section dark-background">

            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">


                <div class="carousel-item active">
                    <img src="assets/img/team/team.png" alt="">

                </div>
                <!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="assets/img/team/team2.jpg" alt="">

                </div>
            </div> <!-- End Carousel Item -->

            <!-- <div class="carousel-item">
                <img src="assets/img/hero-carousel/img3.jpg" alt="">



              </div> -->


            <div class="carousel-container">
                <!-- <h2 class="changing-text">CRAFTING <br> <span id="gsap-word">EXPERIENCE</span> <br> GAMES</h2> -->
                <h2 class="text-container">
                    PERUSAHAAN <br>
                    <!-- <span class="text-wrapper">
                    <span id="typed-text">INNOVATING</span>
                  </span> -->PENGEMBANGAN
                    <br> GAME TERKEMUKA
                </h2>


                <!-- <a href="#about" class="btn-get-started border border-white shadow-lg">GET STARTED NOW</a> -->
            </div>



        </section>
        <section id="about" class="about section">
            <div class="page-title" data-aos="fade">
                <div class="heading">
                    <div class="container">
                        <div class="row d-flex justify-content-center text-center">
                            <div class="col-lg-8">
                                <h1>Tentang <span style="color: #ffa200;">Kami</span></h1>
                                <p class="mb-0">Kami adalah CuyNest, studio pengembangan game yang menghadirkan pengalaman
                                    bermain
                                    inovatif dan seru.</p>
                                <h3>"Ciptakan, Mainkan, Taklukkan!"</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="breadcrumbs">
                    <div class="container">
                        <ol>
                            <li><a href="index.html">Beranda</a></li>
                            <li class="current">Tentang Kami</li>
                        </ol>
                    </div>
                </nav>
            </div>
            <!-- tentang kami -->

            <div class="contain">
                <div class="row align-items-center">
                    <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
                        <img src="/images/N2.png" class="img-fluid rounded shadow" alt="Tentang Kami">
                    </div>
                    <div class="col-lg-8 isi-about" data-aos="fade-left" data-aos-delay="200">
                        <h3><span class="icon-about"><i class="fas fa-building"></i></span> Siapa Kami?</h3>
                        <p>
                            Kami adalah CuyNest, sebuah studio pengembangan game yang berdedikasi untuk menciptakan
                            pengalaman
                            bermain
                            yang inovatif, mendalam, dan menghibur. Dengan tim yang terdiri dari para pengembang, desainer,
                            dan
                            kreator
                            berbakat, kami berkomitmen menghadirkan game berkualitas tinggi yang dapat dinikmati oleh pemain
                            di
                            seluruh
                            dunia. <br>
                            Melalui inovasi dan dedikasi, kami terus memperkuat posisi kami di industri game, menciptakan
                            pengalaman
                            bermain yang imersif, serta memperluas pengaruh kami tidak hanya di Asia Tenggara, tetapi juga
                            secara
                            global. Kami percaya bahwa game adalah media yang kuat untuk menginspirasi, menghibur, dan
                            menghubungkan
                            orang, dan kami berkomitmen untuk terus menciptakan game yang memukau dan bermakna bagi pemain
                            di
                            seluruh
                            dunia.
                        </p>

                        <h3><span class="icon-about"><i class="fas fa-rocket"></i></span></i> Visi Kami</h3>
                        <p>Menjadi salah satu studio game terkemuka yang menghadirkan pengalaman bermain yang imersif dan
                            tak
                            terlupakan di berbagai platform.</p>

                        <h3><span class="icon-about"><i class="fas fa-bullseye"></i></span> Misi Kami</h3>
                        <ul class="list-unstyled mt-3">
                            <li><i class="bi bi-check-circle text-info"></i> Mengembangkan game dengan kualitas grafis dan
                                gameplay
                                terbaik.</li>
                            <li><i class="bi bi-check-circle text-info"></i> Menciptakan dunia game yang menarik, penuh
                                tantangan,
                                dan berkesan.</li>
                            <li><i class="bi bi-check-circle text-info"></i> Mendukung komunitas gamer dengan update, event,
                                dan
                                interaksi yang aktif.</li>
                            <li><i class="bi bi-check-circle text-info"></i> Berinovasi dalam teknologi game untuk
                                memberikan
                                pengalaman bermain yang lebih interaktif dan realistis.</li>
                        </ul>

                        <h3><span class="icon-about"><i class="fas fa-route"></i></span> Perjalanan Kami</h3>
                        <p>Sejak didirikan pada tahun 2005, CuyNest terus berkembang dan beradaptasi dengan tren industri
                            untuk
                            menghadirkan pengalaman terbaik bagi para pemain. Dari proyek game indie pertama kami hingga
                            pengembangan
                            skala besar, setiap langkah yang kami ambil selalu berfokus pada kualitas dan inovasi. Dukungan
                            dari
                            komunitas menjadi motivasi utama kami untuk terus menciptakan game yang lebih baik di masa
                            depan.
                        </p>

                        <h3><span class="icon-about"><i class="fas fa-users"></i></span> Tim Kami</h3>
                        <p>Di balik setiap game yang kami buat, ada tim yang penuh dengan kreativitas, keahlian, dan passion
                            tinggi di
                            dunia game development. Dari desainer, pemrogram, musisi, hingga penulis cerita, kami bekerja
                            sama
                            untuk
                            menciptakan pengalaman bermain yang tak hanya menghibur, tetapi juga memiliki kedalaman cerita
                            dan
                            visual
                            yang memukau.</p>

                        <h3><span class="icon-about"><i class="fas fa-briefcase"></i></span> Bergabung dengan Kami</h3>
                        <p>Kami selalu mencari talenta baru yang siap membawa inovasi dalam dunia pengembangan game. Jika
                            kamu
                            memiliki passion dalam menciptakan game luar biasa, kunjungi halaman Karier kami dan temukan
                            kesempatan
                            untuk menjadi bagian dari CuyNest!</p>
                    </div>
                </div>
            </div>

        </section>


        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="section-title container" data-aos="fade-up">
                <h2>Tim</h2>
                <p>
                    Temui Tim Kami</p>
            </div><!-- End Section Title -->

            <div class="border-about container">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="assets/img/team/1.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href="https://www.youtube.com/@Yooofams"><i class="bi bi-youtube"></i></a>
                                    <a href="https://www.facebook.com/gandhi.gunadi.33/"><i class="bi bi-facebook"></i></a>
                                    <a href="https://www.instagram.com/deganz__/"><i class="bi bi-instagram"></i></a>
                                    <a href="https://wa.me/6287820055714/?text=Hi min, saya pelanggan di CuyNest."><i
                                            class="bi bi-whatsapp"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Lord D Gandhi</h4>
                                <span>Chief Executive Officer (CEO)</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Andy Lukito</h4>
                                <span>Chief Technology Officer (CTO)</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>KajewDev</h4>
                                <span>Chief Creative Officer (CCO)</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Masahiro Sakurai</h4>
                                <span>Chief Operating Officer (COO)</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img img1">
                                <img src="assets/img/team/team.png" class="img-fluid d-block mx-auto" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Tim 1 Meijin</h4>
                                <span>Member tim game developer 1</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img img1">
                                <img src="assets/img/team/team2.jpg" class="img-fluid d-block mx-auto" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Tim 2 Sakurai</h4>
                                <span>Member tim game developer 2</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section><!-- /Team Section -->

    </main>
@endsection
