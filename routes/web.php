<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
