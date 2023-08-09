@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Penarikan Dana
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card corona-gradient-card mb-3">
                            <div class="card-body">
                                <div class="card-text">
                                    <h4 class="card-title">Daftar Pengajuan Penarikan Dana</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Penggalangan Dana</th>
                                    <th>Panti Asuhan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penarikans as $penarikan)
                                    <tr>
                                        <td>{{ $penarikan->penggalangan->judul }}</td>
                                        <td>{{ $penarikan->penggalangan->panti->nama_panti }}</td>
                                        <td>Rp. {{ number_format($penarikan->jumlah,2,',','.') }}</td>
                                        <td>
                                            @if($penarikan->status == 2)
                                                <label class="badge badge-success">Diproses Admin</label>
                                            @elseif($penarikan->status == 0)
                                                <label class="badge badge-warning">Sedang Diproses Admin</label>
                                            @else
                                                <label class="badge badge-danger">Ditolak Admin</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="nav-link" href="{{ route('pelaksana.admin.penggalangan.detail.penarikan.dana', ['id' => $penarikan->id]) }}">
                                                <i class="mdi mdi mdi-magnify"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection