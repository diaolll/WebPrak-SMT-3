<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\DaftarPet;
use App\Models\Dokter;
use App\Models\Kategori;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get total counts for statistics
        $totalUsers = User::count();
        $totalPemilik = Pemilik::count();
        $totalPet = DaftarPet::count();
        $totalDokter = Dokter::count();

        // Get master data counts
        $masterDataCounts = [
            'Kategori' => Kategori::count(),
            'Ras Hewan' => RasHewan::count(),
            'Jenis Hewan' => JenisHewan::count(),
            'Kategori Klinis' => KategoriKlinis::count(),
            'Kode Tindakan/Terapi' => KodeTindakanTerapi::count(),
        ];

        return view('admin.Administrator.Dashboard_admin', [
            'totalUsers' => $totalUsers,
            'totalPemilik' => $totalPemilik,
            'totalPet' => $totalPet,
            'totalDokter' => $totalDokter,
            'masterDataCounts' => $masterDataCounts,
        ]);
    }
}
