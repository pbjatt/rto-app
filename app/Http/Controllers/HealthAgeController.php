<?php

namespace App\Http\Controllers;

use App\Models\HealthAge;
use Illuminate\Http\Request;

class HealthAgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = HealthAge::get();

        // set page and title -------------
        $page  = 'healthage.list';
        $title = 'HealthAge list';
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
        $page  = 'healthage.add';
        $title = 'Add HealthAge';
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

        $record           = new HealthAge;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.healthage.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.healthage.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthAge  $healthAge
     * @return \Illuminate\Http\Response
     */
    public function show(HealthAge $healthage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthAge  $healthAge
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HealthAge $healthage)
    {
        $editData =  ['record' => $healthage->toArray()];
        $request->replace($editData);
        $request->flash();

        // set page and title ------------------
        $page = 'healthage.edit';
        $title = 'Edit HealthAge';
        $data = compact('page', 'title', 'healthage');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthAge  $healthAge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthAge $healthage)
    {
        $rules = [
            'record'          => 'required|array',
            'record.name'      => 'required'
        ];
        $messages = [
            'record.name'  => 'Please Enter name.'
        ];
        $request->validate($rules, $messages);

        $record           = $healthage;
        $input            = $request->record;
        $record->fill($input);

        if ($record->save()) {
            return redirect(route('admin.healthage.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthAge  $healthAge
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthAge $healthage)
    {
        $healthage->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
