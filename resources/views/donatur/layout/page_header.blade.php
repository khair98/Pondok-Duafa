<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">
            @if(Route::currentRouteName() == 'donatur.menu.contact')
                Kontak Kami
            @elseif(Route::currentRouteName() == 'donatur.menu.about')
                Tentang Kami
            @elseif(Route::currentRouteName() == 'donatur.donasi.index')
                Penggalangan Dana
            @endif
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('index') }}">Beranda</a></li>
                @if(Route::currentRouteName() == 'donatur.donasi.detail')
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('donatur.donasi.index') }}">Penggalangan Dana</a></li>
                @endif
                <li class="breadcrumb-item text-primary active" aria-current="page">
                    @if(Route::currentRouteName() == 'donatur.menu.contact')
                        Kontak Kami
                    @elseif(Route::currentRouteName() == 'donatur.menu.about')
                        Tentang Kami
                    @elseif(Route::currentRouteName() == 'donatur.donasi.index')
                        Penggalangan Dana
                    @elseif(Route::currentRouteName() == 'donatur.donasi.detail')
                        Detail Penggalangan Dana
                    @endif
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->