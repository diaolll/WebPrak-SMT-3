<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RoleUser;
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

        public function profile()
    {
        // Ambil data user login
        $user = User::with(['roles', 'perawat'])
            ->where('iduser', Auth::id())
            ->first();

        // Roles
        $roles = $user->roles ?? collect();
        $roleNames = $roles->pluck('nama_role')->implode(', ');

        // Data perawat (bisa null)
        $perawat = $user->perawat;

        return view('admin.Perawat.profile', compact(
            'user',
            'roles',
            'roleNames',
            'perawat'
        ));
    }
}