<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bimbingan;
use App\Models\Penelitian;

class Mahasiswa extends Controller
{
    public function penelitian(Request $request){
        $penelitian = Penelitian::all();
        return view('mahasiswa/penelitian', ['penelitian'=>$penelitian]);
    }

    public function tambahPenelitian(){
        return view('mahasiswa/tambah/penelitian');
    }

    public function createPenelitian(Request $request){
        $penelitian = new Penelitian;
        $penelitian->NIM = $request->nim;
        $penelitian->JUDUL_TA = $request->judul_ta;
        $penelitian->STATUS = 1;
        if($penelitian->save()){
            return redirect('/mahasiswa-penelitian')->with('tambahSuccess', 'Data berhasil ditambahkan');
        } else {
            return back()->with('tambahError', 'Data gagal ditambahkan');
        }
    }

    public function bimbingan(){
        $bimbingan = Bimbingan::all();
        return view('mahasiswa/bimbingan', ['bimbingan'=>$bimbingan]);
    }

    public function tambahBimbingan(){
        $penelitian = Penelitian::all();
        return view('mahasiswa/tambah/bimbingan', ['penelitian'=>$penelitian]);
    }

    public function createBimbingan(Request $request){
        $bimbingan = new Bimbingan;
        $bimbingan->ID_PENELITIAN = $request->id_penelitian;
        $bimbingan->TANGGAL = $request->tanggal;
        $bimbingan->STATUS = 2;
        $bimbingan->LAPORAN_TA = $request-file('laporan_ta');

        if($request->file('laporan_ta')){
            $request->file('laporan_ta')->store('file-laporan');
            if($bimbingan->save()){
                return redirect('/mahasiswa-bimbingan')->with('tambahSuccess', 'Data berhasil ditambahkan');
            } else 
                return back()->with('tambahError', 'Data gagal ditambahkan');
        } else 
            return back()->with('tambahError', 'Data gagal ditambahkan');
        
        
    }
}
