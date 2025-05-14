<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\psikolog\ArticleController as psikologArticleController;

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, etc.)
Auth::routes();

// Halaman Dashboard, menggunakan HomeController
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/article/list', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/detail/{ArticleId}', [ArticleController::class, 'detail'])->name('article.detail');

Route::get('/psikolog/article', [psikologArticleController::class, 'index'])->name('psikolog.article.index');
Route::post('/psikolog/article/create', [psikologArticleController::class, 'create'])->name('psikolog.article.post');
Route::put('/psikolog/article/update/{ArticleId}', [psikologArticleController::class, 'update'])->name('psikolog.article.update');
Route::delete('/psikolog/article/delete/{ArticleId}', [psikologArticleController::class, 'destroy'])->name('psikolog.article.delete');

// Route untuk melakukan top up saldo (POST request)
Route::post('/topup', [TopUpController::class, 'topUp'])->name('topup');
