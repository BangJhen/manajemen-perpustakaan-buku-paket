<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookDamageController;
use App\Http\Controllers\ReportController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::resource('books', BookController::class);
Route::get('/books-damaged', [BookController::class, 'damaged'])->name('books.damaged');

// Book Damage Routes
Route::get('/books/{book}/damages/create', [BookDamageController::class, 'create'])->name('books.damages.create');
Route::post('/books/{book}/damages', [BookDamageController::class, 'store'])->name('books.damages.store');
Route::get('/books/{book}/damages/{damage}', [BookDamageController::class, 'show'])->name('books.damages.show');
Route::get('/books/{book}/damages/{damage}/edit', [BookDamageController::class, 'edit'])->name('books.damages.edit');
Route::put('/books/{book}/damages/{damage}', [BookDamageController::class, 'update'])->name('books.damages.update');
Route::delete('/books/{book}/damages/{damage}', [BookDamageController::class, 'destroy'])->name('books.damages.destroy');

Route::resource('categories', CategoryController::class);

// Report Routes
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');

// API Routes for AJAX calls
Route::get('/api/categories/{category}/books', [CategoryController::class, 'getBooks'])->name('api.categories.books');
