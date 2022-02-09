<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserHistory;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function index()
    {
        //
        return view('admin.dashboard');
    }

    public function userList ()
    {
       $users = user::where('user_type', 'user')->get();

       return view('admin.user-list', [
           'users' => $users,
       ]);
    }

    public function userstatus($id,$status)
    {
        User::where('id',$id)->update(['user_status' => $status]);
            
        return redirect()->route('admin.user-list');
    }

    public function destroy($id) {

        $user = User::find($id)->delete();

        return redirect()->route('admin.user-list');
    }

    public function history($id) {

        $user = UserHistory::where('user_id', $id)->paginate(20);

        return view('admin.userhistory', [ 'user' => $user ]);
    }
}
