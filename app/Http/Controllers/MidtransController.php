<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Transaction;
use Illuminate\Support\Carbon;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();
        $order = explode('_', $notification->order_id);

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $order[0];
        $dataPembayaran = $notification->gross_amount;

        // ambil_id
        $transaction = Transaction::where('code', $order_id)->first();

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud != 'challenge') {
                    $transaction->transaction_status = 'MENUNGGU KONFIRMASI';
                }
            }
        } else if ($status == 'settlement') {
            // Sukses
            if ($transaction->payment_system == 'DP') {
                if ($transaction->tgl_byr_dp == null && $transaction->transaction_status == 'BELUM BAYAR') {
                    // Bayar DP
                    if ($dataPembayaran == $transaction->downpayment) {
                        $transaction->transaction_status = 'MENUNGGU KONFIRMASI';
                        $transaction->tgl_byr_dp = Carbon::now();
                    }
                } else {
                    // Bayar Tagihan
                    if ($dataPembayaran == $transaction->tagihan && !isset($transaction->tgl_byr_tagihan)) {
                        $transaction->transaction_status = 'SEDANG DIPROSES';
                        $transaction->tgl_byr_tagihan = Carbon::now();
                    }
                }
            } else {
                // Bayar Cash
                if ($dataPembayaran == $transaction->total_price && !isset($transaction->tgl_byr_cash)) {
                    $transaction->transaction_status = 'MENUNGGU KONFIRMASI';
                    $transaction->tgl_byr_cash = Carbon::now();
                }
            }
        }

        // Simpan transaksi
        $transaction->save();
    }
    public function finishRedirect(Request $request)
    {
        return view('pages.success');
    }
    public function unfinishRedirect(Request $request)
    {
        return view('pages.success');
    }
    public function errorRedirect(Request $request)
    {
        return view('pages.success');
    }
}
