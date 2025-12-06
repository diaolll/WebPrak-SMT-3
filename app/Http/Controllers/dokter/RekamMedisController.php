<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DaftarPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\role; // huruf kecil sesuai file kamu
use App\Models\Pemilik;


class RekamMedisController extends Controller
{
    /** 
     * TAMPILKAN SEMUA REKAM MEDIS PET
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
     * FORM TAMBAH REKAM MEDIS
     */
    public function create($idpet)
    {
        $pet = DaftarPet::findOrFail($idpet);
        return view('admin.dokter.rekam_medis.create', compact('pet'));
    }

    /**
     * SIMPAN DATA REKAM MEDIS
     */
    public function store(Request $request, $idpet)
{
    $request->validate([
        'anamnesa'        => 'required|string',
        'temuan_klinis'   => 'required|string',
        'diagnosa'        => 'required|string',
    ]);

    // Ambil role_user langsung
    $roleDokter = RoleUser::where('iduser', Auth::id())
        ->where('idrole', 2) // idrole = 2 = dokter
        ->first();

    if (!$roleDokter) {
        return back()->with('error', 'Akun ini tidak memiliki role dokter.');
    }

    $idrole_user = $roleDokter->idrole_user;

            RekamMedis::create([
            'anamnesa'          => $request->anamnesa,
            'temuan_klinis'     => $request->temuan_klinis,
            'diagnosa'          => $request->diagnosa,
            'idpet'             => $idpet,
            'dokter_pemeriksa'  => $roleDokter->idrole_user,
            'created_at'        => now(), // <-- biar gak null
        ]);


    return redirect()->route('admin.dokter.rekam_medis.index', $idpet)
        ->with('success', 'Rekam medis berhasil ditambahkan!');
}


    /**
     * FORM EDIT REKAM MEDIS
     */
    public function edit($id)
{
    // Ambil data rekam medis
    $rekam = RekamMedis::with('pet')->findOrFail($id);

    // Ambil daftar dokter dari table role_user dengan idrole = 2 (dokter)
    $dokterList = RoleUser::where('idrole', 2)->with('user')->get();

    // Kirim data ke view
    return view('admin.Perawat.rekam_medis.edit', compact('rekam', 'dokterList'));
}


    /**
     * UPDATE DATA REKAM MEDIS
     */
    public function update(Request $request, $id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $dokterList = RoleUser::where('role_id', 2)->get(); // contoh jika role 2 = dokter


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

        return redirect()->route('admin.dokter.rekam_medis.index', $rekam->idpet) ////// ini
        ->with('success', 'Rekam medis berhasil diperbarui!');
    }

    /**
     * HAPUS
     */
    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();

        return back()->with('success', 'Rekam medis berhasil dihapus!');
    }
}
