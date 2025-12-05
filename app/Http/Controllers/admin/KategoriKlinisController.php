<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis; // Asumsi nama model
use Exception;

class KategoriKlinisController extends Controller
{
    // READ: Menampilkan daftar data
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori_klinis.index', compact('kategoriKlinis'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        return view('admin.kategori_klinis.create');
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateKategoriKlinis($request); 
            $this->createKategoriKlinis($validatedData); 

            return redirect()->route('admin.kategori_klinis.index')
                ->with('success', 'Kategori Klinis berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($idkategori_klinis)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($idkategori_klinis);
        return view('admin.kategori_klinis.edit', compact('kategoriKlinis'));
    }

    // UPDATE: Memperbarui data
    public function update(Request $request, $idkategori_klinis)
    {
        try {
            $validatedData = $this->validateKategoriKlinis($request, $idkategori_klinis); 
            $this->updateKategoriKlinis($idkategori_klinis, $validatedData);

            return redirect()->route('admin.kategori_klinis.index')
                ->with('success', 'Kategori Klinis berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($idkategori_klinis)
    {
        try {
            $kategoriKlinis = KategoriKlinis::findOrFail($idkategori_klinis);
            $kategoriKlinis->delete();
            
            return redirect()->route('admin.kategori_klinis.index')
                ->with('success', 'Kategori Klinis berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        // Asumsi primary key adalah 'idkategori_klinis' dan kolom unik adalah 'nama_kategori_klinis'
        $uniqueRule = $id 
            ? 'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis' 
            : 'unique:kategori_klinis,nama_kategori_klinis'; 

        return $request->validate([
            'nama_kategori_klinis' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule 
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.', 
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks.', 
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter.', 
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter.', 
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.', 
        ]);
    }
    
    // ----------- HELPER -----------
    
    // Helper untuk membuat data baru (CREATE)
    protected function createKategoriKlinis(array $data) 
    {
        try {
            // Asumsi Model KategoriKlinis menggunakan $timestamps = false; dan $fillable = ['nama_kategori_klinis']
            return KategoriKlinis::create([ 
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal menyimpan data kategori klinis: ' . $e->getMessage()); 
        }
    }

    // Helper untuk memperbarui data (UPDATE)
    protected function updateKategoriKlinis($idkategori_klinis, array $data) 
    {
        try {
            $kategoriKlinis = KategoriKlinis::findOrFail($idkategori_klinis);
            return $kategoriKlinis->update([
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data kategori klinis: ' . $e->getMessage()); 
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaKategoriKlinis($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}