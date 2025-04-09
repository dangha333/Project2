<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('listProduct', [ProductController::class, 'index'])->name('listProduct');
Route::get('addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
Route::post('addPostProduct', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
Route::get('updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::patch('updateProduct/{id}', [ProductController::class, 'updatePatchProduct'])->name('updatePatchProduct');
Route::delete('delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');