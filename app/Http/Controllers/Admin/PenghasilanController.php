<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PenghasilanController extends Controller
{
    public function index()
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.product', 'shop.saldo_shop.riwayat_saldo_shop', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        $startDate = Carbon::now()->subMonth(); // Tanggal mulai 1 bulan yang lalu
        $endDate = Carbon::now(); // Tanggal sekarang
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        $saldoToko = $dataUser->shop->saldo_shop->saldo;
        $totalPendapatan = $dataUser->shop->transaction
            ->where('transaction_status', 'SELESAI')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->sum('total_price');

        $totalOngkosKirim = $dataUser->shop->transaction
            ->where('transaction_status', 'SELESAI')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->sum('shipping_price');
        $totalPenjualanProduk = $totalPendapatan - $totalOngkosKirim;

        return view('pages.admin.penghasilan', [
            'saldoToko' => $saldoToko,
            'totalPendapatan' => $totalPendapatan,
            'totalPenjualanProduk' => $totalPenjualanProduk,
            'totalOngkosKirim' => $totalOngkosKirim,
            'dataTransaksi' => $dataUser->shop->transaction,
            'riwayatTransaksi' => $dataUser->shop->saldo_shop->riwayat_saldo_shop,
            'aktif' => 'Dalam Pengiriman'
        ]);
    }


    public function show()
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.product', 'shop.saldo_shop', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        $startDate = Carbon::now()->subMonth(); // Tanggal mulai 1 bulan yang lalu
        $endDate = Carbon::now(); // Tanggal sekarang
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        $saldoToko = $dataUser->shop->saldo_shop->first()->saldo;
        $totalPendapatan = $dataUser->shop->transaction
            ->where('transaction_status', 'SELESAI')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->sum('total_price');

        $totalOngkosKirim = $dataUser->shop->transaction
            ->where('transaction_status', 'SELESAI')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->sum('shipping_price');
        $totalPenjualanProduk = $totalPendapatan - $totalOngkosKirim;

        return view('pages.admin.penghasilan2', [
            'saldoToko' => $saldoToko,
            'totalPendapatan' => $totalPendapatan,
            'totalPenjualanProduk' => $totalPenjualanProduk,
            'totalOngkosKirim' => $totalOngkosKirim,
            'dataTransaksi' => $dataUser->shop->transaction,
            'aktif' => 'Sudah Diterima'
        ]);
    }
}
