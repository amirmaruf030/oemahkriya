<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatSaldoUser extends Model
{
    use HasFactory;

    protected $table = 'riwayat_saldo_users';

    protected $fillable = ['saldo_users_id', 'jumlah_transaksi', 'jenis_transaksi', 'keterangan'];

    public function saldo_user()
    {
        return $this->belongsTo(SaldoUser::class, 'saldo_users_id', 'saldo_users_id');
    }
}
