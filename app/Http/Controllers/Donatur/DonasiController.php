<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggalangan;
use App\Models\Donasi;
use App\Models\Panti;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class DonasiController extends Controller
{
    public function index(){
        $penggalangans = Penggalangan::with('donasi')
        ->where('status',1)
        ->where('verif',2)
        ->whereDate('waktu_selesai', '>=', Carbon::now())
        ->whereDate('waktu_mulai', '<=', Carbon::now())
        ->withSum('donasi', 'jumlah')
        ->orderBy('donasi_sum_jumlah', 'asc')
        ->get();
        return view('donatur.donate', compact('penggalangans'));
    }

    public function detail($id){
        $penggalangan = Penggalangan::with('donasi', 'berita')
            ->where('id', $id)->first();
        return view('donatur.detail-donate', compact('penggalangan'));
    }

    public function payment(Request $request, $id_penggalangan){
        if($request->jumlahh !=null){
            $jumlah=$request->jumlahh;
        }else{
            $jumlah=$request->jumlah;
        }
        if($request->kirim_email !=null){
            $kirimEmail=1;
        }else{
            $kirimEmail=0;
        }
        $penggalangan = [
            'id_penggalangan' => $id_penggalangan,
            'nama' => $request->nama,
            'email' => $request->email,
            'jumlah' => $jumlah,
            'metode_pembayaran' => $request->metode_pembayaran,
            'kirim_email' => $kirimEmail,
        ];
        return view('donatur.payment')->with('penggalangan', $penggalangan);
    }

    public function lihatDonasi($id){
        $penggalangans = Penggalangan::with('donasi')
        ->where('status',1)
        ->where('verif',2)
        ->where('id_panti',$id)
        ->whereDate('waktu_selesai', '>=', Carbon::now())
        ->whereDate('waktu_mulai', '>=', Carbon::now())
        ->withSum('donasi', 'jumlah')
        ->orderBy('donasi_sum_jumlah', 'asc')
        ->get();
        return view('donatur.donate', compact('penggalangans'));
    }

    public function lihatSemuaDonasi($id){
        $penggalangans = Penggalangan::with('donasi')
        ->where('status',1)
        ->where('verif',2)
        ->where('id_panti',$id)
        ->whereDate('waktu_selesai', '>=', Carbon::now())
        ->whereDate('waktu_mulai', '>=', Carbon::now())
        ->withSum('donasi', 'jumlah')
        ->orderBy('donasi_sum_jumlah', 'asc')
        ->get();
        return view('donatur.donate', compact('penggalangans'));
    }

    public function create(Request $request, $id_penggalangan){
        $noDonasi=Donasi::max('id');
        $noDonasi=$noDonasi+1;
        $jumlah=str_replace(['Rp. ', '.'], '', request('jumlah'));
        $jumlah = (int)$jumlah;
        $penggalangan=Penggalangan::where('id', $id_penggalangan)->first();
        $panti=Panti::where('id', $penggalangan->id_panti)->first();
        if ($request->hasFile('bukti_pembayaran')) {
            $fileExtension = $request->file('bukti_pembayaran')->extension();
            $namaBuktiPembayaran = $noDonasi . '-' . $penggalangan->judul. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_buktiPembayaran($namaBuktiPembayaran);
            Storage::putFileAs('public/bukti pembayaran/' . $panti->nama_panti .'/'.$penggalangan->judul, $request->file('bukti_pembayaran'), $namaBuktiPembayaran);
        } else {
            $namaBuktiPembayaran = null;
        }

        $panti = Donasi::create([
            'id_penggalangan' => $id_penggalangan,
            'nama' => request('nama'),
            'email' => request('email'),
            'jumlah' => $jumlah,
            'metode_pembayaran' => request('metode_pembayaran'),
            'bukti_pembayaran' => $namaBuktiPembayaran,
            'kirim_email' => request('kirim_email'),
        ]);
        Alert::success('Berhasil!', 'Pembayaran Berhasil!');
        return redirect()->route('donatur.donasi.detail', ['id' => $id_penggalangan])->with('success', 'Pembayaran Berhasil!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    function filter_filename_buktiPembayaran($namaBuktiPembayaran, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $namaBuktiPembayaran);
        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');
        // optional beautification
        if ($beautify) $filename = $this->beautify_filename($filename);
        // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
        return $filename;
    }
    function beautify_filename($filename) {
        // reduce consecutive characters
        $filename = preg_replace(array(
            // "file   name.zip" becomes "file-name.zip"
            '/ +/',
            // "file___name.zip" becomes "file-name.zip"
            '/_+/',
            // "file---name.zip" becomes "file-name.zip"
            '/-+/'
        ), '-', $filename);
        $filename = preg_replace(array(
            // "file--.--.-.--name.zip" becomes "file.name.zip"
            '/-*\.-*/',
            // "file...name..zip" becomes "file.name.zip"
            '/\.{2,}/'
        ), '.', $filename);
        // lowercase for windows/unix interoperability http://support.microsoft.com/kb/100625
        $filename = mb_strtolower($filename, mb_detect_encoding($filename));
        // ".file-name.-" becomes "file-name"
        $filename = trim($filename, '.-');
        return $filename;
    }
}
