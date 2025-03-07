<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
    
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    // Handle logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Quiz Routes
    Route::prefix('quiz')->group(function () {
        Route::get('/start', [QuizController::class, 'startQuiz'])->name('quiz.start');
        Route::get('/{quizId}/play', [QuizController::class, 'playQuiz'])->name('quiz.play');
        Route::post('/{quizId}/question/{questionId}/submit', [QuizController::class, 'submitAnswer']);
        Route::get('/{quizId}/end', [QuizController::class, 'endQuiz'])->name('quiz.end');
        Route::get('/{quizId}/results', [QuizController::class, 'showResults'])->name('quiz.results');
    });
});
