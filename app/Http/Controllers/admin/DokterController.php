<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter; // Model yang dikelola
use App\Models\User; // Digunakan untuk relasi
use Illuminate\Validation\Rule;
use Exception;

class DokterController extends Controller 
{
    // READ: Menampilkan daftar data
    public function index()
    {
        // Memuat data Dokter dan relasi User terkait untuk ditampilkan
        $dokter = Dokter::with('user')->get();
        return view('admin.dokter.index', compact('dokter'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        // Mengambil daftar User yang belum terdaftar sebagai Dokter
        // PENTING: User hanya bisa menjadi Dokter/Perawat/Pemilik satu kali
        $existingUserIds = Dokter::pluck('id_user')->toArray();
        $users = User::whereNotIn('iduser', $existingUserIds)->get(); 

        return view('admin.dokter.create', compact('users'));
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateDokter($request); 
            $this->createDokter($validatedData); 

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data Dokter berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($id_dokter)
    {
        $dokter = Dokter::findOrFail($id_dokter);
        // User yang sedang diedit tidak boleh muncul di daftar user lain
        $users = User::all(); 
        return view('admin.dokter.edit', compact('dokter', 'users'));
    }

    // UPDATE: Memperbarui data
    public function update(Request $request, $id_dokter)
    {
        try {
            $validatedData = $this->validateDokter($request, $id_dokter); 
            $this->updateDokter($id_dokter, $validatedData);

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data Dokter berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($id_dokter)
    {
        try {
            Dokter::destroy($id_dokter);
            
            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data Dokter berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validateDokter(Request $request, $id = null)
    {
        // Validasi id_user harus unik di tabel dokter
        $uniqueRuleUser = Rule::unique('dokter', 'id_user')->ignore($id, 'id_dokter');
        
        // Validasi no_hp unik
        $uniqueRuleHp = Rule::unique('dokter', 'no_hp')->ignore($id, 'id_dokter');

        $rules = [
            'id_user' => ['required', 'integer', $uniqueRuleUser, 'exists:user,iduser'], // Harus ada User ID
            'alamat' => ['required', 'string', 'max:100'],
            'no_hp' => ['required', 'string', 'max:45', $uniqueRuleHp],
            'bidang_dokter' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ];

        return $request->validate($rules, [
            'id_user.required' => 'User Dokter wajib dipilih.',
            'id_user.unique' => 'User ini sudah terdaftar sebagai Dokter/Perawat lain.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'bidang_dokter.required' => 'Bidang Dokter wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);
    }
    
    // ----------- HELPER -----------
    protected function createDokter(array $data) 
    {
        return Dokter::create($data);
    }

    protected function updateDokter($id_dokter, array $data) 
    {
        $dokter = Dokter::findOrFail($id_dokter);
        return $dokter->update($data);
    }
}