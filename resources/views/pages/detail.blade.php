@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Beranda</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Detail Produk
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="details col-md-4">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <h5 class="price"><i class="mdi mdi-cash-check"></i> Harga: <span>@currency_format($product->price)</span></h5>
                        <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6>Kuantitas <input type="number" name="qty" value="1" min="1" max="{{ $product->stok }}" style="width: 4em;text-align: center;" class="mr-2 ml-2"/> Tersisa: {{ $product->stok }}</h6>
                            <h6 class="review-no"><i class="mdi mdi-truck-fast-outline"></i> Dikirim dari:
                                {{ $city->city_name }}
                            </h6>
                            <span class="review-no"><i class="mdi mdi-shopping-outline"></i> Toko
                                {{ $product->shop->nama_toko }}</span>
                                <br>
                            <span class="review-no float-right mr-5">
                                <span class="font-weight-bold">{{ $product->jmlh_penjualan }}</span>
                            Terjual</span>
                            <div class="action mt-4">
                                @auth
                                    @if($dataToko->stts_toko == 1)
                                        @if($product->stok >= 1)
                                            <button type="submit" class="btn btn-shopee px-4 mb-3">
                                                <i class="mdi mdi-cart-arrow-down"></i> Add to Cart
                                            </button>
                                        @else
                                            <span class="btn btn-secondary px-4 mb-3">Stok Habis</span>
                                        @endif
                                    @else
                                        <span class="btn btn-secondary px-4 mb-3">Toko Sedang Libur</span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-shopee px-4 mb-3">
                                        <i class="mdi mdi-login"></i> Masuk untuk Membeli
                                    </a>
                                @endauth
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="">
            <section class="store-description">
                <div class="container">
                    <div style="width:100%;border-bottom:1px solid #ccc;">
                        <h4>Deskripsi Produk</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-12">
                            {{ $product->description }}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection



@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
@endpush
