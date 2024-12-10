<!-- resources/views/hasil_panen/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Hasil Panen</h2>
    <form action="{{ route('hasil_panen.update', $hasilPanen->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="pengelolaan_tanaman_id">Pengelolaan Tanaman</label>
            <select name="pengelolaan_tanaman_id" id="pengelolaan_tanaman_id" class="form-control">
                <option value="">Pilih Pengelolaan Tanaman</option>
                @foreach($pengelolaanTanaman as $tanaman)
                    <option value="{{ $tanaman->id }}" {{ $tanaman->id == $hasilPanen->pengelolaan_tanaman_id ? 'selected' : '' }}>{{ $tanaman->nama_tanaman }}</option>
                @endforeach
            </select>
            @error('pengelolaan_tanaman_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_panen">Jumlah Panen</label>
            <input type="number" name="jumlah_panen" id="jumlah_panen" class="form-control" value="{{ $hasilPanen->jumlah_panen }}" required>
            @error('jumlah_panen') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_penjualan">Jumlah Penjualan</label>
            <input type="number" name="jumlah_penjualan" id="jumlah_penjualan" class="form-control" value="{{ $hasilPanen->jumlah_penjualan }}" required>
            @error('jumlah_penjualan') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_hibah">Jumlah Hibah</label>
            <input type="number" name="jumlah_hibah" id="jumlah_hibah" class="form-control" value="{{ $hasilPanen->jumlah_hibah }}" required>
            @error('jumlah_hibah') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_sisa">Jumlah Sisa</label>
            <input type="number" name="jumlah_sisa" id="jumlah_sisa" class="form-control" value="{{ $hasilPanen->jumlah_sisa }}" required>
            @error('jumlah_sisa') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
    </form>
</div>
@endsection
