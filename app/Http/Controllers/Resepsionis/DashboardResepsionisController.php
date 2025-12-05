<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temu_dokter;
use Carbon\Carbon;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // --- Antrian Hari Ini ---
        $rekamMedisHariIni = Temu_dokter::with([
                'pet.rasHewan.jenisHewan',
                'pet.pemilik.user',
                'roleUser.user'
            ])
            ->whereDate('waktu_daftar', $today)
            ->orderBy('no_urut', 'asc')
            ->get();

        // ===== STATUS MAPPING =====
        // P = Menunggu
        // S = Selesai
        // B = Dibatalkan
        // ===========================

        $totalReservasi = Temu_dokter::whereDate('waktu_daftar', $today)->count();

        $totalSelesai = Temu_dokter::whereDate('waktu_daftar', $today)
                            ->where('status', 'S')
                            ->count();

        $totalMenunggu = Temu_dokter::whereDate('waktu_daftar', $today)
                            ->where('status', 'P')
                            ->count();

        return view('admin.resepsionis.dashboard_resepsionis', compact(
            'rekamMedisHariIni',
            'totalReservasi',
            'totalSelesai',
            'totalMenunggu'
        ));
    }
}
