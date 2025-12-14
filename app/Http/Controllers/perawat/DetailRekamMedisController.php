<?php

namespace App\Http\Controllers\perawat; // <-- Namespace sudah diubah

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\RekamMedis; // Diperlukan untuk mendapatkan ID Pet

class DetailRekamMedisController extends Controller
{
    /**
     * Tampilkan semua detail rekam medis untuk idrekam_medis tertentu (Hanya View).
     */
    public function index($idrekam_medis)
    {
        // 1. Ambil data Rekam Medis utama (untuk mendapatkan idpet, diperlukan untuk tombol kembali)
        $rekam = RekamMedis::findOrFail($idrekam_medis);
        $idpet = $rekam->idpet;

        // 2. Ambil detail rekam medis
        $detailRekamMedis = DetailRekamMedis::where('idrekam_medis', $idrekam_medis)
                            ->with('kodeTindakanTerapi') 
                            ->get();

        // 3. Kirim data ke view di folder Perawat
        return view('admin.perawat.detail_rekam_medis.index', compact('detailRekamMedis', 'idrekam_medis', 'idpet'));
    }

    // Fungsi create, store, show, edit, update, dan destroy DIHAPUS karena Perawat hanya View.
}