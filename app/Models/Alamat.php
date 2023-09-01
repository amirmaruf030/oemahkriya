<?php

namespace App\Models;

use App\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';

    protected $fillable = ['users_id', 'nama', 'no_telp', 'provinces_id', 'provinsi', 'city_id', 'kota', 'subdistrict_id', 'kecamatan', 'detail_alamat', 'kode_pos', 'utama', 'toko'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
