<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_transaksi')->nullable();
            $table->unsignedBigInteger('id_product')->nullable();
            $table->integer('jumlah_pembelian')->default(0);
            $table->string('nama_product');
            $table->date('tanggal_transaksi');
            $table->integer('diskon');
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('id_detail_transaksi')->references('id')->on('detail_transaksis');
            $table->foreign('id_product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
