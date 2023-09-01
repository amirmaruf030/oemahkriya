@extends('layouts.app')

@section('title')
    Ubah Alamat
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <div class="container">
            <div id="content" class="d-none d-sm-inline my-5">
                @include('includes.sidebar-dashboard-transaksi')
                <div id="products">
                    <div class="row mx-0">
                        <div class="col-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Ubah Alamat</h1>
                            </div>
                            <form id="locations" action="{{ route('dashboard-proses-edit-alamat') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                        <input type="hidden" name="idAlamat" value="{{ $alamat->id }}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $alamat->nama }}" placeholder="Nama" />
                                                    @error('nama')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_telp">Nomor Telepon</label>
                                                    <input type="no_telp" class="form-control" name="no_telp" value="{{ $alamat->no_telp }}" placeholder="No Telepon" />
                                                    @error('no_telp')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control" name="provinces_id"
                                                        required="required">
                                                        <option value="0">-- pilih provinsi --</option>
                                                        <option selected value="{{ $alamat->provinces_id }}" >{{ $alamat->provinsi }}</option>
                                                        @foreach ($provinces as $province => $value)
                                                            <option value="{{ $province }}" >{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('provinces_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kota/ Kabupaten</label>
                                                    <select class="form-control" name="city_id" required="required">
                                                        <option value="">-- pilih kota --</option>
                                                        <option value="{{ $alamat->city_id }}" selected>{{ $alamat->kota }}</option>
                                                    </select>
                                                    @error('city_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select class="form-control" name="kecamatan" required="required">
                                                        <option value="">-- pilih Kecamatan --</option>
                                                        <option value="{{ $alamat->subdistrict_id }}" selected>{{ $alamat->kecamatan }}</option>
                                                    </select>
                                                    @error('kecamatan')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="detail_alamat">Detail Alamat</label>
                                                    <textarea class="form-control" name="detail_alamat" cols="30" rows="3"
                                                        placeholder="Detail Alamat">{{ $alamat->detail_alamat }}</textarea>
                                                    @error('detail_alamat')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="kode_pos">Kode Pos</label>
                                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $alamat->kode_pos }}"
                                                        placeholder="Kode Pos" />
                                                    @error('kode_pos')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-shopee px-5">
                                                Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 d-sm-none" style="padding-left:0; padding-right:0;">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="#" class="text-dark" style="text-decoration: underline;" onclick="window.history.back();"><i class="fas fa-chevron-left"></i> Kembali</a>
                            <span class="font-weight-bold float-right mr-4">Ubah Alamat</span>
                        </div>
                    </div>
                    <form id="locations" action="{{ route('dashboard-proses-edit-alamat') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idAlamat" value="{{ $alamat->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $alamat->nama }}" placeholder="Nama" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="no_telp" class="form-control" name="no_telp" value="{{ $alamat->no_telp }}" placeholder="No Telepon" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-control" name="provinces_id"
                                            required="required">
                                            <option value="0">-- pilih provinsi --</option>
                                            <option selected disabled>{{ $alamat->provinsi }}</option>
                                            @foreach ($provinces as $province => $value)
                                                <option value="{{ $province }}" >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kota/ Kabupaten</label>
                                        <select class="form-control" name="city_id" required="required">
                                            <option value="">-- pilih kota --</option>
                                            <option selected disabled>{{ $alamat->kota }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-control" name="kecamatan" required="required">
                                            <option value="">-- pilih Kecamatan --</option>
                                            <option selected disabled>{{ $alamat->kecamatan }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="detail_alamat">Detail Alamat</label>
                                        <textarea class="form-control" name="detail_alamat" cols="30" rows="3"
                                            placeholder="Detail Alamat">{{ $alamat->detail_alamat }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $alamat->kode_pos }}"
                                            placeholder="Kode Pos" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
                                    Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    
        //ajax select kota
        $('select[name="provinces_id"]').on('change', function() {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append(
                            '<option value="">-- pilih kota --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="city_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_id"]').append(
                    '<option value="">-- pilih kota --</option>');
            }
        });

        //ajax select kecamatan
        $('select[name="city_id"]').on('change', function() {
            let citiesId = $(this).val();
            if (citiesId) {
                jQuery.ajax({
                    url: '/subdistrict/' + citiesId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('select[name="kecamatan"]').empty();
                        $('select[name="kecamatan"]').append(
                            '<option value="">-- pilih kecamatan --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="kecamatan"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                $('select[name="kecamatan"]').append(
                    '<option value="">-- pilih kecamatan --</option>');
            }
        });


    </script>
@endsection
