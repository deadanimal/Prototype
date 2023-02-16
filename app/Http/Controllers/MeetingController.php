<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\MeetingItem;

class MeetingController extends Controller
{
    public function show_meetings(Request $request) {
        $meetings = Meeting::all();
        return view('meeting_list', compact('meetings'));
    }

    public function show_meeting(Request $request) {
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);
        return view('meeting_detail', compact('meeting'));
    }

    public function update_meeting(Request $request) {
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);
    }

    public function attend_meeting(Request $request) {
        $id = (int) $request->route('meeting_id');  
        $meeting = Meeting::find($id);
        
    }    
}
