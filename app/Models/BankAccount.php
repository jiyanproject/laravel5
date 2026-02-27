<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use Uuid;

    protected $fillable = [
    	'bank_name',
    	'account_no',
        'chart_id',
        'opening_balance',
        'opening_date',
        'active',
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
}
