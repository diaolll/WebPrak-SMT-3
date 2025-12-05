<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role; 
use Exception;

class RoleController extends Controller
{
    // READ: Menampilkan daftar data
    public function index()
    {
        $role = Role::all();
        return view('admin.role.index', compact('role'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        return view('admin.role.create');
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateRole($request); 
            $this->createRole($validatedData); 

            return redirect()->route('admin.role.index')
                ->with('success', 'Role berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($idrole)
    {
        $role = Role::findOrFail($idrole);
        return view('admin.role.edit', compact('role'));
    }

    // UPDATE: Memperbarui data
    public function update(Request $request, $idrole)
    {
        try {
            $validatedData = $this->validateRole($request, $idrole); 
            $this->updateRole($idrole, $validatedData);

            return redirect()->route('admin.role.index')
                ->with('success', 'Role berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($idrole)
    {
        try {
            $role = Role::findOrFail($idrole);
            $role->delete();
            
            return redirect()->route('admin.role.index')
                ->with('success', 'Role berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validateRole(Request $request, $id = null)
    {
        $uniqueRule = $id 
            ? 'unique:role,nama_role,' . $id . ',idrole' 
            : 'unique:role,nama_role'; 

        return $request->validate([
            'nama_role' => [
                'required', 
                'string', 
                'max:50', 
                $uniqueRule 
            ],
        ], [
            'nama_role.required' => 'Nama role wajib diisi.', 
            'nama_role.unique' => 'Nama role sudah ada.', 
        ]);
    }
    
    // ----------- HELPER -----------
    protected function createRole(array $data) 
    {
        try {
            return Role::create([ 
                'nama_role' => $this->formatNamaRole($data['nama_role']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal menyimpan Role: ' . $e->getMessage()); 
        }
    }

    protected function updateRole($idrole, array $data) 
    {
        try {
            $role = Role::findOrFail($idrole);
            return $role->update([
                'nama_role' => $this->formatNamaRole($data['nama_role']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui Role: ' . $e->getMessage()); 
        }
    }

    protected function formatNamaRole($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}