@extends('layouts.admin')

@section('title')
    Detail Transaksi
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between"
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaksi</a></li>
                                <li class="breadcrumb-item active">Detail Transaksi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{--  Desktop  --}}
                    <div class="d-none d-sm-inline">
                        <div class="container">
                            <div class="card">
                                <div class="row" id="transactionDetails">
                                    <div class="col-12">
                                        <div class="card-header" style="padding-top:0;">
                                            <div class="card-body">
                                                {{--  Informasi Pengiriman  --}}
                                                <div class="row">
                                                    <div class="col-12 mt-4 mb-3">
                                                        <h5>Informasi Pengiriman</h5>
                                                        <hr class="mt-2 mb-2" />
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                        <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">No Pesanan</h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    <i class="fa fa-print"></i> {{ $dataTransaksi->code }}</p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">Status Pesanan</h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    <span class="badge badge-pill badge-warning fw-bolder p-1" style="background: #800080; color:#fff;"> {{ $dataTransaksi->transaction_status }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-3 text-secondary">Pelanggan</h6>
                                                                <p class="text-primary fw-bolder">
                                                                    @if(isset($dataTransaksi->user->image))
                                                                        <img class="img-profile rounded-circle border p-1" src="{{ asset('storage/assets/profil/' . $dataTransaksi->user->image) }}" style="max-width: 30px; margin-right:5px;">
                                                                    @else
                                                                        <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 30px; margin-right:10px;">
                                                                    @endif
                                                                    {{ $dataTransaksi->user->name }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-3 text-secondary">Jasa Pengiriman</h6>
                                                                <p class="text-primary fw-bolder">
                                                                    <span class="fw-bolder">{{ strtoupper($dataTransaksi->pengiriman->jasa_kirim) }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-3 text-secondary">Alamat Pengiriman</h6>
                                                                <p class="text-primary fw-bolder">
                                                                    <span class="fw-bolder">{{ $dataTransaksi->pengiriman->penerima }}</span> | {{ $dataTransaksi->pengiriman->no_telp_penerima }} <br>
                                                                    {{ $dataTransaksi->pengiriman->alamat_penerima }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-3 text-secondary">Resi Pengiriman</h6>
                                                                <p class="text-primary fw-bolder">
                                                                    @if($dataTransaksi->pengiriman->resi == '')
                                                                        -
                                                                    @else
                                                                        {{ $dataTransaksi->pengiriman->resi }}
                                                                        <br>
                                                                        <span class="small">Waktu Pengiriman : 
                                                                            <span class="fw-bolder">{{ $dataTransaksi->pengiriman->tgl_pengiriman }}</span>
                                                                        </span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--  Rincian Produk  --}}
                                                
                                                    <div class="row">
                                                        <hr>
                                                        <div class="col-12">
                                                            <div class="">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h5 class="mb-1 text-secondary">
                                                                                Rincian Produk
                                                                            </h5>
                                                                            <table class="table table-bordered border-3" id="dataTable" width="100%" cellspacing="0">
                                                                                <thead>
                                                                                    <tr class="bg-mid">
                                                                                        <th class="text-center align-middle" scope="col">No.</th>
                                                                                        <th class="text-center align-middle" scope="col">Produk</th>
                                                                                        <th class="text-center align-middle" scope="col">Jumlah</th>
                                                                                        <th class="text-center align-middle" scope="col">Harga</th>
                                                                                        <th class="text-center align-middle" scope="col">Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($dataTransaksi->transaction_detail as $dataProduk)
                                                                                        <tr style="color: black;">
                                                                                            <td class="text-center align-middle">
                                                                                                {{ $loop->iteration }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <div class="mr-3">
                                                                                                        <img src="{{ Storage::url($dataProduk->image ?? '') }}" alt="" style="width: 70px" class="img-thumbnail">
                                                                                                    </div>
                                                                                                    <div style="margin-left:5px;">
                                                                                                        <div>{{ $dataProduk->nama_produk }}</div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-center align-middle">
                                                                                                <span style="font-size: 15px; color: #858796;">{{ $dataProduk->qty }} pcs</span>
                                                                                            </td>
                                                                                            <td class="text-center align-middle">
                                                                                                Rp{{ number_format($dataProduk->price) }}
                                                                                            </td>
                                                                                            <td class="text-center align-middle" style="font-weight: bold; color: black;">Rp{{ number_format($dataProduk->qty*$dataProduk->price) }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    @if(isset($dataTransaksi->catatan))
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <h5 class="mb-1 text-secondary">
                                                                                    Catatan Pesanan
                                                                                </h5>
                                                                                <div class="card shadow">
                                                                                    <div class="card-body">
                                                                                        <span class="fw-bold">{{ $dataTransaksi->catatan }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                {{--  Rincian Pembayaran  --}}
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <h5>Rincian Pembayaran</h5>
                                                        <hr class="mt-2 mb-2" />
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">Waktu Pemesanan</h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    {{ $dataTransaksi->created_at }}</p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">
                                                                    Metode Pembayaran
                                                                </h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    @if($dataTransaksi->payment_system == "DP")
                                                                        {{ $dataTransaksi->payment_system }} (Downpayment)
                                                                    @else
                                                                        {{ $dataTransaksi->payment_system }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">
                                                                    Total Penjualan
                                                                </h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    Rp{{ number_format($dataTransaksi->total_price - $dataTransaksi->shipping_price) }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">Total Pembayaran</h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    Rp{{ number_format($dataTransaksi->total_price) }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">Biaya Ongkos Kirim</h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    Rp{{ number_format($dataTransaksi->shipping_price) }}
                                                                </p>
                                                            </div>

                                                            <div class="col-12 col-md-6">
                                                                <h6 class="mb-1 text-secondary">Status Pembayaran</h6>
                                                                <p class="mb-3 text-primary fw-bolder">
                                                                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                                                        <tbody>
                                                                            @if($dataTransaksi->payment_system == 'DP')
                                                                                <tr>
                                                                                    <td style="padding: 0;">
                                                                                        <span class="fw-bolder text-primary">DP <span class="float-end fw-bolder text-primary"> :
                                                                                        </span></span>
                                                                                    </td>
                                                                                    <td style="padding: 0;">
                                                                                        <span class="ml-3 text-primary fw-bolder" style="margin-left:10px;">
                                                                                        Rp{{ number_format($dataTransaksi->downpayment) }} 
                                                                                        
                                                                                        @if($dataTransaksi->tgl_byr_dp != null)
                                                                                            <span class="fw-bolder text-success ">(Terbayar)</span>
                                                                                        </span>
                                                                                        <br>
                                                                                        <span class="ml-3 mt-1 small" style="margin-left:10px;">{{ $dataTransaksi->tgl_byr_dp }} </span>
                                                                                        @else
                                                                                            <span class="fw-bolder text-danger">(Belum Bayar)</span>
                                                                                        </span>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="padding: 0;">
                                                                                        <span class="fw-bolder text-primary">Tagihan <span class="float-end fw-bolder"> :
                                                                                        </span>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td style="padding: 0;">
                                                                                        <span class="fw-bolder ml-3 text-primary" style="margin-left:10px;">
                                                                                        Rp{{ number_format($dataTransaksi->tagihan) }} 
                                                                                        
                                                                                        @if($dataTransaksi->tgl_byr_tagihan != null)
                                                                                            <span class="fw-bolder text-success">(Terbayar)</span>
                                                                                            </span>
                                                                                            <br>
                                                                                            <span class="ml-3 mt-1 small" style="margin-left:10px;">
                                                                                            {{ $dataTransaksi->tgl_byr_tagihan }}</span>
                                                                                        @else
                                                                                            <span class="fw-bolder text-danger">(Belum Bayar)</span>
                                                                                        </span>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @else
                                                                                <tr>
                                                                                    <td style="padding: 0;">
                                                                                        <span class="fw-bolder ">Total Pesanan <span class="float-end fw-bolder"> :
                                                                                            </span></span>
                                                                                    </td>
                                                                                    <td style="padding: 0;">
                                                                                        <span class="ml-3 fw-bolder text-primary" style="margin-left:10px;">
                                                                                        Rp{{ number_format($dataTransaksi->total_price) }} 
                                                                                        
                                                                                        @if($dataTransaksi->tgl_byr_cash != null)
                                                                                            <span class="fw-bolder text-success">(Terbayar)</span>
                                                                                        </span>
                                                                                        <br>
                                                                                        <div>
                                                                                            <span class="ml-3 mt-1 " style="margin-left:10px;">
                                                                                                {{ $dataTransaksi->tgl_byr_cash }}
                                                                                            </span>
                                                                                        </div>
                                                                                        @else
                                                                                            <span class="fw-bolder text-danger">(Belum Bayar)</span>
                                                                                        </span>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </h4>
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
                    </div>

                    {{--  Mobile  --}}
                    <div class="col-sm-12 d-sm-none" style="padding-left:0; padding-right:0;">
                        <div class="row">
                            <div class="col-lg-12">
                                {{--  Tombol Kembali  --}}
                                <div class="row">
                                    <div class="col-sm-12 mb-3" style="margin-left:10px;">
                                        <a href="#" class="text-dark" style="text-decoration: underline;" onclick="window.history.back();"><i class="fas fa-chevron-left"></i> Kembali</a>
                                    </div>
                                </div>

                                {{--  Informasi Pengiriman  --}}
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <h5 class="fw-bolder">Informasi Pengiriman</h5>
                                        <hr>
                                        <div class="fw-bolder mb-2">
                                            <h6 class="text-secondary">No Pesanan</h6>
                                            <span class="text-primary">
                                                <i class="fa fa-print"></i> {{ $dataTransaksi->code }}
                                            </span>
                                        </div>
                                        <div class="fw-bolder mb-2">
                                            <h6 class="text-secondary">Status Pesanan</h6>
                                            <span class="badge badge-pill badge-warning p-1"
                                                style="background: #800080; color:#fff;"> {{ $dataTransaksi->transaction_status }}
                                            </span>
                                        </div>
                                        <div class="fw-bolder mb-2">
                                            <h6 class="text-secondary">Pelanggan</h6>
                                            <div class="text-primary">
                                                @if(isset($dataTransaksi->user->image))
                                                    <img class="img-profile rounded-circle border p-1" src="{{ asset('storage/assets/profil/' . $dataTransaksi->user->image) }}" style="max-width: 40px; margin-right:3px;">
                                                @else
                                                    <img class="img-profile rounded-circle" src="/images/defaul-profil.png" style="max-width: 40px; margin-right:3px;">
                                                @endif
                                                {{ $dataTransaksi->user->name }}
                                            </div>
                                        </div>
                                        <div class="fw-bolder mb-2">
                                            <h6 class="fw-bolder text-secondary">Alamat Pengiriman</h6>
                                            <div class="text-primary">
                                                {{ $dataTransaksi->pengiriman->penerima }} | {{ $dataTransaksi->pengiriman->no_telp_penerima }} <br>
                                            {{ $dataTransaksi->pengiriman->alamat_penerima }}</div>
                                        </div>
                                        <div class="fw-bolder mb-2">
                                            <h6 class="text-secondary">Jasa Pengiriman</h6>
                                            <div class="text-primary">{{ strtoupper($dataTransaksi->pengiriman->jasa_kirim) }}</div>
                                        </div>
                                        <div class="fw-bolder mb-2">
                                            <h6 class="text-secondary">Resi Pengiriman</h6>
                                            <div class="text-primary">
                                                @if($dataTransaksi->pengiriman->resi == '')
                                                    -
                                                @else
                                                    {{ $dataTransaksi->pengiriman->resi }}
                                                    <br>
                                                    <span class="small">Waktu Pengiriman : 
                                                        {{ $dataTransaksi->pengiriman->tgl_pengiriman }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        {{--  Rincian Produk  --}}
                                        <h5 class="fw-bolder">Rincian Produk</h5>
                                        <hr>
                                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                            <tbody>
                                                @foreach($dataTransaksi->transaction_detail as $transaksi)
                                                    <tr>
                                                        <td style="padding: 10px;" class="justify-content-between align-items-end border">
                                                            <div class="d-flex">
                                                                <img src="{{ Storage::url($transaksi->image ?? '') }}" alt="" style="width: 70px" class="img-thumbnail mr-3 mt-2">
                                                                <div class="d-flex flex-column" style="margin-left:8px;">
                                                                    <span class="fw-bolder mt-3">{{ $transaksi->nama_produk }}</span>
                                                                    <span class="small text-muted">{{ $transaksi->qty }} pcs</span>
                                                                    <span class="small text-muted">Rp{{ number_format($transaksi->price) }}</span>
                                                                </div>
                                                            </div>
                                                            <span class="float-end fw-bolder small" style="margin-right:20px;">Total : Rp{{ number_format($transaksi->qty*$transaksi->price) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{--  Rincian Pembayaran  --}}
                                        <h5 class="fw-bolder">Rincian Pembayaran</h5>
                                        <hr>
                                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-secondary">Waktu Pemesanan <span class="float-end"> : </span></span>
                                                    </td>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-primary" style="margin-left:8px;">
                                                            {{ $dataTransaksi->created_at }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-secondary">Metode Pembayaran <span class="float-end"> : </span></span>
                                                    </td>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-primary" style="margin-left:8px;">
                                                            @if($dataTransaksi->payment_system == "DP")
                                                                {{ $dataTransaksi->payment_system }} (Downpayment)
                                                            @else
                                                                {{ $dataTransaksi->payment_system }}
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-secondary">Total Penjualan <span class="float-end"> : </span></span>
                                                    </td>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-primary" style="margin-left:8px;">
                                                            Rp{{ number_format($dataTransaksi->total_price - $dataTransaksi->shipping_price) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-secondary">Biaya Ongkos Kirim <span class="float-end"> : </span></span>
                                                    </td>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-primary" style="margin-left:8px;">
                                                            Rp{{ number_format($dataTransaksi->shipping_price) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-secondary">Total Pembayaran <span
                                                        class="float-end fw-bolder"> :
                                                        </span></span>
                                                    </td>
                                                    <td style="padding: 0;">
                                                        <span class="fw-bolder text-primary" style="margin-left:8px;">
                                                            Rp{{ number_format($dataTransaksi->total_price) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        {{--  Status Pembayaran  --}}
                                        <span class="fw-bolder">Status Pembayaran</span>
                                        <table class="table table-borderless mt-2" id="dataTable" width="100%" cellspacing="0">
                                            <tbody>
                                                @if($dataTransaksi->payment_system == 'DP')
                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <span class="fw-bolder">DP <span class="float-end fw-bolder"> :
                                                            </span></span>
                                                        </td>
                                                        <td style="padding: 0;">
                                                            <span class="text-primary fw-bolder" style="margin-left: 8px;">
                                                                Rp{{ number_format($dataTransaksi->downpayment) }}
                                                                @if($dataTransaksi->tgl_byr_dp != null)
                                                                    <span class="text-success">(Terbayar)</span>
                                                                    <br>
                                                                    <span class="small mt-1" style="margin-left: 8px;">{{ $dataTransaksi->tgl_byr_dp }} </span>
                                                                @else
                                                                    <span class="text-danger">(Belum Bayar)</span>
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <span class="fw-bolder">
                                                                Tagihan <span class="float-end"> : </span>
                                                            </span>
                                                        </td>
                                                        <td style="padding: 0;">
                                                            <span class="text-primary fw-bolder" style="margin-left: 8px;">
                                                                Rp{{ number_format($dataTransaksi->tagihan) }}
                                                                @if($dataTransaksi->tgl_byr_tagihan != null)
                                                                    <span class="text-success">(Terbayar)</span>
                                                                    <br>
                                                                    <span class="small mt-1" style="margin-left: 8px;">{{ $dataTransaksi->tgl_byr_tagihan }} </span>
                                                                @else
                                                                    <span class="text-danger">(Belum Bayar)</span>
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <span class="fw-bolder">
                                                                Total Pesanan <span class="float-end"> : </span>
                                                            </span>
                                                        </td>
                                                        <td style="padding: 0;">
                                                            <span class="text-primary fw-bolder" style="margin-left: 8px;">
                                                                Rp{{ number_format($dataTransaksi->total_price) }}
                                                                @if($dataTransaksi->tgl_byr_cash != null)
                                                                    <span class="text-success">(Terbayar)</span>
                                                                    <br>
                                                                    <span class="small mt-1" style="margin-left: 8px;">{{ $dataTransaksi->tgl_byr_cash }} </span>
                                                                @else
                                                                    <span class="text-danger">(Belum Bayar)</span>
                                                                @endif
                                                            </span>
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
@endsection
