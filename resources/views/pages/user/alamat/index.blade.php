@extends('layouts.app')

@section('title')
    Alamat Saya
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <div class="container">
            <div id="content" class="d-none d-sm-inline my-5">
                @include('includes.sidebar-dashboard-transaksi')
                <div id="products">
                    <div class="row mx-0">
                        <div class="col-sm-12">
                            <div class="card shadow mb-2">
                                <div class="card-body text-center" style="padding-bottom:0;">
                                    <h4 class="float-left font-weight-bold">Alamat Saya</h4>
                                    <a href="{{ route('dashboard-tambah-alamat') }}"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mb-4">
                                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Alamat Baru
                                    </a>
                                </div>
                            </div>
                                                @forelse($alamat->alamat as $items)
                            <div class="card shadow">
                                <div class="card-body" style="padding-bottom:0;">
                                    <div class="">
                                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                    <tr class="table-borderless">
                                                        <td style="padding: 0;">
                                                            <span class="font-weight-bold">{{ $items->nama }}</span> | {{ $items->no_telp }} <br>
                                                            {{ $items->detail_alamat }}
                                                            <div class="float-right">
                                                                {{--  Button Hapus  --}}
                                                                @if($items->toko == 0 && $items->utama == 0)
                                                                    <form action="{{ route('dashboard-proses-hapus-alamat') }}" method="post" class="d-inline mb-3">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $items->id }}">
                                                                        @if($alamat->alamat->count() > 1)
                                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                                Hapus
                                                                            </button>
                                                                        @endif
                                                                    </form>
                                                                @endif
                                                                {{--  Button Ubah  --}}
                                                                <a href="{{ route('dashboard-edit-alamat', $items->id) }}"
                                                                class="btn btn-primary d-sm-inline-block btn-sm shadow-sm">
                                                                Ubah
                                                                </a>
                                                                {{--  Dropdown Button Lainnya  --}}
                                                                @if($items->utama == 0 || $alamat->shop && $items->toko == 0)
                                                                    <a href="" class="btn btn-secondary btn-sm" id="navbarDropdown" role="button" data-toggle="dropdown">
                                                                        Lainnya
                                                                    </a>
                                                                    <div class="dropdown-menu">
                                                                        {{--  Button Atur Sebagai Utama  --}}
                                                                        @if($items->utama == 0)
                                                                            <form class="mb-1" action="{{ route('dashboard-proses-alamat-utama') }}" method="POST">
                                                                            @csrf
                                                                                <input type="hidden" name="utama" value="{{ $items->id }}">
                                                                                <button type="submit" class="btn btn-block btn-dropdown btn-sm text-left">Atur sebagai utama</button>
                                                                            </form>
                                                                        @endif
                                                                        {{--  Button Jadikan Alamat Toko  --}}
                                                                        @if($alamat->shop && $items->toko == 0)
                                                                            <form action="{{ route('dashboard-proses-alamat-toko') }}" method="POST">
                                                                            @csrf
                                                                                <input type="hidden" name="toko" value="{{ $items->id }}">
                                                                                <button type="submit" class="btn btn-block btn-dropdown btn-sm text-left">Jadikan Alamat Toko</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <br>
                                                            {{ $items->kecamatan }}, {{ $items->kota }}, {{ $items->provinsi }}, {{ $items->kode_pos }}
                                                            <br>
                                                            @if($items->utama == 1)
                                                                <p class="border border-danger d-inline-block text-danger p-1 mt-2"> Utama </p>
                                                            @endif
                                                            @if($items->toko == 1)
                                                                <p class="border border-danger d-inline-block text-danger p-1 mt-2"> Alamat Toko </p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="mt-3" style="height: 42vh;">
                                    <div class="col-sm-12 text-center mb-3 mt-3">
                                        <span>Belum Ada Alamat</span>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 d-sm-none" style="padding-left:0; padding-right:0;">
                <div class="card shadow">
                    <div class="col-sm-12 text-center">
                            <span class="font-weight-bold">Alamat Saya</span>
                    </div>
                </div>
                @forelse($alamat->alamat as $items)
                    <div class="card shadow">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0" style="margin-bottom:0">
                            <tbody style="color: black;">
                            <tr class="table-borderless">
                                <td>
                                <span class="font-weight-bold">{{ $items->nama }}</span> | {{ $items->no_telp }} <span class="float-right shadow">
                                </span> <br>
                                {{ $items->detail_alamat }}
                                <br>
                                {{ $items->kecamatan }}, {{ $items->kota }}, {{ $items->provinsi }}, {{ $items->kode_pos }}
                                <br>
                                @if($items->utama == 1)
                                    <p class="border border-danger d-inline-block text-danger p-1 mt-2"> Utama </p>
                                @endif
                                @if($items->toko == 1)
                                    <p class="border border-danger d-inline-block text-danger p-1 mt-2"> Alamat Toko </p>
                                @endif
                            </tr>
                            <tr class="table-borderless">
                                <td>
                                    <div class="float-right">
                                        {{--  Button Hapus  --}}
                                        @if($items->toko == 0 && $items->utama == 0)
                                            <form action="{{ route('dashboard-proses-hapus-alamat') }}" method="post" class="d-inline mb-3">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $items->id }}">
                                                @if($alamat->alamat->count() > 1)
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                @endif
                                            </form>
                                        @endif
                                        {{--  Button Ubah  --}}
                                        <a href="{{ route('dashboard-edit-alamat', $items->id) }}"
                                        class="btn btn-primary d-sm-inline-block btn-sm shadow-sm">
                                        Ubah
                                        </a>
                                        {{--  Dropdown Button Lainnya  --}}
                                        @if($items->utama == 0 || $alamat->shop && $items->toko == 0)
                                            <a href="" class="btn btn-secondary btn-sm" id="navbarDropdown" role="button" data-toggle="dropdown">
                                                Lainnya
                                            </a>
                                            <div class="dropdown-menu mr-2">
                                                {{--  Button Atur Sebagai Utama  --}}
                                                @if($items->utama == 0)
                                                    <form class="mb-1" action="{{ route('dashboard-proses-alamat-utama') }}" method="POST">
                                                    @csrf
                                                        <input type="hidden" name="utama" value="{{ $items->id }}">
                                                        <button type="submit" class="btn btn-block btn-dropdown btn-sm text-left">Atur sebagai utama</button>
                                                    </form>
                                                @endif
                                                {{--  Button Jadikan Alamat Toko  --}}
                                                @if($alamat->shop && $items->toko == 0)
                                                    <form action="{{ route('dashboard-proses-alamat-toko') }}" method="POST">
                                                    @csrf
                                                        <input type="hidden" name="toko" value="{{ $items->id }}">
                                                        <button type="submit" class="btn btn-block btn-dropdown btn-sm text-left">Jadikan Alamat Toko</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @empty
                        <div class="col-sm-12 text-center mb-3 mt-3">
                                <span>Belum Ada Alamat</span>
                        </div>
                @endforelse
                <div class="card shadow">
                    <a href="{{ route('dashboard-tambah-alamat') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Alamat Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
