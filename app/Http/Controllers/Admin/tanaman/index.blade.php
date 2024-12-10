@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Tanaman</h1>
    <a href="{{ route('tanaman.create') }}" class="btn btn-primary mb-3">Tambah Tanaman</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Tanaman</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tanaman as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->nama_tanaman }}</td>
                <td>{{ $t->deskripsi }}</td>
                <td>
                    <a href="{{ route('tanaman.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tanaman.destroy', $t->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data tanaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $tanaman->links() }}
</div>
@endsection

