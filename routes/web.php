<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::post('/cart/delete','App\Http\Controllers\OrderController@cartdelete')->name('cartdelete');
Route::get('/gio-hang','App\Http\Controllers\OrderController@order')->name('order');
Route::post('/order/create','App\Http\Controllers\OrderController@ordercreate') ->middleware('auth')->name('ordercreate');
Route::get('/testemail','App\Http\Controllers\OrderController@testemail');


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';