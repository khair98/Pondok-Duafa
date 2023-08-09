@extends('donatur.layout.core')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Panti Asuhan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('donatur.panti.index') }}">Daftar Panti asuhan</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Detail Panti</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="center" style="display: flex; justify-content: center;">
        <div class="col-lg-8 col-md-8">
            <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                <div class="text-center">
                    <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                        <small>{{ $panti->nama_panti }}</small>
                    </div>
                    <h5 class="mb-3">{{ $panti->alamat }}</h5>
                    <p>{{ $panti->email }}</p>
                    <p>{{ $panti->kontak }}</p>
                    <p>{{ $panti->jumlah_anak }} anak</p>
                </div>
                <div class="position-relative mt-auto">
                    <div id="carouselExampleControls-{{$panti->id}}" class="carousel slide" data-bs-ride="carousel">
                        <center>
                            <div class="carousel-inner">
                                @foreach($panti->foto as $key=>$foto)
                                    @if($key==0)
                                        <div class="carousel-item active">
                                            <img style="height:900px; width:100%;margin:3%" class="d-block img-fluid" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" alt="">
                                        </div>
                                    @elseif($key!=0)
                                        <div class="carousel-item">
                                            <img style="height:900px;width:100%;margin:3%" class="d-block img-fluid" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" alt="">
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
                </div>
                <nav style="margin:3%">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tabs-order" data-bs-toggle="tab" data-bs-target="#tabs-1" type="button" role="tab" aria-controls="tabs-1" aria-selected="true">Profil
                        </button>
                        <button class="nav-link" id="nav-tab-manager" data-bs-toggle="tab" data-bs-target="#tabs-2" type="button" role="tab" aria-controls="tabs-2" aria-selected="false">Daftar Penggalangan Dana
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="myTabContent" style="margin:3%">
                    <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="tabs-tab1">
                        <small style="margin:3%"><?php echo $panti->profil?></small>
                    </div>
                    <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="tabs-2">
                        @if($penggalangans->count() != 0)
                            @include('donatur.layout.causes')
                        @else
                            <p>Belum Ada Penggalangan Dana</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Donate End -->
@endsection
<script>
    $("#mybut").click(function() {
        var sel = document.querySelector('#nav-tab-manager')
        bootstrap.Tab.getOrCreateInstance(sel).show()
    })
</script>