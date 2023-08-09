@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Detail Penggalangan Dana
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
                            <h4 class="card-title">Detail Penarikan Dana</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                    <tbody>
                        <tr>
                            <td>Penggalangan Dana</td>
                            <td>
                                {{ $penarikan->penggalangan->judul }}
                                <br>
                                {{ $penarikan->penggalangan->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Panti Asuhan</td>
                            <td>{{ $penarikan->penggalangan->panti->nama_panti }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>Rp.{{ number_format($penarikan->jumlah,2,',','.') }}</td>
                        </tr>
                        <tr>
                            <td>Nama penerima</td>
                            <td>
                                {{ $penarikan->nama }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Bank</td>
                            <td>
                                {{ $penarikan->nama_bank }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td>
                                {{ $penarikan->no_rekening }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status Verifikasi</td>
                            @if($penarikan->status == 2)
                                <td><label class="badge badge-success">Disetujui Admin</label></td>
                            @elseif($penarikan->status == 0)
                                <td><label class="badge badge-warning">Menunggu Persetujuan Admin</label></td>
                            @else
                                <td>
                                    <label class="badge badge-danger">Ditolak Admin</label>
                                    <br>
                                    <label class="mt-3">{{$penarikan->catatan_status}}</label>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="col-12 mb-3">
                    @if($penarikan->status ==0)
                        <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#terimaPenarikanDana"
                            data-bs-whatever="Terima Penarikan Dana" data-toggle="tooltip">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Setujui Penarikan Dana
                        </button>
                        <div class="modal fade" id="terimaPenarikanDana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Setujui Penarikan Dana</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelaksana.admin.penggalangan.setujui.penarikan.dana', ['id' => $penarikan->id]) }}" enctype="multipart/form-data" method="POST" class="well" id="block-validate">
                                        @csrf
                                        <div class="modal-body bg-secondary">
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label" style="color:black">Upload Bukti Transfer:</label>
                                                <!-- <textarea class="form-control bg-light" id='catatan_status' name="catatan_status" id="message-text" rows="6" required></textarea> -->
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-12">
                                                                <input type="file" class="form-control" name="bukti_transfer" id="bukti_transfer"
                                                                    placeholder="Bukti Transfer..." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <!-- <a href="{{ route('pelaksana.admin.donasi.tolak', ['id' => $penarikan->id]) }}" class="btn btn-danger btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Tolak Pembayaran Donasi
                        </a> -->
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#tolakPenarikanDana"
                            data-bs-whatever="Tolak Penarikan Dana" data-toggle="tooltip">
                            <i class="mdi mdi-close-box-outline"></i> Tolak Penarikan Dana
                        </button>
                        <div class="modal fade" id="tolakPenarikanDana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Penarikan Dana</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelaksana.admin.penggalangan.tolak.penarikan.dana', ['id' => $penarikan->id]) }}" method="POST" class="well" id="block-validate">
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
                </div>
            </div>
        </div>
    </div>
@endsection
