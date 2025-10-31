<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (!Auth::check()) {

            return redirect()->route('login');
        }

        $user_role = session()->get('user_role') ?? null;

        if ($user_role == 1) {
            return $next($request);
        } else {
            return back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }
}
