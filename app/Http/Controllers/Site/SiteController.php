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

    public function login()
    {
        return view('site.login');
    }

    // POST /login
    public function doLogin(Request $request)
    {
        // 1) Validasi input
        $cred = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email'    => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        // 2) Coba login pakai Auth (cek password hash otomatis)
        if (Auth::attempt($cred)) {
            $request->session()->regenerate(); // anti session fixation

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // 3) Ambil 1 role aktif (status = 1)
            $activeRole = $user->roles()->wherePivot('status', 1)->first();

            // Simpan info penting di session (opsional)
            Session::put('iduser', $user->iduser);
            Session::put('email',  $user->email);
            Session::put('nama',   $user->nama);
            Session::put('role',   $activeRole?->nama_role);

            // 4) Redirect sesuai role
            $roleName = $activeRole?->nama_role;
            return match ($roleName) {
                'Administrator' => redirect()->route('admin.home'),
                'Resepsionis'   => redirect()->route('resepsionis.home'),
                'Perawat'       => redirect()->route('perawat.home'),
                'Dokter'        => redirect()->route('dokter.home'),
                default         => $this->logoutWithMessage('Role tidak ditemukan / tidak aktif.'),
            };
        }

        // jika gagal
        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }

    // GET /logout
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('site.login')->with('success', 'Anda telah logout.');
    }

    private function logoutWithMessage(string $msg)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('site.login')->with('error', $msg);
    }
    
}

