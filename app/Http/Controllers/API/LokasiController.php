<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
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
}
