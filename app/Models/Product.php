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
        'price',
        'stock',
    ];
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
    
    
    }               
