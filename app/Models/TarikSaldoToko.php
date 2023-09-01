<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarikSaldoToko extends Model
{
    use HasFactory;

    protected $table = 'tarik_saldo_toko';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'shops_id',
        'nama_penerima',
        'rekening',
        'no_rekening',
        'jumlah_saldo',
        'tgl_penarikan',
        'status',
    ];

    public function saldo_shop()
    {
        return $this->belongsTo(SaldoShop::class, 'shops_id', 'shops_id');
    }
}
