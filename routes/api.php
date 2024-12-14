<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supplier2Controller;

Route::apiResource('suppliers', Supplier2Controller::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
