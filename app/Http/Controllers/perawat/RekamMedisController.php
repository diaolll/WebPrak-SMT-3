<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DaftarPet;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;

class RekamMedisController extends Controller
{
    /**
     * LIST REKAM MEDIS
     */
    public function index($idpet)
    {
        $pet = DaftarPet::findOrFail($idpet);

        $rekam = RekamMedis::where('idpet', $idpet)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.Perawat.rekam_medis.index', compact('pet', 'rekam'));
    }

    /**
     * FORM CREATE
     */
    public function create($idpet)
    {
        $pet = DaftarPet::findOrFail($idpet);

        // ambil dokter pemeriksa (role = 3 misalnya)
        $dokters = RoleUser::where('idrole', 2)->with('user')->get();

        return view('admin.Perawat.rekam_medis.create', compact('pet', 'dokters'));
    }

    /**
     * STORE
     */
    public function store(Request $request, $idpet)
    {
        $request->validate([
            'anamnesa'        => 'required|string',
            'temuan_klinis'   => 'required|string',
            'diagnosa'        => 'required|string',
            'dokter_pemeriksa'=> 'required|integer',
        ]);

        RekamMedis::create([
            'anamnesa'          => $request->anamnesa,
            'temuan_klinis'     => $request->temuan_klinis,
            'diagnosa'          => $request->diagnosa,
            'idpet'             => $idpet,
            'dokter_pemeriksa'  => $request->dokter_pemeriksa,
            'created_at'        => now(),
        ]);

        return redirect()->route('admin.Perawat.rekam_medis.index', $idpet)
            ->with('success', 'Rekam medis berhasil ditambahkan!');
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $dokterList = RoleUser::where('idrole', 2)->with('user')->get();

        return view('admin.Perawat.rekam_medis.edit', compact('rekam', 'dokterList'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $rekam = RekamMedis::findOrFail($id);

        $request->validate([
            'anamnesa'        => 'required|string',
            'temuan_klinis'   => 'required|string',
            'diagnosa'        => 'required|string',
            'dokter_pemeriksa'=> 'required|integer',
        ]);

        $rekam->update([
            'anamnesa'        => $request->anamnesa,
            'temuan_klinis'   => $request->temuan_klinis,
            'diagnosa'        => $request->diagnosa,
            'dokter_pemeriksa'=> $request->dokter_pemeriksa,
            'created_at'      => now(),
        ]);

        return redirect()->route('admin.Perawat.rekam_medis.index', $rekam->idpet)
            ->with('success', 'Rekam medis berhasil diperbarui!');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();

        return back()->with('success', 'Rekam medis berhasil dihapus!');
    }
}
