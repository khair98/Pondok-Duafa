@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Detail Panti Asuhan
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
                            <h4 class="card-title">Foto Panti Asuhan</h4>
                            <p class="card-text"> Klik Foto untuk melihat detail</p>
                        </div>
                    </div>
                </div>
                <div id="lightgallery" class="row lightGallery">
                    @foreach($foto as $key=>$foto)
                        <a href="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" class="image-tile"><img style="height:250px;" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" alt="image small"></a>
                    @endforeach
                </div>
                <div class="card corona-gradient-card mb-3">
                    <div class="card-body">
                        <div class="card-text">
                            <h4 class="card-title">Detail Panti Asuhan</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Panti</td>
                            <td>{{ $panti->nama_panti }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $panti->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $panti->email }}</td>
                        </tr>
                        <tr>
                            <td>Kontak</td>
                            <td>{{ $panti->kontak }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Anak</td>
                            <td>{{ $panti->jumlah_anak }}</td>
                        </tr>
                        <tr>
                            <td>Surat Izin</td>
                            <td>
                                @if($panti->surat_izin != null)
                                    <a href="{{ route('pelaksana.admin.panti.downloadSuratIzin', ['id' => $panti->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                        target="_blank">
                                        <i class="mdi mdi-download opacity-50 me-1"></i>
                                        Download Surat Izin panti Asuhan
                                    </a>
                                @else
                                    <p style="color:red">Tidak ada surat izin</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            @if($panti->status == 'Active')
                                <td><label class="badge badge-success">Aktif</label></td>
                            @elseif($panti->status == 'Waiting')
                                <td><label class="badge badge-warning">Menunggu Verifikasi</label></td>
                            @else
                                <td>
                                    <label class="badge badge-danger">Tidak Aktif</label>
                                    <br>
                                    <label class="mt-3">{{$panti->catatan_status}}</label>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="col-12 mb-3">
                    @if($panti->status =='Waiting')
                        <a href="{{ route('pelaksana.admin.panti.verif', ['id' => $panti->id]) }}" class="btn btn-info btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Verifikasi
                        </a>
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#tolakPanti"
                            data-bs-whatever="Penolakan Pendaftaran Panti Asuhan" data-toggle="tooltip">
                            <i class="mdi mdi-close-box-outline"></i> Tolak PendaftaranPanti
                        </button>
                        <div class="modal fade" id="tolakPanti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Pendaftaran Panti Asuhan</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelaksana.admin.panti.tolak', ['id' => $panti->id]) }}" method="POST" class="well" id="block-validate">
                                        @csrf
                                        <div class="modal-body bg-secondary">
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label" style="color:black">Catatan:</label>
                                                <textarea class="form-control bg-light" id='catatan_status' name="catatan_status" id="message-text" rows="6" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="tolak" class="btn btn-primary"><span class="ni ni-check-bold"></span> Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($panti->status =='Active')
                        <!-- <a href="{{ route('pelaksana.admin.panti.nonactive', ['id' => $panti->id]) }}" class="btn btn-info btn-lg btn-block">
                            <i class="mdi mdi mdi-close-box"></i> Non Aktifkan Panti
                        </a> -->
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#nonaktifkanPantiAsuhan"
                            data-bs-whatever="Penolakan Verifikasi Donasi" data-toggle="tooltip">
                            <i class="mdi mdi-close-box-outline"></i> Nonaktifkan Panti Asuhan
                        </button>
                        <div class="modal fade" id="nonaktifkanPantiAsuhan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Verifikasi Donasi</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelaksana.admin.panti.nonactive', ['id' => $panti->id]) }}" method="POST" class="well" id="block-validate">
                                        @csrf
                                        <div class="modal-body bg-secondary">
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label" style="color:black">Catatan:</label>
                                                <textarea class="form-control bg-light" id='catatan_status' name="catatan_status" id="message-text" rows="6" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="tolak" class="btn btn-primary"><span class="ni ni-check-bold"></span> Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($panti->status =='NonActive')
                        <a href="{{ route('pelaksana.admin.panti.verif', ['id' => $panti->id]) }}" class="btn btn-info btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Aktifkan Panti
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
