<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function AllUsers()
    {
         $all_users = User::where('usertype','Admin')->get();
        return view('admin.users.view-users',compact('all_users'));
    }

    public function EditUser($id)
    {
        $all_users = User::latest()->paginate(10);
        $selected_user = User::find($id);
        return view('admin.users.edit-user',compact('selected_user','all_users'));
    }

    public function UpdateUser(Request $request,$id)
    {
        $profile_image = $request->file('photo_url');
        if (Auth::user()) {
            if ($profile_image) {
                $unique_name = hexdec(uniqid()) . '.' . $profile_image->getClientOriginalExtension();
                $photo_loc = 'images/profiles/';
                $save_photo = $photo_loc . $unique_name;
                $profile_image->move($photo_loc, $unique_name);

                $old_img = $request->old_image;
                if (!empty($old_img)) {
                    unlink($old_img);
                }
                User::find($id)->update([
                    'name' => $request->name,
                    'role'=>$request->role,
                    'email' => $request->email,
                    'photo_url' => $save_photo,
                ]);

                $custom_notification = [
                    'message' => 'User successfully Updated with Profile',
                    'alert-type' => 'success',
                ];
            } else {
                User::find($id)->update([
                    'name' => $request->name,
                    'role'=>$request->role,
                    'email' => $request->email,
                ]);

                $custom_notification = [
                    'message' => 'User successfully Updated',
                    'alert-type' => 'success',
                ];
            }
            return redirect()->route('view.users')->with($custom_notification);
        }
    }

    public function DeleteUser($id)
    {
       $delete_user = User::find($id);
       $user_photo = $delete_user -> photo_url;

      if(!empty($user_photo)){
          unlink($user_photo);
      }

       $delete_user->delete();
        $custom_notification = [
            'message' => 'User successfully deleted',
            'alert-type' => 'warning',
        ];
        return redirect()->route('view.users')->with($custom_notification);

    }

    public function AddUserPage()
    {
        $all_users = User::latest()->paginate(5);
     return view('admin.users.add-user',compact('all_users'));
    }

    public function AddUser(Request $request)
    {

        $new_user = new User;
        $code = rand(0000,9999);
        $new_user -> usertype = 'Admin';
        $new_user -> role = $request -> role;
        $new_user -> name =$request->name;
        $new_user -> email =$request->email;
        $new_user ->password = Hash::make($code);
        $new_user -> code = $code;
        $new_user -> save();

        $custom_notification = [
            'message' => 'User successfully Updated',
            'alert-type' => 'success',
        ];
        return redirect()->route('view.users')->with($custom_notification);

    }


}
