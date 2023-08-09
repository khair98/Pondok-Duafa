<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Penggalangan;
use App\Models\Panti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\sendUcapanTerimakasih;
use App\Mail\sendGagalDonasi;
use Illuminate\Support\Facades\Mail;

class DonasiController extends Controller
{
    public function index(){
        $donasis = Donasi::all();
        return view('pelaksana.role.admin.donasi.index', compact('donasis'));
    }
    public function detail($id){
        $donasi = Donasi::where('id', $id)->first();
        return view('pelaksana.role.admin.donasi.detail', compact('donasi'));
    }

    public function downloadBuktiPembayaran($id)
    {
        $donasi = Donasi::findOrFail($id);
        $buktiPembayaran=$donasi->bukti_pembayaran;
        $user= DB::table('penggalangans')
                ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                ->join('users', 'pantis.id_user', 'users.id')
                ->where('penggalangans.id', $donasi->id)
                ->first();
        $file = public_path() . '/storage/bukti pembayaran/' . $user->nama_panti . "/" . $user->judul . "/" . $buktiPembayaran;
        // $file= public_path(). '/storage/surat permohonan sk/Fakultas Matematika dan Ilmu Pengetahuan Alam/10112022-03-43-30.pdf';
        $headers = array(
            'Content-Type: application',
        );
        return response()->download($file, $donasi->bukti_pembayaran, $headers);
    }

    public function verif($id){
        $getDonasi=Donasi::where('id', $id)->first();
        $getPenggalangan=Penggalangan::where('id', $getDonasi->id_penggalangan)->first();

        $donasi = $getDonasi->update([
            'verif' => 2,
        ]);
        $data=$getDonasi;
        $penggalangan=$getPenggalangan;
        $panti = Panti::where('id', $getPenggalangan->id_panti)->first();
        $send = Mail::to($getDonasi->email)->send(new sendUcapanTerimakasih($data, $panti, $penggalangan));
        if($send){
            Alert::success('Berhasil!', 'Pembayaran donasi berhasil diverifikasi!');
            return redirect()->route('pelaksana.admin.donasi.index')->with('success', 'Pembayaran donasi berhasil diverifikasi!');
        }
    }

    public function tolak(Request $request, $id){
        $getDonasi=Donasi::where('id', $id)->first();
        $getPenggalangan=Penggalangan::where('id', $getDonasi->id_penggalangan)->first();

        $donasi = $getDonasi->update([
            'verif' => 1,
            'catatan_verif' => $request->catatan_verif,
        ]);
        $data=$getDonasi;
        $penggalangan=$getPenggalangan;
        $panti = Panti::where('id', $getPenggalangan->id_panti)->first();
        $send = Mail::to($getDonasi->email)->send(new sendGagalDonasi($data, $panti, $penggalangan));
        if($send){
            Alert::success('Berhasil!', 'Pembayaran donasi berhasil ditolak!');
        }
        return redirect()->route('pelaksana.admin.donasi.index')->with('success', 'Pembayaran donasi berhasil ditolak!');
    }
}
