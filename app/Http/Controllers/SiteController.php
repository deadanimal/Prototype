<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function change_password(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        Alert::success('Success', 'Password has been changed.');
        return back();
    }    
}
