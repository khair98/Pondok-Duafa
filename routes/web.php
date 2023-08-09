<?php

use App\Http\Controllers\Pelaksana\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::prefix('pelaksana')->name('pelaksana.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        // Route::get('/', 'loginHome')->name('home');
        Route::get('/', 'loginHome')->name('index');
        Route::post('/', 'loginAuth')->name('login.auth');
        Route::get('/register', 'registerHome')->name('register');
        Route::post('/register', 'registerAuth')->name('register.auth');
        Route::post('/logout', 'logout')->name('logout');

    });
});


require __DIR__ . '/pelaksana.php';
require __DIR__ . '/donatur.php';
