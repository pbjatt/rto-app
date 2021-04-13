<?php

namespace App\Http\Controllers;

use App\Models\HealthZone;
use App\Models\State;
use App\Models\ZoneState;
use Illuminate\Http\Request;

class HealthZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = HealthZone::get();

        // set page and title -------------
        $page  = 'healthzone.list';
        $title = 'Company list';
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
        $state = State::get();
        $stateArr  = ['' => 'Select state'];
        if (!$state->isEmpty()) {
            foreach ($state as $pcat) {
                $stateArr[$pcat->id] = $pcat->name;
            }
        }

        $page  = 'healthzone.add';
        $title = 'Add Company';
        $data  = compact('page', 'title', 'stateArr');

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

        $record           = new HealthZone;
        $input            = $request->record;

        $record->fill($input);
        $record->save();
        foreach ($request->state as $i => $state) {
            $zonestates = new ZoneState;
            $stateArr = [
                'health_zone_id' => $record->id,
                'state_id' => $state
            ];
            $zonestates->fill($stateArr);
            $zonestates->save();
        }

        return redirect(route('admin.healthzone.index'))->with('success', 'Success! New record has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthZone  $healthZone
     * @return \Illuminate\Http\Response
     */
    public function show(HealthZone $healthZone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthZone  $healthZone
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HealthZone $healthzone)
    {
        $editData =  ['record' => $healthzone->toArray()];
        $request->replace($editData);
        $request->flash();

        $state = State::get();
        $stateArr  = ['' => 'Select state'];
        if (!$state->isEmpty()) {
            foreach ($state as $pcat) {
                $stateArr[$pcat->id] = $pcat->name;
            }
        }

        // set page and title ------------------
        $page = 'healthzone.edit';
        $title = 'Edit HealthZone';
        $data = compact('page', 'title', 'healthzone', 'stateArr');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthZone  $healthZone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthZone $healthzone)
    {
        $rules = [
            'record'          => 'required|array',
            'record.name'      => 'required'
        ];
        $messages = [
            'record.name'  => 'Please Enter name.'
        ];
        $request->validate($rules, $messages);

        $record           = $healthzone;
        $input            = $request->record;
        $record->fill($input);

        if ($record->save()) {
            return redirect(route('admin.healthzone.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthZone  $healthZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthZone $healthzone)
    {
        $healthzone->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
