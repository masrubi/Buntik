@extends('layouts.app')

@section('title', 'Tambah Tanaman')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Tanaman</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tanaman.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                        <input type="text" name="nama_tanaman" id="nama_tanaman" class="form-control @error('nama_tanaman') is-invalid @enderror" value="{{ old('nama_tanaman') }}">
                        @error('nama_tanaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('tanaman.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection




