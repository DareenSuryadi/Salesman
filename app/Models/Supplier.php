<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function get_supplier()
    {
    // Mengambil informasi supplier_name dan picsupplier
    $sql = $this->select("*");

    return $sql;
    }

}
