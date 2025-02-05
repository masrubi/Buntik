<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Rekening;
use App\Models\Variasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

   /* public function get_ongkir($id_kabupaten, $berat)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=399&destination=" . $id_kabupaten . "&weight=" . $berat . "&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: f201c33f7b1021a48e2a76125bfa5e15"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $provinsi = $response['rajaongkir']['results'];
            return $provinsi;
        }
    }
*/
    public function index()
    {
        $pesanan_paid = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
            ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
            ->select('pesanan.*', 'produk_tani.*', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten','user_alamat.nama_kecamatan', 'user_alamat.nama_desa')
            ->where('pesanan.id_user', Auth::user()->id)
            ->where(function($query){
                $query->where('pesanan.status', 'menunggu pembayaran')
                ->orWhere('pesanan.status','Bukti Pembayaraan Sedang Di Tinjau')
                ->orWhere('pesanan.status','Pesanan Di Tolak');
            })
            ->orderBy('pesanan.updated_at', 'desc')
            ->get();


            $ongoing = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
            ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
            ->select('pesanan.*', 'produk_tani.*', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten','user_alamat.nama_kecamatan', 'user_alamat.nama_desa')
            ->where('pesanan.id_user', Auth::user()->id)
            ->where('pesanan.status', 'Pesanan Di Terima')
            ->orderBy('pesanan.updated_at', 'desc')
            ->get();

            $kirim = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
            ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
            ->select('pesanan.*', 'produk_tani.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten','user_alamat.nama_kecamatan', 'user_alamat.nama_desa')
            ->where('pesanan.id_user', Auth::user()->id)
            ->where('pesanan.status', 'Barang Dalam Pengiriman')
            ->orderBy('pesanan.updated_at', 'desc')
            ->get();

            $tagihan = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
            ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
            ->select('pesanan.*', 'produk_tani.nama_produk', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten', 'user_alamat.nama_kecamatan', 'user_alamat.nama_desa')
            ->where('pesanan.id_user', Auth::user()->id)
            ->where('pesanan.dp_status', 'tagihan deliver')
            ->orderBy('pesanan.updated_at', 'desc')
            ->get();
        return view('customer.pesanan.pesanan', compact(['pesanan_paid', 'ongoing','kirim','tagihan']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validasi jika alamat pengiriman belum dipilih
    if ($request->alamat_kirim === null) {
        return back()->with('error', 'Proses Gagal Wajib Memilih Salah Satu Alamat Pengiriman');
    }

    // Mendapatkan id keranjang dan memproses harga variasi dan harga semai
    $id_keranjang = $request->id_keranjang;
    $harga_variasi = $request->variasi_harga ?? '0';
    $harga_semai = $request->semai_harga ?? '0';

    // Hitung total variasi dan semai
    $total_variasi = array_sum(explode(',', $harga_variasi));
    $total_semai = array_sum(explode(',', $harga_semai));

    // Memproses data kabupaten dari request
    $kabupaten = explode('|', $request->alamat_kirim);
    $id_kabupaten = $kabupaten[0] ?? null;
    $id_alamat = $kabupaten[1] ?? null;

    // Validasi jika kabupaten atau alamat tidak valid
    if ($id_kabupaten === null || $id_alamat === null) {
        return back()->with('error', 'Format alamat pengiriman tidak valid.');
    }

    // Ambil data keranjang
    $keranjang = Keranjang::join('produk_tani', 'keranjang.id_produk', '=', 'produk_tani.id_produk')
        ->select('keranjang.*', 'produk_tani.*')
        ->find($id_keranjang);

    if (!$keranjang) {
        return back()->with('error', 'Data keranjang tidak ditemukan.');
    }

    // Hitung total harga produk
    $total = $keranjang->total;
    $harga_produk = $keranjang->harga_produk;
    $jumlah = $harga_produk * $total;

    // Asumsikan berat produk = jumlah total
    $berat = $total;

    // Ongkir
    $ongkir = 0; // Jika tidak ada layanan ongkir, tetapkan 0
    $harga_ongkir = $ongkir;

    // Hitung total pembayaran
    $total_bayar = $jumlah + $harga_ongkir + $total_variasi + $total_semai;

    // Simpan data pesanan ke database
    Pesanan::create([
        'id_user' => Auth::user()->id,
        'id_produk' => $keranjang->id_produk,
        'quantity' => $keranjang->total,
        'id_alamat' => $id_alamat,
        'id_kabupaten'   => $id_kabupaten,
        'variasi'   => $request->variasi,
        'variasi_harga' => $harga_variasi,
        'variasi_total' => $total_variasi,
        'semai'   => $request->semai,
        'semai_harga' => $harga_semai,
        'semai_total' => $total_semai,
        'note_semai_variasi' => $request->note,
        'bayar' => $jumlah,
        'ongkir' => $harga_ongkir,
        'total_bayar' => $total_bayar,
        'status' => "menunggu pembayaran",
    ]);

    // Hapus keranjang setelah pesanan disimpan
    Keranjang::find($id_keranjang)->delete();

    // Redirect ke halaman pesanan
    return to_route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
        ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
        ->join('users', 'users.id', '=', 'pesanan.id_user')
        ->select('pesanan.*', 'produk_tani.*', 'user_alamat.no_telp','user_alamat.alamat','user_alamat.nama_penerima', 'user_alamat.nama_prov', 'user_alamat.nama_kabupaten','user_alamat.nama_kecamatan', 'user_alamat.desa' ,'users.*')
        ->find($id);

        return view('customer.pesanan.pesanan_cetak', compact(['pesanan']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pesanan  = Pesanan::join('produk_tani', 'produk_tani.id_produk', '=', 'pesanan.id_produk')
            ->join('user_alamat', 'user_alamat.id_user_alamat', '=', 'pesanan.id_alamat')
            ->select(
                'pesanan.*',
                'produk_tani.*',
                'user_alamat.nama_prov',
                'user_alamat.nama_kabupaten',
                'user_alamat.nama_kecamatan',
                'user_alamat.nama_desa',
                'user_alamat.alamat',
                'user_alamat.kode_pos',
                'user_alamat.nama_penerima',
                'user_alamat.no_telp'
            )
            ->find($id);

        $rekening = Rekening::get();

        $id_kabupaten = $pesanan->id_kabupaten;
        $berat = $pesanan->quantity * 1;
        $ongkir = 0;

        // dd($ongkir);
        return view('customer.pesanan.pesanan_edit', compact(['pesanan', 'ongkir', 'rekening']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required',
            'metode' => 'required'
        ]);

        $data_desain = Pesanan::find($id);

        if ($request->hasFile('bukti_bayar')) {
            $bukit_pembayaran = $request->file('bukti_bayar')->getClientOriginalName();
            $request->bukti_bayar->move(public_path('bukti_bayar'), $bukit_pembayaran);
        }

        if ($request->hasFile('desain')) {
            $desain = $request->file('desain')->getClientOriginalName();
            $request->desain->move(public_path('desain'), $desain);
        } else {
            $desain = $data_desain->desain;
        }

        if ($request->metode=='dp') {
            Pesanan::find($id)->update([
                'bukti_bayar_dp' => $bukit_pembayaran,
                'desain' => $desain,
                'request_user' => $request->request_desain,
                'status' => 'Bukti Pembayaraan Sedang Di Tinjau',
                'tipe_pembayaran' => 'dp',
            ]);
        }else{
            Pesanan::find($id)->update([
                'bukti_bayar' => $bukit_pembayaran,
                'desain' => $desain,
                'request_user' => $request->request_desain,
                'status' => 'Bukti Pembayaraan Sedang Di Tinjau',
                'tipe_pembayaran' => 'lunas',
            ]);
        }

        return to_route('pesanan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
