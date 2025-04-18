<?php

namespace App\Http\Controllers;

use App\Mail\NewUser;
use App\Models\Meeting;
use App\Models\Organisation;
use App\Models\Trail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SiteController extends Controller
{
    public function show_home() {
        return view('home');
    }

    public function show_dashboard(Request $request) {
        $user = $request->user();
        if ($user->user_type == 'client') {
            return view('dashboard_client', compact('user'));
        } else {

            $meetings = Meeting::where([
                ['meeting_date', '>', Carbon::now('Asia/Singapore')->subDays(1)],
                ['status', '=', 'draft'],
            ])->orderBy('meeting_date')->get();  
            
            // $meetings = DB::table('meetings')
            //     ->join('meeting_attendees', 'meeting_attendees.user_id', '=', $user->id)
                // ->select('meetings.*', 'meeting_attendees.user_id')->get();
            // $meetings = Meeting::join('meeting_attendees','meeting_attendees.user_id','=',$user->id)->get();

            return view('dashboard', compact('user', 'meetings'));
        }        
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

        Trail::create([
            'category' => 'authentication',
            'user_id'=>auth()->user()->id,
            'message' => 'Change password',
        ]);

        Alert::success('Success', 'Password has been changed.');
        return back();
    }   
    
    public function show_users(Request $request) {
        $user = $request->user();
        if ($user->email != 'afeezaziz@pipeline.com.my') {
            return redirect('/');
        }
        $internal_users = User::where([
            ['status','=', 'active'],
            ['organisation_id','=', 1],
        ])->orderBy('position')->get();
        $external_users = User::where('status', 'active')->whereNotIn('organisation_id', [1])->orderBy('position')->get();        
        $organisations = Organisation::all();
        return view('users', compact('internal_users', 'external_users', 'organisations'));
    }   

    public function show_user(Request $request) {
        $user = $request->user();
        if ($user->user_type != 'admin') {
            return redirect('/');
        }

        $id = (int) $request->route('id');  
        $user = User::find($id);
        return view('user_detail', compact('user'));
    }    


    
    public function create_user(Request $request) {
        $user = $request->user();
        if ($user->email != 'afeezaziz@pipeline.com.my') {
            return redirect('/');
        }
        
        $new_user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $new_user->position = $request->position;
        $new_user->organisation_id = $request->organisation_id;
        $new_user->user_type = $request->user_type;
        
        $new_user->save();

        Mail::to($new_user->email)->send(new NewUser($new_user, $request->password));
        Mail::to('pmo@pipeline.com.my')->send(new NewUser($new_user, 'PasswordRemoved'));

        return back();
    }  

    public function update_user_password(Request $request) {
        $user = $request->user();
        $id = (int) $request->route('id');  
        if ($user->email != 'afeezaziz@pipeline.com.my') {
            return redirect('/');
        }
        
        $found_user = User::find($id);    
        $found_user->password = Hash::make($request->password);    
        $found_user->save();

        $message = "Your password has been changed by admin. New password is:".$request->password.'. Please change your password at the earliest oppurtunity';
        Http::post('https://api.green-api.com/waInstance'.env('WA_INSTANCE').'/SendTemplateButtons/'.env('WA_TOKEN'), [
            'chatId' => $found_user->whatsapp_number."@c.us",
            'message' => $message,
            'footer' => 'View the system ',
            'templateButtons' => [
                [
                    "index" => 1,
                    "urlButton" => [
                        "displayText" => 'View the system',
                        "url" => "https://prototype.com.my/dashboard",
                    ],
                ],
            ]
        ]);          

        return back();
    }      
    
    public function create_organisation(Request $request) {
        $user = $request->user();
        if ($user->email != 'afeezaziz@pipeline.com.my') {
            return redirect('/');
        }
        
        Organisation::create([
            'name' => $request->name,
            'shortname' => $request->shortname,
        ]);

        return back();
    }         


}
