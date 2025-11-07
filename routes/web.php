<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\admin\JenisHewanController;
use App\Http\Controllers\admin\PemilikController;
use App\Http\Controllers\admin\RasHewanController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\KodeTindakanTerapiController;
use App\Http\Controllers\admin\DaftarPetController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;  
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\Resepsionis\ResepsionisDashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [SiteController::class, 'index'])->name('site.home');

Route::get('/struktur',[SiteController::class, 'struktur'])->name('site.struktur');

Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');

Route::get('/pelatihan', [SiteController::class, 'pelatihan'])->name('site.pelatihan');

Route::get('/kontak', [SiteController::class, 'kontak'])->name('site.kontak');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cekKoneksi'); // menambahkan route untuk cekKoneksi

// Route::get('/', function () {
//     return view('home');
// })->name('site.home');

// // Route::get('admin/jenis-hewan', [App\Http\Controllers\admin\JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');

// // Route::get('admin/pemilik', [App\Http\Controllers\admin\PemilikController::class, 'index'])->name('admin.pemilik.index');

// // Route::get('admin/ras_hewan', [App\Http\Controllers\admin\RasHewanController::class, 'index'])->name('admin.ras_hewan.index');

// // Route::get('admin/kategori', [App\Http\Controllers\admin\KategoriController::class, 'index'])->name('admin.kategori.index');

// // Route::get('admin/kategori_klinis', [App\Http\Controllers\admin\KategoriKlinisController::class, 'index'])->name('admin.kategori_klinis.index');

// // Route::get('admin/kode_tindakan_terapi', [App\Http\Controllers\admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode_tindakan_terapi.index');

// // Route::get('admin/daftar_pet', [App\Http\Controllers\admin\DaftarPetController::class, 'index'])->name('admin.daftar_pet.index');

// // Route::get('admin/role', [App\Http\Controllers\admin\RoleController::class, 'index'])->name('admin.role.index');

// Route::get('admin/user', [App\Http\Controllers\admin\UserController::class, 'index'])->name('admin.user.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// akses administrator
Route::middleware(['isAdministrator'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/jenis_hewan', [App\Http\Controllers\admin\JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');
    Route::get('/jenis_hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenis_hewan.create');
    Route::post('/jenis_hewan/store', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('admin/user', [App\Http\Controllers\admin\UserController::class, 'index'])->name('admin.user.index');
    Route::get('admin/pemilik', [App\Http\Controllers\admin\PemilikController::class, 'index'])->name('admin.pemilik.index');
    Route::get('admin/ras_hewan', [App\Http\Controllers\admin\RasHewanController::class, 'index'])->name('admin.ras_hewan.index');
    Route::get('admin/kategori', [App\Http\Controllers\admin\KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('admin/kategori_klinis', [App\Http\Controllers\admin\KategoriKlinisController::class, 'index'])->name('admin.kategori_klinis.index');
    Route::get('admin/kode_tindakan_terapi', [App\Http\Controllers\admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode_tindakan_terapi.index');
    Route::get('admin/daftar_pet', [App\Http\Controllers\admin\DaftarPetController::class, 'index'])->name('admin.daftar_pet.index');
    Route::get('admin/role', [App\Http\Controllers\admin\RoleController::class, 'index'])->name('admin.role.index');

});

Route::middleware(['isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\Resepsionis\DashboardResepsionisController::class, 'index'])->name('admin.Resepsionis.Dashboard_Resepsionis');
});

Route::middleware('isDokter')->group(function () {
    Route::get('/dokter', [App\Http\Controllers\dokter\DokterDashboardController::class, 'index'])->name('admin.Dokter.Dashboard_dokter');
});

Route::middleware('isPemilik')->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\pemilik\PemilikDashboardController::class, 'index'])->name('admin.pemilik.Dashboard_pemilik');
});

Route::middleware('isPerawat')->group(function () {
    Route::get('/perawat/dashboard', [App\Http\Controllers\perawat\PerawatDashboardController::class, 'index'])->name('admin.perawat.Dashboard_perawat');
});

// middleware
// route web app
