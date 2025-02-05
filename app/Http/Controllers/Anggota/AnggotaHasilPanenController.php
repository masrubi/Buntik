<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\HasilPanen;
use App\Models\PengelolaanTanaman;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaHasilPanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
        public function index()
{
    $hasilPanen = HasilPanen::with(['pengelolaanTanaman.kelompokTani', 'pengelolaanTanaman.tanaman', 'user'])->get();
    return view('anggota.hasil_panen.hasil_panen', compact('hasilPanen'));
}

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengelolaanTanaman = PengelolaanTanaman::all();
        $users = User::all();

        return view('anggota.hasil_panen.hasil_panen_create', compact('pengelolaanTanaman', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengelolaan_tanaman_id' => 'required|exists:pengelolaan_tanaman,id',
            'id_user' => 'required|exists:users,id',
            'jml_panen' => 'required|numeric|min:0',
            'jml_jual' => 'required|numeric|min:0',
            'jml_hibah' => 'required|numeric|min:0',
            'jml_sisa' => 'required|numeric|min:0',
        ]);

        HasilPanen::create($request->all());

        return redirect()->route('anggota.hasil_panen.index')->with('success', 'Data hasil panen berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilPanen $hasilPanen)
    {
        $pengelolaanTanaman = PengelolaanTanaman::all();
        $users = User::all();

        return view('anggota.hasil_panen.hasil_panen_edit', compact('hasilPanen', 'pengelolaanTanaman', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HasilPanen $hasilPanen)
    {
        $request->validate([
            'pengelolaan_tanaman_id' => 'required|exists:pengelolaan_tanaman,id',
            'id_user' => 'required|exists:users,id',
            'jml_panen' => 'required|numeric|min:0',
            'jml_jual' => 'required|numeric|min:0',
            'jml_hibah' => 'required|numeric|min:0',
            'jml_sisa' => 'required|numeric|min:0',
        ]);

        $hasilPanen->update($request->all());

        return redirect()->route('anggota.hasil_panen.index')->with('success', 'Data hasil panen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilPanen $hasilPanen)
    {
        $hasilPanen->delete();

        return redirect()->route('anggota.hasil_panen.index')->with('success', 'Data hasil panen berhasil dihapus.');
    }
}
