@extends('anggota.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Edit Hasil Panen</h4>
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
                            <h4 class="header-title">Form Edit Hasil Panen</h4>
                            <p class="card-title-desc">Perhatikan data yang diubah agar sesuai dengan kondisi sebenarnya.</p>

                            <form action="{{ route('anggota.hasil_panen.update', $hasilPanen->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="pengelolaan_tanaman_id" class="form-label">Pengelolaan Tanaman</label>
                                    <select class="form-control select2 @error('pengelolaan_tanaman_id') is-invalid @enderror" name="pengelolaan_tanaman_id">
                                        <option selected disabled value="">--- Pilih Pengelolaan Tanaman ---</option>
                                        @foreach ($pengelolaanTanaman as $data)
                                            <option value="{{ $data->id }}" {{ $hasilPanen->pengelolaan_tanaman_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->kelompokTani->nama_kelompok }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pengelolaan_tanaman_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                

                                <div class="mb-3">
                                    <label for="id_user" class="form-label">User</label>
                                    <select class="form-control select2 @error('id_user') is-invalid @enderror" name="id_user">
                                        <option selected disabled value="">--- Pilih User ---</option>
                                        @foreach ($pengelolaanTanaman as $data)
                                            <option value="{{ $data->user->id }}" {{ $hasilPanen->id_user == $data->user->id ? 'selected' : '' }}>
                                                {{ $data->user->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_user')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                

                                <div class="mb-3">
                                    <label for="jml_panen" class="form-label">Jumlah Panen (kg)</label>
                                    <input type="number" class="form-control @error('jml_panen') is-invalid @enderror" name="jml_panen" value="{{ $hasilPanen->jml_panen }}" step="0.01">
                                    @error('jml_panen')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jml_jual" class="form-label">Jumlah Terjual (kg)</label>
                                    <input type="number" class="form-control @error('jml_jual') is-invalid @enderror" name="jml_jual" value="{{ $hasilPanen->jml_jual }}" step="0.01">
                                    @error('jml_jual')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jml_hibah" class="form-label">Jumlah Hibah (kg)</label>
                                    <input type="number" class="form-control @error('jml_hibah') is-invalid @enderror" name="jml_hibah" value="{{ $hasilPanen->jml_hibah }}" step="0.01">
                                    @error('jml_hibah')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jml_sisa" class="form-label">Jumlah Sisa (kg)</label>
                                    <input type="number" class="form-control @error('jml_sisa') is-invalid @enderror" name="jml_sisa" value="{{ $hasilPanen->jml_sisa }}" step="0.01">
                                    @error('jml_sisa')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                    </button>
                                </div>

                                <a href="{{ route('anggota.hasil_panen.index') }}" class="btn btn-danger w-100">
                                    <i class="mdi mdi-arrow-left"></i> Batal
                                </a>
                            </form>
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
