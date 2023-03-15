<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Organisation;
use App\Models\Project;
use App\Models\ProjectDeliverable;
use App\Models\ProjectDocument;
use App\Models\ProjectPayment;
use App\Models\ProjectPhase;
use App\Models\ProjectRequirement;
use App\Models\ProjectTestflow;
use App\Models\ProjectTestflowItem;
use App\Models\ProjectUser;
use App\Models\Resource;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Trail;
use App\Models\User;
use App\Models\Workpackage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    public function show_projects(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'admin') {
            $projects = Project::all();
            return view('project_list', compact('projects'));
        } elseif ($user->user_type == 'staff') {            
            $projects = Project::whereNotIn('organisation_id', [1])->orderBy('name')->get();
            return view('project_list', compact('projects'));
        } else {
            $projects = Project::where('organisation_id', $user->organisation_id)->get();
            return view('project_list_client', compact('projects'));
        }
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
        $wps = Workpackage::where('project_id', $id)->orderBy('estimate_delivery')->orderBy('status')->get();
        $requirements = ProjectRequirement::where('project_id', $id)->get();
        $tickets = Ticket::where('project_id', $id)->get();

        $wp_costs = 0;
        foreach($wps as $wp) {
            if($wp->package_level == '1 - 6 hours') {
                $rate = 6;                
            } elseif ($wp->package_level == '2 - 3 hours') {
                $rate = 3;
            } elseif ($wp->package_level == '3 - 1 hour') {
                $rate = 1;
            } else {
                $rate = 1;
            }

            if($wp->resource) {
                $cost = $wp->resource->hourly_rate * 6;            
            } else {
                $cost = 0;            
            }        

            $wp_costs += $cost;
        }

        return view('project_detail', compact(['project', 'documents','meetings',
            'deliverables', 'users', 'members','payments','phases','wps', 'requirements',
            'tickets', 'wp_costs'
        ]));
    }

    public function show_resources(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'admin') {
            $resources = Resource::where('status', 'active')->orderBy('resource_type')->get();
            return view('resource_list', compact('resources'));
        } elseif ($user->user_type == 'staff') {
            $resource = Resource::where([
                ['user_id', '=', $user->id],
            ])->first();
            return view('resource_detail', compact('resource'));        
        } else {
            return redirect('/'); 
        }
        
    }

    public function show_resource(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('resource_id');          ;
        $projects = Project::all();
        if ($user->user_type == 'admin') {
            $resource = Resource::find($id);
        } else {
            $resource = Resource::where([
                ['id', '=', $id],
                ['user_id', '=', $user->id],
            ])->first();
        }
        return view('resource_detail', compact('resource'));        
    }    

    public function create_resource(Request $request) {
        $id = (int) $request->route('resource_id');  
        $user = $request->user();
        if ($user->user_type == 'admin') {
            Resource::create([
                'user_id' => $request->user_id,
                'resource_type' => $request->resource_type,
                'currency' => 'myr',
                'hourly_rate' => $request->hourly_rate,
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

    public function create_requirement(Request $request) {
        
        $user = $request->user();

        ProjectRequirement::create([
            'name' => $request->name,
            'category' => $request->category,
            'remarks' => $request->remarks,

            'project_id' => $request->project_id,
            'user_id' => $user->id,
        ]);
     
        return back();        
    }

    public function create_testingflow(Request $request) {

        $user = $request->user();

        $testflow = ProjectTestflow::create([
            'name' => $request->name,

            'project_id' => $request->project_id,
            'user_id' => $user->id,
        ]);
     
        return back();   
                
    }

    public function create_testingflow_item(Request $request) {
        
        $user = $request->user();

        $testflow_item = ProjectTestflowItem::create([
            'name' => $request->name,
            
            'testingflow_id' => $request->testingflow_id,
            'project_id' => $request->project_id,
            'user_id' => $user->id,
        ]);
     
        return back();  

    }

    public function show_tickets(Request $request) {

        $user = $request->user();
        if ($user->user_type == 'admin') {
            $tickets = Ticket::where('status', 'opened')->get();
            $projects = Project::all();
        } elseif ($user->user_type == 'staff') {            
            $tickets = Ticket::where('status', 'opened')->get();
            $projects = Project::whereNotIn('organisation_id', [1])->orderBy('name')->get();
        } else {
            $tickets = Ticket::where([
                ['organisation_id','=', $user->organisation_id],
                ['status','=', 'opened'],
            ])->get();
            $projects = Project::where('organisation_id', $user->organisation_id)->get();
        }
        $organisations = Organisation::all();

        return view('ticket_list', compact('tickets', 'organisations', 'projects'));

    }

    public function show_ticket(Request $request) {
        $id = (int) $request->route('ticket_id');  
        $ticket = Ticket::find($id);
        return view('ticket_detail', compact('ticket'));        
    }

    public function create_ticket(Request $request) {
        $user = $request->user();
        $project = Project::find($request->project_id);

        $ticket = Ticket::create([
            'title' => $request->title,
            'category' => $request->category,
            'status' => 'opened',
    
            'organisation_id' => $project->organisation->id,
            'project_id' => $project->id,
            'user_id' => $user->id,
        ]);

        $message = TicketMessage::create([
            'message' => $request->message, 

            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
        ]);

        if($request->has('attachment')) {
            $message->attachment = $request->file('attachment')->store('prototype/attachment');
            $message->save();
        }

        Alert::success('Success', 'Ticket has been created');
        return back();
    }

    public function reply_ticket(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('ticket_id');  
        $ticket = Ticket::find($id);

        $message = TicketMessage::create([
            'message' => $request->message, 

            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
        ]);

        if($request->has('attachment')) {
            $message->attachment = $request->file('attachment')->store('prototype/attachment');
            $message->save();
        }        

        Alert::success('Success', 'Message has been created');        
        return back();
    }

    public function update_ticket(Request $request) {

        $id = (int) $request->route('ticket_id');  
        $ticket = Ticket::find($id);
        $ticket->status = $request->status;
        $ticket->save();
        
        return back();
    }
}

