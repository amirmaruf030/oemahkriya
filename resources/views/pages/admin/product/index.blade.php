@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Produk</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('product.create') }}" class="btn bg-utama float-end mb-3" style="margin-right:20px;">
                                <i class="mdi mdi-plus-circle-outline"></i> Tambah Produk Baru
                            </a>
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="bg-second">
                                            <th class="text-center align-middle">No</th>
                                            <th class="text-center align-middle">Produk</th>
                                            <th class="text-center align-middle">Kategori</th>
                                            <th class="text-center align-middle">Harga</th>
                                            <th class="text-center align-middle">Stok</th>
                                            <th class="text-center align-middle">Penjualan</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    @foreach ($produk as $item)
                                    <tbody>
                                        <tr>
                                            {{--  No  --}}
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            {{--  Produk  --}}
                                            <td>
                                                <img src="{{ Storage::url($item->galleries->first()->photos ?? '') }}" alt="" style="width: 70px" class="img-thumbnail">
                                                <span style="margin-left:10px;">{{ $item->name }}</span>
                                            </td>
                                            {{--  Kategori  --}}
                                            <td class="text-center align-middle">{{ $item->category->name }}</td>
                                            {{--  Harga  --}}
                                            <td class="text-center align-middle">
                                                Rp{{ number_format($item->price, 0, ',', '.') }}
                                                {{--  Button Edit Stok  --}}
                                                <a href="" class="m-1" data-bs-toggle="modal" data-bs-target="#aturHargaProduk{{ $item->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            {{--  Stok  --}}
                                            <td class="text-center align-middle">
                                                {{ $item->stok }}
                                                {{--  Button Edit Stok  --}}
                                                <a href="" class="m-1" data-bs-toggle="modal" data-bs-target="#aturStokProduk{{ $item->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            {{--  Penjualan  --}}
                                            <td class="text-center align-middle">
                                                {{ $item->jmlh_penjualan }}
                                            </td>
                                            {{--  Aksi  --}}
                                            <td class="text-center align-middle">
                                                <a href="{{ route('product.edit', encrypt($item->id)) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-pencil-alt"></i> Ubah
                                                </a>
                                                <form action="{{ route('product.destroy', encrypt($item->id)) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    @if (@empty($item))
                                    <tbody>
                                        <tr>
                                            <td colspan="7" class="text-center">Kosong</td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
             <!-- container-fluid -->
        </div>

        {{--  Modal  --}}
        @foreach ($produk as $item)
            <!-- Modal Atur Stok Produk -->
            <div class="modal fade" id="aturStokProduk{{ $item->id }}" tabindex="-1" aria-labelledby="aturStokProduk{{ $item->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aturStokProduk{{ $item->id }}Label">Atur Stok Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="edit-form" action="{{ route('product.updatestok') }}" method="post">
                        @csrf
                            <input type="hidden" name="idProduk" value="{{ $item->id }}">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row d-flex">
                                        <div class="col-lg-7 mx-auto text-center">
                                            <div class="mb-3">
                                                <label for="stokProduk" class="form-label">{{ $item->name }}</label>
                                                <input type="number" class="form-control text-center" id="stokProduk" name="stok" value="{{ $item->stok }}">
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
            <!-- Modal Atur Harga Produk -->
            <div class="modal fade" id="aturHargaProduk{{ $item->id }}" tabindex="-1" aria-labelledby="aturHargaProduk{{ $item->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aturHargaProduk{{ $item->id }}Label">Atur Harga Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="edit-form" action="{{ route('product.updateharga') }}" method="post">
                        @csrf
                            <input type="hidden" name="idProduk" value="{{ $item->id }}">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row d-flex">
                                        <div class="col-lg-7 mx-auto text-center">
                                            <div class="mb-3">
                                                <label for="hargaProduk" class="form-label">{{ $item->name }}</label>
                                                <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                                <input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="price" value="{{ $item->price }}">
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

    @endsection