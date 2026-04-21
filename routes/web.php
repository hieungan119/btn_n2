<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route tìm kiếm laptop
Route::post('timkiem', [HomeController::class, 'search'])->name('laptop.search');
Route::get('laptop/theloai/{id}', function($id) {
    return app(HomeController::class)->index(request()->merge(['id_danh_muc' => $id]));
});
require __DIR__ . '/auth.php';

Route::get('/laptop/list', [ManagementController::class, 'list_laptop'])->name('laptop.list');

Route::post('/laptop/delete/{id}', [ManagementController::class, 'delete_laptop'])->name('laptop.delete');

