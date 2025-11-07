<?php

namespace App\Http\Controllers\perawat;

use App\Models\RekamMedis; // <-- Perbaiki di baris paling atas controller Anda
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\perawat\RekamMedis; // Menggunakan nama class Model yang benar (RekamMedis)
use Carbon\Carbon; // Digunakan untuk memfilter tanggal hari ini

class PerawatDashboardController extends Controller
{
    public function index()
    {
        // FUNGSI INI MENGAMBIL DATA ANTRIAN HARI INI
        $rekamMedisAntrian = RekamMedis::with(['pet.pemilik.user', 'dokter'])
            // Filter hanya data hari ini (Antrian)
            ->whereDate('created_at', Carbon::today()) 
            ->orderBy('created_at', 'asc') 
            ->get();
            
        // Kirim data antrian ke dashboard
        return view('admin.Perawat.Dashboard_perawat', compact('rekamMedisAntrian'));
    }

   // Fungsi untuk menampilkan Daftar Rekam Medis LENGKAP (Arsip)
   public function rekamMedis() {
        $RekamMedisList = RekamMedis::with(['pet.pemilik.user', 'dokter'])
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        return view('admin.perawat.index', compact('RekamMedisList')); 
   }
}