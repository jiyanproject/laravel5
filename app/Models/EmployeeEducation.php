<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $fillable = [
    	'employee_id',
    	'institution_name',
        'date_of_graduate',
    	'degree',
    	'major',
    	'gpa',
    ];

    public function Parent()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function Employees()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
