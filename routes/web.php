<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhienController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [NhienController::class, 'index']);
Route::get('home/detail/{id}','App\Http\Controllers\NhienController@detail');
Route::post('/cart/add','App\Http\Controllers\NhienController@cartadd')->name('cartadd');

require __DIR__.'/auth.php';
