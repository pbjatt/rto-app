<?php

namespace App\Http\Controllers;

use App\Models\HealthPlanPrice;
use App\Models\HealthPlan;
use App\Models\HealthZone;
use App\Models\HealthAge;
use App\Models\FamilySize;
use App\Models\Company;
use Illuminate\Http\Request;

class HealthPlanPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = HealthPlanPrice::paginate(10);

        if ($request->company) {
            $company   = Company::find($request->company);

            $ages   = HealthAge::pluck('name', 'id');
            $zones   = HealthPlanPrice::groupBy('health_zone_id')->pluck('health_zone_id');
            $sizes   = HealthPlanPrice::groupBy('family_size_id')->pluck('family_size_id');
            // $plans   = HealthPlanPrice::groupBy('health_plan_id')->pluck('health_plan_id');
            $plans = HealthPlan::pluck('name', 'id');
            // dd($plans);

            foreach ($zones as $zoneid => $zone) {
                foreach ($sizes as $sizeid => $size) {
                    foreach ($ages as $ageid => $age) {
                        foreach ($plans as $planid => $plan) {
                            $s = FamilySize::find($size);
                            $z = HealthZone::find($zone);
                            $health_prices[$z->name][$s->name][$age][$plan] = HealthPlanPrice::get_data($company->id, $zone, $size, $ageid, $planid);
                        }
                    }
                }
            }

            // dd($health_prices);

            $company = Company::get();
            $companyArr  = ['' => 'Select Company'];
            if (!$company->isEmpty()) {
                foreach ($company as $pcat) {
                    $companyArr[$pcat->id] = $pcat->name;
                }
            }

            $page  = 'healthplanprice.list';
            $title = 'healthplanprice list';

            $data  = compact('page', 'title', 'lists', 'health_prices', 'zones', 'ages', 'sizes', 'plans', 'companyArr');
        } else {
            $company = Company::get();
            $companyArr  = ['' => 'Select Company'];
            if (!$company->isEmpty()) {
                foreach ($company as $pcat) {
                    $companyArr[$pcat->id] = $pcat->name;
                }
            }

            $page  = 'healthplanprice.list';
            $title = 'healthplanprice list';

            $data  = compact('page', 'title', 'lists', 'companyArr');
        }

        // set page and title -------------

        return view('backend.layout.master', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ccArr  = ['' => 'Select Cubic Capacity'];

        $zone = HealthZone::get();
        $zoneArr  = ['' => 'Select Zone'];
        if (!$zone->isEmpty()) {
            foreach ($zone as $pcat) {
                $zoneArr[$pcat->id] = $pcat->name;
            }
        }

        $age = HealthAge::get();
        $ageArr  = ['' => 'Select Age'];
        if (!$age->isEmpty()) {
            foreach ($age as $pcat) {
                $ageArr[$pcat->id] = $pcat->name;
            }
        }

        $plan = HealthPlan::get();
        $planArr  = ['' => 'Select Plan'];
        if (!$plan->isEmpty()) {
            foreach ($plan as $pcat) {
                $planArr[$pcat->id] = $pcat->name;
            }
        }

        $size = FamilySize::get();
        $sizeArr  = ['' => 'Select Family Size'];
        if (!$size->isEmpty()) {
            foreach ($size as $pcat) {
                $sizeArr[$pcat->id] = $pcat->name;
            }
        }

        $company = Company::get();
        $companyArr  = ['' => 'Select Company'];
        if (!$company->isEmpty()) {
            foreach ($company as $pcat) {
                $companyArr[$pcat->id] = $pcat->name;
            }
        }

        // set page and title -------------
        $page  = 'healthplanprice.add';
        $title = 'healthplanprice Add';
        $data  = compact('page', 'title', 'planArr', 'ageArr', 'zoneArr', 'sizeArr', 'companyArr');

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
            'record'        => 'required|array',
            'record.price'  => 'required',
        ];

        $messages = [
            'record.price'  => 'Please Enter price.',
        ];

        $request->validate($rules, $messages);

        $record           = new HealthPlanPrice;
        $input            = $request->record;

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.healthplanprice.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.healthplanprice.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthPlanPrice  $healthPlanPrice
     * @return \Illuminate\Http\Response
     */
    public function show(HealthPlanPrice $healthplanprice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthPlanPrice  $healthPlanPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HealthPlanPrice $healthplanprice)
    {
        $editData =  ['record' => $healthplanprice->toArray()];
        $request->replace($editData);
        $request->flash();

        $zone = HealthZone::get();
        $zoneArr  = ['' => 'Select Zone'];
        if (!$zone->isEmpty()) {
            foreach ($zone as $pcat) {
                $zoneArr[$pcat->id] = $pcat->name;
            }
        }

        $age = HealthAge::get();
        $ageArr  = ['' => 'Select Age'];
        if (!$age->isEmpty()) {
            foreach ($age as $pcat) {
                $ageArr[$pcat->id] = $pcat->name;
            }
        }

        $plan = HealthPlan::get();
        $planArr  = ['' => 'Select Plan'];
        if (!$plan->isEmpty()) {
            foreach ($plan as $pcat) {
                $planArr[$pcat->id] = $pcat->name;
            }
        }

        $size = FamilySize::get();
        $sizeArr  = ['' => 'Select Family Size'];
        if (!$size->isEmpty()) {
            foreach ($size as $pcat) {
                $sizeArr[$pcat->id] = $pcat->name;
            }
        }

        $company = Company::get();
        $companyArr  = ['' => 'Select Company'];
        if (!$company->isEmpty()) {
            foreach ($company as $pcat) {
                $companyArr[$pcat->id] = $pcat->name;
            }
        }

        $cvalue = $healthplanprice->company_id;

        // set page and title -------------
        $page  = 'healthplanprice.edit';
        $title = 'healthplanprice Edit';
        $data  = compact('page', 'title', 'zoneArr', 'ageArr', 'planArr', 'zoneArr', 'sizeArr', 'companyArr', 'healthplanprice', 'cvalue');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthPlanPrice  $healthPlanPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthPlanPrice $healthplanprice)
    {
        $record     = $healthplanprice;
        $input      = $request->record;

        $record->fill($input);
        if ($record->save()) {
            $cvalue = $record->company_id;
            return redirect(url('admin/healthplanprice?company=' . $cvalue))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthPlanPrice  $healthPlanPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthPlanPrice $healthplanprice)
    {
        $healthplanprice->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
