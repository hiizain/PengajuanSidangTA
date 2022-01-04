<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Dosen;
use App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landPage/welcome');
});


// Admin
Route::get('/admin', [Admin::class, 'index']);

Route::get('/admin-admin', [Admin::class, 'admin']);
Route::get('/admin-admin-tambah', [Admin::class, 'tambahAdmin']);
Route::post('/admin-admin-create', [Admin::class, 'createAdmin']);

Route::get('/admin-mahasiswa', [Admin::class, 'mahasiswa']);
Route::post('/admin-mahasiswa-setDosen', [Admin::class, 'setDosen']);
Route::get('/admin-mahasiswa-tambah', [Admin::class, 'tambahMhs']);
Route::post('/admin-mahasiswa-create', [Admin::class, 'createMhs']);

Route::get('/admin-dosen', [Admin::class, 'dosen']);
Route::get('/admin-dosen-tambah', [Admin::class, 'tambahDosen']);
Route::post('/admin-dosen-create', [Admin::class, 'createDosen']);

Route::get('/admin-sidang', [Admin::class, 'sidang']);
Route::post('/admin-sidang-jadwalkan', [Admin::class, 'sidangJadwalkan']);
Route::post('/admin-sidang-jadwal', [Admin::class, 'jadwalkanSidang']);
Route::post('/admin-sidang-tolak', [Admin::class, 'sidangTolak']);
Route::post('/admin-sidang-selesai', [Admin::class, 'sidangSelesai']);


// Dosen
Route::get('/dosen', [Dosen::class, 'index']);

Route::get('/dosen-mahasiswa', [Dosen::class, 'mahasiswa']);

Route::post('/dosen-bimbingan', [Dosen::class, 'bimbingan']);
Route::post('/dosen-bimbingan-setuju', [Dosen::class, 'setujuBimbingan']);
Route::post('/dosen-bimbingan-menolak', [Dosen::class, 'menolakBimbingan']);
Route::post('/dosen-bimbingan-selesai', [Dosen::class, 'selesaiBimbingan']);
Route::post('/dosen-bimbingan-ACCFinal', [Dosen::class, 'ACCFinalBimbingan']);
Route::post('/dosen-bimbingan-komentar', [Dosen::class, 'komentarBimbingan']);

Route::get('/dosen-sidangDosbim', [Dosen::class, 'sidangDosbim']);
Route::get('/dosen-sidangDosenUji', [Dosen::class, 'sidangDosenUji']);


// Mahasiswa
Route::get('/mahasiswa', [Mahasiswa::class, 'index']);

Route::get('/mahasiswa-penelitian', [Mahasiswa::class, 'penelitian']);
Route::get('/mahasiswa-penelitian-tambah', [Mahasiswa::class, 'tambahPenelitian']);
Route::post('/mahasiswa-penelitian-create', [Mahasiswa::class, 'createPenelitian']);

Route::get('/mahasiswa-bimbingan', [Mahasiswa::class, 'bimbingan']);
Route::get('/mahasiswa-bimbingan-tambah', [Mahasiswa::class, 'tambahBimbingan']);
Route::post('/mahasiswa-bimbingan-create', [Mahasiswa::class, 'createBimbingan']);

Route::get('/mahasiswa-sidang', [Mahasiswa::class, 'sidang']);
Route::post('/mahasiswa-ajukanSidang', [Mahasiswa::class, 'ajukanSidang']);


// Login
Route::get('/login-admin', [LoginController::class, 'loginAdmin']);
Route::post('/admin-cek', [LoginController::class, 'adminCek']);

Route::get('/login-dosen', [LoginController::class, 'loginDosen']);
Route::post('/dosen-cek', [LoginController::class, 'dosenCek']);

Route::get('/login-mahasiswa', [LoginController::class, 'loginMahasiswa']);
Route::post('/mahasiswa-cek', [LoginController::class, 'mahasiswaCek']);


// logout
Route::post('/logout', [LoginController::class, 'logout']);