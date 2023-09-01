<!DOCTYPE html>
<html>

<head>
  <title>Laporan Penghasilan {{ $filename }}</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      width: 100px;
    }

    h1,
    h2,
    p {
      margin: 5px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 8px;
    }

    thead {
      background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #e5e5e5;
    }

    .align-right {
      float: right;
      /* Menggeser elemen ke kanan */
    }

    .table-font-size {
      font-size: 12px;
    }

    .text-center {
      text-align: center;
    }

    .font-18 {
      font-size: 18px;
    }

    .font-14 {
      font-size: 14px;
    }

    .borderless-table {
      border-collapse: collapse;
      border: none;
    }

    .borderless-table td {
      border: none;
      padding: 5px;
    }

    .half-page {
      width: 40%;
      float: left;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1 class="font-18">{{ Auth::user()->shop->nama_toko }}</h1>
    <p>{{ Auth::user()->shop->detail_alamat}}, {{ Auth::user()->shop->kecamatan}}, {{ Auth::user()->shop->kota }}</p>
    <p>{{ Auth::user()->shop->provinsi }}, {{ Auth::user()->shop->kode_pos }}</p>
  </div>

  <h2 class="font-14">Laporan Penghasilan <span>{{ $rentanWaktu }}</span></h2>
  <span>{{ $dataWaktu }}</span>

  <table>
    <thead>
      <tr class="table-font-size">
        <th>No. Pesanan</th>
        <th>Status</th>
        <th>Tanggal Pesanan</th>
        <th>Tanggal Diterima</th>
        <th>Tanggal Dibatalkan</th>
        <th>Metode Pembayaran</th>
        <th>Total Harga Produk</th>
        <th>Ongkos Kirim</th>
        <th>Total Pembayaran</th>
        <th>Saldo Diterima</th>
      </tr>
    </thead>
    <tbody>
      @foreach($transaksi as $dataTransaksi)
        <tr class="table-font-size">
          <td>{{ $dataTransaksi->code }}</td>
          <td>{{ $dataTransaksi->transaction_status }}</td>
          <td>{{ $dataTransaksi->created_at->format('d-m-Y') }}</td>
            @if($dataTransaksi->transaction_status == 'SELESAI')
              <td>{{ $dataTransaksi->pengiriman->updated_at->format('d-m-Y') }}</td>
            @else
              <td class="text-center">-</td>
            @endif
            @if($dataTransaksi->transaction_status == 'SELESAI')
              <td class="text-center">-</td>
            @else
              <td>{{ $dataTransaksi->pengiriman->updated_at->format('d-m-Y') }}</td>
            @endif
          <td>{{ $dataTransaksi->payment_system }}</td>
          <td>{{ $dataTransaksi->total_harga_produk }}</td>
          <td>{{ $dataTransaksi->shipping_price }}</td>
          <td>{{ $dataTransaksi->total_price }}</td>
          @if($dataTransaksi->transaction_status == 'SELESAI')
            <td>{{ $dataTransaksi->total_price }}</td>
          @else
            <td>{{ $dataTransaksi->downpayment }}</td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>

</body>

</html>