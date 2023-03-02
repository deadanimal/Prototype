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
                $workpackages = Workpackage::where('user_id', $user->id)->get();
            }
        } else {
            return redirect('/'); 
        }

        return view('workpackage_list', compact('workpackages', 'projects'));
    }

    public function show_workpackage(Request $request) {
        $id = (int) $request->route('workpackage_id');  
        $workpackage = Workpackage::find($id);

        return view('workpackage_detail', compact('workpackage'));
    }

    public function create_workpackage(Request $request) {
;  
        Workpackage::create([
            'name' => $request->name,
            'package_type' => $request->package_type,
            'package_level' => $request->package_level,
            'date_estimate' => $request->date_estimate,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
        ]);

        return back();
    }    
}
