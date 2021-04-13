<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Signature;
use Validator;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $signature = Signature::where('user_id', $user->id)->first();

        $re = [
            'status'    => true,
            'signature' => $signature
        ];

        return response()->json($re);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'mobile'    => 'required|string|regex:/\d{10}/',
            'email'     => 'required|email',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {

            $user = auth()->user();
            $signature = Signature::where('user_id', $user->id)->first();

            $signature->name    = $request->name;
            $signature->mobile  = $request->mobile;
            $signature->email   = $request->email;

            $signature->save();
            $re = [
                'status'        => true,
                'message'       => 'Success!! Signature Updated successfully.',
                'signnature'    => $signature,
            ];
        }
        return response()->json($re);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
