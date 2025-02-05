<?php

namespace App\Http\Controllers\Anggota;
use App\Http\Controllers\Controller;
use App\Models\PengelolaanTanaman;
use App\Models\KelompokTani;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class AnggotaPengelolaanTanamanController extends Controller
{
    // Menampilkan semua pengelolaan tanaman
    public function index()
    {
        $pengelolaanTanaman = PengelolaanTanaman::with(['kelompokTani', 'tanaman'])->get();
       
        return view('anggota.pengelolaan_tanaman.pengelolaan_tanaman', compact('pengelolaanTanaman'));
    }

    // Menampilkan form untuk membuat pengelolaan tanaman baru
    public function create()
    {
        $kelompokTani = KelompokTani::all();
        $tanaman = Tanaman::all();
        return view('anggota.pengelolaan_tanaman.pengelolaan_tanaman_create', compact('kelompokTani', 'tanaman'));
    }

    // Menyimpan pengelolaan tanaman baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelompok_tani_id' => 'required|exists:kelompok_tani,id',
            'tanaman_id' => 'required|exists:tanaman,id',
            'tanggal_tanam' => 'required|date',
            'tanggal_panen' => 'required|date|after:tanggal_tanam',
            'jml_tanam' => 'required|numeric|min:1',
            'jml_pupuk' => 'required|numeric|min:0',
        ]);

        PengelolaanTanaman::create(array_merge($validated, ['id_user' => auth()->id()]));

        return redirect()->route('anggota.pengelolaan_tanaman.index')
            ->with('success', 'Data pengelolaan tanaman berhasil disimpan!');
    }

    // Menampilkan form untuk mengedit pengelolaan tanaman
    public function edit($id)
    {
        // Cari pengelolaan tanaman berdasarkan ID dengan relasi terkait
        $pengelolaanTanaman = PengelolaanTanaman::with(['kelompokTani', 'tanaman', 'user'])->findOrFail($id);
    
        // Ambil semua data kelompok tani, tanaman, dan user untuk dropdown (jika diperlukan)
        $kelompokTani = KelompokTani::all();
        $tanaman = Tanaman::all();
        $users = User::where('role', 'anggota')->get(); // Ambil hanya user dengan role tertentu (opsional)
    
        // Kirim data ke view
        return view('anggota.pengelolaan_tanaman.pengelolaan_tanaman_edit', compact('pengelolaanTanaman', 'kelompokTani', 'tanaman', 'users'));
    }
    

    // Mengupdate data pengelolaan tanaman
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kelompok_tani_id' => 'required|exists:kelompok_tani,id',
            'tanaman_id' => 'required|exists:tanaman,id',
            'tanggal_tanam' => 'required|date',
            'tanggal_panen' => 'required|date|after:tanggal_tanam',
            'jml_tanam' => 'required|numeric|min:1',
            'jml_pupuk' => 'required|numeric|min:0',
        ]);

        $pengelolaanTanaman = PengelolaanTanaman::findOrFail($id);
        $pengelolaanTanaman->update($validated);

        return redirect()->route('anggota.pengelolaan_tanaman.index')
            ->with('success', 'Data pengelolaan tanaman berhasil diperbarui!');
    }

    // Menghapus pengelolaan tanaman
    public function destroy($id)
    {
        $pengelolaanTanaman = PengelolaanTanaman::findOrFail($id);
        $pengelolaanTanaman->delete();

        return redirect()->route('anggota.pengelolaan_tanaman.index')
            ->with('success', 'Data pengelolaan tanaman berhasil dihapus!');
    }
}
