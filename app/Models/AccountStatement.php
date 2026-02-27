<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class AccountStatement extends Model
{
    use Uuid;

    protected $fillable = [
    	'transaction_date',
        'reference_no',
        'payee',
        'total',
        'balance',
        'tax_reference',
        'status_id',
    	'created_by',
    	'checked_by',
        'approved_by',
        'posted_by',
    ];

    public $incrementing = false;

    public function Statuses()
    {
    	return $this->belongsTo(Status::class,'status_id');
    }

    public function Child()
    {
        return $this->hasMany(JournalEntry::class,'account_statement_id');
    }

    public function Creator()
    {
        return $this->belongsTo(Employee::class,'created_by');
    }

    public function Checker()
    {
        return $this->belongsTo(Employee::class,'checked_by');
    }

    public function Approval()
    {
        return $this->belongsTo(Employee::class,'approved_by');
    }

    public function Posted()
    {
        return $this->belongsTo(Employee::class,'posted_by');
    }
}
