<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CubicCapacity;
use App\Models\Type;

class CubicCapacityController extends Controller
{
    public function index()
    {
        $lists = CubicCapacity::paginate(10);

        // set page and title -------------
        $page  = 'cubiccapacity.list';
        $title = 'cubiccapacity list';
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

        $page  = 'cubiccapacity.add';
        $title = 'Add cubiccapacity';
        $data  = compact('page', 'title', 'categoryArr');

        return view('backend.layout.master', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'record'        => 'required|array',
            'record.cc_range'   => 'required|string',
            'record.type_id'   => 'required'
        ];

        $message = [
            'record.cc_range'  => 'Please Enter cc_range.',
        ];

        $request->validate($rules, $message);

        $record           = new CubicCapacity;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.cubiccapacity.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.cubiccapacity.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function edit(Request $request, CubicCapacity $cubiccapacity)
    {
        $category = Type::get();
        $categoryArr  = ['' => 'Select Category'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->name;
            }
        }

        $editData =  ['record' => $cubiccapacity->toArray()];
        $request->replace($editData);
        $request->flash();

        $page  = 'cubiccapacity.edit';
        $title = 'Edit cubiccapacity';
        $data  = compact('page', 'title', 'cubiccapacity', 'categoryArr');

        return view('backend.layout.master', $data);
    }

    public function update(Request $request, CubicCapacity $cubiccapacity)
    {
        $record     = $cubiccapacity;
        $input      = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.cubiccapacity.index'))->with('success', 'Success! Record has been edided');
        }
    }

    public function destroy(CubicCapacity $cubiccapacity)
    {
        $cubiccapacity->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
