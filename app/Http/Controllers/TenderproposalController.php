<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Tenderproposal;
use Illuminate\Http\Request;

class TenderproposalController extends Controller
{
    public function show_tenderproposals(Request $request) {            
        $tenders = Tenderproposal::all();
        $user = $request->user();
        $organisations = Organisation::all();
        return view('tender_list', compact('tenders', 'organisations'));
    }

    public function show_tenderproposal(Request $request) {
        $id = (int) $request->route('tenderproposal_id');  
        $tender = Tenderproposal::find($id);
        return view('tender_detail', compact('tender'));
    }

    public function create_tenderproposal(Request $request) {
        $user = $request->user();
        $tender = Tenderproposal::create([
            'title' => $request->title,
            'category' => $request->category,
            'tender_type' => $request->tender_type,
    
            'submission_date' => $request->submission_date,
            'briefing_date' => $request->briefing_date,
    
            'submission_file' => $request->file('attachment')->store('prototype/submission_file'),
            'remarks' => $request->remarks,
    
            'organisation_id' => $request->organisation_id,
            'user_id' => $user->id,            
        ]);
        return back();
    }   
    
    public function update_tenderproposal(Request $request) {
        $user = $request->user();
        $tender = Tenderproposal::find($id);
        return back();
    }      
}
