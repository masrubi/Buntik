@extends('layouts.app')

@section('title', 'Tambah Hasil Panen')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Hasil Panen</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('hasil_panen.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pengelolaan_tanaman_id" class="form-label">Pengelolaan Tanaman</label>
                        <select name="pengelolaan_tanaman_id" id="pengelolaan_tanaman_id" class="form-select @error('pengelolaan_tanaman_id') is-invalid @enderror">
                            <option value="">Pilih Pengelolaan</option>
                            @foreach($pengelolaanTanaman as $item)
                                <option value="{{ $item->id }}" {{ old('pengelolaan_tanaman_id') == $item->id ? 'selected' : '' }}>{{ $item->tanaman->nama_tanaman }} - {{ $item->kelompokTani->nama_kelompok }}</option>
                            @endforeach
                        </select>
                        @error('pengelolaan_tanaman_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="jumlah_panen" class="form-label">Jumlah Panen</label>
                        <input type="number" name="jumlah_panen" id="jumlah_panen" class="form-control @error('jumlah_panen') is-invalid @enderror" value="{{ old('jumlah_panen') }}">
                        @error('jumlah_panen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jumlah_penjualan" class="form-label">Jumlah Penjualan</label>
                        <input type="number" name="jumlah_penjualan" id="jumlah_penjualan" class="form-control @error('jumlah_penjualan') is-invalid @enderror" value="{{ old('jumlah_penjualan') }}">
                        @error('jumlah_penjualan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jumlah_hibah" class="form-label">Jumlah Hibah</label>
                        <input type="number" name="jumlah_hibah" id="jumlah_hibah" class="form-control @error('jumlah_hibah') is-invalid @enderror" value="{{ old('jumlah_hibah') }}">
                        @error('jumlah_hibah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jumlah_sisa" class="form-label">Jumlah Sisa</label>
                        <input type="number" name="jumlah_sisa" id="jumlah_sisa" class="form-control @error('jumlah_sisa') is-invalid @enderror" value="{{ old('jumlah_sisa') }}">
                        @error('jumlah_sisa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('hasil_panen.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

