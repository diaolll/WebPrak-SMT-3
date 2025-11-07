<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Digunakan untuk mendapatkan ID pengguna yang sedang login
use App\Models\Pemilik; // Sesuaikan jika namespace berbeda
use App\Models\DaftarPet;     // Sesuaikan jika namespace berbeda

class PemilikDashboardController extends Controller
{
    public function index()
    {
        // 1. Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // 2. Cari objek Pemilik yang terhubung dengan User ID ini
        //    Asumsi: ada relasi 1-ke-1 dari User ke Pemilik (atau Pemilik punya kolom user_id)
        $pemilik = Pemilik::where('iduser', $userId)->first();

        \Log::info('User ID: ' . $userId);
        if ($pemilik) {
            \Log::info('Pemilik ID: ' . $pemilik->id);
        } else {
            \Log::warning('No Pemilik record found for user ID: ' . $userId);
        }

        // Variabel untuk menampung data Pet
        $listPetSaya = collect(); // Buat collection kosong sebagai default

        if ($pemilik) {
            // 3. Ambil semua Pet milik Pemilik tersebut
            //    Load relasi jenisHewan dan rasHewan untuk ditampilkan di view
            $listPetSaya = DaftarPet::where('idpemilik', $pemilik->id)
                                ->with(['jenisHewan', 'rasHewan'])
                                ->get();
        }
        
        // 4. Kirim data ke View
        //    Perhatikan: view tetap 'admin.pemilik.Dashboard_pemilik' sesuai yang Anda tentukan
        return view('admin.pemilik.Dashboard_pemilik', compact('listPetSaya', 'pemilik'));
    }
}