<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Validator;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'      => 'required',
            'cc'        => 'required',
            'type_id'   => 'required'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $lists = Price::where('type', $request->type)->where('cc', $request->cc)->where('type_id', $request->type_id)->first();

            if (empty($lists)) {
                $re = [
                    'status' => false,
                    'message'    => 'No record found.'
                ];
            } else {
                $re = [
                    'status' => true,
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
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //
    }
}
