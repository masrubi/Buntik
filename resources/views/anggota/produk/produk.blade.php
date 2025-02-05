@extends('anggota.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Produk Tani</h4>
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
                            @if (session('success'))
                                <div class="alert alert-success mb-3" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('delete'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('delete') }}
                                </div>
                            @endif
                            <a href="{{ route('anggota.produk.create') }}" class="btn btn-primary"><i class="mdi mdi-store-plus"></i> Tambah Produk Baru</a>
                            <div class="mt-3">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Kelompok Pengelola</th>
                                            <th>Stok (kg)</th>
                                            <th>Foto Produk</th>
                                            <th>Tanggal Upload</th>
                                            <th>
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produk as $data)
                                            <tr>
                                                <td><b>{{ $data->nama_produk }}</b></td>
                                                <td><i>{{ $data->jenis_kategori }}</i></td>
                                                <td><i>{{ $data->nama_kelompok ?? 'Tidak Ada' }}</i></td>
                                                <td><i>{{ $data->stok_produk }}</i> Kg</td>
                                                <td align="center">
                                                    <img src="/produk/{{ $data->foto_produk1 }}" alt="Foto Produk" height="50px" width="50px">
                                                </td>
                                                <td>{{ $data->created_at ? $data->created_at->format('d M Y') : '-' }}</td>

                                                <td align="center">
                                                    <a href="{{ route('anggota.produk.edit', $data->id_produk) }}" class="btn btn-warning btn-sm">
                                                        <i class="dripicons-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('anggota.produk.destroy', $data->id_produk) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Yakin akan Menghapus Produk Ini?');">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="dripicons-trash"></i> Hapus
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
    </div> <!-- container-fluid -->
@endsection

@section('css')
    <link href="/morvin/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/morvin/dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="/morvin/dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2500);
    </script>

    <!-- Required datatable js -->
    <script src="/morvin/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="/morvin/dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/morvin/dist/assets/libs/jszip/jszip.min.js"></script>
    <script src="/morvin/dist/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="/morvin/dist/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="/morvin/dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="/morvin/dist/assets/js/pages/datatables.init.js"></script>
@endsection
