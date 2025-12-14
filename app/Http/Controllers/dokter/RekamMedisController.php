<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DaftarPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;


class RekamMedisController extends Controller
{
    /** * TAMPILKAN SEMUA REKAM MEDIS PET
     */
    public function index($idpet)
    {
        $pet = DaftarPet::findOrFail($idpet);
        $rekam = RekamMedis::where('idpet', $idpet)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dokter.rekam_medis.index', compact('pet', 'rekam'));
    }

    /**
     * FORM TAMBAH REKAM MEDIS - DINONAKTIFKAN
     */
    /*
    public function create($idpet)
    {
        $pet = DaftarPet::findOrFail($idpet);
        return view('admin.dokter.rekam_medis.create', compact('pet'));
    }
    */

    /**
     * SIMPAN DATA REKAM MEDIS - DINONAKTIFKAN
     */
    /*
    public function store(Request $request, $idpet)
    {
        $request->validate([
            'anamnesa'        => 'required|string',
            'temuan_klinis'   => 'required|string',
            'diagnosa'        => 'required|string',
        ]);

        $roleDokter = RoleUser::where('iduser', Auth::id())
            ->where('idrole', 2)
            ->first();

        if (!$roleDokter) {
            return back()->with('error', 'Akun ini tidak memiliki role dokter.');
        }

        RekamMedis::create([
            'anamnesa'          => $request->anamnesa,
            'temuan_klinis'     => $request->temuan_klinis,
            'diagnosa'          => $request->diagnosa,
            'idpet'             => $idpet,
            'dokter_pemeriksa'  => $roleDokter->idrole_user,
            'created_at'        => now(), 
        ]);


        return redirect()->route('admin.dokter.rekam_medis.index', $idpet)
            ->with('success', 'Rekam medis berhasil ditambahkan!');
    }
    */


    /**
     * FORM EDIT REKAM MEDIS - DINONAKTIFKAN
     */
    /*
    public function edit($id)
    {
        $rekam = RekamMedis::with('pet')->findOrFail($id);
        return view('admin.dokter.rekam_medis.edit', compact('rekam'));
    }
    */


    /**
     * UPDATE DATA REKAM MEDIS - DINONAKTIFKAN
     */
    /*
    public function update(Request $request, $id)
    {
        $rekam = RekamMedis::findOrFail($id);

        $request->validate([
            'anamnesa'        => 'required|string',
            'temuan_klinis'   => 'required|string',
            'diagnosa'        => 'required|string',
        ]);

        $rekam->update([
            'anamnesa'        => $request->anamnesa,
            'temuan_klinis'   => $request->temuan_klinis,
            'diagnosa'        => $request->diagnosa,
            'created_at'      => now(),
        ]);

        return redirect()->route('admin.dokter.rekam_medis.index', $rekam->idpet)
        ->with('success', 'Rekam medis berhasil diperbarui!');
    }
    */

    /**
     * HAPUS - DINONAKTIFKAN
     */
    /*
    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();

        return back()->with('success', 'Rekam medis berhasil dihapus!');
    }
    */
}