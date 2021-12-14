<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Bimbingan;
use App\Models\Penelitian;
use Illuminate\Support\Facades\Auth;

class Dosen extends Controller
{
    public function mahasiswa(){
        $mahasiswa = Mahasiswa::where('NIP_DOSEN', Auth::user()->username)->get();
        return view('dosen/mahasiswa', ['mahasiswa'=>$mahasiswa]);
    }

    public function bimbingan(Request $request){
        $penelitian = Penelitian::where('NIM', $request->nim)->first();
        $bimbingan = Bimbingan::where('ID_PENELITIAN', $penelitian->ID_PENELITIAN)->get();
        return view('dosen/bimbingan', ['bimbingan'=>$bimbingan, 'NIM'=>$request->nim]);
    }

    public function setujuBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $status = 1;
        if($bimbingan->update([
            'STATUS'=>$status
            ])){
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }

    public function menolakBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $status = 0;
        if($bimbingan->update([
            'STATUS'=>$status
            ])){
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }

    public function ACCFinalBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $statusBim = 5;
        if($bimbingan->update([
            'STATUS'=>$statusBim
            ])){
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }

    public function komentarBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        if($bimbingan->update([
            'KOMENTAR'=>$request->komentar
            ])){
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }
}
