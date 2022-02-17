<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Layanan</title>

        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">Packclese</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home
                      <span class="sr-only">(current)</span>
                    </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Layanan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Riwayat Transaksi</a>
              </li>
              @if (Route::has('login'))
                @auth
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      {{Auth::user()->name}}
                      <img class="img-profile rounded-circle" src="{{asset(Auth::user()->profile_photo_path)}}" width="25" height="25">
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Profile</a>
                      <a class="dropdown-item" href="#">Pengaturan</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Keluar</a>
                    </div>
                  </li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                @else
                  <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                  </li>
                @endauth
              @endif
            </ul>
          </div>
        </div>
        </nav>
        @yield('layananContent')
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>

        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    </body>
</html>
