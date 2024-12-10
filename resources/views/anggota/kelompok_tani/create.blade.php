@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Tambah Kelompok Tani</h1>

    <form action="{{ route('kelompok_tani.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>Form Data Kelompok Tani</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
                    <input type="text" name="nama_kelompok" class="form-control" id="nama_kelompok" placeholder="Masukkan nama kelompok" required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan lokasi" required>
                </div>

                <div class="mb-3">
                    <label for="modal_gedung" class="form-label">Modal Gedung</label>
                    <input type="number" name="modal_gedung" class="form-control" id="modal_gedung" placeholder="Masukkan modal gedung" required>
                </div>

                <div class="mb-3">
                    <label for="modal_pupuk" class="form-label">Modal Awal Pupuk</label>
                    <input type="number" name="modal_pupuk" class="form-control" id="modal_pupuk" placeholder="Masukkan modal awal pupuk" required>
                </div>

                <div class="mb-3">
                    <label for="modal_bibit" class="form-label">Modal Awal Bibit</label>
                    <input type="number" name="modal_bibit" class="form-control" id="modal_bibit" placeholder="Masukkan modal awal bibit" required>
                </div>

                <div class="mb-3">
                    <label for="modal_alat_operasional" class="form-label">Modal Operasional</label>
                    <input type="number" name="modal_alat_operasional" class="form-control" id="modal_alat_operasional" placeholder="Masukkan modal operasional" required>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
<a href="{{ route('kelompok_tani.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>

            </div>
        </div>
    </form>
</div>
@endsection
