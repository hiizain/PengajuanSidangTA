<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginMahasiswa(){
        return view('login/mahasiswa/login');
    }

    public function mahasiswaCek(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($userFound = User::where('username',$request->username)->first()){
            if ($mahasiswa = Mahasiswa::where('NIM',$userFound->username)->first()){
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
        
                    return redirect()->intended('/mahasiswa-penelitian');
                } else
                return back()->with('loginError', 'Login gagal');
            } else
            return back()->with('loginError', 'Anda bukan mahasiswa');
        } else 
        return back()->with('loginError', 'Login gagal');
    }

    public function loginDosen(){
        return view('login/dosen/login');
    }

    public function dosenCek(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($userFound = User::where('username',$request->username)->first()){
            if ($dosen = Dosen::where('NIP',$userFound->username)->first()){
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
        
                    return redirect()->intended('/dosen-mahasiswa');
                } else
                return back()->with('loginError', 'Login gagal');
            } else
            return back()->with('loginError', 'Anda bukan dosen');
        } else 
        return back()->with('loginError', 'Login gagal');
    }

    public function loginAdmin(){
        return view('login/admin/login');
    }

    public function adminCek(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($userFound = User::where('username',$request->username)->first()){
            if ($admin = Admin::where('ID_PEG',$userFound->username)->first()){
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
        
                    return redirect()->intended('/admin');
                } else
                return back()->with('loginError', 'Login gagal');
            } else
            return back()->with('loginError', 'Anda bukan admin');
        } else 
        return back()->with('loginError', 'Login gagal');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginCek(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($userFound = User::where('username',$request->username)->first()){
        if ($admin = Admin::where('ID_PEG',$userFound->username)->first()){
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect()->intended('/admin', ['admin'=>$admin]);
            } else
            return back()->with('loginError', 'Login gagal');
        } else
        return back()->with('loginError', 'Anda bukan admin');
        } else 
        return back()->with('loginError', 'Login gagal');
    }


}
