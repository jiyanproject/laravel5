<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
    	'city_name',
    	'province_id',
    ];

    public function Provinces()
    {
    	return $this->belongsTo(Province::class,'province_id');
    }
}
