<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->hasOne('App\Models\Type', 'id', 'type_id');
    }
}
