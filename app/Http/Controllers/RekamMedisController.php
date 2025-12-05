<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis; // Asumsi Model Rekam Medis
use App\Models\Dokter;
use Carbon\Carbon;
use Exception;

class RekamMedisController extends Controller
{
    // READ: Menampilkan daftar semua Rekam Medis
    public function index()
    {
        // Dokter perlu melihat semua rekam medis pasien yang pernah mereka tangani
        // Asumsi: Semua dokter bisa melihat semua rekam medis untuk tujuan pelaporan
        $rekamMedis = RekamMedis::with(['pet.pemilik.user'])->orderBy('created_at', 'desc')->get();
        return view('rekam_medis.index', compact('rekamMedis'));
    }

    // READ: Menampilkan detail satu Rekam Medis
    public function show($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter'])->findOrFail($idrekam_medis);
        return view('rekam_medis.show', compact('rekamMedis'));
    }

    // CREATE: Menampilkan form tambah detail Rekam Medis (misalnya hasil diagnosis, tindakan)
    public function create($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'dokter'])->findOrFail($idrekam_medis);
        // Form untuk mengisi detail medis
        return view('rekam_medis.create_detail', compact('rekamMedis'));
    }
    
    // STORE: Menyimpan detail baru (melalui UPDATE record yang sudah ada)
    public function store(Request $request, $idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        
        try {
            $validated = $request->validate([
                'diagnosis' => 'required|string|max:500',
                'tindakan' => 'required|string|max:500',
                'resep_obat' => 'nullable|string|max:500',
                // Asumsi field ini ada di tabel RekamMedis
            ]);
            
            $rekamMedis->update($validated);

            return redirect()->route('rekam_medis.show', $idrekam_medis)
                ->with('success', 'Detail Rekam Medis berhasil disimpan.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan detail: ' . $e->getMessage());
        }
    }
    
    // DELETE: Menghapus Rekam Medis (Jika diizinkan)
    public function destroy($idrekam_medis)
    {
        try {
            RekamMedis::destroy($idrekam_medis);
            return redirect()->route('rekam_medis.index')->with('success', 'Rekam Medis berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus Rekam Medis: ' . $e->getMessage());
        }
    }
}