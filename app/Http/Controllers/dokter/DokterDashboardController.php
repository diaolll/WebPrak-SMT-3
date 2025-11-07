<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterDashboardController extends Controller
{
    public function index()
    {
        return view('admin.Dokter.Dashboard_dokter');
    }
}
