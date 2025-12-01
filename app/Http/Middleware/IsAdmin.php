<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek: Sudah login? DAN Role-nya 'admin'?
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Silakan masuk
        }

        // Kalau bukan admin, tolak akses (Error 403 Forbidden)
        abort(403, 'AKSES DITOLAK: Halaman ini khusus Admin.');
    }
}