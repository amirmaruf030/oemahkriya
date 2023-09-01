@extends('layouts.buat-toko')

@section('title')
    Store Dashboard
@endsection


@section('content')
    <link rel="stylesheet" href="https://unpkg.com/choices.js@9.0.0/public/assets/styles/choices.min.css">
    <!-- Section Content -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Toko Saya</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-8 mx-auto">
                            <div class="card card-h-100">
                                <div class="card-body bg-mid">
                                    <h5 class="card-title me-2 text-center text-white mb-3">Buat Toko Saya</h5>
                                    <form action="{{ route('buat-toko.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="form-group mb-1">
                                                    <label>Nama Toko</label>
                                                    <input type="text" class="form-control" name="nama_toko"/>

                                                    @error('nama_toko')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label>Alamat Toko</label>
                                                    <select id="alamat" name="alamat" class="form-control">
                                                        <option value="">-- Pilih Alamat Toko --</option>
                                                        @foreach ($alamat as $item)
                                                        <option value="{{ $item->id }}">{{$item->nama }}, {{$item->no_telp }} ,  {{$item->kecamatan }} | {{$item->kota }} | {{$item->provinsi }} | {{ $item->kode_pos }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('alamat')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="float-end fw-bolder"><a href="{{ route('dashboard-tambah-alamat') }}">Tambah Alamat Baru</a></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Logo Toko</label>
                                                    <input type="file" name="image" class="form-control" />
                                                    @error('image')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="submit" class="btn bg-utama px-5 float-end" style="background:#3645a8; color:#fff;">
                                                <i class="mdi mdi-content-save"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('addon-script')
    <script src="https://unpkg.com/choices.js@9.0.0/public/assets/scripts/choices.min.js"></script>
    <script>
        const select = new Choices('#alamat', {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false,
            choices: []
        });
    </script>
@endpush