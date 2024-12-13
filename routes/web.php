<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

// Rute khusus
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/pdf', [CategoryController::class, 'generatePDF'])->name('categories.pdf');

// Rute lainnya
Route::get('/', function () {
    return view('welcome');
});
