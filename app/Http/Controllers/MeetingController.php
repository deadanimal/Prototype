<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\MeetingAttendee;
use App\Models\MeetingItem;
use App\Models\Project;
use App\Models\Workpackage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class MeetingController extends Controller
{
    public function show_meetings(Request $request) {
        $upcoming_meetings = Meeting::where('meeting_date', '>', Carbon::now('Asia/Singapore')->subDays(1))->orderBy('meeting_date')->get();
        $projects = Project::all();

        return view('meeting_list', compact('upcoming_meetings', 'projects'));
    }

    public function show_meeting(Request $request) {
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);

        $client_attendees = MeetingAttendee::where('meeting_id', $meeting->id)->get();
        $pnsb_attendees = Workpackage::where('meeting_id', $meeting->id)->get();

        return view('meeting_detail', compact('meeting', 'client_attendees', 'pnsb_attendees'));
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
}
