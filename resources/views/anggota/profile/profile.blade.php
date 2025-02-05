@extends('anggota.layouts.master')

@section('content')
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4>My Profile</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="page-content-wrapper">
        <div class="row">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <center>
                                @if (Auth::user()->foto_profile == null)
                                <img class="rounded-circle avatar-xl" alt="200x200" src="/buntik/default.jpg"
                                    data-holder-rendered="true">
                                @else
                                <img class="rounded-circle avatar-xl" alt="200x200"
                                    src="/foto_profile/{{ Auth::user()->foto_profile }}" data-holder-rendered="true">
                                @endif
                            </center>
                        </div>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myModal">Ganti
                            Foto Profile</button>
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('anggota.profile_store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Masukan Foto :</label>
                                                    <input type="file" name="img1" class="form-control" accept="image/*"
                                                        id="imgInp1">
                                                </div>
                                                <div class="col-md-3">
                                                    <img id="output1" src="/morvin/dist/assets/images/upload.png"
                                                        width="150px" height="110px" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Ubah
                                                Foto Profile</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('anggota.profile_update', Auth::user()->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <!-- Update Profile Section -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                                        <input class="form-control @error('nama') is-invalid @enderror" name="nama"
                                            type="text" placeholder="Nama Lengkap" id="example-text-input"
                                            value="{{ Str::title(Auth::user()->nama) }}">
                                        @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Email Pengguna</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            type="email" placeholder="Email Pengguna" id="example-text-input"
                                            value="{{ Str::title(Auth::user()->email) }}">
                                        @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Password Pengguna /<span
                                                class="text-danger">* Kosongkan Kalau Tidak Merubah
                                                Password</span></label>
                                        <input class="form-control" name="password" type="password"
                                            placeholder="Password Pengguna" id="example-text-input" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary w-100">Perbaharui Profile</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <!-- Update Kelompok Tani Section -->
                        <form action="{{ route('anggota.profile', Auth::user()->id) }}" method="post">
                            @csrf
                            @method('put')
                            <h4 class="mt-4">Data Kelompok Tani</h4>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
                                    <input class="form-control @error('nama_kelompok') is-invalid @enderror"
                                        name="nama_kelompok" type="text" placeholder="Nama Kelompok" id="nama_kelompok"
                                        value="{{ old('nama_kelompok', $kelompokTani->nama_kelompok ?? '') }}" required>
                                    @error('nama_kelompok')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-control @error('id_provinsi') is-invalid @enderror"
                                        name="id_provinsi" id="provinsi" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $prov)
                                        <option value="{{ $prov->id }}" {{ isset($kelompokTani) && $kelompokTani->
                                            id_provinsi == $prov->id ? 'selected' : '' }}>
                                            {{ $prov->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_provinsi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> -->
                            <!-- Provinsi -->
                            <div class="col-md-6">
                                <label for="provinsi">Pilih Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-control">
                                    <option value="" selected disabled>Pilih Provinsi</option>
                                    @foreach($provinsi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kabupaten -->
                            <div class="col-md-6">
                                <label for="kabupaten">Pilih Kabupaten</label>
                                <select id="kabupaten" name="kabupaten" class="form-control" disabled>
                                    <option value="" selected disabled>Pilih Kabupaten</option>
                                </select>
                            </div>

                            <!-- Kecamatan -->
                            <div class="col-md-6">
                                <label for="kecamatan">Pilih Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control" disabled>
                                    <option value="" selected disabled>Pilih Kecamatan</option>
                                </select>
                            </div>

                            <!-- Desa -->
                            <div class="col-md-6">
                                <label for="desa">Pilih Desa</label>
                                <select id="desa" name="desa" class="form-control" disabled>
                                    <option value="" selected disabled>Pilih Desa</option>
                                </select>
                            </div>
                    </div>


                    </form>
                </div>


                <!-- Alamat -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="5"
                            class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Tulis alamat lengkap"></textarea>
                        @error('alamat')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('js')
<script>
    imgInp1.onchange = evt => {
        const [file] = imgInp1.files
        if (file) {
            output1.src = URL.createObjectURL(file)
        }
    }

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2500);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
<script src="/morvin/dist/assets/js/app.js"></script>

<script src="/morvin/dist/assets/libs/select2/js/select2.min.js"></script>
<script src="/morvin/dist/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/morvin/dist/assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/morvin/dist/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/morvin/dist/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<script src="/morvin/dist/assets/js/pages/form-advanced.init.js"></script>
<script>
    $(document).ready(function () {
        // Ketika provinsi dipilih
        $('#provinsi').change(function () {

            var provinsiId = $(this).val();
            // console.log(provinsiId);  // Cek apakah provinsiId terambil dengan benar

            if (provinsiId) {
                // Ambil data kabupaten berdasarkan provinsiId
                $.ajax({
                    url: '/api/kabupaten/' + provinsiId,  // URL sesuai dengan route Anda
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data); // Cek data yang diterima dari server
                        $('#kabupaten').html('<option value="" selected disabled>Pilih Kabupaten</option>');
                        $.each(data.kabupaten, function (index, item) {
                            $('#kabupaten').append('<option value="' + item.id + '">' + item.nama + '</option>');
                        });
                        $('#kabupaten').prop('disabled', false);  // Enable dropdown kabupaten setelah data diterima
                    },
                    error: function () {
                        alert('Gagal mengambil data kabupaten.');
                    }
                });
            }
        });

        // Ketika kabupaten dipilih
        $('#kabupaten').change(function () {
            var kabupatenId = $(this).val();

            if (kabupatenId) {
                // Ambil data kecamatan berdasarkan kabupatenId
                $.ajax({
                    url: '/api/kecamatan/' + kabupatenId,  // URL sesuai dengan route Anda
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data); // Cek data yang diterima dari server
                        $('#kecamatan').html('<option value="" selected disabled>Pilih Kecamatan</option>');
                        $.each(data.kecamatan, function (index, item) {
                            $('#kecamatan').append('<option value="' + item.id + '">' + item.nama + '</option>');
                        });
                        $('#kecamatan').prop('disabled', false);  // Enable dropdown kecamatan setelah data diterima
                    },
                    error: function () {
                        alert('Gagal mengambil data kecamatan.');
                    }
                });
            }
        });

        // Ketika kecamatan dipilih
        $('#kecamatan').change(function () {
            var kecamatanId = $(this).val();

            if (kecamatanId) {
                // Ambil data desa berdasarkan kecamatanId
                $.ajax({
                    url: '/api/desa/' + kecamatanId,  // URL sesuai dengan route Anda
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data); // Cek data yang diterima dari server
                        $('#desa').html('<option value="" selected disabled>Pilih Desa</option>');
                        $.each(data.desa, function (index, item) {
                            $('#desa').append('<option value="' + item.id + '">' + item.nama + '</option>');
                        });
                        $('#desa').prop('disabled', false);  // Enable dropdown desa setelah data diterima
                    },
                    error: function () {
                        alert('Gagal mengambil data desa.');
                    }
                });
            }
        });
    });

</script>
@endsection