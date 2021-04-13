<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthPlanPrice;
use App\Models\HealthPlan;
use App\Models\HealthZone;
use App\Models\HealthAge;
use App\Models\FamilySize;
use App\Models\Company;
use Validator;

class HealthController extends Controller
{
    public function company()
    {
        $lists = Company::get();

        if ($lists->isEmpty()) {
            $re = [
                'status' => false,
                'message'    => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status' => true,
                'message'    => $lists->count() . " records found.",
                'data'   => $lists
            ];
        }
        return response()->json($re);
    }

    public function healthzone()
    {
        $lists = HealthZone::get();

        if ($lists->isEmpty()) {
            $re = [
                'status' => false,
                'message'    => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status' => true,
                'message'    => $lists->count() . " records found.",
                'data'   => $lists
            ];
        }
        return response()->json($re);
    }

    public function healthage()
    {
        $lists = HealthAge::get();

        if ($lists->isEmpty()) {
            $re = [
                'status' => false,
                'message'    => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status' => true,
                'message'    => $lists->count() . " records found.",
                'data'   => $lists
            ];
        }
        return response()->json($re);
    }

    public function healthplan()
    {
        $lists = HealthPlan::get();

        if ($lists->isEmpty()) {
            $re = [
                'status' => false,
                'message'    => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status' => true,
                'message'    => $lists->count() . " records found.",
                'data'   => $lists
            ];
        }
        return response()->json($re);
    }

    public function familysize()
    {
        $lists = FamilySize::get();

        if ($lists->isEmpty()) {
            $re = [
                'status' => false,
                'message'    => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status' => true,
                'message'    => $lists->count() . " records found.",
                'data'   => $lists
            ];
        }
        return response()->json($re);
    }

    public function healthplanprice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id'     => 'required',
            'health_zone_id'      => 'required',
            'health_plan_id'      => 'required',
            'family_size_id'      => 'required',
            'health_age_id'      => 'required',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $lists = HealthPlanPrice::where('company_id', $request->company_id)->where('health_zone_id', $request->health_zone_id)->where('health_plan_id', $request->health_plan_id)->where('family_size_id', $request->family_size_id)->where('health_age_id', $request->health_age_id)->get();

            if ($lists->isEmpty()) {
                $re = [
                    'status' => false,
                    'message'    => 'No record(s) found.'
                ];
            } else {
                $re = [
                    'status' => true,
                    'data'   => $lists
                ];
            }
        }
        return response()->json($re);
    }
}
