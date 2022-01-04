<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Admin as PAA;
use App\Models\Sidang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    public function index(){
        $admin = PAA::where('ID_PEG',Auth::user()->username)->first();
        return view('admin/welcome', ['admin'=>$admin]);
    }

    public function mahasiswa(){
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        $dosenSet = Dosen::where('MAHASISWA_DIBIMBING', '<', 4)->get();
        return view('admin/mahasiswa', ['mahasiswa'=>$mahasiswa, 'dosen'=>$dosen, 'dosenSet'=>$dosenSet]);
    }

    public function setDosen(Request $request){
        $mahasiswa = Mahasiswa::where('NIM',$request->nim);
        $dosen = Dosen::where('NIP', $request->NIP)->first();
        $mahasiswaDibimbing = $dosen->MAHASISWA_DIBIMBING+1;
        $dosen = Dosen::where('NIP', $request->NIP);
        if($mahasiswa->update([
            'NIP_DOSEN_PEMBIMBING'=>$request->NIP
            ])
            &&
            $dosen->update([
            'MAHASISWA_DIBIMBING'=> $mahasiswaDibimbing
            ])){
            return redirect('/admin-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/admin-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        }
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
        $dosen->MAHASISWA_DIBIMBING = 0;

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
        $admin->PRODI = $request->prodi;
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

    public function sidang(){
        $sidang = Sidang::where('ID_PEG', Auth::user()->username)->get();
        return view('admin/sidang', ['sidang'=>$sidang]);
    }

    public function sidangJadwalkan(Request $request){
        $mahasiswa = Mahasiswa::where('NIM',$request->nim)->first();
        $array[0] = $mahasiswa->NIP_DOSEN_PEMBIMBING;
        //return $array;
        $dosen = Dosen::whereNotIn('NIP',$array)->get();
        $sidang = Sidang::all();
        return view('admin/tambah/sidang', ['sidang'=>$sidang, 'dosen'=>$dosen, 'id'=>$request->id]);
    }

    public function jadwalkanSidang(Request $request){
        $sidang = Sidang::where('ID_SIDANG',$request->id);
        $status = 1;
        if($sidang->update([
            'TANGGAL'=>$request->tanggal_sidang,
            'NIP1'=>$request->nip1,
            'NIP2'=>$request->nip2,
            'NIP3'=>$request->nip3,
            'LINK_ZOOM'=>$request->link_zoom,
            'STATUS'=>$status,
            ])){
            return redirect('/admin-sidang')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/admin-sidang')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }

    public function sidangTolak(Request $request){
        $sidang = Sidang::where('ID_SIDANG',$request->id);
        $status = 0;
        if($sidang->update([
            'STATUS'=>$status
            ])){
            return redirect('/admin-sidang')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/admin-sidang')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }

    public function sidangSelesai(Request $request){
        $sidang = Sidang::where('ID_SIDANG',$request->id);
        $status = 3;
        if($sidang->update([
            'STATUS'=>$status
            ])){
            return redirect('/admin-sidang')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/admin-sidang')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }
}
