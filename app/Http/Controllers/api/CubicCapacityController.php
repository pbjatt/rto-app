<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CubicCapacity;
use Illuminate\Http\Request;
use Validator;

class CubicCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id'  => 'required'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $lists = CubicCapacity::where('type_id', $request->type_id)->get();

            if ($lists->isEmpty()) {
                $re = [
                    'status' => false,
                    'message'    => 'No record(s) found.'
                ];
            } else {
                $re = [
                    'status' => true,
                    'message'    => $lists->count() . " records found.",
                    'data'   => $lists
                ];
            }
        }
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
     * @param  \App\Models\CubicCapacity  $cubicCapacity
     * @return \Illuminate\Http\Response
     */
    public function show(CubicCapacity $cubicCapacity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CubicCapacity  $cubicCapacity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CubicCapacity $cubicCapacity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CubicCapacity  $cubicCapacity
     * @return \Illuminate\Http\Response
     */
    public function destroy(CubicCapacity $cubicCapacity)
    {
        //
    }
}
