<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoUser extends Model
{
    use HasFactory;

    protected $table = 'saldo_users';

    protected $fillable = ['users_id', 'saldo'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'users_id');
    }

    public function riwayat_saldo_user()
    {
        return $this->hasMany(RiwayatSaldoUser::class, 'saldo_users_id', 'id');
    }

    public function tarikSaldoUser()
    {
        return $this->hasMany(TarikSaldoUser::class, 'users_id', 'users_id');
    }
}
