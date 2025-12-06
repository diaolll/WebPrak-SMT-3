<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPet;

class PetController extends Controller
{
    public function index()
    {
        $pets = DaftarPet::with(['pemilik', 'rasHewan', 'jenisHewan'])->get();

        return view('admin.dokter.pet.index', compact('pets'));
    }

}
