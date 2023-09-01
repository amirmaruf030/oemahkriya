<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ url('/vendor/ruang-admin') }}/img/logo/logo.png" rel="icon">

    <title>@yield('title')</title>

    {{--  @stack('prepend-style')  --}}
    <link href="{{ url('/vendor/ruang-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/vendor/ruang-admin') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/vendor/ruang-admin') }}/css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/vendor/ruang-admin') }}/css/style.css">
    {{--  @stack('addon-style')  --}}
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                <img src="{{ url('/vendor/ruang-admin') }}/img/logo/logo2.png">
                </div>
                <div class="sidebar-brand-text mx-3">OemahKriya</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard-transaction') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pesanan Saya</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard-settings-account') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Akun Saya</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard-alamat') }}">
                <i class="fas fa-fw fa-map-marker-alt"></i>
                <span>Alamat</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>LogOut</span></a>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="{{ route('cart') }}">
                                @php
                                    $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                                @endphp
                                @if ($carts > 0)
                                <i class="fas fa-shopping-cart" style="font-size: 1.4em;"></i>
                                <span class="badge badge-warning badge-counter" style="font-size: 1em;">{{ $carts }}</span>
                                @else
                                <i class="fas fa-shopping-cart" style="font-size: 1.4em;"></i>
                                <span class="badge badge-warning badge-counter" style="font-size: 1em;"></span>
                                @endif
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{ url('/vendor/ruang-admin') }}/img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->name; }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-store fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Toko Saya
                                </a>
                                <a class="dropdown-item" href="alamat.html">
                                    <i class="fas fa-map-marker-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Alamat
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-clipboard-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pesanan Saya
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Beranda
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Tutup Topbar -->

                {{-- Content --}}
                @yield('content')
                
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>copyright &copy;
                    <script> document.write(new Date().getFullYear()); </script> - developed by
                    <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                    </span>
                </div>
                </div>
            </footer>
            <!-- Footer -->

        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="{{ url('/vendor/ruang-admin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('/vendor/ruang-admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/vendor/ruang-admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ url('/vendor/ruang-admin') }}/js/ruang-admin.min.js"></script>
    @stack('addon-script')
</body>

</html>
