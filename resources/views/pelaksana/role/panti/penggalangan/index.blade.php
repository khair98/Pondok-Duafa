@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Daftar Penggalangan Dana
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <style>
        .switch {
          position: relative;
          display: inline-block;
          width: 45px;
          height:26px;
        }
        .switch input {
          opacity: 0;
          width: 0;
          height: 0;
        }
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        .slider:before {
          position: absolute;
          content: "";
          height: 20px;
          width: 20px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        input:checked + .slider {
          background-color: #2196F3;
        }
        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
          -webkit-transform: translateX(20px);
          -ms-transform: translateX(20px);
          transform: translateX(20px);
        }
        /* Rounded sliders */
        .slider.round {
          border-radius: 26px;
        }
        .slider.round:before {
          border-radius: 50%;
        }
        </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="col-3 mb-3">
            <a href="{{ route('pelaksana.panti.penggalangan.create.index') }}" class="btn btn-info btn-lg btn-block">
                <i class="mdi mdi-plus-circle-outline"></i> Daftar Penggalangan
            </a>
            <!-- <button type="button" class="btn btn-primary btn-lg btn-block">
                <i class="mdi mdi-plus-circle-outline"></i> Daftarkan Panti
            </button> -->
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            @if($penggalangans->count() != null)
                                @foreach($penggalangans as $penggalangan)
                                    <div class="col-lg-4 col-md-6 mb-3">
                                        <div class="causes-item d-flex flex-column border-top border-5 border-primary rounded-top overflow-hidden h-100" style="background-color: #F9F5EB">
                                            <div class="text-center p-4 pt-0">
                                                <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                                                    <small style="color: black !important">{{ $penggalangan->panti->nama_panti }}</small>
                                                </div>
                                                <h5 class="mb-3" style="color: black !important">{{ $penggalangan->judul }}</h5>
                                                <p style="color: black !important">{{ $penggalangan->deskripsi }}</p>
                                                <div class="causes-progress bg-light p-3 pt-2">
                                                    <p class="text-dark"><small class="text-body" style="color: blue !important">Tujuan</small> Rp.{{ number_format($penggalangan->jumlah,2,',','.') }}</p>
                                                    <?php 
                                                        $total=0;
                                                        if($penggalangan->donasi->count() == 0){
                                                            $goal=0;
                                                            $persen=0;
                                                            $total=0;
                                                        }else{
                                                            foreach($penggalangan->donasi as $key=>$donasi){
                                                                $goal=$penggalangan->jumlah;
                                                                $jumlah=$donasi->jumlah;
                                                                $total=$total+$jumlah;
                                                                $persen=($total/$goal)*100;
                                                            }
                                                        }
                                                    ?>
                                                    <p class="text-dark"><small class="text-body" class="text-body" style="color: blue !important">Tercapai</small> Rp.{{ number_format($total,2,',','.') }}</p>
                                                    @if($total > $goal)
                                                        <div class="progress progress-lg mt-2">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-between">
                                                            <small class="text-body" style="color: blue !important">Persentase Terpenuhi</small>
                                                            <small class="text-body" style="color: blue !important">{{ round($persen, 3) }}%</small>
                                                        </div>
                                                        <div class="progress progress-lg mt-2">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ round($persen, 3) }}%" aria-valuenow="{{ round($persen, 3) }}" aria-valuemin="0" aria-valuemax="100">{{ round($persen, 3) }}%</div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="position-relative mt-auto">
                                                <img class="img-fluid" src="{{ asset('storage/foto penggalangan/' . $user->username .'/'.$penggalangan->panti->nama_panti .'/'. $penggalangan->foto)}}" alt="">
                                                <center>
                                                    <div class="causes-overlay m-3" style="justify-content:space-between;">
                                                        <a class="btn btn-outline-primary" href="{{ route('pelaksana.panti.penggalangan.update.index', ['id' => $penggalangan->id]) }}" style="width: 100%">
                                                            Perbarui
                                                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                                                <i class="fa fa-arrow-right"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </center>
                                                <center>
                                                    <div class="causes-overlay m-3" style="justify-content:space-between">
                                                        <a class="btn btn-primary" href="{{ route('pelaksana.panti.penggalangan.berita', ['id' => $penggalangan->id]) }}" style="width: 100%">
                                                            Update Kabar Terbaru
                                                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                                                <i class="fa fa-arrow-right"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @if($total > 100000)
                                                        <div class="causes-overlay m-3" style="justify-content:space-between">
                                                            <a class="btn btn-outline-primary" href="{{ route('pelaksana.panti.penggalangan.penarikan.dana', ['id' => $penggalangan->id]) }}" style="width: 100%">
                                                                Ajukan Penarikan Dana
                                                                <div class="d-inline-flex btn-sm-square bg-success text-white rounded-circle ms-2">
                                                                    <i class="fa fa-arrow-right"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if($penggalangan->waktu_selesai < Carbon\Carbon::now())
                                                        <div class="causes-overlay m-3" style="justify-content:space-between">
                                                            <a class="btn btn-info" href="{{ route('pelaksana.panti.penggalangan.laporan', ['id' => $penggalangan->id]) }}" style="width: 100%">
                                                                Upload Laporan Penggalangan
                                                                <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                                                    <i class="fa fa-arrow-right"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </center>
                                                <center>
                                                    <div class="ml-3">
                                                        @if($penggalangan->verif == 2)
                                                            <label class="badge badge-success">Diverifikasi Admin</label>
                                                        @elseif($penggalangan->verif == 0)
                                                            <label class="badge badge-warning">Menunggu Verifikasi Admin</label>
                                                        @else
                                                            <label class="badge badge-danger">Ditolak Admin</label>
                                                            <br>
                                                            <label class="mt-3">{{$penggalangan->catatan_verif}}</label>
                                                        @endif
                                                    </div>
                                                </center>
                                                <div class="causes-overlay" style="justify-content:space-between; margin:40px">
                                                    @if($penggalangan->verif == 2)
                                                        @if($penggalangan->status == 1)
                                                            <h6 class="mb-3" style="color: black">Status: <span style="color: green">Aktif</span></h6>
                                                            <div class="row">
                                                                <div class="col-10">
                                                                    <p style="color: black">Apakah Anda ingin menonaktifkan penggalangan dana?</p>
                                                                </div>
                                                                <div class="col-1">
                                                                    <form action="{{ route('pelaksana.panti.penggalangan.nonaktif', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample" onSubmit="return confirm('Apakah anda yakin ingin menonaktifkan panti?');" id="nonaktif">
                                                                        @csrf
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="status-nonaktif" name="status-nonaktif" checked>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <h6 class="mb-3" style="color: black">Status: <span style="color: red">Tidak Aktif</span></h6>
                                                            <div class="row">
                                                                <div class="col-10">
                                                                    <p style="color: black">Apakah Anda ingin mengaktifkan penggalangan dana?</p>
                                                                </div>
                                                                <div class="col-1">
                                                                    <form action="{{ route('pelaksana.panti.penggalangan.aktif', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample" onSubmit="return confirm('Apakah anda yakin ingin mengaktifkan panti?');" id="aktif">
                                                                        @csrf
                                                                        <label class="switch">
                                                                            <input type="checkbox" id="status-aktif" name="status-aktif">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <form id="aktif">
                                                            @csrf
                                                            <label class="switch">
                                                                <input type="checkbox" id="status-failed" name="status-failed" onclick="return false;">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $persen=0?>
                                @endforeach
                            @else
                                <p>Tidak Ada Data</p>
                            @endif
                        </div>
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
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <script>
            $("#status-aktif").change(function() {
                if(this.checked === true) {
                    $("#aktif").submit();
                }
            })
            $("#status-nonaktif").change(function() {
                if(this.checked === false) {
                    $("#nonaktif").submit();
                }
            })
            $("#status-failed").change(function() {
                alert("Anda tidak dapat mengaktifkan penggalangan dana jika Admin belum memverifikasi penggalangan dana! Penggalangan dana akan aktif otomatis jika admin telah memverifikasi penggalangan dana");
            })
            // public function fail() {
            //     alert("Anda tidak dapat mengaktifkan penggalangan dana jika Admin belum memverifikasi penggalangan dana! Penggalangan dana akan aktif otomatis jika admin telah memverifikasi penggalangan dana");
            // }
        </script>
    @endsection
@endsection
