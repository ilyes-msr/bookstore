<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PublishersController;
use App\Http\Controllers\AuthorsController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard');
});

Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/search', [GalleryController::class, 'search'])->name('search');
Route::get('/book/{book}', [BooksController::class, 'details'])->name('book.details');

Route::get('/categories/search', [CategoriesController::class, 'search'])->name('categories.search');
Route::get('/categories/{category}', [CategoriesController::class, 'result'])->name('gallery.categories.show');
Route::get('/categories', [CategoriesController::class, 'list'])->name('gallery.categories.list');

Route::get('/publishers/search', [PublishersController::class, 'search'])->name('publishers.search');
Route::get('/publishers/{publisher}', [PublishersController::class, 'result'])->name('gallery.publishers.show');
Route::get('/publishers', [PublishersController::class, 'list'])->name('gallery.publishers.list');

Route::get('/authors/search', [AuthorsController::class, 'search'])->name('authors.search');
Route::get('/authors/{author}', [AuthorsController::class, 'result'])->name('gallery.authors.show');
Route::get('/authors', [AuthorsController::class, 'list'])->name('gallery.authors.list');

Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');

// Route::get('/admin/books', [BooksController::class, 'index'])->name('books.index');
// Route::get('/admin/books/create', [BooksController::class, 'create'])->name('books.create');
// Route::post('/admin/books', [BooksController::class, 'store'])->name('books.store');
// Route::get('/admin/books/{book}', [BooksController::class, 'show'])->name('books.show');
// Route::get('/admin/books/{book}/edit', [BooksController::class, 'edit'])->name('books.edit');
// Route::patch('/admin/books/{book}', [BooksController::class, 'update'])->name('books.update');
// Route::delete('/admin/books/{book}', [BooksController::class, 'destroy'])->name('books.delete');

Route::resource('/admin/books', BooksController::class);

Route::get('/infos', function () {
    return phpinfo();
});
