<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RasHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rashewan = RasHewan::all();
        return view('admin.ras_hewan.index', compact('rashewan'));
    }
}
