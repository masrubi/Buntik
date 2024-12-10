<!-- resources/views/pengelolaan_tanaman/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengelolaan Tanaman</h2>
    <form action="{{ route('pengelolaan_tanaman.update', $pengelolaanTanaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kelompok_tani_id">Kelompok Tani</label>
            <select name="kelompok_tani_id" id="kelompok_tani_id" class="form-control">
                <option value="">Pilih Kelompok Tani</option>
                @foreach($kelompokTani as $kelompok)
                    <option value="{{ $kelompok->id }}" {{ $pengelolaanTanaman->kelompok_tani_id == $kelompok->id ? 'selected' : '' }}>
                        {{ $kelompok->nama_kelompok }}
                    </option>
                @endforeach
            </select>
            @error('kelompok_tani_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tanaman_id">Tanaman</label>
            <select name="tanaman_id" id="tanaman_id" class="form-control">
                <option value="">Pilih Tanaman</option>
                @foreach($tanaman as $tanam)
                    <option value="{{ $tanam->id }}" {{ $pengelolaanTanaman->tanaman_id == $tanam->id ? 'selected' : '' }}>
                        {{ $tanam->nama_tanaman }}
                    </option>
                @endforeach
            </select>
            @error('tanaman_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_tanam">Tanggal Tanam</label>
            <input type="date" name="tanggal_tanam" id="tanggal_tanam" class="form-control" value="{{ $pengelolaanTanaman->tanggal_tanam }}" required>
            @error('tanggal_tanam') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_panen">Tanggal Panen</label>
            <input type="date" name="tanggal_panen" id="tanggal_panen" class="form-control" value="{{ $pengelolaanTanaman->tanggal_panen }}" required>
            @error('tanggal_panen') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_panen">Jumlah Panen</label>
            <input type="number" name="jumlah_panen" id="jumlah_panen" class="form-control" value="{{ $pengelolaanTanaman->jumlah_panen }}" required>
            @error('jumlah_panen') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_pupuk">Jumlah Pupuk</label>
            <input type="number" name="jumlah_pupuk" id="jumlah_pupuk" class="form-control" value="{{ $pengelolaanTanaman->jumlah_pupuk }}" required>
            @error('jumlah_pupuk') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
    </form>
</div>
@endsection
