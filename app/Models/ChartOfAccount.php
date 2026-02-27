<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    use Uuid;

    protected $fillable = [
    	'account_id',
    	'account_name',
    	'account_category',
    	'opening_balance',
    	'created_by',
    	'updated_by',
    ];

    public $incrementing = false;

    public function Author()
    {
    	return $this->belongsTo(Employee::class,'created_by');
    }

    public function Editor()
    {
    	return $this->belongsTo(Employee::class,'updated_by');
    }

    public function Parent()
    {
        return $this->belongsTo(CoaCategory::class,'account_category','id');
    }
}
