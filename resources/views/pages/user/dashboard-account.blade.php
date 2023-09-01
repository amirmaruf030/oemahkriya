@extends('layouts.app')

@section('title')
    Akun Saya
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <div class="container">
            <div id="content" class="d-none d-sm-inline my-5">
                @include('includes.sidebar-dashboard-transaksi')
                <div id="products">
                    <div class="row mx-0">
                        <div class="col-sm-12" style="height: 57vh;">
                            <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                                <div class="row">
                                                    <p class="text-center w-100 font-weight-bold">Profil</p>
                                                    <div class="col-lg-12 d-flex justify-content-center align-items-center mb-3">
                                                        @if(isset(Auth::user()->image))
                                                            <img class="img-profile rounded-circle" src="{{ asset('storage/assets/profil/' . Auth::user()->image) }}" style="max-width: 150px">
                                                        @else
                                                            <img class="img-profile" src="/images/defaul-profil.png" style="max-width: 150px">
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-8 mx-auto">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                                            <label class="custom-file-label" for="customFile">Pilih Foto</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" />

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="username" class="form-control" id="username" name="username"
                                                    value="{{ $user->username }}" readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $user->email }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-11 text-right">
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
                <div class="">
                    <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                                        <div class="row">
                                            <p class="text-center w-100 font-weight-bold">Profil</p>
                                            <div class="col-lg-12 d-flex justify-content-center align-items-center mb-3">
                                                @if(isset(Auth::user()->image))
                                                    <img class="img-profile rounded-circle" src="{{ asset('storage/assets/profil/' . Auth::user()->image) }}" style="max-width: 150px">
                                                @else
                                                    <img class="img-profile" src="/images/defaul-profil.png" style="max-width: 150px">
                                                @endif
                                            </div>
                                            <div class="col-lg-8 mx-auto mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="image">
                                                    <label class="custom-file-label" for="customFile">Pilih Foto</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="username" class="form-control" id="username" name="username"
                                            value="{{ $user->username }}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11 text-right">
                                        <button type="submit" class="btn btn-success px-5">
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
@endsection
