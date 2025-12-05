<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;

class ResepsionisController extends Controller
{
    // =============================
    // TAMPIL DATA PET + PEMILIK
    // =============================
    public function index()
    {
        $pets = DaftarPet::with(['pemilik.user', 'jenisHewan', 'rasHewan'])->get();
        return view('admin.Resepsionis.pet.index', compact('pets'));
    }

    // =============================
    // FORM TAMBAH PET
    // =============================
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $jenis   = JenisHewan::all();
        $ras     = RasHewan::all();

        return view('admin.Resepsionis.pet.create', compact('pemilik', 'jenis', 'ras'));
    }

    // =============================
    // SIMPAN PET
    // =============================
    public function store(Request $request)
{
    $request->validate([
        'nama'            => 'required',
        'tanggal_lahir'   => 'nullable|date',
        'jenis_kelamin'   => 'required',
        'warna_tanda'     => 'nullable',
        'idpemilik'       => 'required|exists:pemilik,idpemilik',
        'idras_hewan'     => 'required|exists:ras_hewan,idras_hewan',
        // HAPUS validasi untuk idjenis_hewan
    ]);

    DaftarPet::create([
        'nama' => $request->nama,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'warna_tanda' => $request->warna_tanda,
        'idpemilik' => $request->idpemilik,
        'idras_hewan' => $request->idras_hewan,
    ]);

    return redirect()->route('admin.Resepsionis.pet.index')
        ->with('success', 'Data pet berhasil ditambahkan');
}

    // =============================
    // FORM EDIT PET
    // =============================
    public function edit($id)
    {
        $pet     = DaftarPet::findOrFail($id);
        $pemilik = Pemilik::with('user')->get();
        $jenis   = JenisHewan::all();
        $ras     = RasHewan::all();

        return view('admin.Resepsionis.pet.edit', compact('pet', 'pemilik', 'jenis', 'ras'));
    }

    // =============================
    // UPDATE PET
    // =============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'            => 'required',
            'jenis_kelamin'   => 'required',
            'idpemilik'       => 'required',
            'idjenis_hewan'   => 'required',
            'idras_hewan'     => 'required',
        ]);

        $pet = DaftarPet::findOrFail($id);
        $pet->update($request->all());

        return redirect()->route('admin.Resepsionis.pet.index')
            ->with('success', 'Data pet berhasil diperbarui');
    }

    // =============================
    // HAPUS PET
    // =============================
    public function destroy($id)
    {
        DaftarPet::destroy($id);

        return redirect()->route('admin.Resepsionis.pet.index')
            ->with('success', 'Data pet berhasil dihapus');
    }
}
