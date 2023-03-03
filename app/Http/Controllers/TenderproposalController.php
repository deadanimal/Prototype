<?php

namespace App\Http\Controllers;

use App\Models\Tenderproposal;
use Illuminate\Http\Request;

class TenderproposalController extends Controller
{
    public function show_tenderproposals(Request $request) {            
        $tenders = Tenderproposal::all();
        $user = $request->user();
        return view('tender_list', compact('tenders'));
    }

    public function show_tenderproposal(Request $request) {
        $id = (int) $request->route('tenderproposal_id');  
        $tender = Tenderproposal::find($id);
        return view('tender_detail', compact('tender'));
    }

    public function create_tenderproposal(Request $request) {
        $user = $request->user();
        $tender = Tenderproposal::create([]);
        return back();
    }   
    
    public function update_tenderproposal(Request $request) {
        $user = $request->user();
        $tender = Tenderproposal::find($id);
        return back();
    }      
}
