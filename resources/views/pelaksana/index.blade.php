<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @role('admin')
    <title>Admin - Daftar Panti Asuhan</title>
  @endrole
  @role('panti')
    <title>Panti - Daftar Panti Asuhan</title>
  @endrole
  <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link rel="shortcut icon" href="{{ asset('assets/images/fav.png')}}" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form>
                <div class="form-group">
                  <label>Username or email *</label>
                  <input type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="text" class="form-control p_input">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  {{-- <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button> --}}
                  <a class="btn btn-primary btn-block enter-btn" >Login</a>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook mr-2 col">
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('assets/js/misc.js')}}"></script>
  <script src="{{ asset('assets/js/settings.js')}}"></script>
  <script src="{{ asset('assets/js/todolist.js')}}"></script>
</body>
</html>
