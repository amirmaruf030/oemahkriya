<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Models\RiwayatSaldoShop;
use App\Models\RiwayatSaldoUser;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $dataUser = User::with(['transaction.pengiriman', 'transaction.transaction_detail.product.galleries', 'transaction.shop'])->findOrFail(Auth::user()->id);
        $notifikasi = Transaction::get();

        return view('pages.dashboard-transactions', [
            'buyTransactions' => $dataUser->transaction,
            'notifikasi' => $notifikasi,
            'aktif' => 'Semua'
        ]);
    }

    public function belumBayar()
    {
        $transaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries'])->where('users_id', Auth::user()->id)->where('transaction_status', 'BELUM BAYAR')->get();
        $notifikasi = Transaction::get();
        return view('pages.dashboard-transactions-belumbayar', [
            'buyTransactions' => $transaksi,
            'notifikasi' => $notifikasi,
            'aktif' => 'Belum Bayar'
        ]);
    }

    public function sedangProses()
    {
        $transaksi = User::with(['transaction.transaction_detail', 'transaction.shop', 'transaction.transaction_detail.product.galleries'])->where('id', Auth::user()->id)->get();
        $notifikasi = Transaction::get();

        foreach ($transaksi as $data) {
        }
        $dataTransaksi = $data->transaction->whereIn('transaction_status', ['MENUNGGU KONFIRMASI', 'SEDANG DIPROSES']);

        return view('pages.dashboard-transactions-sedangproses', [
            'buyTransactions' => $dataTransaksi,
            'notifikasi' => $notifikasi,
            'aktif' => 'Sedang Diproses'
        ]);
    }

    public function dikirim()
    {
        $transaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries'])->where('users_id', Auth::user()->id)->where('transaction_status', 'DIKIRIM')->get();
        $notifikasi = Transaction::get();

        return view('pages.dashboard-transactions-dikirim', [
            'buyTransactions' => $transaksi,
            'notifikasi' => $notifikasi,
            'aktif' => 'Dikirim'
        ]);
    }

    public function selesai()
    {
        $transaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries'])->where('users_id', Auth::user()->id)->where('transaction_status', 'SELESAI')->get();
        $notifikasi = Transaction::get();

        return view('pages.dashboard-transactions-selesai', [
            'buyTransactions' => $transaksi,
            'notifikasi' => $notifikasi,
            'aktif' => 'Selesai'
        ]);
    }

    public function dibatalkan()
    {
        $transaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries'])->where('users_id', Auth::user()->id)->where('transaction_status', 'DIBATALKAN')->get();
        $notifikasi = Transaction::get();

        return view('pages.dashboard-transactions-dibatalkan', [
            'buyTransactions' => $transaksi,
            'notifikasi' => $notifikasi,
            'aktif' => 'Dibatalkan'
        ]);
    }

    public function tagihan()
    {
        $transaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries'])->where('users_id', Auth::user()->id)->where('transaction_status', 'TAGIHAN')->get();
        $notifikasi = Transaction::get();

        return view('pages.dashboard-transactions-tagihan', [
            'buyTransactions' => $transaksi,
            'notifikasi' => $notifikasi,
            'aktif' => 'Tagihan'
        ]);
    }

    public function batalkan(Request $request)
    {
        $dataTransaksi = Transaction::with(['transaction_detail', 'shop.saldo_shop', 'user'])->findOrFail($request->idTransaksi);
        if ($dataTransaksi->payment_system == 'Cash' && $dataTransaksi->transaction_status == 'SEDANG DIPROSES' || $dataTransaksi->payment_system == 'DP' && $dataTransaksi->transaction_status == 'SEDANG DIPROSES' && isset($dataTransaksi->tgl_byr_dp) && isset($dataTransaksi->tgl_byr_tagihan)) {
            // Buat data riwayat saldo user
            $riwayatSaldoUser = RiwayatSaldoUser::create([
                'saldo_users_id' => $dataTransaksi->user->saldo_user->id,
                'jumlah_transaksi' => $dataTransaksi->tagihan,
                'jenis_transaksi' => 'Pembatalan Pesanan',
                'keterangan' => 'No Pesanan : ' . $dataTransaksi->code
            ]);
            $saldoUser = $dataTransaksi->user->saldo_user;
            $saldoUser->saldo += $riwayatSaldoUser->jumlah_transaksi;
            $saldoUser->save();

            // Buat data riwayat transaksi toko
            $riwayatSaldoShop = RiwayatSaldoShop::create([
                'saldo_shops_id' => $dataTransaksi->shop->saldo_shop->id,
                'jumlah_transaksi' => $dataTransaksi->downpayment,
                'jenis_transaksi' => 'Pembatalan Pesanan',
                'keterangan' => 'No Pesanan : ' . $dataTransaksi->code
            ]);
            $saldoToko = $dataTransaksi->shop->saldo_shop;
            $saldoToko->saldo += $riwayatSaldoShop->jumlah_transaksi;
            $saldoToko->save();
        } elseif ($dataTransaksi->payment_system == 'DP' && $dataTransaksi->transaction_status == 'SEDANG DIPROSES' && isset($dataTransaksi->tgl_byr_dp) && !isset($dataTransaksi->tgl_byr_tagihan) || $dataTransaksi->payment_system == 'DP' && $dataTransaksi->transaction_status == 'TAGIHAN' && isset($dataTransaksi->tgl_byr_dp) && !isset($dataTransaksi->tgl_byr_tagihan)) {
            // Buat data riwayat transaksi toko
            $riwayatSaldoShop = RiwayatSaldoShop::create([
                'saldo_shops_id' => $dataTransaksi->shop->saldo_shop->id,
                'jumlah_transaksi' => $dataTransaksi->downpayment,
                'jenis_transaksi' => 'Pembatalan Pesanan',
                'keterangan' => 'No Pesanan : ' . $dataTransaksi->code
            ]);
            $saldoToko = $dataTransaksi->shop->saldo_shop;
            $saldoToko->saldo += $riwayatSaldoShop->jumlah_transaksi;
            $saldoToko->save();
        } elseif ($dataTransaksi->transaction_status == 'MENUNGGU KONFIRMASI') {
            if ($dataTransaksi->payment_system == 'DP') {
                // Buat data riwayat saldo user
                $riwayatSaldoUser = RiwayatSaldoUser::create([
                    'saldo_users_id' => $dataTransaksi->user->saldo_user->id,
                    'jumlah_transaksi' => $dataTransaksi->downpayment,
                    'jenis_transaksi' => 'Pembatalan Pesanan',
                    'keterangan' => 'No Pesanan : ' . $dataTransaksi->code
                ]);
                $saldoUser = $dataTransaksi->user->saldo_user;
                $saldoUser->saldo += $riwayatSaldoUser->jumlah_transaksi;
                $saldoUser->save();
            } else {
                // Buat data riwayat saldo user
                $riwayatSaldoUser = RiwayatSaldoUser::create([
                    'saldo_users_id' => $dataTransaksi->user->saldo_user->id,
                    'jumlah_transaksi' => $dataTransaksi->total_price,
                    'jenis_transaksi' => 'Pembatalan Pesanan',
                    'keterangan' => 'No Pesanan : ' . $dataTransaksi->code
                ]);
                $saldoUser = $dataTransaksi->user->saldo_user;
                $saldoUser->saldo += $riwayatSaldoUser->jumlah_transaksi;
                $saldoUser->save();
            }
        }

        // Update Status Transaksi
        $dataTransaksi->transaction_status = 'DIBATALKAN';
        $dataTransaksi->save();

        // Update Tabel Produk
        foreach ($dataTransaksi->transaction_detail as $dataDetail) {
            $dataProduk = Product::findOrFail($dataDetail->products_id);
            $dataProduk->stok += $dataDetail->qty;
            $dataProduk->save();
        }

        return redirect()->route('dashboard-transaction-dibatalkan');
    }

    public function bayarPesanan(Request $request)
    {
        $dataTransaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries', 'pengiriman'])->findOrFail($request->idTransaksi);
        if ($dataTransaksi->payment_system == 'DP') {
            if ($dataTransaksi->tgl_byr_dp == null && $dataTransaksi->transaction_status == 'BELUM BAYAR') {
                // Bayar DP
                $data['transaction_status'] = 'MENUNGGU KONFIRMASI';
                $data['tgl_byr_dp'] = Carbon::now();
                $dataTransaksi->update($data);
                return redirect()->route('dashboard-transaction-sedangproses');
            } else {
                // Bayar Tagihan
                $data['transaction_status'] = 'SEDANG DIPROSES';
                $data['tgl_byr_tagihan'] = Carbon::now();
                $dataTransaksi->update($data);
                return redirect()->route('dashboard-transaction-sedangproses');
            }
        } else {
            // Bayar Cash
            $data['transaction_status'] = 'MENUNGGU KONFIRMASI';
            $data['tgl_byr_cash'] = Carbon::now();
            $dataTransaksi->update($data);
            return redirect()->route('dashboard-transaction-sedangproses');
        }
    }

    public function detailPesanan(Request $request)
    {
        $dataTransaksi = Transaction::with(['transaction_detail', 'shop', 'transaction_detail.product.galleries', 'pengiriman'])->findOrFail($request->idTransaksi);

        return view('pages.user.detail-transaksi', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Detail'
        ]);
    }

    public function pesananDiterima(Request $request)
    {
        $dataTransaksi = Transaction::with(['transaction_detail', 'shop.saldo_shop'])->findOrFail($request->idTransaksi);
        // Update Tabel Transaksi
        $data['transaction_status'] = 'SELESAI';
        $dataTransaksi->update($data);

        // Update Tabel Produk
        foreach ($dataTransaksi->transaction_detail as $dataDetail) {
            $dataProduk = Product::findOrFail($dataDetail->products_id);
            $dataProduk->jmlh_penjualan += $dataDetail->qty;
            $dataProduk->save();
        }

        // Buat data riwayat transaksi
        $riwayatSaldoShop = RiwayatSaldoShop::create([
            'saldo_shops_id' => $dataTransaksi->shop->saldo_shop->id,
            'jumlah_transaksi' => $dataTransaksi->total_price,
            'jenis_transaksi' => 'Penjualan Produk',
            'keterangan' => 'No Pesanan : ' . $dataTransaksi->code
        ]);

        // Penerusan Saldo Ke Seller
        $saldoToko = $dataTransaksi->shop->saldo_shop;
        $saldoToko->saldo += $riwayatSaldoShop->jumlah_transaksi;
        $saldoToko->save();

        return redirect()->route('dashboard-transaction-selesai');
    }
}
