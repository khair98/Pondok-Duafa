@extends('pelaksana.layout.core.index')
@section('title')
    Admin - Detail Donasi
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
                    <?php $user= DB::table('donasis')
                            ->join('penggalangans', 'donasis.id_penggalangan', 'penggalangans.id')
                            ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                            ->join('users', 'pantis.id_user', 'users.id')
                            ->where('donasis.id', $donasi->id)
                            ->first();
                    ?>
                    <a href="{{ asset('storage/bukti pembayaran/' .$user->nama_panti .'/'.  $user->judul .'/'. $donasi->bukti_pembayaran)}}" class="image-tile"><img style="height:250px;" src="{{ asset('storage/bukti pembayaran/' . $user->nama_panti .'/'.$user->judul .'/'. $donasi->bukti_pembayaran)}}" alt="image small"></a>
                </div>
                <div class="card corona-gradient-card mb-3">
                    <div class="card-body">
                        <div class="card-text">
                            <h4 class="card-title">Detail Donasi</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Donatur</td>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $donasi->email }}</td>
                        </tr>
                        <tr>
                            <td>Penggalangan Dana</td>
                            <td>
                                {{ $user->judul }}
                                <br>
                                {{ $user->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Panti Asuhan</td>
                            <td>
                                {{ $user->nama_panti }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>Rp.{{ number_format($donasi->jumlah,2,',','.') }}</td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            @if($donasi->metode_pembayaran == 'qris')
                                <td>QRIS</td>
                            @else
                                <td>BSI</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Kirim Email</td>
                            @if($donasi->kirim_email == 0)
                                <td>Tidak</td>
                            @else
                                <td>Ya</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Status Verifikasi</td>
                            @if($donasi->verif == 2)
                                <td><label class="badge badge-success">Diverifikasi Admin</label></td>
                            @elseif($donasi->verif == 0)
                                <td><label class="badge badge-warning">Menunggu Verifikasi Admin</label></td>
                            @else
                                <td>
                                    <label class="badge badge-danger">Ditolak Admin</label>
                                    <br>
                                    <label class="mt-3">{{$donasi->catatan_verif}}</label>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Bukti Pembayaran</td>
                            <td>
                                @if($donasi->bukti_pembayaran != null)
                                    <a href="{{ route('pelaksana.admin.donasi.downloadBuktiPembayaran', ['id' => $donasi->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                        target="_blank">
                                        <i class="mdi mdi-download opacity-50 me-1"></i>
                                        Bukti Pembayaran
                                    </a>
                                @else
                                    <h6 style="color:black">Tidak ada bukti pembayaran</h6>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="col-12 mb-3">
                    @if($donasi->verif ==0)
                        <a href="{{ route('pelaksana.admin.donasi.verif', ['id' => $donasi->id]) }}" class="btn btn-info btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Verifikasi Pembayaran Donasi
                        </a>
                        <!-- <a href="{{ route('pelaksana.admin.donasi.tolak', ['id' => $donasi->id]) }}" class="btn btn-danger btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Tolak Pembayaran Donasi
                        </a> -->
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#tolakVerifDonasi"
                            data-bs-whatever="Penolakan Verifikasi Donasi" data-toggle="tooltip">
                            <i class="mdi mdi-close-box-outline"></i> Tolak Pembayaran Donasi
                        </button>
                        <div class="modal fade" id="tolakVerifDonasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Verifikasi Donasi</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelaksana.admin.donasi.tolak', ['id' => $donasi->id]) }}" method="POST" class="well" id="block-validate">
                                        @csrf
                                        <div class="modal-body bg-secondary">
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label" style="color:black">Catatan:</label>
                                                <textarea class="form-control bg-light" id='catatan_verif' name="catatan_verif" id="message-text" rows="6" required></textarea>
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
