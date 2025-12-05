<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter; // Model data detail Dokter
use App\Models\RekamMedis; // Model data transaksional
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class DokterController extends Controller 
{
    /**
     * Menampilkan Dashboard Dokter dengan daftar pasien yang ditugaskan.
     * Ini adalah fungsi utama (index) yang diakses setelah login.
     * LOGIC DATA SETUP DIHAPUS DARI SINI.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Asumsi: Data detail Dokter sudah ada atau tidak diperlukan untuk loading dashboard
        $dataDokter = Dokter::where('id_user', $user->iduser)->first();

        // JIKA ANDA TIDAK MAU ADA REDIRECT PAKSA, HAPUS BLOK IF INI
        // if (!$dataDokter) {
        //     return redirect()->route('dokter.data_detail.show'); 
        // }
        
        // Lanjutkan loading data (ambil idDokter, atau gunakan ID placeholder jika null)
        $idDokter = $dataDokter ? $dataDokter->id_dokter : 0; 

        // 2. Ambil Pasien Hari Ini yang ditugaskan
        $pasienHariIni = RekamMedis::with(['pet.pemilik.user'])
            ->where('dokter_pemeriksa', $idDokter)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Tampilkan dashboard utama
        return view('admin.dokter.dashboard_dokter', compact('pasienHariIni')); 
    }

public function profile()
{
    $user = \App\Models\User::with(['roles', 'dokter'])
        ->where('iduser', Auth::id())
        ->first();

    $roles = $user->roles ?? collect();
    $roleNames = $roles->pluck('nama')->implode(', ');

    $dokter = $user->dokter; // BOLEH NULL, VIEW SUDAH AMAN

    return view('admin.Dokter.profile', compact(
        'user',
        'roles',
        'roleNames',
        'dokter'
    ));
}





    
    // FUNGSI showForm() DIHAPUS
    // FUNGSI store() DIHAPUS
}