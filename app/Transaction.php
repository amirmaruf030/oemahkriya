<?php

namespace App;

use App\Models\RiwayatSaldoShop;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id',
        'shops_id',
        'shipping_price',
        'total_harga_produk',
        'payment_system',
        'total_price',
        'downpayment',
        'tagihan',
        'transaction_status',
        'catatan',
        'tgl_byr_dp',
        'tgl_byr_tagihan',
        'tgl_byr_cash',
        'tgl_konfirmasi',
        'code',
        'bukti_pembayaran'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shops_id', 'id');
    }

    public function pengiriman()
    {
        return $this->hasOne(Models\Pengiriman::class, 'transactions_id', 'id');
    }

    public function riwayat_saldo_shop()
    {
        return $this->belongsTo(RiwayatSaldoShop::class, 'id', 'saldo_shops_id');
    }
}
