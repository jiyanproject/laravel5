<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeFamily extends Model
{
    protected $fillable = [
    	'employee_id',
    	'first_name',
    	'last_name',
    	'relations',
    	'address',
    	'phone',
    	'mobile'
    ];

    public function Parent()
    {
    	return $this->belongsTo(Employee::class,'employee_id');
	}
	
	public function Employees()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
