<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');
Route::get('provinces', 'API\LocationController@provinces')->name('api-provinces');
Route::get('regencies/{provinces_id}', 'API\LocationController@regencies')->name('api-regencies');
Route::get('provincesid', 'API\LocationController@provincesid')->name('api-provincesid');
Route::get('regenciesid/{provinces_id}', 'API\LocationController@regenciesid')->name('api-regenciesid');

Route::group(['middleware' => ['auth:api']], function () {

    // Route::get('carts', 'API\CartController@index')->name('api-carts');
    // Route::post('carts', 'API\CartController@store')->name('api-carts-store');
    // Route::post('carts/{id}', 'API\CartController@update')->name('api-carts-update');
    // Route::delete('carts/{id}', 'API\CartController@destroy')->name('api-carts-destroy');
    // Route::get('carts/{id}', 'API\CartController@show')->name('api-carts-show');
    // Route::get('carts/check/{id}', 'API\CartController@check')->name('api-carts-check');
    // Route::get('carts/checkout/{id}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/check', 'API\CartController@check')->name('api-carts-check');
    // Route::get('carts/checkout', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}/{kode_pos}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}/{kode_pos}/{nama}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}/{kode_pos}/{nama}/{telepon}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}/{kode_pos}/{nama}/{telepon}/{email}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}/{kode_pos}/{nama}/{telepon}/{email}/{keterangan}', 'API\CartController@checkout')->name('api-carts-checkout');
    // Route::get('carts/checkout/{id}/{ongkir}/{kurir}/{service}/{resi}/{status}/{alamat}/{kota}/{kode_pos}/{nama}/{telepon}/{email}/{keterangan}/{status_pembayaran}', 'API\CartController@checkout')->name('api-carts-checkout');
});
