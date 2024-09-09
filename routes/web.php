<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Показ формы для ввода email для регистрации
Route::get('register/request', [RegisterController::class, 'showRegistrationLinkRequestForm'])->name('register.request');
// Отправка ссылки для завершения регистрации
Route::post('register/email', [RegisterController::class, 'sendRegistrationLinkEmail'])->name('register.email');
// Показ формы завершения регистрации (по токену)
Route::get('register/complete/{token}', [RegisterController::class, 'showRegistrationForm'])->name('register.complete');
// Обработка завершения регистрации
Route::post('register/complete', [RegisterController::class, 'completeRegistration'])->name('register.finalize');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Auth::routes(['verify' => true]);
// Показ формы для ввода email
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Отправка ссылки на сброс пароля
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Показ формы сброса пароля с токеном
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Обработка сброса пароля
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Auth::routes();
// Group the routes that require authentication
Route::middleware('auth')->group(function () {
    Route::post('/offlineModal', [ProfileController::class, 'offlineModal'])->name('offlineModal');
    Route::post('/profileedit', [ProfileController::class, 'profileedit'])->name('profileedit');
    Route::post('/profileDelete', [ProfileController::class, 'profileDelete'])->name('profileDelete');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/register-group/{id}', [RegController::class, 'registerGroup'])->name('register.group');
    Route::post('/registerGroupCommand/{id}', [RegController::class, 'registerGroupCommand'])->name('registerGroupCommand');
    Route::get('/thanky/{id}', [RegController::class, 'thanky'])->name('thanky');
    Route::get('/register-solo/{id}', [RegController::class, 'registerSolo'])->name('register.solo');
    Route::post('/register-solo/{id}', [RegController::class, 'registerSoloCommand'])->name('registerSoloCommand');
});

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
