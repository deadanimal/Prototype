<?php

namespace App\Http\Controllers;

use App\Models\Mockup;
use Illuminate\Http\Request;

class MockupController extends Controller
{
    public function show_mockups(Request $request) {
        $mockups = Mockup::all();
        return view('mockup_list', compact('mockups'));
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
            'status' => 'draft',
            'user_id' => $user->id,
        ]);

        if($request->has('specification')) {
            $mockup->specification = $request->file('specification')->store('prototype/specification');
        }
    }    
}
