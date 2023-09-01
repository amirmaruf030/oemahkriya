@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css"
        rel="stylesheet" />

    <!-- Page Content -->
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cart
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">

                @if ($carts->count() > 0)
                <div class="row" data-aos="" >
                    <div class="col-12 table-responsive">
                        <div class="row" data-aos="">
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <h2 class="mb-4">Daftar Belanja</h2>
                            </div>
                        </div>
                        <div class="d-none d-sm-block">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <table class="table table-borderless table-cart">
                                    <thead>
                                        <tr class="btn-shopee">
                                            <td colspan="2" class="text-center">Produk</td>
                                            <td>Harga</td>
                                            <td>Jumlah</td>
                                            <td>Total</td>
                                            <td>Berat (gram)</td>
                                            <td>Hapus</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalPrice = 0 @endphp
                                        @php $totalPriceMobile = 0 @endphp
                                        @php $totalweigth = 0 @endphp
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td style="width: 20%;">
                                                    @if ($cart->product->galleries)
                                                        <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                                            alt="" class="cart-image" />
                                                    @endif
                                                </td>
                                                <td style="width: 35%;">
                                                    <div class="product-title">{{ $cart->product->name }}</div>
                                                    <div class="product-subtitle">by {{ $cart->product->shop->nama_toko }}
                                                    </div>
                                                </td>
                                                <td style="width: 30%;">
                                                    <div class="product-title">Rp. {{ number_format($cart->product->price) }}
                                                    </div>
                                                </td>
                                                <td style="width: 20%;" class="mr-4">
                                                    <input type="hidden" name="id[]" value="{{ $cart->id }}">
                                                    <input type="number" name="qty[]" min="0"
                                                        max="{{ $cart->product->stok }}" style="border: 0.5px solid black"
                                                        class="form-control" value="{{ $cart->qty }}">
                                                </td>
                                                <td style="width: 25%;">
                                                    <div class="product-title">
                                                        {{ number_format($cart->product->price * $cart->qty) }}
                                                    </div>
                                                </td>
                                                <td style="width: 10%;">
                                                    <div class="product-title">
                                                        {{ $cart->weight }}
                                                    </div>
                                                </td>
                                                <td style="width: 20%;">
                                                    <div class="product-title">
                                                        <a href="{{ route('cart-delete', $cart->id) }}" title="Hapus Item">
                                                            <i class="mdi mdi-delete text-danger mdi-24px"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $totalPrice +=  $cart->product->price * $cart->qty @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="cart-total float-right mr-4">
                                            <button class="btn btn-shopee btn-sm" type="submit">
                                                Update List
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile -->
                        <div class="table-responsive d-block d-sm-none">
                            <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th style="padding: 0;"><i class="fas fa-store"></i> {{ $cart->product->shop->nama_toko }}</th>
                                    </tr>
                                    </thead>
                                    @foreach ($carts as $cart)
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0; padding-top: 8px;">
                                            @if ($cart->product->galleries)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                                    alt="" style="width: 90px" class="img-thumbnail float-left mr-3" />
                                            @endif
                                            <span class="font-weight-bold">{{ $cart->product->name }}</span>
                                            <br>
                                            <span class="small text-dark">{{ number_format($cart->product->price) }}</span>
                                            <br>
                                            <span class="small text-muted">
                                                <input type="hidden" name="id[]" value="{{ $cart->id }}">
                                                <input type="number" name="qty[]" min="0"
                                                    max="{{ $cart->product->stok }}" style="width: 4em;text-align: center;" 
                                                    value="{{ $cart->qty }}">
                                            </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @php $totalPriceMobile +=  $cart->product->price * $cart->qty @endphp
                                    @endforeach
                                </table>
                                <button type="submit" class="btn btn-shopee btn-sm float-right">Update List</button>
                            </form>
                        </div>
                        <!-- Akhir Mobile -->

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <hr>
                        <h2 class="mb-2">Alamat Pengiriman</h2>

                        <!-- Desktop -->
                        <div class="d-none d-sm-block">
                            <table class="table table-borderless table-cart">
                                <tbody>
                                    <tr>
                                        <td style="width: 20%;">
                                        {{ $cartAlamat->nama }} <br> {{ $cartAlamat->no_telp }}
                                        </td>
                                        <td style="width: 60%;">
                                            {{ $cartAlamat->detail_alamat }}, {{ $cartAlamat->kota }} - {{ $cartAlamat->kecamatan }}, {{ $cartAlamat->provinsi }}, {{ $cartAlamat->kode_pos }}
                                        </td>
                                        <td style="width: 10%;">
                                            @if($cartAlamat->utama == 1)
                                            <p class="border border-primary d-inline-block p-1 mt-2" style="color:#3645a8; border-color: #3645a8;"> Utama </p>
                                            @endif
                                        </td>
                                        <td style="width: 10%;" class="mr-4">
                                            <a href="" class="float-right font-weight-bold text-decoration-none mt-3" data-toggle="modal" data-target="#alamatModal">
                                            UBAH
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                        </div>

                        <!-- Mobile -->
                        <div class="table-responsive d-block d-sm-none">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold">{{ $cartAlamat->nama }}</span> | {{ $cartAlamat->no_telp }} <br>
                                            {{ $cartAlamat->detail_alamat }} <br>
                                            {{ $cartAlamat->kecamatan }}, {{ $cartAlamat->kota }}, {{ $cartAlamat->provinsi }}, {{ $cartAlamat->kode_pos }} <br>
                                            <div class="float-right">
                                                <a href="" class="font-weight-bold text-decoration-none mt-3" data-toggle="modal" data-target="#alamatModal">
                                                UBAH
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                
                {{--  Form Checkout Desktop  --}}
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data" class="d-none d-sm-block">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" name="alamat" value="{{ $cartAlamat->id }}">
                    <h2 class="mt-4">Pilih Jasa Expedisi dan Service Ongkir</h2>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card_">
                                <div class="card-body">
                                    <h2>Catatan</h2>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="catatan" class="col-sm-2 col-form-label">Catatan: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="catatan" placeholder="(Optional)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card_">
                                <div class="card-body">
                                    <h2>Kurir</h2>
                                    <hr>
                                    <div class="form-group">
                                        <span>Opsi Pengiriman:</span>
                                        <span class="font-weight-bold text-uppercase">{{ $carts->first()->pengiriman }}</span>
                                        <!-- Button trigger modal -->
                                        <a href="" class="float-right font-weight-bold text-decoration-none" data-toggle="modal" data-target="#pengirimanModal">
                                        UBAH
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card_">
                                <div class="card-body">
                                    <h2>Service</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label>Pilih Ongkir</label>
                                        <select class="form-control kota-tujuan" name="service_ongkir" required="required">
                                        <option value="">-- pilih service --</option>
                                        @php for ($i = 0; $i < $num_services; $i++) {
                                            $service = $services[$i]['service'];
                                            $description = $services[$i]['service'];
                                            $service_etd = $array_result['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['etd'];
                                            $service_value = $array_result['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['value'];
                                        
                                            echo '<option value="'.$service_value.'">' . strtoupper($jasaKirim).': ' . $service . ' - Rp. ' . $service_value . ' (' . $service_etd . ' Hari) </option>';
                                        }
                                        @endphp
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ongkos Kirim (Rp.)</label>
                                        <input type="number" class="form-control" name="costongkir" id="costongkir"
                                            placeholder="" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2 class="mb-1">Total Tagihan Pembayaran</h2>
                        </div>
                    </div>
                    {{--  Desktop  --}}
                    <div class="row">
                            <div class="col-4 col-md-2">
                                <div class="product-title text-success">Rp {{ number_format($totalPrice ?? 0) }}</div>
                                <span>Biaya DP : <span class="font-weight-bold">Rp{{ number_format($totalPrice*0.3) }}</span></span>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="product-subtitle">Ongkos kirim otomatis ditambahkan total tagihan Checkout</div>
                            </div>
                            <div class="col-4 col-md-3">
                                <select class="form-control" name="payment_system" required="required">
                                    <option value="">-- Pilih Sistem Pembayaran --</option>
                                    <option value="DP">DP</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                            <div class="col-8 col-md-3">
                                <button type="submit" class="btn btn-shopee btn-block">
                                    Checkout
                                </button>
                            </div>
                    </div>
                    {{--  Akhir Desktop  --}}
                </form>

                {{--  Form Checkout Mobile  --}}
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data" class="d-block d-sm-none">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" name="alamat" value="{{ $cartAlamat->id }}">
                    <h2 class="mt-4">Pilih Jasa Expedisi, Kurir dan Service Ongkir</h2>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="card_">
                                <div class="card-body">
                                    <h2>Kurir</h2>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Catatan: </label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" name="catatan" placeholder="(Optional)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card_">
                                <div class="card-body">
                                    <h2>Kurir</h2>
                                    <hr>
                                    <div class="form-group">
                                        <span>Opsi Pengiriman:</span>
                                        <span class="font-weight-bold text-uppercase">{{ $carts->first()->pengiriman }}</span>
                                        <!-- Button trigger modal -->
                                        <a href="" class="float-right font-weight-bold text-decoration-none" data-toggle="modal" data-target="#pengirimanModal">
                                        UBAH
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card_">
                                <div class="card-body">
                                    <h2>Service</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label>Pilih Ongkir</label>
                                        <select class="form-control kota-tujuan" name="service_ongkir" required="required">
                                        <option value="">-- pilih service --</option>
                                        @php for ($i = 0; $i < $num_services; $i++) {
                                            $service = $services[$i]['service'];
                                            $description = $services[$i]['service'];
                                            $service_etd = $array_result['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['etd'];
                                            $service_value = $array_result['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['value'];
                                        
                                            echo '<option value="'.$service_value.'">' . strtoupper($jasaKirim).': ' . $service . ' - Rp. ' . $service_value . ' (' . $service_etd . ' Hari) </option>';
                                        }
                                        @endphp
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ongkos Kirim (Rp.)</label>
                                        <input type="number" class="form-control" name="costongkir" id="costongkir2"
                                            placeholder="" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2 class="mb-1">Total Tagihan Pembayaran</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-title text-success">Rp. {{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Ongkos kirim otomatis ditambahkan total tagihan setelah Checkout</div>
                            <select class="form-control" name="payment_system" required="required">
                                <option value="">-- Pilih Sistem Pembayaran --</option>
                                <option value="DP">DP</option>
                                <option value="Cash">Cash</option>
                            </select>
                            <button type="submit" class="btn btn-shopee btn-block">
                                Checkout
                            </button>
                        </div>
                    </div>
                </form>
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <strong>Maaf!</strong> Anda belum memiliki barang di keranjang belanja.
                            </div>
                        </div>
                @endif
            </div>
        </section>
    </div>

    <!-- Modal Ubah Alamat -->
    <div class="modal fade" id="alamatModal" tabindex="-1" aria-labelledby="alamatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('cart.cart-ubah-alamat') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="alamatModalLabel">Alamat Saya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                @forelse ($alamatUser->alamat as $alamat)
                                    <div class="form-check">
                                        @if($alamat->id == $cartAlamat->id)
                                            <input class="form-check-input" type="radio" name="alamat_id" id="{{ $alamat->id }}" value="{{ $alamat->id }}" checked required="" >
                                        @else
                                            <input class="form-check-input" type="radio" name="alamat_id" id="{{ $alamat->id }}" value="{{ $alamat->id }}" required="" >
                                        @endif
                                        <label class="form-check-label btn-block" for="{{ $alamat->id }}">
                                            {{$alamat->nama }} | {{$alamat->no_telp }} <br> {{$alamat->detail_alamat }} <br>{{$alamat->kecamatan }}, {{$alamat->kota }}, {{$alamat->provinsi }}, {{$alamat->kode_pos }} <hr>
                                        </label>
                                    </div>
                                @empty
                                <div class="form-check">
                                    -== Alamat Kosong ==-
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-shopee">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Pengiriman -->
    @if($carts->first() != null)
        <div class="modal fade" id="pengirimanModal" tabindex="-1" aria-labelledby="pengirimanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('cart.cart-ubah-pengiriman') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="pengirimanModalLabel">Pilih Opsi Pengiriman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="expeditions_id" id="jne" value="jne" @if($carts->first()->pengiriman == 'jne') checked @endif required="">
                                    <label class="form-check-label btn-block" for="jne">
                                        JNE
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="expeditions_id" id="pos" value="pos" @if($carts->first()->pengiriman == 'pos') checked @endif required="">
                                    <label class="form-check-label btn-block" for="pos">
                                        POS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="expeditions_id" id="tiki" value="tiki" @if($carts->first()->pengiriman == 'tiki') checked @endif required="">
                                    <label class="form-check-label btn-block" for="tiki">
                                        TIKI
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-shopee">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                this.getProvincesData();
                this.getRegenciesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: "{{ $cart->user->provinces_id ?? null }}",
                regencies_id: "{{ $cart->user->regencies_id ?? null }}",
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
            }
        });
        //raja ongkir js
        $(document).ready(function() {
            //active select2
            $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
                theme: 'bootstrap4',
                width: 'style',
            });
            //ajax select kota asal
            $('select[name="province_origin"]').on('change', function() {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/' + provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="city_origin"]').empty();
                            $('select[name="city_origin"]').append(
                                '<option value="">-- pilih kota asal --</option>');
                            $.each(response, function(key, value) {
                                $('select[name="city_origin"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_origin"]').append(
                        '<option value="">-- pilih kota asal --</option>');
                }
            });
            //ajax select kota tujuan
            $('select[name="province_destination"]').on('change', function() {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/' + provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="city_destination"]').empty();
                            $('select[name="city_destination"]').append(
                                '<option value="">-- pilih kota tujuan --</option>');
                            $.each(response, function(key, value) {
                                $('select[name="city_destination"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_destination"]').append(
                        '<option value="">-- pilih kota tujuan --</option>');
                }
            });
            //ajax select service ongkir
            $('select[name="courier"]').on('change', function(e) {
                let courier = $(this).val();
                if (courier) {
                    e.preventDefault();

                    let token = $("meta[name='csrf-token']").attr("content");
                    let city_origin = $('select[name=city_origin]').val();
                    let city_destination = $('select[name=city_destination]').val();
                    let courier = $('select[name=courier]').val();
                    let weight = $('#weight').val();

                    if (isProcessing) {
                        return;
                    }

                    isProcessing = true;
                    jQuery.ajax({
                        url: "/cart",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _token: token,
                            city_origin: city_origin,
                            city_destination: city_destination,
                            courier: courier,
                            weight: weight,
                        },
                        dataType: "JSON",
                        type: "POST",
                        success: function(response) {
                            isProcessing = false;
                            if (response) {
                                $('#ongkir').empty();
                                $('.ongkir').addClass('d-block');
                                $('select[name="service_ongkir"]').empty();
                                $('select[name="service_ongkir"]').append(
                                    '<option value="">-- pilih service --</option>');
                                $.each(response[0]['costs'], function(key, value) {
                                    $('select[name="service_ongkir"]').append(
                                        '<option value="' + value.cost[
                                            0].value + '">' + response[0].code
                                        .toUpperCase() + ' : <strong>' +
                                        value.service + '</strong> - Rp. ' + value
                                        .cost[
                                            0].value + ' (' + value.cost[0].etd +
                                        ' hari)</li></option>');
                                });

                            }
                        }
                    });
                } else {
                    $('select[name="service_ongkir"]').append(
                        '<option value="">-- pilih service --</option>');
                }
            });

            //ajax check ongkir
            let isProcessing = false;
            $('.btn-check').click(function(e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let city_origin = $('select[name=city_origin]').val();
                let city_destination = $('select[name=city_destination]').val();
                let courier = $('select[name=courier]').val();
                let weight = $('#weight').val();

                if (isProcessing) {
                    return;
                }

                isProcessing = true;
                jQuery.ajax({
                    url: "/cart",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _token: token,
                        city_origin: city_origin,
                        city_destination: city_destination,
                        courier: courier,
                        weight: weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(response) {
                        isProcessing = false;
                        if (response) {
                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            $('select[name="service_ongkir"]').empty();
                            $('select[name="service_ongkir"]').append(
                                '<option value="">-- pilih kota service --</option>');
                            $.each(response[0]['costs'], function(key, value) {
                                $('select[name="service_ongkir"]').append(
                                    '<option value="' + value.cost[
                                        0].value + '">' + response[0].code
                                    .toUpperCase() + ' : <strong>' +
                                    value.service + '</strong> - Rp. ' + value.cost[
                                        0].value + ' (' + value.cost[0].etd +
                                    ' hari)</li></option>');
                            });

                        }
                    }
                });

            });

            //ajax service ongkir to input value
            $('select[name="service_ongkir"]').on('change', function() {
            let costongkir = $(this).val();
            // alert(costongkir);
            document.getElementById('costongkir').value = costongkir;
            document.getElementById('costongkir2').value = costongkir;
            
            // menjumlahkan nilai variabel costongkir dengan nilai variabel $totalPrice
            let totalPrice = {{ $totalPrice ?? 0 }};
            let totalHarga = parseInt(costongkir) + parseInt(totalPrice);
            
            // menampilkan nilai total harga pada halaman
            $('div.product-title.text-success').text('Rp. ' + numberWithCommas(totalHarga));
        });
        
        // fungsi untuk menambahkan separator ribuan pada angka
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

            });
    </script>
@endpush
