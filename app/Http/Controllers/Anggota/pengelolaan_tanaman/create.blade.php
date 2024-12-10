@extends('layouts.app')

@section('title', 'Tambah Pengelolaan Tanaman')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Pengelolaan Tanaman</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengelolaan_tanaman.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kelompok_tani_id" class="form-label">Kelompok Tani</label>
                        <select name="kelompok_tani_id" id="kelompok_tani_id" class="form-select @error('kelompok_tani_id') is-invalid @enderror">
                            <option value="">Pilih Kelompok Tani</option>
                            @foreach($kelompokTani as $item)
                                <option value="{{ $item->id }}" {{ old('kelompok_tani_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_kelompok }}</option>
                            @endforeach
                        </select>
                        @error('kelompok_tani_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanaman_id" class="form-label">Tanaman</label>
                        <select name="tanaman_id" id="tanaman_id" class="form-select @error('tanaman_id') is-invalid @enderror">
                            <option value="">Pilih Tanaman</option>
                            @foreach($tanaman as $item)
                                <option value="{{ $item->id }}" {{ old('tanaman_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_tanaman }}</option>
                            @endforeach
                        </select>
                        @error('tanaman_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                        <input type="date" name="tanggal_tanam" id="tanggal_tanam" class="form-control @error('tanggal_tanam') is-invalid @enderror" value="{{ old('tanggal_tanam') }}">
                        @error('tanggal_tanam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_panen" class="form-label">Tanggal Panen</label>
                        <input type="date" name="tanggal_panen" id="tanggal_panen" class="form-control @error('tanggal_panen') is-invalid @enderror" value="{{ old('tanggal_panen') }}">
                        @error('tanggal_panen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jumlah_panen" class="form-label">Jumlah Panen</label>
                        <input type="number" name="jumlah_panen" id="jumlah_panen" class="form-control @error('jumlah_panen') is-invalid @enderror" value="{{ old('jumlah_panen') }}">
                        @error('jumlah_panen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="jumlah_pupuk" class="form-label">Jumlah Pupuk</label>
                        <input type="number" name="jumlah_pupuk" id="jumlah_pupuk" class="form-control @error('jumlah_pupuk') is-invalid @enderror" value="{{ old('jumlah_pupuk') }}">
                        @error('jumlah_pupuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('pengelolaan_tanaman.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
