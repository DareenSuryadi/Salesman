<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('address_supp');
            $table->string('phone_supp');
            $table->string('pic_name');
            $table->string('phone');
            $table->text('address');
            $table->timestamps();
        });
    }


   /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('suppliers');
        }
    };