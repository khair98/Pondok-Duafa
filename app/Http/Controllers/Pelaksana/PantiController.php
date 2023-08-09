<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panti;
use App\Models\Penggalangan;
use App\Models\FotoPanti;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPendaftaranPantiBerhasil;
use App\Mail\SendPendaftaranPantiGagal;

class PantiController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('panti')){
            $panti = Panti::with('foto')->where('id_user', Auth::user()->id)->first();
            $foto = Panti::with('foto')->where('id_user', Auth::user()->id)->get();
            return view('pelaksana.role.panti.panti.index', compact('panti','foto'));
        }else{
            $pantis = Panti::with('foto')->where('diajukan', 1)->get();
            $foto = Panti::with('foto')->where('diajukan', 1)->get();
            return view('pelaksana.role.admin.panti.index', compact('pantis','foto'));
        }
    }

    // public function createIndex(){
    //     return view('pelaksana.role.panti.panti.create');
    // }
    public function create(Request $request, $id){
        $panti=Panti::findOrFail($id);
        $panti->update([
            'diajukan' => true,
        ]);
        Alert::success('Berhasil!', 'Panti Asuhan berhasil didaftarkan!');
        return redirect()->route('pelaksana.panti.panti.index')->with('success', 'Panti Asuhan berhasil didaftarkan!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    public function updateIndex($id){
        $panti = Panti::with('foto')->where('id',$id)->first();
        if(Auth::user()->hasRole('panti')){
            return view('pelaksana.role.panti.panti.update', compact('panti'));
        }else{
            return view('pelaksana.role.admin.panti.update', compact('panti'));
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'id_panti'=>'required',
            'nama_panti' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'kontak' => 'required',
            'jumlah_anak' => 'required',
        ]);
        $panti=Panti::where('id', $validated['id_panti'])->first();
        if ($request->hasFile('surat_izin')) {
            $fileExtension = $request->file('surat_izin')->extension();
            $namaSuratIzin = $panti->id . '-' . $validated['nama_panti']. '-'. Carbon::now()->isoFormat('DDMYYYY-hh-mm-ss') . '.' . $fileExtension;
            $this->filter_filename_surat_izin($namaSuratIzin);
            Storage::putFileAs('public/surat izin/' . $validated['nama_panti'], $request->file('surat_izin'), $namaSuratIzin);
        } else {
            $namaSuratIzin = $panti->surat_izin;
        }

        $panti->update([
            'id_user' =>Auth::user()->id,
            'nama_panti' => $validated['nama_panti'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'kontak' => $validated['kontak'],
            'jumlah_anak' => $validated['jumlah_anak'],
            'profil' => $request->profil,
            'surat_izin' => $namaSuratIzin,
        ]);
        $k=1;
        $pantis=FotoPanti::where('id_panti', $validated['id_panti'])->get();
        $jumlahFoto=FotoPanti::where('id_panti', $validated['id_panti'])->count();
        if($request->file('foto')!=null){
            foreach($request->file('foto') as $key=>$value) {
                for($i=0; $i<count($request->file('foto')); $i++){
                    $foto=$request->file('foto')[$i];
                    $fileExtension = $foto->extension();
                    $id=$key++;
                    $namaFoto = $panti->id.'-'.$panti->nama_panti.'-'. $id . '.' . $fileExtension;
                    Storage::putFileAs('public/foto panti/' . $panti->id, $foto, $namaFoto);
                    $pantis[$i]->update([
                        'foto' => $namaFoto,
                    ]);
                }
            }
        }
        // if($jumlahFoto<=count($request->foto)){
        // }else{
        // }
        if($request->file('foto-addition')!=null){
            for($i=0; $i<count($request->file('foto-addition')); $i++){
                $foto=$request->file('foto-addition')[$i];
                $fileExtension = $foto->extension();
                $count=$jumlahFoto+$i+1;
                $namaFoto = $panti->id.'-'.$panti->nama_panti.'-'. $count . '.' . $fileExtension;
                Storage::putFileAs('public/foto panti/' . $panti->id, $foto, $namaFoto);
                FotoPanti::create([
                    'id_panti' => $panti->id,
                    'foto' => $namaFoto,
                ]);
            }
        }
        $pantis = Panti::all();
        Alert::success('Berhasil!', 'Data berhasil diupdate!');
        return redirect()->route('pelaksana.panti.panti.index')->with('success', 'Data berhasil diupdate!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    public function downloadSuratIzin($id)
    {
        $panti = Panti::findOrFail($id);
        $suratizin=$panti->surat_izin;
        $user= Panti::where('pantis.id', $panti->id)
                ->first();
        $file = public_path() . '/storage/surat izin/'. $panti->nama_panti . "/" . $suratizin;
        // $file= public_path(). '/storage/surat permohonan sk/Fakultas Matematika dan Ilmu Pengetahuan Alam/10112022-03-43-30.pdf';
        $headers = array(
            'Content-Type: application',
        );
        return response()->download($file, $panti->surat_izin, $headers);
    }

    public function detail($id){
        $panti = Panti::where('id', $id)->first();
        $foto = FotoPanti::where('id_panti', $id)->get();
        if(Auth::user()->hasRole('panti')){
            return view('pelaksana.role.panti.panti.detail', compact('panti','foto'));
        }else{
            return view('pelaksana.role.admin.panti.detail', compact('panti','foto'));
        }
    }
    public function verif($id){
        $panti=Panti::findOrFail($id);
        $panti->update([
            'status' =>'Active',
        ]);
        $panti=Panti::findOrFail($id);
        $send = Mail::to($panti->email)->send(new SendPendaftaranPantiBerhasil($panti));
        Alert::success('Berhasil!', 'Panti berhasil diverifikasi!');
        return redirect()->route('pelaksana.admin.panti.index')->with('success', 'Panti berhasil diverifikasi!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }
    public function tolak(Request $request, $id){
        $panti=Panti::findOrFail($id);
        $panti->update([
            'status' =>'Reject',
            'catatan_status' => $request->catatan_status,
        ]);
        $panti=Panti::findOrFail($id);
        $send = Mail::to($panti->email)->send(new SendPendaftaranPantiGagal($panti));
        Alert::success('Berhasil!', 'Pendaftaran Panti berhasil ditolak!');
        return redirect()->route('pelaksana.admin.panti.index')->with('success', 'Panti berhasil diverifikasi!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }
    public function nonactive(Request $request, $id){
        $panti=Panti::findOrFail($id);
        $panti->update([
            'status' =>'NonActive',
            'catatan_status' =>$request->catatan_status,
        ]);
        Alert::success('Berhasil!', 'Panti berhasil dinonaktifkan!');
        $penggalangans=Penggalangan::where('id_panti', $id)->get();
        foreach($penggalangans as $penggalangan){
            $penggalangan->update([
                'status' => false,
                'catatan_status' =>$request->catatan_status,
            ]);
        }
        return redirect()->route('pelaksana.admin.panti.index')->with('success', 'Panti berhasil dinonaktifkan!');
        // return view('pelaksana.role.panti.index', compact('pantis'));
    }

    function filter_filename_surat_izin($namaSuratizin, $beautify=true) {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $namaSuratizin);
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
?>
