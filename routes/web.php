<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [SiteController::class, 'index'])->name('site.home');

Route::get('/struktur',[SiteController::class, 'struktur'])->name('site.struktur');

Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');

Route::get('/pelatihan', [SiteController::class, 'pelatihan'])->name('site.pelatihan');

Route::get('/kontak', [SiteController::class, 'kontak'])->name('site.kontak');

Route ::get('/login', [SiteController::class, 'login'])->name('site.login');

Route::post('/login', [SiteController::class, 'doLogin'])->name('site.login.post');

Route::post('/logout', [SiteController::class, 'logout'])->name('site.logout');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cekKoneksi'); // menambahkan route untuk cekKoneksi

// Contoh tujuan redirect per role (buat placeholder dulu)
Route::get('/admin', function () {
    return view('site.admin');
})->name('site.admin');

Route::get('admin/jenis-hewan', [App\Http\Controllers\admin\JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');

Route::get('admin/pemilik', [App\Http\Controllers\admin\PemilikController::class, 'index'])->name('admin.pemilik.index');

Route::get('admin/ras_hewan', [App\Http\Controllers\admin\RasHewanController::class, 'index'])->name('admin.ras_hewan.index');

Route::get('admin/kategori', [App\Http\Controllers\admin\KategoriController::class, 'index'])->name('admin.kategori.index');

Route::get('admin/kategori_klinis', [App\Http\Controllers\admin\KategoriKlinisController::class, 'index'])->name('admin.kategori_klinis.index');

Route::get('admin/kode_tindakan_terapi', [App\Http\Controllers\admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode_tindakan_terapi.index');

Route::get('admin/daftar_pet', [App\Http\Controllers\admin\DaftarPetController::class, 'index'])->name('admin.daftar_pet.index');

Route::get('admin/role', [App\Http\Controllers\admin\RoleController::class, 'index'])->name('admin.role.index');

Route::get('admin/user', [App\Http\Controllers\admin\UserController::class, 'index'])->name('admin.user.index');