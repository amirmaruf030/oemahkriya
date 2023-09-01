<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('shops_id', Shop::where('users_id', Auth::user()->id)->first()->id);
            })
            ->get();
        return view('pages.admin.pesanan.index', [
            'sellTransactions' => $sellTransactions
        ]);
    }
}
