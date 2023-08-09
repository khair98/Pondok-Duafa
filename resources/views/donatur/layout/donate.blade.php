
<div class="container-fluid donate my-5 py-5" data-parallax="scroll" data-image-src="{{ asset('assets/donatur/img/carousel-2.jpg')}}">
    <div class="container py-5">
    <div class="row g-5 align-items-center">
    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="h-100 bg-secondary p-3">
                <div class="row m-3" data-toggle="appear">
                    <!-- <canvas id="barChart"></canvas> -->
                    <div id="containerPerbulan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="h-100 bg-secondary p-3">
                <div class="row m-3" data-toggle="appear">
                    <!-- <canvas id="barChart"></canvas> -->
                    <div id="containerTerbanyak" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@include('donatur.layout.js.index')
@yield('js')
