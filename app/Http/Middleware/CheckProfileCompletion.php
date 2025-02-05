<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelompokTani;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Cek apakah role pengguna adalah anggota
            if ($user->role === 'anggota') {
                // Ambil data kelompok tani berdasarkan id_user
                $kelompokTani = KelompokTani::where('id_user', $user->id)->first();

                // Cek apakah data kelompok tani ada dan kolom penting sudah terisi
                if (!$kelompokTani || 
                    empty($kelompokTani->nama_kelompok) || 
                    empty($kelompokTani->id_provinsi) || 
                    empty($kelompokTani->id_kabupaten) || 
                    empty($kelompokTani->id_kecamatan) || 
                    empty($kelompokTani->id_desa) || 
                    empty($kelompokTani->alamat) || 
                    empty($kelompokTani->desa) || 
                    empty($kelompokTani->kecamatan) || 
                    empty($kelompokTani->kabupaten) || 
                    empty($kelompokTani->provinsi)) 
                {
                    // Mengecualikan rute profile edit dan profile
                    if (!$request->routeIs('anggota.profile') && !$request->routeIs('anggota.profile_edit')) {
                        return redirect()->route('anggota.profile')->with('error', 'Harap lengkapi profil kelompok tani Anda sebelum melanjutkan.');
                    }
                }
            }
        }

        return $next($request);
    }
}
