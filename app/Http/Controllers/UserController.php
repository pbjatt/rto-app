<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class UserController extends Controller
{
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

        if ($request->current_password != $request->new_password) {
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
        $lists = User::where('role_id', 2)->orderBy('id', 'asc')->paginate(10);

        // set page and title ------------------
        $page  = 'user.userlist';
        $title = 'User list';
        $data  = compact('page', 'title', 'lists');

        // return data to view
        return view('backend.layout.master', $data);
    }
}
