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

// Logout
Route::post('/logout', [SiteController::class, 'logout'])->name('site.logout');


