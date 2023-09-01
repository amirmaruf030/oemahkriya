<style>
    #filterbar.expand .nav-link.active {
        color: #ee4d2d !important;
    }
    #filterbar .box ul li.nav-item a.nav-link:hover span, 
    #filterbar .box ul li.nav-item a.nav-link:hover i {
        color: red;
    }
</style>

<div id="filterbar" class="expand">
    <div class="box">
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <li class="nav-item">
                <a class="nav-link text-secondary @if($aktif == 'Semua' || $aktif == 'Belum Bayar' || $aktif == 'Sedang Diproses' || $aktif == 'Dikirim' || $aktif == 'Selesai' || $aktif == 'Dibatalkan' || $aktif == 'Tagihan' || $aktif == 'Detail') active @endif" href="{{ route('dashboard-transaction') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pesanan Saya</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary @if($aktif == 'Akun Saya') active @endif" href="{{ route('dashboard-settings-account') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Akun Saya</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary @if($aktif == 'Saldo') active @endif" href="{{ route('saldo') }}">
                <i class="fas fa-fw fa-dollar"></i>
                <span>Saldo</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary @if($aktif == 'Alamat') active @endif" href="{{ route('dashboard-alamat') }}">
                <i class="fas fa-fw fa-map-marker-alt"></i>
                <span>Alamat</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>LogOut</span></a>
            </li>
            <hr class="sidebar-divider">
        </ul>
    </div>
</div>