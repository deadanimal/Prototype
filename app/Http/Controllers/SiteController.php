<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SiteController extends Controller
{
    public function show_home() {
        return view('home');
    }

    public function show_dashboard(Request $request) {
        $user = $request->user();
        return view('dashboard', compact('user'));
    }    

    public function show_profile(Request $request) {
        $user = $request->user();
        return view('profile', compact('user'));
    }        

    public function update_profile_picture(Request $request) {
        $user = $request->user();
        $user->profile_picture = $request->file('profile_picture')->store('prototype/profile_picture');
        $user->save();
        Alert::success('Success', 'Profile picture has successfully uploaded');
        return back();
    }
}
