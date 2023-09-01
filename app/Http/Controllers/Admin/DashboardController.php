<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Transaction;
use App\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.product'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('buat-toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $produk = $dataUser->shop->product->count();
            $revenue = Transaction::where('shops_id', $dataUser->shop->id)->where('transaction_status', 'SELESAI')->sum('total_price');
            $belumbayar = Transaction::where('shops_id', $dataUser->shop->id)->where('transaction_status', 'BELUM BAYAR')->count();
            $perludiproses = Transaction::where('shops_id', $dataUser->shop->id)->where('transaction_status', 'MENUNGGU KONFIRMASI')->count();
            $perludikirim = Transaction::where('shops_id', $dataUser->shop->id)
                ->where('transaction_status', 'SEDANG DIPROSES')
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('payment_system', 'Cash');
                    })
                        ->orWhere(function ($q) {
                            $q->where('payment_system', 'DP')
                                ->whereNotNull('tgl_byr_dp')
                                ->whereNotNull('tgl_byr_tagihan');
                        });
                })
                ->count();
            $perlupenagihan = Transaction::where('shops_id', $dataUser->shop->id)->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count();
            $transaction = Transaction::where('shops_id', $dataUser->shop->id)->count();
            $latestproducts = Product::where('shops_id', $dataUser->shop->id)->orderBy('stok', 'asc')->take(5)->get();
            $latesttransactions = Transaction::with(['user'])->where('shops_id', $dataUser->shop->id)->orderBy('created_at', 'desc')->take(5)->get();
        } elseif (Auth::user()->roles == 'ADMIN') {
            $produk = Product::count();
            $belumbayar = Transaction::where('transaction_status', 'BELUM BAYAR')->count();
            $perludiproses = Transaction::where('transaction_status', 'MENUNGGU KONFIRMASI')->count();
            $perlupenagihan = Transaction::where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count();
            $perludikirim = Transaction::where('transaction_status', 'SEDANG DIPROSES')
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('payment_system', 'Cash');
                    })
                        ->orWhere(function ($q) {
                            $q->where('payment_system', 'DP')
                                ->whereNotNull('tgl_byr_dp')
                                ->whereNotNull('tgl_byr_tagihan');
                        });
                })
                ->count();
            $revenue = Transaction::where('transaction_status', 'SELESAI')->sum('total_price');
            $transaction = Transaction::count();
            $latestproducts = Product::orderBy('created_at', 'desc')->take(5)->get();
            $latesttransactions = Transaction::orderBy('created_at', 'desc')->take(5)->get();
        }

        return view('pages.admin.dashboard', [
            'produk' => $produk,
            'belumbayar' => $belumbayar,
            'perludiproses' => $perludiproses,
            'perlupenagihan' => $perlupenagihan,
            'perludikirim' => $perludikirim,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'latestproducts' => $latestproducts,
            'latesttransactions' => $latesttransactions,
        ]);
    }
}
