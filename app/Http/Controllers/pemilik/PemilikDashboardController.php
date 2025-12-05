<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Digunakan untuk mendapatkan ID pengguna yang sedang login
use App\Models\Pemilik; 
use App\Models\DaftarPet;     // Model Pet Anda
use Exception;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        // 1. Dapatkan objek User yang sedang login
        $user = Auth::user();
        
        // 2. Cari objek Pemilik yang terhubung dengan User ini
        //    PENTING: Gunakan Primary Key Model User: $user->iduser
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        // Inisialisasi koleksi kosong
        $pets = collect(); 
        $ownerName = $user->nama ?? 'Pemilik'; // Ambil nama dari User

        if ($pemilik) {
            // 3. Ambil semua Pet milik Pemilik tersebut
            //    PENTING: Gunakan with(['rasHewan.jenisHewan']) untuk eager loading relasi bersarang
            $pets = DaftarPet::with(['rasHewan', 'rasHewan.jenisHewan']) 
        ->where('idpemilik', $pemilik->idpemilik) 
        ->get();
        }
        
        // 4. Kirim data yang diperlukan ke View
        //    Variabel yang dikirim: $pets, $ownerName (nama user), $pemilik (objek pemilik)
        return view('admin.pemilik.Dashboard_pemilik', compact('ownerName', 'pets', 'pemilik'));
    }
}