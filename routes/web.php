<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;


Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/products',\App\Http\Controllers\ProductController::class);
Route::resource('/suppliers', \App\Http\Controllers\SupplierController::class);
Route::delete('suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
Route::resource('transaksis', TransaksiController::class);
