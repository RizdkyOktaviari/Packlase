<title>Profile</title>
<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="{{asset('css/profile/profile.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('cropper/cropper.min.css')}}">
<style media="screen" type="text/css">
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn1 {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
</style>
@toastr_css
@livewireStyles
<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<script src="{{asset('cropper/cropper.min.js')}}"></script>
<script>


    window.addEventListener('closeModal', event => {
        $("#modalForm").modal('hide');
    })

    window.addEventListener('openModal', event => {
        $("#modalForm").modal('show');
    })

    window.addEventListener('closeModal_email', event => {
        $("#modalForm_email").modal('hide');
    })

    window.addEventListener('openModal_email', event => {
        $("#modalForm_email").modal('show');
    })

    window.addEventListener('closeModal_address', event => {
        $("#update_address").modal('hide');
    })

    window.addEventListener('openModal_address', event => {
        $("#update_address").modal('show');
    })

    window.addEventListener('closeModal_phoneNumber', event => {
        $("#update_phoneNumber").modal('hide');
    })

    window.addEventListener('openModal_phoneNumber', event => {
        $("#update_phoneNumber").modal('show');
    })

    window.addEventListener('closeModal_image', event => {
        $("#update_image").modal('hide');
    })

    window.addEventListener('openModal_image', event => {
        $("#update_image").modal('show');
    })

    window.addEventListener('closeModal_setting', event => {
        $("#update_setting").modal('hide');
    })

    window.addEventListener('openModal_setting', event => {
        $("#update_setting").modal('show');
    })

</script>
@toastr_js
@toastr_render
@livewireScripts

<body>
@yield('content')
<footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
      </div>
    </div>
  </footer>
</body>
