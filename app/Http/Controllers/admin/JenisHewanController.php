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
}