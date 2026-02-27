<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = [
        'account_statement_id',
        'transaction_date',
    	'item',
    	'description',
    	'quantity',
    	'unit_price',
    	'account_name',
    	'trans_type',
    	'tax_rate',
        'tax_amount',
    	'file',
    	'amount',
        'source',
    ];

    public function Parent()
    {
        return $this->belongsTo(AccountStatement::class,'account_statement_id');
    }

    public function Accounts()
    {
        return $this->belongsTo(ChartOfAccount::class,'account_name','id');
    }
}
