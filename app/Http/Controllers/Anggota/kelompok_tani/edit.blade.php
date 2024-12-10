@extends('layouts.app')

@section('title', 'Edit Kelompok Tani')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Edit Kelompok Tani</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('kelompok_tani.update', $kelompokTani->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
                    <input type="text" name="nama_kelompok" id="nama_kelompok" class="form-control @error('nama_kelompok') is-invalid @enderror" value="{{ old('nama_kelompok', $kelompokTani->nama_kelompok) }}" required>
                    @error('nama_kelompok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $kelompokTani->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="modal_gedung" class="form-label">Modal Gedung</label>
                    <input type="number" step="0.01" name="modal_gedung" id="modal_gedung" class="form-control @error('modal_gedung') is-invalid @enderror" value="{{ old('modal_gedung', $kelompokTani->modal_gedung) }}" required>
                    @error('modal_gedung')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="modal_awal_pupuk" class="form-label">Modal Awal Pupuk</label>
                    <input type="number" step="0.01" name="modal_awal_pupuk" id="modal_awal_pupuk" class="form-control @error('modal_awal_pupuk') is-invalid @enderror" value="{{ old('modal_awal_pupuk', $kelompokTani->modal_awal_pupuk) }}" required>
                    @error('modal_awal_pupuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="modal_awal_bibit" class="form-label">Modal Awal Bibit</label>
                    <input type="number" step="0.01" name="modal_awal_bibit" id="modal_awal_bibit" class="form-control @error('modal_awal_bibit') is-invalid @enderror" value="{{ old('modal_awal_bibit', $kelompokTani->modal_awal_bibit) }}" required>
                    @error('modal_awal_bibit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="modal_operasional" class="form-label">Modal Operasional</label>
                    <input type="number" step="0.01" name="modal_operasional" id="modal_operasional" class="form-control @error('modal_operasional') is-invalid @enderror" value="{{ old('modal_operasional', $kelompokTani->modal_operasional) }}" required>
                    @error('modal_operasional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('kelompok_tani.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
