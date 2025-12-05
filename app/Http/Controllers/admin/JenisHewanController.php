<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan; // Pastikan menggunakan JenisHewan
use Exception; // Import Exception untuk penanganan error
use Illuminate\Support\Facades\DB;  

class JenisHewanController extends Controller
{
    public function index()
    {
        // Query Builder untuk mengambil data jenis hewan
        $jenisHewan = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->get();

        return view('admin.jenis_hewan.index', compact('jenisHewan'));
    }

    // CREATE (tetap sama)
    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    // STORE (tetap sama)
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateJenisHewan($request); 
            $this->createJenisHewan($validatedData); 

            return redirect()->route('admin.jenis_hewan.index')
                ->with('success', 'Jenis hewan berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // ----------- FUNGSI CRUD BARU (EDIT, UPDATE, DESTROY) -----------
    
    // Fungsi untuk menampilkan form edit
    public function edit($idjenis_hewan)
    {
        // Cari data berdasarkan primary key yang didefinisikan di route
        $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
        return view('admin.jenis_hewan.edit', compact('jenisHewan'));
    }

    // Fungsi untuk memproses data yang diubah
    public function update(Request $request, $idjenis_hewan)
    {
        try {
            // Validasi input, mengirimkan ID untuk pengecualian unique rule
            $validatedData = $this->validateJenisHewan($request, $idjenis_hewan); 
            
            // Menggunakan helper untuk UPDATE data
            $this->updateJenisHewan($idjenis_hewan, $validatedData);

            return redirect()->route('admin.jenis_hewan.index')
                ->with('success', 'Jenis hewan berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // Fungsi untuk menghapus data
    public function destroy($idjenis_hewan)
    {
        try {
            $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
            $jenisHewan->delete();
            
            return redirect()->route('admin.jenis_hewan.index')
                ->with('success', 'Jenis hewan berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION -----------
    protected function validateJenisHewan(Request $request, $id = null)
    {
        // Aturan unique disesuaikan untuk update jika ID ada
        $uniqueRule = $id 
            ? 'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' 
            : 'unique:jenis_hewan,nama_jenis_hewan'; 

        return $request->validate([
            'nama_jenis_hewan' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule 
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.', 
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks.', 
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter.', 
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.', 
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada.', 
        ]);
    }
    
    // ----------- HELPER -----------
    
    // Helper untuk membuat data baru (CREATE)
    protected function createJenisHewan(array $data)
    {
        try {
            // Menggunakan Query Builder untuk insert data
            $jenisHewan = DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);

            return $jenisHewan;
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk memperbarui data (UPDATE)
    protected function updateJenisHewan($idjenis_hewan, array $data) 
    {
        try {
            $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
            return $jenisHewan->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui data jenis hewan: ' . $e->getMessage()); 
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaJenisHewan($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }

}