@extends('layouts.app')

@section('title')
    Pesanan Saya | Detail Transaksi
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-home">
        <div class="container">
            <div id="content" class="d-none d-sm-inline my-5">
                @include('includes.sidebar-dashboard-transaksi')
                <div id="products">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="card shadow mb-3">
                                <div class="col-sm-12">
                                    <a href="#" class="text-dark" style="text-decoration: underline;" onclick="javascript:history.back()"><i class="fas fa-chevron-left"></i> Kembali</a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 mt-2">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <span class="font-weight-bold">Alamat Pengiriman</span>
                                                    <hr>
                                                    <span class="font-weight-bold">{{ $dataTransaksi->pengiriman->penerima }}</span> | {{ $dataTransaksi->pengiriman->no_telp_penerima }} <br>
                                                    {{ $dataTransaksi->pengiriman->alamat_penerima }}
                                                </div>
                                                <div class="col-lg-5 offset-1">
                                                    <span class="font-weight-bold">Jasa Pengiriman</span>
                                                    <hr>
                                                    <span class="font-weight-bold">{{ strtoupper($dataTransaksi->pengiriman->jasa_kirim) }}</span><br>
                                                    @if($dataTransaksi->pengiriman->resi == '')
                                                        Resi : -
                                                    @else
                                                        Resi : {{ $dataTransaksi->pengiriman->resi }}
                                                        <br>
                                                        <span class="small">
                                                            <span class="small">Tgl Pengiriman : 
                                                                <span class="font-weight-bold">{{ $dataTransaksi->pengiriman->tgl_pengiriman }}</span>
                                                            </span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 mt-3">
                                            <span class="font-weight-bold">Rincian Produk</span>
                                            <hr>
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr class="thead-light">
                                                        <th colspan="3" class="pt-0 pb-0">
                                                        @if(isset($dataTransaksi->shop->image))
                                                            <img class="img-profile rounded-circle border p-1" src="{{ Storage::url($dataTransaksi->shop->image ?? '') }}" style="max-width: 40px; ">
                                                            
                                                        @else
                                                            <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px; margin-right:10px;">
                                                        @endif
                                                        {{ $dataTransaksi->shop->nama_toko }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dataTransaksi->transaction_detail as $items)
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
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <span class="font-weight-bold">Rincian Pembayaran</span>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>Status Pesanan <span class="float-right">:</span></p>
                                                    <p>No Pesanan <span class="float-right">:</span></p>
                                                    <p>Tanggal Pembelian <span class="float-right">:</span></p>
                                                    <p>Metode Pembayaran <span class="float-right">:</span></p>
                                                    <p>Subtotal Belanja <span class="float-right">:</span></p>
                                                    <p>Biaya Kirim <span class="float-right">:</span></p>
                                                    <p>
                                                        <strong style="font-size: 16px">Total Belanja <span
                                                        class="float-right">:</span></strong>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <span class="badge badge-pill badge-warning" style="background: #800080; color:#fff;"> {{ $dataTransaksi->transaction_status }}
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>
                                                            <i class="fa fa-print"></i>
                                                            {{ $dataTransaksi->code }}
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>{{ $dataTransaksi->created_at }}</span>
                                                    </p>
                                                    <p>
                                                        <span class="">{{ $dataTransaksi->payment_system }}</span>
                                                    </p>
                                                    <p>
                                                        <span class="">Rp{{ number_format($dataTransaksi->total_price - $dataTransaksi->shipping_price) }}</span>
                                                    </p>
                                                    <p>
                                                        <span class="">Rp{{ number_format($dataTransaksi->shipping_price) }}</span>
                                                    </p>
                                                    <p>
                                                        <span class="">
                                                            <strong>Rp{{ number_format($dataTransaksi->total_price) }}</strong>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <hr>
                                                    <span class="font-weight-bold">Status Pembayaran</span>
                                                    <hr>
                                                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                                        <tbody>
                                                            @if($dataTransaksi->payment_system == 'DP')
                                                                <tr>
                                                                    <td style="padding: 0;">
                                                                        <span class="font-weight-bold">DP <span class="float-right font-weight-bold"> :
                                                                        </span></span>
                                                                    </td>
                                                                    <td style="padding: 0;">
                                                                        <span class="ml-3 ">
                                                                        Rp{{ number_format($dataTransaksi->downpayment) }} 
                                                                        
                                                                        @if($dataTransaksi->tgl_byr_dp != null)
                                                                            <span class="font-weight-bold text-success ">(Terbayar)</span>
                                                                        </span>
                                                                        <br>
                                                                        <span class="ml-3 mt-1">{{ $dataTransaksi->tgl_byr_dp }} </span>
                                                                        @else
                                                                            <span class="font-weight-bold text-danger ">(Belum Bayar)</span>
                                                                        </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 0;">
                                                                        <span class="font-weight-bold">Tagihan <span class="float-right font-weight-bold"> :
                                                                        </span></span>
                                                                    </td>
                                                                    <td style="padding: 0;">
                                                                        <span class="ml-3">
                                                                        Rp{{ number_format($dataTransaksi->tagihan) }} 
                                                                        
                                                                        @if($dataTransaksi->tgl_byr_tagihan != null)
                                                                            <span class="font-weight-bold text-success ">(Terbayar)</span>
                                                                        </span>
                                                                        <br>
                                                                        <span class="ml-3 mt-1">{{ $dataTransaksi->tgl_byr_tagihan }} </span>
                                                                        @else
                                                                            <span class="font-weight-bold text-danger ">(Belum Bayar)</span>
                                                                        </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td style="padding: 0;">
                                                                        <span class="font-weight-bold">Total Pembayaran <span class="float-right font-weight-bold"> :
                                                                            </span></span>
                                                                    </td>
                                                                    <td style="padding: 0;">
                                                                        <span class="ml-3 font-weight-bold">
                                                                        Rp{{ number_format($dataTransaksi->total_price) }} 
                                                                        
                                                                        @if($dataTransaksi->tgl_byr_cash != null)
                                                                            <span class="font-weight-bold text-success ">(Terbayar)</span>
                                                                        </span>
                                                                        <br>
                                                                        <span class="ml-3 mt-1">{{ $dataTransaksi->tgl_byr_cash }} </span>
                                                                        @else
                                                                            <span class="font-weight-bold text-danger ">(Belum Bayar)</span>
                                                                        </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 d-sm-none" style="padding-left:0; padding-right:0;">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <a href="#" class="text-dark" style="text-decoration: underline;" onclick="window.history.back();"><i class="fas fa-chevron-left"></i> Kembali</a>
                                    <span class="font-weight-bold float-right mr-4">Detail Transaksi</span>
                                </div>
                            </div>
                        <div class="card shadow mb-2">
                            <div class="card-body">
                                <span class="font-weight-bold">Alamat Pengiriman</span>
                                <hr>
                                <span class="small">
                                    <span class="font-weight-bold">{{ $dataTransaksi->pengiriman->penerima }}</span> | {{ $dataTransaksi->pengiriman->no_telp_penerima }} <br>
                                    {{ $dataTransaksi->pengiriman->alamat_penerima }}
                                </span>
                                <br><br>
                                <span class="font-weight-bold">Informasi Pengiriman</span>
                                <hr>
                                <span class="small"><span class="font-weight-bold">{{ strtoupper($dataTransaksi->pengiriman->jasa_kirim) }}</span><br>
                                @if($dataTransaksi->pengiriman->resi == '')
                                    Resi : -
                                @else
                                    Resi : {{ $dataTransaksi->pengiriman->resi }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="card shadow mb-2">
                            <div class="card-body">
                                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <th style="padding: 0;">
                                            @if(isset($dataTransaksi->shop->image))
                                                <img class="img-profile rounded-circle border p-1" src="{{ Storage::url($dataTransaksi->shop->image ?? '') }}" style="max-width: 40px; ">
                                                
                                            @else
                                                <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px; margin-right:10px;">
                                            @endif
                                            {{ $dataTransaksi->shop->nama_toko }}
                                                <hr>
                                            </th>
                                        </tr>
                                        @foreach($dataTransaksi->transaction_detail as $items)
                                            <tr>
                                                <td style="padding: 0;">
                                                    <img src="{{ Storage::url($items->image ?? '') }}" alt="" style="width: 70px"
                                                        class="img-thumbnail float-left mr-3">
                                                    <span>{{ $items->nama_produk }}</span>
                                                    <br>
                                                    <span class="small text-muted">{{ $items->qty }} pcs</span>
                                                    <br>
                                                    <span class="small text-muted">Rp{{ number_format($items->price) }}</span>
                                                    <hr>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small">Status Pesanan <span class="float-right"> : </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="badge badge-pill badge-warning ml-3"
                                                    style="background: #800080; color:#fff;"> {{ $dataTransaksi->transaction_status }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small">Invoice <span class="float-right"> : </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="ml-3 small">
                                                    <i class="fa fa-print"></i>
                                                    {{ $dataTransaksi->code }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small">Tanggal Pembelian <span class="float-right"> : </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="ml-3 small">
                                                    {{ $dataTransaksi->created_at }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small">Metode Pembayaran <span class="float-right"> : </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="ml-3 small">
                                                    {{ $dataTransaksi->payment_system }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small">Subtotal Belanja <span class="float-right"> : </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="ml-3 small">
                                                    Rp{{ number_format($dataTransaksi->total_price - $dataTransaksi->shipping_price) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small">Biaya Kirim <span class="float-right"> : </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="ml-3 small">
                                                    Rp{{ number_format($dataTransaksi->shipping_price) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <span class="small font-weight-bold">Total Belanja <span
                                                class="float-right font-weight-bold"> :
                                                </span></span>
                                            </td>
                                            <td style="padding: 0;">
                                                <span class="ml-3 small font-weight-bold">
                                                    Rp{{ number_format($dataTransaksi->total_price) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <span class="font-weight-bold">Status Pembayaran</span>
                                <hr>
                                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        @if($dataTransaksi->payment_system == 'DP')
                                            <tr>
                                                <td style="padding: 0;">
                                                    <span class="font-weight-bold small">DP <span class="float-right font-weight-bold"> :
                                                    </span></span>
                                                </td>
                                                <td style="padding: 0;">
                                                    <span class="ml-3 small">
                                                    Rp{{ number_format($dataTransaksi->downpayment) }} 
                                                    
                                                    @if($dataTransaksi->tgl_byr_dp != null)
                                                        <span class="font-weight-bold small text-success ">(Terbayar)</span>
                                                    </span>
                                                    <br>
                                                    <span class="ml-3 mt-1 small">{{ $dataTransaksi->tgl_byr_dp }} </span>
                                                    @else
                                                        <span class="font-weight-bold small text-danger ">(Belum Bayar)</span>
                                                    </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0;">
                                                    <span class="font-weight-bold small">Tagihan <span class="float-right font-weight-bold"> :
                                                    </span></span>
                                                </td>
                                                <td style="padding: 0;">
                                                    <span class="ml-3 small">
                                                    Rp{{ number_format($dataTransaksi->tagihan) }} 
                                                    
                                                    @if($dataTransaksi->tgl_byr_tagihan != null)
                                                        <span class="font-weight-bold small text-success ">(Terbayar)</span>
                                                    </span>
                                                    <br>
                                                    <span class="ml-3 mt-1 small">{{ $dataTransaksi->tgl_byr_tagihan }} </span>
                                                    @else
                                                        <span class="font-weight-bold small text-danger ">(Belum Bayar)</span>
                                                    </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td style="padding: 0;">
                                                    <span class="font-weight-bold small">Total Pesanan <span class="float-right font-weight-bold"> :
                                                        </span></span>
                                                </td>
                                                <td style="padding: 0;">
                                                    <span class="ml-3 font-weight-bold small">
                                                    Rp{{ number_format($dataTransaksi->total_price) }} 
                                                    
                                                    @if($dataTransaksi->tgl_byr_cash != null)
                                                        <span class="font-weight-bold small text-success ">(Terbayar)</span>
                                                    </span>
                                                    <br>
                                                    <span class="ml-3 mt-1 small">{{ $dataTransaksi->tgl_byr_cash }} </span>
                                                    @else
                                                        <span class="font-weight-bold small text-danger ">(Belum Bayar)</span>
                                                    </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
