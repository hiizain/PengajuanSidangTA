<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Bimbingan;
use App\Models\Penelitian;
use App\Models\Sidang;
use App\Models\Dosen as DSN;
use Illuminate\Support\Facades\Auth;

class Dosen extends Controller
{
    public function index(){
        $dosen = DSN::where('NIP',Auth::user()->username)->first();
        return view('dosen/welcome', ['dosen'=>$dosen]);
    }

    public function mahasiswa(){
        $mahasiswa = Mahasiswa::where('NIP_DOSEN_PEMBIMBING', Auth::user()->username)->orderBy('NIM')->get();
        return view('dosen/mahasiswa', ['mahasiswa'=>$mahasiswa]);
    }

    public function bimbingan(Request $request){
        $mahasiswa = Mahasiswa::where('NIM', $request->nim)->first();
        
        if ($penelitian = Penelitian::where('NIM', $request->nim)->first()){
            $bimbingan = Bimbingan::where('ID_PENELITIAN', $penelitian->ID_PENELITIAN)->get();
            return view('dosen/bimbingan', ['bimbingan'=>$bimbingan, 'NIM'=>$request->nim, 'mahasiswa'=>$mahasiswa]);
        }
        return back()->with('bimbinganError', 'Belum pernah mengajukan bimbingan.');
    }

    public function setujuBimbingan(Request $request){
        $bimbinganFind = Bimbingan::where('ID_BIMBINGAN',$request->id)->first();
        $penelitian = Penelitian::where('ID_PENELITIAN', $bimbinganFind->ID_PENELITIAN);
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $statusBim = 1;
        if($bimbingan->update([
            'STATUS'=>$statusBim
            ])
            &&
            $penelitian->update([
                'STATUS'=>2
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

    public function selesaiBimbingan(Request $request){
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $status = 3;
        if($bimbingan->update([
            'STATUS'=>$status
            ])){
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        } else {
            return redirect('/dosen-mahasiswa')->with('updateSuccess', 'Data berhasil dirubah');
        }
    }

    public function ACCFinalBimbingan(Request $request){
        $penelitian = Penelitian::where('NIM', $request->nim)->first();
        if($bimbinganFinal = Bimbingan::where('ID_PENELITIAN', $penelitian->ID_PENELITIAN)->where('STATUS', 5)){
        $statusBim = 3;
        $bimbinganFinal->update([
            'STATUS'=>$statusBim
        ]);
        }
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id)->first();
        $penelitian = Penelitian::where('ID_PENELITIAN', $bimbingan->ID_PENELITIAN);
        $bimbingan = Bimbingan::where('ID_BIMBINGAN',$request->id);
        $statusBim = 5;
        if($bimbingan->update([
            'STATUS'=>$statusBim
            ])
            &&
            $penelitian->update([
                'STATUS'=>5
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

    public function sidangDosbim(){
        $mahasiswa = Mahasiswa::where('NIP_DOSEN_PEMBIMBING', Auth::user()->username)->get();
        if ($mahasiswa->count()!=0){
            $a=0;
            foreach ($mahasiswa as $item){
            $array[$a] = $item->NIM;
            $a++;
            }
            $sidang = Sidang::whereIn('NIM', $array)->where('STATUS', 1)->get();
            return view('dosen/sidangDosbim', ['sidang'=>$sidang]);
        }
        return back()->with('bimbinganError', 'Tidak memiliki mahasiswa bimbingan.');
    }

    public function sidangDosenUji(){
        $sidang = Sidang::where('NIP1', Auth::user()->username)
                  ->orWhere('NIP2', Auth::user()->username)
                  ->orWhere('NIP3', Auth::user()->username)
                  ->where('STATUS', 1)->get();
        return view('dosen/sidangDosenUji', ['sidang'=>$sidang]);
    }
}
