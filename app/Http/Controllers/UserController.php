<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserHistory;
use Auth;
use Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function support() {

        return view('user.support');
    }

    public function profile() {

        return view('user.profile');
    }

    public function editprofile() {

        return view('user.edit');
    }

    public function history() {

        $user = Auth::user()->id;
        $history= UserHistory::where("user_id", $user)->paginate(20);

        return view('user.history', ['his'=> $history]);
    }

    public function updateprofile(Request $data) {

        $data->validate([
            'name' => 'required',
            'email' => 'required',
            'old_password' => 'nullable',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->name = $data->name;
        $user->email = $data->email;
        if($data->password) {

            if (Hash::check($data->old_password, $user->password)) {
            
            if ($data->old_password == $data->password) {
                session()->flash('success', 'Cannot Change a password as Same as Old Password');
                return redirect()->route('profile'); 
            }

            User::where('id', Auth::user()->id)->update(['password' => Hash::make($data->password)]);

            session()->flash('success', 'Password Successfully Updated');

            return redirect()->route('profile');
        }
        else{
            session()->flash('success', 'Password does not Matched');

            return redirect()->route('profile');
        }
    }
        $user->save();

        session()->flash('success', 'Profile updated successfully');

        return redirect()->route('profile');
    }

    public function email(Request $data) {

        $data->validate([
            'email' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ]);

        $mail = ([
            'email' => $data->email,
            'subject' => $data->subject,
            'body' => $data->body,
        ]);

        Mail::send('user.email-template', $mail, function($message) use ($mail) {
          $message->to('goberrhelp@gmail.com')
          ->subject($mail['subject']);
        });

        return back()->with(['success' => 'Email successfully sent!']);
    }
}
