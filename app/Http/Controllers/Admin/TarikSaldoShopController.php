<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatSaldoShop;
use App\Models\TarikSaldoToko;
use Illuminate\Http\Request;

class TarikSaldoShopController extends Controller
{
    public function tarikSaldo(Request $request)
    {
        // Proses penarikan saldo
        $tarikSaldo = new TarikSaldoToko();
        $tarikSaldo->shops_id = $request->idShop;
        $tarikSaldo->nama_penerima = $request->penerima;
        $tarikSaldo->rekening = $request->rekening;
        $tarikSaldo->no_rekening = $request->noRekening;
        $tarikSaldo->jumlah_saldo = $request->jumlahSaldo;
        $tarikSaldo->tgl_penarikan = now();
        $tarikSaldo->status = 'Dalam proses';
        $tarikSaldo->save();
        $tarikSaldo->refresh();

        // Update saldo di tabel SaldoToko
        $saldoToko = $tarikSaldo->saldo_shop;
        $saldoToko->saldo -= $request->jumlahSaldo;
        $saldoToko->save();

        // Catat penarikan saldo dalam riwayat saldo
        $riwayatSaldo = new RiwayatSaldoShop();
        $riwayatSaldo->saldo_shops_id = $saldoToko->id;
        $riwayatSaldo->jumlah_transaksi = $request->jumlahSaldo;
        $riwayatSaldo->jenis_transaksi = 'penarikan';
        $riwayatSaldo->keterangan = 'Penarikan saldo toko';
        $riwayatSaldo->save();

        return redirect()->back();
    }
}
