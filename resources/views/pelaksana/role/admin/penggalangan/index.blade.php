@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Penggalangan Dana
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
                                    <h4 class="card-title">Daftar Penggalangan Dana</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Panti</th>
                                    <th>Judul Penggalangan</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penggalangans as $penggalangan)
                                    <tr>
                                        <td>{{ $penggalangan->panti->nama_panti }}</td>
                                        <td>{{ $penggalangan->judul }}</td>
                                        <td>{{ $penggalangan->jumlah }}</td>
                                        <td>
                                            <span>Mulai: </span> 
                                            {{ $penggalangan->waktu_mulai }} 
                                            <br> 
                                            <span>Selesai: </span> 
                                            {{ $penggalangan->waktu_selesai }}
                                            <br>
                                            @if($penggalangan->waktu_mulai > Carbon\Carbon::now())
                                                <label class="badge badge-warning mt-3">Belum Dimulai
                                            @elseif($penggalangan->waktu_selesai < Carbon\Carbon::now())
                                                <label class="badge badge-danger mt-3">Berakhir</label>
                                            @else
                                                <label class="badge badge-success mt-3">Sedang Berlangsung
                                            @endif
                                        </td>
                                        <td>
                                            @if($penggalangan->verif == 2)
                                                <label class="badge badge-success">Diverifikasi Admin</label>
                                            @elseif($penggalangan->verif == 0)
                                                <label class="badge badge-warning">Menunggu Verifikasi Admin</label>
                                            @else
                                                <label class="badge badge-danger">Ditolak Admin</label>
                                            @endif
                                            <br><br>
                                            @if($penggalangan->status == true)
                                                <label class="badge badge-success">Aktif</label>
                                            @else
                                                <label class="badge badge-danger">Tidak Aktif</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="nav-link" href="{{ route('pelaksana.admin.penggalangan.detail', ['id' => $penggalangan->id]) }}">
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