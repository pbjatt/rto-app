<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Age;
use App\Models\CubicCapacity;
use App\Models\Idvrate;
use App\Models\Type;

class IdvrateController extends Controller
{
    public function master(Request $request, $category)
    {
        $limit = $request->limit ?: 100;
        $category = Type::where('slug', $category)->firstOrFail();
        $category = $category->id;

        $query = Idvrate::with(['ageyears', 'cubiccapacity', 'type']);
        if (!empty($category)) {
            $query->where('type_id', $category);
        }
        $lists = $query->paginate($limit);
        // dd($lists);

        $ages   = Age::where('type_id', $category)->pluck('age', 'id');
        $zone   = Idvrate::where('type_id', $category)->groupBy('zone')->pluck('zone');
        $all_cc = CubicCapacity::where('type_id', $category)->pluck('cc_range', 'id');

        $idv_rates = [];

        if ($category == 5 || $category == 8 || $category == 9 || $category == 17 || $category == 16 || $category == 4 || $category == 5) {
            foreach ($ages as $id => $age) {
                foreach ($zone as $z) {
                    $idv_rates[$age][$z] = Idvrate::get_data_wo_cc($id, $z, $category);
                }
            }
        } else {
            foreach ($ages as $id => $age) {
                foreach ($zone as $z) {
                    foreach ($all_cc as $cc_id => $cc) {
                        $idv_rates[$age][$z][$cc] = Idvrate::get_data($id, $z, $cc_id, $category);
                    }
                }
            }
        }

        // set page and title -------------
        if ($category == 5 || $category == 8 || $category == 9 || $category == 17 || $category == 16 || $category == 4 || $category == 5) {
            $page  = 'idv.list1';
        } else {
            $page  = 'idv.list';
        }
        // dd($page);
        $title = 'idv list';
        $data  = compact('page', 'title', 'lists', 'idv_rates', 'zone', 'all_cc', 'category');
        // dd($lists);

        return view('backend.layout.master', $data);
    }

    public function index(Request $request)
    {
        // dd($request);
        $limit = $request->limit ?: 10;
        $query = Idvrate::with(['ageyears', 'cubiccapacity', 'type']);

        if (!empty($request->category)) {
            $query->whereHas('type', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $lists = $query->paginate($limit);

        // set page and title -------------
        $page  = 'idv.list';
        $title = 'idv list';
        $data  = compact('page', 'title', 'lists');

        return view('backend.layout.master', $data);
    }

    public function create(Request $request)
    {
        $ccArr  = ['' => 'Select Cubic Capacity'];

        $category = Type::findOrFail($request->category);
        $categoryArr  = ['' => 'Select Category'];
        if (!empty($category)) {
            $categoryArr[$category->id] = $category->name;
        }

        $ageArr  = ['' => 'Select Range'];

        $zoneArr  = [
            ''  => 'Select Zone',
            'A' => 'A',
            'B' => 'B',
            'C' => 'C'
        ];

        // set page and title -------------
        $page  = 'idv.add';
        $title = 'idv Add';
        $data  = compact('page', 'title', 'ccArr', 'ageArr', 'zoneArr', 'categoryArr', 'category');

        return view('backend.layout.master', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'record'        => 'required|array',
            'record.idv'  => 'required',
        ];

        $messages = [
            'record.idv'  => 'Please Enter Idv.',
        ];

        $request->validate($rules, $messages);

        $record           = new Idvrate;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            $category = Type::find($record->type_id);
            return redirect(route('admin.idv-list', $category->slug))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.idv.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Idvrate $Idvrate)
    {
        //
    }

    public function edit(Request $request, Idvrate $idv)
    {
        $editData =  ['record' => $idv->toArray()];
        $request->replace($editData);
        $request->flash();

        $category = Type::find($idv->type_id);
        $cat = Type::get();
        $categoryArr  = ['' => 'Select Category'];
        if (!$cat->isEmpty()) {
            foreach ($cat as $pcat) {
                $categoryArr[$pcat->id] = $pcat->name;
            }
        }

        $cc = CubicCapacity::where('type_id', $idv->type_id)->get();
        $ccArr  = ['' => 'Select Cubic Capacity'];
        if (!$cc->isEmpty()) {
            foreach ($cc as $pcat) {
                $ccArr[$pcat->id] = $pcat->cc_range;
            }
        }

        $age = Age::where('type_id', $idv->type_id)->get();
        $ageArr  = ['' => 'Select Range'];
        if (!$age->isEmpty()) {
            foreach ($age as $pcat) {
                $ageArr[$pcat->id] = $pcat->age;
            }
        }

        $zoneArr  = [
            ''  => 'Select Zone',
            'A' => 'A',
            'B' => 'B',
            'C' => 'C'
        ];

        // set page and title -------------
        $page  = 'idv.edit';
        $title = 'idv Edit';
        $data  = compact('page', 'title', 'ccArr', 'idv', 'ageArr', 'zoneArr', 'categoryArr', 'category');

        return view('backend.layout.master', $data);
    }

    public function update(Request $request, Idvrate $idv)
    {
        $record     = $idv;
        $input      = $request->record;

        $record->fill($input);
        if ($record->save()) {
            $category = Type::find($record->type_id);
            return redirect(route('admin.idv-list', $category->slug))->with('success', 'Success! Record has been edided');
        }
    }

    public function destroy(Idvrate $idv)
    {
        $idv->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
