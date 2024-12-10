@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Tambah Kelompok Tani</h4>
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
                            <h4 class="header-title">Form Tambah Kelompok Tani</h4>
                            <p class="card-title-desc">Perhatikan penulisan setiap kelompok tani agar data dapat disimpan dengan benar.</p>

                            <form action="{{ route('admin.kelompok_tani.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_kelompok" class="form-label">Nama Kelompok Tani</label>
                                    <input class="form-control @error('nama_kelompok') is-invalid @enderror" name="nama_kelompok" type="text" placeholder="Kelompok Tani ABC" id="nama_kelompok">
                                    @error('nama_kelompok')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" type="text" placeholder="Lokasi Kelompok Tani" id="lokasi">
                                    @error('lokasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success w-100"><i class="mdi mdi-content-save"></i> Simpan Kelompok Tani</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection
