<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pondok Duafa | @yield('title')</title>
        @include('pelaksana.layout.meta.index')
        @include('pelaksana.layout.icon.index')
        @include('pelaksana.layout.css.index')
        @yield('css')
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            @include('pelaksana.layout.navigation.index')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/faces/user.png')}}" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                            <div class="navbar-profile">
                                <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/user.png')}}" alt="">
                                <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                            </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                            <h6 class="p-3 mb-0">Profile</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-success"></i>
                                </div>
                                </div>
                                <div class="preview-item-content">
                                <p class="preview-subject mb-1">Settings</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('pelaksana.logout') }}" method="POST">
                                @csrf
                                <a class="dropdown-item preview-item" href="#" onclick="this.closest('form').submit()">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </form>
                            <div class="dropdown-divider"></div>
                            <p class="p-3 mb-0 text-center">Advanced settings</p>
                            </div>
                        </li>
                    </ul>
                </div>
                </nav>
                <!-- partial -->
                <div class="main-panel">
                    @yield('content')
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © pondok duafa 2023</span>
                        </div>
                    </footer>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        @include('pelaksana.layout.js.index')
        @include('sweetalert::alert')
        @yield('js')
    </body>
</html>