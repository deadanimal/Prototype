<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MockupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\WorkpackageController;
use App\Http\Controllers\UserUpdateController;

Route::get('/', [SiteController::class, 'show_home']);

Route::get('/meetings/guest', [MeetingController::class, 'show_meeting_guest']);
Route::get('/meetings/{meeting_id}', [MeetingController::class, 'show_meeting']);

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [SiteController::class, 'show_dashboard']);
    Route::get('/profile', [SiteController::class, 'show_profile']);
    Route::post('/profile-picture', [SiteController::class, 'update_profile_picture']);
    Route::put('/profile-password', [SiteController::class, 'change_password']);

    Route::get('/location', [UserUpdateController::class, 'get_locations']);
    Route::post('/location', [UserUpdateController::class, 'send_location']);

    Route::get('/progress', [UserUpdateController::class, 'get_kemajuans']);
    Route::post('/progress', [UserUpdateController::class, 'send_kemajuan']);    

    Route::get('/meetings', [MeetingController::class, 'show_meetings']);
    Route::post('/meetings', [MeetingController::class, 'create_meeting']);    
    Route::put('/meetings/{meeting_id}', [MeetingController::class, 'update_meeting']);    
    

    Route::post('/meetings/{meeting_id}/attendances', [MeetingController::class, 'attend_meeting']);
    Route::post('/meetings/{meeting_id}/notes', [MeetingController::class, 'create_note']);
    Route::put('/meetings/{meeting_id}/notes/{note_id}', [MeetingController::class, 'edit_note']);

    Route::get('/mockups', [MockupController::class, 'show_mockups']);
    Route::post('/mockups', [MockupController::class, 'create_mockup']);   
    Route::get('/mockups/{mockup_id}', [MockupController::class, 'show_mockup']); 
    Route::put('/mockups/{mockup_id}', [MockupController::class, 'update_mockup']);  

    Route::get('/workpackages', [WorkpackageController::class, 'show_workpackages']);
    Route::post('/workpackages', [WorkpackageController::class, 'create_workpackage']);   
    Route::get('/workpackages/{workpackage_id}', [WorkpackageController::class, 'show_workpackage']); 
    Route::put('/workpackages/{workpackage_id}', [WorkpackageController::class, 'update_workpackage']);      
        

    Route::get('/projects', [ProjectController::class, 'show_projects']);
    Route::post('/projects', [ProjectController::class, 'create_project']);   
    Route::get('/projects/{project_id}', [ProjectController::class, 'show_project']); 
    Route::put('/projects/{project_id}', [ProjectController::class, 'update_project']);  
    
    Route::get('/projects/{project_id}/requirements', [ProjectController::class, 'show_requirements']);
    Route::post('/requirements', [ProjectController::class, 'create_requirement']);   
    Route::get('/requirements/{requirement_id}', [ProjectController::class, 'show_requirement']); 
    Route::put('/requirements/{requirement_id}', [ProjectController::class, 'update_requirement']);
    
    Route::get('/projects/{project_id}/test-scripts', [ProjectController::class, 'show_test_scripts']);
    Route::post('/test-scripts', [ProjectController::class, 'create_test_script']);   
    Route::get('/test-scripts/{test-script_id}', [ProjectController::class, 'show_test_script']); 
    Route::put('/test-scripts/{test-script_id}', [ProjectController::class, 'update_test_script']);      

    Route::get('/resources', [ProjectController::class, 'show_resources']);
    Route::post('/resources', [ProjectController::class, 'create_resource']);    
    Route::put('/resources/{resource_id}', [ProjectController::class, 'update_resource']);       
   
    Route::get('/users', [SiteController::class, 'show_users']);
    Route::post('/users', [SiteController::class, 'create_user']);
    Route::get('/users/{id}', [SiteController::class, 'show_user']);    
    Route::put('/users/{id}', [SiteController::class, 'update_user']);    

});