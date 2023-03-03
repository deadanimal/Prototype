<?php

namespace App\Http\Controllers;

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
            $workpackages = Workpackage::orderBy('estimate_delivery')->get();
        } elseif ($user->user_type == 'staff') {
            $resource = Resource::where('user_id', $user->id)->first();
            if ($resource->resource_type == 'pmo') {
                $workpackages = Workpackage::orderBy('estimate_delivery')->get();
            } else {
                return redirect('/workpackages/assigned');
            }
        } else {
            return redirect('/'); 
        }

        $resources = Resource::orderBy('resource_type')->get();
        return view('workpackage_list_coordinator', compact('workpackages', 'projects', 'resources'));
    }

    public function show_workpackages_assigned(Request $request) {
        $user = $request->user();
        $resource = Resource::where('user_id', $user->id)->first();
        $workpackages = Workpackage::where('resource_id', $resource->id)->get();
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
}
