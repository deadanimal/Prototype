<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\MeetingAttendee;
use App\Models\MeetingItem;
use App\Models\Project;
use App\Models\User;
use App\Models\Workpackage;
use Carbon\Carbon;
use DataTables;

use RealRashid\SweetAlert\Facades\Alert;

class MeetingController extends Controller
{
    public function show_meetings(Request $request) {

        $user = $request->user();
        if ($user->user_type == 'client') {
            return view('dashboard_client', compact('user'));
        } else {
            $upcoming_meetings = Meeting::where([
                ['meeting_date', '>', Carbon::now('Asia/Singapore')->subDays(1)],
                ['status', '=', 'draft'],
            ])->orderBy('meeting_date')->get();
            $projects = Project::all();
    
            return view('meeting_list', compact('upcoming_meetings', 'projects'));
        }  

    }

    public function show_meeting(Request $request) {
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);
        $users = User::where('organisation_id', 1)->get();

        return view('meeting_detail', compact('meeting', 'users'));
    }

    public function create_meeting(Request $request) {
        $user = $request->user();

        Meeting::create([
            'title'=> $request->title,
            'project_id'=> $request->project_id,
            'meeting_type'=> $request->meeting_type,
            'meeting_date'=> $request->meeting_date,
            'remarks'=> $request->meeting_remarks,
            'status' => 'draft',
            'user_id'=> $user->id,
        ]);

        Alert::success('Success', 'Meeting is in Draft');

        return back();
    }  
    
    public function update_meeting(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);

        Alert::success('Success', 'Meeting has been updated!');

        return back();
    }    

    public function attend_meeting(Request $request) {
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);
        
        MeetingAttendee::create([
            'email'=> $request->email,
            'meeting_id'=> $meeting->id,
        ]);

        Alert::success('Success', 'Meeting attendance has been created!');

        return back();
    }    

    public function create_meeting_attendee(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);    

        $attendee = New MeetingAttendee;
        $attendee->name = $request->name;
        $attendee->meeting_id = $meeting->id;
        if($request->email) {
            $attendee->email = $request->email;
        } else {
            $attendee->user_id = $request->user_id;
        }
        
        $attendee->save();

        Alert::success('Success', 'Meeting attendee has been created!');

        return back();
    }      

    public function create_note(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);        

        $item = MeetingItem::create([            
            'item'=> $request->item,
            'category'=> $request->category,
            'meeting_id'=> $meeting->id,
            'user_id'=> $user->id,
        ]);

        if($request->has('attachment')) {
            $item->attachment = $request->file('attachment')->store('prototype/meeting_attachment');
            $item->save();
        }        

        Alert::success('Success', 'Meeting item has been created!');

        return back();
    }   
    
    public function update_meeting_item(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('item_id');  
        $meeting_item = MeetingItem::find($id);

        $meeting_item->update([            
            'item'=> $request->item,
            'category'=> $request->category
        ]);        

        Alert::success('Success', 'Meeting item has been updated!');

        return back();
    }   
    
    public function reschedule_meeting(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);
        $meeting->status = $request->purpose;
        $meeting->reschedule_remarks = $request->remarks;
        $meeting->save();

        if ($meeting->status == 'reschedule') {
            Meeting::create([
                'title'=> $meeting->title,
                'project_id'=> $meeting->project_id,
                'meeting_type'=> $meeting->meeting_type,
                'meeting_date'=> $request->meeting_date,
                'remarks'=> $meeting->remarks,
                'status' => 'draft',
                'user_id'=> $user->id,
            ]);   
        }    



        Alert::success('Success', 'Meeting has been updated!');

        return back();
    }    
    
    
    public function datatable_meetings(Request $request) {
        $data = Meeting::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }    
}
