<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');


Route::resource('shop', App\Http\Controllers\ShopController::class);
Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index2');
Route::post('fetchdata', [App\Http\Controllers\ShopController::class, 'fetchData'])->name('shop.fetchData');
// Route::post('search', [App\Http\Controllers\ShopController::class, 'search'])->name('shop.search');


Route::resource('cart', App\Http\Controllers\CartController::class);

Route::post('pago', [App\Http\Controllers\PagoController::class, 'store']);

Route::get('csrf', [App\Http\Controllers\PagoController::class, 'getCsrf']);

