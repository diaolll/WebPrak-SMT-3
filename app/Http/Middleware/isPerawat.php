<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isPerawat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login');
        }

        // 2. Ambil role dari session
        $userRole = session('user_role');

        // 3. Cek apakah role pengguna adalah '3' (Perawat)
        // Role '3' merujuk pada case '3' di LoginController yang me-redirect ke 'perawat.dashboard'.
        if ($userRole == 3) {
            // Jika role sesuai, izinkan akses ke route berikutnya
            return $next($request);
        } else {
            // Jika role tidak sesuai, tolak akses
            return back()->with('error', 'Akses ditolak. Anda tidak memiliki izin Perawat untuk mengakses halaman ini.');
        }
    }
}