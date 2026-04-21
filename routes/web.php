<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
Route::get('/laptop/list', [ManagementController::class, 'list_laptop'])->name('laptop.list');

Route::post('/laptop/delete/{id}', [ManagementController::class, 'delete_laptop'])->name('laptop.delete');