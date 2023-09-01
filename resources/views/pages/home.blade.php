@extends('layouts.app')

@section('title')
    Beranda
@endsection

@section('content')
    <div class="page-content page-home">
        <section class="store-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="">
                        <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
                                <li data-target="#storeCarousel" data-slide-to="1"></li>
                                <li data-target="#storeCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/images/slide1.jpg" alt="Carousel Image" class="d-block w-100" />
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#storeCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#storeCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="">
                        <h5>Kategori</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementCategory = 0 @endphp
                    @forelse ($categories as $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos=""
                            data-aos-delay="{{ $incrementCategory += 100 }}">
                            <a href="{{ route('categories-detail', $category->slug) }}"
                                class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ Storage::url($category->photo) }}" alt="" class="w-100" />
                                </div>
                                <p class="categories-text">
                                    {{ $category->name }}
                                </p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="" >
                            Kategori Tidak Ditemukan
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12 btn-shopee mt-3 mb-3 rounded pt-4 pb-2" data-aos="">
                        <h5 class="font-weight-bold btn-shopee">Produk Terbaru</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementProduct = 0 @endphp
                    @forelse ($products->where('stok', '>', 0) as $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos=""
                            data-aos-delay="{{ $incrementProduct += 100 }}">
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="
                                        @if ($product->galleries) background-image: url('{{ Storage::url($product->galleries->first()->photos ?? '') }}');
                                        @else
                                            background-color: #eee; @endif
                                    ">
                                    </div>
                                </div>
                                <div class="products-text">
                                    <span class="small">{{ $product->name }}</span>
                                </div>
                                <div class="products-price">
                                    @currency_format($product->price)
                                    <span class="float-right text-secondary small"><span class="font-weight-bold">{{ $product->jmlh_penjualan }}</span> Terjual</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="" >
                            Data Produk Kosong
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12 btn-shopee mt-3 mb-3 rounded pt-4 pb-2" data-aos="">
                        <h5 class="font-weight-bold btn-shopee">Produk Populare</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementProduct = 0 @endphp
                    @forelse ($produkPopulare->where('stok', '>', 0) as $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos=""
                            data-aos-delay="{{ $incrementProduct += 100 }}">
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="
                                        @if ($product->galleries) background-image: url('{{ Storage::url($product->galleries->first()->photos ?? '') }}');
                                        @else
                                            background-color: #eee; @endif
                                    ">
                                    </div>
                                </div>
                                <div class="products-text">
                                    <span class="small">{{ $product->name }}</span>
                                </div>
                                <div class="products-price">
                                    @currency_format($product->price)
                                    <span class="float-right text-secondary small"><span class="font-weight-bold">{{ $product->jmlh_penjualan }}</span> Terjual</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="" >
                            Data Produk Kosong
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
