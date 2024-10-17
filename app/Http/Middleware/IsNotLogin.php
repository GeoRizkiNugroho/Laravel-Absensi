<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsNotLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login, lanjutkan request
        if (Auth::check() == FALSE) {
            return $next($request);
        }

        // Jika sudah login, redirect ke halaman 'home' atau yang ditentukan
        return redirect()->route('home')->with('failed', 'Anda telah login, tidak dapat login lagi');
    }
}
