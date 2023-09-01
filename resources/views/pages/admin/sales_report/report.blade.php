<!DOCTYPE html>
<html>
<head>
  <title>Laporan Penjualan {{ $filename }}</title>
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

h1, h2, p {
  margin: 5px 0;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
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
        float: right; /* Menggeser elemen ke kanan */
    }

    .table-font-size {
      font-size: 12px;
    }

    .font-18 {
      font-size: 18px;
    }

    .font-14 {
      font-size: 14px;
    }

  </style>

  @php
    use Carbon\Carbon;
    use App\Transaction;
    use App\Models\Pengiriman;
  @endphp
</head>
<body>
  <div class="header">
    <h1 class="font-18">{{ Auth::user()->shop->nama_toko }}</h1>
    <p>{{ Auth::user()->shop->detail_alamat}}, {{ Auth::user()->shop->kecamatan}}, {{ Auth::user()->shop->kota }}</p>
    <p>{{ Auth::user()->shop->provinsi }}, {{ Auth::user()->shop->kode_pos }}</p>
  </div>

  <h2 class="font-14">Laporan Penjualan <span>{{ $rentanWaktu }}</span></h2>
  <span>{{ $dataWaktu }}</span>

  <table>
    <thead>
      <tr class="table-font-size">
        <th>No. Pesanan</th>
        <th>Status Pesanan</th>
        <th>Waktu Pemesanan</th>
        <th>Kurir</th>
        <th>Nama Produk</th>
        <th>Harga Produk</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $dataTransaksi)
            @foreach ($dataTransaksi->transaction_detail as $dataDetail)
                <tr class="table-font-size">
                    <td>{{ Transaction::findOrFail($dataDetail->transactions_id)->code }}</td>
                    <td>{{ Transaction::findOrFail($dataDetail->transactions_id)->transaction_status }}</td>
                    <td>{{ Transaction::findOrFail($dataDetail->transactions_id)->created_at }}</td>
                    <td>{{ strtoupper(Pengiriman::findOrFail($dataDetail->transactions_id)->jasa_kirim) }}</td>
                    <td>{{ $dataDetail->nama_produk }}</td>
                    <td>{{ $dataDetail->price }}</td>
                    <td>{{ $dataDetail->qty }}</td>
                </tr>
            @endforeach
      @endforeach
    </tbody>
  </table>
</body>
</html>
