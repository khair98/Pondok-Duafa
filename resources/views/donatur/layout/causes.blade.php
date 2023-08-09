<!-- Causes Start -->
<div class="container-xxl bg-light my-5 py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Daftar Penggalangan Dana</div>
            <h1 class="display-6 mb-5">Setiap anak berhak mendapatkan hidup yang layak</h1>
        </div>
        <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            @foreach($penggalangans as $penggalangan)
                <div class="col-lg-4 col-md-6">
                    <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                                <small>{{ $penggalangan->panti->nama_panti }}</small>
                            </div>
                            <h5 class="mb-3">{{ $penggalangan->judul }}</h5>
                            <p>{{ $penggalangan->deskripsi }}</p>
                            <div class="causes-progress bg-light p-3 pt-2">
                                <div>
                                    <p class="text-dark"><small class="text-body">Tujuan</small> Rp.{{ number_format($penggalangan->jumlah,2,',','.') }}</p>
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
                                    <p class="text-dark"><small class="text-body">Tercapai</small> Rp.{{ number_format($total,2,',','.') }}</p>
                                </div>
                                <div class="progress">
                                    @if($total > $goal)
                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            <span>100 %</span>
                                        </div>
                                    @else
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ round($persen, 3) }}" aria-valuemin="0" aria-valuemax="100">
                                            <span>{{ round($persen, 3) }} %</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="position-relative mt-auto">
                            <?php $user= DB::table('penggalangans')
                                    ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                                    ->join('users', 'pantis.id_user', 'users.id')
                                    ->where('penggalangans.id', $penggalangan->id)
                                    ->first();
                            ?>
                            <img class="img-fluid" src="{{ asset('storage/foto penggalangan/' . $user->username .'/'.$penggalangan->panti->nama_panti .'/'. $penggalangan->foto)}}" alt="">
                            <div class="causes-overlay">
                                <a class="btn btn-outline-primary" href="{{ route('donatur.donasi.detail', ['id' => $penggalangan->id]) }}">
                                    Selengkapnya
                                    <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $persen=0?>
            @endforeach
            <div class="row mt-4 justify-content-center">
                @if(Route::currentRouteName() != 'donatur.panti.detail')
                    <a class="col-6 btn btn-primary py-2 px-3 me-3" href="{{ route('donatur.donasi.index') }}">
                        Lainnya
                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                @else
                    <a class="col-6 btn btn-primary py-2 px-3 me-3" href="{{ route('donatur.donasi.lihatDonasi', ['id' => $penggalangan->id_panti]) }}">
                        Lainnya
                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Causes End -->