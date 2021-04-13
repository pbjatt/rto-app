<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Type::where('type_id', null)->get();
        foreach ($lists as $list) {
            $subtype = Type::latest()->where('type_id', $list->id)->get();
            $list->subtype = $subtype;
        }

        $page  = 'type.list';
        $title = 'Type list';
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
        $type = Type::get();
        $typeArr  = ['' => 'Select parent'];
        if (!$type->isEmpty()) {
            foreach ($type as $pcat) {
                $typeArr[$pcat->id] = $pcat->name;
            }
        }

        $page  = 'type.add';
        $title = 'Add Type';
        $data  = compact('page', 'title', 'typeArr');

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
            'record.name'      => 'required|string',
        ];

        $messages = [
            'record.name'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Type;
        $input            = $request->record;

        $input['slug']    = Str::slug($input['name'], '-');

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.type.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.type.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Type $type)
    {
        $editData =  ['record' => $type->toArray()];
        $request->replace($editData);
        $request->flash();

        $types = Type::get();
        $typeArr  = ['' => 'Select parent'];
        if (!$types->isEmpty()) {
            foreach ($types as $pcat) {
                $typeArr[$pcat->id] = $pcat->name;
            }
        }

        // set page and title ------------------
        $page = 'type.edit';
        $title = 'Edit Type';
        $data = compact('page', 'title', 'type', 'typeArr');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $rules = [
            'record'            => 'required|array',
            'record.name'      => 'required|string',
        ];

        $messages = [
            'record.name'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);
        $record     = $type;
        $input      = $request->record;

        $input['slug']    = Str::slug($input['name'], '-');

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.type.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
