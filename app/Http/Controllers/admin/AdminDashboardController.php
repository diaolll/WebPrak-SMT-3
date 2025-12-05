<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class AdminDashboardController extends Controller
{
    public function index()
{
    // Ringkasan Data Master
    $masterDataCounts = [
        'Pemilik' => DB::table('pemilik')->count(),
        'User' => DB::table('user')->count(),
        'Daftar Pet' => DB::table('pet')->count(),
        'Jenis Hewan' => DB::table('jenis_hewan')->count(),
        'Kategori' => DB::table('kategori')->count(),
        'Kategori Klinis' => DB::table('kategori_klinis')->count(),
        'Kode Tindakan' => DB::table('kode_tindakan_terapi')->count(),
        'Role' => DB::table('role')->count(),
    ];

    // Statistik Utama Dashboard (4 BOX BARU)
    $totalUsers   = DB::table('user')->count();
    $totalPemilik = DB::table('pemilik')->count();
    $totalPet     = DB::table('pet')->count();

    // Kalau kamu belum punya tabel laporan, bebas ganti misalnya 'rekam_medis'
    // Sementara aku pakai tabel 'rekam_medis' kalau itu sistem klinik hewan.
    $totalDokter = DB::table('dokter')->count();    // Kalau ga ada tabel itu, ganti jadi tabel yang benar ya.

    return view('admin.Administrator.Dashboard_admin', compact(
        'masterDataCounts',
        'totalUsers',
        'totalPemilik',
        'totalPet',
        'totalDokter'
    ));
}
}