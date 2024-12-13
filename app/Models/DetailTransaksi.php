<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi'; // Nama tabel di database

    protected $fillable = [
        'id_transaksi',
        'id_product',
        'jumlah_pembelian',
    ];

    // Relasi ke model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
