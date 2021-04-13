<?php

namespace App\Http\Controllers;

use App\Models\FamilySize;
use Illuminate\Http\Request;

class FamilySizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = FamilySize::get();

        // set page and title -------------
        $page  = 'familysize.list';
        $title = 'FamilySize list';
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
        $page  = 'familysize.add';
        $title = 'Add FamilySize';
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

        $record           = new familysize;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.familysize.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.familysize.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function show(FamilySize $familySize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FamilySize $familysize)
    {
        $editData =  ['record' => $familysize->toArray()];
        $request->replace($editData);
        $request->flash();

        // set page and title ------------------
        $page = 'familysize.edit';
        $title = 'Edit FamilySize';
        $data = compact('page', 'title', 'familysize');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilySize $familysize)
    {
        $rules = [
            'record'          => 'required|array',
            'record.name'      => 'required'
        ];
        $messages = [
            'record.name'  => 'Please Enter name.'
        ];
        $request->validate($rules, $messages);

        $record           = $familysize;
        $input            = $request->record;
        $record->fill($input);

        if ($record->save()) {
            return redirect(route('admin.familysize.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilySize  $familySize
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilySize $familysize)
    {
        $familysize->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
