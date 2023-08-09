@extends('donatur.layout.core')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Penggalangan Dana</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('donatur.donasi.index') }}">Penggalangan Dana</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('donatur.donasi.detail', ['id' => $penggalangan['id_penggalangan']]) }}">Detail Penggalangan Dana</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Pembayaran</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <center>
        @if($penggalangan['metode_pembayaran'] == 'qris')
            <div class="qris col-6" id="detail-qris">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="qris text-center" style="margin: 0 auto;">
                                <img src="{{ asset('assets/qris/barcode.png')}}" width="250" height="250" id="qr-code"/>
                                <button type="button" class="d-none btn-lanjut my-3" id="load-qris">Load QR Code</button>
                                <div class="text-center">Scan QRIS di atas menggunakan</div>
                                <div class="e-wallet">
                                    <img class="img-responsive" src="{{ asset('assets/qris/gopay.png')}}" width="50" height="50" alt="">
                                    <img class="img-responsive" src="{{ asset('assets/qris/dana.png')}}" width="50" height="50" alt="">
                                    <img class="img-responsive" src="{{ asset('assets/qris/linkaja.png')}}" width="50" height="50" alt="">
                                    <img class="img-responsive" src="{{ asset('assets/qris/ovo.png')}}" width="50" height="50" alt="">
                                    <img class="img-responsive" src="{{ asset('assets/qris/shopeePay.png')}}" width="50" height="50" alt="">
                                </div>
                            </div>
                            <div class="detail-qris col mt-4">
                                <div class="mx-4" style="margin: 0 auto;">
                                    <div class="row">
                                        <div class="col title-detail-qris">
                                            Merchant Name
                                        </div>
                                        <div class="value-detail-qris col text-right ">
                                            KHAIR					
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col title-detail-qris">
                                            NMID
                                        </div>
                                        <div class="value-detail-qris col text-right ">
                                            ID1023258571612
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col title-detail-qris">
                                            <span style="font-size:16px; font-weight: bold;">Total Payment </span>
                                        </div>
                                            <span style="font-size:16px; font-weight: bold;">{{$penggalangan['jumlah']}},-</span>
                                        </div>
                                        <hr>
                                        <p class="text-center">
                                            NB: Transaksi yang telah dibayarkan <b>Tidak Dapat Dibatalkan dengan Alasan Apapun</b>.<br>Dengan melakukan pembayaran berarti Anda telah mengerti dan menyetujui segala prosedur registrasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bsi col-6" id="detail-bsi">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="detail-qris col mt-4">
                                <div class="mx-4" style="margin: 0 auto;">
                                    <div class="row">
                                        <div class="col title-detail-qris">
                                            Nama Penerima
                                        </div>
                                        <div class="value-detail-qris col text-right ">
                                            Risti Ummul Khair					
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col title-detail-qris">
                                            NMID
                                        </div>
                                        <div class="value-detail-qris col text-right ">
                                            1046422631
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col title-detail-qris">
                                            <span style="font-size:16px; font-weight: bold;">Total Payment </span>
                                        </div>
                                        <div class="value-detail-qris col text-right ">
                                            <span style="font-size:16px; font-weight: bold;">{{$penggalangan['jumlah']}},-</span>
                                        </div>
                                        <hr>
                                        <p class="text-center">
                                            NB: Transaksi yang telah dibayarkan <b>Tidak Dapat Dibatalkan dengan Alasan Apapun</b>.<br>Dengan melakukan pembayaran berarti Anda telah mengerti dan menyetujui segala prosedur registrasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <form action="{{ route('donatur.donasi.create', [
            'id_penggalangan' => $penggalangan['id_penggalangan'],
            'nama' => $penggalangan['nama'],
            'email' => $penggalangan['email'],
            'jumlah' => $penggalangan['jumlah'],
            'metode_pembayaran' => $penggalangan['metode_pembayaran'],
            'kirim_email' => $penggalangan['kirim_email']
            ]) }}" method="POST" enctype="multipart/form-data" class="forms-sample" id="donasi">
            @csrf
            <div class="card mt-4 col-6">
                <div class="card-body">
                    <div class="row">
                        <h6 for="bukti_pembayaran">Upload Bukti Pembayaran</h6>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="bg-light" type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran"
                                        placeholder="Bukti Pembayaran" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                <button class="btn btn-primary px-5" style="height: 60px;">
                    Donasi Sekarang
                    <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                        <i class="fa fa-arrow-right"></i>
                    </div>
                </button>
            </div>
        </form>
    </center>
@endsection