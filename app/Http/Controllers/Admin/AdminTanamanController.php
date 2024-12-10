<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class AdminTanamanController extends Controller
{
    public function index()
    {
        $tanaman = Tanaman::paginate(10);
        return view('admin.tanaman.tanaman', compact('tanaman'));
    }

    public function create()
    {
        return view('admin.tanaman.tanaman_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tanaman' => 'required',
            'deskripsi' => 'required',
        ]);

        // Hapus tag HTML dari deskripsi
        $validated['deskripsi'] = strip_tags($validated['deskripsi']);

        Tanaman::create($validated);

        return redirect()->route('admin.tanaman.index')->with('success', 'Data tanaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        return view('admin.tanaman.tanaman_edit', compact('tanaman'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_tanaman' => 'required',
            'deskripsi' => 'required',
        ]);

        // Hapus tag HTML dari deskripsi
        $validated['deskripsi'] = strip_tags($validated['deskripsi']);

        $tanaman = Tanaman::findOrFail($id);
        $tanaman->update($validated);

        // Redirect berdasarkan peran pengguna
        if (auth()->user()->role === 'admin') {
            return to_route('admin.tanaman.index')->with('success', 'Berhasil memperbaharui tanaman.');
        } elseif (auth()->user()->role === 'anggota') {
            return to_route('anggota.tanaman.index')->with('success', 'Berhasil memperbaharui tanaman.');
        }
    }

    public function destroy($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        $tanaman->delete();

        return redirect()->route('admin.tanaman.index')->with('success', 'Data tanaman berhasil dihapus.');
    }
}
