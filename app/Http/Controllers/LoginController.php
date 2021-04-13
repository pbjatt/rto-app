<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.inc.login');
    }
    public function checklogin(Request $request)
    {
        $rules = [
            "email"       => "required",
            "password"    => "required"
        ];
        $request->validate($rules);

        $user_data= array(
            'email'     => $request->email,
            'password'  => $request->password
        );
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            $is_remembered = !empty($request->remember_me) ? true : false;
            if (Auth::attempt($user_data, $is_remembered)) {
                return redirect(route('admin-home'));
            } else {
                return redirect()->back()->with('error', 'Credentials not matched.');
            }
        } else {
            return redirect()->back()->with('error', 'Credentials not matched.');
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect(route('login'));
    }

    public function change_password()
    {
        return view('backend.inc.profile.changepassword');
    }

    public function save_password(Request $request)
    {
        $rules = [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|same:new_password',
            'confirm_password' => 'required|string|min:8|same:new_password'
        ];
        $request->validate($rules);

        $new_password = Hash::make($request->new_password);
        if($request->current_password != $request->new_password){
            Auth()->user()->update(['password' => $new_password]);
            return redirect()->back()->with('success', 'Your password has been changed successfully.');
        } else {
            return redirect()->back()->with('danger', 'Error!! Current and new password are same.');
        }
    }
    public function profile(Request $request)
    {
        $lists = Auth::guard()->user();

        $editData = $lists->toArray();
        $request->replace($editData);
        $request->flash();
        // dd($editData);
        // set page and title ------------------
        $page  = 'user.list';
        $title = 'User list';
        $data  = compact('page', 'title', 'lists');

        // return data to view
        return view('backend.layout.master', $data);
    }

    public function edit_profile(Request $request)
    {
        $rules = [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6'
        ];
        $request->validate($rules);

        $new_password = Hash::make($request->new_password);

        if($request->current_password != $request->new_password){
            $record             = Auth::guard()->user();
            $record->name       = $request->name;
            $record->email      = $request->email;
            $record->password   = $new_password;
            // dd($record);
            $record->save();
            return redirect()->back()->with('success', 'Your password has been changed successfully.');
        } else {
            return redirect()->back()->with('danger', 'Error!! Current and new password are same.');
        }
    }

    public function list()
    {
        $lists = User::whereNotIn('id', [1])->orderBy('id', 'asc')->paginate(10);
        
        // set page and title ------------------
        $page  = 'user.userlist';
        $title = 'User list';
        $data  = compact('page', 'title', 'lists');

        // return data to view
        return view('backend.layout.master', $data);
    }
}
