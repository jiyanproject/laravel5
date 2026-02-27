<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetDetail extends Model
{
    protected $fillable = [
    	'budget_id',
    	'budget_period',
    	'account_name',
    	'account_category',
    	'budget_amount',
    ];

    public function Parent()
    {
    	return $this->belongsTo(BudgetPeriod::class,'budget_id');
    }
}
