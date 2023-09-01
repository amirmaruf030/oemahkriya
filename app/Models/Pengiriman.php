<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = ['transactions_id', 'penerima', 'no_telp_penerima', 'alamat_penerima', 'pengirim', 'alamat_pengirim', 'no_telp_pengirim', 'jasa_kirim', 'resi', 'tgl_pengiriman'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
