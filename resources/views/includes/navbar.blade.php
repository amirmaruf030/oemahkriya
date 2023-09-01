<nav class="navbar navbar-expand-lg navbar-red navbar-store fixed-top navbar-fixed-top" data-aos="" style="background-color: #3645a8 !important; padding: 5px 1rem;">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="/images/logo_ok.png" alt="Logo" />
        </a>
        @auth
            <a href="{{ route('cart') }}" class="nav-link d-block d-lg-none">
                @php
                    $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                    <img src="/images/icon-cart-filled2.svg" alt="" />
                    <div class="card-badge">{{ $carts }}</div>
                @else
                    <img src="/images/icon-cart-empty2.svg" alt="" />
                @endif
            </a>
        @endauth
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">Kategori</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bantuan') }}" class="nav-link">Bantuan</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Registrasi</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-light nav-link px-4"
                            style="color:#3645a8 !important;">Masuk</a>
                    </li>
                @endguest
            </ul>

            @auth
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                        @if(isset(Auth::user()->image))
                            <img src="{{ asset('storage/assets/profil/' . Auth::user()->image) }}" alt="" class="img-fluid rounded-circle mr-2 profile-picture" />
                        @else
                            <img src="/images/defaul-profil.png" alt="" class="rounded-circle mr-2 profile-picture" />
                        @endif
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">
                                Akun Saya
                            </a>
                            <a href="{{ route('dashboard-transaction') }}" class="dropdown-item">Pesanan Saya</a>
                            <a href="{{ route('dashboard-alamat') }}" class="dropdown-item">Alamat</a>
                            <a href="{{ route('admin-dashboard') }}" target="_blank" class="dropdown-item">Toko Saya</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            @if ($carts > 0)
                                <img src="/images/icon-cart-filled2.svg" alt="" />
                                <div class="card-badge">{{ $carts }}</div>
                            @else
                                <img src="/images/icon-cart-empty2.svg" alt="" />
                            @endif
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            Hi, {{ Auth::user()->name }} <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">
                                Akun Saya
                            </a>
                            <a href="{{ route('dashboard-transaction') }}" class="dropdown-item">Pesanan Saya</a>
                            <a href="{{ route('dashboard-alamat') }}" class="dropdown-item">Alamat</a>
                            <a href="{{ route('admin-dashboard') }}" target="_blank" class="dropdown-item">Toko Saya</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
