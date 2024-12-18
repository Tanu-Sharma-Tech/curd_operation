<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, 'index'])->name('products.list');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{products}',[ProductController::class,'edit'])->name('products.edit');
Route::put('/products/{products}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/{products}',[ProductController::class,'destroy'])->name('products.destroy');


