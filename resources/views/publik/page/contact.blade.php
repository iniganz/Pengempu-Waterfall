@extends('publik.layout.index')

@section('content')
<main class="main">

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="section-title container" data-aos="fade-up">
            <p class="cuypy text-center">HUBUNGI KAMI</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- MAP -->
            <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                <iframe style="border:0; width: 100%; height: 270px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.308728100212!2d115.20089157575923!3d-8.46932968564576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd223428135bb67%3A0xbc9889d658b497a4!2sAir%20Terjun%20Pengempu!5e0!3m2!1sid!2sid!4v1766993101081!5m2!1sid!2sid"
                    allowfullscreen loading="lazy"></iframe>
            </div>

            <div class="row gy-4">

                <!-- INFO -->
                <div class="col-lg-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Alamat</h3>
                            <p>G6J3+798, Jl. Seribupati, Cau Belayu, Kec. Marga, Kabupaten Tabanan, Bali 82181</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Telepon</h3>
                            <p>(0361) 464700</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email</h3>
                            <p>waterfallpengempu@gmail.com</p>
                        </div>
                    </div>
                </div>

                <!-- FORM -->
                <div class="col-lg-8">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST"
                          data-aos="fade-up" data-aos-delay="200"
                          onsubmit="this.querySelector('button').disabled=true;
                                    this.querySelector('button').innerText='Mengirim...';">

                        @csrf
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name"
                                    class="form-control"
                                    placeholder="Nama Anda"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email"
                                    class="form-control"
                                    placeholder="Email Anda"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" name="subject"
                                    class="form-control"
                                    placeholder="Subjek Pesan"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <textarea name="message"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Tulis pesan Anda di sini..."
                                    required></textarea>
                            </div>

                            <div class="col-md-12 text-center button-css">
                                <button type="submit">
                                    Send Message
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
                <!-- END FORM -->

            </div>
        </div>

    </section>
</main>
@endsection
