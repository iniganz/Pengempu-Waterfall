@extends('publik.layout.index')


@section('content')
<link rel="stylesheet" href="{{ asset('css/service-detail.css') }}">


<main id="main" class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 id="service-main-title">Service Details</h1>
              <p class="mb-0" id="service-subtitle">Loading service details...</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="/">Home</a></li>
            <li><a href="#" id="service-category-link">Services</a></li>
            <li class="current" id="current-service">Service Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">
      <div class="container">
        <div class="row gy-5">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="service-box">
              <h4>Services List</h4>
              <div class="services-list" id="services-list">
                <!-- Will be populated by JavaScript -->
              </div>
            </div>

            <div class="service-box">
              <h4>Download Catalog</h4>
              <div class="download-catalog" id="download-links">
                <!-- Will be populated by JavaScript -->
              </div>
            </div>

            <div class="help-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-headset help-icon"></i>
              <h4>Have a Question?</h4>
              <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>+62 878 2005
                  5714</span></p>
              <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <a
                  href="mailto:cuynestgame@.com">cuynestgame@.com</a></p>
            </div>
          </div>

          <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
            <img id="service-main-image" src="" alt="" class="img-fluid services-img">
            <h3 id="service-title">Service Title</h3>
            <p id="service-description">
              Loading service description...
            </p>
            <div class="service-features">
              <ul id="service-features-list">
                <!-- Will be populated by JavaScript -->
              </ul>
            </div>
            <div id="service-additional-content">
              <!-- Will be populated by JavaScript -->
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Service Details Section -->

  </main><!-- End #main -->
  <script src="{{ asset('js/service-detail.js') }}"></script>

@endsection
