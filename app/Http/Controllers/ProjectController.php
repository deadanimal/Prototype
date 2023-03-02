<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Project;
use App\Models\ProjectDeliverable;
use App\Models\ProjectDocument;
use App\Models\ProjectPayment;
use App\Models\ProjectPhase;
use App\Models\ProjectUser;
use App\Models\Resource;
use App\Models\Trail;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    public function show_projects(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'admin') {
            $projects = Project::all();
        } elseif ($user->user_type == 'staff') {
            $projects = Project::whereNotIn('organisation_id', [1])->orderBy('name')->get();
        } else {
            $projects = Project::where('organisation_id', $user->organisation_id)->get();
            return view('project_list_client', compact('projects'));
        }
        return view('project_list', compact('projects'));
    }

    public function show_project(Request $request) {
        $id = (int) $request->route('project_id');  

        $user = $request->user();
        if($user->user_type != 'admin') {
            if (ProjectUser::where('user_id', '=', $user->id)->exists()) {
                //
            } else {
                Alert::error('Error', 'You are not part of the project.');
                return back();
            }
        }

        $users = User::where('organisation_id', 1)->get();
        $meetings = Meeting::where('project_id', $id)->orderBy('meeting_date')->get();

        $project = Project::find($id);
        $documents = ProjectDocument::where('project_id', $id)->get();
        $deliverables = ProjectDeliverable::where('project_id', $id)->get();        
        $members = ProjectUser::where('project_id', $id)->get();
        $payments = ProjectPayment::where('project_id', $id)->get();
        $phases = ProjectPhase::where('project_id', $id)->get();
        
        

        return view('project_detail', compact('project', 'documents','meetings','deliverables', 'users', 'members','payments','phases'));
    }

    public function show_resources(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'admin') {
            $resources = Resource::orderBy('resource_type')->get();
        } elseif ($user->user_type == 'staff') {
            $resources = Resource::where('status', 'active')->orderBy('resource_type')->get();
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

    public function create_resource(Request $request) {
        $id = (int) $request->route('resource_id');  
        $user = $request->user();
        if ($user->user_type == 'admin') {
            Resource::create([
                'user_id' => $request->user_id,
                'resource_type' => $request->resource_type,
                'status' => 'active'
            ]);
        }     

        return back();
    }    
    
    public function upload_project_document(Request $request) {
        $id = (int) $request->route('project_id');  
        $user = $request->user();
        $project = Project::find($id);

            $document = ProjectDocument::create([
                'name' => $request->name,
                'version' => $request->version,
                'category' => $request->category,
                'project_id' => $id,
                'user_id' => $user->id,
            ]);

            $document->document = $request->file('document')->store('prototype/document');
            $document->save();

            // $trail_message = 'Upload new document for ' + $project->name;

            // Trail::create([
            //     'category' => 'project/documents',
            //     'user_id'=>auth()->user()->id,
            //     'message' => $trail_message,
            // ]);                 

        return back();
    }   
    
    public function add_project_member(Request $request) {
        $id = (int) $request->route('project_id');          

        ProjectUser::create([
            'category' => $request->category,
            'project_id' => $id,
            'user_id' => $request->user_id,
        ]);

        // $project = Project::find($id);
        // $trail_message = 'Add new project member for ' + $project->name;

        // Trail::create([
        //     'category' => 'project/members',
        //     'user_id'=>auth()->user()->id,
        //     'message' => $trail_message,
        // ]);         

        return back();
    }    
    
    public function add_project_payment(Request $request) {
        $id = (int) $request->route('project_id');  

        ProjectPayment::create([
            'name' => $request->name,
            'date' => $request->date,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'status'=> 'draft',
            'project_id' => $id,
            'user_id' => $request->user_id,
        ]);

        // $project = Project::find($id);
        // $trail_message = 'Add new project payment for ' + $project->name;

        // Trail::create([
        //     'category' => 'project/payments',
        //     'user_id'=>auth()->user()->id,
        //     'message' => $trail_message,
        // ]);           

        return back();
    }    
    
    public function add_project_phase(Request $request) {
        $id = (int) $request->route('project_id');  
        $user = $request->user();

        ProjectPhase::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'draft',
            'project_id' => $id,
            'user_id' => $user->id,
        ]);

        // $project = Project::find($id);
        // $trail_message = 'Add new project phase for ' + $project->name;

        // Trail::create([
        //     'category' => 'project/phases',
        //     'user_id'=>auth()->user()->id,
        //     'message' => $trail_message,
        // ]);  

        return back();
    }    
    
    public function add_project_deliverable(Request $request) {
        $id = (int) $request->route('project_id');  

        ProjectDeliverable::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'status'=> 'draft',
            'project_id' => $id,
            'user_id' => $request->user_id,
        ]);

        // $project = Project::find($id);
        // $trail_message = 'Add new project deliverable for ' + $project->name;

        // Trail::create([
        //     'category' => 'project/deliverables',
        //     'user_id'=>auth()->user()->id,
        //     'message' => $trail_message,
        // ]);          

        return back();
    }       
}
