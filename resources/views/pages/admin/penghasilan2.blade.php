@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection
@push('addon-style')
    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-bottom-color: red !important;
            color: red !important;
        }

        .bg-navbar {
            background-color: #ee4d2d !important;
        }

        .sidebar-light .sidebar-brand {
            background-color: #dc4325 !important;
        }

        .nav-item .nav-transaksi:hover {
            color: #dc4325 !important;
            border-bottom-color: #dc4325;
        }
    </style>
@endpush

@section('content')
    <!-- Section Content -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Informasi Penghasilan</h4>
                    </div>
                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-lg-3">
                        <div class="card bg-success border-success text-white-50" style="background-color: #20c997;">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Saldo Toko</h5>
                                <a href="" class="text-white float-end text-decoration-underline">Tarik Saldo</a>
                                <h2 class="card-text fw-medium text-white mb-0">Rp{{ number_format($saldoToko, 0, ',', '.') }}</h2>
                            </div>
                        </div>
                </div><!-- end col -->

                <div class="col-lg-3">
                        <div class="card bg-danger border-danger text-white-50">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Total Penjualan Produk</h5>
                                <h6 class="text-white float-end">Bulan ini</h6>
                                <h2 class="card-text text-white fw-medium mb-0">Rp{{ number_format($totalPenjualanProduk, 0, ',', '.') }}</h2>
                            </div>
                        </div>
                </div><!-- end col -->
                
                <div class="col-lg-3">
                        <div class="card bg-info border-info text-white-50">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Total Ongkos Kirim</h5>
                                <h6 class="text-white float-end">Bulan ini</h6>
                                <h2 class="card-text fw-medium text-white mb-0">Rp{{ number_format($totalOngkosKirim, 0, ',', '.') }}</h2>
                            </div>
                        </div>
                </div><!-- end col -->

                <div class="col-lg-3">
                        <div class="card bg-primary border-primary text-white-50">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Total Pendapatan</h5>
                                <h6 class="text-white float-end">Bulan ini</h6>
                                <h2 class="card-text fw-medium text-white mb-0">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                            </div>
                        </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card-header">
                        <div class="card-body">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Rincian Penghasilan</h4>
                            </div>
                            <ul class="nav nav-tabs text-center justify-content-center mb-3" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link nav-transaksi nav-transaksi text-secondary @if($aktif == 'Dalam Pengiriman') active  @endif" style="margin-bottom: 0" href="{{ route('penghasilan.index') }}">Dalam Proses</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Sudah Diterima') active  @endif" style="margin-bottom: 0" href="{{ route('penghasilan.show') }}">Sudah Diterima</a>
                                </li>
                            </ul>
                            
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr class="table-warning">
                                        <th class="text-center align-middle">Pesanan</th>
                                        <th class="text-center align-middle">Waktu Diterima</th>
                                        <th class="text-center align-middle">Status</th>
                                        <th class="text-center align-middle">Metode Pembayaran</th>
                                        <th class="text-center align-middle">Total Pembayaran</th>
                                    </tr>
                                </thead>
                                
                                @forelse($dataTransaksi->where('transaction_status', 'SELESAI')->sortByDesc('updated_at') as $transaksi)
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3 mb-1">
                                                    <img src="{{ Storage::url($transaksi->transaction_detail->first()->product->galleries->first()->photos ?? '') }}" alt="" style="width: 70px" class="img-thumbnail">
                                                </div>
                                                <div style="margin-left:5px;">
                                                    <div>{{ $transaksi->code }}</div>
                                                    <div>Pemesan: {{ $transaksi->user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">{{ $transaksi->updated_at->format('d/m/Y') }}</td>
                                        <td class="text-center align-middle">
                                            {{ $transaksi->transaction_status }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $transaksi->payment_system }}
                                        </td>
                                        <td class="text-center align-middle">
                                            Rp{{ number_format($transaksi->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                                @empty
                                    <tbody>
                                        <tr>
                                            <th class="text-center" colspan="5">
                                                Belum Ada Pesanan
                                            </th>
                                        </tr>
                                    </tbody>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- container-fluid -->
    </div>
@endsection
