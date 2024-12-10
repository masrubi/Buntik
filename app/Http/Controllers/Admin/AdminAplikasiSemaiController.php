<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Semai;
use Illuminate\Http\Request;

class AdminAplikasiSemaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semai = Semai::latest()->paginate(4);
        return view('admin.semai.semai', compact('semai'));
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
        $request->validate([
            'semai'=>'required|unique:semai,jenis_semai',
            'harga_semai'=>'required',
        ]);

        $nilai_awal =  preg_replace('/[Rp.,]/','',$request->harga_semai);
        $harga = substr($nilai_awal, 0, -2);

        Semai::create([
            'jenis_semai'=>$request->semai,
            'harga_semai'=>$harga
        ]);

        return back()->with('success', 'Berhasil Menambahkan Aplikasi semai Baru');
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
        $update = Semai::find($id);
        $Semai = Semai::latest()->paginate(4);

        return view('admin.semai.semai_edit', compact(['update', 'Semai']));
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
            'semai'=>'required|unique:semai,jenis_semai',
            'harga_semai'=>'required',
        ]);

        $nilai_awal =  preg_replace('/[Rp.,]/','',$request->harga_semai);
        $harga = substr($nilai_awal, 0, -2);

        Semai::where('id_semai', $id)->update([
            'jenis_semai'=>$request->semai,
            'harga_semai'=>$harga
        ]);

        return to_route('semai.index')->with('success', 'Berhasil Menperbaharui Aplikasi Semai Baru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Semai::where('id_semai', $id)->delete();
        return to_route('semai.index')->with('delete', 'Berhasil Menghapus Aplikasi Semai');
    }
}
