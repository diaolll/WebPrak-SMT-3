<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat; // Model yang dikelola
use App\Models\User; // Digunakan untuk relasi
use App\Models\Role; // Digunakan untuk menautkan Role
use Illuminate\Support\Facades\Hash; // Untuk password
use Illuminate\Validation\Rule;
use Exception;

class PerawatController extends Controller 
{
    // READ: Menampilkan daftar data
    public function index()
    {
        // Memuat data Perawat dan relasi User terkait untuk ditampilkan
        $perawat = Perawat::with('user')->get();
        return view('admin.perawat.index', compact('perawat'));
    }

    // CREATE: Menampilkan form tambah data (Membuat User dan Perawat)
    public function create()
    {
        // PENTING: Mengirim variabel default untuk View yang menggunakan logic isEdit
        $isEdit = false; 
        
        return view('admin.perawat.create', compact('isEdit'));
    }

    // STORE: Menyimpan data baru (Membuat User DAN Perawat)
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validatePerawat($request); 
            $this->createPerawatAndUser($validatedData); // Helper baru

            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data Perawat dan User berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($id_perawat)
    {
        $perawat = Perawat::with('user')->findOrFail($id_perawat);
        return view('admin.perawat.edit', compact('perawat'));
    }

    // UPDATE: Memperbarui data (Memperbarui User dan Perawat)
    public function update(Request $request, $id_perawat)
    {
        try {
            $validatedData = $this->validatePerawat($request, $id_perawat); 
            $this->updatePerawatAndUser($id_perawat, $validatedData); // Helper baru

            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data Perawat dan User berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($id_perawat)
    {
        try {
            $perawat = Perawat::with('user')->findOrFail($id_perawat);
            $user_id = $perawat->id_user;
            
            // 1. Hapus record Perawat
            $perawat->delete();
            
            // 2. Hapus User terkait (dan otomatis detach role)
            if ($user_id) {
                User::findOrFail($user_id)->roles()->detach();
                User::destroy($user_id);
            }
            
            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data Perawat dan User terkait berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validatePerawat(Request $request, $id = null)
    {
        $perawat = $id ? Perawat::findOrFail($id) : null;
        $userId = $perawat ? $perawat->id_user : null;
        
        // Validasi no_hp unik di tabel perawat
        $uniqueRuleHp = Rule::unique('perawat', 'no_hp')->ignore($id, 'id_perawat');

        // Validasi email unik di tabel user
        $uniqueRuleEmail = Rule::unique('user', 'email')->ignore($userId, 'iduser');
        
        $rules = [
            'nama' => ['required', 'string', 'max:255'], // Nama User
            'email' => ['required', 'string', 'email', 'max:255', $uniqueRuleEmail], // Email User
            'password' => [$id ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'], // Password User
            
            'alamat' => ['required', 'string', 'max:100'],
            'no_hp' => ['required', 'string', 'max:45', $uniqueRuleHp],
            'pendidikan' => ['required', 'string', 'max:100'], // Field Spesifik
            'jenis_kelamin' => ['required', 'in:L,P'],
        ];

        return $request->validate($rules, [
            'nama.required' => 'Nama User wajib diisi.',
            'email.required' => 'Email User wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);
    }
    
    // ----------- HELPER CREATE USER & PERAWAT -----------
    protected function createPerawatAndUser(array $data) 
    {
        $user = null;
        try {
            // 1. BUAT USER BARU
            $user = User::create([
                'nama' => $data['nama'], 
                'email' => $data['email'],
                'password' => Hash::make($data['password']), // Hash password
            ]);
            
            // 2. TAUTKAN ROLE PERAWAT (ID 3)
            $user->roles()->attach(3, ['status' => 1]); 

            // 3. BUAT DATA PERAWAT
            Perawat::create([
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
                'pendidikan' => $data['pendidikan'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'id_user' => $user->iduser, // FK ke User
            ]);

        } catch (Exception $e) { 
            // Rollback manual: Hapus User yang baru dibuat jika insert Perawat gagal
            if (isset($user)) {
                $user->roles()->detach();
                User::destroy($user->iduser);
            }
            throw new Exception('Gagal membuat User dan Perawat: ' . $e->getMessage()); 
        }
    }

    // ----------- HELPER UPDATE USER & PERAWAT -----------
    protected function updatePerawatAndUser($id_perawat, array $data) 
    {
        $perawat = Perawat::findOrFail($id_perawat);
        $user = $perawat->user; // Dapatkan User terkait

        try {
            // 1. UPDATE USER
            if ($user) {
                $userData = [
                    'nama' => $data['nama'], 
                    'email' => $data['email'],
                ];
                if (!empty($data['password'])) {
                    $userData['password'] = Hash::make($data['password']);
                }
                $user->update($userData);
            }

            // 2. UPDATE DATA PERAWAT
            return $perawat->update([
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
                'pendidikan' => $data['pendidikan'],
                'jenis_kelamin' => $data['jenis_kelamin'],
            ]);

        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui User dan Perawat: ' . $e->getMessage()); 
        }
    }
}