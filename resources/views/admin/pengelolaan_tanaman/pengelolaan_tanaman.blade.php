@extends('admin.layouts.master')

@section('css')
    <link href="/morvin/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/morvin/dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/morvin/dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pengelolaan Tanaman</h4>
                        <a href="{{ route('admin.pengelolaan_tanaman.create') }}" class="btn btn-primary float-right">Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelompok Tani</th>
                                    <th>Tanaman</th>
                                    <th>Tanggal Tanam</th>
                                    <th>Tanggal Panen</th>
                                    <th>Jumlah Tanam</th>
                                    <th>Jumlah Pupuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengelolaanTanaman as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->kelompokTani->nama_kelompok }}</td>
                                        <td>{{ $data->tanaman->nama_tanaman }}</td>
                                        <td>{{ $data->tanggal_tanam }}</td>
                                        <td>{{ $data->tanggal_panen }}</td>
                                        <td>{{ $data->jml_tanam }}</td>
                                        <td>{{ $data->jml_pupuk }}</td>
                                        <td>
                                            <a href="{{ route('admin.pengelolaan_tanaman.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.pengelolaan_tanaman.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="if(!confirm('Yakin ingin menghapus data ini?')) { return false; }">Hapus</button>
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
@endsection

@section('css')
    <link href="/morvin/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/morvin/dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="/morvin/dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
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
