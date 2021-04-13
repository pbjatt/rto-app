<?php

namespace App\Http\Controllers;

use App\Models\HealthPlan;
use Illuminate\Http\Request;

class HealthPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = HealthPlan::get();

        // set page and title -------------
        $page  = 'healthplan.list';
        $title = 'HealthPlan list';
        $data  = compact('page', 'title', 'lists');

        return view('backend.layout.master', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page  = 'healthplan.add';
        $title = 'Add HealthPlan';
        $data  = compact('page', 'title');

        return view('backend.layout.master', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'record'          => 'required|array',
            'record.name'      => 'required'
        ];

        $messages = [
            'record.name'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new HealthPlan;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.healthplan.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.healthplan.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthPlan  $healthPlan
     * @return \Illuminate\Http\Response
     */
    public function show(HealthPlan $healthplan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthPlan  $healthPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HealthPlan $healthplan)
    {
        $editData =  ['record' => $healthplan->toArray()];
        $request->replace($editData);
        $request->flash();

        // set page and title ------------------
        $page = 'healthplan.edit';
        $title = 'Edit HealthPlan';
        $data = compact('page', 'title', 'healthplan');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthPlan  $healthPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthPlan $healthplan)
    {
        $rules = [
            'record'          => 'required|array',
            'record.name'      => 'required'
        ];
        $messages = [
            'record.name'  => 'Please Enter name.'
        ];
        $request->validate($rules, $messages);

        $record           = $healthplan;
        $input            = $request->record;
        $record->fill($input);

        if ($record->save()) {
            return redirect(route('admin.healthplan.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthPlan  $healthPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthPlan $healthplan)
    {
        $healthplan->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
