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
Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');


Route::post('chart', [App\Http\Controllers\ShopController::class, 'chart'])->name('chart');
Route::get('viewChart', [App\Http\Controllers\ShopController::class, 'viewChart'])->name('viewChart');
