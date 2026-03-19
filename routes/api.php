<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;


## ================== SETTINGS ================== ##
Route::get('/settings',             [SettingsController::class, 'index']);
Route::get('/about-us',             [SettingsController::class, 'about']);
Route::get('/privacy',              [SettingsController::class, 'privacy']);
Route::get('/terms',                [SettingsController::class, 'terms']);
Route::get('/faq',                  [SettingsController::class, 'faq']);
Route::post('/contact',             [SettingsController::class, 'contact']);
Route::get('/banners',              [SettingsController::class, 'banners']);
Route::get('/why-choose',           [SettingsController::class, 'whyChoose']);
Route::get('/request-service',      [SettingsController::class, 'requestService']);
Route::get('/gallery-page',         [SettingsController::class, 'galleryPage']);
Route::get('/gallery-items',        [SettingsController::class, 'galleryItems']);
## ================== SETTINGS ================== ##

## ================== CONTENT ================== ##
Route::get('/services-page',        [ProjectController::class, 'servicesPage']);
Route::get('/services',             [ProjectController::class, 'services']);
Route::get('/work-page',            [ProjectController::class, 'workPage']);
Route::get('/projects',             [ProjectController::class, 'projects']);
Route::get('/projects/{slug}',      [ProjectController::class, 'projectDetails']);
Route::get('/projects/{slug}/related', [ProjectController::class, 'relatedProjects']);
## ================== CONTENT ================== ##

## ================== LOOKUPS (Mobile) ================== ##
Route::get('/countries',                            [LocationController::class, 'countries']);
Route::get('/countries/{country_id}/governorates',  [LocationController::class, 'governorates']);
## ================== LOOKUPS (Mobile) ==================



## ------------------ AUTH ROUTES ------------------ ##
Route::controller(AuthController::class)->group(function () {
    Route::post('/register',     'register')->middleware('guest');
    Route::post('/verify-otp',   'verifyOtp')->middleware('guest');
    Route::post('/resend-otp',   'resendOtp')->middleware('guest');
    Route::post('/login',        'login')->middleware('guest');
    Route::post('/logout',       'logout')->middleware('auth:sanctum');
    Route::post('/firebase-login',       [AuthController::class, 'firebaseLogin']);
});
## ------------------ AUTH ROUTES ------------------ ##




## ------------------ Forgot Password ------------------ ##
Route::post('/forgot/password',         [ForgotController::class, 'forgotPassword'])->middleware('guest');
Route::post('/forgot/verify-otp',       [ForgotController::class, 'verifyOtp'])->middleware('guest');
Route::post('/forgot/resend-otp',       [ForgotController::class, 'resendOtp'])->middleware('guest');
Route::post('/forgot/reset-password',   [ForgotController::class, 'resetPassword'])->middleware('guest');
## ------------------ Forgot Password ------------------ ##
