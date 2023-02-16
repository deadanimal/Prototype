<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\Project;

class MeetingController extends Controller
{
    public function show_meetings(Request $request) {
        $meetings = Meeting::all();
        $projects = Project::all();
        return view('meeting_list', compact('meetings', 'projects'));
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
