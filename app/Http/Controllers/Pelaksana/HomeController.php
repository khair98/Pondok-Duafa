<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panti;
use App\Models\Penggalangan;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin')){
            $panti=Panti::count();
            $pantiVerif=Panti::where('status', 'Active')->count();
            $penggalangan=Penggalangan::count();
            $penggalanganVerif=Penggalangan::where('status', 2)->count();
            $donasi=Donasi::count();
            $donasiVerif=Donasi::where('verif', 2)->count();
            $donasiVerifJan=Donasi::where('verif', 2)->whereMonth('created_at', '01')->count();
            $donasiVerifFeb=Donasi::where('verif', 2)->whereMonth('created_at', '02')->count();
            $donasiVerifMar=Donasi::where('verif', 2)->whereMonth('created_at', '03')->count();
            $donasiVerifApr=Donasi::where('verif', 2)->whereMonth('created_at', '04')->count();
            $donasiVerifMei=Donasi::where('verif', 2)->whereMonth('created_at', '05')->count();
            $donasiVerifJun=Donasi::where('verif', 2)->whereMonth('created_at', '06')->count();
            $donasiVerifJul=Donasi::where('verif', 2)->whereMonth('created_at', '07')->count();
            $donasiVerifAgu=Donasi::where('verif', 2)->whereMonth('created_at', '08')->count();
            $donasiVerifSep=Donasi::where('verif', 2)->whereMonth('created_at', '09')->count();
            $donasiVerifOkt=Donasi::where('verif', 2)->whereMonth('created_at', '10')->count();
            $donasiVerifNov=Donasi::where('verif', 2)->whereMonth('created_at', '11')->count();
            $donasiVerifDes=Donasi::where('verif', 2)->whereMonth('created_at', '12')->count();
        }elseif(Auth::user()->hasRole('panti')){
            $panti=Panti::where('id_user', Auth::user()->id)->count();
            $pantiVerif=Panti::where('id_user', Auth::user()->id)->where('status', 'Active')->count();
            $penggalangan=Penggalangan::whereHas('panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->count();
            $penggalanganVerif=Penggalangan::whereHas('panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('status', 2)->count();
            $donasi=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->count();
            $donasiVerif=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->count();
            $donasiVerifJan=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '01')->count();
            $donasiVerifFeb=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '02')->count();
            $donasiVerifMar=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '03')->count();
            $donasiVerifApr=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '04')->count();
            $donasiVerifMei=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '05')->count();
            $donasiVerifJun=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '06')->count();
            $donasiVerifJul=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '07')->count();
            $donasiVerifAgu=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '08')->count();
            $donasiVerifSep=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '09')->count();
            $donasiVerifOkt=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '10')->count();
            $donasiVerifNov=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '11')->count();
            $donasiVerifDes=Donasi::whereHas('penggalangan.panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })->where('verif', 2)->whereMonth('created_at', '12')->count();
        }
        return view('pelaksana.dashboard.index', compact(
            'panti',
            'penggalangan',
            'donasi',
            'pantiVerif',
            'penggalanganVerif',
            'donasiVerif',
            'donasiVerifJan',
            'donasiVerifFeb',
            'donasiVerifMar',
            'donasiVerifApr',
            'donasiVerifMei',
            'donasiVerifJun',
            'donasiVerifJul',
            'donasiVerifAgu',
            'donasiVerifSep',
            'donasiVerifOkt',
            'donasiVerifNov',
            'donasiVerifDes'
        ));
    }
}
