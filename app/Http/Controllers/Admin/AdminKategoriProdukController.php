<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminKategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::latest()->paginate(4);
        return view('admin.kategori.kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'kategori'=>'required|unique:kategori,jenis_kategori'
        ]);

        Kategori::create([
            'jenis_kategori'=>$request->kategori,
        ]);

        return back()->with('success', 'Berhasil Membuat Kategori Baru');
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
        $update = Kategori::find($id);
        $kategori = Kategori::latest()->paginate(4);

        return view('admin.kategori.kategori_edit', compact(['update','kategori']));
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
            'kategori'=>'required'
        ]);

        Kategori::where('id_kategori', $id)->update([
            'jenis_kategori'=>$request->kategori,
        ]);

        /*return to_route('kategori.index')->with('success', 'Berhasil Perbaharaui Kategori');
        */

        if (auth()->user()->role === 'admin') {
            return to_route('admin.kategori.index')->with('success', 'Berhasil Memperbaharui produk Baru');
        } elseif (auth()->user()->role === 'anggota') {
            return to_route('anggota.kategori.index')->with('success', 'Berhasil Memperbaharui produk Baru');
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
        Kategori::where('id_kategori', $id)->delete();

        return to_route('kategori.index')->with('delete', 'Berhasil Menghapus Kategori');
    }
}
