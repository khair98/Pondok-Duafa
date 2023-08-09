<?php

use App\Http\Controllers\Pelaksana\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelaksana\DonasiController;
use App\Http\Controllers\Pelaksana\PenggalanganController;
use App\Http\Controllers\Pelaksana\PantiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('pelaksana')->name('pelaksana.')->middleware(['auth', 'role:admin|panti'])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::prefix('donasi')->name('donasi.')->controller(DonasiController::class)->group(function () {
            Route::get('/', [DonasiController::class, 'index'])->name('index');
            Route::get('/create', [DonasiController::class, 'createIndex'])->name('create.index');
            Route::post('/create', [DonasiController::class, 'create'])->name('create');
            Route::get('/detail/{id}', [DonasiController::class, 'detail'])->name('detail');
            Route::get('/download-bukti-pembayaran/{id}', [DonasiController::class, 'downloadBuktiPembayaran'])->name('downloadBuktiPembayaran');
            Route::get('/verif/{id}', [DonasiController::class, 'verif'])->name('verif');
            Route::post('/tolak/{id}', [DonasiController::class, 'tolak'])->name('tolak');
        });
        Route::prefix('penggalangan')->name('penggalangan.')->controller(PenggalanganController::class)->group(function () {
            Route::get('/', [PenggalanganController::class, 'index'])->name('index');
            Route::get('/create', [PenggalanganController::class, 'createIndex'])->name('create.index');
            Route::post('/create', [PenggalanganController::class, 'create'])->name('create');
            Route::get('/detail/{id}', [PenggalanganController::class, 'detail'])->name('detail');
            Route::get('/download-proposal/{id}', [PenggalanganController::class, 'downloadProposal'])->name('downloadProposal');
            Route::get('/download-laporan/{id}', [PenggalanganController::class, 'downloadLaporan'])->name('downloadLaporan');
            Route::get('/verif/{id}', [PenggalanganController::class, 'verif'])->name('verif');
            Route::post('/tolak/{id}', [PenggalanganController::class, 'tolak'])->name('tolak');
            Route::get('/aktif/{id}', [PenggalanganController::class, 'aktif'])->name('aktif');
            Route::post('/nonaktif/{id}', [PenggalanganController::class, 'nonaktif'])->name('nonaktif');
            Route::get('/daftar-penarikan-dana', [PenggalanganController::class, 'daftarPenarikanDana'])->name('daftar.penarikan.dana');
            Route::get('/detail-penarikan-dana/{id}', [PenggalanganController::class, 'detailPenarikanDana'])->name('detail.penarikan.dana');
            Route::post('/setujui-penarikan-dana/{id}', [PenggalanganController::class, 'setujuiPenarikanDana'])->name('setujui.penarikan.dana');
            Route::post('/tolak-penarikan-dana/{id}', [PenggalanganController::class, 'tolakPenarikanDana'])->name('tolak.penarikan.dana');
            Route::get('/terima-laporan/{id}', [PenggalanganController::class, 'terimaLaporan'])->name('terimaLaporan');
            Route::post('/tolak-laporan/{id}', [PenggalanganController::class, 'tolakLaporan'])->name('tolakLaporan');
        });
        Route::prefix('panti')->name('panti.')->controller(PantiController::class)->group(function () {
            Route::get('/', [PantiController::class, 'index'])->name('index');
            Route::get('/create', [PantiController::class, 'createIndex'])->name('create.index');
            Route::post('/create', [PantiController::class, 'create'])->name('create');
            Route::get('/detail/{id}', [PantiController::class, 'detail'])->name('detail');
            Route::get('/verifikasi/{id}', [PantiController::class, 'verif'])->name('verif');
            Route::post('/tolak/{id}', [PantiController::class, 'tolak'])->name('tolak');
            Route::post('/nonaktifkan/{id}', [PantiController::class, 'nonactive'])->name('nonactive');
            Route::get('/download-surat-izin/{id}', [PantiController::class, 'downloadSuratIzin'])->name('downloadSuratIzin');
        });
    });
    Route::prefix('panti')->name('panti.')->middleware(['auth', 'role:panti'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::prefix('donasi')->name('donasi.')->controller(DonasiController::class)->group(function () {
            Route::get('/', [DonasiController::class, 'index'])->name('index');
            Route::get('/create', [DonasiController::class, 'createIndex'])->name('create.index');
            Route::post('/create', [DonasiController::class, 'create'])->name('create');
        });
        Route::prefix('penggalangan')->name('penggalangan.')->controller(PenggalanganController::class)->group(function () {
            Route::get('/', [PenggalanganController::class, 'index'])->name('index');
            Route::get('/create', [PenggalanganController::class, 'createIndex'])->name('create.index');
            Route::post('/create', [PenggalanganController::class, 'create'])->name('create');
            Route::get('/update/{id}', [PenggalanganController::class, 'updateIndex'])->name('update.index');
            Route::post('/update/{id}', [PenggalanganController::class, 'update'])->name('update');
            Route::post('/aktif/{id}', [PenggalanganController::class, 'aktif'])->name('aktif');
            Route::post('/nonaktif/{id}', [PenggalanganController::class, 'nonaktif'])->name('nonaktif');
            Route::get('/berita/{id}', [PenggalanganController::class, 'berita'])->name('berita');
            Route::post('/berita/{id}', [PenggalanganController::class, 'updateBerita'])->name('update.berita');
            Route::get('/penarikan-dana/{id}', [PenggalanganController::class, 'penarikanDana'])->name('penarikan.dana');
            Route::post('/ajukan-penarikan-dana/{id}', [PenggalanganController::class, 'ajukanPenarikanDana'])->name('ajukan.penarikan.dana');
            Route::get('/laporan/{id}', [PenggalanganController::class, 'laporan'])->name('laporan');
            Route::get('/download-format-laporan/{id}', [PenggalanganController::class, 'downloadFormatLaporan'])->name('downloadFormatLaporan');
            Route::post('/upload-laporan/{id}', [PenggalanganController::class, 'uploadLaporan'])->name('uploadLaporan');
            Route::get('/download-laporan/{id}', [PenggalanganController::class, 'downloadLaporan'])->name('downloadLaporan');
            Route::get('/download-proposal/{id}', [PenggalanganController::class, 'downloadProposal'])->name('downloadProposal');
        });
        
        Route::prefix('panti')->name('panti.')->controller(PantiController::class)->group(function () {
            Route::get('/', [PantiController::class, 'index'])->name('index');
            // Route::get('/create', [PantiController::class, 'createIndex'])->name('create.index');
            Route::get('/create/{id}', [PantiController::class, 'create'])->name('create');
            Route::get('/update/{id}', [PantiController::class, 'updateIndex'])->name('update.index');
            Route::post('/update/{id}', [PantiController::class, 'update'])->name('update');
            Route::get('/detail/{id}', [PantiController::class, 'detail'])->name('detail');
            Route::get('/download-surat-izin/{id}', [PantiController::class, 'downloadSuratIzin'])->name('downloadSuratIzin');
        });
    });
});
