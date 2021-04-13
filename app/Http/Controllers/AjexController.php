<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\Idvrate;
use App\Models\Age;
use App\Models\CubicCapacity;

class AjexController extends Controller
{
    public function changeoption(Request $request)
    {
        $Age = Age::latest()->where('type_id', $request->category)->get();
        $CubicCapacity = CubicCapacity::latest()->where('type_id', $request->category)->get();

        $ccArr  = ['' => 'Select Cubic Capacity'];
        if (!$CubicCapacity->isEmpty()) {
            foreach ($CubicCapacity as $pcat) {
                $ccArr[$pcat->id] = $pcat->cc_range;
            }
        }

        $ageArr  = ['' => 'Select Range'];
        if (!$Age->isEmpty()) {
            foreach ($Age as $pcat) {
                $ageArr[$pcat->id] = $pcat->age;
            }
        }

        $age = view('backend.template.age_select', compact('ageArr'))->render();
        $cc = view('backend.template.cc_select', compact('ccArr'))->render();

        $re = [
            'age' => $age,
            'cc' => $cc
        ];

        return response()->json($re, 200);
    }
}
