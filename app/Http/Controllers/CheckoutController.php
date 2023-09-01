<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Alamat;
use App\Transaction;
use App\Models\Pengiriman;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Proses checkout
        $code = 'STORE-' . mt_rand(0000, 9999);
        $carts = Cart::with(['product.shop', 'product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        foreach ($carts as $dataProduk) {
            $produk = $dataProduk->product;
            $produk->stok -= $dataProduk->qty;
            $produk->save();
        }

        if ($request->payment_system == 'DP') {
            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'shops_id' => $carts->first()->product->shop->id,
                'payment_system' => 'DP',
                'shipping_price' => $request->costongkir,
                'total_harga_produk' => $request->total_price,
                'total_price' => $request->total_price + $request->costongkir,
                'downpayment' => $request->total_price * 0.30,
                'tagihan' => ($request->total_price + $request->costongkir) - ($request->total_price * 0.30),
                'transaction_status' => 'BELUM BAYAR',
                'catatan' => $request->catatan,
                'code' => $code
            ]);
        } else {
            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'shops_id' => $carts->first()->product->shop->id,
                'payment_system' => 'Cash',
                'shipping_price' => $request->costongkir,
                'total_harga_produk' => $request->total_price,
                'total_price' => $request->total_price + $request->costongkir,
                'downpayment' => $request->total_price * 0.30,
                'tagihan' => ($request->total_price + $request->costongkir) - ($request->total_price * 0.30),
                'transaction_status' => 'BELUM BAYAR',
                'catatan' => $request->catatan,
                'code' => $code
            ]);
        }

        // Buat data detail transaksi
        foreach ($carts as $cart) {
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'nama_produk' => $cart->product->name,
                'price' => $cart->product->price,
                'qty' => $cart->qty,
                'image' => $cart->product->galleries->first()->photos
            ]);
        }

        // Buat data pengiriman
        Pengiriman::create([
            'transactions_id' => $transaction->id,
            'penerima' => Alamat::findOrFail($request->alamat)->nama,
            'no_telp_penerima' => Alamat::findOrFail($request->alamat)->no_telp,
            'alamat_penerima' => Alamat::findOrFail($request->alamat)->detail_alamat . ', ' . Alamat::findOrFail($request->alamat)->kecamatan . ', ' . Alamat::findOrFail($request->alamat)->kota . ', ' . Alamat::findOrFail($request->alamat)->provinsi . ', ' . Alamat::findOrFail($request->alamat)->kode_pos,
            'pengirim' => $carts->first()->product->shop->nama_toko,
            'no_telp_pengirim' => $carts->first()->product->shop->no_telp_toko,
            'alamat_pengirim' => $carts->first()->product->shop->detail_alamat . ', ' . $carts->first()->product->shop->kecamatan . ', ' . $carts->first()->product->shop->kota . ', ' . $carts->first()->product->shop->provinsi . ', ' . $carts->first()->product->shop->kode_pos,
            'jasa_kirim' => $carts->first()->pengiriman,
            'resi' => ''
        ]);

        // Delete data cart
        Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->delete();
    }
}
