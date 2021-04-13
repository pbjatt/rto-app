<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|regex:/[A-Za-z ]+/',
            'mobile'        => 'required|string|regex:/\d{10}/|unique:users,mobile,' . $user->id,
            'email'         => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            if ($user->email != request('email')) {
                $user->email_verified   = 'false';
            }

            $user->name     = request('name');
            $user->mobile   = request('mobile');
            $user->email    = request('email');
            $user->address_id    = request('address_id');

            if ($request->hasFile('image')) {
                $file = $request->image;
                $optimizeImage = Image::make($file);
                $optimizeImage->resize(200, 200);
                $optimizePath = public_path() . '/images/profile/';
                $name = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $name, 72);
                $user->image = $name;
            }

            $user->save();

            $re = [
                'status'    => true,
                'message'   => 'Success!! Profile updated successfully.',
                'data'      => $user
            ];
        }
        return response()->json($re);
    }
}
