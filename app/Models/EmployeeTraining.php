<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model
{
    protected $fillable = [
    	'employee_id',
        'appraisal_id',
    	'training_provider',
    	'training_title',
    	'location',
    	'from',
    	'to',
    	'status',
        'training_outcome',
        'certification',
        'reports',
        'materials',
    ];

    public function Parent()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function Docs()
    {
    	return $this->hasMany(EmployeeTrainingFile::class);
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status');
    }

    public function Appraisal()
    {
        return $this->belongsTo(EmployeeAppraisal::class,'appraisal_id');
    }
}
