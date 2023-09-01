@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection

@section('content')
    <!-- Section Content -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ route('transaction.belumbayar') }}">
                        <div class="card bg-danger border-danger text-white-50">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Belum Bayar</h5>
                                <p class="card-text fw-medium display-4 mb-0">{{ $belumbayar }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3">
                    <a href="{{ route('transaction.perludiproses') }}">
                        <div class="card bg-info border-info text-white-50">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Perlu Diproses</h5>
                                <p class="card-text fw-medium display-4 mb-0">{{ $perludiproses }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="{{ route('transaction.sedangdiproses') }}">
                        <div class="card bg-warning border-warning text-white-50">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Perlu Penagihan</h5>
                                <p class="card-text fw-medium display-4 mb-0">{{ $perlupenagihan }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="{{ route('transaction.perludikirim') }}">
                        <div class="card bg-success border-success text-white-50" style="background-color: #20c997;">
                            <div class="card-body">
                                <h5 class="mb-3 text-white">Perlu Dikirim</h5>
                                <p class="card-text fw-medium display-4 mb-0">{{ $perludikirim }}</p>
                            </div>
                        </div>

                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5 mx-auto">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center mb-4">
                                <h5 class="card-title me-2">Produk</h5>
                                <span class="fw-bolder card-title me-2 ms-auto">Total : {{ $produk }}</span>
                            </div>
                            <div class="row align-items-center">
                                <div class="px-3" data-simplebar style="max-height: 352px;">
                                    <ul class="list-unstyled activity-wid mb-0">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($latestproducts as $product)
                                            @if ($i <= 4)
                                                <li class="activity-list activity-border">
                                                    <div class="activity-icon avatar-md">
                                                        @if ($i % 2 == 0)
                                                            <span
                                                                class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        @else
                                                            <span
                                                                class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                        @endif
                                                        <i class="bx bx bx-shopping-bag font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="timeline-list-item">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                                    <h5 class="font-size-14 mb-1">
                                                                        {{ $product->name }}
                                                                    </h5>
                                                                    <p class="text-truncate text-muted font-size-13">
                                                                        {{ $product->created_at->diffForHumans() }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0 text-end me-3">
                                                                    <h6 class="mb-1">
                                                                        {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                                                                    </h6>
                                                                    <div class="font-size-13">{{ 'Stok ' . $product->stok }}
                                                                    </div>
                                                                </div>

                                                                <div class="flex-shrink-0 text-end">
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-24"
                                                                            role="button" data-bs-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" about="_blank"
                                                                                href="/details/{{ $product->slug }}">
                                                                                <i class="mdi mdi-android-messages"></i>
                                                                                Lihat
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($i == 5)
                                                <li class="activity-list">
                                                    <div class="activity-icon avatar-md">
                                                        <span
                                                            class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                            <i class="bx bx bx-shopping-bag font-size-24"></i>
                                                        </span>
                                                    </div>
                                                    <div class="timeline-list-item">
                                                        <div class="timeline-list-item">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 overflow-hidden me-4">
                                                                    <h5 class="font-size-14 mb-1">
                                                                        {{ $product->name }}
                                                                    </h5>
                                                                    <p class="text-truncate text-muted font-size-13">
                                                                        {{ $product->created_at->diffForHumans() }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0 text-end me-3">
                                                                    <h6 class="mb-1">
                                                                        {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                                                                    </h6>
                                                                    <div class="font-size-13">{{ $product->stok }}
                                                                    </div>
                                                                </div>

                                                                <div class="flex-shrink-0 text-end">
                                                                    <div class="dropdown">
                                                                        <a class="text-muted dropdown-toggle font-size-24"
                                                                            role="button" data-bs-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" about="_blank"
                                                                                href="/details/{{ $product->slug }}">
                                                                                <i class="mdi mdi-android-messages"></i>
                                                                                Lihat
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @php $i++; @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 mx-auto">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center mb-4">
                                        <h5 class="card-title me-2">Transaksi</h5>
                                        <span class="fw-bolder card-title me-2 ms-auto">Total : {{ $transaction }}</span>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="px-3" data-simplebar style="max-height: 352px;">
                                            <ul class="list-unstyled activity-wid mb-0">
                                                @php
                                                    $i = 1;
                                                @endphp
                                            @foreach ($latesttransactions as $latestransaction)
                                                    @if ($i <= 4)
                                                        <li class="activity-list activity-border">
                                                            <div class="activity-icon avatar-md">
                                                                @if ($i % 2 == 0)
                                                                    <span
                                                                        class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                                    @else
                                                                        <span
                                                                            class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                                @endif
                                                                <i class="bx bx bx-shopping-bag font-size-24"></i>
                                                                </span>
                                                            </div>
                                                            <div class="timeline-list-item">
                                                                <div class="timeline-list-item">
                                                                    <div class="d-flex">
                                                                        <div class="flex-grow-1 overflow-hidden me-4">
                                                                            <h5 class="font-size-14 mb-1">
                                                                                {{ $latestransaction->user->name ?? '' }}
                                                                            </h5>
                                                                            <p
                                                                                class="text-truncate text-muted font-size-13">
                                                                                {{ $latestransaction->created_at->diffForHumans() }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="flex-shrink-0 text-end me-3">
                                                                            <h6 class="mb-1">
                                                                                {{ 'Rp. ' . number_format($latestransaction->total_price, 0, ',', '.') }}
                                                                            </h6>
                                                                            <div class="font-size-13">
                                                                                {{ 'Status ' . $latestransaction->transaction_status }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="flex-shrink-0 text-end">
                                                                            <div class="dropdown">
                                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true">
                                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                                </a>

                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-end">
                                                                                    <a class="dropdown-item"
                                                                                        about="_blank"
                                                                                        href="{{ route('transactions-details', encrypt($latestransaction->id)) }}">
                                                                                        <i
                                                                                            class="mdi mdi-android-messages"></i>
                                                                                        Lihat
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @if ($i == 5)
                                                        <li class="activity-list">
                                                            <div class="activity-icon avatar-md">
                                                                <span
                                                                    class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                                    <i class="bx bx bx-shopping-bag font-size-24"></i>
                                                                </span>
                                                            </div>
                                                            <div class="timeline-list-item">
                                                                <div class="timeline-list-item">
                                                                    <div class="d-flex">
                                                                        <div class="flex-grow-1 overflow-hidden me-4">
                                                                            <h5 class="font-size-14 mb-1">
                                                                                {{ $latestransaction->user->name }}
                                                                            </h5>
                                                                            <p
                                                                                class="text-truncate text-muted font-size-13">
                                                                                {{ $latestransaction->created_at->diffForHumans() }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="flex-shrink-0 text-end me-3">
                                                                            <h6 class="mb-1">
                                                                                {{ 'Rp. ' . number_format($latestransaction->total_price, 0, ',', '.') }}
                                                                            </h6>
                                                                            <div class="font-size-13">
                                                                                {{ 'Status ' . $latestransaction->transaction_status }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="flex-shrink-0 text-end">
                                                                            <div class="dropdown">
                                                                                <a class="text-muted dropdown-toggle font-size-24"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true">
                                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                                </a>

                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-end">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @php $i++; @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
