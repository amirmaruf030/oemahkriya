<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CetakLaporanController extends Controller
{
    public function index(Request $request)
    {
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);
        $transaksi = $dataUser->shop->transaction()->whereBetween('created_at', [now()->subMonth(), now()])->get();

        if ($request->rentangWaktu == 'minggu') {
            // Data 1 Minggu
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subWeek(), now()])
                ->get();
            $minggu = Carbon::now()->subWeek();
            $sekarang = Carbon::now();
            $rentanWaktu = 'Mingguan';

            $dataWaktu = $minggu->format('d-m-Y') . ' s/d ' . $sekarang->format('d-m-Y');
            $filename = $minggu->format('dmY') . '_' . $sekarang->format('dmY');
        } elseif ($request->rentangWaktu == 'bulan') {
            // Data 1 Bulan
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subMonth(), now()])
                ->get();
            $bulan = Carbon::now()->subMonth();
            $sekarang = Carbon::now();
            $rentanWaktu = 'Bulanan';

            $dataWaktu = $bulan->format('d-m-Y') . ' s/d ' . $sekarang->format('d-m-Y');
            $filename = $bulan->format('dmY') . '_' . $sekarang->format('dmY');
        } elseif ($request->rentangWaktu == 'tahun') {
            // Data 1 Tahun
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subYear(), now()])
                ->get();
            $tahun = Carbon::now()->subYear();
            $sekarang = Carbon::now();
            $rentanWaktu = 'Tahunan';

            $dataWaktu = $tahun->format('d-m-Y') . ' s/d ' . $sekarang->format('d-m-Y');
            $filename = $tahun->format('dmY') . '-' . $sekarang->format('dmY');
        } else {
            return redirect()->route('transaction');
        }

        $pdf = PDF::loadView('pages.admin.sales_report.report', compact('transaksi', 'dataWaktu', 'rentanWaktu', 'filename'));

        // (Opsional) Konfigurasi ukuran dan orientasi halaman
        $pdf->setPaper('A4', 'landscape');

        // // Menyimpan file PDF sementara di server
        $pdfPath = storage_path('app/LaporanPenjualan ' . $filename . '.pdf');
        $pdf->save($pdfPath);

        if ($request->rentangWaktu == 'minggu') {
            // Mengirim file PDF sebagai respons untuk di-download
            return response()->download($pdfPath, 'Laporan_Penjualan_Mingguan_' . $filename . '.pdf')->deleteFileAfterSend(true);
        } elseif ($request->rentangWaktu == 'bulan') {
            return response()->download($pdfPath, 'Laporan_Penjualan_Bulanan_' . $filename . '.pdf')->deleteFileAfterSend(true);
        } elseif ($request->rentangWaktu == 'tahun') {
            return response()->download($pdfPath, 'Laporan_Penjualan_Tahunan_' . $filename . '.pdf')->deleteFileAfterSend(true);
        } else {
            return redirect()->route('transaction');
        }
    }

    public function penghasilan(Request $request)
    {
        $dataUser = User::with(['alamat', 'shop.transaction.transaction_detail', 'shop.transaction.pengiriman', 'shop.transaction.user'])->findOrFail(Auth::user()->id);

        if ($request->rentangWaktu == 'minggu') {
            // Data 1 Minggu
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subWeek(), now()])
                ->where(function ($query) {
                    $query->where('transaction_status', 'SELESAI')
                        ->orWhere('transaction_status', 'DIBATALKAN');
                })
                ->whereNotNull('tgl_konfirmasi')->with(['transaction_detail'])
                ->get();
            foreach ($transaksi as $dataTransaksi) {
                $totalProdukTerjual = $dataTransaksi->transaction_detail->count();
            }

            $minggu = Carbon::now()->subWeek();
            $sekarang = Carbon::now();
            $rentanWaktu = 'Mingguan';
            $dataWaktu = $minggu->format('d-m-Y') . ' s/d ' . $sekarang->format('d-m-Y');
            $filename = $minggu->format('dmY') . '_' . $sekarang->format('dmY');
        } elseif ($request->rentangWaktu == 'bulan') {
            // Data 1 Bulan
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subMonth(), now()])
                ->where(function ($query) {
                    $query->where('transaction_status', 'SELESAI')
                        ->orWhere('transaction_status', 'DIBATALKAN');
                })
                ->whereNotNull('tgl_konfirmasi')->with(['transaction_detail'])
                ->get();
            foreach ($transaksi as $dataTransaksi) {
                $totalProdukTerjual = $dataTransaksi->transaction_detail->count();
            }
            $bulan = Carbon::now()->subMonth();
            $sekarang = Carbon::now();
            $rentanWaktu = 'Bulanan';

            $dataWaktu = $bulan->format('d-m-Y') . ' s/d ' . $sekarang->format('d-m-Y');
            $filename = $bulan->format('dmY') . '_' . $sekarang->format('dmY');
        } elseif ($request->rentangWaktu == 'tahun') {
            // Data 1 Tahun
            $transaksi = $dataUser->shop->transaction()
                ->whereBetween('created_at', [now()->subYear(), now()])
                ->where(function ($query) {
                    $query->where('transaction_status', 'SELESAI')
                        ->orWhere('transaction_status', 'DIBATALKAN');
                })
                ->whereNotNull('tgl_konfirmasi')->with(['transaction_detail'])
                ->get();
            foreach ($transaksi as $dataTransaksi) {
                $totalProdukTerjual = $dataTransaksi->transaction_detail->count();
            }
            $tahun = Carbon::now()->subYear();
            $sekarang = Carbon::now();
            $rentanWaktu = 'Tahunan';

            $dataWaktu = $tahun->format('d-m-Y') . ' s/d ' . $sekarang->format('d-m-Y');
            $filename = $tahun->format('dmY') . '_' . $sekarang->format('dmY');
        } else {
            return redirect()->route('transaction');
        }


        $pdf = PDF::loadView('pages.admin.sales_report.report-penghasilan', compact('transaksi', 'dataWaktu', 'rentanWaktu', 'filename', 'totalProdukTerjual'));

        // (Opsional) Konfigurasi ukuran dan orientasi halaman
        $pdf->setPaper('A4', 'landscape');

        // Menyimpan file PDF sementara di server
        $pdfPath = storage_path('app/LaporanPenghasilan ' . $filename . '.pdf');
        $pdf->save($pdfPath);

        if ($request->rentangWaktu == 'minggu') {
            // Mengirim file PDF sebagai respons untuk di-download
            return response()->download($pdfPath, 'Laporan_Penghasilan_Mingguan_' . $filename . '.pdf')->deleteFileAfterSend(true);
        } elseif ($request->rentangWaktu == 'bulan') {
            return response()->download($pdfPath, 'Laporan_Penghasilan_Bulanan_' . $filename . '.pdf')->deleteFileAfterSend(true);
        } elseif ($request->rentangWaktu == 'tahun') {
            return response()->download($pdfPath, 'Laporan_Penghasilan_Tahunan_' . $filename . '.pdf')->deleteFileAfterSend(true);
        } else {
            return redirect()->route('transaction');
        }
    }
}
