<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Semai;
use App\Models\Variasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = Keranjang::join('produk_tani', 'keranjang.id_produk', '=', 'produk_tani.id_produk')
            ->select('keranjang.*', 'produk_tani.*')
            ->where('keranjang.id_user', Auth::user()->id)
            ->orderBy('keranjang.id_keranjang', 'desc')
            ->paginate(10);

        return view('customer.keranjang.keranjang', compact(['keranjang']));
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

        if ($request->demo0 < 1) {
            return back()->with('error', 'Maaf Pembelian Produk belum mendapatkan diskon');
        }

        Keranjang::create([
            'id_user' => Auth::user()->id,
            'id_produk' => $request->produk,
            'total' => $request->demo0,
        ]);

        return to_route('keranjang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $id;

        $alamat = Alamat::where('id_user', Auth::user()->id)
        ->orderBy('id_user_alamat', 'DESC')
        ->get();

        $keranjang = Keranjang::join('produk_tani', 'keranjang.id_produk', '=', 'produk_tani.id_produk')
        ->select('keranjang.*', 'produk_tani.*')
        ->where('keranjang.id_keranjang', $id)
        ->get();

        $variasi = Variasi::get();

        $semai = Semai::get();

        return view('customer.checkout.checkout', compact(['alamat','id','keranjang','variasi','semai']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if ($request->pembelian < 1) {
            return back()->with('error', 'Maaf Pembelian belum mendapatkan diskons');
        }

        Keranjang::where('id_keranjang', $id)->update([
            'total' => $request->pembelian
        ]);

        return back()->with('success', 'Berhasil Memperbaharui Banyak Pembelian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Keranjang::where('id_keranjang', $id)->delete();

        return to_route('keranjang.index')->with('success', 'Berhasil Menghapus Keranjang');
    }
}
