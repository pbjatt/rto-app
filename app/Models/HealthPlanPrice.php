<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthPlanPrice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function get_data($company, $zone, $size, $age, $plan)
    {
        // echo '<pre>';
        // print_r(compact('company', 'zone', 'size', 'age', 'plan'));
        // echo '</pre>';
        $data = \DB::table('health_plan_prices')->where('company_id', $company)->where('health_zone_id', $zone)->where('family_size_id', $size)->where('health_age_id', $age)->where('health_plan_id', $plan)->first();
        return !empty($data->id) ? $data : null;
    }
}
