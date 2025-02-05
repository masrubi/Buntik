<?php

namespace App\Http\Controllers\Anggota;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AnggotaDashboardController extends Controller
{
    public function index()
    {
        $transaksi = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
        ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
        ->select('pesanan.*', 'produk_tani.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten', 'user_alamat.nama_kecamatan', 'user_alamat.nama_desa')
        ->where('pesanan.status', 'selesai')
        ->orderBy('pesanan.updated_at', 'desc')
        ->limit(10)
        ->get();

        return view('anggota.dashboard', compact(['transaksi']));
    }

    public function laporan(Request $request)
    {
        $laporan = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
        ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
        ->select('pesanan.*','produk_tani.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten', 'user_alamat.nama_kecamatan', 'user_alamat.nama_desa')
        // ->where('pesanan.status', 'selesai')
        // ->orWhere('pesanan.status', 'Barang Dalam Pengiriman')
        ->whereBetween('pesanan.updated_at', [$request->date_start, $request->date_end])
        ->where(function($query) {
            $query->where('pesanan.status', 'selesai')
                  ->orWhere('pesanan.status', 'Barang Dalam Pengiriman');
        })
        ->get();

        return view('anggota.laporan.laporan', compact(['laporan']));
    }
}
