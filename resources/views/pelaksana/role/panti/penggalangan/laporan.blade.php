@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Laporan Penggalangan Dana
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="card corona-gradient-card mb-3">
                    <div class="card-body">
                        <div class="card-text">
                            <h4 class="card-title">Foto Penggalangan Dana</h4>
                        </div>
                    </div>
                </div>
                <div id="lightgallery" class="row lightGallery">
                    <?php $user= DB::table('penggalangans')
                            ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                            ->join('users', 'pantis.id_user', 'users.id')
                            ->where('penggalangans.id', $penggalangan->id)
                            ->first();
                    ?>
                    <a href="{{ asset('storage/foto penggalangan/' . $user->username .'/'.$penggalangan->panti->nama_panti .'/'. $penggalangan->foto)}}" class="image-tile"><img style="height:250px;" src="{{ asset('storage/foto penggalangan/' . $user->username .'/'.$penggalangan->panti->nama_panti .'/'. $penggalangan->foto)}}" alt="image small"></a>
                </div>
                <div class="card corona-gradient-card mb-3">
                    <div class="card-body">
                        <div class="card-text">
                            <h4 class="card-title">Detail Penggalangan Dana</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Panti Asuhan</td>
                            <td>{{ $penggalangan->panti->nama_panti }}</td>
                        </tr>
                        <tr>
                            <td>Judul Penggalangan Dana</td>
                            <td>{{ $penggalangan->judul }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $penggalangan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>{{ $penggalangan->jumlah }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ $penggalangan->waktu_mulai }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ $penggalangan->waktu_selesai }}</td>
                        </tr>
                        <tr>
                            <td>Format Laporan</td>
                            <td>
                                <a href="{{ route('pelaksana.panti.penggalangan.downloadFormatLaporan', ['id' => $penggalangan->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                    style="margin-bottom:24px" target="_blank">
                                    <i class="mdi mdi-downloadopacity-50 me-1"></i>
                                    Download Format Laporan
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Laporan</td>
                            <td>
                                @if($penggalangan->laporan == null)
                                    <h6 style="color:black">Tidak ada laporan</h6>
                                @else
                                    <a href="{{ route('pelaksana.panti.penggalangan.downloadLaporan', ['id' => $penggalangan->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                        style="margin-bottom:24px" target="_blank">
                                        <i class="mdi mdi-download opacity-50 me-1"></i>
                                        Download Laporan
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <form action="{{ route('pelaksana.panti.penggalangan.uploadLaporan', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <tr>
                                <td>Upload Laporan</td>
                                <td>
                                    <input type="file" class="form-control" name="laporan" id="laporan"
                                        placeholder="Laporan..." required>
                                    <span id="error-message-laporan" class="validation-error-label"></span>
                                    <br>
                                    <p style="color:red">*Pastikan file berformat pdf/doc/docx</p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" id="btnSubmit" class="btn btn-primary mr-2 mt-3">Submit</button></td>
                            </tr>
                        </form>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#laporan').on('change',function(){
            myfiles = $(this).val();
            var ext = myfiles.split('.').pop();
            if(ext == "pdf" || ext == "doc" || ext == "docx" || ext == "PDF" || ext == "DOC" || ext == "DOCX"){
                $('#error-message-laporan').css("display","none");
            }else{
                $('#error-message-laporan').html("File harus berformat pdf/doc/docx!");
                $('#error-message-laporan').css("display","block");
                $('#error-message-laporan').css("color","red");
            }
        });
    </script>
@endsection
