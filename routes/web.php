<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MnhuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('laptop/theloai/{id}', function($id) {
    return app(HomeController::class)->index(request()->merge(['id_danh_muc' => $id]));
});
require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return redirect('/');           
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/laptop/list', [ManagementController::class, 'list_laptop'])->name('laptop.list');

Route::post('/laptop/delete/{id}', [ManagementController::class, 'delete_laptop'])->name('laptop.delete');

Route::match(['GET', 'POST'], '/timkiem', [MnhuController::class, 'search']);

