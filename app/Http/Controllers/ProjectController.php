<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Resource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show_projects(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'admin') {
            $projects = Project::all();
        } elseif ($user->user_type == 'staff') {
            $projects = Project::whereNotIn('organisation_id', [1])->get();
        } else {
            return redirect('/'); 
        }
        return view('project_list', compact('projects'));
    }

    public function show_project(Request $request) {
        $id = (int) $request->route('project_id');  
        $project = Project::find($id);

        return view('project_detail', compact('project'));
    }

    public function show_resources(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'admin') {
            $resources = Resource::all();
        } elseif ($user->user_type == 'staff') {
            $resources = Resource::where('status', 'active')->get();
        } else {
            return redirect('/'); 
        }
        
        return view('resource_list', compact('resources'));
    }

    public function show_resource(Request $request) {
        $id = (int) $request->route('resource_id');  
        $resource = Resource::find($id);

        return view('resource_detail', compact('resource'));
    }    
}
