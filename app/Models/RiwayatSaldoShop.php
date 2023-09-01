<?php

namespace App\Models;

use App\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatSaldoShop extends Model
{
    use HasFactory;

    protected $table = 'riwayat_saldo_shops';

    protected $fillable = ['saldo_shops_id', 'jumlah_transaksi', 'jenis_transaksi', 'keterangan'];

    public function saldo_shop()
    {
        return $this->belongsTo(Models\SaldoShop::class, 'saldo_shops_id', 'saldo_shops_id');
    }
}
