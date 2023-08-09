@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Daftar Panti Asuhan
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="col-6 mb-3">
            @if($panti->status == 'Waiting')
                @if($panti->diajukan == 0)
                    @if($panti->jumlah_anak == null || $panti->foto == null || $panti->surat_izin == null)
                        <h4 style="color:red">Data Panti Asuhan Belum Lengkap. Harap lengkapi terlebih dahulu agar dapat diproses oleh admin.</h4>
                    @else
                        <a href="{{ route('pelaksana.panti.panti.create', ['id' => $panti->id]) }}" class="btn btn-info btn-lg btn-block">
                            <i class="mdi mdi-plus-circle-outline"></i> Daftarkan panti
                        </a>
                    @endif
                @endif
            @endif
            <!-- <button type="button" class="btn btn-primary btn-lg btn-block">
                <i class="mdi mdi-plus-circle-outline"></i> Daftarkan Panti
            </button> -->
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="preview-subject">{{$panti->nama_panti}}</h6>
                            <div class="owl-carousel owl-theme full-width">
                                @foreach($panti->foto as $key=>$foto)
                                    <div class="item">
                                        <img style="width:100% !important; height: 450px !important" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" />
                                    </div>
                                @endforeach
                            </div>
                            @if($panti->status == 'Active')
                                <label class="badge badge-success">Diverifikasi Admin</label>
                            @elseif($panti->status == 'Waiting')
                                <label class="badge badge-warning">Menunggu Verifikasi Admin</label>
                            @else
                            <label class="badge badge-danger">Ditolak Admin</label>
                                <br>
                                <label class="mt-3">{{$donasi->catatan_status}}</label>
                            @endif
                            <div class="d-flex py-4">
                                <div class="preview-list w-100">
                                    <div class="preview-item p-0">
                                        <div class="preview-thumbnail">
                                        <img src="../../../assets/images/faces/face12.jpg" class="rounded-circle" alt="">
                                        </div>
                                        <div class="preview-item-content d-flex flex-grow">
                                            <div class="flex-grow">
                                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                    <h6 class="preview-subject">{{$panti->alamat}}</h6>
                                                    <h6 class="preview-subject"><b>Jumlah Anak : {{$panti->jumlah_anak}}</b></h6>
                                                </div>
                                                <p class="text-muted">{{$panti->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted">{{$panti->kontak}} </p>
                            <a href="{{ route('pelaksana.panti.panti.update.index', ['id' => $panti->id]) }}" class="btn btn-info btn-lg btn-block">
                                <i class="mdi mdi-tooltip-edit"></i> Kelola Panti
                            </a>
                            <!-- <div class="progress progress-md portfolio-progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @section('js')
        <script src="{{ asset('assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{ asset('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{ asset('assets/js/form-validation.js')}}"></script>
        <script src="{{ asset('assets/js/bt-maxLength.js')}}"></script>
        <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('assets/js/owl-carousel.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    @endsection
@endsection
