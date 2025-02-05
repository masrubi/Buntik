<?php

namespace App\Http\Controllers\Anggota;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\HasilPanen;
use Illuminate\Http\Request;

class AnggotaProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $produk = Produk::join('kategori', 'produk_tani.kategori', '=', 'kategori.id_kategori')
        ->select('produk_tani.*','kategori.jenis_kategori')
        ->get();
       
        return view('anggota.produk.produk', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
        return view('anggota.produk.produk_create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'=>'required|unique:produk_tani,nama_produk',
            'pilih_kategori'=>'required',
            'deskripsi_produk'=>'required',
        ]);

        $harga = substr(preg_replace('/[Rp.,]/','',$request->harga_produk1), 0, -2);
        

        if ($request->hasFile('img1')) {
            $foto1 = $request->file('img1')->getClientOriginalName();
            $request->img1->move(public_path('produk'), $foto1);
        } else {
            $foto1 = $request->file('img1');
        }

        if ($request->hasFile('img2')) {
            $foto2 = $request->file('img2')->getClientOriginalName();
            $request->img2->move(public_path('produk'), $foto2);
        } else {
            $foto2 = $request->file('img2');
        }

        if ($request->hasFile('img3')) {
            $foto3 = $request->file('img3')->getClientOriginalName();
            $request->img3->move(public_path('produk'), $foto3);
        } else {
            $foto3 = $request->file('img3');
        }

        if ($request->hasFile('img4')) {
            $foto4 = $request->file('img4')->getClientOriginalName();
            $request->img4->move(public_path('produk'), $foto4);
        } else {
            $foto4 = $request->file('img4');
        }

        produk::create([
            'nama_produk'=>$request->nama_produk,
            'kategori'=>$request->pilih_kategori,
            'deskripsi'=>$request->deskripsi_produk,
            'harga_produk'=>$harga,
            'foto_produk1'=>$foto1,
            'foto_produk2'=>$foto2,
            'foto_produk3'=>$foto3,
            'foto_produk4'=>$foto4,
        ]);

       /* return to_route('anggota.produk.index')->with('success', 'Berhasil Menambahkan produk Baru');
       */

       if (auth()->user()->role === 'anggota') {
        return to_route('anggota.produk.index')->with('success', 'Berhasil menambahkan produk Baru');
    } elseif (auth()->user()->role === 'anggota') {
        return to_route('anggota.produk.index')->with('success', 'Berhasil menambahkan produk Baru');
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = produk::find($id);
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
        return view('anggota.produk.produk_edit', compact(['produk','kategori']));
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
            'nama_produk'=>'required',
            'pilih_kategori'=>'required',
            'deskripsi_produk'=>'required',
        ]);

        $harga = substr(preg_replace('/[Rp.,]/','',$request->harga_produk1), 0, -2);
       
        if ($request->hasFile('img1')) {
            $foto1 = $request->file('img1')->getClientOriginalName();
            $request->img1->move(public_path('produk'), $foto1);
        } else {
            $foto1 = $request->fileimg1;
        }

        if ($request->hasFile('img2')) {
            $foto2 = $request->file('img2')->getClientOriginalName();
            $request->img2->move(public_path('produk'), $foto2);
        } else {
            $foto2 = $request->fileimg2;
        }

        if ($request->hasFile('img3')) {
            $foto3 = $request->file('img3')->getClientOriginalName();
            $request->img3->move(public_path('produk'), $foto3);
        } else {
            $foto3 = $request->fileimg3;
        }

        if ($request->hasFile('img4')) {
            $foto4 = $request->file('img4')->getClientOriginalName();
            $request->img4->move(public_path('produk'), $foto4);
        } else {
            $foto4 = $request->fileimg4;
        }

        produk::where('id_produk', $id)->update([
            'nama_produk'=>$request->nama_produk,
            'kategori'=>$request->pilih_kategori,
            'deskripsi'=>$request->deskripsi_produk,
            'harga_produk'=>$harga,            
            'foto_produk1'=>$foto1,
            'foto_produk2'=>$foto2,
            'foto_produk3'=>$foto3,
            'foto_produk4'=>$foto4,
        ]);

        /* return to_route('produk.index')->with('success', 'Berhasil Memperbaharui produk Baru');
        */
        if (auth()->user()->role === 'anggota') {
            return to_route('anggota.produk.index')->with('success', 'Berhasil Memperbaharui produk Baru');
        } elseif (auth()->user()->role === 'anggota') {
            return to_route('anggota.produk.index')->with('success', 'Berhasil Memperbaharui produk Baru');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        produk::where('id_produk', $id)->delete();

        return back()->with('delete', 'Berhasil Menghapus produk');
    }
}
