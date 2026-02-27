<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceTransaction extends Model
{
    protected $fillable = [
    	'attendance_id',
    	'clock_in',
    	'clock_out',
    	'notes',
    ];

    public function Parent()
    {
    	return $this->belongsTo(EmployeeAttendance::class,'attendance_id');
    }

}
