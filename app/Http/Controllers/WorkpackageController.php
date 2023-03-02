<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Resource;
use App\Models\Workpackage;
use Illuminate\Http\Request;

class WorkpackageController extends Controller
{
    public function show_workpackages(Request $request) {
        
        
        $projects = Project::all();
        $user = $request->user();

        if ($user->user_type == 'admin') {
            $workpackages = Workpackage::all();
        } elseif ($user->user_type == 'staff') {
            $resource = Resource::where('user_id', $user->id)->first();
            if ($resource->resource_type == 'pmo') {
                $workpackages = Workpackage::all();
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
        $workpackage = Workpackage::find($id);

        return view('workpackage_detail', compact('workpackage'));
    }

    public function create_workpackage(Request $request) {

        $user = $request->user();
;  
        $wp = Workpackage::create([
            'name' => $request->name,
            'package_type' => $request->package_type,
            'package_level' => $request->package_level,
            'estimate_delivery' => $request->estimate_delivery,
            'coordinator_id' => $user->id,
        ]);

        if($request->project_id) {
            $wp->project_id = $request->project_id;
            $wp->save();
        }

        if($request->resource_id) {
            $wp->resource_id = $request->resource_id;
            $wp->status = 'assigned';
            $wp->save();
        } else {
            $wp->status = 'unassigned';
            $wp->save();
        }        

        return back();
    }    
}
