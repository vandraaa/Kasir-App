<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'tanggal',
        'total_harga',
        'metode_pembayaran',
        'nama'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'float',
    ];
}
