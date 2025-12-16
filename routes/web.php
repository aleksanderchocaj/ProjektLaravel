<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/check', [QuizController::class, 'check'])->name('quizzes.check');
});
Route::middleware(['auth', 'admin']) // Używamy naszego aliasu 'admin'
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
Route::resource('quizzes', \App\Http\Controllers\AdminQuizController::class);
    });

require __DIR__.'/auth.php';
