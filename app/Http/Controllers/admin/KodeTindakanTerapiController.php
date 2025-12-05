<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi; 
use App\Models\Kategori; 
use App\Models\KategoriKlinis;
use Exception;

class KodeTindakanTerapiController extends Controller
{
    // READ: Menampilkan daftar data
    public function index()
    {
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode_tindakan_terapi.index', compact('kodeTindakan'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode_tindakan_terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateKodeTindakanTerapi($request); 
            $this->createKodeTindakanTerapi($validatedData); 

            return redirect()->route('admin.kode_tindakan_terapi.index')
                ->with('success', 'Kode Tindakan Terapi berhasil ditambahkan.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // EDIT: Menampilkan form edit
    public function edit($idkode_tindakan_terapi)
    {
    $kodeTindakan = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
    
    // PASTIKAN KEDUA BARIS INI ADA DI FUNGSI EDIT:
    $kategori = Kategori::all(); 
    $kategoriKlinis = KategoriKlinis::all();

    // PASTIKAN SEMUA VARIABEL DIKIRIMKAN:
    return view('admin.kode_tindakan_terapi.edit', compact('kodeTindakan', 'kategori', 'kategoriKlinis'));
    }

    // UPDATE: Memperbarui data
    public function update(Request $request, $idkode_tindakan_terapi)
    {
        try {
            $validatedData = $this->validateKodeTindakanTerapi($request, $idkode_tindakan_terapi); 
            $this->updateKodeTindakanTerapi($idkode_tindakan_terapi, $validatedData);

            return redirect()->route('admin.kode_tindakan_terapi.index')
                ->with('success', 'Kode Tindakan Terapi berhasil diperbarui.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    // DESTROY: Menghapus data
    public function destroy($idkode_tindakan_terapi)
    {
        try {
            $kodeTindakan = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
            $kodeTindakan->delete();
            
            return redirect()->route('admin.kode_tindakan_terapi.index')
                ->with('success', 'Kode Tindakan Terapi berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    // ----------- VALIDATION (MENGHAPUS VALIDASI DESKRIPSI TAPI MEMPERTAHANKAN INPUT NAMA) -----------
    protected function validateKodeTindakanTerapi(Request $request, $id = null)
    {
        $uniqueRule = $id 
            ? 'unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi' 
            : 'unique:kode_tindakan_terapi,kode'; 

        return $request->validate([
            'kode' => [
                'required', 
                'string', 
                'max:10', 
                $uniqueRule 
            ],
            // MEMPERTAHANKAN INPUT NAMA_TINDAKAN (YANG AKAN DI-MAP KE DESKRIPSI)
            'nama_tindakan' => [
                'required', 
                'string', 
                'max:255',
            ],
            
            // Validasi Foreign Key (Kategori Master)
            'idkategori' => [ 
                'required',
                'integer',
                'exists:kategori,idkategori'
            ],
            // Validasi Foreign Key (Kategori Klinis)
            'idkategori_klinis' => [ 
                'required',
                'integer',
                'exists:kategori_klinis,idkategori_klinis' 
            ]
        ], [
            'kode.required' => 'Kode wajib diisi.', 
            'kode.unique' => 'Kode sudah ada.', 
            'nama_tindakan.required' => 'Nama tindakan wajib diisi.',
            'idkategori.required' => 'Kategori wajib dipilih.',
            'idkategori_klinis.required' => 'Kategori Klinis wajib dipilih.'
        ]);
    }
    
    // ----------- HELPER (MEMETAKAN NAMA_TINDAKAN KE DESKRIPSI_TINDAKAN_TERAPI) -----------
    
    // Helper untuk membuat data baru (CREATE)
    protected function createKodeTindakanTerapi(array $data) 
    {
        try {
            return KodeTindakanTerapi::create([ 
                'kode' => strtoupper(trim($data['kode'])), 
                // PERBAIKAN UTAMA: Memetakan input nama_tindakan ke kolom deskripsi_tindakan_terapi
                'deskripsi_tindakan_terapi' => $this->formatNamaTindakan($data['nama_tindakan']), 
                'idkategori' => $data['idkategori'], 
                'idkategori_klinis' => $data['idkategori_klinis'],
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal menyimpan Kode Tindakan Terapi: ' . $e->getMessage()); 
        }
    }

    // Helper untuk memperbarui data (UPDATE)
    protected function updateKodeTindakanTerapi($idkode_tindakan_terapi, array $data) 
    {
        try {
            $kodeTindakan = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
            return $kodeTindakan->update([
                'kode' => strtoupper(trim($data['kode'])),
                // PERBAIKAN UTAMA: Memetakan input nama_tindakan ke kolom deskripsi_tindakan_terapi
                'deskripsi_tindakan_terapi' => $this->formatNamaTindakan($data['nama_tindakan']), 
                'idkategori' => $data['idkategori'], 
                'idkategori_klinis' => $data['idkategori_klinis'],
            ]);
        } catch (Exception $e) { 
            throw new Exception('Gagal memperbarui Kode Tindakan Terapi: ' . $e->getMessage()); 
        }
    }

    protected function formatNamaTindakan($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }
}