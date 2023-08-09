@extends('donatur.layout.core')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Panti Asuhan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Daftar Panti Asuhan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl bg-light my-5 py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Daftar Panti Asuhan</div>
            <h1 class="display-6 mb-5">Setiap anak berhak mendapatkan hidup yang layak</h1>
        </div>
        <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            @foreach($pantis as $panti)
                <div class="col-lg-4 col-md-6">
                    <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <h5 class="mb-3">{{ $panti->nama_panti }}</h5>
                        </div>
                        <div class="position-relative mt-auto">
                            <div id="carouselExampleControls-{{$panti->id}}" class="carousel slide" data-bs-ride="carousel">
                                <center>
                                    <div class="carousel-inner">
                                        @foreach($panti->foto as $key=>$foto)
                                            @if($key==0)
                                                <div class="carousel-item active">
                                                    <img style="height:300px;" class="d-block w-100 img-fluid" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" alt="">
                                                </div>
                                            @elseif($key!=0)
                                                <div class="carousel-item">
                                                    <img style="height:300px;" class="d-block w-100 img-fluid" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" alt="">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </center>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-{{$panti->id}}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-{{$panti->id}}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="causes-overlay">
                                <a class="btn btn-outline-primary" href="{{ route('donatur.panti.detail', ['id' => $panti->id]) }}">
                                    Selengkapnya
                                    <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $persen=0?>
            @endforeach
        </div>
    </div>
</div>
    
@endsection