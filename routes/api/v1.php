<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\Api\V1\EmailVerificationController;
use App\Http\Controllers\Api\V1\RecruiterController;

Route::post('/authenticate', [AuthenticationController::class, 'authenticate']);
Route::get('/verify-email', [EmailVerificationController::class, 'verify'])->name('verify-email');

Route::prefix('physical-recruiters')->group(function() {
    Route::post('register', [RecruiterController::class, 'registerPhysicRecruiter']);
});

Route::get('/test', function () {
//    dd(\App\Models\User::find(31)->email_verified);
});