<!-- resources/views/pengelolaan_tanaman/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Pengelolaan Tanaman</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pengelolaan_tanaman.create') }}" class="btn btn-primary mb-3">Tambah Pengelolaan Tanaman</a>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kelompok Tani</th>
                <th>Tanaman</th>
                <th>Tanggal Tanam</th>
                <th>Tanggal Panen</th>
                <th>Jumlah Panen</th>
                <th>Jumlah Pupuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengelolaanTanaman as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kelompokTani->nama_kelompok }}</td>
                    <td>{{ $item->tanaman->nama_tanaman }}</td>
                    <td>{{ $item->tanggal_tanam->format('d/m/Y') }}</td>
                    <td>{{ $item->tanggal_panen->format('d/m/Y') }}</td>
                    <td>{{ number_format($item->jumlah_panen, 2) }} kg</td>
                    <td>{{ number_format($item->jumlah_pupuk, 2) }} kg</td>
                    <td>
                        <a href="{{ route('pengelolaan-tanaman.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pengelolaan-tanaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
