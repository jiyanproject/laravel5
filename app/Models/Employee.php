<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Uuid;

    protected $fillable = [
    	'employee_no',
    	'first_name',
    	'last_name',
    	'date_of_birth',
    	'place_of_birth',
    	'sex',
    	'marital_status',
    	'picture',
    	'address',
    	'phone',
    	'mobile',
    	'email',
    	'id_card',
        'tax_category',
        'tax_no',
        'availability',
        'contract_status',
        'created_by',
    	'updated_by',
    ];

    public $incrementing = false;

    public function Author()
    {
    	return $this->belongsTo(User::class,'created_by');
    }

    public function Editor()
    {
    	return $this->belongsTo(User::class,'updated_by');
    }

    public function Child()
    {
        return $this->hasMany(EmployeeFamily::class,'employee_id','id');
    }

    public function Educations()
    {
        return $this->hasMany(EmployeeEducation::class,'employee_id');
    }

    public function Leaves()
    {
        return $this->hasMany(EmployeeLeave::class,'employee_id');
    }

    public function Available()
    {
        return $this->belongsTo(Status::class,'availability');
    }
    
    public function Trainings()
    {
        return $this->hasMany(EmployeeTraining::class,'employee_id');
    }

    public function Services()
    {
        return $this->hasMany(EmployeeService::class,'employee_id');
    }

    public function Attendances()
    {
        return $this->hasMany(EmployeeAttendance::class,'employee_id');
    }

    public function Contracts()
    {
        return $this->belongsTo(Status::class,'contract_status');
    }
}
