<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    // AJAX regencies
    Route::get('/api/regencies/{province_id}', function ($province_id) {
        return \App\Models\Regency::where('province_id', $province_id)
            ->orderBy('id') ->get(['id', 'name']); })
            ->name('api.regencies');
    // Forgot password - form
    Route::get('/forgot-password', [LoginController::class, 'forgotPasswordForm'])
        ->name('password.request');

    // Forgot password - send email
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])
        ->name('password.email');

    // Reset password - form from email link
    Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordForm'])
        ->name('password.reset');

    // Reset password - update the password
    Route::post('/reset-password', [LoginController::class, 'updatePassword'])
        ->name('password.update');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (requires login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Verification notice (user logged in but not verified)
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    // Verify link clicked from email
    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware('signed')
        ->name('verification.verify');

    // Resend verification email
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
