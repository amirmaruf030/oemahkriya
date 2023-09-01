<!-- resources/views/sales_report/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <!-- Tambahkan CSS sesuai kebutuhan -->
</head>
<body>
    <h1>Laporan Penjualan</h1>

    <a href="{{ route('sales-report.pdf') }}" target="_blank">Generate PDF</a>
    <a href="{{ route('sales-report.penghasilan', 'minggu') }}" target="_blank">Generate Penghasilan PDF</a>
    <form action="{{ route('sales-report.penghasilan', 'minggu') }}" method="POST">
        @csrf
        @method('GET');
        <button type="submit">Cetak Penghasilan</button>
    </form>
</body>
</html>
