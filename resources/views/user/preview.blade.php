@extends('layouts.welcome')
@section('titels', 'Packlese')
@section('section')
<main id="main">
  <!-- ======= Home Section ======= -->
  <section class="section">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-5" data-aos="fade-up">
        <h2 class="section-heading" id="section-heading">Packclese</h2><br>
        <p>Tujuan yang akan dicapai adalah menyediakan jasa yang dapat membantu berjalannya kegiatan domestik dengan cepat dan terpercaya, sehingga pengguna dapat produktif beraktivitas seperti biasanya. PACKCLESE berusaha menjadi penyedia jasa bantu kegiatan domestik dengan ongkos yang terjangkau bagi mahasiswa dan masyarakat luas.</p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row justify-content-center text-center mb-5" data-aos="fade">
        <div class="col-md-6 mb-5">
          <img src="{{asset('img/apps.svg')}}" alt="Image" class="img-fluid">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="step">
            <span class="number">01</span>
            <h3>Download</h3>
            <p>Download aplikasi di playstore anda.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="step">
            <span class="number">02</span>
            <h3>Sign Up</h3>
            <p>Silahkan registrasi terlebih dahulu.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="step">
            <span class="number">03</span>
            <h3>Enjoy the app</h3>
            <p>Selamat menikmati jasa layanan kami.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="service1">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 me-auto">
          <h3 class="mb-4">{{$jenisLayanan[0]->jenis}}</h3>
          <p class="mb-4">{{$jenisLayanan[0]->description}}</p>
          <p><a href="{{route('laundry')}}" class="btn btn-primary">Detail</a></p>
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <img src="{{asset($jenisLayanan[0]->picturePath)}}" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </section>
  <section class="section" >
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 ms-auto order-2">
          <h2 class="mb-4">{{$jenisLayanan[1]->jenis}}</h2>
          <p class="mb-4">{{$jenisLayanan[1]->description}}</p>
          <p><a href="{{route('bersih')}}" class="btn btn-primary">Detail</a></p>
        </div>
        <div class="col-md-6" data-aos="fade-right">
          <img src="{{asset($jenisLayanan[1]->picturePath)}}" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 me-auto">
          <h2 class="mb-4">{{$jenisLayanan[2]->jenis}}</h2>
          <p class="mb-4">{{$jenisLayanan[2]->description}}</p>
          <p><a href="{{route('paket')}}" class="btn btn-primary">Detail</a></p>
        </div>
        <div class="col-md-6" data-aos="fade-right">
          <img src="{{asset($jenisLayanan[2]->picturePath)}}" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 ms-auto order-2">
          <h2 class="mb-4">{{$jenisLayanan[3]->jenis}}</h2>
          <p class="mb-4">{{$jenisLayanan[3]->description}}</p>
          <p><a href="{{route('titip')}}" class="btn btn-primary">Detail</a></p>
        </div>
        <div class="col-md-6" data-aos="fade-right">
          <img src="{{asset($jenisLayanan[3]->picturePath)}}" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>
  </section>


    <!-- ======= Testimonials Section ======= -->
    <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">Komentar Customer</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-7">

            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">
                @if(count($komentar) == 0)
                <div class="swiper-slide">
                  <div class="review text-center">
                    <p class="stars">
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill muted"></span>
                    </p>
                    <blockquote>
                      <p>Komentar Customer</p>
                    </blockquote>

                    <p class="review-user">
                      <img src="#" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Anonymous</span>, &mdash; User
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->
                @else
                @foreach($komentar as $komen)
                <div class="swiper-slide">
                  <div class="review text-center">
                    <blockquote>
                      <p>{{$komen->komentar}}</p>
                    </blockquote>

                    <p class="review-user">
                      <img src="{{asset('storage/'.$komen->User->profile_photo_path)}}" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">{{$komen->User->name}}</span>, &mdash; User
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->
                @endforeach
                @endif

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

  <!-- ======= CTA Section ======= -->
  <section class="section cta-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2>Coba Aplikasi Sekarang</h2>
        </div>
        <div class="col-md-5 text-center text-md-end">
          <p> <a href="https://drive.google.com/drive/folders/1nrR6lInu59_xoBl03bhCMaQG5SWMWeBF?usp=sharing" target="_blank" class="btn d-inline-flex align-items-center"><i class="bx bxl-play-store"></i><span>Google play</span></a></p>
        </div>
      </div>
    </div>
  </section><!-- End CTA Section -->



</main><!-- End #main -->
@endsection
