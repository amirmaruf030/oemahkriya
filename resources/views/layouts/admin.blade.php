<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    {{--  <link rel="shortcut icon" href="/assets/images/favicon.ico">  --}}

    <title>@yield('title')</title>

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    
    <link href="{{ url('/vendor/ruang-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <style>
        .bg-utama {
            background: #3645a8;
            color: #fff;
        }

        .bg-utama:hover {
            color: yellow;
        }

        .bg-second {
            background: #dbe0ff;
        }

        .bg-mid {
            background: #a5b1ff;
        }
    </style>
    @stack('addon-style')
</head>

<body>
    <header id="page-topbar">
        <div class="navbar-header" style="background-color: #3645a8;">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box" style="background-color: #3645a8; border-right:none !important;">
                    <a href="/toko" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/assets/images/favicon.ico" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/favicon.ico" alt="" height="24"> <span
                                class="logo-txt text-white">OemahKriya</span>
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars text-light"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        {{--  <h5 class="mt-2 text-secondary">Marketplace Oemah Kriya</h5>  --}}
                    </div>
                </form>

            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item   "
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" style="background-color: #3645a8; color: #fff;">
                            @php use App\Shop;  @endphp
                            @if(isset(Shop::where('users_id', Auth::user()->id)->first()->image))
                                <img class="rounded-circle header-profile-user" src="{{ Storage::url(Shop::where('users_id', Auth::user()->id)->first()->image ?? '') }}" alt="Header Avatar">
                            @elseif(isset(Auth::user()->image))
                                <img class="rounded-circle header-profile-user" src="{{ asset('storage/assets/profil/' . Auth::user()->image) }}" alt="Header Avatar">
                            @else
                                <img class="rounded-circle header-profile-user" src="/assets/images/users/default-shop.png"
                                alt="Header Avatar">
                            @endif
                        <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->shop->nama_toko }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('pengaturan-toko') }}">
                            <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                            Profile</a>
                        <a class="dropdown-item" href="/" target="_blank">
                            <i class="mdi mdi-earth font-size-16 align-middle me-1"></i> Beranda </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100" style="background:#dbe0ff;">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Menu Toko</li>
                    <li>
                        <a href="{{ route('admin-dashboard') }}">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">
                            <i class="bx bx-bx bxs-store"></i>
                            <span data-key="t-horizontal">Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transaction.index') }}">
                            <i class="bx bx-bx bxs-bx bx-transfer"></i>
                            <span data-key="t-horizontal">Transaksi</span>
                        </a>
                    </li>
                    @if(Auth::user()->roles == 'USER')
                        <li>
                            <a href="{{ route('penghasilan.index') }}">
                                <i class="fas fa-hand-holding-usd"></i>
                                <span data-key="t-horizontal">Penghasilan</span>
                            </a>
                        </li>
                    @endif
                    {{--  <li>
                        <a href="{{ route('product-gallery.index') }}">
                            <i class="bx bx-bx bxs-bx bx-photo-album"></i>
                            <span data-key="t-horizontal">Galleries</span>
                        </a>
                    </li>  --}}
                    @if(Auth::user()->roles == 'ADMIN')
                        <li>
                            <a href="{{ route('category.index') }}">
                                <i class="bx bx-bx bxs-bx bx-collection"></i>
                                <span data-key="t-horizontal">Kategori</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('pengaturan-toko') }}">
                            {{--  <i class="dripicons-user-group"></i>  --}}
                            <i data-feather="settings"></i>
                            <span data-key="t-horizontal">Pengaturan Toko</span>
                        </a>
                    </li>
                    {{--  <li>
                        <a href="{{ route('user.index') }}">
                            <i class="dripicons-user-group"></i>
                            <span data-key="t-horizontal">Users</span>
                        </a>
                    </li>  --}}
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span data-key="t-horizontal">LogOut</span>
                        </a>
                    </li>
                    <hr>
                </ul>

                {{--  <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                    <div class="card-body">
                        <i class="bx bx-chat bx-lg text-primary"></i>
                        <div class="mt-4">
                            <h5 class="alertcard-title font-size-16">CS 24 Jam</h5>
                            <p class="font-size-13">Chat dengan CS Toko Sport Jago Software. Silahkan tanyakan terkait
                                product kami</p>
                            <a href="https://wa.link/egfbid" target="_blank" class="btn btn-primary mt-2">Chat CS</a>
                        </div>
                    </div>
                </div>  --}}
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    <div class="main-content">

        @yield('content')

        <!-- End Page-content -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Oemah Kriya.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a href="#!" class="text-decoration-underline">M Amir Maruf</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="/assets/libs/jquery/jquery.min.js"></script>
    @stack('addon-script')

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>
    <script src="/assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="/assets/libs/pace-js/pace.min.js"></script>
    <!-- choices js -->
    <script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- color picker js -->
    <script src="/assets/libs/@simonwep/pickr/pickr.min.js"></script>
    <script src="/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

    <!-- datepicker js -->
    <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

    <!-- init js -->
    <script src="/assets/js/pages/form-advanced.init.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

</body>

</html>
