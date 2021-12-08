<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Bimbingan;
use App\Models\Penelitian;

class Dosen extends Controller
{
    public function mahasiswa(){
        $mahasiswa = Mahasiswa::all();
        return view('dosen/mahasiswa', ['mahasiswa'=>$mahasiswa]);
    }

    public function bimbingan(){
        $bimbingan = Bimbingan::all();
        return view('dosen/bimbingan', ['bimbingan'=>$bimbingan]);
    }

    public function setujuBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $status = 1;
        if($bimbingan->update([
            'STATUS'=>$status
            ])){
            return redirect('/dosen-bimbingan')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return back()->with('updateError', 'Data gagal dirubah');
        }
    }

    public function menolakBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $status = 0;
        if($bimbingan->update([
            'STATUS'=>$status
            ])){
            return redirect('/dosen-bimbingan')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return back()->with('updateError', 'Data gagal dirubah');
        }
    }

    public function ACCFinalBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $penelitian = Penelitian::where('ID_PENELITIAN',$bimbingan->ID_PENELITIAN);
        $statusBim = 5;
        $statusPnlt = 5;
        if($bimbingan->update([
            'STATUS'=>$statusBim
            ]) 
            && 
            $penelitian->update([
            'STATUS'=>$statusPnlt
            ])){
            return redirect('/dosen-bimbingan')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return back()->with('updateError', 'Data gagal dirubah');
        }
    }

    public function komentarBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        if($bimbingan->update([
            'KOMENTAR'=>$request->komentar
            ])){
            return redirect('/dosen-bimbingan')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return back()->with('updateError', 'Data gagal dirubah');
        }
    }
}
