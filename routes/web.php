<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SearchController;

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
Route::any('/', [IndexController::class, 'index'])->name('index');
Route::any('/movie/{cid?}', [MovieController::class, 'index'])->name('movie');
Route::any('/movie/category/{cid?}', [MovieController::class, 'index'])->name('movie.category');
Route::any('/movie/show/{number?}', [MovieController::class, 'show'])->name('movie.show');

Route::any('/novel', [NovelController::class, 'index'])->name('novel.index');
Route::any('/novel/category/{cid?}', [NovelController::class, 'lists'])->name('novel.lists');
Route::any('/novel/book/{id?}', [NovelController::class, 'book'])->name('novel.book');
Route::any('/novel/book/chapter/{id?}', [NovelController::class, 'chapter'])->name('novel.book.chapter');

Route::any('/page/{id}', [PageController::class, 'index'])->name('page.index');
Route::any('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::any('/feedback/save', [FeedbackController::class, 'save'])->name('feedback.save');

Route::any('/search', [SearchController::class, 'search'])->name('search');
