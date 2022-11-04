<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Products


Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

Route::get('/', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');
Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'show'])->name('show_product');
Route::get('/edit-product/{id}', [App\Http\Controllers\ProductsController::class, 'edit'])->name('edit_products');
Route::put('/edit-product/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('update_products');
Route::get('/create-product', [App\Http\Controllers\ProductsController::class, 'create'])->name('create_product');
Route::post('/create-product', [App\Http\Controllers\ProductsController::class, 'store'])->name('store_product');
Route::delete('/delete-product/{id}', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('destroy_product');

// Transaction
Route::get('/ajax-autocomplete-search', [App\Http\Controllers\TransactionsController::class, 'selectSearch']);
Route::get('/create-transaction', [App\Http\Controllers\TransactionsController::class, 'create'])->name('create_trans');
Route::post('/create-transaction', [App\Http\Controllers\TransactionsController::class, 'store'])->name('store_trans');
Route::get('/edit-transaction/{id}', [App\Http\Controllers\TransactionsController::class, 'edit'])->name('edit_trans');
Route::put('/edit-transaction/{id}', [App\Http\Controllers\TransactionsController::class, 'update'])->name('update_trans');
Route::get('/transaction', [App\Http\Controllers\TransactionsController::class, 'index'])->name('transaction');
Route::delete('/delete-transaction/,{id}', [App\Http\Controllers\TransactionsController::class, 'destroy'])->name('destroy_trans');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

