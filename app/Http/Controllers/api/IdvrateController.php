<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Idvrate;
use Validator;
use Illuminate\Http\Request;

class IdvrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zone'      => 'required',
            'age'       => 'required',
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
            $lists = Idvrate::where('type_id', $request->type_id)->where('zone', $request->zone)->where('cc', $request->cc)->where('age', $request->age)->first();

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
     * @param  \App\Models\Idvrate  $idvrate
     * @return \Illuminate\Http\Response
     */
    public function show(Idvrate $idvrate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idvrate  $idvrate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idvrate $idvrate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idvrate  $idvrate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idvrate $idvrate)
    {
        //
    }
}
