<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Signature;
use Validator;
use Pdf;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $lists = Quotation::where('user_id', $user->id)->get();
        foreach ($lists as $list) {
            $list->data = json_decode($list->data);
        }

        if ($lists->isEmpty()) {
            $re = [
                'status'    => false,
                'message'   => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status'    => true,
                'message'   => $lists->count() . " records found.",
                'data'      => $lists
            ];
        }
        return response()->json($re);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data'      => 'required'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user = auth()->user();
            $quotation = new Quotation;
            $quotation->user_id = $user->id;
            // $data = [
            //     'basic_details'         => [
            //         'type_of_vehivle'                   => 'New',
            //         'policy_type'                       => '1+5 boundle policy',
            //         'trto'                              => 'Jodhpur',
            //         'zone'                              => 'B',
            //         'cubic_capacity'                    => 'UPTO 75 CC',
            //         'age_of_vehicle'                    => '0 Years',
            //     ],
            //     'part_a_own_damage'     => [
            //         'vehicle_basic_rate'                => '1.676',
            //         'basic_own_damage'                  => '1.676',
            //         'discount'                          => '1.676',
            //         'loading'                           => '1.676',
            //         'basic_od_after_discount'           => '1.676',
            //         'electric_accessories_value'        => '1.676',
            //         'non_electric_accessories_value'    => '1.676',
            //         'basic_od_before_ncb'               => '1.676',
            //         'no_claim_bonus'                    => '1.676',
            //         'gross_own_damage'                  => '1.676',
            //         'zero_dep'                          => '1.676',
            //         'other_add_on_percent'              => '1.676',
            //         'other_add_on'                      => '1.676',
            //         'final_own_damage'                  => '1.676',
            //     ],
            //     'part_b_liability'      => [
            //         'basic_tp'                          => '1.676',
            //         'cpa_owner_driver'                  => '1.676',
            //         'll_to_paid_driver'                 => '1.676',
            //         'pa_to_unnamed_passanger'           => '1.676',
            //         'tppd_cover'                        => '1.676',
            //         'final_tp'                          => '1.676',
            //     ],
            //     'part_c_final_premium'  => [
            //         'premium_before_taxes'              => '1.676',
            //         'gst'                               => '1.676',
            //         'kerala_cess'                       => '1.676',
            //         'final_premium'                     => '1.676',
            //     ]
            // ];

            $quotation->data = $request->data;
            $quotation->type_id = $request->type_id;

            $quotation->save();

            $re = [
                'status'        => true,
                'message'       => 'Success!! Quotation added successfully.',
                'quotation'     => $quotation,
            ];
        }

        return response()->json($re);
    }

    public function quotation_pdf(Request $request, $id)
    {
        $user = auth()->user();
        $user->sign = Signature::where('user_id', $user->id)->first();
        $quotation = Quotation::with('category')->findOrFail($id);
        $quotation->data = json_decode($quotation->data);
        $quotation->date =  date("d-m-Y", strtotime($quotation->created_at));
        $data = compact('quotation', 'user');

        $pdf = Pdf::loadView('quotation', $data);
        return $pdf->stream("quotation.pdf");
    }
}
