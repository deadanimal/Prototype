<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\Kitab;
use App\Models\KitabAttachment;
use App\Models\Project;
use App\Models\Resource;
use App\Models\Workpackage;
use App\Models\WorkpackageReview;
use Illuminate\Http\Request;

class WorkpackageController extends Controller
{
    public function show_workpackages(Request $request) {
        
        
        $projects = Project::all();
        $user = $request->user();

        if ($user->user_type == 'admin') {
            
        } elseif ($user->user_type == 'staff') {
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

        $resources = Resource::where('status', 'active')->orderBy('resource_type')->get();
        return view('workpackage_list_coordinator', compact('workpackages', 'projects', 'resources'));
    }

    public function show_workpackages_assigned(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();
        $workpackages = Workpackage::where([
            ['resource_id','=', $resource->id]
        ])->orderBy('estimate_delivery')->orderBy('status')->get();

        return view('workpackage_list_resource', compact('workpackages'));        
    }

    public function show_workpackage(Request $request) {
        $id = (int) $request->route('workpackage_id');  
        $wp = Workpackage::find($id);
        $projects = Project::all();
        $resources = Resource::orderBy('resource_type')->get();
        return view('workpackage_detail', compact('wp', 'projects','resources'));
    }

    public function create_workpackage(Request $request) {

        $user = $request->user();
;  
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
        }          

        if($request->resource_id) {
            $wp->resource_id = $request->resource_id;
            $wp->status = 'Assigned';
            $wp->save();
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
            'remarks' => $request->remarks,
        ]);   
        
        if($request->reviewer_id) {
            $wp->reviewer_id = $request->reviewer_id;
            $wp->save();
        }          

        if($request->resource_id) {
            $wp->resource_id = $request->resource_id;
            $wp->status = 'Reassigned';
            $wp->save();
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
        } elseif($request->action == 'answer') {
            $wp->status = 'Question Answered';            
        } else {

        }

        $wp->save();
        

        $wp_review = WorkpackageReview::create([
            'remarks' => $request->remarks,
            'workpackage_id' => $wp->id,
            'resource_id'=> $user->resource->id
        ]);

        if($request->attachment) {
            $wp_review->attachment = $request->file('attachment')->store('prototype/attachment');
            $wp_review->save();
        }

        return back();
    } 

    public function show_kitabs(Request $request) {
        $user = $request->user();
        $kitabs = Kitab::orderBy('category')->orderBy('title')->get();
        $notes = Kitab::where([
            ['user_id', '=', $user->id]
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


}
