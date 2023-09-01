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
    .btn-tarik:hover {
        color: yellow !important;
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
            <div class="card-header pb-0 pt-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card bg-success border-success text-white-50" style="background-color: #20c997;">
                                <div class="card-body">
                                    <h5 class="mb-3 text-white">Saldo Toko</h5>
                                    <!-- Button trigger modal -->
                                    <a href="" class="text-white float-end text-decoration-underline btn-tarik" data-bs-toggle="modal" data-bs-target="#tarikSaldoModal">
                                        Tarik Saldo
                                    </a>
                                    <h3 class="card-text fw-medium text-white mb-0">Rp{{ number_format($saldoToko, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-3">
                            <div class="card bg-danger border-danger text-white-50">
                                <div class="card-body">
                                    <h5 class="mb-3 text-white">Total Penjualan Produk</h5>
                                    <h6 class="text-white float-end">Bulan ini</h6>
                                    <h3 class="card-text text-white fw-medium mb-0">Rp{{ number_format($totalPenjualanProduk, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-3">
                            <div class="card bg-info border-info text-white-50">
                                <div class="card-body">
                                    <h5 class="mb-3 text-white">Total Ongkos Kirim</h5>
                                    <h6 class="text-white float-end">Bulan ini</h6>
                                    <h3 class="card-text fw-medium text-white mb-0">Rp{{ number_format($totalOngkosKirim, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-3">
                            <div class="card bg-primary border-primary text-white-50">
                                <div class="card-body">
                                    <h5 class="mb-3 text-white">Total Pendapatan</h5>
                                    <h6 class="text-white float-end">Bulan ini</h6>
                                    <h3 class="card-text fw-medium text-white mb-0">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card-header pt-0">
                    <div class="card-body">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Riwayat Transaksi</h4>
                            <span class="d-sm-flex float-end">
                                <span class="fw-bolder text-secondary mt-2" style="margin-right:5px;">Laporan Penghasilan</span>
                                <form action="{{ route('cetak-laporan.penghasilan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rentangWaktu" value="minggu">
                                    @method('GET')
                                    <button type="submit" class="btn btn-sm btn-secondary m-1"><i class="fas fa-print"></i> 1 Minggu</a></button>
                                </form>
                                <form action="{{ route('cetak-laporan.penghasilan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rentangWaktu" value="bulan">
                                    @method('GET')
                                    <button type="submit" class="btn btn-sm btn-secondary mt-1"><i class="fas fa-print"></i> 1 Bulan</a></button>
                                </form>
                                <form action="{{ route('cetak-laporan.penghasilan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rentangWaktu" value="tahun">
                                    @method('GET')
                                    <button type="submit" class="btn btn-sm btn-secondary m-1"><i class="fas fa-print"></i> 1 Tahun</a></button>
                                </form>
                            </span>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr class="bg-mid">
                                    <th class="text-center align-middle">Jumlah Transaksi</th>
                                    <th class="text-center align-middle">Jenis Transaksi</th>
                                    <th class="text-center align-middle">Keterangan</th>
                                    <th class="text-center align-middle">Tanggal Transaksi</th>
                                </tr>
                            </thead>
                            @forelse($riwayatTransaksi->sortByDesc('created_at') as $riwayat)
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="text-center align-middle">
                                            Rp{{ number_format($riwayat->jumlah_transaksi, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $riwayat->jenis_transaksi }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $riwayat->keterangan }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $riwayat->created_at }}
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



<!-- Modal -->
<div class="modal fade" id="tarikSaldoModal" tabindex="-1" aria-labelledby="tarikSaldoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarikSaldoModalLabel">Tarik Saldo Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-form" action="{{ route('saldotoko.tarik') }}" method="post">
            @csrf
            @method('GET')
                <input type="hidden" name="" value="">
                <div class="modal-body">
                        <div class="container">
                            <div class="row d-flex">
                                <input type="hidden" name="idShop" value="{{ Auth::user()->shop->id }}">
                                <input type="hidden" name="jumlahSaldo" value="{{ $saldoToko }}">
                                <div class="mt-3">
                                    <div class="col-lg-7 mx-auto text-center">
                                        <div class="mb-3">
                                            <label for="pengirimanPesanan" class="form-label">Rekening</label>
                                            <select class="form-select" aria-label="Default select example" name="rekening">
                                                <option selected>Pilih Rekening</option>
                                                <option value="BCA">BCA</option>
                                                <option value="BRI">BRI</option>
                                                <option value="Mandiri">Mandiri</option>
                                                <option value="CIMB Niaga">CIMB Niaga</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mx-auto text-center">
                                        <div class="mb-3">
                                            <label for="pengirimanPesanan" class="form-label">Nama Penerima</label>
                                            <input type="text" class="form-control text-center" id="pengirimanPesanan" name="penerima">
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mx-auto text-center">
                                        <div class="mb-3">
                                            <label for="pengirimanPesanan" class="form-label">No Rekening</label>
                                            <input type="text" class="form-control text-center" id="pengirimanPesanan" name="noRekening" >
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mx-auto text-center">
                                        <div class="mb-3">
                                            <p class="text-success">Total saldo yang tersedia akan ditarik</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-utama">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection