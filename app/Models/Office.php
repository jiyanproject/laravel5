<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
    	'office_name',
    	'office_address',
    	'province',
    	'city',
    ];

    public function Provinces()
    {
    	return $this->belongsTo(Province::class,'province');
    }

    public function Cities()
    {
    	return $this->belongsTo(City::class,'city');
    }
}
