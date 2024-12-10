@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Tambah Tanaman</h4>
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
                            <h4 class="header-title">Form Upload Tanaman Baru</h4>
                            <p class="card-title-desc">Perhatikan penulisan setiap tanaman agar dapat membuat konsumen nyaman
                                bertransaksi</p>

                            <form action="{{ route('admin.tanaman.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Nama Tanaman</label>
                                    <input
                                        class="form-control @error('nama_tanaman')
                                        is-invalid
                                    @enderror"
                                        name="nama_tanaman" type="text" placeholder="Sawi Hijau"
                                        id="example-text-input">
                                    @error('nama_tanaman')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Deskripsi Tanaman</label>
                                    <textarea 
                                        class="form-control @error('deskripsi') is-invalid @enderror" 
                                        id="elm1" 
                                        name="deskripsi" 
                                        rows="5">{{ old('deskripsi', $tanaman->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success w-100"><i class="mdi mdi-content-save"></i> Simpan Tanaman</button>
                                </div>
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
    <link href="/morvin/dist/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="/morvin/dist/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="/morvin/dist/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="/morvin/dist/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script>
        imgInp1.onchange = evt => {
            const [file] = imgInp1.files
            if (file) {
                output1.src = URL.createObjectURL(file)
            }
        }

        imgInp2.onchange = evt => {
            const [file] = imgInp2.files
            if (file) {
                output2.src = URL.createObjectURL(file)
            }
        }

        imgInp3.onchange = evt => {
            const [file] = imgInp3.files
            if (file) {
                output3.src = URL.createObjectURL(file)
            }
        }
        imgInp4.onchange = evt => {
            const [file] = imgInp4.files
            if (file) {
                output4.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script src="/morvin/dist/assets/libs/select2/js/select2.min.js"></script>
    <script src="/morvin/dist/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/morvin/dist/assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="/morvin/dist/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="/morvin/dist/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

    <script src="/morvin/dist/assets/libs/inputmask/jquery.inputmask.min.js"></script>

    <script src="/morvin/dist/assets/libs/tinymce/tinymce.min.js"></script>

    <!-- Summernote js -->
    <script src="/morvin/dist/assets/libs/summernote/summernote-bs4.min.js"></script>

    <!-- init js -->
    <script src="/morvin/dist/assets/js/pages/form-editor.init.js"></script>

    <!-- form mask init -->
    <script src="/morvin/dist/assets/js/pages/form-mask.init.js"></script>

    <script src="/morvin/dist/assets/js/pages/form-advanced.init.js"></script>
@endsection
