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
    </style>

<ul class="nav nav-tabs text-center justify-content-center mb-3" id="myTab" role="tablist">
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi nav-transaksi text-secondary @if($aktif == 'Semua') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction') }}">
            Semua
            @if($notifikasi->where('users_id', Auth::user()->id)->whereIn('transaction_status', ['MENUNGGU KONFIRMASI', 'SEDANG DIPROSES', 'BELUM BAYAR', 'TAGIHAN', 'DIKIRIM'])->count() > 0)
                <span class="badge badge-primary rounded-circle">{{ $notifikasi->where('users_id', Auth::user()->id)->whereIn('transaction_status', ['MENUNGGU KONFIRMASI', 'SEDANG DIPROSES', 'BELUM BAYAR', 'TAGIHAN', 'DIKIRIM'])->count() }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Belum Bayar') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction-belumbayar') }}">
            Belum Bayar
            @if($notifikasi->where('users_id', Auth::user()->id)->where('transaction_status', 'BELUM BAYAR')->count() > 0)
                <span class="badge badge-primary rounded-circle">{{ $notifikasi->where('users_id', Auth::user()->id)->where('transaction_status', 'BELUM BAYAR')->count() }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Sedang Diproses') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction-sedangproses') }}">
            Sedang diproses
            @if($notifikasi->where('users_id', Auth::user()->id)->whereIn('transaction_status', ['MENUNGGU KONFIRMASI', 'SEDANG DIPROSES'])->count() > 0)
                <span class="badge badge-primary rounded-circle">{{ $notifikasi->where('users_id', Auth::user()->id)->whereIn('transaction_status', ['MENUNGGU KONFIRMASI', 'SEDANG DIPROSES'])->count() }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Tagihan') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction-tagihan') }}">
            Tagihan
            @if($notifikasi->where('users_id', Auth::user()->id)->where('transaction_status', 'TAGIHAN')->count() > 0)
                <span class="badge badge-primary rounded-circle">{{ $notifikasi->where('users_id', Auth::user()->id)->where('transaction_status', 'TAGIHAN')->count() }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Dikirim') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction-dikirim') }}">
            Dikirim
            @if($notifikasi->where('users_id', Auth::user()->id)->where('transaction_status', 'DIKIRIM')->count() > 0)
                <span class="badge badge-primary rounded-circle">{{ $notifikasi->where('users_id', Auth::user()->id)->where('transaction_status', 'DIKIRIM')->count() }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Selesai') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction-selesai') }}">Selesai</a>
    </li>
    <li class="nav-item mx-auto">
        <a class="nav-link nav-transaksi text-secondary @if($aktif == 'Dibatalkan') active  @endif" style="margin-bottom: 0" href="{{ route('dashboard-transaction-dibatalkan') }}">Dibatalkan</a>
    </li>
</ul>