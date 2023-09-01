<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarikSaldoUser extends Model
{
    use HasFactory;

    protected $table = 'tarik_saldo_users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'users_id',
        'nama_penerima',
        'rekening',
        'no_rekening',
        'jumlah_saldo',
        'tgl_penarikan',
        'status',
    ];

    public function saldo_user()
    {
        return $this->belongsTo(SaldoUser::class, 'users_id', 'users_id');
    }
}
