@extends('customer.layouts.master')

@section('content')
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4>Alamat Penerima</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Alamat Penerima</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="page-content-wrapper">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Form Alamat Penerima Barang</h5>
                <p class="card-title-desc">Isi dengan sesuai agar pengiriman tidak terkendala</p>
                <form action="{{ route('customer.alamat_checkout_store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_keranjang" value="{{ $alamat }}">

                    <div class="row">
                        <!-- Nama Lengkap -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap Penerima</label>
                                <input type="text" id="nama" name="nama" 
                                    class="form-control @error('nama') is-invalid @enderror" 
                                    placeholder="Nama Lengkap">
                                @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- No. Telp -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telp" class="form-label">No. Telp</label>
                                <input type="number" id="telp" name="telp" 
                                    class="form-control @error('telp') is-invalid @enderror" 
                                    placeholder="No. Telp">
                                @error('telp')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kode Pos -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="pos" class="form-label">Kode Pos</label>
                                <input type="number" id="pos" name="pos" 
                                    class="form-control @error('pos') is-invalid @enderror" 
                                    placeholder="Kode POS">
                                @error('pos')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="container-fluid">
                            <form action="{{ route('customer.alamat_checkout_store') }}" method="POST">
                                @csrf
                                <div class="row">
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
                        
                                    <!-- Kota -->
                                    <div class="col-md-6">
                                        <label for="kota">Pilih Kota</label>
                                        <select id="kota" name="kota" class="form-control" disabled>
                                            <option value="" selected disabled>Pilih Kota</option>
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

                        <!-- Submit Button -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100">Simpan Alamat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
    <link href="/morvin/dist/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/morvin/dist/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="/morvin/dist/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="/morvin/dist/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
<script src="/morvin/dist/assets/js/app.js"></script>

    <script src="/morvin/dist/assets/libs/select2/js/select2.min.js"></script>
    <script src="/morvin/dist/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/morvin/dist/assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="/morvin/dist/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="/morvin/dist/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

    <script src="/morvin/dist/assets/js/pages/form-advanced.init.js"></script>
@endsection

@section('scripts')

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const provinsi = document.getElementById('provinsi');
    const kota = document.getElementById('kota');
    const kecamatan = document.getElementById('kecamatan');
    const desa = document.getElementById('desa');

    // Fungsi untuk mengisi dropdown
    function fillDropdown(dropdown, data, placeholder) {
        dropdown.innerHTML = `<option value="" selected disabled>${placeholder}</option>`;
        data.forEach(item => {
            dropdown.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
        });
        dropdown.disabled = false;
    }

    // Event untuk Provinsi
    provinsi.addEventListener('change', function () {
        const provinsiId = this.value;
        kota.disabled = true;
        kecamatan.disabled = true;
        desa.disabled = true;
        fetch(`/get-kota/${provinsiId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data Kota:', data);
                fillDropdown(kota, data.kota, 'Pilih Kota/Kabupaten');
            })
            .catch(error => console.error('Error:', error));
    });

    // Event untuk Kota
    kota.addEventListener('change', function () {
        const kotaId = this.value;
        kecamatan.disabled = true;
        desa.disabled = true;
        fetch(`/get-kecamatan/${kotaId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data Kecamatan:', data);
                fillDropdown(kecamatan, data.kecamatan, 'Pilih Kecamatan');
            })
            .catch(error => console.error('Error:', error));
    });

    // Event untuk Kecamatan
    kecamatan.addEventListener('change', function () {
        const kecamatanId = this.value;
        desa.disabled = true;
        fetch(`/get-desa/${kecamatanId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data Desa:', data);
                fillDropdown(desa, data.desa, 'Pilih Desa');
            })
            .catch(error => console.error('Error:', error));
    });
});




</script>
@endsection