<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class EmployeeAppraisal extends Model
{
    use Uuid;

    protected $fillable = [
    	'employee_id',
    	'supervisor_id',
        'appraisal_type',
    	'appraisal_period',
    	'progress',
    	'status_id',
    ];

    public $incrementing = false;

    public function Parent()
    {
    	return $this->belongsTo(Employee::class,'employee_id');
    }

    public function Supervisor()
    {
        return $this->belongsTo(Employee::class,'supervisor_id');
    }

    public function Statuses()
    {
    	return $this->belongsTo(Status::class,'status_id');
    }

    public function Types()
    {
        return $this->belongsTo(Status::class,'appraisal_type');
    }

    public function Details()
    {
        return $this->hasMany(AppraisalData::class,'appraisal_id');
    }

    public function Courses()
    {
        return $this->hasMany(EmployeeTraining::class,'appraisal_id');
    }

    public function Comments()
    {
        return $this->hasMany(AppraisalComment::class,'appraisal_id');
    }

    public function Goals()
    {
        return $this->hasMany(AppraisalSoftGoal::class,'appraisal_id');
    }

    public function Roles()
    {
        return $this->hasMany(AppraisalAdditionalRole::class,'appraisal_id');
    }
}
