<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jenishewan;

class JenisHewanController extends Controller
{
public function index()
{
    $jenisHewan = Jenishewan::all();
    return view('admin.jenis_hewan.index', compact('jenisHewan'));
}
public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateJenisHewan($request); 
            
            $jenisHewan = $this->createJenisHewan($validatedData); 

            return redirect()->route('admin.jenis_hewan.index')
                ->with('success', 'Jenis hewan berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    // B. Validation
    protected function validateJenisHewan(Request $request, $id = null)
    {
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
    
    // C. Helper
    protected function createJenisHewan(array $data) 
    {
        try {
            return JenisHewan::create([ 
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (\Exception $e) { 
            throw new \Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage()); 
        }
    }

    protected function formatNamaJenisHewan($nama) 
    {
        return trim(ucwords(strtolower($nama))); 
    }

}