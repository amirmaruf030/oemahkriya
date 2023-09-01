<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $transactions = Transaction::get();
        return view('pages.admin.sales_report.index', compact('transactions'));
    }

    public function generatePDF()
    {
        $dataUser = $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        $transaksi = $dataUser->shop->transaction()->whereBetween('created_at', [now()->subMonth(), now()])->get();


        $pdf = PDF::loadView('pages.admin.sales_report.report', compact('transaksi'));

        // (Opsional) Konfigurasi ukuran dan orientasi halaman
        $pdf->setPaper('A4', 'landscape');

        // Menghasilkan output PDF ke browser atau menyimpannya
        return $pdf->stream('sales_report.pdf');
    }
    public function generatePenghasilanPDF($rentangWaktu)
    {
        $dataUser = $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);

        if ($rentangWaktu == 'minggu') {
            // Data 1 Minggu
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subWeek(), now()])
                ->get();
        } elseif ($rentangWaktu == 'bulan') {
            // Data 1 Bulan
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subMonth(), now()])
                ->get();
        } elseif ($rentangWaktu == 'tahun') {
            // Data 1 Tahun
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subYear(), now()])
                ->get();
        } elseif ($rentangWaktu == '3bulan') {
            // Data 3 Bulan
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subMonths(3), now()])
                ->get();
        } else {
            // Jika parameter tidak sesuai, misalnya kosong atau tidak valid, ambil semua data
            $transaksi = $dataUser->shop->transaction()->get();
        }


        $pdf = PDF::loadView('pages.admin.sales_report.report-penghasilan', compact('transaksi'));

        // (Opsional) Konfigurasi ukuran dan orientasi halaman
        $pdf->setPaper('A4', 'landscape');

        // Menghasilkan output PDF ke browser atau menyimpannya
        return $pdf->stream('sales_report_penghasilan.pdf');
    }
}
