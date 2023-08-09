<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggalangan;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $penggalangans = Penggalangan::with('donasi')
        ->where('status',1)
        ->where('verif',2)
        ->whereDate('waktu_selesai', '>=', Carbon::now())
        ->whereDate('waktu_mulai', '<=', Carbon::now())
        ->withSum('donasi', 'jumlah')
        ->orderBy('donasi_sum_jumlah', 'asc')
        ->paginate(3);
        return view('donatur.index', compact('penggalangans'));
    }

    public function contact(){
        return view('donatur.contact');
    }

    public function about(){
        return view('donatur.about');
    }
}