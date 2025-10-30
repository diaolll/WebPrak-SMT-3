<?php

// Pastikan namespace ini sudah benar
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// BARIS INI YANG HILANG ATAU SALAH NAMA
use App\Models\DaftarPet;
class DaftarPetController extends Controller // Pastikan nama class sudah benar
{
    public function index()
    {
        // Sekarang, Laravel tahu bahwa 'Pet' merujuk ke 'App\Models\Pet'
        $pets = DaftarPet::with('pemilik.user', 'rasHewan')->get();
        
        // Pastikan nama view sudah benar (misal: 'admin.pet.index')
        return view('admin.Daftar_Pet.index', compact('pets')); 
    }
}