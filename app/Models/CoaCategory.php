<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class CoaCategory extends Model
{
    protected $fillable = [
    	'category_name'
    ];

    public function Child()
    {
    	return $this->hasMany(ChartOfAccount::class,'account_category');
    }
}
