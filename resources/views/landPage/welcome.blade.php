@extends('../landPage/layouts/master')

@section('container')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Selamat Datang</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Ini adalah Sistem Informasi Pengajuan Sidang TA</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="#" class="btn-get-started scrollto">Get Started</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="../assets2/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

</section><!-- End Hero -->

@endsection