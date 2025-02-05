<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AlamatAnggotaController extends Controller
{
    /**
     * Fetch wilayah data from the API
     */
    // Mengambil data kabupaten berdasarkan provinsi
    public function getKabupaten($provinsiId)
    {
        
        $kabupaten = Kabupaten::where('provinsi_id', $provinsiId)->get();
        return response()->json(['kabupaten' => $kabupaten]);  // Mengembalikan data kabupaten dalam format JSON
    }

    public function getKecamatan($kabupatenId)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $kabupatenId)->get();
        return response()->json(['kecamatan' => $kecamatan]);  // Mengembalikan data kecamatan dalam format JSON
    }

    public function getDesa($kecamatanId)
    {
        $desa = Desa::where('kecamatan_id', $kecamatanId)->get();
        return response()->json(['desa' => $desa]);  // Mengembalikan data desa dalam format JSON
    }


    public function create_checkout($alamat)
    {
        // Data alamat yang diterima
        $alamat = $alamat;

        // Ambil data provinsi dari tabel 'provinsi'
        $provinsi = \App\Models\Provinsi::all(); // Sesuaikan dengan model Anda



        // Kirim data ke view 'alamat_anggota'
        return view('anggota.alamat.alamat_anggota', compact('alamat', 'provinsi'));
    }





    /**
    

    
     * Create checkout page with wilayah selection
     */


    /**
     * Store selected address to the database
     */
    public function store_alamat_checkout(Request $request)
{
    // Mendapatkan id_keranjang dari request
    $id_keranjang = $request->id_keranjang;

    // Cek kapasitas maksimal alamat
    $alamat = Alamat::where('id_user', Auth::id())->get();
    if ($alamat->count() >= 3) {
        return redirect()->route('anggota_profile.show', $id_anggota)
            ->with('error', 'Kapasitas pengisian alamat maksimal hanya 3.');
    }

    // Validasi request data
    $request->validate([
        'nama' => 'required',
        'telp' => 'required',
        'pos' => 'required',
        'provinsi' => 'required|numeric',
        'kabupaten' => 'required|numeric',
        'kecamatan' => 'required|numeric',
        'desa' => 'required|numeric',
        'alamat' => 'required',
    ]);

    // Ambil data wilayah berdasarkan ID untuk mendapatkan nama wilayah
    $provinsi = Provinsi::find($request->provinsi);
    $kabupaten = Kabupaten::find($request->kabupaten);
    $kecamatan = Kecamatan::find($request->kecamatan);
    $desa = Desa::find($request->desa);

    // Pastikan semua data wilayah ditemukan
    if (!$provinsi || !$kabupaten || !$kecamatan || !$desa) {
        return redirect()->route('anggota_profile.show', $id_keranjang)
            ->with('error', 'Wilayah tidak ditemukan. Pastikan memilih provinsi, kabupaten, kecamatan, dan desa dengan benar.');
    }

    // Simpan alamat ke database
    Alamat::create([
        'id_user' => Auth::id(),
        'no_telp' => $request->telp,
        'nama_penerima' => $request->nama,
        'id_provinsi' => $provinsi->id,
        'nama_prov' => $provinsi->nama,
        'id_kabupaten' => $kabupaten->id,
        'nama_kabupaten' => $kabupaten->nama,
        'id_kecamatan' => $kecamatan->id,
        'nama_kecamatan' => $kecamatan->nama,
        'id_desa' => $desa->id,
        'nama_desa' => $desa->nama,
        'kode_pos' => $request->pos,
        'alamat' => $request->alamat,
    ]);

    // Kembalikan ke halaman keranjang dengan status sukses
    return redirect()->route('anggota_profile.show', $id_keranjang)
        ->with('success', 'Berhasil menambahkan alamat anggota.')
        ->with(compact('id_anggota')); // Menggunakan compact di sini
    }
}
