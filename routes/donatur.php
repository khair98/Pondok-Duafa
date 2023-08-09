<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Donatur\DonasiController;
// use App\Http\Controllers\Donatur\PenggalanganController;
use App\Http\Controllers\Donatur\PantiController;
use App\Http\Controllers\Donatur\HomeController;


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
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::prefix('donatur')->name('donatur.')->group(function () {
    Route::prefix('menu')->name('menu.')->controller(HomeController::class)->group(function () {
        Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
        Route::get('/about', [HomeController::class, 'about'])->name('about');
    });
    Route::prefix('donasi')->name('donasi.')->controller(DonasiController::class)->group(function () {
        Route::get('/', [DonasiController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [DonasiController::class, 'detail'])->name('detail');
        Route::post('/payment/{id_penggalangan}', [DonasiController::class, 'payment'])->name('payment');
        Route::get('/lihat-donasi/{id}', [DonasiController::class, 'lihatDonasi'])->name('lihatDonasi');
        Route::get('/create/index', [DonasiController::class, 'createIndex'])->name('create.index');
        Route::post('/create/{id_penggalangan}', [DonasiController::class, 'create'])->name('create');
    });
    // Route::prefix('penggalangan')->name('penggalangan.')->controller(PenggalanganController::class)->group(function () {
    //     Route::get('/', [PenggalanganController::class, 'index'])->name('index');
    //     Route::get('/create/index', [PenggalanganController::class, 'createIndex'])->name('create.index');
    //     Route::post('/create', [PenggalanganController::class, 'create'])->name('create');
    // });
    Route::prefix('panti')->name('panti.')->controller(PantiController::class)->group(function () {
        Route::get('/', [PantiController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [PantiController::class, 'detail'])->name('detail');
        Route::get('/profil/{id}', [PantiController::class, 'profil'])->name('profil');
        Route::get('/create/index', [PantiController::class, 'createIndex'])->name('create.index');
        Route::post('/create', [PantiController::class, 'create'])->name('create');
    });
});
