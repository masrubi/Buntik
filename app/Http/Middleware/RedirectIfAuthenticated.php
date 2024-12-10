<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
{
    
    $guards = empty($guards) ? [null] : $guards;

    /*foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = auth()->user(); // Ambil user yang sedang login

            // Cek role user
            if ($user->role == 'admin') {
                // Jika admin, redirect ke dashboard admin
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'anggota') {
                // Jika anggota, redirect ke dashboard anggota
                return redirect()->route('anggota.dashboard');
            } elseif ($user->role == 'pembeli') {
                // Jika pembeli, redirect ke dashboard pembeli
                return redirect()->route('customer.dashboard');
            }
        } */


        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (auth()->user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif (auth()->user()->role == 'anggota') {
                    return redirect()->route('anggota.dashboard');
                } else {
                    return redirect()->route('customer.dashboard');
                }
            }
        

    }

   
    return $next($request);
}

}
