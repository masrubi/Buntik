@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Semai Produk</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="container-fluid">
        <div class="page-content-wrapper">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h4 class="header-title">Buat Pesanan Semai</h4>
                            <p class="card-title-desc"><code>Perhatikan Tulisan Dengan Baik dan Benar</code></p>
                            <form action="{{ Route('admin.semai.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input
                                        class="form-control @error('semai')
                                        is-invalid
                                    @enderror"
                                        name="semai" type="text" placeholder="Masukan Tipe semai"
                                        id="example-text-input">
                                    @error('semai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input id="input-currency"
                                        class="form-control input-mask text-left @error('harga_semai')
                                    is-invalid
                                    @enderror"
                                        name="harga_semai"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'Rp. ', 'placeholder': '0'">
                                    @error('harga_semai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="btn btn-success waves-effect waves-light w-100">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            @if (session('delete'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('delete') }}
                                </div>
                            @endif
                            <h4 class="header-title">Data Aplikasi Semai</h4>
                            <p class="card-title-desc">Data Aplikasi Semai Produk - Produk yang di Pasarkan</p>

                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Jenis Semai</th>
                                            <th>Harga Semai</th>
                                            <th>
                                                <center>Action</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        function rupiah($angka)
                                        {
                                            $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
                                            return $hasil_rupiah;
                                        }
                                        @endphp
                                        @foreach ($semai as $data => $list)
                                            <tr>
                                                <td>{{ $list->jenis_semai }}</td>
                                                <td>
                                                    @php
                                                        echo rupiah($list->harga_semai)
                                                    @endphp

                                                    {{-- {{ echo rupiah($list->harga_semai) }}</td> --}}
                                                <td align="center">
                                                    <a href="{{ route('admin.semai.edit', $list->id_semai) }}"
                                                        class="btn btn-warning waves-effect waves-light"><i
                                                            class="dripicons-pencil"></i> Edit</a>
                                                    <form action="{{ route('admin.semai.destroy', $list->id_semai) }}" method="POST"
                                                        style="display:inline"
                                                        onsubmit="return confirm('Apakah Yakin akan Di Hapus ?');">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger waves-effect waves-light"><i
                                                                class="dripicons-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-felx justify-content-center mt-2">
                                {{ $semai->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection

@section('js')
    <script src="/morvin/dist/assets/libs/inputmask/jquery.inputmask.min.js"></script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2500);
    </script>

    <!-- form mask init -->
    <script src="/morvin/dist/assets/js/pages/form-mask.init.js"></script>
@endsection
