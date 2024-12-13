<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'id',
        'tanggal_transaksi',
        'diskon',
        'created_at',
        'updated_at',
        'status',
        'id_user',
        'bukti_transaksi',
    ];

    // Relasi ke DetailTransaksi
    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'id_product'); // Asumsi id_product adalah foreign key
    // }

    public function get_transaksi(){
        //get all transaksi
        $sql = $this->select(
                            "transaksis.*", 
                            "products.title as title", 
                            "category_product.product_category_name as product_category_name", 
                            "products.price as price", 
                            "products.stock as stock",
                            "detail_transaksi.id_product as id_product", 
                            "detail_transaksi.jumlah_pembelian as jumlah_pembelian",
                            "users.email"
                        )
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksis.id')
                        ->join('users', 'users.id', '=', 'transaksis.id_user')
                        ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
                        ->join('category_product', 'category_product.id', '=', 'products.product_category_id');
        return $sql;
    }   

    
    public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_transaksi');
    }

}
