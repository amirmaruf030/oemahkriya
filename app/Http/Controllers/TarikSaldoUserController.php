<?php

namespace App\Http\Controllers;

use App\Models\RiwayatSaldoUser;
use App\Models\TarikSaldoUser;
use Illuminate\Http\Request;

class TarikSaldoUserController extends Controller
{
    public function tarikSaldo(Request $request)
    {
        // Proses penarikan saldo
        $tarikSaldo = new TarikSaldoUser();
        $tarikSaldo->users_id = $request->idUser;
        $tarikSaldo->nama_penerima = $request->penerima;
        $tarikSaldo->rekening = $request->rekening;
        $tarikSaldo->no_rekening = $request->noRekening;
        $tarikSaldo->jumlah_saldo = $request->jumlahSaldo;
        $tarikSaldo->tgl_penarikan = now();
        $tarikSaldo->status = 'Dalam proses';
        $tarikSaldo->save();
        $tarikSaldo->refresh();

        // Update saldo di tabel SaldoToko
        $saldoUser = $tarikSaldo->saldo_user;
        $saldoUser->saldo -= $request->jumlahSaldo;
        $saldoUser->save();

        // Catat penarikan saldo dalam riwayat saldo
        $riwayatSaldo = new RiwayatSaldoUser();
        $riwayatSaldo->saldo_users_id = $saldoUser->id;
        $riwayatSaldo->jumlah_transaksi = $request->jumlahSaldo;
        $riwayatSaldo->jenis_transaksi = 'penarikan';
        $riwayatSaldo->keterangan = 'Penarikan saldo User';
        $riwayatSaldo->save();

        return redirect()->back();
    }
}
