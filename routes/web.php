<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'show_home']);

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [SiteController::class, 'show_dashboard']);

    Route::get('/meetings', [MeetingController::class, 'show_meetings']);
    Route::post('/meetings', [MeetingController::class, 'create_meeting']);
    Route::get('/meetings/{meeting_id}', [MeetingController::class, 'show_meeting']);
    Route::put('/meetings/{meeting_id}', [MeetingController::class, 'update_meeting']);    
   

});