<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use Uuid;

    protected $fillable = [
    	'employee_id',
    	'working_hour',
    	'status_id',
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
        return $this->hasMany(AttendanceTransaction::class,'attendance_id');
    }

    public function Activity()
    {
        return $this->hasMany(AttendanceTransaction::class,'attendance_id','id')->latest();
    }
}
