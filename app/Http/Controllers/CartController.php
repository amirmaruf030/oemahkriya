<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Province;
use App\City;
use App\Subdistrict;
use App\User;
use App\Product;
use App\Models\Alamat;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Data Cart User
        $carts = Cart::with(['product.galleries', 'product.shop', 'user.alamat'])->where('users_id', Auth::user()->id)->get();
        $alamatUser = User::with(['alamat'])->find(Auth::user()->id);

        // Deklarasi ALAMAT PENGIRIM, TUJUAN, BERAT BARANG
        $berat = 0;
        foreach ($carts as $cart) {
            $cartAlamat = Alamat::findOrFail($cart->alamat_id);
            $tujuan = $cartAlamat->city_id;
            $asal = $cart->product->shop->city_id;
            $berat = $berat + $cart->weight;
        }

        // Ambil data provinsi
        $provinces = Province::pluck('name', 'province_id');

        // Kondisi jika Cart User kosong
        if ($carts->isEmpty()) {
            $cartAlamat = $alamatUser->alamat->where('utama', 1)->first();
            return view('pages.cart', compact('carts', 'provinces', 'alamatUser', 'cartAlamat'));
        }

        $jasaKirim = $carts->first()->pengiriman;
        $client = new Client();
        try {
            $response = $client->request(
                'POST',
                'https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin=' . $asal . '&destination=' . $tujuan . '&weight=' . $berat . '&courier=' . $jasaKirim . '',
                    'headers' => [
                        'key' => 'e02ac561ad8d4c8cdb74b127c4cc149f',
                        'content-type' => 'application/x-www-form-urlencoded',
                    ]
                ]
            );
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        // Ambil jumlah service yang tersedia
        $services = $array_result['rajaongkir']['results'][0]['costs'];
        // Banyak service yang tersedia
        $num_services = count($services);

        return view('pages.cart', compact('carts', 'provinces', 'services', 'num_services', 'array_result', 'jasaKirim', 'alamatUser', 'cartAlamat'));
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }

    public function getCities($id) //untuk mendapatkan data kota berdasarkan kode provinsi dalam bentuk data JSON
    {
        $city = City::where('province_id', $id)->pluck('city_name', 'city_id');
        return response()->json($city);
    }

    public function getSubdistrict($id) //untuk mendapatkan data kota berdasarkan kode provinsi dalam bentuk data JSON
    {
        $subdistrict = Subdistrict::where('city_id', $id)->pluck('subdistrict_name', 'subdistrict_id');
        return response()->json($subdistrict);
    }

    public function check_ongkir(Request $request) //untuk menghitung dari ongkos kirim yang mana datanya akan dikembalikan dalam bentuk JSON
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }
    public function update(Request $request)
    {
        if ($request->qty == 0) {
            $cart = Cart::findOrFail($request->id);
            $cart->delete();
            return redirect()->route('cart');
        } else {
            foreach ($request->id as $key => $value) {
                $cart = Cart::findOrFail($value);
                $cart->qty = $request->qty[$key];
                $cart->weight = $request->qty[$key] * Product::find($cart->products_id)->weigth;
                $cart->total_price = $request->qty[$key] * $cart->product->price;
                $cart->save();
            }
            return redirect()->route('cart');
        }
    }

    // Ubah Alamat Cart
    public function cartUbahAlamat(Request $request)
    {
        $carts = Cart::where('users_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            $cart->alamat_id = $request->alamat_id;
            $cart->save();
        }

        return redirect()->back();
    }

    // Ubah Pengiriman Cart
    public function cartUbahPengiriman(Request $request)
    {
        $carts = Cart::where('users_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            $cart->pengiriman = $request->expeditions_id;
            $cart->save();
        }

        return redirect()->back();
    }
}
