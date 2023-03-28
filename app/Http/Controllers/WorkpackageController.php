<?php

namespace App\Http\Controllers;

use App\Mail\WorkpackageAssigned;
use App\Mail\WorkpackageReviewed;
use Illuminate\Support\Str;

use App\Models\Kitab;
use App\Models\KitabAttachment;
use App\Models\Project;
use App\Models\Resource;
use App\Models\Workpackage;
use App\Models\WorkpackageReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;


class WorkpackageController extends Controller
{

    public function show_workpackages(Request $request) {
        
        
        $projects = Project::all();
        $user = $request->user();

        if ($user->user_type == 'admin') {
            
        } elseif ($user->user_type == 'staff' || $user->user_type == 'remote - my') {
            $resource = Resource::where('user_id', $user->id)->first();
            if ($resource->resource_type == 'pmo') {

            } else {
                return redirect('/workpackages/assigned');
            }
        } else {
            return redirect('/'); 
        }

        $workpackages = Workpackage::whereNotIn('status', ['Work Package Approved'])
            ->orderBy('estimate_delivery')
            ->orderBy('status')
            ->get();

            $all_wps = Workpackage::orderBy('estimate_delivery')->get();        
            
            $assigned_wps = Workpackage::where([
                ['status','=', 'Reassigned']
            ])->orWhere([
                ['status','=', 'Assigned']
            ])->orWhere([
                ['status','=', 'Work Package Incomplete']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();

            $unassigned_wps = Workpackage::where([
                ['status','=', 'Unassigned']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            

            $delayed_wps = Workpackage::where([
                ['status','=', 'Delayed']
            ])->orderBy('estimate_delivery')->get();                
    
            $approved_wps = Workpackage::where([
                ['status','=', 'Work Package Approved']
            ])->orderBy('estimate_delivery')->get();    
            
            $inreview_wps = Workpackage::where([
                ['status','=', 'Work Package In Review']
            ])->orderBy('estimate_delivery')->get(); 
            
            $question_wps = Workpackage::where([
                ['status','=', 'Has Problem']
            ])->orWhere([
                ['status','=', 'Question Answered']
            ])->orderBy('estimate_delivery')->get();              

        $resources = Resource::where('status', 'active')->whereNotIn('resource_type', ['viewer'])->orderBy('resource_type')->get();
        return view('workpackage_list_coordinator', compact([
            'workpackages', 'projects', 'resources',
            'all_wps','assigned_wps', 'approved_wps','inreview_wps', 'question_wps',
            'delayed_wps', 'unassigned_wps'
        ]));
    }

    public function show_workpackages_assigned(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Reassigned']
            ])->orWhere([                
                ['status','=', 'Assigned']
            ])->orWhere([                
                ['status','=', 'Work Package Incomplete']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Reassigned']
            ])->orWhere([
                ['resource_id','=', $resource->id],
                ['status','=', 'Assigned']
            ])->orWhere([
                ['resource_id','=', $resource->id],
                ['status','=', 'Work Package Incomplete']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }

    public function show_workpackages_unassigned(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Unassigned']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Unassigned']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }     

    public function show_workpackages_completed(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Work Package Approved']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Work Package Approved']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }    

    public function show_workpackages_delayed(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Delayed']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Delayed']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }      
    
    public function show_workpackages_rejected(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Rejected']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Rejected']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }     
    
