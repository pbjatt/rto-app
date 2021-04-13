<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Type;
use Illuminate\Http\Request;

class AgeController extends Controller
{
    public function index()
    {

        $lists = Age::get();

        // set page and title -------------
        $page  = 'age.list';
        $title = 'Age list';
        $data  = compact('page', 'title', 'lists');

        return view('backend.layout.master', $data);
    }

    public function create()
    {
        $category = Type::get();
        $categoryArr  = ['' => 'Select Category'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->name;
            }
        }

        $page  = 'age.add';
        $title = 'Add Age';
        $data  = compact('page', 'title', 'categoryArr');

        return view('backend.layout.master', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'record'          => 'required|array',
            'record.age'      => 'required'
        ];

        $messages = [
            'record.age'  => 'Please Enter Age.',
        ];

        $request->validate($rules, $messages);

        $record           = new Age;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.age.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.age.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function edit(Request $request, Age $age)
    {
        $editData =  ['record' => $age->toArray()];
        $request->replace($editData);
        $request->flash();

        $category = Type::get();
        $categoryArr  = ['' => 'Select Category'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->name;
            }
        }

        // set page and title ------------------
        $page = 'age.edit';
        $title = 'Edit Age';
        $data = compact('page', 'title', 'age', 'categoryArr');

        return view('backend.layout.master', $data);
    }

    public function update(Request $request, Age $age)
    {
        $rules = [
            'record'          => 'required|array',
            'record.age'      => 'required|numeric'
        ];
        $messages = [
            'record.age'  => 'Please Enter Age.'
        ];
        $request->validate($rules, $messages);

        $record           = Age::find($age->id);
        $input            = $request->record;
        $record->fill($input);

        if ($record->save()) {
            return redirect(route('admin.age.index'))->with('success', 'Success! Record has been edided');
        }
    }

    public function destroy(Age $age)
    {

        $age->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
