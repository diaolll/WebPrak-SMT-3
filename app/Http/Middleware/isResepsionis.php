<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class IsResepsionis
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
            // Jika belum login, arahkan ke halaman login
            return redirect()->route('login');
        }

        // 2. Cek apakah pengguna yang sudah login memiliki role 'resepsionis'
        if (Auth::user()->role !== 'resepsionis') {
            // Jika role-nya bukan 'resepsionis', kembalikan respons 403 (Forbidden)
            // Anda bisa mengganti ini dengan pengalihan ke halaman lain (misalnya dashboard)
            abort(403, 'Akses Ditolak. Anda bukan Resepsionis.');
        }

        // 3. Jika lolos kedua pengecekan, lanjutkan ke request selanjutnya
        return $next($request);
    }
}