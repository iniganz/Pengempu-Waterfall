@extends('publik.layout.index')


@section('content')
    <main class="main">

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="section-title container" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>Check our Portfolio</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-pc">PC & Console</li>
                        <li data-filter=".filter-hp">Mobile Games</li>
                        <li data-filter=".filter-aset">Game Assets</li>
                    </ul><!-- End Portfolio Filters -->
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pc">
                            <img src="assets/img/masonry-portfolio/pc1.jpg" class="img-fluid" alt="Sea Of Thief">
                            <div class="portfolio-info">
                                <h4>Sea OF Thief</h4>
                                <p>Ahoy!</p>
                                <a href="assets/img/masonry-portfolio/pc1.jpg" title="Sea OF Thief"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=1&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pc">
                            <img src="assets/img/masonry-portfolio/pc2.png" class="img-fluid" alt="Palword">
                            <div class="portfolio-info">
                                <h4>Palword</h4>
                                <p>Love That Game</p>
                                <a href="assets/img/masonry-portfolio/pc2.png" title="Palword"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=2&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pc">
                            <img src="assets/img/masonry-portfolio/pc3.jpg" class="img-fluid" alt="Grand Theft Auto V">
                            <div class="portfolio-info">
                                <h4>Grand Theft Auto V</h4>
                                <p>The Greet Game</p>
                                <a href="assets/img/masonry-portfolio/pc3.jpg" title="Grand Theft Auto V"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=3&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pc">
                            <img src="assets/img/masonry-portfolio/pc4.png" class="img-fluid" alt="Valorant">
                            <div class="portfolio-info">
                                <h4>Valorant</h4>
                                <p>FPS Game</p>
                                <a href="assets/img/masonry-portfolio/pc4.png" title="Valorant"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=4&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pc">
                            <img src="assets/img/masonry-portfolio/pc.png" class="img-fluid" alt="Stardew Valley">
                            <div class="portfolio-info">
                                <h4>Stardew Valley</h4>
                                <p>Chill Game</p>
                                <a href="assets/img/masonry-portfolio/pc.png" title="Stardew Valley"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=15&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pc">
                            <img src="assets/img/masonry-portfolio/hp.png" class="img-fluid" alt="Wuthering Waves">
                            <div class="portfolio-info">
                                <h4>Wuthering Waves</h4>
                                <p>MMOPRPG Game</p>
                                <a href="assets/img/masonry-portfolio/hp.png" title="Wuthering Waves"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=16&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-hp">
                            <img src="assets/img/masonry-portfolio/mobile1.jpg" class="img-fluid"
                                alt="Mobile Legends : Bang Bang">
                            <div class="portfolio-info">
                                <h4>Mobile Legends : Bang Bang</h4>
                                <p>5 VS 5</p>
                                <a href="assets/img/masonry-portfolio/mobile1.jpg" title="Mobile Legends : Bang Bang"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=5&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-hp">
                            <img src="assets/img/masonry-portfolio/mobile2.png" class="img-fluid" alt="Clash Of Clan">
                            <div class="portfolio-info">
                                <h4>Clash Of Clan</h4>
                                <p>The Old Greet Game</p>
                                <a href="assets/img/masonry-portfolio/mobile2.png" title="Clash Of Clan"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=6&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-hp">
                            <img src="assets/img/masonry-portfolio/mobile3.png" class="img-fluid"
                                alt="PlayerUnknown Battlegrounds Mobile">
                            <div class="portfolio-info">
                                <h4>PlayerUnknown Battlegrounds Mobile</h4>
                                <p>FPS Game</p>
                                <a href="assets/img/masonry-portfolio/mobile3.png"
                                    title="PlayerUnknown Battlegrounds Mobile" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=7&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-hp">
                            <img src="assets/img/masonry-portfolio/mobile4.png" class="img-fluid"
                                alt="Genshin Impact">
                            <div class="portfolio-info">
                                <h4>Genshin Impact</h4>
                                <p>Love That Game</p>
                                <a href="assets/img/masonry-portfolio/mobile4.png" title="Genshin Impact"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=8&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-hp">
                            <img src="assets/img/masonry-portfolio/mobile5.png" class="img-fluid"
                                alt="The Greedy Foxy">
                            <div class="portfolio-info">
                                <h4>The Greedy Foxy</h4>
                                <p>The Greet Nice Game</p>
                                <a href="assets/img/masonry-portfolio/mobile5.png" title="The Greedy Foxy"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=9&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-aset">
                            <img src="assets/img/masonry-portfolio/aset1.png" class="img-fluid" alt="Aset Game">
                            <div class="portfolio-info">
                                <h4>Aset Game</h4>
                                <p>3D & 2D Art</p>
                                <a href="assets/img/masonry-portfolio/aset1.png" title="Aset Game"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=10&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-aset">
                            <img src="assets/img/masonry-portfolio/aset2.jpg" class="img-fluid" alt="Aset Game">
                            <div class="portfolio-info">
                                <h4>Aset Game</h4>
                                <p>3D & 2D Art</p>
                                <a href="assets/img/masonry-portfolio/aset2.jpg" title="Aset Game"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=11&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-aset">
                            <img src="assets/img/masonry-portfolio/aset3.jpg" class="img-fluid" alt="Aset Game">
                            <div class="portfolio-info">
                                <h4>Aset Game</h4>
                                <p>3D & 2D Art</p>
                                <a href="assets/img/masonry-portfolio/aset3.jpg" title="Aset Game"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=12&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-aset">
                            <img src="assets/img/masonry-portfolio/aset4.jpg" class="img-fluid" alt="Aset Game">
                            <div class="portfolio-info">
                                <h4>Aset Game</h4>
                                <p>3D & 2D Art</p>
                                <a href="assets/img/masonry-portfolio/aset4.jpg" title="Aset Game"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=13&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-aset">
                            <img src="assets/img/masonry-portfolio/aset5.png" class="img-fluid" alt="Aset Game">
                            <div class="portfolio-info">
                                <h4>Aset Game</h4>
                                <p>3D & 2D Art</p>
                                <a href="assets/img/masonry-portfolio/aset5.png" title="Aset Game"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="/portfolio?product_id=14&category=pc" title="More Details"
                                    class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div><!-- End Portfolio Item -->
                     

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->
    </main>
@endsection
