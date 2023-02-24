<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show_projects(Request $request) {
        $projects = Project::all();
        return view('project_list', compact('projects'));
    }

    public function show_project(Request $request) {
        $id = (int) $request->route('project_id');  
        $project = Project::find($id);

        return view('project_detail', compact('project'));
    }
}
