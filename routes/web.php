<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MnhuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhienController;


Route::get('/', [HomeController::class, 'index']);
Route::post('/cart/delete','App\Http\Controllers\OrderController@cartdelete')->name('cartdelete');
Route::get('/gio-hang','App\Http\Controllers\OrderController@order')->name('order');
Route::post('/order/create','App\Http\Controllers\OrderController@ordercreate') ->middleware('auth')->name('ordercreate');
Route::get('/testemail','App\Http\Controllers\OrderController@testemail');


Route::get('/dashboard', function () {
    //return view('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('laptop/theloai/{id}', function($id) {
    return app(HomeController::class)->index(request()->merge(['id_danh_muc' => $id]));
});
require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return redirect('/');           

})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('home/detail/{id}','App\Http\Controllers\NhienController@detail');
Route::post('/cart/add','App\Http\Controllers\NhienController@cartadd')->name('cartadd');

Route::get('/laptop/list', [ManagementController::class, 'list_laptop'])->name('laptop.list');

Route::post('/laptop/delete/{id}', [ManagementController::class, 'delete_laptop'])->name('laptop.delete');

Route::match(['GET', 'POST'], '/timkiem', [MnhuController::class, 'search']);
