<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('titless')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('img/favicons.png')}}" rel="icon">
    <link href="{{asset('img/favicons.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('SoftLand/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('SoftLand/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('SoftLand/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('SoftLand/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('SoftLand/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('SoftLand/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"  href="{{asset('rating/rating.css')}}"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @livewireStyles
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

    @yield('content')

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
    <script src="{{asset('SoftLand/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('SoftLand/assets/js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="{{asset('rating/rating_review.js')}}"></script>
    <script src="{{asset('bs4/build/bootstrap4-rating-input.min.js')}}"></script>
    <script src="{{asset('bs4/src/bootstrap4-rating-input.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
     $(function(){
        $('#ratingme').rating();

        // $( "a" ).click(function(){
        //  alert($('#ratingme').val());
        // });
     });
    </script>
    <script>
        //Close Modal Rating Di Riwayat Transaksi
        // window.addEventListener('closeModal_rt_laundry', event => {
        //     $("#detail_laundry").modal('hide');
        // })

    </script>
    <script type="text/javascript">
      window.addEventListener("load", function () {
        const loader = document.querySelector(".loader");
        loader.className += " hidden"; // class "loader hidden"
      });
    </script>
    @yield('js')
    @livewireScripts
  </body>
</html>
