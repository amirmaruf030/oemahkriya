@extends('layouts.admin')

@section('title')
    Store Dashboard | Transaksi
@endsection
@push('addon-style')
    <style>
    .form-check-input:checked + .form-check-label {
    border: 2px solid #ee4d2d;
    }
    .form-check-input + .form-check-label {
    border: 1px solid lightgrey;
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
                    <h4 class="mb-sm-0 font-size-18">Transaksi</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            {{--  Desktop  --}}
            <div class="col-12 d-none d-sm-inline">
                @include('includes.navbar-transaksi-admin')
                <div class="card-header" style="padding-top:0;">
                    <div class="card-body">
                        <table class="table table-bordered border-3" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-mid">
                                    <th class="text-center align-middle" scope="col">Produk</th>
                                    <th class="text-center align-middle" scope="col">Total Pesanan</th>
                                    <th class="text-center align-middle" scope="col">Status</th>
                                    <th class="text-center align-middle" scope="col">Jasa Kirim</th>
                                    <th class="text-center align-middle" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            @forelse($dataTransaksi->sortByDesc('updated_at') as $transaksi)
                                <tbody>
                                    <tr class="bg-second">
                                        <th colspan="3" class="pt-2 pb-1">
                                        @if(isset($transaksi->user->image))
                                            <img class="img-profile rounded-circle border" src="{{ asset('storage/assets/profil/' . $transaksi->user->image) }}" style="max-width: 30px; ">
                                            
                                        @else
                                            <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px;">
                                        @endif
                                        {{ $transaksi->user->name }}</th>
                                        <th colspan="2" class="text-right">No. Pesanan {{ $transaksi->code }}</th>
                                    </tr>
                                    <tr style="color: black;">
                                        <td>
                                            @foreach($transaksi->transaction_detail as $dataProduk)
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3 mb-1">
                                                        <img src="{{ Storage::url($dataProduk->image ?? '') }}" alt="" style="width: 70px" class="img-thumbnail">
                                                    </div>
                                                    <div style="margin-left:5px;">
                                                        <div>{{ $dataProduk->nama_produk }}</div>
                                                        <div>x{{ $dataProduk->qty }}</div>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="text-end">Rp{{ number_format($dataProduk->price) }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-center align-middle">
                                            Rp{{ number_format($transaksi->total_price) }}
                                            <br>
                                            <span style="font-size: 15px; color: #858796;"><p>{{ $transaksi->payment_system }}</p></span>
                                        </td>
                                        <td class="text-center align-middle" style="font-weight: bold; color: black;">{{ $transaksi->transaction_status }}</td>
                                        <td class="text-center align-middle">
                                            <span style="display: inline-block; vertical-align: middle;">{{ strtoupper($transaksi->pengiriman->jasa_kirim) }}</span>
                                            <br>
                                            <span style="display: inline-block; vertical-align: middle;">Rp{{ number_format($transaksi->shipping_price) }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($transaksi->transaction_status == "MENUNGGU KONFIRMASI")
                                                {{--  Perlu Diproses  --}}
                                                <button type="button" class="btn btn-sm bg-utama mb-1" data-bs-toggle="modal" data-bs-target="#aturKonfirmasiPesananModal{{ $transaksi->id }}"> Atur Pesanan</button>
                                                <br>
                                            @elseif(($transaksi->transaction_status == "SEDANG DIPROSES" && $transaksi->payment_system == "Cash") || ($transaksi->transaction_status == "SEDANG DIPROSES" && $transaksi->payment_system == "DP" && isset($transaksi->tgl_byr_dp) && isset($transaksi->tgl_byr_tagihan)))
                                                {{--  Perlu Dikirim  --}}
                                                {{--  Button Atur Pengiriman  --}}
                                                <button type="button" class="btn btn-sm bg-utama mb-1" data-bs-toggle="modal" data-bs-target="#aturPengirimanModal{{ $transaksi->id }}">Atur Pengiriman</button>
                                                <br>
                                            @elseif($transaksi->transaction_status == "SEDANG DIPROSES" && $transaksi->payment_system == "DP" && isset($transaksi->tgl_byr_dp) && is_null($transaksi->tbl_byr_tagihan))
                                                {{--  Perlu Ditagih  --}}
                                                <button type="button" class="btn btn-sm bg-utama mb-1" data-bs-toggle="modal" data-bs-target="#aturPesananModal{{ $transaksi->id }}">Ajukan Tagihan</button>
                                                <br>
                                            @endif
                                            {{--  Button Periksa Rincian  --}}
                                            <a href="{{ route('transactions-details', encrypt($transaksi->id)) }}" class="btn btn-info btn-sm">Periksa Rincian</a>
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <tbody>
                                    <tr>
                                        <th colspan="5" class="text-center">
                                            Belum Ada Pesanan
                                        </th>
                                    </tr>
                                </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
            {{--  Mobile  --}}
            <div class="d-sm-none">
                @include('includes.dropdown-mobile-transaksi-admin')
                @forelse($dataTransaksi->sortByDesc('updated_at') as $transaksi)
                    <div class="card shadow">
                        <div class="card-body border" style="padding-bottom:0;">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="d-flex justify-content-between align-items-center" style="padding: 0;">
                                            <div>
                                                @if(isset($transaksi->user->image))
                                                    <img class="img-profile rounded-circle border" src="{{ asset('storage/assets/profil/' . $transaksi->user->image) }}" style="max-width: 30px; ">
                                                    
                                                @else
                                                    <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px;">
                                                @endif
                                                {{ $transaksi->user->name }}
                                            </div>
                                            <div class="text-danger">{{ $transaksi->transaction_status }}</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0;" class="d-flex justify-content-between align-items-end">
                                            <div class="d-flex">
                                                <img src="{{ Storage::url($transaksi->transaction_detail->first()->image ?? '') }}" alt="" style="width: 70px" class="img-thumbnail mr-3 my-2">
                                                <div class="d-flex flex-column" style="margin-left:8px;">
                                                    <span class="mt-3">{{ $transaksi->transaction_detail->first()->nama_produk }}</span>
                                                    <span class="small text-muted">x{{ $transaksi->transaction_detail->first()->qty }}</span>
                                                    <span class="small text-muted">Rp{{ number_format($transaksi->transaction_detail->first()->price) }}</span>
                                                </div>
                                            </div>
                                            <span class="small fw-bolder border p-1" style="align-self: flex-end;">Pengiriman : {{ strtoupper($transaksi->pengiriman->jasa_kirim) }} <br> <span class="">Rp{{ number_format($transaksi->shipping_price) }}</span></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0;" class="d-flex flex-column">
                                            <div class="clearfix">
                                                <hr>
                                                <span class="fs-6">{{ $transaksi->transaction_detail->count() }} produk</span>
                                                <span class="small fw-bolder" style="float:right;">NP. {{ $transaksi->code }}</span>
                                                <br>
                                                <span class="fs-6 text-muted" style="float:right;">Total Pesanan: <span class="fw-bolder">Rp{{ number_format($transaksi->total_price) }}</span>
                                                </span>
                                            </div>
                                            <br>
                                            <div class="clearfix">
                                                <span class="fw-bolder mx-auto">{{ $transaksi->payment_system }}</span>
                                                {{--  Button Periksa Rincian  --}}
                                                <a href="{{ route('transactions-details', encrypt($transaksi->id)) }}" class="btn btn-info btn-sm float-end">Periksa Rincian</a>
                                                @if($transaksi->transaction_status == "MENUNGGU KONFIRMASI")
                                                    {{--  Perlu Diproses  --}}
                                                    {{--  Button Atur Pesanan  --}}
                                                    <button type="button" class="btn btn-sm bg-utama float-end" style="margin-right:5px;" data-bs-toggle="modal" data-bs-target="#aturKonfirmasiPesananModal{{ $transaksi->id }}">Atur Pesanan
                                                    </button>
                                                @elseif($transaksi->transaction_status == "SEDANG DIPROSES" && $transaksi->payment_system == "Cash" || $transaksi->transaction_status == "SEDANG DIPROSES" && $transaksi->payment_system == "DP" && isset($transaksi->tgl_byr_dp) && isset($transaksi->tgl_byr_tagihan))
                                                    {{--  Perlu Dikirim  --}}
                                                    {{--  Button Atur Pengiriman  --}}
                                                    <button type="button" class="btn btn-sm bg-utama float-end" style="margin-right:5px;" data-bs-toggle="modal" data-bs-target="#aturPengirimanModal{{ $transaksi->id }}">Atur Pengiriman</button>
                                                @elseif($transaksi->transaction_status == "SEDANG DIPROSES" && $transaksi->payment_system == "DP" && isset($transaksi->tgl_byr_dp))
                                                    {{--  Perlu Ditagih  --}}
                                                    {{--  Button Atur Pesanan  --}}
                                                    <button type="button" class="btn btn-sm bg-utama float-end" style="margin-right:5px;" data-bs-toggle="modal" data-bs-target="#aturPesananModal{{ $transaksi->id }}">
                                                    Ajukan Tagihan
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="card-body" style="height: 47vh;">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="padding: 0;">
                                        Belum Ada Pesanan
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endforelse
            </div>
        </div>

        @foreach($dataTransaksi as $transaksi)
            <!-- Modal Atur Konfirmasi Pesanan -->
            <div class="modal fade" id="aturKonfirmasiPesananModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="aturKonfirmasiPesananModal{{ $transaksi->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aturKonfirmasiPesananModal{{ $transaksi->id }}Label">Atur Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="edit-form" action="{{ route('transactions-konfirmasi') }}" method="post">
                        @csrf
                            <input type="hidden" name="idTransaksi" value="{{ $transaksi->id }}">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row d-flex">
                                        <div class="col">
                                            <input class="form-check-input visually-hidden" type="radio" name="transaction_status" value="SEDANG DIPROSES" id="{{ $transaksi->id }}-1" required>
                                            <label class="form-check-label float-end" for="{{ $transaksi->id }}-1">
                                                <div class="card border-0">
                                                    <div class="card-body" style="padding-bottom:0;">
                                                        <h5 class="card-title text-center mb-4">Konfirmasi Pesanan</h5>
                                                        <p class="card-title text-center"><img src="/assets/images/users/proses.png" style="height:70px" alt=""></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input visually-hidden" type="radio" name="transaction_status" value="DIBATALKAN" id="{{ $transaksi->id }}-2" required>
                                        <label class="form-check-label float-start" for="{{ $transaksi->id }}-2">
                                            <div class="card border-0">
                                                <div class="card-body" style="padding-bottom:0;">
                                                    <h5 class="card-title text-center mb-4">Batalkan Pesanan</h5>
                                                    <p class="card-title text-center m-3"><img src="/assets/images/users/batal.png" style="height:61px" alt=""></p>
                                                </div>
                                            </div>
                                        </label>
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

            <!-- Modal Atur Penagihan -->
            <div class="modal fade" id="aturPesananModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="aturPesananModal{{ $transaksi->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aturPesananModal{{ $transaksi->id }}Label">Pengajuan Tagihan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="edit-form" action="{{ route('transactions-penagihan') }}" method="post">
                        @csrf
                            <input type="hidden" name="idTransaksi" value="{{ $transaksi->id }}">
                            <div class="modal-body">
                                    <div class="container">
                                        <div class="row d-flex">
                                            <div class="col">
                                                <input class="form-check-input visually-hidden" type="radio" name="transaction_status" value="TAGIHAN" id="{{ $transaksi->id }}-3">
                                                <label class="form-check-label float-end" for="{{ $transaksi->id }}-3">
                                                    <div class="card border-0">
                                                        <div class="card-body" style="padding-bottom:0;">
                                                            <h5 class="card-title text-center mb-4">Kirim Pengajuan</h5>
                                                            <p class="card-title text-center"><img src="/assets/images/users/kirim-pengajuan.png" style="height:70px" alt=""></p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <input class="form-check-input visually-hidden" type="radio" name="transaction_status" value="DIBATALKAN" id="{{ $transaksi->id }}-4">
                                                <label class="form-check-label float-start" for="{{ $transaksi->id }}-4">
                                                    <div class="card border-0">
                                                        <div class="card-body" style="padding-bottom:0;">
                                                            <h5 class="card-title text-center mb-4">Batalkan Pesanan</h5>
                                                            <p class="card-title text-center m-3"><img src="/assets/images/users/batal.png" style="height:61px" alt=""></p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn bg-utama">Kirim Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Atur Pengiriman -->
            <div class="modal fade" id="aturPengirimanModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="aturPengirimanModal{{ $transaksi->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aturPengirimanModal{{ $transaksi->id }}Label">Pengiriman Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="edit-form" action="{{ route('transactions-pengiriman') }}" method="post">
                        @csrf
                            <input type="hidden" name="idTransaksi" value="{{ $transaksi->id }}">
                            <div class="modal-body">
                                    <div class="container">
                                        <div class="row d-flex">
                                            <div class="col text-center">
                                                <img src="/assets/images/users/kirim-pesanan.png" style="height:120px" alt="">
                                            </div>
                                            <div class="mt-3">
                                                <div class="col-lg-7 mx-auto text-center">
                                                    <div class="mb-3">
                                                        <label for="pengirimanPesanan" class="form-label">Update Resi Pengiriman</label>
                                                        <input type="text" class="form-control text-center" id="pengirimanPesanan" name="resi" placeholder="Masukkan Resi Pengiriman Disini">
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