<style>
    .dropdown-transaksi {
        background-color: rgba(238, 77, 45, 0.8);
        /* Warna #ee4d2d dengan kapasitas transparan 80% */
        border: none;
        /* Hilangkan border default */
    }

    .btn-dropdown-transaksi {
        color: #fff;
        /* Warna font putih */
    }

    .circle {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: blue;
        color: white;
        text-align: center;
        line-height: 25px;
    }
    .circle-kosong {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: #b6b6e7;
        color: white;
        text-align: center;
        line-height: 25px;
    }

    .position-relative {
        position: relative;
    }

</style>

{{--  Perhitungan Data Perlu Dikirim  --}}
@php
    $perluDikirim = 0;
@endphp
@foreach($dataTransaksi->whereIn('transaction_status', 'SEDANG DIPROSES')->sortByDesc('updated_at') as $transaksi)
    @if($transaksi->payment_system == "Cash" || ($transaksi->payment_system == "DP" && isset($transaksi->tgl_byr_dp) && isset($transaksi->tgl_byr_tagihan)))
        @php
            $perluDikirim++;
        @endphp
    @endif
@endforeach

<div class="dropdown d-flex justify-content-end mb-3" style="margin-top: -50px;">
    <button class="btn btn-secondary btn-sm dropdown-toggle" style="margin-right:5px;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Laporan <i class="fas fa-caret-down"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <form action="{{ route('cetak-laporan.penjualan') }}" method="POST">
        @csrf
        <input type="hidden" name="rentangWaktu" value="minggu">
        @method('GET')
        <button type="submit" class=" dropdown-item btn-sm text-light bg-secondary mb-1"><i class="fas fa-print"></i> 1 Minggu</a></button>
        </form>
      </li>
      <li>
        <form action="{{ route('cetak-laporan.penjualan') }}" method="POST">
        @csrf
        <input type="hidden" name="rentangWaktu" value="bulan">
        @method('GET')
        <button type="submit" class=" dropdown-item btn-sm text-light bg-secondary mb-1"><i class="fas fa-print"></i> 1 Bulan</a></button>
        </form>
      </li>
      <li>
        <form action="{{ route('cetak-laporan.penjualan') }}" method="POST">
        @csrf
        <input type="hidden" name="rentangWaktu" value="tahun">
        @method('GET')
        <button type="submit" class=" dropdown-item btn-sm text-light bg-secondary"><i class="fas fa-print"></i> 1 Tahun</a></button>
        </form>
      </li>
    </ul>

    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $aktif }} <i class="fas fa-caret-down"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item position-relative" href="{{ route('transaction.index') }}">
                Semua
                @if($dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() + $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim > 1)
                        <span class="circle">{{ $dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() + $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim }}</span>
                    @else
                        <span class="circle-kosong">{{ $dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() + $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim }}</span>
                    @endif
                {{--  <span class="circle">2</span>  --}}
            </a>
        </li>
        <li><a class="dropdown-item position-relative" href="{{ route('transaction.belumbayar') }}">Belum Bayar</a></li>
        <li>
            <a class="dropdown-item position-relative" href="{{ route('transaction.perludiproses') }}">
                Perlu Diproses
                @if($dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() > 1)
                    <span class="circle" style="left: 125px;">{{ $dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() }}</span>
                @else
                    <span class="circle-kosong" style="left: 125px;">{{ $dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() }}</span>
                @endif
            </a>
        </li>
        <li>
            <a class="dropdown-item position-relative" href="{{ route('transaction.sedangdiproses') }}">
                Sedang Diproses
                @if($dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim > 1)
                    <span class="circle" style="left: 140px;">{{ $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim }}</span>
                @else
                    <span class="circle-kosong" style="left: 140px;">{{ $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim }}</span>
                @endif
            </a>
        </li>
        <li><a class="dropdown-item" href="{{ route('transaction.dikirim') }}">Dikirim</a></li>
        <li><a class="dropdown-item" href="{{ route('transaction.selesai') }}">Selesai</a></li>
        <li><a class="dropdown-item" href="{{ route('transaction.dibatalkan') }}">Dibatalkan</a></li>
    </ul>
</div>

@if($aktif == 'Belum Bayar' || $aktif == 'Dalam Penagihan')
        <div class="col-sm-12">
            <ul class="nav  justify-content-center nav-pills flex-wrap mt-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <a href="{{ route('transaction.belumbayar') }}" class="nav-link btn-sm @if($aktif == 'Belum Bayar') active  @endif border">Cash/DP</a>
                </li>
                <li class="nav-item text-center border" role="presentation">
                    <a href="{{ route('transaction.dalampenagihan') }}" class="nav-link btn-sm @if($aktif == 'Dalam Penagihan') active  @endif">Penagihan</a>
                </li>
            </ul>
        </div>
    @elseif($aktif == 'Sedang Diproses' || $aktif == 'Perlu Dikirim')
        <div class="col-sm-12">
            <ul class="nav  justify-content-center nav-pills flex-wrap mt-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <a href="{{ route('transaction.sedangdiproses') }}" class="nav-link btn-sm @if($aktif == 'Sedang Diproses') active  @endif border">Perlu Penagihan</a>
                </li>
                <li class="nav-item text-center border" role="presentation">
                    <a href="{{ route('transaction.perludikirim') }}" class="nav-link btn-sm @if($aktif == 'Perlu Dikirim') active  @endif">Perlu Dikirim</a>
                </li>
            </ul>
        </div>
    @endif