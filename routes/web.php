<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssessmentQuestionController;

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, etc.)
Auth::routes();

// Halaman Dashboard, menggunakan HomeController
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Route untuk melakukan top up saldo (POST request)
Route::post('/topup', [TopUpController::class, 'topUp'])->name('topup');

// Route asessment
Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment.index');
Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');
Route::get('/assessment/history', [AssessmentController::class, 'history'])->name('assessment.history');

// Route untuk mengelola pertanyaan assessment
Route::resource('assessment/questions', AssessmentQuestionController::class, ['as' => 'assessment']);



