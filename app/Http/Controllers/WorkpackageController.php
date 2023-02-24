<?php

namespace App\Http\Controllers;

use App\Models\Workpackage;
use Illuminate\Http\Request;

class WorkpackageController extends Controller
{
    public function show_workpackages(Request $request) {
        $workpackages = Workpackage::all();
        return view('workpackage_list', compact('workpackages'));
    }

    public function show_workpackage(Request $request) {
        $id = (int) $request->route('workpackage_id');  
        $workpackage = Workpackage::find($id);

        return view('workpackage_detail', compact('workpackage'));
    }
}
