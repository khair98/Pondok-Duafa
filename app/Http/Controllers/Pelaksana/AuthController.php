<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Panti;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginHome()
    {
        try {
            $roles = Auth::user()->getRoleNames();
            $role = $roles[0];

            if ($role == 'admin') {
                return redirect()->route('pelaksana.admin.index');
            }

            if ($role == 'panti') {
                return redirect()->route('pelaksana.panti.index');
            }
        } catch (\Throwable $th) {
            return view('pelaksana.auth.login');
        }
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->getRoleNames();

            if ($role[0] == 'admin') {
                return redirect()->route('pelaksana.admin.index');
            } else {
                return redirect()->route('pelaksana.panti.index');
            }
        }

        Alert::error('Gagal!', 'Periksa kembali username dan password Anda!');
        return back();
    }

    public function registerHome()
    {
        try {
            $roles = Auth::user()->getRoleNames();
            $role = $roles[0];

            if ($role == 'admin') {
                return redirect()->route('pelaksana.admin.index');
            }

            if ($role == 'panti') {
                return redirect()->route('pelaksana.panti.index');
            }
        } catch (\Throwable $th) {
            return view('pelaksana.auth.register');
        }
    }

    public function registerAuth(Request $request)
    {
        $cekEmail = User::where('email', $request->email)->count();
        $cekNoHP = User::where('no_hp', $request->no_hp)->count();
        if($request->password == $request->re_password){
            if($cekEmail == 0 && $cekNoHP == 0){
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'password' => Hash::make($request->password),
                    'status' => 'Active',
                ]);  
                $user->assignRole('panti');
                if($user){
                    $user->assignRole($request->role);
                    $panti=Panti::create([
                        'id_user'=>$user->id,
                        'nama_panti' => $request->name,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'kontak' => $request->no_hp,
                        'status' => 'Waiting',
                    ]);
                    return redirect()->route('pelaksana.index')->with('success', 'Berhasil registrasi!');
                }
            }
            else{
                if($cekEmail != 0){
                    return redirect()->route('pelaksana.register')->with('error', 'Email telah dipakai!');
                    Alert::error('Gagal!', 'Email telah dipakai!');
                    return back();
                }
                elseif($cekNoHP != 0){
                    return redirect()->route('pelaksana.register')->with('error', 'No. HP telah dipakai!');
                    Alert::error('Gagal!', 'No. HP telah dipakai!');
                    return back();
                }
            }
        }else{
            return redirect()->route('pelaksana.register')->with('error', 'Password tidak cocok!');
            Alert::error('Gagal!', 'Password tidak cocok!');
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/pelaksana');
    }
}
