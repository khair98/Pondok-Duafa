@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Panti Asuhan
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
                                    <h4 class="card-title">Daftar Panti Asuhan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Panti</th>
                                    <th>Alamat</th>
                                    <th>Kontak</th>
                                    <th>Jumlah Anak</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pantis as $panti)
                                    <tr>
                                        <td>{{ $panti->nama_panti }}</td>
                                        <td>{{ $panti->alamat }}</td>
                                        <td>{{ $panti->kontak }}</td>
                                        <td>{{ $panti->jumlah_anak }}</td>
                                        @if($panti->status == 'Active')
                                            <td><label class="badge badge-success">Aktif</label></td>
                                        @elseif($panti->status == 'Waiting')
                                            <td><label class="badge badge-warning">Menunggu Verifikasi</label></td>
                                        @else
                                            <td><label class="badge badge-danger">Tidak Aktif</label></td>
                                        @endif
                                        <td>
                                            <a class="nav-link" href="{{ route('pelaksana.admin.panti.detail', ['id' => $panti->id]) }}">
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