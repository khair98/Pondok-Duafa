@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Donasi
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
                                    <h4 class="card-title">Daftar Donasi</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Donatur</th>
                                    <th>Jumlah</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donasis as $donasi)
                                    <tr>
                                        <td>{{ $donasi->nama }}</td>
                                        <td>{{ $donasi->jumlah }}</td>
                                        <td>{{ $donasi->metode_pembayaran }}</td>
                                        <td>
                                            @if($donasi->verif == 2)
                                                <label class="badge badge-success">Diverifikasi Admin</label>
                                            @elseif($donasi->verif == 0)
                                                <label class="badge badge-warning">Menunggu Verifikasi Admin</label>
                                            @else
                                                <label class="badge badge-danger">Ditolak Admin</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="nav-link" href="{{ route('pelaksana.admin.donasi.detail', ['id' => $donasi->id]) }}">
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