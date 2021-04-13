<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Tool::latest()->get();

        $page  = 'tool.list';
        $title = 'Tool list';
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
        $page  = 'tool.add';
        $title = 'Add Tool';
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
            'record'            => 'required|array',
            'record.title'      => 'required|string',
        ];

        $messages = [
            'record.title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Tool;
        $input            = $request->record;

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : $input['slug'];

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.tool.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.tool.index'))->with('danger', 'Error! Something going wrong.');
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tool $tool)
    {
        $editData =  ['record' => $tool->toArray()];
        $request->replace($editData);
        $request->flash();

        // set page and title ------------------
        $page = 'tool.edit';
        $title = 'Edit Tool';
        $data = compact('page', 'title', 'tool');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $rules = [
            'record'            => 'required|array',
            'record.title'      => 'required|string',
            'record.slug'       => 'unique:tools,slug,' . $tool->id
        ];

        $messages = [
            'record.title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);
        $record     = $tool;
        $input      = $request->record;

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : $input['slug'];

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.tool.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
