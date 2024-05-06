<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'transaksi_id',
        'tanggal',
        'total_harga',
        'metode_pembayaran',
        'nama'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'float'
    ];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
