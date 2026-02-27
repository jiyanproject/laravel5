<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveTransaction extends Model
{
    protected $fillable = [
        'leave_id',
        'timeoff_type',
        'leave_type',
        'halfday_type',
    	'leave_start',
        'leave_end',
        'schedule_in',
        'schedule_out',
    	'notes',
        'amount_requested',
        'status_id',
        'approved_by'
    ];

    public function Parent()
    {
    	return $this->belongsTo(EmployeeLeave::class,'leave_id');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function Types()
    {
        return $this->belongsTo(LeaveType::class,'timeoff_type');
    }

    public function Approver()
    {
        return $this->belongsTo(User::class,'approved_by');
    }

}
