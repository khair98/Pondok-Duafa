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
                            <td>Status Verifikasi</td>
                            @if($penggalangan->verif == 2)
                                <td><label class="badge badge-success">Diverifikasi Admin</label></td>
                            @elseif($penggalangan->verif == 0)
                                <td><label class="badge badge-warning">Menunggu Verifikasi Admin</label></td>
                            @else
                                <td>
                                    <label class="badge badge-danger">Ditolak Admin</label>
                                    <br>
                                    <label class="mt-3">{{$penggalangan->catatan_verif}}</label>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Status Aktif</td>
                            @if($penggalangan->status == true)
                                <td><label class="badge badge-success">Aktif</label></td>
                            @else
                                <td>
                                    <label class="badge badge-danger">Tidak Aktif</label>
                                    <br>
                                    <label class="mt-3">{{$penggalangan->catatan_status}}</label>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Proposal</td>
                            <td>
                                @if($penggalangan->proposal != null)
                                    <a href="{{ route('pelaksana.admin.penggalangan.downloadProposal', ['id' => $penggalangan->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                        target="_blank">
                                        <i class="mdi mdi-download opacity-50 me-1"></i>
                                        Download Proposal
                                    </a>
                                @else
                                    <h6 style="color:black">Tidak ada proposal</h6>
                                @endif
                            </td>
                        </tr>
                        @if($penggalangan->waktu_selesai < Carbon\Carbon::now())
                            <tr>
                                <td>Laporan</td>
                                <td>
                                    <div class="col-6">
                                        @if($penggalangan->laporan != null)
                                            <a href="{{ route('pelaksana.admin.penggalangan.downloadLaporan', ['id' => $penggalangan->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                                style="margin-bottom:24px" target="_blank">
                                                <i class="mdi mdi-download opacity-50 me-1"></i>
                                                Download Laporan
                                            </a>
                                        @else
                                            <h6 style="color:black">Tidak ada laporan</h6>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="col-6 mb-3">
                                        @if($penggalangan->verif_laporan == 2)
                                            <label class="badge badge-success">Laporan Diverifikasi Admin</label>
                                        @elseif($penggalangan->verif_laporan == 0)
                                            <label class="badge badge-warning">Laporan Menunggu Verifikasi Admin</label>
                                        @else
                                            <label class="badge badge-danger">Laporan Ditolak Admin</label>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('pelaksana.admin.penggalangan.terimaLaporan', ['id' => $penggalangan->id]) }}" class="btn btn-info btn-lg btn-block">
                                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Verifikasi Laporan
                                        </a>
                                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#tolakVerifLaporan"
                                            data-bs-whatever="Penolakan Verifikasi Laporan" data-toggle="tooltip">
                                            <i class="mdi mdi-close-box-outline"></i> Tolak Laporan
                                        </button>
                                        <div class="modal fade" id="tolakVerifLaporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Verifikasi Donasi</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('pelaksana.admin.penggalangan.tolakLaporan', ['id' => $penggalangan->id]) }}" method="POST" class="well" id="block-validate">
                                                        @csrf
                                                        <div class="modal-body bg-secondary">
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label" style="color:black">Catatan:</label>
                                                                <textarea class="form-control bg-light" id='catatan' name="catatan" id="message-text" rows="6" required></textarea>
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
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @if($penggalangan->proposal != null)
                            <tr>
                                <h6 class="p-3 rounded bg-info" for="upload">Proposal</h6>
                                <div class="col-12">
                                    <div class="card-body">
                                        <?php
                                            $user= DB::table('penggalangans')
                                                    ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                                                    ->join('users', 'pantis.id_user', 'users.id')
                                                    ->where('penggalangans.id', $penggalangan->id)
                                                    ->first();
                                        ?>
                                        <embed type="application/pdf" src="{{ asset('/storage/proposal/' . $user->username . "/" . $penggalangan->panti->nama_panti . "/" . $penggalangan->proposal) }}" style="width:100%; height: 1200px">
                                    </div>
                                </div>
                            </tr>
                        @endif
                        @if($penggalangan->laporan != null)
                            <tr>
                                <h6 class="p-3 rounded bg-info" for="upload">Laporan</h6>
                                <div class="col-12">
                                    <div class="card-body">
                                        <?php
                                            $user= DB::table('penggalangans')
                                                    ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                                                    ->join('users', 'pantis.id_user', 'users.id')
                                                    ->where('penggalangans.id', $penggalangan->id)
                                                    ->first();
                                        ?>
                                        <embed type="application/pdf" src="{{ asset('/storage/laporan/' . $user->username . "/" . $penggalangan->panti->nama_panti . "/" . $penggalangan->laporan) }}" style="width:100%; height: 1200px">
                                    </div>
                                </div>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
                <div class="col-12 mb-3">
                    @if($penggalangan->verif ==0)
                        <a href="{{ route('pelaksana.admin.penggalangan.verif', ['id' => $penggalangan->id]) }}" class="btn btn-info btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Verifikasi Penggalangan Dana
                        </a>
                        <!-- <a href="{{ route('pelaksana.admin.penggalangan.tolak', ['id' => $penggalangan->id]) }}" class="btn btn-danger btn-lg btn-block">
                            <i class="mdi mdi mdi-checkbox-marked-outline"></i> Tolak Penggalangan Dana
                        </a> -->
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#tolakVerifPenggalangan"
                            data-bs-whatever="Penolakan Verifikasi Penggalangan Dana" data-toggle="tooltip">
                            <i class="mdi mdi-close-box-outline"></i> Tolak Penggalangan Dana
                        </button>
                        <div class="modal fade" id="tolakVerifPenggalangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Verifikasi Donasi</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelaksana.admin.penggalangan.tolak', ['id' => $penggalangan->id]) }}" method="POST" class="well" id="block-validate">
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
                    @if($penggalangan->verif !=0)
                        @if($penggalangan->status ==true)
                            <!-- <form action="{{ route('pelaksana.panti.penggalangan.nonaktif', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample" onSubmit="return confirm('Apakah anda yakin ingin menonaktifkan penggalangan dana?');" id="nonaktif">
                                @csrf
                                <button href="{{ route('pelaksana.admin.penggalangan.nonaktif', ['id' => $penggalangan->id]) }}" class="btn btn-danger btn-lg btn-block" type="submit">
                                    <i class="mdi mdi mdi-close-box"></i> Non Aktifkan Penggalangan Dana
                                </button>
                            </form> -->
                            <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#nonaktifkanPenggalanganDana"
                                data-bs-whatever="Penolakan Verifikasi Donasi" data-toggle="tooltip">
                                <i class="mdi mdi-close-box-outline"></i> Nonaktifkan Penggalangan Dana
                            </button>
                            <div class="modal fade" id="nonaktifkanPenggalanganDana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color:black">Penolakan Verifikasi Donasi</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('pelaksana.admin.penggalangan.nonaktif', ['id' => $penggalangan->id]) }}" method="POST" class="well" id="block-validate">
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
                        @if($penggalangan->status ==false && $penggalangan->verif ==2)
                            <a href="{{ route('pelaksana.admin.penggalangan.aktif', ['id' => $penggalangan->id]) }}" class="btn btn-info btn-lg btn-block">
                                <i class="mdi mdi mdi-checkbox-marked-outline"></i> Aktifkan Penggalangan Dana
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
