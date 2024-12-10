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
        'nama_kota_supp',
        'nama_negara_supp',
        'nama_provinsi_supp',
        'kode_pos',
        'phone_supp',
        'pic_name',
        'phone_pic',
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