<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminController extends Controller
{
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request -> session() ->invalidate();
        $request -> session() ->regenerateToken();
        return redirect()->route('login');
    }

    public function ChangePasswordPage()
    {
        return view('admin.users.change-password');
    }

    public function UpdatePassword(Request $request)
    {
        $admin_user = User::find(Auth::id());
        $current_password = $admin_user -> password;

        if(Hash::check($request->current_password,$current_password)){
            if(Auth::user()){
                User::find(Auth::id())->update([
                   'password'=>Hash::make($request->new_password),
                ]);
                Auth::logout();
                return redirect('login');

            }

        }else{
            return redirect()->back()->with('error','Current Password is Incorrect');
        }

    }


    public function ProfilePage()
    {
        return view('admin.users.profile-page');
    }
}
