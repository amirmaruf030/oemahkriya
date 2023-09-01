<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with('galleries')
            ->whereHas('shop', function ($query) {
                $query->where('stts_toko', 1);
            })
            ->latest()
            ->take(12)
            ->get();
        $produkPopulare = Product::with('galleries')
            ->whereHas('shop', function ($query) {
                $query->where('stts_toko', 1);
            })
            ->orderByDesc('jmlh_penjualan')
            ->take(12)
            ->get();

        return view('pages.home', [
            'categories' => $categories,
            'products' => $products,
            'produkPopulare' => $produkPopulare
        ]);
    }
}
