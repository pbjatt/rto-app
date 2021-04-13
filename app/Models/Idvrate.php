<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idvrate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ageyears()
    {
        return $this->hasOne('App\Models\Age', 'id', 'age');
    }

    public function cubiccapacity()
    {
        return $this->hasOne('App\Models\CubicCapacity', 'id', 'cc');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public static function get_data($age, $zone, $cc, $type)
    {
        // echo '<pre>';
        // print_r(compact('age', 'zone', 'cc', 'type'));
        // echo '</pre>';
        $data = \DB::table('idvrates')->where('age', $age)->where('zone', $zone)->where('cc', $cc)->where('type_id', $type)->first();
        // dd($data);
        return !empty($data->idv) ? $data : null;
    }

    public static function get_data_wo_cc($age, $zone, $type)
    {
        // echo '<pre>';
        // print_r(compact('age', 'zone', 'type'));
        // echo '</pre>';
        $data = \DB::table('idvrates')->where('age', $age)->where('zone', $zone)->where('type_id', $type)->first();
        // dd($data);
        return !empty($data->idv) ? $data : null;
    }
}
