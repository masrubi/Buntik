<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\User;
use App\Models\KelompokTani;
use App\Models\Provinsi;  // Import model Provinsi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAnggotaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kelompokTani = KelompokTani::where('id_user', $user->id)->first();
        $provinsi = Provinsi::all(); // Ambil semua data provinsi

        return view('anggota.profile.profile', compact('user', 'kelompokTani', 'provinsi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'img1' => 'required|image|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('img1')) {
            $foto_profile = $request->file('img1')->getClientOriginalName();
            $request->img1->move(public_path('foto_profile'), $foto_profile);

            $id_user = Auth::user()->id;

            User::find($id_user)->update([
                'foto_profile' => $foto_profile,
            ]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::find($id)->update($data);

        return back()->with('success', 'Berhasil memperbarui profil');
    }

    public function update_kelompok_tani(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'lokasi' => 'required',
            'modal_gedung' => 'required',
            'modal_pupuk' => 'required',
            'modal_bibit' => 'required',
            'modal_alat_operasional' => 'required',
        ]);
        
        KelompokTani::updateOrCreate(
            ['id_user' => Auth::id()],
            [
                'nama_kelompok' => $request->nama_kelompok,
                'id_provinsi' => $request->provinsi,
                'id_kabupaten' => $request->kabupaten,
                'id_kecamatan' => $request->kecamatan,
                'id_desa' => $request->desa,
                'alamat' => $request->alamat,
                'provinsi' => Provinsi::find($request->provinsi)->nama,
                'kecamatan' => Kecamatan::find($request->kecamatan)->nama,
                'kabupaten' => Kabupaten::find($request->kabupaten)->nama,
                'desa' => Desa::find($request->desa)->nama,
                'lokasi' => $request->lokasi,
                'modal_gedung' => $request->modal_gedung,
                'modal_pupuk' => $request->modal_pupuk,
                'modal_bibit' => $request->modal_bibit,
                'modal_alat_operasional' => $request->modal_alat_operasional,
            ]
        );

        return back()->with('success', 'Data kelompok tani berhasil diperbarui');
    }
}
