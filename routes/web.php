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

Route::get('/admin', function () {
    return view('admin/welcome');
});

// Admin
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


// Dosen
Route::get('/dosen-mahasiswa', [Dosen::class, 'mahasiswa']);

Route::post('/dosen-bimbingan', [Dosen::class, 'bimbingan']);
Route::post('/dosen-bimbingan-setuju', [Dosen::class, 'setujuBimbingan']);
Route::post('/dosen-bimbingan-menolak', [Dosen::class, 'menolakBimbingan']);
Route::post('/dosen-bimbingan-ACCFinal', [Dosen::class, 'ACCFinalBimbingan']);
Route::post('/dosen-bimbingan-komentar', [Dosen::class, 'komentarBimbingan']);


// Mahasiswa
Route::get('/mahasiswa', [Mahasiswa::class, 'index']);

Route::get('/mahasiswa-penelitian', [Mahasiswa::class, 'penelitian']);
Route::get('/mahasiswa-penelitian-tambah', [Mahasiswa::class, 'tambahPenelitian']);
Route::post('/mahasiswa-penelitian-create', [Mahasiswa::class, 'createPenelitian']);

Route::get('/mahasiswa-bimbingan', [Mahasiswa::class, 'bimbingan']);
Route::get('/mahasiswa-bimbingan-tambah', [Mahasiswa::class, 'tambahBimbingan']);
Route::post('/mahasiswa-bimbingan-create', [Mahasiswa::class, 'createBimbingan']);

Route::get('/mahasiswa-sidang', [Mahasiswa::class, 'sidang']);
Route::get('/mahasiswa-sidang-tambah', [Mahasiswa::class, 'tambahSidang']);
Route::post('/mahasiswa-sidang-create', [Mahasiswa::class, 'createSidang']);


// Login
Route::get('/login-admin', [LoginController::class, 'loginAdmin']);
Route::post('/admin-cek', [LoginController::class, 'adminCek']);

Route::get('/login-dosen', [LoginController::class, 'loginDosen']);
Route::post('/dosen-cek', [LoginController::class, 'dosenCek']);

Route::get('/login-mahasiswa', [LoginController::class, 'loginMahasiswa']);
Route::post('/mahasiswa-cek', [LoginController::class, 'mahasiswaCek']);


// logout
Route::post('/logout', [LoginController::class, 'logout']);