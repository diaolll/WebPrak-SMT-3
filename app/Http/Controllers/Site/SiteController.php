<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- untuk Auth
use Illuminate\Support\Facades\Session;


class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function struktur()
    {
        return view('site.struktur');
    }
    
    public function layanan()
    {
        return view('site.layanan');
    }

    public function pelatihan()
    {
        return view('site.pelatihan');
    }

    public function kontak()
    {
        return view('site.kontak');
    }
 
    
    public function cekKoneksi() // membuat method cekKoneksi
    {
        try {
            \DB::connection()->getPdo();
            return "Koneksi ke database berhasil.";
        } catch (\Exception $e) {
            return "Koneksi ke database gagal: " . $e->getMessage();
        }
    }

    public function admin()
    {
        return view('site.admin');
    }
}

