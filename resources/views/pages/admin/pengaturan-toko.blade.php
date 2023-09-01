@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Pengaturan Toko</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="col-sm-12">
                    <form action="{{ route('buat-toko.update', encrypt($dataToko->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="mb-3">
                                            <div class="row">
                                                <h5 class="text-center w-100 font-weight-bold mb-3">Toko Saya</h5>
                                                <div class="col-lg-12 d-flex justify-content-center align-items-center mb-3">
                                                @if(isset(Auth::user()->image))
                                                    <img class="img-profile rounded-circle" src="{{ Storage::url($dataToko->image ?? '') }}" style="max-width: 150px">
                                                    
                                                @else
                                                    <img class="img-profile" src="/images/defaul-profil.png" style="max-width: 150px">
                                                @endif
                                                </div>
                                                <div class="col-lg-8 mx-auto">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="customFile" name="image">
                                                        <label class="input-group-text" for="customFile">Pilih Foto</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Toko</label>
                                            <input type="text" class="form-control" id="name" name="nama_toko" value="{{ $dataToko->nama_toko }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email-input" class="form-label">Status Toko</label>
                                            <select name="stts_toko" class="form-control">
                                                <option value="0" @if($dataToko->stts_toko == 0) selected @endif>Toko Libur</option>
                                                <option value="1" @if($dataToko->stts_toko == 1) selected @endif>Toko Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 text-end">
                                    <button type="submit" class="btn bg-utama px-5">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection