<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isDokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil role dari session
       $userRole = session('user_role');

       // Cek apakah role pengguna adalah '2' (Dokter)
       if ($userRole == 2) {
            // Jika role sesuai, izinkan akses
            return $next($request);
        } else {
            // Jika role tidak sesuai, tolak akses
            return back()->with('error', 'Akses ditolak. Anda tidak memiliki izin Dokter untuk mengakses halaman ini.');
        }
    }
}