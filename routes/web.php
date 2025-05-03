<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;

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

// Route edit profile
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Route artikel
Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    
    // Route komentar artikel
    Route::post('/articles/{articleId}/comments', [ArticleCommentController::class, 'store'])->name('article.comments.store');
    Route::delete('/articles/{articleId}/comments/{commentId}', [ArticleCommentController::class, 'destroy'])->name('article.comments.destroy');
});
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Route manajemen pertanyaan assessment (khusus psikolog)
Route::middleware(['auth', 'psikologrole'])->group(function () {
    Route::get('/assessment/questions', [AssessmentController::class, 'manageQuestions'])->name('assessment.questions.manage');
    Route::post('/assessment/questions', [AssessmentController::class, 'storeQuestion'])->name('assessment.questions.store');
    Route::get('/assessment/questions/{id}/edit', [AssessmentController::class, 'editQuestion'])->name('assessment.questions.edit');
    Route::put('/assessment/questions/{id}', [AssessmentController::class, 'updateQuestion'])->name('assessment.questions.update');
    Route::delete('/assessment/questions/{id}', [AssessmentController::class, 'destroyQuestion'])->name('assessment.questions.destroy');
});



