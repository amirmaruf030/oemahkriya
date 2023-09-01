@extends('layouts.app')

@section('title')
    Kategori Page
@endsection

@section('content')
    <style>
        a.text-kategori{
            color: #3645a8;
            text-decoration: none;
        }
        a.text-kategori:hover{
            color: red;
        }
    </style>
    <!-- Page Content -->
    <div class="page-content page-home">
        <div class="container">
            <div id="content" class="my-5">
                <div id="filterbar" class="expand">
                    <div class="box">
                        <div class="form-group text-center">
                            <h5>Filter Kategori</h5>
                        </div>
                        @php $incrementCategory = 0 @endphp
                        @forelse ($categories as $category)
                            <div class="mb-2">
                                <label class="tick"><a href="{{ route('categories-detail', $category->slug) }}"
                                        class="text-capitalize d-flex align-items-center text-kategori">
                                        {{ $category->name }}
                                    </a> <i clas="mdi mdi-box-label"></i>
                                </label>
                            </div>
                        @empty
                            <div class="box-label text-uppercase d-flex align-items-center">
                                Tidak Ditemukan Kategori
                            </div>
                        @endforelse
                    </div>
                </div>
                <div id="products">
                    <div class="row mx-0">
                        @php $incrementProduct = 0 @endphp
                        @forelse ($products as $product)
                            <div class="col-lg-4 col-md-6 pt-md-0 pt-3 mb-3">
                                <a href="{{ route('detail', $product->slug) }}" class=" btn-shopee text-secondary text-decoration-none">
                                <div class="card shadow">
                                    <div class="card-img">
                                        <img src="{{ Storage::url($product->galleries->first()->photos) }}"
                                        alt="" height="100" id="shirt">
                                    </div>
                                    <div class="card-body pt-0 pb-0">
                                        <div class="product-name mt-3">{{ $product->name }}</div>
                                    </div>
                                    <div class="card-body pt-0 pb-0">
                                        <div class="price mt-2">
                                            <div class="font-weight-normal text-danger">
                                            @currency_format($product->price)
                                            <span class="float-right text-secondary small"><span class="font-weight-bold text-secondary">{{ $product->jmlh_penjualan }}</span> Terjual</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                                Produk Tidak Ditemukan
                            </div>
                        @endforelse
                    <div class="row">
                        <div class="col-12 mt-4 mx-auto">
                            {{ $products->links() }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
