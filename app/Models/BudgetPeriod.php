<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class BudgetPeriod extends Model
{
    use Uuid;

    protected $fillable = [
    	'budget_start',
    	'budget_end',
    	'budget_title',
    	'status_id',
    	'created_by',
    	'updated_by',
    	'approved_by',
    ];

    public $incrementing = false;

    public function Statuses()
    {
    	return $this->belongsTo(Status::class,'status_id');
    }

    public function Creator()
    {
    	return $this->belongsTo(Employee::class,'created_by');
    }

    public function Editor()
    {
    	return $this->belongsTo(Employee::class,'updated_by');
    }

    public function Approval()
    {
    	return $this->belongsTo(Employee::class,'approved_by');
    }

    public function Child()
    {
        return $this->hasMany(BudgetDetail::class,'budget_id');
    }
}
