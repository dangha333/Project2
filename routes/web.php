<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('listProduct', [ProductController::class, 'index'])->name('listProduct');
Route::get('addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
Route::post('addPostProduct', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
Route::get('updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::patch('updateProduct/{id}', [ProductController::class, 'updatePatchProduct'])->name('updatePatchProduct');
Route::delete('delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');


Route::get('listCategory', [CategoryController::class, 'index'])->name('listCategory');
Route::get('addCategory', [CategoryController::class, 'addCategory'])->name('addCategory');
Route::post('addPostCategory', [CategoryController::class, 'addPostCategory'])->name('addPostCategory');
Route::get('updateCategory/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
Route::patch('updateCategory/{id}', [CategoryController::class, 'updatePatchCategory'])->name('updatePatchCategory');
Route::delete('deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');

Route::get('listOrder', [OrderController::class, 'index'])->name('listOrder');
Route::get('listOrderDetail/{id}', [OrderController::class, 'listOrderDetail'])->name('listOrderDetail');