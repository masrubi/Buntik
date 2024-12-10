@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Hasil Panen</h4>
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
                            <h4 class="header-title">Daftar Hasil Panen</h4>
                            <p class="card-title-desc">Berikut adalah daftar hasil panen berdasarkan data pengelolaan tanaman.</p>

                            <div class="mb-3">
                                <a href="{{ route('admin.hasil_panen.create') }}" class="btn btn-success">
                                    <i class="mdi mdi-plus-circle"></i> Tambah Hasil Panen
                                </a>
                            </div>
                            
                            <div style="overflow-x: auto;">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pengelolaan Tanaman</th>
                                            <th>Kelompok Tani</th>
                                            <th>User</th>
                                            <th>Jumlah Panen (kg)</th>
                                            <th>Jumlah Terjual (kg)</th>
                                            <th>Jumlah Hibah (kg)</th>
                                            <th>Jumlah Sisa (kg)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasilPanen as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->pengelolaanTanaman->tanaman->nama_tanaman }}</td>
                                                <td>{{ $data->pengelolaanTanaman->kelompokTani->nama_kelompok }}</td>
                                                <td>{{ $data->user->nama }}</td>
                                                <td>{{ $data->jml_panen }}</td>
                                                <td>{{ $data->jml_jual }}</td>
                                                <td>{{ $data->jml_hibah }}</td>
                                                <td>{{ $data->jml_sisa }}</td>
                                                <td>
                                                    <a href="{{ route('admin.hasil_panen.edit', $data->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="mdi mdi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.hasil_panen.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="if(!confirm('Yakin ingin menghapus data ini?')) { return false; }">
                                                            <i class="mdi mdi-delete"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="/morvin/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/morvin/dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <style>
        .dataTables_wrapper {
            width: 100%;
            overflow-x: scroll;
        }

        .dataTables_scroll {
            overflow: auto;
        }
    </style>
       
    @endsection

@section('js')
    <script src="/morvin/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                scrollX: true,
                responsive: false,
                columnDefs: [
                    { targets: -1, orderable: false, width: "100%" }
                ]
            });
        });
    </script>
@endsection