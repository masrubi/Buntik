<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatCustomerController extends Controller
{
    /**
     * Fetch wilayah data from the API
     */
    // Mengambil data kota berdasarkan provinsi
    public function getKota($provinsiId)
    {
        \Log::info("getKota dipanggil dengan provinsiId: $provinsiId");
        $kota = Kota::where('provinsi_id', $provinsiId)->get();
        return response()->json(['kota' => $kota]);  // Mengembalikan data kota dalam format JSON
    }
    
    public function getKecamatan($kotaId)
    {
        $kecamatan = Kecamatan::where('kota_id', $kotaId)->get();
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

    

    // Kirim data ke view 'alamat_checkout'
    return view('customer.alamat.alamat_checkout', compact('alamat', 'provinsi'));
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
    
        // Check if the user has less than 3 addresses
        $alamat = Alamat::where('id_user', Auth::id())->get();
        if ($alamat->count() >= 3) {
            return redirect()->route('keranjang.show', $id_keranjang)
                ->with('error', 'Kapasitas pengisian alamat maksimal hanya 3.');
        }
    
        // Validate request data
        $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'pos' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
        ]);
    
        // Parse wilayah inputs (periksa format id|name untuk setiap wilayah)
        $provinsi = explode('|', $request->provinsi);
        $kota = explode('|', $request->kota);
        $kecamatan = explode('|', $request->kecamatan);
        $desa = explode('|', $request->desa);
    
        // Pastikan setiap wilayah terisi dengan format yang benar
        if (count($provinsi) !== 2 || count($kota) !== 2 || count($kecamatan) !== 2 || count($desa) !== 2) {
            return redirect()->route('keranjang.show', $id_keranjang)
                ->with('error', 'Format wilayah tidak valid. Pastikan memilih provinsi, kota, kecamatan, dan desa dengan benar.');
        }
    
        // Assign variables from exploded values
        [$id_provinsi, $nama_provinsi] = $provinsi;
        [$id_kota, $nama_kota] = $kota;
        [$id_kecamatan, $nama_kecamatan] = $kecamatan;
        [$id_desa, $nama_desa] = $desa;
    
        // Store address in the database
        Alamat::create([
            'id_user' => Auth::id(),
            'no_telp' => $request->telp,
            'nama_penerima' => $request->nama,
            'id_provinsi' => $id_provinsi,
            'nama_prov' => $nama_provinsi,
            'id_kota' => $id_kota,
            'nama_kota' => $nama_kota,
            'id_kecamatan' => $id_kecamatan,
            'nama_kecamatan' => $nama_kecamatan,
            'id_desa' => $id_desa,
            'nama_desa' => $nama_desa,
            'kode_pos' => $request->pos,
            'alamat' => $request->alamat,
        ]);
    
        // Kembalikan ke halaman keranjang dengan status sukses dan kirimkan data yang diperlukan
        return redirect()->route('keranjang.show', $id_keranjang)
            ->with('success', 'Berhasil menambahkan alamat pengiriman.')
            ->with(compact('id_keranjang')); // Menggunakan compact di sini
    }
}    


