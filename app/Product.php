<?php

namespace App;

use App\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'shops_id', 'categories_id', 'price', 'description', 'slug', 'stok', 'weigth', 'jmlh_penjualan'
    ];

    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shops_id', 'id');
    }

    public function transaction_detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id', 'id');
    }
}
