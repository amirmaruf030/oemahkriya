<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoShop extends Model
{
    use HasFactory;

    protected $table = 'saldo_shops';

    protected $fillable = ['shops_id', 'saldo'];

    public function tarikSaldoToko()
    {
        return $this->hasMany(TarikSaldoToko::class, 'shops_id', 'shops_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id', 'shops_id');
    }

    public function riwayat_saldo_shop()
    {
        return $this->hasMany(RiwayatSaldoShop::class, 'saldo_shops_id', 'id');
    }
}
