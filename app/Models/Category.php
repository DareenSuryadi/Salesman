<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='category_product';

    protected $fillable = [
        'product_category_name',
    ];
    
    public function get_category(){
        $sql = $this->select("category_product.*");

        return $sql;
    }
}
