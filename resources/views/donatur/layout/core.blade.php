<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PondokDuafa - Free Nonprofit Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/donatur/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Edu+NSW+ACT+Foundation&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/donatur/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/donatur/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/donatur/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/donatur/css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png')}}" />
    <style type="text/css">
        .display-4{
            font-family: 'Delicious Handrawn', cursive;
        }
        .display-6{
            font-family: 'Delicious Handrawn', cursive;
            font-size:48px;
        }
        #more {display: none;}
        /* .fs-5{
            font-family: 'Edu NSW ACT Foundation', cursive;
        } */
        .btn-load-more {
            font-size: 14px;
            color: #fff;
            background-color: #00712c;
            border: 0;
            outline: 0;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }
        .btn-load-more:hover { background-color: #00481c; }
        [type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@example.com</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h5 class="fw-bold text-primary m-0">Pondok<span class="text-white">Duafa</span></h5>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ route('index') }}" class="nav-item nav-link {{Route::currentRouteName() == 'index' ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('donatur.panti.index') }}" class="nav-item nav-link {{(Route::currentRouteName() == 'donatur.panti.index'|Route::currentRouteName() == 'donatur.panti.detail') ? 'active' : '' }}">Daftar Panti Asuhan</a>
                    <a href="{{ route('donatur.donasi.index') }}" class="nav-item nav-link {{(Route::currentRouteName() == 'donatur.donasi.index'|Route::currentRouteName() == 'donatur.donasi.detail') ? 'active' : '' }}">Penggalangan Dana</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="service.html" class="dropdown-item">Service</a>
                            <a href="donate.html" class="dropdown-item">Donate</a>
                            <a href="team.html" class="dropdown-item">Our Team</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div> -->
                    <a href="{{ route('donatur.menu.about') }}" class="nav-item nav-link {{Route::currentRouteName() == 'donatur.menu.about' ? 'active' : '' }}">Tentang Kami</a>
                    <a href="{{ route('donatur.menu.contact') }}" class="nav-item nav-link {{Route::currentRouteName() == 'donatur.menu.contact' ? 'active' : '' }}">Kontak Kami</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn btn-outline-primary py-2 px-3" href="{{ route('pelaksana.register') }}">
                        Daftar
                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-4">
                    <h1 class="fw-bold text-primary mb-4">Pondok<span class="text-white">Duafa</span></h1>
                    <p>Kebaikan tanpa putus, pahala mengalir terus</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="text-light mb-4">Alamat</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Pontianak, Kalimantan Barat, Indonesia</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+628979840299</p>
                    <p><i class="fa fa-envelope me-3"></i>ristiummulkhair98@gmail.com</p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="text-light mb-4">Link</h5>
                    <a class="btn btn-link" href="">Tentang Kami</a>
                    <a class="btn btn-link" href="">Kontak Kami</a>
                    <a class="btn btn-link" href="">Layanan</a>
                    <a class="btn btn-link" href="">Syarat & Ketentuan</a>
                    <a class="btn btn-link" href="">Bantuan</a>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        use App\Models\Penggalangan;
        use App\Models\Donasi;
        use App\Models\Panti;
        $penggalangans=Penggalangan::where('verif', 2)->get();
        $donasis = Donasi::where('verif', 2)->get();
        $monthlyDonationTotal = [];

        // Inisialisasi total donasi setiap bulan menjadi 0
        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $monthlyDonationTotal[$month] = 0;
        }

        foreach ($donasis as $donasi) {
            $month = date('F', strtotime($donasi->created_at));
            $amount = $donasi->jumlah;
            
            if (isset($monthlyDonationTotal[$month])) {
                $monthlyDonationTotal[$month] += $amount;
            }
        }

        $months = array_keys($monthlyDonationTotal);
        $donationTotals = array_values($monthlyDonationTotal);

        // dd($donasi);
        $arr =array();
        $months = array();
        foreach($penggalangans as $key=>$donasi){
            $jumlah=0;
            foreach($donasi->donasi as $k=>$donasi){
                $total=$donasi->jumlah;
                $jumlah=$total+$jumlah;
            }
            $arrLength=array_push($arr, $jumlah);
            rsort($arr);
        }
    ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('sweetalert::alert')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/donatur/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('assets/donatur/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('assets/donatur/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/donatur/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/donatur/lib/parallax/parallax.min.js')}}"></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/donatur/js/main.js')}}"></script>
    <!-- Read More Button Start-->
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script>
        $(function () {
            var arr = {!! json_encode($arr) !!};
            var months = {!! json_encode($months) !!};
            var donationTotals = {!! json_encode($donationTotals) !!};

            var categories = {!! json_encode($penggalangans->map(function($penggalangan) { return $penggalangan->judul . ' (' . $penggalangan->panti->nama_panti . ')'; })) !!};

            var chartOptions = {
                chart: {
                    type: 'column',
                    renderTo: 'containerPerbulan'
                },
                title: {
                    text: 'Banyaknya Donasi per Bulan'
                },
                xAxis: {
                    categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                },
                yAxis: {
                    min: 0,
                    max: 50000000,
                    title: {
                        text: 'Jumlah Donasi'
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000000 + ' juta';
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.1,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Jumlah Donasi',
                    data: donationTotals
                }]
            };
            
            var chart = new Highcharts.Chart(chartOptions);

            var chartOptions = {
                chart: {
                    type: 'column',
                    renderTo: 'containerTerbanyak'
                },
                title: {
                    text: 'Insight Donasi'
                },
                xAxis: {
                    categories: categories
                },
                yAxis: {
                    min: 0,
                    max: 50000000,
                    title: {
                        text: 'Jumlah Donasi'
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000000 + ' juta';
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Donasi',
                    data: arr
                }]
            };

            var chart = new Highcharts.Chart(chartOptions);
        });
    </script>

    <!-- Read More Button End -->
</body>
</html>