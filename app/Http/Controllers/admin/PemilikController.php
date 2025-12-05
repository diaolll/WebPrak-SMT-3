<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik; 
use App\Models\User; // Digunakan untuk membuat dan mengupdate User
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\Rule;
use Exception;

class PemilikController extends Controller
{
    // READ: Menampilkan daftar data
    public function index()
    {
        $pemilik = Pemilik::with('user')->get(); 
        return view('admin.pemilik.index', compact('pemilik'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        return view('admin.pemilik.create');
    }

    // STORE: Menyimpan data baru (Membuat User dan Pemilik)
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validatePemilik($request); 
            
            $this->createPemilikAndUser($validatedData); 

            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Data Pemilik dan Akun User berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($idpemilik)
    {
        $pemilik = Pemilik::with('user')->findOrFail($idpemilik); 
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    // UPDATE: Memperbarui data (Memperbarui User dan Pemilik)
    public function update(Request $request, $idpemilik)
    {
        try {
            $validatedData = $this->validatePemilik($request, $idpemilik); 
            
            $this->updatePemilikAndUser($idpemilik, $validatedData);

            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Data Pemilik dan Akun User berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($idpemilik)
    {
        try {
            $pemilik = Pemilik::findOrFail($idpemilik);
            $user_id = $pemilik->iduser;
            
            // Hapus record Pemilik
            $pemilik->delete();
            
            // Hapus User yang terkait
            if ($user_id) {
                // Hapus User dan otomatis detach Role
                User::findOrFail($user_id)->roles()->detach(); 
                User::destroy($user_id); 
            }
            
            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Data Pemilik dan User terkait berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validatePemilik(Request $request, $id = null)
    {
        $pemilik = $id ? Pemilik::find($id) : null;
        $userId = $pemilik ? $pemilik->iduser : null;
        
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            
            'no_wa' => [
                'required', 
                'string',
                'max:15',
                Rule::unique('pemilik', 'no_wa')->ignore($id, 'idpemilik')
            ],
            
            'alamat' => ['required', 'string'],
            
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255',
                // PENTING: Gunakan tabel 'user' dan PK 'iduser'
                Rule::unique('user', 'email')->ignore($userId, 'iduser') 
            ],

            'password' => [
                $id ? 'nullable' : 'required', 
                'string', 
                'min:8', 
                'confirmed' 
            ],
        ];

        return $request->validate($rules, [
            'nama.required' => 'Nama pemilik wajib diisi.', 
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi untuk User baru.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.', 
            'no_wa.unique' => 'Nomor WhatsApp ini sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);
    }
    
    // ----------- HELPER MANUAL AUTO-INCREMENT -----------
    
    /**
     * Menghitung ID Pemilik berikutnya secara manual dari database.
     */
    protected function getNextIdPemilik()
    {
        $maxId = Pemilik::max('idpemilik');
        return $maxId ? $maxId + 1 : 1;
    }
    
    // ----------- HELPER CREATE USER & PEMILIK -----------
    
    protected function createPemilikAndUser(array $data) 
    {
        $user = null;
        try {
            // 1. BUAT USER BARU
            $user = User::create([
                'nama' => trim(ucwords(strtolower($data['nama']))), 
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            
            // 2. TAUTKAN ROLE PEMILIK (ID 5) SEGERA SETELAH USER DIBUAT
            // PENTING: ID 5 adalah Pemilik
            $user->roles()->attach(5, ['status' => 1]); 

            // 3. TENTUKAN ID PEMILIK BARU SECARA MANUAL
            $nextIdPemilik = $this->getNextIdPemilik();

            // 4. BUAT PEMILIK BARU, TAUTKAN KE USER
            return Pemilik::create([ 
                'idpemilik' => $nextIdPemilik, 
                'no_wa' => trim($data['no_wa']), 
                'alamat' => trim($data['alamat']),
                'iduser' => $user->iduser, 
            ]);

        } catch (Exception $e) { 
            // Rollback manual: Hapus User yang baru dibuat jika insert Pemilik gagal
            if (isset($user) && $user->iduser) {
                $user->roles()->detach(); // Detach Role juga
                User::destroy($user->iduser); 
            }
            throw new Exception('Gagal menyimpan data Pemilik: ' . $e->getMessage()); 
        }
    }

    // ----------- HELPER UPDATE USER & PEMILIK -----------
    
    protected function updatePemilikAndUser($idpemilik, array $data) 
    {
        try {
            $pemilik = Pemilik::with('user')->findOrFail($idpemilik);
            
            // 1. UPDATE USER TERKAIT
            if ($pemilik->user) {
                $updateUserData = [
                    'nama' => trim(ucwords(strtolower($data['nama']))), 
                    'email' => $data['email'],
                ];
                
                // Hanya update password jika diisi
                if (!empty($data['password'])) {
                    $updateUserData['password'] = Hash::make($data['password']);
                }
                
                $pemilik->user->update($updateUserData);
            }

            // 2. UPDATE RECORD PEMILIK
            return $pemilik->update([
                'no_wa' => trim($data['no_wa']), 
                'alamat' => trim($data['alamat']),
            ]);

        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data Pemilik: ' . $e->getMessage()); 
        }
    }

    protected function formatNama($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}