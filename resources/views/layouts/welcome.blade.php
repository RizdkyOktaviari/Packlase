<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('titels')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('img/favicons.png')}}" rel="icon">
  <link href="{{asset('img/favicons.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('SoftLand/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('SoftLand/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('SoftLand/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('SoftLand/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('SoftLand/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('SoftLand/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>
  <!-- Loader animation start   -->
  <div class="loader">
      <div class="preload-animation">
          <!-- <div class="preload-image">
              <center><img src="{{asset('img/logo.png')}}" alt=""></center>
          </div> -->
          <div class="loading-bar">
              <div class="blue-bar"></div>
          </div>
      </div>
  </div>
  <!-- end of Loader animation -->
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    @include('layouts.user.navbar')
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section class="hero-section" id="hero">

    <div class="wave">

      <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
          </g>
        </g>
      </svg>

    </div>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 hero-text-image">
          <div class="row">
            <div class="col-lg-8 text-center text-lg-start">
              <h1 data-aos="fade-right">Packlese</h1>
              <p class="mb-5" data-aos="fade-right" data-aos-delay="100">Kemas, Ringkas, Tangkas!</p>
              <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><a href="#service1" class="btn btn-outline-white">Mulai</a></p>
            </div>
            <div class="col-lg-4 iphone-wrap">
              <img src="{{asset('img/soft/phone_2.png')}}" alt="Image" class="phone-1" data-aos="fade-right">
              <img src="{{asset('img/soft/phone_1.png')}}" alt="Image" class="phone-2" data-aos="fade-right" data-aos-delay="200">
            </div>
          </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  @yield('section')
  <!-- ======= Footer ======= -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <h3>About Packclese</h3>
          <p>Packlese adalah Jasa layanan jasa penitipan barang, motor, bersih - bersih rumah, laundry dan lain sebagainya</p>
        </div>
        <div class="col-md-auto ms-auto">
          <a href="#"><span class="bi bi-envelope"> packclese2021@gmail.com</span></a>
          <div class="col-md-auto ms-auto">
            <a href="#"><span class="bi bi-facebook"> PACKCLESE</span></a>
            <div class="col-md-auto ms-auto">
              <a href="#"><span class="bi bi-whatsapp"> +6281411822</span></a>
              <div class="col-md-auto ms-auto">
                <a href="#"><span class="bi bi-instagram"> @packclese</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center text-center">
      <div class="col-md-7">
        <p class="copyright">&copy; Copyright Packclese. All Rights Reserved</p>
        <div class="credits">
        </div>
      </div>
    </div>

    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('SoftLand/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('SoftLand/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('SoftLand/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('SoftLand/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('SoftLand/assets/js/main.js')}}"></script>
  <script type="text/javascript">
    window.addEventListener("load", function () {
      const loader = document.querySelector(".loader");
      loader.className += " hidden"; // class "loader hidden"
    });
  </script>

</body>

</html>
