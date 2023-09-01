<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'nama_toko', 'stts_toko', 'no_telp_toko', 'image', 'provinces_id', 'provinsi', 'city_id', 'kota', 'kecamatan', 'detail_alamat', 'kode_pos'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'shops_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'shops_id', 'id');
    }

    public function saldo_shop()
    {
        return $this->hasOne(Models\SaldoShop::class, 'shops_id', 'id');
    }
}
