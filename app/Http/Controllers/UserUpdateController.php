<?php

namespace App\Http\Controllers;

use App\Models\UserKemajuan;
use App\Models\UserLocation;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserUpdateController extends Controller
{
    public function admin_get_locations(Request $request) {} 

    public function get_locations(Request $request) {
        $user = $request->user();
        $locations = UserLocation::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('locations', compact('locations'));
    }

    public function send_location(Request $request) {
        $user = $request->user();

        UserLocation::create([
            'user_id' => $user->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'purpose' => $request->purpose,
            'remarks' => $request->remarks,
        ]);

        Alert::success('Success', 'Location has been updated!');
        return back();
    }

    public function get_kemajuans(Request $request) {
        $user = $request->user();
        $kemajuans = UserKemajuan::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('kemajuans', compact('kemajuans'));
    }

    public function send_kemajuan(Request $request) {
        $user = $request->user();

        $maju = UserKemajuan::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'work_package_id' => $request->wp_id,
            'remarks' => $request->remarks,
        ]);

        $maju->status = 'created';
        $maju->save();
        
        Alert::success('Success', 'Kemajuan has been updated!');
        return back();
    }    
}
