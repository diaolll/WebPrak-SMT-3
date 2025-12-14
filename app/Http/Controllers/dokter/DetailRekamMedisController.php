<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\RekamMedis;

class DetailRekamMedisController extends Controller
{
    /**
     * Tampilkan semua detail rekam medis untuk idrekam_medis tertentu.
     */
    public function index($idrekam_medis)
    {
        // 1. Ambil data Rekam Medis utama (untuk mendapatkan idpet)
        $rekam = RekamMedis::findOrFail($idrekam_medis); // <--- DITAMBAHKAN
        $idpet = $rekam->idpet;                         // <--- DITAMBAHKAN

        // 2. Ambil detail rekam medis
        $detailRekamMedis = DetailRekamMedis::where('idrekam_medis', $idrekam_medis)
                            ->with('kodeTindakanTerapi') 
                            ->get();

        // 3. Kirim $idpet ke view
        return view('admin.dokter.detail_rekam_medis.index', compact('detailRekamMedis', 'idrekam_medis', 'idpet')); // <--- Variabel 'idpet' DITAMBAHKAN
    }

    /**
     * Tampilkan form untuk membuat detail rekam medis baru.
     */
    public function create($idrekam_medis)
    {
        // Mengambil semua kode tindakan untuk dropdown
        $kodeTindakan = KodeTindakanTerapi::all(); 
        return view('admin.dokter.detail_rekam_medis.create', compact('idrekam_medis', 'kodeTindakan'));
    }

    /**
     * Simpan data detail rekam medis yang baru.
     */
    public function store(Request $request, $idrekam_medis)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail'                 => 'required|string',
        ]);

        DetailRekamMedis::create([
            'idrekam_medis'          => $idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi, 
            'detail'                 => $request->detail,
        ]);

        return redirect()->route('admin.dokter.detail_rekam_medis.index', $idrekam_medis)->with('success', 'Detail Rekam Medis berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail spesifik.
     */
    public function show($idrekam_medis, $id)
    {
        $detailRekamMedis = DetailRekamMedis::with('kodeTindakanTerapi')->findOrFail($id);
        return view('admin.dokter.detail_rekam_medis.show', compact('detailRekamMedis', 'idrekam_medis'));
    }

    /**
     * Tampilkan form edit detail rekam medis.
     */
    public function edit($idrekam_medis, $id)
    {
        $detailRekamMedis = DetailRekamMedis::findOrFail($id);
        $kodeTindakan = KodeTindakanTerapi::all(); // Diperlukan untuk dropdown
        
        return view('admin.dokter.detail_rekam_medis.edit', compact('detailRekamMedis', 'idrekam_medis', 'kodeTindakan'));
    }

    /**
     * Update data detail rekam medis.
     */
    public function update(Request $request, $idrekam_medis, $id)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi', 
            'detail'                 => 'required|string',
        ]);

        $detailRekamMedis = DetailRekamMedis::findOrFail($id);
        $detailRekamMedis->update([
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail'                 => $request->detail,
        ]);

        return redirect()->route('admin.dokter.detail_rekam_medis.index', $idrekam_medis)->with('success', 'Detail Rekam Medis berhasil diperbarui.');
    }

    /**
     * Hapus detail rekam medis.
     */
    public function destroy($idrekam_medis, $id)
    {
        $detailRekamMedis = DetailRekamMedis::findOrFail($id);
        $detailRekamMedis->delete();
        
        return redirect()->route('admin.dokter.detail_rekam_medis.index', $idrekam_medis)->with('success', 'Detail Rekam Medis berhasil dihapus.');
    }
}