<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'supplier_name',
        'address_supp',
        'phone_supp',
        'pic_name',
        'phone',
        'address',
    ];

       /**
     * Mengambil informasi supplier
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function get_supplier()
    {
        // Mengambil semua informasi dari tabel supplier
        return self::select('*');
    }
}

  