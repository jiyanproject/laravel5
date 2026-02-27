<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use Uuid;

    protected $fillable = [
    	'employee_id',
        'period',
    	'leave_amount',
    	'leave_usage',
    	'leave_remaining',
    ];

    public $incrementing = false;

    public function Employees()
    {
    	return $this->belongsTo(Employee::class,'employee_id');
    }

    public function Statuses()
    {
    	return $this->belongsTo(Status::class,'status_id');
    }

    public function Details()
    {
        return $this->hasMany(LeaveTransaction::class,'leave_id');
    }
}
