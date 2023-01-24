<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BookShowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/books', [BooksController::class, 'readResponse']);
// Template Book Rendering

Route::get('/', [BookShowController::class, 'index'])->name('home');


Route::get('/category/{slug}', [BookShowController::class, 'category_view_all'])->name('category.slug');

Route::get('/book/{slug}', [BookShowController::class, 'book_view'])->name('book.slug');
