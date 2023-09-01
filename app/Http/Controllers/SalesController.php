<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\fpdf\fpdf;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function generateReport()
    {
        // Ambil data penjualan dari database sesuai kebutuhan Anda
        $salesData = Transaction::get(); // Query untuk mengambil data penjualan

        // Buat objek FPDF
        $pdf = new \FPDF();

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Atur font dan ukuran
        $pdf->SetFont('Arial', 'B', 16);

        // Tambahkan judul laporan
        $pdf->Cell(0, 10, 'Laporan Penjualan', 0, 1, 'C');

        // Tampilkan data penjualan dalam tabel
        foreach ($salesData as $sale) {
            $pdf->Cell(40, 10, $sale->product_name, 1, 0);
            $pdf->Cell(40, 10, $sale->quantity, 1, 0);
            $pdf->Cell(40, 10, $sale->total_amount, 1, 1);
        }

        // Simpan file PDF ke server atau kirim langsung ke browser
        $pdf->Output('sales_report.pdf', 'D');
    }

    public function generateReport2()
    {
        // Ambil data penjualan dari database sesuai kebutuhan Anda
        $salesData = Transaction::get(); // Query untuk mengambil data penjualan

        // Buat header PDF
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Penjualan', 0, 1, 'C');

        // Tampilkan data penjualan dalam tabel
        foreach ($salesData as $sale) {
            $pdf->Cell(40, 10, $sale->product_name, 1, 0);
            $pdf->Cell(40, 10, $sale->quantity, 1, 0);
            $pdf->Cell(40, 10, $sale->total_amount, 1, 1);
        }

        // Simpan file PDF ke server atau kirim langsung ke browser
        $pdf->Output('sales_report.pdf', 'D');
    }
}
