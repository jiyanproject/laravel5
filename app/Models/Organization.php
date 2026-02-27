<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
    	'name',
    	'parent',
    ];
}
