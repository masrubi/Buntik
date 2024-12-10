@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Data Tanaman</h1>
    <form action="{{ route('tanaman.update', $tanaman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
            <input type="text" class="form-control" id="nama_tanaman" name="nama_tanaman" value="{{ $tanaman->nama_tanaman }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $tanaman->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('tanaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
