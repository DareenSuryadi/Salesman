<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UlasanController;


Route::get('/', function () {
    return view('index');
});

//route resource for products
Route::resource('/products',\App\Http\Controllers\ProductController::class)->middleware('auth');
Route::resource('/suppliers', \App\Http\Controllers\SupplierController::class)->middleware('auth');
Route::resource('transaksis', TransaksiController::class)->middleware('auth');
Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('index');
Route::get('/plist', [App\Http\Controllers\LoginController::class, 'plist'])->name('plist');
Route::get('/home', [App\Http\Controllers\LoginController::class, 'home'])->name('home')->middleware('auth');
Route::get('/profile', [App\Http\Controllers\LoginController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/indexc', [App\Http\Controllers\ProductController::class, 'indexc'])->name('indexc')->middleware('auth');
Route::get('/cart', [App\Http\Controllers\LoginController::class, 'viewCart'])->name('cart');
Route::get('/cart/add/{id}', [App\Http\Controllers\LoginController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [App\Http\Controllers\LoginController::class, 'removeFromCart'])->name('cart.remove');
Route::post('cart/update/{id}', [App\Http\Controllers\LoginController::class, 'updateQuantity'])->name('cart.update');
Route::resource('/users', \App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('/category', \App\Http\Controllers\CategoryController::class)->middleware('auth');
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'registerForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/send-email/{to}/{Id}', [\App\Http\Controllers\TransaksiController::class,'sendemail']);
Route::get('/dashboard', [TransaksiController::class, 'dashboard'])->name('dashboard.customer')->middleware('auth');

Route::get('/products/{id}/details', [ProductController::class, 'showc'])->name('product.details');
Route::get('/ulasan/{id_transaksi}/create', [UlasanController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan/{id_transaksi}', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/ulasan/{id}', [UlasanController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan/{id}', [UlasanController::class, 'store'])->name('ulasan.store');
Route::get('/ulasan', [TransaksiController::class, 'indexUlasan'])->name('ulasan.index');
Route::get('/ulasan/{id_transaksi}/show', [UlasanController::class, 'show'])->name('ulasan.show');
