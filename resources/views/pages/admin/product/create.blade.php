@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection
@push('addon-style')
    <style>
        #gambar2-group {
        display: none;
        }
        #gambar3-group {
        display: none;
        }
    </style>
@endpush
@push('addon-script')
    <!-- ckeditor -->
    <script src="/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <!-- init js -->
    <script src="/assets/js/pages/form-editor.init.js"></script>
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tambah Produk Baru</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
                                <li class="breadcrumb-item active">Tambah Produk Baru</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <label for="example-text-input" class="form-label text-center mb-3">Foto Produk</label>
                                    <div class="col-lg-2">
                                        <div class="mb-1 position-relative">
                                            <img id="preview1" class="img-thumbnail" style="display: none; height: 80px;">
                                            <input type="file" class="custom-file-input" id="gambar1" name="photos[]" onchange="previewImage(this)" accept="image/*" style="display: none;">
                                            <br>
                                            <label for="gambar1" class="btn btn-primary" style="margin:5px;">Upload</label>
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-1" style="margin:5px;display:none;" id="hapus1" onclick="hapusGambar(1)"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-1 position-relative" id="gambar2-group" style="display: none;">
                                            <img id="preview2" class="img-thumbnail" style="display: none; height: 80px;">
                                            <input type="file" class="custom-file-input" id="gambar2" name="photos[]" onchange="previewImage(this)" accept="image/*" style="display: none;">
                                            <br>
                                            <label for="gambar2" class="btn btn-primary" style="margin:5px;">Upload</label>
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-1" style="margin:5px;display:none;" id="hapus2" onclick="hapusGambar(2)"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-1 position-relative" id="gambar3-group" style="display: none;">
                                            <img id="preview3" class="img-thumbnail" style="display: none; height: 80px;">
                                            <input type="file" class="custom-file-input" id="gambar3" name="photos[]" onchange="previewImage(this)" accept="image/*" style="display: none;">
                                            <br>
                                            <label for="gambar3" class="btn btn-primary" style="margin:5px;">Upload</label>
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-1" style="margin:5px;display:none;" id="hapus3" onclick="hapusGambar(3)"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    @error('photos')
                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-text-input" class="form-label">Nama Produk</label>
                                                    <input class="form-control" type="text" value="{{ old('name') }}" name="name" id="example-text-input" autocomplete="off">
                                                    @error('name')
                                                        <div class="text-danger fw-bolder">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-url-input" class="form-label">Harga</label>
                                                    <input class="form-control" type="number" value="{{ old('harga') }}" name="harga" id="example-number-input" autocomplete="off">
                                                    @error('harga')
                                                        <div class="text-danger fw-bolder">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-email-input" class="form-label">Kategori Product</label>
                                                    <select name="categories_id" class="form-control">
                                                        @foreach ($categories as $categories)
                                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('categories_id')
                                                        <div class="text-danger fw-bolder">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-url-input" class="form-label">Berat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" value="{{ old('berat') }}" name="berat" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                        <span class="input-group-text" id="basic-addon2">gr</span>
                                                    </div>
                                                    @error('berat')
                                                        <div class="text-danger fw-bolder">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-url-input" class="form-label">Stok</label>
                                                    <input class="form-control" type="number" value="{{ old('stok') }}" name="stok" id="example-number-input" autocomplete="off">
                                                    @error('stok')
                                                        <div class="text-danger fw-bolder">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="floatingTextarea">Deskripsi</label>
                                                    <textarea class="form-control" name="description" id="floatingTextarea">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="text-danger fw-bolder">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mt-3">
                                                <a href="{{ route('product.index') }}" class="btn btn-secondary px-5">
                                                    <i class="mdi mdi-arrow-left"></i> Kembali
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-3">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-3">
                                                <button type="submit" class="btn bg-utama px-5">
                                                    <i class="mdi mdi-content-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewId = $(input).attr('id').replace('gambar', 'preview');
                $('#' + previewId).attr('src', e.target.result).show();
                var inputId = parseInt($(input).attr('id').replace('gambar', ''));
                $('#hapus' + inputId).show(); // menampilkan tombol hapus
            }
            reader.readAsDataURL(input.files[0]);

            var inputId = parseInt($(input).attr('id').replace('gambar', ''));
            if (inputId < 3) {
                var nextInputId = inputId + 1;
                $('#gambar' + nextInputId + '-group').show();
                $('#gambar' + nextInputId + '-group').show();
            }
        }
    }

    function hapusGambar(id) {
        $('#preview' + id).hide();
        $('#gambar' + id).val('');
        $('#hapus' + id).hide();
    }

    $(document).ready(function() {
        $('input[type="file"]').change(function() {
            previewImage(this);
        });
    });

</script>

@endsection
