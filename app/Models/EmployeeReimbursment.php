<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class EmployeeReimbursment extends Model
{
    use Uuid;

    protected $fillable = [
    	'employee_id',
    	'type_id',
    	'transaction_date',
    	'amount',
    	'notes',
    	'status_id',
    	'files',
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

    public function Type()
    {
    	return $this->belongsTo(ReimbursType::class,'type_id');
    }
}
