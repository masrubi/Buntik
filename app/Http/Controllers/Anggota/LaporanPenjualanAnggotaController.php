<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanPenjualanAnggotaController extends Controller
{
    public function laporan_penjualan()
    {
        $transaksi = Pesanan::join('produk', 'produk.id_produk', '=', 'pesanan.id_produk')
        ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
        ->select('pesanan.*', 'produk.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kota')
        /*->where('pesanan.status', 'selesai')
        ->orWhere('pesanan.status', 'Barang Dalam Pengiriman')*/
        ->where(function ($query) {
            $query->where('pesanan.status', 'selesai')
                  ->orWhere('pesanan.status', 'Barang Dalam Pengiriman');
        })
        
        ->orderBy('pesanan.updated_at', 'desc')
        ->limit(10)
        ->get();

        return view('anggota.laporan_penjualan.laporan_penjualan', compact(['transaksi']));
    }
    public function cetakPesanan($id)
{
    $pesanan = Pesanan::find($id);

    if (!$pesanan) {
        return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
    }

    // Ambil data terkait lainnya jika diperlukan
    $produk = $pesanan->produk;
    $alamat = $pesanan->user_alamat;

    return view('anggota.pesanan.cetak_pesanan', compact('pesanan', 'produk', 'alamat'));
}
/*public function cetakLaporan()
{
    $transaksi = Pesanan::join('produk', 'produk.id_produk', '=', 'pesanan.id_produk')
        ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
        ->select('pesanan.*', 'produk.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kota')
        ->where('pesanan.status', 'selesai')
        ->orWhere('pesanan.status', 'Barang Dalam Pengiriman')
        ->orderBy('pesanan.updated_at', 'desc')
        ->get();

    return view('anggota.laporan_penjualan.cetak_laporan', compact('transaksi'));
}*/


public function cetakLaporan(Request $request)
{
    $date_start = $request->input('date_start');
    $date_end = $request->input('date_end');

    $query = Pesanan::join('produk', 'produk.id_produk', '=', 'pesanan.id_produk')
        ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
        ->select('pesanan.*', 'produk.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kota')
        ->where('pesanan.status', 'selesai')
        ->orWhere('pesanan.status', 'Barang Dalam Pengiriman');

    if ($date_start && $date_end) {
        $query->whereBetween('pesanan.updated_at', [$date_start, $date_end]);
    }

    $transaksi = $query->orderBy('pesanan.updated_at', 'desc')->get();

    return view('anggota.laporan_penjualan.cetak_laporan', compact('transaksi', 'date_start', 'date_end'));
}


}

