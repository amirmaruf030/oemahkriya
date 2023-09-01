<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\User;
use App\ProductGallery;

use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.product.galleries', 'shop.product.category'])->findOrFail(Auth::user()->id);
        // dd($dataUser->shop->transaction->transaction_detail);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }
        if (Auth::user()->roles == 'USER') {
            $produk = $dataUser->shop->product;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $produk = Product::get();
        }
        return view('pages.admin.product.index', [
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.product'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        $categories = Category::all();

        return view('pages.admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $shop = User::with(['Shop'])->find(Auth::user()->id);

        $produk = Product::create([
            'name' => $request->name,
            'shops_id' => $shop->shop->id,
            'categories_id' => $request->categories_id,
            'price' => $request->harga,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
            'weigth' => $request->berat,
            'stok' => $request->stok,
            'jmlh_penjualan' => 0
        ]);

        foreach ($request->file('photos') as $photo) {
            $data['photos'] = $photo->store('assets/product', 'public');
            $data['products_id'] = $produk->id;
            ProductGallery::create($data);
        }
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.product'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        $item = Product::with(['category', 'galleries'])->find(Crypt::decrypt($id));
        $categories = Category::all();

        return view('pages.admin.product.edit', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail(Crypt::decrypt($id));
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Ambil Data Produk
        $dataProduk = Product::with(['galleries'])->findorFail(Crypt::decrypt($id));
        // Hapus data produk
        $dataProduk->delete();
        return redirect()->route('product.index');
    }

    public function updatestok(Request $request)
    {
        $dataProduk = Product::findOrFail($request->idProduk);
        $dataUpdate['stok'] = $request->stok;
        $dataProduk->update($dataUpdate);

        return redirect()->route('product.index');
    }

    public function updateharga(Request $request)
    {
        $dataProduk = Product::findOrFail($request->idProduk);
        $dataUpdate['price'] = $request->price;
        $dataProduk->update($dataUpdate);

        return redirect()->route('product.index');
    }
}
