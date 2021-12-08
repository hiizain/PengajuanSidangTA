<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Admin as PAA;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    public function mahasiswa(){
        $mahasiswa = Mahasiswa::all();
        return view('admin/mahasiswa', ['mahasiswa'=>$mahasiswa]);
    }

    public function tambahMhs(){
        return view('admin/tambah/mahasiswa');
    }

    public function createMhs(Request $request){
        $mahasiswa = new Mahasiswa;
        $mahasiswa->NIM = $request->nim;
        $mahasiswa->NAMA = $request->nama;
        $mahasiswa->JENIS_KELAMIN = $request->jenis_kelamin;
        $mahasiswa->TANGGAL_LAHIR = $request->tanggal_lahir;
        $mahasiswa->ALAMAT = $request->alamat;
        $mahasiswa->PRODI = $request->prodi;
        $mahasiswa->NO_TELPON = $request->no_telpon;
        $mahasiswa->EMAIL = $request->email;

        $request->password = $request->nim;
        $request->password = Hash::make($request->password);

        $user = new User;
        $user->username = $request->nim;
        $user->password = $request->password;
        if($mahasiswa->save() && $user->save()){
            return redirect('/admin-mahasiswa')->with('tambahSuccess', 'Data berhasil ditambahkan');
        } else 
            return back()->with('tambahError', 'Data gagal ditambahkan');
        
    }

    public function dosen(){
        $dosen = Dosen::all();
        return view('admin/dosen', ['dosen'=>$dosen]);
    }

    public function tambahDosen(){
        return view('admin/tambah/dosen');
    }

    public function createDosen(Request $request){
        $dosen = new Dosen;
        $dosen->NIP = $request->nip;
        $dosen->NAMA = $request->nama;
        $dosen->JENIS_KELAMIN = $request->jenis_kelamin;
        $dosen->TANGGAL_LAHIR = $request->tanggal_lahir;
        $dosen->ALAMAT = $request->alamat;
        $dosen->NO_TELPON = $request->no_telpon;
        $dosen->EMAIL = $request->email;

        $request->password = $request->nip;
        $request->password = Hash::make($request->password);

        $user = new User;
        $user->username = $request->nip;
        $user->password = $request->password;
        if($dosen->save() && $user->save()){
            return redirect('/admin-dosen')->with('tambahSuccess', 'Data berhasil ditambahkan');
        } else 
            return back()->with('tambahError', 'Data gagal ditambahkan');
        
    }

    public function admin(){
        $admin = PAA::all();
        return view('admin/admin', ['admin'=>$admin]);
    }

    public function tambahAdmin(){
        return view('admin/tambah/admin');
    }

    public function createAdmin(Request $request){
        $admin = new PAA;
        $admin->ID_PEG = $request->id_peg;
        $admin->NAMA = $request->nama;
        $admin->JENIS_KELAMIN = $request->jenis_kelamin;
        $admin->TANGGAL_LAHIR = $request->tanggal_lahir;
        $admin->ALAMAT = $request->alamat;
        $admin->NO_TELPON = $request->no_telpon;

        $request->password = $request->id_peg;
        $request->password = Hash::make($request->password);

        $user = new User;
        $user->username = $request->id_peg;
        $user->password = $request->password;
        if($admin->save() && $user->save()){
            return redirect('/admin-admin')->with('tambahSuccess', 'Data berhasil ditambahkan');
        } else 
            return back()->with('tambahError', 'Data gagal ditambahkan');
        
    }
}
