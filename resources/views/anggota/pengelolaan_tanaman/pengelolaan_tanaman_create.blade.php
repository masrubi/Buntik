@extends('anggota.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Tambah Pengelolaan Tanaman</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Form Tambah Pengelolaan Tanaman</h4>
                            <p class="card-title-desc">Pastikan data yang dimasukkan sesuai untuk pengelolaan tanaman yang efektif.</p>

                            <form action="{{ route('anggota.pengelolaan_tanaman.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="kelompok_tani" class="form-label">Kelompok Tani</label>
                                    <select class="form-control select2 @error('kelompok_tani_id') is-invalid @enderror" name="kelompok_tani_id">
                                        <option selected disabled value="">--- Pilih Kelompok Tani ---</option>
                                        @foreach ($kelompokTani as $data)
                                            <option value="{{ $data->id }}">
                                                {{ Str::upper($data->nama_kelompok) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelompok_tani_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanaman" class="form-label">Tanaman</label>
                                    <select class="form-control select2 @error('tanaman_id') is-invalid @enderror" name="tanaman_id">
                                        <option selected disabled value="">--- Pilih Tanaman ---</option>
                                        @foreach ($tanaman as $data)
                                            <option value="{{ $data->id }}">
                                                {{ Str::upper($data->nama_tanaman) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tanaman_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                                    <input type="date" class="form-control @error('tanggal_tanam') is-invalid @enderror" name="tanggal_tanam" value="{{ old('tanggal_tanam') }}">
                                    @error('tanggal_tanam')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_panen" class="form-label">Perkiraan Tanggal Panen</label>
                                    <input type="date" class="form-control @error('tanggal_panen') is-invalid @enderror" name="tanggal_panen" value="{{ old('tanggal_panen') }}">
                                    @error('tanggal_panen')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jml_tanam" class="form-label">Jumlah Tanam (batang)</label>
                                    <input type="number" class="form-control @error('jml_tanam') is-invalid @enderror" name="jml_tanam" value="{{ old('jml_tanam') }}" step="0.01">
                                    @error('jml_tanam')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jml_pupuk" class="form-label">Jumlah Pupuk (kg)</label>
                                    <input type="number" class="form-control @error('jml_pupuk') is-invalid @enderror" name="jml_pupuk" value="{{ old('jml_pupuk') }}" step="0.01">
                                    @error('jml_pupuk')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100"><i class="mdi mdi-content-save"></i> Tambah Pengelolaan Tanaman</button>
                                </div>
                                <a href="{{ route('anggota.pengelolaan_tanaman.index') }}" class="btn btn-danger w-100">
                                    <i class="mdi mdi-arrow-left"></i> Batal
                                </a>
                            </form>

                            <!-- Tombol Batal -->
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection

@section('css')
    <link href="/morvin/dist/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="/morvin/dist/assets/libs/select2/js/select2.min.js"></script>
    <script src="/morvin/dist/assets/js/pages/form-advanced.init.js"></script>
@endsection
