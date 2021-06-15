<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CubicCapacity;
use App\Models\Price;
use App\Models\Type;

class PriceController extends Controller
{
    public function master(Request $request, $category)
    {
        $limit = $request->limit ?: 100;
        $category = Type::where('slug', $category)->firstOrFail();
        $cat = $category;
        $category = $category->id;

        $query = Price::with('cubiccapacity');
        if (!empty($category)) {
            $query->where('type_id', $category);
        }
        $lists = $query->paginate($limit);
        // dd($lists);

        $zone   = Price::where('type_id', $category)->groupBy('type')->pluck('type');
        $all_cc = CubicCapacity::where('type_id', $category)->pluck('cc_range', 'id');
        // dd($zone);

        $price_rates = [];

        if ($category == 5) {
            foreach ($zone as $z) {
                $price_rates[$z] = Price::get_data_wo_cc($z, $category);
            }
        } elseif ($category == 8 || $category == 9 || $category == 10 || $category == 11 || $category == 12 || $category == 13) {
            foreach ($all_cc as $cc_id => $cc) {
                $price_rates[$cc] = Price::get_data_w_cc($cc_id, $category);
            }
        } else {
            foreach ($all_cc as $cc_id => $cc) {
                foreach ($zone as $z) {
                    $price_rates[$cc][$z] = Price::get_data($z, $cc_id, $category);
                }
            }
        }
        // dd($price_rates);

        // set page and title -------------
        if ($category == 17 || $category == 16 || $category == 4 || $category == 5 || $category == 6) {
            $page = 'price.list3';
        } elseif ($category == 12 || $category == 13) {
            $page  = 'price.list1';
        } elseif ($category == 8 || $category == 9 || $category == 10 || $category == 11) {
            $page  = 'price.list2';
        } else {
            $page  = 'price.list';
        }
        $title = 'Price list';
        $data  = compact('page', 'title', 'lists', 'price_rates', 'zone', 'all_cc', 'category', 'cat');

        return view('backend.layout.master', $data);
    }
    public function index()
    {
        $lists = Price::with('cubiccapacity')->get();

        // set page and title -------------
        $page  = 'price.list';
        $title = 'Price list';
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

        $typeArr  = [
            ''  => 'Select Type',
            'New' => 'New',
            'Renewal' => 'Renewal'
        ];

        $page  = 'price.add';
        $title = 'Add price';
        $data  = compact('page', 'title', 'ccArr', 'typeArr', 'categoryArr', 'category');

        return view('backend.layout.master', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'record'        => 'required|array',
            'record.price'  => 'required',
            'record.type_id'  => 'required',
        ];

        $messages = [
            'record.price'  => 'Please Enter price.',
        ];

        $request->validate($rules, $messages);

        $record           = new Price;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            $category = Type::find($record->type_id);
            return redirect(route('admin.price-list', $category->slug))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.price.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function edit(Request $request, Price $price)
    {
        $editData =  ['record' => $price->toArray()];
        $request->replace($editData);
        $request->flash();

        $category = Type::find($price->type_id);
        $cat = Type::get();
        $categoryArr  = ['' => 'Select Category'];
        if (!$cat->isEmpty()) {
            foreach ($cat as $pcat) {
                $categoryArr[$pcat->id] = $pcat->name;
            }
        }

        $cc = CubicCapacity::where('type_id', $price->type_id)->get();
        $ccArr  = ['' => 'Select Cubic Capacity'];
        if (!$cc->isEmpty()) {
            foreach ($cc as $pcat) {
                $ccArr[$pcat->id] = $pcat->cc_range;
            }
        }

        $typeArr  = [
            ''  => 'Select Type',
            'New' => 'New',
            'Renewal' => 'Renewal'
        ];

        // set page and title ------------------
        $page = 'price.edit';
        $title = 'Edit Price';
        $data = compact('page', 'title', 'price', 'ccArr', 'typeArr', 'categoryArr', 'category');

        return view('backend.layout.master', $data);
    }

    public function update(Request $request, Price $price)
    {
        $record     = $price;
        $input      = $request->record;

        $record->fill($input);
        if ($record->save()) {
            $category = Type::find($record->type_id);
            return redirect(route('admin.price-list', $category->slug))->with('success', 'Success! Record has been edided');
        }
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
