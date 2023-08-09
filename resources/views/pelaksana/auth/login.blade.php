<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pelaksana - Daftar Panti Asuhan</title>
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
              <form action="{{ route('pelaksana.login.auth') }}" method="post">
                @csrf
                <div class="form-group">
                  <label>Username or email *</label>
                  <input type="text" name="username" class="form-control p_input" required>
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" name="password" class="form-control p_input" required>
                </div>
                <div class="text-center">
                  {{-- <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button> --}}
                  <button type="submit" class="btn btn-primary btn-block enter-btn" >Login</button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="{{ route('pelaksana.register') }}"> Register</a></p>
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
  @include('sweetalert::alert')
</body>
</html>
