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

                // Daftar kolom yang harus diisi
                $fieldsToCheck = ['nama_kelompok', 'id_provinsi', 'id_kabupaten', 'id_kecamatan', 'id_desa', 'alamat', 'desa', 'kecamatan', 'kabupaten', 'provinsi'];

                // Cek apakah data kelompok tani ada dan semua kolom wajib sudah terisi
                $isProfileIncomplete = !$kelompokTani || collect($fieldsToCheck)->contains(fn($field) => blank($kelompokTani->$field));

                // Jika profil belum lengkap, arahkan ke halaman profile kecuali jika pengguna sedang di halaman profile atau edit profile
                if ($isProfileIncomplete && !in_array($request->route()->getName(), ['anggota.profile', 'anggota.profile_edit'])) {
                    return redirect()->route('anggota.profile')
                        ->with('error', 'Harap lengkapi profil kelompok tani Anda sebelum melanjutkan.');
                }
            }
        }

        return $next($request);
    }
}
