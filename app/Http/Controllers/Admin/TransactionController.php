<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;



class TransactionController extends Controller
{
    public function index() // Semua
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.index', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Semua'
        ]);
    }

    public function belumbayar() // Belum Bayar
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.belum-bayar', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Belum Bayar'
        ]);
    }

    public function dalampenagihan() // Dalam Penagihan
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.dalam-penagihan', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Dalam Penagihan'
        ]);
    }

    public function perludiproses() // Perlu Piproses
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.perlu-diproses', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Perlu Diproses'
        ]);
    }

    public function sedangdiproses() //Perlu Penagihan
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.sedang-diproses', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Sedang Diproses'
        ]);
    }

    public function perludikirim() // Perlu Dikirim
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.perlu-dikirim', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Perlu Dikirim'
        ]);
    }

    public function dikirim() // Sedang Dikirim
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.dikirim', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Dikirim'
        ]);
    }

    public function selesai() // Selesai
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.selesai', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Selesai'
        ]);
    }

    public function dibatalkan() // Dibatalkan
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail.product.galleries', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        if (Auth::user()->roles == 'USER') {
            $dataTransaksi = $dataUser->shop->transaction;
        } elseif (Auth::user()->roles == 'ADMIN') {
            $dataTransaksi = Transaction::with(['transaction_detail', 'pengiriman', 'user'])->get();
        }

        return view('pages.admin.transaction.dibatalkan', [
            'dataTransaksi' => $dataTransaksi,
            'aktif' => 'Dibatalkan'
        ]);
    }

    public function konfirmasi(Request $request)
    {
        // Perlu Diproses => Sedang Diproses

        $dataTransaksi = Transaction::findOrFail($request->idTransaksi);
        $data['tgl_konfirmasi'] = Carbon::now();
        $data['transaction_status'] = $request->transaction_status;
        $dataTransaksi->update($data);
        return redirect()->route('transaction.sedangdiproses');
    }

    public function penagihan(Request $request)
    {
        // Sedang Diproses [Perlu Penagihan] => Belum Bayar [Tagihan]

        $dataTransaksi = Transaction::findOrFail($request->idTransaksi);
        $data['transaction_status'] = $request->transaction_status;
        $dataTransaksi->update($data);
        return redirect()->route('transaction.dalampenagihan');
    }

    public function pengiriman(Request $request)
    {
        // Sedang Diproses [Perlu Dikirim] => Dikirim

        // Update tb_transaksi
        $dataTransaksi = Transaction::findOrFail($request->idTransaksi);
        $data['transaction_status'] = 'DIKIRIM';
        $dataTransaksi->update($data);

        // Update tb_pengiriman
        $dataPengiriman = Pengiriman::where('transactions_id', $request->idTransaksi)->firstOrFail();
        $data['resi'] = $request->resi;
        $data['tgl_pengiriman'] = Carbon::now();
        $dataPengiriman->update($data);

        return redirect()->route('transaction.dikirim');
    }

    public function details(Request $request, $idTransaksi)
    {
        $id = Crypt::decrypt($idTransaksi);
        $dataTransaksi = Transaction::with(['transaction_detail', 'user', 'transaction_detail.product.galleries', 'pengiriman'])->findOrFail($id);

        return view('pages.admin.transaction.details', [
            'dataTransaksi' => $dataTransaksi
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Transaction::findOrFail(Crypt::decrypt($id));
        $item->update($data);

        return redirect()->route('transaction.index');
    }
    public function trxupdate(Request $request, $id)
    {
        $data = $request->all();
        TransactionDetail::where('transactions_id', $id)->update([
            'shipping_status' => $data['shipping_status'],
            'resi' => $data['resi']
        ]);

        return redirect()->route('transactions-details', $id);
    }
}
