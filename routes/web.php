<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopUpController;

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

// Routes untuk Psikolog
Route::prefix('psikolog')->group(function () {
    // Halaman untuk psikolog
    Route::get('/login', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'showLoginForm'])->name('psikolog.login');
    Route::get('/register', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'showRegistrationForm'])->name('psikolog.register');
    
    // Proses autentikasi
    Route::post('/login', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'login'])->name('psikolog.login.submit');
    Route::post('/register', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'register'])->name('psikolog.register.submit');
    
    // Route yang membutuhkan autentikasi
    Route::middleware('auth:psychologist')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'dashboard'])->name('psikolog.dashboard');
        Route::post('/logout', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'logout'])->name('psikolog.logout');
        Route::get('/profile', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'profile'])->name('psikolog.profile');
        Route::put('/profile', [App\Http\Controllers\Auth\PsychologistAuthController::class, 'updateProfile'])->name('psikolog.profile.update');
    });
});

// Assessment untuk user
Route::middleware(['auth'])->group(function () {
    Route::get('/assessment', [App\Http\Controllers\AssessmentController::class, 'index'])->name('assessment.index');
    Route::get('/assessment/start/{id}', [App\Http\Controllers\AssessmentController::class, 'start'])->name('assessment.start');
    Route::get('/assessment/do/{userAssessmentId}', [App\Http\Controllers\AssessmentController::class, 'do'])->name('assessment.do');
    Route::post('/assessment/do/{userAssessmentId}', [App\Http\Controllers\AssessmentController::class, 'submit'])->name('assessment.submit');
    Route::get('/assessment/result/{userAssessmentId}', [App\Http\Controllers\AssessmentController::class, 'result'])->name('assessment.result');
    Route::get('/assessment/history', [App\Http\Controllers\AssessmentController::class, 'history'])->name('assessment.history');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
});

// Assessment untuk psikolog
Route::middleware(['auth:psychologist'])->prefix('psikolog')->name('psikolog.')->group(function () {
    Route::resource('assessment', App\Http\Controllers\Psychologist\AssessmentController::class);
    Route::post('assessment/{assessment}/store-question', [App\Http\Controllers\Psychologist\AssessmentController::class, 'storeQuestion'])->name('assessment.storeQuestion');
    Route::get('assessment/{assessment}/edit-question/{question}', [App\Http\Controllers\Psychologist\AssessmentController::class, 'editQuestion'])->name('assessment.editQuestion');
    Route::put('assessment/{assessment}/update-question/{question}', [App\Http\Controllers\Psychologist\AssessmentController::class, 'updateQuestion'])->name('assessment.updateQuestion');
    Route::delete('assessment/{assessment}/delete-question/{question}', [App\Http\Controllers\Psychologist\AssessmentController::class, 'destroyQuestion'])->name('assessment.deleteQuestion');
});

// Route halaman konsultasi untuk user
Route::middleware(['auth'])->get('/konsultasi', [App\Http\Controllers\ConsultationController::class, 'index'])->name('konsultasi.index');
Route::middleware(['auth'])->get('/konsultasi/{psychologist}/booking', [App\Http\Controllers\ConsultationController::class, 'bookingForm'])->name('konsultasi.booking.form');
Route::middleware(['auth'])->post('/konsultasi/{psychologist}/booking', [App\Http\Controllers\ConsultationController::class, 'bookingStore'])->name('konsultasi.booking.store');

Route::middleware(['auth'])->get('/jadwal-konsultasi', [App\Http\Controllers\ConsultationController::class, 'jadwalUser'])->name('konsultasi.jadwal.user');
Route::middleware(['auth'])->post('/jadwal-konsultasi/{booking}/bayar', [App\Http\Controllers\ConsultationController::class, 'bayarBooking'])->name('konsultasi.booking.bayar');

Route::middleware(['auth:psychologist'])->get('/psikolog/jadwal-konsultasi', [App\Http\Controllers\ConsultationController::class, 'jadwalPsikolog'])->name('psikolog.jadwal.konsultasi');

Route::middleware(['auth'])->get('/jadwal-konsultasi/{booking}/edit', [App\Http\Controllers\ConsultationController::class, 'editBooking'])->name('konsultasi.booking.edit');
Route::middleware(['auth'])->put('/jadwal-konsultasi/{booking}', [App\Http\Controllers\ConsultationController::class, 'updateBooking'])->name('konsultasi.booking.update');
Route::middleware(['auth'])->delete('/jadwal-konsultasi/{booking}', [App\Http\Controllers\ConsultationController::class, 'deleteBooking'])->name('konsultasi.booking.delete');
