<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');
Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');
Route::get('/bantuan', 'BantuanController@index')->name('bantuan');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');
    Route::get('/success', 'CartController@success')->name('success');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cartupdate', 'CartController@update')->name('cart.update');
    Route::post('/cart-ubah-alamat', 'CartController@cartUbahAlamat')->name('cart.cart-ubah-alamat');
    Route::post('/cart-ubah-pengiriman', 'CartController@cartUbahPengiriman')->name('cart.cart-ubah-pengiriman');
    Route::post('/cart', 'CartController@check_ongkir')->name('cart_check_ongkir');
    Route::get('/cities/{province_id}', 'CartController@getCities');
    Route::get('/subdistrict/{cities_id}', 'CartController@getSubdistrict');
    Route::get('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');
    Route::post('/callback', 'CheckoutController@callback')->name('midtrans-callbacks');

    Route::get('/dashboard', 'DashboardController@index')
        ->name('dashboard');

    Route::get('/dashboard/products', 'DashboardProductController@index')
        ->name('dashboard-product');
    Route::get('/dashboard/saldo', 'DashboarSaldoController@index')
        ->name('saldo');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')
        ->name('dashboard-product-create');
    Route::post('/dashboard/products', 'DashboardProductController@store')
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')
        ->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update')
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')
        ->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')
        ->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')
        ->name('dashboard-transaction');
    Route::get('/dashboard/transactions/tagihan', 'DashboardTransactionController@tagihan')
        ->name('dashboard-transaction-tagihan');
    Route::get('/dashboard/transactions/dibatalkan', 'DashboardTransactionController@dibatalkan')
        ->name('dashboard-transaction-dibatalkan');
    Route::get('/dashboard/transactions/selesai', 'DashboardTransactionController@selesai')
        ->name('dashboard-transaction-selesai');
    Route::get('/dashboard/transactions/dikirim', 'DashboardTransactionController@dikirim')
        ->name('dashboard-transaction-dikirim');
    Route::get('/dashboard/transactions/sedang-proses', 'DashboardTransactionController@sedangProses')
        ->name('dashboard-transaction-sedangproses');
    Route::get('/dashboard/transactions/belum-bayar', 'DashboardTransactionController@belumBayar')
        ->name('dashboard-transaction-belumbayar');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')
        ->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')
        ->name('dashboard-transaction-update');
    // Batalkan Pesanan
    Route::post('/dashboard/batalkan', 'DashboardTransactionController@batalkan')
        ->name('batalkan-pesanan');
    // Bayar Sekarang
    Route::post('/dashboard/bayar', 'DashboardTransactionController@bayarPesanan')
        ->name('bayar-pesanan');
    // Detail Pesanan
    Route::post('/dashboard/detail', 'DashboardTransactionController@detailPesanan')
        ->name('detail-pesanan');
    // Pesanan Diterima
    Route::post('/dashboard/pesanan-diterima', 'DashboardTransactionController@pesananDiterima')
        ->name('pesanan-diterima');

    Route::get('/dashboard/settings', 'DashboardSettingController@store')
        ->name('dashboard-settings-store');
    Route::get('/dashboard/account', 'DashboardSettingController@account')
        ->name('dashboard-settings-account');
    Route::post('/dashboard/update/{redirect}', 'DashboardSettingController@update')
        ->name('dashboard-settings-redirect');

    Route::get('/dashboard/alamat', 'DashboardAlamatController@index')
        ->name('dashboard-alamat');
    Route::get('/dashboard/tambah-alamat', 'DashboardAlamatController@tambahAlamat')
        ->name('dashboard-tambah-alamat');
    Route::get('/dashboard/edit-alamat/{id}', 'DashboardAlamatController@editAlamat')
        ->name('dashboard-edit-alamat');
    Route::post('/dashboard/proses-tambah-alamat', 'DashboardAlamatController@store')
        ->name('dashboard-proses-tambah-alamat');
    Route::post('/dashboard/proses-edit-alamat', 'DashboardAlamatController@prosesEditAlamat')
        ->name('dashboard-proses-edit-alamat');
    Route::post('/dashboard/alamat-utama', 'DashboardAlamatController@alamatUtama')
        ->name('dashboard-proses-alamat-utama');
    Route::post('/dashboard/alamat-toko', 'DashboardAlamatController@alamatToko')
        ->name('dashboard-proses-alamat-toko');
    Route::post('/dashboard/hapus-alamat', 'DashboardAlamatController@destroy')
        ->name('dashboard-proses-hapus-alamat');
    Route::get('saldo/tarik-saldo', 'TarikSaldoUserController@tarikSaldo')
        ->name('saldouser.tarik');
});

Route::prefix('toko')
    ->namespace('Admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::get('transaksi/cetak-laporan-penjualan', 'CetakLaporanController@index')->name('cetak-laporan.penjualan');
        Route::get('transaksi/cetak-laporan-penghasilan', 'CetakLaporanController@penghasilan')->name('cetak-laporan.penghasilan');
        Route::get('saldo-toko/tarik-saldo', 'TarikSaldoShopController@tarikSaldo')->name('saldotoko.tarik');
        Route::resource('category', 'CategoryController');
        Route::resource('penghasilan', 'PenghasilanController');
        Route::get('penghasilan/2', 'PenghasilanController@show')
            ->name('penghasilan.show');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::get('transaksi', 'TransactionController@index')
            ->name('transaction.index');
        Route::get('transaksi/belum-bayar', 'TransactionController@belumbayar')
            ->name('transaction.belumbayar');
        Route::get('transaksi/dalam-penagihan', 'TransactionController@dalampenagihan')
            ->name('transaction.dalampenagihan');
        Route::get('transaksi/perludiproses', 'TransactionController@perludiproses')
            ->name('transaction.perludiproses');
        Route::get('transaksi/perludikirim', 'TransactionController@perludikirim')
            ->name('transaction.perludikirim');
        Route::get('transaksi/perlupenagihan', 'TransactionController@sedangdiproses')
            ->name('transaction.sedangdiproses');
        Route::get('transaksi/dikirim', 'TransactionController@dikirim')
            ->name('transaction.dikirim');
        Route::get('transaksi/selesai', 'TransactionController@selesai')
            ->name('transaction.selesai');
        Route::get('transaksi/dibatalkan', 'TransactionController@dibatalkan')
            ->name('transaction.dibatalkan');
        Route::post('/transaksi/konfirmasi', 'TransactionController@konfirmasi')
            ->name('transactions-konfirmasi');
        Route::post('/transaksi/penagihan', 'TransactionController@penagihan')
            ->name('transactions-penagihan');
        Route::post('/transaksi/pengiriman', 'TransactionController@pengiriman')
            ->name('transactions-pengiriman');
        Route::get('transaksi/{id}', 'TransactionController@details')
            ->name('transactions-details');
        Route::post('/transaksi/{id}', 'TransactionController@trxupdate')
            ->name('transactions-update');
        Route::resource('buat-toko', 'ShopController');
        Route::get('pengaturan-toko', 'ShopController@pengaturanToko')
            ->name('pengaturan-toko');
        Route::resource('pesanan', 'PesananController');
        // Update Stok Produk
        Route::post('/product/update-stok', 'ProductController@updatestok')
            ->name('product.updatestok');
        // Update Harga Produk
        Route::post('/product/update-harga', 'ProductController@updateharga')
            ->name('product.updateharga');
        // Delete Image Produk 1-1
        Route::post('/gallery/update-image', 'ProductGalleryController@updateImage')
            ->name('gallery.update-image');
    });


Auth::routes();
