<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'product_category_id',
        'id_supplier',
        'description',
        'alamat',
        'price',
        'diskon',
        'stock',
        'video_link',
    ];

    protected $casts = [
        'diskon' => 'integer',
    ];

    public function getDiscountedPriceAttribute(): float
    {
        return (float) $this->price * (1 - ((int) $this->diskon / 100));
    }

    public function get_product(){
        // get all products
        $sql = $this->select("products.*", "category_product.product_category_name as product_category_name", "suppliers.supplier_name")
                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id')// Join
                    ->join('suppliers','suppliers.id','=', 'products.id_supplier');
        return $sql;
    }

    
    public function get_category_product(){
        $sql = DB::table ('category_product')->select('*');
        
        return $sql;
    }
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_product');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function fasilitas()
    {
    return $this->hasMany(Fasilitas::class);
    }

    public function getEmbedVideoLinkAttribute()
{
    $url = $this->video_link;

    if (strpos($url, 'youtube.com/watch') !== false) {
        return preg_replace('/watch\?v=/', 'embed/', $url);
    }

    if (strpos($url, 'youtu.be/') !== false) {
        return str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
    }

    if (strpos($url, 'vimeo.com/') !== false) {
        return preg_replace('/vimeo\.com\/(\d+)/', 'player.vimeo.com/video/$1', $url);
    }

    return $url;
}

    
    public function ulasans()
    {
        return $this->hasManyThrough(Ulasan::class, DetailTransaksi::class, 'id_product', 'id_transaksi', 'id', 'id_transaksi');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_product');
    }

}               
