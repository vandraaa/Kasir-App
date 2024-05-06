<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'nama_item',
        'harga',
        'jumlah'
    ];

    protected $casts = [
        'harga' => 'float',
        'jumlah' => 'integer'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
