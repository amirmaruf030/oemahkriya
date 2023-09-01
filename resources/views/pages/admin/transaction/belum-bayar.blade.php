@extends('layouts.admin')

@section('title')
    Transaksi | Belum Bayar
@endsection
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
            </div>

            <div class="d-sm-none">
                @include('includes.dropdown-mobile-transaksi-admin')
            </div>

                {{--  Cash / DP  --}}
                <div class="tab-pane fade show active" id="pills-cash-dp" role="tabpanel" aria-labelledby="pills-cash-dp-tab">
                    {{--  Desktop  --}}
                    <div class="col-12 d-none d-sm-inline">
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
                                    @forelse($dataTransaksi->where('transaction_status', 'BELUM BAYAR')->sortByDesc('updated_at') as $transaksi)
                                        <thead>
                                            <tr class="bg-second">
                                                <th colspan="3" class="pt-2 pb-1">
                                                    @if(isset($transaksi->user->image))
                                                        <img class="img-profile rounded-circle border" src="{{ asset('storage/assets/profil/' . $transaksi->user->image) }}" style="max-width: 30px; ">
                                                        
                                                    @else
                                                        <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px;">
                                                    @endif
                                                    {{ $transaksi->user->name }}
                                                </th>
                                                <th colspan="2" class="text-right">No. Pesanan {{ $transaksi->code }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                    <div class="d-sm-none mt-3">
                        @forelse($dataTransaksi->where('transaction_status', 'BELUM BAYAR')->sortByDesc('updated_at') as $transaksi)
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
                {{--  Tagihan  --}}
        </div>
        
    </div>
@endsection