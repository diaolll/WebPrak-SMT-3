<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\admin\JenisHewanController;
use App\Http\Controllers\admin\PemilikController;
use App\Http\Controllers\admin\RasHewanController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\KategoriKlinisController;
use App\Http\Controllers\admin\KodeTindakanTerapiController;
use App\Http\Controllers\admin\DaftarPetController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\Resepsionis\ResepsionisDashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dokter\DokterController;
use App\Http\Controllers\dokter\DokterProfileController;
use App\Http\Controllers\pemilik\PemilikDashboardController;
use App\Http\Controllers\perawat\PerawatDashboardController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Dokter\PetController;
use App\Http\Controllers\Dokter\RekamMedisController;




/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('site.struktur');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');
Route::get('/pelatihan', [SiteController::class, 'pelatihan'])->name('site.pelatihan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('site.kontak');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cekKoneksi');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Middleware: Administrator (CRUD Master Data)
|--------------------------------------------------------------------------
*/
Route::middleware(['isAdministrator'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 1. JENIS HEWAN (CRUD LENGKAP)
    Route::get('admin/jenis_hewan', [JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');
    Route::get('admin/jenis_hewan/create', [JenisHewanController::class, 'create'])->name('admin.jenis_hewan.create');
    Route::post('admin/jenis_hewan/store', [JenisHewanController::class, 'store'])->name('admin.jenis_hewan.store');
    Route::get('admin/jenis_hewan/{idjenis_hewan}/edit', [JenisHewanController::class, 'edit'])->name('admin.jenis_hewan.edit');
    Route::post('admin/jenis_hewan/{idjenis_hewan}/update', [JenisHewanController::class, 'update'])->name('admin.jenis_hewan.update');
    Route::delete('admin/jenis_hewan/{idjenis_hewan}', [JenisHewanController::class, 'destroy'])->name('admin.jenis_hewan.destroy');

    // 2. RAS HEWAN (CRUD LENGKAP)
    Route::get('admin/ras_hewan', [RasHewanController::class, 'index'])->name('admin.ras_hewan.index');
    Route::get('admin/ras_hewan/create', [RasHewanController::class, 'create'])->name('admin.ras_hewan.create');
    Route::post('admin/ras_hewan/store', [RasHewanController::class, 'store'])->name('admin.ras_hewan.store');
    Route::get('admin/ras_hewan/{idras_hewan}/edit', [RasHewanController::class, 'edit'])->name('admin.ras_hewan.edit');
    Route::post('admin/ras_hewan/{idras_hewan}/update', [RasHewanController::class, 'update'])->name('admin.ras_hewan.update');
    Route::delete('admin/ras_hewan/{idras_hewan}', [RasHewanController::class, 'destroy'])->name('admin.ras_hewan.destroy');

    // 3. KATEGORI (CRUD LENGKAP)
    Route::get('admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('admin/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('admin/kategori/store', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('admin/kategori/{idkategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('admin/kategori/{idkategori}/update', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('admin/kategori/{idkategori}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    // 4. KATEGORI KLINIS (CRUD LENGKAP)
    Route::get('admin/kategori_klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori_klinis.index');
    Route::get('admin/kategori_klinis/create', [KategoriKlinisController::class, 'create'])->name('admin.kategori_klinis.create');
    Route::post('admin/kategori_klinis/store', [KategoriKlinisController::class, 'store'])->name('admin.kategori_klinis.store');
    Route::get('admin/kategori_klinis/{idkategori_klinis}/edit', [KategoriKlinisController::class, 'edit'])->name('admin.kategori_klinis.edit');
    Route::post('admin/kategori_klinis/{idkategori_klinis}/update', [KategoriKlinisController::class, 'update'])->name('admin.kategori_klinis.update');
    Route::delete('admin/kategori_klinis/{idkategori_klinis}', [KategoriKlinisController::class, 'destroy'])->name('admin.kategori_klinis.destroy');

    // 5. KODE TINDAKAN TERAPI (CRUD LENGKAP)
    Route::get('admin/kode_tindakan_terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode_tindakan_terapi.index');
    Route::get('admin/kode_tindakan_terapi/create', [KodeTindakanTerapiController::class, 'create'])->name('admin.kode_tindakan_terapi.create');
    Route::post('admin/kode_tindakan_terapi/store', [KodeTindakanTerapiController::class, 'store'])->name('admin.kode_tindakan_terapi.store');
    Route::get('admin/kode_tindakan_terapi/{idkode_tindakan_terapi}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('admin.kode_tindakan_terapi.edit');
    Route::post('admin/kode_tindakan_terapi/{idkode_tindakan_terapi}/update', [KodeTindakanTerapiController::class, 'update'])->name('admin.kode_tindakan_terapi.update');
    Route::delete('admin/kode_tindakan_terapi/{idkode_tindakan_terapi}', [KodeTindakanTerapiController::class, 'destroy'])->name('admin.kode_tindakan_terapi.destroy');

    // 6. PEMILIK (CRUD LENGKAP)
    Route::get('admin/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
    Route::get('admin/pemilik/create', [PemilikController::class, 'create'])->name('admin.pemilik.create');
    Route::post('admin/pemilik/store', [PemilikController::class, 'store'])->name('admin.pemilik.store');
    Route::get('admin/pemilik/{idpemilik}/edit', [PemilikController::class, 'edit'])->name('admin.pemilik.edit');
    Route::post('admin/pemilik/{idpemilik}/update', [PemilikController::class, 'update'])->name('admin.pemilik.update');
    Route::delete('admin/pemilik/{idpemilik}', [PemilikController::class, 'destroy'])->name('admin.pemilik.destroy');

    // 7. DAFTAR PET (CRUD LENGKAP) 
    Route::get('admin/daftar_pet', [DaftarPetController::class, 'index'])->name('admin.daftar_pet.index');
    Route::get('admin/daftar_pet/create', [DaftarPetController::class, 'create'])->name('admin.daftar_pet.create');
    Route::post('admin/daftar_pet/store', [DaftarPetController::class, 'store'])->name('admin.daftar_pet.store');
    Route::get('admin/daftar_pet/{idpet}/edit', [DaftarPetController::class, 'edit'])->name('admin.daftar_pet.edit');
    Route::post('admin/daftar_pet/{idpet}/update', [DaftarPetController::class, 'update'])->name('admin.daftar_pet.update');
    Route::delete('admin/daftar_pet/{idpet}', [DaftarPetController::class, 'destroy'])->name('admin.daftar_pet.destroy');

    // 8. ROLE (CRUD LENGKAP)
    Route::get('admin/role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('admin/role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('admin/role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('admin/role/{idrole}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('admin/role/{idrole}/update', [RoleController::class, 'update'])->name('admin.role.update');
    Route::delete('admin/role/{idrole}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    // 9. USER (CRUD LENGKAP)
    Route::get('admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('admin/user/{iduser}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('admin/user/{iduser}/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/{iduser}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // Route untuk CRUD Dokter (Mengganti yang lama)
    Route::get('admin/dokter', [App\Http\Controllers\admin\DokterController::class, 'index'])->name('admin.dokter.index');
    Route::get('admin/dokter/create', [App\Http\Controllers\admin\DokterController::class, 'create'])->name('admin.dokter.create');
    Route::post('admin/dokter/store', [App\Http\Controllers\admin\DokterController::class, 'store'])->name('admin.dokter.store');
    Route::get('admin/dokter/{id_dokter}/edit', [App\Http\Controllers\admin\DokterController::class, 'edit'])->name('admin.dokter.edit');
    Route::post('admin/dokter/{id_dokter}/update', [App\Http\Controllers\admin\DokterController::class, 'update'])->name('admin.dokter.update');
    Route::delete('admin/dokter/{id_dokter}', [App\Http\Controllers\admin\DokterController::class, 'destroy'])->name('admin.dokter.destroy');

    // ROUTE CRUD PERAWAT
    Route::get('admin/perawat', [App\Http\Controllers\admin\PerawatController::class, 'index'])->name('admin.perawat.index');
    Route::get('admin/perawat/create', [App\Http\Controllers\admin\PerawatController::class, 'create'])->name('admin.perawat.create');
    Route::post('admin/perawat/store', [App\Http\Controllers\admin\PerawatController::class, 'store'])->name('admin.perawat.store');
    Route::get('admin/perawat/{id_perawat}/edit', [App\Http\Controllers\admin\PerawatController::class, 'edit'])->name('admin.perawat.edit');
    Route::post('admin/perawat/{id_perawat}/update', [App\Http\Controllers\admin\PerawatController::class, 'update'])->name('admin.perawat.update');
    Route::delete('admin/perawat/{id_perawat}', [App\Http\Controllers\admin\PerawatController::class, 'destroy'])->name('admin.perawat.destroy');
});

Route::middleware(['isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\Resepsionis\DashboardResepsionisController::class, 'index'])->name('admin.Resepsionis.Dashboard_Resepsionis');

    // Rute CRUD Pet
    Route::get(
        '/resepsionis/pet',
        [App\Http\Controllers\Resepsionis\ResepsionisController::class, 'index']
    )->name('admin.Resepsionis.pet.index');

    Route::get(
        '/resepsionis/pet/create',
        [App\Http\Controllers\Resepsionis\ResepsionisController::class, 'create']
    )->name('admin.Resepsionis.pet.create');

    Route::post(
        '/resepsionis/pet',
        [App\Http\Controllers\Resepsionis\ResepsionisController::class, 'store']
    )->name('admin.Resepsionis.pet.store');

    Route::get(
        '/resepsionis/pet/{id}/edit',
        [App\Http\Controllers\Resepsionis\ResepsionisController::class, 'edit']
    )->name('admin.Resepsionis.pet.edit');

    Route::put(
        '/resepsionis/pet/{id}',
        [App\Http\Controllers\Resepsionis\ResepsionisController::class, 'update']
    )->name('admin.Resepsionis.pet.update');

    Route::delete(
        '/resepsionis/pet/{id}',
        [App\Http\Controllers\Resepsionis\ResepsionisController::class, 'destroy']
    )->name('admin.Resepsionis.pet.destroy');

    Route::get(
        '/temu-dokter',
        [TemuDokterController::class, 'index']
    )->name('admin.resepsionis.temu_dokter.index');

    Route::get(
        '/temu-dokter/create',
        [TemuDokterController::class, 'create']
    )->name('admin.resepsionis.temu_dokter.create');

    Route::post(
        '/temu-dokter',
        [TemuDokterController::class, 'store']
    )->name('admin.resepsionis.temu_dokter.store');

    Route::get(
        '/temu-dokter/nomor-urut',
        [TemuDokterController::class, 'nomorUrut']
    )->name('admin.resepsionis.temu_dokter.form_norut');

    Route::delete(
        '/temu-dokter/{id}',
        [TemuDokterController::class, 'destroy']
    )->name('admin.resepsionis.temu_dokter.destroy');



    Route::get('/resepsionis/pemilik', [\App\Http\Controllers\Resepsionis\PemilikController::class, 'index'])
        ->name('admin.resepsionis.pemilik.index');

    Route::get('/resepsionis/pemilik/create', [\App\Http\Controllers\Resepsionis\PemilikController::class, 'create'])
        ->name('admin.resepsionis.pemilik.create');

    Route::post('resepsionis/pemilik/store', [\App\Http\Controllers\Resepsionis\PemilikController::class, 'store'])
        ->name('admin.resepsionis.pemilik.store');

    Route::get('/resepsionis/pemilik/edit/{id}', [\App\Http\Controllers\Resepsionis\PemilikController::class, 'edit'])
        ->name('admin.resepsionis.pemilik.edit');

    Route::put('/resepsionis/pemilik/update/{id}', [\App\Http\Controllers\Resepsionis\PemilikController::class, 'update'])
        ->name('admin.resepsionis.pemilik.update');

    Route::delete('/resepsionis/pemilik/delete/{id}', [\App\Http\Controllers\Resepsionis\PemilikController::class, 'destroy'])
        ->name('admin.resepsionis.pemilik.destroy');

    Route::put(
        '/resepsionis/update-status/{id}',
        [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'updateStatus']
    )
        ->name('resepsionis.updateStatus');
});



Route::prefix('admin/dokter')
    ->middleware(['auth', 'isDokter'])
    ->group(function () {
        
        Route::get('/profil', [DokterController::class, 'profile'])
            ->name('admin.dokter.profile');

        // DATA PET
        Route::get('/pet', [PetController::class, 'index'])
            ->name('admin.dokter.pet.index');

        Route::get('/rekam-medis/{idpet}', [RekamMedisController::class, 'index'])
            ->name('admin.dokter.rekam_medis.index');

        Route::get('/rekam-medis/{idpet}/create', [RekamMedisController::class, 'create'])
            ->name('admin.dokter.rekam_medis.create');

        Route::post('/rekam-medis/{idpet}', [RekamMedisController::class, 'store'])
            ->name('admin.dokter.rekam_medis.store');

        Route::get('/rekam-medis/{id}/edit', [RekamMedisController::class, 'edit'])
            ->name('admin.dokter.rekam_medis.edit');

        Route::put('/rekam-medis/{id}', [RekamMedisController::class, 'update'])
            ->name('admin.dokter.rekam_medis.update');

        Route::delete('/rekam-medis/{id}', [RekamMedisController::class, 'destroy'])
            ->name('admin.dokter.rekam_medis.destroy');
    });

    
Route::middleware('isPemilik')->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\pemilik\PemilikDashboardController::class, 'index'])->name('admin.pemilik.Dashboard_pemilik');
});

Route::middleware('isPerawat')->group(function () {
    Route::get('/pet', [\App\Http\Controllers\Perawat\PetController::class, 'index'])
        ->name('admin.Perawat.pet.index');

    // REKAM MEDIS
    Route::get('/rekam-medis/{idpet}', [\App\Http\Controllers\Perawat\RekamMedisController::class, 'index'])
        ->name('admin.Perawat.rekam_medis.index');

    Route::get('/rekam-medis/{idpet}/create', [\App\Http\Controllers\Perawat\RekamMedisController::class, 'create'])
        ->name('admin.Perawat.rekam_medis.create');

    Route::post('/rekam-medis/{idpet}', [\App\Http\Controllers\Perawat\RekamMedisController::class, 'store'])
        ->name('admin.Perawat.rekam_medis.store');

    Route::get('/rekam-medis/edit/{id}', [\App\Http\Controllers\Perawat\RekamMedisController::class, 'edit'])
        ->name('admin.Perawat.rekam_medis.edit');

    Route::put('/rekam-medis/{id}', [\App\Http\Controllers\Perawat\RekamMedisController::class, 'update'])
        ->name('admin.Perawat.rekam_medis.update');

    Route::delete('/rekam-medis/{id}', [\App\Http\Controllers\Perawat\RekamMedisController::class, 'destroy'])
        ->name('admin.Perawat.rekam_medis.destroy');

    Route::get(
        '/profile',
        [App\Http\Controllers\perawat\PerawatDashboardController::class, 'profile']
    )->name('admin.Perawat.profile');
});
