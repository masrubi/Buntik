@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Hapus Pengelolaan Tanaman</h4>
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
                            <h4 class="header-title">Konfirmasi Penghapusan Pengelolaan Tanaman</h4>
                            <p class="card-title-desc">Anda yakin ingin menghapus data berikut? Proses ini tidak dapat dibatalkan.</p>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Kelompok Tani</th>
                                        <td>{{ Str::upper($pengelolaanTanaman->kelompokTani->nama_kelompok) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanaman</th>
                                        <td>{{ Str::upper($pengelolaanTanaman->tanaman->nama_tanaman) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Tanam</th>
                                        <td>{{ $pengelolaanTanaman->tanggal_tanam }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Panen</th>
                                        <td>{{ $pengelolaanTanaman->tanggal_panen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Tanam (kg)</th>
                                        <td>{{ $pengelolaanTanaman->jml_tanam }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pupuk (kg)</th>
                                        <td>{{ $pengelolaanTanaman->jml_pupuk }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <form action="{{ route('admin.pengelolaan_tanaman.destroy', $pengelolaanTanaman->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-danger w-100"><i class="mdi mdi-delete"></i> Hapus</button>
                                </div>
                                <a href="{{ route('admin.pengelolaan_tanaman.index') }}" class="btn btn-secondary w-100">
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
