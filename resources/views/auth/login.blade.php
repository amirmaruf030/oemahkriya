@extends('layouts.auth')
@section('title')
    Login Page
@endsection
@section('content')
    <div class="page-content page-auth">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="/images/login-placeholder2.png" alt="" class="w-50 mb-4 mb-lg-none" />
                    </div>
                    <div class="col-lg-5">
                        <h2>
                            Mendapatkan kerajinan berkualitas, menjadi lebih mudah
                        </h2>
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label>Email Address</label>
                                <input id="email" type="email"
                                    class="form-control w-75 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password"
                                    class="form-control w-75 @error('password') is-invalid @enderror" name="password"
                                     autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-shopee btn-block w-75 mt-4">
                                Masuk
                            </button>
                            <a href="{{ route('register') }}" class="btn btn-signup btn-block w-75 mt-2">
                                Registrasi
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
