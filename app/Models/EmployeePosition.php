<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    protected $fillable = [
    	'position_name',
    	'created_by',
    	'updated_by',
    ];

    public function Author()
    {
    	return $this->belongsTo(User::class,'created_by');
    }

    public function Editor()
    {
    	return $this->belongsTo(User::class,'updated_by');
    }
}
