@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection
@push('addon-style')
    <style>
        #gambar2-group {
            display: show;
        }
        #gambar3-group {
            display: show;
        }
        .row {
        display: flex;
        justify-content: center;
        }
    </style>
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Ubah Produk</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
                                <li class="breadcrumb-item active">Ubah Produk</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <h5 for="example-text-input" class="form-label text-center mb-3">Foto Produk</h5>
                                    @foreach ($item->galleries as $items)
                                    <div class="col-lg-2">
                                        <div class="position-relative text-center">
                                            {{--  Image  --}}
                                            <img src="{{ Storage::url($items->photos ?? '') }}" alt="" style="height: 70px; display: block; margin: 0 auto; padding-right:30px;" class="mx-auto">
                                            @if($item->galleries->count() > 1)
                                                {{--  Button Hapus Image  --}}
                                                <form action="{{ route('product-gallery.destroy', encrypt($items->id)) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger position-absolute top-0 float-end" style="margin-top:25px; margin-left:23px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            {{--  Button Edit Image  --}}
                                            <a href="" class="btn btn-sm btn-info position-absolute float-end top-0" style="margin-top:0px; margin-left:23px; padding:4px;" data-bs-toggle="modal" data-bs-target="#editImageModal{{ $items->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($item->galleries->count() < 3)
                                        <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                            <div class="mb-1 position-relative">
                                                {{--  Button Tambah Image  --}}
                                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahImageModal">
                                                Upload
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('product.update', encrypt($item->id)) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-text-input" class="form-label">Nama Produk</label>
                                                    <input class="form-control" type="text" value="{{ $item->name }}" name="name" id="example-text-input" autocomplete="off" >
                                                    @error('name')
                                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-url-input" class="form-label">Harga</label>
                                                    <input class="form-control" type="number" value="{{ $item->price }}" name="harga" id="example-number-input" autocomplete="off">
                                                    @error('harga')
                                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-email-input" class="form-label">Kategori Product</label>
                                                    <select name="categories_id" class="form-control">
                                                        @foreach ($categories as $categories)
                                                            <option value="{{ $categories->id }}" @if($categories->id == $item->categories_id) selected @endif>{{ $categories->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('categories_id')
                                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-url-input" class="form-label">Berat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" value="{{ $item->weigth }}" name="berat" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                        <span class="input-group-text" id="basic-addon2">gr</span>
                                                    </div>
                                                    @error('berat')
                                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="example-url-input" class="form-label">Stok</label>
                                                    <input class="form-control" type="number" value="{{ $item->stok }}" name="stok" id="example-number-input" autocomplete="off">
                                                    @error('stok')
                                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <label for="floatingTextarea">Deskripsi</label>
                                                    <textarea class="form-control" name="description" id="floatingTextarea">{{ $item->description }}</textarea>
                                                    @error('description')
                                                        <div class="text-danger fw-bolder text-center">{{ $message }}</div>
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
                                            <div class="mt-4">
                                                <a href="{{ route('product.index') }}" class="btn btn-secondary px-5">
                                                    <i class="mdi mdi-arrow-left"></i> Back
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-4">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <button type="submit" class="btn bg-utama px-5">
                                                    <i class="mdi mdi-content-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div> 
            </div>

        </div>
    </div>

    @foreach ($item->galleries as $items)
        <!-- Modal Edit Foto Produk -->
        <div class="modal fade" id="editImageModal{{ $items->id }}" tabindex="-1" aria-labelledby="editImageModal{{ $items->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editImageModal{{ $items->id }}Label">Ubah Foto Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('product-gallery.edit', encrypt($items->id)) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('GET')
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 text-center">
                                    <label for="example-text-input" class="form-label mb-3">Sebelum</label>
                                    <div class="position-relative">
                                        <img src="{{ Storage::url($items->photos ?? '') }}" alt="" style="height: 80px; display: block; margin: 0 auto;" class="img-thumbnail mx-auto">
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <label for="example-text-input" class="form-label mb-3">Sesudah</label>
                                    <div class="position-relative">
                                        <img id="preview{{ $loop->iteration }}" class="img-thumbnail" style="display: none; height: 80px;">
                                        <input type="file" class="custom-file-input" id="gambar{{ $loop->iteration }}" name="photos" onchange="previewImage(this)" accept="image/*" style="display: none;">
                                        <br>
                                        <label for="gambar{{ $loop->iteration }}" class="btn btn-primary" style="margin:5px;">Upload</label>
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-1" style="margin:5px;display:none;" id="hapus1" onclick="hapusGambar(1)"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-utama">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

        <!-- Modal Tambah Foto Produk -->
        <div class="modal fade" id="tambahImageModal" tabindex="-1" aria-labelledby="tambahImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahImageModalLabel">Tambah Foto Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('product-gallery.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idProduk" value="{{ $item->id }}">
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 text-center">
                                    <label for="example-text-input" class="form-label mb-3">Foto Produk</label>
                                    <div class="position-relative">
                                        <img id="preview" class="img-thumbnail" style="display: none; height: 80px;">
                                        <input type="file" class="custom-file-input" id="gambar" name="photos[]" onchange="previewImage(this)" accept="image/*" style="display: none;">
                                        <br>
                                        <label for="gambar" class="btn btn-primary" style="margin:5px;">Upload</label>
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-1" style="margin:5px;display:none;" id="hapus1" onclick="hapusGambar(1)"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-utama">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

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