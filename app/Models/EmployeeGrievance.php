<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class EmployeeGrievance extends Model
{
    use Uuid;

    protected $fillable = [
    	'employee_id',
    	'subject',
    	'type_id',
    	'is_public',
    	'description',
    	'files',
    	'status_id',
    	'rating',
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

    public function Categories()
    {
        return $this->belongsTo(GrievanceCategory::class,'type_id');
    }

    public function Child()
    {
        return $this->hasMany(GrievanceComment::class,'grievance_id','id');
    }
}
