    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-bottom-color: red !important;
            color: red !important;
        }

        .bg-navbar {
            background-color: #ee4d2d !important;
        }

        .sidebar-light .sidebar-brand {
            background-color: #dc4325 !important;
        }

        .nav-item .nav-transaksi:hover {
            color: #dc4325 !important;
            border-bottom-color: #dc4325;
        }

        {{--  Mulai  --}}
        .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: blue;
        }
        .circle-kosong {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #b6b6e7;
        }
        .circle2 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #fff;
        }

        .number {
            position: relative;
            z-index: 1;
            color: #fff;
        }
        .number2 {
            position: relative;
            z-index: 1;
            color: blue;
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

    <ul class="nav nav-tabs text-center justify-content-center" id="myTab" role="tablist">
        <li class="nav-item ">
            <a class="nav-link nav-transaksi nav-transaksi text-secondary @if($aktif == 'Semua') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.index') }}">
                <span style="margin-right:10px;">Semua</span>
                <span class="text-success position-relative">
                    @if($dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() + $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim + $dataTransaksi->where('transaction_status', 'DIKIRIM')->count() + $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() + $dataTransaksi->where('transaction_status', 'TAGIHAN')->count() > 0)
                        <span class="circle"></span>
                    @else
                        <span class="circle-kosong"></span>
                    @endif
                    <span class="number">{{ $dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() + $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim + $dataTransaksi->where('transaction_status', 'DIKIRIM')->count() + $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() + $dataTransaksi->where('transaction_status', 'TAGIHAN')->count() }}</span>
                </span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Belum Bayar' || $aktif == 'Dalam Penagihan') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.belumbayar') }}">
                <span style="margin-right:10px;">Belum Bayar</span>
                <span class="text-success position-relative">
                    @if( $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() + $dataTransaksi->where('transaction_status', 'TAGIHAN')->count() > 0)
                        <span class="circle"></span>
                    @else
                        <span class="circle-kosong"></span>
                    @endif
                    <span class="number">{{ $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() + $dataTransaksi->where('transaction_status', 'TAGIHAN')->count() }}</span>
                </span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Perlu Diproses') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.perludiproses') }}">
                <span style="margin-right:10px;">Perlu Diproses</span>
                <span class="position-relative">
                    @if($dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() > 0)
                        <span class="circle"></span>
                    @else
                        <span class="circle-kosong"></span>
                    @endif
                    <span class="number">{{ $dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() }}</span>
                </span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Sedang Diproses' || $aktif == 'Perlu Dikirim') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.sedangdiproses') }}">
            <span style="margin-right:10px;">Sedang Diproses</span>
            <span class="text-success position-relative">
                @if($dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim > 0)
                    <span class="circle"></span>
                @else
                    <span class="circle-kosong"></span>
                @endif
                <span class="number">{{ $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() + $perluDikirim }}</span>
            </span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Dikirim') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.dikirim') }}">
                <span style="margin-right:10px;">Dikirim</span>
                <span class="text-success position-relative">
                    @if($dataTransaksi->where('transaction_status', 'DIKIRIM')->count() > 0)
                        <span class="circle"></span>
                    @else
                        <span class="circle-kosong"></span>
                    @endif
                    <span class="number">{{ $dataTransaksi->where('transaction_status', 'DIKIRIM')->count() }}</span>
                </span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Selesai') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.selesai') }}">Selesai</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Dibatalkan') active  @endif" style="margin-bottom: 0" href="{{ route('transaction.dibatalkan') }}">Dibatalkan</a>
        </li>
    </ul>

    @if($aktif == 'Belum Bayar' || $aktif == 'Dalam Penagihan')
        <div class="col-sm-12">
            <ul class="nav  justify-content-center nav-pills flex-wrap mt-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <a href="{{ route('transaction.belumbayar') }}" class="nav-link btn-sm @if($aktif == 'Belum Bayar') active  @endif border">
                        {{--  {{ $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() }}  --}}
                        <span style="margin-right:10px;">Cash/DP</span>
                        <span class="text-success position-relative">
                            @if($aktif == 'Belum Bayar')
                                <span class="circle2"></span>
                                <span class="number2">{{ $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() }}</span>
                            @else
                                <span class="circle"></span>
                                <span class="number">{{ $dataTransaksi->where('transaction_status', 'BELUM BAYAR')->count() }}</span>
                            @endif
                        </span>
                    </a>
                </li>
                <li class="nav-item text-center border" role="presentation">
                    <a href="{{ route('transaction.dalampenagihan') }}" class="nav-link btn-sm @if($aktif == 'Dalam Penagihan') active  @endif">
                        <span style="margin-right:10px;">Penagihan</span>
                        <span class="text-success position-relative">
                            @if($aktif == 'Dalam Penagihan')
                                <span class="circle2"></span>
                                <span class="number2">{{ $dataTransaksi->where('transaction_status', 'TAGIHAN')->count() }}</span>
                            @else
                                <span class="circle"></span>
                                <span class="number">{{ $dataTransaksi->where('transaction_status', 'TAGIHAN')->count() }}</span>
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    @elseif($aktif == 'Sedang Diproses' || $aktif == 'Perlu Dikirim')
        <div class="col-sm-12">
            <ul class="nav  justify-content-center nav-pills flex-wrap mt-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <a href="{{ route('transaction.sedangdiproses') }}" class="nav-link btn-sm @if($aktif == 'Sedang Diproses') active  @endif border">
                        <span style="margin-right:10px;">Perlu Penagihan</span>
                        <span class="text-success position-relative">
                        @if($aktif == 'Sedang Diproses')
                            <span class="circle2"></span>
                            <span class="number2">{{ $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() }}</span>
                        @else
                            <span class="circle"></span>
                            <span class="number">{{ $dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() }}</span>
                        @endif
                        </span>
                    </a>
                </li>
                <li class="nav-item text-center border" role="presentation">
                    <a href="{{ route('transaction.perludikirim') }}" class="nav-link btn-sm @if($aktif == 'Perlu Dikirim') active  @endif">
                    <span style="margin-right:10px;">Perlu Dikirim</span>
                        <span class="text-success position-relative">
                            @if($aktif == 'Perlu Dikirim')
                                <span class="circle2"></span>
                                <span class="number2">{{ $perluDikirim }}</span>
                            @else
                                <span class="circle"></span>
                                <span class="number">{{ $perluDikirim }}</span>
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-0">
                <div class="card-body">
                @if($aktif == 'Perlu Diproses')
                    @if($dataTransaksi->where('transaction_status', 'MENUNGGU KONFIRMASI')->count() != null)
                        <span class="fw-bolder text-danger">Harap konfirmasi pesanan segera untuk menyiapkan pesanan</span>
                    @endif
                @elseif($aktif == 'Sedang Diproses')
                    @if($dataTransaksi->where('transaction_status', 'SEDANG DIPROSES')->where('payment_system', 'DP')->whereNotNull('tgl_byr_dp')->whereNull('tgl_byr_tagihan')->count() != null)
                        <span class="fw-bolder text-danger">Mohon ajukan tagihan setelah pesanan siap dikirim</span>
                    @endif
                @elseif($aktif == 'Perlu Dikirim')
                    @php $data = 0; @endphp
                    @foreach($dataTransaksi->whereIn('transaction_status', 'SEDANG DIPROSES') as $transaksi)
                        @if($transaksi->payment_system == "Cash" || ($transaksi->payment_system == "DP" && isset($transaksi->tgl_byr_dp) && isset($transaksi->tgl_byr_tagihan)))
                            @php $data++; @endphp
                        @endif
                    @endforeach
                    @if($data > 0)
                        <span class="fw-bolder text-danger">Mohon input resi setelah pesanan dikirim</span>
                    @endif
                @endif
                    <form action="{{ route('cetak-laporan.penjualan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="rentangWaktu" value="tahun">
                        @method('GET')
                        <button type="submit" class="float-end m-1 btn btn-sm btn-secondary"><i class="fas fa-print"></i> 1 Tahun</a></button>
                    </form>
                    <form action="{{ route('cetak-laporan.penjualan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="rentangWaktu" value="bulan">
                        @method('GET')
                        <button type="submit" class="float-end mt-1 btn btn-sm btn-secondary"><i class="fas fa-print"></i> 1 Bulan</a></button>
                    </form>
                    <form action="{{ route('cetak-laporan.penjualan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="rentangWaktu" value="minggu">
                        @method('GET')
                        <button type="submit" class="float-end m-1 btn btn-sm btn-secondary"><i class="fas fa-print"></i> 1 Minggu</a></button>
                    </form>
                    <span class="fw-bolder text-secondary float-end mt-2">Laporan Penjualan</span>
                </div>
            </div>
        </div>
    </div>