<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Role; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get(); 
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateUser($request); 
            $this->createUserAndAttachRole($validatedData); 

            return redirect()->route('admin.user.index')
                ->with('success', 'User dan Role berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    public function edit($iduser)
    {
        $user = User::with('roles')->findOrFail($iduser); 
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $iduser)
    {
        try {
            $validatedData = $this->validateUser($request, $iduser); 
            $this->updateUserAndSyncRole($iduser, $validatedData);

            return redirect()->route('admin.user.index')
                ->with('success', 'User dan Role berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    public function destroy($iduser)
    {
        try {
            $user = User::with('pemilik')->findOrFail($iduser);

            // LOGIKA PENTING 1: Hapus data pivot (role_user)
            // Ini akan menghapus semua record di tabel role_user yang terkait dengan iduser ini.
            $user->roles()->detach(); 

            // LOGIKA PENTING 2: Hapus record anak (Pemilik) terlebih dahulu
            if ($user->pemilik) {
                $user->pemilik->delete();
            }
            
            // LOGIKA PENTING 3: Hapus User utama
            $user->delete(); 
            
            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus user. Silakan cek error: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validateUser(Request $request, $id = null)
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('user', 'email')->ignore($id, 'iduser') 
            ],

            'password' => [
                $id ? 'nullable' : 'required', 
                'string', 
                'min:8', 
                'confirmed' 
            ],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:role,idrole'], 
        ];

        return $request->validate($rules, [
            'nama.required' => 'Nama user wajib diisi.', 
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi untuk User baru.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'roles.required' => 'Role wajib dipilih minimal satu.',
        ]);
    }
    
    // ----------- HELPER CREATE -----------
    protected function createUserAndAttachRole(array $data) 
    {
        try {
            $user = User::create([
                'nama' => trim(ucwords(strtolower($data['nama']))), 
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            
            $rolesToAttach = array_fill_keys($data['roles'], ['status' => 1]);
            $user->roles()->attach($rolesToAttach);

            return $user;

        } catch (Exception $e) { 
            throw new Exception('Gagal membuat User dan menautkan Role: ' . $e->getMessage()); 
        }
    }

    // ----------- HELPER UPDATE -----------
    protected function updateUserAndSyncRole($iduser, array $data) 
    {
        try {
            $user = User::findOrFail($iduser);
            
            $updateUserData = [
                'nama' => trim(ucwords(strtolower($data['nama']))), 
                'email' => $data['email'],
            ];
            
            if (!empty($data['password'])) {
                $updateUserData['password'] = $data['password']; 
            }
            
            $user->update($updateUserData);
            
            $rolesToSync = array_fill_keys($data['roles'], ['status' => 1]);
            $user->roles()->sync($rolesToSync);

            return $user;

        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui User dan Role: ' . $e->getMessage()); 
        }
    }
}