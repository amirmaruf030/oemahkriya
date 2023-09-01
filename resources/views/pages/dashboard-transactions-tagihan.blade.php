@extends('layouts.app')

@section('title')
    Pesanan Saya | Tagihan
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <div class="container">
            <div id="content" class="d-none d-sm-inline my-5">
                @include('includes.sidebar-dashboard-transaksi')
                <div id="products">
                    @include('includes.navbar-dashboard-transaksi')
                    <div class="row mx-0">
                        <div class="container">
                            @forelse ($buyTransactions->sortByDesc('updated_at') as $transaction)
                                <div class="card shadow mb-2" >
                                    <div class="card-body " style="padding:5px; padding-bottom:0px">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="thead-light">
                                                    <th colspan="3" class="pt-1 pb-1">
                                                    @if(isset($transaction->shop->image))
                                                        <img class="img-profile rounded-circle border" src="{{ Storage::url($transaction->shop->image ?? '') }}" style="max-width: 30px; ">
                                                        
                                                    @else
                                                        <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px;">
                                                    @endif
                                                    {{ $transaction->shop->nama_toko }}
                                                        <span class="float-right">{{ $transaction->transaction_status }}</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transaction->transaction_detail as $items)
                                                <tr>
                                                    <td>
                                                        <img src="{{ Storage::url($items->image ?? '') }}" alt="" style="width: 70px"
                                                        class="img-thumbnail float-left mr-3">
                                                        <span>{{ $items->nama_produk }}</span>
                                                        <br>
                                                        <span>{{ $items->qty }} pcs <span class="float-right">Rp{{ number_format($items->price) }}</span></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td>
                                                        @if($transaction->payment_system == 'DP')
                                                            <span class="float-right">Total Pesanan: Rp{{ number_format($transaction->total_price) }}
                                                            </span>
                                                            <br>
                                                            <span class="float-right">Jumlah Tagihan: <span
                                                                class="font-weight-bold">Rp{{ number_format($transaction->tagihan) }}</span>
                                                            </span>
                                                        @else
                                                            <span class="float-right">Total Pesanan: <span
                                                                class="font-weight-bold">Rp{{ number_format($transaction->total_price) }}</span>
                                                            </span>
                                                        @endif
                                                        <br>
                                                        {{--  Button Detail Pesanan  --}}
                                                        <form class="float-right mt-2" action="{{ route('detail-pesanan') }}" method="POST">
                                                        @csrf
                                                            <input type="hidden" name="idTransaksi" value="{{ $transaction->id }}">
                                                            <button type="submit" class="btn btn-info btn-sm">Detail</button>
                                                        </form>
                                                        {{--  Button Batalkan Pesanan  --}}
                                                        <!-- Button Batalkan Pesanan modal -->
                                                        <button type="button" class="btn btn-sm btn-danger float-right mt-2 mr-1" data-toggle="modal" data-target="#batalPesananModal{{ $transaction->id }}">
                                                        Batalkan Pesanan
                                                        </button>
                                                        {{--  Button Bayar Sekarang  --}}
                                                        <form class="float-right mt-2 mr-1" action="{{ route('bayar-pesanan') }}" method="POST">
                                                        @csrf
                                                            <input type="hidden" name="idTransaksi" value="{{ $transaction->id }}">
                                                            <button type="submit" class="btn btn-primary btn-sm">Bayar Sekarang</button>
                                                        </form>
                                                        <span class="clearfix float-left">Metode Pembayaran: <span
                                                            class="font-weight-bold">{{ $transaction->payment_system }}</span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @empty
                                <div class="" style="height: 47vh;">
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
                </div>
            </div>

            <div class="col-sm-12 d-sm-none" style="padding-left:0; padding-right:0;">
                @include('includes.dropdown-mobile-dashboard-transaksi')
                @forelse ($buyTransactions->sortByDesc('updated_at') as $transaction)
                    <div class="card shadow mb-2">
                        <div class="card-body" style="padding-bottom:0">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="padding: 0;">
                                        @if(isset($transaction->shop->image))
                                            <img class="img-profile rounded-circle border" src="{{ Storage::url($transaction->shop->image ?? '') }}" style="max-width: 30px; ">
                                            
                                        @else
                                            <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px;">
                                        @endif
                                        {{ $transaction->shop->nama_toko }}
                                        <span class="float-right text-danger mb-4">{{ $transaction->transaction_status }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0;">
                                            <img src="{{ Storage::url($transaction->transaction_detail->first()->image ?? '') }}" alt="" style="width: 70px"
                                                class="img-thumbnail float-left mr-3">
                                            <span>{{ $transaction->transaction_detail->first()->nama_produk }}</span>
                                            <br>
                                            <span class="float-right small text-muted">{{ $transaction->transaction_detail->first()->qty }} pcs</span>
                                            <br>
                                            <span class="float-right small text-muted">Rp{{ number_format($transaction->transaction_detail->first()->price) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0;" class="d-flex flex-column">
                                        
                                            <div class="clearfix">
                                                <hr>
                                                <span class="float-left small">{{ $transaction->transaction_detail->count() }} produk</span>
                                                <span class="float-right small text-muted">Total Pesanan: Rp{{ number_format($transaction->total_price) }}
                                                </span>
                                                <span class="float-right small text-muted">Jumlah Tagihan: <span
                                                    class="font-weight-bold">Rp{{ number_format($transaction->tagihan) }}</span>
                                                </span>
                                            </div>
                                            <br>
                                            <div class="clearfix">
                                                <span class="font-weight-bold mx-auto">{{ $transaction->payment_system }}</span>
                                                <a href="" class="btn btn-info btn-sm float-right" id="navbarDropdown" role="button" data-toggle="dropdown">
                                                    Lainnya
                                                </a>
                                                <div class="dropdown-menu dropdown-transaksi mr-2">
                                                    {{--  Button Detail Pesanan  --}}
                                                    <form class="mb-1" action="{{ route('detail-pesanan') }}" method="POST">
                                                    @csrf
                                                        <input type="hidden" name="idTransaksi" value="{{ $transaction->id }}">
                                                        <button type="submit" class="btn btn-block btn-dropdown btn-dropdown-transaksi btn-sm text-left">Detail</button>
                                                    </form>
                                                    {{--  Button Batalkan Pesanan  --}}
                                                    <!-- Button Batalkan Pesanan modal -->
                                                    <button type="button" class="btn btn-block btn-dropdown btn-dropdown-transaksi btn-sm text-left" data-toggle="modal" data-target="#batalPesananModal{{ $transaction->id }}">
                                                    Batalkan Pesanan
                                                    </button>
                                                </div>
                                                {{--  Button Bayar Sekarang  --}}
                                                <form class="float-right mr-1" action="{{ route('bayar-pesanan') }}" method="POST">
                                                @csrf
                                                    <input type="hidden" name="idTransaksi" value="{{ $transaction->id }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">Bayar Sekarang</button>
                                                </form>
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
    </div>

    <!-- Modal -->
    @foreach($buyTransactions as $transaction)
        <div class="modal fade" id="batalPesananModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="batalPesananModal{{ $transaction->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalPesananModal{{ $transaction->id }}Label">Batalkan Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="float-right mt-2 mr-1" action="{{ route('batalkan-pesanan') }}" method="POST">
                    @csrf
                        <div class="modal-body">
                            <input type="hidden" name="idTransaksi" value="{{ $transaction->id }}">
                            <div class="row">
                                @if($transaction->transaction_status == 'MENUNGGU KONFIRMASI')
                                    <div class="col-lg-12 text-center">
                                        <h6 class="font-weight-bold text-secondary mx-auto">Yakin Ingin Membatalkan Pesanan Ini?</h6>
                                        <p class="text-success">Dana akan dikembalikan ke saldo Anda</p>
                                    </div>
                                @else
                                    @if($transaction->payment_system == 'Cash' || $transaction->payment_system == 'DP' && isset($transaction->tgl_byr_dp) && isset($transaction->tgl_byr_tagihan))
                                        <div class="col-lg-12 text-center">
                                            <h6 class="font-weight-bold text-secondary mx-auto">Yakin Ingin Membatalkan Pesanan Ini?</h6>
                                            <p class="text-success">Dana akan terpotong sebagai biaya DP dan dikembalikan ke saldo Anda</p>
                                        </div>
                                    @else
                                        @if(isset($transaction->tgl_byr_dp) && !isset($transaction->tgl_byr_tagihan))
                                            <div class="col-lg-12 text-center">
                                                <h6 class="font-weight-bold text-secondary mx-auto">Yakin Ingin Membatalkan Pesanan Ini?</h6>
                                                <p class="text-success">Dana akan diserahkan ke Penjual sebagai biaya DP</p>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Batalkan Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
