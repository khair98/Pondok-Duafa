@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Penarikan Dana
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card corona-gradient-card mb-3">
                            <div class="card-body">
                                <div class="card-text">
                                    <h4 class="card-title">Pengajuan Penarikan Dana</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-secondary">
                            <div class="card-body">
                            <h6 class="p-3 rounded bg-info" for="detail_capaian" style="margin-top:36px">Detail Pencapaian Penggalangan Dana</h6>
                                <div class="causes-progress p-3 pt-2">
                                    <p class="text-dark"><span class="text-body" style="color: blue !important">Tujuan</span><b> Rp.{{ number_format($penggalangan->jumlah,2,',','.') }}</b></p>
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
                                    <p class="text-dark">
                                        <span class="text-body" class="text-body" style="color: blue !important">Tercapai</span>
                                        <b> Rp.{{ number_format($total,2,',','.') }}<b>
                                    </p>
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
                                <h6 class="p-3 rounded bg-info" for="detail_penarikan" style="margin-top:36px">Detail Penarikan Dana</h6>
                                <?php
                                    $totalPenarikan=0;
                                    if($penarikans->count() == 0){
                                        $jumlahPenarikan=0;
                                        $totalPenarikan=$totalPenarikan+$jumlahPenarikan;
                                        $persenPenarikan=($totalPenarikan/$total)*100;
                                    }else{
                                        foreach($penarikans as $key=>$penarikan){
                                            $jumlahPenarikan=$penarikan->jumlah;
                                            $totalPenarikan=$totalPenarikan+$jumlahPenarikan;
                                            $persenPenarikan=($totalPenarikan/$total)*100;
                                        }
                                    }
                                ?>
                                @foreach($penarikans as $key=>$penarikan)
                                    <p class="text-dark m-3 mt-3">
                                        <small class="text-body" class="text-body" style="color: blue !important">Terdapat Penarikan Dana Sebesar</small>
                                        <b> Rp.{{ number_format($penarikan->jumlah,2,',','.') }}</b> 
                                        <small class="text-body" class="text-body" style="color: blue !important">pada {{$penarikan->created_at}}</small>
                                    </p>
                                @endforeach
                                <hr class="m-3 mt-2" style="border: 1px solid black;">
                                <div class="causes-progress p-3 pt-2">
                                    <p class="text-dark"><span class="text-body" style="color: blue !important">Tercapai</span><b> Rp.{{ number_format($total,2,',','.') }}</b></p>
                                    <p class="text-dark"><span class="text-body" style="color: blue !important">Total Pencairan Dana</span><b> Rp.{{ number_format($totalPenarikan,2,',','.') }}</b></p>
                                    @if($totalPenarikan > $total)
                                        <div class="progress progress-lg mt-2">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-between">
                                            <small class="text-body" style="color: blue !important">Persentase Penarikan Dana dari jumlah dana terkumpul</small>
                                            <small class="text-body" style="color: blue !important">{{ round($persenPenarikan, 3) }}%</small>
                                        </div>
                                        <div class="progress progress-lg mt-2">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ round($persenPenarikan, 3) }}%" aria-valuenow="{{ round($persenPenarikan, 3) }}" aria-valuemin="0" aria-valuemax="100">{{ round($persenPenarikan, 3) }}%</div>
                                        </div>
                                    @endif
                                </div>
                                <h6 class="p-3 rounded bg-info" for="penarikan_dana" style="margin-top:36px">Formulir Pengajuan Penarikan Dana</h6>
                                <div class="form p-3 pt-2" style="color:black">
                                    <form action="{{ route('pelaksana.panti.penggalangan.ajukan.penarikan.dana', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                        @csrf
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" class="form-control border-0" placeholder="Jumlah.." id="jumlah" name="jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama di Rekening</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama di rekening.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Nama Bank</label>
                                            <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Nama Bank.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Nomor Rekening Penerima</label>
                                            <input type="number" class="form-control" id="no_rekening" name="no_rekening" placeholder="Nomor Rekening Penerima.." required>
                                        </div>
                                        <div class="form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                            <input onclick="snk()" type="checkbox" class="form-check-input" id="snkCheckBox"> Saya setuju dengan syarat dan ketentuan yang ada </label>
                                        </div>
                                        <button disabled type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
                                        <!-- <button type="submit" class="btn btn-primary mr-2 m-3">Submit</button> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        var rupiah = document.getElementById("jumlah");
        console.log('rupiah', rupiah)
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
        $('#btncheck').removeAttr('disabled');
        function snk() {
            var snkCheckBox = document.getElementById("snkCheckBox");
            console.log('a')
            // jumlahLainInput.style.display = "none";
            if (snkCheckBox.checked == true){
                $('#btnSubmit').removeAttr('disabled');
            } else {
                $('#btnSubmit').attr("disabled","disabled");
            }
        }
    </script>
@endsection
