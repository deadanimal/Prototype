<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MockupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TenderproposalController;
use App\Http\Controllers\WorkpackageController;
use App\Http\Controllers\UserUpdateController;

Route::get('/', [SiteController::class, 'show_home']);

Route::get('/meetings/guest', [MeetingController::class, 'show_meeting_guest']);

Route::middleware('auth')->group(function () {

    Route::get('/meetings/{meeting_id}', [MeetingController::class, 'show_meeting']);
    
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

    Route::get('/meeting-search', [MeetingController::class, 'show_searched_meetings']);    
    Route::post('/meetings/search', [MeetingController::class, 'search_meetings']);    
    Route::put('/meetings/{meeting_id}', [MeetingController::class, 'update_meeting']);    
    

    Route::post('/meetings/{meeting_id}/attendances', [MeetingController::class, 'attend_meeting']);
    Route::post('/meetings/{meeting_id}/notes', [MeetingController::class, 'create_note']);
    Route::post('/meetings/{meeting_id}/attendees', [MeetingController::class, 'create_meeting_attendee']);
    Route::put('/meetings/{meeting_id}/notes/{note_id}', [MeetingController::class, 'edit_note']);
    Route::post('/meetings/{meeting_id}/reschedule', [MeetingController::class, 'reschedule_meeting']);

    Route::get('/mockups', [MockupController::class, 'show_mockups']);
    Route::post('/mockups', [MockupController::class, 'create_mockup']);   
    Route::get('/mockups/{mockup_id}', [MockupController::class, 'show_mockup']); 
    Route::put('/mockups/{mockup_id}', [MockupController::class, 'update_mockup']);  

    Route::get('/workpackages', [WorkpackageController::class, 'show_workpackages']);
    
    Route::get('/workpackages/search', [WorkpackageController::class, 'show_searched_workpackages']);
    Route::post('/workpackages/search', [WorkpackageController::class, 'search_workpackages']);
    Route::post('/projects/{project_id}/workpackages/search', [WorkpackageController::class, 'search_project_workpackages']);

    Route::get('/workpackages/create', [WorkpackageController::class, 'show_workpackages_create']);
    Route::get('/workpackages/calendar', [WorkpackageController::class, 'show_workpackages_calendar']);
    Route::get('/workpackages/assigned', [WorkpackageController::class, 'show_workpackages_assigned']);
    Route::get('/workpackages/unassigned', [WorkpackageController::class, 'show_workpackages_unassigned']);
    Route::get('/workpackages/completed', [WorkpackageController::class, 'show_workpackages_completed']);
    Route::get('/workpackages/delayed', [WorkpackageController::class, 'show_workpackages_delayed']);
    Route::get('/workpackages/rejected', [WorkpackageController::class, 'show_workpackages_rejected']);
    Route::get('/workpackages/inreview', [WorkpackageController::class, 'show_workpackages_inreview']);
    Route::get('/workpackages/problems', [WorkpackageController::class, 'show_workpackages_problems']);
    Route::get('/workpackages/queries', [WorkpackageController::class, 'show_workpackages_queries']);
    Route::get('/workpackages/answers', [WorkpackageController::class, 'show_workpackages_answers']);

    Route::post('/workpackages', [WorkpackageController::class, 'create_workpackage']);   
    Route::get('/workpackages/{workpackage_id}', [WorkpackageController::class, 'show_workpackage']); 
    Route::put('/workpackages/{workpackage_id}', [WorkpackageController::class, 'update_workpackage']);
    Route::post('/workpackages/{workpackage_id}/review', [WorkpackageController::class, 'review_workpackage']);
        

    Route::get('/projects', [ProjectController::class, 'show_projects']);
    Route::post('/projects', [ProjectController::class, 'create_project']);   
    Route::get('/projects/{project_id}', [ProjectController::class, 'show_project']); 
    Route::put('/projects/{project_id}', [ProjectController::class, 'update_project']);      
    
    Route::post('/projects/{project_id}/members', [ProjectController::class, 'add_project_member']);   
    Route::delete('/projects/{project_id}/members/{member_id}', [ProjectController::class, 'remove_project_member']);   
    
    Route::post('/projects/{project_id}/payments', [ProjectController::class, 'add_project_payment']);   
    Route::put('/projects/{project_id}/payments', [ProjectController::class, 'update_project_payment']);   
    Route::delete('/projects/{project_id}/payments', [ProjectController::class, 'delete_project_payment']);   
    
    Route::post('/projects/{project_id}/phases', [ProjectController::class, 'add_project_phase']);   
    Route::put('/projects/{project_id}/phases/{phase_id}', [ProjectController::class, 'update_project_phase']);       
    Route::delete('/projects/{project_id}/phases/{phase_id}', [ProjectController::class, 'delete_project_phase']);   

    Route::post('/projects/{project_id}/deliverables', [ProjectController::class, 'add_project_deliverable']);   
    Route::put('/projects/{project_id}/deliverables/{deliverable_id}', [ProjectController::class, 'update_project_deliverable']);       
    Route::delete('/projects/{project_id}/deliverables/{deliverable_id}', [ProjectController::class, 'delete_project_deliverable']);    

    Route::post('/projects/{project_id}/documents', [ProjectController::class, 'upload_project_document']);   
    Route::put('/projects/{project_id}/documents/{document_id}', [ProjectController::class, 'update_project_document']);       
    Route::delete('/projects/{project_id}/documents/{document_id}', [ProjectController::class, 'delete_project_document']);        
    
    Route::post('/requirements', [ProjectController::class, 'create_requirement']);   
    Route::get('/requirements/{requirement_id}', [ProjectController::class, 'show_requirement']); 
    Route::put('/requirements/{requirement_id}', [ProjectController::class, 'update_requirement']);
    Route::delete('/requirements/{requirement_id}', [ProjectController::class, 'delete_requirement']);

    Route::post('/testcases', [ProjectController::class, 'create_testcase']);   
    Route::get('/testcases/{testcase_id}', [ProjectController::class, 'show_testcase']); 
    Route::put('/testcases/{testcase_id}', [ProjectController::class, 'update_testcase']);
    Route::delete('/testcases/{testcase_id}', [ProjectController::class, 'delete_testcase']);    
    Route::post('/testcases/{testcase_id}/execute', [ProjectController::class, 'execute_testcase']);  
    
    Route::post('/issues', [ProjectController::class, 'create_issue']);   
    Route::put('/issues/{issue_id}', [ProjectController::class, 'update_issue']);
    Route::delete('/issues/{issue_id}', [ProjectController::class, 'delete_issue']);  
    
    // Route::post('/testflows', [ProjectController::class, 'create_testflow']);   
    // Route::get('/testflows/{testflow_id}', [ProjectController::class, 'show_testflow']); 
    // Route::put('/testflows/{testflow_id}', [ProjectController::class, 'update_testflow']);   
    
    // Route::post('/testflow-items', [ProjectController::class, 'create_testflow_item']);
    // Route::get('/testflow-items/{testflow_item_id}', [ProjectController::class, 'show_testflow_item']); 
    // Route::put('/testflow-items/{testflow_item_id}', [ProjectController::class, 'update_testflow_item']);     

    Route::get('/resources', [ProjectController::class, 'show_resources']);
    Route::get('/resources/{resource_id}', [ProjectController::class, 'show_resource']);
    Route::post('/resources', [ProjectController::class, 'create_resource']);    
    Route::put('/resources/{resource_id}', [ProjectController::class, 'update_resource']);       
   
    Route::get('/users', [SiteController::class, 'show_users']);
    Route::post('/users', [SiteController::class, 'create_user']);
    Route::get('/users/{id}', [SiteController::class, 'show_user']);    
    Route::put('/users/{id}', [SiteController::class, 'update_user']);    
    Route::put('/users/{id}/password', [SiteController::class, 'update_user_password']);    

    Route::post('/organisations', [SiteController::class, 'create_organisation']);

    Route::get('/products', [ProductController::class, 'show_products']);
    Route::post('/products', [ProductController::class, 'create_product']);   
    Route::get('/products/{product_id}', [ProductController::class, 'show_product']); 
    Route::put('/products/{product_id}', [ProductController::class, 'update_product']);
    Route::get('/products/{product_id}/technical', [ProductController::class, 'show_product_technicals']);   

    Route::post('/products/{product_id}/actors', [ProductController::class, 'create_product_actor']);
    Route::put('/products/{product_id}/actors/{actor_id}', [ProductController::class, 'update_product_actor']);
    Route::post('/products/{product_id}/usecases', [ProductController::class, 'create_product_usecase']);
    Route::put('/products/{product_id}/usecases/{usecase_id}', [ProductController::class, 'update_product_usecase']);    
    Route::post('/products/{product_id}/tables', [ProductController::class, 'create_product_table']);
    Route::put('/products/{product_id}/tables/{table_id}', [ProductController::class, 'update_product_table']); 
    Route::post('/products/{product_id}/attributes', [ProductController::class, 'create_product_table_attribute']);
    Route::put('/products/{product_id}/attributes/{attribute_id}', [ProductController::class, 'update_product_table_attribute']);
    Route::post('/products/{product_id}/methods', [ProductController::class, 'create_product_method']);
    Route::put('/products/{product_id}/methods/{method_id}', [ProductController::class, 'update_product_method']);            
    
    Route::get('/tenderproposals', [TenderproposalController::class, 'show_tenderproposals']);
    Route::post('/tenderproposals', [TenderproposalController::class, 'create_tenderproposal']);   
    Route::get('/tenderproposals/{tenderproposal_id}', [TenderproposalController::class, 'show_tenderproposal']); 
    Route::put('/tenderproposals/{tenderproposal_id}', [TenderproposalController::class, 'update_tenderproposal']);    

    Route::get('/tickets', [ProjectController::class, 'show_tickets']);
    Route::post('/tickets', [ProjectController::class, 'create_ticket']);   
    Route::get('/tickets/{ticket_id}', [ProjectController::class, 'show_ticket']); 
    Route::post('/tickets/{ticket_id}/reply', [ProjectController::class, 'reply_ticket']); 
    Route::put('/tickets/{ticket_id}', [ProjectController::class, 'update_ticket']); 

    Route::get('/kitabs', [WorkpackageController::class, 'show_kitabs']);
    Route::post('/kitabs', [WorkpackageController::class, 'create_kitab']);   
    Route::get('/kitabs/{kitab_id}', [WorkpackageController::class, 'show_kitab']); 
    Route::put('/kitabs/{kitab_id}', [WorkpackageController::class, 'update_kitab']);     

    Route::post('/kitab-attachments', [WorkpackageController::class, 'create_kitab_attachment']);   

    Route::get('/dt/meetings', [MeetingController::class, 'datatable_meetings']);
});