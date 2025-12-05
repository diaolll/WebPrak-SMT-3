<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RekamMedis;
// use App\Models\Perawat; // Jika diperlukan data detail perawat

class PerawatDashboardController extends Controller
{
    public function index()
    {
        // Ambil data antrian hari ini (semua rekam medis yang dibuat hari ini)
        $rekamMedisAntrian = RekamMedis::with(['pet.pemilik.user', 'dokter'])
            // Filter hanya data hari ini (Antrian)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Kirim data antrian ke dashboard
        return view('admin.perawat.dashboard_perawat', compact('rekamMedisAntrian'));
    }
}