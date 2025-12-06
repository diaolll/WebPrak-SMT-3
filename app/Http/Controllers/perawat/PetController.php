<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\DaftarPet;

class PetController extends Controller
{
    public function index()
    {
        $pets = DaftarPet::with(['pemilik', 'rasHewan', 'jenisHewan'])->get();

        return view('admin.Perawat.pet.index', compact('pets'));
    }


}
