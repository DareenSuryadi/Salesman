<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_product', 
        'jumlah_pembelian', 
        'nama_kasir', 
        'tanggal_transaksi', 
        'diskon'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
