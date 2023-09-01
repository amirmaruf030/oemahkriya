<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transactions_id',
        'nama_produk',
        'products_id',
        'price',
        'qty',
        'image'
    ];

    protected $hidden = [];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id', 'transactions_id');
    }
}
