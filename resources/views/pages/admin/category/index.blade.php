@extends('layouts.admin')

@section('title')
    Kategori
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Kategori</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-utama float-end mb-3" style="margin-right:20px;" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                                <i class="mdi mdi-plus-circle-outline"></i> Tambah Kategori Baru
                            </button>
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="bg-mid">
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Foto</th>
                                            <th>Slug</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                @foreach($kategori as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'. $item->photo) }}" alt="{{ $item->name }}" style="width: 70px" class="img-thumbnail">
                                            </td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDataModal{{ $item->id }}">
                                                    <i class="fa fa-pencil-alt"></i> Edit
                                                </button>
                                                <form action="{{ route('category.destroy', encrypt($item->id)) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataModalLabel">Tambah Kategori Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Nama Kategori</label>
                                            <input class="form-control" type="text" value="{{ old('name') }}"
                                                name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-url-input" class="form-label">Foto</label>
                                            <input class="form-control" type="file" value="" name="photo"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-utama"><i class="mdi mdi-content-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        @foreach($kategori as $item)
        <div class="modal fade" id="editDataModal{{ $item->id }}" tabindex="-1" aria-labelledby="editDataModal{{ $item->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataModal{{ $item->id }}Label">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('category.update', Crypt::encrypt($item->id)) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Nama Kategori</label>
                                        <input class="form-control" type="text" value="{{ $item->name }}"
                                            name="name" id="example-text-input" autocomplete="off" required>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 text-center">
                                            <label for="example-text-input" class="form-label mb-3">Sebelum</label>
                                            <div class="position-relative">
                                                <img src="{{ Storage::url($item->photo ?? '') }}" alt="" style="height: 80px; display: block; margin: 0 auto;" class="img-thumbnail mx-auto">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 text-center">
                                            <label for="example-text-input" class="form-label mb-3">Sesudah</label>
                                            <div class="position-relative">
                                                <img id="preview{{ $loop->iteration }}" class="img-thumbnail" style="display: none; height: 80px;">
                                                <input type="file" class="custom-file-input" id="gambar{{ $loop->iteration }}" name="photo" onchange="previewImage(this)" accept="image/*" style="display: none;">
                                                <br>
                                                <label for="gambar{{ $loop->iteration }}" class="btn btn-primary" style="margin:5px;">Upload</label>
                                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-1" style="margin:5px;display:none;" id="hapus1" onclick="hapusGambar(1)"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
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