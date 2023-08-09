<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panti;
use App\Models\Penggalangan;
use Carbon\Carbon;

class PantiController extends Controller
{
    public function index(){
        $pantis = Panti::with('foto')->where('status', 'Active')->get();
        return view('donatur.panti', compact('pantis'));
    }

    public function detail($id){
        $panti = Panti::with('foto')->where('id', $id)->first();
        $penggalangans = Penggalangan::with('donasi')
        ->where('status',1)
        ->where('verif',2)
        ->where('id_panti',$id)
        ->whereDate('waktu_selesai', '<', Carbon::now())
        ->paginate(3);
        return view('donatur.detail-panti', compact('panti', 'penggalangans'));
    }

    public function profil($id){
        $panti = Panti::where('id', $id)->first();
        return view('donatur.profil', compact('panti'));
    }
}
