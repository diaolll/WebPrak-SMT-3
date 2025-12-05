<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPet; // Model Anda
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Exception;

class DaftarPetController extends Controller
{
    // READ: Menampilkan daftar data
    public function index()
    {
        $pets = DaftarPet::with(['pemilik.user', 'rasHewan'])->get();
        return view('admin.daftar_pet.index', compact('pets')); 
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::all(); 
        return view('admin.daftar_pet.create', compact('pemilik', 'rasHewan'));
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateDaftarPet($request); 
            $this->createDaftarPet($validatedData); 

            return redirect()->route('admin.daftar_pet.index')
                ->with('success', 'Data Hewan Peliharaan berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($idpet)
    {
        $pet = DaftarPet::findOrFail($idpet); 
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::all();
        return view('admin.daftar_pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    // UPDATE: Memperbarui data
    public function update(Request $request, $idpet)
    {
        try {
            $validatedData = $this->validateDaftarPet($request, $idpet); 
            $this->updateDaftarPet($idpet, $validatedData);

            return redirect()->route('admin.daftar_pet.index')
                ->with('success', 'Data Hewan Peliharaan berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($idpet)
    {
        try {
            $pet = DaftarPet::findOrFail($idpet); 
            $pet->delete();
            
            return redirect()->route('admin.daftar_pet.index')
                ->with('success', 'Data Hewan Peliharaan berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION (JENIS KELAMIN DISINKRONKAN KE J/B) -----------
    protected function validateDaftarPet(Request $request, $id = null)
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['required', 'in:J,B'], // PERBAIKAN: Nilai validasi diubah
            'warna_tanda' => ['nullable', 'string', 'max:50'], 
            
            // Foreign Keys
            'idpemilik' => ['required', 'integer', 'exists:pemilik,idpemilik'],
            'idras_hewan' => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ];

        return $request->validate($rules, [
            'nama.required' => 'Nama hewan peliharaan wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid (harus Jantan atau Betina).',
            'idpemilik.required' => 'Pemilik wajib dipilih.',
            'idras_hewan.required' => 'Ras hewan wajib dipilih.',
        ]);
    }
    
    // ----------- HELPER -----------
    
    protected function createDaftarPet(array $data) 
    {
        try {
            return DaftarPet::create([ 
                'nama' => $this->formatName($data['nama']),
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'warna_tanda' => $data['warna_tanda'],
                'idpemilik' => $data['idpemilik'],
                'idras_hewan' => $data['idras_hewan'],
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal menyimpan data Hewan Peliharaan: ' . $e->getMessage()); 
        }
    }

    protected function updateDaftarPet($idpet, array $data) 
    {
        try {
            $pet = DaftarPet::findOrFail($idpet);
            return $pet->update([
                'nama' => $this->formatName($data['nama']),
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'warna_tanda' => $data['warna_tanda'],
                'idpemilik' => $data['idpemilik'],
                'idras_hewan' => $data['idras_hewan'],
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data Hewan Peliharaan: ' . $e->getMessage()); 
        }
    }

    protected function formatName($name) 
    {
        return trim(ucwords(strtolower($name))); 
    }
}