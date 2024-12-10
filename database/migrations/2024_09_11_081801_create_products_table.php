<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->nullable()->index();
            $table->foreignId('id_supplier')->nullable()->index();
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('price');
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
        
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->string('product_category_name');
            $table->timestamps();
        });
        
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kota_supp');
            $table->string('nama_negara_supp');
            $table->string('nama_provinsi_supp');
            $table->int('kode_pos');
            $table->string('supplier_name');
            $table->text('address_supp');
            $table->string('phone_supp');
            $table->string('pic_name');
            $table->string('phone');
            $table->text('address');
            $table->timestamps();
        });
        
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kasir');
            $table->timestamp('tanggal_transaksi');
            $table->integer('diskon')->default(0);
            $table->timestamps();
        });
        
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->nullable()->index();
            $table->foreignId('id_product')->nullable()->index();
            $table->integer('jumlah_pembelian');
            $table->timestamps();
        });
    
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
