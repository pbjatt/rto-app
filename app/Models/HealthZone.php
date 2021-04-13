<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthZone extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function zonestates()
    {
        return $this->hasMany('App\Models\ZoneState', 'id', 'health_zone_id');
    }
}
