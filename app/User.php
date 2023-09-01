<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shop()
    {
        return $this->hasOne(Shop::class, 'users_id', 'id');
    }

    public function alamat()
    {
        return $this->hasMany(Models\Alamat::class, 'users_id', 'id');
    }

    public function saldo_user()
    {
        return $this->hasOne(Models\SaldoUser::class, 'users_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'users_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
}
