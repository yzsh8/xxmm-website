<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Session;

Route::any('/', [IndexController::class, 'index'])->name('index');
Route::any('/movie/{cid?}', [MovieController::class, 'index'])->name('movie');
Route::any('/movie/category/{cid?}', [MovieController::class, 'index'])->name('movie.category');
Route::any('/movie/show/{number?}', [MovieController::class, 'show'])->name('movie.show');
Route::any('/api/notice', [NoticeController::class, 'api'])->name('movie.notice');

Route::any('/novel', [NovelController::class, 'index'])->name('novel.index');
Route::any('/novel/category/{cid?}', [NovelController::class, 'lists'])->name('novel.lists');
Route::any('/novel/book/{id?}', [NovelController::class, 'book'])->name('novel.book');
Route::any('/novel/book/chapter/{id?}', [NovelController::class, 'chapter'])->name('novel.book.chapter');

Route::any('/page/{id}', [PageController::class, 'index'])->name('page.index');
Route::any('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::any('/feedback/save', [FeedbackController::class, 'save'])->name('feedback.save');

Route::any('/search', [SearchController::class, 'search'])->name('search');

Route::get('/language/{locale}',function($locale){
    app()->setLocale($locale);
    session()->put('locale',$locale);
    return back();
})->name('language');
