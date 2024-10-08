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
            $table->string('image');
            $table->string('title');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('id_supplier');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('product_category_id')->references('id')->on('category_product');
            $table->foreign('id_supplier')->references('id')->on('suppliers');
        });
        Schema::create('category_product', function (Blueprint $table){
            $table->id();
            $table->string('product_category_name');
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
