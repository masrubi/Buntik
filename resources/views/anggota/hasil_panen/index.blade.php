<!-- resources/views/hasil_panen/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Hasil Panen</h2>
    <a href="{{ route('hasil_panen.create') }}" class="btn btn-primary mb-3">Tambah Hasil Panen</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pengelolaan Tanaman</th>
                <th>Jumlah Panen</th>
                <th>Jumlah Penjualan</th>
                <th>Jumlah Hibah</th>
                <th>Jumlah Sisa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilPanen as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pengelolaanTanaman->nama_tanaman }}</td>
                    <td>{{ $item->jumlah_panen }}</td>
                    <td>{{ $item->jumlah_penjualan }}</td>
                    <td>{{ $item->jumlah_hibah }}</td>
                    <td>{{ $item->jumlah_sisa }}</td>
                    <td>
                        <a href="{{ route('hasil-panen.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('hasil-panen.destroy', $item->id) }}" method="POST" style="display:inline;">
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
