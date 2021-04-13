<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cubiccapacity()
    {
        return $this->hasOne('App\Models\CubicCapacity', 'id', 'cc');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Type', 'id', 'type_id');
    }

    public static function get_data($zone, $cc, $type)
    {
        // echo '<pre>';
        // print_r(compact('zone', 'cc', 'type'));
        // echo '</pre>';
        $data = \DB::table('prices')->where('type', $zone)->where('cc', $cc)->where('type_id', $type)->first();
        // dd($data);
        return !empty($data->id) ? $data : null;
    }

    public static function get_data_wo_cc($zone, $type)
    {
        // echo '<pre>';
        // print_r(compact('age', 'zone', 'type'));
        // echo '</pre>';
        $data = \DB::table('prices')->where('type', $zone)->where('type_id', $type)->first();
        // dd($data);
        return !empty($data->id) ? $data : null;
    }
}
