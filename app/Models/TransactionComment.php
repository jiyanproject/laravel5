<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionComment extends Model
{
    protected $fillable = [
    	'transaction_id',
    	'comment',
    	'created_by',
    ];

    public function Author()
    {
    	return $this->belongsTo(Employee::class,'created_by');
    }
}
