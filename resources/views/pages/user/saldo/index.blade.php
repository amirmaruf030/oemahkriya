@extends('layouts.app')

@section('title')
    Saldo Saya
@endsection
@push('addon-style')
<style>
    .tarik {
        color: #fff;
    }

    .tarik:hover {
        color: yellow;
    }
</style>
@endpush
@section('content')
<!-- Page Content -->
<div class="page-content page-home">
    <div class="container">
        <div id="content" class="d-none d-sm-inline my-5">
            @include('includes.sidebar-dashboard-transaksi')
            <div id="products">
                <div class="row mx-0">
                    <div class="col-xl-12 col-md-6 mb-3">
                        <div class="card shadow h-100">
                            <div class="card-body bg-success">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <i class="fas fa-wallet fa-2x text-light"></i>
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Saldo Saya</div>
                                        <div class="h5 mb-0 font-weight-bold text-light text-gray-800">Rp{{ number_format($dataUser->saldo_user->saldo, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <a class="tarik" href="#" data-toggle="modal" data-target="#tarikSaldoUser">Tarik Saldo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-secondary">Riwayat Saldo</h6>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="thead-light">
                                            <th class="text-center align-middle">Jumlah Transaksi</th>
                                            <th class="text-center align-middle">Jenis Transaksi</th>
                                            <th class="text-center align-middle">Keterangan</th>
                                            <th class="text-center align-middle">Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataUser->saldo_user->riwayat_saldo_user->sortByDesc('created_at') as $dataRiwayat)
                                        <tr>
                                            <td>
                                                Rp{{ number_format($dataRiwayat->jumlah_transaksi, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $dataRiwayat->jenis_transaksi }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $dataRiwayat->keterangan }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $dataRiwayat->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum Ada Riwayat</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Perhatian!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Logout akan mengakhiri sesi Anda. Apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    {{--  <a href="login.html" class="btn btn-primary">Logout</a>  --}}
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="tarikSaldoUser" tabindex="-1" aria-labelledby="tarikSaldoUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarikSaldoUserLabel">Penarikan Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-form" action="{{ route('saldouser.tarik') }}" method="post">
                @csrf
                @method('GET')
                <div class="modal-body">
                    <div class="container">
                        <div class="row d-flex">
                            <input type="hidden" name="idUser" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="jumlahSaldo" value="{{ $dataUser->saldo_user->saldo }}">
                            <div class="col-lg-12">
                                @if($dataUser->saldo_user->saldo >=10000)
                                    <div class="mt-3">
                                        <div class="col-lg-7 mx-auto text-center">
                                                <label for="pengirimanPesanan" class="form-label">Rekening</label>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example" name="rekening">
                                                    <option selected>Pilih Rekening</option>
                                                    <option value="BCA">BCA</option>
                                                    <option value="BRI">BRI</option>
                                                    <option value="Mandiri">Mandiri</option>
                                                    <option value="CIMB Niaga">CIMB Niaga</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mx-auto text-center">
                                            <div class="mb-3">
                                                <label for="pengirimanPesanan" class="form-label">Nama Penerima</label>
                                                <input type="text" class="form-control text-center" id="pengirimanPesanan" name="penerima">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mx-auto text-center">
                                            <div class="mb-3">
                                                <label for="pengirimanPesanan" class="form-label">No Rekening</label>
                                                <input type="text" class="form-control text-center" id="pengirimanPesanan" name="noRekening">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mx-auto text-center">
                                            <div class="mb-3">
                                                <p class="text-success">Total saldo yang tersedia akan ditarik</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <div class="col-lg-7 mx-auto text-center">
                                            <label for="pengirimanPesanan" class="form-label mb-3 text-danger">Saldo Dibawah Minimal Penarikan</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($dataUser->saldo_user->saldo >=10000)
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        @else
                            <button type="submit" disabled class="btn btn-primary">Ajukan</button>
                        @endif
                    </div>
            </form>
        </div>
    </div>
</div>


@endsection