@extends('donatur.layout.core')
@section('content')
    @include('donatur.layout.page_header')
    <div class="center" style="display: flex; justify-content: center;">
        <div class="col-lg-8 col-md-8">
            <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                <div class="text-center">
                    <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                        <small>{{ $penggalangan->panti->nama_panti }}</small>
                    </div>
                    <h5 class="mb-3">{{ $penggalangan->judul }}</h5>
                    <p>{{ $penggalangan->deskripsi }}</p>
                    <div class="causes-progress bg-light p-3 pt-2">
                        <div>
                            <div class="d-flex justify-content-between">
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
                                <p class="text-dark"><small class="text-body">Tujuan</small> Rp.{{ number_format($penggalangan->jumlah,2,',','.') }}</p>
                                <p class="text-dark"><small class="text-body">Tercapai</small> Rp.{{ number_format($total,2,',','.') }}</p>
                            </div>
                        </div>
                        <div class="progress" style="margin-left:30px; margin-right:30px">
                            @if($persen != 0)
                                @if($total >= $goal)
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        <span>100 %</span>
                                    </div>
                                @else
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ round($persen, 3) }}" aria-valuemin="0" aria-valuemax="100">
                                        <span>{{ round($persen, 3) }} %</span>
                                    </div>
                                @endif
                            @else
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <span>0 %</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="position-relative mt-auto">
                    <img class="img-fluid" width="100%" src="{{ asset('storage/foto penggalangan/' . $penggalangan->panti->user->username .'/' .$penggalangan->panti->nama_panti . '/' .$penggalangan->foto)}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Donasi Sekarang</div>
                    <h1 class="display-6">Terima Kasih Atas Hasil Yang Dicapai Bersama Anda</h1>
                    <p class="mb-0">Satu rupiah dari Anda pasti berharga untuk mereka</p>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 bg-secondary p-5">
                        <form action="{{ route('donatur.donasi.payment', ['id_penggalangan' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample" id="donasi">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-light border-0" id="nama" name="nama" placeholder="Your Name" required>
                                        <label for="name">Nama</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="noname" onclick="tanpaNama()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Donasi Tanpa Menyebutkan Nama
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-light border-0" id="email" name="email" placeholder="Your Email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div> <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="checkbox" id="kirim_email" onclick="kirimEmail()" name="kirim_email">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Kirim Email Laporan Penggalangan Dana 
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="jumlah-default">
                                    <div class="btn-group d-flex justify-content-around">
                                        <input type="radio" class="btn-check" name="jumlahh" id="btnradio1" value="20000" checked>
                                        <label class="btn btn-light py-3" for="btnradio1">Rp.20.000,00</label>

                                        <input type="radio" class="btn-check" name="jumlahh" id="btnradio2" value="50000">
                                        <label class="btn btn-light py-3" for="btnradio2">Rp.50.000,00</label>

                                        <input type="radio" class="btn-check" name="jumlahh" id="btnradio3" value="100000">
                                        <label class="btn btn-light py-3" for="btnradio3">Rp.100.000,00</label>
                                    </div>
                                </div>
                                <div class="col-12" id="jumlahLainInput" style="display:none">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-light border-0" placeholder="Jumlah Lain" id="anotherCount" name="jumlah">
                                        <label for="name">Jumlah Lain</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="jumlahLainCheckBox" onclick="jumlahLain()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Jumlah lainnya
                                        </label>
                                    </div>
                                </div>
                                <small>Metode Pembayaran</small>
                                <div class="col-12">
                                    <div class="form-check btn-group d-flex justify-content-around">
                                        <label style="margin-right:2%">
                                            <input type="radio" name="metode_pembayaran" value="qris" onclick="clickQris()" id="qris">
                                            <img class="btn btn-light py-3" for="btnradiometode1" src="{{ asset('assets/qris/logo.png')}}" alt="Option 1" for="btnradio1" style="width:220px; height:150px;">
                                        </label>
                                        <label>
                                            <input type="radio" name="metode_pembayaran" value="bsi" onclick="clickBsi()" id="bsi">
                                            <img class="btn btn-light py-3" for="btnradiometode2" src="{{ asset('assets/qris/logo-bsi.png')}}" alt="Option 2" for="btnradio2" style="width:220px; height:150px;">
                                        </label>
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
                                <!-- <div class="col-12 text-center mt-3">
                                    <a class="btn btn-primary px-5" style="height: 60px;" href="{{ route('donatur.donasi.payment', ['id_penggalangan' => $penggalangan->id]) }}">
                                        Donasi Sekarang
                                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div> -->
                                <!-- <div class="qris" id="detail-qris" style="display:none">
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
                                                            <div class="value-detail-qris col text-right ">
                                                                <span style="font-size:16px; font-weight: bold;">Rp 34.096</span>
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
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
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
                                </div>
                                <div class="bsi" id="detail-bsi" style="display:none">
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
                                                               ID1023258571612
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col title-detail-qris">
                                                                <span style="font-size:16px; font-weight: bold;">Total Payment </span>
                                                            </div>
                                                            <div class="value-detail-qris col text-right ">
                                                                <span style="font-size:16px; font-weight: bold;">Rp 34.096</span>
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
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
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
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Donate End -->
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Kabar Terbaru
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @if($penggalangan->berita->count() !=null)
                                        @foreach($penggalangan->berita as $key=>$berita)
                                            <?php echo $berita->isi?>
                                            <hr>
                                        @endforeach
                                    @else
                                        <p><b>Belum ada kabar terbaru</b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Pencairan Dana
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @if($penggalangan->penarikan->count() !=null)
                                        @foreach($penggalangan->penarikan as $key=>$penarikan)
                                            <p><b>{{$penggalangan->panti->nama_panti}}</b> melakukan penarikan dana sebesar <b>Rp. {{number_format($penarikan->jumlah,2,',','.')}}</b></p>
                                            <hr>
                                        @endforeach
                                    @else
                                        <p><b>Belum ada penarikan dana</b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Donasi
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @if($penggalangan->donasi->count() !=null)
                                        @foreach($penggalangan->donasi as $key=>$donasi)
                                            <p><b>{{$donasi->nama}}</b> mendonasikan uang sebesar <b>Rp. {{number_format($donasi->jumlah,2,',','.')}}</b></p>
                                            <hr>
                                        @endforeach
                                    @else
                                        <p><b>Belum ada yang berdonasi</b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function jumlahLain() {
        var checkBox = document.getElementById("jumlahLainCheckBox");
        var jumlahLainInput = document.getElementById("jumlahLainInput");
        var jumlahDefault = document.getElementById("jumlah-default");
        // jumlahLainInput.style.display = "none";
        if (checkBox.checked == true){
            jumlahLainInput.style.display = "block";
            jumlahDefault.style.display = "none";
            $('#btnradio1').prop('checked', false);
            $('#btnradio2').prop('checked', false);
            $('#btnradio3').prop('checked', false);

            var rupiah = document.getElementById("anotherCount");
            rupiah.addEventListener("keyup", function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, "Rp. ");
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
            }
        } else {
            jumlahLainInput.style.display = "none";
            jumlahDefault.style.display = "block";
        }
    }
    function tanpaNama() {
        var checkBox = document.getElementById("noname");
        // var nama = document.getElementById("nama");
        // jumlahLainInput.style.display = "none";
        if (checkBox.checked == true){
            document.getElementById("nama").value = "Orang Baik";
        }else{
            document.getElementById("nama").value = "";
        }
    }

    function kirimEmail() {
        var checkBox = document.getElementById("kirim_email");
        // var nama = document.getElementById("nama");
        // jumlahLainInput.style.display = "none";
        if (checkBox.checked == true){
            document.getElementById("kirim_email").value = 1;
        }else{
            document.getElementById("kirim_email").value = 0;
        }
    }
    function clickQris() {
        var qris = document.getElementById("qris");
        var detailQris = document.getElementById("detail-qris");
        var detailBsi = document.getElementById("detail-bsi");
        // jumlahLainInput.style.display = "none";
        if (qris.checked == true){
            detailQris.style.display = "block";
            detailBsi.style.display = "none";
        } else {
            detailQris.style.display = "none";
            detailBsi.style.display = "block";
        }
    }
    function clickBsi() {
        var bsi = document.getElementById("bsi");
        var detailQris = document.getElementById("detail-qris");
        var detailBsi = document.getElementById("detail-bsi");
        // jumlahLainInput.style.display = "none";
        if (bsi.checked == true){
            detailBsi.style.display = "block";
            detailQris.style.display = "none";
        } else {
            detailBsi.style.display = "none";
            detailQris.style.display = "block";
        }
    }
</script>