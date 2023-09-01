<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class DashboarSaldoController extends Controller
{
    public function index()
    {
        $dataUser = User::with(['saldo_user.riwayat_saldo_user'])->findOrFail(Auth::user()->id);
        $aktif = 'Saldo';

        return view('pages.user.saldo.index', compact('dataUser', 'aktif'));
    }
}
