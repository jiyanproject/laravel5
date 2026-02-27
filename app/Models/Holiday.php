<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
    	'holiday_name',
    	'holiday_start',
    	'holiday_end',
    	'leave_status',
    	'status_id',
    ];

    public function Statuses()
    {
    	return $this->belongsTo(Status::class,'leave_status');
    }
}
