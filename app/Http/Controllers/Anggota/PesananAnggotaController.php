<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PesananAnggotaController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Filter pesanan berdasarkan id_user (anggota yang login)
        $konfirmasi = Pesanan::with(['produk', 'userAlamat', 'customer'])
            ->where('id_user', $user->id)
            ->where('status', 'Bukti Pembayaraan Sedang Di Tinjau')
            ->where('tipe_pembayaran', 'lunas')
            ->orderBy('updated_at', 'desc')
            ->get();

        $ongoing = Pesanan::with(['produk', 'userAlamat', 'customer'])
            ->where('id_user', $user->id)
            ->where('status', 'Pesanan Di Terima')
            ->where('tipe_pembayaran', 'lunas')
            ->orderBy('id_pesanan', 'desc')
            ->get();

        $kirim = Pesanan::with(['produk', 'userAlamat', 'customer'])
            ->where('id_user', $user->id)
            ->where('status', 'Barang Dalam Pengiriman')
            ->orderBy('id_pesanan', 'desc')
            ->get();

        $konfirmasi_dp = Pesanan::with(['produk', 'userAlamat', 'customer'])
            ->where('id_user', $user->id)
            ->where('status', 'Bukti Pembayaraan Sedang Di Tinjau')
            ->where('tipe_pembayaran', 'dp')
            ->orderBy('updated_at', 'desc')
            ->get();

        $ongoing_dp = Pesanan::with(['produk', 'userAlamat', 'customer'])
            ->where('id_user', $user->id)
            ->where('status', 'Pesanan Di Terima')
            ->where('tipe_pembayaran', 'dp')
            ->orderBy('id_pesanan', 'desc')
            ->get();

        return view('anggota.pesanan.pesanan', compact(['konfirmasi', 'ongoing', 'kirim', 'konfirmasi_dp', 'ongoing_dp']));
    }

    public function konfirm_pembayaran($id)
    {
        Pesanan::where('id_pesanan', $id)->update([
            'status' => 'Pesanan Di Terima'
        ]);
        return back();
    }

    public function tolak_pembayaran($id)
    {
        Pesanan::where('id_pesanan', $id)->update([
            'status' => 'Pesanan Di Tolak'
        ]);
        return back();
    }

    public function cetak_pesanan($id)
    {
        $pesanan = Pesanan::with(['produk', 'userAlamat', 'customer'])
            ->where('id_pesanan', $id)
            ->firstOrFail();

        return view('anggota.pesanan.pesanan_cetak', compact(['pesanan']));
    }

    public function download_request($id)
    {
        $desain = Pesanan::findOrFail($id);
        $file = public_path() . "/desain/" . $desain->desain;

        return Response::download($file, '#P00' . $desain->id_pesanan . '-' . $desain->desain);
    }

    public function store_resi(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required'
        ]);

        Pesanan::where('id_pesanan', $id)->update([
            'status' => 'Barang Dalam Pengiriman',
            'no_resi' => $request->resi,
        ]);

        return back();
    }

    public function kirim_tagihan($id)
    {
        Pesanan::where('id_pesanan', $id)->update([
            'dp_status' => 'tagihan deliver',
        ]);

        return back();
    }

    public function tolak_sisa_dp($id)
    {
        Pesanan::where('id_pesanan', $id)->update([
            'dp_status' => 'tagihan sisa tolak',
        ]);

        return back();
    }

    public function terima_sisa_dp($id)
    {
        Pesanan::where('id_pesanan', $id)->update([
            'dp_status' => 'lunas',
        ]);

        return back();
    }
}
