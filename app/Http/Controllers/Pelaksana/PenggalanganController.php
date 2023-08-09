<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggalangan;
use App\Models\Panti;
use App\Models\User;
use App\Models\Berita;
use App\Models\PenarikanDana;
use App\Models\Donasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendReport;
use App\Mail\SendPengirimanDana;
use App\Mail\SendPenarikanDanaGagal;
use App\Mail\SendPendaftaranPenggalanganBerhasil;
use App\Mail\SendPendaftaranPenggalanganGagal;
use App\Mail\SendPenggalanganBaru;
use Illuminate\Support\Facades\DB;

class PenggalanganController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('panti')){
            $penggalangans = Penggalangan::whereHas('panti.user', function($q){
                $q->where('users.id', Auth::user()->id);
            })
            ->get();
            // dd(Auth::user()->id);
            $user=User::where('id', Auth::user()->id)->first();
            return view('pelaksana.role.panti.penggalangan.index', compact('penggalangans','user'));
        }else{
            $penggalangans = Penggalangan::all();
            $user=User::where('id', Auth::user()->id)->first();
            return view('pelaksana.role.admin.penggalangan.index', compact('penggalangans','user'));
        }
    }

    public function createIndex(){
        $cekPanti=Panti::where('id_user', Auth::user()->id)->where('status', 'Active')->first();
        if($cekPanti != null){
            $pantis = Panti::where('id_user', Auth::user()->id)->where('status', 'Active')->get();
            return view('pelaksana.role.panti.penggalangan.create', compact('pantis'));
        }else{
            Alert::error('Gagal!', 'Belum ada panti asuhan aktif!');
            return back();
        }
    }

    public function penarikanDana($id){
        $penggalangan=Penggalangan::where('id', $id)->first();
        $penarikans=PenarikanDana::where('id_penggalangan', $penggalangan->id)->where('status', 1)->get();
        return view('pelaksana.role.panti.penggalangan.penarikan-dana', compact('penggalangan', 'penarikans'));
    }

    public function daftarPenarikanDana(){
        $penggalangan=Penggalangan::all();
        $penarikans=PenarikanDana::all();
        return view('pelaksana.role.admin.penggalangan.penarikan-dana', compact('penggalangan', 'penarikans'));
    }

    public function detailPenarikanDana($id){
        $penggalangan=Penggalangan::where('id', $id)->first();
        $penarikan=PenarikanDana::where('id', $id)->first();
        return view('pelaksana.role.admin.penggalangan.detail-penarikan-dana', compact('penggalangan', 'penarikan'));
    }

    public function setujuiPenarikanDana(Request $request, $id){
        $getPenarikan=PenarikanDana::where('id', $id)->first();
        $getDonasi=Donasi::where('id', $getPenarikan->id_penggalangan)->first();
        if ($request->bukti_transfer !=null) {
            $fileExtension = $request->file('bukti_transfer')->extension();
            $namaBuktiTransfer = $getPenarikan->id . '-' . $getPenarikan->no_rekening. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_bukti_transfer($namaBuktiTransfer);
            Storage::putFileAs('public/bukti pencairan dana/' . $getPenarikan->judul, $request->file('bukti_transfer'), $namaBuktiTransfer);
        } else {
            $namaBuktiTransfer = null;
        }

        $penarikan = $getPenarikan->update([
            'status' => 2,
            'bukti_transfer' => $namaBuktiTransfer,
        ]);
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        $panti = $getPenggalangan->update([
            'verif_laporan' => 2,
        ]);
        $donasis=Donasi::where('id_penggalangan', $getPenggalangan->id)->where('kirim_email', 1)->where('verif', 2)->get();
        $penggalangan = Penggalangan::where('id', $getPenarikan->id_penggalangan)->first();
        $panti = Panti::where('id', $penggalangan->id_panti)->first();
        $user = User::where('id', $panti->id_user)->first();
        $data=$getPenarikan;
        foreach($donasis as $donasi){
            $send = Mail::to($donasi->email)->send(new SendPengirimanDana($data, $penggalangan, $panti));
        }
        $send = Mail::to($panti->email)->send(new SendPengirimanDana($data, $penggalangan, $panti));

        if($send){
            return redirect()->route('pelaksana.admin.penggalangan.daftar.penarikan.dana')->with('success', 'Laporan Berhasil Dikirim!');
        }
        $penggalangan = Penggalangan::where('id', $getPenarikan->id_penggalangan)->first();
        $panti = Panti::where('id', $penggalangan->id_panti)->first();
        $user = User::where('id', $panti->id_user)->first();
        $data=$getPenarikan;
        Alert::success('Berhasil!', 'Penarikan dana berhasil disetujui!');
        return redirect()->route('pelaksana.admin.penggalangan.daftar.penarikan.dana')->with('success', 'Penarikan dana berhasil disetujui!');
    }

    public function tolakPenarikanDana(Request $request, $id){
        $getPenarikan=PenarikanDana::where('id', $id)->first();

        $penarikan = $getPenarikan->update([
            'status' => 1,
            'catatan_status' => $request->catatan_status,
        ]);
        $penggalangan = Penggalangan::where('id', $getPenarikan->id_penggalangan)->first();
        $panti = Panti::where('id', $penggalangan->id_panti)->first();
        $user = User::where('id', $panti->id_user)->first();
        $data=$getPenarikan;
        $send = Mail::to($panti->email)->send(new SendPenarikanDanaGagal($data, $penggalangan, $panti));
        Alert::success('Berhasil!', 'Penarikan dana berhasil ditolak!');
        return redirect()->route('pelaksana.admin.penggalangan.daftar.penarikan.dana')->with('success', 'Penarikan dana berhasil ditolak!');
    }

    public function create(Request $request){
        $validated = $request->validate([
            'id_panti' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required',
            // 'jumlah' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'proposal' => 'required',
        ]);
        $noPenggalangan=Penggalangan::max('id');
        $noPenggalangan=$noPenggalangan+1;
        $user=User::where('id', Auth::user()->id)->first();
        $panti=Panti::where('id', $validated['id_panti'])->first();
        if ($request->hasFile('foto')) {
            $fileExtension = $request->file('foto')->extension();
            $namaFoto = $noPenggalangan . '-' . $validated['judul']. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_foto($namaFoto);
            Storage::putFileAs('public/foto penggalangan/' . $user->username .'/'.$panti->nama_panti, $request->file('foto'), $namaFoto);
        } else {
            $namaFoto = null;
        }
        if ($request->hasFile('proposal')) {
            $fileExtension = $request->file('proposal')->extension();
            $namaProposal= $noPenggalangan . '-' . $validated['judul']. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_proposal($namaProposal);
            Storage::putFileAs('public/proposal/' . $user->username .'/'.$panti->nama_panti, $request->file('proposal'), $namaProposal);
        } else {
            $namaProposal = null;
        }

        $jumlah=str_replace(['Rp. ', '.'], '', $request->jumlah);
        $jumlah = (int)$jumlah;

        $panti = Penggalangan::create([
            'id_panti' => $validated['id_panti'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $namaFoto,
            'jumlah' => $jumlah,
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'proposal' => $namaProposal,
        ]);
        Alert::success('Berhasil!', 'Data berhasil ditambahkan!');
        return redirect()->route('pelaksana.panti.penggalangan.index')->with('success', 'Data berhasil ditambahkan!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    public function updateIndex($id){
        $penggalangan = Penggalangan::where('id', $id)->first();
        $pantis = Panti::where('id_user', Auth::user()->id)->where('status', 'Active')->get();
        $user=User::where('id', Auth::user()->id)->first();
        return view('pelaksana.role.panti.penggalangan.update', compact('penggalangan', 'pantis', 'user'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'id_panti' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required',
            'jumlah' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);
        $noPenggalangan=Penggalangan::max('id');
        $noPenggalangan=$noPenggalangan+1;
        $user=User::where('id', Auth::user()->id)->first();
        $panti=Panti::where('id', $validated['id_panti'])->first();
        if ($request->hasFile('foto')) {
            $fileExtension = $request->file('foto')->extension();
            $namaFoto = $noPenggalangan . '-' . $validated['judul']. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_foto($namaFoto);
            Storage::putFileAs('public/foto penggalangan/' . $user->username .'/'.$panti->nama_panti, $request->file('foto'), $namaFoto);
        } else {
            $namaFoto = null;
        }
        if ($request->hasFile('proposal')) {
            $fileExtension = $request->file('proposal')->extension();
            $namaProposal= $noPenggalangan . '-' . $validated['judul']. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_proposal($namaProposal);
            Storage::putFileAs('public/proposal/' . $user->username .'/'.$panti->nama_panti, $request->file('proposal'), $namaProposal);
        } else {
            $namaProposal = null;
        }
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        $panti = $getPenggalangan->update([
            'id_panti' => $validated['id_panti'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $namaFoto,
            'jumlah' => $validated['jumlah'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'proposal' => $namaProposal,
        ]);
        Alert::success('Berhasil!', 'Data berhasil diperbarui!');
        return redirect()->route('pelaksana.panti.penggalangan.index')->with('success', 'Data berhasil ditambahkan!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    public function aktif($id){
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        if($getPenggalangan->verif == 2){
            $panti = $getPenggalangan->update([
                'status' => true,
            ]);
            if(Auth::user()->hasRole('panti')){
                Alert::success('Berhasil!', 'Penggalangan dana berhasil diaktifkan!');
                return redirect()->route('pelaksana.panti.penggalangan.index')->with('success', 'Penggalangan dana berhasil diaktifkan!');
            }elseif(Auth::user()->hasRole('admin')){
                Alert::success('Berhasil!', 'Penggalangan dana berhasil diaktifkan!');
                return redirect()->route('pelaksana.admin.penggalangan.detail', ['id' => $getPenggalangan->id])->with('success', 'Penggalangan dana berhasil diaktifkan!');
            }
        }else{
            Alert::error('Admin belum memverifikasi penggalangan dana!', 'Anda tidak dapat mengaktifkan penggalangan dana jika Admin belum memverifikasi penggalangan dana! Penggalangan dana akan aktif otomatis jika admin telah memverifikasi penggalangan dana');
            return back();
        }
    }

    public function nonaktif(Request $request, $id){
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        if(Auth::user()->hasRole('panti')){
            $panti = $getPenggalangan->update([
                'status' => false,
            ]);
            Alert::success('Berhasil!', 'Penggalangan dana berhasil dinonaktifkan!');
            return redirect()->route('pelaksana.panti.penggalangan.index')->with('success', 'Penggalangan dana berhasil dinonaktifkan!');
        }else{
            $panti = $getPenggalangan->update([
                'status' => false,
                'catatan_status' => $request->catatan_status,
            ]);
            Alert::success('Berhasil!', 'Penggalangan dana berhasil dinonaktifkan!');
            return redirect()->route('pelaksana.admin.penggalangan.detail', ['id' => $getPenggalangan->id])->with('success', 'Penggalangan dana berhasil dinonaktifkan!');
        }
    }

    public function terimaLaporan($id){
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        $panti = $getPenggalangan->update([
            'verif_laporan' => 2,
        ]);
        $data = Penggalangan::where('id', $id)->first();
        $panti = Panti::where('id', $data->id_panti)->first();
        $user = User::where('id', $panti->id_user)->first();
        $donasi=Donasi::where('id_penggalangan', $id)->where('kirim_email', 1)->where('verif', 2)->get();
        if($donasi->count() != null){
            foreach($donasi as $email){
                $send = Mail::to($email->email)->send(new SendReport($data, $panti, $user));
            }
            if($send){
                return redirect()->route('pelaksana.admin.penggalangan.detail', ['id' => $getPenggalangan->id])->with('success', 'Laporan Berhasil Dikirim!');
            }
        }
        Alert::success('Berhasil!', 'Laporan penggalangan dana berhasil diverifikasi!');
        return redirect()->route('pelaksana.admin.penggalangan.detail', ['id' => $getPenggalangan->id])->with('success', 'Laporan Penggalangan dana berhasil ditverifikasi!');
    }

    public function tolakLaporan(Request $request, $id){
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        $panti = $getPenggalangan->update([
            'verif_laporan' => 1,
            'catatan_laporan' => $request->catatan
        ]);
        Alert::success('Berhasil!', 'Laporan penggalangan dana berhasil ditolak!');
        return redirect()->route('pelaksana.admin.penggalangan.detail', ['id' => $getPenggalangan->id])->with('success', 'Penggalangan dana berhasil dinonaktifkan!');
    }

    public function detail($id){
        $penggalangan = Penggalangan::where('id', $id)->first();
        if(Auth::user()->hasRole('panti')){
            return view('pelaksana.role.panti.penggalangan.detail', compact('penggalangan'));
        }else{
            return view('pelaksana.role.admin.penggalangan.detail', compact('penggalangan'));
        }
    }

    public function downloadProposal($id)
    {
        $penggalangan = Penggalangan::findOrFail($id);
        $proposal=$penggalangan->proposal;
        $user= DB::table('penggalangans')
                ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                ->join('users', 'pantis.id_user', 'users.id')
                ->where('penggalangans.id', $penggalangan->id)
                ->first();
        $file = public_path() . '/storage/proposal/' . $user->username . "/" . $penggalangan->panti->nama_panti . "/" . $proposal;
        // $file= public_path(). '/storage/surat permohonan sk/Fakultas Matematika dan Ilmu Pengetahuan Alam/10112022-03-43-30.pdf';
        $headers = array(
            'Content-Type: application',
        );
        return response()->download($file, $penggalangan->proposal, $headers);
    }

    public function downloadLaporan($id)
    {
        $penggalangan = Penggalangan::findOrFail($id);
        $laporan=$penggalangan->laporan;
        $user= DB::table('penggalangans')
                ->join('pantis', 'penggalangans.id_panti', 'pantis.id')
                ->join('users', 'pantis.id_user', 'users.id')
                ->where('penggalangans.id', $penggalangan->id)
                ->first();
        $file = public_path() . '/storage/laporan/' . $user->username . "/" . $penggalangan->panti->nama_panti . "/" . $laporan;
        // $file= public_path(). '/storage/surat permohonan sk/Fakultas Matematika dan Ilmu Pengetahuan Alam/10112022-03-43-30.pdf';
        $headers = array(
            'Content-Type: application',
        );
        return response()->download($file, $penggalangan->laporan, $headers);
    }

    public function downloadFormatLaporan($id)
    {
        $namaFile='Format Laporan Panti Asuhan.docx';
        $file = public_path() . '/' .$namaFile;
        $headers = array(
            'Content-Type: application',
        );
        return response()->download($file, $namaFile, $headers);
    }

    public function uploadLaporan(Request $request, $id){
        $validated = $request->validate([
            'laporan' => 'required',
        ]);
        $penggalangan=Penggalangan::where('id', $id)->first();
        $user=User::where('id', Auth::user()->id)->first();
        $panti=Panti::where('id', $penggalangan->id_panti)->first();
        if ($request->hasFile('laporan')) {
            $fileExtension = $request->file('laporan')->extension();
            $namaLaporan = $penggalangan->id . '-' . $penggalangan->judul. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_laporan($namaLaporan);
            Storage::putFileAs('public/laporan/' . $user->username .'/'.$panti->nama_panti, $request->file('laporan'), $namaLaporan);
        } else {
            $namaLaporan = null;
        }

        $panti = $penggalangan->update([
            'laporan' => $namaLaporan,
        ]);
        Alert::success('Berhasil!', 'Laporan berhasil diupdate!');
        return redirect()->route('pelaksana.panti.penggalangan.laporan', ['id' => $penggalangan->id])->with('success', 'Data berhasil diupdate!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    public function verif($id){
        $getPenggalangan=Penggalangan::where('id', $id)->first();
        $penggalangan=$getPenggalangan;
        $panti = $getPenggalangan->update([
            'verif' => 2,
            'status' => true,
        ]);
        $data=$getPenggalangan;
        $donasis=Donasi::where('kirim_email', 1)->where('verif', 2)->get();
        $donasis=collect($donasis)->unique('email');
        $panti = Panti::where('id', $data->id_panti)->first();
        foreach($donasis as $donasi){
            $send = Mail::to($donasi->email)->send(new SendPenggalanganBaru($data, $panti));
        }
        // $send = Mail::to($panti->email)->send(new SendPenggalanganBaru($data, $panti));
        $send = Mail::to($panti->email)->send(new SendPendaftaranPenggalanganBerhasil($data, $panti, $penggalangan));
        if($send){
            return redirect()->route('pelaksana.admin.penggalangan.index')->with('success', 'Laporan Berhasil Dikirim!');
        }
        Alert::success('Berhasil!', 'Penggalangan dana berhasil diverifikasi!');
        return redirect()->route('pelaksana.admin.penggalangan.index')->with('success', 'Penggalangan dana berhasil diverifikasi!');
    }

    public function tolak(Request $request, $id){
        $getPenggalangan=Penggalangan::where('id', $id)->first();

        $panti = $getPenggalangan->update([
            'verif' => 1,
            'catatan_verif' => $request->catatan_verif,
        ]);
        $penggalangan=$getPenggalangan;
        $data=$getPenggalangan;
        $panti = Panti::where('id', $data->id_panti)->first();
        $send = Mail::to($panti->email)->send(new SendPendaftaranPenggalanganGagal($data, $panti, $penggalangan));
        Alert::success('Berhasil!', 'Penggalangan dana berhasil ditolak!');
        return redirect()->route('pelaksana.admin.penggalangan.index')->with('success', 'Penggalangan dana berhasil ditolak!');
    }

    public function berita($id){
        $penggalangan = Penggalangan::where('id', $id)->first();
        $berita = Berita::where('id_penggalangan', $id)->latest('created_at')->first();
        $beritas = Berita::where('id_penggalangan', $id)->get();
        return view('pelaksana.role.panti.penggalangan.kabar', compact('penggalangan', 'berita', 'beritas'));
    }

    public function updateBerita(Request $request, $id){
        $validated = $request->validate([
            'id_penggalangan' => 'required',
            'isi' => 'required',
        ]);
        Berita::create([
            'id_penggalangan' => $validated['id_penggalangan'],
            'isi' => $validated['isi'],
        ]);
        Alert::success('Berhasil!', 'Berita berhasil diperbarui!');
        return redirect()->route('pelaksana.panti.penggalangan.index')->with('success', 'Berita berhasil diperbarui!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    public function ajukanPenarikanDana(Request $request, $id){
        $validated = $request->validate([
            'jumlah' => 'required',
            'nama' => 'required',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
        ]);
        $jumlah=str_replace(['Rp. ', '.'], '', $validated['jumlah']);
        $jumlah = (int)$jumlah;
        PenarikanDana::create([
            'id_penggalangan' => $id,
            'jumlah' => $jumlah,
            'nama' => $validated['nama'],
            'nama_bank' => $validated['nama_bank'],
            'no_rekening' => $validated['no_rekening'],
        ]);
        Alert::success('Berhasil!', 'Pengajuan Penarikan Dana Berhasil!');
        return redirect()->route('pelaksana.panti.penggalangan.index')->with('success', 'Pengajuan Penarikan Dana Berhasil!');;
    }

    public function laporan(Request $request, $id){
        $penggalangan = Penggalangan::where('id', $id)->first();
        return view('pelaksana.role.panti.penggalangan.laporan', compact('penggalangan'));
    }

    function filter_filename_foto($namaFoto, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $namaFoto);
        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');
        // optional beautification
        if ($beautify) $filename = $this->beautify_filename($filename);
        // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
        return $filename;
    }
    function filter_filename_proposal($namaProposal, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $namaProposal);
        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');
        // optional beautification
        if ($beautify) $filename = $this->beautify_filename($filename);
        // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
        return $filename;
    }
    function filter_filename_laporan($namaLaporan, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $namaLaporan);
        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');
        // optional beautification
        if ($beautify) $filename = $this->beautify_filename($filename);
        // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
        return $filename;
    }
    function filter_filename_bukti_transfer($namaBuktiTransfer, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $namaBuktiTransfer);
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
