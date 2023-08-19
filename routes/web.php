<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookListController;
use App\Http\Controllers\HomeController;
use App\Models\BookList;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


/* Admin login Part start */
Route::get('/admin/login', [AdminController::class, 'loginForm']);
Route::post('login', [AdminController::class, 'loginFunctionality'])->name('loginFunctionality');

//admin loggedin routes
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::post('logout', [AdminController::class, 'logout'])->name('logoutt');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //Crud Author
    Route::get('/authors', [AuthorController::class, 'authors'])->name('authors');
    Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/store', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/author/edit/{author}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/author/update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::post('/author/delete/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');


    //Create Book List
    Route::get('/books', [BookListController::class, 'books'])->name('books');
    Route::get('/book/create', [BookListController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookListController::class, 'store'])->name('book.store');
    Route::get('/book/edit/{book}', [BookListController::class, 'edit'])->name('book.edit');
    Route::post('/book/update/{id}', [BookListController::class, 'update'])->name('book.update');
    Route::post('/book/delete/{id}', [BookListController::class, 'destroy'])->name('book.destroy');


    //Create Category List
    Route::get('/categories', [BookCategoryController::class, 'index'])->name('categories');
    Route::get('/category/create', [BookCategoryController::class, 'create'])->name('categories.create');
    Route::post('/category/store', [BookCategoryController::class, 'store'])->name('categories.store');
    Route::get('/category/edit{category}', [BookCategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/category/update/{id}', [BookCategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete/{id}', [BookCategoryController::class, 'destroy'])->name('category.destroy');
});
