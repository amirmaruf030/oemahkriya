<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use App\Transaction;
use App\Province;
use App\Models\Regency;
use App\Models\Alamat;
use App\User;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        // Data Produk
        $product = Product::with(['galleries', 'shop'])->where('slug', $id)->firstOrFail();
        // Data Toko
        $dataToko = Shop::findOrFail($product->shops_id);
        $province = Province::where('province_id', $product->shop->provinces_id)->first();
        $city = City::where('city_id', $product->shop->city_id)->first();

        return view('pages.detail', [
            'product' => $product,
            'province' => $province,
            'city' => $city,
            'dataToko' => $dataToko
        ]);
    }

    public function add(Request $request, $id)
    {
        $cekcart = Cart::where('products_id', $id)->where('users_id', Auth::user()->id)->first();
        $pengirimanSebelum = Cart::where('users_id', Auth::user()->id)->first();

        if ($cekcart == null && $pengirimanSebelum == null) {
            // [Kondisi jika produk tersebut tidak ada pada CART]
            // [Dan Kondisi Jika CART kosong]
            $alamatUser = Alamat::where('users_id', Auth::user()->id)->where('utama', 1)->first();
            if ($alamatUser == null) {
                return redirect()->route('dashboard-tambah-alamat');
            }
            $cart = new Cart();
            $cart->products_id = $id;
            $cart->users_id = Auth::user()->id;
            $cart->qty = $request->qty;
            $cart->total_price = $request->qty * Product::find($id)->price;
            $cart->weight = $request->qty * Product::find($id)->weigth;
            $cart->pengiriman = 'jne';
            $cart->alamat_id = $alamatUser->id;
            $cart->save();
        } elseif ($cekcart == null && $pengirimanSebelum != null) {
            // [Kondisi jika produk tersebut tidak ada pada CART]
            // [Dan Kondisi Jika Sudah terdapat produk lain pada CART]
            if (Product::find($pengirimanSebelum->products_id)->shops_id == Product::find($id)->shops_id) {
                // [Kondisi Jika produk masih 1 toko]
                $cart = new Cart();
                $cart->products_id = $id;
                $cart->users_id = Auth::user()->id;
                $cart->qty = $request->qty;
                $cart->total_price = $request->qty * Product::find($id)->price;
                $cart->weight = $request->qty * Product::find($id)->weigth;
                $cart->pengiriman = $pengirimanSebelum->pengiriman;
                $cart->alamat_id = $pengirimanSebelum->alamat_id;
                $cart->save();
            } else {
                // [Kondisi jika produk beda toko]
                foreach (Cart::where('users_id', Auth::user()->id)->get() as $dataCart) {
                    $dataCart->delete();
                }
                $cart = new Cart();
                $cart->products_id = $id;
                $cart->users_id = Auth::user()->id;
                $cart->qty = $request->qty;
                $cart->total_price = $request->qty * Product::find($id)->price;
                $cart->weight = $request->qty * Product::find($id)->weigth;
                $cart->pengiriman = $pengirimanSebelum->pengiriman;
                $cart->alamat_id = $pengirimanSebelum->alamat_id;
                $cart->save();
            }
        } else {
            // [Kondisi jika produk sudah terdapat pada CART]
            // Get Data ID_SHop dari produk yang ada pada cart pertama
            $dataShopAwal = Product::find($pengirimanSebelum->products_id)->shops_id;

            // get Data ID_Shop dari produk yang ingin di tambahkan
            $dataShopRequest = Product::find($id)->shops_id;

            $qtynow = $cekcart->qty + $request->qty;
            if ($qtynow <= Product::find($id)->stok && $dataShopAwal == $dataShopRequest) {
                $cekcart->qty = $cekcart->qty + $request->qty;
                $cekcart->weight = $qtynow * Product::find($id)->weigth;
                $cekcart->total_price = $qtynow * Product::find($id)->price;
                $cekcart->pengiriman = $pengirimanSebelum->pengiriman;
                $cekcart->alamat_id = $pengirimanSebelum->alamat_id;
                $cekcart->save();
            }
        }

        return redirect()->route('cart');
    }
}
