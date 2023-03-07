<?php

namespace App\Http\Controllers;

use App\Models\Mockup;
use Illuminate\Http\Request;

class MockupController extends Controller
{
    public function show_mockups(Request $request) {
        $mockups = Mockup::all();
        $upcoming_mockups = Mockup::where('status', 'draft')->orderBy('mockup_date')->get();
        return view('mockup_list', compact('upcoming_mockups'));
    }

    public function show_mockup(Request $request) {
        $id = (int) $request->route('mockup_id');  
        $mockup = Mockup::find($id);

        return view('mockup_detail', compact('mockup'));
    }

    public function create_mockup(Request $request) {
        $user = $request->user();
        $mockup = Mockup::create([
            'project_name' => $request->project_name,
            'client_name' => $request->client_name,
            'mockup_date' => $request->mockup_date,
            'trello_link' => $request->trello_link,
            'remarks' => $request->remarks,
            'status' => 'draft',
            'user_id' => $user->id,
        ]);

        $mockup->specification = $request->file('attachment')->store('prototype/specification');
        $mockup->save();
        return back();
    }    
}
