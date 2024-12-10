<?php



namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\KelompokTani;
use Illuminate\Http\Request;

class AdminKelompokTaniController extends Controller
{
    // Metode untuk menampilkan form tambah Kelompok Tani
    public function create()
    {
        return view('kelompok_tani.create'); // Pastikan Anda memiliki view 'create' di resources/views/kelompok_tani
    }

    // Metode untuk menyimpan data Kelompok Tani
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'modal_gedung' => 'required|numeric',
            'modal_pupuk' => 'required|numeric',
            'modal_bibit' => 'required|numeric',
            'modal_alat_operasional' => 'required|numeric',
        ]);

        KelompokTani::create($request->all());

        return redirect()->route('kelompok_tani.index')->with('success', 'Kelompok Tani berhasil ditambahkan');
    }

    // Metode untuk menampilkan list Kelompok Tani
    public function index()
{
    $kelompokTani = KelompokTani::paginate(10); // Mengambil 10 data per halaman
    return view('kelompok_tani.index', compact('kelompokTani'));
}

    // Method Edit
    public function edit($id)
    {
        $kelompokTani = KelompokTani::findOrFail($id);
        return view('kelompok_tani.edit', compact('kelompokTani'));
    }

    // Method Update
    public function update(Request $request, $id)
    {
        $kelompokTani = KelompokTani::findOrFail($id);

        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'modal_gedung' => 'required|numeric|min:0',
            'modal_awal_pupuk' => 'required|numeric|min:0',
            'modal_awal_bibit' => 'required|numeric|min:0',
            'modal_operasional' => 'required|numeric|min:0',
        ]);

        $kelompokTani->update($validated);

        return redirect()->route('kelompok_tani.index')
            ->with('success', 'Data Kelompok Tani berhasil diperbarui.');
    }
}
