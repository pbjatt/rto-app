<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Rto;
use Validator;
use Illuminate\Http\Request;

class RtoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$lists = Rto::where('name', 'like', '%' . $request->rto_name . '%')->get();

		if($lists->isEmpty()) {
			$re = [
				'status' => false,
				'message'	=> 'No record(s) found.'
			];
		}else{
			$re = [
				'status' => true,
				'message'	=> $lists->count()." records found.",
				'data'   => $lists
			];
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
     * @param  \App\Models\Rto  $rto
     * @return \Illuminate\Http\Response
     */
    public function show(Rto $rto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rto  $rto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rto $rto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rto  $rto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rto $rto)
    {
        //
    }
}
