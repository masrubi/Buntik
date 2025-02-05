@extends('anggota.layouts.master')

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
                            <h4 class="header-title">Perbaharui Semai</h4>
                            <p class="card-title-desc"><code>Perhatikan Tulisan Dengan Baik dan Benar</code></p>
                            <form action="{{ Route ('anggota.semai.update', $update->id_semai) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <input
                                        class="form-control @error('semai')
                                        is-invalid
                                    @enderror"
                                        name="semai" value="{{ $update->jenis_semai }}" type="text" placeholder="Masukan Tipe semai"
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
                                        name="harga_semai" value="{{ $update->harga_semai }}"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'Rp. ', 'placeholder': '0'">
                                    @error('harga_semai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="btn btn-success waves-effect waves-light w-100">Perbaharui Data</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Data Semai</h4>
                            <p class="card-title-desc">Data Semai Produk - Produk yang di Pasarkan</p>

                            <div class="table-responsive">
                                <table class="table table-bordered border-danger mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Aplikasi semai</th>
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
                                        @foreach ($Semai as $data => $list)
                                            <tr>
                                                <td>{{ $list->jenis_semai }}</td>
                                                <td>
                                                    @php
                                                        echo rupiah($list->harga_semai)
                                                    @endphp

                                                    {{-- {{ echo rupiah($list->harga_semai) }}</td> --}}
                                                <td align="center">
                                                    <form action="{{ route('anggota.semai.destroy', $list->id_semai) }}" method="POST"
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection

@section('js')
    <!-- form mask -->
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
