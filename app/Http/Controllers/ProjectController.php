<?php

namespace App\Http\Controllers;

use App\Mail\TicketCreated;
use App\Mail\TicketReplied;
use App\Models\Meeting;
use App\Models\Organisation;
use App\Models\Project;
use App\Models\ProjectDeliverable;
use App\Models\ProjectDocument;
use App\Models\ProjectPayment;
use App\Models\ProjectPhase;
use App\Models\ProjectRequirement;
use App\Models\ProjectTestcase;
use App\Models\ProjectTestcaseExecution;
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
use Illuminate\Support\Facades\Mail;
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

        $users = User::where('status', 'active')->get();
        $meetings = Meeting::where('project_id', $id)->orderBy('meeting_date')->get();

        $project = Project::find($id);
        $documents = ProjectDocument::where('project_id', $id)->get();
        $deliverables = ProjectDeliverable::where('project_id', $id)->get();        
        $members = ProjectUser::where('project_id', $id)->get();
        $payments = ProjectPayment::where('project_id', $id)->get();
        $phases = ProjectPhase::where('project_id', $id)->orderBy('start_date')->get();
        $wps = Workpackage::where('project_id', $id)->orderBy('estimate_delivery')->orderBy('status')->get();
        $requirements = ProjectRequirement::where('project_id', $id)->get();
        $tickets = Ticket::where('project_id', $id)->get();
        $testcases = ProjectTestcase::where('project_id', $id)->get();

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
            'tickets', 'wp_costs', 'testcases'
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
        $wps = Workpackage::where('resource_id', $id)->get();
        return view('resource_detail', compact('resource', 'wps'));        
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

        return back();
    }   

    public function update_project_document(Request $request) {
        $id = (int) $request->route('document_id');  
        $user = $request->user();
        $document = ProjectDocument::find($id);

        $document->update([
            'name' => $request->name,
            'version' => $request->version,
            'category' => $request->category,
        ]);

        return back();
    }        

    public function delete_project_document(Request $request) {
        $id = (int) $request->route('document_id');  
        $user = $request->user();

        $document = ProjectDocument::find($id);
        $document->delete();
        
        return back();
    }       

    
    public function add_project_member(Request $request) {
        $id = (int) $request->route('project_id');          

        ProjectUser::create([
            'category' => $request->category,
            'project_id' => $id,
            'user_id' => $request->user_id,
        ]);        

        return back();
    }    

    public function remove_project_member(Request $request) {
        $id = (int) $request->route('member_id');          

        $member = ProjectUser::find($id);
        $member->delete();    

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

        return back();
    }    
    
    public function update_project_phase(Request $request) {
        $id = (int) $request->route('phase_id');  
        $user = $request->user();
        $phase = ProjectPhase::find($id);

        $phase->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back();
    }        

    public function delete_project_phase(Request $request) {
        $id = (int) $request->route('phase_id');  
        $user = $request->user();

        $phase = ProjectPhase::find($id);
        $phase->delete();
        
        return back();
    }      
    
    public function add_project_deliverable(Request $request) {
        $id = (int) $request->route('project_id');  

        ProjectDeliverable::create([
            'name' => $request->name,
            'date' => $request->date,
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
    
    public function update_project_deliverable(Request $request) {
        $id = (int) $request->route('deliverable_id');  
        $user = $request->user();
        $deliverable = ProjectDeliverable::find($id);

        $deliverable->update([
            'name' => $request->name,
            'date' => $request->date,
            'remarks' => $request->remarks,
        ]);

        return back();
    }        

    public function delete_project_deliverable(Request $request) {
        $id = (int) $request->route('deliverable_id');  
        $user = $request->user();

        $deliverable = ProjectDeliverable::find($id);
        $deliverable->delete();
        
        return back();
    }       

    public function create_requirement(Request $request) {
        
        $user = $request->user();

        $requirement = ProjectRequirement::create([
            'name' => $request->name,
            'module_name' => $request->module_name,
            'category' => $request->category,
            'remarks' => $request->remarks,

            'project_id' => $request->project_id,
            'user_id' => $user->id,
        ]);

        if($request->has('attachment')) {
            $requirement->attachment = $request->file('attachment')->store('prototype/attachment');
            $requirement->save();  
        }    
        
        ProjectTestcase::create([
            'name' => $requirement->name,
            'category' => 'NA',
            'remarks' => 'NA',
            'requirement_id' => $requirement->id,

            'project_id' => $request->project_id,
            'user_id' => $user->id,
        ]);        
     
        return back();        
    }

    public function show_requirement(Request $request) {
        $id = (int) $request->route('requirement_id');  
        $user = $request->user();

        $requirement = ProjectRequirement::find($id);
        return view('requirement_detail', compact('requirement'));
    }   
    
    public function update_requirement(Request $request) {
        $id = (int) $request->route('requirement_id');  
        $user = $request->user();

        $requirement = ProjectRequirement::find($id);
        $requirement->update([
            'name' => $request->name,
            'module_name' => $request->module_name,
            'category' => $request->category,
            'remarks' => $request->remarks,            
        ]);
        return back();
    }       
    
    public function delete_requirement(Request $request) {
        $id = (int) $request->route('requirement_id');  
        $user = $request->user();

        $requirement = ProjectRequirement::find($id);
        $requirement->delete();
        return back();
    }     
    

    public function create_testcase(Request $request) {
        
        $user = $request->user();

        $testcase = ProjectTestcase::create([
            'name' => $request->name,
            'category' => $request->category,
            'remarks' => $request->remarks,
            'requirement_id' => $request->requirement_id,

            'project_id' => $request->project_id,
            'user_id' => $user->id,
        ]);

        if($request->has('attachment')) {
            $testcase->attachment = $request->file('attachment')->store('prototype/attachment');
            $testcase->save();  
        }        
     
        return back();        
    }

    public function show_testcase(Request $request) {
        $id = (int) $request->route('testcase_id');  
        $user = $request->user();

        $testcase = ProjectTestcase::find($id);        
        return view('testcase_detail', compact('testcase'));
    }        
    
    public function update_testcase(Request $request) {
        $id = (int) $request->route('testcase_id');  
        $user = $request->user();

        $testcase = ProjectTestcase::find($id);
        $testcase->update([
            'name' => $request->name,
            'category' => $request->category,
            'remarks' => $request->remarks,       
        ]);
        return back();
    }       
    
    public function delete_testcase(Request $request) {
        $id = (int) $request->route('testcase_id');  
        $user = $request->user();

        $testcase = ProjectTestcase::find($id);
        $testcase->delete();
        return back();
    }    
    
    public function execute_testcase(Request $request) {
        $id = (int) $request->route('testcase_id');  
        $user = $request->user();
        $testcase = ProjectTestcase::find($id);
        

        $execution = ProjectTestcaseExecution::create([
            'remarks' => $request->remarks, 
            'status' => $request->status,
            'project_testcase_id' => $testcase->id,
            'user_id' => $user->id,
        ]);

        if($request->attachment) {
            $execution->attachment = $request->file('attachment')->store('prototype/attachment');
            $execution->save();
        }

        return back();
    }     
    

    // public function create_testflow(Request $request) {

    //     $user = $request->user();

    //     ProjectTestflow::create([
    //         'name' => $request->name,
    //         'category' => $request->category,
    //         'remarks' => $request->remarks,

    //         'project_id' => $request->project_id,
    //         'user_id' => $user->id,
    //     ]);
     
    //     return back();   
                
    // }

    // public function show_testflow(Request $request) {
    //     $id = (int) $request->route('testflow_id');  
    //     $user = $request->user();

    //     $testflow = ProjectTestflow::find($id);
    //     return view('testflow_detail', compact('testflow'));
    // }       

    // public function create_testflow_item(Request $request) {
        
    //     $user = $request->user();

    //     $testflow_item = ProjectTestflowItem::create([
    //         'name' => $request->name,
            
    //         'testflow_id' => $request->testflow_id,
    //         'project_id' => $request->project_id,
    //         'user_id' => $user->id,
    //     ]);
     
    //     return back();  

    // }

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

        $project_users = ProjectUser::where('project_id', $project->id)->get();

        foreach($project_users as $project_user) {
            Mail::to($project_user->user->email)->send(new TicketCreated($ticket, $message));
        }
        Mail::to('pmo@pipeline.com.my')->send(new TicketCreated($ticket, $message));


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
      
        
        $project_users = ProjectUser::where('project_id', $ticket->project->id)->get();

        foreach($project_users as $project_user) {
            Mail::to($project_user->user->email)->send(new TicketReplied($ticket, $message));
        }        

        Mail::to('pmo@pipeline.com.my')->send(new TicketReplied($ticket, $message));
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

