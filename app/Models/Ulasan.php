<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'id_transaksi',
        'ulasan',
        'rating',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_transaksi' => 'integer',
        'ulasan' => 'string',
        'rating' => 'string', // ENUM di database, disimpan sebagai string di model
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

}