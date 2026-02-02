<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotController;
use App\Http\Controllers\Api\SettingsController;


## ================== SETTINGS ================== ##
Route::get('/settings',     [SettingsController::class, 'index']);
Route::get('/about-us',     [SettingsController::class, 'about']);
Route::get('/privacy',      [SettingsController::class, 'privacy']);
Route::get('/terms',        [SettingsController::class, 'terms']);
Route::get('/faq',          [SettingsController::class, 'faq']);
Route::post('/contact',     [SettingsController::class, 'contact']);
Route::get('/banners',      [SettingsController::class, 'banners']);
## ================== SETTINGS ================== ##




## ------------------ AUTH ROUTES ------------------ ##
Route::controller(AuthController::class)->group(function () {
    Route::post('/register',     'register')->middleware('guest');
    Route::post('/verify-otp',   'verifyOtp')->middleware('guest');
    Route::post('/resend-otp',   'resendOtp')->middleware('guest');
    Route::post('/login',        'login')->middleware('guest');
    Route::post('/logout',       'logout')->middleware('auth:sanctum');
});
## ------------------ AUTH ROUTES ------------------ ##




## ------------------ Forgot Password ------------------ ##
Route::post('/forgot/password',         [ForgotController::class, 'forgotPassword'])->middleware('guest');
Route::post('/forgot/verify-otp',       [ForgotController::class, 'verifyOtp'])->middleware('guest');
Route::post('/forgot/resend-otp',       [ForgotController::class, 'resendOtp'])->middleware('guest');
Route::post('/forgot/reset-password',   [ForgotController::class, 'resetPassword'])->middleware('guest');
## ------------------ Forgot Password ------------------ ##
