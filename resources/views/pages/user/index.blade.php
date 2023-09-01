@extends('layouts.app')

@section('title')
Bantuan Page
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<!-- Page Content -->
<div class="page-content page-cart">

    <section class="store-cart">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-12 table-responsive">
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-md-12">
                            <div class="card_">
                                <div class="card-body rounded mb-3" style="background:#5f6ecc; color:#fff;">
                                    <div class="text-center">
                                        <h5>Selamat datang di layanan bantuan! <br>Kami telah menyusun FAQ panduan untuk mengoptimalkan pengalaman penjualan dan pembelian di Oemah Kriya.</h5>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="address">
                                                {{--  <h6>Belanja Di Oemah Kriya:</h6>  --}}

                                                <div class="accordion" id="accordionExample">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-shopee btn-block text-left text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Belanja Di Oemah Kriya
                                                        </button>
                                                    </h2>

                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="list-group" id="list-tab" role="tablist">
                                                                        {{-- Faq 1  --}}
                                                                        <a class="list-group-item list-group-item-action active small" id="list-faq1-list" data-toggle="list" href="#list-faq1" role="tab" aria-controls="faq1">Bagaimana cara mencari produk di Oemah Kriya?</a>
                                                                        {{-- Faq 2  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq2-list" data-toggle="list" href="#list-faq2" role="tab" aria-controls="faq2">Bagaimana cara melakukan checkout di Oemah Kriya?</a>
                                                                        {{-- faq 3  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq3-list" data-toggle="list" href="#list-faq3" role="tab" aria-controls="faq3">Bagaimana cara membayar tagihan pesanan pada sistem pembayaran DP?</a>
                                                                        {{-- Faq 4  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq4-list" data-toggle="list" href="#list-faq4" role="tab" aria-controls="faq4">Syarat & Ketentuan pembatalan pesanan</a>
                                                                        {{-- Faq 5  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq5-list" data-toggle="list" href="#list-faq5" role="tab" aria-controls="faq5">Apa itu sistem pembayaran DP pada Oemah Kriya?</a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="list-faq1" role="tabpanel" aria-labelledby="list-faq1-list">
                                                                            <h5 class="text-center">Bagaimana cara mencari produk di Oemah Kriya?</h5>
                                                                            <hr>
                                                                            <p>Ada dua cara yang dapat Anda gunakan untuk mencari produk</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Pada Halaman Beranda</li>
                                                                                Scroll kebawah di beranda website Oemah Kriya untuk melihat produk <span class="font-weight-bold">Terbaru</span> dan <span class="font-weight-bold">Terpopular</span>.
                                                                                <img src="/images/produk_beranda.gif" alt="Produk Beranda" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Pada Halaman Kategori</li>
                                                                                Pilih menu kategori di daftar menu Oemah Kriya > Pilih kategori Produk untuk melihat produk berdasarkan <span class="font-weight-bold">Kategori</span> produk yang lebih spesifik.
                                                                                <img src="/images/produk_karegori.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                            
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq2" role="tabpanel" aria-labelledby="list-faq2-list">
                                                                            <h5 class="text-center">Bagaimana cara melakukan checkout di Oemah Kriya?</h5>
                                                                            <hr>
                                                                            <p>Setelah Anda melakukan pencarian produk dan membuat keputusan tentang barang yang ingin Anda beli, Anda dapat melanjutkan tahap pembelian dengan menggunakan langkah-langkah berikut:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Beli dan checkout segera</li>
                                                                                Di halaman produk, Anda dapat memilih opsi <span class="font-weight-bold">Add to Cart</span> > pilih <span class="font-weight-bold">Opsi Pengiriman</span> yang Anda inginkan > pilih <span class="font-weight-bold">Sistem Pembayaran</span> yang sesuai > klik <span class="font-weight-bold">Checkout</span> untuk melanjutkan proses pemesanan.
                                                                                <img src="/images/checkout.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq3" role="tabpanel" aria-labelledby="list-faq3-list">
                                                                            <h5 class="text-center">Bagaimana cara membayar tagihan pesanan pada sistem pembayaran DP?</h5>
                                                                            <hr>
                                                                            <p>Setelah produk sudah siap untuk dikirim, Toko akan mengirimkan tagihan pelunasan pembayaran kepada Anda. Untuk melanjutkan pembayaran tagihan pesanan, Anda dapat mengikuti langkah-langkah berikut:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Bayar Tagihan Sekarang</li>
                                                                                Pada menu halaman, Anda dapat memilih opsi <span class="font-weight-bold">Pesanan Saya</span> > pilih opsi <span class="font-weight-bold">Tagihan</span> > pilih opsi <span class="font-weight-bold">Bayar Sekarang</span> untuk melanjutkan proses pembayaran.
                                                                                <img src="/images/bayar-tagihan.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq4" role="tabpanel" aria-labelledby="list-faq4-list">
                                                                            <h5 class="text-center">Syarat & Ketentuan pembatalan pesanan</h5>
                                                                            <hr>
                                                                            <p>Berikut adalah beberapa ketentuan yang berlaku terkait pembatalan pesanan di platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Saldo Dikembalikan Sepenuhnya</li>
                                                                                Ketika pelanggan membatalkan pesanan dan status pesanan masih dalam proses "Menunggu Konfirmasi", maka saldo akan dikembalikan sepenuhnya kepada pelanggan.
                                                                                <img src="/images/menunggu_konfirmasi.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Saldo Dikembalikan Sebagian</li>
                                                                                Sebagian saldo akan dikembalikan kepada pelanggan jika mereka membatalkan pesanan setelah pesanan tersebut dikonfirmasi oleh Toko dan menggunakan sistem pembayaran tunai (Cash) atau uang muka (DP) dengan pembayaran yang telah dilunasi sepenuhnya. Kebijakan pengembalian saldo saat ini di Oemah Kriya adalah sebesar 70% dari total harga produk ditambah dengan total biaya pengiriman.
                                                                                <img src="/images/pengembalian_sebagian.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Saldo Diserahkan Ke Toko</li>
                                                                                Jumlah saldo yang ada akan sepenuhnya diserahkan kepada Toko jika pelanggan membatalkan pesanan setelah pesanan tersebut dikonfirmasi oleh Toko dan menggunakan sistem pembayaran uang muka (DP) tanpa melunasi tagihan yang belum dibayar.
                                                                                <img src="/images/serahkan_toko.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq5" role="tabpanel" aria-labelledby="list-faq5-list">
                                                                            <h5 class="text-center">Apa itu sistem pembayaran DP pada Oemah Kriya?</h5>
                                                                            <hr>
                                                                            <p>Berikut adalah penjelasan mengenai sistem pembayaran DP di Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">DP (Down Payment) atau Uang Muka</li>
                                                                                DP (uang muka) pada Oemah Kriya adalah jumlah uang yang harus dibayarkan oleh pelanggan sebagai pembayaran awal saat melakukan pemesanan produk. Persentase uang muka yang berlaku di Oemah Kriya adalah 30% dari total harga pembelian produk. Pembayaran DP ini merupakan tanda komitmen dari pelanggan sebelum toko memulai proses produksi untuk produk yang dipesan oleh pelanggan.
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-shopee btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Berjualan Di Oemah Kriya
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="list-group" id="list-tab" role="tablist">
                                                                        {{-- Faq 6  --}}
                                                                        <a class="list-group-item list-group-item-action active small" id="list-faq6-list" data-toggle="list" href="#list-faq6" role="tab" aria-controls="faq6">Bagaimana membuat toko di Oemah Kriya?</a>
                                                                        {{-- Faq 7  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq7-list" data-toggle="list" href="#list-faq7" role="tab" aria-controls="faq7">Bagaimana menambah / mengedit / menghapus produk di toko saya?</a>
                                                                        {{-- faq 8  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq8-list" data-toggle="list" href="#list-faq8" role="tab" aria-controls="faq8">Bagaimana melakukan konfirmasi pesanan?</a>
                                                                        {{-- Faq 9  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq9-list" data-toggle="list" href="#list-faq9" role="tab" aria-controls="faq9">Bagaimana cara mengirimkan tagihan untuk pemesanan DP?</a>
                                                                        {{-- Faq 10  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq10-list" data-toggle="list" href="#list-faq10" role="tab" aria-controls="faq10">Bagaimana cara mengirim pesanan dan input resi pengiriman?</a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="list-faq6" role="tabpanel" aria-labelledby="list-faq6-list">
                                                                            <h5 class="text-center">Bagaimana membuat toko di Oemah Kriya?</h5>
                                                                            <hr>
                                                                            <p>Berikut ini adalah langkah-langkah untuk membuat toko di platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Membuat Toko</li>
                                                                                Setelah Anda berhasil mendaftarkan akun dan menambahkan alamat di platform Oemah Kriya, langkah pertama pada halaman menu pilih opsi <span class="font-weight-bold">Profile</span> > selanjutnya pilih <span class="font-weight-bold">Toko Saya</span> > kemudian isi formulir dengan <span class="font-weight-bold">Nama Toko</span> yang diinginkan > pilih <span class="font-weight-bold">Alamat Toko</span> yang sesuai > unggah foto sebagai <span class="font-weight-bold">Logo Toko</span> > terakhir pilih opsi <span class="font-weight-bold">Simpan</span> untuk menyelesaikan pembuatan toko.
                                                                                <img src="/images/buat-toko.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq7" role="tabpanel" aria-labelledby="list-faq7-list">
                                                                            <h5 class="text-center">Bagaimana menambah/mengedit/menghapus produk di toko saya?</h5>
                                                                            <hr>
                                                                            <p>Berikut ini adalah langkah-langkah dalam mengelola produk di platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Membuat Produk</li>
                                                                                Untuk membuat dan mengelola produk, langkah pertama adalah masuk ke <span class="font-weight-bold">Halaman Toko</span> > kemudian pilih menu <span class="font-weight-bold">Produk</span> > selanjutnya pilih opsi <span class="font-weight-bold">Tambah Produk Baru</span> > unggah <span class="font-weight-bold">Foto Produk</span> yang diinginkan > Setelah itu, lengkapi informasi produk dengan mengisi <span class="font-weight-bold">Data Produk</span> > klik <span class="font-weight-bold">Simpan</span> untuk membuat produk tersebut.
                                                                                <img src="/images/membuat-produk.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Edit Produk</li>
                                                                                Untuk mengubah <span class="font-weight-bold">Data Produk</span>, langkah pertama adalah masuk ke <span class="font-weight-bold">Halaman Produk</span> di platform Oemah Kriya > pilih opsi <span class="font-weight-bold">Ubah</span> untuk memulai pengeditan > Anda dapat mengubah <span class="font-weight-bold">Foto Produk</span> dan memperbarui <span class="font-weight-bold">Data Produk</span> yang diinginkan > pilih opsi <span class="font-weight-bold">Simpan</span> untuk menyimpan perubahan.
                                                                                <img src="/images/ubah-produk.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Hapus Produk</li>
                                                                                Anda dapat menghapus produk dengan masuk ke <span class="font-weight-bold">Halaman Produk</span> pada platform Oemah Kriya > pilih opsi <span class="font-weight-bold">Hapus</span> untuk menghapus produk yang diinginkan.
                                                                                <img src="/images/hapus-produk.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq8" role="tabpanel" aria-labelledby="list-faq8-list">
                                                                            <h5 class="text-center">Bagaimana melakukan konfirmasi pesanan?</h5>
                                                                            <hr>
                                                                            <p>Berikut ini adalah langkah-langkah dalam melakukan konfirmasi pesanan di platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li>Konfirmasi Pesanan</li>
                                                                                Untuk melakukan konfirmasi pesanan, langkah pertama adalah masuk ke <span class="font-weight-bold">Halaman Toko</span> > pilih menu <span class="font-weight-bold">Dashboard</span> pada platform Oemah Kriya > pilih opsi <span class="font-weight-bold">Perlu Diproses</span> untuk melihat pesanan yang perlu dikonfirmasi > pilih opsi <span class="font-weight-bold">Atur Pesanan</span> untuk mengakses detail pesanan yang ingin dikonfirmasi > pilih opsi <span class="font-weight-bold">Konfirmasi Pesanan</span> > klik <span class="font-weight-bold">Simpan</span> untuk menyimpan konfirmasi pesanan.
                                                                                <img src="/images/konfirmasi-pesanan.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq9" role="tabpanel" aria-labelledby="list-faq9-list">
                                                                            <h5 class="text-center">Bagaimana cara mengirimkan tagihan untuk pemesanan DP?</h5>
                                                                            <hr>
                                                                            <p>Berikut ini adalah langkah-langkah untuk mengirimkan tagihan pelunasan biaya pada platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li>Pengiriman Tagihan Pelanggan</li>
                                                                                Untuk mengirimkan <span class="font-weight-bold">Tagihan Pesanan</span>, langkah pertama adalah masuk ke <span class="font-weight-bold">Halaman Toko</span> di platform Oemah Kriya > pilih menu <span class="font-weight-bold">Dashboard</span> > pilih opsi <span class="font-weight-bold">Perlu Penagihan</span> untuk melihat pesanan yang membutuhkan tagihan > pilih opsi <span class="font-weight-bold">Ajukan Tagihan</span> > pilih opsi <span class="font-weight-bold">Kirim Sekarang</span> untuk mengirimkan tagihan kepada pelanggan.
                                                                                <img src="/images/atur-penagihan.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq10" role="tabpanel" aria-labelledby="list-faq10-list">
                                                                            <h5 class="text-center">Bagaimana cara mengirim pesanan dan input resi pengiriman?</h5>
                                                                            <hr>
                                                                            <p>Berikut adalah langkah-langkah untuk mengirim pesanan dan memasukkan nomor resi pengiriman pada platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Pengiriman Pesanan</li>
                                                                                Langkah pertama dalam <span class="font-weight-bold">Mengirim Pesanan</span> di platform Oemah Kriya adalah dengan mengirimkan pesanan kepada jasa pengiriman yang tercantum pada pesanan > masuk ke <span class="font-weight-bold">Halaman Toko</span> di platform Oemah Kriya > pilih menu <span class="font-weight-bold">Dashboard</span> > cari opsi <span class="font-weight-bold">Perlu Dikirim</span> untuk melihat pesanan yang perlu dikirim > pilih opsi <span class="font-weight-bold">Atur Pengiriman</span> > masukkan <span class="font-weight-bold">Resi Pengiriman</span> yang sesuai > klik opsi <span class="font-weight-bold">Simpan</span> untuk menyimpan informasi pengiriman yang telah diinputkan.
                                                                                <img src="/images/pengiriman.gif" alt="Produk Kategori" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-shopee btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            Akun Pelanggan & Toko
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div class="list-group" id="list-tab" role="tablist">
                                                                        {{-- Faq 11  --}}
                                                                        <a class="list-group-item list-group-item-action active small" id="list-faq11-list" data-toggle="list" href="#list-faq11" role="tab" aria-controls="faq11">Bagaimana cara menambah / mengedit / menghapus alamat saya?</a>
                                                                        {{-- Faq 12  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq12-list" data-toggle="list" href="#list-faq12" role="tab" aria-controls="faq12">Bagaimana cara mengedit profile akun saya?</a>
                                                                        {{-- faq 13  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq13-list" data-toggle="list" href="#list-faq13" role="tab" aria-controls="faq13">Bagaimana cara mengedit profile Toko saya?</a>
                                                                        {{-- Faq 14  --}}
                                                                        <a class="list-group-item list-group-item-action small" id="list-faq14-list" data-toggle="list" href="#list-faq14" role="tab" aria-controls="faq14">Bagaimana cara mengubah alamat toko saya?</a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="list-faq11" role="tabpanel" aria-labelledby="list-faq11-list">
                                                                            <h5 class="text-center">Bagaimana cara menambah/mengedit/menghapus alamat saya?</h5>
                                                                            <hr>
                                                                            <p>Berikut adalah langkah-langkah dalam mengelola alamat pada platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Tambah Alamat</li>
                                                                                Untuk menambahkan alamat , langkah pertama adalah dengan mengklik <span class="font-weight-bold">Profil</span> Anda pada platform Oemah Kriya > pilih opsi <span class="font-weight-bold">Alamat</span> > pilih <span class="font-weight-bold">Tambah Alamat Baru</span> > Masukkan <span class="font-weight-bold">Data Alamat</span> > pilih opsi <span class="font-weight-bold">Simpan</span> untuk menyimpan alamat yang baru.
                                                                                <img src="/images/tambah-alamat.gif" alt="Tambah Alamat" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Edit Alamat</li>
                                                                                Untuk melakukan pengeditan alamat pada platform Oemah Kriya, langkah pertama adalah masuk ke <span class="font-weight-bold">Halaman Alamat</span> > pilih opsi <span class="font-weight-bold">Ubah</span> untuk memulai pengeditan > Anda dapat mengubah <span class="font-weight-bold">Data Alamat</span> yang diinginkan > pilih opsi <span class="font-weight-bold">Simpan</span> untuk menyimpan perubahan yang telah dilakukan.
                                                                                <img src="/images/ubah-alamat.gif" alt="Ubah Alamat" class="mt-3">
                                                                            </ul>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Hapus Alamat</li>
                                                                                Anda dapat menghapus alamat pada platform Oemah Kriya dengan masuk ke <span class="font-weight-bold">Halaman Alamat</span> > pilih opsi <span class="font-weight-bold">Hapus</span> untuk menghapus alamat yang dimaksud. Namun, <span class="font-weight-bold text-danger">perlu diperhatikan bahwa jika hanya terdapat satu alamat, maka tidak akan ada opsi untuk menghapusnya</span>.
                                                                                <img src="/images/hapus-alamat.png" alt="Ubah Alamat" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq12" role="tabpanel" aria-labelledby="list-faq12-list">
                                                                            <h5 class="text-center">Bagaimana cara mengedit profile akun saya?</h5>
                                                                            <hr>
                                                                            <p>Berikut ini adalah langkah-langkah untuk mengedit profile akun pada platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Edit Profile</li>
                                                                                Untuk mengedit profil pada platform Oemah Kriya, langkah pertama adalah dengan memilih opsi <span class="font-weight-bold">Profile</span> di menu > pilih opsi <span class="font-weight-bold">Akun Saya</span> > mengubah <span class="font-weight-bold">Foto Profil</span> atau mengedit <span class="font-weight-bold">Data Profil</span> > pilih opsi <span class="font-weight-bold">Simpan</span> untuk menyimpan perubahan yang telah dilakukan.
                                                                                <img src="/images/ubah-profile.gif" alt="Ubah Profile" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq13" role="tabpanel" aria-labelledby="list-faq13-list">
                                                                            <h5 class="text-center">Bagaimana cara mengedit profile Toko saya?</h5>
                                                                            <hr>
                                                                            <p>Berikut adalah langkah-langkah untuk mengedit profil toko pada platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Edit Profil Toko</li>
                                                                                Langkah pertama dalam mengedit profil Toko pada platform Oemah Kriya adalah dengan memilih opsi <span class="font-weight-bold">Profile</span> di menu > pilih opsi <span class="font-weight-bold">Toko Saya</span> > pilih <span class="font-weight-bold">Pengaturan Toko</span> > ubah data toko seperti <span class="font-weight-bold">Foto, Nama Toko, dan Status Toko</span> > pilih opsi <span class="font-weight-bold">Simpan</span> untuk menyimpan perubahan.
                                                                                <img src="/images/edit-profile-toko.gif" alt="Ubah Profile Toko" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="list-faq14" role="tabpanel" aria-labelledby="list-faq14-list">
                                                                            <h5 class="text-center">Bagaimana cara mengubah alamat toko saya?</h5>
                                                                            <hr>
                                                                            <p>Berikut ini adalah langkah-langkah untuk mengubah alamat toko pada platform Oemah Kriya:</p>
                                                                            <ul>
                                                                                <li class="font-weight-bold">Ubah Alamat Toko</li>
                                                                                Untuk mengubah Alamat Toko pada platform Oemah Kriya, langkah pertama adalah masuk ke <span class="font-weight-bold">Halaman Alamat</span> > pilih alamat yang ingin diubah > pilih opsi <span class="font-weight-bold">Lainnya</span> > pilih opsi <span class="font-weight-bold">Jadikan Alamat Toko</span> untuk mengubahnya menjadi alamat toko yang baru.
                                                                                <img src="/images/ubah-alamat-toko.gif" alt="Ubah Alamat Toko" class="mt-3">
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-5">
                                                <div class="mapouter">
                                                    <div class="gmap_canvas"><iframe width="406" height="295"
                                                            id="gmap_canvas"
                                                            src="https://maps.google.com/maps?q=sidoharjo,sragen&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                            frameborder="0" scrolling="no" marginheight="0"
                                                            marginwidth="0"></iframe><a
                                                            href="https://2piratebay.org"></a><br>
                                                        <style>
                                                            .mapouter {
                                                                position: relative;
                                                                text-align: right;
                                                                height: 295px;
                                                                width: 406px;
                                                            }
                                                        </style><a href="https://www.embedgooglemap.net">embedding
                                                            google maps in html</a>
                                                        <style>
                                                            .gmap_canvas {
                                                                overflow: hidden;
                                                                background: none !important;
                                                                height: 295px;
                                                                width: 406px;
                                                            }
                                                        </style>
                                                    </div>
                                                </div>
                                            </div>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush