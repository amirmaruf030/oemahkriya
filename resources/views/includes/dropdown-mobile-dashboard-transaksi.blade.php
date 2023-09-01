<style>
  .dropdown-transaksi {
    background-color: rgba(238, 77, 45, 0.8); /* Warna #ee4d2d dengan kapasitas transparan 80% */
    border: none; /* Hilangkan border default */
  }

  .btn-dropdown-transaksi {
    color: #fff; /* Warna font putih */
  }

</style>

<div class="dropdown d-flex justify-content-end mb-3" style="margin-top: -14px;">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ $aktif }}
    </button>
    <div class="dropdown-menu mr-3">
        <a class="dropdown-item" href="{{ route('dashboard-transaction') }}">Semua</a>
        <a class="dropdown-item" href="{{ route('dashboard-transaction-belumbayar') }}">Belum Bayar</a>
        <a class="dropdown-item" href="{{ route('dashboard-transaction-sedangproses') }}">Sedang Diproses</a>
        <a class="dropdown-item" href="{{ route('dashboard-transaction-tagihan') }}">Tagihan</a>
        <a class="dropdown-item" href="{{ route('dashboard-transaction-dikirim') }}">Dikirim</a>
        <a class="dropdown-item" href="{{ route('dashboard-transaction-selesai') }}">Selesai</a>
        <a class="dropdown-item" href="{{ route('dashboard-transaction-dibatalkan') }}">Dibatalkan</a>
    </div>
</div>