    public function show_workpackages_inreview(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Work Package In Review']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Work Package In Review']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }    
    
    public function show_workpackages_problems(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Has Problem']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Has Problem']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }     
    
    public function show_workpackages_answers(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Question Answered']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Question Answered']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }         

    public function show_workpackages_queries(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();  
        
        if($resource->resource_type == 'all' || $resource->resource_type == 'pmo') {
            $workpackages = Workpackage::where([                
                ['status','=', 'Has Query']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();  
        } else {
            $workpackages = Workpackage::where([
                ['resource_id','=', $resource->id],
                ['status','=', 'Has Query']
            ])->orderBy('estimate_delivery')->orderBy('status')->get();            
        }
        
        return view('workpackage_simple_list', compact([
            'workpackages'
        ]));                
    }        

    public function show_workpackage(Request $request) {
        $id = (int) $request->route('workpackage_id');  
        $wp = Workpackage::find($id);
        $projects = Project::all();
        $resources = Resource::where('status', 'active')->whereNotIn('resource_type', ['viewer'])->orderBy('resource_type')->get();
        return view('workpackage_detail', compact('wp', 'projects','resources'));
    }

    public function show_workpackages_create(Request $request) {
        $projects = Project::whereNotIn('organisation_id',[1])->get();
        $user = $request->user();            
        $resources = Resource::where('status', 'active')->whereNotIn('resource_type', ['viewer'])->orderBy('resource_type')->get();

        return view('workpackage_create', compact([
            'projects', 'resources',
        ]));
    }    

    public function create_workpackage(Request $request) {

        $user = $request->user();

        $wp = Workpackage::create([
            'name' => $request->name,
            'package_type' => $request->package_type,
            'package_level' => $request->package_level,
            'estimate_delivery' => $request->estimate_delivery,
            'remarks' => $request->remarks,
            'coordinator_id' => $user->id,
        ]);

        if($request->project_id) {
            $wp->project_id = $request->project_id;
            $wp->save();
        }

        if($request->reviewer_id) {
            $wp->reviewer_id = $request->reviewer_id;
            $wp->save();
            Mail::to($wp->reviewer->user->email)->send(new WorkpackageAssigned($wp));
            // if($wp->reviewer->user->whatsapp_number) {
            //     $this->notify_workpackage_assigned($wp->reviewer->user, $wp);
            // }                    
        }          

        if($request->resource_id) {
            $wp->resource_id = $request->resource_id;
            $wp->status = 'Assigned';
            $wp->save();
            Mail::to($wp->resource->user->email)->send(new WorkpackageAssigned($wp));
            // if($wp->resource->user->whatsapp_number) {
            //     $this->notify_workpackage_assigned($wp->resource->user, $wp);
            // }                    

        } else {
            $wp->status = 'Unassigned';
            $wp->save();
        }        


        return back();
    }   

    public function update_workpackage(Request $request) {
        $id = (int) $request->route('workpackage_id');  
        $wp = Workpackage::find($id);  
        
        $wp->update([
            'name' => $request->name,
            'estimate_delivery' => $request->estimate_delivery,
            'remarks' => $request->remarks,
        ]);   
        
        if($request->reviewer_id) {
            $wp->reviewer_id = $request->reviewer_id;
            $wp->save();
            Mail::to($wp->reviewer->user->email)->send(new WorkpackageAssigned($wp));
            // if($wp->reviewer->user->whatsapp_number) {
            //     $this->notify_workpackage_assigned($wp->reviewer->user, $wp);
            // }                    
        }          

        if($wp->resource_id != $request->resource_id) {
            $wp->resource_id = $request->resource_id;
            $wp->status = 'Reassigned';
            $wp->save();
            Mail::to($wp->resource->user->email)->send(new WorkpackageAssigned($wp));
            // if($wp->resource->user->whatsapp_number) {
            //     $this->notify_workpackage_assigned($wp->resource->user, $wp);
            // }               
        }     

        
        return back();
    }
    
    public function review_workpackage(Request $request) {
        $id = (int) $request->route('workpackage_id');  
        $user = $request->user();
        $wp = Workpackage::find($id);

        if($request->action == 'submit_work_complete') {
            $wp->status = 'Work Package In Review';
        } elseif($request->action == 'submit_work_incomplete') {
            $wp->status = 'Work Package Incomplete';
        } elseif($request->action == 'review_work_complete') {
            $wp->status = 'Work Package Approved';
        } elseif($request->action == 'review_work_incomplete') {
            $wp->status = 'Work Package Incomplete';
        } elseif($request->action == 'question') {
            $wp->status = 'Has Problem';
        } elseif($request->action == 'query') {
            $wp->status = 'Has Query';            
        } elseif($request->action == 'answer') {
            $wp->status = 'Question Answered';            
        } elseif($request->action == 'delayed') {
            $wp->status = 'Delayed';            
        } elseif($request->action == 'rejected') {
            $wp->status = 'Rejected';            
        } else {

        }

        $wp->save();
        

        $wp_review = WorkpackageReview::create([
            'remarks' => $request->remarks,
            'status' => $wp->status,
            'workpackage_id' => $wp->id,
            'resource_id'=> $user->resource->id
        ]);

        if($request->attachment) {
            $wp_review->attachment = $request->file('attachment')->store('prototype/attachment');
            $wp_review->save();
        }

        Mail::to($wp->reviewer->user->email)->send(new WorkpackageReviewed($wp, $wp_review));
        // if($wp->reviewer->user->whatsapp_number) {
        //     $this->notify_workpackage_review($wp->reviewer->user, $wp, $wp_review);
        // }
        Mail::to($wp->resource->user->email)->send(new WorkpackageReviewed($wp, $wp_review));
        if($wp->status == 'Has Query' || $wp->status == 'Delayed') {
            if($wp->resource->user->whatsapp_number) {
                $this->notify_workpackage_review($wp->resource->user, $wp, $wp_review);
            }        
        }

        return back();
    } 

    public function show_kitabs(Request $request) {
        $user = $request->user();
        $kitabs = Kitab::where('privacy', 'public')->orderBy('category')->orderBy('title')->get();
        $notes = Kitab::where([
            ['user_id', '=', $user->id],
            ['privacy', '=', 'private']
        ])->orderBy('category')->orderBy('title')->get();
        $attachments = KitabAttachment::where([
            ['user_id', '=', $user->id]
        ])->orderBy('title')->get();
        return view('kitab_list', compact('kitabs','notes', 'attachments'));
    }

    public function show_kitab(Request $request) {
        $id = (int) $request->route('kitab_id');  
        $kitab = Kitab::find($id);
        $remarks = Str::markdown($kitab->remarks);

        return view('kitab_detail', compact('kitab', 'remarks'));
    }    

    public function create_kitab(Request $request) {

        $user = $request->user();
;  
        Kitab::create([
            'title' => $request->title,        
            'category' => $request->category,
            'remarks' => $request->remarks,
            'privacy' => $request->privacy,
            'status' => 'draft',
            'user_id' => $user->id,
        ]);
    

        return back();
    }   

    public function create_kitab_attachment(Request $request) {

        $user = $request->user();
;  
        KitabAttachment::create([
            'title' => $request->title,        
            'link' => $request->file('attachment')->store('prototype/attachment'),
            'user_id' => $user->id,
        ]);
    

        return back();
    }       


    public function update_kitab(Request $request) {
        $id = (int) $request->route('kitab_id');  
        $kitab = Kitab::find($id);
        $kitab->update([
            'title' => $request->title,        
            'remarks' => $request->remarks,
        ]);
        
        return back();
    }    

    public function show_searched_workpackages() {
        $projects = Project::all();
        $resources = Resource::whereNotIn('resource_type', ['viewer'])->orderBy('resource_type')->get();
        $workpackages = [];
        return view('workpackage_search', compact('projects', 'resources', 'workpackages'));
    }

    public function search_workpackages(Request $request) {
        $projects = Project::all();
        $resources = Resource::whereNotIn('resource_type', ['viewer'])->orderBy('resource_type')->get();

        $wps = Workpackage::where([
            ['id', '>', 1]
        ]);

        if($request->package_type != '-') {
            $wps->where('package_type', $request->package_type);
        }

        if($request->package_level != '-') {
            $wps->where('package_level', $request->package_level);
        }    

        if($request->project_id != '-') {
            $wps->where('project_id', $request->project_id);
        }
        
        if($request->resource_id != '-') {
            $wps->where('resource_id', $request->resource_id);
        }    

        if($request->status != '-') {
            $wps->where('status', $request->status);
        }          


        $workpackages = $wps->get();

        return view('workpackage_search', compact('projects', 'resources', 'workpackages'));
    }   
    
    public function search_project_workpackages(Request $request) {

        $id = (int) $request->route('project_id');  
        $project = Project::find($id);
        $wps = Workpackage::where([
            ['project_id', '=', $id]
        ]);


        if($request->package_type != '-') {
            $wps->where('package_type', $request->package_type);
        }

        if($request->package_level != '-') {
            $wps->where('package_level', $request->package_level);
        }    

        if($request->status != '-') {
            $wps->where('status', $request->status);
        }          


        $workpackages = $wps->get();

        return view('project_workpackage', compact('project', 'workpackages'));
    }        

    public function notify_workpackage_assigned($user, $wp) {
        $message = "There is an assignment for the work package. Work Package ID: ". $wp->id.'.';
        Http::post('https://api.green-api.com/waInstance'.env('WA_INSTANCE').'/SendTemplateButtons/'.env('WA_TOKEN'), [
            'chatId' => $user->whatsapp_number."@c.us",
            'message' => $message,
            'footer' => 'View the Work Package '.$wp->id,
            'templateButtons' => [
                [
                    "index" => 1,
                    "urlButton" => [
                        "displayText" => 'Work Package: '.$wp->name,
                        "url" => "https://prototype.com.my/workpackages/".$wp->id,
                    ],
                ],
            ]
        ]);        
    }    

    public function notify_workpackage_review($user, $wp, $wp_review) {
        $message = "There is an update for the work package. Work Package ID: ". $wp->id.'. Status: '.$wp_review->status.' Message:'.$wp_review->remarks;
        Http::post('https://api.green-api.com/waInstance'.env('WA_INSTANCE').'/SendTemplateButtons/'.env('WA_TOKEN'), [
            'chatId' => $user->whatsapp_number."@c.us",
            'message' => $message,
            'footer' => 'View the Work Package '.$wp->id,
            'templateButtons' => [
                [
                    "index" => 1,
                    "urlButton" => [
                        "displayText" => 'Work Package: '.$wp->name,
                        "url" => "https://prototype.com.my/workpackages/".$wp->id,
                    ],
                ],
            ]
        ]);        
    }
    


}
