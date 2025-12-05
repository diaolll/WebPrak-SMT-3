<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori; // Pastikan import model Kategori
use Exception;

class KategoriController extends Controller
{
    // READ: Menampilkan daftar data
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        return view('admin.kategori.create');
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateKategori($request); 
            $this->createKategori($validatedData); 

            return redirect()->route('admin.kategori.index')
                ->with('success', 'Kategori berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($idkategori)
    {
        $kategori = Kategori::findOrFail($idkategori);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // UPDATE: Memperbarui data
    public function update(Request $request, $idkategori)
    {
        try {
            $validatedData = $this->validateKategori($request, $idkategori); 
            $this->updateKategori($idkategori, $validatedData);

            return redirect()->route('admin.kategori.index')
                ->with('success', 'Kategori berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($idkategori)
    {
        try {
            $kategori = Kategori::findOrFail($idkategori);
            $kategori->delete();
            
            return redirect()->route('admin.kategori.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validateKategori(Request $request, $id = null)
    {
        // Aturan unique disesuaikan untuk update jika ID ada
        // Asumsi primary key adalah 'idkategori' dan kolom unik adalah 'nama_kategori'
        $uniqueRule = $id 
            ? 'unique:kategori,nama_kategori,' . $id . ',idkategori' 
            : 'unique:kategori,nama_kategori'; 

        return $request->validate([
            'nama_kategori' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule 
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.', 
            'nama_kategori.string' => 'Nama kategori harus berupa teks.', 
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.', 
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.', 
            'nama_kategori.unique' => 'Nama kategori sudah ada.', 
        ]);
    }
    
    // ----------- HELPER -----------
    
    // Helper untuk membuat data baru (CREATE)
    protected function createKategori(array $data) 
    {
        try {
            // Asumsi Model Kategori menggunakan $timestamps = false; dan $fillable = ['nama_kategori']
            return Kategori::create([ 
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal menyimpan data kategori: ' . $e->getMessage()); 
        }
    }

    // Helper untuk memperbarui data (UPDATE)
    protected function updateKategori($idkategori, array $data) 
    {
        try {
            $kategori = Kategori::findOrFail($idkategori);
            return $kategori->update([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data kategori: ' . $e->getMessage()); 
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaKategori($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}