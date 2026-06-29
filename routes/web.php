<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category/create', [CategorieController::class, 'create_category'])->name('create_category');
Route::post('/category/store', [CategorieController::class, 'store_category'])->name('store_category');
Route::get('/category', [CategorieController::class, 'index_categorie'])->name('index_categorie');

Route::get('/book/create', [BookController::class, 'create_book'])->name('create_book');
Route::post('/book/store', [BookController::class, 'store_book'])->name('store_book');
Route::get('/book', [BookController::class, 'index_book'])->name('index_book');
Route::get('/book/{book}/show', [BookController::class, 'show_book'])->name('show_book');
Route::get('/book/{book}/edit', [BookController::class, 'edit_book'])->name('edit_book');
Route::patch('/book/{book}/update', [BookController::class, 'update_book'])->name('update_book');
Route::delete('/book/{book}/delete', [BookController::class, 'delete_book'])->name('delete_book');

Route::post('/book/{book}/add_queue', [QueueController::class, 'add_to_queue'])->name('add_to_queue');
Route::get('/queue', [QueueController::class, 'index_queue'])->name('index_queue');
Route::patch('/queue/{queue}/update', [QueueController::class, 'update_queue'])->name('update_queue');
Route::delete('/queue/{queue}/delete', [QueueController::class, 'delete_queue'])->name('delete_queue');

Route::post('/queue/pinjam', [BorrowController::class, 'pinjam'])->name('pinjam');